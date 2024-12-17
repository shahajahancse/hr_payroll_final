<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <style>
        body{
            font-size: 13px;
        }
        .table, th, td {
            border:1px solid black;
            border-collapse: collapse;
        }
    </style>
</head>
<body>
     <!-- < ?php dd($results);?> -->
    <?php $this->load->view("head_english");?>
    <h4 style="text-align:center">Attendence Summary Report <?php echo date('d/m/Y',strtotime($report_date))?></h4>
    <div align="center" class="container">
		<table class="table">
			<tr>
				<th class="text-center" style="text-align:center; background: #dbf5f9;">Sl.</th>
				<th class="text-center" style="text-align:center; background: #dbf5f9;">Line Name</th>
                <th class="text-center" style="text-align:center">Total</th>
				<th class="text-center" style="text-align:center">Present</th>
                <th class="text-center" style="text-align:center">Absent</th>
				<th class="text-center" style="text-align:center; background: #dbf5f9;">Male</th>
                <th class="text-center" style="text-align:center; background: #dbf5f9;">Female</th>
                <?php $dddd = 0; foreach($keys as $key){ $dddd = $dddd + 1; ?>
                <?php if ($dddd % 2 == 0) { ?>
                    <th style="padding:0px; background: #dbf5f9;">
                        <table style="border-collapse: collapse;border:0px white;">
                            <tr>
                                <th class="text-center" colspan='3' style="padding: 0;width: 92px;border: none;border-bottom: 1px solid black;"><?php echo $key ?></th>
                            </tr>
                            <tr>
                                <td style="width:25px;border: none;margin: 0;border-right:1px solid black;">TT</td>
                                <td style="width:25px;border: none;margin: 0;">PR</td>
                                <td style="width:25px;border: none;margin: 0;border-left:1px solid black;">AB</td>
                            </tr>
                        </table>
                    </th>
                <?php } else { ?>
                    <th style="padding:0px;">
                        <table style="border-collapse: collapse;border:0px white;">
                            <tr>
                                <th class="text-center" colspan='3' style="padding: 0;width: 92px;border: none;border-bottom: 1px solid black;"><?php echo $key ?></th>
                            </tr>
                            <tr>
                                <td style="width:25px;border: none;margin: 0;border-right:1px solid black;">TT</td>
                                <td style="width:25px;border: none;margin: 0;">PR</td>
                                <td style="width:25px;border: none;margin: 0;border-left:1px solid black;">AB</td>
                            </tr>
                        </table>
                    </th>
                <?php } } ?>
				<th class="text-center">Leave</th>
                <th class="text-center">Late</th>
				<th class="text-center">Remark</th>
			</tr>
            <?php
            // dd($results);
                $i=1;
                $sumAllEmp=$sumAllPresent=$sumAllPresent=$sumAllAbsent=$sumAllMale=$sumAllFemale=$sumAllLeave=$sumAllLate=0;
                $tt=$pr=$ab= array();
                foreach($results as $row){

                $sumAllEmp      += $row->all_emp;
                $sumAllPresent  += $row->all_present;
                $sumAllAbsent   += $row->all_absent;
                $sumAllMale     += $row->all_male;
                $sumAllFemale   += $row->all_female;
                $sumAllLeave   += $row->all_leave;
                $sumAllLate    += $row->all_late;
            ?>
			<tr>
				<td style="text-align:center; background: #dbf5f9;"><?php echo $i++?></td>
				<td style="text-align:center; background: #dbf5f9;"><?php echo $row->line_name_en?></td>
				<td style="text-align:center"><?php echo $row->all_emp?></td>
				<td style="text-align:center"><?php echo $row->all_present?></td>
				<td style="text-align:center"><?php echo $row->all_absent?></td>
				<td style="text-align:center; background: #dbf5f9;"><?php echo $row->all_male?></td>
				<td style="text-align:center; background: #dbf5f9;"><?php echo $row->all_female?></td>
               <?php $dddd = 0;
                    // dd($row);
                    foreach($keys as $key){ $dddd = $dddd + 1;
                        $group_data = $row->group_data[$key]?? (object) array('total_emp'=>0, 'emp_present'=>0, 'emp_absent'=>0);


                        if(!isset($tt[$key])){
                            $tt[$key] =0;
                            $ab[$key] =0;
                            $pr[$key] =0;
                        }

                    $tt[$key] += (isset($group_data->total_emp))?$group_data->total_emp :0;
                    $pr[$key] += (isset($group_data->emp_present))?$group_data->emp_present :0;
                    $ab[$key] += (isset($group_data->emp_absent))?$group_data->emp_absent :0;
                ?>
                <?php if ($dddd % 2 == 0) { ?>
                    <td style="padding:0px; background: #dbf5f9;">
                        <table style="border-collapse: collapse;border:0px white;width: -webkit-fill-available;" >
                            <tr>
                                <td class="text-center;" style="text-align:center;border: none;width:16px;margin: 0;border-right:1px solid black;"><?php echo (isset($group_data->total_emp))?$group_data->total_emp :'--'?></td>
                                <td class="text-center;" style="text-align:center;border: none;width:16px;margin: 0;"><?php echo  (isset($group_data->emp_present))?$group_data->emp_present :'--'?></td>
                                <td class="text-center;" style="text-align:center ;border: none;width:16px;margin: 0;border-left:1px solid black;"><?php echo  (isset($group_data->emp_absent))?$group_data->emp_absent :'--'?></td>
                            </tr>
                        </table>
                    </td>
                <?php } else { ?>
                    <td style="padding:0px">
                        <table style="border-collapse: collapse;border:0px white;width: -webkit-fill-available;" >
                            <tr>
                                <td class="text-center;" style="text-align:center;border: none;width:16px;margin: 0;border-right:1px solid black;"><?php echo (isset($group_data->total_emp))?$group_data->total_emp :'--'?></td>
                                <td class="text-center;" style="text-align:center;border: none;width:16px;margin: 0;"><?php echo  (isset($group_data->emp_present))?$group_data->emp_present :'--'?></td>
                                <td class="text-center;" style="text-align:center ;border: none;width:16px;margin: 0;border-left:1px solid black;"><?php echo  (isset($group_data->emp_absent))?$group_data->emp_absent :'--'?></td>
                            </tr>
                        </table>
                    </td>
                <?php } } ?>
				<td class="text-center" style="text-align:center;"><?php echo $row->all_leave?></td>
				<td class="text-center" style="text-align:center;"><?php echo $row->all_late?></td>
                <td></td>
			</tr>
            <?php }?>
			<tr>
				<td colspan="2" style="vertical-align: middle;text-align: center;font-weight:bold">Total</td>
                <td class="text-center" style="vertical-align: middle;text-align: center;font-weight:bold;text-align:center;">
                    <?php echo $sumAllEmp;
                        // $result = ($percentage / 100) * $number;
                    ?>
                </td>
                <td class="text-center" style="font-weight:bold;text-align:center;">
                    <?php echo $sumAllPresent.'<br>';
                        $result = ($sumAllPresent / $sumAllEmp) * 100;
                        echo "(".round($result, 2)."%)";
                    ?>
                </td>
                <td class="text-center" style="font-weight:bold;text-align:center;">
                    <?php echo $sumAllAbsent.'<br>';
                        $result = ($sumAllAbsent / $sumAllEmp) * 100;
                        echo "(".round($result, 2)."%)";
                    ?>
                </td>
                <td class="text-center" style="font-weight:bold;text-align:center;">
                    <?php echo $sumAllMale.'<br>';
                        $result = ($sumAllMale / $sumAllEmp) * 100;
                        echo "(".round($result, 2)."%)";
                    ?>
                </td>
                <td class="text-center" style="font-weight:bold;text-align:center;">
                    <?php echo $sumAllFemale.'<br>';
                        $result = ($sumAllFemale / $sumAllEmp) * 100;
                        echo "(".round($result, 2)."%)";
                    ?>
                </td>
               <?php foreach($keys as $key){?>
                <td style="padding:0px">
                    <table style="border-collapse: collapse;border:0px white;width: -webkit-fill-available;" >
                        <tr>
                            <td class="text-center" style="text-align:center;text ;width:30px;border: none;padding: 9px 0px;margin: 0;border-right:1px solid black;"><?php echo $tt[$key];?></td>
                            <td class="text-center" style="text-align:center;text ;width:30px;border: none;padding: 9px 0px;margin: 0;"><?php echo  $pr[$key]?></td>
                            <td class="text-center" style="text-align:center;text ;width:30px;border: none;padding: 9px 0px;margin: 0;border-left:1px solid black;"><?php echo $ab[$key] ?></td>
                        </tr>
                    </table>
               </td>
                <?php }?>
                <td class="text-center" style="font-weight:bold;text-align:center;">
                    <?php echo $sumAllLeave.'<br>';
                         $result = ($sumAllLeave / $sumAllEmp) * 100;
                         echo "(".round($result, 2)."%)";
                    ?>
                </td>
                <td class="text-center" style="font-weight:bold;text-align:center;">
                    <?php echo $sumAllLate.'<br>';
                        $result = ($sumAllLate / $sumAllEmp) * 100;
                        echo "(".round($result, 2)."%)";
                    ?>
                </td>
                <td></td>
			</tr>
		</table>
    </div>
    <br><br>
</body>
</html>
<?php exit(); ?>









