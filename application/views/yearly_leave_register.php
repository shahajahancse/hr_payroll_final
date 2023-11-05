<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>
	General Employee Report

</title>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/print.css" media="print" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/SingleRow.css" />

<style>
		.bordered {
    border: 2px solid black;
    border-collapse: collapse;
	font-size:12px;
	border-radius:3px;
	
}
.bordered td, .bordered th {
    border: 1px solid #ffff;
	
}
.bordered th {
   background: #C9C9C9;
}
.bordered tr:nth-of-type(odd) {
    background-color: #F7F7F7;
}
 
.bordered tr:hover {
    background: #C9C9C9;
    -o-transition: all 0.1s ease-in-out;
    -webkit-transition: all 0.1s ease-in-out;
    -moz-transition: all 0.1s ease-in-out;
    -ms-transition: all 0.1s ease-in-out;
    transition: all 0.1s ease-in-out;     
}
	.emp_info{
		background:#DFDFFF;
	}
	


</style>
</head>

<body style="width:800px;">

<?php 
$row_count=count($values["emp_name"]);

?>

<table class="bordered" align="center" height="auto"border="1" cellspacing="0" cellpadding="2" style="font-size:12px; width:750px;">

<tr height="85px">

<td colspan="17" style="text-align:center;">
 
<?php
$this->load->view("head_english");?>

<span style="font-size:13px; font-weight:bold; text-align: center;">
Leave Register of <?php echo $year; ?>
</span>
</td>
</tr>


<th>SL</th>
<th>Emp ID</th>
<th>Name</th>
<th>Designation</th>
<th>DOJ</th>
<th>Department</th>
<th>Section</th>
<th>TTL Work Day</th>
<th>TTL Absent Day</th>
<th>TTL Weekend Day</th>
<th>TTL Holiday Day</th>


<th>C/L Enjoy</th>
<th>Balance</th>
<th>S/L Enjoy</th>
<th>Balance</th>
<th>E/L Enjoy</th>
<th>Balance</th>


<?php

	for($i=0; $i<$row_count;$i++)
	{
	echo "<tr style='text-align: center;'>";
	
	echo "<td>";
	echo $i +1;
	echo "</td>";
	
	
	echo "<td  style='text-align:center; width:70px;'>";
	echo $values["emp_id"][$i];
	echo "</td>";
	
	
	echo "<td >";
	echo $values["emp_name"][$i];
	echo "</td>";
	
	
	echo "<td >";
	echo $values["desig_name"][$i];
	echo "</td>";
	
	echo "<td >";
	echo $values["doj"][$i];
	echo "</td>";
	
	echo "<td >";
	echo $values["dept_name"][$i];
	echo "</td>";
	
	echo "<td >";
	echo $values["sec_name"][$i];
	echo "</td>";
	
	
	
	echo "<td >";
	echo $values["present_days"][$i];
	echo "</td>";
	
	echo "<td >";
	echo $values["absent_days"][$i];
	echo "</td>";
	
	echo "<td >";
	echo $values["weekend_days"][$i];
	echo "</td>";
	
	echo "<td >";
	echo $values["holiday"][$i];
	echo "</td>";
	
	
	echo "<td >";
	echo $values["casual_leave"][$i];
	echo "</td>";
	
	echo "<td >";
	echo $values["casual_balance"][$i];
	echo "</td>";
	
	echo "<td >";
	echo $values["sick_leave"][$i];
	echo "</td>";
	
	echo "<td >";
	echo $values["sick_balance"][$i];
	echo "</td>";
	
	echo "<td >";
	echo $values["earn_leave"][$i];
	echo "</td>";
	
	echo "<td >";
	echo "";
	echo "</td>";
	
	
	echo "</tr>";
	}
	?>
	
	
	
</body>
</html>