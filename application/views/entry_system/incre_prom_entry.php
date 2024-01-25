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
        <br>
        <div id="loader" align="center" style="margin:0 auto; overflow:hidden; display:none; margin-top:10px;">
            <img src="<?php echo base_url('images/ajax-loader.gif');?>" />
        </div>
        <div class="row nav_head">
            <div class="col-lg-6">
                <span style="font-size: 20px;"><?= $title ?></span>
            </div><!-- /.col-lg-6 -->
            <div class="col-lg-6">
                <div class="input-group" style="display:flex; gap: 14px">
                    <input class="btn btn-primary" onclick='toggleSection("increment_entry")' type="button"
                        value='Increment Entry' />
                    <input class="btn btn-info" onclick='toggleSection("promotion_entry")' type="button"
                        value='Promotion Entry' />
                </div><!-- /input-group -->
            </div><!-- /.col-lg-6 -->
        </div><!-- /.row -->
        <div id="increment_entry" class="row nav_head" style="margin-top: 13px;">
            <form class="col-md-12" action="<?= base_url('entry_system_con/increment_entry') ?>" method="post"
                id="increment_entry_form">
                <div class="col-md-12">
                    <div class="raw">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">From Date</label>
                                <input type="date" class="form-control input-sm" id="from_date" name="from_date"
                                    value="<?= date('Y-m-d') ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">To Date</label>
                                <input type="date" class="form-control input-sm" id="to_date" name="to_date"
                                    value="<?= date('Y-m-d') ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Leave Type</label>
                                <select class="form-control select22" name='leave_type' id='leave_type'
                                    style="padding: 1px 12px; height: 29px;">
                                    <option value='cl'>Casual</option>
                                    <option value='sl'>Sick</option>
                                    <option value='pl'>Paternity</option>
                                    <option value='ml'>Maternity</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group" style="margin: 8px 16px;">
                                <label class="control-label">Description</label>
                                <textarea class="form-control input-sm" id="reason" name="reason"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12" style="margin: 8px -16px; display: flex; justify-content: flex-end;">
                            <input type="button" onclick="leave_add(event)" value="Submit" class="btn btn-primary">
                        </div>
                    </div>
                </div>
            </form>
        </div><!-- /.row -->
        <div id="promotion_entry" class="row nav_head" style="margin-top: 13px;">
            <div class="col-md-12" style="display: flex;gap: 11px;flex-direction: column;">
                <div class="col-md-12" style="box-shadow: 0px 0px 2px 2px #bdbdbd;border-radius: 4px;padding-top: 8px;">
                    <div class="row">
                        <div class="col-md-8">
                            <div style="display: flex; gap: 10px">
                                <span>
                                    <img id="profile_image" style="height: 78px;width: 100px;" class="img-responsive"
                                        alt="">
                                </span>
                                <p style="font-size: 20px;">Name: <span id="emp_name"> </span></p>
                                <p style="">Dept: <span id="departments_ids"> </span></p>
                                <p style="">Sec : <span id="sections_ids"> </span></p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <p style="">Emp Id: <span id="emps_ids"> </span></p>
                                <p style="">Line  : <span id="lines_ids"> </span></p>
                                <p style="">Desig : <span id="desigs_id"> </span></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12" style="box-shadow: 0px 0px 2px 2px #bdbdbd;border-radius: 4px;padding-top: 8px;">
                    <table class="table col-md-12">
                        <thead>
                            <tr>
                                <th>Leave Type</th>
                                <th>Entitle</th>
                                <th>Taken</th>
                                <th>Balance</th>
                            </tr>
                        </thead>
                        <tbody id="leave_balance">
                            <tr>
                                <th>Casual Leave</th>
                                <td id="leave_entitle_casual">12</td>
                                <td id="leave_taken_casual">6</td>
                                <td id="leave_balance_casual">5</td>
                            </tr>
                            <tr>
                                <th>Sick Leave</th>
                                <td id="leave_entitle_sick">12</td>
                                <td id="leave_taken_sick">4</td>
                                <td id="leave_balance_sick">8</td>
                            </tr>
                            <tr>
                                <th>Maternity Leave</th>
                                <td id="leave_entitle_maternity">12</td>
                                <td id="leave_taken_maternity">4</td>
                                <td id="leave_balance_maternity">8</td>
                            </tr>
                            <tr>
                                <th>Paternity Leave</th>
                                <td id="leave_entitle_paternity">12</td>
                                <td id="leave_taken_paternity">4</td>
                                <td id="leave_balance_paternity">8</td>
                            </tr>
                        </tbody>

                    </table>
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
    function get_emp_info_by_id() {

        var checkboxes = document.getElementsByName('emp_id[]');
        var sql = get_checked_value(checkboxes);
        let numbersArray = sql.split(",");
        if (numbersArray == '') {
            showMessage('error', 'Please select employee Id');
            setTimeout(() => {
                $("#loader").hide();
                $("#increment_entry").hide();
                $("#promotion_entry").hide();
            }, 500);
            return false;
        }
        if (numbersArray.length > 1) {
            showMessage('error', 'Please select max one employee Id');
            setTimeout(() => {
                $("#loader").hide();
                $("#increment_entry").hide();
                $("#promotion_entry").hide();
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
                $('#sections_ids').html(d.sec_name_bn);
                $('#emps_ids').html(d.emp_id);
                $('#lines_ids').html(d.line_name_en);
                $('#desigs_id').html(d.desig_name);

                /*$('#leave_entitle_casual').html(d.leave_entitle_casual);
                $('#leave_entitle_sick').html(d.leave_entitle_sick);
                $('#leave_entitle_maternity').html(d.leave_entitle_maternity);
                $('#leave_entitle_paternity').html(d.leave_entitle_paternity);
                $('#leave_taken_casual').html(d.leave_taken_casual);
                $('#leave_taken_sick').html(d.leave_taken_sick);
                $('#leave_taken_maternity').html(d.leave_taken_maternity);
                $('#leave_taken_paternity').html(d.leave_taken_paternity);
                $('#leave_balance_casual').html(d.leave_balance_casual);
                $('#leave_balance_sick').html(d.leave_balance_sick);
                $('#leave_balance_maternity').html(d.leave_balance_maternity);
                $('#leave_balance_paternity').html(d.leave_balance_paternity);*/
            },
            error: function() {
                $("#loader").hide();
                alert('Something went wrong');
            }
        })
    }
</script>

<script>
    function leave_add(e) {
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
                    showMessage('success', 'Leave Added Successfully');
                } else {
                    showMessage('error', 'Leave Not Added');
                }
            },
            error: function(data) {
                $("#loader").hide();
                showMessage('error', 'Leave Not Added');
            }
        })
    }
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
        if (sectionId == 'increment_entry') {
            $("#promotion_entry").hide();
            get_emp_info_by_id();
        } else {
            $("#increment_entry").hide();
            get_emp_info_by_id();
        }
        $("#" + sectionId).slideToggle();
    }
    // Initial hiding of both sections
    $("#increment_entry, #promotion_entry").hide();
</script>




