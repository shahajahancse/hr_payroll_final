<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Festival Bonus</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/print.css" media="print" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/SingleRow.css" />
</head>

<body>
	<?php 
		// dd($value);
		$row_count=count($value);
		if($row_count >15){
			$page=ceil($row_count/15);
		}
		else{
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
		<?php  for ( $counter = 1; $counter <= $page; $counter ++) { ?>
			<table height="auto"  class="sal" border="1" cellspacing="0" cellpadding="2" style="font-size:13px; margin:0 auto; width:Auto; border-collapse: collapse;">
				<tr height="85px">
					<td colspan="17" align="center">
						<div style="width:100%; font-family:Arial, Helvetica, sans-serif;">
							<div style="text-align:left; position:relative;padding-left:10px;width:20%; float:left; font-weight:bold;">
								<table> 
									<?php $date = date('d-m-Y');?>
								</table>
							</div>

							<div style="text-align:center; position:relative; overflow:hidden; display:block;">
								<?php $this->load->view("head_english"); ?>
								Festival Bonus Sheet for The Month of 
								<?php echo '</span>';
									$date = $salary_month;
									$date_format = date("F-Y", strtotime($date));
									$this->db->where('id', $value[0]->bonus_rule_id);
									$bbnn = $this->db->get('pr_bonus_rules')->row();
									echo $date_format .' ( '. $bbnn->festival .' )';
									echo '</span>';
								?>
							</div>
							<div style="text-align:left; position:relative;padding-left:10px;width:20%; overflow:hidden; float:right; display:block; font-weight:bold">
							</div>
						</div>
					</td>
				</tr>
				<!-- report title -->
				<tr height="20px">
					<td  height="20px" style='padding:3px;'><strong>Sl. No.</strong</td>
					<td style='padding:3px;'><strong>Emp. ID</strong</td>
					<td style='padding:3px;'><strong>Name</strong</td>
					<td style='padding:3px;'><strong>Designation</strong</td>
					<td style='padding:3px;'><strong>Line</strong</td>
					<td style='padding:3px;'><strong>Joining</strong</td>
					<td style='padding:3px;'><strong>Effect Date</strong</td>
					<td style='padding:3px;'><strong>Service Month</strong</td>
					<td style='padding:3px;'><strong>Gross Salary</strong</td>
					<td style='padding:3px;'><strong>Payable Amount</strong</td>
					<td style='padding:3px;'><strong>Bkash Number</strong</td>
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
						echo "<tr height='50' style='padding:3px;'>";
						echo "<td >";
						echo $k+1;
						echo "</td>";

						echo "<td style='padding:3px;'>";
						print_r($value[$k]->emp_id);
						echo "</td>";

						echo "<td style='padding:3px;'>";
						print_r($value[$k]->name_en);
						echo "</td>";
								
						echo "<td style='padding:3px;'>";
						print_r($value[$k]->desig_name);
						echo "</td>";
						
						echo "<td style='padding:3px;'>";
						print_r($value[$k]->line_name_en);
						echo "</td>";
								
						echo "<td style='padding:3px;'>";
						echo date("d-m-Y", strtotime($value[$k]->emp_join_date));
						echo "</td>";

						echo "<td style='padding:3px;'>";
						echo date("d-m-Y", strtotime($bbnn->effective_date));
						echo "</td>";

						echo "<td style='padding:3px;'>";
							// $join_date = new DateTime($value[$k]->emp_join_date);
                            // $effective_date = new DateTime($bbnn->effective_date);
                            // $interval = $join_date->diff($effective_date);
                            // $interval->d += 1; // Adding one day to the interval
                            // echo $interval->format('%y Year %m Month %d Day');
							$emp_join_date    = $value[$k]->emp_join_date;
							$effective_date   = $bbnn->effective_date;
							$joinDate         = new DateTime($emp_join_date);
							$effectiveDate    = new DateTime($effective_date);
							$diff             = $effectiveDate->diff($joinDate);
							$days             = $diff->d;
							if($days >= 30){
								$diff->m = $diff->m + 1;
								$days = $days - 30;
							}
							echo "{$diff->y} years, {$diff->m} months, {$days} days";
						echo "</td>";

						echo "<td style='padding:3px;'>";
						print_r($value[$k]->com_gross_sal);
						echo "</td>";

						echo "<td style='padding:3px; text-align:right'>";
						print_r($value[$k]->com_bonus_ammount ? $value[$k]->com_bonus_ammount : 0);
						echo "</td>";

						echo "<td style='padding:3px;'>";
						print_r($value[$k]->bank_bkash_no);
						echo "</td>";

						$total_festival_bonus = $total_festival_bonus + $value[$k]->com_bonus_ammount;
						$net_pay = $net_pay + $value[$k]->com_bonus_ammount;
							
						echo "</tr>"; 
						$k++;
					}
				?>
				<tr>
					<td align="center" colspan="9"><strong>Every Page Total</strong></td>
					<td align="right" style='padding:3px;'><strong><?php echo $english_format_number = number_format($total_festival_bonus);?></strong></td>
				</tr>

				<?php if($counter == $page) {?>
					<tr height="10">
						<td align="center" colspan="9" style='padding:3px;'><strong>Total</strong></td>
						<td align="right" style='padding:3px;'><strong><?php echo $english_format_number = number_format($net_pay);?></strong></td>
					</tr>
				<?php } ?>
					
				<table width="90%" height="80px" border="0" align="center" style="font-weight:bold;  font-size:10px ;margin-bottom: 270px;">
					<tr height="80%" >
						<td colspan="29"></td>
					</tr>
					<tr height="20%">
						<td  align="center"><dt class="bottom_txt_design" >Prepared By</dt></td>
						<td  align="center"><dt class="bottom_txt_design" >Manager(HRD)</dt></td>
						<td  align="center"><dt class="bottom_txt_design" >Audit</dt></td>
						<td  align="center"><dt class="bottom_txt_design" >GM</dt></td>
						<td  align="center"><dt class="bottom_txt_design" >Group GM</dt></td>
						<td  align="center"><dt class="bottom_txt_design" >COO</dt></td>
						<td  align="center"><dt class="bottom_txt_design" >DMD</dt></td>
						<td  align="center"><dt class="bottom_txt_design" >Managing Director</dt></td>
					</tr>
				</table>
			</table>  
		<?php } ?>
	</table>
</body>
</html>