<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>MSH Payroll Reports</title>

	<link href="<?=base_url()?>awedget/assets/plugins/boostrap-3.3.7/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="<?=base_url()?>awedget/assets/plugins/boostrap-3.3.7/js/bootstrap.min.js" type="text/javascript"></script>

	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>themes/redmond/jquery-ui-1.8.2.custom.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>themes/ui.jqgrid.css"/>
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>css/calendar.css"/>

	<script src="<?php echo base_url(); ?>js/jquery.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>js/jquery-ui-1.8.23.custom.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>js/i18n/grid.locale-en.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>js/jquery.jqGrid.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>js/grid_content.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>js/calendar_eu.js" type="text/javascript"></script>
	<script>
    $(function(){
            $( ".clearfix" ).dialog({
                autoOpen: false,
                height: 370,
                width: 300,
                resizable: false,
                modal: true
            });

            $(".ui-dialog-titlebar").hide();

        });
    </script>
	<style>
		.select-date {
			border-radius: 5px;
			border: 1px solid #d6d5cf;
			padding: 10px;
			margin-right: 15px;
			margin-left: 15px;
		}
		.select-date .form-group-sm .form-control{
			height: 25px !important;
			padding: 5px !important;
		}

		.category-option {
			/* padding: 10px; */
			border-radius: 15px;
			margin-right: 15px;
			margin-left: 15px;
		}

		.category-option fieldset {
			border: 1px solid silver !important;
		}
		.category-option legend {
			width: 150px;
			padding: 2px;
			margin-left: calc(10% - 55px - 8px);
			margin-bottom: 2px;
			font-size: 16px;
			font-weight: bold;
		}
		.category-fields{
			padding-right: 15px;
			padding-left: 15px;
		}

		.category-fields .form-group-sm select.form-control {
			height: 25px !important;
			padding: 5px !important;
			line-height: 30px;
			width: 245PX !important;
		}

		/* report  option */
		.report-option {
			border-radius: 15px;
			margin-right: 0px;
			margin-left: 10px;
			margin-top: 0px;
		}

		/* Tabs section  */
		/* Tabs section  */
		*,
		*:after,
		*:before {
		box-sizing: border-box;
		-webkit-box-sizing: border-box;
		-moz-box-sizing: border-box;
		-webkit-font-smoothing: antialiased;
		font-smoothing: antialiased;
		text-rendering: optimizeLegibility
		}

		/* Multi Tab Sidebar */

		.multitab-section {
		display: inline-block;
		text-transform: uppercase;
		width: 98%;
		}

		.multitab-section p {
		display: inline-block;
		background: #fff;
		text-transform: lowercase;
		font-size: 14px;
		padding: 20px;
		margin: 0;
		}

		.multitab-widget {
		list-style: none;
		margin: 0 0 10px;
		padding: 0
		}

		.multitab-widget li {
		list-style: none;
		padding: 0;
		margin: 0;
		float: left
		}

		.multitab-widget li a {
		background: #22a1c4;
		color: #fff;
		display: block;
		padding: 10px;
		font-size: 13px;
		text-decoration: none
		}

		.multitab-tab {
			/* width: 33.3%; */
			text-align: center
		}

		.multitab-section h2,
		.multitab-section h3,
		.multitab-section h4,
		.multitab-section h5,
		.multitab-section h6 {
			display: none;
		}

		.multitab-widget li a.multitab-widget-current {
			/* padding-bottom: 20px; */
			margin-top: 0px;
			background: #fff;
			color: #444;
			text-decoration: none;
			border-top: 1px solid #22a1c4;
			font-size: 14px;
			text-transform: capitalize;
		}

		#multicolumn-widget-id4 .table1>tbody>tr>td,
		#multicolumn-widget-id5 .table1>tbody>tr>td {
			padding: 4px !important;
			line-height: 1.42857143;
			vertical-align: top;
			border-top: 1px solid #ddd;
		}
	</style>

</head>
<body bgcolor="#ECE9D8">
	<div align="center" style=" margin:0 auto; width:1050px; min-height:620px; overflow:hidden;">
		<div style="float:left; overflow:hidden; width:70%; height:auto;">
			<form name="grid" target="_blank">

				<!-- Date and time section -->
				<div class="row select-date" align="left">
					<div class="col-md-6 form-inline">
						<div class="form-group form-group-sm">
							<label class="control-label">First Date : </label>
							<input class="form-control" name="firstdate" id="firstdate" type="text" style="width:100px;">
							<span>
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
							</span>
						</div>
					</div>
					<div class="col-md-6 form-inline">
						<div class="form-group form-group-sm">
							<label class="control-label">Second Date : </label>
							<input class="form-control" name="seconddate" id="seconddate" type="text" style="width:100px;">
							<span>
								<script language="JavaScript">
									var o_cal = new tcal ({
										// form name
										'formname': 'grid',
										// input name
										'controlname': 'seconddate'
									});

									// individual template parameters can be modified via the calendar variable
									o_cal.a_tpl.yearscroll = false;
									o_cal.a_tpl.weekstart = 6;

								</script>
							</span>
						</div>
					</div>

					<div class="col-md-6 form-inline" style="padding-top:6px">
						<div class="form-group form-group-sm">
							<label class="control-label">First Time : </label>
							<input class="form-control" name="f_time" id="f_time" type="text" style="width:100px;">
						</div>
					</div>
					<div class="col-md-6 form-inline" style="padding-top:6px">
						<div class="form-group form-group-sm">
							<label class="control-label">Second Time : </label>
							<input class="form-control" name="s_time" id="s_time" type="text" style="width:100px;">
						</div>
					</div>
				</div>

				<!-- Category option -->
				<?php
					$this->load->model('common_model');
					$unit = $this->common_model->get_unit_id_name();
				?>
				<div class="row category-option">
					<fieldset>
						<legend>Category Options</legend>
						<div class="row category-fields">
							<div class="col-md-6 form-inline">
								<div class="form-group form-group-sm">
									<label class="control-label">Unit &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp; </label>
									<?php
										$this->load->model('common_model');
										$unit = $this->common_model->get_unit_id_name();
										$units = $unit->result();
									?>
									<select class="form-control" name='grid_start' id='grid_start' style="width:250px;" onchange='grid_get_all_data()' />
										<option value='Select'>	Select	</option>
										<?php foreach($unit->result() as $rows) { ?>
												<option value="<?php echo $rows->unit_id; ?>"><?php echo $rows->unit_name; ?></option>
										<?php } ?>
									</select>
								</div>
							</div>
							<div class="col-md-6 form-inline">
								<div class="form-group form-group-sm">
									<label class="control-label">Dept. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp; </label>
									<select class="form-control" id='grid_dept' name='grid_dept' style="width:250px;" onChange="grid_all_search()"><option value=''></option></select>
								</div>
							</div>

							<div class="col-md-6 form-inline" style="padding-top:6px">
								<div class="form-group form-group-sm">
									<label class="control-label">Section &nbsp;:&nbsp; </label>
									<select class="form-control" id='grid_section' name='grid_section' style="width:250px;" onChange="grid_all_search()"><option value=''></option></select>
								</div>
							</div>
							<div class="col-md-6 form-inline" style="padding-top:6px">
								<div class="form-group form-group-sm">
									<label class="control-label">Line &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp; </label>
									<select class="form-control" id='grid_line' name='grid_line' style="width:250px;" onChange="grid_all_search()"><option value=''></option></select>
								</div>
							</div>

							<div class="col-md-6 form-inline" style="padding-top:6px">
								<div class="form-group form-group-sm">
									<label class="control-label">Desig. &nbsp;&nbsp;&nbsp;:&nbsp;</label>
									<select class="form-control" id='grid_desig' name='grid_desig' style="width:250px;" onChange="grid_all_search()"><option value=''></option></select>
								</div>
							</div>
							<div class="col-md-6 form-inline" style="padding-top:6px">
								<div class="form-group form-group-sm">
									<label class="control-label">Sex &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : &nbsp;</label>
									<select class="form-control" id='grid_sex' name='grid_sex' style="width:250px;" onChange="grid_all_search()"><option value=''></option></select></select>
								</div>
							</div>

							<div class="col-md-6 form-inline" style="padding-top:6px; padding-bottom:10px">
								<div class="form-group form-group-sm">
									<label class="control-label">Status &nbsp;&nbsp;&nbsp;:&nbsp; </label>
									<select class="form-control" id='grid_status' name='grid_status' style="width:250px;" onChange="grid_all_search()"><option value=''></option></select>
								</div>
							</div>
							<div class="col-md-6 form-inline" style="padding-top:6px; padding-bottom:10px">
								<div class="form-group form-group-sm">
									<label class="control-label">Position :&nbsp; </label>
									<select class="form-control" id='grid_position' name='grid_position' style="width:250px;" onChange="grid_all_search()"><option value=''></option></select>
								</div>
							</div>
						</div>
					</fieldset>
				</div>
				<br/>


				<div class="row report-option">
					<div class='multitab-section'>
						<ul class='multitab-widget multitab-widget-content-tabs-id'>
						<li class='multitab-tab'><a href='#multicolumn-widget-id1'>Daily Reports</a></li>
						<li class='multitab-tab'><a href='#multicolumn-widget-id2'>Monthly Reports</a></li>
						<li class='multitab-tab'><a href='#multicolumn-widget-id3'>Continuous Reports</a></li>
						<li class='multitab-tab'><a href='#multicolumn-widget-id4'>Other Reports</a></li>
						<!-- <li class='multitab-tab'><a href='#multicolumn-widget-id5'>Other Reports 2</a></li> -->
						</ul>
						<div class='multitab-widget-content multitab-widget-content-widget-id' id='multicolumn-widget-id1'>
							<table class="table table" width="100%"  style="font-size:11px; ">
								<?php
									$usr_arr = array(3,7,8);
									$usr_arr_2 = array(6);
									$usr_arr_3 = array(11);
									$usr_arr_4 = array(6,11);

									$user_id = $this->acl_model->get_user_id($this->session->userdata('data')->id_number);
									$acl = $this->acl_model->get_acl_list($user_id);
								?>
								<tr>
								<?php if(!in_array($user_id,$usr_arr)){  ?>
								<td style="width:20%;"><input class="btn btn-primary" type="button" style="width:100%; font-size:100%;" value="Daily Present Report" onClick="grid_daily_present_report()"></td>
								<?php } ?>
								<td style="width:20%;"><input class="btn btn-primary" type="button" style="width:100%; font-size:100%;" value="Daily Absent Report" onClick="grid_daily_absent_report()"></td>
								<td style="width:20%;"><input class="btn btn-primary" type="button" style="width:100%; font-size:100%;" value="Daily Leave Report" onClick="grid_daily_leave_report()"></td>
								<td style="width:20%;"><input class="btn btn-primary" type="button" style="width:100%; font-size:100%;" value="Daily Late Report" onClick="grid_daily_late_report()"></td>
								</tr>
								<tr>
								<td style="width:20%;"><input class="btn btn-primary" type="button" style="width:100%; font-size:100%;" value="Daily OT" onClick="grid_daily_ot()"></td>
								<?php if(!in_array($user_id,$usr_arr_2)){  ?>
								<?php if(!in_array($user_id,$usr_arr_3)){  ?>
								<td style="width:20%;"><input class="btn btn-primary" type="button" style="width:100%; font-size:100%;" value="Out & IN Report" onClick="grid_daily_out_in_report()"></td>
								<?php } ?>
								<?php } ?>

								<?php if(!in_array(10,$acl)){ ?>
								<?php if(!in_array(14,$acl)){ ?>
								<td style="width:20%;"><input class="btn btn-primary" type="button" style="width:100%; font-size:100%;" value="Daily Out Punch Miss" onClick="grid_daily_out_punch_miss_report()"></td>
								<td style="width:20%; background-color: #666666;"><input class="btn btn-primary" type="button" style="width:100%; font-size:100%;" value="Daily Costing" onClick="daily_costing_report()"></td>
								<?PHP } ?>
								<?PHP } ?>
								<!-- <td style="width:20%;"><input class="btn btn-primary" type="button" style="width:100%; font-size:100%;" value="Daily Movement Report" onClick="grid_daily_move_report()"></td> -->
								</tr>

								<?php if(!in_array(10,$acl)){ ?>
								<?php if(!in_array(14,$acl)){ ?>
								<tr>
								<td style="width:20%; background-color: #666666;"><input class="btn btn-primary" type="button" style="width:100%; font-size:100%;" value="Daily EOT" onClick="grid_daily_eot()"></td>
								<td style="width:20%; background-color: #666666;"><input class="btn btn-primary" type="button" style="width:100%; font-size:100%;" value="Actual Present Report" onClick="grid_actual_present_report()"></td>
								<!-- <td style="width:20%; background-color: #666666;"><input class="btn btn-primary" type="button" style="width:100%; font-size:100%;" value="Daily Allowance" onClick="grid_daily_allowance_bills()"></td> -->
								<td style="width:20%; background-color: #666666;"><input class="btn btn-primary" type="button" style="width:100%; font-size:100%;" value="Actual Out & IN Report" onClick="grid_daily_actual_out_in_report()"></td>
								<td style="width:20%; background-color: #666666;"><input class="btn btn-primary" type="button" style="width:100%; font-size:100%;" value="Holiday / Weekend Absent" onClick="grid_daily_holiday_weekend_absent_report()"></td>
								</tr>
								<?php } ?>
								<?php } ?>

								<tr>
								<!-- <td style="width:20%; background-color: #666666;"><input class="btn btn-primary" type="button" style="width:100%; font-size:100%;" value="Daily Night Allowance" onClick="grid_daily_night_allowance_report()"></td> -->
								<?php if(!in_array(10,$acl)){ ?>
								<?php if(!in_array(14,$acl)){ ?>
								<!-- <td style="width:20%; background-color: #666666;"><input class="btn btn-primary" type="button" style="width:100%; font-size:100%;" value="Daily Costing" onClick="daily_costing_report()"></td> -->

								<td style="width:20%; background-color: #666666;"><input class="btn btn-primary" type="button" style="width:100%; font-size:100%;" value="Holiday / Weekend Present" onClick="grid_daily_holiday_weekend_present_report()"></td>

								<!-- <td style="width:20%; background-color: #666666;"><input class="btn btn-primary" type="button" style="width:100%; font-size:100%;" value="Holiday / Weekend Absent" onClick="grid_daily_holiday_weekend_absent_report()"></td> -->
								<?php } ?>
								<?php } ?>
									<!-- td style="width:20%; background-color: #666666;"><input class="btn btn-primary" type="button" style="width:100%; font-size:100%;" value="Weekend Allowance Sheet" onClick="grid_daily_weekend_allowance_sheet()"></td> -->

									<!-- <td style="width:20%; background-color: #666666;"><input class="btn btn-primary" type="button" style="width:100%; font-size:100%;" value="Holiday Allowance Sheet" onClick="grid_daily_holiday_allowance_sheet()"></td> -->
								</tr>
							</table>
						</div>

						<?php if(!in_array($user_id,$usr_arr)){  ?>
						<div class='multitab-widget-content multitab-widget-content-widget-id' id='multicolumn-widget-id2'>
							<table class="table" width="75%"  style="font-size:11px; float: left;">
								<tr >

								<td style="width:20%;"><input class="btn btn-primary" type="button" style=" width:100%; font-size:100%;" value="Attendance Register" onClick="grid_monthly_att_register_ot()"></td>
								<td style="width:20%;"><input class="btn btn-primary" type="button" style=" width:100%; font-size:100%;" value="OT Register" onClick="grid_monthly_ot_register()"></td>

								<?php if(!in_array(10,$acl)){ ?>
								<?php if(!in_array(10,$acl)){ ?>

								<td style="width:20%; background-color: #666666;">
								<input class="btn btn-primary" type="button" style=" width:100%; font-size:100%; " value="EOT Register" onClick="grid_monthly_eot_register()">
								<?php
								$register = 1;
								$register_blank = 2;
								$register_blank_without_name = 3;
								?>
								<td style="width:20%; background-color: #666666;">
									<input class="btn btn-primary" type="button" style=" width:100%; font-size:100%;" value="Attendance Register" onClick="grid_monthly_att_register(<?php echo $register;?>)">
								</td>
								<?php } ?>
								<?php } ?>
								<!-- <td style="width:20%; background-color: #666666;">
									<input class="btn btn-primary" type="button" style=" width:100%; font-size:100%;" value="Attendance Register Blank" onClick="grid_monthly_att_register(<?php echo $register_blank;?>)">
								</td> -->
								</tr>

								<!-- <tr>
									<td style="width:20%; background-color: #666666;">
									<input class="btn btn-primary" type="button" style=" width:100%; font-size:100%;" value="Register Blank Without Name" onClick="grid_monthly_att_register(<?php echo $register_blank_without_name;?>)">
								</td>
								</tr> -->
							</table>
						</div>

						<div class='-content multitab-widget-content-widget-id' id='multicolumn-widget-id3'>
							<table class="table" width="100%"  style="font-size:11px; ">
								<tr>
								<td style="width:20%;"><input class="btn btn-primary" type="button" style="width:100%; font-size:100%;" value="Present Report" onClick="grid_continuous_present_report()"></td>
								<td style="width:20%;"><input class="btn btn-primary" type="button" style="width:100%; font-size:100%;" value="Absent Report" onClick="grid_continuous_absent_report()"></td>
								<td style="width:20%;"><input class="btn btn-primary" type="button" style="width:100%; font-size:100%;" value="Leave Report" onClick="grid_continuous_leave_report_new()"></td>
								<td style="width:20%;"><input class="btn btn-primary" type="button" style="width:100%; font-size:100%;" value="Late Report" onClick="grid_continuous_late_report()"></td>
								<!-- <td style="width:20%;"><input class="btn btn-primary" type="button" style="width:100%; font-size:100%;" value="Leave Report (OLD)" onClick="grid_continuous_leave_report_old()"></td> -->
								</tr>

								<tr>
								<td style="width:20%;"><input class="btn btn-primary" type="button" style=" width:100%; font-size:100%;"  value="Increment Report" onClick="grid_continuous_incre_report()"></td>
								<td style="width:20%;"><input class="btn btn-primary" type="button" style=" width:100%; font-size:100%;"  value="Promotion Report" onClick="grid_continuous_prom_report()"></td>
								<!-- <td style="width:20%;"><input class="btn btn-primary" type="button" style="width:100%; font-size:100%;" value="Increment/Promotion Propsal" onClick="grid_continuous_increment_promotion_proposal()"></td> -->
								<!-- </tr> -->

								<?php if(!in_array(10,$acl)){ ?>
								<?php if(!in_array(14,$acl)){ ?>

								<!-- <tr> -->

								<td style="width:20%; background-color:#666666;"><input class="btn btn-primary" type="button" style=" width:100%; font-size:100%;"  value="OT / EOT Report" onClick="grid_continuous_ot_eot_report()"></td>
								<td style="width:20%; background-color:#666666;"><input class="btn btn-primary" type="button" style="width:100%; font-size:100%;" value="Continuous Costing Report" onClick="grid_continuous_costing_report()"></td>
								<!-- <td style="width:20%;"></td>
								<td style="width:20%;"></td> -->

								</tr>

								<?php } ?>
								<?php } ?>

								<tr>
									<td style="width:20%;"><input class="btn btn-primary" type="button" style=" width:100%; font-size:100%;"  value="Absent three" onClick="grid_continuous_report_limit(3)"></td>
									<td style="width:20%;"><input class="btn btn-primary" type="button" style=" width:100%; font-size:100%;"  value="Absent ten" onClick="grid_continuous_report_limit(10)"></td>
								</tr>

							</table>
						</div>
						<?php } ?>

						<div class='-content multitab-widget-content-widget-id' id='multicolumn-widget-id4'>
							<table class="table table1"  style="font-size:11px; ">
								<tr>
								<td style="width:20%;"><input class="btn btn-primary" type="button" style="width:100%; font-size:100%;" value="App. Letter" onClick="grid_app_letter()"></td>
								<td style="width:20%;"><input class="btn btn-primary" type="button" style="width:100%; font-size:100%;" value="ID Card Bangla" onClick="grid_id_card()"></td>
								<td style="width:20%;"><input class="btn btn-primary" type="button" style="width:100%; font-size:100%;" value="ID Card English" onClick="grid_id_card_english()"></td>
								<?php
								if(!in_array($user_id,$usr_arr_3)){  ?>
								<?php if(!in_array($user_id,$usr_arr)){ ?>
								<td style="width:20%;"><input class="btn btn-primary" type="button" style="width:100%; font-size:100%;" value="Job Card" onClick="grid_job_card()"></td>
								<?php } ?>
								<?php } ?>
								</tr>
								<tr>
								<td style="width:20%;"><input class="btn btn-primary" type="button" style="width:100%; font-size:100%;" value="New Join Report" onClick="grid_new_join_report()"></td>

								<?php if(!in_array($user_id,$usr_arr)){  ?>
								<td style="width:20%;"><input class="btn btn-primary" type="button" style="width:100%; font-size:100%;" value="Resign Report" onClick="grid_resign_report()"></td>
								<td style="width:20%;"><input class="btn btn-primary" type="button" style="width:100%; font-size:100%;" value="Left Report" onClick="grid_left_report()"></td>
								<?php } ?>
								<td style="width:20%;"><input class="btn btn-primary" type="button" style="width:100%; font-size:100%;" value="General Report" onClick="grid_general_info()"></td>
								

								<!-- <td style="width:20%;"><input class="btn btn-primary" type="button" style="width:100%; font-size:100%;" value="BGM Current Report" onClick="grid_current_info()"></td> -->
								</tr>
								<tr>
								<?php if(!in_array($user_id,$usr_arr)){  ?>
								<!-- <td style="width:20%;"><input class="btn btn-primary" type="button" style="width:100%; font-size:100%;" value="BGM New Join Report" onClick="grid_bgm_new_join_report()"></td> -->

								<!-- <td style="width:20%;"><input class="btn btn-primary" type="button" style="width:100%; font-size:100%;" value="Leave Application" onClick="grid_leave_application_form()"></td> -->
								<td style="width:20%;"><input class="btn btn-primary" type="button" style="width:100%; font-size:100%;" value="Earn Leave Report" onClick="grid_earn_leave()"></td>
								
								<td style="width:20%;"><input class="btn btn-primary" type="button" style="width:100%; font-size:100%;" value="Leave Register" onClick="grid_yearly_leave_register()"></td>
								<td style="width:20%;"><input class="btn btn-primary" type="button" style="width:100%; font-size:100%;" value="Job Application" onClick="grid_emp_job_application()"></input></td>
								<td style="width:20%;">
								<input class="btn btn-primary" type="button" style="width:100%; font-size:100%;" value="Joining Letter" onClick="join_letter()"></input>
								</td>

								</tr>
								<tr>
								<!-- <td style="width:20%;"><input class="btn btn-primary" type="button" style="width:100%; font-size:100%;" value="BGM Resign Report" onClick="grid_bgm_resign_report()"></td> -->
								<!-- <td style="width:20%;"><input class="btn btn-primary" type="button" style="width:100%; font-size:100%;" value="BGM Left Report" onClick="grid_bgm_left_report()"></td> -->

								<!-- <td style="width:20%;"><input class="btn btn-primary" type="button" style="width:100%; font-size:100%;" value="BGM Left Resign Report" onClick="grid_bgm_left_resign_report()"></td> -->

								</tr>
								<tr>
									<td style="width:20%;"><input class="btn btn-primary" type="button" style="width:100%; font-size:100%;" value="Letter 1" onClick="grid_letter1_report()"></td>
									<td style="width:20%;"><input class="btn btn-primary" type="button" style="width:100%; font-size:100%;" value="Letter 2" onClick="grid_letter2_report()"></td>
									<td style="width:20%;"><input class="btn btn-primary" type="button" style="width:100%; font-size:100%;" value="Letter 3" onClick="grid_letter3_report()"></td>
									<?php } ?>
									<td style="width:20%;"><input class="btn btn-primary" type="button" style="width:100%; font-size:100%;" value="Employee Information" onClick="grid_employee_information()"></td>
									<?php if(!in_array($user_id,$usr_arr)){  ?>
								<?php } ?>
								</tr>

								<tr>
								<td style="width:20%;">
									<input class="btn btn-primary" type="button" style="width:100%; font-size:100%;" value="Nominee From" onClick="grid_nominee()">
								</td>

								<?php if(!in_array($user_id,$usr_arr)){  ?>
									<td style="width:20%;"><input class="btn btn-primary" type="button" style="width:100%; font-size:100%;" value="Increment Letter" onClick="grid_incre_prom_report()"></td>
									<td style="width:20%;"><input class="btn btn-primary" type="button" style="width:100%; font-size:100%;" value="Promotion Letter" onClick="grid_prom_report()"></td>
										<?php } ?>
									<td style="width:20%;">
									<input class="btn btn-primary" type="button" style="width:100%; font-size:100%;" value="Service Book" onClick="grid_service_book()"></td>
								</tr>
								<tr>
								
								<td style="width:20%;">
									<input class="btn btn-primary" type="button" style="width:100%; font-size:100%;" value="Age estimation" onClick="grid_age_estimation()">
								</td>
								<?php if(!in_array(10,$acl)){ ?>
								<?php if(!in_array(14,$acl)){ ?>
								<td style="width:20%; background-color:#666666;">
									<input class="btn btn-primary" type="button" style="width:100%; font-size:100%;" value="EOT Job Card" onClick="grid_extra_ot()">
								</td>
								<?php } ?>
								<?php } ?>
								
								<?php if(!in_array(10,$acl)){ ?>
								<?php if(!in_array(14,$acl)){ ?>
								<td style="width:20%; background-color:#666666;">
									<input class="btn btn-primary" type="button" style="width:100%; font-size:100%;" value="EOT Job Card 9pm" onClick="grid_extra_ot_9pm()">
								</td>
								<?php } ?>
								<?php } ?>

								<!-- <td style="width:20%;"><input class="btn btn-primary" type="button" style="width:100%; font-size:100%;" value="Letter 1" onClick="grid_letter1_report()"></td> -->

								</tr>
							</table>
						</div>
					</div>
				</div>

			</form>
		</div>

		<div style="float:right; width: 30%;">
			<table class="table" id="list1" style="font-family: 'Times New Roman', Times, serif; font-size:12px;"><tr><td></td></tr></table>
		</div>
		<!--<div id="pager1"></div>-->
		<div id="viewid"></div>
		<div class="clearfix" style="display:none;">
			<div class="loading" style="text-align-last: center;"><img src="<?php echo base_url() ?>img/load.gif"  alt="Load"/></div>
			<div style="margin-top:50px; text-align-last: center;"> Processing Please Wait..... </div>
		</div>
	</div>

<!-- tabs js -->
	<script>
		jQuery(document).ready(function($){
			$(".multitab-widget-content-widget-id").hide();
			$("ul.multitab-widget-content-tabs-id li:first a").addClass("multitab-widget-current").show();
			$(".multitab-widget-content-widget-id:first").show();

			$("ul.multitab-widget-content-tabs-id li a").click(function() {
				$("ul.multitab-widget-content-tabs-id li a").removeClass("multitab-widget-current a");
				$(this).addClass("multitab-widget-current");
				$(".multitab-widget-content-widget-id").hide();
				var activeTab = $(this).attr("href");
				$(activeTab).fadeIn();
				return false;
			});
		});
	</script>
</body>
</html>


