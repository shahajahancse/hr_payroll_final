<!-- /*************  ✨ Codeium Command 🌟  *************/ -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>
        <?php
            $status_labels = [
                1 => 'Regular Employee',
                2 => 'New Employee',
                3 => 'Left Employee',
                4 => 'Resign Employee',
                6 => 'Promoted Employee'
            ];
            echo $status_labels[$grid_status] ?? 'Employee';
        ?> Monthly Holiday Allowance Sheet -
        <?php echo date("F-Y", strtotime($salary_month)); ?>
    </title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/print.css" media="all" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/SingleRow.css" />
    <style>
        table{ 
			width: 60%; 
			border-collapse: collapse; 
			font-size: 12px; 
			margin: 0 auto; 
		}
        th, td{ 
			border: 1px solid black; 
			padding: 2px; text-align: center; 
		}
        .bottom_txt_design{ 
			border-top: 1px solid; 
			width: 160px; 
			font-weight: bold;
		}

              .page_break {
            page-break-before: always;
            page-break-inside: avoid;
        }

        @media print {
            table { 
                page-break-inside: auto;
            }
            /* Force page breaks after each table (if needed) */
            .page_break {
                page-break-before: always;
            }
        }

        /* Ensure that the first page has content and doesn't remain blank */
        body {
            margin: 0;
        }
    </style>
</head>
<body>
    <?php 
        $per_page = 30;
        $total_rows = count($value);
        $total_pages = ceil($total_rows / $per_page);
        
        $grand_total_allowance = 0;
    
        for ($page = 0; $page < $total_pages; $page++):
            $start = $page * $per_page;
            $end = min($start + $per_page, $total_rows);
            $total_page_allowance = 0;
			?>
    <table>
		<tr>
			<td colspan="12">
				<?php $this->load->view("head_english");?>
                <strong><?php echo $status_labels[$grid_status] ?? 'Employee'; ?> Monthly Holiday Allowance Sheet - <?php echo date("F-Y", strtotime($salary_month)); ?></strong>
            </td>
        </tr>
        <tr>
            <th style='white-space:nowrap'>SI No</th>
            <th style='white-space:nowrap'>Card No</th>
            <th style='white-space:nowrap'>Name</th>
            <th style='white-space:nowrap'>Designation</th>
            <th style='white-space:nowrap'>Line</th>
            <th style='white-space:nowrap'>Joining Date</th>
            <th style='white-space:nowrap'>Grade</th>
            <th style='white-space:nowrap'>Night. No.</th>
            <th style='white-space:nowrap'>Night. Rate</th>
            <th style='white-space:nowrap'>Total Night. Amt</th>
            <th style='white-space:nowrap'>Signature</th>
        </tr>
        <?php for ($i = $start; $i < $end; $i++){
            $employee = $value[$i]; 
			// dd($employee);
            if($employee->night_alo_count==0){
                continue;
            }
            $holiday_allowance = $employee->night_allowance*$employee->night_alo_count; 
            $total_page_allowance += $holiday_allowance;
            $grand_total_allowance += $holiday_allowance; 

        ?>
            <tr>
                <td><?php echo $i + 1; ?></td>
                <td style='white-space:nowrap'><?php echo $employee->emp_id; ?></td>
                <td style='white-space:nowrap'><?php echo $employee->name_en; ?></td>
                <td style='white-space:nowrap'><?php echo $employee->desig_name; ?></td>
                <td style='white-space:nowrap'><?php echo $employee->line_name_en; ?></td>
                <td style='white-space:nowrap'><?php echo date("d-M-y", strtotime($employee->emp_join_date)); ?></td>
                <td style='white-space:nowrap'><?php echo $employee->gr_name; ?></td>
                <td style='white-space:nowrap'><?php echo $employee->night_alo_count; ?></td>
                <td style='white-space:nowrap'><?php echo (int)$employee->night_allowance; ?></td>
                <td style='white-space:nowrap'><?php echo $holiday_allowance; ?></td>
                <td style='padding:10px 60px'>&nbsp;</td>
            </tr>
        <?php }?>
        <tr>
            <td colspan="9"><strong>Total Per Page</strong></td>
            <td><?php echo number_format($total_page_allowance); ?></td>
        </tr>

	<br><br>
    <div class="page_break"></div>
    <?php endfor; ?>
        <tr>
            <td colspan="9"><strong>Grand Total</strong></td>
            <td><?php echo number_format($grand_total_allowance); ?></td>
        </tr>
    </table>

</body>
</html>

<!-- /******  10e28063-69d2-432a-8849-c95efeb83edb  *******/ -->
