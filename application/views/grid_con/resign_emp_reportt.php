
<title>
	Resign Employee Report
</title>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/print.css" media="print" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/SingleRow.css" />
<style>


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


<?php
$per_page_id = 10;
$row_count = count($values["emp_name"]);
$page_count = ceil($row_count / $per_page_id);

$k = 0;
for ($page = 0; $page < $page_count; $page++) {
	$this->load->view("head_english");
?>
<span style="font-size:13px; text-align: center;">
	<p style="text-align: center;padding: 0px;margin: 0;">Left Employee  Information </br>
		<?php echo date('d M Y', strtotime($start_date)) . "  TO  " . date('d M Y', strtotime($end_date)); ?>
	</p>
</span>
<table class="main_table" align="center" height="auto" style="font-size:11px; width:700px;margin:0 auto;">
	<tr>
		<th>SL</th>
		<th>Emp ID</th>
		<th>Name</th>
		<th>Designation</th>
		<th>Line</th>
		<th>Section</th>
		<th>Date of Birth</th>
		<th>Joining Date</th>
		<th>Last Working Date</th>
		<th>Image</th>
		<th>Remarks</th>
	</tr>
	<?php
	for ($i = 0; $i < $per_page_id && $k < $row_count; $i++, $k++) {
		echo "<tr>";
		echo "<td style='padding: 5px 3px;'>" . ($k + 1) . "</td>";
		echo "<td style='text-align:center; width:60px;'>" . $values["emp_id"][$k] . "</td>";
		echo "<td style='padding: 5px 3px;'>" . $values["emp_name"][$k] . "</td>";
		echo "<td style='padding: 5px 3px;'>" . $values["desig_name"][$k] . "</td>";
		echo "<td style='padding: 5px 3px;'>" . $values["line_name"][$k] . "</td>";

		$sections = preg_split('/[ -]/', $values["line_name"][$k]);
		echo "<td style='padding: 5px 3px;'>" . ($sections[0] == "Line" ? "Sewing" : $sections[0]) . "</td>";

		$dob = date("d-M-y", strtotime($values["emp_dob"][$k]));
		echo "<td style='text-align:center; width:70px;'>" . $dob . "</td>";

		$doj = date("d-M-y", strtotime($values["doj"][$k]));
		echo "<td style='text-align:center; width:70px;'>" . $doj . "</td>";

		$e_date = date("d-M-Y", strtotime($values["e_date"][$k]));
		echo "<td style='text-align:center; width:70px;'>" . $e_date . "</td>";

		echo "<td style='padding:5px 3px'><img src='" . base_url() . "uploads/photo/" . $values["img_source"][$k] . "' width='70' height='80' /></td>";
		echo "<td style='text-align:center; width:70px;'>&nbsp;</td>";
		echo "</tr>";
	}
	?>
</table>
<?php if ($page < $page_count - 1) { ?>
	<div style="page-break-after: always;"></div>
<?php }
}
exit();
?>
