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

<!-- <body style="width:800px;"> -->
<body style="width:800px;">
<div style="position:absolute; right:0" class="noprint">
	<form action="<?php echo base_url();?>index.php/grid_con/general_info_excel" method="post">
		<input type="hidden" name="sal_year_month" value="<?php echo $salary_month; ?>"></input>
		<input type="hidden" name="grid_emp_id" value="<?php echo implode(",",$grid_emp_id); ?>"></input>

		<button type="submit" style="border: 0; background-color:#eeffcc; cursor:pointer;" alt="XLS Export">XLS Export</button>
	</form>
</div>

<?php 
$row_count=count($values["emp_name"]);
$per_page_id = 8;
if($row_count > $per_page_id)
{
$page = ceil($row_count/$per_page_id);
}
else
{
$page=1;
}

$k = 0;

			
			
			
for ( $counter = 1; $counter <= $page; $counter ++)
{
?>

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
<th>N.ID</th>
<th>Name</th>
<th>F.Name</th>
<th>M.Name</th>
<th>S.Name</th>
<th>Mobile</th>
<th>Pre.Address</th>
<th>Par.Address</th>
<th>Gender</th>
<th>Blood</th>
<th>Height</th>
<th>Dept.</th>
<th>Sec.</th>
<th>Desi.</th>
<th>Line.</th>
<th>Date of Birth</th>
<th>Joining Date</th>
<th>Sal. Grade</th>
<th>Gross Salary</th>
<th style="padding-left: 15px;padding-right: 15px;">Signature</th>
<?php
			
	if($counter == $page)
  	{
   		$modulus = ($row_count-1) %$per_page_id;
    	$per_page_row=$modulus;
	}
   	else
   	{
    	$per_page_row=$per_page_id-1;
   	}
  	
   //	$k = 1;
	
	for($i=0; $i<=$per_page_row;$i++)
	{
		echo "<tr>";
	
	echo "<td>";
	echo $k +1;
	echo "</td>";
	
	
	echo "<td  style='text-align:center;'>";
	echo $values["emp_id"][$k];
	echo "</td>";
	
	echo "<td >";
	echo $values["n_id"][$k];
	echo "</td>";
	
	echo "<td >";
	echo $values["emp_name"][$k];
	echo "</td>";
	
	echo "<td >";
	echo $values["emp_fname"][$k];
	echo "</td>";
	
	echo "<td >";
	echo $values["emp_mname"][$k];
	echo "</td>";
	
	echo "<td >";
	echo $values["spouse_name"][$k];
	echo "</td>";
	
	echo "<td >";
	echo $values["mobile"][$k];
	echo "</td>";
	
	echo "<td style='font-size:10px;width:200px;height:60px;overflow:hidden;'>";
	echo $values["emp_pre_add"][$k];
	echo "</td>";
	
	echo "<td style='font-size:10px;width:200px;height:60px;overflow:hidden;'>";
	echo $values["emp_par_add"][$k];
	echo "</td>";
	
	echo "<td>";
	$this->db->select('pr_emp_sex.sex_id,pr_emp_sex.sex_name');
	$this->db->from('pr_emp_sex');
	$this->db->where('pr_emp_sex.sex_id',$values["sex_id"][$k]);
	$query = $this->db->get();
	foreach($query->result() as $row){
		echo $row->sex_name;
	}
	//echo $values["emp_sex"][$k];
	echo "</td>";
	
	echo "<td >";
	$this->db->select('pr_emp_blood_groups.blood_name');
	$this->db->from('pr_emp_blood_groups');
	$this->db->where('pr_emp_blood_groups.blood_id',$values["emp_blood"][$k]);
	$query = $this->db->get()->row();
	echo $query->blood_name;
	echo "</td>";
	
	echo "<td >";
	echo $values["posi_name"][$k];
	echo "</td>";
	
	echo "<td >";
	echo $values["dept_name"][$k];
	echo "</td>";
	
	echo "<td >";
	echo $values["sec_name"][$k];
	echo "</td>";
	
	echo "<td >";
	echo $values["desig_name"][$k];
	echo "</td>";
	
	echo "<td >";
	echo $values["line_name"][$k];
	echo "</td>";
	
	
	echo "<td   style='text-align:center; width:70px;'>";
	$year= trim(substr($values["emp_dob"][$k],0,4));
	$month = trim(substr($values["emp_dob"][$k],5,2));
	$tarik = trim(substr($values["emp_dob"][$k],8,2));
	$date_format = date("d-M-y", mktime(0, 0, 0, $month, $tarik, $year));
	echo $date_format;
	echo "</td>";
	
	echo "<td  style='text-align:center; width:70px;'>";
	$year= trim(substr($values["doj"][$k],0,4));
	$month = trim(substr($values["doj"][$k],5,2));
	$tarik = trim(substr($values["doj"][$k],8,2));
	$date_format = date("d-M-y", mktime(0, 0, 0, $month, $tarik, $year));
	echo $date_format;
	echo "</td>";
	
	echo "<td >";
	echo $values["gr_name"][$k];
	echo "</td>";
	
	echo "<td >";
	echo $values["gross_sal"][$k];
	echo "</td>";
	
	echo "<td >";
	echo "&nbsp;";
	echo "</td>";
	
	echo "</tr>";
		$k++;
		
		
	}
	?>
	
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
			<?php

		}

?>

</body>
</html>