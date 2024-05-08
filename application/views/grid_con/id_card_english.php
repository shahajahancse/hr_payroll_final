<?php error_reporting(0);?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ID Card BN</title>
<link  rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/id_card_style.css" />
<style type="text/css">

.bijoy{
font-family:SutonnyMJ;
font-size:10px;
}

@font-face {
font-family: "kalpurush";
src: url("css/fonts/kalpurush.ttf");
}
</style>
</head>

<body>

<?php
//print_r($values);
$i = 0;
$k = 0;
//for($k=0; $k<=100; $k++)
$count = $values->num_rows();
$div_loop = ceil($count/4);
$data = $values->result_array();

for($j=1; $j<= $div_loop; $j++){
?>
<div style="overflow:hidden;">
	<table border="0" cellpadding="0" cellspacing="0" style="line-height: 14px;">
	<tr>
	<?php
	$end = $k + 3;
	$l = 0;
	$m=0;
	if($j == $div_loop){
		$end = $count - $div_loop;
	}
	for($i =$k; $i <= $end; $i++){
		++$m;

		if($l % 2 == 0){
	?>
	</tr>
<?php
if($m>=4 and $m % 4 == 0){
	echo '<div style="page-break-after: always;"></div>';
}
?>
	<tr>
<?php } ?>
	<td style="width:400px; height:350px; padding: 3px 15px;" valign='top' align='center'>
		<div class="id_card_front" style="width:195px; height:312px; padding:1px; vertical-align: top; border-radius: 10px; border:1px solid black; float: left;">
		  	<div class="front_top" style="margin-top: 3px; float: left;">
				<div class="front_top_left" style="width:30px; float:left;">
					<img src="<?php  echo base_url();?>images/<?php echo $company_logo = $this->common_model->company_info()->company_logo; ?>" height="25px" width="25px" />
				</div>
				<div class="front_top_middle" style="width:160px; text-align:center; float:left; margin: 0 auto;vertical-align:top;line-height: 14px;">
					<div class="e_front_col_6" style="font-size:12px; padding:1px 16px 0px 0px;">
						<spam style="font-size: 12px;  ">ID Card</spam>
					</div>
				   	<div class="e_front_col_6" style="font-size:12px; padding:1px 22px 0px 0px;">
						<b><spam style="font-size: 12px;  "><?php echo "Loopdot Fashion Ltd."; ?></spam></b>

					</div>
				</div>
			</div>
			<div class="front_top_left" style="width:100%; vertical-align:top; font-size: 20px;">
				<div style="width:100%;padding-right:5px;text-align:center;margin-top: 0px;font-size:12px;">
					<p style="margin: 0px;  font-size:12px;"> Phone:
						<?php echo $this->common_model->company_info()->company_phone; ?>
					</p>
				</div>
				<div style="height: 5px;"></div>
				<div style="width:100%;text-align:center;margin-top: 0px; padding:2px 0 0 2px;" >
					<img style="border:1px dashed black;" src="<?php echo base_url();?>uploads/photo/<?php echo $data[$i]["img_source"];?>" width="70" height="65" />
				</div>
			</div>
			<div class="front_top_left" style="width:100%; vertical-align:top; font-size: 20px; padding-top: 1px; text-align-last: left;">
				<div class="front_row_left_3">
					<div class="e_front_col_3" style="line-height: 14px;font-size: 12px; margin: 5px;">1। Name: <b><?php echo $data[$i]["emp_full_name"]; ?></b></div>
				</div>
				<div class="front_row_left_1">
					<div class="e_front_col_1" style="line-height: 14px;font-size: 12px; margin: 5px; ">2। Card No: <b><span><?php echo $data[$i]["emp_id"] ?></span></b></div>
				</div>
			</div>
			<div class="front_row_2" style="text-align-last: left;">
				<div class="e_front_col_8" style="line-height: 14px;font-size: 12px; margin: 2px; ">
					3। Designation <b>
				   <?php
				     $des = strtolower($data[$i]["desig_name"]);
	                  echo ucwords($des);
				   ?>

				   </b>
				</div>
			</div>
			<div class="front_row_3" style="text-align-last: left;">
				<div class="e_front_col_12" style="line-height: 14px;font-size: 12px; margin: 2px; ">
					4। Section: <b><?php echo $data[$i]["sec_name"]; ?></b></div>
			</div>
			<div class="front_row_3" style="text-align-last: left;">
				<div class="e_front_col_12" style="line-height: 14px;font-size: 12px; margin: 2px;">
					5। Line: <b><?php echo $data[$i]["line_name"]; ?></b></div>
			</div>

			<div class="front_row_3" style="text-align-last: left;">
				<div class="e_front_col_12" style="line-height: 14px;font-size: 11px; margin: 2px;  ">
					6। Work type: <b><?php echo $data[$i]["wk_type"]; ?></b></div>
			</div>

			<div class="front_row_4" style=" text-align-last: left;">
				<div class="e_front_col_13" style="font-size: 12px; line-height: 14px;margin: 2px; ">
					7। join Date : <b>
					<?php
						$join_date = $data[$i]["emp_join_date"];
						$year=trim(substr($join_date,0,4));
						$month=trim(substr($join_date,5,2));
						$day=trim(substr($join_date,8,2));
						echo " ".$date_format = date("d/m/Y", mktime(0, 0, 0, $month, $day, $year));
					?></b>
				</div>
			</div>

			<div class="front_row_5" style="text-align:left;margin-top:7px;  width: 100%;">
				<div style=" float: left;  width: 50%;">
					<img src="<?php echo base_url();?>images/<?php echo $company_signature = $this->common_model->company_info()->company_signature; ?>" width="60" height="20" />
				</div>
				<div style=" width: 45%; height: 20px; border: 1px dashed black; float: right; "></div>
			</div>


			<!-- <div class="front_row_7" style=" margin-top:1px; width: 100%; ">
				<div class="e_front_col_19" style=" width: 47%; float:left; border-top:1px dotted black; font-size: 12px; margin: 1px;line-height: 14px;">Authority</div>
				<div class="e_front_col_18" style=" width: 50%; float:right; font-size: 12px; margin: 1px;">Signature</div>
			</div> -->


			<div class="front_row_7" style=" margin-top:1px; width: 100%;">
			<div class="e_front_col_19" style=" width: 60%; float:left; border-top:1px dotted black; font-size: 13px; margin: 1px;">Authority Signature</div>
			<div class="e_front_col_18" style=" width: 35%; float:right; font-size: 13px; margin: 1px;">Signature</div>
		</div>

		</div>

		<div class="id_card_front" style="width:195px; height:312px; padding:1px; vertical-align: top; border-radius: 10px; border:1px solid black; float: right;line-height: 14px;">
			<div class="front_top_left" style="width:100%; vertical-align:top; font-size: 15px; padding-top: 5px;">
				<div class="front_row_left_3">
					<div class="e_front_col_6" style="font-size: 12px; margin: 5px 0;  ">Blood Group : &nbsp;<b><?php echo $data[$i]["blood_name"]; ?></b></div>
				</div>
				<div class="front_row_left_1">
					<div class="e_front_col_1" style="font-size: 12px; min-height: 40px; margin: 20px 0;  "> Permanent Address: <b><?php echo $data[$i]["emp_par_add"]; ?></b></div>
				</div>
			</div>
			<div class="front_row_2">
				<div class="e_front_col_8" style="font-size: 12px; min-height: 10px; margin: 5px 0;  line-height: 14px;">
					Contact Number: <b>
					<?php //echo $company_logo = $this->common_model->company_information("company_phone"); ?>
				    <?php  echo $des = strtolower($data[$i]["mobile"]);  ?>
				   </b>
				</div>
				<div class="e_front_col_12" style="font-size: 12px; margin: 5px 0;  ">
					NID Card: <b>
					<?php echo $data[$i]["emp_n_id"]; ?>

				   </b>
				</div>
			</div>

			<br>
			<div class="front_top" style="float: left; width: 100%; margin: 0 auto; margin-bottom: 5px;">
				<div style="padding: 5px; font-size: 13px;">If Found Please Return To : </div>
				<div class="front_top_left" style=" float:left; margin: 0 0 0 20px;">
					<img src="<?php  echo base_url();?>images/<?php echo $company_logo = $this->common_model->company_info()->company_logo; ?>" height="30" width="30" />
				</div>
				<div class="front_top_middle" style=" height: 20px; text-align:center; float:right; margin: 0;vertical-align:top; float: left;   padding-top: 10px;">
					<b><spam style="font-size: 16px;line-height: 14px;">&nbsp;<?php echo "  &nbsp;&nbsp; Loopdot Fashion Ltd."; ?></spam></b>
				</div>
			</div>
			<div class="front_top_left" style="width:100%; vertical-align:top; font-size: 20px; ">
				<div style="width:100%;padding:5px;text-align:center;margin-top: 0px;font-size:12px;">
					<p style="margin: 0px; font-size: 12px;line-height: 14px;"><?php echo $company_logo = $this->common_model->company_info()->company_add_english; ?></p>
					<p style="margin: 0px;">Phone: <?php echo $company_logo = $this->common_model->company_info()->company_phone; ?></p>
				</div>
			</div>
		</div>
	</td>
	<?php
	$k =$i+1;
	$l++;
	}
	?>
	</tr>
</table>

</div>
<br />
<?php
}
?>

</body>
</html>

<?php exit(); ?>
