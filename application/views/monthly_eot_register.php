<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Monthly OT Register</title>
<link rel="stylesheet" type="text/css" href="../../../../../css/print.css" media="print" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/SingleRow.css" />
</head>

<body>
<?php
$per_page_id = 56;
$row_count = count($values["emp_id"]);
$max = $row_count;

$page = ($row_count > $per_page_id) ? ceil($row_count / $per_page_id) : 1;

$grand_total_eot_hour = 0;
$grand_total_eot_amount = 0;

$k = 0;

for ($counter = 1; $counter <= $page; $counter++) {
    $page_total_eot_hour = 0; // Reset for each page
    $page_total_eot_amount = 0;
?>
    <div style="margin: 0 auto; width: 750px;">
        <?php $this->load->view("head_english"); ?>
        <!--Report title-->
        <div align="center" style="margin: 0 auto; overflow: hidden; font-family: 'Times New Roman', Times, serif;">
            <span style="font-size:12px; font-weight:bold;">Monthly EOT Report of <?php echo "$start_date"; ?></span>
        </div>
        <div style="clear: both; width: 100%; height: 20px;"></div>
        <table class="sal" border="1" cellpadding="0" cellspacing="0" align="center" style="font-size:12px;">
            <tr>
                <th>SL</th>
                <th>Emp ID</th>
                <th>Employee Name</th>
                <th>Designation</th>
                <th>Line No.</th>
                <th>Shift</th>
                <th>Gross Sal</th>
                <th>OT Rate</th>
                <th>Total EOT Hour</th>
                <th>Total EOT Amount</th>
            </tr>

            <?php
            for ($i = 0; $i < $per_page_id && $k < $max; $i++) {
                echo "<tr>";

                echo "<td>" . ($k + 1) . "</td>";
                echo "<td>" . $values["emp_id"][$k] . "</td>";
                echo "<td width='150' style='text-align:left;'>" . $values["emp_name"][$k] . "</td>";
                echo "<td width='140' style='text-align:left;'>" . $values["desig_name"][$k] . "</td>";
                echo "<td width='140' style='text-align:left;'>" . $values["line_name"][$k] . "</td>";
                echo "<td>" . (($values["emp_shift"][$k] == 'Template  (Night_shift)' || $values["emp_shift"][$k] == 'Template (Day_shift)') ? 'HGL_Worker' : $values["emp_shift"][$k]) . "</td>";
                echo "<td width='40' style='text-align:right;'>" . $values["gross_sal"][$k] . "</td>";
                echo "<td style='text-align:right;'>" . $values["ot_rate"][$k] . "</td>";

                echo "<td style='text-align:center;'>" . $values["total_eot_hour"][$k] . "</td>";
                echo "<td style='text-align:right;'>" . number_format($values["total_eot_amount"][$k]) . "</td>";

                // Calculate Page Total
                $page_total_eot_hour += $values["total_eot_hour"][$k];
                $page_total_eot_amount += $values["total_eot_amount"][$k];

                // Calculate Grand Total
                $grand_total_eot_hour += $values["total_eot_hour"][$k];
                $grand_total_eot_amount += $values["total_eot_amount"][$k];

                echo "</tr>";
                $k++;

                if ($k >= $max) {
                    break;
                }
            }
            ?>
            <!-- Page Total -->
            <tr>
                <td colspan="8" style="text-align:center; font-weight:bold;">Page Total</td>
                <td style="text-align:center; font-weight:bold;"><?php echo $page_total_eot_hour; ?></td>
                <td style="text-align:right; font-weight:bold;"><?php echo number_format($page_total_eot_amount); ?>/=</td>
            </tr>

            <?php
            // Grand Total (only on the last page)
            if ($counter == $page) {
            ?>
            <tr>
                <td colspan="8" style="text-align:center; font-weight:bold;">Grand Total</td>
                <td style="text-align:center; font-weight:bold;"><?php echo $grand_total_eot_hour; ?></td>
                <td style="text-align:right; font-weight:bold;"><?php echo number_format($grand_total_eot_amount); ?>/=</td>
            </tr>
            <?php } ?>
        </table>
        <div style="page-break-after: always;"></div>
    </div>
<?php
    if ($k >= $max) {
        break;
    }
}
?>
</body>
</html>
<?php exit(); ?>