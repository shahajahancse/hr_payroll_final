<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title> Daily
        <?php
			if ($daily_status == 2)
			{
				echo "Absent";
			}
			else if($daily_status == 1)
			{
				echo "Present";
			}
			else if($daily_status == 3)
			{
				echo "Leave";
			}
			elseif($daily_status == 4)
			{
				echo "Late";
			}
			elseif($daily_status == 5)
			{
				echo "OT";
			}
			elseif($daily_status == 6)
			{
				echo "EOT";
			}
			elseif($daily_status == 7)
			{
				echo "OUT & IN";
			}
			elseif($daily_status == 8)
			{
				echo "Punch Miss";
			}
		?>
        Report</title>
    <!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/print.css" media="print" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/SingleRow.css" /> -->
    <style>
    @media print {
        table {
            widht: 600px !important;
        }
		#btnExport {
				display: none;
		}
    }
    </style>
</head>

<body style="margin: 0px;">
	<span id='massage'></span>
	<div id='all_data'>
    <?php $this->load->view("head_english"); ?>
<<<<<<< HEAD
<<<<<<< HEAD
    <!--Report title goes here-->
    <div align="center"  style=" margin:0 auto;  overflow:hidden; font-family: 'Times New Roman', Times, serif;">
=======
	<button style='position:absulate;margin-left:50px' id="btnExport">Download as Excel</button>
    <div align="center" style=" margin:0 auto;  overflow:hidden; font-family: 'Times New Roman', Times, serif;">
    <!--Report title goes here-->
>>>>>>> bf661ad8fac5127562e40f191e767e275d29986f
=======

	<button style='position:absulate;margin-left:50px' id="btnExport">Download as Excel</button>
    <div align="center" style=" margin:0 auto;  overflow:hidden; font-family: 'Times New Roman', Times, serif;">
    <!--Report title goes here-->
>>>>>>> 4576f5ada5e890be8307e4763ec790af8a0a0d19
        <span style="font-size:12px; font-weight:bold;"> Daily
            <?php

			//    dd($values);
				if ($daily_status == 2)
				{
					echo "Absent";
				}
				elseif($daily_status == 1)
				{
					echo "Present";
				}
				elseif($daily_status == 3)
				{
					echo "Leave";
				}
				elseif($daily_status == 4)
				{
					echo "Late";
				}
				elseif($daily_status == 5)
				{
					echo "OT";
				}
				elseif($daily_status == 6)
				{
					echo "EOT";
				}
				elseif($daily_status == 7)
				{
					echo "OUT & IN";
				}
				elseif($daily_status == 8)
				{
					echo "Punch Miss";
				}
			?> Report , Date
            <?php echo date("d/m/Y",strtotime($date)); ?>
        </span>
        <br><br>
        <table border="1" cellpadding="0" cellspacing="0" style="font-size:12px; width:700px; margin-bottom:20px;" id='report-data'>
            <?php $this->load->model('Grid_model'); $i=1;
			$groupedData = array();
			
			foreach ($values as $employee) {
				if($employee['out_time'] == '00:00:00' && $employee['in_time'] == '00:00:00' && in_array($daily_status,array(7,8))) {
					continue;
				}
				
				$sectionName = $employee['sec_name_en'];
				$groupedData[$sectionName][] = $employee;
			} ?>

            <?php foreach ($groupedData as $sectionName => $employees) { ?>
            <tr
                style="background:radial-gradient(#585252, transparent); backdrop-filter: brightness(0.5);padding: 3px;">
                <td style="width:0px;border:none;font-size:14px;float:left;white-space:nowrap;padding:0 4px">
                    <b> <?php echo $sectionName ?></b>
                </td>
            </tr>
            <tr>
                <th style="padding-left:10px;padding-right:10px;">SL</th>
                <th style="padding-left:10px;padding-right:10px;">ID</th>
                <th style="padding:0 4px;">Employee Name</th>
                <th style="">Designation</th>
                <th style="padding:0 4px">Line</th>
                <th style="">Shift</th>
                <?php if($daily_status == 4){?>
                	<th style="padding:0 4px">In Time</th>
                <?php }?>

                <?php if($daily_status==1 || $daily_status== 5 || $daily_status==6 || $daily_status==7 || $daily_status==8){?>
					<th style="padding:0 4px">In Time</th>
					<th style="padding:0 4px">Out Time</th>
                <?php }?>

                <?php if($daily_status == 5){ ?>
                	<th style="padding:0 4px">OT Hour</th>
                <?php } ?>
				<?php if($daily_status == 6){ ?>
					<th>OT Hour</th>
					<th>EOT Hour</th>
					<!-- <th>Modify EOT</th>
					<th>Deduct EOT</th> -->
					<!-- <th>Final EOT</th> -->
					<th>Total OT</th>
                <?php } ?>

				<!-- < php if($daily_status != 8){?> -->
					<!-- <th style="padding:0 4px">Status</th> -->
				<?php  if($daily_status != 8) { ?>
					<th style="padding:0 4px">Status</th>
				<?php } ?>

                <?php if($daily_status == 2){?>
					<th>Mobile</th>
					<th>Remark</th>
                <?php }?>
                <?php if($daily_status == 2 || $daily_status == 4){?>
                	<th>Sign</th>
                <?php }?>
            </tr>

            <?php 	foreach ($employees as $key=>$employee) {
				
				$emp_num_rows = $this->Grid_model->attendance_check_for_absent($employee['emp_id'],$date);
				//dd($emp_num_rows);

				?>
            <tr>
                <td style="text-align:center"><?php echo $i++?></td>
                <td style="text-align:center;padding:0 4px"><?php echo $employee['emp_id']?></td>
                <td style="text-align:center"><?php echo $employee['name_en']?></td>
                <td style="text-align:center"><?php echo $employee['desig_name']?></td>
                <td style="text-align:center;padding:0 4px"><?php echo $employee['line_name_en']?></td>
                <td style="text-align:center;"><?php echo $employee['shift_name']?></td>

				<?php if($daily_status == 4){?>
					<td style="text-align:center; padding:0 4px">
						<?php echo date('h:i:s A',strtotime($employee['in_time']))?>
					</td>
                <?php }?>

                <?php if($daily_status==1 || $daily_status== 5 || $daily_status==6 || $daily_status==7 || $daily_status==8){?>
					<td style="text-align:center; padding:0 4px">
						<?php 
							echo $employee['in_time'] !='00:00:00' ? date('h:i:s A',strtotime($employee['in_time'])) : "";
						?>
					</td>
					<td style="text-align:center; padding:0 4px">
					<?php
					//dd($daily_status);
					if ($daily_status==5 &&  $employee['ot']>=2) {
						//dd($employee['ot']);
						$text= ($employee['out_time'] !='00:00:00')? date('7:i:s A',strtotime($employee['out_time'])) : "";
					}else{
						$text= ($employee['out_time'] !='00:00:00')? date('h:i:s A',strtotime($employee['out_time'])) : "";
					}
					?>


						<?php echo $text ?>
					</td>
                <?php }?>

                <?php if($daily_status == 5){?>
                	<td style="text-align:center"><?php echo $employee['ot']?></td>
                <?php }if($daily_status == 6){?>
                <td style="text-align:center"><?php echo $employee['ot']?></td>
                <td style="text-align:center"><?php echo $employee['eot']?></td>
                <!-- <td style="text-align:center"> ?php echo $employee['modify_eot']?></td>
                <td style="text-align:center">< ?php echo $employee['deduction_hour']?></td> -->
                <!-- <td style="text-align:center">
                    < ?php echo ($employee['eot']+ $employee['modify_eot']+$employee['deduction_hour'])?></td> -->
                <td style="text-align:center">
                    <?php echo ($employee['ot']+$employee['eot']+ $employee['modify_eot']+$employee['deduction_hour'])?>
                </td>
                <?php }?>

				<?php if($daily_status != 8){?>
					<td style="text-align:center">
						<?php
							if($daily_status == 3){
								echo  ( $employee['leave_type'] =='cl'? 'Casual Leave':
									( $employee['leave_type'] =='sl'? 'Sick Leave':
									( $employee['leave_type'] =='ml'? 'Maternity Leave':
									( $employee['leave_type'] =='el'? 'Earn Leave': 'Leave'))));
							}else if($daily_status == 2){
								echo  $emp_num_rows;
							}
							// else{
								// echo  $daily_status != 4 ? $employee['present_status'] : "P(Late)";
							// }
						?>
					</td>
				<?php } else { ?>
					<td style="padding-top:30px;padding-left:80px"> </td>
				<?php } ?>

                <?php if($daily_status == 2){?>
					<td style="padding:0 4px"><?php echo $employee['personal_mobile']?></td>
					<td style="padding-top:30px;padding-left:80px"></td>
                <?php }?>
                <?php if($daily_status == 2 || $daily_status == 4){?>
                	<td style="padding-top:30px;padding-left:80px"> </td>
                <?php }?>
            </tr>
            <?php } }
				
			
			?>
            <tr style="border:none;font-size:14px;white-space:nowrap">
                <td colspan="10" style="padding:0 4px">
                    <?php echo  "<style='float:left;'>Total : " . $i-1?>
                </td>
            </tr>

        </table>
	</div>
	<br><br>

<<<<<<< HEAD
<<<<<<< HEAD
	</div>
	<?php if($i-1 == 0){ ?>
	<script>
 		document.getElementById('all_data').remove();
 		document.getElementById('massage').innerHTML = 'Requested list is empty';
	</script>
	<?php }?>
=======
=======
>>>>>>> 4576f5ada5e890be8307e4763ec790af8a0a0d19


<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.4/xlsx.full.min.js"></script>
<script>
		function convert_excel(type, fn, dl) {
			var elt = document.getElementById('report-data');
			var wb = XLSX.utils.table_to_book(elt, {sheet:"Sheet JS"});
			return dl ?
				XLSX.write(wb, {bookType:type, bookSST:true, type: 'base64'}) :
				XLSX.writeFile(wb, fn || ('Reports.' + (type || 'xlsx')));
		}
		$("#btnExport").click(function(event) {
		convert_excel('xlsx');
		});
</script>
<<<<<<< HEAD
>>>>>>> bf661ad8fac5127562e40f191e767e275d29986f
=======

>>>>>>> 4576f5ada5e890be8307e4763ec790af8a0a0d19
</body>

</html>
<?php exit(); ?>
