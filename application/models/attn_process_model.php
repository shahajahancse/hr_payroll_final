<?php
 error_reporting(0);
class Attn_process_model extends CI_Model{

	function __construct()
	{
		parent::__construct();

		/* Standard Libraries */
		ini_set('memory_limit', -1);
		ini_set('max_execution_time', 0);
	    set_time_limit(0);
		$this->load->model('file_process_model');
	}

	function prox_id($empid)
	{
		$proxi_id = array();
		$this->db->select('proxi_id');
		$this->db->where_in('emp_id',$empid);
		$query = $this->db->get('pr_id_proxi');
		foreach ($query->result() as $rows)
		{
			$proxi_id[] = $rows->proxi_id;
		}
			return $proxi_id;
	}

	function attn_process($process_date,$unit,$grid_emp_id){
		$result 	= array();
		//MAKE YEAR,MONTH,DAY FROM INPUT DATE
		$first_y	= date('Y', strtotime($process_date));
		$first_m	= date('m', strtotime($process_date));
		$first_d	= date('d', strtotime($process_date));

		//CREATE END OF THE MONTH
		$last_date 	= date("t", mktime(0, 0, 0, $first_m, 1, $first_y));

		//DECLARE FILE PROCESS FUNCTION FOR ATTENDANCE PROCESS
		$proxi = $this->prox_id($grid_emp_id);
		//print_r($proxi);exit;
		$this->file_process_model->file_process_for_attendance($process_date,$unit,$proxi);  //on 2022
		$att_date = $process_date;
		//exit;
		//MONTHLY ATTENDANCE TABLE EXISTANCE CHECK
		$monthly_attendance_table_existance_check = $this->monthly_attendance_table_existance_check($process_date);

		//IF THE CONDITION IS FALSE THE WHOLE PROCESS WILL STOP AND SHOW THIS MESSAGE
		if ($monthly_attendance_table_existance_check == false ){
		 	return "Selected month does not exist and change your process month";
		}

		//MAKE ATTEANDANCE TABLE NAME MONTHLY
		$att_table 	= $this->make_attendance_table_name_monthly($process_date);

		//GET ALL EMPLOYEE INCLUDING REGULER,NEW,RESIGN,LEFT,PROMOTED
		$all_employee = $this->get_all_employee($grid_emp_id);
		//===================================================
		$year_month = date("Y-m", mktime(0, 0, 0, $first_m, 1, $first_y));
		$year_month = $year_month."-01";
		//===================================================
		$i = 0; $j = 0;
		foreach ($all_employee->result() as $rows){
			$emp_id			= $rows->emp_id;

			//PROCESS ELIGIBILITY CHECK AFTER JOINING AND BEFORE RESIGN OR LEFT
			$joining_check 	= $this->check_joining($emp_id, $process_date);
			$resign_check 	= $this->check_resign($emp_id, $process_date);
			$left_check 	= $this->check_left($emp_id, $process_date);

			//IF ANY CONDITION IS FALSE THEN ID WILL NOT GO TO THE CORE PROCESS
			if($joining_check == false or $resign_check == false or $left_check == false){
				$attn_delete = $this->attn_delete_for_eligibility_failed($emp_id, $att_date);
				$i++;
			}else{
				$j++;
				//GET CURRENT SHIFT INFORMATION
				$shift_duty = $rows->shift_duty;

				//WEEKEND CHECK FOR SPECIFIC ID: RETURN TRUE OR FALSE
				//$this->increment_entry_auto($emp_id, $process_date);
				$weekend 	= $this->check_weekend($emp_id, $process_date);
				$holiday = $this->check_holiday($emp_id, $att_date);

				//-------  Out Punch Process for Previous Date ---- Zuel ALi 20-03-2019 -------
				// $process_prev_date = date('Y-m-d',strtotime('-1 day',strtotime($process_date)));
				// $machine_data_prev = $this->insert_monthly_machine_data_to_temp_table($emp_id, $process_prev_date);
				//------- Previous Date Out Punch Process -----------

				$machine_data = $this->insert_monthly_machine_data_to_temp_table($emp_id, $process_date);
				//exit;
				//===================================================
				$temp_table = "temp_$emp_id";
				$temp_table = strtolower($temp_table);
				//===================================================

				//CREATE A ROW INTO pr_attn_monthly TABLE IF NOT EXIST
				$this->create_row_for_attendance_monthly($emp_id, $process_date);

				$ot_hour = 0;
				//sleep(1);

				$date_field='.date_time';
				$prox_id_field='.proxi_id';
				$select=$temp_table.$date_field;
				// print_r($select);exit('asdasd');

				$emp_shift = $this->emp_shift_check_process($emp_id, $att_date);

				//$emp_shift = $this->emp_shift_check($emp_id);

				$schedule = $this->schedule_check($emp_shift);
				//print_r($schedule);
				$start_time	=  $schedule[0]["in_start"];
				$end_time   =  $schedule[0]["in_end"];
				$out_start_time = $schedule[0]["out_start"];
                $out_end_time = $schedule[0]["out_end"];

				$date = "date_$first_d";
				$date1 = date("Y-m-d", mktime(0, 0, 0, $first_m, $first_d, $first_y));
				/*$this->db->select($select);
				$this->db->from($temp_table);
				$this->db->where("trim(substr($select,1,10)) = '$date1' ");
				$this->db->where("trim(substr($select,11,14)) BETWEEN '$start_time' and '$end_time'");

				$query = $this->db->get();*/
				//echo $this->db->last_query() ;

				//if($query->num_rows() == 0){
				$am_pm = date("A", strtotime($out_end_time));

                    $out_date = $process_date;
                    if ($am_pm == "AM") {
                        $now = strtotime($out_date);
                        $datestr = strtotime("+1 day", $now);
                        $out_date = date("Y-m-d", $datestr);
                        $out_date = $out_date;
                    }else{
                        $out_date = $process_date;
                    }
                    $out_start_time = "$process_date $out_start_time";
                    $out_end_time = "$out_date $out_end_time";
                    $in_time = $this->time_check_in($process_date, $start_time, $end_time, $temp_table);
                    $out_time = $this->time_check_out2($out_start_time, $out_end_time, $temp_table);

                    if ($in_time == '' and $out_time == ''){
					$this->db->select("leave_type");
					$this->db->where("emp_id",$emp_id);
					$this->db->where("start_date",$process_date);
					$query = $this->db->get("pr_leave_trans");

					if($query->num_rows() > 0){
						$result[$emp_id] = "L";
						$ppp = array( $date => $result[$emp_id]);
						$this->db->where("emp_id",$emp_id);
						$this->db->where("att_month",$year_month);
						$this->db->update("pr_attn_monthly",$ppp);
					}elseif ($process_date == $holiday){
						$result[$emp_id] = "H";

						$hhh = array( $date => $result[$emp_id]);
						$this->db->where("emp_id",$emp_id);
						$this->db->where("att_month",$year_month);
						$this->db->update("pr_attn_monthly",$hhh);
					}
					elseif ($process_date == $weekend){
						$result[$emp_id] = "W";
						$www = array( $date => $result[$emp_id]);
						$this->db->where("emp_id",$emp_id);
						$this->db->where("att_month",$year_month);
						$this->db->update("pr_attn_monthly",$www);
					}else{
						// echo "hi";
						$result[$emp_id] = "A";

						$aaa = array( $date => $result[$emp_id]);
						$this->db->where("emp_id",$emp_id);
						$this->db->where("att_month",$year_month);
						$this->db->update("pr_attn_monthly",$aaa);
					}
				}/*elseif($out_time == ''){
						$result[$emp_id] = "A";

						$aaa = array( $date => $result[$emp_id]);
						$this->db->where("emp_id",$emp_id);
						$this->db->where("att_month",$year_month);
						$this->db->update("pr_attn_monthly",$aaa);
				}*/
				else{
					if ($process_date == $weekend){
						$result[$emp_id] = "W";

						$www = array( $date => $result[$emp_id]);
						$this->db->where("emp_id",$emp_id);
						$this->db->where("att_month",$year_month);
						$this->db->update("pr_attn_monthly",$www);
					}elseif ($process_date == $holiday){
						$result[$emp_id] = "H";

						$hhh = array( $date => $result[$emp_id]);
						$this->db->where("emp_id",$emp_id);
						$this->db->where("att_month",$year_month);
						$this->db->update("pr_attn_monthly",$hhh);
					}else{
						$this->db->select("leave_type");
						$this->db->where("emp_id",$emp_id);
						$this->db->where("start_date",$process_date);
						$query = $this->db->get("pr_leave_trans");
						if($query->num_rows() > 0){
							$result[$emp_id] = "L";
							$ppp = array( $date => $result[$emp_id]);
							$this->db->where("emp_id",$emp_id);
							$this->db->where("att_month",$year_month);
							$this->db->update("pr_attn_monthly",$ppp);
						}else{
							$result[$emp_id] = "P";
							$ppp = array( $date => $result[$emp_id]);
							$this->db->where("emp_id",$emp_id);
							$this->db->where("att_month",$year_month);
							$this->db->update("pr_attn_monthly",$ppp);
						}
					}
				}
				if($process_date == $weekend || $process_date == $holiday){
					if($weekend == 1){
						$status = "W";
					}
					if($holiday == 1){
						$status = "H";
					}

					//=============================Extra OT Calculation=============================
					// $weekend_eot_calculation = $this->weekend_holday_eot_calculation($emp_id, $att_date,$status,$result[$emp_id]); //04-07-2022
					$weekend_eot_calculation = $this->weekend_holday_eot_calculation($emp_id, $att_date, $status);
					// echo "<pre>"; print_r($weekend_eot_calculation); exit;
					//=============================Extra OT Calculation=============================
				}
				else{
					//=================OT CALCULATION============================
					$ot_hour_calcultation = $this->ot_hour_calcultation($emp_id, $att_date);
					// echo "<pre>"; print_r($ot_hour_calcultation); exit;
					$out_time = $ot_hour_calcultation['out_time'];
					if($ot_hour_calcultation["ot_hour"] !=''){
						if($ot_hour_calcultation["ot_hour"] > 2){
							$extra_ot_hour = $ot_hour_calcultation["ot_hour"] - 2 ;
							$ot_hour_calcultation["ot_hour"] = 2;

							//This code use for Ramadan
							$ramadan_month1 = "2015-06-19";
							$ramadan_month2 = "2015-07-19";
							if($att_date >= $ramadan_month1 and $att_date <= $ramadan_month2){
								$out_time_date = "$att_date $out_time";
								$check_time = "20:00:00";
								$check_time_date = "$att_date $check_time";
								if($out_time_date >= $check_time_date){
									//$extra_ot_hour = $extra_ot_hour -1;
								}
							}
						}
						else{
							$extra_ot_hour = 0;
						}
					}
					else{
						$ot_hour_calcultation["ot_hour"] = 0;
						$extra_ot_hour = 0;
					}

					$insert_ot_hour = $this->insert_ot_hour($emp_id, $att_date, $ot_hour_calcultation,$result[$emp_id]);
					if($extra_ot_hour >= 0){
						$insert_extra_ot_hour = $this->insert_extra_ot_hour($emp_id, $att_date, $extra_ot_hour);
					}

					$insert_deduction_hour = $this->deduction_hour_process($emp_id,$att_date);
					//===========OT CALCULATION============================
				}
			}
		}
		return $result;
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

	function insert_extra_ot_hour($emp_id, $att_date, $extra_ot_hour)
	{
		$ot_status = $this->db->select('ot_entitle')->where('emp_id',$emp_id)->get('pr_emp_com_info')->row()->ot_entitle;

		$night_allwance = $this->db->select('night_allo')->where('emp_id',$emp_id)->where('shift_log_date',$att_date)->get('pr_emp_shift_log')->row()->night_allo;

		//echo $night_allwance;

		$eot_leasure_hour = $this->get_setup_attributes(2);
		$eot_leasure_hour = $eot_leasure_hour - 2;

		if($eot_leasure_hour <= $extra_ot_hour)
		{
			// $extra_ot_hour = $extra_ot_hour - 1;
		}

		if($night_allwance == "1")
		{

			$unit_id = $this->db->select('unit_id')->where('emp_id',$emp_id)->get('pr_emp_com_info')->row()->unit_id;

			$night_deduct_hour = $this->db->select('deduct_hour')->where('unit_id',$unit_id)->get('pr_night_rules')->row()->deduct_hour;
			$extra_ot_hour = $extra_ot_hour - $night_deduct_hour;
			//$extra_ot_hour = $extra_ot_hour;
		}

		$staff_id = array();
		$this->db->select("emp_id");
		$this->db->from("staff_ot_list_emp");
		$this->db->where("emp_id", $emp_id);
		$query_staff = $this->db->get();
		// echo $this->db->last_query();
		foreach($query_staff->result() as $staff_row)
		{
			$staff_id[] = $staff_row->emp_id;
		}
		//print_r($staff_id);exit;
		if(in_array($emp_id,$staff_id))
		{
			$staff = true;
		}else{
			$staff = false;
		}

		if($ot_status == 0){
			$data = array(
					"extra_ot_hour" => $extra_ot_hour,
					"extra_ot_hour_actual" 	=> $extra_ot_hour
					);
		}
		else{
			$data = array(
					"extra_ot_hour" => $extra_ot_hour,
					"extra_ot_hour_actual" 	=> $extra_ot_hour,
					'deduction_hour'	=> 0
					// 'modify_eot'		=> 0
					);
		}
		if($staff==1){
			$this->db->where("emp_id", $emp_id);
			$this->db->where("shift_log_date", $att_date);
			$this->db->update("pr_emp_shift_log", $data);
		}
		// print_r($data);
		$this->db->where("emp_id", $emp_id);
		$this->db->where("shift_log_date", $att_date);
		$this->db->where("modify", 0);
		$this->db->update("pr_emp_shift_log", $data);
		//echo $this->db->last_query();
		return true;
	}

	function weekend_holday_eot_calculation($emp_id, $date, $present_status)
	{
		
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
				
		$this->db->select("shift_id, ot_minute_to_one_hour");
		$this->db->from("pr_emp_shift_schedule");
		$this->db->where("sh_type", $emp_shift);
		$query = $this->db->get();
		$row = $query->row();
		$ot_minute_to_one_hour = $row->ot_minute_to_one_hour;
		$shift_id = $row->shift_id;
		
		$this->db->select("shift_id");
		$this->db->from("pr_emp_shift");
		$this->db->where("shift_duty", $shift_id);
		$query = $this->db->get();
		$row = $query->row();
		$shift_duty = $row->shift_id;
			
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
		
		
		$in_time  = $this->time_check_in($date, $start_time, $end_time, $table);
		$in_time_date=  $date." ".$in_time;
		$out_start_time = "$in_date $out_start_time";
		$out_end_time = "$out_date $out_end_time";
		
		$out_time_date = $this->time_check_out2($out_start_time, $out_end_time, $table);
		$out_time = trim(substr($out_time_date,11,19));

		if($in_time == '' or $out_time == '')
		{
			$weekend_holiday_eot_hour = 0;
		}
		else
		{
			$weekend_holiday_eot_hour = $this->hour_differences($in_time_date, $out_time_date, $ot_minute_to_one_hour, $date);	
		}	
		if($weekend_holiday_eot_hour > 5)
		{
			$weekend_holiday_eot_hour = $weekend_holiday_eot_hour -1;
		}					
		
		$this->db->select();
		$this->db->where("emp_id", $emp_id);
		$this->db->where("shift_log_date", $date);
		$query = $this->db->get("pr_emp_shift_log");
		
		//echo $query->num_rows();
					//print_r($data);
					//echo "LATE: ".$late_time;
		if($query->num_rows() > 0)
		{
			$data = array(
				'in_time' => $in_time,
				'out_time' => $out_time,
				'ot_hour' => 0,
				'extra_ot_hour' => $weekend_holiday_eot_hour,
				'ot_hour_actual' => $weekend_holiday_eot_hour,
				'extra_ot_hour_actual' => $weekend_holiday_eot_hour,
				'late_status' => 0,
				'present_status' 	=> $present_status,
			);
			$this->db->where('shift_log_date', $date);
			$this->db->where('emp_id', $emp_id);
			$this->db->update('pr_emp_shift_log', $data);
			//echo $this->db->last_query();
		}
		else
		{
			
			$data = array(
				'emp_id' => $emp_id,
				'in_time' => $in_time,
				'out_time' => $out_time,
				'shift_id' => $shift_id,
				'shift_duty' => $shift_duty,
				'shift_log_date' => $date,
				'ot_hour' => 0,
				'extra_ot_hour' => $weekend_holiday_eot_hour,
				'ot_hour_actual' => $weekend_holiday_eot_hour,
				'extra_ot_hour_actual' => $weekend_holiday_eot_hour,
				'late_status' => 0,
				'present_status' 	=> $present_status,
			);
			$this->db->insert("pr_emp_shift_log", $data);
		}

		return true;
	}

	function hour_differences($start_date_time, $end_date_time, $ot_minute_to_one_hour)
	{
		
		// Update by Shahajahan, 2021-11-07 ---------
		$start_date_time = strtotime("$start_date_time");
		$end_date_time 	= strtotime("$end_date_time");
		$elapsed 		= $end_date_time - $start_date_time;
		$elapsed_hour 	= floor($elapsed / 3600);
		$elapsed 		-= 3600 * floor($elapsed / 3600);    
		$elapsed_min 	= floor($elapsed / 60);

		// echo " = ". $elapsed_hour ." = "; print_r($elapsed); echo(" = ". $elapsed_min); die;

		$min_mint = 20; // Minimum Minute to helf (0.5) OT Count

		if($elapsed_min >= $ot_minute_to_one_hour){ // 50 or more Minuts to 1HR
			$elapsed_hour = $elapsed_hour + 1;
		}
		/*elseif($elapsed_min >= $min_mint AND $elapsed_min < $ot_minute_to_one_hour){ 
			// 20 more and 50 less Minuts to 0.5 HR
			$elapsed_hour = $elapsed_hour + 0.5;
		}*/

		return $elapsed_hour;
		// return $elapsed_hour;
	}
	

	function weekend_holday_eot_calculation_04_07_2022($emp_id, $date,$status,$present_status)
	{
		//echo $emp_id;
		$this->db->select("pr_work_off.replace_val");
		$this->db->from("pr_work_off");
		$this->db->where("pr_work_off.emp_id = '$emp_id'");
		$this->db->where("pr_work_off.work_off_date = '$date'");
		$this->db->where("pr_work_off.replace_val = ", 1);
		$replace_val = $this->db->get();
		$val = $replace_val->row();
		$f_val = $val->replace_val;

		$this->db->select("pr_holiday.replace_val");
		$this->db->from("pr_holiday");
		$this->db->where("pr_holiday.emp_id = '$emp_id'");
		$this->db->where("pr_holiday.holiday_date = '$date'");
		$this->db->where("pr_holiday.replace_val = ", 1);
		$replace_val = $this->db->get();
		$val = $replace_val->row();
		$h_val = $val->replace_val;

		if($f_val==1 || $h_val==1)
		{
			$ot_hour_calcultation = $this->ot_hour_calcultation_for_replace_duty($emp_id, $date);
			$outtime = $ot_hour_calcultation['out_time'];
			if($ot_hour_calcultation["ot_hour"] !=''){
				if($ot_hour_calcultation["ot_hour"] > 2){
					$extra_ot_hour = $ot_hour_calcultation["ot_hour"] - 2 ;
					$ot_hour_calcultation["ot_hour"] = 2;
				}
				else{
					$extra_ot_hour = 0;
				}
			}
			else{
				$ot_hour_calcultation["ot_hour"] = 0;
				$extra_ot_hour = 0;
			}

			$insert_ot_hour = $this->insert_ot_hour($emp_id, $date, $ot_hour_calcultation,$present_status);
			if($extra_ot_hour >= 0){
				$insert_extra_ot_hour = $this->insert_extra_ot_hour($emp_id, $date, $extra_ot_hour);
			}

		   $insert_deduction_hour = $this->deduction_hour_process($emp_id,$date);

			// }else{
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

			$in_time  = $this->time_check_in($date, $start_time, $end_time, $table);
			$in_time_date=  $date." ".$in_time;
			$out_start_time = "$in_date $out_start_time";
			$out_end_time = "$out_date $out_end_time";

			// $out_time_date = $this->time_check_out2($start_time, $out_end_time, $table);
			$out_time_date = $this->time_check_out2($out_start_time, $out_end_time, $table);
			$workoff_eot_out_date = trim(substr($out_time_date,0,10));
			$out_time = trim(substr($out_time_date,11,19));

			if($in_time == '' or $out_time == '')
			{
				$weekend_holiday_eot_hour = 0;
				if($status == "h")
				 {
					$holiday_allowance_check = 0;
				 	$weekly_allowance_check = 0;
				 	$present_status = "H";
				 }
				 if($status == "w")
				 {
					$holiday_allowance_check = 0;
				 	$weekly_allowance_check = 0;
				 	$present_status = "W";
				 }
			}
			else
			{
			   $hour_or_miniute 	= $this->get_setup_attributes(10);
				if($hour_or_miniute == "hour")
				{
					$weekend_holiday_eot_hour = $this->hour_difference($in_time_date, $out_time_date, $emp_id, $date,$status,$in_time);
				}
				else
				{
					$weekend_holiday_eot_hour = $this->minute_difference($in_time_date, $out_time_date, $emp_id, $date,$status,$in_time);
				}

				$workoff_eot_lunch_deduct_time 	= $this->get_setup_attributes(7);
				$workoff_eot_lunch_deduct_time 	= "$in_date $workoff_eot_lunch_deduct_time";
				$workoff_eot_out_time 			= "$workoff_eot_out_date $out_time";

				if($workoff_eot_lunch_deduct_time <= $workoff_eot_out_time)
				{
					$weekend_holiday_eot_hour = $weekend_holiday_eot_hour - 1;
				}
				else
				{
					$weekend_holiday_eot_hour = $weekend_holiday_eot_hour;
				}

				//====================================Holiday Aloowance============================
				 if($status == "h")
				 {
					$holiday_allowance_check = 1;
				 	$weekly_allowance_check = 0;
				 	$present_status = "H";
				 }
				 if($status == "w")
				 {
					$holiday_allowance_check = 0;
				 	$weekly_allowance_check = 1;
				 	$present_status = "W";
				 }
			}

			$this->db->select('modify');
			$this->db->where("emp_id", $emp_id);
			$this->db->where("shift_log_date", $date);
			$this->db->where("modify", 1);
			$query2 = $this->db->get("pr_emp_shift_log");
			// echo $this->db->last_query();
			$modify_sts = $query2->row();
			$modify_sts = $modify_sts->modify;

			if($out_time != '' && $modify_sts==0)
			{
				$night_allowance = $this->get_night_allowance($date,$out_time,$emp_id);

			}elseif($out_time != '' && $modify_sts==1){

				$this->db->select('out_time');
				$this->db->where("emp_id", $emp_id);
				$this->db->where("shift_log_date", $date);
				$query3 = $this->db->get("pr_emp_shift_log");
				$modify_out_time = $query3->row();
				$modify_out_time = $modify_out_time->out_time;

				$night_allowance = $this->get_night_allowance($date,$modify_out_time,$emp_id);
			}
			else
			{
				$night_allowance = 0;
			}

			$data_1 = array(
					"night_allo" => $night_allowance
				);
			// print_r($data_1);
			$this->db->where("emp_id", $emp_id);
			$this->db->where("shift_log_date", $date);
			$this->db->update("pr_emp_shift_log", $data_1);


			//$weekend_holiday_eot_hour."====".$night_allowance;
			if($night_allowance == "1" || $night_allowance == "2")
			{

				$unit_id = $this->db->select('unit_id')->where('emp_id',$emp_id)->get('pr_emp_com_info')->row()->unit_id;

				$night_deduct_hour = $this->db->select('deduct_hour')->where('unit_id',$unit_id)->get('pr_night_rules')->row()->deduct_hour;


				$weekend_holiday_eot_hour = $weekend_holiday_eot_hour - $night_deduct_hour;
			}

			if($ot_status == 1){
				$weekend_holiday_eot_hour = 0;

				$data = array(
					'in_time' 			=> $in_time,
					'out_time' 			=> $out_time,
					'ot_hour' 			=> 0,
					'ot_hour_actual' 	=> 0,
					'extra_ot_hour' 	=> 0,
					'extra_ot_hour_actual'=> 0,
					'deduction_hour' 	=> 0,
					'late_status' 		=> 0,
					'night_allo' 		=> $night_allowance,
					//'night_allo_2nd' 	=> $night_allowance['night_allow_2nd'],
					'present_status' 	=> $present_status,
					'tiffin_allo' 		=> 0,
					'holiday_allowance'	=> $holiday_allowance_check,
					'weekly_allo'		=> $weekly_allowance_check,
					// 'modify_eot'		=> 0,
					'deduction_hour'	=> 0
				);

			} else {
				$data = array(
					'in_time' 			=> $in_time,
					'out_time' 			=> $out_time,
					'ot_hour' 			=> 0,
					'ot_hour_actual' 	=> 0,
					'extra_ot_hour' 	=> $weekend_holiday_eot_hour,
					'extra_ot_hour_actual' 	=> $weekend_holiday_eot_hour,
					'deduction_hour' 	=> 0,
					'late_status' 		=> 0,
					'night_allo' 		=> $night_allowance,
					//'night_allo_2nd' 	=> $night_allowance['night_allow_2nd'],
					'present_status' 	=> $present_status,
					'tiffin_allo' 		=> 0,
					'holiday_allowance'	=> $holiday_allowance_check,
					'weekly_allo'		=> $weekly_allowance_check
				);
			}

			$this->db->select();
			$this->db->where("emp_id", $emp_id);
			$this->db->where("shift_log_date", $date);
			$this->db->where("modify", 0);
			$query = $this->db->get("pr_emp_shift_log");

			//echo $query->num_rows();
			//print_r($data);
			//echo "LATE: ".$late_time;

			if($query->num_rows() > 0)
			{
				//print_r($data);
				$this->db->where('shift_log_date', $date);
				$this->db->where("modify", 0);
				$this->db->where('emp_id', $emp_id);
				$this->db->update('pr_emp_shift_log', $data);
				//echo $this->db->last_query();
			} else {
				if($query2->num_rows() > 0){

				}else{

					$insert_data = array(
					'emp_id' => $emp_id,
					'in_time' => $in_time,
					'out_time' => $out_time,
					'shift_log_date' => $date,
					'ot_hour' => 0,
					'ot_hour_actual' => 0,
					'extra_ot_hour' => $weekend_holiday_eot_hour,
					'extra_ot_hour_actual' => $weekend_holiday_eot_hour,
					'night_allo' 	=> $night_allowance,
					//'night_allo_2nd' => $night_allowance['night_allow_2nd'],
					'holiday_allowanc'=>$holiday_allowance_check,
					'present_status' =>$present_status,
					'weekly_allo'=>$weekly_allowance_check
					);

				   $this->db->insert("pr_emp_shift_log", $insert_data);
				}
			}
			return true;
	    }
	}

	function hour_difference($start_date_time, $end_date_time, $emp_id, $date,$status = "", $in_time)
	{
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

		if($elapsed_min >= $ot_minutes)
		{
			$elapsed_hour = $elapsed_hour + 1;
		}
		else
		{
			$elapsed_hour = $elapsed_hour;
		}
		return $elapsed_hour;
	}

	function check_weekend($emp_id, $att_date)
	{
		$this->db->select("emp_id");
		$this->db->from("pr_work_off");
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
		$this->db->from("pr_holiday");
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
	function ot_hour_calcultation($emp_id, $date)
	{
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

		$this->db->select("shift_id");
		$this->db->from("pr_emp_shift_schedule");
		$this->db->where("sh_type", $emp_shift);
		$query = $this->db->get();
		$row = $query->row();

		$schedule = $this->schedule_check($emp_shift);
		/*print_r($schedule);
		exit;*/
		$start_time		=  $schedule[0]["in_start"];
		$late_time 		=  $schedule[0]["late_start"];
		$end_time   	=  $schedule[0]["in_end"];
		$out_start_time	=  $schedule[0]["out_start"];
		$ot_start_time	=  $schedule[0]["ot_start"];
		$out_end_time	=  $schedule[0]["out_end"];
		// echo "<pre>"; print_r($schedule); exit;

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
		//echo $out_end_time;
		$present_check = $this->present_check($date, $emp_id);
		if($present_check == true)
		{
			$in_time  = $this->time_check_in($date, $start_time, $end_time, $table);

			$out_start_time = "$date $out_start_time";
			$out_end_time = "$out_date $out_end_time";

			$out_time = $this->time_check_out2($out_start_time, $out_end_time, $table);
		}
		else
		{
			$in_time = '';
			$out_time = '';
		}
		//echo $in_time;
		if($in_time !='')
		{
			$hour = trim(substr($in_time,0,2));
			$minute = trim(substr($in_time,3,2));
			$sec = trim(substr($in_time,6,2));
			$time_format = date("h:i:s A", mktime($hour, $minute, $sec, 0, 0, 0));
			$in_time_format = $time_format;
		}
		else
		{
			$in_time_format='';
		}

		if($out_time !='')
		{
			//echo $out_time;
			$hour = trim(substr($out_time,11,2));
			$minute = trim(substr($out_time,14,2));
			$sec = trim(substr($out_time,17,2));
			$time_format = date("h:i:s A", mktime($hour, $minute, $sec, 0, 0, 0));
			$out_time_format = $time_format;
		}
		else
		{
			$out_time_format='';
		}

		$staff_id = array();
		$this->db->select("emp_id");
		$this->db->from("staff_ot_list_emp");
		$this->db->where("emp_id", $emp_id);
		$query_staff = $this->db->get();
		// echo $this->db->last_query();
		foreach($query_staff->result() as $staff_row)
		{
			$staff_id[] = $staff_row->emp_id;
		}
		//print_r($staff_id);exit;
		if(in_array($emp_id,$staff_id))
		{
			$staff = true;
		}else{
			$staff = false;
		}
		$row = $query->row();

		$ot_hour='';
		if($in_time !='' and $out_time !='')
		{
			// || $staff==1
			if($ot_status == 0)
			{
				//$in_date_time = $out_start_time;
				//*****Coded By Tarek Updated on 21-7-16*****//
				$hour_or_miniute 	= $this->get_setup_attributes(10);

				if($hour_or_miniute == "hour")
				{
					$ot_hour = $this->hour_difference($ot_start_time, $out_time, $emp_id, $date,$status,$in_time);
				}
				else
				{
					// echo $in_time.'=='.$out_time;
					$ot_hour = $this->minute_difference($ot_start_time, $out_time, $emp_id, $date,$status,$in_time);
				}
			}elseif($staff==1)
			{
				//echo "of course here";
				$this->db->select('out_time,modify');
				$this->db->where("emp_id", $emp_id);
				$this->db->where("shift_log_date", $date);
				$query3 = $this->db->get("pr_emp_shift_log");
				$modify_time = $query3->row();
				$modify_out_time = $modify_time->out_time;
				$modify = $modify_time->modify;
				$date_modify_time = $date.' '.$modify_out_time;
				// $date_modify_time = '2019-09-17 23:59:00';
				$hour_or_miniute = $this->get_setup_attributes(10);

				if($modify==1){
					$out_hour = trim(substr($date_modify_time,11,2));
					$out_minute = trim(substr($date_modify_time,14,2));
					$out_sec = trim(substr($date_modify_time,17,2));
					$time_am_pm = date("A", mktime($out_hour, $out_minute, $out_sec, 0, 0, 0));
					$out_date = $date;

				if($time_am_pm == "AM")
					{
						$now = strtotime($out_date);
						$datestr = strtotime("+1 day",$now);
						$out_date = date("Y-m-d", $datestr);
						$out_date = $out_date;
					}
					else
					{
						$out_date = $date;
					}
					$date_modify_time = $out_date.' '.$modify_out_time;

					if($hour_or_miniute == "hour")
					{
						$ot_hour = $this->hour_difference($ot_start_time, $date_modify_time, $emp_id, $date,$status,$in_time);
					}
					else
					{
						// echo $ot_start_time.'='.$date_modify_time.'='.$emp_id.'='.$date,$status.'='.$in_time;
						$ot_hour = $this->minute_difference($ot_start_time, $date_modify_time, $emp_id, $date,$status,$in_time);
					}
				}else{
					if($hour_or_miniute == "hour")
					{
						$ot_hour = $this->hour_difference($ot_start_time, $out_time, $emp_id, $date,$status,$in_time);
					}
					else
					{
						$ot_hour = $this->minute_difference($ot_start_time, $out_time, $emp_id, $date,$status,$in_time);
					}
				}
			}
			else
			{
				$ot_hour = 0;
			}
		}

		if($out_time !='')
		{
			//echo $out_time;
			$hour = trim(substr($out_time,11,2));
			$minute = trim(substr($out_time,14,2));
			$sec = trim(substr($out_time,17,2));
			$out_time = date("H:i:s", mktime($hour, $minute, $sec, 0, 0, 0));
		}

		$data["in_time"] = $in_time;
		$data["out_time"] = $out_time;
		$data["ot_hour"] = $ot_hour;
		//echo "EMP:$emp_id";
		// print_r($data);
		return $data;
	}


	function ot_hour_calcultation_for_replace_duty($emp_id, $date)
	{
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

		$this->db->select("shift_id");
		$this->db->from("pr_emp_shift_schedule");
		$this->db->where("sh_type", $emp_shift);
		$query = $this->db->get();
		$row = $query->row();

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
		//echo $out_end_time;
		$present_check = $this->present_check_for_w_h($date, $emp_id);
		if($present_check == true)
		{
			$in_time  = $this->time_check_in($date, $start_time, $end_time, $table);

			$out_start_time = "$in_date $out_start_time";
			$out_end_time = "$out_date $out_end_time";

			$out_time = $this->time_check_out2($out_start_time, $out_end_time, $table);
			//if($emp_id =='FI0428')
			//{
				//echo "IN:$in_time# OS:$out_start_time# OE:$out_end_time# OUT:$out_time";
				//echo $this->db->last_query();
			//}
		}
		else
		{
			$in_time = '';
			$out_time = '';
		}
		//echo $in_time;
		if($in_time !='')
		{
			$hour = trim(substr($in_time,0,2));
			$minute = trim(substr($in_time,3,2));
			$sec = trim(substr($in_time,6,2));
			$time_format = date("h:i:s A", mktime($hour, $minute, $sec, 0, 0, 0));
			$in_time_format = $time_format;
		}
		else
		{
			$in_time_format='';
		}

		if($out_time !='')
		{
			$hour = trim(substr($out_time,11,2));
			$minute = trim(substr($out_time,14,2));
			$sec = trim(substr($out_time,17,2));
			$time_format = date("h:i:s A", mktime($hour, $minute, $sec, 0, 0, 0));
			$out_time_format = $time_format;
		}
		else
		{
			$out_time_format='';
		}

		$ot_hour='';
		if($in_time !='' and $out_time !='')
		{
			if($ot_status == 0)
			{
				$in_date_time = $out_start_time;

				//*****Coded By Tarek Updated on 21-7-16*****//

				$hour_or_miniute 	= $this->get_setup_attributes(10);

				if($hour_or_miniute == "hour")
				{
					$ot_hour = $this->hour_difference($ot_start_time, $out_time, $emp_id, $date,$status,$in_time);

				}
				else
				{
					$ot_hour = $this->minute_difference($ot_start_time, $out_time, $emp_id, $date,$status,$in_time);
				}

			}
			else
			{
				$ot_hour = 0;
			}
		}

		if($out_time !='')
		{
			$hour = trim(substr($out_time,11,2));
			$minute = trim(substr($out_time,14,2));
			$sec = trim(substr($out_time,17,2));
			$out_time = date("H:i:s", mktime($hour, $minute, $sec, 0, 0, 0));
		}

		$data["in_time"] = $in_time;
		$data["out_time"] = $out_time;
		$data["ot_hour"] = $ot_hour;
		//echo "EMP:$emp_id";
		/*print_r($data);*/
		return $data;
	}

	/*function minute_difference($datetime1,$datetime2,$emp_id, $date,$status="",$in_time)
	{
		//echo "$datetime1,$datetime2,$emp_id, $date";
		//$out_time = date('H:i:s', strtotime($datetime2));
		$out_date_time1 = "$date 19:00:00";
		$out_date = date("Y-m-d",strtotime("+1 day",strtotime($date)));
		$out_date_time = "$out_date 00:00:00";
		$datetime = strtotime($datetime2) - strtotime($datetime1);
		$minutes = floor($datetime/60);

		$fraction_minute = $minutes % 60 ;

		if($fraction_minute <= 15)
		{
			$minutes = $minutes - $fraction_minute;
		}

		$emp_shift 	= $this->emp_shift_check($emp_id, $date);
		$schedule 	= $this->schedule_check($emp_shift);
		$ot_minutes		=  $schedule[0]["ot_minute_to_one_hour"];

		//echo $minutes."==";
		$modulas = $minutes%60;
		$minutes_to_hour = $minutes/60;

		if($modulas >= 45)
		{
			$minutes_to_hour = round($minutes_to_hour);
		}
		elseif($modulas < 45){
			$minutes_to_hour = substr($minutes_to_hour, 0,1);
		}
		else{
			   $minutes_to_hour = round($minutes_to_hour);
		}
		//return $minutes;
		return $minutes_to_hour;
	}*/

	function minute_difference($datetime1,$datetime2,$emp_id, $date,$status = "", $in_time)
	{
		// echo $in_time.'=='.$shift_in_time;

		$emp_shift = $this->emp_shift_check($emp_id, $date);
		$schedule = $this->schedule_check($emp_shift);

		$shift_in_time	=  $schedule[0]["in_time"];
		$ot_minutes		=  $schedule[0]["ot_minute_to_one_hour"];

		$real_in_time = strtotime($in_time);
		$sh_in_time = strtotime($shift_in_time);
		// echo $in_time .'>'. $shift_in_time;
		if($real_in_time > $sh_in_time){
			$herenow = strtotime($in_time) - strtotime($shift_in_time);
			$after_intime_m = floor($herenow/60);
		}

		$out_date_time1 = "$date 19:00:00";
		$out_date = date("Y-m-d",strtotime("+1 day",strtotime($date)));
		$out_date_time = "$out_date 00:00:00";
		$datetime = strtotime($datetime2) - strtotime($datetime1);
		$minutes = floor($datetime/60);

		if($minutes > $after_intime_m){
			$minutes = $minutes - $after_intime_m;
		}else{
			$minutes = 0;
		}
		// echo $minutes;
		$fraction_minute = $minutes % 60 ;

		if($fraction_minute <= 15)
		{
			$minutes = $minutes - $fraction_minute;
		}

		$modulas = $minutes%60;
		$minutes_to_hour = $minutes/60;

		if($modulas >= 45)
		{
			$minutes_to_hour = round($minutes_to_hour);
		}
		elseif($minutes_to_hour <=9 && $modulas < 45){
			$minutes_to_hour = substr($minutes_to_hour, 0,1);
		}
		elseif($minutes_to_hour > 9 && $modulas < 45){
			$minutes_to_hour = substr($minutes_to_hour, 0,2);
		}
		else{
			   $minutes_to_hour = round($minutes_to_hour);
		}
		//return $minutes;
		return $minutes_to_hour;
	}

	function insert_ot_hour($emp_id, $date, $ot_hour_calcultation,$present_status)
	{
		// echo "EMP: $emp_id";
		//print_r($ot_hour_calcultation);
		$emp_shift = $this->emp_shift_check($emp_id, $date);
		//echo $emp_shift;
		$schedule = $this->schedule_check($emp_shift);
		//print_r($schedule);
		$start_time		=  $schedule[0]["in_start"];
		$late_time 		=  $schedule[0]["late_start"];
		$end_time   	=  $schedule[0]["in_end"];
		$out_start_time	=  $schedule[0]["out_start"];
		$out_end_time	=  $schedule[0]["out_end"];

		if($ot_hour_calcultation["in_time"] == '')
		{
			$in_time = '';
		}
		else
		{
			$in_time = $ot_hour_calcultation["in_time"];
		}
		//$ot_hour_calcultation["out_time"];
		if($ot_hour_calcultation["out_time"] == '')
		{
			$out_time = '';
		}
		else
		{
			 $out_time = $ot_hour_calcultation["out_time"];
		}
		if($ot_hour_calcultation["ot_hour"] =='' or $ot_hour_calcultation["ot_hour"] <=0)
		{
			$ot_hour = 0;
		}
		else
		{
			$ot_hour = $ot_hour_calcultation["ot_hour"];
		}

		//Night Allowance Check

		    $this->db->select('modify');
			$this->db->where("emp_id", $emp_id);
			$this->db->where("shift_log_date", $date);
			$this->db->where("modify", 1);
			$query2 = $this->db->get("pr_emp_shift_log");
			// echo $this->db->last_query();
			$modify_sts = $query2->row();
			$modify_sts = $modify_sts->modify;

			if($out_time != '' && $modify_sts==0)
			{
				$night_allowance = $this->get_night_allowance($date,$out_time,$emp_id);

			}elseif($out_time != '' && $modify_sts==1){

				$this->db->select('out_time');
				$this->db->where("emp_id", $emp_id);
				$this->db->where("shift_log_date", $date);
				$query3 = $this->db->get("pr_emp_shift_log");
				$modify_out_time = $query3->row();
				$modify_out_time = $modify_out_time->out_time;

				$night_allowance = $this->get_night_allowance($date,$modify_out_time,$emp_id);
			}
			else
			{
				$night_allowance = 0;
			}

			$data_1 = array(
					"night_allo" => $night_allowance
				);
			// print_r($data_1);exit;
			$this->db->where("emp_id", $emp_id);
			$this->db->where("shift_log_date", $date);
			$this->db->update("pr_emp_shift_log", $data_1);

		$this->db->select();
		$this->db->where("emp_id", $emp_id);
		$this->db->where("shift_log_date", $date);
		$this->db->where("modify", 0);
		$query = $this->db->get("pr_emp_shift_log");
		if($query->num_rows() > 0)
		{
			if($in_time > $late_time and $in_time !='')
			{
				$late_status = 1;
			}
			else
			{
				$late_status = 0;
			}



			$tiffin_allowance = 0;

			//echo $tiffin_allowance."///".$night_allowance."///".$out_time;
			$data = array(
						"in_time" 			=> $in_time,
						"out_time" 			=> $out_time,
						"ot_hour" 			=> $ot_hour,
						"ot_hour_actual" 	=> $ot_hour,
						"late_status" 		=> $late_status,
						"tiffin_allo" 		=> $tiffin_allowance,
						"present_status" 	=> $present_status
						);
			//print_r($data);exit;
			//echo "LATE: ".$late_time;
			$this->db->where("emp_id", $emp_id);
			$this->db->where("shift_log_date", $date);
			$this->db->where("modify", 0);
			$this->db->update("pr_emp_shift_log", $data);
			//echo $this->db->last_query();
		}else{
			// echo $in_time.' '.$out_time;

			if($in_time='' && $out_time=''){
				$in_time ='';
				$out_time ='';
				if($modify_sts==1){
				$data_modify = array(
					"present_status" => $present_status,
					"in_time" => $in_time,
					"out_time" => $out_time
				);
			  }

			  //print_r($data_modify);
			$this->db->where("emp_id", $emp_id);
			$this->db->where("shift_log_date", $date);
			$this->db->where("modify", 1);
			$this->db->update("pr_emp_shift_log", $data_modify);

			}else{
				// echo "hi";
			if($modify_sts==1){
				$data_modify = array(
					"present_status" => $present_status
				);
			  }
			  // print_r($data_modify);
			  $this->db->where("emp_id", $emp_id);
			  $this->db->where("shift_log_date", $date);
			  $this->db->where("modify", 1);
			  $this->db->update("pr_emp_shift_log", $data_modify);
			}
		}

		/*$cformat = date('Y-m-d',strtotime($date));
			$cy = substr($cformat,0,4);
			$cm = substr($cformat,5,2);
			$cd = substr($cformat,8,2);
			$f_date = date("Y-m-d", mktime(0, 0, 0, $cm, 1, $cy));
			$s_date = date('Y-m-d',strtotime('6 days',strtotime($f_date)));
			$sStartDate = $f_date;
			$sEndDate = $s_date;

			$cformat2 = date('Y-m-d',strtotime($date));
			$cy2 = substr($cformat2,0,4);
			$cm2 = substr($cformat2,5,2);
			$cd2 = substr($cformat2,8,2);

			$f_date2 = date("Y-m-d", mktime(0, 0, 0, $cm2, 1, $cy2));
			$f_date2 = date('Y-m-d',strtotime('7 days',strtotime($f_date)));

			$s_date2 = date('Y-m-d',strtotime('6 days',strtotime($f_date2)));
			$sStartDate2 = $f_date2;
			$sEndDate2 = $s_date2;

			$cformat3 = date('Y-m-d',strtotime($date));
			$cy3 = substr($cformat3,0,4);
			$cm3 = substr($cformat3,5,2);
			$cd3 = substr($cformat3,8,2);

			$f_date3 = date("Y-m-d", mktime(0, 0, 0, $cm3, 1, $cy3));
			$f_date3 = date('Y-m-d',strtotime('14 days',strtotime($f_date3)));

			$s_date3 = date('Y-m-d',strtotime('6 days',strtotime($f_date3)));
			$sStartDate3 = $f_date3;
			$sEndDate3 = $s_date3;

			$cformat4 = date('Y-m-d',strtotime($date));
			$cy4 = substr($cformat4,0,4);
			$cm4 = substr($cformat4,5,2);
			$cd4 = substr($cformat4,8,2);

			$f_date4 = date("Y-m-d", mktime(0, 0, 0, $cm4, 1, $cy4));
			$f_date4 = date('Y-m-d',strtotime('21 days',strtotime($f_date4)));

			$last_d4 = date("t", mktime(0, 0, 0, $cm4, $cd4, $cy4));
			$d4 = $last_d4 - 22 ;
			$s_date4 = date('Y-m-d',strtotime($d4 .'days',strtotime($f_date4)));
			$sStartDate4 = $f_date4;
			$sEndDate4 = $s_date4;
			//echo $s_date.'=='.$date;
			if($s_date==$date){
				$this->db->select('pr_emp_shift_log.emp_id,SUM(pr_emp_shift_log.ot_hour + pr_emp_shift_log.extra_ot_hour) as total');
				$this->db->from('pr_emp_shift_log');
				$this->db->where('pr_emp_shift_log.shift_log_date >=',$f_date);
				$this->db->where('pr_emp_shift_log.shift_log_date <=',$s_date);
				$this->db->where('pr_emp_shift_log.emp_id',$emp_id);
				$query2 = $this->db->get();
				foreach($query2->result() as $obj){
					//echo $obj->total;
					if($obj->total >= 12){
						$data = array(
						"tot_sts" => 1
						);

						$this->db->where("emp_id", $emp_id);
						$this->db->where("shift_log_date", $s_date);
						$this->db->update("pr_emp_shift_log", $data);
					}else{
						$data = array(
						"tot_sts" => 0
						);

						$this->db->where("emp_id", $emp_id);
						$this->db->where("shift_log_date", $s_date);
						$this->db->update("pr_emp_shift_log", $data);
					}
				}
			}elseif($sEndDate2==$date){

				$this->db->select('pr_emp_shift_log.emp_id,SUM(pr_emp_shift_log.ot_hour + pr_emp_shift_log.extra_ot_hour) as total');
				$this->db->from('pr_emp_shift_log');
				$this->db->where('pr_emp_shift_log.shift_log_date >=',$sStartDate2);
				$this->db->where('pr_emp_shift_log.shift_log_date <=',$sEndDate2);
				$this->db->where('pr_emp_shift_log.emp_id',$emp_id);
				$query2 = $this->db->get();
				foreach($query2->result() as $obj){
					//echo $obj->total;
					if($obj->total >= 12){
						$data = array(
						"tot_sts_2" => 1
						);

						$this->db->where("emp_id", $emp_id);
						$this->db->where("shift_log_date", $sEndDate2);
						$this->db->update("pr_emp_shift_log", $data);
					}else{
						$data = array(
						"tot_sts_2" => 0
						);

						$this->db->where("emp_id", $emp_id);
						$this->db->where("shift_log_date", $sEndDate2);
						$this->db->update("pr_emp_shift_log", $data);
					}
				}

			}elseif($sEndDate3==$date){

				$this->db->select('pr_emp_shift_log.emp_id,SUM(pr_emp_shift_log.ot_hour + pr_emp_shift_log.extra_ot_hour) as total');
				$this->db->from('pr_emp_shift_log');
				$this->db->where('pr_emp_shift_log.shift_log_date >=',$sStartDate3);
				$this->db->where('pr_emp_shift_log.shift_log_date <=',$sEndDate3);
				$this->db->where('pr_emp_shift_log.emp_id',$emp_id);
				$query2 = $this->db->get();
				foreach($query2->result() as $obj){
					//echo $obj->total;
					if($obj->total >= 12){
						$data = array(
						"tot_sts_3" => 1
						);

						$this->db->where("emp_id", $emp_id);
						$this->db->where("shift_log_date", $sEndDate3);
						$this->db->update("pr_emp_shift_log", $data);
					}else{
						$data = array(
						"tot_sts_3" => 0
						);

						$this->db->where("emp_id", $emp_id);
						$this->db->where("shift_log_date", $sEndDate3);
						$this->db->update("pr_emp_shift_log", $data);
					}
				}

			}elseif($sEndDate4==$date){
				$this->db->select('pr_emp_shift_log.emp_id,SUM(pr_emp_shift_log.ot_hour + pr_emp_shift_log.extra_ot_hour) as total');
				$this->db->from('pr_emp_shift_log');
				$this->db->where('pr_emp_shift_log.shift_log_date >=',$sStartDate4);
				$this->db->where('pr_emp_shift_log.shift_log_date <=',$sEndDate4);
				$this->db->where('pr_emp_shift_log.emp_id',$emp_id);
				$query2 = $this->db->get();
				foreach($query2->result() as $obj){
					//echo $obj->total;
					if($obj->total >= 12){
						$data = array(
						"tot_sts_4" => 1
						);

						$this->db->where("emp_id", $emp_id);
						$this->db->where("shift_log_date", $sEndDate4);
						$this->db->update("pr_emp_shift_log", $data);
					}else{
						$data = array(
						"tot_sts_4" => 0
						);

						$this->db->where("emp_id", $emp_id);
						$this->db->where("shift_log_date", $sEndDate4);
						$this->db->update("pr_emp_shift_log", $data);
					}
				}
			}*/
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

	function get_night_allowance($date,$out_time,$emp_id)
	{
		//echo $out_time;
		$emp_shift = $this->emp_shift_check($emp_id, $date);

		$this->db->select("shift_id");
		$this->db->from("pr_emp_shift_schedule");
		$this->db->where("sh_type", $emp_shift);
		$query = $this->db->get();
		$row = $query->row();

		$schedule = $this->schedule_check($emp_shift);
		//print_r($schedule);
		$out_end_time_shift	=  $schedule[0]["out_end"];
		$desig_id = $this->db->where("emp_id",$emp_id)->get('pr_emp_com_info')->row()->emp_desi_id;
		$night_allowance_rules = $this->get_night_allowance_rules($desig_id);

		if($night_allowance_rules['msg'] == "OK" )
		{
			$night_allowance_time = $this->db->where("rules_id",$night_allowance_rules['rules_id'])->get('pr_night_allowance_rules')->row()->night_time;
			$night_allowance_time_2 = $this->db->where("rules_id",$night_allowance_rules['rules_id'])->get('pr_night_allowance_rules')->row()->night_time_2nd;

			$night_allowance_time_1_con_time = date("H:i:s",strtotime('-1 minutes',strtotime($night_allowance_time_2)));

			$date_outtime 	= "$date $out_time";
			$date_nighttime = "$date $night_allowance_time";
			$date_nighttime_2nd = "$date $night_allowance_time_2";

			$out_end_time 		= date('A', strtotime($out_end_time_shift));
			$night_allowance_time_2nd 	= date('A', strtotime($night_allowance_time_2));
			$night_allowance_time_1_con = date('A', strtotime($night_allowance_time_1_con_time));
			$out_time_median 			= date('A', strtotime($out_time));

			if($out_end_time == "AM")
			{
				$tomorrow = date('Y-m-d',strtotime($date . "+1 days"));
				$out_end_time = "$tomorrow $out_end_time_shift";
			}else{
				$out_end_time = "$date $out_end_time_shift";
			}

			if($night_allowance_time_2nd == "AM")
			{
				$tomorrow = date('Y-m-d',strtotime($date . "+1 days"));
				$date_nighttime_2nd = "$tomorrow $night_allowance_time_2";
			}

			if($night_allowance_time_1_con == "AM")
			{
				$tomorrow = date('Y-m-d',strtotime($date . "+1 days"));
				$night_allowance_time_1_con = "$tomorrow $night_allowance_time_1_con_time";
			}else{
				$night_allowance_time_1_con = "$date $night_allowance_time_1_con_time";
			}

			if($out_time_median == "AM")
			{
				$tomorrow = date('Y-m-d',strtotime($date . "+1 days"));
				$date_outtime = "$tomorrow $out_time";
			}
			// echo $date_outtime .'>='. $date_nighttime .'&&'. $date_outtime .'<='. $night_allowance_time_1_con;
			// echo "<br>";
			// echo $date_outtime .'>='.$date_nighttime_2nd .'&&'. $date_outtime .'<='. $out_end_time;
			if($date_outtime >= $date_nighttime && $date_outtime <= $night_allowance_time_1_con)
			{
				$night_allow = 1;
			}
			elseif($date_outtime >= $date_nighttime_2nd && $date_outtime <= $out_end_time)
			{
				$night_allow = 2;
			}
			else
			{
				$night_allow = 0;
			}
		}
		else
		{
			$night_allow = 0;
		}
		return $night_allow;
	}

	function get_night_allowance_2nd($date,$out_time,$emp_id)
	{
		//echo $tomorrow = date('Y-m-d',strtotime($date . "+1 days"));
		$desig_id = $this->db->where("emp_id",$emp_id)->get('pr_emp_com_info')->row()->emp_desi_id;
		$night_allowance_rules = $this->get_night_allowance_rules($desig_id);

		if($night_allowance_rules['msg'] == "OK" )
		{
			$night_allowance_time = $this->db->where("rules_id",$night_allowance_rules['rules_id'])->get('pr_night_allowance_rules')->row()->night_time_2nd;

			$date_outtime 	= "$date $out_time";
			$date_nighttime = "$date $night_allowance_time";

			$night_out_time_median 		= date('A', strtotime($night_allowance_time));
			$out_time_median 			= date('A', strtotime($out_time));

			if($night_out_time_median == "AM")
			{
				$tomorrow = date('Y-m-d',strtotime($date . "+1 days"));
				$date_nighttime = "$tomorrow $night_allowance_time";
			}
			if($out_time_median == "AM")
			{
				$tomorrow = date('Y-m-d',strtotime($date . "+1 days"));
				$date_outtime = "$tomorrow $out_time";
			}

			if($date_nighttime <= $date_outtime)
			{
					$night_allow 			= 1;
			}
			else
			{
					$night_allow 			= 0;
			}
		}
		else
		{
			$night_allow 			= 0;
		}
		return $night_allow;
	}


	function get_tiffin_allowance_rules_data()
	{
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
	function get_night_allowance_rules($desig_id)
	{
		$this->db->select('rules_id');
		$this->db->from('pr_night_allowance_level');
		$this->db->where("desig_id", $desig_id);
		$query = $this->db->get();
		if($query->num_rows()>0)
		{
			$row = $query->row();
			$data['rules_id'] = $row->rules_id;
			$data['msg'] = "OK";
		}
		else
		{
			$rules_id = 0;
			$data['msg'] = "NULL";
		}
		// print_r($data);
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
		$query = $this->db->get("pr_holiday");
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

		if($query->num_rows() > 0 )
		{
			foreach($query->result() as $row)
			{
				$shift_duty = $row->shift_duty;
			}

			$this->db->select("sh_type");
			$this->db->from("pr_emp_shift_schedule");
			$this->db->where("shift_id", $shift_duty);
			$query1 = $this->db->get();
			$row = $query1->row();
			return $row->sh_type;
		}
		else
		{
			$this->db->select("pr_emp_shift.shift_id, pr_emp_shift.shift_duty");
			$this->db->from("pr_emp_shift");
			$this->db->from("pr_emp_com_info");
			$this->db->where("pr_emp_com_info.emp_id", $emp_id);
			$this->db->where("pr_emp_shift.shift_id = pr_emp_com_info.emp_shift");
			$query2 = $this->db->get();
			//echo $this->db->last_query();
			foreach($query2->result() as $rows)
			{
				$shift_id = $rows->shift_id;
				$shift_duty = $rows->shift_duty;
			}

			$data = array(
							'emp_id' 		 => $emp_id,
							'shift_id' 		 => $shift_id,
							'shift_duty' 	 => $shift_duty,
							'shift_log_date' => $att_date

			);
			// echo "hey";exit;

			$this->db->insert("pr_emp_shift_log", $data);


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

	function schedule_check($emp_shift)
	{
		$this->db->where("sh_type", $emp_shift);
		$query = $this->db->get("pr_emp_shift_schedule");
		return $query->result_array();
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
			foreach($query->result() as $row)
			{
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
			//echo $this->db->last_query();
			$row = $query->row();
			return $row->sh_type;

		}
	}

	function present_check($date, $emp_id)
	{
		//echo $date.'=='.$emp_id;
		$year  = trim(substr($date,0,4));
		$month = trim(substr($date,5,2));
		$day   = trim(substr($date,8,2));
		$date_field = "date_$day";
		$att_month = $year."_".$month."-01";

		$this->db->select($date_field);
		$this->db->where("emp_id", $emp_id);
		$this->db->where("att_month", $att_month);
		$this->db->where($date_field, "P");
		//$this->db->where($date_field, "W");
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

	function present_check_for_w_h($date, $emp_id)
	{
		//echo $date.'=='.$emp_id;
		$year  = trim(substr($date,0,4));
		$month = trim(substr($date,5,2));
		$day   = trim(substr($date,8,2));
		$date_field = "date_$day";
		$att_month = $year."-".$month."-01";

		$this->db->select($date_field);
		$this->db->where("emp_id", $emp_id);
		$this->db->where("att_month", $att_month);
		$this->db->or_where($date_field, "P");
		$this->db->or_where($date_field, "W");
		$this->db->or_where($date_field, "H");
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

	function time_check_in($date, $start_time, $end_time, $table)
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

	function time_check_out2_new($start_time, $end_time, $table)
	{
		//echo $start_time.'='.$end_time;
		//echo $start_time;
		$start_time = trim(substr($start_time,11,18));
		$end_time = trim(substr($end_time,11,18));
		$this->db->select("date_time");
		//$this->db->where("trim(substr(date_time,1,10)) = '$date'");
		//$this->db->where("trim(substr(date_time,1,10)) = '$date'");
		$this->db->where("trim(substr(date_time,11,19)) BETWEEN '$start_time' and '$end_time'");

		//$this->db->where("date_time BETWEEN '$start_time' and '$end_time'");//change 29-10-2018
		$this->db->order_by("date_time","DESC");
		$this->db->limit("1");
		$query = $this->db->get($table);
		// echo $this->db->last_query();
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
		// echo $this->db->last_query();
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
		//echo "hello";
		//$date1 = new DateTime($last_update);
		//$date2 = new DateTime($current_date);
		//$interval = $date1->diff($date2);
		//$day =  $interval->days;
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

	function deduction_hour_process($emp_id,$att_date)
	{
		$this->db->select('*');
		$this->db->where("shift_log_date",$att_date);
		$this->db->where("emp_id",$emp_id);
		$query = $this->db->get('pr_emp_shift_log');

		foreach($query->result() as $row)
		{
			$emp_id = $row->emp_id;
			$ot_hour_actual = $row->ot_hour_actual;
			$extra_ot_hour_actual = $row->extra_ot_hour_actual;
			$ot_hour = $row->ot_hour;
			$extra_ot_hour = $row->extra_ot_hour;

			$tot_actual = $ot_hour_actual + $extra_ot_hour_actual;
			$tot_ot = $ot_hour + $extra_ot_hour;

			if($tot_actual!=0 && $tot_ot!=0){
				$deduct_hour = $tot_actual - $tot_ot;
			}else{
				$deduct_hour = 0;
			}

			$data = array(
				'deduct_hour' => $deduct_hour
			);
			// print_r($data);
			$this->db->where("emp_id",$emp_id);
			$this->db->where("shift_log_date",$att_date);
			$this->db->update('pr_emp_shift_log', $data);
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

	function get_all_employee($grid_emp_id)
	{
		$this->db->select('pr_emp_per_info.emp_id, pr_emp_per_info.emp_full_name, pr_designation.desig_name, pr_emp_shift.shift_duty');
		$this->db->from('pr_emp_per_info');
		$this->db->from('pr_emp_com_info');
		$this->db->from('pr_designation');
		$this->db->from('pr_emp_shift');
		$this->db->where_in("pr_emp_per_info.emp_id",$grid_emp_id);
		//$this->db->where("pr_emp_per_info.emp_id",'000321');
		$this->db->where("pr_emp_per_info.emp_id = pr_emp_com_info.emp_id");
		$this->db->where("pr_emp_com_info.emp_desi_id = pr_designation.desig_id");
		$this->db->where("pr_emp_com_info.emp_shift = pr_emp_shift.shift_id");
		$this->db->order_by("pr_emp_com_info.emp_id");
		return $query = $this->db->get();
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

	function insert_monthly_machine_data_to_temp_table($emp_id, $process_date){
		$temp_table = "temp_$emp_id";
		$temp_table = strtolower($temp_table);

		$att_table 	= $this->make_attendance_table_name_monthly($process_date);
		//echo $process_date;
		$this->db->select();
		$this->db->from($att_table);
		$this->db->from('pr_id_proxi');
		$this->db->where("$att_table.proxi_id = pr_id_proxi.proxi_id");
		$this->db->where("pr_id_proxi.emp_id  = '$emp_id'");
		$this->db->where("$att_table.date_time  like '$process_date%'");
		$query = $this->db->get();
		// echo $this->db->last_query();
		foreach($query->result() as $rows){
			$this->db->select();
			$this->db->where("device_id  = '$rows->device_id'");
			$this->db->where("proxi_id  = '$rows->proxi_id'");
			$this->db->where("date_time  = '$rows->date_time'");
			$this->db->from($temp_table);
			$query = $this->db->get();
			if($query->num_rows == 0){
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
		// $year_month = "$year-month-01";
		$year_month = $year_month.'-01';
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

	function attn_delete_for_eligibility_failed($emp_id, $att_date){
		/*$this->db->select('emp_id');
		$this->db->where('emp_id',$emp_id);
		$this->db->where('shift_log_date',$att_date);
		$query = $this->db->get('pr_emp_shift_log');
		if($query->num_rows() > 0 )
		{*/
		$this->db->where('emp_id',$emp_id);
		$this->db->where('shift_log_date',$att_date);
		$this->db->delete('pr_emp_shift_log');
		// }
	}

	function emp_com_info_data($emp_id){
		//echo $emp_id;
		$this->db->select('emp_id,emp_dept_id,emp_sec_id,emp_line_id,emp_desi_id,emp_sal_gra_id,gross_sal,com_gross_sal');
		$this->db->where('emp_id',$emp_id);
		return $query = $this->db->get('pr_emp_com_info');
	}

	function increment_entry_auto($empid,$process_date){
		//echo $empid.''.$process_date;exit;
		$process_dom = date('m-d',strtotime($process_date));
		$this->db->select('emp_id,emp_join_date');
		$this->db->where('emp_id',$empid);
		$this->db->like('emp_join_date',$process_dom);
		$inc_check = $this->db->get('pr_emp_com_info');
		//echo $inc_check->num_rows();
		//echo $this->db->last_query();exit;
		if ($inc_check->num_rows() == 0) {
			return;
		}else{
			$emp_com_info = $this->emp_com_info_data($empid);
			foreach($emp_com_info->result() as $rows){
				//print_r($rows);exit;
				$emp_dept_id 	= $rows->emp_dept_id;
				$emp_sec_id 	= $rows->emp_sec_id;
				$emp_line_id 	= $rows->emp_line_id;
				$emp_desi_id 	= $rows->emp_desi_id;
				$emp_sal_gra_id = $rows->emp_sal_gra_id;
				$gross_sal 		= $rows->gross_sal;
				$com_gross_sal 	= $rows->com_gross_sal;
			}

			$new_emp_sal_gra_id	= $emp_sal_gra_id;//Old GRD ID
			// $percent = (5/100);//5%
			$percent = $this->common_model->get_setup_attributes(11);
			$diff_gross_salary 	= $gross_sal*($percent/100);
			$new_entry_date 	= date("Y-m-d", strtotime($process_date));

			$new_gross_sal 	= $gross_sal + $diff_gross_salary;
			$new_gross_sal_com 	= $com_gross_sal + $diff_gross_salary;

			$data = array(
					'prev_emp_id'		=> $empid,
					'prev_dept' 		=> $emp_dept_id,
					'prev_section' 		=> $emp_sec_id,
					'prev_line' 		=> $emp_line_id,
					'prev_desig' 		=> $emp_desi_id,
					'prev_grade'  		=> $emp_sal_gra_id,
					'prev_salary'  		=> $gross_sal,
					'prev_com_salary'	=> $com_gross_sal,
					'new_emp_id'  		=> $empid,
					'new_dept'  		=> $emp_dept_id,
					'new_section'		=> $emp_sec_id,
					'new_line' 			=> $emp_line_id,
					'new_desig'			=> $emp_desi_id,
					'new_grade'			=> $new_emp_sal_gra_id,
					'new_salary'		=> $new_gross_sal,
					'new_com_salary'	=> $new_gross_sal_com,
					'effective_month'	=> $new_entry_date,
					'ref_id'			=> $empid,
					'status'			=> 1
				);

			/*echo "<pre>";
			print_r($data);exit;*/
			$data2 = array(
					'emp_sal_gra_id'	=> $new_emp_sal_gra_id,
					'gross_sal'  		=> $new_gross_sal,
					'com_gross_sal'  	=> $new_gross_sal_com,
			);


			$query2 = $this->db->select('prev_emp_id,effective_month')->where('prev_emp_id',$empid)->where('effective_month',$new_entry_date)->get('pr_incre_prom_pun')->num_rows();

			if($query2==0){
				$this->db->insert('pr_incre_prom_pun', $data);
				$update = $this->db->where('emp_id',$empid)->update('pr_emp_com_info', $data2);
			}
			return ;
		}
	}

	function staff_id_collect($emp_id){
 		$staff_id = array();
		$this->db->select("emp_id");
		$this->db->from("staff_ot_list_emp");
		$this->db->where("emp_id", $emp_id);
		$query_staff = $this->db->get();
		// echo $this->db->last_query();
		foreach($query_staff->result() as $staff_row)
		{
			$staff_id[] = $staff_row->emp_id;
		}
		//print_r($staff_id);exit;
		if(in_array($emp_id,$staff_id))
		{
			$staff = true;
		}else{
			$staff = false;
		}
     }

	function ot_hour_auto_calcultation($emp_id, $in_time, $out_time, $date)
	  {
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

		$emp_shift = $this->emp_shift_check($emp_id, $date);

		$this->db->select("shift_id");
		$this->db->from("pr_emp_shift_schedule");
		$this->db->where("sh_type", $emp_shift);
		$query = $this->db->get();
		$row = $query->row();

		$schedule = $this->schedule_check($emp_shift);
		//print_r($schedule);
		$start_time		=  $schedule[0]["in_start"];
		$late_time 		=  $schedule[0]["late_start"];
		$end_time   	=  $schedule[0]["in_end"];
		$out_start_time	=  $schedule[0]["out_start"];
		$ot_start_time	=  $schedule[0]["ot_start"];
		$out_end_time	=  $schedule[0]["out_end"];
		$out_time;
		$out_end_time = strtotime($out_end_time);
		$out_time_str = strtotime($out_time);

		$hour = trim(substr($out_start_time,0,2));
		$minute = trim(substr($out_start_time,3,2));
		$sec = trim(substr($out_start_time,6,2));

		$am_pm = date("A", mktime($hour, $minute, $sec, 0, 0, 0));
		$in_date = $date;
		$out_date = $date;
		$ot_start_time = "$in_date $ot_start_time";

		$hour = trim(substr($out_time,0,2));
		$minute = trim(substr($out_time,3,2));
		$sec = trim(substr($out_time,6,2));
		$am_pm = date("A", mktime($hour, $minute, $sec, 0, 0, 0));

		if($out_time_str > $out_end_time)
	    {
	   	  $out_date = $date;
		  $out_time = "$out_date $out_time";
	    }
		elseif($am_pm == "AM")
		{
			//echo $am_pm;
			$now = strtotime($out_date);
			$datestr = strtotime("+1 day",$now);
			$out_date = date("Y-m-d", $datestr);
			$out_date = $out_date;
			$out_time = "$out_date $out_time";
	  }else
		 {
			$out_date = $date;
			$out_time = "$out_date $out_time";
		 }

		if($in_time !='')
		{
			$hour = trim(substr($in_time,0,2));
			$minute = trim(substr($in_time,3,2));
			$sec = trim(substr($in_time,6,2));
			$time_format = date("h:i:s A", mktime($hour, $minute, $sec, 0, 0, 0));
			$in_time_format = $time_format;
		}
		else
		{
			$in_time_format='';
		}

		if($out_time !='')
		{
			//echo $out_time;
			$hour = trim(substr($out_time,11,2));
			$minute = trim(substr($out_time,14,2));
			$sec = trim(substr($out_time,17,2));
			$time_format = date("h:i:s A", mktime($hour, $minute, $sec, 0, 0, 0));
			$out_time_format = $time_format;
		}
		else
		{
			$out_time_format='';
		}

		$ot_hour='';
		if($in_time !='' and $out_time !='')
		{
			// || $staff==1
			if($ot_status == 0)
			{
				//$in_date_time = $out_start_time;
				//*****Coded By Tarek Updated on 21-7-16*****//
				$hour_or_miniute 	= $this->get_setup_attributes(10);

				if($hour_or_miniute == "hour")
				{
					$ot_hour = $this->hour_difference($ot_start_time, $out_time, $emp_id, $date);
				}
				else
				{
					// echo "tai";
					$ot_hour = $this->minute_difference_auto($ot_start_time, $out_time, $emp_id,$date,$in_time);
				}
			}
			else
			{
				$ot_hour = 0;
			}
		}

		if($out_time !='')
		{
			//echo $out_time;
			$hour = trim(substr($out_time,11,2));
			$minute = trim(substr($out_time,14,2));
			$sec = trim(substr($out_time,17,2));
			$out_time = date("H:i:s", mktime($hour, $minute, $sec, 0, 0, 0));
		}

		$data["in_time"] = $in_time;
		$data["out_time"] = $out_time;
		$data["ot_hour"] = $ot_hour;
		//echo "EMP:$emp_id";
		// print_r($data);
		return $data;
	}

	function weekend_holday_eot_calculation_auto($emp_id,$date,$in_time,$out_time,$status,$present_status)
	{
		// echo $emp_id;
		// exit();
		$this->db->select("pr_work_off.replace_val");
		$this->db->from("pr_work_off");
		$this->db->where("pr_work_off.emp_id = '$emp_id'");
		$this->db->where("pr_work_off.work_off_date = '$date'");
		$this->db->where("pr_work_off.replace_val = ", 1);
		$replace_val = $this->db->get();
		$val = $replace_val->row();
		$f_val = $val->replace_val;

		$this->db->select("pr_holiday.replace_val");
		$this->db->from("pr_holiday");
		$this->db->where("pr_holiday.emp_id = '$emp_id'");
		$this->db->where("pr_holiday.holiday_date = '$date'");
		$this->db->where("pr_holiday.replace_val = ", 1);
		$replace_val = $this->db->get();
		$val = $replace_val->row();
		$h_val = $val->replace_val;

		if($f_val==1 || $h_val==1)
		{
			$ot_hour_calcultation = $this->ot_hour_auto_calcultation($emp_id,$in_time,$out_time,$date);

				if($ot_hour_calcultation["ot_hour"] !=''){
					if($ot_hour_calcultation["ot_hour"] > 2){
						$extra_ot_hour = $ot_hour_calcultation["ot_hour"] - 2 ;
						$ot_hour = $ot_hour_calcultation["ot_hour"] = 2;
					}
					else{
						$extra_ot_hour = 0;
						$ot_hour = $ot_hour_calcultation["ot_hour"];
					}
				}
				else{
					$ot_hour = $ot_hour_calcultation["ot_hour"] = 0;
					$extra_ot_hour = 0;
				}

				$this->modify_ot_eot_update($emp_id,$in_time,$out_time,$ot_hour,$extra_ot_hour,$date);

				$data = array(
						'ot_hour'=> $ot_hour,
						'extra_ot_hour'=> $extra_ot_hour,
					);
				return $data;

		}else{
		// echo "here";
		$holiday_allowance_check = 0;
		$weekly_allowance_check = 0;
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

		$emp_shift = $this->emp_shift_check($emp_id, $date);
		$schedule = $this->schedule_check($emp_shift);
		$start_time		=  $schedule[0]["in_start"];
		$late_time 		=  $schedule[0]["late_start"];
		$end_time   	=  $schedule[0]["in_end"];
		$out_start_time	=  $schedule[0]["out_start"];
		$ot_start_time	=  $schedule[0]["ot_start"];
		$out_end_time	=  $schedule[0]["out_end"];

		$out_end_time = strtotime($out_end_time);
		$out_time_str = strtotime($out_time);

		$hour = trim(substr($out_start_time,0,2));
		$minute = trim(substr($out_start_time,3,2));
		$sec = trim(substr($out_start_time,6,2));

		$am_pm = date("A", mktime($hour, $minute, $sec, 0, 0, 0));
		$in_date = $date;
		$out_date = $date;
		$ot_start_time = "$in_date $ot_start_time";
		$in_time_date=  $date." ".$in_time;

		$hour = trim(substr($out_time,0,2));
		$minute = trim(substr($out_time,3,2));
		$sec = trim(substr($out_time,6,2));
		$am_pm = date("A", mktime($hour, $minute, $sec, 0, 0, 0));

		if($out_time_str > $out_end_time)
	    {
	   	  $out_date = $date;
		  $out_time_date = "$out_date $out_time";
	    }
		elseif($am_pm == "AM")
		{
			//echo $am_pm;
			$now = strtotime($out_date);
			$datestr = strtotime("+1 day",$now);
			$out_date = date("Y-m-d", $datestr);
			$out_date = $out_date;
			$out_time_date = "$out_date $out_time";
	  }else
		 {
			$out_date = $date;
			$out_time_date = "$out_date $out_time";
		 }

		 $workoff_eot_out_date = trim(substr($out_time_date,0,10));
		 $out_time = trim(substr($out_time_date,11,19));
		 // echo $out_time_date;
		if($in_time == '' or $out_time == '')
		{
			$weekend_holiday_eot_hour = 0;
			if($status == "h")
			 {
				$holiday_allowance_check = 0;
			 	$weekly_allowance_check = 0;
			 	$present_status = "H";
			 }
			 if($status == "w")
			 {
				$holiday_allowance_check = 0;
			 	$weekly_allowance_check = 0;
			 	$present_status = "W";
			 }
		}
		else
		{
		   $hour_or_miniute 	= $this->get_setup_attributes(10);
			if($hour_or_miniute == "hour")
			{
				$weekend_holiday_eot_hour = $this->hour_difference($in_time_date, $out_time_date, $emp_id, $date);
			}
			else
			{
				// echo $in_time_date.'='.$out_time_date.'='.$emp_id.'='.$date.'='.$status.'='.$in_time;
				$weekend_holiday_eot_hour = $this->minute_difference_auto($in_time_date,$out_time_date,$emp_id,$date,$in_time);
			}

			$workoff_eot_lunch_deduct_time 	= $this->get_setup_attributes(7);
			$workoff_eot_lunch_deduct_time 	= "$in_date $workoff_eot_lunch_deduct_time";
			$workoff_eot_out_time 			= "$workoff_eot_out_date $out_time";

			if($workoff_eot_lunch_deduct_time <= $workoff_eot_out_time)
			{
				$weekend_holiday_eot_hour = $weekend_holiday_eot_hour - 1;
			}
			else
			{
				$weekend_holiday_eot_hour = $weekend_holiday_eot_hour;
			}
			// echo $weekend_holiday_eot_hour;

			//====================================Holiday Aloowance============================
			 if($status == "h")
			 {
				$holiday_allowance_check = 1;
			 	$weekly_allowance_check = 0;
			 	$present_status = "H";
			 }
			 if($status == "w")
			 {
				$holiday_allowance_check = 0;
			 	$weekly_allowance_check = 1;
			 	$present_status = "W";
			 }
		}
		//$weekend_holiday_eot_hour."====".$night_allowance;
		if($night_allowance == "1" || $night_allowance == "2")
			{
				$unit_id = $this->db->select('unit_id')->where('emp_id',$emp_id)->get('pr_emp_com_info')->row()->unit_id;

				$night_deduct_hour = $this->db->select('deduct_hour')->where('unit_id',$unit_id)->get('pr_night_rules')->row()->deduct_hour;

				$weekend_holiday_eot_hour = $weekend_holiday_eot_hour - $night_deduct_hour;
			}

		if($ot_status == 1){

			$weekend_holiday_eot_hour = 0;
			$data = array(
				'ot_hour' => 0,
				'extra_ot_hour' => 0
			);
		}
		else
		{
		$data = array(
				'ot_hour' => 0,
				'extra_ot_hour' => $weekend_holiday_eot_hour
				);
		}

		$this->modify_ot_eot_update($emp_id,$in_time,$out_time,$ot_hour,$weekend_holiday_eot_hour,$date);
		return $data;
	 }
	}

	function minute_difference_auto($datetime1,$datetime2,$emp_id,$date,$in_time)
	{
		// echo $datetime1.'='.$datetime2.'='.$emp_id.'='.$date.'='.$in_time;exit;

		$emp_shift = $this->emp_shift_check($emp_id, $date);
		$schedule = $this->schedule_check($emp_shift);

		$shift_in_time	=  $schedule[0]["in_time"];
		$ot_minutes		=  $schedule[0]["ot_minute_to_one_hour"];

		$real_in_time = strtotime($in_time);
		$sh_in_time = strtotime($shift_in_time);

		if($real_in_time > $sh_in_time){
			$herenow = strtotime($in_time) - strtotime($shift_in_time);
			$after_intime_m = floor($herenow/60);
		}

		$out_date_time1 = "$date 19:00:00";
		$out_date = date("Y-m-d",strtotime("+1 day",strtotime($date)));
		$out_date_time = "$out_date 00:00:00";
		$datetime = strtotime($datetime2) - strtotime($datetime1);
		$minutes = floor($datetime/60);

		if($minutes > $after_intime_m){
			$minutes = $minutes - $after_intime_m;
		}
		// echo $minutes;
		$fraction_minute = $minutes % 60 ;

		if($fraction_minute <= 15)
		{
			$minutes = $minutes - $fraction_minute;
		}
		$modulas = $minutes%60;
		$minutes_to_hour = $minutes/60;

		if($modulas >= 45)
		{
			$minutes_to_hour = round($minutes_to_hour);
		}
		elseif($minutes_to_hour <=9 && $modulas < 45){
			$minutes_to_hour = substr($minutes_to_hour, 0,1);
		}
		elseif($minutes_to_hour > 9 && $modulas < 45){
			$minutes_to_hour = substr($minutes_to_hour, 0,2);
		}
		else{
			 $minutes_to_hour = round($minutes_to_hour);
		}
		// echo  $date.'=='.$minutes_to_hour;exit;
		// echo $minutes_to_hour;
		return $minutes_to_hour;
	}

	function modify_ot_eot_update($emp_id,$in_time,$out_time,$ot_hour,$extra_ot_hour,$date){

		$emp_shift = $this->emp_shift_check($emp_id, $date);
		// echo $emp_shift;
		$schedule = $this->schedule_check($emp_shift);
		// print_r($schedule);
		$start_time		=  $schedule[0]["in_start"];
		$late_time 		=  $schedule[0]["late_start"];
		$end_time   	=  $schedule[0]["in_end"];
		$out_start_time	=  $schedule[0]["out_start"];
		$out_end_time	=  $schedule[0]["out_end"];

		$arr = $this->select_actual_ot_eot($emp_id,$date);
		$ot_hour_now = $arr['ot_hour'];
		$ot_actual = $arr['ot_actual'];
		$eot_actual = $arr['eot_actual'];
		$modify = $arr['modify'];
		// print_r($arr);

		// if($out_time == ""){
		// 		continue;
		// 	}

			if($in_time > $late_time and $in_time !='')
			{
				$late_status = 1;
			}
			else
			{
				$late_status = 0;
			}

			if($ot_hour_now==0){
				$ot_hour_actual = $ot_hour;
				$extra_ot_hour_actual = $extra_ot_hour;
			}else{
				$ot_hour_actual = $ot_actual;
				$extra_ot_hour_actual = $eot_actual;
			}

			if($modify==0){
				$data= array(
				'in_time'		=> $in_time,
				'out_time'		=> $out_time,
				'ot_hour'		=> $ot_hour,
				'ot_hour_actual'=> $ot_hour,
				'extra_ot_hour'	=> $extra_ot_hour,
				'extra_ot_hour_actual'=> $extra_ot_hour,
				'late_status'=> $late_status,
				'modify' => 1
			 );
		   }else{
		   		$data= array(
				'in_time'		=> $in_time,
				'out_time'		=> $out_time,
				'ot_hour'		=> $ot_hour,
				'extra_ot_hour'	=> $extra_ot_hour,
				'late_status'=> $late_status,
				'modify' => 1
			 );
		   }

		$this->db->where("emp_id",$emp_id);
		$this->db->where("shift_log_date",$date);
		$this->db->update("pr_emp_shift_log",$data);

	}

	function select_actual_ot_eot($emp_id,$date){
		// $data = array();
		$this->db->select("ot_hour,ot_hour_actual,extra_ot_hour_actual,modify");
		$this->db->from("pr_emp_shift_log");
		$this->db->where("emp_id",$emp_id);
		$this->db->where("shift_log_date",$date);
		$query = $this->db->get();

		foreach($query->result() as $row){
			$ot_hour = $row->ot_hour;
			$ot_actual = $row->ot_hour_actual;
			$eot_actual = $row->extra_ot_hour_actual;
			$modify = $row->modify;
		}

		$data = array(
				'ot_hour' => $ot_hour,
				'ot_actual' => $ot_actual,
				'eot_actual' => $eot_actual,
				'modify' => $modify
			);

		return $data;
	}

}
