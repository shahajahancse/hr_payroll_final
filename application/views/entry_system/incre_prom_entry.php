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
                <div class="form-group" style="margin-bottom: 10px !important;">
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
                <div class="form-group" style="margin-bottom: 10px !important;">
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
                <div class="form-group" style="margin-bottom: 10px !important;">
                    <label class="control-label">Section </label>
                    <select class="form-control input-sm section" id='section' name='section'>
                        <option value=''></option>
                    </select>
                </div>
            </div>
            <!-- line -->
            <div class="col-md-6">
                <div class="form-group" style="margin-bottom: 10px !important;">
                    <label class="control-label">Line </label>
                    <select class="form-control input-sm line" id='line' name='line'>
                        <option value=''></option>
                    </select>
                </div>
            </div>
            <!-- Designation -->
            <div class="col-md-6">
                <div class="form-group" style="margin-bottom: 10px !important;">
                    <label class="control-label">Designation</label>
                    <select class="form-control input-sm desig" id='desig' name='desig' onChange="grid_emp_list()">
                        <option value=''></option>
                    </select>
                </div>
            </div>
            <!-- status -->
            <div class="col-md-6">
                <?php $categorys = $this->db->get('emp_category_status')->result(); ?>
                <div class="form-group" style="margin-bottom: 10px !important;">
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
        <div id="loader" align="center" style="margin:0 auto; overflow:hidden; display:none; margin-top:5px;">
            <img src="<?php echo base_url('images/ajax-loader.gif');?>" />
        </div>

        <!-- Increment Promtion Line change -->
        <div class="row nav_head">
            <div class="col-lg-6">
                <span style="font-size: 20px;"><?= $title ?></span>
            </div><!-- /.col-lg-6 -->
            <div class="col-lg-6">
                <div class="input-group" style="display:flex; gap: 14px">
                    <input class="btn btn-primary" onclick='toggleSection("increment")' type="button" value="Increment" />
                    <input class="btn btn-info" onclick='toggleSection("promotion")' type="button" value="Promotion" />
                    <input class="btn btn-success" onclick='toggleSection("line_change")' type="button" value="Line" />
                </div><!-- /input-group -->
            </div><!-- /.col-lg-6 -->
        </div><!-- /.row -->

        <!-- promotion entry  -->
        <div id="promotion_entry" class="row nav_head" style="margin-top: 13px;">
            <div class="col-md-12" style="display: flex;gap: 11px;flex-direction: column;">
                <div class="col-md-12" style="box-shadow: 0px 0px 2px 2px #bdbdbd;border-radius: 4px;padding-top: 8px;">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="col-md-3" style="padding: 0px 0px 10px 0px !important">
                                <span style="max-height: 100% !important; max-height: 100% !important; display: block !important;">
                                    <img id="profile_image" style="height: 90px;width: 110px;" class="img-responsive" >
                                </span>
                            </div>
                            <div class="col-md-9">
                                <p style="font-size: 16px; font-weight: bold; margin-bottom: 5px; margin-top: 5px">Name: <span id="emp_name"> </span></p>
                                <p style="font-weight: bold; margin-bottom: 5px;">Dept: <span id="departments_ids"> </span></p>
                                <p style="font-weight: bold;">Sec : <span id="sections_ids"> </span></p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <p style="font-weight: bold; margin-bottom: 5px; margin-top: 5px">Emp Id: <span id="emps_ids"> </span></p>
                                <p style="font-weight: bold; margin-bottom: 5px;">Line  : <span id="lines_ids"> </span></p>
                                <p style="font-weight: bold;">Desig : <span id="desigs_id"> </span></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12" style="box-shadow: 0px 0px 2px 2px #bdbdbd;border-radius: 4px;padding-top: 10px; padding-bottom: 10px;">
                    <form class="col-md-12" method="post" id="promotion_entry_entry_form">
                        <div class="raw">
                            <div class="col-md-6" style="padding-left: 0px!important; padding-right: 5px!important;">
                                <div class="form-group">
                                    <label class="control-label">Department</label>
                                    <select name="pro_department" id="pro_department" class="form-control input-sm">
                                        <option value="">Select Department</option>
                                        <?php foreach ($departments as $key => $r) { ?>
                                            <option value="<?= $r->dept_id ?>"><?= $r->dept_name .' >> '. $r->unit_name ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6" style="padding-left: 5px!important; padding-right: 0px!important;">
                                <div class="form-group">
                                    <label class="control-label">Section</label>
                                    <select id="pro_section" class="form-control input-sm pro_section">
                                        <option value="">Select Section</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6" style="padding-left: 0px!important; padding-right: 5px!important;">
                                <div class="form-group">
                                    <label class="control-label">Line</label>
                                    <select id="pro_line" class="form-control input-sm pro_line">
                                        <option value="">Select Line</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6" style="padding-left: 5px!important; padding-right: 0px!important;">
                                <div class="form-group">
                                    <label class="control-label">Designation</label>
                                    <select id="pro_designation" class="form-control input-sm pro_designation">
                                        <option value="">Select Designation</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="raw">
                            <div class="col-md-3" style="padding-left: 0px!important; padding-right: 5px!important;">
                                <div class="form-group">
                                    <label class="control-label">Gross Salary</label>
                                    <input class="form-control" readonly id="salary" name="salary">
                                </div>
                            </div>
                            <div class="col-md-3" style="padding-left: 5px!important; padding-right: 5px!important;">
                                <div class="form-group">
                                    <label class="control-label">New Salary</label>
                                    <input class="form-control" id="gross_sal" name="gross_sal">
                                </div>
                            </div>
                            <div class="col-md-3" style="padding-left: 5px!important; padding-right: 5px!important;">
                                <div class="form-group">
                                    <label class="control-label">Com. Salary</label>
                                    <input class="form-control" readonly id="com_salary" name="com_salary">
                                </div>
                            </div>
                            <div class="col-md-3" style="padding-left: 5px!important; padding-right: 0px!important;">
                                <div class="form-group">
                                    <label class="control-label">New Com. Salary</label>
                                    <input class="form-control" id="com_gross_sal" name="com_gross_sal">
                                </div>
                            </div>
                        </div>

                        <div class="row" top='20px'>
                            <div class="col-md-3">
                                <select name="grade_id" id="grade_id" class="form-control">
                                    <option value="">Grade</option>
                                    <option value="8">1</option>
                                    <option value="7">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="7">5</option>
                                    <option value="6">6</option>
                                    <option value="5">7</option>
                                    <option value="1">None</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <span style="font-size: 18px; font-weight: bold;">Effective Date : </span>
                            </div>
                            <div class="col-md-3" style="padding-left: 0px; padding-right: 0px;">
                                <input type="date" class="form-control" id="date" placeholder="select date">
                            </div>
                            <div class="col-md-3">
                                <div class="input-group" style="gap: 14px; display: flex;">
                                    <span class="input-group-btn" style="display: flex; gap: 10px;">
                                        <input class="btn btn-primary" onclick='add_weekend()' type="button" value='Save' />
                                        <input class="btn btn-danger" onclick="delete_weekend()" type="button" value="Delete">
                                    </span>
                                </div><!-- /input-group -->
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- increment entry  -->
        <div id="increment_entry" class="row nav_head" style="margin-top: 13px;">
            <div class="col-md-12" style="display: flex;gap: 11px;flex-direction: column;">
                <div class="col-md-12" style="box-shadow: 0px 0px 2px 2px #bdbdbd;border-radius: 4px;padding-top: 8px;">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="col-md-3" style="padding: 0px 0px 10px 0px !important">
                                <span style="max-height: 100% !important; max-height: 100% !important; display: block !important;">
                                    <img id="inc_profile_image" style="height: 90px;width: 110px;" class="img-responsive" >
                                </span>
                            </div>
                            <div class="col-md-9">
                                <p style="font-size: 16px; font-weight: bold; margin-bottom: 5px; margin-top: 5px">Name: <span id="inc_emp_name"> </span></p>
                                <p style="font-weight: bold; margin-bottom: 5px;">Dept: <span id="inc_departments_ids"> </span></p>
                                <p style="font-weight: bold;">Sec : <span id="inc_sections_ids"> </span></p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <p style="font-weight: bold; margin-bottom: 5px; margin-top: 5px">Emp Id: <span id="inc_emps_ids"> </span></p>
                                <p style="font-weight: bold; margin-bottom: 5px;">Line  : <span id="inc_lines_ids"> </span></p>
                                <p style="font-weight: bold;">Desig : <span id="inc_desigs_id"> </span></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12" style="box-shadow: 0px 0px 2px 2px #bdbdbd;border-radius: 4px;padding-top: 10px; padding-bottom: 10px;">
                    <form class="col-md-12" method="post" id="increment_entry_form">
                        <div class="raw">
                            <div class="col-md-3" style="padding: 5px !important">
                                <div class="form-group" style="margin-bottom: 3px !important;">
                                    <label class="control-label">Gross Salary</label>
                                    <input class="form-control" readonly id="inc_salary" name="salary">
                                </div>
                            </div>
                            <div class="col-md-3" style="padding: 5px !important">
                                <div class="form-group" style="margin-bottom: 3px !important;">
                                    <label class="control-label">New Salary</label>
                                    <input class="form-control" id="gross_sal" name="gross_sal">

                                </div>
                            </div>
                            <div class="col-md-3" style="padding: 5px !important">
                                <div class="form-group" style="margin-bottom: 3px !important;">
                                    <label class="control-label">Com. Salary</label>
                                    <input class="form-control" readonly id="inc_com_salary" name="com_salary">
                                </div>
                            </div>
                            <div class="col-md-3" style="padding: 5px !important">
                                <div class="form-group" style="margin-bottom: 3px !important;">
                                    <label class="control-label">New Com. Salary</label>
                                    <input class="form-control" id="com_gross_sal" name="com_gross_sal">
                                </div>
                            </div>
                        </div>
                        <div class="row" top='20px'>
                            <div class="col-md-3">
                                <span style="font-size: 18px; font-weight: bold;">Effective Date : </span>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group" style="gap: 14px; display: flex;">
                                    <input type="date" class="form-control" id="date" placeholder="select date">
                                    <span class="input-group-btn" style="display: flex; gap: 10px;">
                                        <input class="btn btn-primary" onclick='add_weekend()' type="button" value='Save' />
                                        <input class="btn btn-danger" onclick="delete_weekend()" type="button" value="Delete">
                                    </span>
                                </div><!-- /input-group -->
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Line change entry  -->
        <div id="line_change" class="row nav_head" style="margin-top: 13px;">
            <div class="col-md-12" style="display: flex;gap: 11px;flex-direction: column;">
                <div class="col-md-12" style="box-shadow: 0px 0px 2px 2px #bdbdbd;border-radius: 4px;padding-top: 8px;">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="col-md-3" style="padding: 0px 0px 10px 0px !important">
                                <span style="max-height: 100% !important; max-height: 100% !important; display: block !important;">
                                    <img id="line_profile_image" style="height: 90px;width: 110px;" class="img-responsive" >
                                </span>
                            </div>
                            <div class="col-md-9">
                                <p style="font-size: 16px; font-weight: bold; margin-bottom: 5px; margin-top: 5px">Name: <span id="line_emp_name"> </span></p>
                                <p style="font-weight: bold; margin-bottom: 5px;">Dept: <span id="line_departments_ids"> </span></p>
                                <p style="font-weight: bold;">Sec : <span id="line_sections_ids"> </span></p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <p style="font-weight: bold; margin-bottom: 5px; margin-top: 5px">Emp Id: <span id="line_emps_ids"> </span></p>
                                <p style="font-weight: bold; margin-bottom: 5px;">Line  : <span id="line_lines_ids"> </span></p>
                                <p style="font-weight: bold;">Desig : <span id="line_desigs_id"> </span></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12" style="box-shadow: 0px 0px 2px 2px #bdbdbd;border-radius: 4px;padding-top: 10px; padding-bottom: 10px;">
                    <form class="col-md-12" method="post" id="line_change_entry_form">
                        <div class="raw">
                            <div class="col-md-6" style="padding-left: 0px!important; padding-right: 5px!important;">
                                <div class="form-group">
                                    <label class="control-label">Department</label>
                                    <select id="line_change_department" class="form-control input-sm line_change_department">
                                        <option value="">Select Department</option>
                                        <?php foreach ($departments as $key => $r) { ?>
                                            <option value="<?= $r->dept_id ?>"><?= $r->dept_name .' >> '. $r->unit_name ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6" style="padding-left: 5px!important; padding-right: 0px!important;">
                                <div class="form-group">
                                    <label class="control-label">Section</label>
                                    <select id="line_change_section" class="form-control input-sm line_change_section">
                                        <option value="">Select Section</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6" style="padding-left: 0px!important; padding-right: 5px!important;">
                                <div class="form-group">
                                    <label class="control-label">Line</label>
                                    <select id="line_change_line" class="form-control input-sm line_change_line">
                                        <option value="">Select Line</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6" style="padding-left: 5px!important; padding-right: 0px!important;">
                                <div class="form-group">
                                    <label class="control-label">Designation</label>
                                    <select id="line_change_desig" class="form-control input-sm line_change_desig">
                                        <option value="">Select Designation</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row" top='20px'>
                            <div class="col-md-3 pull-right">
                                <div class="input-group pull-right" style="">
                                    <span class="input-group-btn">
                                        <input class="btn btn-primary" onclick='add_weekend()' type="button" value='Update' />
                                    </span>
                                </div><!-- /input-group -->
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4 tablebox">
        <input type="text" id="searchi" class="form-control" placeholder="Search">
        <div style="height: 80vh; overflow-y: scroll;">
            <table class="table table-hover" id="fileDiv">
                <thead>
                    <tr style="position: sticky;top: 0;z-index:1">
                        <th class="active" style="width:10%"><input type="checkbox" id="select_all"
                                class="select-all checkbox" name="select-all"></th>
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
                    <?php } } ?>
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
    function get_emp_info_promotion() {

        var checkboxes = document.getElementsByName('emp_id[]');
        var sql = get_checked_value(checkboxes);
        let numbersArray = sql.split(",");
        if (numbersArray == '') {
            showMessage('error', 'Please select employee Id');
            setTimeout(() => {
                $("#loader").hide();
                $("#increment_entry").hide();
                $("#promotion_entry").hide();
                $("#line_change").hide();
            }, 500);
            return false;
        }
        if (numbersArray.length > 1) {
            showMessage('error', 'Please select max one employee Id');
            setTimeout(() => {
                $("#loader").hide();
                $("#increment_entry").hide();
                $("#promotion_entry").hide();
                $("#line_change").hide();
            }, 500);
            return false;
        }
        unit_id = document.getElementById('unit_id').value;
        if (unit_id == '') {
            showMessage('error', 'Please select Unit');
            setTimeout(() => {
                $("#loader").hide();
                $("#increment_entry").hide();
                $("#promotion_entry").hide();
                $("#line_change").hide();
            }, 500);
            return false;
        }

        $.ajax({
            type: "POST",
            contentType: "application/json",
            dataType: "json",
            url: hostname + "common/get_emp_info_by_id/"+numbersArray[0]+"/"+unit_id,
            success: function(d) {
                console.log(d);
                $("#loader").hide();
                $("#promotion_entry").show();
                $('#profile_image').attr('src', hostname + 'uploads/photo/' + d.img_source);
                $('#emp_name').html(d.name_en);
                $('#departments_ids').html(d.dept_name);
                $('#sections_ids').html(d.sec_name_en);
                $('#emps_ids').html(d.emp_id);
                $('#lines_ids').html(d.line_name_en);
                $('#desigs_id').html(d.desig_name);
                $('#salary').val(d.gross_sal);
                $('#com_salary').val(d.com_gross_sal);
            },
            error: function() {
                $("#loader").hide();
                alert('Something went wrong');
            }
        })
    }
    function get_emp_info_increment() {

        var checkboxes = document.getElementsByName('emp_id[]');
        var sql = get_checked_value(checkboxes);
        let numbersArray = sql.split(",");
        if (numbersArray == '') {
            showMessage('error', 'Please select employee Id');
            setTimeout(() => {
                $("#loader").hide();
                $("#increment_entry").hide();
                $("#promotion_entry").hide();
                $("#line_change").hide();
            }, 500);
            return false;
        }
        if (numbersArray.length > 1) {
            showMessage('error', 'Please select max one employee Id');
            setTimeout(() => {
                $("#loader").hide();
                $("#increment_entry").hide();
                $("#promotion_entry").hide();
                $("#line_change").hide();
            }, 500);
            return false;
        }
        unit_id = document.getElementById('unit_id').value;
        if (unit_id == '') {
            showMessage('error', 'Please select Unit');
            setTimeout(() => {
                $("#loader").hide();
                $("#increment_entry").hide();
                $("#promotion_entry").hide();
                $("#line_change").hide();
            }, 500);
            return false;
        }

        $.ajax({
            type: "POST",
            contentType: "application/json",
            dataType: "json",
            url: hostname + "common/get_emp_info_by_id/"+numbersArray[0]+"/"+unit_id,
            success: function(d) {
                console.log(d);
                $("#loader").hide();
                $("#increment_entry").show();
                $('#inc_profile_image').attr('src', hostname + 'uploads/photo/' + d.img_source);
                $('#inc_emp_name').html(d.name_en);
                $('#inc_departments_ids').html(d.dept_name);
                $('#inc_sections_ids').html(d.sec_name_en);
                $('#inc_emps_ids').html(d.emp_id);
                $('#inc_lines_ids').html(d.line_name_en);
                $('#inc_desigs_id').html(d.desig_name);
                $('#inc_salary').val(d.gross_sal);
                $('#inc_com_salary').val(d.com_gross_sal);
            },
            error: function() {
                $("#loader").hide();
                alert('Something went wrong');
            }
        })
    }
    function get_emp_info_line() {

        var checkboxes = document.getElementsByName('emp_id[]');
        var sql = get_checked_value(checkboxes);
        let numbersArray = sql.split(",");
        if (numbersArray == '') {
            showMessage('error', 'Please select employee Id');
            setTimeout(() => {
                $("#loader").hide();
                $("#increment_entry").hide();
                $("#promotion_entry").hide();
                $("#line_change").hide();
            }, 500);
            return false;
        }
        if (numbersArray.length > 1) {
            showMessage('error', 'Please select max one employee Id');
            setTimeout(() => {
                $("#loader").hide();
                $("#increment_entry").hide();
                $("#promotion_entry").hide();
                $("#line_change").hide();
            }, 500);
            return false;
        }
        unit_id = document.getElementById('unit_id').value;
        if (unit_id == '') {
            showMessage('error', 'Please select Unit');
            setTimeout(() => {
                $("#loader").hide();
                $("#increment_entry").hide();
                $("#promotion_entry").hide();
                $("#line_change").hide();
            }, 500);
            return false;
        }

        $.ajax({
            type: "POST",
            contentType: "application/json",
            dataType: "json",
            url: hostname + "common/get_emp_info_by_id/"+numbersArray[0]+"/"+unit_id,
            success: function(d) {
                console.log(d);
                $("#loader").hide();
                $("#line_change").show();
                $('#line_profile_image').attr('src', hostname + 'uploads/photo/' + d.img_source);
                $('#line_emp_name').html(d.name_en);
                $('#line_departments_ids').html(d.dept_name);
                $('#line_sections_ids').html(d.sec_name_en);
                $('#line_emps_ids').html(d.emp_id);
                $('#line_lines_ids').html(d.line_name_en);
                $('#line_desigs_id').html(d.desig_name);
                $('#line_salary').val(d.gross_sal);
                $('#line_com_salary').val(d.com_gross_sal);
            },
            error: function() {
                $("#loader").hide();
                alert('Something went wrong');
            }
        })
    }
</script>

<script>
    function increment_entry_form(e) {
        e.preventDefault();

        var checkboxes = document.getElementsByName('emp_id[]');
        var sql = get_checked_value(checkboxes);
        let numbersArray = sql.split(",");
        if (numbersArray == '') {
            showMessage('error', 'Please select employee Id');
            return false;
        }
        if (numbersArray.length > 1) {
            showMessage('error', 'Please select max one employee Id');
            return false;
        }
        unit_id = document.getElementById('unit_id').value;
        if (unit_id == '') {
            showMessage('error', 'Please select Unit');
            return false;
        }
        return ;
        var formdata = $("#increment_entry_form").serialize();
        var data = "unit_id=" + unit_id + "&emp_id=" + numbersArray[0] + "&" + formdata; // Merge the data
        console.log(data);

        $.ajax({
            type: "POST",
            url: hostname + "entry_system_con/increment_entry",
            data: data,
            success: function(data) {
                $("#loader").hide();
                if (data == 'success') {
                    showMessage('success', 'Increment Added Successfully');
                } else {
                    showMessage('error', 'Increment Not Added');
                }
            },
            error: function(data) {
                $("#loader").hide();
                showMessage('error', 'Increment Not Added');
            }
        })
    }
</script>

<script>
    //section dropdown
    $('#line_change_department').change(function() {
        $('.line_change_section').addClass('form-control input-sm');
        $(".line_change_section > option").remove();
        $(".line_change_line > option").remove();
        $(".line_change_desig > option").remove();
        var id = $('#line_change_department').val();
        $.ajax({
            type: "POST",
            url: hostname + "common/ajax_section_by_dept_id/" + id,
            success: function(func_data) {
                $('.line_change_section').append("<option value=''>-- Select District --</option>");
                $.each(func_data, function(id, name) {
                    var opt = $('<option />');
                    opt.val(id);
                    opt.text(name);
                    $('.line_change_section').append(opt);
                });
            }
        });
    });
    //Line dropdown
    $('#line_change_section').change(function() {
        $('.line_change_line').addClass('form-control input-sm');
        $(".line_change_line > option").remove();
        $(".line_change_desig > option").remove();
        var id = $('#line_change_section').val();
        $.ajax({
            type: "POST",
            url: hostname + "common/ajax_line_by_sec_id/" + id,
            success: function(func_data) {
                $('.line_change_line').append("<option value=''>-- Select District --</option>");
                $.each(func_data, function(id, name) {
                    var opt = $('<option />');
                    opt.val(id);
                    opt.text(name);
                    $('.line_change_line').append(opt);
                });
            }
        });
    });
    //Designation dropdown
    $('#line_change_line').change(function() {
        $('.line_change_desig').addClass('form-control input-sm');
        $(".line_change_desig > option").remove();
        var id = $('#line_change_line').val();
        $.ajax({
            type: "POST",
            url: hostname + "common/ajax_designation_by_line_id/" + id,
            success: function(func_data) {
                $('.line_change_desig').append("<option value=''>-- Select District --</option>");
                $.each(func_data, function(id, name) {
                    var opt = $('<option />');
                    opt.val(id);
                    opt.text(name);
                    $('.line_change_desig').append(opt);
                });
            }
        });
    });
</script>
<script>
    //section dropdown
    $('#pro_department').change(function() {
        $('.pro_section').addClass('form-control input-sm');
        $(".pro_section > option").remove();
        $(".pro_line > option").remove();
        $(".pro_designation > option").remove();
        var id = $('#pro_department').val();
        $.ajax({
            type: "POST",
            url: hostname + "common/ajax_section_by_dept_id/" + id,
            success: function(func_data) {
                $('.pro_section').append("<option value=''>-- Select District --</option>");
                $.each(func_data, function(id, name) {
                    var opt = $('<option />');
                    opt.val(id);
                    opt.text(name);
                    $('.pro_section').append(opt);
                });
            }
        });
    });
    //Line dropdown
    $('#pro_section').change(function() {
        $('.pro_line').addClass('form-control input-sm');
        $(".pro_line > option").remove();
        $(".pro_designation > option").remove();
        var id = $('#pro_section').val();
        $.ajax({
            type: "POST",
            url: hostname + "common/ajax_line_by_sec_id/" + id,
            success: function(func_data) {
                $('.pro_line').append("<option value=''>-- Select District --</option>");
                $.each(func_data, function(id, name) {
                    var opt = $('<option />');
                    opt.val(id);
                    opt.text(name);
                    $('.pro_line').append(opt);
                });
            }
        });
    });
    //Designation dropdown
    $('#pro_line').change(function() {
        $('.pro_designation').addClass('form-control input-sm');
        $(".pro_designation > option").remove();
        var id = $('#pro_line').val();
        $.ajax({
            type: "POST",
            url: hostname + "common/ajax_designation_by_line_id/" + id,
            success: function(func_data) {
                $('.pro_designation').append("<option value=''>-- Select District --</option>");
                $.each(func_data, function(id, name) {
                    var opt = $('<option />');
                    opt.val(id);
                    opt.text(name);
                    $('.pro_designation').append(opt);
                });
            }
        });
    });
</script>
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
<script>
    function loading_open() {
        $('#loader').css('display', 'block');
    }
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
                        items += '<tr class="removeTr">';
                        items +=
                            '<td><input type="checkbox" class="checkbox" id="emp_id" name="emp_id[]" value="' +
                            value.emp_id + '" ></td>';
                        items += '<td class="success">' + value.emp_id + '</td>';
                        items += '<td class="warning ">' + value.name_en + '</td>';
                        items += '</tr>';
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
<script>
    function get_checked_value(checkboxes) {
        var vals = Array.from(checkboxes)
            .filter(checkbox => checkbox.checked)
            .map(checkbox => checkbox.value)
            .join(",");
        return vals;
    }
</script>
<script>
    function toggleSection(sectionId) {
        if (sectionId == 'increment') {
            $("#promotion_entry").hide();
            $("#line_change").hide();
            get_emp_info_increment();
        } else if(sectionId == 'promotion') {
            $("#increment_entry").hide();
            $("#line_change").hide();
            get_emp_info_promotion();
        } else {
            $("#promotion_entry").hide();
            $("#increment_entry").hide();
            get_emp_info_line();
        }
        $("#" + sectionId).slideToggle();
    }
    // Initial hiding of all sections
    $("#increment_entry, #promotion_entry, #line_change").hide();
</script>




