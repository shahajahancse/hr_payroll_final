<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>MSH Payroll Reports</title>

	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>css/calendar.css" />
	
	<script src="<?php echo base_url(); ?>js/mars_js.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>js/calendar_eu.js" type="text/javascript"></script>
	

</head>
<body bgcolor="#ECE9D8">
<div align="center" style=" margin:0 auto; width:1000px; min-height:555px; overflow:hidden;">
<div style="float:left; overflow:hidden; width:90%; height:auto; padding:10px; text-align:left;">
<form name="grid">
<div>
<?php 
		$this->load->model('common_model'); 
		$unit = $this->common_model->get_unit_id_name();
	?>
<fieldset style='width:95%;'><legend><font size='+1'><b>Date</b></font></legend>
Select Date: <input type="text" name="firstdate" id="firstdate" style="width:100px;"/>

	<script language="JavaScript">
	var o_cal = new tcal ({
		// form name
		'formname': 'grid',
		// input name
		'controlname': 'firstdate'
	});
	
	// individual template parameters can be modified via the calendar variable
	o_cal.a_tpl.yearscroll = false;
	o_cal.a_tpl.weekstart = 6;
	
	</script>
 </div>
</fieldset>
<br />
<div>
<fieldset style='width:95%;'><legend><font size='+1'><b>Category Options</b></font></legend>
<table align="left">
<tr>

<td>Unit</td>
<td>:</td>
<td><select name='grid_start' id='grid_start' style="width:250px;"  />
            	<option value='Select'>	Select	</option>
                <?php foreach($unit->result() as $rows) { ?>
						<option value="<?php echo $rows->unit_id; ?>"><?php echo $rows->unit_name; ?></option>
				<?php } ?>
            </select></td>

<td>

<td>Select Category</td><td>:</td>
<select id="category">
	<option value="Select" selected="selected">Select</option>
	<option value="Department">Department</option>
	<option value="Section">Section</option>
	<option value="Line">Line</option>
</select>
</td>

</tr>

</table>
</fieldset>
</div>
<div>
<br />

<fieldset style='width:95%;'><legend><font size='+1'><b>Daily Reports</b></font></legend>
<table width="100%"  style="font-size:11px; ">
<?php $usr_arr = array(3,7,8);
$user_id = $this->acl_model->get_user_id($this->session->userdata('username'));
$acl = $this->acl_model->get_acl_list($user_id); ?>
<tr>
<?php if(!in_array($user_id,$usr_arr)){  ?>
<td style="width:20%;"><input type="button" style="width:100%; font-size:100%;" value="Attendance Summary" onClick="daily_attendance_summary()"></td>
<?php } ?>
<td style="width:20%;"><input type="button" style="width:100%; font-size:100%;" value="Attendance Summary New" onClick="daily_attendance_summary_test()"></td>
<td style="width:20%;"></td>
<td style="width:20%;"></td>
</tr>


<?php

if(!in_array(10,$acl))
{
?>
<?php if(!in_array($user_id,$usr_arr)){  ?>
<tr>
<td style="width:20%;background-color: #666666"><input type="button" style="width:100%; font-size:100%;" value="Daily Costing Summary" onClick="daily_costing_summary()"></td>

<td style="width:20%;background-color: #666666"><input type="button" style="width:100%; font-size:100%;" value="Daily OT Summary" onClick="daily_ot_summary()"></td>

<td style="width:20%;background-color: #666666"><input type="button" style="width:100%; font-size:100%;" value="Daily Logout" onClick="daily_logout_report()"></td>
<td style="width:20%;"></td>
<td style="width:20%;"></td>


</tr>
<?php } ?>
<?php } ?>

</table>

</fieldset>



</div>

</form>

</div>
<div style="float:right;">
<table id="list1" style="font-family: 'Times New Roman', Times, serif; font-size:15px;"><tr><td></td></tr></table>
</div>
<!--<div id="pager1"></div>-->

<div id="viewid"></div>
</div>
</body>
</html>