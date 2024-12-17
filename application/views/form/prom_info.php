
<link href="<?=base_url()?>awedget/assets/plugins/boostrap-3.3.7/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="<?php echo base_url('/assets/bootstrap/css/bootstrap.min.css') ?>">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="<?php echo base_url('/assets/bootstrap/js/bootstrap.js') ?>"></script>

<script src="<?=base_url()?>awedget/assets/plugins/boostrap-3.3.7/js/bootstrap.min.js" type="text/javascript"></script>

<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>css/calendar.css" />
<script type="text/javascript" src="<?php echo base_url();?>js/dynamic.js"></script>
<script src="<?php echo base_url(); ?>js/calendar_eu.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function(){
$(".flip").click(function(){
    $(".panel").slideToggle("slow");
  });
});
function enableemstate() {
document.getElementById('empstat').disabled=false;
}
</script>


<body bgcolor="#ECE9D8">
<div class="content" >
<div id="error_id" style="display:none; color:red;">
<?php echo $validation_errors =  validation_errors(); ?>
</div>
<?php
if($validation_errors != '')
{
	echo "<SCRIPT LANGUAGE=\"JavaScript\">alert(document.getElementById('error_id').innerHTML);</SCRIPT>";
}
?>
<form class="form-group" name='cominfo' class="cominfo"  enctype="multipart/form-data" method="post" action="<?php echo base_url();?>emp_increment_con/promotion_info" >
  <fieldset style="background:#F2F2E6;"><legend style="font-size:28px; font-weight:bold;">Promotion Entry</legend>
    <table class="table sal" border="0" style=" border-collapse:collapse; margin-bottom:20px; width:820px;" cellpadding="3">
      <tr>
        <td width='10%'>Emp Id </td>
        <td width='2%'>:</td>
        <td width='10%'><input class="form-control" type='text' style=" width:91%" id='empid' name='empid' value="<?php echo set_value('empid'); ?>"  required /></td>
        <td width='10%'>Effective Date</td>
        <td width='2%'>:</td>
        <td width='10%' class="form-inline">
          <input class="form-control" type='text'  id='entdate' name="entdate" style=" width:80%" value="<?php echo set_value('entdate'); ?>" />
          <script language="JavaScript">
            var o_cal = new tcal ({
              // form name
              'formname': 'cominfo',
              // input name
              'controlname': 'entdate'
            });

            // individual template parameters can be modified via the calendar variable
            o_cal.a_tpl.yearscroll = false;
            o_cal.a_tpl.weekstart = 6;

          </script>
        </td>
        <td align="center" width="12%" rowspan="5"><img  id='img'  name='image' alt='Image' width="80px" height="100px" src="<?php echo base_url(); ?>uploads/company_photo/images.jpeg">
        </td>
      </tr>
      <tr>
        <td width='10%'>Unit</td>
        <td width='2%'>:</td>
        <td>
          <select class="form-control" style="width:93%;" id='units' name='units' onchange='grid_get_all_data_for_unit()'>
          <option value='Select'>	Select	</option>
              <?php


              $units = $this->common_model->get_unit_id_name();
              foreach($units->result() as $rows) {
                  if($this->input->post('unit_id') == $rows->unit_id) {?>
                      <option value="<?php echo $rows->unit_id; ?>" selected="selected"><?php echo $rows->unit_name; ?></option>
                  <?php } else { ?>
                      <option value="<?php echo $rows->unit_id; ?>"><?php echo $rows->unit_name; ?></option>
                  <?php } ?>

              <?php } ?>
          </select>
        </td>
      </tr>
      <tr>
        <td width='10%'>Department</td>
        <td width='2%'>:</td>
        <td width='10%'><select class="form-control" style="width:93%;" id='dept' name='dept'>
		<?php $department_name = $this->processdb->get_department_name();
		foreach($department_name->result() as $rows) {
			if($this->input->post('dept') == $rows->dept_id) {?>
				<option value="<?php echo $rows->dept_id; ?>" selected="selected"><?php echo $rows->dept_name; ?></option>
			<?php } else { ?>
				<option value="<?php echo $rows->dept_id; ?>"><?php echo $rows->dept_name; ?></option>
			<?php } ?>

		<?php } ?>
	</select></td>
        <td width='10%'>Section</td>
        <td width='2%'>:</td>
        <td width='10%'><select class="form-control" style="width:93%;" id='sec' name='sec' >
    	<?php $section_name = $this->processdb->get_section_name();
		foreach($section_name->result() as $rows) {
			if($this->input->post('sec') == $rows->sec_id) {?>
				<option value="<?php echo $rows->sec_id; ?>" selected="selected"><?php echo $rows->sec_name; ?></option>
			<?php } else { ?>
				<option value="<?php echo $rows->sec_id; ?>"><?php echo $rows->sec_name; ?></option>
			<?php } ?>

		<?php } ?>
  	</select></td>
      </tr>

      <tr>
        <td width='10%'>Line Number</td>
        <td width='2%'>:</td>
        <td width='10%'><select class="form-control" style="width:93%;"id='line' name='line' >
		<?php $line_name = $this->processdb->get_line_name();
		foreach($line_name->result() as $rows) {
			if($this->input->post('line') == $rows->line_id) {?>
				<option value="<?php echo $rows->line_id; ?>" selected="selected"><?php echo $rows->line_name; ?></option>
			<?php } else { ?>
				<option value="<?php echo $rows->line_id; ?>"><?php echo $rows->line_name; ?></option>
			<?php } ?>

		<?php } ?>
	</select></td>
        <td width='10%'>Designation</td>
        <td width='2%'>:</td>
        <td width='10%'><select class="form-control" style="width:93%;" id='desig' name='desig'>
    	<?php $designation_name = $this->processdb->get_designation_name();
		foreach($designation_name->result() as $rows) {
			if($this->input->post('desig') == $rows->desig_id) {?>
				<option value="<?php echo $rows->desig_id; ?>" selected="selected"><?php echo $rows->desig_name; ?></option>
			<?php } else { ?>
				<option value="<?php echo $rows->desig_id; ?>"><?php echo $rows->desig_name; ?></option>
			<?php } ?>

		<?php } ?>
	</select></td>
      </tr>
      <tr>
        <td width='10%'>Emp Status</td>
        <td width='2%'>:</td>
        <td width='20%'><select class="form-control" style="width:93%;" id='empstat' name='empstat'  disabled="disabled" >
            <?php $status_name = $this->processdb->get_status_name();
		foreach($status_name->result() as $rows) {
			if($this->input->post('empstat') == $rows->stat_id) {?>
            <option value="<?php echo $rows->stat_id; ?>" selected="selected"><?php echo $rows->stat_type; ?></option>
            <?php } else { ?>
            <option value="<?php echo $rows->stat_id; ?>"><?php echo $rows->stat_type; ?></option>
            <?php } ?>
            <?php } ?>
          </select></td>
        <td width='10%'>Salary Grade</td>
        <td width='2%'>:</td>
        <td width='20%'><select class="form-control" style="width:93%;"  id='salg' name='salg'>
            <?php $grade_name = $this->processdb->get_grade_name();
		foreach($grade_name->result() as $rows) {
			if($this->input->post('salg') == $rows->gr_id) {?>
            <option value="<?php echo $rows->gr_id; ?>" selected="selected"><?php echo $rows->gr_name; ?></option>
            <?php } else { ?>
            <option value="<?php echo $rows->gr_id; ?>"><?php echo $rows->gr_name; ?></option>
            <?php } ?>
            <?php } ?>
          </select></td>
      </tr>
      <tr>
        <td width='10%'>Gross</td>
        <td width='2%'>:</td>
        <td width='10%'><input class="form-control" name="text8" type='text' id='gsal'  onchange='basic_sal_cal()' style="width:91%" value="<?php echo set_value('text8'); ?>" required/></td>
        <td width='10%'>Basic</td>
        <td width='2%'>:</td>
        <td width='10%'><input  class="form-control" name="text8" type='text' disabled='disabled' id='bsal'  style="width:91%" /></td>
      </tr>
      <tr>
        <td width='10%'>House</td>
        <td width='2%'>:</td>
        <td width='10%'><input class="form-control" name="text8" type='text' disabled='disabled' id='hrent'  style="width:91%"/></td>
        <td width='10%'>Medical</td>
        <td width='2%'>:</td>
        <td width='10%'><input  class="form-control"name="text8" type='text' disabled='disabled' id='mallow' style="width:91%"/></td>
        <td width='10%' rowspan="2" id="emp_name" style="text-align:center;"></td>
      </tr>
       <tr>
  		<td >Transport</td><td width='2%'>:</td>
  		<td ><input class="form-control" name="text8" type='text' disabled='disabled' id='transport_allow'   style="width:91%"/></td>
  		<td >Food</td><td width='2%'>:</td>
 		 <td ><input class="form-control" name="text8" type='text' disabled='disabled' id='lunch_allow'  style="width:91%" /></td>
	</tr>
    </table>
    <div class="panel" align="center">
<table cellpadding="0" cellspacing="5" width='450px' border='0' align='center'>
<tr><td>New Employee ID</td>
<td><input name="new_empid" type='text' id='new_empid' size='29px'  value="<?php echo set_value('new_empid'); ?>"/></td>
</tr>
</table></div><p class="flip">If Need New Employee ID Just Click Here</p>
    </fieldset>
    <div style="width:900px; height:50px; background:#9DA2A6; margin-top:2px; padding-top:10px;">
    <input class="btn btn-primary" type='button' name='add' onclick='clear_data_incre_prom()' value='NEW'/>&nbsp;<input  class="btn btn-success"type="submit" name='pi_save'   value='SAVE'  style="display:none"/>&nbsp;<input class="btn btn-primary" type="submit" name="pi_edit" id="pi_edit" disabled="disabled" onclick="enableemstate()"  style="margin-right:10px;" value='EDIT'/></form>Find ID :
  <input class="form-group" style='background-color:yellow;' type='text' size='15px' id='search_empid' name='search_empid' onchange="com_incre_prom_search()"  />
<!--  </div>
--></div>
<?php if($this->input->post('pi_edit')) {echo "<SCRIPT LANGUAGE=\"JavaScript\">document.cominfo.pi_edit.disabled = false; document.cominfo.pi_save.disabled = true;</SCRIPT>";} ?>

