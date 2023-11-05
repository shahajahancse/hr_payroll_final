<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Leave Transaction</title>
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>css/calendar.css" />
<link href="<?=base_url()?>awedget/assets/plugins/boostrap-3.3.7/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="<?php echo base_url('/assets/bootstrap/css/bootstrap.min.css') ?>">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="<?=base_url()?>awedget/assets/plugins/boostrap-3.3.7/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>js/jquery-ui-1.8.23.custom.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/dynamic.js"></script>
<script src="<?php echo base_url(); ?>js/calendar_eu.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>js/grid_content.js" type="text/javascript"></script>

<style>
form input:focus,form textarea:focus,form select:focus{
  border:1px solid #666;
  background:#e3f1f1;
  }
  select, input, textarea, button {outline:solid 1px gray; resize:none; padding:1px;}

</style>
</head>
<body bgcolor="#ECE9D8">

<form  name='leave_holy_days' >
<div class="form-group container" align="center" style="margin:0 auto; overflow:hidden; ">
<fieldset style='background:#F2F2E6;'><legend style="font-size:28px; font-weight:bold;">Leave Entry</legend>

<table class="table"  border='0' style='padding:10px'>
<tr>
<td width='25%'>Employee ID</td>
<td colspan='2'><input class="form-group" name='empid_leave' type='text' id='empid_leave' size='50px' /></td>
</tr>
<tr>
<td width='40%'>Start Date </td>
<td colspan='2'><input class="form-group" name='start_leave_date' type='text' id='start_leave_date' size='50px' />
<script language="JavaScript">
	var o_cal = new tcal ({
		// form name
		'formname': 'leave_holy_days',
		// input name
		'controlname': 'start_leave_date'
	});
	
	// individual template parameters can be modified via the calendar variable
	o_cal.a_tpl.yearscroll = false;
	o_cal.a_tpl.weekstart = 6;
	
	</script>
</td>
</tr>
<tr>
<td width='31%'>End Date</td>
<td colspan='2'><input class="form-group" name='end_leave_date' type='text' id='end_leave_date' size='50px' />
<script language="JavaScript">
	var o_cal = new tcal ({
		// form name
		'formname': 'leave_holy_days',
		// input name
		'controlname': 'end_leave_date'
	});
	
	// individual template parameters can be modified via the calendar variable
	o_cal.a_tpl.yearscroll = false;
	o_cal.a_tpl.weekstart = 6;
	
	</script>
</td>
</tr>
<tr>
<td width='31%'>Leave Type </td>
<td colspan='2'size='50px'>
	<select class="form-control" name='select' id='leave_type' style="width: 400px;">
		<option value='cl'>Casual</option>
		<option value='sl'>Sick</option>
		<option value='el'>Earn</option>
		<option value='pl'>Paternity</option>
		<option value='ml'>Maternity</option>
		<option value='do'>Dayoff</option>
		<option value='wp'>Without Pay</option>
		<option value='stl'>Study</option>
	</select></td>
</tr>
</table>	

</fieldset>
<br>
<input class="btn btn-primary" type='button' name='add' onclick='enable_leve()' value='NEW'/>&nbsp;<input class="btn btn-success" type='button' name='leave_save' onclick='save_leave()' value='SAVE'/>&nbsp; <input class="btn btn-danger" type="button" value="Leave Application" onClick="grid_leave_application_form()">
</div>
</form>
<br><br><br>

<div class="form-group container">
<fieldset style='background:#F2F2E6;margin-top:10px;'><legend style="font-size:28px; font-weight:bold;">Leave Balance Check</legend>
<table class="table" width='100%' border='0' align='center' style='padding:10px'>
<tr>
<td  width='30%'>Employee Status</td>
<td width='22%' style='color: #0000FF'><div id='emp_status'></div></td>
<td  width='18%'>Name</td>
<td width='20%' colspan="2" id="emp_name" style=" font-weight:bold;"></td>
</tr>
<tr>
<td  width='30%'>Casual Leave Entitle</td>
<td width='20%'><input class="form-group" name='c_leave' type='text' id='c_leave' size='15PX'  disabled='disabled'/></td>
<td> Balance </td>
<td><input class="form-group"name='c_leave_balance' type='text' id='c_leave_balance' size='15PX' disabled='disabled' /></td>
<td width='18%' rowspan="4"><img style="margin-left: 15px;"  id='img'  name='image' alt='Image' width="70" height="80px" src="<?php echo base_url(); ?>uploads/company_photo/images.jpeg"></td>
</tr>
<tr>
<td>Sick Leave Entitle </td>
<td><input class="form-group"name='s_leave'type='text' id='s_leave'size='15PX' disabled='disabled' /></td>
<td> Balance </td>
<td><input class="form-group"name='s_leave_balance' type='text' id='s_leave_balance'size='15PX' disabled='disabled' /></td>
</tr>
<tr>
<td>Earn Leave Entitle </td>
<td><input class="form-group"name='e_leave'type='text' id='e_leave'size='15PX' disabled='disabled' /></td>
<td> Balance </td>
<td><input class="form-group"name='e_leave_balance' type='text' id='e_leave_balance'size='15PX' disabled='disabled' /></td>
</tr>
<tr>
<td>Maternity Leave Entitle </td>
<td><input   class="form-group"name='m_leave' type='text' id='m_leave'size='15PX' disabled='disabled' /></td>
<td> Balance </td>
<td><input class="form-group"name='m_leave_balance' type='text' id='m_leave_balance'size='15PX' disabled='disabled' /></td>
</tr>
<tr>
<td>Paternity Leave Entitle </td>
<td><input class="form-group"name='p_leave' type='text' id='p_leave'size='15PX' disabled='disabled' /></td>
<td> Balance </td>
<td><input class="form-group"name='p_leave_balance' type='text' id='p_leave_balance'size='15PX' disabled='disabled'/></td>
 <td></td>
</tr>

</table>

</fieldset>
<br>
<div style=" text-align: center; width:600px; background:#9DA2A6; margin-top:2px; margin-left: 250px; padding:10px;">
Emp ID:<input   class="form-group"style='background-color:yellow;' type='text' size='15px' name='emp_id' id='emp_id' >Year :<input   class="form-group"style='background-color:yellow;' type='text' size='15px' name='find_year' id='find_year' /><input   class="btn btn-success" type='button' value='Search' onclick='search_year()'  />

</div>
</div>

