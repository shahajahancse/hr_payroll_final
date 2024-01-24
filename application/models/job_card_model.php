<?php
class Job_card_model extends CI_Model{

	function __construct()
	{
		parent::__construct();
		$this->load->model('common_model');
	}

	// start 9pm eot job card
	function leave_per_emp($sStartDate, $sEndDate, $emp_id)
	{
		$this->db->select("start_date");
		$this->db->where("start_date BETWEEN '$sStartDate' AND '$sEndDate'");
		$this->db->where("emp_id = '$emp_id'");
		$query = $this->db->get("pr_leave_trans");
		$leave = array();
		foreach ($query->result() as $row)
		{
			$leave[] = $row->start_date;
		}
		return $leave;
	}

	function check_weekend($sStartDate, $sEndDate, $emp_id)
	{
		$this->db->select("work_off_date");
		$this->db->where("work_off_date BETWEEN '$sStartDate' AND '$sEndDate'");
		$this->db->where("emp_id = '$emp_id'");
		$query = $this->db->get("attn_work_off");
		$weekend = array();
		foreach ($query->result() as $row)
		{
			$weekend[] = $row->work_off_date;
		}
		return $weekend;
	}

	function holiday_calculation($sStartDate, $sEndDate)
	{
		$this->db->select("holiday_date as start_date");
		$this->db->where("holiday_date BETWEEN '$sStartDate' AND '$sEndDate'");
		$query = $this->db->get("attn_holiday");
		$holiday = array();
		foreach ($query->result() as $row)
		{
			$holiday[] = $row->start_date;
		}
		return $holiday;
	}

	function emp_shift_check($emp_id, $att_date)
	{
		$this->db->select("shift_id, shift_duty");
		$this->db->from("pr_emp_shift_log");
		$this->db->where("emp_id", $emp_id);
		$this->db->where("shift_log_date", $att_date);
		$query = $this->db->get();

		if($query->num_rows() > 0 )
		{
			$shift_duty = $query->row()->shift_duty;

			$this->db->select("sh_type");
			$this->db->from("pr_emp_shift_schedule");
			$this->db->where("shift_id", $shift_duty);
			$query1 = $this->db->get();
			$row = $query1->row();
			return $row->sh_type;
		}
		else
		{
			$this->db->select("pr_emp_shift_schedule.sh_type");
			$this->db->from("pr_emp_shift_schedule");
			$this->db->from("pr_emp_shift");
			$this->db->from("pr_emp_com_info");
			$this->db->where("pr_emp_com_info.emp_id", $emp_id);
			$this->db->where("pr_emp_shift.shift_id = pr_emp_com_info.emp_shift");
			$this->db->where("pr_emp_shift.shift_duty = pr_emp_shift_schedule.shift_id");
			$query = $this->db->get();
			$row = $query->row();
			return $row->sh_type;
		}
	}

	function schedule_check($emp_shift)
	{
		$this->db->where("sh_type", $emp_shift);
		$query = $this->db->get("pr_emp_shift_schedule");
		return $query->result_array();
	}

   function get_leave_type($shift_log_date,$emp_id)
   {
   		$this->db->select('leave_type');
		$this->db->where('emp_id', $emp_id);
		$this->db->where("start_date <=", $shift_log_date);
		$this->db->where("start_date >=", $shift_log_date);
		$query = $this->db->get('pr_leave_trans');
		$row = $query->row();
		$leave_type = $row->leave_type;
		return $leave_type;
   }

	function get_join_date($emp_id, $sStartDate, $sEndDate)
	{
		$this->db->select('emp_join_date');
		$this->db->where("emp_join_date BETWEEN '$sStartDate' AND '$sEndDate'");
		$this->db->where("emp_id = '$emp_id'");
		$query = $this->db->get("pr_emp_com_info");
		if($query->num_rows() > 0)
		{
			$row = $query->row();
			return $emp_join_date = $row->emp_join_date;
		}
		else
		{
			return false;
		}
	}

	function get_resign_date($emp_id, $sStartDate, $sEndDate)
	{
		$this->db->select('resign_date');
		$this->db->where("resign_date BETWEEN '$sStartDate' AND '$sEndDate'");
		$this->db->where("emp_id = '$emp_id'");
		$query = $this->db->get("pr_emp_resign_history");
		if($query->num_rows() > 0)
		{
			$row = $query->row();
			return $resign_date = $row->resign_date;
		}
		else
		{
			return false;
		}
	}

	function get_left_date($emp_id, $sStartDate, $sEndDate)
	{
		$this->db->select('left_date');
		$this->db->where("left_date BETWEEN '$sStartDate' AND '$sEndDate'");
		$this->db->where("emp_id = '$emp_id'");
		$query = $this->db->get("pr_emp_left_history");
		if($query->num_rows() > 0)
		{
			$row = $query->row();
			return $resign_date = $row->left_date;
		}
		else
		{
			return false;
		}
	}

	function get_formated_out_time_5pm($emp_id, $out_time, $emp_shift)
	{
		if($out_time =='00:00:00')
		{
			return $out_time ='';
		}
		$schedule 				= $this->schedule_check($emp_shift);
		$out_start				= $schedule[0]["out_start"];
		$ot_start				= $schedule[0]["ot_start"];
		$ot_minute				= $schedule[0]["ot_minute_to_one_hour"];
		// $one_hour_ot_out_time	= $schedule[0]["one_hour_ot_out_time"];
		// $two_hour_ot_out_time	= $schedule[0]["two_hour_ot_out_time"];
		$one_hour_ot_out_time	= '18:00:00';
		$two_hour_ot_out_time	= '19:00:00';
		$three_hour_ot_out_time	= '20:00:00';
		$four_hour_ot_out_time	= '21:00:00';
		$five_hour_ot_out_time	= '22:00:00';


		if($out_start < $out_time) 
		{ 
			// one hour ot cal and get buyer time
			if ($out_time >= $ot_start AND $out_time <= $one_hour_ot_out_time) {
				if ($out_time >= '17:50:00') {
					return $out_time = $this->time_format_ten_plus($out_time);
				} else {
					return $out_time = $this->time_am_pm_format_new($out_time);
				}
			}

			// two hour ot cal and get buyer time
			if ($out_time >= $ot_start AND $out_time <= $two_hour_ot_out_time) {
				if ($out_time >= '18:50:00') {
					return $out_time = $this->time_format_ten_plus($out_time);
				} else {
					return $out_time = $this->time_am_pm_format_new($out_time);
				}
			}

			// three hour ot cal and get buyer time
			if ($out_time >= $ot_start AND $out_time <= $three_hour_ot_out_time) {
				if ($out_time >= '19:50:00') {
					return $out_time = $this->time_format_ten_plus($out_time);
				} else {
					// exit($out_time);
					return $out_time = $this->time_am_pm_format_new($out_time);
				}
			}

			// four hour ot cal and get buyer time
			if ($out_time >= $ot_start AND $out_time <= $four_hour_ot_out_time) {
				if ($out_time >= '20:50:00') {
					return $out_time = $this->time_format_ten_plus($out_time);
				} else {
					return $out_time = $this->time_am_pm_format_new($out_time);
				}
			}

			if ($out_time >= $ot_start AND $out_time > $four_hour_ot_out_time) {
				return  $out_time = $this->time_am_pm_format_new($four_hour_ot_out_time ,$out_time);
			} else {
				return $out_time = $this->time_am_pm_format($out_time);
			}
		} 
		else
		{ 
			return $out_time = $this->get_buyer_in_time($four_hour_ot_out_time ,$out_time); 
		} 
	}

	function time_am_pm_format($out_time){
		return date("h:i:s A", strtotime($out_time));
	}

	function time_format_ten_plus($out_time){
		$time = strtotime($out_time);
		return date("h:i:s A", strtotime('+11 minutes', $time));	
	}

	function get_buyer_in_time($exact_time_15min_back ,$in_time)
	{
		//echo $in_time;
		$exact_hour_min_sec = $this->get_hour_min_sec($exact_time_15min_back);
		$exact_hour   		= $exact_hour_min_sec['hour'];
		$exact_minute 		= $exact_hour_min_sec['minute'];

		$real_hour_min_sec 	= $this->get_hour_min_sec($in_time);
		$real_minute  		= $real_hour_min_sec['minute'];
		$real_second 		= $real_hour_min_sec['second'];

		$buyer_minute = $this->create_buyer_minute($real_minute);
		$buyer_minute = $buyer_minute + $exact_minute;

		return $time_format = date("h:i:s A", mktime($exact_hour, $buyer_minute, $real_second, 0, 0, 0));

	}

	function time_am_pm_format_new($out_time){
		$real_hour_min_sec 	= $this->get_hour_min_sec($out_time);
		$hour  				= $real_hour_min_sec['hour'];
		$minute  			= $real_hour_min_sec['minute'];
		$second 			= $real_hour_min_sec['second'];
		
		$buyer_minute = $this->create_buyer_minute($minute);		
		return date("h:i:s A", mktime($hour, $buyer_minute, $second, 0, 0, 0));
	}

	function get_hour_min_sec($time)
	{
		$data = array();
		$data['hour']   = substr($time,0,2);
		$data['minute'] = substr($time,3,2);
		$data['second'] = substr($time,6,2);
		return $data;
	}

	function create_buyer_minute($minute)
	{
		$min_1st_digit = substr($minute,0,1);
		$min_2nd_digit = substr($minute,1,1);
		$buyer_minute  = $min_1st_digit + $min_2nd_digit;
		$rand_min = rand(1,2);
		$buyer_minute = $rand_min;
		return $buyer_minute;
	}

	function emp_job_card($grid_firstdate, $grid_seconddate, $emp_id)
	{
		$data = array();
		$grid_firstdate = date("Y-m-d", strtotime($grid_firstdate)); 
		$grid_seconddate = date("Y-m-d", strtotime($grid_seconddate));

		$joining_check = $this->get_join_date($emp_id, $grid_firstdate, $grid_seconddate);
		if( $joining_check != false)
		{
			$start_date = $joining_check;
		}
		else
		{
			$start_date = $grid_firstdate;
		}
			
		$resign_check  = $this->get_resign_date($emp_id, $grid_firstdate, $grid_seconddate);
		if($resign_check != false)
		{
			$end_date = $resign_check;
		}
		else
		{
			$end_date = $grid_seconddate;
		}
			
		$left_check  = $this->get_left_date($emp_id, $grid_firstdate, $grid_seconddate);
		if($left_check != false)
		{
			$end_date = $left_check;
		}
		else
		{
			$end_date = $grid_seconddate;
		}
			

		$data['leave'] = $this->leave_per_emp($start_date, $end_date, $emp_id);
			
		$data['weekend'] = $this->check_weekend($start_date, $end_date, $emp_id);

		$data['holiday'] = $this->holiday_calculation($start_date, $end_date, $emp_id);
		
			
		$this->db->select('pr_emp_shift_log.in_time , pr_emp_shift_log.out_time, pr_emp_shift_log.shift_log_date, pr_emp_shift_log.ot_hour, pr_emp_shift_log.extra_ot_hour, pr_emp_shift_log.late_status,pr_emp_shift_log.deduction_hour');
		$this->db->from('pr_emp_shift_log');
		$this->db->where('pr_emp_shift_log.emp_id', $emp_id);
		$this->db->where("pr_emp_shift_log.shift_log_date >=", $start_date);
		$this->db->where("pr_emp_shift_log.shift_log_date <=", $end_date);
		$this->db->order_by("pr_emp_shift_log.shift_log_date");				
		$query = $this->db->get()->result();

		$data['emp_data'] = $query;

		return $data;
	}
	// end 9pm eot job card
	// 
	// start actual job card
	public function actual_job_card($grid_firstdate, $grid_seconddate, $emp_id)
	{
		$data = array();
		$grid_firstdate = date("Y-m-d", strtotime($grid_firstdate)); 
		$grid_seconddate = date("Y-m-d", strtotime($grid_seconddate));

		$joining_check = $this->get_join_date($emp_id, $grid_firstdate, $grid_seconddate);
		if( $joining_check != false)
		{
			$start_date = $joining_check;
		}
		else
		{
			$start_date = $grid_firstdate;
		}
			
		$resign_check  = $this->get_resign_date($emp_id, $grid_firstdate, $grid_seconddate);
		if($resign_check != false)
		{
			$end_date = $resign_check;
		}
		else
		{
			$end_date = $grid_seconddate;
		}
			
		$left_check  = $this->get_left_date($emp_id, $grid_firstdate, $grid_seconddate);
		if($left_check != false)
		{
			$end_date = $left_check;
		}
		else
		{
			$end_date = $grid_seconddate;
		}

		$this->db->select();
		$this->db->where("emp_id",$emp_id);
		$this->db->where("shift_log_date BETWEEN '$start_date' AND '$end_date' ");
		$this->db->order_by("shift_log_date");
		$query = $this->db->get("pr_emp_shift_log")->result();

		$data['emp_data'] = $query;

		return $data;
	}
	// end actual job card

}