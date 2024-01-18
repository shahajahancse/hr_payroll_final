
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
        
        $user_id = $this->session->userdata('data')->id;
        $acl = check_acl_list($user_id);
    ?>
    <div class="content">
        <!-- Left side for report section -->
        <div class="col-md-8">
            <!-- selection area -->
            <div class="row tablebox" style="margin-bottom: 10px;">
                <div class="row" style="justify-content: center!important; display: flex; flex-wrap: wrap;">
                    <div class="col-md-5">
                        <div class="form-group">
                            <h4 class="control-label" style="font-weight: bold;">Select Salary Month </h4>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <input type="month" onChange="grid_emp_list()" class="form-control" id="salary_month" value="<?= date('Y-m') ?>">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row tablebox" style="display: block; margin-bottom: 10px;">
                <h3 class="h3" style="font-weight: 600;">Select Category</h3>
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
                <div class="col-md-3">
                    <?php $categorys = $this->db->get('emp_category_status')->result(); ?>
                    <div class="form-group">
                        <label class="control-label">Status </label>
                        <select name="status" id="status" class="form-control input-sm" onChange="grid_emp_list()">
                            <option value="">All Employee</option>
                            <?php foreach ($categorys as $key => $row) { ?>
                            <option value="<?= $row->id ?>"><?= $row->status_type; ?>
                            </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="control-label">Salary </label>
                        <select name="stop_salary" id="stop_salary" class="form-control input-sm" onChange="grid_emp_list()">
                            <option value="1">Running</option>
                            <option value="2">Stop</option>
                        </select>
                    </div>
                </div>
            </div>
            <!-- selection area -->

            <!-- Report are -->
            <div class="row tablebox" style="margin-bottom: 15px;">
                <div class='multitab-section'>
                    <ul class="nav nav-tabs" id="myTabs">
                        <li class="active"><a href="#daily" data-toggle="tab">Salary Reports</a></li>
                        <li><a href="#other_benifits" data-toggle="tab">Others Benefit Reports</a></li>
                        <li><a href="#earn_leave" data-toggle="tab"> Earn Leave Reports</a></li>
                    </ul>
                    <div class="tab-content">
                        <!-- salary report  -->
                        <div class="tab-pane fade in active" id="daily">
                            <?php if(in_array(77,$acl)) { ?>
                            <button class="btn input-sm sbtn" onclick="monthly_salary_sheet()">Monthly Salary Sheet</button>
                            <?php } ?>
                            <?php if(in_array(78,$acl)) { ?>
                            <button class="btn input-sm sbtn" onclick="grid_pay_slip()">Pay Slip</button>
                            <?php } ?>
                            <?php if(in_array(79,$acl)) { ?>
                            <button class="btn input-sm sbtn" onclick="sal_summary_report()">Actual Salary Summary</button>
                            <?php } ?>
                            <?php if(in_array(80,$acl)) { ?>
                            <button class="btn input-sm sbtn" onclick="sec_sal_summary_report()">Sec Wise Salary Summary</button>
                            <?php } ?>


                            <?php if(in_array(81,$acl)) { ?>
                            <button class="btn input-sm sbtn" onclick="actual_monthly_salary_sheet()">Actual Salary Sheet</button>
                            <?php } ?>
                            <?php if(in_array(82,$acl)) { ?>
                            <button class="btn input-sm sbtn" onclick="grid_pay_slip_actual()">Actual Pay Slip </button>
                            <?php } ?>
                            <?php if(in_array(83,$acl)) { ?>
                            <button class="btn input-sm sbtn" onclick="grid_mix_salary_sheet()">Salary Sheet BFL</button>
                            <?php } ?>
                            <?php if(in_array(84,$acl)) { ?>
                            <button class="btn input-sm sbtn" onclick="grid_actual_monthly_salary_sheet_with_eot()">Act. Monthly Sal. Sheet EOT</button>
                            <?php } ?>


                            <?php if(in_array(85,$acl)) { ?>
                            <button class="btn input-sm sbtn" onclick="monthly_salary_sheet_nine_pm()">Salary Sheet Nine</button>
                            <?php } ?>
                            <?php if(in_array(86,$acl)) { ?>
                            <button class="btn input-sm sbtn" onclick="grid_pay_slip_com()">Pay Slip</button>
                            <?php } ?>
                        </div>
                        <!-- salary report end  -->

                        <!-- Others Benefit Report -->
                        <div class="tab-pane fade" id="other_benifits">
                            <?php if(in_array(87,$acl)) { ?>
                            <button class="btn input-sm sbtn" onclick="grid_festival_bonus()">Festival Bonus</button>
                            <?php } ?>
                            <?php if(in_array(88,$acl)) { ?>
                            <button class="btn input-sm sbtn" onclick="grid_festival_bonus_summary()">Festival Bonus Summary</button>
                            <?php } ?>
                            <?php if(in_array(89,$acl)) { ?>
                            <button class="btn input-sm sbtn" onclick="grid_festival_bonus_summary_sec_wise()">Festival Bonus Summary(Sec)</button>
                            <?php } ?>
                            <?php if(in_array(90,$acl)) { ?>
                            <button class="btn input-sm sbtn" onclick="grid_advance_salary_sheet()">Advance Salary Sheet</button>
                            <?php } ?>
                            <?php if(in_array(91,$acl)) { ?>
                            <button class="btn input-sm sbtn" onclick="grid_comprative_salary_statement()">Comparative Statement</button>
                            <?php } ?>
                            <?php if(in_array(92,$acl)) { ?>
                            <button class="btn input-sm sbtn" onclick="grid_maternity_benefit()">Maternity Benefit Report</button>
                            <?php } ?>
                        </div>
                        <!-- Others Benefit Report end -->


                        <div class="tab-pane fade" id="earn_leave">
                            <?php if(in_array(93,$acl)) { ?>
                            <button class="btn input-sm sbtn" onclick="grid_earn_leave_payment_buyer()">Earn Leave Payment Sheet</button>
                            <?php } ?>
                            <?php if(in_array(94,$acl)) { ?>
                            <button class="btn input-sm sbtn" onclick="grid_earn_leave_general_info()">Actual Earn Leave Payment Sheet</button>
                            <?php } ?>
                            <?php if(in_array(95,$acl)) { ?>
                            <button class="btn input-sm sbtn" onclick="grid_earn_leave_summery()">Earn Leave Summery Sheet</button>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Report are end -->
        </div>
        <!-- Left side end -->

        <!-- right side to select employee on list -->
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
                        <td><input type="checkbox" class="checkbox" id="emp_id" name="emp_id[]" value="<?= $emp->emp_id ?>">
                        </td>
                        <td class="success"><?= $emp->emp_id ?></td>
                        <td class="warning "><?= $emp->name_en ?></td>
                    </tr>
                    <?php } } ?>
                </table>
            </div>
        </div>
    </div>

    <script src="<?php echo base_url(); ?>js/grid_content.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>js/grid_content.js" type="text/javascript"></script>
    <script type="text/javascript">
        // on load employee
        function grid_emp_list() {
            var unit = document.getElementById('unit_id').value;
            alert(unit);
            var dept = document.getElementById('dept').value;
            var section = document.getElementById('section').value;
            var line = document.getElementById('line').value;
            var desig = document.getElementById('desig').value;
            var status = document.getElementById('status').value;
            var stop_salary = document.getElementById('stop_salary').value;
            var salary_month = document.getElementById('salary_month').value;

            if (typeof unit === "undefined" || unit = '') {
                return 'Please Select Unit First';
            }

            url = hostname + "common/salary_emp_list/" + unit + "/" + dept + "/" + section + "/" + line + "/" + desig;
            $.ajax({
                url: url,
                type: 'GET',
                data: {
                    "status"      : status,
                    "stop_salary" : stop_salary,
                    "salary_month": salary_month,
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
                                value.emp_id + '" ></td>';
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