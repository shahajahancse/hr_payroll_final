<?php
class Salary_process_model extends CI_Model{
	
	
	function __construct()
	{
		parent::__construct();
		
		/* Standard Libraries */
		$this->load->model('pf_model');
		$this->load->model('common_model');
	}
	
	function salary_process($unit_id,$process_month,$grid_emp_id)
	{
		set_time_limit(0);
		ini_set('memory_limit', -1);
		ini_set('max_execution_time', 0);

		$num_of_days   = date("t", strtotime($process_month));
		$start_date    = date("Y-m-01", strtotime($process_month));
		$end_date      = $process_month .'-'. $num_of_days;
		$table_name    = "att_".date("Y_m", strtotime($process_month));

		// dd($firstdayname .'=='. $firstday .'=='. $lastday);

		//PROCESS MONTH EXISTANCE CHECK
		if(!$this->db->table_exists($table_name))
		{
			return "Process month does not exist, please change your process month";
		}

		//SALARY BLOCK CHECK
		$sb = $this->db->where('block_month',$start_date)->where('unit_id',$unit_id)->get('pay_salary_block')->num_rows();
		if($sb > 0)
		{
			return "This Month Already Finally Processed.";
		}

		$prev_month = date("Y-m",strtotime("-1 month",strtotime($start_date)));
		$pvm = $this->db->where('block_month',$prev_month)->where('unit_id',$unit_id)->get('pay_salary_block')->num_rows();
		if($pvm < 1  && $unit_id != 4)
		{
			return "Please Finally Processed Previous Month..";
		}
		
		$arr = array('10','104','8','47','34','32');
		$this->db->select("
				id,
				emp_id,
				emp_dept_id,
				emp_sec_id,
				emp_line_id,
				emp_desi_id
				emp_cat_id,
				emp_join_date,
				gross_sal,
				com_gross_sal,
				ot_entitle,
			");
		$this->db->where("unit_id", $unit_id);
		$this->db->where_in("id", $grid_emp_id);
		$this->db->order_by("id");
		$query = $this->db->get("pr_emp_com_info");
		
		if($query->num_rows() == 0)
		{
			return "Employee information does not exist";
		}
		else
		{
			$data = array();
			$data_com 	= array();
			foreach($query->result() as $rows)
			{
				set_time_limit(0) ;
				ini_set("memory_limit","512M");
				
				//============ GENERAL INFORMATION ======================
				//=================================================================
				// $emp_name 		= $this->emp_name($rows->emp_id);
				// $emp_desig 		= $this->emp_desig($rows->emp_desi_id);
				$id 			= $rows->id; 
				$emp_id 		= $rows->emp_id; 
				$emp_dept_id	= $rows->emp_dept_id;
				$emp_sec_id 	= $rows->emp_sec_id;
				$emp_line_id	= $rows->emp_line_id;
				$desi_id 		= $rows->emp_desi_id;
				$emp_cat_id		= $rows->emp_cat_id;
				
				$doj 			= $rows->emp_join_date;
				$gross_sal 		= $rows->gross_sal;
				$gross_sal_com 	= $rows->com_gross_sal;
				$ot_check 		= $rows->ot_entitle;
				
				$sp_eligibility = $this->salary_process_eligibility($id, $start_date);
				
				if($sp_eligibility == true)
				{
					//========== FOR INCREMENT AND PROMOTION ================
					//==========================================================
					$where = "trim(substr(effective_month,1,7)) = '$start_date'";
					$this->db->select("new_salary");
					$this->db->where("new_emp_id", $id);
					$this->db->where($where);
					$inc_prom = $this->db->get("pr_incre_prom_pun");
					if($inc_prom->num_rows() > 0 )
					{
						$inc_p = $inc_prom->row();
						$gross_sal 		= $inc_p->new_salary;
						$gross_sal_com 	= $inc_p->new_salary;
					}
					//============= END INCREMENT AND PROMOTION ===============

					$ss 			= $this->common_model->salary_structure($gross_sal);
					$basic_sal 		= $ss['basic_sal'];
					$house_rent 	= $ss['house_rent'];
					$madical_allo 	= $ss['medical_allow'];
					$food_allow 	= $ss['food_allow'];
					$trans_allow 	= $ss['trans_allow'];
					$salary_structure = array(
						'basic_sal'   => $basic_sal,	
						'house_r' 	  => $house_rent,	
						'medical_a'   => $madical_allo,	
						'food_allow'  => $food_allow,	
						'trans_allow' => $trans_allow,
					);
					
					$data["emp_id"] 	= $id;
					$data["unit_id"] 	= $unit_id;
					$data["dept_id"] 	= $emp_dept_id;
					$data["sec_id"] 	= $emp_sec_id;
					$data["line_id"] 	= $emp_line_id;
					$data["desig_id"] 	= $desi_id;
					$data["emp_status"] = $emp_cat_id;
					$data["gross_sal"] 	= $gross_sal;
					
					$stop_salary		 = $this->stop_salary_check($id,$start_date);
					$data["stop_salary"] = $stop_salary;

					//COMPLIENCE
					$ssc 		= $this->common_model->salary_structure($gross_sal_com);
					$basic_sal_com 				= $ssc['basic_sal'];
					$house_rent_com 			= $ssc['house_rent'];
					$madical_allo_com 			= $ssc['medical_allow'];
					$food_allow_com 			= $ssc['food_allow'];
					$trans_allow_com 			= $ssc['trans_allow'];
					$salary_structure_com = array(
						'basic_sal'   => $basic_sal_com,	
						'house_r' 	  => $house_rent_com,	
						'medical_a'   => $madical_allo_com,	
						'food_allow'  => $food_allow_com,	
						'trans_allow' => $trans_allow_com,
					);

					
					$data_com["emp_id"] 		= $emp_id;
					$data_com["unit_id"] 		= $unit_id;
					$data_com["dept_id"] 		= $emp_dept_id;
					$data_com["sec_id"] 		= $emp_sec_id;
					$data_com["line_id"] 		= $emp_line_id;
					$data_com["desig_id"] 		= $desi_id;
					$data_com["emp_status"] 	= $emp_cat_id;
					$data_com["gross_sal"] 		= $gross_sal_com;
					$data_com["stop_salary"]	= 1;				
				//=========== END GENERAL INFORMATION ==================
				
				
				//========= PRESENT STATUS ========================
				//==============================================================
				$join_month = trim(substr($doj,0,7));

				$resign_check 	= $this->resign_check($emp_id, $process_month);
				$left_check 	= $this->left_check($emp_id, $process_month);

				if($resign_check != false and $process_month == $join_month){
					$total_days = $resign_check['resign_day'];
					$left_or_resign_date = $resign_check['resign_date'];
					$resign_data = $this->get_resign_month_dates($resign_check['resign_day'], $process_month);
					$resign_after_absent = $this->resign_day_count($resign_data['resign_3rd_date'],$resign_data['resign_2nd_count']);
					
					$search_date = $doj;
					$doj_data = $this->get_join_month_dates($doj);
					$doj_before_absent = $this->new_join_day_count($doj_data['doj_1st_date'], $doj_data['doj_3rd_date']);
					
					$before_after_absent = $resign_after_absent+$doj_before_absent;
				}
				elseif($left_check != false and $process_month == $join_month){
					$total_days = $left_check['left_day'];
					$left_or_resign_date = $left_check['left_date'];
					$resign_data = $this->get_resign_month_dates($left_check['left_day'], $process_month);
					if($process_month == $join_month){
						$search_date = $doj;
					}else{
						$search_date = $resign_data['resign_1st_date'];
					}
					$doj_data = $this->get_join_month_dates($doj);
					$doj_before_absent = $this->new_join_day_count($doj_data['doj_1st_date'], $doj_data['doj_3rd_date']);	
					$resign_after_absent = $this->resign_day_count($resign_data['resign_3rd_date'],$resign_data['resign_2nd_count']);
					$before_after_absent = $doj_before_absent+$resign_after_absent;
				}
				elseif($resign_check != false){
					$total_days = $resign_check['resign_day'];
					$left_or_resign_date = $resign_check['resign_date'];
					$resign_data = $this->get_resign_month_dates($resign_check['resign_day'], $process_month);
					$search_date = $resign_data['resign_1st_date'];
					$resign_after_absent = $this->resign_day_count($resign_data['resign_3rd_date'],$resign_data['resign_2nd_count']);
					$before_after_absent = $resign_after_absent;
				}
				elseif($process_month == $join_month){
					$search_date = $doj;
					$doj_data = $this->get_join_month_dates($doj);
					$doj_before_absent = $this->new_join_day_count($doj_data['doj_1st_date'], $doj_data['doj_3rd_date']);					
					$total_days = $num_of_days;
					$left_or_resign_date = $end_date;
					$before_after_absent = $doj_before_absent;
				}
				elseif($left_check != false){
					$total_days = $left_check['left_day'];
					$left_or_resign_date = $left_check['left_date'];
					$resign_data = $this->get_resign_month_dates($left_check['left_day'], $process_month);
					if($process_month == $join_month){
						$search_date = $doj;
					}	
					else{
						$search_date = $resign_data['resign_1st_date'];
					}
					$resign_after_absent = $this->resign_day_count($resign_data['resign_3rd_date'],$resign_data['resign_2nd_count']);
					$before_after_absent = $resign_after_absent;
				}
				else{
					$total_days = $num_of_days;
					$search_date = $start_date;
					$before_after_absent = 0;
					$left_or_resign_date = $end_date;
				}
	
				
				$absent = "A";
				$absent = $this->attendance_check($rows->emp_id,$absent,$total_days, $search_date);
				$attend = "P";
				$attend = $this->attendance_check($rows->emp_id,$attend,$total_days, $search_date);
				
				$leave_type = "cl";
				$cas_leave = $this->leave_db($rows->emp_id, $search_date, $left_or_resign_date, $leave_type);
				$leave_type = "sl";
				$sick_leave = $this->leave_db($rows->emp_id, $search_date, $left_or_resign_date, $leave_type);
				$leave_type = "el";
				$earn_leave = $this->leave_db($rows->emp_id, $search_date, $left_or_resign_date, $leave_type);
				$leave_type = "ml";
				$m_leave = $this->leave_db($rows->emp_id, $search_date, $left_or_resign_date, $leave_type);
				$leave_type = "wp";
				$wp_leave = $this->leave_db($rows->emp_id, $search_date, $left_or_resign_date, $leave_type);
				$leave_type = "do";
				$do_leave = $this->leave_db($rows->emp_id, $search_date, $left_or_resign_date, $leave_type);
				
				$total_leave 		= $cas_leave + $sick_leave + $m_leave + $earn_leave + $wp_leave;//e + $do_leave;
				$total_pay_leave 	= $cas_leave + $sick_leave + $m_leave + $earn_leave;// $wp_leave + $do_leave;
				
				$weekend = "W";
				$weekend = $this->attendance_check($rows->emp_id,$weekend,$total_days, $search_date);
				$holiday = "H";
				$holiday = $this->attendance_check($rows->emp_id,$holiday,$total_days, $search_date);
				
				//$num_working_days 	= $num_of_days - $weekend - $before_after_absent;
				$num_working_days 	= $num_of_days - $holiday - $weekend - $before_after_absent;
				$total_holiday 		= $weekend + $holiday;
				//echo $m_leave.'+'.$attend .'+'. $total_holiday .'+'. $total_pay_leave;
				$pay_days = $attend + $total_holiday + $total_pay_leave-$m_leave;
				
								
				$data["num_of_workday"] 		= $num_working_days;
				$data["att_days"] 				= $attend;
				$data["absent_days"] 			= $absent;
				$data["before_after_absent"] 	= $before_after_absent;
				
				$data["c_l"] 					= $cas_leave;
				$data["s_l"] 					= $sick_leave;
				$data["e_l"] 					= $earn_leave;
				$data["m_l"] 					= $m_leave;
				$data["wp"] 					= $wp_leave ;//+ $do_leave;
				$data["total_leave"] 			= $total_leave ;
				$data["total_pay_leave"] 		= $total_pay_leave ;
				
				$data["holiday"] 				= $holiday;
				$data["weekend"] 				= $weekend;
				$data["total_holiday"] 			= $total_holiday;
				$data["pay_days"] 				= $pay_days;
				
				//COMPLIENCE
				$data_com["num_of_workday"] 		= $num_working_days;
				$data_com["att_days"] 				= $attend;
				$data_com["absent_days"] 			= $absent;
				$data_com["before_after_absent"] 	= $before_after_absent;
				
				$data_com["c_l"] 					= $cas_leave;
				$data_com["s_l"] 					= $sick_leave;
				$data_com["e_l"] 					= $earn_leave;
				$data_com["m_l"] 					= $m_leave;
				$data_com["wp"] 					= $wp_leave ;//+ $do_leave;
				$data_com["total_leave"] 			= $total_leave ;
				$data_com["total_pay_leave"] 		= $total_pay_leave ;
				
				$data_com["holiday"] 				= $holiday;
				$data_com["weekend"] 				= $weekend;
				$data_com["total_holiday"] 			= $total_holiday;
				$data_com["pay_days"] 				= $pay_days;

				// echo "<pre>";print_r($data_com);exit();
				
				
				//==========END PRESENT sTATUS=================
				
				//=======DEDUCTION STATUS======================
				//==============================================================
				
				//========DEDUCTION STATUS=======================
				//==============================================================
				
				//==============================Maternity leave calculation==============================
				if($m_leave > 0)
				{
					$per_day_salary_for_gross = $gross_sal/$num_of_days;
					$ml_payment = round($m_leave * $per_day_salary_for_gross);
					// print_r($ml_payment);exit('ali');
					$data_ml["emp_id"] 			= $rows->emp_id;
					$data_ml["food_allow"] 		= $food_allow;
					$data_ml["trans_allaw"] 	= $trans_allow;
					$data_ml["basic_sal"] 		= $basic_sal;
					$data_ml["house_r"] 		= $house_rent;
					$data_ml["medical_a"] 		= $madical_allo;
					$data_ml["gross_sal"] 		= $gross_sal;
					$data_ml["total_days"] 		= $num_of_days;
					//$data_ml["num_of_workday"] 	= $no_working_days;
					$data_ml["m_leave"] 		= $m_leave;
					$data_ml["ml_payment"] 		= $ml_payment;
					$data_ml["salary_month"] 	= $start_date;
				}
				//ABSENT DEDUCTION FOR NON-COMPLIENCE		
				$sal_month = date("Y-m-d", mktime(0, 0, 0, $month_v, 1, $year_v));
				// print_r($data_com);exit;

				
				if($data_com["m_l"] !=''){
					$num_of_days_n = date('t',strtotime($sal_month));
				}
				else{
					$num_of_days_n = 30;
				}

				// print_r($num_of_days_n);exit;

				$p_sal_month = '2018-02-01';
				
				if( $sal_month > $p_sal_month){

					if($pay_days != 0){
						// echo $num_of_days_n .' = '. $num_of_days; exit();
						$absent = $absent + $wp_leave ;
						if($resign_check != false or $left_check != false){
							$before_after_deduct = $gross_sal / $num_of_days * $data["before_after_absent"];
							//$abs_deduction = $gross_sal / $num_of_days_n * $absent;
							$abs_deduction = $basic_sal / $num_of_days_n * $absent;
							$ml_deduct = $gross_sal / $num_of_days * $m_leave;
							$abs_deduction = round($abs_deduction + $before_after_deduct + $ml_deduct);
						}
						else if($salary_month == $join_month){
							$before_after_deduct = $gross_sal / $num_of_days * $data["before_after_absent"];
							//$abs_deduction = $gross_sal / $num_of_days_n * $absent;
							$abs_deduction = $basic_sal / $num_of_days_n * $absent;
							$ml_deduct = $basic_sal / $num_of_days_n * $m_leave;
							$abs_deduction = round($abs_deduction + $before_after_deduct + $ml_deduct);
						}
						else{
							//echo "here";
							$abs_deduction = $basic_sal / $num_of_days_n * $absent;
							$ml_deduct = $gross_sal / $num_of_days_n * $m_leave;
							// print_r($ml_deduct);exit('aaa');
							$abs_deduction = round($abs_deduction+$ml_deduct);
							//$abs_deduction = round($abs_deduction);
						}
					} else{
						$abs_deduction = $gross_sal;
					}
					
					
					//ABSENT DEDUCTION FOR COMPLIANCE
					if($pay_days != 0)
					{
						$absent = $absent + $wp_leave ;
						if($resign_check != false or $left_check != false)
						{
							$before_after_deduct = $gross_sal_com / $num_of_days * $data["before_after_absent"];
							$abs_deduction_com = $gross_sal_com / $num_of_days_n * $absent;
							$abs_deduction_com = round($abs_deduction_com + $before_after_deduct);
						}
						else if($salary_month == $join_month)
						{
							$before_after_deduct = $gross_sal_com / $num_of_days * $data["before_after_absent"];
							$abs_deduction_com = $basic_sal_com / $num_of_days_n * $absent;
							$abs_deduction_com = round($abs_deduction_com + $before_after_deduct);
						}
						else
						{
							$abs_deduction_com = $basic_sal_com / $num_of_days_n * $absent;
							$abs_deduction_com = round($abs_deduction_com);
						}
					}
					else
					{
						$abs_deduction_com = $gross_sal_com;
					}

				}
				else
				{
					if($pay_days != 0)
					{
						$absent = $absent + $wp_leave ;
						if($salary_month == $join_month or $resign_check != false or $left_check != false)
						{
							$before_after_deduct = $gross_sal / $num_of_days * $data["before_after_absent"];
							$abs_deduction = $gross_sal / $num_of_days_n * $absent;
							$ml_deduct = $basic_sal / $num_of_days * $m_leave;
							$abs_deduction = round($abs_deduction + $before_after_deduct + $ml_deduct);
							if($salary_month != $join_month and ($resign_check != false or $left_check != false) and $pay_days >= 15)
							{
								$before_after_deduct = $basic_sal / $num_of_days * $data["before_after_absent"];
								$abs_deduction = $basic_sal / $num_of_days * $absent;
								$ml_deduct = $basic_sal / $num_of_days * $m_leave;
								$abs_deduction = round($abs_deduction + $before_after_deduct+$ml_deduct);	
							}
						}
						else
						{
							$abs_deduction = $basic_sal / $num_of_days * $absent;
							$ml_deduct = $basic_sal / $num_of_days * $m_leave;
							$abs_deduction = round($abs_deduction+$ml_deduct);
						}
					}
					else
					{
						$abs_deduction = $gross_sal;
					}
					
					
					//ABSENT DEDUCTION FOR COMPLIANCE
					if($pay_days != 0)
					{
						$absent = $absent + $wp_leave ;
						if($salary_month == $join_month or $resign_check != false or $left_check != false)
						{
							$before_after_deduct = $gross_sal_com / $num_of_days * $data["before_after_absent"];
							$abs_deduction_com = $basic_sal_com / $num_of_days_n * $absent;
							$abs_deduction_com = round($abs_deduction_com + $before_after_deduct);
						}
						else
						{
							$abs_deduction_com = $basic_sal_com / $num_of_days * $absent;
							$abs_deduction_com = round($abs_deduction_com);
						}
					}
					else
					{
						$abs_deduction_com = $gross_sal_com;
					}

				}
				
				
				//ADVANCE LOAN
				// shahajahan 11-0502022
				$advance_deduct = $this->advance_loan_deduction($emp_id, $salary_month);
				/*	//Khalid 01-08-21
				if($emp_sec_id == 5 || $emp_sec_id == 6){
				$advance_deduct = 0;
				}else{
				$advance_deduct = $this->advance_loan_deduction($emp_id, $salary_month);
				}*/
				
				//DEDUCTION
				$deduct_hour 	= 0;
				$deduct_amount 	= 0;
				if($deduct_status == "No")
				{
					//******deduct hour *****************************************************************
					$this->db->select('deduction_hour');
					$this->db->where("trim(substr(shift_log_date,1,7)) = '$salary_month'");
					$this->db->where("emp_id",$rows->emp_id);
					$query_ded = $this->db->get('pr_emp_shift_log');
					$total_deduction_hour = 0;
					foreach ($query_ded->result() as $row)
					{
						$deduction_hour = $row->deduction_hour;
						$total_deduction_hour = $total_deduction_hour + $deduction_hour;
					}
					$deduct_hour = $total_deduction_hour;
					
					//******End deduct hour ************************************************************************
					
					//************************deduct amount***************************************************** 
					$per_day_salary = $basic_sal/$num_of_days;
					$per_hour_salary = $per_day_salary /8;
					//echo $per_hour_salary;
					$deduct_amount = $per_hour_salary *$total_deduction_hour;
					$deduct_amount = 0;//round($deduct_amount);
					//************************end deduct amount***************************************************** 
				}
				
				//LATE DEDUCTION
				$late_count = $this->get_late_count($emp_id,$year,$month);
				$late_deduct = floor($late_count /4);		// 4times late = 1 Day Absent. 
				//$late_deduct_amount = round($gross_sal / $num_working_days * $late_deduct);
				
				//STAMP
				$stamp = $salary_structure['stamp'];
				$absent_plus_before_after_absent = $absent + $data["before_after_absent"];
				if($absent_plus_before_after_absent == $num_of_days)
				{
					$stamp = 0;
				}
				
				//OTHERS DEDUCTION
				$others_deduct = $this->others_deduct_cal($emp_id, $year_month);
				if($others_deduct == '')
				{
					$others_deduct = 0;
				}
				if($gross_sal == 0)
				{
					$others_deduct = 0;
				}
				
				$tax_deduct = $this->tax_deduct_cal($emp_id, $year_month);
				if($tax_deduct == '')
				{
					$tax_deduct = 0;
				}
				if($gross_sal == 0)
				{
					$tax_deduct = 0;
				}
								
				$total_deduction = $advance_deduct + $abs_deduction + $others_deduct + $tax_deduct + $stamp;
				
				$data["abs_deduction"] 		= $abs_deduction;
				$data["late_count"] 		= $late_count;
				$data["late_deduct"] 		= 0;
				$data["deduct_hour"] 		= $deduct_hour;
				$data["deduct_amount"] 		= $deduct_amount;
				$data["adv_deduct"] 		= $advance_deduct;
				$data["others_deduct"] 		= $others_deduct;
				$data["tax_deduct"] 		= $tax_deduct;
				$data["stamp"] 				= $stamp;
				$data["total_deduct"] 		= $total_deduction;
				
				//COMPLIENCE
				$total_deduction_com = $advance_deduct + $abs_deduction_com + $others_deduct + $tax_deduct + $stamp ;//+ $deduct_amount;
				
				
				$data_com["abs_deduction"] 		= $abs_deduction_com;
				$data_com["late_count"] 		= $late_count;
				$data_com["late_deduct"] 		= 0;
				$data_com["deduct_hour"] 		= 0;
				$data_com["deduct_amount"] 		= 0;
				$data_com["adv_deduct"] 		= $advance_deduct;
				$data_com["others_deduct"] 		= $others_deduct;
				$data_com["tax_deduct"] 		= $tax_deduct;
				$data_com["stamp"] 				= $stamp;
				$data_com["total_deduct"] 		= $total_deduction_com;
				
				//===========================END OF DEDUCTION STATUS==================================
				
				
				//=============================ALLOWANCES========================================
				//===============================================================================
				
				//ATTN. BONUS
				//$condition_late = $this->common_model->get_setup_attributes('3'); //2==if one is late for 2 day then attendance bonus will be cancelled
				$att_bouns_present_day = $attend + $weekend;	
				$eligible_att_bonus_days = $num_of_days - $holiday;
							
				if($att_bouns_present_day == $eligible_att_bonus_days)
				{
					//if($late_count < $condition_late)
					if($late_count ==0)
					{
						 $att_bouns = $this->att_bouns_cal($emp_id);
					}
					else
					{
						$att_bouns = 0;
					}
				}
				else
				{
					$att_bouns = 0;
				}
				
				
				//HOLIDAY ALLOWANCE (APPLICABLE FOR OT = NO)
				$holiday_alo_count 			= 0;
				$holiday_allowance_rate 	= 0;
				$holiday_allowance 			= 0;
				if($ot_check == 1){
					$holiday_alo_count 				= $this->get_holiday_alo_count($emp_id,$year,$month);
					$holiday_allowance_data 		= $this->holiday_allaw_cal($emp_id,$holiday_alo_count,$desi_id);
					$holiday_allowance 				= $holiday_allowance_data['holiday_allowance'];
					$holiday_allowance_rate 		= $holiday_allowance_data['holiday_allowance_rate'];
				}
				
				
				//HOLIDAY ALLOWANCE (APPLICABLE FOR OT = NO)
				$weekend_alo_count 			= 0;
				$weekend_allowance_rate 	= 0;
				$weekend_allowance 			= 0;
				if($ot_check == 1){
					$weekend_alo_count 				= $this->get_weekend_alo_count($emp_id,$year,$month);
					$weekend_allowance_data 		= $this->weekend_allaw_cal($emp_id,$weekend_alo_count,$desi_id);
					$weekend_allowance 				= $weekend_allowance_data['weekend_allowance'];
					$weekend_allowance_rate 		= $weekend_allowance_data['weekend_allowance_rate'];
				}
				
				
				//Night ALLOWANCE (APPLICABLE FOR OT = NO)
				/*if($ot_check == 0)
				{
					$night_alo_count 		= 0;
					$night_allowance_rate 	= 0;
					$night_allowance 		= 0;

				}
				else
				{*/
					$night_alo_count 			= $this->get_night_alo_count($emp_id,$year,$month);
					$night_allowance_data 		= $this->night_allaw_cal($emp_id,$night_alo_count,$desi_id);
					$night_allowance 			= $night_allowance_data['night_allowance'];
					$night_allowance_rate 		= $night_allowance_data['night_allowance_rate'];
				//}
				
				$total_allaw = $weekend_allowance + $holiday_allowance + $night_allowance;
				

				$data["att_bonus"] 				= $att_bouns;
				$data["holiday_alo_count"] 		= $holiday_alo_count;
				$data["holiday_allowance"] 		= $holiday_allowance;
				$data["holiday_allowance_rate"] = $holiday_allowance_rate;
				
				$data["weekend_alo_count"] 		= $weekend_alo_count;
				$data["weekend_allowance"] 		= $weekend_allowance;
				$data["weekend_allowance_rate"] = $weekend_allowance_rate;
				
				$data["night_alo_count"] 		= $night_alo_count;
				$data["night_allowance"] 		= $night_allowance;
				$data["night_allowance_rate"] 	= $night_allowance_rate;

				$data["total_allaw"] 			= $total_allaw;
				
				//COMPLIENCE
				$data_com["att_bonus"] 				= $att_bouns;
				$data_com["holiday_alo_count"] 		= $holiday_alo_count;
				$data_com["holiday_allowance"] 		= $holiday_allowance;
				$data_com["holiday_allowance_rate"] = $holiday_allowance_rate;
				
				$data_com["night_alo_count"] 		= $night_alo_count;
				$data_com["night_allowance"] 		= $night_allowance;
				$data_com["night_allowance_rate"] 	= $night_allowance_rate;

				$data_com["total_allaw"] 			= $total_allaw;
				
				
				//=========================================OVERTIME CALCULATION=============================================
				//==========================================================================================================
				
				//OT CALCULATION
				$ot_rate = $salary_structure['ot_rate'];
				if($ot_check == 0)
				{
					$ot_hour = $this->ot_hour($rows->emp_id, $year_month, $ot_rate);
					if($ot_hour == '')
					{
						$ot_hour = 0;
					}
					else
					{
						$ot_hour = $ot_hour;
					}
				}
				else
				{
				  $ot_hour = 0;
				  
				}
				// echo $ot_hour;exit;
				$ot_amount = round($ot_hour * $ot_rate);

				
				//EXTRA OT CALCULATION
				if($ot_check == 0)
				{
					$collect_eot_hour = $this->eot_hour($emp_id, $year_month);
					$ot_eot_12am_hour = $this->ot_eot_12am_hour($emp_id, $year_month);
					$ot_eot_4pm_hour = $this->ot_eot_4pm_hour($emp_id, $year_month);
					//THIS EOT IS INTRODUCE FOR SUPER ADMIN PRIVILEGE IN ACL
					$eot_hour_for_sa = $this->eot_hour_for_super_admin($emp_id, $year_month);
					
					$modify_eot_hour = $this->modify_eot_hour($emp_id, $year_month);
					if($ot_hour == '')
					{
						$collect_eot_hour = 0;
						$ot_eot_12am_hour = 0;
						$ot_eot_4pm_hour = 0;
						$modify_eot_hour = 0;
					}
					if($eot_hour_for_sa == '')
					{//echo "ase";
						$eot_hour_for_sa = 0;
					}
				}
				else
				{
				  $collect_eot_hour = 0;
				  $ot_eot_12am_hour = 0;
				  $ot_eot_4pm_hour = 0;
				  $modify_eot_hour = 0;
				  $eot_hour_for_sa = 0;
				}
				
				$eot_hour = $collect_eot_hour + $modify_eot_hour - $deduct_hour;
				//$ot_eot_12am_hr = $ot_eot_12am_hour + $modify_eot_hour - $deduct_hour;
				$ot_eot_12am_hr = $ot_eot_12am_hour;
				//$ot_eot_4pm_hr = $ot_eot_4pm_hour + $modify_eot_hour - $deduct_hour;
				$ot_eot_4pm_hr = $ot_eot_4pm_hour;
				
				$eot_amount = round($eot_hour * $ot_rate);
				$ot_eot_12am_amount = round($ot_eot_12am_hr * $ot_rate);
				$ot_eot_4pm_amount = round($ot_eot_4pm_hr * $ot_rate);
				
				//THIS EOT AMOUNT IS ALSO INTRODUCE FOR SUPER ADMIN PRIVILEGE IN ACL
				$eot_amount_for_sa = round($eot_hour_for_sa * $ot_rate);
				if($eot_hour<0)
				{
					$eot_amount=0;
					$ot_eot_12am_amount = 0;
					$ot_eot_4pm_amount = 0;
				}
				
				if($eot_hour_for_sa<0)
				{
					$eot_amount_for_sa=0;
					$ot_eot_12am_amount = 0;
					$ot_eot_4pm_amount = 0;
				}
				
				$data["ot_hour"] 			= $ot_hour;
				$data["ot_amount"] 			= $ot_amount;
				$data["ot_rate"] 			= $ot_rate;
				$data["collect_eot_hour"] 	= $collect_eot_hour;
				$data["modify_eot_hour"] 	= $modify_eot_hour;
				$data["eot_hour"] 			= $eot_hour;
				$data["eot_amount"] 		= $eot_amount;
				$data["ot_eot_12am_hour"] 	= $ot_eot_12am_hr;
				$data["ot_eot_12am_amt"] 	= $ot_eot_12am_amount;
				$data["ot_eot_4pm_hour"] 	= $ot_eot_4pm_hr;
				$data["ot_eot_4pm_amt"] 	= $ot_eot_4pm_amount;
				$data["salary_month"] 		= $start_date;
				$data["eot_hr_for_sa"] 		= $eot_hour_for_sa;
				$data["eot_amt_for_sa"] 	= $eot_amount_for_sa;
				
				
				//COMPLIENCE
				$data_com["ot_hour"] 			= $ot_hour;
				$data_com["ot_amount"] 			= $ot_amount;
				$data_com["ot_rate"] 			= $ot_rate;

				$data_com["collect_eot_hour"] 	= $collect_eot_hour;
				$data_com["modify_eot_hour"] 	= $modify_eot_hour;
				$data_com["eot_hour"] 			= $eot_hour;
				$data_com["eot_amount"] 		= $eot_amount;
				$data_com["ot_eot_12am_hour"] 	= $ot_eot_12am_hr;
				$data_com["ot_eot_12am_amt"] 	= $ot_eot_12am_amount;
				$data_com["ot_eot_4pm_hour"] 	= $ot_eot_4pm_hr;
				$data_com["ot_eot_4pm_amt"] 	= $ot_eot_4pm_amount;
				$data_com["salary_month"] 		= $start_date;
		
				//***************************Festival bonus***********************

				$festival_bonus 	= 0;
				$festival_bonus_com = 0;
				$data["festival_bonus"] 	= $festival_bonus;
				$data_com["festival_bonus"] = $festival_bonus_com;
				
				//***************************End of Festival bonus***********************//
				
				//***Net Pay Edited By Tarek On 22-10-2016 For Stapm Deduction Whose Net Pay less than 500***//
				$net_pay = $gross_sal + $att_bouns + $ot_amount - $total_deduction ;
				
				if($net_pay < 510)
				{
					$data["stamp"] 				= 0;
					$data["total_deduct"] 		= $advance_deduct + $abs_deduction + $others_deduct + $tax_deduct + 0;
					
					$data["net_pay"] 			= $net_pay;   // ($net_pay + 10) remove 28-11-2023
				}
				else
				{
					$data["net_pay"] = $net_pay;
				}
				
				
				//COMPLIENCE
				$net_pay_com = $gross_sal_com + $att_bouns + $ot_amount - $total_deduction_com ;//Zuel 140420
				
				if($net_pay_com < 510)
				{
					$data_com["stamp"] 				= 0;
					$data_com["total_deduct"] 		= $advance_deduct + $abs_deduction_com + $others_deduct + $tax_deduct + 0 ;
					
					$data_com["net_pay"] 			= $net_pay_com;  // ($net_pay_com + 10) remove 28-11-2023
				}
				else
				{
					$data_com["net_pay"] = $net_pay_com;
				}

				//print_r($data);
				// echo "<pre>";print_r($data);exit;

				$this->db->select("emp_id");
				$this->db->where("emp_id", $rows->emp_id);
				$this->db->where("salary_month", $start_date);
				$query = $this->db->get("pr_pay_scale_sheet");
				
				if($query->num_rows() > 0 )
				{
					//echo "hello";
					$this->db->where("emp_id", $rows->emp_id);
					$this->db->where("salary_month", $start_date);
					$this->db->update("pr_pay_scale_sheet",$data);
				}
				else
				{
					$this->db->insert("pr_pay_scale_sheet",$data);

				}
				
				
				//COMPLIENCE
				$this->db->select("emp_id");
				$this->db->where("emp_id", $rows->emp_id);
				$this->db->where("salary_month", $start_date);
				$query = $this->db->get("pr_pay_scale_sheet_com");

				// echo "<pre>";print_r($data_com);exit;
				
				if($query->num_rows() > 0 )
				{
					//echo "hello";
					$this->db->where("emp_id", $rows->emp_id);
					$this->db->where("salary_month", $start_date);
					$this->db->update("pr_pay_scale_sheet_com",$data_com);
				}
				else
				{
					$this->db->insert("pr_pay_scale_sheet_com",$data_com);
				}
			}
		}
			//$data["deduct_status"] = $deduct_status;
			return "Process completed successfully";
		}
	}
	
	function salary_process_eligibility($emp_id, $salary_month)
	{
		$salary_year_month = date('Y-m', strtotime($salary_month));
		
		$join_check 		= $this->join_range_check($emp_id, $salary_year_month);
		$resign_check 		= $this->resign_range_check($emp_id, $salary_year_month);
		$left_check 		= $this->left_range_check($emp_id, $salary_year_month);
		$zero_gross_check 	= $this->zero_gross_check($emp_id);
		
		if($join_check != false and $resign_check != false and $left_check != false and $zero_gross_check != false )
		{
				return true;
		}
		else
		{
			return false;
		}
	}

	function zero_gross_check($emp_id)
	{
		$this->db->select('gross_sal');
		$this->db->where('id', $emp_id);
		$this->db->where("gross_sal !=","0");
		$query = $this->db->get('pr_emp_com_info');
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
	
	function join_range_check($emp_id, $salary_year_month)
	{
		$this->db->select('emp_join_date');
		$this->db->where('id', $emp_id);
		$this->db->where("trim(substr(emp_join_date,1,7)) <= '$salary_year_month'");
		$query = $this->db->get('pr_emp_com_info');
		if($query->num_rows() > 0)
		{
			return true;
		}	
		else
		{
			return false;	
		}
	}
	
	function resign_range_check($emp_id, $salary_year_month)
	{
		$this->db->select('resign_date');
		$this->db->where('emp_id', $emp_id);
		$query = $this->db->get('pr_emp_resign_history');
		if($query->num_rows() == 0)
		{
			return true;
		}	
		else
		{
			$this->db->select('resign_date');
			$this->db->where('emp_id', $emp_id);
			$this->db->where("trim(substr(resign_date,1,7)) >= '$salary_year_month'");
			$query = $this->db->get('pr_emp_resign_history');
			if($query->num_rows() > 0)
			{
				return true;
			}	
			else
			{
				return false;	
			}
		}
	}
	
	function left_range_check($emp_id, $salary_year_month)
	{
		$this->db->select('left_date');
		$this->db->where('emp_id', $emp_id);
		$query = $this->db->get('pr_emp_left_history');
		if($query->num_rows() == 0)
		{
			return true;
		}	
		else
		{
			$this->db->select('left_date');
			$this->db->where('emp_id', $emp_id);
			$this->db->where("trim(substr(left_date,1,7)) >= '$salary_year_month'");
			$query = $this->db->get('pr_emp_left_history');
			if($query->num_rows() > 0)
			{
				return true;
			}	
			else
			{
				return false;	
			}
		}
	}

	function stop_salary_check($emp_id,$start_date)
	{
		$salary_month = date("Y-m", strtotime($start_date)); 
		$num_rows = $this->db->where("emp_id",$emp_id)->like("salary_month",$salary_month)->get('pay_emp_stop_salary')->num_rows();
		
		if($num_rows > 0)
		{
			$stop_salary = 2;
		} else {
			$stop_salary = 1;
		}
		return $stop_salary;
	}
	
	function resign_check($emp_id, $salary_month){
		$where = "trim(substr(resign_date,1,7)) = '$salary_month'";
		$this->db->select('resign_date');
		$this->db->where('emp_id', $emp_id);
		$this->db->where($where);
		$query = $this->db->get('pr_emp_resign_history');
		//echo $this->db->last_query();
		if($query->num_rows() == 0){
			return false;
		}else{
			$data = array();
			$data['resign_date'] = $query->row()->resign_date;
			$data['resign_day'] = substr($data['resign_date'], 8,2);
			return $data;
		}	
	}
	
	function left_check($emp_id, $salary_month)
	{
		$where = "trim(substr(left_date,1,7)) = '$salary_month'";
		$this->db->select('left_date');
		$this->db->where('emp_id', $emp_id);
		$this->db->where($where);
		$query = $this->db->get('pr_emp_left_history');
		//echo $this->db->last_query();
		if($query->num_rows() == 0)
		{
			return false;
		}
		else
		{
			$data = array();
			$data['left_date'] = $query->row()->left_date;
			$data['left_day'] = substr($data['left_date'], 8,2);
			return $data;
		}	
	}









	//////////////////// old code /////////////////////////////
	
	function get_tiffin_allowance_rules_data()
	{
		$this->db->select('*');
		$this->db->from('pr_tiffin_allowance_rules');
		$this->db->where("rules_id", "1");
		$query = $this->db->get();
		$row = $query->row();
		$data['first_tiffin_time'] 	= $row->first_tiffin_time;
		$data['first_tiffin_allo'] 	= $row->first_tiffin_allo;
		$data['second_tiffin_time'] = $row->second_tiffin_time;
		$data['second_tiffin_allo'] = $row->second_tiffin_allo;
		return $data;
		
	}
	function get_desig_bonus_rules($effective_date,$desig_id)
	{
		$this->db->select('pr_desig_bonus_rules.bonus_amount,pr_desig_bonus_rules.rules_name');
		$this->db->from('pr_desig_bonus_rules');
		$this->db->from('pr_desig_bonus_level');
		$this->db->where("pr_desig_bonus_rules.rules_id = pr_desig_bonus_level.rules_id");
		$this->db->where("pr_desig_bonus_level.desig_id", $desig_id);
		$query = $this->db->get();
		if($query->num_rows()>0)
		{
			$row = $query->row();
			$data['bonus_amount'] = $row->bonus_amount;
			$data['rules_name'] = $row->rules_name;
			$data['msg'] = "OK";
		}
		else
		{
			$rules_id = 0;
			$data['msg'] = "NULL";
		}
		//echo "=====".$this->db->last_query();
		return $data;
	}
	
	function holiday_allaw_cal($emp_id,$holiday_alo_count,$desi_id)
	{
		$holiday_allowance_rules = $this->get_holiday_allowance_rules($desi_id);
		
		if($holiday_allowance_rules['msg'] == "OK" )
		{
				$holiday_allowance_rate = $this->db->where("rules_id",$holiday_allowance_rules['rules_id'])->get('pr_holiday_allowance_rules')->row()->allowance_amount;
				$holiday_allowance	 	= $holiday_allowance_rate * $holiday_alo_count;
		}
		else
		{
			$holiday_allowance 			= 0;
			$holiday_allowance_rate  	= 0;
		}
		$data['holiday_allowance_rate'] = $holiday_allowance_rate;
		$data['holiday_allowance'] 		= $holiday_allowance;
		return $data;
	}
	function get_holiday_allowance_rules($desig_id)
	{
		$this->db->select('rules_id');
		$this->db->from('pr_holiday_allowance_level');
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
		return $data;
	}
	function get_holiday_alo_count($emp_id,$year,$month){
		$year_month = $year."-".$month;
		$this->db->where("trim(substr(shift_log_date,1,7)) = '$year_month'");
		$this->db->where('emp_id', $emp_id);
		$this->db->where('holiday_allowance', '1');
		$this->db->from('pr_emp_shift_log');
		return  $this->db->count_all_results();
	
	}
	
	function weekend_allaw_cal($emp_id,$weekend_alo_count,$desi_id)
	{
		$weekend_allowance_rules = $this->get_weekend_allowance_rules($desi_id);
		
		if($weekend_allowance_rules['msg'] == "OK" )
		{
				$weekend_allowance_rate = $this->db->where("rules_id",$weekend_allowance_rules['rules_id'])->get('pr_weekend_allowance_rules')->row()->allowance_amount;
				$weekend_allowance	 	= $weekend_allowance_rate * $weekend_alo_count;
		}
		else
		{
			$weekend_allowance 			= 0;
			$weekend_allowance_rate  	= 0;
		}
		$data['weekend_allowance_rate'] = $weekend_allowance_rate;
		$data['weekend_allowance'] 		= $weekend_allowance;
		return $data;
	}
	function get_weekend_allowance_rules($desig_id)
	{
		$this->db->select('rules_id');
		$this->db->from('pr_weekend_allowance_level');
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
		return $data;
	}
	function get_weekend_alo_count($emp_id,$year,$month)
	{
		$year_month = $year."-".$month;
		$this->db->where("trim(substr(shift_log_date,1,7)) = '$year_month'");
		$this->db->where('emp_id', $emp_id);
		$this->db->where('weekly_allo', '1');
		$this->db->from('pr_emp_shift_log');
		return  $this->db->count_all_results();
	
	}
	
	function night_allaw_cal($emp_id,$night_alo_count,$desi_id)
	{
		$night_allowance_rules = $this->get_night_allowance_rules($desi_id);
		
		if($night_allowance_rules['msg'] == "OK" )
		{
				$night_allowance_rate = $this->db->where("rules_id",$night_allowance_rules['rules_id'])->get('pr_night_allowance_rules')->row()->night_allowance;
				$night_allowance	 	= $night_allowance_rate * $night_alo_count;
		}
		else
		{
			$night_allowance 		= 0;
			$night_allowance_rate  	= 0;
		}
		$data['night_allowance_rate'] 	= $night_allowance_rate;
		$data['night_allowance'] 		= $night_allowance;
		return $data;
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
		return $data;
	}
	function get_night_alo_count($emp_id,$year,$month)
	{
		$year_month = $year."-".$month;
		$this->db->where("trim(substr(shift_log_date,1,7)) = '$year_month'");
		$this->db->where('emp_id', $emp_id);
		$this->db->where('night_allo', '1');
		$this->db->from('pr_emp_shift_log');
		return  $this->db->count_all_results();
	
	}
	function get_tiffin_alo_count($emp_id,$year,$month,$first_tiffin_allo)
	{
		$year_month = $year."-".$month;
		$this->db->where("trim(substr(shift_log_date,1,7)) = '$year_month'");
		$this->db->where('emp_id', $emp_id);
		$this->db->where('tiffin_allo',$first_tiffin_allo);
		$this->db->from('pr_emp_shift_log');
		return  $this->db->count_all_results();
	
	}
	function tiffin_allaw_cal($emp_id,$tiffin_count,$desig_id)
	{
		$tiffin_allowance_rules 	= $this->get_tiffin_allowance_rules_data();
		$tiffin_allowance 			= $tiffin_allowance_rules ['tiffin_amount'] * $tiffin_count;
		
		$data ['tiffin_allowance_rate'] =  $tiffin_allowance_rules ['tiffin_amount'];
		$data ['tiffin_allowance']		=  $tiffin_allowance;
		return $data;
	}
	/*function get_tiffin_allowance_rules_data()
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
	}*/
	function get_lunch_allaw_count($emp_id,$year,$month)
	{
		$year_month = $year."-".$month;
		$this->db->where("trim(substr(shift_log_date,1,7)) = '$year_month'");
		$this->db->where('emp_id', $emp_id);
		$this->db->where('launch_allowance', '1');
		$this->db->from('pr_emp_shift_log');
		return  $this->db->count_all_results();
	
	}	

	
	function emp_production($emp_prod)
	{
		$this->db->select("emp_id,salary_type");
		$this->db->where("emp_id",$emp_prod);
		$this->db->where("salary_type",2);
		$query = $this->db->get("pr_emp_com_info");
		if($query->num_rows == 1)
		{
			return $emp_prod;
		}
		else
		{
			return false ;
		}
	}
	
	function others_allaw_cal($emp_id, $salary_month)
	{
		$this->db->select("payment_amount");
		$this->db->where("emp_id", $emp_id);
		$this->db->like("payment_month",$salary_month);
		$query = $this->db->get("pr_payment");
		//echo $this->db->last_query();
		if($query->num_rows > 0)
		{
			$row = $query->row();
			return $row->payment_amount;
		}
		else
		{
			return 0;
		}
	}
	
	function ot_hour($emp_id, $year_month, $ot_rate)
	{
		$this->db->select_sum("ot_hour");
		$this->db->where("emp_id", $emp_id);
		$this->db->like("shift_log_date",$year_month);
		$query = $this->db->get("pr_emp_shift_log");
		//echo $this->db->last_query();
		$row = $query->row();
		return $row->ot_hour;
	}
	
	function modify_eot_hour($emp_id, $year_month)
	{
		$this->db->select_sum("modify_eot");
		$this->db->where("emp_id", $emp_id);
		$this->db->like("shift_log_date",$year_month);
		$query = $this->db->get("pr_emp_shift_log");
		$row = $query->row();
		return $row->modify_eot;
	}
	
	function eot_hour($emp_id, $year_month)
	{
		$this->db->select_sum("extra_ot_hour");
		$this->db->where("emp_id", $emp_id);
		$this->db->like("shift_log_date",$year_month);
		$query = $this->db->get("pr_emp_shift_log");
		//echo $this->db->last_query();
		$row = $query->row();
		return $row->extra_ot_hour;
	}
	
	function ot_eot_4pm_hour($emp_id, $year_month)
	{
		$this->db->select_sum("ot_eot_4pm");
		$this->db->where("emp_id", $emp_id);
		$this->db->like("shift_log_date",$year_month);
		$query = $this->db->get("pr_emp_shift_log");
		//echo $this->db->last_query();
		$row = $query->row();
		return $row->ot_eot_4pm;
	}
	
	function ot_eot_12am_hour($emp_id, $year_month)
	{
		$this->db->select_sum("ot_eot_12am");
		$this->db->where("emp_id", $emp_id);
		$this->db->like("shift_log_date",$year_month);
		$query = $this->db->get("pr_emp_shift_log");
		//echo $this->db->last_query();
		$row = $query->row();
		return $row->ot_eot_12am;
	}
	
	
	function eot_hour_for_super_admin($emp_id, $year_month)
	{
		$this->db->select_sum("extra_ot_hour");
		$this->db->where("emp_id", $emp_id);
		$this->db->where("present_status !=", 'W');
		$this->db->where("present_status !=", 'H');
		$this->db->like("shift_log_date",$year_month);
		$query = $this->db->get("pr_emp_shift_log");
		//echo $this->db->last_query();
		$row = $query->row();
		return $row->extra_ot_hour;
	}
	
	function ot_hour_between_date($emp_id, $start_date, $end_date)
	{
		$this->db->select_sum("ot_hour");
		$this->db->where("emp_id", $emp_id);
		$this->db->where("shift_log_date BETWEEN '$start_date' AND '$end_date'");
		$query = $this->db->get("pr_emp_shift_log");
		//echo $this->db->last_query();
		$row = $query->row();
		return $row->ot_hour;
	}
	
	function eot_hour_between_date($emp_id, $start_date, $end_date)
	{
		$this->db->select_sum("extra_ot_hour");
		$this->db->where("emp_id", $emp_id);
		$this->db->where("shift_log_date BETWEEN '$start_date' AND '$end_date'");
		$query = $this->db->get("pr_emp_shift_log");
		//echo $this->db->last_query();
		$row = $query->row();
		return $row->extra_ot_hour;
	}
	
	function att_bouns_cal($emp_id)
	{
		$this->db->select("pr_attn_bonus.ab_rule");
		$this->db->from("pr_attn_bonus");
		$this->db->from("pr_emp_com_info");
		$this->db->where("pr_emp_com_info.emp_id", $emp_id);
		$this->db->where("pr_emp_com_info.att_bonus = pr_attn_bonus.ab_id");
		$query = $this->db->get();
		$row = $query->row();
		return $row->ab_rule;
	}
	
	function transport_cal($emp_id)
	{
		$this->db->select("transport");
		$this->db->from("pr_emp_com_info");
		$this->db->where("emp_id", $emp_id);
		$query = $this->db->get();
		$row = $query->row();
		if($row->transport == 0 )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function lunch_allaw_cal($emp_id)
	{
		$this->db->select("lunch");
		$this->db->from("pr_emp_com_info");
		$this->db->where("emp_id", $emp_id);
		$query = $this->db->get();
		$row = $query->row();
		if($row->lunch == 0 )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function others_deduct_cal($emp_id, $year_month)
	{
		$this->db->select_sum("others_deduct");
		$this->db->where("emp_id", $emp_id);
		$this->db->like("deduct_month",$year_month);
		$query = $this->db->get("pr_deduct");
		//echo $this->db->last_query();
		$row = $query->row();
		return $row->others_deduct;
	}
	
	function tax_deduct_cal($emp_id, $year_month)
	{
		$this->db->select_sum("tax_deduct");
		$this->db->where("emp_id", $emp_id);
		$this->db->like("deduct_month",$year_month);
		$query = $this->db->get("pr_deduct");
		//echo $this->db->last_query();
		$row = $query->row();
		return $row->tax_deduct ;
	}
	
	function emp_name($emp_id)
	{
		$this->db->select("emp_full_name");
		$this->db->where("emp_id",$emp_id);
		$query = $this->db->get("pr_emp_per_info");
		$row = $query->row();
		return $row->emp_full_name;
	}
	
	function emp_desig($desig_id)
	{
		$this->db->select("desig_name");
		$this->db->where("desig_id",$desig_id);
		$query = $this->db->get("pr_designation");
		$row = $query->row();
		return $row->desig_name;
	}
	
	function salary_grade($gr_id)
	{
		$this->db->select("gr_name");
		$this->db->where("gr_id",$gr_id);
		$query = $this->db->get("pr_grade");
		$row = $query->row();
		return $row->gr_name;
	}
	
	function attendance_check($emp_id,$present_status,$num_of_days, $start_date)
	{
		//echo "$present_status=> $num_of_days, $start_date***";
		$search_date =trim(substr($start_date,0,7));
		$loop_date = trim(substr($start_date,8,2));
		$this->db->select("");
		$this->db->where("emp_id",$emp_id);
		$this->db->like("att_month",$search_date);
		$query = $this->db->get("pr_attn_monthly");
		//echo $this->db->last_query();
		$count = 0;
		foreach($query->result_array() as $rows => $value)
		{
			for($i=$loop_date; $i<= $num_of_days ; $i++)
			{
				$idate = date("d", mktime(0, 0, 0, 0, $i, 0));
				$date="date_$idate";
				
				if($value[$date] == "$present_status")
				{
					$count++;
				}
			}
		}
		//echo "$present_status=$count###";
		return $count;
	}
	
	
	function insert_pay_sheet($data)
	{
		$this->db->insert('pr_pay_scale_sheet', $data); 
	}
	
	function update_pay_sheet($data)
	{
		$this->db->where("emp_id",$data['emp_id']);  
		$this->db->update('pr_pay_scale_sheet', $data);
		
	}
	
	function leave_db($emp_id,$start_date,$end_date, $leave_type)
	{
		$where = "trim(substr(start_date,1,10)) BETWEEN '$start_date' and '$end_date'";
		
		$this->db->select('start_date');
		$this->db->where("emp_id",$emp_id);
		$this->db->where("leave_type",$leave_type);
		$this->db->where($where);
		
		$query = $this->db->get('pr_leave_trans');
		
		return $query->num_rows();
	}
	
	function advance_loan_deduction($emp_id, $salary_month)
	{
		$search_year_month = $salary_month;
		$salary_month = "$salary_month-01";
				
		$this->db->select("*");
		$this->db->where("emp_id", $emp_id);
		$this->db->where("loan_status", '1');
		$query = $this->db->get("pr_advance_loan");
		//echo $query->num_rows();
		if( $query->num_rows() > 0)
		{
			$rows = $query->row();
			$loan_id	= $rows->loan_id;
			$loan_amt 	= $rows->loan_amt; 	
			$pay_amt  	= $rows->pay_amt;
			
			
			$this->db->select("emp_id,pay_amount");
			$this->db->where("emp_id", $emp_id);
			$this->db->where("loan_id", $loan_id);
			$this->db->like("pay_month", $salary_month);
			$query1 = $this->db->get("pr_advance_loan_pay_history");

			if( $query1->num_rows() == 0)
			{
				$this->db->select_sum("pay_amount");
				$this->db->where("emp_id", $emp_id);
				$this->db->where("loan_id", $loan_id);
				$query2 = $this->db->get("pr_advance_loan_pay_history");
				//echo $this->db->last_query();
				
				if( $query2->num_rows() > 0)
				{
					$row = $query2->row();
					$total_pay_amount = $row->pay_amount;
				}
				else
				{
					$total_pay_amount = 0;
				}
				
				$rest_loan_amount = $loan_amt - $total_pay_amount;
					
				if($rest_loan_amount > $pay_amt)
				{
					$data = array(
									'pay_id' 	=> '',
									'loan_id' 	=> $loan_id,
									'emp_id'  	=> $emp_id,
									'pay_amount'=> $pay_amt,
									'pay_month' => $salary_month
								);
					if($this->db->insert("pr_advance_loan_pay_history", $data))
					{
						return $pay_amt;
					}
				}
				else
				{
					$data = array(
									'pay_id' 	=> '',
									'loan_id' 	=> $loan_id,
									'emp_id'  	=> $emp_id,
									'pay_amount'=> $rest_loan_amount,
									'pay_month' => $salary_month
								);
					if($this->db->insert("pr_advance_loan_pay_history", $data))
					{
						$this->db->select_sum("pay_amount");
						$this->db->where("emp_id", $emp_id);
						$this->db->where("loan_id", $loan_id);
						$query2 = $this->db->get("pr_advance_loan_pay_history");
						//echo $this->db->last_query();
						
						if( $query2->num_rows() > 0)
						{
							$row = $query2->row();
							$total_pay_amount = $row->pay_amount;
							
							if($total_pay_amount == $loan_amt)
							{
								$data = array(
											'loan_status' => 2
											);
								$this->db->where("emp_id", $emp_id);
								$this->db->where("loan_id", $loan_id);
								$this->db->update("pr_advance_loan", $data);
							}
						}
						return $rest_loan_amount;
					}
				}
				
			}
			else
			{
				$row = $query1->row();
				$pay_amount = $row->pay_amount;
				return $pay_amount;
			}
		}
		else
		{
			$this->db->select("*");
			$this->db->where("emp_id", $emp_id);
			$this->db->where("loan_status", '2');
			$this->db->like("loan_date",$search_year_month);
			$query = $this->db->get("pr_advance_loan");
			
			if( $query->num_rows() > 0)
			{
				foreach($query->result() as $rows)
				{
					$loan_id	= $rows->loan_id;
					$loan_amt 	= $rows->loan_amt; 	
					$pay_amt  	= $rows->pay_amt;
				}
			
				$this->db->select("emp_id,pay_amount");
				$this->db->where("emp_id", $emp_id);
				$this->db->where("loan_id", $loan_id);
				$this->db->like("pay_month", $salary_month);
				$query1 = $this->db->get("pr_advance_loan_pay_history");
				if( $query1->num_rows() == 0)
				{
					return 0;
				}
				else
				{
					$row = $query1->row();
					$pay_amount = $row->pay_amount;
					return $pay_amount;
				}
			}
			else
			{
				return 0;
			}
		}
	}
	
	function get_bonus_status()
	{
		$this->db->select('*');
		$query_fes_bonus = $this->db->get('pr_bonus_rules');
		foreach($query_fes_bonus->result() as $rows)
		{
			$effective_date =  $rows->effective_date;
			list($fes_year, $fes_month, $fes_date) = explode('-', trim($effective_date));
			$fes_bonus_month_table = "att_".$fes_year."_".$fes_month;
		}
		return $fes_bonus_month_table;
	}
	
	function get_bonus_effective_date($salary_month)
	{
		$this->db->select('effective_date');
		$this->db->like('effective_date',$salary_month);
		$query = $this->db->get('pr_bonus_rules');
		//echo $this->db->last_query();
		if($query->num_rows() > 0 ){
			$row = $query->row();
			return $effective_date =  $row->effective_date;
		}else{
			return false;
		}
	}
	
	function get_service_month($effective_date,$doj)
	{
		$date_diff 		= strtotime($effective_date)-strtotime($doj);
		//DATE TO DATE RULE
		//return $month 	= floor(($date_diff)/2592000);
		
		//MONTH TO MONTH RULE
		//return $month 	= ceil(($date_diff)/2628000);
		$startdate = strtotime($doj);
		$enddate = strtotime($effective_date);

		return $numberOfMonths = abs((date('Y', $enddate) - date('Y', $startdate))*12 + (date('m', $enddate) - date('m', $startdate)))+1;
	}
	
	function get_festival_bonus_rule($service_month)
	{
		//echo $service_month;
		$data = array();
		$this->db->select('*');
		$this->db->where('bonus_first_month <=', $service_month); 
		$this->db->where('bonus_second_month >=', $service_month); 
		$this->db->order_by('effective_date','DESC');
		$this->db->limit(1);
		$query = $this->db->get('pr_bonus_rules');
		//echo $this->db->last_query();
		//echo 'R:'.$num = $query->num_rows().'|';
		$row = $query->row();
		if($query->num_rows() != 0)
		{
			$data['bonus_amount'] 		= $row->bonus_amount;
			$data['amount_fraction'] 	= $row->bonus_amount_fraction;
			$data['bonus_percent'] 		= $row->bonus_percent;
		}
		return $data;
	}
	
	function get_festival_bonus($festival_bonus_rule,$gross_sal,$basic_sal)
	{
		$bonus_amount 		= $festival_bonus_rule['bonus_amount'];
		$amount_fraction 	= $festival_bonus_rule['amount_fraction'];
		$bonus_percent 		= $festival_bonus_rule['bonus_percent']; 
		
		if($bonus_amount == "Gross")
		{
			$salary_for_bonus = $gross_sal;
		}
		else
		{
			$salary_for_bonus = $basic_sal; 
		}
		
		$pre_festival_bonus = $salary_for_bonus * $amount_fraction;
		$festival_bonus = round((($pre_festival_bonus * $bonus_percent)/100));
		return $festival_bonus;
	}
	
	function get_late_count($emp_id,$year,$month)
	{
		$year_month = $year."-".$month;
		$this->db->where("trim(substr(shift_log_date,1,7)) = '$year_month'");
		$this->db->where('emp_id', $emp_id);
		$this->db->where('late_status', '1');
		$this->db->from('pr_emp_shift_log');
		return  $this->db->count_all_results();
	
	}
	
	function get_join_month_dates($doj)
	{
		$data = array();
		$year 		= date('Y', strtotime($doj));
		$month 		= date('m', strtotime($doj));
		$day 		= date('d', strtotime($doj));
		$last_day 	= date('t', strtotime($doj));
		
		$data['doj_1st_date'] 	= date("Y-m-d", mktime(0, 0, 0, $month, 1, $year));
		$data['doj_2nd_date'] 	= date("Y-m-d", strtotime("-1 day",strtotime($doj)));
		$data['doj_1st_count'] 	= date("d", strtotime($data['doj_2nd_date']));
		$data['doj_3rd_date'] 	= $doj;
		$data['doj_2nd_count'] 	= $last_day;
		$data['doj_4th_date'] 	= date("Y-m-d", mktime(0, 0, 0, $month, $last_day, $year));
		
		return $data;
	}
	
	function get_resign_month_dates($resign_check, $salary_month)
	{
		$resign_date = "$salary_month-$resign_check";
		$data = array();
		$year 		= date('Y', strtotime($resign_date));
		$month 		= date('m', strtotime($resign_date));
		$day 		= date('d', strtotime($resign_date));
		$last_day 	= date('t', strtotime($resign_date));
		
		$data['resign_1st_date'] 	= date("Y-m-d", mktime(0, 0, 0, $month, 1, $year));
		$data['resign_2nd_date'] 	= date("Y-m-d", strtotime("-1 day",strtotime($resign_date)));
		$data['resign_1st_count'] 	= date("d", strtotime($data['resign_2nd_date']));
		$data['resign_3rd_date'] 	= $resign_date;
		$data['resign_2nd_count'] 	= $last_day;
		$data['resign_4th_date'] 	= date("Y-m-d", mktime(0, 0, 0, $month, $last_day, $year));
		
		return $data;
	}
	
	function resign_day_count($resign_date, $end_date_of_month)
	{
		$resign_day = date('d', strtotime($resign_date));
		return $resign_day_count = $end_date_of_month - $resign_day;
	}
	
	function new_join_day_count($first_day_of_month, $join_date)
	{
		$first_day_of_month = date('d', strtotime($first_day_of_month));
		$join_date = date('d', strtotime($join_date));	
		return $resign_day_count = $join_date - $first_day_of_month;
	}
	
	function deduction_hour_count($emp_id,$year,$month)
	{
		$year_month = "$year-$month";
		
		$this->db->select('SUM(deduction_hour) AS deduction_hour_count');	
		$this->db->where('emp_id', $emp_id);
		$this->db->like('shift_log_date', $year_month);
		$query = $this->db->get('pr_emp_shift_log');
		$row = $query->row();
		return $deduction_hour_count = $row->deduction_hour_count;
	}
	


}
?>