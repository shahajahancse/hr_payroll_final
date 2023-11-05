<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Personal Info</title>

 <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>css/calendar.css" />
 

<link href="<?=base_url()?>awedget/assets/plugins/boostrap-3.3.7/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="<?php echo base_url('/assets/bootstrap/css/bootstrap.min.css') ?>">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="<?php echo base_url('/assets/bootstrap/js/bootstrap.js') ?>"></script>
	
<script src="<?=base_url()?>awedget/assets/plugins/boostrap-3.3.7/js/bootstrap.min.js" type="text/javascript"></script>
		
<script type="text/javascript" src="<?php echo base_url();?>js/dynamic.js"></script>
<script src="<?php echo base_url(); ?>js/calendar_eu.js" type="text/javascript"></script>


</head>

<body bgcolor="">

<div class="form-group container" align="center" style="margin:0 auto; overflow:hidden;">

<fieldset style='width:600px; border:1px;'><legend><font><b>Advance Loan</b></font></legend>

<form name="adv_loan">
<table class="table" border="0" cellpadding="2" cellspacing="2">
<tr><td>Enter employee ID</td> <td>:</td> <td><input class="form-control" type="text" name="emp_id" id="emp_id" /></td></tr>
<tr><td>Enter loan amount</td> <td>:</td> <td><input class="form-control" type="text" name="loan_amt" id="loan_amt" /></td></tr>
<tr><td>Enter payment/month</td> <td>:</td> <td><input class="form-control" type="text" name="pay_amt" id="pay_amt" /></td></tr>
<tr><td>Select Loan Date</td> <td>:</td>
<td>
<div class="form-inline">
	<input style="width: 90%" class="form-control" type='text' name='loan_date' id='loan_date' size='16'>
	<script language="JavaScript">
		var o_cal = new tcal ({
			// form name
			'formname': 'adv_loan',
			// input name
			'controlname': 'loan_date'
		});
		
		// individual template parameters can be modified via the calendar variable
		o_cal.a_tpl.yearscroll = false;
		o_cal.a_tpl.weekstart = 6;
	
	</script>
</div>
</td></tr>
<tr><td> </td><td><td><input class="btn btn-success" type='button' name='view' onclick='advance_loan_insert()' value='Submit'/></td></tr>
</table>
</form>
</fieldset>

</div>

</body>
</html>