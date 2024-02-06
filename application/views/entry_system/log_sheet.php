<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Job Card</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/table.css" />
</head>

<body>
    <div align="center" style="height:100%; width:100%; overflow:hidden;" >
        <?php $this->load->view('head_english'); ?>

        <span style='font-size:13px; font-weight:bold;'>
        Shift Log from  <?php echo $first_date .' -TO- '. $second_date; ?>
        </span>
        <br /><br />
	
        <table border='0' style='font-size:13px;  width:600px;'>
            <tr>
                <td width=''><strong>Emp ID:</strong></td>
                <td width=''><?= $row->emp_id ?></td>
            
                <td width=''><strong>Name :</strong> </td>
                <td width=''><?= $row->name_en ?></td>
            </tr>

            <tr>
                <td width=''><strong>Proxi NO.</strong></td>
                <td width=''><?= $row->proxi_id ?></td>
            
                <td width=''><strong>Section :</strong> </td>
                <td width=''><?= $row->sec_name_en ?></td>
            </tr>

            <tr>
                <td width=''><strong>Line :</strong></td>
                <td width=''><?= $row->line_name_en ?></td>
            
                <td width=''><strong>Desig :</strong> </td>
                <td width=''><?= $row->desig_name ?></td>
            </tr>

            <tr>
                <td width=''><strong>DOJ :</strong></td>
                <td width=''><?= date('d-m-Y', strtotime($row->emp_join_date)) ?></td>
            
                <td width=''><strong>Dept :</strong> </td>
                <td width=''><?= $row->dept_name ?></td>
            </tr>
	    <table>
        <br>

        <table width="700" border="1" bordercolor="#000000" cellspacing="0" cellpadding="2" style="text-align:center; font-size:13px; "> 
            <tr>
                <th>Date</th>
                <th>In Time</th>
                <th>Out Time</th>
                <th>Shift</th>
                <th>In Time [HH:MM:SS]</th>
                <th>Out Time [HH:MM:SS]</th>
            </tr>
            <form action="" method="post">
                <input type="hidden" name="emp_id" id="emp_id" value="<?= $row->id ?>">
                <input type="hidden" name="proxi" id="proxi" value="<?= $row->proxi_id ?>">
            
                <tr>
                    <td style="width:130px;">
                    <input type="hidden" name="manual_date0" id="manual_date0" value="2023-12-31">
                    </td>
                    <td style="width:130px;"></td>
                    <td style="width:130px;"></td>
                    <td style="width:130px;"></td>
                    
                    <td style="width:130px;">
                    <input type="text" style="border:1px solid #6E7C8B; font-weight:bold;" name="in_time[]">
                    </td>
                    <td style="width:130px;">
                    <input type="text" style="border:1px solid #6E7C8B;font-weight:bold;" name="manual_outtime0" id="manual_outtime0"></td>
                </tr>
                <tr><td colspan="6"><input type="submit" value="Submit"></td></tr>
            </form>
        </table>
	</div>
</body>
</html>


