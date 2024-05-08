<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
<title>General Employee Report</title>
</head>
<body>
	<div class="container-fluid">
	<!-- <div style="position:absolute; right:0" class="noprint">
		<form action="<?php echo base_url();?>index.php/grid_con/general_info_excel" method="post">
			<input type="hidden" name="grid_emp_id" value="<?php echo implode(",",$grid_emp_id); ?>"></input>
			<button type="submit" style="border: 0; background-color:#eeffcc; cursor:pointer;" alt="XLS Export">XLS Export</button>
		</form>
	</div> -->
	<table align="center" height="auto"  class="sal" border="1" cellspacing="0" cellpadding="2" style="font-size:10px; width:1050px;">
		<tr height="85px">
			<td colspan="22" style="text-align:center;">
				<?php $this->load->view("head_english");?>
				<!-- <span style="font-size:13px; font-weight:bold; text-align: center;">Section Wise All Employee List </span> -->
			</td>
		</tr>
		<th class="text-center">SL</th>
		<th class="text-center">Emp ID</th>
		<th class="text-center">Name</th>
		<th class="text-center">Dept.</th>
		<th class="text-center">Section</th>
		<th class="text-center">Designation</th>
		<th class="text-center">Line</th>
		<th class="text-center">Joining Date</th>
		<th class="text-center">Sal. Grade</th>
		<th class="text-center">Gross Salary</th>
		<th class="text-center">N.ID</th>
		<th class="text-center">Date of Birth</th>
		<th class="text-center">F.Name</th>
		<th class="text-center">M.Name</th>
		<th class="text-center">S.Name</th>
		<th class="text-center">Mobile</th>
		<th class="text-center">Pre.Address</th>
		<th class="text-center">Per.Address</th>
		<th class="text-center">Gender</th>
		<th class="text-center">Blood</th>
		<th class="text-center" >Signature</th>
		<!-- < ? php dd($values)?> -->

		<?php $i= 1;foreach($values as $row){?>
		<tr>
			<td class="text-center"><?php echo $i++?></td>
			<td class="text-center"><?php echo $row->emp_id?></td>
			<td class="text-center"><?php echo $row->name_en?></td>
			<td class="text-center"><?php echo $row->dept_name?></td>
			<td class="text-center"><?php echo $row->sec_name_en?></td>
			<td class="text-center"><?php echo $row->desig_name?></td>
			<td class="text-center" style="white-space:nowrap"><?php echo $row->line_name_en?></td>
			<td class="text-center"><?php echo date('d/m/Y',strtotime($row->emp_join_date))?></td>
			<td class="text-center"><?php echo $row->emp_sal_gra_id?></td>
			<td class="text-center"><?php echo $row->gross_sal?></td>
			<td class="text-center"><?php echo $row->nid_dob_id?></td>
			<td class="text-center"><?php echo date('d/m/Y',strtotime($row->emp_dob))?></td>
			<td class="text-center"><?php echo $row->father_name?></td>
			<td class="text-center"><?php echo $row->mother_name?></td>
			<td class="text-center"><?php echo $row->spouse_name?></td>
			<td class="text-center"><?php echo $row->personal_mobile?></td>
			<td class="text-center"><?php echo $row->pre_village.",".$row->pre_post_name_en.",".$row->pre_upa_name_en.",".$row->pre_dis_name_en?></td>
			<td class="text-center"><?php echo $row->per_village.",".$row->per_post_name_en.",".$row->per_upa_name_en.",".$row->per_dis_name_en?></td>
			<td class="text-center"><?php echo $row->gender?></td>
			<td class="text-center"><?php echo $row->blood?></td>
			<td class="text-center" style="height:35px;width:77px"></td>
		</tr>

		<?php }?>



		<tr style="width: 100%">
			<table width="1050px" height="80px" border="0" align="center" style="margin-bottom:0px; font-family:Arial, Helvetica, sans-serif; font-size:10px;">
				<tr height="80%" >
				<td></td>
				</tr>
				<tr height="20%">
					<td  align="center" style="width:20%"><dt class="border-top w-50" style="border-top:1px solid black !important">Prepare By</dt></td>
					<td  align="center" style="width:20%"><dt class="border-top w-50" style="border-top:1px solid black !important">HR Manager</dt></td>
					<td  align="center" style="width:20%"><dt class="border-top w-50" style="border-top:1px solid black !important">Admin Manager</dt></td>
					<td  align="center" style="width:20%"><dt class="border-top w-50" style="border-top:1px solid black !important">GM</dt></td>
					<td  align="center" style="width:20%"><dt class="border-top w-50" style="border-top:1px solid black !important">MD</dt></td>
				</tr>
			</table>
		</tr>
	</table>
	</div>
	<div style="page-break-after: always;"></div>
</body>
<br><br>
</html>
<?php exit(); ?>
