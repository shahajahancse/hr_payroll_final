<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>
	Separation Report

</title>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/print.css" media="print" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/SingleRow.css" />
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
table,th,tr,td{
	margin:0px;
	padding:0px;
}
table.main_table{
	border-collapse: collapse;
}

table.main_table tr,table.main_table tr td,table.main_table tr th{
 border: 1px solid #000000;

}
</style>

</head>

<body>

<?php
$per_page_id = 46;
 $row_count=count($values["emp_name"]);
 $max = $row_count;
if($row_count > $per_page_id)
{
 $page = ceil($row_count/$per_page_id);
}
else
{
$page=1;
}

$k = 0;

 for($counter = 1; $counter <= $page; $counter ++)
 {
?>
<table class="heading" align="center" height="auto" style="font-size:12px; width:750px;border:0px;margin:0 auto;">
	<tr height="70px">
		<td style="text-align:center;width: 70%;padding-left:150px;">
		<?php $this->load->view("head_english");?><span style="font-size:13px; font-weight:bold; text-align: center;">
			Left Employee  Information </br>
				<?php
					$year= trim(substr($start_date,0,4));
					$month = trim(substr($start_date,5,2));
					$tarik = trim(substr($start_date,8,2));
					$date_format_1 = date("d-M-Y", mktime(0, 0, 0, $month, 1, $year));
					$lastday = date("t", mktime(0, 0, 0, $month, 1, $year));
					$date_format_2 = date("d-M-Y", mktime(0, 0, 0, $month, $lastday, $year));
					echo $date_format_1;

					echo " - TO - ";
					echo $date_format_2;

				?>
			</span>
		</td>
		<td style="text-align:right;width: 30%">
			<?php echo '<span style="font-family:SutonnyMJ;font-size:15px;">'."পাতা নং # $counter <br>".'</span>';?>
		</td>
	</tr>
</table>
<table class="main_table" align="center" height="auto"  style="font-size:11px; width:750px;margin:0 auto;">
<th>SL</th>
<th>Emp ID</th>
<th>Name</th>
<th>Designation</th>
<th>Line</th>
<th>Section</th>
<th>Date of Birth</th>
<th>Joining Date</th>
<th>Effective Date</th>
<th>Remarks</th>
<?php
	$section=array();

	for($i=0; $i<=$per_page_id;$i++)
	{

	if($section!=$values["sec_name_en"][$k]){
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
		echo "<td colspan='10' style='font-size:11px'>Section :&nbsp".$values["sec_name_en"][$k]."</td>";
		echo "</tr>";
   	}

	echo "<tr>";
	echo "<td>";
	echo $k+1;
	echo "</td>";

	echo "<td  style='text-align:center; width:70px; font-weight:bold;'>";
	echo $values["emp_id"][$k];
	echo "</td>";

	echo "<td >";
	echo $values["emp_name"][$k];
	echo "</td>";


	echo "<td >";
	echo $values["desig_name"][$k];
	echo "</td>";

	echo "<td >";
	echo $values["line_name"][$k];
	echo "</td>";

	echo "<td >";
	echo $values["sec_name_en"][$k];
	echo "</td>";

	echo "<td   style='text-align:center; width:70px;'>";
	$year= trim(substr($values["emp_dob"][$k],0,4));
	$month = trim(substr($values["emp_dob"][$k],5,2));
	$tarik = trim(substr($values["emp_dob"][$k],8,2));
	$date_format = date("d-M-y", mktime(0, 0, 0, $month, $tarik, $year));
	echo $date_format;
	echo "</td>";

	echo "<td  style='text-align:center; width:70px;'>";
	$year= trim(substr($values["doj"][$k],0,4));
	$month = trim(substr($values["doj"][$k],5,2));
	$tarik = trim(substr($values["doj"][$k],8,2));
	$date_format = date("d-M-y", mktime(0, 0, 0, $month, $tarik, $year));
	echo $date_format;
	echo "</td>";

	echo "<td   style='text-align:center; width:70px;'>";
	$year= trim(substr($values["e_date"][$k],0,4));
	$month = trim(substr($values["e_date"][$k],5,2));
	$tarik = trim(substr($values["e_date"][$k],8,2));
	$date_format = date("d-M-y", mktime(0, 0, 0, $month, $tarik, $year));
	echo $date_format;
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
	}
	?>
	<table width="750" height="60px" border="0" align="center" style="margin:0 auto 120px; font-family:Arial, Helvetica, sans-serif; font-size:10px;">
			<tr height="30%" >
				<td colspan="28"></td>
			</tr>
			<tr height="20%">
				<td  align="center" style="width:20%" ><dt class="bottom_txt_design" >Prepare By</dt></td>
		        <td align="center"  style="width:20%" ><dt class="bottom_txt_design" >Manager(HR)</dt></td>
				<td  align="center" style="width:20%" ><dt class="bottom_txt_design" >Manager(Admin)</dt></td>
		        <td  align="center" style="width:20%" ><dt class="bottom_txt_design" >GM</dt></td>
			</tr>
		</table>
	</table>
	<div style="page-break-after: always;"></div>
	<?php
	if($max==$k){
	break;
	}
} ?>
</body>
</html>
<?php exit(); ?>
