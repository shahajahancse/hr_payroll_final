<?php
// echo phpinfo();exit;

class Attn_process_con extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		/* Standard Libraries */
		$this->load->library('grocery_CRUD');
		$this->load->model('attn_process_model');
		$this->load->model('log_model');
		ini_set('memory_limit', -1);
		ini_set('max_execution_time', 0);
	    set_time_limit(0);
		
		$this->load->model('acl_model');
		$this->load->model('common_model');
	}
	//-------------------------------------------------------------------------------------------------------
	// Form display for Attendance Process
	//-------------------------------------------------------------------------------------------------------
	function attn_process_form()
	{
		if($this->session->userdata('logged_in')==FALSE)
		$this->load->view('login_message');
		else
		$this->load->view('form/attn_process');
	}

	function auto_shift_change($input_date)
	{
		$this->load->model('acl_model');
		$date 		= $input_date;
		//$emp_arr = array(000187,000317,000321,000186,000347,000552,000835,000846,002229,002551,002552,002686,002924,002923,003116,003128,004397);
		$emp_fixed_shift = array(15,16,17);
		$nameOfDay = date('D', strtotime($date));
		$udate =date("Y-m-d", strtotime($date));
		if($udate > date('Y-m-d')){
			echo 'Pleased select  6 days ago to today.';
			exit();
		}

		$pdate =date('Y-m-d', strtotime('-6 days'));
		/*if($udate < $pdate){
			echo 'Pleased select  6 days ago to today.';
			return ;
		}*/


		$per_data=date('Y-m-d', strtotime("$udate,-1 day"));

		$this->db->select('*');
		$this->db->from('pr_emp_shift_process');
		$this->db->where('date', $per_data);
		$process_date=$this->db->get()->num_rows();
		if($process_date>0){
			// continue();
		}
		else{
			echo "Process first the date: ". $per_data;
			exit();
		}

		$this->db->select('*');
		$this->db->from('pr_emp_weekend');
		$this->db->where('day', $nameOfDay);
		$offday_query=$this->db->get();
		foreach($offday_query->result() as $row_id) {
			$offday_id[]= $row_id->id;//1
		}

		$this->db->select('*');
		$this->db->from('pr_emp_shift_process');
		$this->db->where('date', $udate);
		$process_date=$this->db->get()->num_rows();

		if($process_date>0){
			//echo '<div id="report-danger" class="report-div danger" style="display: block;"><p>Alredy Shift Changed </p></div>';
		}
		else{
			//echo "yes";
			//echo $nameOfDay;exit;
			if($nameOfDay=='Fri'){
				//echo "no";
				$this->db->select('emp_id, emp_shift');
				$this->db->from('pr_emp_com_info');
				$this->db->where_in('pr_emp_com_info.emp_shift', $emp_fixed_shift);
				//$this->db->where_in('weekend', $offday_id);
				$offday=$this->db->get()->result();
				//echo $this->db->last_query();
				$i=0;
				foreach ($offday as $item) {
					$i=$i+1;

					$id=$item->emp_id;
					//echo $item->emp_shift
					if($item->emp_shift==15){
						$emp_shift=17;
					}
					if($item->emp_shift==17){
						$emp_shift=16;
					}
					if($item->emp_shift==16){
						$emp_shift=15;
					}

					$data=array(
						'emp_shift'=>$emp_shift
					);

					$this->db->where('emp_id', $id);
					$this->db->update('pr_emp_com_info', $data);

					/*if($i>0){
					$data=array(
						'date'=>$udate
					);
					$this->db->insert('pr_emp_shift_process', $data);
					}else{
					}*/
				}

				$data=array(
						'date'=>$udate
					);

				$this->db->insert('pr_emp_shift_process', $data);

			}else{
				$data=array(
					'date'=>$udate
				);
				$this->db->insert('pr_emp_shift_process', $data);
		}
	  }
	}

	function attn_process(){
		$access_level = 4;
		$acl = $this->acl_model->acl_check($access_level);

		$unit = $this->input->post('unit_id');
		$date = $this->input->post('p_start_date');
		$spl = $this->input->post('spl');
		$input_date = date("Y-m-d", strtotime($date));
		$grid_emp_id = explode('xxx', $spl);
		//print_r($grid_emp_id);exit;
		//$this->earn_leave_process($input_date);
		// For Shift Auto Change
		// $this->auto_shift_change($input_date);
		$this->db->trans_start();
		ini_set('memory_limit', '-1M');
		set_time_limit(0);
		$data = $this->attn_process_model->attn_process($input_date,$unit,$grid_emp_id);
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE){
			exit('fiz');
			$this->db->trans_rollback();
			echo "Process failed";
		}else{
			$this->db->trans_commit();
			if(is_array($data)){
				// ATTENDANCE PROCESS LOG Generate
				$this->log_model->log_attn_process($input_date);
				echo "Process completed sucessfully";
			}else{
				echo $data;
			}
		}
	}

	function attn_process_month(){
		$access_level = 4;
		$acl = $this->acl_model->acl_check($access_level);

		$unit = $this->input->post('unit_id');
		$date = $this->input->post('p_start_date');
		$spl = $this->input->post('spl');
		$input_date = date("Y-m-d", strtotime($date));
		$grid_emp_id = explode('xxx', $spl);
		// print_r($grid_emp_id);exit;
		$this->db->trans_start();
		ini_set('memory_limit', '-1M');
		set_time_limit(0);
		$Month_length = date('t',strtotime($input_date));
		$month_year = date('Y-m',strtotime($input_date));

		for($loop = 1;$loop <= $Month_length;$loop++)
		{
			$input_date = date('Y-m-d',strtotime($month_year.'-'.$loop));
			$data = $this->attn_process_model->attn_process($input_date,$unit,$grid_emp_id);
		}

		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			echo "Process failed";
		}else{
			$this->db->trans_commit();
			if(is_array($data)){
				// ATTENDANCE PROCESS LOG Generate
				$this->log_model->log_attn_process($input_date);
				echo "Process completed sucessfully";
			}else{
				echo $data;
			}
		}
	}

	function earn_leave_process($input_date)
	{
		$data = $this->attn_process_model->earn_leave_process($input_date);
	}

	function deduction_hour_process($date)
	{
		$data = $this->attn_process_model->deduction_hour_process($date);
	}

	function test()
	{
		$date1 = '2012-08-20';
		$date2 = date('Y-m-d');
		echo $days = $this->attn_process_model->get_date_to_date_day_differance($date1,$date2);
	}
	function crud_output($output = null)
	{
		$this->load->view('output.php',$output);
	}
	function attn_file_upload()
	{
		$user_id = $this->acl_model->get_user_id($this->session->userdata('username'));
		$acl     = $this->acl_model->get_acl_list($user_id);

		$crud = new grocery_CRUD();

		$crud->set_table('pr_attn_file_upload');
		$crud->set_subject('Attendance File Upload');

		$get_session_user_unit = $this->common_model->get_session_unit_id_name();
		if($get_session_user_unit != 0)
		{
			$crud->where('pr_attn_file_upload.unit_id',$get_session_user_unit);
		}
		$state = $crud->getState();
 		$crud->display_as( 'unit_id' , 'Unit' );

		if($state == 'add' || $state == 'insert_validation')
		{
			$crud->required_fields( 'file_name','upload_date','unit_id');
			$crud->set_rules('upload_date','Date','trim|required|callback_date_duplication_check_for_unit');
			$crud->callback_before_insert(array($this,'upload_file_name_change'));
		}

		/*elseif($state == 'edit'  || $state == 'update_validation')
		{
			$crud->required_fields( 'file_name');
			$crud->change_field_type('upload_date','readonly');
		}*/
		if($get_session_user_unit != 0)
		{
			$crud->set_relation( 'unit_id' , 'pr_units','unit_name',array('unit_id' => $get_session_user_unit) );
		}
		else
		{
			$crud->set_relation( 'unit_id' , 'pr_units','unit_name' );
		}

		$crud->set_field_upload('file_name','data/');
		$crud->unset_edit();
		if(in_array(10,$acl)){
		$crud->columns('unit_id','upload_date','status','last_process_time','username');
		}
		$crud->fields('unit_id','file_name','upload_date');
		$crud->order_by('upload_date','DESC');
		//$crud->unset_delete();
		$output = $crud->render();
		$this->crud_output($output);
	}

	function date_duplication_check_for_unit($upload_date)
	{
	   	$year 	= substr($upload_date,6,4);
		$month 	= substr($upload_date,3,2);
		$day 	= substr($upload_date,0,2);
		$upload_date = "$year-$month-$day";
		$unit = $_POST['unit_id'];

		$num_row = $this->db->where('upload_date',$upload_date)->where('unit_id',$unit)->get('pr_attn_file_upload')->num_rows();
		if ($num_row > 0)
		{
			$this->form_validation->set_message('date_duplication_check_for_unit', "Sorry! The Upload Date is already exist.");
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}

	function file_upload()
	{
		$crud = new grocery_CRUD();

		$crud->set_table('pr_attn_file_upload');
		$crud->set_subject('Factory File Upload');

		$state = $crud->getState();
		// echo $state;
		if($state == 'add' || $state == 'insert_validation')
		{
			if ($state == 'insert_validation') {
				$input_date = explode('/', $_POST['upload_date']);
				$where = $input_date[2].'-'.$input_date[1].'-'.$input_date[0];
				$file_checking = $this->db->where('pr_attn_file_upload.upload_date',$where)->get('pr_attn_file_upload')->num_rows();
				if ($file_checking > 0) {
					throw new Exception('duplication date is not allowed to do this operation');
					die();
				} else {
					$crud->required_fields( 'file_name','upload_date');
					$crud->set_rules('upload_date','Date','trim|required');
				}
			}
		}
		elseif($state == 'edit'  || $state == 'update_validation')
		{
			$crud->required_fields( 'file_name');
			$crud->change_field_type('upload_date','readonly');
		}

		$crud->set_field_upload('file_name','data/');

		$crud->fields('file_name','upload_date');
		$crud->order_by('upload_date','DESC');
		//$crud->unset_delete();
		$output = $crud->render();
		$this->crud_output($output);
	}
}
