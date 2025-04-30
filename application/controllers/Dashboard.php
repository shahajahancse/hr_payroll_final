<?php
class Dashboard extends CI_Controller {

	function __construct(){
		parent::__construct();

		set_time_limit(0);
		ini_set("memory_limit","512M");

		if($this->session->userdata('logged_in')==FALSE)
		{
			redirect("authentication");
		}
		$this->load->model('Mars_model');

		$this->data['user_data'] = $this->session->userdata('data');
	}

	function get_dashboard_data(){

	$return_data=array();
	$report_date = date("Y-m-d");
	$return_data = $this->Mars_model->dashboard_summary($report_date,$this->session->userdata('data')->unit_name);
	echo json_encode($return_data);
	}
}
