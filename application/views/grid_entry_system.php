<div class="content">
	
	<?php 
	// dd($username);
	$this->load->model('common_model');
	$unit = $this->common_model->get_unit_id_name();
	$id   = $this->session->userdata('data');
	$user_id = $this->acl_model->get_user_id($id->id_number);
	$acl     = $this->acl_model->get_acl_list($user_id);

	  $usr_arr = array(3,7,8,77);
	  $usr_arr_2 = array(6,11,77);
	?>
		<form name="grid">
		<div class="form-group">
			<div class="container">
				<div class="col-sm-12 col-md-8">
					<fieldset class="col-xs-12 col-sm-12 col-md-12">
						<legend class="bg-info" align="center"><font size='+1'><b>Date</b></font></legend>
						<div class="col-xs-12 col-sm-6 col-md-6">
							<div class="form-inline">
								<label class="col-md-6">First Date: </label>
								<input class="form-control" type="text" name="firstdate" id="firstdate"/>
								<script class="col-md-2" language="JavaScript">
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
						</div>
						<div class="col-xs-12 col-sm-6 col-md-6">
							<div class="form-inline">
								<label class="col-md-6">Second Date: </label>
								<input  class="form-control" type="text" name="seconddate" id="seconddate"/>
								<script class="col-md-2" language="JavaScript">
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
							</div>
						</div>
					</fieldset>
					<fieldset class="col-xs-12 col-sm-12 col-md-12">
						<legend class="bg-info" align="center"><font size='+1'><b>Category Options</b></font></legend>
						<div class="row">
						<div class="col-xs-12 col-sm-6 col-md-6">
							<div class="form-group">
								<label class="col-md-6">Unit: </label>
								<select  class="form-control" name='grid_start' id='grid_start' onchange='grid_get_all_data_for_entry()'>
				            		<option value='Select'>	Select	</option>
				        				<?php foreach($unit->result() as $rows) { ?>
													<option value="<?= $rows->unit_id?>"><?=$rows->unit_name?></option>
												<?php } ?>
				            	</select>
							</div>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-6">
							<div class="form-group">
								<label class="col-md-6">Department: </label>
								<select  class="form-control" name='grid_dept' id='grid_dept' onchange="grid_all_search()">
				            		<option value=''>	</option>
				            	</select>
							</div>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-6">
							<div class="form-group">
								<label class="col-md-6">Section: </label>
								<select  class="form-control" name='grid_section' id='grid_section' onchange="grid_all_search()">
				            		<option value=''>	</option>
				            	</select>
							</div>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-6">
							<div class="form-group">
								<label class="col-md-6">Line: </label>
								<select  class="form-control" name='grid_line' id='grid_line' onchange="grid_all_search()">
				            		<option value=''>	</option>
				            	</select>
							</div>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-6">
							<div class="form-group">
								<label class="col-md-6">Designation: </label>
								<select  class="form-control" name='grid_desig' id='grid_desig' onchange="grid_all_search()">
				            		<option value=''>	</option>
				            	</select>
							</div>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-6">
							<div class="form-group">
								<label class="col-md-6">Sex: </label>
								<select  class="form-control" name='grid_sex' id='grid_sex' onchange="grid_all_search()">
				            		<option value=''>	</option>
				            	</select>
							</div>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-6">
							<div class="form-group">
								<label class="col-md-6">Status: </label>
								<select  class="form-control" name='grid_status' id='grid_status' onchange="grid_all_search()">
				            		<option value=''>	</option>
				            	</select>
							</div>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-6">
							<div class="form-group">
								<label class="col-md-6">Position: </label>
								<select  class="form-control" name='grid_position' id='grid_position' onchange="grid_all_search()">
				            		<option value=''>	</option>
				            	</select>
							</div>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-6">
							<div class="form-group">
								<label class="col-md-6">Punch Miss: </label>
								<select  class="form-control" name='grid_out_miss' id='grid_out_miss' onchange="grid_all_search_out_miss()">
				            		<option value=''>	</option>
				            	</select>
							</div>
						</div>

						</div>
					</fieldset>
					<!-- Entry Management -->
					<fieldset class="col-xs-12 col-sm-12 col-md-12">
						<legend class="bg-info" align="center"><font size='+1'><b>Attendance</b></font></legend>
						<div class="row">
							<div class="col-xs-12 col-sm-6 col-md-12">
								<div class="form-group">
									<label class="col-md-2">Time: </label>
					            	<input  class="form-control col-mb-2" type='text' name='m_s_time' id='m_s_time' size='16' placeholder="To [HH:MM:SS]"/><br>
					            	<!-- <input  class="form-control col-mb-2" type='text' name='m_e_time' id='m_e_time' size='16' placeholder="From [HH:MM:SS]"/><br> -->
								
					            	<input  class="btn btn-primary" style="position: relative;" type='button' name='btn' id='btn' onclick='manual_attendance_entry()' value='Insert'/>
								</div>
							</div>
						</div>
					</fieldset>
					<?php if(!in_array($user_id,$usr_arr_2)){  ?>
						<fieldset class="col-xs-12 col-sm-12 col-md-12">
							<legend class="bg-info" align="center"><font size='+1'><b>Present to Absent</b></font></legend>
							<div class="row">
								<div class="col-xs-12 col-sm-6 col-md-12">
									<div class="form-group" style="text-align: center;">
										<label class="col-md-4" style="text-align: center;">Action: </label>
						            	<input  class="btn btn-danger mb-2" type='button' onclick='manual_entry_Delete()' value='Delete'/><br>
						            	<span class="col-md-6" style="font-size:12px;">[Select First & Second date and employee ID]</span>
									</div>
								</div>
							</div>
						</fieldset>
					<?php } ?>
				</div>
				<div class="col-md-4">
					<div style="">
						<div >
							<table id="list1" style="font-family: 'Times New Roman', Times, serif; font-size:15px;"><tr><td></td></tr></table>
						</div>
						<div id="viewid"></div>
						<div class="clearfix" style="display:none;">
						    <div class="loading" style="text-align-last: center;"><img src="<?php echo base_url() ?>img/load.gif"  alt="Load"/></div>
						    <div style="margin-top:50px; text-align-last: center;"> Searching Please Wait..... </div>
						</div>
					</div>
				</div>
			</div><!-- End Container -->
		</div>
	</form>
	<div align="center" style=" margin:0 auto; width:1000px; min-height:555px; overflow:hidden;">
		<div style="float:left; overflow:hidden; width:65%; height:auto; padding:10px;">
			<div style="margin:0 auto; width:100%; overflow:hidden;">
				<br />
				<?php
				$usr_arr = array(3,7,8);
				$usr_arr_2 = array(6,11);
				$user_id = $this->acl_model->get_user_id($this->session->userdata('username'));
				$acl = $this->acl_model->get_acl_list($user_id);
				?>
				<fieldset style="width:100%;"><legend><font size='+1'><b>Entry Management</b></font></legend>
					<div style="margin:0 auto; width:100%;overflow:hidden; height:auto;">
						<?php if(!in_array($user_id,$usr_arr_2)){  ?>
						<?php } ?>
						<div style="margin:0 auto; width:100%; overflow:hidden; float:left;">
							<fieldset style='width:95%;'><legend><font size='+1'><b>Weekend</b></font></legend>
								<form name='manual_attendance'>
									<table>
										<tr>
											<td  style='text-align-last: center;'><input class="btn btn-primary mb-2" type='button' name='btn' id='btn' onclick='save_work_off()' value='Insert' size='15'>
											</td>
											<?php if(!in_array($user_id,$usr_arr_2)){  ?>
											<td  style='text-align-last: center;'> <input  type='checkbox' name='chek' id='chek' value='1'>Fridy Replace Duty
											</td>
											<?php } ?>
										</tr>
										<tr><td><span style="font-size:12px;">[Select First date and employee ID]</span></td></tr>
									</table>
								</form>
							</fieldset>
						</div>

						<div style="margin:0 auto; width:100%; overflow:hidden; float:right; ">
							<fieldset style=' background-color:#CCC;'><legend><font size='+1'><b>Holiday</b></font></legend>
								<form name='manual_attendance'>
									<table>
										<tr>
											<td>Description &nbsp;</td>
											<td class="form-inline">&nbsp;<input  class="form-control" style="width: 200px" type='text' size='12px' id='holiday_description'>&nbsp;<input class="btn btn-primary" type='button' name='holiday_save_id'  onclick='save_holiday()' value='Insert'/>
											</td>
										<?php if(!in_array($user_id,$usr_arr_2)){  ?>
										<td  style='text-align-last: center;'> &nbsp;<input  type='checkbox' name='h_chek' id='h_chek' value='1'>Holiday Replace Duty
											</td>
											<?php } ?>
										</tr>
										<tr><td colspan="2" style="text-align-last: center;"><span style="font-size:12px;">[Type description]</span></td>
										</tr>
									</table>
								</form>
							</fieldset>
						</div>
						<br />
						<?php if(!in_array($user_id,$usr_arr_2)){  ?>
							<div style="margin:0 auto; width:100%; overflow:hidden; float:right;">
								<fieldset style=' background-color:#CCC;'><legend><font size='+1'><b>OT Abstract Search</b></font></legend>
									<form name='manual_attendance'>
										<table>
											<tr>
												<td>OT Hour &nbsp;</td> &nbsp;&nbsp;
												<td class="form-inline">
													<input class="form-control" style="width: 200px" type='text' size='12px' id='ot_hour'>&nbsp;&nbsp;
													<input class="btn btn-primary mb-2" type='button' name='ot_hour'  onclick='ot_hour_search()' value='Searching'/>
												</td>
											</tr>
										</table>
									</form>
								</fieldset>
							</div>
						<?php } ?>
						<br />
						<?php //} ?>

						<?php if(!in_array(10,$acl)){ ?>
							<?php if(in_array(13,$acl)){ ?>
								<div style="margin:0 auto; width:100%;  overflow:hidden; float:right;">
									<fieldset style=''><legend><font size='+1'><b> Job Card Modify</b></font></legend>
										<form name='ot_eot_modify'>
											<table>
												<tr >
													<td>Emp. ID </td>
													<td>:</td>
													<td><input class="form-control" type='text' size='12' name='manual_eot_emp_id' id='manual_eot_emp_id'></td>
													<td><input class="btn-primary mb-2" type='button' size='18' name='btn' id='btn' onclick='manual_eot_modification()' value='Modify' style="width: 100px;"></td>
												</tr>
											</table>
										</form>
									</fieldset>
								</div>

							<?php } ?>
						<?php } ?>
					</div>
				</fieldset>
			</div>
		</div>
	</div>
</div>