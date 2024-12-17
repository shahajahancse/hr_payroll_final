<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>
<?php
	if($grid_status == 1)
	{ echo 'Reguler Employee '; }
	elseif($grid_status == 2)
	{ echo 'New Employee '; }
	elseif($grid_status == 3)
	{ echo 'Left Employee '; }
	elseif($grid_status == 4)
	{ echo 'Resign Employee '; }
	elseif($grid_status == 6)
	{ echo 'Promoted Employee '; }
?>Monthly Salary Sheet of 
<?php 
$date = $salary_month;
$year=trim(substr($date,0,4));
$month=trim(substr($date,5,2));
$day=trim(substr($date,8,2));
$date_format = date("F-Y", mktime(0, 0, 0, $month, $day, $year));
echo $date_format;
?>
</title>
</head>

<body>
<?php
	$filename = "araf.xls";
	header('Content-Type: application/vnd.ms-excel'); //mime type
	header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
	header('Cache-Control: max-age=0'); //no cache
?>
<?php 
$row_count=count($value);
if($row_count >6)
{
$page=ceil($row_count/6);
}
else
{
$page=1;
}

$k = 0;

			
			$basic = 0;
			$house_rent = 0;
			$medical_all = 0;
			$gross_sal = 0;
			$abs_deduct = 0;
			$payable_basic = 0;
			$payable_house_rent =0;
			$payable_madical_allo =0;
			$pay_wages = 0;
			$grand_total_pay_wages =0;
			$grand_total_att_bonus =0;
			$grand_total_net_wages_after_deduction = 0;
			$grand_total_net_wages_with_ot = 0;
			$trans_allaw = 0;
			$lunch_allaw =0;
			$others_allaw = 0;
			$total_allaw =0;
			$ot_hour =0;
			$ot_rate =0;
			$ot_amount =0;
			$gross_pay =0;
			$adv_deduct =0;
			$provident_fund =0;
			$others_deduct =0;
			$total_deduct =0;
			$pbt =0;
			$tax =0;
			$net_pay =0;
			
			$stam_value = 0;
			$total_stam_value = 0;
			$grand_total_advance_salary = 0;
			$grand_total_lunch_deduction_hour = 0;
			$grand_total_lunch_deduction_amount = 0;
			$grand_total_absent_deduction = 0;
			$grand_total_tax_deduction = 0;
			$grand_total_satmp_deduction =0;
			$grand_total_net_wages_without_ot = 0;
			$grand_total_ot_hour = 0;
			$grand_total_ot_amount = 0;
			$grand_total_stamp_deduction = 0;
			$grand_total_others_deduct_deduction = 0;
			$grand_total_adv_deduct = 0;
			$grand_gross_sal =0;
			
			
			?>
			<table >
			
			<?php
for ( $counter = 1; $counter <= $page; $counter ++)
{
?>

<table align="center" height="auto"  class="bordered_salary" border="1" cellspacing="0" cellpadding="0" style="font-size:12px; width:auto; border-collapse:collapse;">

<tr height="85px">

<?php if($deduct_status == "Yes"){?> 
<td colspan="38" align="center">
<?php }else{ ?>
<td colspan="36" align="center">
<?php } ?>

<div style="text-align:left; position:relative; top:20px; padding-left:10px;">
<?php 
$date = date('d-m-Y');
//echo "Payment Date : $date"; ?>
</div>
 
<?php $this->load->view("head_english"); ?>
<?php 
	if($grid_status == 1)
	{ echo 'Reguler Employee'; }
	elseif($grid_status == 2)
	{ echo 'New Employee '; }
	elseif($grid_status == 3)
	{ echo 'Left Employee '; }
	elseif($grid_status == 4)
	{ echo 'Resign Employee '; }
	elseif($grid_status == 6)
	{ echo 'Promoted Employee '; }
?>Monthly Salary Sheet of 
<?php 
$date = $salary_month;
$year=trim(substr($date,0,4));
$month=trim(substr($date,5,2));
$day=trim(substr($date,8,2));
$date_format = date("F-Y", mktime(0, 0, 0, $month, $day, $year));
echo $date_format;

?>

</td>
</tr>


  <tr height="20px">
    <td rowspan="2"  width="15" height="20px"><div align="center"><strong>SL N0</strong></div></td>
    <td rowspan="2" width="14" height="20px"><div align="center"><strong>Card No</strong></div></td>
    <td rowspan="2" width="30" height="20px"><div align="center"><strong>Name</strong></div></td>
	<td rowspan="2" width="30" height="20px"><div align="center"><strong>Section</strong></div></td>
    <td rowspan="2" width="25" height="20px"><div align="center"><strong>Desig.</strong></div></td>
    <td rowspan="2" width="25" height="20px"><div align="center"><strong>Date of Join</strong></div></td>
    <td rowspan="2" width="25" height="20px"><div align="center"><strong>Gr.</strong></div></td>
	 <td rowspan="2" width="25" height="20px"><div align="center"><strong>Line No</strong></div></td>
    <td rowspan="2" width="31" height="20px"><div align="center"><strong>Total Days</strong></div></td>
	<td rowspan="2" width="31" ><div align="center"><strong>Total Att.</strong></div></td>
    <td rowspan="2" width="31" ><div align="center"><strong>Total Abs.</strong></div></td>
    
    <td colspan="4" height="20px"><div align="center"><strong>Leave Status</strong></div></td>
    <td colspan="5" height="20px"><div align="center"><strong>Salary</strong></div></td>
    
    <td rowspan="2" width="35" height="20px"><div align="center"><strong>Gross</strong></div></td>
    	
 
    <td rowspan="2"  width="15" height="20px" style="font-size:10px;"><div align="center"><strong>Atn.B.</strong></div></td>
    <?php if($deduct_status == "Yes"){?> 
     <td colspan="7" height="20px"><div align="center"><strong>Deduction</strong></div></td>
	 <?php }else{ ?>
	  <td colspan="5" height="20px"><div align="center"><strong>Deduction</strong></div></td>
	  <?php } ?> 
    <td rowspan="2" width="25" height="20px"><div align="center"><strong>Pay Wages</strong></div></td>
    <td colspan="3" height="20px"><div align="center"><strong>Overtime</strong></div></td>
    <td rowspan="2" width="22" height="20px"><div align="center"><strong>Net Wages</strong></div></td>
	<td rowspan="2"  width="180"><div align="center"><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Signature&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong></div></td>
  </tr>
  <tr height="15px">
  <td width="15" style="font-size:10px;"><div align="center"><strong>CL</strong></div></td>
	<td width="15" style="font-size:10px;"><div align="center"><strong>SL</strong></div></td>
    <td  style="font-size:10px;"><div align="center"><strong>H.D</strong></div></td>
    <td  style="font-size:10px;"><div align="center"><strong>ML</strong></div></td>
    <td width="20" height="20px"> <div align="center"><strong>Basic Sal.</strong></div></td>
    <td  width="17" height="20px"><div align="center"><strong>House Rent (50%)</strong></div></td>
    <td  width="15" height="20px"><div align="center"><strong>Med.</strong></div></td>
    <td width="20" height="20px"> <div align="center"><strong>T.A</strong></div></td>
     <td width="20" height="20px"> <div align="center"><strong>F.A</strong></div></td>
	<?php if($deduct_status == "Yes"){?>
	<td width="37" style="font-size:10px;"><div align="center"><strong>Hour</strong></div></td>
	<td width="22" style="font-size:10px;"><div align="center"><strong>Rate</strong></div></td>
	<?php } ?>
    <td width="37" style="font-size:10px;"><div align="center"><strong>Adv. Deduct</strong></div></td>
    <td width="37" style="font-size:10px;"><div align="center"><strong>Abs. Deduct</strong></div></td>
    <td width="37" style="font-size:10px;"><div align="center"><strong>Tax</strong></div></td>
    <td width="37" style="font-size:10px;"><div align="center"><strong>Oth. Ded</strong></div></td>
    <td width="37" style="font-size:10px;"><div align="center"><strong>Stamp</strong></div></td>
    <td width="37" style="font-size:10px;"><div align="center"><strong>Hour</strong></div></td>
    <td width="37" style="font-size:10px;"><div align="center"><strong>Rate</strong></div></td>
    <td width="37" style="font-size:10px;"><div align="center"><strong>Taka</strong></div></td>
    
   </tr>
<?php
			
	if($counter == $page)
  	{
   		$modulus = ($row_count-1) % 6;
    	$per_page_row=$modulus;
	}
   	else
   	{
    	$per_page_row=5;
   	}
  	
   	$total_pay_wages	= 0;
	$total_ot_hours   	= 0;
	$total_ot_amount  	= 0;
	$total_att_bonus	= 0;
	$total_gross_pays	= 0;
	$total_net_pays		= 0;
	$total_net_wages_after_deduction = 0;
	$total_net_wages_with_ot = 0;
	$total_att_bonus  = 0;
	$total_gross_sal_per_page = 0;
	$total_advance_per_page = 0;
	$lunch_deduction_hour_per_page = 0;
	$lunch_deduction_amount_per_page = 0;
	$total_absent_deduction_per_page = 0;
	$total_stamp_deduction_per_page = 0;
	$total_tax_deduction_per_page = 0;
	$total_net_wages_without_ot_per_page = 0;
	$total_ot_hour_per_page = 0;
	$total_ot_amount_per_page = 0;
	$total_others_deduct_per_page =0;
	$total_adv_deduct_per_page = 0;
	
	for($p=0; $p<=$per_page_row;$p++)
	{
		echo "<tr height='80' style='text-align:center;font-size:14px;' >";
		echo "<td >";
		echo $k+1;
		echo "</td>";
		
		echo "<td> ";
		print_r($value[$k]->emp_id);
		//echo $row->emp_id;
		echo "</td>";
		
		echo "<td style='font-family:arial;'>";
		print_r($value[$k]->emp_full_name);
		echo '<br>';
		if($grid_status == 4)
		{
			$resign_date = $this->Grid_model->get_resign_date_by_empid($value[$k]->emp_id);
			if($resign_date != false){
			echo $resign_date = date('d-M-y', strtotime($resign_date));}
		}
		elseif($grid_status == 3)
		{
			$left_date = $this->Grid_model->get_left_date_by_empid($value[$k]->emp_id);
			if($left_date != false){
			echo $left_date = date('d-M-y', strtotime($left_date));}
		}
		echo "</td>"; 
				
	echo "<td >";
		print_r($value[$k]->sec_name);
		//echo $row->desig_name;
		echo "</td>";
				
		echo "<td >";
		print_r($value[$k]->desig_name);
		//echo $row->desig_name;
		echo "</td>";
		
		echo "<td >";
		$date = $value[$k]->emp_join_date;
		//print_r($value[$k]->emp_join_date);
		$year=trim(substr($date,0,4));
		$month=trim(substr($date,5,2));
		$day=trim(substr($date,8,2));
		$date_format = date("d-M-y", mktime(0, 0, 0, $month, $day, $year));
		echo $date_format;
		echo "</td>";
		
		echo "<td >";
		print_r ($value[$k]->gr_name);
		echo "</td>";
		
		echo "<td >";
		print_r($value[$k]->line_name);
		//echo $row->desig_name;
		echo "</td>";
				
		echo "<td>";
		$num_of_days = $value[$k]->total_days;
		print_r ($value[$k]->total_days);
		//echo $row->total_days;
		echo "</td>";	
		
		echo "<td>";
		print_r ($value[$k]->att_days + $value[$k]->weeked);
		//echo $row->total_days;
		echo "</td>";	
		
		echo "<td>";
		echo $value[$k]->absent_days;
		echo "</br>";
		echo $value[$k]->before_after_absent;
		echo "</br>";
		echo "=";
		echo "</br>";
		$absent = $value[$k]->absent_days + $value[$k]->before_after_absent;
		
		//print_r ($value[$k]->absent_days);
		echo $absent;
		echo "</td>";
		
		echo "<td>";
		print_r ($value[$k]->c_l);
		//echo "cl".$row->c_l;
		echo "</td>";
			
		echo "<td>";
		print_r ($value[$k]->s_l);
		//echo "sl".$row->s_l;
		echo "</td>";
		
		echo "<td>";
		print_r ($value[$k]->holidy);
		//echo "ho_day" . $row->holiday_or_weeked;
		echo "</td>";
		
		echo "<td>";
		print_r ($value[$k]->m_l);
		//echo "el".$row->e_l;
		echo "</td>";
		
		
			
		echo "<td>";
		$basic_sal = $value[$k]->basic_sal;
		print_r ($value[$k]->basic_sal);
		$basic = $basic + $value[$k]->basic_sal;
		echo "</td>";
			
		echo "<td>";
		print_r ($value[$k]->house_r);
		//echo $row->house_r;
		$house_rent = $house_rent + $value[$k]->house_r;
		echo "</td>";
			
		echo "<td>";
		print_r ($value[$k]->medical_a);
		//echo $row->medical_a;
		$medical_all = $medical_all + $value[$k]->medical_a;
		echo "</td>";
		
		echo "<td>";
		print_r ($value[$k]->trans_allaw);
		//echo $row->medical_a;
		$trans_allaw = $trans_allaw + $value[$k]->trans_allaw;
		echo "</td>";
		
		echo "<td>";
		print_r ($value[$k]->food_allow);
		echo "</td>";
				 
		echo "<td style='font-weight:bold;'>";
		$gross_sal =  $value[$k]->gross_sal;
		print_r ($value[$k]->gross_sal);
		//echo "<strong>$row->gross_sal</strong>";
		//$gross_sal = $gross_sal + $value[$k]->gross_sal;
		$total_gross_sal_per_page = $total_gross_sal_per_page + $value[$k]->gross_sal;
		$grand_gross_sal =$grand_gross_sal + $value[$k]->gross_sal;
		echo "</td>";
				
		 
		
		$total_leave = $value[$k]->c_l + $value[$k]->s_l + $value[$k]->e_l + $value[$k]->m_l;
			

		
		
		echo "<td style='font-weight:bold;'>";
		print_r ($value[$k]->att_bonus);
		echo "</td>";
	
		
		$gross_salary = $value[$k]->net_pay;
				
		/*if($deduct_status == "Yes")
		{
			echo "<td>";
			print_r ($value[$k]->deduct_hour);
			$lunch_deduction_hour_per_page 		= $lunch_deduction_hour_per_page + $value[$k]->deduct_hour;
			$grand_total_lunch_deduction_hour 	= $grand_total_lunch_deduction_hour + $value[$k]->deduct_hour;
			echo "</td>";
			
			echo "<td>";
			$deduct_amount = $value[$k]->deduct_amount;
			$deduct_amount = round($deduct_amount,2);
			echo $deduct_amount;
			$lunch_deduction_amount_per_page 	= $lunch_deduction_amount_per_page + $deduct_amount;
			$grand_total_lunch_deduction_amount = $grand_total_lunch_deduction_amount + $deduct_amount;
			echo "</td>";
			$gross_salary = $gross_salary -$deduct_amount;
		}*/
		
	
		
		
		echo "<td>";
		$adv_deduct 	= $value[$k]->adv_deduct;
		echo $adv_deduct ;
		$total_adv_deduct_per_page= $total_adv_deduct_per_page + $adv_deduct;
		$grand_total_adv_deduct 	= $grand_total_adv_deduct + $adv_deduct;
		echo "</td>";
		
		echo "<td>";
		$abs_deduction = $value[$k]->abs_deduction;
		print_r ($value[$k]->abs_deduction);
		$total_absent_deduction_per_page= $total_absent_deduction_per_page + $value[$k]->abs_deduction;
		$grand_total_absent_deduction 	= $grand_total_absent_deduction + $value[$k]->abs_deduction;
		echo "</td>";
			
		$pay_wages 		= $value[$k]->pay_wages; 
		$adv_deduct 	= $value[$k]->adv_deduct;
		$att_bonus 		= $value[$k]->att_bonus;
		$deduct_amount 	= $value[$k]->deduct_amount;
		
		$total_att_bonus = $total_att_bonus + $att_bonus;
		$grand_total_att_bonus = $grand_total_att_bonus + $att_bonus;
		
		$total_pay_wages = $total_pay_wages + $pay_wages;
		$grand_total_pay_wages = $grand_total_pay_wages + $pay_wages;
		
		
		
		echo "<td>";
		$tax = $value[$k]->tax;
		print_r ($value[$k]->tax);
		
		
		$total_tax_deduction_per_page = $total_tax_deduction_per_page + $tax;
		$grand_total_tax_deduction 	= $grand_total_tax_deduction + $tax;
		
		$others_deduct = $others_deduct + $value[$k]->others_deduct; 
		echo "</td>";
		
		echo "<td>";
		$others_deduct = $value[$k]->others_deduct;
		echo $others_deduct;
		
		$total_others_deduct_per_page = $total_others_deduct_per_page + $others_deduct;
		$grand_total_others_deduct_deduction 	= $grand_total_others_deduct_deduction + $others_deduct;
		//$others_deduct = $others_deduct + $value[$k]->others_deduct; 
		echo "</td>";
		
		echo "<td style='font-weight:bold;'>";
		$stam_value = $value[$k]->stamp;
		$atten = ($value[$k]->att_days + $value[$k]->weeked);
		if($atten ==0){$stam_value=0;}
		echo $stam_value;
		$total_stamp_deduction_per_page = $total_stamp_deduction_per_page + $stam_value;
		$grand_total_stamp_deduction 	= $grand_total_stamp_deduction + $stam_value;
		
		echo "</td>";
		
		$net_wages_after_deduction = $gross_sal - $abs_deduction  + $att_bonus - $tax - $stam_value - $others_deduct - $adv_deduct;
		$total_net_wages_without_ot_per_page= $total_net_wages_without_ot_per_page +  $net_wages_after_deduction;
		$grand_total_net_wages_without_ot 	= $grand_total_net_wages_without_ot +  $net_wages_after_deduction;
			
		echo "<td style='font-weight:bold;'>";
		echo $net_wages_after_deduction;
		echo "</td>";
		
		$total_net_wages_after_deduction = $total_net_wages_after_deduction + $net_wages_after_deduction;
		$grand_total_net_wages_after_deduction = $grand_total_net_wages_after_deduction + $net_wages_after_deduction;
				
		echo "<td>";
		$ot_hour =$value[$k]->ot_hour;
		$eot_hour =$value[$k]->eot_hour;
		$total_ot_eot = $ot_hour + $eot_hour;
		echo $ot_hour."<br>".$eot_hour."<br>"."= <br>".$total_ot_eot;
		//echo '<br>+';
		//echo '<br>';
		//echo $value[$k]->eot_hour;
		//echo '<br>=';
		//echo '<br>';
		$ot_hour = $value[$k]->ot_hour;// +  $value[$k]->eot_hour; 
		echo "</td>";
		
		$total_ot_hour_per_page = $total_ot_hour_per_page + $total_ot_eot; 
		$grand_total_ot_hour = $grand_total_ot_hour + $total_ot_eot; 
		
		echo "<td>";
		print_r ($value[$k]->ot_rate);
		//echo "o_r".$row->ot_rate;
		$ot_rate = $ot_rate + $value[$k]->ot_rate; 
		echo "</td>";
		
		//$ot_amount = round($total_ot_eot * $value[$k]->ot_rate);
		$ot_amount =  $value[$k]->ot_amount + $value[$k]->eot_amount;
				
		echo "<td>";
		echo $ot_amount;
		echo "</td>";
		
		$total_ot_amount_per_page = $total_ot_amount_per_page + $ot_amount;
		$grand_total_ot_amount = $grand_total_ot_amount + $ot_amount;
		
		$ot_amount_only = $ot_amount;
		$net_wages_with_ot = $value[$k]->net_pay;//$net_wages_after_deduction + $ot_amount_only;
				
					
		echo "<td style='font-weight:bold;'>";
		echo $ot_amount_only +$net_wages_after_deduction;
		//echo $net_wages_with_ot;
		echo "</td>";
		
		$total_net_wages_with_ot = $total_net_wages_with_ot + $net_wages_with_ot;
		$grand_total_net_wages_with_ot = $grand_total_net_wages_with_ot + $net_wages_with_ot;
		
		
			
		echo "<td>";
		echo "&nbsp;";
		echo "</td>";
			
		echo "</tr>"; 
		$k++;
	}
	?>
	<tr style='font-size:14px;'>
		<td align="center" colspan="20" ><strong>Total Per Page</strong></td>
        <td align="right" ><strong><?php echo $english_format_number = number_format($total_gross_sal_per_page);?></strong></td>
		<td align="right"><strong><?php echo $english_format_number = number_format($total_att_bonus);?></strong></td>
		<?php if($deduct_status == "Yes"){?>
		<td align="center"><strong><?php echo $english_format_number = number_format($lunch_deduction_hour_per_page);?></strong></td>
        <td align="right"><strong><?php echo $english_format_number = number_format($lunch_deduction_amount_per_page);?></strong></td>
        <?php }?>
        <td align="right"><strong><?php echo $english_format_number = number_format($total_adv_deduct_per_page);?></strong></td>
        <td align="right"><strong><?php echo $english_format_number = number_format($total_absent_deduction_per_page);?></strong></td>
        <td align="right"><strong><?php echo $english_format_number = number_format($total_tax_deduction_per_page);?></strong></td>
        <td align="right"><strong><?php echo $english_format_number = number_format($total_others_deduct_per_page);?></strong></td>
        <td align="right"><strong><?php echo $english_format_number = number_format($total_stamp_deduction_per_page);?></strong></td>
		 <td align="right"><strong><?php echo $english_format_number = number_format($total_net_wages_after_deduction);?></strong></td>
        <td align="center"><strong><?php echo $english_format_number = number_format($total_ot_hour_per_page);?></strong></td>
        <td align="right" colspan="1"></td>
        <td align="right"><strong><?php echo $english_format_number = number_format($total_ot_amount_per_page);?></strong></td>
        <td align="right"><strong><?php echo $english_format_number = number_format($total_net_wages_with_ot);?></strong></td>
		
	</tr>
	<?php
	if($counter == $page)
   		{?>
			<tr height="10" style='font-size:14px;'>
			<td colspan="20" align="center" ><strong>Grand Total</strong></td>
            <td align="right"><strong><?php echo $english_format_number = number_format($grand_gross_sal);?></strong></td>
            <td align="right" ><strong><?php echo $english_format_number = number_format($grand_total_att_bonus);?></strong></td>
            <?php if($deduct_status == "Yes"){?>
			<td align="center" ><strong><?php echo $english_format_number = number_format($grand_total_lunch_deduction_hour);?></strong></td>
            <td align="right" ><strong><?php echo $english_format_number = number_format($grand_total_lunch_deduction_amount);?></strong></td>
			 <?php }?>
             <td align="right"><strong><?php echo $english_format_number = number_format($grand_total_adv_deduct);?></strong></td>
            <td align="right"><strong><?php echo $english_format_number = number_format($grand_total_absent_deduction);?></strong></td>
            <td align="right"><strong><?php echo $english_format_number = number_format($grand_total_tax_deduction);?></strong></td>
            <td align="right"><strong><?php echo $english_format_number = number_format($grand_total_others_deduct_deduction);?></strong></td>
            <td align="right"><strong><?php echo $english_format_number = number_format($grand_total_stamp_deduction);?></strong></td>
            <td align="right"><strong><?php echo $english_format_number = number_format($grand_total_net_wages_after_deduction);?></strong></td>
            <td align="center"><strong><?php echo $english_format_number = number_format($grand_total_ot_hour);?></strong></td>
            <td colspan="1"></td>
            <td align="right"><strong><?php echo $english_format_number = number_format($grand_total_ot_amount);?></strong></td>
            <td align="right"><strong><?php echo $english_format_number = number_format($grand_total_net_wages_with_ot);?></strong></td>
			
			</tr>
			<?php } ?>
			
			<table width="100%" height="60px" border="0" align="center" style="margin-bottom:100px; font-family:Arial, Helvetica, sans-serif;">
			<tr height="80%" >
			<td colspan="28"></td>
			</tr>
			<tr height="20%">
			<td  align="center">HR & Admin</td>
			<td  align="right">Accounts</td>
			<td  align="right">Verified By(Director)</td>
			<td  align="right">Approved By(MD)</td>
			</tr>
			
			</table>
			</table>
			  
			<?php

		}

?>

</table>

</body>
</html>