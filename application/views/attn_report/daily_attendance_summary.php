<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" >
</head>

<body>
    <?php $this->load->view("head_english");?><br>
    <div align="center" class="container">
       
		<table class="table table-bordered table-sm">
			<tr>
				<th>Sl.</th>
				<th>Line Name</th>
                <th>Total</th>
				<th>Present</th>
                <th>Absent</th>
				<th>Male</th>
                <th>Female</th>
                <?php foreach($keys as $key){?>
                <th style="padding:0px" >
                    <table style="border-collapse: collapse;border:0px white;width: -webkit-fill-available;" >
                        <tr>
                            <th class="text-center" colspan='3' style="padding: 0;border: none;border-bottom: 1px solid #dee2e6;"><?php echo $key ?></th>
                        </tr>
                        <tr>
                            <td style="border: none;padding:2px;margin: 0;border-right:1px solid #dee2e6;">TT</td>
                            <td style="border: none;padding:2px;margin: 0;">PR</td>
                            <td style="border: none;padding:2px;margin: 0;border-left:1px solid #dee2e6;">AB</td>
                        </tr>
                    </table>
                </th>
                <?php }?>
				<th>Leave</th>
                <th>Late</th>
				<th>Remark</th>
			</tr>
            <?php $i=1; foreach($results as $row){?>
			<tr>
				<td><?php echo $i++?></td>
				<td><?php echo $row->line_name_en?></td>
				<td><?php echo $row->all_emp?></td>
				<td><?php echo $row->all_present?></td>
				<td><?php echo $row->all_absent?></td>
				<td><?php echo $row->all_male?></td>
				<td><?php echo $row->all_female?></td>
               <?php foreach($keys as $key){
                $group_data =$row->group_data[$key];
                ?>
                <th style="padding:0px" >
                    <table style="border-collapse: collapse;border:0px white;width: -webkit-fill-available;" >
                        <tr>
                            <td style="border: none;padding:2px;margin: 0;border-right:1px solid #dee2e6;"><?php echo (!empty($group_data))?$group_data->total_emp :'--'?></td>
                            <td style="border: none;padding:2px;margin: 0;"><?php echo  (!empty($group_data))?$group_data->emp_present :'--'?></td>
                            <td style="border: none;padding:2px;margin: 0;border-left:1px solid #dee2e6;"><?php echo  (!empty($group_data))?$group_data->emp_absent :''?></td>
                        </tr>
                    </table>
                </th>
                <?php }?>
				<td><?php echo $row->all_leave?></td>
				<td><?php echo $row->all_late?></td>
                <td></td>

			</tr>
            <?php }?>

			<tr>
				<td colspan="2">Sum: 28</td>
			</tr>
		</table>
    </div>

</body>

</html>
