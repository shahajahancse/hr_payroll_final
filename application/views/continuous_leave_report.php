<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Continuous <?php echo $status; ?> Report</title>
<link rel="stylesheet" type="text/css" href="../../../../../../css/SingleRow.css" />
</head>

<body style="margin: 0px;">

<?php 
$per_page_id = 20;
$row_count = count($values_2["emp_id"]);
$max = $row_count;
if($row_count >$per_page_id)
{
$page=ceil($row_count/$per_page_id);
}
else
{
$page=1;
}

$k = 0;

$total_leave_days = 0;
$cnt = 0;
for($counter = 1; $counter <= $page; $counter ++)
{
	$m = 0;
	$total_per_page_leave_days = 0;
	$cnt = $cnt + 1;

 ?>
<table class="heading" align="center" height="auto" style="font-size:12px; width:750px;border:0px;">
	<tr height="70px">
		<td style="text-align:center;width: 70%;padding-left:150px;">
		<?php $this->load->view("head_english");?><span style="font-size:13px; font-weight:bold; text-align: center;">
			<?php 
				echo $status.' Report from ';  

				$year= trim(substr($start_date,0,4));
				$month = trim(substr($start_date,5,2));
				$tarik = trim(substr($start_date,8,2));
				$date_format = date("d-M-Y", mktime(0, 0, 0, $month, $tarik, $year));
				echo $date_format;
				
				echo " - TO - ";
				
				$year= trim(substr($end_date,0,4));
				$month = trim(substr($end_date,5,2));
				$tarik = trim(substr($end_date,8,2));
				
				
				
				$date_format = date("d-M-Y", mktime(0, 0, 0, $month, $tarik, $year));
				echo $date_format;
				  
				?>
			</span>
		</td>
		<td style="text-align:right;width: 30%">
			<?php echo '<span style="font-family:SutonnyMJ;font-size:15px;">'."পাতা নং # $counter <br>".'</span>';?>
		</td>
	</tr>
</table>
<div align="center" style=" margin:0 auto; overflow:hidden; font-family: 'Times New Roman', Times, serif;">
<table border="1" align="center" style="border:1px solid; border-collapse: collapse; border-spacing: 10px;font-size:12px; width:750px; margin-bottom:0px;">

	<th>SL</th><th>Emp ID</th><th>Proxi ID</th><th>Name</th><!--<th>DOJ</th>--><th>Section</th><th>Designation</th>

	<?php 
		 if($status == "Leave"){
			 echo "<th>Leave Type</th>";
		 }
		  elseif($status == "Present"){
			 echo "<th>Present Type</th>";
		 }
		  elseif($status == "Absent"){
			 echo "<th>Absent Type</th>";
		}
	?>
	<th>From Date</th>
	<th>To Date</th>
	<th>Total Leave Between Date</th>
	<th>Enjoy Leave This Year</th>
	<th>Casual(10)</th>
	<th>Sick(14)</th>
	<th>Earn(18)</th>
	<th>Maternity(112)</th>
	<th>Purpose</th>

<?php
	$section=array();
	for($i=0; $i<=$per_page_id; $i++)
	{

	if($section!=$values_2["sec_name"][$k]){
		$i=$i+1;
		$row_count = $row_count+1;
		if($row_count >$per_page_id)
		{
		$page=ceil($row_count/$per_page_id);
		}
		else
		{
		$page=1;
		}

	echo "<tr bgcolor='#CCCCCC'>";
	echo "<td colspan='16' style='font-size:14px'>Section :&nbsp".$values_2["sec_name"][$k]."</td>";
	echo "</tr>";
	
	$cnt++;
	}

	echo "<tr>";
	
	echo "<td>";
	echo $s=$k+1;
	echo "</td>";
	
	echo "<td>";
	echo $values_2["emp_id"][$k];
	echo "</td>";
	
	echo "<td>";
	echo "&nbsp;";
	echo $values_2["prox_id"][$k];
	echo "</td>";
	
	echo "<td >";
	echo $values_2["full_name"][$k];
	echo "</td>";


	echo "<td>";
	echo $values_2["sec_name"][$k];
	echo "</td>";
	
	echo "<td >";
	echo $values_2["desig_name"][$k];
	echo "</td>";

	echo "<td style='text-transform: uppercase;width:75px;height:auto;'>";

	if($status == "Leave"){
	   $leave_data = $this->grid_model->continuous_multiple_leave_report($start_date,$end_date,$values_2["emp_id"][$k]);

		$leave = array();
		$date = array();
		foreach($leave_data as $rows){
				$leave_type = $rows['leave_type'];
				$leave[] = $leave_type;
				$date_item = $rows['start_date'];
				$date[] = $date_item;
			}
			echo $leave[0];
	}
	echo "</td>";

	echo "<td style='text-align:center'>";
	echo $date[0];
	echo "</td>";

	echo "<td style='text-align:center'>";
	echo end($date);
	echo "</td>";
	
	echo "<td style='text-align:center;width:80px;'>";
	echo $values_2["total"][$k];
	echo "</td>";

	$y = date('Y');
	$first_date = $y.'-01-01';
	$second_date = $y.'-12-31';

	echo "<td style='text-align:center;width:80px;'>";
	$total_enjoy_leave_this_year = $this->grid_model->total_enjoyable_leave($values_2["emp_id"][$k],$first_date,$second_date);
	echo $total_enjoy_leave_this_year;
	echo "</td>";

	
	echo "<td style='text-align:center'>";
	$total_cl_leave = $this->grid_model->total_year_pass_leave($values_2["emp_id"][$k],cl,$first_date,$second_date);
	$bal_cl = 10 - $total_cl_leave;
	if($bal_cl < 1){
		echo 0;
	}else{
		echo 'Bal('.$bal_cl.')';
	}
	echo "</td>";

	echo "<td style='text-align:center'>";
	$total_sl_leave = $this->grid_model->total_year_pass_leave($values_2["emp_id"][$k],sl,$first_date,$second_date);
	$bal_sl = 14 - $total_sl_leave;
	if($bal_sl < 1){
		echo 0;
	}else{
		echo 'Bal('.$bal_sl.')';
	}
	echo "</td>";

	echo "<td style='text-align:center'>";
	$total_el_leave = $this->grid_model->total_year_pass_leave($values_2["emp_id"][$k],el,$first_date,$second_date);
	$bal_el = 18 - $total_el_leave;
	if($bal_el < 1){
		echo 0;
	}else{
		echo 'Bal('.$bal_el.')';
	}
	echo "</td>";

	echo "<td style='text-align:center'>";
	$total_ml_leave = $this->grid_model->total_year_pass_leave($values_2["emp_id"][$k],ml,$first_date,$second_date);
	$bal_ml = 112 - $total_ml_leave;
	if($bal_ml < 1){
		echo 0;
	}else{
		echo 'Bal('.$bal_ml.')';
	}
	echo "</td>";

	echo "<td style='text-align:center;width:120px;'>";
	echo $values_2["leave_descrip"][$k];
	echo "</td>";
	echo "</tr>";

	
	
	$section=$values_2["sec_name"][$k];
	$total_per_page_leave_days = $total_per_page_leave_days + $values_2['total'][$k];
	$total_leave_days = $total_leave_days + $values_2['total'][$k];
	$m++;
	$k++;

	if($max==$k){
		break;
	}
}

	echo "<tr bgcolor='#CCCCCC'>";
	echo "<td colspan='6' style='font-size:14px'>Total :&nbsp".$m."</td>";
	echo "<td colspan='3' style='font-size:14px'>".' '."</td>";
	echo "<td colspan='7' style='font-size:14px'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$total_per_page_leave_days."</td>";
	echo "</tr>";

if($counter == $page){
	echo "<tr bgcolor='#CCCCCC'>";
	echo "<td colspan='6' style='font-size:14px'>Total :&nbsp".$m."</td>";
	echo "<td colspan='3' style='font-size:14px'>".' '."</td>";
	echo "<td colspan='7' style='font-size:14px'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$total_leave_days."</td>";
	echo "</tr>";
  }
 ?>
	<table width="750" height="65px" border="0" align="center" style="margin-bottom:70px; font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold;">
		<tr height="20%" >
			<td colspan="29"></td>
		</tr>
		<tr height="15%">
		<td  align="left" style="width:10%;"><dt class="bottom_txt_design" >Prepared By</dt></td>
		<td  align="left" style="width:10%;"><dt class="bottom_txt_design" >Manager(HR)</dt></td>
		<td  align="left" style="width:10%;"><dt class="bottom_txt_design" >Manager(Admin)</dt></td>
		<td  align="left" style="width:20%;"><dt class="bottom_txt_design" >GM(Admin, HRD & Compliance)</dt></td>
       <!--  <td align="left"  style="width:12%" ><dt class="bottom_txt_design" >হিসাব বিভাগ</dt></td>
        <td  align="left" style="width:12%" ><dt class="bottom_txt_design" >ব্যবস্থাপনা পরিচালক</dt></td> -->
		</tr>
	</table>

</table>
<div style="page-break-after: always;"></div>
</div>
<?php 
	if($max==$k){
		break;
	}
} ?>
</body>
</html>