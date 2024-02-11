<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>
 Holiday / Weekend Absent 
 Report</title>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/print.css" media="print" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/SingleRow.css" />

</head>

<body>
<?php //print_r($values); 
//echo $daily_status;
$base_url = base_url();
?>
<div style=" margin:0 auto;  width:800px;">

<?php 

$this->load->view("head_english");
?>
<div align="center" style=" margin:0 auto;  overflow:hidden; font-family: 'Times New Roman', Times, serif;"><span style="font-size:13px; font-weight:bold;">
Holiday / Weekend Absent 
 Report of <?php echo "$date/$month/$year"; ?></span>
<br />
<br />


<table class="sal" border="1" cellpadding="2" cellspacing="0" align="center" style="font-size:12px;">


<?php
$section=array();
$i=0;
$count = count($values["emp_id"]);
for($i=0; $i<$count; $i++ )
{
	
	if($section!=$values["sec_name_en"][$i]){
	echo "<tr bgcolor='#CCCCCC'>";
	echo "<td colspan='10' style='font-size:16px;font-wieght:bold;'>Section :&nbsp".$values["sec_name_en"][$i]."</td>";
	echo "</tr>";
	
	 ?>
	<th>SL</th><th>Emp ID</th><th>Employee Name</th><th>Line No. </th> <th>Designation</th><th>Status</th><th>Remarks</th> <th>Sign.</th> 

<?php
	

	
	}

	echo "<tr>";
	
	echo "<td>";
	echo $k = $i+1;
	echo "</td>";
	
	echo "<td style='font-weight:bold;'>";
	echo $values["emp_id"][$i];
	echo "</td>";
	
	// echo "<td>";
	// echo "&nbsp;";
	// echo $values["proxi_id"][$i];
	// echo "</td>";
	
	echo "<td >";
	echo $values["emp_name"][$i];
	echo "</td>";
	
	echo "<td >";
	echo $values["line_name"][$i];
	echo "</td>";
	
	echo "<td >";
	echo $values["desig_name"][$i];
	echo "</td>";
	
	echo "<td >";
	echo $values["cont_absent"][$i];
	echo "</td>";

	echo "<td width='80' align='center'>";
	echo "";
	echo "</td>";
		
	echo "<td width='80' align='center'>";
	echo "";
	echo "</td>";	
	
	echo "</tr>";
	$section=$values["sec_name_en"][$i];
}

?>

</table>
</div>
</div>
</body>
</html>
