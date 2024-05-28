<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>উৎসব ভাতা</title>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/print.css" media="print" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/SingleRow.css" />

</head>

<body style="width:800px;">

<?php 
$row_count=count($value);
if($row_count >15)
{
$page=ceil($row_count/15);
}
else
{
$page=1;
}

$k = 0;

			
			$basic_sal = 0;
			$house_rent = 0;
			$medical_all = 0;
			$trans_all = 0;
			$food_all = 0;
			$gross_sal = 0;
			$net_pay =0;
		
			?>
			<table>
			
			<?php 
			// dd($value);
for ( $counter = 1; $counter <= $page; $counter ++)
{
?>

<table height="auto"  class="sal" border="1" cellspacing="0" cellpadding="2" style="font-size:13px; margin:0 auto;width:Auto; border-collapse: collapse;">

<tr height="85px">
<td colspan="17" align="center">
<div style="width:100%; font-family:Arial, Helvetica, sans-serif;">
<div style="text-align:left; position:relative;padding-left:10px;width:20%; float:left; font-weight:bold;">
<table>
<?php 
$date = date('d-m-Y');
$section_name = isset($value[$k]->sec_name_bn) ? $value[$k]->sec_name_bn : "";
echo "<span style='white-space:nowrap;'>সেকশন : ".$section_name."</span><br>";
 ?>
</table>
</div>
 <div style="text-align:center; position:relative;padding-left:10px;width:50%; overflow:hidden; float:left; display:block;">
<?php 
$this->load->view("head_bangla");

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
echo '<span style="font-weight:bold;">';
?>
উৎসব ভাতা
<?php 
$date = $salary_month;
$year=trim(substr($date,0,4));
$month=trim(substr($date,5,2));
$day=trim(substr($date,8,2));
$date_format = date("F-Y", mktime(0, 0, 0, $month, $day, $year));
$date_formate2 = $this->common_model->covert_english_date_to_bangla_date_with_day_name($date_format);
echo $date_formate2;
echo '</span>';

?>

</div>
<div style="text-align:left; position:relative;padding-left:10px;width:20%; overflow:hidden; float:right; display:block; font-weight:bold">

<?php
echo '<span style="font-weight:bold;font-family:SutonnyMj; SolaimanLipi;">';
echo "পেজ নম্বর # $counter এর $page<br>";
echo "প্রদাণের তারিখ : ";
echo '</span>';
?>

</div>


</div>
</td>
</tr>


  <tr height="20px">
    <td  width="15" height="20px" style='white-space:nowrap;'><div align="center"><strong>ক্রমিক নং</strong></div></td>
    <td width="14" style='white-space:nowrap;'><div align="center"><strong>কার্ড নং</strong></div></td>
    <td width="30" style='white-space:nowrap;'><div align="center"><strong>কর্মচারীর নাম</strong></div></td>
    <td width="25" ><div align="center"><strong>পদবী</strong></div></td>
	<td width="30" ><div align="center"><strong>লাইন</strong></div></td>
    <td width="25" style='white-space:nowrap;'><div align="center"><strong>যোগদানের তারিখ</strong></div></td>
	<td width="25" style='white-space:nowrap;'><div align="center"><strong>গ্রেড</strong></div></td>
    <td width="20" style='white-space:nowrap;'> <div align="center"><strong>মূল বেতন</strong></div></td>
    <td width="35" style='white-space:nowrap;'><div align="center"><strong>মোট বেতন</strong></div></td>
    <td width="40" style='white-space:nowrap;'><div align="center"><strong>কর্ম মাস</strong></div></td>
    <td width="35" style='white-space:nowrap;'><div align="center"><strong>ভাতা%</strong></div></td>
    <td width="22" style='white-space:nowrap;'><div align="center"><strong>উৎসব ভাতা</strong></div></td> 

	<td  width="80"><div align="center"><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;স্বাক্ষর&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong></div></td>
  </tr>
<?php
			
	if($counter == $page)
  	{
   		$modulus = ($row_count-1) % 15;
    	$per_page_row=$modulus;
	}
   	else
   	{
    	$per_page_row=14;
   	}
  	
   	$total_basic_sal = 0;
	$total_house_rent = 0;
	$total_medical_all = 0;
	$total_trans_all = 0;
	$total_food_all = 0;
	$total_gross_sal = 0;
	$total_net_pays		= 0;
	$total_festival_bonus = 0;
	for($p=0; $p<=$per_page_row;$p++)
	{
		echo "<tr height='50' style='text-align:center;font-family:SutonnyMj; SolaimanLipi;'' >";
		echo "<td >";
		echo $k+1;
		echo "</td>";
		
		echo "<td style='text-align:center;font-family:SutonnyMj; SolaimanLipi;'>";
		print_r($value[$k]->emp_id);
		//echo $row->emp_id;
		echo "</td>";
		
		echo "<td style='width:100px;font-family:SutonnyMj; SolaimanLipi;'>";
		print_r($value[$k]->name_bn);
		echo '<br>';
		if($grid_status == 4)
		{
			$resign_date = $this->Grid_model->get_resign_date_by_empid($value[$k]->emp_id);
			if($resign_date != false){
			echo $resign_date = date('d-M-y', strtotime($resign_date));}
		}
		echo "</td>"; 
				
		
				
		echo "<td>";
		print_r($value[$k]->desig_bangla);
		//echo $row->desig_name;
		echo "</td>";
		
		echo "<td>";
		print_r($value[$k]->line_name_bn);
		//echo $row->desig_name;
		echo "</td>";
				
				
		echo "<td>";
		$date = $value[$k]->emp_join_date;
		//print_r($value[$k]->emp_join_date);
		$year=trim(substr($date,0,4));
		$month=trim(substr($date,5,2));
		$day=trim(substr($date,8,2));
		$date_format = date("d-F-y", mktime(0, 0, 0, $month, $day, $year));
		$date_formate2 = $this->common_model->covert_english_date_to_bangla_date_with_day_name($date_format);
echo $date_formate2;
		echo "</td>";
			
		echo "<td style='text-align:center;font-family:SutonnyMj; SolaimanLipi;'>";
		print_r ($value[$k]->gr_name == 'None' ? 'নাই' : $value[$k]->gr_name);
		echo "</td>";
			
		echo "<td style='text-align:center;font-family:SutonnyMj; SolaimanLipi;'>";
		print_r ($value[$k]->basic_sal);
		$total_basic_sal = $total_basic_sal + $value[$k]->basic_sal;
		$basic_sal = $basic_sal + $value[$k]->basic_sal;
		echo "</td>";
			
		echo "<td style='text-align:center;font-family:SutonnyMj; SolaimanLipi;'>";
		print_r ($value[$k]->gross_sal);
		//echo "<strong>$row->gross_sal</strong>";
		$total_gross_sal = $total_gross_sal + $value[$k]->gross_sal;
		$gross_sal = $gross_sal + $value[$k]->gross_sal;
		echo "</td>";
				
		echo "<td style='text-align:center;font-family:SutonnyMj; SolaimanLipi;'>";
		$service_month = $value[$k]->service_length;
		$effective_date = trim(substr($salary_month,1,7));
		$effective_date = $this->salary_process_model->get_bonus_effective_date($effective_date);
		
		$year = floor($service_month/365);
		$month = $service_month - ($year*365);
		
		echo "$service_month মাস " ;//= $this->salary_process_model->get_service_month($effective_date,$value[$k]->emp_join_date);
		
		echo "</td>";
		
		echo "<td style='text-align:center;font-family:SutonnyMj; SolaimanLipi;'>";
		$bouns_rule = $this->salary_process_model->get_festival_bonus_rule($service_month);
		if($bouns_rule)
		echo $bouns_rule['bonus_percent'];
		echo "</td>";		
		
		echo "<td style='text-align:center;font-family:SutonnyMj; SolaimanLipi;'>";
		print_r ($value[$k]->bonus_amount);
		echo "</td>";
		
		$total_festival_bonus = $total_festival_bonus + $value[$k]->bonus_amount;
		$net_pay = $net_pay + $value[$k]->bonus_amount;
				
		echo "<td>";
		echo "&nbsp;";
		echo "</td>";
			
		echo "</tr>"; 
		$k++;
	}
	?>
	<tr>
		<td align="center" colspan="7"><strong>প্রতি পাতার মোট</strong></td>
		
		<td align="right" style="font-weight:bold;font-family:SutonnyMj; SolaimanLipi;"><strong><?php echo $english_format_number = number_format($total_basic_sal);?></strong></td>
		<!--<td align="right"><strong><?php echo $english_format_number = number_format($total_house_rent);?></strong></td>
		<td align="right"><strong><?php echo $english_format_number = number_format($total_medical_all);?></strong></td>
		<td align="right"><strong><?php echo $english_format_number = number_format($total_trans_all);?></strong></td>
		<td align="right"><strong><?php echo $english_format_number = number_format($total_food_all);?></strong></td> -->
		
		<td align="right" style="font-weight:bold;font-family:SutonnyMj; SolaimanLipi;"><strong><?php echo $english_format_number = number_format($total_gross_sal);?></strong></td>
		
		<td align="center" colspan="2"></td>
		<td align="right" style="font-weight:bold;font-family:SutonnyMj; SolaimanLipi;"><strong><?php echo $english_format_number = number_format($total_festival_bonus);?></strong></td>
	</tr>
	<?php
	if($counter == $page)
   		{?>
			<tr height="10">
            <td align="center" colspan="7" style="font-weight:bold;font-family:SutonnyMj; SolaimanLipi;"><strong>সর্বমোট</strong></td>
		
		<td align="right" style="font-weight:bold;font-family:SutonnyMj; SolaimanLipi;"><strong><?php echo $english_format_number = number_format($basic_sal);?></strong></td>
		<!--<td align="right"><strong><?php echo $english_format_number = number_format($house_rent);?></strong></td>
		<td align="right"><strong><?php echo $english_format_number = number_format($medical_all);?></strong></td>
		<td align="right"><strong><?php echo $english_format_number = number_format($trans_all);?></strong></td>
		<td align="right"><strong><?php echo $english_format_number = number_format($food_all);?></strong></td>-->
		
		<td align="right" style="font-weight:bold;font-family:SutonnyMj; SolaimanLipi;"><strong><?php echo $english_format_number = number_format($gross_sal);?></strong></td>
		
		<td align="center" colspan="2"></td>
		<td align="right" style="font-weight:bold;font-family:SutonnyMj; SolaimanLipi;"><strong><?php echo $english_format_number = number_format($net_pay);?></strong></td>
			
			</tr>
			<?php } ?>
			
<table width="100%" height="80px" border="0" align="center" style="font-weight:bold;font-family:SutonnyMj; SolaimanLipi; font-size:10px;margin-bottom:270px;">
			<tr height="80%" >
			<td colspan="29"></td>
			</tr>
			<tr height="20%">
			<td  align="center" style="width:15%;"><dt class="bottom_txt_design" >এডমিন এন্ড এইচ.আর বিভাগ</dt></td>
            <td align="center"  style="width:25%" ><dt class="bottom_txt_design" >অ্যাকাউন্টস বিভাগ</dt></td>
			<td  align="center" style="width:20%" ><dt class="bottom_txt_design" >পরিচালক</dt></td>
            <td  align="center" style="width:20%" ><dt class="bottom_txt_design" >ব্যবস্থাপনা পরিচালক</dt></td>
			</tr>
			</table>
			</table>
			  
			<?php

		}

?>
</table>

</body>
</html>