<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Daily
<?php
if ($daily_status == 2)
{
	echo "Absent";
}
else if($daily_status == 1)
{
	echo "Present";
}
else if($daily_status == 3)
{
	echo "Leave";
}
elseif($daily_status == 4)
{
	echo "Late";
}

elseif($daily_status == 5)
{
	echo "OT";
}

elseif($daily_status == 6)
{
	echo "EOT";
}

?>
 Report</title>
<!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/print.css" media="print" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/SingleRow.css" /> -->

</head>

<body style="margin: 0px;"><br>
<?php 
// dd($values);
$this->load->view("head_english");
?>
<!--Report title goes here-->
<div align="center" style=" margin:0 auto;  overflow:hidden; font-family: 'Times New Roman', Times, serif;"><span style="font-size:12px; font-weight:bold;">
Daily
<?php
if ($daily_status == 2)
{
	echo "Absent";
}
elseif($daily_status == 1)
{
	echo "Present";
}
elseif($daily_status == 3)
{
	echo "Leave";
}

elseif($daily_status == 4)
{
	echo "Late";
}

elseif($daily_status == 5)
{
	echo "OT";
}

elseif($daily_status == 6)
{
	echo "EOT";
}

?> Report , Date <?php echo date("d/m/Y",strtotime($date)); ?></span><br><br>
<table  border="1" cellpadding="0" cellspacing="0" style="font-size:11px; width:750px; margin-bottom:20px;">

	<?php 
	    // dd($values);
		$groupedData = array();
		foreach ($values as $employee) {
			$sectionName = $employee['sec_name_en'];
			$groupedData[$sectionName][] = $employee;
		} 
		foreach ($groupedData as $sectionName => $employees) { ?>

	<tr>
		<th colspan="10" style="border:none;font-size:14px;background:gray"><?php echo $sectionName ?></th>
	</tr>	
	<tr>
		<th style="padding-left:10px;padding-right:10px;">SL</th>
		<th style="padding-left:10px;padding-right:10px;white-space:nowrap">Emp ID</th>
		<th>Employee Name</th>
		<th>Designation</th>
		<th>Line</th> 
		<th>Shift</th>
		<?php if($daily_status == 1){?>
		<th>In Time</th>
		<th style="white-space: nowrap;">Out Time</th>
		<?php }?>
		<?php if($daily_status == 4){?>
		<th>In Time</th>
		<?php }?>

		<?php if($daily_status ==  5 || $daily_status == 6){?>
			<th>In Time</th>
			<th style="white-space: nowrap;">Out Time</th>
		<?php }?>
		<?php if($daily_status == 5){?>
		<th>OT Hour</th>
		<?php } if($daily_status == 6){?>
				<th>EOT Hour</th>
		<?php }?>
		<th>Status</th>	
		<?php if($daily_status == 2){?>
		<th>Mobile</th>
		<th>Remark</th>	
		<?php }?>
		<?php if($daily_status == 2 || $daily_status == 4){?>
		<th>Sign</th>	
		<?php }?>
	</tr>
		
	<?php	foreach ($employees as $key=>$employee) {
	?>
	<tr>
		<td  style="text-align:center"><?php echo $key+1?></td>
		<td style="text-align:center"><?php echo $employee['emp_id']?></td>
		<td style="white-space: nowrap;text-align:center"><?php echo $employee['name_en']?></td>
		<td style="white-space: nowrap;text-align:center"><?php echo $employee['desig_name']?></td>
		<td style="white-space: nowrap;text-align:center"><?php echo $employee['line_name_en']?></td>
		<td style="white-space: nowrap;text-align:center"><?php echo $employee['shift_name']?></td>
		<?php if($daily_status == 1){?>
			<td style="text-align:center"><?php echo $employee['in_time']?></td>
			<td style="text-align:center"><?php echo $employee['out_time']?></td>
		<?php }?>
		<?php if($daily_status == 4){?>
			<td style="text-align:center"><?php echo $employee['in_time']?></td>
		<?php }?>
		
		<?php if($daily_status == 5 || $daily_status == 6){?>
			<td style="text-align:center"><?php echo $employee['in_time']?></td>
			<td style="text-align:center"><?php echo $employee['out_time']?></td>
		
		<?php }?>
		<?php if($daily_status == 5){?>
			<td style="text-align:center"><?php echo $employee['ot']?></td>
		<?php }if($daily_status == 6){?>
		<td style="text-align:center"><?php echo $employee['eot']?></td>
		<?php }?>
		<td style="text-align:center">
			<?php
				  if($daily_status == 3){
					 echo  $employee['leave_type'];
				  }else{
					echo  $daily_status != 4 ? $employee['present_status'] : "P(Late)";
				  }
			
			?>
		</td>
		<?php if($daily_status == 2){?>
		<td><?php echo $employee['personal_mobile']?></td>
		<td style="padding-top:30px;padding-left:80px"></td>
		<!-- <td></td> -->
		<?php }?>
		<?php if($daily_status == 2 || $daily_status == 4){?>
		<td style="padding-top:30px;padding-left:80px">

		</td>
		<?php }?>
	</tr>
	<?php 		}
		
	} ?>
	<tr>
		<th colspan="10" style="background:gray;border:none;font-size:14px">
			<?php echo "Total : " . count($values)?>
		</th>
	</tr>
</table>

</body>
</html>
