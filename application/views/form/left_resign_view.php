<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Left / Resign</title>
<link href="<?=base_url()?>awedget/assets/plugins/boostrap-3.3.7/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="<?php echo base_url('/assets/bootstrap/css/bootstrap.min.css') ?>">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="<?php echo base_url('/assets/bootstrap/js/bootstrap.js') ?>"></script>
<script src="<?=base_url()?>awedget/assets/plugins/boostrap-3.3.7/js/bootstrap.min.js" type="text/javascript"></script>

<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>css/calendar.css" />
<script src="<?php echo base_url(); ?>js/calendar_eu.js" type="text/javascript"></script>
<script language="javascript" type="text/javascript" src="<?php echo base_url();?>js/jquery-1.9.1.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo base_url();?>js/jquery-ui.js"></script>
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>css/jquery-ui-1.8.23.custom.css" />

<style>
form input:focus,form textarea:focus,form select:focus {
  border:1px solid #666;
  background:#e3f1f1;
  }
  select, input, textarea, button {outline:solid 1px gray; resize:none; padding:1px;}

</style>
</head>
<body bgcolor="#ECE9D8">
<div class="form-group" align="center" style="margin:0 auto; width:100%; overflow:hidden; ">
<form class="form-group" name='left_resign' >
<fieldset style='width:500px;background:#F2F2E6;margin-top:10px;'>
<legend style="font-size:28px; font-weight:bold;">Left / Resign Entry</legend>
<table class="table" width='100%' border='0' align='center' style='padding:10px'>

<tr>
<td  width='35%'><label>Employee ID</label></td><td style="font-weight: bold;"><label>:</label></td>
<td width='50%'><input class="form-group" name='emp_id' type='text' id='emp_id' disabled='disabled'/></td>
</tr>

<tr>
<td><label>Effective Date</label></td><td style="font-weight: bold;"><label>:</label></td>
<td><input class="form-group" type='text' id='effective_date' name="effective_date">
<script language="JavaScript">
	var o_cal = new tcal ({
		// form name
		'formname': 'left_resign',
		// input name
		'controlname': 'effective_date'
	});
	
	// individual template parameters can be modified via the calendar variable
	o_cal.a_tpl.yearscroll = false;
	o_cal.a_tpl.weekstart = 6;
	
	</script></td>
</tr>

<tr>
<td><label>Left / Resign </label></td><td style="font-weight: bold;"><label>:</label></td>
<td>
		<select class="form-control" name='select' id='left_resign_status' name="left_resign_status" width='150px'>
		<option value='3'>Left</option>
		<option value='4'>Resign</option>
		</select>
</td>
</tr>


</table>

</fieldset>
<br>
<input class="form-group" style='background-color:yellow;' type='text' size='25px' id='search_empid' name='search_empid'/>
<input class="btn btn-danger" type='button' value='Submit' id='left_or_resign' disabled="disabled"  class="left_res_button"/>
<input class="btn btn-primary" type='button' value='regular' id='left_resign_to_regular' disabled="disabled" class="left_res_button" />

</div>

</form>

<!-- <fieldset  id="auto_gen1"  style="display:none;background:#F2F2E6; font-size:11px; font-weight:bold;width:400px; margin-top: 20px;">
     
</fieldset> -->


</div>

	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<fieldset  id="auto_gen1"  style="display:none;background:#F2F2E6; font-size:11px; font-weight:bold; margin-top: 20px;">
			</fieldset>
		</div>
	</div>
</body>
</html>


<script>
$(function() {
	
	$('#search_empid').keydown(function(){
		$(this).autocomplete(
		{
			source: "<?php echo base_url(); ?>index.php/left_resign_con/search_empid_for_resign_left",
			minLength: 0,
			autoFocus: false,
			select:function(event,ui){
			var left_resign_emp_id = ui.item.left_resign_emp_id ;
			
			var search_data = {
			left_resign_search_text: left_resign_emp_id//$("#mslc_search_text").val()
			};
			
			 $.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>index.php/left_resign_con/get_left_resign_info",
				data: search_data,
				cache: false,
				success: function(data){
					if(data == "This Employee ID Not Exists!")
					{
						alert(data);
						return false;
					}
					if(data == "Please Log In As a Unit User !")
					{
						alert(data);
						return false;
					}
					if(data == "Please Enter Valid Employee ID !")
					{
						alert(data);
						return false;
					}
					left_res_info = data.split("===");
					document.getElementById('emp_id').value 			= left_res_info[0];
					document.getElementById('effective_date').value 	= left_res_info[1];
					
					//alert(left_res_info[3]);
					
					if(left_res_info[3] != "Null")
					{
						$("#left_resign_status option[value='"+left_res_info[2]+"']").remove();
						$("#left_resign_status").append("<option selected='selected' value='"+left_res_info[2]+"'>"+left_res_info[3]+"</option>");
						document.getElementById("left_or_resign").disabled 	= true;
						document.getElementById("left_resign_to_regular").disabled 	= false;
						document.getElementById("left_resign_status").disabled 	= true;
						document.getElementById("effective_date").disabled 	= true;
					}
					else{
						document.getElementById("left_or_resign").disabled 	= false;
						document.getElementById("left_resign_status").disabled 	= false;
						document.getElementById("effective_date").disabled 	= false;
						document.getElementById("left_resign_to_regular").disabled 	= true;
					}
					//alert(left_res_info);
					$('#auto_gen1').load('<?php echo base_url();?>index.php/left_resign_con/get_left_resign_employee_basic_info/'+left_res_info[0]);
					$('#auto_gen1').show();
					return false;
				}
				
				
				});
			}
		});
	});
	

	$('#left_resign_to_regular').on('click',function(){
   		var left_res_button_value = $(this).val();

   		var button_data = {
   			emp_id	:$("#emp_id").val(),
   			effective_date	:$("#effective_date").val(),
			left_res_button_value: $(this).val(),//$("#mslc_search_text").val()
			left_resign_status: $("#left_resign_status").val()
		};
			
			
		$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>index.php/left_resign_con/left_resign_and_regular_action",
			data: button_data,
			cache: false,
			success: function(data){
				alert(data);
				window.location.href = "<?php echo base_url();?>index.php/left_resign_con/left_resign_entry";
				return false;
			}
		});
			
	});

	$('#left_or_resign').on('click',function(){
   		var effective_date = $("#effective_date").val();
   		
   		if(effective_date == '')
		{
			alert("Enter Effective Date!");
			return;
		}

   		var button_data = {
   			emp_id	:$("#emp_id").val(),
   			effective_date	:$("#effective_date").val(),
			left_res_button_value: $(this).val(),//$("#mslc_search_text").val()
			left_resign_status: $("#left_resign_status").val()
		};
			
			
		$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>index.php/left_resign_con/left_resign_and_regular_action",
			data: button_data,
			cache: false,
			success: function(data){
				alert(data);
				window.location.href = "<?php echo base_url();?>index.php/left_resign_con/left_resign_entry";
				return false;
			}
		});
			
	});
	
	
	
	
});


</script>