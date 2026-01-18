<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Increment Report</title>

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
$per_page_id = 25;
$row_count = count($values["new_emp_id"]);
$max = $row_count;

if($row_count > $per_page_id){
    $page = ceil($row_count/$per_page_id);
    $page2 = ceil($row_count/$per_page_id);
}else{
    $page = 1;
    $page2 = 1;
}

$k = 0;

$grand_total_prev_com_salary = 0;
$grand_total_inc_amount = 0;
$grand_total_new_com_salary = 0;

$section_id = $values["new_section_id"][0]; 
?>

<?php for($counter = 1; $counter <= $page; $counter++): ?>

<?php
$sub_total_prev_com_salary = 0;
$sub_total_inc_amount = 0;
$sub_total_new_com_salary = 0;
?>

<table class="heading" align="center" style="font-size:12px; width:750px;border:0px;">
<tr height="70px">
<td style="text-align:center;width:70%;padding-left:150px;">
<?php $this->load->view("head_english");?>
<span style="font-size:13px; font-weight:bold;">
Increment Report from 
<?php echo date("d-M-Y", strtotime($start_date)); ?>
 - TO -
<?php echo date("d-M-Y", strtotime($end_date)); ?>
</span>
</td>
<td style="text-align:right;width:30%">
<?php echo "Page No. # ".$counter; ?>
</td>
</tr>
</table>

<table class="main_table" align="center" style="font-size:12px;width:750px">

<?php 
for($i=0; $i <= $per_page_id; $i++) {

    if ($k == 0) {
        echo "<tr bgcolor='#CCCCCC'>
        <td colspan='10' style='font-size:16px'>Section : ".$values["new_section"][$k]."</td>
        </tr>";

        echo "<tr>
        <th>SL</th>
        <th>Emp ID</th>
        <th>Name</th>
        <th>Designation</th>
        <th>Line</th>
        <th>Grade</th>
        <th>Pre. Sal.</th>
        <th>Increment</th>
        <th>Cur. Sal.</th>
        <th>Effective Date</th>
        </tr>";
    }
    else if(isset($values["new_section_id"][$k]) && $section_id != $values["new_section_id"][$k]) {
        echo "<tr bgcolor='#CCCCCC'>
        <td colspan='10' style='font-size:16px'>Section : ".$values["new_section"][$k]."</td>
        </tr>";

        echo "<tr>
        <th>SL</th>
        <th>Emp ID</th>
        <th>Name</th>
        <th>Designation</th>
        <th>Line</th>
        <th>Grade</th>
        <th>Pre. Sal.</th>
        <th>Increment</th>
        <th>Cur. Sal.</th>
        <th>Effective Date</th>
        </tr>";
    }

    $emp_id = isset($values["ref_id"][$k]) ? $values["ref_id"][$k] : '';
    if($emp_id == '') continue;

    echo "<tr>";
    echo "<td>".($k+1)."</td>";
    echo "<td><b>".$emp_id."</b></td>";

    $emp = $this->db->where('emp_id',$emp_id)->get('pr_emp_per_info')->row();
    echo "<td>".($emp->name_en ?? '')."</td>";
    echo "<td>".$values["new_desig"][$k]."</td>";
    echo "<td>".$values["new_line"][$k]."</td>";

    $gr = $this->db->where('gr_id',$values["new_grade"][$k])->get('pr_grade')->row();
    echo "<td>".($gr->gr_name ?? '')."</td>";

    $prev = $values["prev_com_salary"][$k];
    $new  = $values["new_com_salary"][$k];
    $inc  = $new - $prev;

    echo "<td align='right'>$prev</td>";
    echo "<td align='right'>$inc</td>";
    echo "<td align='right'>$new</td>";
    echo "<td align='center'>".date("d-M-Y",strtotime($values["effective_month"][$k]))."</td>";
    echo "</tr>";

    $sub_total_prev_com_salary += $prev;
    $sub_total_inc_amount += $inc;
    $sub_total_new_com_salary += $new;

    $grand_total_prev_com_salary += $prev;
    $grand_total_inc_amount += $inc;
    $grand_total_new_com_salary += $new;

    $section_id = $values["new_section_id"][$k];

    if($k >= $max) break;
    $k++;
}

echo "<tr bgcolor='#CCCCCC' style='font-weight:bold'>
<td colspan='6'>Subtotal</td>
<td>$sub_total_prev_com_salary</td>
<td>$sub_total_inc_amount</td>
<td>$sub_total_new_com_salary</td>
<td></td>
</tr>";

/* ✅ ONLY CHANGE IS HERE */
if ($k >= $max) {
    echo "<tr bgcolor='#CCCCCC' style='font-weight:bold;text-align:center'>
    <td colspan='6'>Grand Total</td>
    <td>$grand_total_prev_com_salary</td>
    <td>$grand_total_inc_amount</td>
    <td>$grand_total_new_com_salary</td>
    <td></td>
    </tr>";
}
?>

</table>

<div style="page-break-after: always;"></div>

<?php if($k >= $max) break; ?>
<?php endfor; ?>

</body>
</html>

<?php exit(); ?>
