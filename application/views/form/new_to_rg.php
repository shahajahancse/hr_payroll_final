<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Salary Process</title>
<link href="<?=base_url()?>awedget/assets/plugins/boostrap-3.3.7/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
	<link rel="stylesheet" href="<?php echo base_url('/assets/bootstrap/css/bootstrap.min.css') ?>">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  	<script src="<?php echo base_url('/assets/bootstrap/js/bootstrap.js') ?>"></script>
	
	<script src="<?=base_url()?>awedget/assets/plugins/boostrap-3.3.7/js/bootstrap.min.js" type="text/javascript"></script>
		
 
<script type="text/javascript" src="<?php echo base_url();?>js/dynamic.js"></script>


</head>

<body bgcolor="#ECE9D8">

<div align="center" style="margin:0 auto; width:100%; overflow:hidden; ">

<fieldset style='width:600px;'><legend><font size='+1'><b>New To Regular</b></font></legend>

<!--Select Month and Year :<select id='report_month_sal'><option value='01'>January</option><option value='02'>February</option><option value='03'>March</option><option value='04'>April</option><option value='05'>May</option><option value='06'>Jun</option><option value='07'>July</option><option value='08'>August</option><option value='09'>September</option><option value='10'>October</option><option value='11'>November</option><option value='12'>December</option></select><select id='report_year_sal'><option value='2011'>2011</option><option value='2012'>2012</option><option value='2013'>2013</option><option value='2014'>2014</option><option value='2015'>2015</option><option value='2016'>2016</option><option value='2017'>2017</option><option value='2018'>2018</option><option value='2019'>2019</option><option value='2020'>2020</option></select>-->
<form class="form-group" name="new_reg" method="post" action="<?php echo base_url();?>entry_system_con/new_to_regular_process">
<?php $this->load->view('month_year'); ?>
<input class="btn btn-success" type="submit" name='view'  value='Process'/>
</form>
</fieldset>

</div>

</body>
</html>