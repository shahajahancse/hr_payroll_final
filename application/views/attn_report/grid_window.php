
<style>
	.sbtn {
		background: #0c74bfeb !important; /*2393e3eb*/
		color: white;
		padding: 6px 10px !important;
	}
	.tab-content > .tab-pane, .pill-content > .pill-pane {
		padding: 15px 1px !important;
	}
	.form-group {
		margin-bottom: 10px !important;
	}

	.h3 {
		margin: 5px !important;
		line-height: 20px !important;
	}
	.fade.in {
		display: flex !important;
		flex-wrap: wrap;
		gap: 4px;
	}
</style>

	<?php
		$this->load->model('common_model');
		$unit = $this->common_model->get_unit_id_name();
	?>
	<div class="content">
		<!-- left side -->
		<div class="col-md-8">
			<!-- selection area -->
			<div class="row tablebox" style="margin-bottom: 10px;">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">First Date : </label>
							<input value="<?= date('d-m-Y') ?>" onchange="count_l1()" class="form-control input-sm date" name="firstdate" id="firstdate" >
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">Second Date : </label>
							<input class= "form-control input-sm date" name="seconddate" id="seconddate" type="text" autocomplete="off">
						</div>
					</div>
				</div>
			</div>
			<div class="row tablebox" style="display: block; margin-bottom: 10px;">
				<h3 class="h3" style="font-weight: 600;">Select Category</h3>
				<div class="col-md-6">
					<div class="form-group">
						<label>Unit <span style="color: red;">*</span> </label>
						<select  name="unit_id" id="unit_id" onchange="count_l1()" class="form-control input-sm">
							<option value="">Select Unit</option>
							<?php

								foreach ($dept as $row) {
									if($row['unit_id'] == $user_data->unit_name){
									$select_data="selected";
									}else{
										if ($user_data->level != "All") {
											continue;
										}
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
			<!-- selection area end -->
			<div id='loaader' style="display: none;align-items: center;justify-content: center;z-index: 33333;background: #e9e9e966;position: absolute;" class="col-md-12">
				<img  src="<?php echo base_url('loader.gif')?>" alt="loader">
			</div>
			<!-- button area for report section  -->
			<div class="row tablebox" style="margin-bottom: 15px;">
				<div class='multitab-section'>
					<ul class="nav nav-tabs" id="myTabs">
						<li class="active"><a href="#daily" data-toggle="tab">Daily Reports</a></li>
						<li><a href="#monthly" data-toggle="tab">Monthly Reports</a></li>
						<li><a href="#continuous" data-toggle="tab">Continuous Reports</a></li>
						<li><a href="#other" data-toggle="tab">Other Reports</a></li>
					</ul>
					<div class="tab-content">
						<?php
							$user_id = $this->session->userdata('data')->id;
							$acl = check_acl_list($user_id);
						?>
						<!-- Daily Reports -->
						<div class="tab-pane fade in active" id="daily">
							<?php if(in_array(21,$acl)) { ?>
								<button class="btn input-sm sbtn" onclick="daily_report(1)">Present Report</button>
							<?php } ?>
							<?php if(in_array(22,$acl)) { ?>
								<button class="btn input-sm sbtn" onclick="daily_report(2)">Absent Report</button>
							<?php } ?>
							<?php if(in_array(23,$acl)) { ?>
								<button class="btn input-sm sbtn" onclick="daily_report(3)">Daily Leave Report</button>
							<?php } ?>
							<?php if(in_array(24,$acl)) { ?>
								<button class="btn input-sm sbtn" onclick="daily_report(4)">Late Report</button>
							<?php } ?>
							<?php if(in_array(25,$acl)) { ?>
								<button class="btn input-sm sbtn" onclick="daily_report(5)">OT Report</button>
							<?php } ?>
							<?php if(in_array(29,$acl)) { ?>
								<button class="btn input-sm sbtn" onclick="daily_report(6)">Daily EOT</button>
							<?php } ?>

							<?php if(in_array(26,$acl)) { ?>
								<button class="btn input-sm sbtn" onclick="daily_report(7)">Out & IN Report</button>
							<?php } ?>
							<?php if(in_array(27,$acl)) { ?>
								<button class="btn input-sm sbtn" onclick="daily_report(8)">Daily Out Punch Miss</button>
							<?php } ?>
							<?php if(in_array(28,$acl)) { ?>
								<button class="btn input-sm sbtn" onclick="daily_costing_report()">Daily Costing</button>
							<?php } ?>



							<?php if(in_array(30,$acl)) { ?>
								<button class="btn input-sm sbtn" onclick="grid_actual_present_report()">Actual Present Report</button>
							<?php } ?>
							<?php if(in_array(31,$acl)) { ?>
								<button class="btn input-sm sbtn" onclick="grid_daily_actual_out_in_report()">Actual Out & IN Report</button>
							<?php } ?>
							<?php if(in_array(32,$acl)) { ?>
								<button class="btn input-sm sbtn" onclick="holiday_weekend_attn_report('A')">Holiday / Weekend Absent</button>
							<?php } ?>
							<?php if(in_array(33,$acl)) { ?>
								<button class="btn input-sm sbtn" onclick="holiday_weekend_attn_report('P')">Holiday / Weekend Present</button>
							<?php } ?>


							<?php if(in_array(74,$acl)) { ?>
							<button class="btn input-sm sbtn" onclick="daily_attendance_summary()">Attendance Summary</button>
							<?php } ?>
							<?php if(in_array(75,$acl)) { ?>
							<button class="btn input-sm sbtn" onclick="daily_costing_summary()">Daily Costing Summary</button>
							<?php } ?>
							<?php if(in_array(76,$acl)) { ?>
							<button class="btn input-sm sbtn" onclick="daily_logout_report()">Daily Logout Report</button>
							<?php } ?>
							<?php if(in_array(105,$acl)) { ?>
							<button class="btn input-sm sbtn" onclick="ot_acknowledgement_sheet(1)">OT Acknowledgement sheet</button>
							<button class="btn input-sm sbtn" onclick="ot_acknowledgement_sheet(2)">OT Acknowledgement Female</button>
							<?php } ?>
							<?php if(in_array(107,$acl)) { ?>
							<button class="btn input-sm sbtn" onclick="iftar_bill_list()">Iftar Bill List</button>
							<?php } ?>
						</div>
						<!-- Daily Reports end -->

						<!-- Monthly Reports -->
						<div class="tab-pane fade" id="monthly">
							<?php if(in_array(34,$acl)) { ?>
								<button class="btn input-sm sbtn" onclick="grid_monthly_att_register_ot()">Attendance Register</button>
							<?php } ?>
							<?php if(in_array(35,$acl)) { ?>
							<button class="btn input-sm sbtn" onclick="grid_monthly_ot_register()">OT Register</button>
							<?php } ?>
							<?php if(in_array(36,$acl)) { ?>
								<button class="btn input-sm sbtn" onclick="grid_monthly_eot_register()">EOT Register</button>
							<?php } ?>
							<?php if(in_array(37,$acl)) { ?>
								<button class="btn input-sm sbtn" onclick="grid_monthly_att_register()">Attendance Register</button>
							<?php } ?>
						</div>
						<!-- Monthly Reports end -->

						<!-- Continuous Reports -->
						<div class="tab-pane fade" id="continuous">
							<?php if(in_array(38,$acl)) { ?>
							<button class="btn input-sm sbtn" onclick="grid_continuous_present_report()">Present Report</button>
							<?php } ?>
							<?php if(in_array(39,$acl)) { ?>
							<button class="btn input-sm sbtn" onclick="grid_continuous_absent_report()">Absent Report</button>
							<?php } ?>
							<?php if(in_array(40,$acl)) { ?>
							<button class="btn input-sm sbtn" onclick="continuous_leave_report()">Leave Report</button>
							<?php } ?>
							<?php if(in_array(41,$acl)) { ?>
							<!-- <button class="btn input-sm sbtn" onclick="grid_continuous_leave_report_old()">Leave Report (old)</button> -->
							<?php } ?>

							<?php if(in_array(42,$acl)) { ?>
							<button class="btn input-sm sbtn" onclick="grid_continuous_late_report()">Late Report</button>
							<?php } ?>
							<?php if(in_array(43,$acl)) { ?>
							<button class="btn input-sm sbtn" onclick="grid_continuous_incre_report()">Increment Report</button>
							<?php } ?>
							<?php if(in_array(44,$acl)) { ?>
							<button class="btn input-sm sbtn" onclick="grid_continuous_prom_report()">Promotion Report</button>
							<?php } ?>
							<?php if(in_array(44,$acl)) { ?>
							<button class="btn input-sm sbtn" onclick="grid_continuous_line_report('line')">Line Change Report</button>
							<?php } ?>
							<?php if(in_array(44,$acl)) { ?>
							<button class="btn input-sm sbtn" onclick="grid_continuous_line_report('section')">Section Change Report</button>
							<?php } ?>
							<?php if(in_array(45,$acl)) { ?>
							<button class="btn input-sm sbtn" onclick="grid_continuous_ot_eot_report()">OT / EOT Report</button>
							<?php } ?>

							<?php if(in_array(46,$acl)) { ?>
							<button class="btn input-sm sbtn" onclick="grid_continuous_costing_report()">Continuous Costing Report</button>
							<?php } ?>
							<!-- < ?php if(in_array(47,$acl)) { ?>
							<button class="btn input-sm sbtn" onclick="grid_continuous_report_limit(3)">Absent three</button>
							< ?php } ?> -->
							<!-- < ?php if(in_array(48,$acl)) { ?>
							<button class="btn input-sm sbtn" onclick="grid_continuous_report_limit(10)">Absent ten</button>
							< ?php } ?> -->
							<?php if(in_array(103,$acl)) { ?>
							<button class="btn input-sm sbtn" onclick="last_increment_promotion(1)">Last Increment Check</button>
							<?php } ?>
							<?php if(in_array(104,$acl)) { ?>
							<button class="btn input-sm sbtn" onclick="last_increment_promotion(2)">Last Promotion Check</button>
							<?php } ?>
							<?php if(in_array(106,$acl)) { ?>
							<button class="btn input-sm sbtn" onclick="increment_able_employee()">Increment able employee</button>
							<?php } ?>
							<?php if(in_array(109,$acl)) { ?>
							<button class="btn input-sm sbtn" onclick="unit_transferred_list(1)">Unit transfer list</button>
							<?php } ?>
							<?php if(in_array(110,$acl)) { ?>
							<button class="btn input-sm sbtn" onclick="unit_transferred_list(2)">Unit transferred list</button>
							<?php } ?>
							<?php if(in_array(111,$acl)) { ?>
							<button class="btn input-sm sbtn" onclick="emp_conformation_list(1)">Staff Conformation List</button>
							<?php } ?>
							<?php if(in_array(112,$acl)) { ?>
							<button class="btn input-sm sbtn" onclick="emp_conformation_list(2)">Emp Conformation List</button>
							<?php } ?>
							<?php if(in_array(113,$acl)) { ?>
							<button class="btn input-sm sbtn" onclick="emp_conformation_list(3)">Conformation Letter</button>
							<?php } ?>
						</div>
						<!-- Continuous Reports end -->

						<!-- Other Reports -->
						<div class="tab-pane fade" id="other">
							<!-- <?php if(in_array(49,$acl)) { ?>
							<button class="btn input-sm sbtn" onclick="grid_app_letter()">App. Letter</button>
							<?php } ?> -->
							<?php if(in_array(50,$acl)) { ?>
							<button class="btn input-sm sbtn" onclick="id_card(1)">ID Card Bangla</button>
							<?php } ?>
							<?php if(in_array(51,$acl)) { ?>
							<button class="btn input-sm sbtn" onclick="id_card(2)">ID Card English</button>
							<?php } ?>
							<?php if(in_array(52,$acl)) { ?>
							<button class="btn input-sm sbtn" onclick="grid_job_card()">Job Card</button>
							<?php } ?>


							<?php if(in_array(53,$acl)) { ?>
							<button class="btn input-sm sbtn" onclick="grid_new_join_report()">New Join Report</button>
							<?php } ?>
							<?php if(in_array(54,$acl)) { ?>
							<button class="btn input-sm sbtn" onclick="grid_resign_report()">Resign Report</button>
							<?php } ?>
							<?php if(in_array(55,$acl)) { ?>
							<button class="btn input-sm sbtn" onclick="grid_left_report()">Left Report</button>
							<?php } ?>
							<?php if(in_array(56,$acl)) { ?>
							<button class="btn input-sm sbtn" onclick="grid_general_info()">General Report</button>
							<?php } ?>


							<?php if(in_array(57,$acl)) { ?>
							<button class="btn input-sm sbtn" onclick="grid_earn_leave()">Earn Leave Report</button>
							<?php } ?>
							<?php if(in_array(58,$acl)) { ?>
							<button class="btn input-sm sbtn" onclick="grid_yearly_leave_register()">Leave Register</button>
							<?php } ?>
							<?php if(in_array(96,$acl)) { ?>
							<button class="btn input-sm sbtn" onclick="worker_register()">Worker Register</button>
							<?php } ?>
							<?php if(in_array(59,$acl)) { ?>
							<button class="btn input-sm sbtn" onclick="grid_emp_job_application()">Job Application</button>
							<?php } ?>
							<?php if(in_array(60,$acl)) { ?>
							<button class="btn input-sm sbtn" onclick="join_letter()">Joining Letter</button>
							<?php } ?>


							<?php if(in_array(61,$acl)) { ?>
							<button class="btn input-sm sbtn" onclick="grid_letter_report(1)">Letter 1 <span class="badge bg-red " style="color:#fff !important" id="letter1_count">0</span></button>
							<?php } ?>
							<?php if(in_array(62,$acl)) { ?>
							<button class="btn input-sm sbtn" onclick="grid_letter_report(2)">Letter 2 <span class="badge bg-red" style="color:#fff !important" id="letter2_count">0</span></button>
							<?php } ?>
							<?php if(in_array(63,$acl)) { ?>
							<button class="btn input-sm sbtn" onclick="grid_letter_report(3)">Letter 3 <span class="badge bg-red" style="color:#fff !important" id="letter3_count">0</span></button>
							<?php } ?>
							<?php if(in_array(64,$acl)) { ?>
							<button class="btn input-sm sbtn" onclick="grid_employee_information()">Employee Information</button>
							<?php } ?>


							<!-- <?php if(in_array(65,$acl)) { ?>
							<button class="btn input-sm sbtn" onclick="grid_nominee()">Nominee From</button>
							<?php } ?> -->
							<?php if(in_array(66,$acl)) { ?>
							<button class="btn input-sm sbtn" onclick="grid_incre_prom_report(1)">Increment Letter</button>
							<?php } ?>
							<?php if(in_array(67,$acl)) { ?>
							<button class="btn input-sm sbtn" onclick="grid_incre_prom_report(2)">Promotion Letter</button>
							<?php } ?>
							<?php if(in_array(67,$acl)) { ?>
							<button class="btn input-sm sbtn" onclick="grid_incre_prom_report(3)">Line Letter</button>
							<?php } ?>
							<?php if(in_array(68,$acl)) { ?>
							<button class="btn input-sm sbtn" onclick="grid_service_book()">Service Book</button>
							<?php } ?>

							<?php if(in_array(101,$acl)) { ?>
							<button class="btn input-sm sbtn" onclick="grid_final_satalment()">Final Satalment</button>
							<?php } ?>

							<!-- <?php if(in_array(69,$acl)) { ?>
							<button class="btn input-sm sbtn" onclick="grid_age_estimation()">Age estimation</button>
							<?php } ?> -->
							<?php if(in_array(70,$acl)) { ?>
								<!-- actual job card -->
							<button class="btn input-sm sbtn" onclick="grid_eot_actual()">Job Card Actual </button>
							<?php } ?>
							<?php if(in_array(72,$acl)) { ?>
								<!-- max 2 eot -->
							<button class="btn input-sm sbtn" onclick="grid_extra_ot_9pm()">Job Card.</button>
							<?php } ?>
							<?php if(in_array(73,$acl)) { ?>
								<!-- max 5 eot -->
							<button class="btn input-sm sbtn" onclick="grid_extra_ot_12am()">Job Card`</button>
							<?php } ?>
							<?php if(in_array(71,$acl)) { ?>
								<!-- eot all with out off day and holiday -->
							<button class="btn input-sm sbtn" onclick="grid_extra_ot_all()">Job Card!</button>
							<?php } ?>
							<?php if(in_array(92,$acl)) { ?>
                            <button class="btn input-sm sbtn" onclick="grid_maternity_benefit(1)">Maternity Benefit Report 1</button>
                            <button class="btn input-sm sbtn" onclick="grid_maternity_benefit(2)">Maternity Benefit Report 2</button>
                            <?php } ?>
							<?php if(in_array(124,$acl)) { ?>
                            <button class="btn input-sm sbtn" onclick="grid_service_book_info()">Service Book Information</button>
                            <?php } ?>
						</div>
						<!-- Other Reports end -->
					</div>
				</div>
			</div>
			<!-- button area for report section end -->
		</div>

		<!-- right side of employee list -->
		<div class="col-md-4 tablebox">
			<input type="text" id="searchi" class="form-control" placeholder="Search">
			<div style="height: 80vh; overflow-y: scroll;">
				<table class="table table-hover" id="fileDiv">
					<thead>
						<tr style="position: sticky;top: 0;z-index:1">
							<th class="active" style="width:10%"><input type="checkbox" id="select_all" class="select-all checkbox" name="select-all"></th>
							<th class="" style="background:#0177bcc2;color:white">Id</th>
							<th class=" text-center" style="background:#0177bc;color:white">Name</th>
						</tr>
					</thead>
					<tbody id="tbody">
						<?php if (!empty($employees)) {
							foreach ($employees as $key => $emp) {
						?>
							<tr class="removeTr">
								<td><input type="checkbox" class="checkbox" id="emp_id" name="emp_id[]" value="<?= $emp->emp_id ?>">
								</td>
								<td class="success"><?= $emp->emp_id ?></td>
								<td class="warning "><?= $emp->name_en ?></td>
							</tr>
						<?php }
						} ?>
						<tr class="removeTrno">
							<td colspan="3" class="text-center"> No data found</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<script src="<?php echo base_url(); ?>js/grid_content.js" type="text/javascript"></script>

	<script>
		$(document).ready(function() {
			$("#searchi").on("keyup", function() {
				var value = $(this).val().toLowerCase();
				$("#tbody tr").filter(function() {
					$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
				});
				$(".removeTrno").toggle($(".removeTr").length === 0);
			});
		});
	</script>
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
					$('.removeTr').remove();
					if (response.length != 0) {
						$('.removeTrno').hide();
						var items = '';
						$.each(response, function(index, value) {
							items += `
								<tr class="removeTr">
									<td><input type="checkbox" class="checkbox" id="emp_id" name="emp_id[]" value="${value.emp_id }" ></td>
									<td class="success">${value.emp_id}</td>
									<td class="warning ">${value.name_en}</td>
								</tr>`
						});
						// console.log(items);
						$('#fileDiv tr:last').after(items);
					} else {
						$('.removeTrno').show();
						$('.removeTr').remove();
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
						$('.desig').append("<option value=''>-- Select Designation --</option>");
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
						$('.line').append("<option value=''>-- Select Line --</option>");
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
						$('.section').append("<option value=''>-- Select Section --</option>");
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
							opt.html(name);
							$('.dept').append(opt);
						});
						changeFontBn();
					}
				});
				// load employee
				grid_emp_list();
			});
		});
	</script>

	<script>
		function count_l1() {
		    var unit = document.getElementById('unit_id').value;
			if (unit == '') {
				return false;
			}

		    var first_date = document.getElementById('firstdate').value;
			if (first_date == '') {
				return false;
			}
			$.ajax({
				type: "POST",
				url: hostname + "grid_con/grid_letter_count",
				data: {
					"unit_id": unit,
					"firstdate": first_date
				},
				success: function(data){
					var data = JSON.parse(data);
					$('#letter1_count').html(data[1]);
					$('#letter2_count').html(data[2]);
					$('#letter3_count').html(data[3]);
				}
			})
		}

	</script>
	<script>
		$(document).ready(function() {
			count_l1();
		});
		function changeFontBn() {
			setTimeout(() => {
				// console.log('changeFontBn');
				$('.changeFontBn').css('font-family', 'SutonnyMJ');
			}, 5000);
		}
	</script>