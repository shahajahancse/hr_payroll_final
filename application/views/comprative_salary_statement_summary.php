<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Comparative Salary Summary Report</title>
<link rel="stylesheet" type="text/css" href="../../../../../../css/print.css" media="print" />

<style type="text/css">
.sal tr td{
border:1px #000000 solid;
border-top-style:none;
border-left-style:none;
padding-right:2px;

}
.sal{
border:1px #000000 solid;
   border-bottom-style: none;
   border-right-style: none;
   }
   
.det tr td{
border:1px #000000 solid;
border-top-style:none;
border-left-style:none;

}
.det{
border:1px #000000 solid;
   border-bottom-style: none;
   border-right-style: none;
   }
.bottom_txt_design
{
	 border-top:1px solid;
	 width:150px;
	 font-weight:bold;
}
.bottom_txt_manager_design
{
	border-top:1px solid;
	 width:170px;
}
</style>
</head>

<body style="width:90%;">

<?php 
//$unit_name['unit_name'] = $this->db->where("unit_id",$grid_unit)->get('pr_units')->row()->unit_name;

//$data['unit_id'] = $grid_unit;
$this->load->view("head_english");
?>

	<div  style="font-size:13px; font-weight:bold; text-align:center; width:100%;">
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
	?>
	Comparative  Salary Statement of  
	<?php 
	
	echo $first_month." And ".$second_month;
	
	?></div>
	<br />
	
	<div style="width:100%;">
	<div style="width: 49%; float: left; margin-bottom: 20px;">
	<table class="sal" border="1" cellspacing="0" cellpadding="0" style="font-size:13px; margin:0 auto;">
	  
   <tr>
  	 <td colspan="8" style="font-weight:bold; text-align: center; background: #B7CBB6;" >
  	Salary Statement of  <?php echo " ".$first_month; ?> 
  </td>
  </tr>
  <tr height="20" align="center" style="font-weight:bold; background-color:#CCC;">
 
   <td height="30"  width="220">Line</td>
    <td   width="100">Total MP</td>
    <td   width="150">Salary Wages</td>
    <td   width="120">Attn Bonus</td>
    <td   width="100">OT Hour</td>
    <td   width="120">OT Amount</td>
    
    <td   width="120">Eot Hour</td>
    <td   width="130">Eot Amount</td>
  </tr>

  	
		<?php
		$gt_mp 			= 0;
		$gt_cash_mp 	= 0;
		$gt_bank_mp 	= 0;
		$gt_gross 		= 0;
		$gt_basic 		= 0;
		$gt_house_r		= 0;
		$gt_medical 	= 0;
		$gt_food 		= 0;
		$gt_transport 	= 0;
		$gt_salary_amt 	= 0;
		$gt_ot_hour 	= 0;
		$gt_ot_amount 	= 0;
		$gt_attn_bonus 	= 0;
		$gt_cash_salary = 0;
		$gt_bank_salary = 0;
		$gt_net_salary	= 0;
		$gt_eot_hour 	= 0;
		$gt_eot_amount	= 0;
		//$count = count($values['first_month']["sec_name"]);
		
		
		if(isset($values['first_month']['sec_name']))
		{
			$count = count($values['first_month']['sec_name']);

		}
		else
		{
			$count = 0;
		}
		
		for($i=0; $i < $count; $i++)
		{
			echo "<tr height='20'>";
			
			echo "<td  style='text-align:left; padding-left:5px;'>";
			echo $values['first_month']["sec_name"][$i];
			echo "</td>";
			
			$total_emp = $values['first_month']["emp_cash"][$i] + $values['first_month']["emp_bank"][$i];
			echo "<td align='center'>";
			echo $total_emp;
			echo "</td>";
			$gt_mp = $gt_mp + $total_emp;
			 
	
		$total_net_pay = $values['first_month']["cash_sum_net_pay"][$i]+ $values['first_month']["bank_sum_net_pay"][$i] ;							 	
		$total_ot_amount = $values['first_month']["cash_sum_ot_amount"][$i] + $values['first_month']["bank_sum_ot_amount"][$i];
		$total_attn_bonus = $values['first_month']["cash_att_bonus"][$i] + $values['first_month']["bank_att_bonus"][$i];
			
		$total_salary_amount = $total_net_pay - ($total_ot_amount + $total_attn_bonus); 
			
			echo "<td align='right' style='padding-right:5px;'>";
			echo number_format($total_salary_amount);
			echo "</td>";
			$gt_salary_amt = $gt_salary_amt + $total_salary_amount;
			
			//TOTAL ATTENDANCE BONUS
			echo "<td align='right' style='padding-right:5px;'>";
			echo number_format($total_attn_bonus);
			echo "</td>";
			$gt_attn_bonus = $gt_attn_bonus + $total_attn_bonus;
			
			//TOTAL OT HOUR
			$total_ot_hour = $values['first_month']["cash_sum_ot_hour"][$i]+ $values['first_month']["bank_sum_ot_hour"][$i];
			echo "<td align='right' style='padding-right:5px;'>";
			echo number_format($total_ot_hour);
			echo "</td>";
			$gt_ot_hour = $gt_ot_hour + $total_ot_hour;
			
			//TOTAL OT AMOUNT 
			echo "<td align='right' style='padding-right:5px;'>";
			echo number_format($total_ot_amount);
			echo "</td>";
			$gt_ot_amount = $gt_ot_amount + $total_ot_amount;
			
			//TOTAL EOT HOUR
			$total_eot_hour = $values['first_month']["total_cash_bank_eot_hour"][$i];
			echo "<td align='right' style='padding-right:5px;'>";
			echo number_format($total_eot_hour);
			echo "</td>";
			$gt_eot_hour = $gt_eot_hour + $total_eot_hour;
			
			
			$total_eot_amount = $values['first_month']["total_cash_bank_eot_amount"][$i];
			echo "<td align='right' style='padding-right:5px;'>";
			echo number_format($total_eot_hour);
			echo "</td>";
			$gt_eot_amount = $gt_eot_amount + $total_eot_amount;			
			

			echo "</tr>";
		}
		echo "<tr style='font-weight:bold; background-color:#CCC;'>";
		
		echo "<td align='center'>";
		echo "A";
		echo "</td>";
		
		echo "<td align='center'>";
		echo $gt_mp;
		echo "</td>";
		
		

		echo "<td align='right' style='padding-right:5px;'>";
		echo number_format($gt_salary_amt);
		echo "</td>";
		echo "<td align='right' style='padding-right:5px;'>";
		echo number_format($gt_attn_bonus);
		echo "</td>";


		echo "<td align='right' style='padding-right:5px;'>";
		echo number_format($gt_ot_hour);
		echo "</td>";

		echo "<td align='right' style='padding-right:5px;'>";
		echo number_format($gt_ot_amount);
		echo "</td>";
		
		echo "<td align='right' style='padding-right:5px;'>";
		echo number_format($gt_eot_hour);
		echo "</td>";

		echo "<td align='right' style='padding-right:5px;'>";
		echo number_format($gt_eot_amount);
		echo "</td>";

				
		echo "</tr>";
	?>
	</table>
	</div>
	<div style="width: 49%; float: right; margin-bottom: 20px;">
	<table class="sal" border="1" cellspacing="0" cellpadding="0" style="font-size:13px; margin:0 auto;">
	 
   <tr>
  	 <td colspan="8" style="font-weight:bold; text-align: center;background: #B7CBB6;" >
  	Salary Statement of <?php echo " ".$second_month; ?> 
  </td>
  </tr>
  <tr height="20" align="center" style="font-weight:bold; background-color:#CCC;">
 
    <td height="30"  width="220">Line</td>
    <td   width="100">Total MP</td>
    <td   width="150">Salary Wages</td>
    <td   width="120">Attn Bonus</td>
    <td   width="100">OT Hour</td>
    <td   width="120">OT Amount</td>
    
    <td   width="120">Eot Hour</td>
    <td   width="130">Eot Amount</td>
  </tr>
 
  	
		<?php
		$gt_mp_second 			= 0;
		$gt_cash_mp_second 	= 0;
		$gt_bank_mp_second 	= 0;
		$gt_gross_second 		= 0;
		$gt_basic_second 		= 0;
		$gt_house_r_second		= 0;
		$gt_medical_second 	= 0;
		$gt_food_second		= 0;
		$gt_transport_second 	= 0;
		$gt_salary_amt_second 	= 0;
		$gt_ot_hour_second 	= 0;
		$gt_ot_amount_second 	= 0;
		$gt_attn_bonus_second 	= 0;
		$gt_cash_salary_second = 0;
		$gt_bank_salary_second = 0;
		$gt_net_salary_second	= 0;
		$gt_eot_hour_second 	= 0;
		$gt_eot_amount_second	= 0;
		
		
		
		//$count_second = count($values['second_month']["sec_name"]);
		
		
		if(isset($values['second_month']['sec_name']))
		{
			$count_second = count($values['second_month']['sec_name']);

		}
		else
		{
			$count_second = 0;
		}
		
		
		
		
		for($i=0; $i < $count_second; $i++)
		{
			echo "<tr height='20'>";
			
			echo "<td  style='text-align:left; padding-left:5px;'>";
			echo $values['second_month']["sec_name"][$i];
			echo "</td>";
			
			$total_emp_second = $values['second_month']["emp_cash"][$i] + $values['second_month']["emp_bank"][$i];
			echo "<td align='center'>";
			echo $total_emp_second;
			echo "</td>";
			$gt_mp_second = $gt_mp_second + $total_emp_second;
			 
	
		$total_net_pay_second = $values['second_month']["cash_sum_net_pay"][$i]+ $values['second_month']["bank_sum_net_pay"][$i] ;							 	
		$total_ot_amount_second = $values['second_month']["cash_sum_ot_amount"][$i] + $values['second_month']["bank_sum_ot_amount"][$i];
		$total_attn_bonus_second = $values['second_month']["cash_att_bonus"][$i] + $values['second_month']["bank_att_bonus"][$i];
			
		$total_salary_amount_second = $total_net_pay_second - ($total_ot_amount_second + $total_attn_bonus_second); 
			
			echo "<td align='right' style='padding-right:5px;'>";
			echo number_format($total_salary_amount_second);
			echo "</td>";
			$gt_salary_amt_second = $gt_salary_amt_second + $total_salary_amount_second;
			
			//TOTAL ATTENDANCE BONUS
			echo "<td align='right' style='padding-right:5px;'>";
			echo number_format($total_attn_bonus_second);
			echo "</td>";
			$gt_attn_bonus_second = $gt_attn_bonus_second + $total_attn_bonus_second;
			
			//TOTAL OT HOUR
			$total_ot_hour_second = $values['second_month']["cash_sum_ot_hour"][$i]+ $values['second_month']["bank_sum_ot_hour"][$i];
			echo "<td align='right' style='padding-right:5px;'>";
			echo number_format($total_ot_hour_second);
			echo "</td>";
			$gt_ot_hour_second = $gt_ot_hour_second + $total_ot_hour_second;
			
			//TOTAL OT AMOUNT 
			echo "<td align='right' style='padding-right:5px;'>";
			echo number_format($total_ot_amount_second);
			echo "</td>";
			$gt_ot_amount_second = $gt_ot_amount_second + $total_ot_amount_second;
			
			//TOTAL EOT HOUR
			$total_eot_hour_second = $values['second_month']["total_cash_bank_eot_hour"][$i];
			echo "<td align='right' style='padding-right:5px;'>";
			echo number_format($total_eot_hour_second);
			echo "</td>";
			$gt_eot_hour_second = $gt_eot_hour_second + $total_eot_hour_second;
			
			
			$total_eot_amount_second = $values['second_month']["total_cash_bank_eot_amount"][$i];
			echo "<td align='right' style='padding-right:5px;'>";
			echo number_format($total_eot_hour_second);
			echo "</td>";
			$gt_eot_amount_second = $gt_eot_amount_second + $total_eot_amount_second;			
			

			echo "</tr>";
		}
		echo "<tr style='font-weight:bold; background-color:#CCC;'>";
		
		echo "<td align='center'>";
		echo "B";
		echo "</td>";
		
		echo "<td align='center'>";
		echo $gt_mp_second;
		echo "</td>";
		
		

		echo "<td align='right' style='padding-right:5px;'>";
		echo number_format($gt_salary_amt_second);
		echo "</td>";
		echo "<td align='right' style='padding-right:5px;'>";
		echo number_format($gt_attn_bonus_second);
		echo "</td>";


		echo "<td align='right' style='padding-right:5px;'>";
		echo number_format($gt_ot_hour_second);
		echo "</td>";

		echo "<td align='right' style='padding-right:5px;'>";
		echo number_format($gt_ot_amount_second);
		echo "</td>";
		
		echo "<td align='right' style='padding-right:5px;'>";
		echo number_format($gt_eot_hour_second);
		echo "</td>";

		echo "<td align='right' style='padding-right:5px;'>";
		echo number_format($gt_eot_amount_second);
		echo "</td>";

				
		echo "</tr>";
	?>
	</table>
	
	</div>
	
	</div>
	
	
	<table class="sal" border="1" cellspacing="0" cellpadding="0" style="font-size:13px; margin:0 auto;">
	 
   <tr>
  	 <td colspan="8" style="font-weight:bold; text-align: center;background: #B7CBB6;" >
  		Difference From <?php echo $first_month; ?> to  <?php echo $second_month; ?> 
  	</td>
  </tr>
  <tr height="22" align="center" style="font-weight:bold; background-color:#CCC;">
 
    <td height="30"  width="200">Line</td>
    <td   width="100">Total MP</td>
    <td   width="120">Salary Wages</td>
    <td   width="120">Attn Bonus</td>
    <td   width="120">OT Hour</td>
    <td   width="120">OT Amount</td>
    
    <td   width="120">Eot Hour</td>
    <td   width="120">Eot Amount</td>
  </tr>
 
  
 	<tr height="22" >
	<td  align='center'>A</td>
	<td  align='center'><?php echo $gt_mp;?></td>
	<td align='right' style="padding-right:5px;"><?php echo $gt_salary_amt;?></td>
	<td align='right' style="padding-right:5px;"><?php echo $gt_attn_bonus;?></td>
	<td align='right' style="padding-right:5px;"><?php echo $gt_ot_hour;?></td>
	<td align='right' style="padding-right:5px;"><?php echo $gt_ot_amount;?></td>
	<td align='right' style="padding-right:5px;"><?php echo $gt_eot_hour;?></td>
	<td align='right' style="padding-right:5px;"><?php echo $gt_eot_amount;?></td>
	</tr>
	
	<tr height="22">
	<td  align='center'>B</td>
	<td  align='center'><?php echo $gt_mp_second;?></td>
	<td align='right' style="padding-right:5px;"><?php echo $gt_salary_amt_second;?></td>
	<td align='right' style="padding-right:5px;"><?php echo $gt_attn_bonus_second;?></td>
	<td align='right' style="padding-right:5px;"><?php echo $gt_ot_hour_second;?></td>
	<td align='right' style="padding-right:5px;"><?php echo $gt_ot_amount_second;?></td>
	<td align='right' style="padding-right:5px;"><?php echo $gt_eot_hour_second;?></td>
	<td align='right' style="padding-right:5px;"><?php echo $gt_eot_amount_second;?></td>
	</tr>
	
	<tr style="font-weight: bold;background-color:#CCC;">
	<td  align='center'>A - B</td>
	<td  align='center'><?php echo number_format($gt_mp - $gt_mp_second);?></td>
	<td align='right' style="padding-right:5px;"><?php echo number_format($gt_salary_amt - $gt_salary_amt_second);?></td>
	<td align='right' style="padding-right:5px;"><?php echo number_format($gt_attn_bonus - $gt_attn_bonus_second);?></td>
	<td align='right' style="padding-right:5px;"><?php echo number_format($gt_ot_hour - $gt_ot_hour_second);?></td>
	<td align='right' style="padding-right:5px;"><?php echo number_format($gt_ot_amount - $gt_ot_amount_second);?></td>
	<td align='right' style="padding-right:5px;"><?php echo number_format($gt_eot_hour - $gt_eot_hour_second);?></td>
	<td align='right' style="padding-right:5px;"><?php echo number_format($gt_eot_amount - $gt_eot_amount_second);?></td>
	</tr>
  
  </table>
	
<br></br>
	
	<table width="80%" height="80px" border="0" align="center" style="margin-bottom:25px; font-family:Arial, Helvetica, sans-serif; font-size:10px; font-weight:bold;margin-top:40px;">
			<tr height="80%" >
			<td colspan="5"></td>
			</tr>
			<tr height="20%">
			<td  align="center" style="width:18%;"><dt class="bottom_txt_design" >Prepared By</dt></td>
            <td align="center"  style="width:18%" ><dt class="bottom_txt_design" >Account Office / Executive</dt></td>
			<td  align="center" style="width:18%" ><dt class="bottom_txt_design" >HR Manager</dt></td>
            <td  align="center" style="width:18%" ><dt class="bottom_txt_design" >General Manager (GM)</dt></td>
            <td  align="center" style="width:18%" ><dt class="bottom_txt_design" >Director</dt></td>
			</tr>
			
			</table>
	
</body>
</html>