<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Unit Transfer List</title>
    <style>
        @media print {
            table {
                width: 95% !important;
            }
            .page-break {
                page-break-after: always;
            }
        }
		table {
			width: 50%;
			border-collapse: collapse;
		}
    </style>
</head>
<body style="margin: 0px;">
    
    <?php 
        $grandTotal = 0; 
        $rowsPerPage = 23; 
        $rowCount = 0;
        $pageTotal = 0;
		$i=1;
    ?>

    <div align="center" style="margin:0 auto; overflow:hidden; font-family: 'Times New Roman', Times, serif;">
    <?php foreach ($values as $key => $r): ?>
        <?php if ($r->ifter_day == 0) continue; ?>
       		<?php 
            if ($rowCount % $rowsPerPage === 0): 
                if ($rowCount > 0): ?>
                    <tr>
                        <td colspan="7" style="text-align:right; padding:4px; font-weight:bold;">Page Total:</td>
                        <td style="text-align:center; padding:2px; font-weight:bold;"> <?php echo $pageTotal; ?> </td>
                        <td></td>
                    </tr>
                    </table>
					<br><br><br>
				<div style="font-size: 12px;display: flex; justify-content: space-between; gap: 10px; flex-wrap: wrap;width: 90%;">
					<?php 
					if($_SESSION['data']->unit_name == 1){
						echo '<div>Prepared by</div> <div>Audit</div> <div>Manager(HRD)</div> <div>GM (Project Head)</div> <div>Approved by</div>';
					}
					if($_SESSION['data']->unit_name == 2 || $_SESSION['data']->unit_name == 4){
						echo '<div>Prepared by</div> <div>Accounts Executive</div> <div>Audit</div> <div>Manager(HRD)</div> <div>AGM (Admin & Finance)</div> <div>GM (Project Head)</div>';
					}
					?>
				</div>
			<div class="page-break"></div>
			<?php endif; ?>
				<?php $this->load->view("head_english");?>
                <span style="font-size:12px; font-weight:bold;">
                    Iftar Bill List Report, Date <?php echo $date1 ?> to <?php echo $date2 ?>
                </span>
                <br><br>
			<table border="1" cellpadding="0" cellspacing="0" style="font-size:12px; margin-bottom:20px;">
				<tr>
					<th style="white-space:nowrap;padding:2px 10px;">SL</th>
					<th style="white-space:nowrap;padding:2px 10px;">Employee ID</th>
					<th style="white-space:nowrap;padding:4px;">Emp Name</th>
					<th style="white-space:nowrap;padding:4px">Designation</th>
					<th style="white-space:nowrap;padding:4px">Line</th>
					<th style="white-space:nowrap;padding:4px">Day</th>
					<th style="padding:4px">Iftar Allowance</th>
					<th style="padding:4px">Total Amount</th>
					<th style="white-space:nowrap;padding:4px;width:100px">Signature</th>
				</tr>
				<?php $pageTotal = 0; endif;  ?>
				<tr>
					<td style="text-align:center;padding:2px;white-space:nowrap"> <?php echo $i++; ?> </td>
					<td style="text-align:center;padding:2px;white-space:nowrap"> <?php echo $r->emp_id ?> </td>
					<td style="text-align:center;padding:2px;white-space:nowrap"> <?php echo $r->name_en ?> </td>
					<td style="text-align:center;padding:2px;"> 				  <?php echo $r->desig_name ?> </td>
					<td style="text-align:center;padding:2px;white-space:nowrap"> <?php echo $r->line_name_en ?> </td>
					<td style="text-align:center;padding:2px;white-space:nowrap"> <?php echo $r->ifter_day ?> </td>
					<td style="text-align:center;padding:2px;white-space:nowrap"> <?php echo $r->ifter_amount ?> </td>
					<td style="text-align:center;padding:2px;white-space:nowrap"> <?php $totalAmount = $r->ifter_day * $r->ifter_amount; echo $totalAmount; ?> </td>
					<td style="text-align:center;padding:15px 30px"></td>
				</tr>
				<?php 
					$grandTotal += $totalAmount; 
					$pageTotal += $totalAmount;
					$rowCount++;
					endforeach; 
				?>
				<tr>
					<td colspan="7" style="text-align:right; padding:4px; font-weight:bold;">Page Total:</td>
					<td style="text-align:center; padding:2px; font-weight:bold;"> <?php echo $pageTotal; ?> </td>
					<td></td>
				</tr>
				<tr>
					<td colspan="7" style="text-align:right; padding:4px; font-weight:bold;">Grand Total:</td>
					<td style="text-align:center; padding:2px; font-weight:bold;"> <?php echo $grandTotal; ?> </td>
					<td></td>
				</tr>
			</table>
			<br><br><br>
			<div style="font-size: 12px;display: flex; justify-content: space-between; gap: 10px; flex-wrap: wrap;width: 90%;">
				<?php 
					if($_SESSION['data']->unit_name == 1){
						echo '
							<div>Prepared by</div> 
							<div>Audit</div> 
							<div>Manager(HRD)</div> 
							<div>GM (Project Head)</div> 
							<div>Approved by</div>
						';
					}
					if($_SESSION['data']->unit_name == 2 || $_SESSION['data']->unit_name == 4){
						echo '
							<div>Prepared by</div> 
							<div>Accounts Executive</div> 
							<div>Audit</div> 
							<div>Manager(HRD)</div> 
							<div>AGM (Admin & Finance)</div> 
							<div>GM (Project Head)</div>
						';
					}
				?>
			</div>
    	</div>
    <!-- <br><br> -->
</body>
</html>
<?php exit(); ?>
