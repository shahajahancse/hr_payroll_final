
<?php
	$this->load->model('common_model');
	$unit = $this->common_model->get_unit_id_name();
?>
<div class="content">
	<div class="col-md-8">
		<div class="row tablebox">
			<!-- <div class="col-md-6"> -->
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">First Date : </label>
							<input class= "form-control input-sm" name="firstdate" id="firstdate" type="date" autocomplete="off">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">Second Date : </label>
							<input class= "form-control input-sm" name="seconddate" id="seconddate" type="date" autocomplete="off">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">First Time : </label>
							<input class= "form-control input-sm" name="f_time" id="f_time" type="text">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">Second Time : </label>
							<input class= "form-control input-sm" name="s_time" id="s_time" type="text">
						</div>
					</div>
				</div>
			<!-- </div> -->
		</div>
		<br>
		<div class="row tablebox" style="display: block;">
			<h3 style="font-weight: 600;">Select Category</h3>
			<div class="col-md-6">
				<div class="form-group">
					<label>Unit <span style="color: red;">*</span> </label>
					<select name="unit_id" id="unit_id" class="form-control input-sm">
						<option value="">Select Unit</option>
						<?php 
							foreach ($dept as $row) {
								if($row['unit_id'] == $user_data->unit_name){
								$select_data="selected";
								}else{
								$select_data='';
								}  
								echo '<option '.$select_data.'  value="'.$row['unit_id'].'">'.$row['unit_name'].
								'</option>';
							}
						?>
					</select>
				</div>
			</div>
			<!-- department -->
			<div class="col-md-6">
				<div class="form-group">
					<label>Department </label>
					<select class="form-control input-sm dept" id='dept' name='dept'>
						<?php if (!empty($user_data->unit_name)) { 
							$dpts = $this->db->where('unit_id', $user_data->unit_name)->get('emp_depertment'); ?>
						<option value=''>Select Department</option>
						<?php foreach ($dpts->result() as $key => $val) { ?>
						<option value='<?= $val->dept_id ?>'><?= $val->dept_name ?></option>
						<?php } } ?>
						<option value=''>Select Department</option>
					</select>
				</div>
			</div>
			<!-- section -->
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label">Section </label>
					<select class="form-control input-sm section" id='section' name='section'>
						<option value=''></option>
					</select>
				</div>
			</div>
			<!-- line -->
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label">Line </label>
					<select class="form-control input-sm line" id='line' name='line'>
						<option value=''></option>
					</select>
				</div>
			</div>
			<!-- Designation -->
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label">Designation</label>
					<select class="form-control input-sm desig" id='desig' name='desig' onChange="grid_emp_list()">
						<option value=''></option>
					</select>
				</div>
			</div>
			<!-- status -->
			<div class="col-md-6">
				<?php $categorys = $this->db->get('emp_category_status')->result(); ?>
				<div class="form-group">
					<label class="control-label">Status </label>
					<select name="status" id="status" class="form-control input-sm" onChange="grid_emp_list()">
						<option value="">All Employee</option>
						<?php foreach ($categorys as $key => $row) { ?>
						<option value="<?= $row->id ?>" <?= ($row->id==1)?'selected':'' ?>><?= $row->status_type; ?>
						</option>
						<?php } ?>
					</select>
				</div>
			</div>
		</div>
		<!-- /.row -->
	</div>
	<div class="col-md-4 tablebox">
		<div style="height: 80vh; overflow-y: scroll;">
			<table class="table table-hover" id="fileDiv">
				<tr style="position: sticky;top: 0;z-index:1">
					<th class="active" style="width:10%"><input type="checkbox" id="select_all"
					class="select-all checkbox" name="select-all"></th>
					<th class="" style="background:#0177bcc2;color:white">Id</th>
					<th class=" text-center" style="background:#0177bc;color:white">Name</th>
				</tr>
				<?php if (!empty($employees)) { 
							foreach ($employees as $key => $emp) { ?>
				<tr id="removeTr">
					<td><input type="checkbox" class="checkbox" id="emp_id" name="emp_id[]" value="<?= $emp->id ?>">
					</td>
					<td class="success"><?= $emp->emp_id ?></td>
					<td class="warning "><?= $emp->name_en ?></td>
				</tr>
				<?php } } ?>
			</table>
		</div>
	</div>
<!-- </div>
	  
<div class="content" style="padding-left: 35px;"> -->
	<div class="col-md-12" style="margin-top: 15px;padding: 1px 0px 0px 13px;">							
	<div class="tablebox">
		<div class='multitab-section'>
			<ul class="nav nav-tabs" id="myTabs">
				<li class="active"><a href="#daily" data-toggle="tab">Daily Reports</a></li>
				<li><a href="#monthly" data-toggle="tab">Monthly Reports</a></li>
				<li><a href="#continuous" data-toggle="tab">Continuous Reports</a></li>
				<li><a href="#other" data-toggle="tab">Other Reports</a></li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane fade in active" id="daily">
					<?php
					$usr_arr = array(3, 7, 8);
					$usr_arr_2 = array(6);
					$usr_arr_3 = array(11);
					$usr_arr_4 = array(6, 11);

					$user_id = $this->acl_model->get_user_id($this->session->userdata('data')->id_number);
					$acl = $this->acl_model->get_acl_list($user_id);
					?>
					<?php if (!in_array($user_id, $usr_arr)) { ?>
						<button class="btn btn-primary input-sm" onclick="daily_report(1)">Present Report</button>
					<?php } ?>
					<button class="btn btn-primary input-sm" onclick="daily_report(2)">Absent Report</button>
					<button class="btn btn-primary input-sm" onclick="daily_report(3)">Daily Leave Report</button>
					<button class="btn btn-primary input-sm" onclick="daily_report(4)">Late Report</button>
					<button class="btn btn-primary input-sm" onclick="daily_report(5)">OT Report</button>
					<?php if (!in_array($user_id, $usr_arr_2) && !in_array($user_id, $usr_arr_3)) { ?>
						<button class="btn btn-primary input-sm" onclick="daily_report(6)">Out & IN Report</button>
						<?php } ?>
						<?php if (!in_array(10, $acl) && !in_array(14, $acl)) { ?>
							<button class="btn btn-primary input-sm" onclick="grid_daily_out_punch_miss_report()">Daily Out Punch Miss</button>
						<button class="btn btn-primary input-sm" onclick="daily_costing_report()">Daily Costing</button>
						<?php } ?>
					<?php if (!in_array(10, $acl) && !in_array(14, $acl)) { ?>
						<button class="btn btn-primary input-sm" onclick="grid_daily_eot()">Daily EOT</button>
						<button class="btn btn-primary input-sm" onclick="grid_actual_present_report()">Actual Present Report</button>
						<button class="btn btn-primary input-sm" onclick="grid_daily_actual_out_in_report()">Actual Out & IN Report</button>
						<button class="btn btn-primary input-sm" onclick="grid_daily_holiday_weekend_absent_report()">Holiday / Weekend Absent</button>
					<?php } ?>
					<?php if (!in_array(10, $acl) && !in_array(14, $acl)) { ?>
						<button class="btn btn-primary input-sm" onclick="grid_daily_holiday_weekend_present_report()">Holiday / Weekend Present</button>
						<?php } ?>
				</div>

				<?php if (!in_array($user_id, $usr_arr)) { ?>
					<div class="tab-pane fade" id="monthly">
						<button class="btn btn-primary input-sm" onclick="grid_monthly_att_register_ot()">Attendance Register</button>
						<button class="btn btn-primary input-sm" onclick="grid_monthly_ot_register()">OT Register</button>
						<?php if (!in_array(10, $acl) && !in_array(10, $acl)) { ?>
							<button class="btn btn-primary input-sm" onclick="grid_monthly_eot_register()">EOT Register</button>
							<?php
							$register = 1;
							$register_blank = 2;
							$register_blank_without_name = 3;
							?>
							<button class="btn btn-primary input-sm" onclick="grid_monthly_att_register(<?php echo $register; ?>)">Attendance Register</button>
						<?php } ?>
					</div>
				<?php } ?>
				<div class="tab-pane fade" id="continuous">
					<button class="btn btn-primary input-sm" onclick="grid_continuous_present_report()">Present Report</button>
					<button class="btn btn-primary input-sm" onclick="grid_continuous_absent_report()">Absent Report</button>
					<button class="btn btn-primary input-sm" onclick="grid_continuous_leave_report_new()">Leave Report</button>
					<button cl   ass="btn btn-primary input-sm" onclick="grid_continuous_late_report()">Late Report</button>
					<button class="btn btn-primary input-sm" onclick="grid_continuous_incre_report()">Increment Report</button>
					<button class="btn btn-primary input-sm" onclick="grid_continuous_prom_report()">Promotion Report</button>
					<?php if (!in_array(10, $acl) && !in_array(14, $acl)) { ?>
						<button class="btn btn-primary input-sm" onclick="grid_continuous_ot_eot_report()">OT / EOT Report</button>
						<button class="btn btn-primary input-sm" onclick="grid_continuous_costing_report()">Continuous Costing Report</button>
					<?php } ?>
					<button class="btn btn-primary input-sm" onclick="grid_continuous_report_limit(3)">Absent three</button>
					<button class="btn btn-primary input-sm" onclick="grid_continuous_report_limit(10)">Absent ten</button>
				</div>
				<div class="tab-pane fade" id="other" style="display: flex;flex-direction: row;flex-wrap: wrap;gap: 4px;">
					<button class="btn btn-primary input-sm" onclick="grid_app_letter()">App. Letter</button>
					<button class="btn btn-primary input-sm" onclick="id_card(1)">ID Card Bangla</button>
					<button class="btn btn-primary input-sm" onclick="id_card(2)">ID Card English</button>

					<?php if (!in_array($user_id, $usr_arr_3)) { ?>
						<?php if (!in_array($user_id, $usr_arr)) { ?>
							<button class="btn btn-primary input-sm" onclick="grid_job_card()">Job Card</button>
						<?php } ?>
					<?php } ?>
					<button class="btn btn-primary input-sm" onclick="grid_new_join_report()">New Join Report</button>
					<?php if (!in_array($user_id, $usr_arr)) { ?>
						<button class="btn btn-primary input-sm" onclick="grid_resign_report()">Resign Report</button>
						<button class="btn btn-primary input-sm" onclick="grid_left_report()">Left Report</button>
						<?php } ?>
					<button class="btn btn-primary input-sm" onclick="grid_general_info()">General Report</button>
					<?php if (!in_array($user_id, $usr_arr)) { ?>
						<button class="btn btn-primary input-sm" onclick="grid_earn_leave()">Earn Leave Report</button>
						<button class="btn btn-primary input-sm" onclick="grid_yearly_leave_register()">Leave Register</button>
						<button class="btn btn-primary input-sm" onclick="grid_emp_job_application()">Job Application</button>
						<button class="btn btn-primary input-sm" onclick="join_letter()">Joining Letter</button>
						<button class="btn btn-primary input-sm" onclick="grid_letter1_report()">Letter 1</button>
						<button class="btn btn-primary input-sm" onclick="grid_letter2_report()">Letter 2</button>
						<button class="btn btn-primary input-sm" onclick="grid_letter3_report()">Letter 3</button>
						<?php } ?>
						<button class="btn btn-primary input-sm" onclick="grid_employee_information()">Employee Information</button>
					<?php if (!in_array($user_id, $usr_arr)) { ?>
						<button class="btn btn-primary input-sm" onclick="grid_nominee()">Nominee From</button>
						<button class="btn btn-primary input-sm" onclick="grid_incre_prom_report()">Increment Letter</button>
						<button class="btn btn-primary input-sm" onclick="grid_prom_report()">Promotion Letter</button>
						<?php } ?>
						<button class="btn btn-primary input-sm" onclick="grid_service_book()">Service Book</button>
						<button class="btn btn-primary input-sm" onclick="grid_age_estimation()">Age estimation</button>
						<?php if (!in_array(10, $acl) && !in_array(14, $acl)) { ?>
						<button class="btn btn-primary input-sm" onclick="grid_extra_ot()">EOT Job Card</button>
						<button class="btn btn-primary input-sm" onclick="grid_extra_ot_9pm()">EOT Job Card 9pm</button>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
	</div>	
</div>

<script src="<?php echo base_url(); ?>js/grid_content.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>js/grid_content.js" type="text/javascript"></script>
<script type="text/javascript">
	// on load employee
	function grid_emp_list() {
	    var unit = document.getElementById('unit_id').value;
	    var dept = document.getElementById('dept').value;
	    var section = document.getElementById('section').value;
	    var line = document.getElementById('line').value;
	    var desig = document.getElementById('desig').value;
	    var status = document.getElementById('status').value;

	    url = hostname + "common/grid_emp_list/" + unit + "/" + dept + "/" + section + "/" + line + "/" + desig;
	    $.ajax({
	        url: url,
	        type: 'GET',
	        data: {
	            "status": status
	        },
	        contentType: "application/json",
	        dataType: "json",
	        success: function(response) {
	            $('#fileDiv #removeTr').remove();
	            if (response.length != 0) {
	                var items = '';
	                $.each(response, function(index, value) {
	                    items += '<tr id="removeTr">';
	                    items +=
	                        '<td><input type="checkbox" class="checkbox" id="emp_id" name="emp_id[]" value="' +
	                        value.id + '" ></td>';
	                    items += '<td class="success">' + value.emp_id + '</td>';
	                    items += '<td class="warning ">' + value.name_en + '</td>';
	                    items += '</tr>';
	                });
	                // console.log(items);
	                $('#fileDiv tr:last').after(items);
	            } else {
	                $('#fileDiv #removeTr').remove();
	            }
	        }
	    });
	}

	$(document).ready(function() {
	    // select all item or deselect all item
	    $("#select_all").click(function() {
	        $('input:checkbox').not(this).prop('checked', this.checked);
	    });
	    //Designation dropdown
	    $('#line').change(function() {
	        $('.desig').addClass('form-control input-sm');
	        $(".desig > option").remove();
	        var id = $('#line').val();
	        $.ajax({
	            type: "POST",
	            url: hostname + "common/ajax_designation_by_line_id/" + id,
	            success: function(func_data) {
	                $('.desig').append("<option value=''>-- Select District --</option>");
	                $.each(func_data, function(id, name) {
	                    var opt = $('<option />');
	                    opt.val(id);
	                    opt.text(name);
	                    $('.desig').append(opt);
	                });
	            }
	        });
	        // load employee
	        grid_emp_list();
	    });

	    //Line dropdown
	    $('#section').change(function() {
	        $('.line').addClass('form-control input-sm');
	        $(".line > option").remove();
	        $(".desig > option").remove();
	        var id = $('#section').val();
	        $.ajax({
	            type: "POST",
	            url: hostname + "common/ajax_line_by_sec_id/" + id,
	            success: function(func_data) {
	                $('.line').append("<option value=''>-- Select District --</option>");
	                $.each(func_data, function(id, name) {
	                    var opt = $('<option />');
	                    opt.val(id);
	                    opt.text(name);
	                    $('.line').append(opt);
	                });
	            }
	        });
	        // load employee
	        grid_emp_list();
	    });
	    //section dropdown
	    $('#dept').change(function() {
	        $('.section').addClass('form-control input-sm');
	        $(".section > option").remove();
	        $(".line > option").remove();
	        $(".desig > option").remove();
	        var id = $('#dept').val();
	        $.ajax({
	            type: "POST",
	            url: hostname + "common/ajax_section_by_dept_id/" + id,
	            success: function(func_data) {
	                $('.section').append("<option value=''>-- Select District --</option>");
	                $.each(func_data, function(id, name) {
	                    var opt = $('<option />');
	                    opt.val(id);
	                    opt.text(name);
	                    $('.section').append(opt);
	                });
	            }
	        });
	        // load employee
	        grid_emp_list();
	    });
	    //Department dropdown
	    $('#unit_id').change(function() {
	        $('.dept').addClass('form-control input-sm');
	        $(".dept > option").remove();
	        $(".section > option").remove();
	        $(".line > option").remove();
	        $(".desig > option").remove();
	        var id = $('#unit_id').val();
	        $.ajax({
	            type: "POST",
	            url: hostname + "common/ajax_department_by_unit_id/" + id,
	            success: function(func_data) {
	                $('.dept').append("<option value=''>-- Select Department --</option>");
	                $.each(func_data, function(id, name) {
	                    var opt = $('<option />');
	                    opt.val(id);
	                    opt.text(name);
	                    $('.dept').append(opt);
	                });
	            }
	        });
	        // load employee
	        grid_emp_list();
	    });
	});
</script>