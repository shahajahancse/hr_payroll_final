<?php error_reporting(0);?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Extra OT Job Card</title>
<link rel="stylesheet" type="text/css" href="../../../../../../css/print.css" media="print" />
</head>

<body>

<?php 
//print_r($values);
$present_count = 0;
$absent_count = 0;
$leave_count = 0;
$ot_count = 0;
$late_count = 0;
$wk_off_count = 0;
$holiday_count = 0;

$emp_id_count = count($values["emp_id"]);

for($i = 0 ; $i < $emp_id_count; $i++)
{
/////////////////////////NEW add///////////
	$present_count = 0;
	$absent_count = 0;
	$leave_count = 0;
	$ot_count = 0;
	$late_count = 0;
	$wk_off_count = 0;
	$holiday_count = 0;
	$perror_count = 0;
	$total_ot_hour = 0;
/////////////////////
	$emp_id  = $values["emp_id"][$i];
	
	?>

	<div align="center" style=" margin:0 auto;  overflow:hidden; font-family: 'Times New Roman', Times, serif; min-height:1000px; margin-bottom:100px;">
		<div >
		<?php
		 $this->load->view("head_english");
		?>
		<span style="font-size:13px; font-weight:bold;">
			Extra OT Report from
			<?php 
			echo $grid_firstdate; 
			echo "- TO - ";
			echo $grid_seconddate; 
			?>
		</span>
		</div>
		<?php
		echo "<table border='0' style='font-size:13px;' width='480'>";
			echo "<tr>";
				echo "<td width='70'>";
				echo "<strong>Emp ID:</strong>";
				echo "</td>";
				echo "<td width='200'>";
				echo $values["emp_id"][$i];
				echo "</td>";
				echo "<td width='50'>";
				echo "<strong>Name :</strong>";
				echo "</td>";
				echo "<td width='150'>";
				echo $values["emp_full_name"][$i];
				echo "</td>";
			echo "</tr>";
			
			echo "<tr>";
				echo "<td >";
				echo "<strong>Proxi NO. :</strong>";
				echo "</td>";
				echo "<td >";
				echo $values["proxi_id"][$i];
				echo "</td>";
				
				echo "<td>";
				echo "<strong>Section :</strong>";
				echo "</td>";
				echo "<td >";
				echo $values["sec_name"][$i];
				echo "</td>";
			echo "</tr>";
			
			echo "<tr>";
				echo "<td>";
				echo "<strong>Line :</strong>";
				echo "</td>";
				echo "<td>";
				echo $values["line_name"][$i];
				echo "</td>";
				echo "<td>";
				echo "<strong>Desig :</strong>";
				echo "</td>";
				echo "<td>";
				echo $values["desig_name"][$i];
				echo "</td>";
			echo "</tr>";
			
			echo "<tr>";
				echo "<td>";
				echo "<strong>DOJ :</strong>";
				echo "</td>";
				echo "<td>";
				echo $values["emp_join_date"][$i];
				echo "</td>";
				
				echo "<td >";
				echo "<strong>Dept :</strong>";
				echo "</td>";
				echo "<td >";
				echo $values["dept_name"][$i];
				echo "</td>";
			echo "</tr>";
		echo "<table>";
		?>
		<br />
		<table cellpadding="2" cellspacing="0" border="1" style='font-size:13px;'>
		<th>Date</th><th>Day</th>
		<th>IN Time</th>
		<th>OUT Time</th>
		<th>Attn.Status</th>
		<th>OT Hour</th>
		<th>Extra OT</th>
		<!-- <th>Modify EOT</th> -->
		<th>OT Hour</th>
		<th>Remarks</th>
	<?php
	$shift_log_count = count($values[$emp_id]["shift_log_date"]);
	$ot_hour = 0;
	$extra_ot_hour = 0;
	$modify_eot = 0;
	$deduction_hour = 0;
	$total_final_eot = 0;
	
	
	for($k = 0 ; $k < $shift_log_count; $k++)
	{
		?>
		<tr>
		<td align="center"> 
		<?php 
		$shift_date =  $values[$emp_id]["shift_log_date"][$k]; 
		echo $shift_date = date("d-M-Y", strtotime($shift_date)); 
		?> 
		</td>
		
		<?php
		$date = $values[$emp_id]["shift_log_date"][$k];
		$day_cate = date('l',(strtotime ($date)));
		
		echo "<td style='text-align:center'>&nbsp;";
		echo $day_cate;
		echo "</td>";
		?>
		
		<td align="center"> 
		<?php 
		//$this->load->model('common_model'); 
		//$unit = $this->common_model->get_unit_id_name();
		$user_id = $this->acl_model->get_user_id($this->session->userdata('username'));
		$acl     = $this->acl_model->get_acl_list($user_id);
		
		$eot_hour   	= $values[$emp_id]["extra_ot_hour"][$k];
		$eot_modify 	= $values[$emp_id]["modify_eot"][$k];
		$eot_deduct 	= $values[$emp_id]["deduction_hour"][$k];
		
		
		if($values[$emp_id]["in_time"][$k] =='00:00:00')
		{
			echo "&nbsp;"; 
		}
		else 
		{
			$in_time =  $values[$emp_id]["in_time"][$k];
			$hour = trim(substr($in_time,0,2));
			$minute = trim(substr($in_time,3,2));
			$sec = trim(substr($in_time,6,2));
			echo $time_format = date("h:i:s A", mktime($hour, $minute, $sec, 0, 0, 0));  
		}	
		?> 
		</td>
		<td align="center"> 
		<?php 

			if($values[$emp_id]["out_time"][$k] =='00:00:00')
			{
				echo "&nbsp;"; 
			}
			else{
					$out_time =  $values[$emp_id]["out_time"][$k];
					$hour = trim(substr($out_time,0,2));
					$minute = trim(substr($out_time,3,2));
					$sec = trim(substr($out_time,6,2));
					echo $time_format = date("h:i:s A", mktime($hour, $minute, $sec, 0, 0, 0)); 
				}
	
		?> 
		</td>
		<?php echo "<td style='text-transform:uppercase;text-align:center'>";
		echo $values[$emp_id]["att_status"][$k];
		echo "</td>"; ?>
		<td align="center"> 
		<?php 
		echo $values[$emp_id]["ot_hour"][$k]; 
		$ot_hour = $ot_hour + $values[$emp_id]["ot_hour"][$k];
		?> 
		</td>
		<td align="center"> 
		
		<?php 
		echo $eot_hour;
		$extra_ot_hour = $extra_ot_hour + $eot_hour; 
		?> 

		
		<!-- <td align="center"> <?php echo $eot_modify; $modify_eot = $modify_eot + $eot_modify; ?> </td>
		<td align="center"> <?php echo $eot_deduct; $deduction_hour = $deduction_hour + $eot_deduct; ?> </td> -->
		
		<?php
		
		$final_eot = $eot_hour + $values[$emp_id]["ot_hour"][$k];
		//$final_eot = $eot_hour;
		
		?>
		<td align="center"> <?php echo $final_eot; $total_final_eot = $total_final_eot + $final_eot;?> </td>
		</td>
        <td><?php echo $values[$emp_id]["remark"][$k];?></td>
		</tr>
		<?php
	/////////////////////New Add////////
	if($values[$emp_id]["att_status"][$k] == "P")
		{
			$present_count++;
		}
		elseif($values[$emp_id]["att_status"][$k] == "A")
		{
			$absent_count++;
		}
		elseif($values[$emp_id]["att_status_count"][$k] == "Leave")
		{
			$leave_count++;
		}
		elseif($values[$emp_id]["att_status"][$k] == "P(Error)")
		{
			$perror_count++;
		}
		elseif($values[$emp_id]["att_status"][$k] == "Weekend")
		{
			$wk_off_count++;
		}
		elseif($values[$emp_id]["att_status"][$k] == "Holiday")
		{
			$holiday_count++;
		}
		
		
	if($values[$emp_id]["remark"][$k] == "Late")
		{
			$late_count++;
		}

		
	}
	?>
	<td style="font-weight:bold; text-align:center;" colspan="5"> Total </td>
	<td style="font-weight:bold; text-align:center;" align="center"><?php  echo  $ot_hour;?></td>
	<td style="font-weight:bold; text-align:center;" align="center"><?php echo  $extra_ot_hour;?></td>
	<!-- <td style="font-weight:bold; text-align:center;" align="center"><?php echo  $modify_eot;?></td> -->
	<td style="font-weight:bold; text-align:center;" align="center"><?php echo  $total_final_eot;?></td>
	<td style="font-weight:bold; text-align:center;" align="center"></td>
	
	</table>
<br/>
	<?php 
	//////////////New add////////////
	
	echo "<table border='0' style='font-size:13px;'>";
	echo "<tr align='center'>";
			
	echo "<td width='75' style='border-bottom:#000000 1px solid;'>";
	echo "PRESENT";
	echo "</td>";
			
	echo "<td width='75' style='border-bottom:#000000 1px solid;'>";
	echo "ABSENT";
	echo "</td>";
			
	echo "<td width='75' style='border-bottom:#000000 1px solid;'>";
	echo "LEAVE";
	echo "</td>";
			
	echo "<td width='75' style='border-bottom:#000000 1px solid;'>";
	echo "WORK OFF";
	echo "</td>";
			
	echo "<td width='75' style='border-bottom:#000000 1px solid;'>";
	echo "HOLIDAY";
	echo "</td>";
	
	echo "<td width='75' style='border-bottom:#000000 1px solid;'>";
	echo "PRESENT ERROR";
	echo "</td>";
		
	echo "<td width='75' style='border-bottom:#000000 1px solid;'>";
	echo "LATE COUNT";
	echo "</td>";
	
	echo "<td width='75' style='border-bottom:#000000 1px solid;'>";
	echo "OVERTIME";
	echo "</td>";
			
	echo "</tr>";
			
	echo "<tr align='center'>";
		
	echo "<td>";
	echo $present_count;
	echo "</td>";
		
	echo "<td>";
	echo $absent_count;
	echo "</td>";
	
	echo "<td>";
	echo $leave_count;
	echo "</td>";
			
	echo "<td>";
	echo $wk_off_count;
	echo "</td>";

	echo "<td>";
	echo $holiday_count;
	echo "</td>";
	
	echo "<td>";
	echo $perror_count;
	echo "</td>";
	
	echo "<td>";
	echo $late_count;
	echo "</td>";

	
	echo "<td>";
	//echo $total_ot_hour;
	//$over_time=$ot_hour + $total_final_eot;
	$over_time = $total_final_eot;
	echo $over_time;
	echo "</td>";
	
	echo "</tr>";
	echo "</table>";
	echo "<br />";
	
?>
	</div>
	<br />
	<?php
}

?>		

</body>
</html>