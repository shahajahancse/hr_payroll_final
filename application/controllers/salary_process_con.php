<?php
class Salary_process_con extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
		/* Standard Libraries */
		$this->load->library('grocery_CRUD');
		$this->load->model('salary_process_model');
		$this->load->model('festival_bonus_model');
		$this->load->model('log_model');
		set_time_limit(0);
		ini_set("memory_limit","512M");
		$this->load->model('acl_model');
		$access_level = 7;
		$acl = $this->acl_model->acl_check($access_level);
	}
	
	function salary_process_form()
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
	
	function salary_process()
	{
		$grid_emp_id = $this->input->post('spl');
		$month = $this->input->post('month');
		$year = $this->input->post('year');
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

