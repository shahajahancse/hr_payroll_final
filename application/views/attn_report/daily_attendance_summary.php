<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" >
    <style>
        body{
            font-size: 13px;
        }
    </style>
</head>
<body>
     <!-- < ?php dd($values);?> -->
    <?php $this->load->view("head_english");?><br>
    <div align="center" class="container">
		<table class="table table-bordered table-sm">
			<tr>
				<th class="text-center">Sl.</th>
				<th class="text-center">Line Name</th>
                <th class="text-center">Total</th>
				<th class="text-center">Present</th>
                <th class="text-center">Absent</th>
				<th class="text-center">Male</th>
                <th class="text-center">Female</th>
                <?php foreach($keys as $key){?>
                <th style="padding:0px">
                    <table style="border-collapse: collapse;border:0px white;width: -webkit-fill-available;">
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
				<th class="text-center">Leave</th>
                <th class="text-center">Late</th>
				<th class="text-center">Remark</th>
			</tr>
            <?php 
                $i=1; 
                $sumAllEmp=0;
                $sumAllPresent=0; 
                $sumAllPresent=0; 
                $sumAllAbsent=0; 
                $sumAllMale=0; 
                $sumAllFemale=0; 
                $sumAllLeave=0; 
                $sumAllLate=0; 
                foreach($results as $row){ 
                $sumAllEmp      += $row->all_emp;
                $sumAllPresent  += $row->all_present;
                $sumAllAbsent   += $row->all_absent;
                $sumAllMale     += $row->all_male;
                $sumAllFemale   += $row->all_female;
                $sumAllLeave   += $row->all_leave;
                $sumAllLate   += $row->all_late;
            
            ?>
			<tr>
				<td class="text-center"><?php echo $i++?></td>
				<td class="text-center"><?php echo $row->line_name_en?></td>
				<td class="text-center"><?php echo $row->all_emp?></td>
				<td class="text-center"><?php echo $row->all_present?></td>
				<td class="text-center"><?php echo $row->all_absent?></td>
				<td class="text-center"><?php echo $row->all_male?></td>
				<td class="text-center"><?php echo $row->all_female?></td>
               <?php foreach($keys as $key){ $group_data =$row->group_data[$key];?>
                <td style="padding:0px">
                    <table style="border-collapse: collapse;border:0px white;width: -webkit-fill-available;" >
                        <tr>
                            <td class="text-center" style="border: none;padding:2px;margin: 0;border-right:1px solid #dee2e6;"><?php echo (!empty($group_data))?$group_data->total_emp :'--'?></td>
                            <td class="text-center" style="border: none;padding:2px;margin: 0;"><?php echo  (!empty($group_data))?$group_data->emp_present :'--'?></td>
                            <td class="text-center" style="border: none;padding:2px;margin: 0;border-left:1px solid #dee2e6;"><?php echo  (!empty($group_data))?$group_data->emp_absent :'--'?></td>
                        </tr>
                    </table>
               </td>
                <?php }?>
				<td class="text-center"><?php echo $row->all_leave?></td>
				<td class="text-center"><?php echo $row->all_late?></td>
                <td></td>
			</tr>
            <?php }?>
			<tr>
				<td colspan="2" class="text-right">Total</td>
                <td class="text-center">
                    <?php echo $sumAllEmp;
                        // $result = ($percentage / 100) * $number;
                    ?>
                </td>
                <td class="text-center">
                    <?php echo $sumAllPresent
                        $result = ($sumAllPresent / 100) * $sumAllEmp;
                        echo "(.".$result."%)"
                    ?>
                </td>
                <td class="text-center">
                    <?php echo $sumAllAbsent
                        $result = ($sumAllAbsent / 100) * $sumAllEmp;
                        echo "(.".$result."%)"
                    ?>
                </td>
                <td class="text-center">
                    <?php echo $sumAllMale
                        $result = ($sumAllMale / 100) * $sumAllEmp;
                        echo "(.".$result."%)"
                    ?>
                </td>
                <td class="text-center">
                    <?php echo $sumAllFemale
                        $result = ($sumAllFemale / 100) * $sumAllEmp;
                        echo "(.".$result."%)"
                    ?>
                </td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td class="text-center"><?php echo $sumAllLeave?></td>
                <td class="text-center"><?php echo $sumAllLate?></td>
                <td></td>
			</tr>
		</table>
    </div>
</body>
</html>