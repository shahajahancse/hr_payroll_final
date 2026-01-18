<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Promotion Report</title>
<link rel="stylesheet" type="text/css" href="../../../../../css/print.css" media="print" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/SingleRow.css" />
<style type="text/css">
table.main_table{
    border-collapse: collapse;
}
table.main_table tr,
table.main_table tr td,
table.main_table tr th{
    border: 1px solid #000000;
}
</style>
</head>

<body>

<?php 
$per_page_id = 20;
$row_count = count($values["new_emp_id"]);
$max = $row_count;

$page = ($row_count > $per_page_id) ? ceil($row_count/$per_page_id) : 1;

$k = 0;

$grand_total_prev_com_salary = 0;
$grand_total_inc_amount = 0;
$grand_total_new_com_salary = 0;

for($counter = 1; $counter <= $page; $counter++) {

$sub_total_prev_com_salary = 0;
$sub_total_inc_amount = 0;
$sub_total_new_com_salary = 0;
?>

<table class="heading" align="center" style="font-size:12px;width:750px;">
<tr height="70px">
<td style="text-align:center;width:70%;padding-left:150px;">
<?php $this->load->view("head_english"); ?>
<span style="font-size:13px;font-weight:bold;">
Promotion Report from 
<?php echo date("d-M-Y", strtotime($start_date)); ?>
 - TO -
<?php echo date("d-M-Y", strtotime($end_date)); ?>
</span>
</td>
<td style="text-align:right;width:30%">
<?php echo '<span style="font-size:15px;">পাতা নং # '.$counter.'</span>'; ?>
</td>
</tr>
</table>

<table class="main_table" align="center" style="font-size:12px;width:750px;">

<tr>
<th>SL</th>
<th style="background:#DDDDDD;">Prev. Emp ID</th>
<th>Name</th>
<th>DOJ</th>
<th>Prev. Line</th>
<th>Prev. Desig.</th>
<th>Prev. Salary</th>
<th style="background:#DDDDDD;">New Emp ID</th>
<th>New Line</th>
<th>New Desig.</th>
<th>New Salary</th>
<th>Total Increment</th>
<th>Effective Date</th>
</tr>

<?php
$section = array();

for($i = 0; $i <= $per_page_id; $i++) {

if (!isset($values["new_section"][$k])) break;

if($section != $values["new_section"][$k]) {
    echo "<tr bgcolor='#CCCCCC'>
    <td colspan='13' style='font-size:16px'>Section : ".$values["new_section"][$k]."</td>
    </tr>";
}

echo "<tr>";
echo "<td>".($k+1)."</td>";

$emp_id = $values["prev_emp_id"][$k];
echo "<td style='background:#DDDDDD;font-weight:bold;'>$emp_id</td>";

$emp_name = $this->db->where('emp_id',$emp_id)->get('pr_emp_per_info')->row()->name_en;
echo "<td>$emp_name</td>";

$doj = $this->db->where('emp_id',$emp_id)->get('pr_emp_com_info')->row()->emp_join_date;
echo "<td>".date("Y-M-d", strtotime($doj))."</td>";

echo "<td>".$values["prev_line"][$k]."</td>";
echo "<td>".$values["prev_desig"][$k]."</td>";
echo "<td>".$values["prev_com_salary"][$k]."</td>";

echo "<td style='background:#DDDDDD;font-weight:bold;'>".$values["new_emp_id"][$k]."</td>";
echo "<td>".$values["new_line"][$k]."</td>";
echo "<td>".$values["new_desig"][$k]."</td>";
echo "<td>".$values["new_com_salary"][$k]."</td>";

$inc_amount = $values["new_com_salary"][$k] - $values["prev_com_salary"][$k];
echo "<td align='right'>$inc_amount</td>";

$sub_total_prev_com_salary += $values["prev_com_salary"][$k];
$sub_total_inc_amount += $inc_amount;
$sub_total_new_com_salary += $values["new_com_salary"][$k];

$grand_total_prev_com_salary += $values["prev_com_salary"][$k];
$grand_total_inc_amount += $inc_amount;
$grand_total_new_com_salary += $values["new_com_salary"][$k];

echo "<td align='center'>".date("d-M-Y", strtotime($values["effective_month"][$k]))."</td>";
echo "</tr>";

$section = $values["new_section"][$k];
$k++;

if($k >= $max) break;
}

echo "<tr bgcolor='#CCCCCC' style='font-weight:bold;text-align:center'>
<td colspan='6'>Subtotal</td>
<td>$sub_total_prev_com_salary</td>
<td colspan='3'></td>
<td>$sub_total_new_com_salary</td>
<td>$sub_total_inc_amount</td>
<td></td>
</tr>";


if ($k >= $max) {
    echo "<tr bgcolor='#CCCCCC' style='font-weight:bold;text-align:center'>
    <td colspan='6'>Grand Total</td>
    <td>$grand_total_prev_com_salary</td>
    <td colspan='3'></td>
    <td>$grand_total_new_com_salary</td>
    <td>$grand_total_inc_amount</td>
    <td></td>
    </tr>";
}
?>

</table>

<div style="page-break-after:always;"></div>

<?php if($k >= $max) break; ?>
<?php } ?>

</body>
</html>

<?php exit(); ?>
