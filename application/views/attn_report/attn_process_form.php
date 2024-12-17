<script src="<?php echo base_url(); ?>js/grid_content.js" type="text/javascript"></script>
<style>
#fileDiv #removeTr td {
    padding: 5px 10px !important;
    font-size: 14px;
}
</style>
<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->

	<?php
		$this->load->model('common_model');
		$unit = $this->common_model->get_unit_id_name();
	?>
<div class="content">
    <div class="row">
        <div class="col-md-8">
            <?php $success = $this->session->flashdata('success');
	        if ($success != "") { ?>
           	 <div class="alert alert-success"><?php echo $success; ?></div>
            <?php } 
	         $error = $this->session->flashdata('error');
	        if ($error) { ?>
           	 <div class="alert alert-failuer"><?php echo $error; ?></div>
            <?php } ?>
        </div>
    </div>
    <!-- <div class="container-fluid">	 -->
    <div class="col-md-8">
        <div class="row tablebox" style="display: block;">
            <h3 style="font-weight: 600;"><?= $title ?></h3>
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
        <br>
        <div id="loader" align="center" style="margin:0 auto; overflow:hidden; display:none; margin-top:10px;">
            <img src="<?php echo base_url('images/ajax-loader.gif');?>" />
        </div>
        <div class="row nav_head">
            <div class="col-lg-4">
                <span style="font-size: 20px;">Attendance Process </span>
            </div><!-- /.col-lg-6 -->
            <div class="col-lg-6">
                <div class="input-group" style="display:flex; gap: 14px">
                    <input type="text" class="form-control date" id="process_date" autocomplete="off">
                    <span class="input-group-btn">
                        <input class="btn btn-primary" onclick='attendance_process()' type="button" value='Process' />
                    </span>
                </div><!-- /input-group -->
            </div><!-- /.col-lg-6 -->
        </div><!-- /.row -->
        <div class="row nav_head" style="margin-top: 13px;">
            <div class="col-lg-4">
                <span style="font-size: 20px;">Attendance Process <br>Date Between </span>
            </div><!-- /.col-lg-6 -->
            <div class="col-lg-6">
                <div class="input-group" style="display:flex; gap: 14px">
                    <input type="text" placeholder="Start Date" class="form-control date" id="process_date1" autocomplete="off">
                    <input type="text" placeholder="End Date" class="form-control date" id="process_date2" autocomplete="off">
                    <span class="input-group-btn">
                        <input class="btn btn-primary" onclick='attendance_process2()' type="button" value='Process' />
                    </span>
                </div><!-- /input-group -->
            </div><!-- /.col-lg-6 -->
        </div><!-- /.row -->
    </div>

		<!-- employee list for right side -->
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
	<!-- </div> -->
</div>

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