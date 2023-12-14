<?php
class Salary_process_con extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
		/* Standard Libraries */
		$this->load->model('salary_process_model');
		$this->load->model('festival_bonus_model');
		$this->load->model('log_model');
		$this->load->model('common_model');

		set_time_limit(0);
		ini_set("memory_limit","512M");

        if ($this->session->userdata('logged_in') == false) {
            redirect("authentication");
        }
        $this->data['user_data'] = $this->session->userdata('data');
        if (!check_acl_list($this->data['user_data']->id, 7)) {
            echo "<SCRIPT LANGUAGE=\"JavaScript\">alert('Sorry! Acess Deny');</SCRIPT>";
            redirect("payroll_con");
            exit;
        }

	}
	
	function salary_process_form()
	{
        if ($this->session->userdata('logged_in') == false) {
            redirect("authentication");
        }
        $this->data['employees'] = array();
        $this->db->select('pr_units.*');
        $this->data['dept'] = $this->db->get('pr_units')->result_array();

        if (!empty($this->data['user_data']->unit_name)) {
	        $this->data['employees'] = $this->common_model->get_emp_by_unit($this->data['user_data']->unit_name);
        }

        $this->data['username'] = $this->data['user_data']->id_number;
        $this->data['title'] = 'Salary Process';
        $this->data['subview'] = 'salary/salary_process_form';
        $this->load->view('layout/template', $this->data);

	}

	//////////////  salary process ///////////////
	function salary_process()
	{
        if ($this->session->userdata('logged_in') == false) {
            redirect("authentication");
        }
		$unit_id 	   = $this->input->post('unit_id');
		$process_month = $this->input->post('process_month');
		$emp_id 	   = $this->input->post('sql');
		$grid_emp_id   = explode(',', $emp_id);

		if(empty($unit_id)){return "Please Login As an Unit User.";}

		$result = $this->salary_process_model->salary_process($unit_id,$process_month,$grid_emp_id);
		if($result == "Process completed successfully")
		{
			// SALARY PROCESS LOG Generate
			$this->log_model->log_salary_process($process_month);
			echo $result;
		}
		else
		{
			echo $result;		
		}

	}

	////////////// salary process block ///////////////
	function salary_process_block()
	{
		dd($_POST);


		$unit_id 		= $this->input->post('unit_id');
		$process_month  = $this->input->post('process_month');
		$grid_emp_id 	= $this->input->post('sql');

		if($process_check == "2")
		{
		  $block_year_month 		= "$year_month-01";
		  $data_1['block_month'] 	= $block_year_month;
		  $data_1['unit_id'] 		= $unit_id;
		  $data_1['username'] 		= $this->session->userdata('username');
		  $data_1['date_time'] 		= date("Y-m-d H:i:s");
		  $this->db->insert('pay_salary_block', $data_1);
		}

		if($result == "Process completed successfully")
		{
			// SALARY PROCESS LOG Generate
			$this->log_model->log_salary_process($year, $month);
			echo $result;
		}
		else
		{
			echo $result;		
		}

	}
	
	////////////// salary process block ///////////////
	function salary_block_delete()
	{
		dd($_POST);


		$year = $this->input->post('unit_id');
		$month = $this->input->post('process_date');
		$grid_emp_id = $this->input->post('sql');

		$process_check = $this->input->post('process_check');
		$grid_emp_id = explode('xxx', $grid_emp_id);
		
		// print_r($grid_emp_id);exit;
		$this->load->model('common_model');

		$result = $this->salary_process_model->pay_sheet($year, $month,$process_check,$grid_emp_id);
		if($result == "Process completed successfully")
		{
			// SALARY PROCESS LOG Generate
			$this->log_model->log_salary_process($year, $month);
			echo $result;
		}
		else
		{
			echo $result;		
		}

	}





	// ////////////////======= old ===========//////////////
	// old code
	function salary_process_formssssss()
	{

		if($this->session->userdata('logged_in')==FALSE)
		$this->load->view('login_message');
		else
		//$this->load->view('form/salary_process');
		$crud = new grocery_CRUD();
		$get_session_user_unit = $this->common_model->get_session_unit_id_name();
		if($get_session_user_unit != 0)
		{
			$crud->where('pr_salary_block.unit_id',$get_session_user_unit);
		}
		$crud->set_table('pr_salary_block');
		$crud->set_subject('Salary Block');
		$crud->display_as('block_month','Final Month');
		$crud->order_by('block_month','desc');
		if($get_session_user_unit != 0)
		{
			$crud->set_relation( 'unit_id' , 'pr_units','unit_name',array('unit_id' => $get_session_user_unit) );
		}
		else
		{
			$crud->set_relation( 'unit_id' , 'pr_units','unit_name' );
		}
		//$crud->required_fields( 'block_month','status');
		//$crud->callback_before_insert(array($this,'user_actual_date_callback'));
		//$crud->callback_before_update(array($this,'user_actual_date_callback'));
		//$crud->set_rules('block_month','Block Month','required|callback_block_month_check');
		//$crud->set_rules('block_month','Block Month','required|callback_block_month_check');
		//$crud->change_field_type('username','hidden');
		//$crud->change_field_type('date_time','hidden');
		$crud->unset_columns('status');
		$crud->unset_delete();
		$crud->unset_add();
		$crud->unset_edit();
		$output = $crud->render();
		$this->load->view('form/salary_process',$output);

	}
	
	////////////////////////Festival Bonus///////////
	function festival_bonus_form()
	{

		if($this->session->userdata('logged_in')==FALSE)
		$this->load->view('login_message');
		else
		$crud = new grocery_CRUD();
		$get_session_user_unit = $this->common_model->get_session_unit_id_name();
		if($get_session_user_unit != 0)
		{
			$crud->where('pr_salary_festival_block.unit_id',$get_session_user_unit);
		}
		$crud->set_table('pr_salary_festival_block');
		$crud->set_subject('Salary Block');
		$crud->display_as('block_month','Final Month');
		if($get_session_user_unit != 0)
		{
			$crud->set_relation( 'unit_id' , 'pr_units','unit_name',array('unit_id' => $get_session_user_unit) );
		}
		else
		{
			$crud->set_relation( 'unit_id' , 'pr_units','unit_name' );
		}
		$crud->order_by('block_month','desc');
		$crud->unset_columns('status');
		$crud->unset_delete();
		$crud->unset_add();
		$crud->unset_edit();
		$output = $crud->render();
		$this->load->view('form/festival_process',$output);

	}
	
	//////////////Festival Process////////////
	function festival_process()
	{
		$month = $this->input->post('month');
		$year = $this->input->post('year');
		$process_check = $this->input->post('process_check');
		
		////////Month Check ///////////
		$this->db->select('');
		$this->db->like('effective_date', $month);
		$query = $this->db->get('pr_bonus_rules');
		//echo $this->db->last_query();
		if($query->num_rows()==0)
		{
			echo "Sorry! This Month is not setup in Festival.";
		}
		else{
	
			$result = $this->festival_bonus_model->festival_bonus_process($year, $month, $process_check);
			if($result == "Process completed successfully")
			{
				// SALARY PROCESS LOG Generate
				$this->log_model->log_salary_process($year, $month);
				echo $result;
			}
			else
			{
				echo $result;		
			}
		
		}	
		
	}
	
	function test()
	{
		/*$service_month = 1;
		$gross_sal = 10000;
		$basic_sal = 7000;
		for($i=0; $i<=25; $i++){
		 $result = $this->salary_process_model->get_festival_bonus_rule($i);
		 echo "$i -> ";
		 print_r($result);
		 echo "== BONUS : ".$bonus = $this->salary_process_model->get_festival_bonus($result,$gross_sal,$basic_sal);
		 echo '<br>';
		 }*/
		 $doj = '2012-10-08';
		 $dates = $this->salary_process_model->get_join_month_dates($doj);
		 print_r($dates);
	}
	
}

