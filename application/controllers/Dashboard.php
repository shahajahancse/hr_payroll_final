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
		
		
    // 12/09/21 shahajahan

	$report_date = date("Y-m-d");
	$this->data['values'] = $this->Mars_model->dashboard_summary($report_date,$this->session->userdata('data')->unit_name);


    $all_emp = $values["all_emp"];
    $all_present = $values["all_present"];
    $all_absent = $values["all_absent"];
    $all_male = $values["all_male"];
    $all_female = $values["all_female"];
    $all_late = $values["all_late"];
    $all_leave = $values["all_leave"];

    $monthly_join_id = $values["monthly_join_id"];
    $monthly_resign_id = $values["monthly_resign_id"];
    $monthly_left_id = $values["monthly_left_id"];
    $salary = $values["salary"];
    $ot = $values["ot"];
    $att_bonus = $values["att_bonus"];
    $day_1 = $values["day_1"];
    $day_2 = $values["day_2"];
    $day_3 = $values["day_3"];
    $day_4 = $values["day_4"];
    $day_5 = $values["day_5"];
    $day_6 = $values["day_6"];
    $day_7 = $values["day_7"];
    $all_present_2 = $values["all_present_2"];
    $all_present_3 = $values["all_present_3"];
    $all_present_4 = $values["all_present_4"];
    $all_present_5 = $values["all_present_5"];
    $all_present_6 = $values["all_present_6"];
    $all_present_7 = $values["all_present_7"];

    $all_absent_2 = $values["all_absent_2"];
    $all_absent_3 = $values["all_absent_3"];
    $all_absent_4 = $values["all_absent_4"];
    $all_absent_5 = $values["all_absent_5"];
    $all_absent_6 = $values["all_absent_6"];
    $all_absent_7 = $values["all_absent_7"];
	}
}
