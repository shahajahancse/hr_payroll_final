<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title> Attn 15 to 49 Report</title>
    <style>
    @media print {
        table {
            widht: 600px !important;
        }
    }
    </style>
</head>

<body style="margin: 0px;">
	<span id='massage'></span>
	<div id='all_data'>
    	<?php $this->load->view("head_english"); ?>
		<div align="center"  style=" margin:0 auto;  overflow:hidden; font-family: 'Times New Roman', Times, serif;">
			<span style="font-size:12px; font-weight:bold;"> Attendance 15 to 49 Report , Month <?php echo $date; ?> </span>
			<br><br>
			<table border="1" cellpadding="0" cellspacing="0" style="font-size:12px; width:700px; margin-bottom:20px;">
				<?php $this->load->model('Grid_model'); $i=1; ?>
				<tr>
					<th style="text-align:left; padding:0 5px;">SL</th>
					<th style="text-align:left; padding:0 5px;">ID</th>
					<th style="text-align:left; padding:0 5px">Employee Name</th>
					<th style="text-align:left; padding:0 5px">Date</th>
					<th style="padding:0 4px">In Time</th>
					<th style="padding:0 4px">Out Time</th>
				</tr>
				<?php foreach ($value as $key=>$employee) { ?>
				<tr>
					<td style="text-align:left; padding:0 5px"><?php echo $i++?></td>
					<td style="text-align:left; padding:0 4px"><?php echo $employee['emp_id']?></td>
					<td style="text-align:left; padding:0 5px"><?php echo $employee['name_en']?></td>
					<td style="text-align:left; padding:0 5px"><?php echo $employee['shift_log_date']?></td>
					<td style="text-align:center"><?php echo $employee['in_time']?></td>
					<td style="text-align:center"><?php echo $employee['out_time']?></td>
				</tr>
				<?php } ?>
			</table>
		</div>
		<br><br>
	</div>
</body>
</html>
<?php exit(); ?>
