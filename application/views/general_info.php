<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>
	General Employee Report
</title>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/print.css" media="print" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/SingleRow.css" />
<style>
.bottom_txt_design
{
	 border-top:1px solid;
	 width:160px;
	 font-weight:bold;
}
.bottom_txt_manager_design
{
	border-top:1px solid;
	width:170px;
}
table{
	table-layout: auto;
}
table tr,table td,table th{
 margin:0px;
 padding:0px;
}
</style>

</head>
<body style="width:800px;">
<div style="position:absolute; right:0" class="noprint">
	<form action="<?php echo base_url();?>index.php/grid_con/general_info_excel" method="post">
		<input type="hidden" name="grid_emp_id" value="<?php echo implode(",",$grid_emp_id); ?>"></input>

		<button type="submit" style="border: 0; background-color:#eeffcc; cursor:pointer;" alt="XLS Export">XLS Export</button>
	</form>
</div>
<table align="center" height="auto"  class="sal" border="1" cellspacing="0" cellpadding="2" style="font-size:10px; width:1050px;">

	<tr height="85px">
		<td colspan="22" style="text-align:center;">
			<?php
			$this->load->view("head_english");?>
			<span style="font-size:13px; font-weight:bold; text-align: center;">
				Section Wise All Employee List 
			</span>
		</td>
	</tr>
	<th>SL</th>
	<th>Emp ID</th>
	<th>Name</th>
	<th>Dept.</th>
	<th>Sec.</th>
	<th>Desi.</th>
	<th>Line.</th>
	<th>Joining Date</th>
	<th>Sal. Grade</th>
	<th>Gross Salary</th>
	<th>N.ID</th>
	<th>Date of Birth</th>
	<th>F.Name</th>
	<th>M.Name</th>
	<th>S.Name</th>
	<th>Mobile</th>
	<th>Pre.Address</th>
	<th>Par.Address</th>
	<th>Gender</th>
	<th>Blood</th>
	<th style="padding-left: 15px;padding-right: 15px;">Signature</th>

		
		<tr style="width: 100%">
			<table width="1050px" height="80px" border="0" align="center" style="margin-bottom:0px; font-family:Arial, Helvetica, sans-serif; font-size:10px;">
				<tr height="80%" >
				<td></td>
				</tr>
				<tr height="20%">
					<td  align="center" style="width:20%" ><dt class="bottom_txt_design" >Prepare By</dt></td>
					<td  align="center" style="width:20%" ><dt class="bottom_txt_design" >HR Manager</dt></td>
					<td  align="center" style="width:20%" ><dt class="bottom_txt_design" >Admin Manager</dt></td>
					<td  align="center" style="width:20%" ><dt class="bottom_txt_design" >GM</dt></td>
					<td  align="center" style="width:20%" ><dt class="bottom_txt_design" >MD</dt></td>
				</tr>
			
			</table>
		</tr>
</table>
	<div style="page-break-after: always;"></div>


</body>
</html>