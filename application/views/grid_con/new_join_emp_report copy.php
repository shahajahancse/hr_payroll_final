<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>New Join Report</title>

<style>
	.bottom_txt_design
	{
		border-top:1px solid;
		width:160px;
		font-weight:bold;
	}
	.bottom_txt_manager_design
	{
		border-top:1px solid;
		width:170px;
	}
	table.main_table{
		border-collapse: collapse;
	}

	table.main_table tr,table.main_table tr td,table.main_table tr th{
	border: 1px solid #000000;

	}
</style>

</head>

<body style="">

<?php
$prev_sec = "";
$row_count=count($values["emp_name"]);
// $row_count = count($values["emp_id"]);
$max = $row_count;
$per_page_id = 27;
if($row_count > $per_page_id)
{
$page = ceil($row_count/$per_page_id);
}
else
{
$page=1;
}

$k = 0;

for ( $counter = 1; $counter <= $page; $counter ++)
{

?>

<!-- <table class="heading" align="center" height="auto" style="font-size:12px; width:750px;border:0px;">
	<tr height="70px">
		<td style="text-align:center;width: 70%;padding-left:150px;"> -->


		<?php

		if ($counter != 1) {
			echo '<div style="page-break-after: always;"></div>';

		}
		
		
		$this->load->view("head_english");?>

		<div style="font-size:13px; font-weight:bold; text-align: center;">
		 	NEW JOINING EMPLOYEES LIST</br>
			<?php
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
		</div>
		<!-- </td> -->
		<!-- <td style="text-align:right;width: 30%">
			< ?php echo '<span style="font-family:SutonnyMJ;font-size:15px;">'."পাতা নং # $counter <br>".'</span>';?>
		</td> -->
	<!-- </tr> -->
<!-- </table> -->


<table class="main_table" align="center" height="auto"  style="font-size:12px; width:750px;">
<th>SL</th>
<th>Emp ID</th>
<th>Emp Name</th>
<th>Designation</th>
<th>Line</th>
<th>Grade</th>
<th>OT Entitle</th>
<th>Att.Bonus</th>
<th>Joining Date</th>
<th>Salary</th>
<th>Remarks</th>

<?php

   	$j = 0;
	$section=array();

	for($i=0; $i<=$per_page_id; $i++)
	{

	if($prev_sec != $values["sec_name_en"][$k]){

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

		// echo "<tr bgcolor='#CCCCCC'>";
		// echo "<td colspan='11' style='font-size:16px'>Section :".$values["sec_name_en"][$k]."</td>";
		// echo "</tr>";
	}


	echo "<tr>";

	echo "<td>";
	echo $k +1;//= $i+1;
	echo "</td>";


	echo "<td  style='text-align:center; width:70px;'>";
	echo $values["emp_id"][$k];
	echo "</td>";

	echo "<td >";
	echo $values["emp_name"][$k];
	echo "</td>";

	//echo "<td style='text-align:center; width:100px;'>";
	//echo $values["sec_name"][$k];
	//echo "</td>";

	$prev_sec = $values["sec_name_en"][$k];

	echo "<td style='text-align:center; width:100px;'>";
	echo $values["desig_name"][$k];
	echo "</td>";

	echo "<td >";
	echo $values["line_name"][$k];
	echo "</td>";

	echo "<td  style='text-align:center; width:60px;'>";
	echo $values["gr_name"][$k];
	echo "</td>";

	echo "<td  style='text-align:center; width:60px;'>";
	if($values["ot_entitle"][$k] == 0)
	{
		echo "Yes";
	}
	else
	{
		echo "No";
	}
	echo "</td>";


	echo "<td  style='text-align:center; width:60px;'>";
	if($values["att_bonus"][$k] == 2)
	{
		echo "No";
	}
	else
	{
		echo $values["rule"][$k];
	}
	echo "</td>";


	echo "<td  style='text-align:center; width:70px;'>";
	$year= trim(substr($values["doj"][$k],0,4));
	$month = trim(substr($values["doj"][$k],5,2));
	$tarik = trim(substr($values["doj"][$k],8,2));
	$date_format = date("d-M-y", mktime(0, 0, 0, $month, $tarik, $year));
	echo $date_format;
	echo "</td>";

	echo "<td   style='text-align:center; width:80px;'>";
	echo $values["gross_sal"][$k];
	echo "</td>";


	echo "<td  style='text-align:center; width:70px;'>";
	echo "&nbsp";
	echo "</td>";

	echo "</tr>";

		$section=$values["sec_name_en"][$k];
		$k++;

		if($max==$k){
			break;
		}

		if ($j == $per_page_id) {
			?>
			<div style="page-break-after: always;"></div>

			<?php $this->load->view("head_english");?>

		<div style="font-size:13px; font-weight:bold; text-align: center;">
		 	NEW JOINING EMPLOYEES LIST</br>
			<?php
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
		</div>
		<!-- </td> -->
		<!-- <td style="text-align:right;width: 30%">
			< ?php echo '<span style="font-family:SutonnyMJ;font-size:15px;">'."পাতা নং # $counter <br>".'</span>';?>
		</td> -->
	<!-- </tr> -->
<!-- </table> -->


<table class="main_table" align="center" height="auto"  style="font-size:12px; width:750px;">
<th>SL</th>
<th>Emp ID</th>
<th>Emp Name</th>
<th>Designation</th>
<th>Line</th>
<th>Grade</th>
<th>OT Entitle</th>
<th>Att.Bonus</th>
<th>Joining Date</th>
<th>Salary</th>
<th>Remarks</th>



			
		<?php }





	}
	?>
		</table>
		

	<?php
	if($max==$k){
		break;
	}

 } ?>

</body>
</html>
<?php exit(); ?>
<!-- pata namber -->
<!-- <table height="80px" border="0" align="center" style="margin-bottom:50px; font-family:Arial, Helvetica, sans-serif; font-size:10px;width: 750px">
	<tr height="50%" >
	<td colspan="28"></td>
	</tr>
	<tr height="20%">
		<td  align="center" style="width:12%" ><dt class="bottom_txt_design" >Prepare By</dt></td>
		<td align="center"  style="width:12%" ><dt class="bottom_txt_design" >Manager(HR)</dt></td>
		<td  align="center" style="width:12%" ><dt class="bottom_txt_design" >Manager(Admin)</dt></td>
		<td  align="left" style="width:20%;"><dt class="bottom_txt_design" >GM(Admin, HRD & Compliance)</dt></td>
	</tr>

	</table> -->