<?php
class Attn_process_model extends CI_Model{


	function __construct()
	{
		parent::__construct();

		/* Standard Libraries */
		$this->load->model('file_process_model');
	}

	function prox_id($empid){
		$proxi_id = array();
		$this->db->select('proxi_id');
		$this->db->where('proxi_id != ""');
		$this->db->where_in('emp_id',$empid);
		$query = $this->db->get('pr_id_proxi');
		foreach ($query->result() as $rows){
			$proxi_id[] = $rows->proxi_id;
		}
		return $proxi_id;
	}

    function delete_double_entry($emp_id,$att_date) {
        $this->db->select('*');
        $this->db->from("pr_emp_shift_log");
        $this->db->where("emp_id", $emp_id);
        $this->db->where("shift_log_date", $att_date);
        $query = $this->db->get();
        if($query->num_rows() > 1)
        {
	        $this->db->where('emp_id',$emp_id);
	        $this->db->where('shift_log_date',$att_date);
	        $this->db->order_by("shift_log_id","ASC");
	        $this->db->delete('pr_emp_shift_log');
        }
    }

	function attn_process($process_date,$unit,$grid_emp_id)
	{
		//SALARY BLOCK CHECK
		// echo $unit_id;exit;
		if (strtotime(date('Y-m-d')) < strtotime($process_date)) {
			return 'Sorry!, Not allow to advance process';
		}

		$prev_date = date('Y-m-d', strtotime($process_date ." - 1 days"));
		$prev_data = $this->db->where('shift_log_date', $prev_date)->get('pr_emp_shift_log', $data);
		if ($prev_data->num_rows() == 0) {
			return 'Please!, first process '.$prev_date;
		}

		$next_month_year = date("Y-m",strtotime($process_date));
		$num_row_month_year = $this->db->like('block_month',$next_month_year)->where('unit_id',$unit)->get('pr_salary_block')->num_rows();
		if($num_row_month_year > 0){
			return "Already Finally Processed..";
		}
		//DECLARE ARRAY FOR DATABASE INSERT/UPDATE
		$result 	= array();

		//MAKE YEAR,MONTH,DAY FROM INPUT DATE
		$first_y	= date('Y', strtotime($process_date));
		$first_m	= date('m', strtotime($process_date));
		$first_d	= date('d', strtotime($process_date));

		//CREATE END OF THE MONTH
		$last_date 	= date("t", mktime(0, 0, 0, $first_m, 1, $first_y));

		$this->file_process_model->file_process_for_attendance($process_date,$unit,$grid_emp_id);

		// exit('X');
		$att_date	= $process_date;

		if ($first_d == $last_date) {
			$this->create_att_month_table($att_table);
		}

		//MONTHLY ATTENDANCE TABLE EXISTANCE CHECK
		$monthly_attn_table_check = $this->monthly_attendance_table_existance_check($process_date);

		//IF THE CONDITION IS FALSE THE WHOLE PROCESS WILL STOP AND SHOW THIS MESSAGE
		if ($monthly_attn_table_check == false ){
		 	return "Selected month does not exist and change your process month";
		}

		//MAKE ATTEANDANCE TABLE NAME MONTHLY
		$att_table 	= $this->make_attendance_table_name_monthly($process_date);
		//GET ALL EMPLOYEE INCLUDING REGULER,NEW,RESIGN,LEFT,PROMOTED

		/*
			// this code temporary
			// this code used to roster part 
		*/
		$emps = array(5001744, 5002386, 5002591, 5002668, 5002752, 5003308, 5003519, 5004138, 5004384, 5004385, 5004391, 5004455, 5004487, 5004557, 5004651, 5004659, 5004670, 5004779, 5004803, 5004814, 5004839, 5004853, 5004866, 5004941, 5005021, 5005040, 5005063, 5005094, 5005168, 5005187, 5005221, 5005232, 5005233, 5005258, 5005259, 5005314, 5005339, 5000949, 5001630, 5001660, 5001665, 5002588, 5002999, 5003320, 5003516, 5003546, 5003610, 5003828, 5003951, 5004162, 5004424, 5004462, 5004588, 5004600, 5004658, 5004778, 5004796, 5004856, 5004886, 5004888, 5004889, 5004922, 5004934, 5004940, 5004976, 5005034, 5005035, 5005036, 5005053, 5005066, 5005162, 5005257, 5005265, 5005271, 5001405, 5003576, 5004399, 5004416, 5004417, 5004915, 5004918, 5005010, 5000292, 5004400, 5004405, 5004526, 5004921, 5004961, 5005025, 5005026, 5005091, 5005103, 5005104);

			// $this->db->where_in('emp_id',$emps)->where('shift_log_date','2023-10-21')->delete('pr_emp_shift_log');
			// $this->check_hsift_roster($process_date, $unit);
			// exit('done');
		// end temporary part

		// $all_employee = $this->get_all_employee($emps);
		$all_employee = $this->get_all_employee($grid_emp_id);

		//===================================================
		$year_month = date("Y-m", mktime(0, 0, 0, $first_m, 1, $first_y));
		$year_month = $year_month."-00";
		//===================================================
		// echo "<pre>"; print_r($all_employee->result()); exit('X');
		$i = 0;
		$j = 0;

		foreach ($all_employee->result() as $rows){
			$emp_id	= $rows->emp_id;

			/*if (in_array($emp_id, $emps)) {
				continue;
			}*/

			$this->delete_double_entry($emp_id,$att_date);
			// echo $emp_id;exit();
			$ot_entitle		= $rows->ot_entitle;
			$emp_desi_id	= $rows->emp_desi_id;

			//PROCESS ELIGIBILITY CHECK AFTER JOINING AND BEFORE RESIGN OR LEFT
			$joining_check 	= $this->check_joining($emp_id, $process_date);
			$resign_check 	= $this->check_resign($emp_id, $process_date);
			$left_check 	= $this->check_left($emp_id, $process_date);

			//IF ANY CONDITION IS FALSE THEN ID WILL NOT GO TO THE CORE PROCESS
			if($joining_check == false or $resign_check == false or $left_check == false){
				$attn_delete = $this->attn_delete_for_eligibility_failed($emp_id, $att_date);
				$i++;
			}
			else{
				$j++;

				//GET CURRENT SHIFT INFORMATION
				$shift_duty = $rows->shift_duty;

				//WEEKEND CHECK FOR SPECIFIC ID: RETURN TRUE OR FALSE
				$weekend 	= $this->check_weekend($emp_id, $process_date);
				$holiday = $this->check_holiday($emp_id, $att_date);


				//CREATE A ROW INTO pr_attn_monthly TABLE IF NOT EXIST
				$this->create_row_for_attendance_monthly($emp_id, $process_date);

				$ot_hour = 0;

				$emp_shift = $this->emp_shift_check_process($emp_id, $process_date);
				$schedule  = $this->schedule_check($emp_shift);

				$in_start_time	= $schedule[0]["in_start"];
				$in_end_time   	= $schedule[0]["in_end"];
				$out_start_time = $schedule[0]["out_start"];
                $out_end_time 	= $schedule[0]["out_end"];
                $ot_start_time 	= $schedule[0]["ot_start"];
                $late_start_time = $schedule[0]["late_start"];

                // 16-11-2023
                $out_date = $process_date;
                if (strtotime($out_end_time) < strtotime('12:00:00')){
                    $out_date = date('Y-m-d', strtotime($out_date. ' + 1 days'));
                }

                if (strtotime($in_end_time) > strtotime('12:00:00')){
	                $ot_start = "$out_date $ot_start_time";
                } else {
	                $ot_start = "$process_date $ot_start_time";
                }

                $in_start_time = "$process_date $in_start_time";
                $in_end_time   = "$process_date $in_end_time";
                $out_end_time   = "$out_date $out_end_time";
                // 16-11-2023

                $table = 'att_'.date('Y_m',strtotime($process_date));
                $in_time  = $this->time_check_in($in_start_time, $in_end_time, $emp_id, 'ASC', $table);
				$out_time = $this->time_check_in($in_end_time, $out_end_time, $emp_id, 'DESC', $table);

				// dd(date('Y-m-d h:i:s',strtotime('1day'.$out_start_time))."==".$out_end_time);
				// dd($in_end_time .' = '. $out_end_time);

				$this->db->select("leave_type");
				$this->db->where("emp_id",$emp_id);
				$this->db->where("start_date",$process_date);
				$query = $this->db->get("pr_leave_trans");

				$date_fld = "date_".date('d', strtotime($process_date));
				if($query->num_rows() > 0){
					$result[$emp_id] = "L";
					$ppp = array( $date_fld => $result[$emp_id]);
					$this->db->where("emp_id",$emp_id);
					$this->db->where("att_month",$year_month);
					$this->db->update("pr_attn_monthly",$ppp);
				}elseif ($process_date == $holiday){
					$result[$emp_id] = "H";
					$hhh = array( $date_fld => $result[$emp_id]);
					$this->db->where("emp_id",$emp_id);
					$this->db->where("att_month",$year_month);
					$this->db->update("pr_attn_monthly",$hhh);
				}elseif ($process_date == $weekend){
					$result[$emp_id] = "W";
					$www = array( $date_fld => $result[$emp_id]);
					$this->db->where("emp_id",$emp_id);
					$this->db->where("att_month",$year_month);
					$this->db->update("pr_attn_monthly",$www);
				}elseif ($in_time != ''){
					$result[$emp_id] = "P";
					$www = array( $date_fld => $result[$emp_id]);
					$this->db->where("emp_id",$emp_id);
					$this->db->where("att_month",$year_month);
					$this->db->update("pr_attn_monthly",$www);
				}else{
					$result[$emp_id] = "A";
					$aaa = array( $date_fld => $result[$emp_id]);
					$this->db->where("emp_id",$emp_id);
					$this->db->where("att_month",$year_month);
					$this->db->update("pr_attn_monthly",$aaa);
				}

				//=================OT CALCULATION ========================
				$ot_hour 		   = 0;
				$eot_hour 		   = 0;
				$ot_eot_12am 	   = 0;
				$ot_eot_4pm        = 0;
				$deduction_hour    = 0;
				$late_status 	   = 0;
				$night_allowance   = 0;
				$holiday_allowance = 0;
				$weekly_allo 	   = 0;


                $two_hour_ot 		= $schedule[0]["two_hour_ot_out_time"];
                $ot_last_hour 		= $schedule[0]["ot_minute_to_one_hour"];
                $lunch_start   		= $schedule[0]["lunch_start"];
                $lunch_minute  		= $schedule[0]["lunch_minute"];
                $tiffin_break       = $schedule[0]["tiffin_break"];
                $tiffin_minute 		= $schedule[0]["tiffin_minute"];
                $tiffin_break2 		= $schedule[0]["tiffin_break2"];
                $tiffin_minute2		= $schedule[0]["tiffin_minute2"];
                $acual_in_time 		= $schedule[0]["in_time"];

                // echo "<pre>"; print_r($schedule); exit;
                // freshment time cal 19-11-2023
                $lunch_in = "$process_date $lunch_start";
				$lunch_in_time = date("Y-m-d H:i:s",strtotime("+ $lunch_minute minutes",strtotime($lunch_in)));

                $tiffin_break_start1 = "$process_date $tiffin_break";
				$tiffin_break_end1 = date("Y-m-d H:i:s",strtotime("+ $tiffin_minute minutes",strtotime($tiffin_break_start1)));

                if (strtotime($tiffin_break2) > strtotime('20:00:00')){
	                $tiffin_break2 = "$process_date $tiffin_break2";
                } else {
	                $tiffin_break2 = "$out_date $tiffin_break2";
                }
				$tiffin_break_time2 = date("Y-m-d H:i:s",strtotime("+ $tiffin_minute2 minutes",strtotime($tiffin_break2)));
				// dd($tiffin_break_time2);
				// freshment time cal 19-11-2023

				// get night allownce time
				$this->db->select("nar.night_time");
				$this->db->from('pr_night_allowance_rules as nar');	
				$this->db->from('pr_night_allowance_level as nal');	
				$this->db->where("unit_id",$unit);
				$this->db->where("nal.desig_id",$emp_desi_id);
				$this->db->where('nar.rules_id = nal.rules_id');
				$night_al_time = $this->db->get();

				// echo "<pre>";print_r($night_al_time->row());exit;
				//============= Working day/Weeked/Holiday OT Calculation =============
				if ($ot_entitle == 0) {
					//======= Weeked/Holiday Extra OT Calculation==========
					if($process_date == $weekend || $process_date == $holiday){

		                if ($in_time != "" && $out_time !="" && $in_time != $out_time) {

	                		$start_date_time = strtotime($in_time);
							$end_date_time 	= strtotime($out_time);

							$minute 		= ($end_date_time - $start_date_time)/60;
							if (($out_time > $lunch_in_time) && ( $lunch_minute != 0)) {
								$minute = $minute - $lunch_minute;
							}

							// Tiffin break Deduction Hour
							if ($out_time > $tiffin_break_end1 && $tiffin_minute != 0) {
								$minute = $minute - $tiffin_minute;
							}
							// Tiffin break Deduction Hour
							if ($out_time > $tiffin_break_time2 && $tiffin_minute2 != 0) {
								$minute = $minute - $tiffin_minute2;
							}

							$eot_hour 	= floor($minute / 60);
							// echo $eot_hour;exit;
							if ($minute % 60 >= $ot_last_hour) {
								$eot_hour = $eot_hour + 1;
							}
							// echo $eot_hour;exit;
							// week andholiday allowns
							if ($eot_hour != 0) {
								if ($process_date == $weekend) {
									$weekly_allo = 1;
								}else{
									$holiday_allowance = 1;
								}
							}

		                }
		                // echo $eot_hour;exit;
						// night allowns

						if ($night_al_time->num_rows() > 0 ) {
							if ($out_time > $night_al_time->row()->night_time) {
								$night_allowance = 1;
							}
						}

					} else {

						$end_date_time 	 = strtotime($out_time);
						$start_date_time = strtotime($ot_start);
						// dd($end_date_time .'==='. $start_date_time .'==='. $in_time);

						if ($end_date_time > $start_date_time && $in_time != '') {
							// this section for ramadan
							$start_date = date("Y-m-d",strtotime("2023-03-23"));
							$end_date = date("Y-m-d",strtotime("2023-04-23"));
							if($process_date > $start_date && $process_date < $end_date){
								if($tiffin_break_end1 > $out_time && $tiffin_break_start1 < $out_time){
									$out_time = $tiffin_break_start1;
									$end_date_time  = strtotime($out_time);
								}
							}
							// this section for ramadan end

							// echo "W $end_date_time ";exit();
							$minute = ($end_date_time - $start_date_time)/60;
							// dd(floor($minute/60));

							// Tiffin break Deduction Hour
							if ($tiffin_break_end1 < $out_time && $tiffin_minute != 0) {
								// $minute = $minute - $tiffin_minute;
								if($unit == 4){
									if($minute > $tiffin_minute){
										$minute = $minute - $tiffin_minute;
									}else{
										$minute = 0;
									}
								}else{
									$minute = $minute - $tiffin_minute;
								}
							}

							// Tiffin break Deduction Hour/
							if ($tiffin_break_time2 < $out_time && $tiffin_minute2 != 0) {
								if($unit == 4){
									if($minute > $tiffin_minute2){
										$minute = $minute - $tiffin_minute2;
									}else{
										$minute = 0;
									}
								}else{
									$minute = $minute - $tiffin_minute2;
								}
							}
							// dd($tiffin_break_time2 .'=='. $out_time);

							// OT Calculation
							$ot_hour = floor($minute / 60);
							// echo "<pre>";print_r($minute.'=='. $tiffin_minute2);exit; 
							

							if ($minute % 60 >= $ot_last_hour) {
								$ot_hour = $ot_hour + 1;
							}


							// // EOT Calculation
							if ($ot_hour > 2) {
								$eot_hour = $ot_hour - 2;
								$ot_hour = 2;
							}

							// 9pm EOT Calculation
							if ($eot_hour > 2) {
								$ot_eot_4pm = 2; 
							} else {
								$ot_eot_4pm = $eot_hour; 
							}

							// 12am EOT Calculation
							if ($tiffin_break_time2 < $out_time && $tiffin_minute2 != 0) {
								$ot_eot_12am = 5;
							} else {
								if ($eot_hour > 5) {
									$ot_eot_12am = 5; 
								} else {
									$ot_eot_12am = $eot_hour; 
								}
							}
						}


						if ($night_al_time->num_rows() > 0 ) {
							$a= $process_date." ".$night_al_time->row()->night_time;
							$b = date('Y-m-d H:i:s', strtotime($a. ' + 1 days'));
						 	// exit; 
							if ($out_time > $b) {
								// echo "1";exit;
								$night_allowance = 1;
							}
							else{
							$night_allowance = 0;
						}
							// else echo "0";exit;
						}

 

						//===========Deduction CALCULATION============================
						$minSlot = 15; //15 Minute Slot
		                $start_date_time = strtotime($ot_start_time);
		                $end_date_time 	= strtotime($out_time);
						/*if ($start_date_time > $end_date_time) {
			                $deduct_minute 	= floor(($start_date_time - $end_date_time)/60);
							$deduction_hour = ($minSlot * floor($deduct_minute / $minSlot))/60;
						}*/
					}
				}

				// echo "<pre>";print_r($tiffin_break_time2);exit;

				// Night Allowance unit

				if ($night_al_time->num_rows() > 0 ) {
					$a= $process_date." ".$night_al_time->row()->night_time;
					$b = date('Y-m-d H:i:s', strtotime($a. ' + 1 days'));
					if ($out_time > $b) {
						$night_allowance = 1;
					} else{
						$night_allowance = 0;
					}
				}

                // echo $night_allowance;exit;

				// Late Status
				if($process_date == $weekend || $process_date == $holiday) {
					$late_status = 0;
				} else {
					$late_start_time = "$process_date $late_start_time";
					if($in_time > $late_start_time) {
					 	$late_status = 1;
					} else {
					 	$late_status = 0;
					}
				}

				 // echo "$late_status  =  $in_time   =   $late_start_time"; die;


				 if($result[$emp_id]=="W" && $in_time !=''){
				 	$weekly_allo=1;
				 }
				 else{
				 	$weekly_allo=0;					 	
				 } 

				 if($result[$emp_id]=="H" && $in_time !=''){
				 	$holiday_allowance=1;
				 }
				 else{
				 	$holiday_allowance=0;					 	
				 } 
				 // echo "<pre>";print_r($result[$emp_id]);exit;
				// echo $weekend;exit;	
				// echo $unit; exit();		
				 // dd($out_time);
				$data = array(
					'in_time' 			=> $in_time,
					'out_time' 			=> $out_time,
					'ot_hour' 			=> $ot_hour,
					'extra_ot_hour' 	=> $eot_hour,
					'ot_eot_4pm' 		=> $ot_eot_4pm,
					'ot_eot_12am' 		=> $ot_eot_12am,
					'deduction_hour' 	=> $deduction_hour,
					'night_allo' 		=> $night_allowance,
					'late_status' 		=> $late_status,
					'present_status' 	=> $result[$emp_id],
					'tiffin_allo' 		=> 0,
					'holiday_allowance'	=> $holiday_allowance,
					'weekly_allo'		=> $weekly_allo
				);
				// dd($data);
				// echo "<pre>";print_r($data);exit();
				// echo "<pre>";print_r($data['night_allo']);exit();

				$this->db->where('shift_log_date', $process_date);
				$this->db->where('emp_id', $emp_id);
				$this->db->update('pr_emp_shift_log', $data);

			}
		}
		// return $data;

		// check roster shift and auto chage this (if true this)
		if ($unit == 4 && strtotime(date('Y-m-d')) == strtotime($process_date)) {
			$this->check_shift_roster($process_date, $unit);
		}
		// $this->check_shift_roster($process_date, $unit);

		return $result;
	}


	// check roster shift and chage it
	function check_shift_roster($date, $unit)
	{
		// dd($date);
		$date = date("Y-m-d",strtotime($date));
		$shifts = $this->db->where('end_date',$date)->where('unit_id',$unit)->get('pr_emp_roster_shift');

		if ($shifts->num_rows() == 0) {
			return false;
		}

		foreach ($shifts->result() as $key => $row) {
			$id 		= $row->id;
			$start_date = $row->start_date;
			$end_date   = $row->end_date;
			$duration 	= $row->duration;
			$dd 		= json_decode($row->shift_type);
			$shift_type = $dd[0];

			// dd($shift_type);
			// automatecally change employee shift
			if (count($shift_type) == 3) {			
				$morning_shift = $shift_type[0];
				$evening_shift = $shift_type[1];
				$night_shift   = $shift_type[2];

				// get shift id wise employee in array 
				$morning = $this->get_roster_shift_emp($morning_shift, $unit);
				$evening = $this->get_roster_shift_emp($evening_shift, $unit);
				$night   = $this->get_roster_shift_emp($night_shift, $unit);

				if (!empty($morning)) {
					$this->auto_change_roster_shift($morning, $night_shift, $unit);
				}
				if (!empty($evening)) {
					$this->auto_change_roster_shift($evening, $morning_shift, $unit);
				}
				if (!empty($night)) {
					$this->auto_change_roster_shift($night, $evening_shift, $unit);
				}

			} else if (count($shift_type) == 2) {
				$day_shift 	 = $shift_type[0];
				$night_shift = $shift_type[1];
				$days 	= $this->get_roster_shift_emp($day_shift, $unit);
				$night  = $this->get_roster_shift_emp($night_shift, $unit);

				if (!empty($days)) {
					$this->auto_change_roster_shift($days, $night_shift, $unit);
				}

				if (!empty($night)) {
					$this->auto_change_roster_shift($night, $day_shift, $unit);
				}
			} 
			// end auto employee shift change

			// update auto roster shift
			$shift_start_date = date('Y-m-d', strtotime($start_date ." + $duration days"));
			$shift_end_date   = date('Y-m-d', strtotime($end_date ." + $duration days"));
			$this->update_roster_shift($id, $shift_start_date, $shift_end_date, $unit);
		}
		return true;
	}

	function auto_change_roster_shift($emp_array, $emp_shift, $unit_id)
	{
		$data = array(
			'emp_shift' => $emp_shift
		);

		$this->db->where_in('emp_id', $emp_array)->where('unit_id', $unit_id)->update('pr_emp_com_info', $data);
		return true;
	}

	function get_roster_shift_emp($emp_shift, $unit_id)
	{
		$rs=$this->db->select('emp_id')->where('emp_shift',$emp_shift)->where('unit_id',$unit_id)->get('pr_emp_com_info');
		$result = $rs->result_array();
		$output = array();

		array_walk($result, function($entry) use (&$output) {
		    $output[] = $entry["emp_id"];
		});
		
		return $output;
	}


	function update_roster_shift($id, $start_date, $end_date, $unit_id)
	{
		$data = array(
			'start_date' => $start_date,
			'end_date'   => $end_date,
		);
		$this->db->where('id', $id)->where('unit_id', $unit_id)->update('pr_emp_roster_shift', $data);
		return true;
	}
	// end roster shift

	function create_att_month_table($att_table)
	{

		$att_table = date('Y-m-d', strtotime($att_table ." + 1 days"));
		$year  = trim(substr($att_table,0,4));
		$month = trim(substr($att_table,5,2));
		$day   = trim(substr($att_table,8,2));
		
		$att_table = "att_".$year."_".$month;
		if (!$this->db->table_exists($att_table)){
			$this->db->query('CREATE TABLE IF NOT EXISTS `'.$att_table.'`(	
			     `att_id` int(11) NOT NULL AUTO_INCREMENT,
			     `device_id` int(11) NOT NULL,
			     `proxi_id` varchar(30) NOT NULL,
			     `date_time` datetime NOT NULL,
			      PRIMARY KEY (`att_id`),
				  KEY `device_id` (`device_id`,`proxi_id`,`date_time`)) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;'
			);	
		}
		return true;
	}
	



	public function four_hour_ot_eot($emp_id, $date)
  	 {
   		$table = "temp_$emp_id";
		$table = strtolower($table);


		$this->db->select("pr_emp_com_info.ot_entitle");
		$this->db->from("pr_emp_com_info");
		$this->db->where("pr_emp_com_info.emp_id = '$emp_id'");
		$query1 = $this->db->get();
		$row1 = $query1->row();
		$ot_status  = $row1->ot_entitle;

		$in_time = '';
		$out_time = '';

		$emp_shift = $this->emp_shift_check($emp_id, $date);

		$this->db->select("shift_id");
		$this->db->from("pr_emp_shift_schedule");
		$this->db->where("sh_type", $emp_shift);
		$query = $this->db->get();
		$row = $query->row();

		$schedule = $this->schedule_check($emp_shift);
		// echo "<pre>"; print_r($schedule); exit();
		$start_time		=  $schedule[0]["in_start"];
		$late_time 		=  $schedule[0]["late_start"];
		$end_time   	=  $schedule[0]["in_end"];
		$out_start_time	=  $schedule[0]["out_start"];
		$ot_start_time	=  $schedule[0]["ot_start"];
		$out_end_time	=  $schedule[0]["out_end"];

		$ot_hour = 0;

		$hour = trim(substr($out_start_time,0,2));
		$minute = trim(substr($out_start_time,3,2));
		$sec = trim(substr($out_start_time,6,2));

		$am_pm = date("A", mktime($hour, $minute, $sec, 0, 0, 0));
		$in_date = $date;
		$ot_start_time = "$in_date $ot_start_time";
		if($am_pm == "AM")
		{
			//echo $am_pm;
			$now = strtotime($in_date);
			$datestr = strtotime("+1 day",$now);
			$in_date = date("Y-m-d", $datestr);
			$in_date = $in_date;
		}
		else
		{
			$in_date = $date;
		}

		$hour = trim(substr($out_end_time,0,2));
		$minute = trim(substr($out_end_time,3,2));
		$sec = trim(substr($out_end_time,6,2));
		$am_pm = date("A", mktime($hour, $minute, $sec, 0, 0, 0));

		$out_date = $date;
		if($am_pm == "AM")
		{
			//echo $am_pm;
			$now = strtotime($out_date);
			$datestr = strtotime("+1 day",$now);
			$out_date = date("Y-m-d", $datestr);
			$out_date = $out_date;
		}
		else
		{
			$out_date = $date;
		}

		$in_time  = $this->in_time_for_four_hur($date, $start_time, $end_time, $table);

		$out_start_time = "$in_date $out_start_time";
		$out_end_time = "$out_date $out_end_time";

		$out_time = $this->out_time_for_four_hur($out_start_time, $out_end_time, $table);

	    if($ot_status == '1'){
			$work_ot_hour = 0;
			$work_eot_hour = 0;
		}else{
		 	//$out_time_x=strtotime($values[$emp_id]["out_time"][$k]);
		 	$out_time_8pm=strtotime('20:00:00');


			//$elapsed = $out_time_x - strtotime($values[$emp_id]["in_time"][$k]);
			$in_time=strtotime($in_time);
			$out_time=strtotime($out_time);
			$elapsed = $out_time - $in_time;
			$elapsed_hour = ($elapsed / 3600);

			if($elapsed_hour > 9){
				//for ramadan (2018-05-18 to 2018-06-17)
				if($date >= '2018-05-18' AND $date <= '2018-06-17'){
					$work_hour = $elapsed_hour - 8.5;
				}
				else{
					$work_hour = $elapsed_hour - 9;
				}
				if($work_hour >= 2){
					$work_ot_hour = 2;//OT=2 Hour
					if ($out_time>$out_time_8pm AND ($date >= '2018-05-18' AND $date <= '2018-06-17')) {//zuel
						$work_eot_hour = floor($work_hour - 3);//(OT=2)+(Iftar=1)=3 Hour
					}
					else{
						//$work_eot_hour = floor($work_hour - 2);//OT=2 Hour
						$work_eot_hour = (int)$work_hour - 2;
					}						
				}
				else{
					//$work_hour = $work_hour;//zuel 10-06-18
					$work_ot_hour = (int)($work_hour);
					$work_eot_hour = 0;
				}
			}
			else{
				$work_ot_hour = 0;
				$work_eot_hour = 0;
			}
		}
			
		$ot_hour = $ot_hour + $work_ot_hour;


		$query = $this->db->select('month_of_ot_eot')->where('emp_id',$emp_id)->where('month_of_ot_eot', $date)->get('four_hour_ot_eot');

		if($query->num_rows() > 0){
			$this->db->where('emp_id',$emp_id); 
			$this->db->where('month_of_ot_eot',$date);
			$this->db->set('work_ot_hour',$work_ot_hour);
			$this->db->set('work_eot_hour',$work_eot_hour);
			$this->db->update('four_hour_ot_eot');
		}
		else{
			$data = array(
				'emp_id' 		=> $emp_id,
				'month_of_ot_eot'=> $date,
				'work_ot_hour'	=> $work_ot_hour,
				'work_eot_hour'	=> $work_eot_hour
				);
			$this->db->insert('four_hour_ot_eot', $data);
		}
    }
	  
	function get_no_work_day($emp_id,$att_date)
	{
		$no_work_day = $this->db->where('emp_id',$emp_id)->where('date',$att_date)->get('pd_production_logs')->num_rows();
		if($no_work_day == 0)
		{
			$no_work_day_status = 1;
		}
		else
		{
			$no_work_day_status = 0;
		}
		$data = array(
		"pd_no_work_check" => $no_work_day_status
		);
		$this->db->where("emp_id", $emp_id);
		$this->db->where("shift_log_date", $att_date);
		$this->db->update("pr_emp_shift_log", $data);
		return;
	}
	function resig_or_left_date($emp_id)
	{
		$this->db->select("left_date");
		$this->db->where('emp_id',$emp_id);
		$query = $this->db->get("pr_emp_left_history");
		$row = $query->row();
		if($query->num_rows() > 0)
		{
			return true;
		}


		$this->db->select("resign_date");
		$this->db->where('emp_id',$emp_id);
		$query = $this->db->get("pr_emp_resign_history");
		$row = $query->row();
		if($query->num_rows() > 0)
		{
			return true;
		}
	}

	function insert_extra_ot_hour($emp_id, $att_date, $extra_ot_hour){
		$extra_ot_hour_old=$extra_ot_hour;
		$ot_status = $this->db->select('ot_entitle')->where('emp_id',$emp_id)->get('pr_emp_com_info')->row()->ot_entitle;
		
		
		$night_allwance = $this->db->select('night_allo')->where('emp_id',$emp_id)->where('shift_log_date',$att_date)->get('pr_emp_shift_log')->row()->night_allo;

		//Zuel Ali 17/08/19
		if($night_allwance == "1"){
			$unit_id = $this->db->select('unit_id')->where('emp_id',$emp_id)->get('pr_emp_com_info')->row()->unit_id;
			
			$night_deduct_hour = $this->db->select('deduct_hour')->where('unit_id',$unit_id)->get('pr_night_rules')->row()->deduct_hour;
			
			//Zuel Only for Ramadan - 2019-05
			if($att_date >= '2019-05-07' && $att_date <= '2019-06-06' && ($unit_id=='1' || $unit_id=='3')){
				$night_deduct_hour=1;
			} 

			//$extra_ot_hour = $extra_ot_hour - $night_deduct_hour; // comment the line 17-04-2022 for ramadan

			// 17-04-2022
			// new code add for ramadan 
			$ramadan_month1 = "2022-04-03";
			$ramadan_month2 = "2022-05-02";
			// echo $extra_ot_hour ." = ";
			if($att_date >= $ramadan_month1 and $att_date <= $ramadan_month2 && $unit_id == '2'){
				$extra_ot_hour = $extra_ot_hour;
			} else {
				// $extra_ot_hour = $extra_ot_hour - $night_deduct_hour;
				$extra_ot_hour = $extra_ot_hour - $night_deduct_hour;
			}
			// end ramadan new code 17-04-2022

		}

		if($ot_status == 0){
			if($extra_ot_hour_old>=5){
            	$ot_eot_12am = 5;
	        }else{
	            $ot_eot_12am = $extra_ot_hour;
	        }
			
			if($extra_ot_hour>=2){
            	$ot_eot_4pm = 2;
	        }else{
	            $ot_eot_4pm = $extra_ot_hour;
	        }
			
		   $data = array(
					"extra_ot_hour" => $extra_ot_hour,
					"ot_eot_12am" => $ot_eot_12am,
					"ot_eot_4pm" => $ot_eot_4pm
				);
		} else{
		   $data = array(
					"extra_ot_hour" => 0,
					'deduction_hour'=> 0,
					'modify_eot'=> 0,
					"ot_eot_12am" => 0,
					"ot_eot_4pm" => 0
				);
		}

			// echo "<pre>";
			// print_r( $data);

			// echo $extra_ot_hour ." = "; die;

		$this->db->where("emp_id", $emp_id);
		$this->db->where("shift_log_date", $att_date);
		$this->db->update("pr_emp_shift_log", $data);
		return true;
	}

	function weekend_holday_eot_calculation($emp_id, $date,$status){
		$holiday_allowance_check = 0;
		$weekly_allowance_check = 0;
		$table = "temp_$emp_id";
		$table = strtolower($table);

		$present_count = 0;
		$absent_count = 0;
		$leave_count = 0;
		$ot_count = 0;
		$late_count = 0;

		$this->db->select("pr_emp_com_info.ot_entitle");
		$this->db->from("pr_emp_com_info");
		$this->db->where("pr_emp_com_info.emp_id = '$emp_id'");
		$query1 = $this->db->get();
		$row1 = $query1->row();
		$ot_status  = $row1->ot_entitle;

		$in_time = '';
		$out_time = '';

		$emp_shift = $this->emp_shift_check($emp_id, $date);

		$schedule = $this->schedule_check($emp_shift);
		//print_r($schedule);
		$start_time		=  $schedule[0]["in_start"];
		$late_time 		=  $schedule[0]["late_start"];
		$end_time   	=  $schedule[0]["in_end"];
		$out_start_time	=  $schedule[0]["out_start"];
		$ot_start_time	=  $schedule[0]["ot_start"];
		$out_end_time	=  $schedule[0]["out_end"];

		$hour = trim(substr($out_start_time,0,2));
		$minute = trim(substr($out_start_time,3,2));
		$sec = trim(substr($out_start_time,6,2));

		$am_pm = date("A", mktime($hour, $minute, $sec, 0, 0, 0));
		$in_date = $date;
		$ot_start_time = "$in_date $ot_start_time";
		if($am_pm == "AM"){
			$now = strtotime($in_date);
			$datestr = strtotime("+1 day",$now);
			$in_date = date("Y-m-d", $datestr);
			$in_date = $in_date;
		}
		else{
			$in_date = $date;
		}

		$hour = trim(substr($out_end_time,0,2));
		$minute = trim(substr($out_end_time,3,2));
		$sec = trim(substr($out_end_time,6,2));
		$am_pm = date("A", mktime($hour, $minute, $sec, 0, 0, 0));

		$out_date = $date;
		if($am_pm == "AM"){
			$now = strtotime($out_date);
			$datestr = strtotime("+1 day",$now);
			$out_date = date("Y-m-d", $datestr);
			$out_date = $out_date;
		}

		$in_time  = $this->time_check_in($date, $start_time, $end_time, $table);
		$in_time_date=  $date." ".$in_time;
		$out_start_time = "$in_date $out_start_time";
		$out_end_time = "$out_date $out_end_time";

		$out_time_date = $this->time_check_out2($out_start_time, $out_end_time, $table);
		$workoff_eot_out_date = trim(substr($out_time_date,0,10));
		$out_time = trim(substr($out_time_date,11,19));

		// echo "<pre>"; print_r($out_time_date ." = ". $out_end_time ." = ". $table); exit();
		

		if($in_time == '' or $out_time == ''){
			$weekend_holiday_eot_hour = 0;
			if($status == "h"){
				$holiday_allowance_check = 0;
			 	$weekly_allowance_check = 0;
				$present_status = "H";
			}
			if($status == "w"){
				$holiday_allowance_check = 0;
				$weekly_allowance_check = 0;
				$present_status = "W";


			}
		} else {
			$weekend_holiday_eot_hour = $this->hour_difference($in_time_date, $out_time_date, $emp_id, $date);
			$workoff_eot_lunch_deduct_time 	= $this->get_setup_attributes(7);
			$workoff_eot_lunch_deduct_time 	= "$in_date $workoff_eot_lunch_deduct_time";
			$workoff_eot_out_time 			= "$workoff_eot_out_date $out_time";
			
			if($workoff_eot_lunch_deduct_time <= $workoff_eot_out_time){
				 // for Ramadan
			    if($date >= '2020-04-25' && $date <= '2020-05-24'){
					$workoff_eot_out_time_8pm = "$date 19:00:00";
					if ($workoff_eot_out_time>=$workoff_eot_out_time_8pm){
						// zuel ali 07-06-18
						$weekend_holiday_eot_hour = $weekend_holiday_eot_hour - 2;
					}
					else{
						$weekend_holiday_eot_hour = $weekend_holiday_eot_hour - 1;
					}
				} else{
					$weekend_holiday_eot_hour = $weekend_holiday_eot_hour - 1;
				}
			} else{
				$weekend_holiday_eot_hour = $weekend_holiday_eot_hour; 
			}
				
			//$weekend_holiday_eot_hour = $weekend_holiday_eot_hour;

			//==============Holiday Aloowance======
            $night_allowance = $this->get_night_allowance($date,$out_time,$emp_id);
			if($status == "h"){
				$holiday_allowance_check = 1;
				$night_allowance = 1;
				$weekly_allowance_check = 0;
				$present_status = "H";
			}

			if($status == "w"){
				$holiday_allowance_check = 0;
				$weekly_allowance_check = 1;
				$night_allowance = 1;
				$present_status = "W";
			}
		}

		if($in_time != '' and $out_time != ''){
			$time_diff = (round(abs(strtotime($out_time_date) - strtotime("$in_date 11:50:00pm"))/3600));
			if($out_time >= "23:55:00" || $out_time >= "00:00:01"){
				$night_allowance = $this->get_night_allowance($date,$out_time,$emp_id);
			} else{
				$night_allowance = 0;
		    }
		} else {
			//$tiffin_allowance = 0;
			$night_allowance = 0;
		}

		if($night_allowance == "1"){
			$unit_id = $this->db->select('unit_id')->where('emp_id',$emp_id)->get('pr_emp_com_info')->row()->unit_id;
			$night_deduct_hour = $this->db->select('deduct_hour')->where('unit_id',$unit_id)->get('pr_night_rules')->row()->deduct_hour;

			// extra losig to night hour deduction 02-06-2022
			if ($in_time <= "11:00:00" && $out_time > "17:00:00") {
				$weekend_holiday_eot_hour = $weekend_holiday_eot_hour - $night_deduct_hour;
			} else {
				$weekend_holiday_eot_hour = $weekend_holiday_eot_hour;
			}
		}
		
		if($status=='w'){
			$ot_eot_12am = 0;
			$ot_eot_4pm = 0;
		}
		
		if($ot_status == 1){ 
			$weekend_holiday_eot_hour = 0;
			
			$data = array(
						'in_time' 			=> $in_time,
						'out_time' 			=> $out_time,
						'ot_hour' 			=> 0,
						'extra_ot_hour' 	=> 0,
						'ot_eot_12am' 		=> 0,
						'ot_eot_4pm' 		=> 0,
						'deduction_hour' 	=> 0,
						'late_status' 		=> 0,
						'night_allo' 		=> $night_allowance,
						'present_status' 	=> $present_status,
						'tiffin_allo' 		=> 0,
						'holiday_allowance'	=> $holiday_allowance_check,
						'weekly_allo'		=> $weekly_allowance_check,
						'modify_eot'		=> 0,
						'deduction_hour'	=> 0
					);
		}
		else {
			$data = array(
						'in_time' 			=> $in_time,
						'out_time' 			=> $out_time,
						'ot_hour' 			=> 0,
						'extra_ot_hour' 	=> $weekend_holiday_eot_hour,
						'ot_eot_12am' 		=> $ot_eot_12am,
						'ot_eot_4pm' 		=> $ot_eot_4pm,
						'deduction_hour' 	=> 0,
						'late_status' 		=> 0,
						'night_allo' 		=> $night_allowance,
						'present_status' 	=> $present_status,
						'tiffin_allo' 		=> 0,
						'holiday_allowance'	=> $holiday_allowance_check,
						'weekly_allo'		=> $weekly_allowance_check
					);
		}

		// echo "<pre>"; print_r($data); die();

		$this->db->where('shift_log_date', $date);
		$this->db->where('emp_id', $emp_id);
		$this->db->update('pr_emp_shift_log', $data);
		return true;
	}



	function hour_difference($start_date_time, $end_date_time, $emp_id, $date){
		$start_date_time= strtotime("$start_date_time");
		$end_date_time 	= strtotime("$end_date_time");
		$elapsed 		= $end_date_time - $start_date_time;
		$elapsed_hour 	= floor($elapsed / 3600);

		$elapsed 		-= 3600 * floor($elapsed / 3600);
		$elapsed_min 		= floor($elapsed / 60);

		$emp_shift 	= $this->emp_shift_check($emp_id, $date);
		$schedule 	= $this->schedule_check($emp_shift);
		//print_r($schedule);

		$ot_minutes		=  $schedule[0]["ot_minute_to_one_hour"];

		if($elapsed_min >= $ot_minutes){
			$elapsed_hour = $elapsed_hour + 1;
		}
		return $elapsed_hour;
	}

	function check_weekend($emp_id, $att_date)
	{
		$this->db->select("emp_id");
		$this->db->from("attn_work_off");
		$this->db->where("emp_id", $emp_id);
		$this->db->where("work_off_date", $att_date);
		$query = $this->db->get();
		//echo $this->db->last_query();
		if($query->num_rows() > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	function check_holiday($id, $att_date)
	{
		$this->db->select("emp_id");
		$this->db->from("attn_holiday");
		$this->db->where("emp_id", $id);
		$this->db->where("holiday_date", $att_date);
		$query = $this->db->get();
		//echo $this->db->last_query();
		if($query->num_rows() > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	function ot_hour_calcultation($emp_id, $date){
		$table = "temp_$emp_id";
		$table = strtolower($table);

		$present_count = 0;
		$absent_count = 0;
		$leave_count = 0;
		$ot_count = 0;
		$late_count = 0;

		$this->db->select("pr_emp_com_info.ot_entitle");
		$this->db->from("pr_emp_com_info");
		$this->db->where("pr_emp_com_info.emp_id = '$emp_id'");
		$query1 = $this->db->get();
		$row1 = $query1->row();
		$ot_status  = $row1->ot_entitle;

		$in_time = '';
		$out_time = '';

		$emp_shift = $this->emp_shift_check($emp_id, $date);

		$schedule = $this->schedule_check($emp_shift);
		// print_r($schedule); exit();
		$start_time		=  $schedule[0]["in_start"];
		$late_time 		=  $schedule[0]["late_start"];
		$end_time   	=  $schedule[0]["in_end"];
		$out_start_time	=  $schedule[0]["out_start"];
		$ot_start_time	=  $schedule[0]["ot_start"];
		$out_end_time	=  $schedule[0]["out_end"];

		$hour = trim(substr($out_start_time,0,2));
		$minute = trim(substr($out_start_time,3,2));
		$sec = trim(substr($out_start_time,6,2));

		$am_pm = date("A", mktime($hour, $minute, $sec, 0, 0, 0));
		$in_date = $date;
		$ot_start_time = "$in_date $ot_start_time";
		if($am_pm == "AM"){
			$now = strtotime($in_date);
			$datestr = strtotime("+1 day",$now);
			$in_date = date("Y-m-d", $datestr);
			$in_date = $in_date;
		}
		else{
			$in_date = $date;
		}

		$hour = trim(substr($out_end_time,0,2));
		$minute = trim(substr($out_end_time,3,2));
		$sec = trim(substr($out_end_time,6,2));
		$am_pm = date("A", mktime($hour, $minute, $sec, 0, 0, 0));

		$out_date = $date;
		if($am_pm == "AM"){
			//echo $am_pm;
			$now = strtotime($out_date);
			$datestr = strtotime("+1 day",$now);
			$out_date = date("Y-m-d", $datestr);
			$out_date = $out_date;
		}
		else{
			$out_date = $date;
		}
		//echo $out_end_time;
		$present_check = $this->present_check($date, $emp_id);
		if( $present_check == true){
			$in_time  = $this->time_check_in($date, $start_time, $end_time, $table);
			$out_start_time = "$in_date $out_start_time";
			$out_end_time = "$out_date $out_end_time";

			$out_time = $this->time_check_out2($out_start_time, $out_end_time, $table);
		}
		else{
			$in_time = '';
			$out_time = '';
		}

		if($in_time !=''){
			$hour = trim(substr($in_time,0,2));
			$minute = trim(substr($in_time,3,2));
			$sec = trim(substr($in_time,6,2));
			$time_format = date("h:i:s A", mktime($hour, $minute, $sec, 0, 0, 0));
			$in_time_format = $time_format;
		}
		else{
			$in_time_format='';
		}

		if($out_time !=''){
			$hour = trim(substr($out_time,11,2));
			$minute = trim(substr($out_time,14,2));
			$sec = trim(substr($out_time,17,2));
			$time_format = date("h:i:s A", mktime($hour, $minute, $sec, 0, 0, 0));
			$out_time_format = $time_format;
		}else{
			$out_time_format='';
		}

		$ot_hour= 0;
		if($in_time !='' and $out_time !=''){
			if($ot_status == 0){
				$in_date_time = $out_start_time;
				$ot_hour = $this->hour_difference($ot_start_time, $out_time, $emp_id, $date);
			}
		}

		if($out_time !=''){
			$hour = trim(substr($out_time,11,2));
			$minute = trim(substr($out_time,14,2));
			$sec = trim(substr($out_time,17,2));
			$out_time = date("H:i:s", mktime($hour, $minute, $sec, 0, 0, 0));
		}

		$data["in_time"] = $in_time;
		$data["out_time"] = $out_time;
		$data["ot_hour"] = $ot_hour;
		// echo "<pre>"; print_r($data); exit();
		return $data;
	}

	function insert_ot_hour($emp_id, $date, $ot_hour_calcultation,$present_status){
		$emp_shift = $this->emp_shift_check($emp_id, $date);
		$schedule = $this->schedule_check($emp_shift);
		$start_time		=  $schedule[0]["in_start"];
		$late_time 		=  $schedule[0]["late_start"];
		$end_time   	=  $schedule[0]["in_end"];
		$out_start_time	=  $schedule[0]["out_start"];
		$out_end_time	=  $schedule[0]["out_end"];

		$in_time = '';
		if($ot_hour_calcultation["in_time"] != ''){
			$in_time = $ot_hour_calcultation["in_time"];
		}
		
		$out_time = '';
		if($ot_hour_calcultation["out_time"] != ''){
			$out_time = $ot_hour_calcultation["out_time"];
		}
		
		if($ot_hour_calcultation["ot_hour"] =='' or $ot_hour_calcultation["ot_hour"] <=0){
			$ot_hour = 0;
		}else{
			$ot_hour = $ot_hour_calcultation["ot_hour"];
		}

		$late_status = 0;
		$night_allowance = 0;
		$this->db->select();
		$this->db->where("emp_id", $emp_id);
		$this->db->where("shift_log_date", $date);
		$query = $this->db->get("pr_emp_shift_log");


		if($query->num_rows() > 0){
			if($in_time >= $late_time && $in_time !=''){
				$late_status = 1;
			}

			//===================Night Allowance Check===================
			if($out_time != ''){
				$night_allowance = $this->get_night_allowance($date,$out_time,$emp_id);
			}
			
			$tiffin_allowance = 0;

			$data = array(
						"in_time" 			=> $in_time,
						"out_time" 			=> $out_time,
						"ot_hour" 			=> $ot_hour,
						"late_status" 		=> $late_status,
						"tiffin_allo" 		=> $tiffin_allowance,
						"present_status" 	=> $present_status,
						"night_allo" 		=> $night_allowance,
						"holiday_allowance"	=> 0,
						"weekly_allo" 		=> 0,
						);
			$this->db->where("emp_id", $emp_id);
			$this->db->where("shift_log_date", $date);
			$this->db->update("pr_emp_shift_log", $data);
		}
	}

	function get_tiffin_allowance($out_time,$emp_id)
	{
		$tiffin_allowance_rules 	= $this->get_tiffin_allowance_rules_data();
		$tiffin_time 				= $tiffin_allowance_rules ['tiffin_time'];
		$tiffin_out_time_median 	= date('A', strtotime($tiffin_time));
		$out_time_median 			= date('A', strtotime($out_time));

		if($tiffin_out_time_median != $out_time_median)
		{
			$tiffin_allow 			= 1;
		}
		else
		{
			if($tiffin_time <= $out_time)
			{
				$tiffin_allow 			= 1;
			}
			else
			{
				$tiffin_allow 			= 0;
			}
		}
		return $tiffin_allow;
	}

	function get_night_allowance($date,$out_time,$emp_id){
		$desig_id = $this->db->where("emp_id",$emp_id)->get('pr_emp_com_info')->row()->emp_desi_id;
		$night_allowance_rules = $this->get_night_allowance_rules($desig_id);

		$night_allow  = 0;
		if($night_allowance_rules['msg'] == "OK" ){
			$night_allowance_time = $this->db->where("rules_id",$night_allowance_rules['rules_id'])->get('pr_night_allowance_rules')->row()->night_time;
			
			$date_outtime 	= "$date $out_time";
			$date_nighttime = "$date $night_allowance_time";
			
			$night_out_time_median 		= date('A', strtotime($night_allowance_time));
			$out_time_median 			= date('A', strtotime($out_time));

			if($night_out_time_median == "AM"){
				$tomorrow = date('Y-m-d',strtotime($date . "+1 days"));
				$date_nighttime = "$tomorrow $night_allowance_time";
			}
			if($out_time_median == "AM"){
				$tomorrow2 = date('Y-m-d',strtotime($date . "+1 days"));
				$date_outtime = "$tomorrow2 $out_time";
			}
			if(strtotime($date_nighttime) <= strtotime($date_outtime)){
				$night_allow 	= 1;
			}
		}

		return $night_allow;
	}

	function get_tiffin_allowance_rules_data(){
		$this->db->select('*');
		$this->db->from('pr_tiffin_bill');
		$this->db->where("id", 1);
		$query = $this->db->get();
		if($query->num_rows()>0)
		{
			$row = $query->row();
			$data['tiffin_time'] = $row->tiffin_time;
			$data['tiffin_amount'] = $row->amount;
		}

		return  $data;
	}
	function get_night_allowance_rules($desig_id){
		$this->db->select('rules_id');
		$this->db->from('pr_night_allowance_level');
		$this->db->where("desig_id", $desig_id);
		$query = $this->db->get();
		if($query->num_rows()>0){
			$row = $query->row();
			$data['rules_id'] = $row->rules_id;
			$data['msg'] = "OK";
		}else{
			$rules_id = 0;
			$data['msg'] = "NULL";
		}

		return $data;
	}
	function get_night_allowance_check($out_time)
	{
		$night_allowance_check = $this->get_setup_attributes(8);
		if($out_time >= $night_allowance_check)
		{
			$night_allowance_status = 1;
		}
		else
		{
			$night_allowance_status = 0;
		}
		return $night_allowance_status;
	}
	function holiday_calculation($date)
	{
		$this->db->select("holiday_date");
		$this->db->where("holiday_date = '$date'");
		$query = $this->db->get("attn_holiday");
		if($query->num_rows > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	function emp_shift_check_process($emp_id, $att_date){
		$this->db->select("shift_id, shift_duty");
		$this->db->from("pr_emp_shift_log");
		$this->db->where("emp_id", $emp_id);
		$this->db->where("shift_log_date", $att_date);
		$query = $this->db->get();

		if($query->num_rows() > 0 ){
			/*foreach($query->result() as $row){
				$shift_duty = $row->shift_duty;
			}*/
			$shift_duty = $query->row()->shift_duty;

			$this->db->select("sh_type");
			$this->db->from("pr_emp_shift_schedule");
			$this->db->where("shift_id", $shift_duty);
			$query1 = $this->db->get();
			$row = $query1->row();
			return $row->sh_type;
		} else {
			$this->db->select("pr_emp_shift.shift_id, pr_emp_shift.shift_duty, pr_emp_shift_schedule.sh_type");
			$this->db->from("pr_emp_shift");
			$this->db->from("pr_emp_shift_schedule");
			$this->db->from("pr_emp_com_info");
			$this->db->where("pr_emp_com_info.emp_id", $emp_id);
			$this->db->where("pr_emp_shift.shift_id = pr_emp_com_info.emp_shift");
			$this->db->where("pr_emp_shift_schedule.shift_id = pr_emp_shift.shift_duty");
			$query2 = $this->db->get()->row();

			$shift_id = $query2->shift_id;
			$shift_duty = $query2->shift_duty;
			$sh_type = $query2->sh_type;
			$data = array(
							'emp_id' 		 => $emp_id,
							'shift_id' 		 => $shift_id,
							'shift_duty' 	 => $shift_duty,
							'shift_log_date' => $att_date,
							'modify_eot'     => 0,
			);

			$this->db->insert("pr_emp_shift_log", $data);
			return $sh_type;
		}
	}

	function schedule_check($emp_shift){
		$this->db->where("sh_type", $emp_shift);
		$query = $this->db->get("pr_emp_shift_schedule");
		return $query->result_array();
	}

	function emp_shift_check($emp_id, $att_date){
		$this->db->select("shift_id, shift_duty");
		$this->db->from("pr_emp_shift_log");
		$this->db->where("emp_id", $emp_id);
		$this->db->where("shift_log_date", $att_date);
		$query = $this->db->get();

		if($query->num_rows() > 0 ){
			foreach($query->result() as $row){
				$shift_duty = $row->shift_duty;
			}

			$this->db->select("sh_type");
			$this->db->from("pr_emp_shift_schedule");
			$this->db->where("shift_id", $shift_duty);
			$query1 = $this->db->get();
			//echo "$emp_id=".$this->db->last_query();
			$row = $query1->row();
			return $row->sh_type;
		}
		else{
			$this->db->select("pr_emp_shift_schedule.sh_type");
			$this->db->from("pr_emp_shift_schedule");
			$this->db->from("pr_emp_shift");
			$this->db->from("pr_emp_com_info");
			$this->db->where("pr_emp_com_info.emp_id", $emp_id);
			$this->db->where("pr_emp_shift.shift_id = pr_emp_com_info.emp_shift");
			$this->db->where("pr_emp_shift.shift_duty = pr_emp_shift_schedule.shift_id");
			$query = $this->db->get();
			//echo $this->db->last_query();
			$row = $query->row();
			return $row->sh_type;
		}
	}

	function present_check($date, $emp_id)
	{
		//echo $date;
		$year  = trim(substr($date,0,4));
		$month = trim(substr($date,5,2));
		$day   = trim(substr($date,8,2));
		$date_field = "date_$day";
		$att_month = $year."_".$month."-00";

		$this->db->select($date_field);
		$this->db->where("emp_id", $emp_id);
		$this->db->where("att_month", $att_month);
		$this->db->where($date_field, "P");
		$query = $this->db->get("pr_attn_monthly");
		if($query->num_rows() > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	function time_check_in_old_18_09_2022($date, $start_time, $end_time, $table)
	{
		$this->db->select("date_time");
		$this->db->where("trim(substr(date_time,1,10)) = '$date'");
		$this->db->where("trim(substr(date_time,11,19)) BETWEEN '$start_time' and '$end_time'");
		$this->db->order_by("date_time","ASC");
		$this->db->limit("1");
		$query = $this->db->get($table);
		$time ="";
		foreach ($query->result() as $row)
		{
			$time = $row->date_time;
		}
		$time = trim(substr($time,11,19));
		return $time;
	}

	function time_check_in($start_time, $end_time, $emp_id, $order_by, $table){
		$this->db->select("date_time");
		$this->db->from($table);

		$this->db->where("$table.proxi_id",$emp_id);
		$this->db->where("date_time BETWEEN '$start_time' and '$end_time'");
		$this->db->order_by("date_time",$order_by);
		$this->db->limit("1");
		$query = $this->db->get();
		// exit('X'.$query->num_rows());
		// dd($start_time."".);
		if ($query->num_rows() > 0) {
			return $query->row()->date_time;
		}else{
			return '';
		}
	}
	
	function in_time_for_four_hur($date, $start_time, $end_time, $table)
	{
		$this->db->select("date_time");
		$this->db->where("trim(substr(date_time,1,10)) = '$date'");
		$this->db->where("trim(substr(date_time,11,19)) BETWEEN '$start_time' and '$end_time'");
		$this->db->order_by("date_time","ASC");
		$this->db->limit("1");
		$query = $this->db->get($table);
		$time ="";
		foreach ($query->result() as $row)
		{
			$time = $row->date_time;
		}
		//$time = trim(substr($time,11,19));
		return $time;
	}

	function time_check_out($date, $start_time, $end_time, $table)
	{
		$this->db->select("date_time");
		$this->db->where("trim(substr(date_time,1,10)) = '$date'");
		$this->db->where("trim(substr(date_time,11,19)) BETWEEN '$start_time' and '$end_time'");
		$this->db->order_by("date_time","DESC");
		$this->db->limit("1");
		$query = $this->db->get($table);
		$time ="";
		foreach ($query->result() as $row)
		{
			$time = $row->date_time;
		}
		//$time = trim(substr($time,11,19));
		return $time;
	}

	function time_check_out2($start_time, $end_time, $table)
	{
		$this->db->select("date_time");
		//$this->db->where("trim(substr(date_time,1,10)) = '$date'");
		$this->db->where("date_time BETWEEN '$start_time' and '$end_time'");
		$this->db->order_by("date_time","DESC");
		$this->db->limit("1");
		$query = $this->db->get($table);
		//echo $this->db->last_query();exit();
		$time ="";
		foreach ($query->result() as $row)
		{
			$time = $row->date_time;
		}
		//$time = trim(substr($time,11,19));
		return $time;
	}
	
	function out_time_for_four_hur($start_time, $end_time, $table)
	{
		$this->db->select("date_time");
		//$this->db->where("trim(substr(date_time,1,10)) = '$date'");
		$this->db->where("date_time BETWEEN '$start_time' and '$end_time'");
		$this->db->order_by("date_time","DESC");
		$this->db->limit("1");
		$query = $this->db->get($table);
		//echo $this->db->last_query();exit();
		$time ="";
		foreach ($query->result() as $row)
		{
			$time = $row->date_time;
		}
		//$time = trim(substr($time,11,19));
		return $time;
	}

	function earn_leave_process($input_date)
	{
		// Start Automatic Earn Leave Entry
		// ================================
		$this->earn_automatic_entry();
		// End Automatic Earn Leave Entry

		$current_date = date("Y-m-d");
		$date = strtotime(date("Y-m-d", strtotime($current_date)) . " -17 day");
		$newdate = date('Y-m-d', $date);

		$where="last_update NOT BETWEEN '$newdate' and '$current_date'" ;
		$this->valid_earn_leave_process($where);

		$year = date('Y');
		$end_date_year = $year."-12-31";
		if($current_date == $end_date_year)
		{
			$where1="last_update  BETWEEN '$newdate' and '$current_date'" ;
			$this->valid_earn_leave_process($where1);
		}

		//Start Year change activity
		//===========================
		$this->db->select('emp_id,last_update');
		$query=$this->db->get('pr_leave_earn');

		foreach ($query->result() as $row)
		{
			$empid = $row-> emp_id;
			$last_update = $row-> last_update;
			$current_year = date("Y");
			$last_update_year = date("Y", strtotime($last_update));
			if($current_year > $last_update_year)
			{
				$this->year_change($empid);
			}
			$max_earn = $this->get_max_earn();
			$this->max_earn_check($empid,$max_earn);

		}
		//End Year change activity
	}

	function earn_automatic_entry()
	{

		$this->db->select('emp_id,emp_join_date');
		$this->db->where("emp_cat_id","1");
		//$this->db->where("emp_id","01010");
		$query = $this->db->get('pr_emp_com_info');
		foreach($query->result() as $rows)
		{
			$empid = $rows->emp_id;
			$join_date = $rows->emp_join_date;
			//$join_date ="2011-11-30";
			//echo $join_date;
			$earn_join_date =  strtotime(date("Y-m-d", strtotime($join_date)) . " +1 year");

			$earn_current_date = strtotime(date("Y-m-d"));
			if($earn_join_date < $earn_current_date)
			{
				$num_row = $this->db->where('emp_id',$empid)->get('pr_leave_earn')->num_rows();
				if ($num_row < 1)
				{
					//echo "----true";
					$data = array(
					'emp_id' => $empid ,
					'old_earn_balance' => "0",
					'current_earn_balance' =>"0",
					"last_update"  => date("Y-m-d")
					);
					$this->db->insert('pr_leave_earn', $data);
				}
			}
		}
	}

	function valid_earn_leave_process($where)
	{

		$current_date = date("Y-m-d");
		$this->db->select('*');
		$this->db->where($where);
		$query=$this->db->get('pr_leave_earn');
		foreach ($query->result() as $row)
		{

			$emid = $row-> emp_id;
			//echo $emid."***";
			$last_update = $row-> last_update;
			$data["emp_id"][] = $emid;
			$data["last_update"][] = $last_update;
			if($last_update != $current_date)
			{
				$result = $this->earn_present_check($emid,$last_update,$current_date);
			}
		}

	}

	function earn_present_check($empid,$last_update,$current_date)
	{

		$day = $this->get_date_to_date_day_differance($last_update,$current_date);
		//echo "$empid,$last_update,$current_date, $day";
		$count = 0;

		for($i=0;$i<=$day;$i++)
		{
			//$last_update= "2012-06-01";
			$date = strtotime(date("Y-m-d", strtotime($last_update)) . " +$i day");
			$newdate = date('Y-m-d', $date);

			$result = $this->present_check($newdate, $empid);
			if($result == true)
			{
				$count = $count + 1;
			}
			//echo $newdate."<br/>";

		}

		//echo $count;
		if ($count!=0)
		{

			$count = round(($count/18),2);
			$this->db->select('current_earn_balance,old_earn_balance');
			$this->db->where("emp_id", $empid);
			$query = $this->db->get('pr_leave_earn');
			$rows = $query->row();
			$old_earn_balance = $rows->old_earn_balance;
			$current_earn_balance = $rows->current_earn_balance;
			$current_earn_balance = $current_earn_balance + $count;
			$data = array(
               'current_earn_balance' => $current_earn_balance,
			   'last_update'  => date('Y-m-d')
            );
			$this->db->where("emp_id",$empid);
			$this->db->update('pr_leave_earn', $data);
		}

	}

	function get_date_to_date_day_differance($date1,$date2)
	{
		$date_diff 		= strtotime($date2)-strtotime($date1);
		//DATE TO DATE RULE
		return $month 	= floor(($date_diff)/60/60/24);
	}

	function year_change($empid)
	{
		//echo $query ->num_rows();

		$this->db->select('*');
		$this->db->where("emp_id", $empid);
		$query = $this->db->get('pr_leave_earn');

		foreach ($query->result() as $row)
		{
			$old_earn_lv_balance = $row ->old_earn_balance;
			$current_earn_lv_balance = $row -> current_earn_balance;
		}

		$old_earn_lv_balance = $old_earn_lv_balance + $current_earn_lv_balance;
		//echo $old_earn_lv_balance ;
		$data = array(
			'old_earn_balance' => $old_earn_lv_balance,
			'current_earn_balance' => "0.00",
			'last_update'  => date('Y-m-d')
		);
		$this->db->where("emp_id",$empid);
		$this->db->update('pr_leave_earn', $data);

	}

	function max_earn_check($empid,$max_earn)
	{
		$this->db->select('old_earn_balance');
		$this->db->where("emp_id", $empid);
		$query = $this->db->get('pr_leave_earn');
		foreach ($query->result() as $row)
		{
			$old_earn_balance = $row->old_earn_balance;
		}

		if($old_earn_balance > $max_earn)
		{
			$data = array(
				'old_earn_balance' => $max_earn
			);
			$this->db->where("emp_id",$empid);
			$this->db->update('pr_leave_earn', $data);
		}
	}

	function get_max_earn()
	{
		$this->db->select('max_earn');
		$query_max_earn = $this->db->get('pr_leave_earn_max');
		$rows = $query_max_earn->row();
		$max_earn  = $rows->max_earn ;
		return $max_earn;
	}

	function deduction_hour_process($emp_id,$att_date){
		$this->db->select('*');
		$this->db->where("shift_log_date",$att_date);
		$this->db->where("emp_id",$emp_id);
		$query = $this->db->get('pr_emp_shift_log');


		foreach ($query->result() as $row){
			$emp_id = $row->emp_id;
			$shift_id = $row->shift_id;
			$out_time = $row->out_time;
			$shift_out_time = $this->get_shift_out_time($shift_id);
			$ot_status = $this->db->select('ot_entitle')->where('emp_id',$emp_id)->get('pr_emp_com_info')->row()->ot_entitle;
			
			if($out_time !="00:00:00"){
				$new_shift_out_time = date("h:i:s A", strtotime($shift_out_time));
				$date_shift_out_time = $att_date." ".$new_shift_out_time;

				$new_out_time = date("h:i:s A", strtotime($out_time));

				$first_out_time=trim(substr($new_out_time,9,2));


				if(trim(substr($new_shift_out_time,9,2)) == $first_out_time){
					$date_out_time = $att_date." ".$new_out_time;

				}else{
					 $att_date_new = strtotime(date("Y-m-d", strtotime($att_date)) . " +1 day");
					 $newdate = date ( 'Y-m-d' , $att_date_new );
					 $date_out_time = $newdate." ".$new_out_time;
				}

				 //echo $date_shift_out_time."---".$date_out_time;
				if(strtotime($date_shift_out_time) > strtotime($date_out_time)){

					$date1 = new DateTime($date_shift_out_time);
					$date2 = new DateTime($date_out_time);
					$interval = $date1->diff($date2);
					$hour =  $interval->h;
					$min =  $interval->i;
					
					if($min > 40){
						$hour = $hour + 1;
					}

					if($hour > 1) $hour = 3; else $hour = 0;

					if($ot_status == 1){
						$hour = 0;
					}
					
					$data = array(
						'deduction_hour' => 0
					);

					$this->db->where("emp_id",$emp_id);
					$this->db->where("shift_log_date",$att_date);
					$this->db->update('pr_emp_shift_log', $data);
				}else{
					$hour=0;
					$min = 0;
					$data = array(
						'deduction_hour' => 0
					);
					$this->db->where("emp_id",$emp_id);
					$this->db->where("shift_log_date",$att_date);
					$this->db->update('pr_emp_shift_log', $data);
				}
			}else{
				$hour=0;
				$min = 0;
			}
		}
	}
	

	function get_shift_out_time($shift_id)
	{
		$this->db->select('*');
		$this->db->where("shift_id",$shift_id);
		$query = $this->db->get('pr_emp_shift_schedule');
		$rows = $query->row();
		$end_time = $rows->ot_start;
		return $end_time;
	}

	function get_setup_attributes($setup_id)
	{
		$this->db->select('value');
		$this->db->where("id",$setup_id);
		$query = $this->db->get('pr_setup');
		$rows = $query->row();
		$setup_value = $rows ->value;
		return $setup_value;
	}

	function monthly_attendance_table_existance_check($process_date)
	{
		$first_y	= date('Y', strtotime($process_date));
		$first_m	= date('m', strtotime($process_date));
		$first_d	= date('d', strtotime($process_date));

		$att_table			= "att_".$first_y."_".$first_m;
		$date_field			= '.date_time';
		$prox_id_field		= '.proxi_id';
		$select				= $att_table.$date_field;
		$w_table_prox_id	= $att_table.$prox_id_field;

		if (!$this->db->table_exists($att_table) )
		{
		 	return false;
		}
		else
		{
			return true;
		}
	}

	function make_attendance_table_name_monthly($process_date)
	{
		$first_y	= date('Y', strtotime($process_date));
		$first_m	= date('m', strtotime($process_date));
		$first_d	= date('d', strtotime($process_date));

		return $att_table	= "att_".$first_y."_".$first_m;
	}

	function get_all_employee($grid_emp_id){
		$this->db->select('pr_emp_per_info.emp_id, pr_emp_per_info.emp_full_name, pr_designation.desig_name, pr_emp_shift.shift_duty,pr_emp_com_info.ot_entitle, pr_emp_com_info.emp_desi_id');
		$this->db->from('pr_emp_per_info');
		$this->db->from('pr_emp_com_info');
		$this->db->from('pr_designation');
		$this->db->from('pr_emp_shift');
		$this->db->where_in("pr_emp_com_info.emp_id",$grid_emp_id);
		//$this->db->where("pr_emp_per_info.emp_id",'2005432');
		// $this->db->where("pr_emp_per_info.emp_id",'1002974'); //ali
		$this->db->where("pr_emp_per_info.emp_id = pr_emp_com_info.emp_id");
		$this->db->where("pr_emp_com_info.emp_desi_id = pr_designation.desig_id");
		$this->db->where("pr_emp_com_info.emp_shift = pr_emp_shift.shift_id");
		$this->db->order_by("pr_emp_com_info.emp_id");
		return $query = $this->db->get();
		//echo $this->db->last_query();exit;
	}

	function check_joining($id, $att_date)
	{
		$this->db->select('emp_id,emp_join_date');
		$this->db->where('emp_id',$id);
		$this->db->where('emp_join_date <=',$att_date);
		$query = $this->db->get('pr_emp_com_info');
		//echo $this->db->last_query();
		if($query->num_rows() > 0)
		return true;
		else
		return false;
	}

	function check_resign($id, $att_date)
	{
		$this->db->select('emp_id,resign_date');
		$this->db->where('emp_id',$id);
		$this->db->where('resign_date <',$att_date);
		$query = $this->db->get('pr_emp_resign_history');
		//echo $this->db->last_query();
		if($query->num_rows() == 0)
		return true;
		else
		return false;
	}

	function check_left($id, $att_date)
	{
		$this->db->select('emp_id,left_date');
		$this->db->where('emp_id',$id);
		$this->db->where('left_date <',$att_date);
		$query = $this->db->get('pr_emp_left_history');
		//echo $this->db->last_query();
		if($query->num_rows() == 0)
		return true;
		else
		return false;
	}

	function insert_monthly_machine_data_to_temp_table($emp_id, $process_date)
	{
		//echo "hey";
		$temp_table = "temp_$emp_id";
		$temp_table = strtolower($temp_table);

		$att_table 	= $this->make_attendance_table_name_monthly($process_date);
		//echo $process_date;
		$this->db->select();
		$this->db->from($att_table);
		// $this->db->from('pr_id_proxi');
		// $this->db->where("$att_table.proxi_id = pr_id_proxi.proxi_id");
		$this->db->where("$att_table.proxi_id  = '$emp_id'");
		$this->db->where("$att_table.date_time  like '$process_date%'");
		$query = $this->db->get();
		//echo $this->db->last_query();
		foreach($query->result() as $rows)
		{
			$this->db->select();
			$this->db->where("device_id  = '$rows->device_id'");
			$this->db->where("proxi_id  = '$rows->proxi_id'");
			$this->db->where("date_time  = '$rows->date_time'");
			$this->db->from($temp_table);
			$query = $this->db->get();
			if($query->num_rows == 0)
			{
				$temp_data = array(
									'device_id' => $rows->device_id,
									'proxi_id' => $rows->proxi_id,
									'date_time' => $rows->date_time
									);
				$this->db->insert($temp_table,$temp_data);
			}
		}
	}

	function create_row_for_attendance_monthly($emp_id, $process_date)
	{
		$year_month = date('Y-m', strtotime($process_date));
		$year_month = "$year_month-00";
		$this->db->select("emp_id");
		$this->db->where("emp_id", $emp_id);
		$this->db->where("att_month",$year_month);
		$query = $this->db->get("pr_attn_monthly");
		if($query->num_rows() ==0)
		{
			$data = array( "emp_id" => $emp_id, 'att_month' => $year_month );
			$this->db->insert("pr_attn_monthly",$data);
		}
	}
	
	function attn_delete_for_eligibility_failed($emp_id, $att_date)
	{
		$this->db->select('emp_id');
		$this->db->where('emp_id',$emp_id);	
		$this->db->where('shift_log_date',$att_date);
		$query = $this->db->get('pr_emp_shift_log');	
		if($query->num_rows() > 0 )
		{
			$this->db->where('emp_id',$emp_id);	
			$this->db->where('shift_log_date',$att_date);
			$this->db->delete('pr_emp_shift_log');		
		}
	}
}