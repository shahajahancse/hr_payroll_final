<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Continuous <?php echo $status; ?> Report</title>
    <link rel="stylesheet" type="text/css" href="../../../../../../css/SingleRow.css" />
</head>

	<style>
		@media print{
			.page_break_t{
				display: block;
				border: none;
			}
			.page_break{
				page-break-before: always;
			}
		}
	</style>
<body>
    <div style="margin:0 auto; width:1000px;">
	<?php $this->load->view("head_english");?>
        <div align="center" style=" margin:0 auto;  overflow:hidden; font-family: 'Times New Roman', Times, serif;">
            <span style="font-size:13px; font-weight:bold;">
	<?php echo $status; ?> Report from
	<?php
		echo $first_date;
		echo " - TO - ";
		echo $second_date;

	?></span>
	<br />
	<br />
	<?php
	// Example array from your query result
		$percent = [
			'present'  => ($values[0]->total_present / $values[0]->total_emp) * 100,
			'absent'   => ($values[0]->total_absent / $values[0]->total_emp) * 100,
			'late'     => ($values[0]->total_late / $values[0]->total_emp) * 100,
			'leave'    => ($values[0]->total_leave / $values[0]->total_emp) * 100,
			'holiday'  => ($values[0]->total_holiday / $values[0]->total_emp) * 100,
			'weekend'  => ($values[0]->total_weekend/ $values[0]->total_emp) * 100
		];
	?>

	<table class="sal" border="1" cellpadding="5" cellspacing="0" align="center" style="font-size:13px; border-collapse:collapse; text-align:center; width:60%;">
		<thead style="background:#f2f2f2;">
			<tr>
				<th>Total Employees</th>
				<th>Total Present</th>
				<th>Total Absent</th>
				<th>Total Late</th>
				<th>Total Leave</th>
				<th>Total Holiday</th>
				<th>Total Weekend</th>
			</tr>
		</thead>
		<tbody>

			<tr>
				<td><?= $values[0]->total_emp; ?></td>
				<td><?= $values[0]->total_present; ?></td>
				<td><?= $values[0]->total_absent; ?></td>
				<td><?= $values[0]->total_late; ?></td>
				<td><?= $values[0]->total_leave; ?></td>
				<td><?= $values[0]->total_holiday; ?></td>
				<td><?= $values[0]->total_weekend; ?></td>
			</tr>
		</tbody>
		<tfoot>			
			<tr>
				<th>Persent(%)</th>
				<td><?= number_format($percent['present'], 2); ?>%</td>
				<td><?= number_format($percent['absent'], 2); ?>%</td>
				<td><?= number_format($percent['late'], 2); ?>%</td>
				<td><?= number_format($percent['leave'], 2); ?>%</td>
				<td><?= number_format($percent['holiday'], 2); ?>%</td>
				<td><?= number_format($percent['weekend'], 2); ?>%</td>
			</tr>
		</tfoot>
	</table>

	</div>
	<br><br>
</body>

</html>
<?php exit(); ?>
