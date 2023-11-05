<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Daily
<?php
if ($daily_status == "A")
{
	echo "Absent";
}
elseif($daily_status == "P")
{
	echo "Present";
}
elseif($daily_status == "L")
{
	echo "Leave";
}

?>
 Report</title>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/print.css" media="print" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/SingleRow.css" />

</head>

<body style="margin: 0px;">

<?php
$per_page_id = 63;
$row_count = count($values["emp_id"]);
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
for($counter = 1; $counter <= $page; $counter ++)
{
 ?>
<div id="no_print" style="float:right;">
</div>
<?php
$this->load->view("head_english");
?>
<!--Report title goes here-->
<div align="center" style=" margin:0 auto;  overflow:hidden; font-family: 'Times New Roman', Times, serif;"><span style="font-size:12px; font-weight:bold;">
Daily
<?php
if ($daily_status == "A")
{
	echo "Absent";
}
elseif($daily_status == "P")
{
	echo "Present";
}
elseif($daily_status == "L")
{
	echo "Leave";
}

?> Report of <?php echo "$date/$month/$year"; ?></span>
<div style="clear: both;height: 20px;width: 100%"></div>
<table class="sal" border="1" cellpadding="0" cellspacing="0" align="center" style="font-size:11px; width:750px; margin-bottom:20px;">
<th>SL</th><th>Emp ID</th><th>Employee Name</th><th>Line No. </th> <th>Department </th> <th>Designation</th>

<?php
if($daily_status == "L"){
	echo "<th>Status</th>";
}
?>

<?php

if($daily_status == "P")
	{
		echo "<th>IN Time</th>";
		echo "<th>OUT Time</th>";
		echo "<th>Status</th>";
	}
?>

<?php
$section=array();

	for($i=0; $i<=$per_page_id; $i++)
	{

		if($section!=$values["sec_name"][$k]){

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
		echo "<td colspan='10' style='font-size:14px'>Section :&nbsp".$values["sec_name"][$k]."</td>";
		echo "</tr>";

	}

	echo "<tr>";

	echo "<td>";
	echo $s=$k+1 ;
	echo "</td>";

	echo "<td>";
	echo $values["emp_id"][$k];
	echo "</td>";

	echo "<td>";
	echo $values["emp_name"][$k];
	echo "</td>";

	echo "<td >";
	echo $values["line_name"][$k];
	echo "</td>";

	echo "<td >";
	echo $values["dept_name"][$k];
	echo "</td>";

	echo "<td>";
	echo $values["desig_name"][$k];
	echo "</td>";

	if($daily_status == "P")
	{
		echo "<td width='80' align='center'>";
		echo $in_time =  $values["in_time"][$k];
		echo "</td>";

		echo "<td width='80' align='center'>";

		echo $values["out_time"][$k];

		echo "</td>";
	}

	echo "<td style='text-align:center'>";
	echo $values["status"][$k];
	echo "</td>";

	echo "</tr>";
		$section=$values["sec_name"][$k];
		$k++;

		if($max==$k){
		break;
	}
}

?>

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
