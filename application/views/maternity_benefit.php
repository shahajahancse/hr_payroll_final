<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<title>Maternity Benefit Report</title>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/SingleRow.css" />
<style type="text/css">
.center{ text-align:center;}
.right{text-align:right; padding-right:10px;}
.left{text-align:left; padding-left:10px;}

 table.sal{
		border:1px solid #000;
		border-collapse: collapse;
		width: 100%;
		text-align: center;
		margin-top:0px;
	}

	table.sal tr,table.sal tr th,table.sal tr td{
		border:1px solid #000;
		border-collapse: collapse;
	}
	table.Installment_cal{
		border:1px solid #000;
		border-collapse: collapse;
		width: 100%;
		text-align: center;
		margin-top:0px;
	}

	table.Installment_cal tr,table.Installment_cal tr th,table.Installment_cal tr td{
		border:1px solid #000;
		border-collapse: collapse;
	}
	tr td{
		font-size:15px !important;
	}
</style>
</head>

<body>
<?php
 function english_to_bangla_date_convert($date)
 {
	$date = date("d/F/Y",strtotime($date));

    $search_array= array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0", "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December", ":", ",","/"); 

    $replace_array= array("১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০", "জানুয়ারী", "ফেব্রুয়ারী", "মার্চ", "এপ্রিল", "মে", "জুন", "জুলাই", "আগষ্ট", "সেপ্টেম্বার", "অক্টোবার", "নভেম্বার", "ডিসেম্বর", ":", ",","/");

    return $en_number = str_replace($search_array, $replace_array, $date);
 }
?>
<?php
	function numberTowords($num) { 
		$ones = array( 
			1 => "one", 
			2 => "two", 
			3 => "three", 
			4 => "four", 
			5 => "five", 
			6 => "six", 
			7 => "seven", 
			8 => "eight", 
			9 => "nine", 
			10 => "ten", 
			11 => "eleven", 
			12 => "twelve", 
			13 => "thirteen", 
			14 => "fourteen", 
			15 => "fifteen", 
			16 => "sixteen", 
			17 => "seventeen", 
			18 => "eighteen", 
			19 => "nineteen" 
		); 
		$tens = array( 
			1 => "ten",
			2 => "twenty", 
			3 => "thirty", 
			4 => "forty", 
			5 => "fifty", 
			6 => "sixty", 
			7 => "seventy", 
			8 => "eighty", 
			9 => "ninety" 
		); 
		$hundreds = array( 
			"hundred", 
			"thousand", 
			"million", 
			"billion", 
			"trillion", 
			"quadrillion" 
		); //limit t quadrillion 
		$num = number_format($num,2,".",","); 
		$num_arr = explode(".",$num); 
		$wholenum = $num_arr[0]; 
		$decnum = $num_arr[1]; 
		$whole_arr = array_reverse(explode(",",$wholenum)); 
		krsort($whole_arr); 
		$rettxt = ""; 
		foreach($whole_arr as $key => $i){ 
			if($i < 20){ 
				$rettxt .= $ones[$i]; 
			}elseif($i < 100){ 
				$rettxt .= $tens[substr($i,0,1)]; 
				$rettxt .= " ".$ones[substr($i,1,1)]; 
			}else{ 
				$rettxt .= $ones[substr($i,0,1)]." ".$hundreds[0]; 
				$rettxt .= " ".$tens[substr($i,1,1)]; 
				if (isset($ones[substr($i,2,1)])) {
					$rettxt .= " ".$ones[substr($i,2,1)]; 
				}
			} 
			if($key > 0){ 
				$rettxt .= " ".$hundreds[$key]." "; 
			} 
		} 

		if($decnum > 0){ 
			$rettxt .= " and "; 
			if($decnum < 20){ 
				$rettxt .= $ones[$decnum]; 
			}elseif($decnum < 100){ 
				$rettxt .= $tens[substr($decnum,0,1)]; 
				$rettxt .= " ".$ones[substr($decnum,1,1)]; 
			} 
		} 
		return $rettxt; 
	}

 ?>

<?php
if($values->num_rows() == 0)
{
	echo 'Requested list is empty';
	exit();
}

$ddddd = $values->result();
$unit_id = $ddddd[0]->unit_id;

foreach($values->result() as $row){ ?>


<div style=" width:900px; height:1050px; margin:0 auto;  overflow:hidden;  font-family: Arial, Helvetica, sans-serif; font-size:12px; clear: both;">
  	
  	<table>
  		<tr>
  			<?php $company_info = $this->common_model->company_info($unit_id); ?>
  			<td width="100px">
  				<img width="80" height="60" src="<?php echo base_url(); ?>images/<?php echo $company_info->company_logo; ?>" />
  			</td>
  			<td style="">
  				<div style="margin-left: 200px;"><?php $this->load->view('head_english'); ?></div>
  			</td>
  		</tr>
  	</table> 
  	<div style="width: 800px;border:2px solid #000;margin: 15px auto;"></div>
    <div style="font-size:20px; font-weight:bold; text-align:center; ">প্রসূতি কল্যাণ সুবিধা</div>
	<br />  
    <div style=" width:50%;font-size:12px; font-weight:bold;">
		<table width="383" border="0" cellpadding="0" cellspacing="0" style="font-size:14px; font-weight:bold;">
		  <tr>
			<td width="147">নাম</td>
			<td width="10">:</td>
			<td width="226"><span style="font-family:Arial, Helvetica, sans-serif;"><b><?php echo $row->name_bn; ?></b></span> </td>
		  </tr>
		  <tr>
			<td>কার্ড নং</td>
			<td>:</td>
			<td>
				<span style="font-family:SutonnyMJ;">
					<b>
						<?php echo $row->emp_id;?>
					</b>
				</span>
			</td>
		  </tr>
		   <tr>
			<td>পদবী</td>
			<td>:</td>
			<td>
				<span style="font-family:Arial, Helvetica, sans-serif;">
					<b>
						<?php echo $designation = $row->desig_bangla;?>
					</b>
				</span>
			</td>
		  </tr>
		  <tr>
			<td>গ্রেড</td>
			<td>:</td>
			<td>
				<span style="">
					<b>
						<?php echo $gr_name = $row->gr_name;?>
					</b>
				</span>
			</td>
		  </tr>
		   <tr>
			<td>বিভাগ</td>
			<td>:</td>
			<td>
				<span style="font-family:Arial, Helvetica, sans-serif;">
					<b>
						<?php echo $section = $row->sec_name_bn;?>
					</b>
				</span>
			</td>
		  </tr>
		  <tr>
			<td>যোগদানের তারিখ</td>
			<td>:</td>
			<td>
				<span style="font-family:SutonnyMJ;">
					<b>
						<?php echo $emp_join_date =  date('d/m/Y',strtotime($row->emp_join_date)); ?>
					</b>
				</span>
			</td>
		  </tr>
		  <tr>
			<td>সন্তান  প্রসবের সম্ভাব্য তারিখ</td>
			<td>:</td>
			<td>
				<span style="font-family:SutonnyMJ">
					<b></b>
				</span>
			</td>
		  </tr>
		  <tr>
			<td>ছুটির শুরুর তারিখ</td>
			<td>:</td>
			<td>
				<span style="font-family:SutonnyMJ;">
					<b>
						<?php echo $start_leave_date =  date('d/m/Y',strtotime($row->start_date)); ?>
					</b>
				</span>
			</td>
		  </tr>
		  <tr>
			<td>ছুটির শেষের তারিখ</td>
			<td>:</td>
			<td>
				<span style="font-family:SutonnyMJ;">
					<b>
						<?php echo $end_leave_date =  date('d/m/Y',strtotime($row->leave_end)); ?>
					</b>
				</span>
			</td>
		  </tr>
		</table>
		
	  </div>

  	<br style="clear:both;height:50px;width: 100%;"/>
  	<table style="width: 100%;font-size: 14px;">
  		<tr>
  			<td>
  				<p>কারখানায় নিয়োজিত রেজিষ্টার্ড চিকিৎসক দ্বারা পরীক্ষা করে অনুমিত হয়েছে, যে .......................... ইং তারিখে তার সন্তান প্রসবের সম্ভাবনা রয়েছে এবং এই মর্মে তাকে উপরোল্লিখিত ছুটির তারিখ অনুযায়ী ১৬ সপ্তাহ বা ১১২ দিন এর জন্য মাতৃত্ব কালীন ছুটির ছাড়পত্র প্রদান সহ নিম্নরূপে প্রসূতি কল্যান সুবিধার ১ম ধাপ প্রদান করা যাচ্ছে।</p>
  			</td>
  		</tr>
  		<tr style="text-align: center;">
  			<td>
  				<span style="width:500px;border-bottom:1px solid #000;">ছুটির অব্যবহিত পূর্ববর্তী  তিন মাসের অর্জিত মজুরী (বেতন, ওভার টাইম এবং অন্যান্য)</span>
  			</td>
  		</tr>
  	</table>
  	<div style="width: 100%;height: 10px;clear: both;"></div>
  	<?php $three_month_back = $this->Leave_model->three_month_back_record($row->emp_id,$row->start_date);?>
	<div style="width:100%;">
	  <table class="sal" width="100%" cellpadding="1" cellspacing="1">
		<tr>
			<th>নং</th>
			<th>মাস</th>
			<th>দিন	</th>
			<th >সাপ্তাহিক ছুটি</th>
			<th >অন্যান্য ছুটি</th>
			<th>অনুপস্থিতির দিন</th>
			<th >মোট প্রকৃত<br> কর্ম দিবস</th>
			<th >অনুপস্থিতর জন্য <br>কর্তন</th>
			<th >প্রদেয় মোট <br>বেতন</th>
			<th >অতিরিক্ত ভাতা</th>
			<th>ও টি</th>
			<th >হাজিরা বোনাস</th>
			<th >উৎসব বোনাস </th>
			<th>স্ট্যাম্প</th>
            <th>সর্বমোট</th>
		</tr>
		<?php 
		$i=1; 
		//$ttl_days 		= 0;
		$ttl_wk_days 	= 0;
		$ttl_absdeduct 	= 0;
		$ttl_net_pay 	= 0;
		$ttl_extra_allow= 0;
		$ttl_ot 		= 0;
		$ttl_att_bonus  = 0;
		$ttl_fest_bonus = 0;
		$ttl_stamp 		= 0;
		$ttl_earning 	= 0;
		$ttl_festival   = 0;
		$absent_days     =0;

		foreach($three_month_back as $month){
		?>
		<tr style="font-family: SutonnyMJ;">
			<td><?php echo $i; $i++; ?></td>
			<td class="left" style="font-family:Arial, Helvetica, sans-serif; white-space:nowrap ">
			  <?php 
			  	 echo $ban_month = english_to_bangla_date_convert($month);
			  ?>  
			</td>

			<?php $salary_data = $this->Leave_model->get_salary_info_for_ml_leave($row->emp_id,$month); ?>
			<?php foreach($salary_data->result() as $rowItem){ ?>
			<?php $other_leave = $rowItem->e_l +  $rowItem->s_l + $rowItem->c_l + $rowItem->m_l;?>
        	<td style="text-align:center;"> <?php echo $rowItem->total_days;?></td>
        	<td style="text-align:center;"> <?php echo $rowItem->weekend;?></td>
        	<td style="text-align:center;"> <?php echo $other_leave;?></td>
        	<td style="text-align:center;"> <?php echo $rowItem->absent_days;?></td>
            <td style="text-align:center;"> <?php echo $rowItem->att_days;?></td>
            <td style="text-align:center;"> <?php echo $rowItem->abs_deduction;?></td>
            <td style="text-align:center;"> <?php echo $rowItem->net_pay;?></td>
            <td style="text-align:center;"> <?php echo '0';?></td>
            <td style="text-align:center;"> <?php echo $rowItem->ot_amount;?></td>
            <td style="text-align:center;"> <?php echo $rowItem->att_bonus;?></td>
            <td style="text-align:right;">  <?php echo $rowItem->festival_bonus;?></td>
            <td style="text-align:right;">  <?php echo $stamp = 0;?></td>
            <td style="text-align:right;">
            	<?php 
            		$total_earning = $rowItem->net_pay + $rowItem->festival_bonus + $rowItem->ot_amount;
            		echo $rowItem->net_pay.'+'.$rowItem->festival_bonus.'+'.$rowItem->ot_amount.'='.$total_earning;
            	?>
            		
            </td>
            <?php 
				//$ttl_days = $ttl_days + $rowItem->total_days;
				$ttl_wk_days = $ttl_wk_days + $rowItem->att_days;//$row->num_of_workday;
				$ttl_absdeduct = $ttl_absdeduct + $rowItem->abs_deduction;
				$ttl_net_pay = $ttl_net_pay + $rowItem->net_pay;
				$ttl_extra_allow = $ttl_extra_allow + 0;
				$ttl_ot = $ttl_ot + $rowItem->ot_amount;
				$ttl_att_bonus = $ttl_att_bonus + $rowItem->att_bonus;
				$ttl_festival = $ttl_festival + $rowItem->festival_bonus;
				$ttl_stamp = $ttl_stamp + $stamp;
				$ttl_earning = $ttl_earning + $total_earning;
			
			} ?>
		</tr>

		<?php } ?>
         <tr style="font-weight:bold;font-family: SutonnyMJ;">
        	<td colspan="6" style="text-align:center;font-family:Arial, Helvetica, sans-serif;font-size:12px !important"> সর্বমোট</td>
            <td style="text-align:center;"> <?php echo $ttl_wk_days; ?></td>
            <td style="text-align:center;">  <?php echo $ttl_absdeduct; ?></td>
            <td style="text-align:center;">  <?php echo $ttl_net_pay; ?> </td>
            <td style="text-align:center;">  <?php echo $ttl_extra_allow; ?> </td>
            <td style="text-align:center;">  <?php echo $ttl_ot; ?> </td>
            <td style="text-align:center;">  <?php echo $ttl_att_bonus; ?> </td>
            <td style="text-align:center;">  <?php echo $ttl_festival; ?> </td>
            <td style="text-align:center;">  <?php echo $ttl_stamp; ?> </td>
            <td style="text-align:right;">  <?php echo $ttl_earning; ?> </td>
        </tr>

	  </table>
	  <br />
	  <table class="divided_two" style="width: 100%;font-size: 14px;">
	  	<tr>
	  		<td>ছুটির অব্যবহিত পূর্ববর্তী তিন মাসের অর্জিত মোট মজুরী = <?php echo '<span style="font-family: SutonnyMJ;font-size: 20px;">'.$ttl_earning.'</span>'; ?> টাকা।</td>
	  	</tr>
	  	<tr>
	  		<td>ছুটির অব্যবহিত পূর্ববর্তী তিন মাসের মোট প্রকৃত কর্মদিবস = <?php echo '<span style="font-family: SutonnyMJ;font-size: 20px;">'.$ttl_wk_days.'</span>'; ?> টাকা।</td>
	  	</tr>
	  	<tr>
	  		<td>প্রতিদিনের গড় মজুরী 
	  		<?php
	  			$per_day = round($ttl_earning/$ttl_wk_days,2); 
	  			echo '('.'<span style="font-family: SutonnyMJ;font-size: 18px;">'.$ttl_earning.'/'.$ttl_wk_days.')'.'='.$per_day.' </span>টাকা।';
	  		?>
	  	</tr>
	  	<tr>
	  		<td>প্রসব পূর্ববর্তী ৮ সপ্তাহ বা ৫৬ দিনের জন্য প্রদেয় প্রসূতি কল্যাণ সুবিধা = 
	  		<?php 
	  		 $first_amt = round($per_day*56);
	  		  echo '<span style="font-family: SutonnyMJ;font-size: 18px;">'.$per_day.'*'.'56'.'='.$first_amt.'</span> টাকা।'; 
	  		?></td>
	  	</tr>
	  	<tr>
	  		<td>প্রসব পরবর্তী ৮ সপ্তাহ বা ৫৬ দিনের জন্য প্রদেয় প্রসূতি কল্যাণ সুবিধা = 
	  		<?php 
	  			$second_amt = round($per_day*56);
	  		    echo '<span style="font-family: SutonnyMJ;font-size: 18px;">'.$per_day.'*'.'56'.'='.$second_amt.'</span> টাকা।'; 
	  		?>
	  		</td>
	  	</tr>
	  	<tr>
	  		<td>
	  			প্রসব পূর্ববর্তী ও পরবর্তী সর্বমোট (৮+৮) = ১৬ সপ্তাহ বা (৫৬+৫৬) = ১১২ দিনের জন্য মোট প্রদেয় সুবিধা = <?php $taka =  $first_amt + $second_amt; echo '<span style="font-family: SutonnyMJ;font-size: 20px;">'.$taka.'</span>'?>টাকা।
	  		</td>
	  	</tr>
	  </table>

	   <br style="clear:both;height:10px;width: 100%;"/>
	   <table class="Installment_cal" style="width: 100%;">
	   	 <tr style="font-weight:bold;font-family: SutonnyMJ;">
	   	 	<th>সুবিধা প্রদানের ধাপ</th>
	   	 	<th>প্রদানের তারিখ</th>
	   	 	<th>টাকার পরিমাণ</th>
	   	 	<th>কর্তন স্ট্যাম্প বাবদ টাকা</th>
	   	 	<th>মোট প্রদেয়</th>
	   	 	<th>গ্রহীতার স্বাক্ষর</th>
	   	 </tr>
	   	 <tr style="font-family: SutonnyMJ; height:60px;">
	   	 	<td>১ম ধাপ (প্রসব পূর্ববর্তী)</td>
	   	 	<td><?php echo $start_leave_date =  date('d/m/Y',strtotime('-1 days',strtotime($row->start_date))); ?></td>
	   	 	<td><?php echo $first_amt;?> টাকা</td>
	   	 	<td>10</td>
	   	 	<td><?php echo $first_amt - 10;?></td>
	   	 	<td></td>
	   	 </tr>
	   	 <tr style="font-family: SutonnyMJ;  height:60px;">
	   	 	<td>২য় ধাপ (প্রসব পরবর্তী)</td>
	   	 	<td><?php echo $start_leave_date =  date('d/m/Y',strtotime('+1 days',strtotime($row->leave_end))); ?></td>
	   	 	<td><?php echo $first_amt;?> টাকা</td>
	   	 	<td>10</td>
	   	 	<td><?php echo $tfirst = $first_amt - 10;?></td>
	   	 	<td></td>
	   	 </tr>
	   </table>
	   <br style="clear:both;height:35px;width: 100%;"/>
	   <table>
	   	<tr><td style="font-size: 18px;text-transform: capitalize;">কথায়ঃ <?php echo $in_word =  numberTowords($tfirst);?></td></tr>
	   </table>
	</div>
	<table width=100% style="text-align: center;">
		 <tr height=150px>
		 <td>
		 	<span style="border-top:1px solid #000;">(সিনি:এক্সিকিউটিভ)</span>
		 </td>
		 <td>
		 	<span style="border-top:1px solid #000;">(ফ্যাক্টরী ম্যানেজার)</span>
		 </td>
		 <td>
		 	<span style="border-top:1px solid #000;">(পরিচালক)</span>
		 </td>
		 </tr>
	</table>

</div>
<?php } ?>
</body>
</html>
