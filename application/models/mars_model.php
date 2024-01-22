<?php
class Mars_model extends CI_Model{


	function __construct()
	{
		parent::__construct();
		$this->load->model('common_model');

		/* Standard Libraries */
	}

	// 29/10/23  shahajahan
	function dashboard_summary($report_date, $unit_id)
	{

		$data = array();
		if (empty($unit_id)) {
			$unit_id = 1;
		}
		$all_id = get_all_emp_id(array(1,2), $unit_id);
	 	$data = $this->weekly_attendance_summary($report_date,$all_id);

	 	$data['monthly_join_id'] = $this->monthly_join_emp($report_date);
		$data['monthly_resign_id'] = $this->monthly_resign_emp($report_date);
		$data['monthly_left_id'] = $this->monthly_left_emp($report_date);

		$lm_expense = $this->last_month_expenses($report_date);
		$data['salary'] = $lm_expense->net_pay;
		$data['ot'] 	= $lm_expense->ot_amount + $lm_expense->eot_amount;
		$data['att_bonus'] = $lm_expense->att_bonus;

		$attendance_summary = $this->attendance_summary($report_date, $all_id);

		$data['all_emp'] = $attendance_summary['all_emp'];
		$data['all_present'] = $attendance_summary['all_present'];
		$data['all_absent'] = $attendance_summary['all_absent'];
		$data['all_male'] = $attendance_summary['all_male'];
		$data['all_female'] = $attendance_summary['all_female'];
		$data['all_late'] = $attendance_summary['all_late'];
		$data['all_leave'] = $attendance_summary['all_leave']; 

		return $data;
	}

	function weekly_attendance_summary($report_date = null, $all_emp_id = null)
	{
		$data = array();
		$date_1 = date('Y-m-d',strtotime($report_date));
		$day_1 = date('D', strtotime($date_1));
		$data['day_1'] = $day_1;

		$date_2 = date('Y-m-d',strtotime('-1 day',strtotime($report_date)));
		$day_2 = date('D', strtotime($date_2));
		$data['day_2'] = $day_2;

		$date_3 = date('Y-m-d',strtotime('-2 day',strtotime($report_date)));
		$day_3 = date('D', strtotime($date_3));
		$data['day_3'] = $day_3;

		$date_4 = date('Y-m-d',strtotime('-3 day',strtotime($report_date)));
		$day_4 = date('D', strtotime($date_4));
		$data['day_4'] = $day_4;

		$date_5 = date('Y-m-d',strtotime('-4 day',strtotime($report_date)));
		$day_5 = date('D', strtotime($date_5));
		$data['day_5'] = $day_5;

		$date_6 = date('Y-m-d',strtotime('-5 day',strtotime($report_date)));
		$day_6 = date('D', strtotime($date_6));
		$data['day_6'] = $day_6;

		$date_7 = date('Y-m-d',strtotime('-6 day',strtotime($report_date)));
		$day_7 = date('D', strtotime($date_7));
		$data['day_7'] = $day_7;


		$this->db->distinct();
		$this->db->select("
				SUM(CASE WHEN present_status = 'P' THEN 1 ELSE 0 END ) AS present,
				SUM(CASE WHEN present_status = 'A' THEN 1 ELSE 0 END ) AS absent,
				SUM(CASE WHEN present_status = 'L' THEN 1 ELSE 0 END ) AS leaves,
				SUM(CASE WHEN present_status = 'W' THEN 1 ELSE 0 END ) AS offday,
				SUM(CASE WHEN present_status = 'H' THEN 1 ELSE 0 END ) AS holiday,
			");
		$this->db->from("pr_emp_shift_log");
		$this->db->where_in("pr_emp_shift_log.emp_id", $all_emp_id);
		$this->db->where("pr_emp_shift_log.shift_log_date", $date_2);
		$data_2 = $this->db->get()->row();
		$data['all_present_2'] = $data_2->present;
		$data['all_absent_2'] = $data_2->absent;
		$data['all_leave_2'] = $data_2->leaves;
		$data['all_offday_2'] = $data_2->offday;
		$data['all_holiday_2'] = $data_2->holiday;


		$this->db->distinct();
		$this->db->select("
				SUM(CASE WHEN present_status = 'P' THEN 1 ELSE 0 END ) AS present,
				SUM(CASE WHEN present_status = 'A' THEN 1 ELSE 0 END ) AS absent,
				SUM(CASE WHEN present_status = 'L' THEN 1 ELSE 0 END ) AS leaves,
				SUM(CASE WHEN present_status = 'W' THEN 1 ELSE 0 END ) AS offday,
				SUM(CASE WHEN present_status = 'H' THEN 1 ELSE 0 END ) AS holiday,
			");
		$this->db->from("pr_emp_shift_log");
		$this->db->where_in("pr_emp_shift_log.emp_id", $all_emp_id);
		$this->db->where("pr_emp_shift_log.shift_log_date", $date_3);
		$data_3 = $this->db->get()->row();
		$data['all_present_3'] = $data_3->present;
		$data['all_absent_3'] = $data_3->absent;
		$data['all_leave_3'] = $data_3->leaves;
		$data['all_offday_3'] = $data_3->offday;
		$data['all_holiday_3'] = $data_3->holiday;


		$this->db->distinct();
		$this->db->select("
				SUM(CASE WHEN present_status = 'P' THEN 1 ELSE 0 END ) AS present,
				SUM(CASE WHEN present_status = 'A' THEN 1 ELSE 0 END ) AS absent,
				SUM(CASE WHEN present_status = 'L' THEN 1 ELSE 0 END ) AS leaves,
				SUM(CASE WHEN present_status = 'W' THEN 1 ELSE 0 END ) AS offday,
				SUM(CASE WHEN present_status = 'H' THEN 1 ELSE 0 END ) AS holiday,
			");
		$this->db->from("pr_emp_shift_log");
		$this->db->where_in("pr_emp_shift_log.emp_id", $all_emp_id);
		$this->db->where("pr_emp_shift_log.shift_log_date", $date_4);
		$data_4 = $this->db->get()->row();
		$data['all_present_4'] = $data_4->present;
		$data['all_absent_4'] = $data_4->absent;
		$data['all_leave_4'] = $data_4->leaves;
		$data['all_offday_4'] = $data_4->offday;
		$data['all_holiday_4'] = $data_4->holiday;


		$this->db->distinct();
		$this->db->select("
				SUM(CASE WHEN present_status = 'P' THEN 1 ELSE 0 END ) AS present,
				SUM(CASE WHEN present_status = 'A' THEN 1 ELSE 0 END ) AS absent,
				SUM(CASE WHEN present_status = 'L' THEN 1 ELSE 0 END ) AS leaves,
				SUM(CASE WHEN present_status = 'W' THEN 1 ELSE 0 END ) AS offday,
				SUM(CASE WHEN present_status = 'H' THEN 1 ELSE 0 END ) AS holiday,
			");
		$this->db->from("pr_emp_shift_log");
		$this->db->where_in("pr_emp_shift_log.emp_id", $all_emp_id);
		$this->db->where("pr_emp_shift_log.shift_log_date", $date_5);
		$data_5 = $this->db->get()->row();
		$data['all_present_5'] = $data_5->present;
		$data['all_absent_5'] = $data_5->absent;
		$data['all_leave_5'] = $data_5->leaves;
		$data['all_offday_5'] = $data_5->offday;
		$data['all_holiday_5'] = $data_5->holiday;


		$this->db->distinct();
		$this->db->select("
				SUM(CASE WHEN present_status = 'P' THEN 1 ELSE 0 END ) AS present,
				SUM(CASE WHEN present_status = 'A' THEN 1 ELSE 0 END ) AS absent,
				SUM(CASE WHEN present_status = 'L' THEN 1 ELSE 0 END ) AS leaves,
				SUM(CASE WHEN present_status = 'W' THEN 1 ELSE 0 END ) AS offday,
				SUM(CASE WHEN present_status = 'H' THEN 1 ELSE 0 END ) AS holiday,
			");
		$this->db->from("pr_emp_shift_log");
		$this->db->where_in("pr_emp_shift_log.emp_id", $all_emp_id);
		$this->db->where("pr_emp_shift_log.shift_log_date", $date_6);
		$data_6 = $this->db->get()->row();
		$data['all_present_6'] = $data_6->present;
		$data['all_absent_6'] = $data_6->absent;
		$data['all_leave_6'] = $data_6->leaves;
		$data['all_offday_6'] = $data_6->offday;
		$data['all_holiday_6'] = $data_6->holiday;


		$this->db->distinct();
		$this->db->select("
				SUM(CASE WHEN present_status = 'P' THEN 1 ELSE 0 END ) AS present,
				SUM(CASE WHEN present_status = 'A' THEN 1 ELSE 0 END ) AS absent,
				SUM(CASE WHEN present_status = 'L' THEN 1 ELSE 0 END ) AS leaves,
				SUM(CASE WHEN present_status = 'W' THEN 1 ELSE 0 END ) AS offday,
				SUM(CASE WHEN present_status = 'H' THEN 1 ELSE 0 END ) AS holiday,
			");
		$this->db->from("pr_emp_shift_log");
		$this->db->where_in("pr_emp_shift_log.emp_id", $all_emp_id);
		$this->db->where("pr_emp_shift_log.shift_log_date", $date_7);
		$data_7 = $this->db->get()->row();
		$data['all_present_7'] = $data_7->present;
		$data['all_absent_7'] = $data_7->absent;
		$data['all_leave_7'] = $data_7->leaves;
		$data['all_offday_7'] = $data_7->offday;
		$data['all_holiday_7'] = $data_7->holiday;

	    return $data;
	}

	function last_month_expenses($salary_month)
	{
		$last_salary_month = date('Y-m-d',strtotime('-1 month',strtotime($salary_month)));
		$this->db->select("
				SUM(net_pay) AS net_pay,
				SUM(ot_amount) AS ot_amount,
				SUM(eot_amount) AS eot_amount,
				SUM(att_bonus) AS att_bonus,
			");
		$this->db->from("pay_salary_sheet");
		$this->db->like("salary_month", $last_salary_month);
		return $this->db->get()->row();
	}

	function attendance_summary($report_date, $all_emp_id)
	{

		$data =array();

		$this->db->select('pr_emp_com_info.emp_id');
		$this->db->from("pr_emp_shift_log");
		$this->db->from("pr_emp_com_info");

		$this->db->where("pr_emp_com_info.emp_id = pr_emp_shift_log.emp_id");
		$this->db->where("pr_emp_shift_log.shift_log_date", $report_date);
		$this->db->where_in("pr_emp_com_info.emp_id", $all_emp_id);
		$this->db->where_not_in('pr_emp_shift_log.present_status', array('H','W'));
		$this->db->group_by('pr_emp_com_info.emp_id');
		$query = $this->db->get();


		if($query->num_rows() == 0)
		{
			$data['all_emp'] 		= 0;
			$data['all_present'] 	= 0;
			$data['all_leave'] 		= 0;
			$data['all_absent'] 	= 0;
			$data['all_late'] 		= 0;
			$data['all_male'] 		= 0;
			$data['all_female'] 	= 0;
		}
		else
		{
			$data['all_emp'] = $query->num_rows();
			$all_emp_id = $query->result_array();
			$it =  new RecursiveIteratorIterator(new RecursiveArrayIterator($all_emp_id));
			$all_emp_id = iterator_to_array($it, false);

			$this->db->distinct();
			$this->db->select("
					SUM(CASE WHEN present_status = 'P' THEN 1 ELSE 0 END ) AS present,
					SUM(CASE WHEN present_status = 'A' THEN 1 ELSE 0 END ) AS absent,
					SUM(CASE WHEN present_status = 'L' THEN 1 ELSE 0 END ) AS leaves,
					SUM(CASE WHEN present_status = 'W' THEN 1 ELSE 0 END ) AS offday,
					SUM(CASE WHEN present_status = 'H' THEN 1 ELSE 0 END ) AS holiday,
					SUM(CASE WHEN late_status    = '1' THEN 1 ELSE 0 END ) AS late_status,
				");
			$this->db->from("pr_emp_shift_log");
			$this->db->where_in("pr_emp_shift_log.emp_id", $all_emp_id);
			$this->db->where("pr_emp_shift_log.shift_log_date", $report_date);
			$atten_data = $this->db->get()->row();

			$data['all_present'] 	= $atten_data->present;
			$data['all_absent'] 	= $atten_data->absent;
			$data['all_leave'] 		= $atten_data->leaves;
			$data['all_late'] 		= $atten_data->late_status;


			$this->db->select("pr_emp_per_info.emp_id");
			$this->db->from('pr_emp_per_info');
			$this->db->where_in("pr_emp_per_info.emp_id", $all_emp_id);
			$this->db->where("pr_emp_per_info.gender", 'Male');
			$data['all_male'] = $this->db->get()->num_rows();
			$data['all_female'] = $data['all_emp'] - $data['all_male'];
		}
		return $data;
	}











	// old code


	function all_emp_id($unit_id = null)
	{
		//araf
		$data = array();
		$emp_cat = array(1,2);
		$this->db->select('emp_id');
		$this->db->from('pr_emp_com_info');
		$this->db->where_in('pr_emp_com_info.emp_cat_id',$emp_cat);
		if ($unit_id != null) {
			$this->db->where('pr_emp_com_info.unit_id',$unit_id);
		}
		$query = $this->db->get()->result_array();

		array_walk($query, function($entry) use (&$data) {
		    $data[] = $entry["emp_id"];
		});
		return $data;
	}

	function department_attendance_summary($report_date, $unit_id)
	{
		//echo $report_date;exit;
		$data = array();
		$query = $this->db->select()->where('unit_id', $unit_id)->order_by('dept_name')->get('emp_depertment');
		$monthly_join_id = $this->monthly_join_emp($report_date);
		$monthly_resign_id = $this->monthly_resign_emp($report_date);
		$monthly_left_id = $this->monthly_left_emp($report_date);
		$last_month_expensive = $this->last_month_expense($report_date);
		$salary = $last_month_expensive['net_pay'];
		$ot_amount = $last_month_expensive['ot_amount'];
		$eot_amount = $last_month_expensive['eot_amount'];
		$att_bonus = $last_month_expensive['att_bonus'];

		$data['monthly_join_id'] = $monthly_join_id;
		$data['monthly_resign_id'] = $monthly_resign_id;
		$data['monthly_left_id'] = $monthly_left_id;

		$data['salary'] = $salary;
		$data['ot'] 	= $ot_amount + $eot_amount;
		$data['att_bonus'] = $att_bonus;
		$all_id = $this->all_emp_id();
		$weekly_status = $this->weekly_attendance_summary($report_date,$all_id);
		$data['day_1'] = $weekly_status['day_1'];
		$data['day_2'] = $weekly_status['day_2'];
		$data['day_3'] = $weekly_status['day_3'];
		$data['day_4'] = $weekly_status['day_4'];
		$data['day_5'] = $weekly_status['day_5'];
		$data['day_6'] = $weekly_status['day_6'];
		$data['day_7'] = $weekly_status['day_7'];

		$data['all_present_2'] = $weekly_status['all_present_2'];
		$data['all_present_3'] = $weekly_status['all_present_3'];
		$data['all_present_4'] = $weekly_status['all_present_4'];
		$data['all_present_5'] = $weekly_status['all_present_5'];
		$data['all_present_6'] = $weekly_status['all_present_6'];
		$data['all_present_7'] = $weekly_status['all_present_7'];

		$data['all_absent_2'] = $weekly_status['all_absent_2'];
		$data['all_absent_3'] = $weekly_status['all_absent_3'];
		$data['all_absent_4'] = $weekly_status['all_absent_4'];
		$data['all_absent_5'] = $weekly_status['all_absent_5'];
		$data['all_absent_6'] = $weekly_status['all_absent_6'];
		$data['all_absent_7'] = $weekly_status['all_absent_7'];


		/*echo "<pre>";
		print_r($data);exit;*/

		foreach($query->result() as $rows)
		{
			$data['cat_name'][] = $rows->dept_name;

			$all_emp_id = $this->get_department_emp_by_id($rows->dept_id, $unit_id);

			if(!empty($all_emp_id))
			{
				$data['daily_att_sum'][] = $this->daily_attendance_summary($report_date, $all_emp_id);
			}
			else
			{
				$data['daily_att_sum'][] = '';
			}

			$emp_desig =	$this->get_department_section_line_unit_wise($unit_id);
			//echo $emp_desig[0]."---";
			for($i=0; $i<12; $i++)
			{
				$all_desig_emp_id_by_dept = $this->desig_emp_id_by_dept($rows->dept_id,$emp_desig[$i]);
				//echo $count_all_desig_emp_id_by_dept = count($all_desig_emp_id_by_dept);
				//echo  $all_desig_emp_id_by_line."---";
				if(!empty($all_desig_emp_id_by_dept))
				{
					$data['remarks_daily_att_sum'][$i][] = $this->daily_attendance_summary($report_date, $all_desig_emp_id_by_dept);
				}
				else
				{
					$data['remarks_daily_att_sum'][$i][] = "null";
				}
				//echo $i;
			}
		}
		return $data;

	}

	function department_attendance_summary_other($report_date, $unit_id)
	{
		//echo $report_date;exit;
		$data = array();
		$query = $this->db->select()->where('unit_id', $unit_id)->order_by('dept_name')->get('emp_depertment');

		foreach($query->result() as $rows)
		{
			$data['cat_name'][] = $rows->dept_name;

			$all_emp_id = $this->get_department_emp_by_id($rows->dept_id, $unit_id);

			if(!empty($all_emp_id))
			{
				$data['daily_att_sum'][] = $this->daily_attendance_summary($report_date, $all_emp_id);
			}
			else
			{
				$data['daily_att_sum'][] = '';
			}

			$emp_desig =	$this->get_department_section_line_unit_wise($unit_id);
			//echo $emp_desig[0]."---";
			for($i=0; $i<12; $i++)
			{
				$all_desig_emp_id_by_dept = $this->desig_emp_id_by_dept($rows->dept_id,$emp_desig[$i]);
				//echo $count_all_desig_emp_id_by_dept = count($all_desig_emp_id_by_dept);
				//echo  $all_desig_emp_id_by_line."---";
				if(!empty($all_desig_emp_id_by_dept))
				{
					$data['remarks_daily_att_sum'][$i][] = $this->daily_attendance_summary($report_date, $all_desig_emp_id_by_dept);
				}
				else
				{
					$data['remarks_daily_att_sum'][$i][] = "null";
				}
				//echo $i;
			}
		}
		return $data;

	}

	function get_department_emp_by_id($dept_id, $unit_id)
	{
		//$emp_cat = array(1,2);
		$query = $this->db->select('emp_id')->where('unit_id', $unit_id)->where('emp_dept_id', $dept_id)->get('pr_emp_com_info');
		$data = array();
		foreach($query->result() as $rows)
		{
			$data[] = $rows->emp_id;
		}
		return $data;
	}

	function desig_emp_id_by_dept($dept_id,$emp_desig)
	{
		//$emp_cat = array(1,2);
		$query = $this->db->select('emp_id')->where('emp_dept_id',$dept_id)->where_in('emp_desi_id',$emp_desig)->get('pr_emp_com_info');
		$data = array();
		//echo $this->db->last_query();
		foreach($query->result() as $rows)
		{
			$data[] = $rows->emp_id;
			//echo $rows->emp_id."---";
		}
		return $data;
	}


	function section_attendance_summary($report_date, $unit_id){
		$query = $this->db->select()->where('unit_id', $unit_id)->order_by('sec_name')->get('pr_section');
		$data = array();
		foreach($query->result() as $rows){
			$data['cat_name'][] = $rows->sec_name;

			$all_emp_id = $this->get_section_emp_by_id($rows->sec_id, $unit_id);
			// print_r($all_emp_id);
			// exit;
			if(!empty($all_emp_id)){
				$data['daily_att_sum'][] = $this->daily_attendance_summary($report_date, $all_emp_id);
			}else{
				$data['daily_att_sum'][] = '';
			}

			/*
			$emp_desig = array(
								0 => array(21),
								1 => array(115),
								2 => array(78,79,112),
								3 => array(76),
								4 => array(102)
             					); */
			$emp_desig =	$this->get_department_section_line_unit_wise($unit_id);

			//echo $emp_desig[0]."---";
			for($i=0; $i<12; $i++){
				$all_desig_emp_id_by_section = $this->desig_emp_id_by_section($rows->sec_id,$emp_desig[$i]);
				//echo  $all_desig_emp_id_by_line."---";
				if(!empty($all_desig_emp_id_by_section)){
					$data['remarks_daily_att_sum'][$i][] = $this->daily_attendance_summary($report_date, $all_desig_emp_id_by_section);
				}else{
					$data['remarks_daily_att_sum'][$i][] = "null";
				}
				//echo $i;
			}
		}
		// print_r($data);exit;
		return $data;

	}

	function get_section_emp_by_id($sec_id, $unit_id)
	{
		//$emp_cat = array(1,2);
		$query = $this->db->select('emp_id')->where('unit_id', $unit_id)->where('emp_sec_id', $sec_id)->get('pr_emp_com_info');
		$data = array();
		foreach($query->result() as $rows)
		{
			$data[] = $rows->emp_id;
		}
		return $data;
	}

	function line_attendance_summary($report_date, $unit_id)
	{
		$arr=array('32','61');
		$query = $this->db->select()->where('unit_id', $unit_id)->where_not_in('line_id',$arr)->order_by('line_name')->get('pr_line_num');
		$data = array();
		foreach($query->result() as $rows)
		{
			$data['cat_name'][] = $rows->line_name;
			
			$all_emp_id = $this->get_line_emp_by_id($rows->line_id, $unit_id);
			
			if(!empty($all_emp_id))
			{
				$data['daily_att_sum'][] = $this->daily_attendance_summary($report_date, $all_emp_id);
			}
			else
			{
				$data['daily_att_sum'][] = '';
			}

			$emp_desig =	$this->get_department_section_line_unit_wise($unit_id);

			for($i=0; $i<6; $i++)
			{
				$all_desig_emp_id_by_line = $this->desig_emp_id_by_line($rows->line_id,$emp_desig[$i]);

				if(!empty($all_desig_emp_id_by_line))
				{
					$data['remarks_daily_att_sum'][$i][] = $this->daily_attendance_summary($report_date, $all_desig_emp_id_by_line);
				}
				else
				{
					$data['remarks_daily_att_sum'][$i][] = "null";
				}

			}
		}
		return $data;
		
	}

	function get_line_emp_by_id($line_id, $unit_id)
	{
		//$emp_cat = array(1,2);
		$query = $this->db->select('emp_id')->where('unit_id', $unit_id)->where('emp_line_id', $line_id)->get('pr_emp_com_info');
		$data = array();
		foreach($query->result() as $rows)
		{
			$data[] = $rows->emp_id;
		}
		return $data;
	}

	function daily_attendance_summary($report_date, $all_emp_id){
		$data =array();

		$this->db->select('pr_emp_shift_log.emp_id');
		$this->db->from("pr_emp_shift_log");
		$this->db->from("pr_emp_com_info");
		$this->db->where_in("pr_emp_shift_log.emp_id", $all_emp_id);
		$this->db->where("shift_log_date", $report_date);
		$this->db->where("pr_emp_shift_log.present_status !=", "W");
		$this->db->where("pr_emp_com_info.emp_cat_id !=", 4);
		$this->db->where("pr_emp_com_info.emp_cat_id !=", 3);
		$this->db->where("pr_emp_com_info.emp_cat_id !=", 2);
		$this->db->where("pr_emp_com_info.emp_id = pr_emp_shift_log.emp_id ");
		$this->db->group_by('pr_emp_shift_log.emp_id');
		$query = $this->db->get();

		// echo $this->db->last_query();exit;

		if($query->num_rows() == 0){
			$data['all_emp'] 		= 0;
			$data['all_present'] 	= 0;
			$data['all_leave'] 		= 0;
			$data['all_absent'] 	= 0;
			$data['all_late'] 		= 0;
			$data['all_male'] 		= 0;
			$data['all_female'] 	= 0;
		}else{
			$data['all_emp'] = $query->num_rows();
			$all_emp_id = $query->result_array();
			$it =  new RecursiveIteratorIterator(new RecursiveArrayIterator($all_emp_id));
			$all_emp_id = iterator_to_array($it, false);

			$this->db->select("pr_emp_shift_log.emp_id");
			$this->db->from("pr_emp_shift_log");
			$this->db->where_in("pr_emp_shift_log.emp_id", $all_emp_id);
			$this->db->where("pr_emp_shift_log.shift_log_date", $report_date);
			$this->db->where("pr_emp_shift_log.in_time !=", "00:00:00");
			$this->db->group_by('pr_emp_shift_log.emp_id');
			$data['all_present'] = $this->db->get()->num_rows();


			$this->db->select("pr_emp_shift_log.emp_id");
			$this->db->from("pr_emp_shift_log");
			$this->db->from("pr_emp_com_info");
			$this->db->where_in("pr_emp_shift_log.emp_id", $all_emp_id);
			$this->db->where("pr_emp_shift_log.shift_log_date", $report_date);
			$this->db->where("pr_emp_shift_log.in_time", "00:00:00");
			$this->db->where("pr_emp_com_info.emp_cat_id !=", 4);
		    $this->db->where("pr_emp_com_info.emp_id = pr_emp_shift_log.emp_id ");
			$this->db->group_by('pr_emp_shift_log.emp_id');
			$all_absent = $this->db->get()->num_rows();
			$all_absent = $all_absent - $data['all_leave'];
			$data['all_absent'] = $all_absent;


			$this->db->select("pr_emp_shift_log.emp_id");
			$this->db->from("pr_emp_shift_log");
			$this->db->where_in("pr_emp_shift_log.emp_id", $all_emp_id);
			$this->db->where("pr_emp_shift_log.shift_log_date", $report_date);
			$this->db->where("pr_emp_shift_log.late_status",1);
			$this->db->group_by('pr_emp_shift_log.emp_id');
			$data['all_late'] = $this->db->get()->num_rows();


			$this->db->select("emp_id");
			$this->db->from("pr_leave_trans");
			$this->db->where_in("emp_id", $all_emp_id);
			$this->db->where("start_date", $report_date);
			$this->db->group_by('emp_id');
			$data['all_leave'] = $this->db->get()->num_rows();


			$this->db->select("pr_emp_per_info.emp_id");
			$this->db->from('pr_emp_per_info');
			$this->db->where_in("pr_emp_per_info.emp_id", $all_emp_id);
			$this->db->where("pr_emp_per_info.emp_sex = 1");
			$data['all_male'] = $this->db->get()->num_rows();

			$this->db->select("pr_emp_per_info.emp_id");
			$this->db->from('pr_emp_per_info');
			$this->db->where_in("pr_emp_per_info.emp_id", $all_emp_id);
			$this->db->where("pr_emp_per_info.emp_sex = 2");
			$data['all_female'] = $this->db->get()->num_rows();
		}
		return $data;
	}

	function get_department_section_line_unit_wise($unit_id){
		$data = array();
		if($unit_id ==1){
			$data = array(
				0 => array(17,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39),//Office staff
				1 => array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,18,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,60,61,62,63,64,65,66,67,68,69),//PD staff
				2 => array(87,88,90,91,94,95,105),//operator
				3 => array(89),//Asst.operator
				4 => array(92),//Line Iron
				5 => array(99),//Finishing Assistant
				6 => array(''),//Jr. Iron Man
				7 => array(98),//Iron Man
				8 => array(102),//Poly Man
				9 => array(101),//Spot Man
				10 => array(100,103),//Folder,Jr. Folder
				11 => array(97,104),//Jr. Packer
				12 => array(106,107,108,109),//Quality Inspector
				13 => array(73,71,72,74),//Admin 4th Class
				14 => array(76,77,78,79,80,81,82,83,84,85,86),//Cutting
				15 => array(110),//Fusing
				16 => array(111,112),//Clener
				17 => array(75,79,85,93),//input Man
				18 => array(59)//Others
			);
			return $data;
		}
	}

	function desig_emp_id_by_line($line_id,$emp_desig)
	{
		//$emp_cat = array(1,2);
		$query = $this->db->select('emp_id')->where('emp_line_id',$line_id)->where_in('emp_desi_id',$emp_desig)->get('pr_emp_com_info');
		$data = array();
		foreach($query->result() as $rows)
		{
			$data[] = $rows->emp_id;
			//echo $rows->emp_id."---";
		}
		return $data;
	}

	


	function desig_emp_id_by_section($section_id,$emp_desig)
	{
		//$emp_cat = array(1,2);
		$query = $this->db->select('emp_id')->where('emp_sec_id',$section_id)->where_in('emp_desi_id',$emp_desig)->get('pr_emp_com_info');
		$data = array();
		foreach($query->result() as $rows)
		{
			$data[] = $rows->emp_id;
			//echo $rows->emp_id."---";
		}
		return $data;
	}


	function last_month_expense($salary_month)
	{
		$this->db->select_sum($column_name);
		$column_name = "net_pay" ;
		$net_pay = $this->get_sum_column($column_name,$salary_month);
		$all_data["net_pay"] = $net_pay;

		$column_name = "eot_amount" ;
		$eot_amount = $this->get_sum_column($column_name,$salary_month);
		$all_data["eot_amount"] = $eot_amount;

		$column_name = "ot_amount" ;
		$ot_amount = $this->get_sum_column($column_name,$salary_month);
		$all_data["ot_amount"] = $ot_amount;

		$column_name = "att_bonus" ;
		$att_bonus = $this->get_sum_column($column_name,$salary_month);
		$all_data["att_bonus"] = $att_bonus;

		return $all_data;

	}

	function get_sum_column($column_name,$salary_month)
	{
		$last_salary_month = date('Y-m-d',strtotime('-1 month',strtotime($salary_month)));
		$this->db->select_sum($column_name);
		$this->db->from("pr_pay_scale_sheet");
		$this->db->like("salary_month", $last_salary_month);
		$query = $this->db->get();
		//echo $this->db->last_query();
		$row = $query->row();
		$result = $row->$column_name;

			if($result =='')
			{
				$result = 0;
			}

		return $result;
	}

	function monthly_join_emp($report_date)
	{
		$year = substr($report_date,0,4);
		$month = substr($report_date,5,2);
		$day = substr($report_date,8,2);
		$days = date("t", mktime(0, 0, 0, $month, 1, $year));
		$fromdate = date("Y-m-d", mktime(0, 0, 0, $month, 1, $year));
		$todate = date("Y-m-d", mktime(0, 0, 0, $month, $days, $year));

		$emp_cat = array(1,2);

		$this->db->select('pr_emp_com_info.emp_id');
		$this->db->from('pr_emp_com_info');
		//$this->db->where_in('pr_emp_com_info.emp_cat_id',$emp_cat);
		$this->db->where("pr_emp_com_info.emp_join_date >=",$fromdate);
		$this->db->where("pr_emp_com_info.emp_join_date <=",$todate);
		//$query = $this->db->get();
		/*echo "<pre>";
		echo $this->db->last_query();exit;*/
		$query = $this->db->get()->num_rows();

		return $query;
	}

	function monthly_resign_emp($report_date)
	{
		$year = substr($report_date,0,4);
		$month = substr($report_date,5,2);
		$day = substr($report_date,8,2);
		$days = date("t", mktime(0, 0, 0, $month, 1, $year));
		$fromdate = date("Y-m-d", mktime(0, 0, 0, $month, 1, $year));
		$todate = date("Y-m-d", mktime(0, 0, 0, $month, $days, $year));

		$this->db->select('pr_emp_resign_history.emp_id');
		$this->db->from('pr_emp_resign_history');
		$this->db->where("pr_emp_resign_history.resign_date >=",$fromdate);
		$this->db->where("pr_emp_resign_history.resign_date <=",$todate);
		//$query = $this->db->get();
		$query = $this->db->get()->num_rows();

		return $query;

	}

	function monthly_left_emp($report_date)
	{
		$year = substr($report_date,0,4);
		$month = substr($report_date,5,2);
		$day = substr($report_date,8,2);
		$days = date("t", mktime(0, 0, 0, $month, 1, $year));
		$fromdate = date("Y-m-d", mktime(0, 0, 0, $month, 1, $year));
		$todate = date("Y-m-d", mktime(0, 0, 0, $month, $days, $year));

		$this->db->select('pr_emp_left_history.emp_id');
		$this->db->from('pr_emp_left_history');
		$this->db->where("pr_emp_left_history.left_date >=",$fromdate);
		$this->db->where("pr_emp_left_history.left_date <=",$todate);
		//$query = $this->db->get();
		$query = $this->db->get()->num_rows();

		return $query;

	}

	//------------------Attn Summary Start-----------------------
	function section_attendance_summary_test($report_date, $unit_id){
		//araf
		$data = array();
		$this->db->select('*');
		$query = $this->db->get('pr_floor');

		foreach($query->result() as $row) {
			$floor_id = $row->id;
			$data[$floor_id]['floor_name']= $row->floor_name;

			$query_1 = $this->db->select('*')->order_by('sec_index')->get('pr_section');

			foreach($query_1->result() as $rows){
				$sec_id = $rows->sec_id;
				$sec_strength = $rows->strength;
				$sec_str_staff = $rows->str_staff;

				$query_2 =$this->db->select('*')->order_by('line_name')->get('pr_line_num');
				foreach($query_2->result() as $row_2){
					$line_id = $row_2->line_id;
					$all_emp_FSL= $this->all_emp_floor_sec_line($unit_id,$floor_id,$sec_id,$line_id,$report_date);
					if(!empty($all_emp_FSL)){
						$data[$floor_id]['floor_info'][$sec_id]['sec_name'] = $rows->sec_name;
						$data[$floor_id]['floor_info'][$sec_id]['sec_id'] = $sec_id;
						$data[$floor_id]['floor_info'][$sec_id]['strength'] = $sec_strength;
						$data[$floor_id]['floor_info'][$sec_id]['str_staff'] = $sec_str_staff;

						$data[$floor_id]['floor_info'][$sec_id]['sec_info'][$line_id]['line_name'] = $row_2->line_name;
						$data[$floor_id]['floor_info'][$sec_id]['sec_info'][$line_id]['strength'] = $row_2->strength;

						$data[$floor_id]['floor_info'][$sec_id]['sec_info'][$line_id]['line_info'] = $this->daily_attendance_summary_test_new($report_date,$all_emp_FSL);



						$emp_desig = $this->get_department_section_line_unit_wise($unit_id);
						for($i=0; $i<19; $i++){
							$all_desig_emp = $this->all_emp_floor_sec_line_desig($unit_id,$floor_id,$sec_id,$line_id,$report_date,$emp_desig[$i]);
							if(!empty($all_desig_emp)){
								$data[$floor_id]['floor_info'][$sec_id]['sec_info'][$line_id]['line_info_detil'][$i] = $this->daily_attendance_summary_test_PA($report_date, $all_desig_emp);
							}else{
								$data[$floor_id]['floor_info'][$sec_id]['sec_info'][$line_id]['line_info_detil'][$i] = "null";
							}
						}
					}
				}
			}
		}
		return $data;
	}
	function daily_attendance_summary_test_new($report_date,$all_emp_FSL){
		//araf
		$data =array();
		$cat_id = array(3,4);
		$this->db->select('count(pr_emp_com_info.emp_id) as tEmp');
		$this->db->from("pr_emp_com_info");
		$this->db->where_in("pr_emp_com_info.emp_id", $all_emp_FSL);
		//$this->db->where_not_in("pr_emp_com_info.emp_cat_id", $cat_id);
		$data['tEmp'] = $this->db->get()->row()->tEmp;

		$this->db->select('count(pr_emp_shift_log.emp_id) as preEmp');
		// $this->db->from("pr_emp_com_info");
		$this->db->from("pr_emp_shift_log");
		// $this->db->where_in("pr_emp_com_info.emp_id", $all_emp_FSL);
		$this->db->where_in("pr_emp_shift_log.emp_id", $all_emp_FSL);
		$this->db->where("pr_emp_shift_log.present_status", 'P');
		// $this->db->where("pr_emp_com_info.emp_id = pr_emp_shift_log.emp_id");
		$this->db->where("pr_emp_shift_log.shift_log_date", $report_date);
		$data['preEmp'] = $this->db->get()->row()->preEmp;

		$this->db->select('count(pr_emp_shift_log.emp_id) as absEmp');
		// $this->db->from("pr_emp_com_info");
		$this->db->from("pr_emp_shift_log");
		$this->db->where_in("pr_emp_shift_log.emp_id", $all_emp_FSL);
		$this->db->where("pr_emp_shift_log.present_status", 'A');
		// $this->db->where("pr_emp_com_info.emp_id = pr_emp_shift_log.emp_id");
		$this->db->where("pr_emp_shift_log.shift_log_date", $report_date);
		$data['absEmp'] = $this->db->get()->row()->absEmp;

		$this->db->select('count(pr_emp_shift_log.emp_id) as wEmp');
		// $this->db->from("pr_emp_com_info");
		$this->db->from("pr_emp_shift_log");
		$this->db->where_in("pr_emp_shift_log.emp_id", $all_emp_FSL);
		$this->db->where("pr_emp_shift_log.present_status", 'W');
		// $this->db->where("pr_emp_com_info.emp_id = pr_emp_shift_log.emp_id");
		$this->db->where("pr_emp_shift_log.shift_log_date", $report_date);
		$data['wEmp'] = $this->db->get()->row()->wEmp;

		$this->db->select('count(pr_emp_shift_log.emp_id) as lEmp');
		// $this->db->from("pr_emp_com_info");
		$this->db->from("pr_emp_shift_log");
		$this->db->where_in("pr_emp_shift_log.emp_id", $all_emp_FSL);
		$this->db->where("pr_emp_shift_log.present_status", 'L');
		// $this->db->where("pr_emp_com_info.emp_id = pr_emp_shift_log.emp_id");
		$this->db->where("pr_emp_shift_log.shift_log_date", $report_date);
		$data['lEmp'] = $this->db->get()->row()->lEmp;

		$this->db->select('count(pr_emp_com_info.emp_id) as tNew');
		$this->db->from("pr_emp_com_info");
		$this->db->where_in("pr_emp_com_info.emp_id", $all_emp_FSL);
		$this->db->where("pr_emp_com_info.emp_join_date", $report_date);
		$data['tNew'] = $this->db->get()->row()->tNew;

		$this->db->select("pr_emp_per_info.emp_id");
		$this->db->from('pr_emp_per_info');
		$this->db->where_in("pr_emp_per_info.emp_id", $all_emp_FSL);
		$this->db->where("pr_emp_per_info.emp_sex = 1");
		$data['all_male'] = $this->db->get()->num_rows();

		$this->db->select("pr_emp_per_info.emp_id");
		$this->db->from('pr_emp_per_info');
		$this->db->where_in("pr_emp_per_info.emp_id", $all_emp_FSL);
		$this->db->where("pr_emp_per_info.emp_sex = 2");
		$data['all_female'] = $this->db->get()->num_rows();

		$this->db->select("pr_emp_shift_log.emp_id");
		$this->db->from("pr_emp_shift_log");
		$this->db->where_in("pr_emp_shift_log.emp_id", $all_emp_FSL);
		$this->db->where("pr_emp_shift_log.shift_log_date", $report_date);
		$this->db->where("pr_emp_shift_log.late_status",1);
		$this->db->group_by('pr_emp_shift_log.emp_id');
		$data['all_late'] = $this->db->get()->num_rows();
		return $data;
	}


	function daily_attendance_summary_test_PA($report_date,$all_emp_FSL){
		$data =array();
		$this->db->select('count(pr_emp_shift_log.emp_id) as preEmp');
		$this->db->from("pr_emp_shift_log");
		$this->db->where_in("pr_emp_shift_log.emp_id", $all_emp_FSL);
		$this->db->where("pr_emp_shift_log.present_status", 'P');
		$this->db->where("pr_emp_shift_log.shift_log_date", $report_date);
		$data['preEmp'] = $this->db->get()->row()->preEmp;

		$this->db->select('count(pr_emp_shift_log.emp_id) as absEmp');
		$this->db->from("pr_emp_shift_log");
		$this->db->where_in("pr_emp_shift_log.emp_id", $all_emp_FSL);
		$this->db->where("pr_emp_shift_log.present_status", 'A');
		$this->db->where("pr_emp_shift_log.shift_log_date", $report_date);
		$data['absEmp'] = $this->db->get()->row()->absEmp;

		return $data;
	}
	function all_emp_floor_sec_line_desig($unit_id, $floor_id, $sec_id, $line_id, $report_date,$emp_desig){
		//araf
		$get_left_emp = $this->get_left_emp_all_sts($report_date);
		$get_resign_emp = $this->get_resign_emp_all_sts($report_date);
		$get_promote_emp = $this->get_promote_emp_all($report_date);

		$data = array();
		$this->db->select('emp_id');
		$this->db->from('pr_emp_com_info');
		$this->db->where('unit_id', $unit_id);
		$this->db->where('floor_id', $floor_id);
		$this->db->where('emp_sec_id', $sec_id);
		$this->db->where('emp_line_id', $line_id);
		// $this->db->where('emp_join_date <= "$report_date"');
		$this->db->where('emp_cat_id != 4');
		$this->db->where_in('emp_desi_id',$emp_desig);
		$this->db->where_not_in('emp_id',$get_left_emp);
		$this->db->where_not_in('emp_id',$get_resign_emp);
		$this->db->where_not_in('emp_id',$get_promote_emp);
		$query = $this->db->get();

		foreach($query->result() as $rows){
			$data[] = $rows->emp_id;
		}
		return $data;
	}

	function daily_attendance_summary_test($report_date, $unit_id, $floor_id, $sec_id, $line_id){

		$data =array();
		// exit($report_date. ', '.$unit_id.', '. $floor_id.', '. $sec_id.', '. $line_id);
		$all_emp_FSL= $this->all_emp_floor_sec_line($unit_id,$floor_id,$sec_id,$line_id);
		// print_r($all_emp_FSL);//exit;
		if(!$all_emp_FSL){
			$data['tEmp'] 	= 0;
			$data['preEmp'] = 0;
			$data['absEmp'] = 0;
			$data['wEmp'] 	= 0;
			$data['lEmp'] 	= 0;
			$data['tNew'] 	= 0;
			$data['all_male'] 	= 0;
			$data['all_female'] = 0;
			$data['all_late'] 	= 0;
			// $data['all_leave'] 	= 0;
		}else{
			$this->db->select('count(pr_emp_com_info.emp_id) as tEmp');
			$this->db->from("pr_emp_com_info");
			$this->db->where_in("pr_emp_com_info.emp_id", $all_emp_FSL);
			$data['tEmp'] = $this->db->get()->row()->tEmp;

			$this->db->select('count(pr_emp_shift_log.emp_id) as preEmp');
			$this->db->from("pr_emp_com_info");
			$this->db->from("pr_emp_shift_log");
			$this->db->where_in("pr_emp_com_info.emp_id", $all_emp_FSL);
			$this->db->where("pr_emp_shift_log.present_status", 'P');
			$this->db->where("pr_emp_com_info.emp_id = pr_emp_shift_log.emp_id");
			$this->db->where("pr_emp_shift_log.shift_log_date", $report_date);
			$data['preEmp'] = $this->db->get()->row()->preEmp;

			$this->db->select('count(pr_emp_shift_log.emp_id) as absEmp');
			$this->db->from("pr_emp_com_info");
			$this->db->from("pr_emp_shift_log");
			$this->db->where_in("pr_emp_com_info.emp_id", $all_emp_FSL);
			$this->db->where("pr_emp_shift_log.present_status", 'A');
			$this->db->where("pr_emp_com_info.emp_id = pr_emp_shift_log.emp_id");
			$this->db->where("pr_emp_shift_log.shift_log_date", $report_date);
			$data['absEmp'] = $this->db->get()->row()->absEmp;

			$this->db->select('count(pr_emp_shift_log.emp_id) as wEmp');
			$this->db->from("pr_emp_com_info");
			$this->db->from("pr_emp_shift_log");
			$this->db->where_in("pr_emp_com_info.emp_id", $all_emp_FSL);
			$this->db->where("pr_emp_shift_log.present_status", 'W');
			$this->db->where("pr_emp_com_info.emp_id = pr_emp_shift_log.emp_id");
			$this->db->where("pr_emp_shift_log.shift_log_date", $report_date);
			$data['wEmp'] = $this->db->get()->row()->wEmp;

			$this->db->select('count(pr_emp_shift_log.emp_id) as lEmp');
			$this->db->from("pr_emp_com_info");
			$this->db->from("pr_emp_shift_log");
			$this->db->where_in("pr_emp_com_info.emp_id", $all_emp_FSL);
			$this->db->where("pr_emp_shift_log.present_status", 'L');
			$this->db->where("pr_emp_com_info.emp_id = pr_emp_shift_log.emp_id");
			$this->db->where("pr_emp_shift_log.shift_log_date", $report_date);
			$data['lEmp'] = $this->db->get()->row()->lEmp;

			$this->db->select('count(pr_emp_com_info.emp_id) as tNew');
			$this->db->from("pr_emp_com_info");
			$this->db->where_in("pr_emp_com_info.emp_id", $all_emp_FSL);
			$this->db->where("pr_emp_com_info.emp_join_date", $report_date);
			$data['tNew'] = $this->db->get()->row()->tNew;

			$this->db->select("pr_emp_per_info.emp_id");
			$this->db->from('pr_emp_per_info');
			$this->db->where_in("pr_emp_per_info.emp_id", $all_emp_FSL);
			$this->db->where("pr_emp_per_info.emp_sex = 1");
			$data['all_male'] = $this->db->get()->num_rows();

			$this->db->select("pr_emp_per_info.emp_id");
			$this->db->from('pr_emp_per_info');
			$this->db->where_in("pr_emp_per_info.emp_id", $all_emp_FSL);
			$this->db->where("pr_emp_per_info.emp_sex = 2");
			$data['all_female'] = $this->db->get()->num_rows();

			$this->db->select("pr_emp_shift_log.emp_id");
			$this->db->from("pr_emp_shift_log");
			$this->db->where_in("pr_emp_shift_log.emp_id", $all_emp_FSL);
			$this->db->where("pr_emp_shift_log.shift_log_date", $report_date);
			$this->db->where("pr_emp_shift_log.late_status",1);
			$this->db->group_by('pr_emp_shift_log.emp_id');
			$data['all_late'] = $this->db->get()->num_rows();

			/*$this->db->select("emp_id");
			$this->db->from("pr_leave_trans");
			$this->db->where_in("emp_id", $all_emp_FSL);
			$this->db->where("start_date", $report_date);
			$this->db->group_by('emp_id');
			$data['all_leave'] = $this->db->get()->num_rows();*/
		}
		// print_r($data);exit;
		return $data;
	}
	/*function all_emp_floor_sec_line($unit_id, $floor_id, $sec_id, $line_id){
		$data = array();
		$query = $this->db->select('emp_id')
				->where('unit_id', $unit_id)
				->where('floor_id', $floor_id)
				->where('emp_sec_id', $sec_id)
				->where('emp_line_id', $line_id)
				->where('emp_cat_id != 4')
				->get('pr_emp_com_info');
		foreach($query->result() as $rows){
			$data[] = $rows->emp_id;
		}
		return $data;
	}*/

	function section_ot_summary($report_date, $unit_id){
		$data = array();
		$sec_arr = array(1,5,6,9,2,4,3,7,8,10);
		$sec_arr_2 = array(1,5,6,9,2,4,3,7,8,10,12,13,14,16,17,15,24);
		$this->db->select('*');
		$query = $this->db->get('pr_floor');
		foreach($query->result() as $row) {
			$floor_id = $row->id;
			$data[$floor_id]['floor_name']= $row->floor_name;

			if($floor_id==99){
				$query_1 = $this->db->select('*')->order_by('sec_index')->where_not_in('sec_id',$sec_arr_2)->get('pr_section');
			}else{
				$query_1 = $this->db->select('*')->order_by('sec_index')->where_not_in('sec_id',$sec_arr)->get('pr_section');
			}

			foreach($query_1->result() as $rows){
				$sec_id = $rows->sec_id;

				$query_2 =$this->db->select('*')->order_by('line_name')->get('pr_line_num');
				foreach($query_2->result() as $row_2){
					$line_id = $row_2->line_id;
					$all_emp_FSL= $this->all_emp_floor_sec_line($unit_id,$floor_id,$sec_id,$line_id,$report_date);
					if(!empty($all_emp_FSL)){
						$data[$floor_id]['floor_info'][$sec_id]['sec_name'] = $rows->sec_name;
						$data[$floor_id]['floor_info'][$sec_id]['sec_id'] = $sec_id;

						$data[$floor_id]['floor_info'][$sec_id]['sec_info'][$line_id]['line_name'] = $row_2->line_name;
						$data[$floor_id]['floor_info'][$sec_id]['sec_info'][$line_id]['line_info'] = $this->daily_ot_summary_test_new($report_date,$all_emp_FSL);
					}
				}
			}
		}
		return $data;
	}

function daily_ot_summary_test_new($report_date,$all_emp_FSL){

	   //echo count($all_emp_FSL);exit;
		$data =array();
		$this->db->select('staff_ot_list_emp.emp_id');
		$this->db->from('pr_emp_com_info');
		$this->db->from('staff_ot_list_emp');
		$this->db->where('pr_emp_com_info.emp_id = staff_ot_list_emp.emp_id');
		// $this->db->where('pr_emp_com_info.floor_id = 99');
		$get_emp = $this->db->get();
		/*foreach($get_emp->result() as $id){
			// $emp_id[]=$id->emp_id;
			echo $id->emp_id.',';
		}*/
		foreach($get_emp->result() as $key => $row)
		{
			$staff_emp_id = $row->emp_id;
			if (($key = array_search($staff_emp_id, $all_emp_FSL)) !== false) {
			    unset($all_emp_FSL[$key]);
			}
		}

		$this->db->select('count(pr_emp_com_info.emp_id) as tEmp');
		$this->db->from("pr_emp_com_info");
		$this->db->where_in("pr_emp_com_info.emp_id", $all_emp_FSL);
		$data['tEmp'] = $this->db->get()->row()->tEmp;


		$data_1['one_hour'] = array();
		$data_1['two_hour'] = array();
		$data_1['three_hour'] = array();
		$data_1['four_hour'] = array();
		$data_1['five_hour'] = array();
		$data_1['six_hour'] = array();
		$data_1['seven_hour'] = array();
		$data_1['eight_hour'] = array();
		$data_1['nine_hour'] = array();
		$data_1['ten_hour'] = array();
		$data_1['others'] = array();
		$g_arr[] = array();

		foreach($all_emp_FSL as $each_id)
		{
			$this->db->select('pr_emp_shift_log.emp_id,SUM(pr_emp_shift_log.ot_hour + pr_emp_shift_log.extra_ot_hour) as total');
			$this->db->from('pr_emp_shift_log');
			$this->db->where('pr_emp_shift_log.shift_log_date',$report_date);
			$this->db->where('pr_emp_shift_log.emp_id',$each_id);
			$query2 = $this->db->get();

			foreach($query2->result() as $obj){

				//echo $obj->emp_id.'=='.$obj->total.',';
				if($obj->total == 1){
					$g_arr['araf'] = $obj->emp_id;
					array_push($data_1['one_hour'],$obj->emp_id);
				}elseif($obj->total == 2){
					array_push($data_1['two_hour'],$obj->emp_id);
				}elseif($obj->total == 3){
					array_push($data_1['three_hour'],$obj->emp_id);
				}elseif($obj->total == 4){
					array_push($data_1['four_hour'],$obj->emp_id);
				}elseif($obj->total == 5){
					array_push($data_1['five_hour'],$obj->emp_id);
				}elseif($obj->total == 6){
					array_push($data_1['six_hour'],$obj->emp_id);
				}elseif($obj->total == 7){
					array_push($data_1['seven_hour'],$obj->emp_id);
				}elseif($obj->total == 8){
					array_push($data_1['eight_hour'],$obj->emp_id);
				}elseif($obj->total == 9){
					array_push($data_1['nine_hour'],$obj->emp_id);
				}elseif($obj->total == 10){
					array_push($data_1['ten_hour'],$obj->emp_id);
				}elseif($obj->total >= 11){
					array_push($data_1['others'],$obj->emp_id);
				}
			 }
		  }

		  $data['one'] = count($data_1['one_hour']);
		  $data['two'] = count($data_1['two_hour']);
		  $data['three'] = count($data_1['three_hour']);
		  $data['four'] = count($data_1['four_hour']);
		  $data['five'] = count($data_1['five_hour']);
		  $data['six'] = count($data_1['six_hour']);
		  $data['seven'] = count($data_1['seven_hour']);
		  $data['eight'] = count($data_1['eight_hour']);
		  $data['nine'] = count($data_1['nine_hour']);
		  $data['ten'] = count($data_1['ten_hour']);
		  $data['others'] = count($data_1['others']);
		    /*echo "<pre>";
		  	print_r($data_1);exit;*/
		  	$one_hour_amt = 0;
		  	$two_hour_amt = 0;
		  	$three_hour_amt = 0;
		  	$four_hour_amt = 0;
		  	$five_hour_amt = 0;
		  	$six_hour_amt = 0;
		  	$seven_hour_amt = 0;
		  	$eight_hour_amt = 0;
		  	$nine_hour_amt = 0;
		  	$ten_hour_amt = 0;
		  	$other_hour_amt = 0;
		  	//print_r($data_1['one_hour']);exit;
		  	$one_hour_data= implode(",",$data_1['one_hour']);
		  	$one_hour_data = explode(",",$one_hour_data);
		  	//print_r($one_hour_data);exit;

		  	$two_hour_data = implode(",",$data_1['two_hour']);
		  	$two_hour_data = explode(",",$two_hour_data);
		  	$three_hour_data = implode(",",$data_1['three_hour']);
		  	$three_hour_data = explode(",",$three_hour_data);
		  	$four_hour_data = implode(",",$data_1['four_hour']);
		  	$four_hour_data = explode(",",$four_hour_data);
		  	$five_hour_data = implode(",",$data_1['five_hour']);
		  	$five_hour_data = explode(",",$five_hour_data);
		  	$six_hour_data = implode(",",$data_1['six_hour']);
		  	$six_hour_data = explode(",",$six_hour_data);
		  	$seven_hour_data = implode(",",$data_1['seven_hour']);
		  	$seven_hour_data = explode(",",$seven_hour_data);
		  	$eight_hour_data = implode(",",$data_1['eight_hour']);
		  	$eight_hour_data = explode(",",$eight_hour_data);
		  	$nine_hour_data = implode(",",$data_1['nine_hour']);
		  	$nine_hour_data = explode(",",$nine_hour_data);
		  	$ten_hour_data = implode(",",$data_1['ten_hour']);
		  	$ten_hour_data = explode(",",$ten_hour_data);
		  	$other_hour_data = implode(",",$data_1['others']);
		  	$other_hour_data = explode(",",$other_hour_data);
		  	//$dd=explode(',', $two_hour_data);
		  	// print_r($dd);exit;

		    $this->db->select("pr_emp_com_info.*, pr_emp_per_info.emp_id, pr_emp_shift_log.*");
			$this->db->from('pr_emp_per_info');
			$this->db->from('pr_emp_com_info');
			$this->db->from('pr_emp_shift_log');
			$this->db->where_in("pr_emp_com_info.emp_id", $one_hour_data);
			$this->db->where("pr_emp_per_info.emp_id = pr_emp_com_info.emp_id");
			$this->db->where("pr_emp_shift_log.emp_id = pr_emp_com_info.emp_id");
			$this->db->where('pr_emp_shift_log.shift_log_date',"$report_date");
			$all_emp_id = $this->db->get();
			/*echo "<pre>";
			echo $this->db->last_query();exit;*/

		  	foreach($all_emp_id->result() as $rows){
		  	//echo $rows->emp_id;
			$salary_structure = $this->common_model->salary_structure($rows->gross_sal);
			$ot_rate = $salary_structure['ot_rate'];
			 $rows->emp_id.'=='.$ot_rate;
			 $one_hour_amt = $one_hour_amt + $ot_rate * 1;
			}
			/*echo "hey";
			echo $one_hour_amt;*/
			//exit;
			$this->db->select("pr_emp_com_info.*, pr_emp_per_info.emp_id, pr_emp_shift_log.*");
			$this->db->from('pr_emp_per_info');
			$this->db->from('pr_emp_com_info');
			$this->db->from('pr_emp_shift_log');
			$this->db->where_in("pr_emp_com_info.emp_id", $two_hour_data);
			$this->db->where("pr_emp_per_info.emp_id = pr_emp_com_info.emp_id");
			$this->db->where("pr_emp_shift_log.emp_id = pr_emp_com_info.emp_id");
			$this->db->where('pr_emp_shift_log.shift_log_date',$report_date);
			$all_emp_id_2 = $this->db->get();

		  	foreach($all_emp_id_2->result() as $rows){
			$salary_structure = $this->common_model->salary_structure($rows->gross_sal);
			$ot_rate = $salary_structure['ot_rate'];
			//echo $rows->emp_id.'=='.$ot_rate;
			$two_hour_amt = $two_hour_amt + $ot_rate * 2;
			}

			$this->db->select("pr_emp_com_info.*, pr_emp_per_info.emp_id, pr_emp_shift_log.*");
			$this->db->from('pr_emp_per_info');
			$this->db->from('pr_emp_com_info');
			$this->db->from('pr_emp_shift_log');
			$this->db->where_in("pr_emp_com_info.emp_id", $three_hour_data);
			$this->db->where("pr_emp_per_info.emp_id = pr_emp_com_info.emp_id");
			$this->db->where("pr_emp_shift_log.emp_id = pr_emp_com_info.emp_id");
			$this->db->where('pr_emp_shift_log.shift_log_date',$report_date);
			$all_emp_id_3 = $this->db->get();

		  	foreach($all_emp_id_3->result() as $rows){
			$salary_structure = $this->common_model->salary_structure($rows->gross_sal);
			$ot_rate = $salary_structure['ot_rate'];
			//echo $rows->emp_id.'=='.$ot_rate;
			$three_hour_amt = $three_hour_amt + $ot_rate * 3;
			}

			$this->db->select("pr_emp_com_info.*, pr_emp_per_info.emp_id, pr_emp_shift_log.*");
			$this->db->from('pr_emp_per_info');
			$this->db->from('pr_emp_com_info');
			$this->db->from('pr_emp_shift_log');
			$this->db->where_in("pr_emp_com_info.emp_id", $four_hour_data);
			$this->db->where("pr_emp_per_info.emp_id = pr_emp_com_info.emp_id");
			$this->db->where("pr_emp_shift_log.emp_id = pr_emp_com_info.emp_id");
			$this->db->where('pr_emp_shift_log.shift_log_date',$report_date);
			$all_emp_id_4 = $this->db->get();

		  	foreach($all_emp_id_4->result() as $rows){
			$salary_structure = $this->common_model->salary_structure($rows->gross_sal);
			$ot_rate = $salary_structure['ot_rate'];
			//echo $rows->emp_id.'=='.$ot_rate;
			$four_hour_amt = $four_hour_amt + $ot_rate * 4;
			}

			$this->db->select("pr_emp_com_info.*, pr_emp_per_info.emp_id, pr_emp_shift_log.*");
			$this->db->from('pr_emp_per_info');
			$this->db->from('pr_emp_com_info');
			$this->db->from('pr_emp_shift_log');
			$this->db->where_in("pr_emp_com_info.emp_id", $five_hour_data);
			$this->db->where("pr_emp_per_info.emp_id = pr_emp_com_info.emp_id");
			$this->db->where("pr_emp_shift_log.emp_id = pr_emp_com_info.emp_id");
			$this->db->where('pr_emp_shift_log.shift_log_date',$report_date);
			$all_emp_id_5 = $this->db->get();

		  	foreach($all_emp_id_5->result() as $rows){
			$salary_structure = $this->common_model->salary_structure($rows->gross_sal);
			$ot_rate = $salary_structure['ot_rate'];
			//echo $rows->emp_id.'=='.$ot_rate;
			$five_hour_amt = $five_hour_amt + $ot_rate * 5;
			}

			$this->db->select("pr_emp_com_info.*, pr_emp_per_info.emp_id, pr_emp_shift_log.*");
			$this->db->from('pr_emp_per_info');
			$this->db->from('pr_emp_com_info');
			$this->db->from('pr_emp_shift_log');
			$this->db->where_in("pr_emp_com_info.emp_id", $six_hour_data);
			$this->db->where("pr_emp_per_info.emp_id = pr_emp_com_info.emp_id");
			$this->db->where("pr_emp_shift_log.emp_id = pr_emp_com_info.emp_id");
			$this->db->where('pr_emp_shift_log.shift_log_date',$report_date);
			$all_emp_id_6 = $this->db->get();

		  	foreach($all_emp_id_6->result() as $rows){
			$salary_structure = $this->common_model->salary_structure($rows->gross_sal);
			$ot_rate = $salary_structure['ot_rate'];
			//echo $rows->emp_id.'=='.$ot_rate;
			$six_hour_amt = $six_hour_amt + $ot_rate * 6;
			}

			$this->db->select("pr_emp_com_info.*, pr_emp_per_info.emp_id, pr_emp_shift_log.*");
			$this->db->from('pr_emp_per_info');
			$this->db->from('pr_emp_com_info');
			$this->db->from('pr_emp_shift_log');
			$this->db->where_in("pr_emp_com_info.emp_id", $seven_hour_data);
			$this->db->where("pr_emp_per_info.emp_id = pr_emp_com_info.emp_id");
			$this->db->where("pr_emp_shift_log.emp_id = pr_emp_com_info.emp_id");
			$this->db->where('pr_emp_shift_log.shift_log_date',$report_date);
			$all_emp_id_7 = $this->db->get();

		  	foreach($all_emp_id_7->result() as $rows){
			$salary_structure = $this->common_model->salary_structure($rows->gross_sal);
			$ot_rate = $salary_structure['ot_rate'];
			//echo $rows->emp_id.'=='.$ot_rate;
			$seven_hour_amt = $seven_hour_amt + $ot_rate * 7;
			}

			$this->db->select("pr_emp_com_info.*, pr_emp_per_info.emp_id, pr_emp_shift_log.*");
			$this->db->from('pr_emp_per_info');
			$this->db->from('pr_emp_com_info');
			$this->db->from('pr_emp_shift_log');
			$this->db->where_in("pr_emp_com_info.emp_id", $eight_hour_data);
			$this->db->where("pr_emp_per_info.emp_id = pr_emp_com_info.emp_id");
			$this->db->where("pr_emp_shift_log.emp_id = pr_emp_com_info.emp_id");
			$this->db->where('pr_emp_shift_log.shift_log_date',$report_date);
			$all_emp_id_8 = $this->db->get();

		  	foreach($all_emp_id_8->result() as $rows){
			$salary_structure = $this->common_model->salary_structure($rows->gross_sal);
			$ot_rate = $salary_structure['ot_rate'];
			//echo $rows->emp_id.'=='.$ot_rate;
			$eight_hour_amt = $eight_hour_amt + $ot_rate * 8;
			}

			$this->db->select("pr_emp_com_info.*, pr_emp_per_info.emp_id, pr_emp_shift_log.*");
			$this->db->from('pr_emp_per_info');
			$this->db->from('pr_emp_com_info');
			$this->db->from('pr_emp_shift_log');
			$this->db->where_in("pr_emp_com_info.emp_id", $nine_hour_data);
			$this->db->where("pr_emp_per_info.emp_id = pr_emp_com_info.emp_id");
			$this->db->where("pr_emp_shift_log.emp_id = pr_emp_com_info.emp_id");
			$this->db->where('pr_emp_shift_log.shift_log_date',$report_date);
			$all_emp_id_9 = $this->db->get();

		  	foreach($all_emp_id_9->result() as $rows){
			$salary_structure = $this->common_model->salary_structure($rows->gross_sal);
			$ot_rate = $salary_structure['ot_rate'];
			//echo $rows->emp_id.'=='.$ot_rate;
			$nine_hour_amt = $nine_hour_amt + $ot_rate * 9;
			}

			$this->db->select("pr_emp_com_info.*, pr_emp_per_info.emp_id, pr_emp_shift_log.*");
			$this->db->from('pr_emp_per_info');
			$this->db->from('pr_emp_com_info');
			$this->db->from('pr_emp_shift_log');
			$this->db->where_in("pr_emp_com_info.emp_id", $ten_hour_data);
			$this->db->where("pr_emp_per_info.emp_id = pr_emp_com_info.emp_id");
			$this->db->where("pr_emp_shift_log.emp_id = pr_emp_com_info.emp_id");
			$this->db->where('pr_emp_shift_log.shift_log_date',$report_date);
			$all_emp_id_10 = $this->db->get();

		  	foreach($all_emp_id_10->result() as $rows){
			$salary_structure = $this->common_model->salary_structure($rows->gross_sal);
			$ot_rate = $salary_structure['ot_rate'];
			//echo $rows->emp_id.'=='.$ot_rate;
			$ten_hour_amt = $ten_hour_amt + $ot_rate * 10;
			}
			$this->db->select("pr_emp_com_info.*, pr_emp_per_info.emp_id, pr_emp_shift_log.*");
			$this->db->from('pr_emp_per_info');
			$this->db->from('pr_emp_com_info');
			$this->db->from('pr_emp_shift_log');
			$this->db->where_in("pr_emp_com_info.emp_id", $other_hour_data);
			$this->db->where("pr_emp_per_info.emp_id = pr_emp_com_info.emp_id");
			$this->db->where("pr_emp_shift_log.emp_id = pr_emp_com_info.emp_id");
			$this->db->where('pr_emp_shift_log.shift_log_date',$report_date);
			$all_emp_id_other = $this->db->get();

			$ot_hour = 0;
			$extra_ot_hour = 0;
			$ot_hour_n = 0;
			$extra_ot_hour_n = 0;

		  	foreach($all_emp_id_other->result() as $rows){
				$salary_structure = $this->common_model->salary_structure($rows->gross_sal);
				$ot_rate = $salary_structure['ot_rate'];
				$ot_hour = $ot_hour + $rows->ot_hour * $ot_rate;
				$extra_ot_hour = $extra_ot_hour + $rows->extra_ot_hour * $ot_rate;

				$ot_hour_n = $ot_hour_n + $rows->ot_hour;
				$extra_ot_hour_n = $extra_ot_hour_n + $rows->extra_ot_hour;
			}
				$Tot = $ot_hour + $extra_ot_hour;
				$ot_amt = $Tot;
				$data['other_ot_hour'] = $ot_hour_n + $extra_ot_hour_n;
				$data['other_amt'] = $ot_amt;


				$data['one_hour_amt'] = $one_hour_amt;
				$data['two_hour_amt'] = $two_hour_amt;
				$data['three_hour_amt'] = $three_hour_amt;
				$data['four_hour_amt'] = $four_hour_amt;
				$data['five_hour_amt'] = $five_hour_amt;
				$data['six_hour_amt'] = $six_hour_amt;
				$data['seven_hour_amt'] = $seven_hour_amt;
				$data['eight_hour_amt'] = $eight_hour_amt;
				$data['nine_hour_amt'] = $nine_hour_amt;
				$data['ten_hour_amt'] = $ten_hour_amt;
				$data['ot_amt'] = $one_hour_amt + $two_hour_amt + $three_hour_amt + $four_hour_amt + $five_hour_amt + $six_hour_am + $seven_hour_amt + $eight_hour_amt + $nine_hour_amt + $ten_hour_amt;
				//exit;
				//echo count($data['two_hour']);
				/*echo "<pre>";
				print_r($data);*/
				//exit;

				return $data;
	}

	function daily_ot_summary_test_PA($report_date,$all_emp_FSL){
		$data =array();

		$this->db->select('count(pr_emp_shift_log.emp_id) as preEmp');
		$this->db->from("pr_emp_shift_log");
		$this->db->where_in("pr_emp_shift_log.emp_id", $all_emp_FSL);
		$this->db->where("pr_emp_shift_log.present_status", 'P');
		$this->db->where("pr_emp_shift_log.shift_log_date", $report_date);
		$data['preEmp'] = $this->db->get()->row()->preEmp;

		$this->db->select('count(pr_emp_shift_log.emp_id) as absEmp');
		$this->db->from("pr_emp_shift_log");
		$this->db->where_in("pr_emp_shift_log.emp_id", $all_emp_FSL);
		$this->db->where("pr_emp_shift_log.present_status", 'A');
		$this->db->where("pr_emp_shift_log.shift_log_date", $report_date);
		$data['absEmp'] = $this->db->get()->row()->absEmp;

		return $data;
	}

	function get_left_emp_all_sts($report_date){
		$this->db->select('pr_emp_left_history.emp_id');
		$this->db->from('pr_emp_left_history');
		$this->db->where("pr_emp_left_history.left_date < '$report_date'");
		$query = $this->db->get();
		if($query->num_rows() > 0){
		  foreach ($query->result() as $row){
			  $emp_id[] = $row->emp_id;
		  }
		  return $emp_id ;
		}else{
			return $emp_id[] = 0  ;
		}
	}
	function get_resign_emp_all_sts($report_date){
		$emp_id = array();
		$this->db->select('pr_emp_resign_history.*');
		$this->db->from('pr_emp_resign_history');
		$this->db->where("trim(substr(pr_emp_resign_history.resign_date,1,7)) < '$report_date'");
		$query = $this->db->get();
		if($query->num_rows() > 0){
			foreach ($query->result() as $row){
				$emp_id[] = $row->emp_id;
			}
			return $emp_id ;
		}else{
			return $emp_id[] = 0  ;
		}
	}
	function get_promote_emp_all($report_date){
		$status = "2";
		$this->db->select('pr_incre_prom_pun.prev_emp_id');
		$this->db->from('pr_incre_prom_pun');
		$this->db->where("trim(substr(pr_incre_prom_pun.effective_month,1,7)) <= '$report_date'");
		$this->db->where("pr_incre_prom_pun.status",$status);
		$this->db->where('pr_incre_prom_pun.prev_emp_id != pr_incre_prom_pun.new_emp_id');
		$query = $this->db->get();
		if($query->num_rows() > 0){
			foreach ($query->result() as $row){
				$emp_id[] = $row->prev_emp_id;
			}
			return $emp_id ;
		}else{
			return $emp_id[] = 0  ;
		}
	}
	function all_emp_floor_sec_line($unit_id, $floor_id, $sec_id, $line_id, $report_date){
		//araf
		$get_left_emp = $this->get_left_emp_all_sts($report_date);
		$get_resign_emp = $this->get_resign_emp_all_sts($report_date);
		$get_promote_emp = $this->get_promote_emp_all($report_date);

		$data = array();
		$cat_id = array(1,2);
		$this->db->select('pr_emp_com_info.emp_id');
		$this->db->from('pr_emp_com_info');
		//$this->db->where('unit_id', $unit_id);
		$this->db->where('pr_emp_com_info.floor_id', $floor_id);
		$this->db->where('pr_emp_com_info.emp_sec_id', $sec_id);
		$this->db->where('pr_emp_com_info.emp_line_id', $line_id);
		$this->db->where_in('pr_emp_com_info.emp_cat_id',$cat_id);
		//$this->db->where_not_in('emp_cat_id',$cat_id);
		//$this->db->where('emp_cat_id != 4');
		//$this->db->where_not_in('emp_id',$get_left_emp);
		/*$this->db->where_not_in('emp_id',$get_left_emp);
		$this->db->where_not_in('emp_id',$get_resign_emp);
		$this->db->where_not_in('emp_id',$get_promote_emp);*/
		$query = $this->db->get();
		//echo $query->num_rows();
		foreach($query->result() as $rows){
			$data[] = $rows->emp_id;
		}
		/*echo "<pre>";
		print_r($data);*/
		return $data;
	}
	////////////////Department_section_line_unit_wise Zuel

	/*function get_department_section_line_unit_wise($unit_id){
		$data = array();
		if($unit_id ==1){
			$data = array(
						0 => array(1,3,53,64,69,77,80,82,99,120),//Office staff
						1 => array(2,6,7,8,9,10,11,13,14,16,17,66,67,68,42,75,76,77,79,81,85,92,93,94,95,96,97,99,102,107,108,111,110,112,115,118,121),//PD staff
						2 => array(18,19,21,44),//operator
						3 => array(23),//Asst.operator
						4 => array(20,49),//Line Iron
						5 => array(28,114),//Finishing  Assistant
						6 => array(29),//Jr. Iron Man
						7 => array(25),//Iron Man
						8 => array(55),//Poly Man
						9 => array(84,122),//Spot Man 25,28,29,55,84
						10 => array(26,27),//Folder,Jr. Folder
						11 => array(30,105),//Jr. Packer
						12 => array(71,72,74),//Admin 4th Class
						13 => array(75,76,77,78,79,80,81,82,83,84,85,86),//Cutting
						14 => array(110),//Fusing
						15 => array(111,112),//Clener
						16 => array(96)//Others
						);
			return $data;
		}
	} */

	function get_ot_hour_wise($unit_id){
		$data = array();
		if($unit_id ==1){
			$data = array(
						0 => array(1,3,53,64,69,77,80,82,99,120),//Office staff
						1 => array(2,6,7,8,9,10,11,13,14,16,17,66,67,68,42,75,76,77,79,81,85,92,93,94,95,96,97,99,102,107,108,111,110,112,115,118,121),//PD staff
						2 => array(18,19,21,44),//operator
						3 => array(23),//Asst.operator
						4 => array(20,49),//Line Iron
						5 => array(28,114),//Finishing  Assistant
						6 => array(29),//Jr. Iron Man
						7 => array(25),//Iron Man
						8 => array(55),//Poly Man
						9 => array(84,122),//Spot Man 25,28,29,55,84
						10 => array(26,27),//Folder,Jr. Folder
						11 => array(30,105),//Jr. Packer
						12 => array(71,72,74),//Admin 4th Class
						13 => array(75,76,77,78,79,80,81,82,83,84,85,86),//Cutting
						14 => array(110),//Fusing
						15 => array(111,112),//Clener
						16 => array(96)//Others
						);
			return $data;
		}
	}
///////////////////////////line_logout_summary///////////////////////////
function line_logout_summary($report_date, $unit_id)
	{
		$query = $this->db->select()->where('unit_id', $unit_id)->order_by('line_name')->get('pr_line_num');
		//echo $num = $query->num_rows();
		//$data = array();
		foreach($query->result() as $rows)
		{
			$data['cat_name'][] = $rows->line_name;

			$all_emp_id = $this->get_line_emp_by_id($rows->line_id, $unit_id);


		}
		return $all_emp_id;

	}
function get_line_emp_logout($line_id, $unit_id, $report_date, $first_time, $secoend_time)
				{
					//$emp_cat = array(1,2);
					$this->db->select("count(pr_emp_shift_log.emp_id) as emp_id, SUM(pr_emp_shift_log.ot_hour) as ot_hour, SUM(pr_emp_shift_log.extra_ot_hour) as extra_ot_hour,SUM(pr_emp_shift_log.modify_eot) as modify_eot,SUM(pr_emp_shift_log.deduction_hour) as deduction_hour");
					$this->db->from("pr_emp_com_info");
					$this->db->from("pr_emp_shift_log");
					$this->db->where("pr_emp_com_info.unit_id", $unit_id);
					$this->db->where("pr_emp_com_info.emp_line_id", $line_id);
					$this->db->where("pr_emp_shift_log.shift_log_date", $report_date);
					$this->db->where("pr_emp_shift_log.out_time BETWEEN '$first_time' AND '$secoend_time'");
					$this->db->where("pr_emp_shift_log.emp_id = pr_emp_com_info.emp_id");
					$this->db->where("pr_emp_shift_log.in_time != '00:00:00'");
					$query = $this->db->get();
					$num_rows = $query->num_rows();
					//$data['num_rows'] = $num_rows;

					//echo $this->db->last_query();
					if($num_rows > 0)
					{
						foreach($query->result() as $rows)
						{
							$data['emp_id'] 		= $rows->emp_id;
							$data['ot_hour'] 		= $rows->ot_hour;
							$data['extra_ot_hour'] 	= $rows->extra_ot_hour;
							$data['modify_eot'] 	= $rows->modify_eot;
							$data['deduction_hour']	= $rows->deduction_hour;
							//echo $rows->emp_id."---";
						}
					}else{
						$data['ot_hour'] 		= 0;
						$data['extra_ot_hour'] 	= 0;
						$data['emp_id'] 		= 0;
						$data['modify_eot'] 	= 0;
						$data['deduction_hour']	= 0;
					}
					return $data;
				}


////////////////////////////////emp_present_linewise	///////////////

function get_emp_present_linewise($line_id, $unit_id, $report_date)
				{
					$this->db->select("count(pr_emp_shift_log.emp_id) as emp_id_present");
					$this->db->from("pr_emp_com_info");
					$this->db->from("pr_emp_shift_log");
					$this->db->where("pr_emp_com_info.unit_id", $unit_id);
					$this->db->where("pr_emp_com_info.emp_line_id", $line_id);
					$this->db->where("pr_emp_shift_log.shift_log_date", $report_date);
					$this->db->where("pr_emp_shift_log.emp_id = pr_emp_com_info.emp_id");
					$this->db->where("pr_emp_shift_log.in_time != '00:00:00'");
					$query = $this->db->get();
					$num_rows = $query->num_rows();
					//$data['num_rows'] = $num_rows;

					//echo $this->db->last_query();
					if($num_rows > 0)
					{
						foreach($query->result() as $rows)
						{
							$data['emp_id_present'] = $rows->emp_id_present;

						}
					}else{
							$data['emp_id_present'] = 0;
					}
					return $data;
				}


///////////////////////////////all_emp_present_error	///////////////

function get_all_emp_present_error($line_id, $unit_id, $report_date)
				{
					$this->db->select("count(pr_emp_shift_log.emp_id) as emp_id_present_error");
					$this->db->from("pr_emp_com_info");
					$this->db->from("pr_emp_shift_log");
					$this->db->where("pr_emp_com_info.unit_id", $unit_id);
					$this->db->where("pr_emp_com_info.emp_line_id", $line_id);
					$this->db->where("pr_emp_shift_log.shift_log_date", $report_date);
					$this->db->where("pr_emp_shift_log.emp_id = pr_emp_com_info.emp_id");
					$this->db->where("pr_emp_shift_log.in_time != '00:00:00'");
					$this->db->where("pr_emp_shift_log.out_time	 = '00:00:00'");
					$query = $this->db->get();
					$num_rows = $query->num_rows();
					//$data['num_rows'] = $num_rows;

					//echo $this->db->last_query();
					if($num_rows > 0)
					{
						foreach($query->result() as $rows)
						{
							$data['emp_id_present_error'] = $rows->emp_id_present_error;

						}
					}else{
							$data['emp_id_present_error'] = 0;
					}
					return $data;
				}


////////////////////////////////

}
?>
