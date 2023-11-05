<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Continious OT/EOT Report</title>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/SingleRow.css" />

</head>

<body>

<div style=" margin:0 auto;  width:750px;">
<?php 
$emp_id = $values["emp_id"][1];
$data['unit_id'] = $this->db->where("emp_id",$emp_id)->get('pr_emp_com_info')->row()->unit_id;
$this->load->view("head_english",$data);
?>
<!--Report title goes here-->
<div align="center" style=" margin:0 auto;  overflow:hidden; font-family: 'Times New Roman', Times, serif;"><span style="font-size:12px; font-weight:bold;">
Continious OT / EOT Report of <?php echo "$start_date"; ?> To <?php echo $end_date; ?></span>
<br />
<br />


<table class="sal" border="1" cellpadding="3" cellspacing="0" align="center" style="font-size:12px;">
<th>SL</th><th>Emp ID</th><th>Punch Card No.</th><th>Employee Name</th> <!--<th>DOJ</th>--> <th>Department</th> <th>Section</th> <th>Line No. </th> <th>Designation</th> <th>Gross Sal</th> <th>OT Rate</th> <th>OT Hour</th><th>EOT Hour</th><th>Total OT / EOT</th><th>OT / EOT Amount</th> 


<?php
$total_ot_hour = 0;
$total_ot_amount = 0;
$total_eot_hour = 0;
$total_ot_eot = 0;
$total_ot_eot_amount = 0;


$count = count($values["emp_id"]);
for($i=0; $i<$count; $i++ )
{
	echo "<tr>";
	
	echo "<td>";
	echo $k = $i+1;
	echo "</td>";
	
	echo "<td>";
	echo $values["emp_id"][$i];
	echo "</td>";
	
	echo "<td>";
	echo "&nbsp;";
	echo $values["proxi_id"][$i];
	echo "</td>";
	
	echo "<td width='150'  style='text-align:left;' >";
	echo $values["emp_name"][$i];
	echo "</td>";
	
	echo "<td  width='140'  style='text-align:left;'>";
	echo $values["dept_name"][$i];
	echo "</td>";
	
	echo "<td  width='140'  style='text-align:left;'>";
	echo $values["sec_name"][$i];
	echo "</td>";
	
	echo "<td  width='140'  style='text-align:left;'>";
	echo $values["line_name"][$i];
	echo "</td>";
	
	echo "<td  width='140'  style='text-align:left;'>";
	echo $values["desig_name"][$i];
	echo "</td>";

	
	echo "<td  width='40'  style='text-align:right;' >";
	echo $values["gross_sal"][$i];
	echo "</td>";
	
	echo "<td  style='text-align:right;' >";
	echo $values["ot_rate"][$i];
	echo "</td>";
	
	echo "<td  style='text-align:center;' >";
	echo $values["ot_hour"][$i];
	echo "</td>";
	$total_ot_hour = $total_ot_hour + $values["ot_hour"][$i];
	
	echo "<td  style='text-align:center;' >";
	echo $values["eot_hour"][$i];
	echo "</td>";
	$total_eot_hour = $total_eot_hour + $values["eot_hour"][$i];
	
	echo "<td  style='text-align:center;' >";
	echo $values["total_ot_eot"][$i];
	echo "</td>";
	$total_ot_eot = $total_ot_eot + $values["total_ot_eot"][$i];

	echo "<td  style='text-align:right;' >";
	echo $values["total_ot_eot_amount"][$i];
	echo "</td>";
	$total_ot_eot_amount = $total_ot_eot_amount + $values["total_ot_eot_amount"][$i];
	
	echo "</tr>";
}

?>
<tr>
<td  colspan="10" style="text-align:center; font-weight:bold;" >
Grand Total
</td>
<td style="text-align:center; font-weight:bold;" ><?php echo $total_ot_hour; ?></td>
<td style="text-align:center; font-weight:bold;" ><?php echo $total_eot_hour; ?></td>
<td style="text-align:center; font-weight:bold;" ><?php echo $total_ot_eot; ?></td>
<td style="text-align:right; font-weight:bold;" ><?php echo number_format($total_ot_eot_amount); ?>/=</td>
</table>
</div>
</div>
</body>
</html>
