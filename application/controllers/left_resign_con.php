<?php
class Left_resign_con extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('left_resign_model');
		$this->load->model('common_model');
		
	}
	//------------------------------------------------
	// Resign / Left View
	//------------------------------------------------
	function left_resign_entry()
	{
		$this->load->view('form/left_resign_view');

	}
	function search_empid_for_resign_left()
	{
		$query = $this->left_resign_model->search_empid_for_resign_left();
		$return_arr = array();
		$row_array = array();
		foreach($query->result() as $row)
		{
		$row_array['left_resign_emp_id'] = $row->emp_id;
		$row_array['value'] = $row->emp_id;	
 
		array_push($return_arr,$row_array);
		}
	
		echo json_encode($return_arr);
	}
	
	function get_left_resign_info()
	{
		$result = $this->left_resign_model->get_left_resign_info();
		echo $result;
	}
	
	function get_left_resign_employee_basic_info()
	{
		$data['emp_id'] = $this->uri->segment(3);
		$this->load->view('form/left_resign_employee_basic_info',$data);
	}
	
	function left_resign_and_regular_action()
	{
		$result = $this->left_resign_model->left_resign_and_regular_action();
		echo $result;
	}
	
	
	
}

