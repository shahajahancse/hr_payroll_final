<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>HR Reports</title>

    <link rel="stylesheet" type="text/css" media="screen"
        href="<?php echo base_url(); ?>themes/redmond/jquery-ui-1.8.2.custom.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>themes/ui.jqgrid.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>css/calendar.css" />

    <script src="<?php echo base_url(); ?>js/jquery.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>js/jquery-ui-1.8.23.custom.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>js/i18n/grid.locale-en.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>js/jquery.jqGrid.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>js/grid_content.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>js/calendar_eu.js" type="text/javascript"></script>
    <script>
    $(function() {
        $(".clearfix").dialog({
            autoOpen: false,
            height: 370,
            width: 300,
            resizable: false,
            modal: true
        });
        $(".ui-dialog-titlebar").hide();
    });
    </script>

</head>

<body bgcolor="#ECE9D8">
    <div align="center" style=" margin:0 auto; width:1000px; min-height:555px; overflow:hidden;">
        <div style="float:left; overflow:hidden; width:65%; height:auto; padding:10px;">
            <form name="grid" target="_blank">
                <div>

                    <fieldset style='width:95%;'>
                        <legend>
                            <font size='+1'><b>Date</b></font>
                        </legend>
                        <table>
                            <tr>
                                <td>First Date </td>
                                <td>:</td>
                                <td> <input type="text" name="firstdate" id="firstdate" style="width:100px;" /></td>
                                <td>
                                    <script language="JavaScript">
                                    var o_cal = new tcal({
                                        // form name
                                        'formname': 'grid',
                                        // input name
                                        'controlname': 'firstdate'
                                    });

                                    // individual template parameters can be modified via the calendar variable
                                    o_cal.a_tpl.yearscroll = false;
                                    o_cal.a_tpl.weekstart = 6;
                                    </script>
                                </td>
                                <td>TO Second Date</td>
                                <td>:</td>
                                <td> <input type="text" name="seconddate" id="seconddate" style="width:100px;" /></td>
                                <td>
                                    <script language="JavaScript">
                                    var o_cal = new tcal({
                                        // form name
                                        'formname': 'grid',
                                        // input name
                                        'controlname': 'seconddate'
                                    });

                                    // individual template parameters can be modified via the calendar variable
                                    o_cal.a_tpl.yearscroll = false;
                                    o_cal.a_tpl.weekstart = 6;
                                    </script>
                                </td>
                            </tr>
                            <tr>
                                <td>First Time</td>
                                <td>:</td>
                                <td> <input name="f_time" id="f_time" style="width:100px;" /> </td>
                                <td></td>
                                <td>TO Second Time</td>
                                <td>:</td>
                                <td> <input name="s_time" id="s_time" style="width:100px;" /></td>
                                <td></td>
                            </tr>
                        </table>

                    </fieldset>
                </div>
                <br />
                <?php
		$this->load->model('common_model');
		$unit = $this->common_model->get_unit_id_name();
		foreach ($unit->result() as $row) {
		 	$unit_id = $row->unit_id;
		 }
	?>
                <div>
                    <fieldset style='width:95%;'>
                        <legend>
                            <font size='+1'><b>Category Options</b></font>
                        </legend>
                        <table>
                            <tr>
                                <td>Unit</td>
                                <td>:</td>
                                <td><select name='grid_start' id='grid_start' style="width:250px;"
                                        onchange='grid_get_all_data()' />
                                    <option value='Select'> Select </option>
                                    <?php foreach($unit->result() as $rows) { ?>
                                    <option value="<?php echo $rows->unit_id; ?>"><?php echo $rows->unit_name; ?>
                                    </option>
                                    <?php } ?>
                                    </select>
                                </td>
                                <td>Dept. </td>
                                <td>:</td>
                                <td><select id='grid_dept' name='grid_dept' style="width:250px;"
                                        onChange="grid_all_search()">
                                        <option value=''></option>
                                    </select></td>
                            </tr>
                            <tr>
                                <td>Section </td>
                                <td>:</td>
                                <td><select id='grid_section' name='grid_section' style="width:250px;"
                                        onChange="grid_all_search()">
                                        <option value=''></option>
                                    </select></td>
                                <td>Line </td>
                                <td>:</td>
                                <td><select id='grid_line' name='grid_line' style="width:250px;"
                                        onChange="grid_all_search()">
                                        <option value=''></option>
                                    </select></td>
                            </tr>
                            <tr>
                                <td>Desig. </td>
                                <td>:</td>
                                <td><select id='grid_desig' name='grid_desig' style="width:250px;"
                                        onChange="grid_all_search()">
                                        <option value=''></option>
                                    </select></td>
                                <td>Sex </td>
                                <td>:</td>
                                <td><select id='grid_sex' name='grid_sex' style="width:250px;"
                                        onChange="grid_all_search()">
                                        <option value=''></option>
                                    </select></select></td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>:</td>
                                <td><select id='grid_status' name='grid_status' style="width:250px;"
                                        onChange="grid_all_search()">
                                        <option value=''></option>
                                    </select></td>

                                <!--<td>Gen. Rpt</td><td>:</td><td><select id='general_report' name='general_report' style="width:250px;"><option value='1'>With Image</option><option value='2'>Without Image</option></select></td>-->
                            </tr>
                        </table>
                    </fieldset>
                </div>
                <div>
                    <br />
                    <fieldset style='width:95%;'>
                        <legend>
                            <font size='+1'><b>Daily Reports</b></font>
                        </legend>
                        <table width="100%" style="font-size:11px; ">
                            <tr>
                                <td style="width:20%;"><input type="button" style="width:100%; font-size:100%;"
                                        value="Daily Present Report" onClick="grid_daily_present_report()"></td>
                                <td style="width:20%;"><input type="button" style="width:100%; font-size:100%;"
                                        value="Daily Absent Report" onClick="grid_daily_absent_report()"></td>
                                <td style="width:20%;"><input type="button" style="width:100%; font-size:100%;"
                                        value="Daily Leave Report" onClick="grid_daily_leave_report()"></td>
                                <td style="width:20%;"><input type="button" style="width:100%; font-size:100%;"
                                        value="Daily Late Report" onClick="grid_daily_late_report()"></td>
                            </tr>
                            <tr>
                                <td style="width:20%;"><input type="button" style="width:100%; font-size:100%;"
                                        value="Daily OT" onClick="grid_daily_ot()"></td>

                                <td style="width:20%;"><input type="button" style="width:100%; font-size:100%;"
                                        value="Out & IN Report" onClick="grid_daily_out_in_report()"></td>
                                <?php
$user_id = $this->acl_model->get_user_id($this->session->userdata('username'));
$acl     = $this->acl_model->get_acl_list($user_id);
$name = $this->session->userdata('username');
//print_r($acl);
if(!in_array(10,$acl)){ ?>
                                <td style="width:20%; background-color: #666666;"><input type="button"
                                        style="width:100%; font-size:100%;" value="Daily Out Punch Miss"
                                        onClick="grid_daily_out_punch_miss_report()"></td>
                                <td style="width:20%; background-color: #666666;"><input type="button"
                                        style="width:100%; font-size:100%;" value="Daily Movement Report"
                                        onClick="grid_daily_move_report()"></td>
                            </tr>

                            <tr>
                                <td style="width:20%; background-color: #666666;"><input type="button"
                                        style="width:100%; font-size:100%;" value="Daily EOT"
                                        onClick="grid_daily_eot()"></td>
                                <td style="width:20%; background-color: #666666;"><input type="button"
                                        style="width:100%; font-size:100%;" value="Actual Present Report"
                                        onClick="grid_actual_present_report()"></td>
                                <td style="width:20%; background-color: #666666;"><input type="button"
                                        style="width:100%; font-size:100%;" value="Daily Allowance"
                                        onClick="grid_daily_allowance_bills()"></td>
                                <td style="width:20%; background-color: #666666;"><input type="button"
                                        style="width:100%; font-size:100%;" value="Actual Out & IN Report"
                                        onClick="grid_daily_actual_out_in_report()"></td>
                            </tr>

                            <tr>
                                <td style="width:20%; background-color: #666666;"><input type="button"
                                        style="width:100%; font-size:100%;" value="Daily Night Allowance"
                                        onClick="grid_daily_night_allowance_report()"></td>
                                <?php if(!in_array(14,$acl)){ ?>
                                <td style="width:20%; background-color: #6CC;"><input type="button"
                                        style="width:100%; font-size:100%;" value="Daily Costing"
                                        onClick="daily_costing_report()"></td>

                                <td style="width:20%; background-color: #6CC;"><input type="button"
                                        style="width:100%; font-size:100%;" value="Holiday / Weekend Present"
                                        onClick="grid_daily_holiday_weekend_present_report()"></td>

                                <td style="width:20%; background-color: #6CC;"><input type="button"
                                        style="width:100%; font-size:100%;" value="Holiday / Weekend Absent"
                                        onClick="grid_daily_holiday_weekend_absent_report()"></td>
                                <?php } ?>
                            </tr>
                            <?php } ?>
                        </table>

                    </fieldset>
                    <br />

                    <fieldset style='width:95%;'>
                        <legend>
                            <font size='+1'><b>Monthly Reports</b></font>
                        </legend>
                        <table width="75%" style="font-size:11px; float: left;">
                            <tr>

                                <td style="width:20%;"><input type="button" style=" width:100%; font-size:100%;"
                                        value="Attendance Register" onClick="grid_monthly_att_register_ot()"></td>
                                <td style="width:20%;"><input type="button" style=" width:100%; font-size:100%;"
                                        value="OT Register" onClick="grid_monthly_ot_register()"></td>

                                <?php if(!in_array(10,$acl)){ ?>

                                <td style="width:20%; background-color: #666666;">
                                    <input type="button" style=" width:100%; font-size:100%; " value="EOT Register"
                                        onClick="grid_monthly_eot_register()">
                                </td>
                                <!--<td style="width:20%; background-color: #666666;">
 <input type="button" style=" width:100%; font-size:100%; " value="EOT Register New" onClick="grid_monthly_eot_register_new()">
 </td>-->
                                <td style="width:20%; background-color: #666666;">
                                    <input type="button" style=" width:100%; font-size:100%;"
                                        value="Attendance Register" onClick="grid_monthly_att_register()">
                                </td>
                                </td>
                                <?php } ?>

                            </tr>

                            <tr>
                                <?php if(!in_array(10,$acl) AND in_array(15,$acl)){ ?>
                                <td style="width:20%; background-color:#666666;">
                                    <input type="button" style="width:100%; font-size:100%;" value="EOT Register New"
                                        onClick="grid_monthly_eot_register_new()">
                                </td>
                                <?php } ?>

                                <!-- <?php if($unit_id=='1') { ?>
	<?php if($name == 'AJ4-HR'){ ?>
	   <td style="width:20%; background-color:#666666;">
	   <input type="button" style="width:100%; font-size:100%;" value="EOT Register New" onClick="grid_monthly_eot_register_new()">
	  </td>
	 <?php  } else { ?>
	   <td style="width:20%; background-color:#666666;display: none">
	      <input type="button" style="width:100%; font-size:100%;" value="Araf Card" onClick="grid_extra_ot_new()">
	  </td>
  <?php  } } ?>

   <?php if($unit_id=='2') { ?>
	<?php if($name == 'lssumon'){ ?>

	   <td style="width:20%; background-color:#666666;">
	   <input type="button" style="width:100%; font-size:100%;" value="EOT Register New" onClick="grid_monthly_eot_register_new()">
	  </td>
	 <?php  } else { ?>
	   <td style="width:20%; background-color:#666666;display: none">
	      <input type="button" style="width:100%; font-size:100%;" value="Araf Card" onClick="grid_extra_ot_new()">
	  </td>
  <?php  } } ?>

   <?php if($unit_id=='3') { ?>
	<?php if($name =='NI4-HR'){ ?>
	  <td style="width:20%; background-color:#666666;">
	   <input type="button" style="width:100%; font-size:100%;" value="EOT Register New" onClick="grid_monthly_eot_register_new()">
	  </td>
	 <?php  } else { ?>
	   <td style="width:20%; background-color:#666666;display: none">
	      <input type="button" style="width:100%; font-size:100%;" value="Araf Card" onClick="grid_extra_ot_new()">
	  </td>
  <?php  } } ?> -->

                            </tr>
                        </table>

                    </fieldset>
                    <br />

                    <fieldset style='width:95%;'>
                        <legend>
                            <font size='+1'><b>Continuous Reports</b></font>
                        </legend>
                        <table width="100%" style="font-size:11px; ">
                            <tr>
                                <td style="width:20%;"><input type="button" style="width:100%; font-size:100%;"
                                        value="Present Report" onClick="grid_continuous_present_report()"></td>
                                <td style="width:20%;"><input type="button" style="width:100%; font-size:100%;"
                                        value="Absent Report" onClick="grid_continuous_absent_report()"></td>
                                <td style="width:20%;"><input type="button" style="width:100%; font-size:100%;"
                                        value="Leave Report" onClick="grid_continuous_leave_report()"></td>
                                <td style="width:20%;"><input type="button" style="width:100%; font-size:100%;"
                                        value="Leave Report (OLD)" onClick="grid_continuous_leave_report_old()"></td>
                            </tr>
                            <tr>
                                <td style="width:20%;"><input type="button" style="width:100%; font-size:100%;"
                                        value="Late Report" onClick="grid_continuous_late_report()"></td>
                                <td style="width:20%;"><input type="button" style=" width:100%; font-size:100%;"
                                        value="Increment Report" onClick="grid_continuous_incre_report()"></td>
                                <td style="width:20%;"><input type="button" style=" width:100%; font-size:100%;"
                                        value="Promotion Report" onClick="grid_continuous_prom_report()"></td>
                                <td style="width:20%;"><input type="button" style="width:100%; font-size:100%;"
                                        value="Increment/Promotion Propsal"
                                        onClick="grid_continuous_increment_promotion_proposal()"></td>
                            </tr>

                            <?php if(!in_array(10,$acl)){ ?>
                            <?php if(!in_array(14,$acl)){ ?>

                            <tr>

                                <td style="width:20%; background-color: #6CC;"><input type="button"
                                        style=" width:100%; font-size:100%;" value="OT / EOT Report"
                                        onClick="grid_continuous_ot_eot_report()"></td>
                                <td style="width:20%; background-color: #6CC;"><input type="button"
                                        style="width:100%; font-size:100%;" value="Continuous Costing Report"
                                        onClick="grid_continuous_costing_report()"></td>
                                <td style="width:20%;"></td>
                                <td style="width:20%;"></td>

                            </tr>
                            <?php } ?>
                            <?php } ?>

                        </table>

                    </fieldset>

                    <br />
                    <fieldset style='width:95%;'>
                        <legend>
                            <font size='+1'><b>Other Reports</b></font>
                        </legend>
                        <table width="100%" style="font-size:11px; ">
                            <tr>
                                <td style="width:20%;"><input type="button" style="width:100%; font-size:100%;"
                                        value="App. Latter" onClick="grid_app_letter()"></td>
                                <td style="width:20%;"><input type="button" style="width:100%; font-size:100%;"
                                        value="ID Card Bangla" onClick="grid_id_card()"></td>
                                <td style="width:20%;"><input type="button" style="width:100%; font-size:100%;"
                                        value="ID Card English" onClick="grid_id_card_english()"></td>
                                <td style="width:20%;"><input type="button" style="width:100%; font-size:100%;"
                                        value="Job Card" onClick="grid_job_card()"></td>
                            </tr>
                            <tr>
                                <td style="width:20%;"><input type="button" style="width:100%; font-size:100%;"
                                        value="New Join Report" onClick="grid_new_join_report()"></td>
                                <td style="width:20%;"><input type="button" style="width:100%; font-size:100%;"
                                        value="Resign Report" onClick="grid_resign_report()"></td>
                                <td style="width:20%;"><input type="button" style="width:100%; font-size:100%;"
                                        value="Left Report" onClick="grid_left_report()"></td>
                                <td style="width:20%;"><input type="button" style="width:100%; font-size:100%;"
                                        value="BGM Current Report" onClick="grid_current_info()"></td>
                            </tr>

                            <tr>
                                <td style="width:20%;"><input type="button" style="width:100%; font-size:100%;"
                                        value="BGM New Join Report" onClick="grid_bgm_new_join_report()"></td>

                                <td style="width:20%;"><input type="button" style="width:100%; font-size:100%;"
                                        value="Leave Application" onClick="grid_leave_application_form()"></td>
                                <td style="width:20%;"><input type="button" style="width:100%; font-size:100%;"
                                        value="Earn Leave Report" onClick="grid_earn_leave()"></td>
                                <td style="width:20%;"><input type="button" style="width:100%; font-size:100%;"
                                        value="General Report" onClick="grid_general_info()"></td>

                            </tr>
                            <tr>
                                <td style="width:20%;"><input type="button" style="width:100%; font-size:100%;"
                                        value="BGM Resign Report" onClick="grid_bgm_resign_report()"></td>
                                <td style="width:20%;"><input type="button" style="width:100%; font-size:100%;"
                                        value="BGM Left Report" onClick="grid_bgm_left_report()"></td>

                                <td style="width:20%;"><input type="button" style="width:100%; font-size:100%;"
                                        value="BGM Left Resign Report" onClick="grid_bgm_left_resign_report()"></td>

                                <td style="width:20%;"><input type="button" style="width:100%; font-size:100%;"
                                        value="Letter 1" onClick="grid_letter1_report()"></td>

                            </tr>
                            <tr>
                                <td style="width:20%;"><input type="button" style="width:100%; font-size:100%;"
                                        value="Letter 2" onClick="grid_letter2_report()"></td>
                                <td style="width:20%;"><input type="button" style="width:100%; font-size:100%;"
                                        value="Letter 3" onClick="grid_letter3_report()"></td>
                                <td style="width:20%;"><input type="button" style="width:100%; font-size:100%;"
                                        value="Employee Information" onClick="grid_employee_information()"></td>
                                <td style="width:20%;"><input type="button" style="width:100%; font-size:100%;"
                                        value="Leave Register" onClick="grid_yearly_leave_register()"></td>
                            </tr>

                            <tr>
                                <td style="width:20%;">
                                    <input type="button" style="width:100%; font-size:100%;" value="Service Book"
                                        onClick="grid_service_book()">
                                </td>
                                <?php if(!in_array(10,$acl)){ ?>
                                <td style="width:20%; background-color:#666666;">
                                    <input type="button" style="width:100%; font-size:100%;" value="EOT Job Card"
                                        onClick="grid_extra_ot()">
                                </td>
                                <?php } ?>
                                <?php //if(!in_array(10,$acl) AND in_array(15,$acl)){ ?>
                                <?php if(in_array(15,$acl)){ ?>
                                <td style="width:20%; background-color:#666666;">
                                    <input type="button" style="width:100%; font-size:100%;" value="EOT Job Card New"
                                        onClick="grid_extra_ot_4pm()">
                                </td>
                                <?php } ?>
                                <?php if(in_array(16,$acl)){ ?>
                                <td style="width:20%; background-color:#666666;">
                                    <input type="button" style="width:100%; font-size:100%;" value="EOT Job Card 12AM"
                                        onClick="grid_extra_ot_12am()">
                                </td>
                                <?php } ?>
                                <!-- <?php if($unit_id=='1') { ?>
	<?php if($name =='AJ4-HR'){ ?>
	  <td style="width:20%; background-color:#666666;">
	    <input type="button" style="width:100%; font-size:100%;" value="EOT Job Card New" onClick="grid_extra_ot_4pm()">
	  </td>
	  <td style="width:20%; background-color:#666666;display: none">
	   <input type="button" style="width:100%; font-size:100%;" value="EOT Job Card 12AM" onClick="grid_extra_ot_12am()">
  	  </td>
	 <?php  } else { ?>
       <td style="width:20%; background-color:#666666;display: none">
	       <input type="button" style="width:100%; font-size:100%;" value="EOT Job Card New" onClick="grid_extra_ot_4pm()">
	  </td>
	  <td style="width:20%; background-color:#666666;display: none">
	   <input type="button" style="width:100%; font-size:100%;" value="EOT Job Card 12AM" onClick="grid_extra_ot_12am()">
  	  </td>
  <?php  } } ?>

  <?php if($unit_id=='2') { ?>
	<?php if($name =='lssumon'){ ?>
	   <td style="width:20%; background-color:#666666;">
	    <input type="button" style="width:100%; font-size:100%;" value="EOT Job Card New" onClick="grid_extra_ot_4pm()">
	  </td>
	  <td style="width:20%; background-color:#666666;display: none">
	   <input type="button" style="width:100%; font-size:100%;" value="EOT Job Card 12AM" onClick="grid_extra_ot_12am()">
  	  </td>
	 <?php  } else { ?>

	  <td style="width:20%; background-color:#666666;display: none">
	       <input type="button" style="width:100%; font-size:100%;" value="EOT Job Card New" onClick="grid_extra_ot_4pm()">
	  </td>
	  <td style="width:20%; background-color:#666666;display: none">
	   <input type="button" style="width:100%; font-size:100%;" value="EOT Job Card 12AM" onClick="grid_extra_ot_12am()">
  	  </td>

  <?php  } } ?>

  <?php if($unit_id=='3') { ?>
	<?php if($name =='NI4-HR'){ ?>
	  <td style="width:20%; background-color:#666666;">
	    <input type="button" style="width:100%; font-size:100%;" value="EOT Job Card New" onClick="grid_extra_ot_4pm()">
	  </td>
	  <td style="width:20%; background-color:#666666;display: none">
	   <input type="button" style="width:100%; font-size:100%;" value="EOT Job Card 12AM" onClick="grid_extra_ot_12am()">
  	  </td>
	 <?php  } else { ?>
	   <td style="width:20%; background-color:#666666;display: none">
	       <input type="button" style="width:100%; font-size:100%;" value="EOT Job Card New" onClick="grid_extra_ot_4pm()">
	  </td>
	  <td style="width:20%; background-color:#666666;display: none">
	   <input type="button" style="width:100%; font-size:100%;" value="EOT Job Card 12AM" onClick="grid_extra_ot_12am()">
  	  </td>
  <?php  } } ?>

	<td style="width:20%; background-color:#666666;">
		<input type="button" style="width:100%; font-size:100%;" value="EOT Job Card 12AM" onClick="grid_extra_ot_12am()">
	</td>
 -->
                                <td style="width:20%;"></td>
                                <td style="width:20%;"></td>

                            </tr>

                            <tr>
                                <td style="width:20%;"></td>
                                <td style="width:20%;"></td>
                                <td style="width:20%;"></td>
                            </tr>




                        </table>

                    </fieldset>

                </div>

            </form>

        </div>
        <div style="float:right;">
            <table id="list1" style="font-family: 'Times New Roman', Times, serif; font-size:15px;">
                <tr>
                    <td></td>
                </tr>
            </table>
        </div>
        <!--<div id="pager1"></div>-->

        <div id="viewid"></div>

        <div class="clearfix" style="display:none;">
            <div class="loading"><img src="<?php echo base_url() ?>img/load.gif" alt="Load" /></div>
            <div style="margin-top:50px;"> Processing Please Wait..... </div>
        </div>
    </div>
    </div>
</body>

</html>