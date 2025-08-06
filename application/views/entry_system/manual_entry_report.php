
<h3 class="text-center"><?php $this->load->view('head_english'); ?></h3>
<div >
    <h4 style="text-align: center">Manual Entry Report</h4>
    <h5 style="text-align: center">Date: <?php echo $report_date; ?></h5>
    <table class="report-table" style="width: 80%; margin: 0 auto; border-collapse: collapse;">
        <thead style="background-color: #f2f2f2;">
            <tr style="text-align:left;">
                <th style="border: 1px solid #ddd; padding: 8px;">Sl.</th>
                <th style="border: 1px solid #ddd; padding: 8px;">Emp.ID</th>
                <th style="border: 1px solid #ddd; padding: 8px;">Name</th>
                <!-- <th style="border: 1px solid #ddd; padding: 8px;">Department</th>
                <th style="border: 1px solid #ddd; padding: 8px;">Section</th> -->
                <th style="border: 1px solid #ddd; padding: 8px;">Designation</th>
                <th style="border: 1px solid #ddd; padding: 8px;">Line</th>
                <th style="border: 1px solid #ddd; padding: 8px;">Time</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; foreach ($att_table_data as $data) { ?>
            <tr style="border-bottom: 1px solid #ddd;">
                <td style="border: 1px solid #ddd; padding: 8px;"><?php echo $i++; ?></td>
                <td style="border: 1px solid #ddd; padding: 8px;white-space:nowrap"><?php echo $data->emp_id; ?></td>
                <td style="border: 1px solid #ddd; padding: 8px;white-space:nowrap"><?php echo $data->name_en; ?></td>
                <!-- <td style="border: 1px solid #ddd; padding: 8px;white-space:nowrap">< ?php echo $data->dept_name; ?></td>
                <td style="border: 1px solid #ddd; padding: 8px;white-space:nowrap">< ?php echo $data->sec_name_en; ?></td> -->
                <td style="border: 1px solid #ddd; padding: 8px;white-space:nowrap"><?php echo $data->desig_name; ?></td>
                <td style="border: 1px solid #ddd; padding: 8px;white-space:nowrap"><?php echo $data->line_name_en; ?></td>
                <td style="border: 1px solid #ddd; padding: 8px;white-space:nowrap"><?php echo date('h:i:s a', strtotime($data->date_time)); ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

