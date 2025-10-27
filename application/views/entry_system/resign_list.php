<style>
    .inputs{
        background: white !important;
        width: 100% !important;
        
    }
    td{
        text-align: center;
        vertical-align: middle !important;
        padding: 0px !important;
    }
    .form-control {
        width: 60%;
        display: inline-block !important;
        text-align: center;
        min-height: 25px !important;
    }
    .tables th, .tables td{
        padding: 0px !important;
    }
    input[type=number] {
        -moz-appearance: textfield;
        appearance: textfield;
        font-size: 15px;
        font-family: SutonnyMJ;
    }
</style>    

<div class="content">
    <nav class="navbar navbar-inverse bg_none">
        <div class="container-fluid nav_head">
            <div class="navbar-header col-md-5">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div>
                    <a class="btn btn-info" href="<?php echo base_url('entry_system_con/left_resign_entry') ?>">Add Resign</a>
                    <a class="btn btn-primary" href="<?php echo base_url('payroll_con') ?>">Home</a>
                </div>
            </div>
            <div class="col-md-7">
                <div id="navbar" class="navbar-collapse collapse">
                    <div class="">
                        <form class="navbar-form pull-right" role="search">
                            <div class="input-group">
                                <input id="deptSearch" type="text" class="form-control" placeholder="Search">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!--/.nav-collapse -->
        </div>
        <!--/.container-fluid -->
    </nav>
    <div class="row">
        <div class="col-md-12">
            <?php $success = $this->session->flashdata('success');
                if ($success != "") { ?>
                <div class="alert alert-success"><?php echo $success; ?></div>
                <?php } 
                $failuer = $this->session->flashdata('failuer');
                if ($failuer) { ?>
                <div class="alert alert-failuer"><?php echo $failuer; ?></div>
            <?php } ?>
        </div>
    </div>
    <!-- <br> -->
    <div class="row tablebox">

        <div class="col-md-12">
            <table class="table table-striped text-center" id="">
                <thead class="text-center">
                    <tr class="text-center">
                        <th class="text-center">SL</th>
                        <th class="text-center">Emp Name </th>
                        <th class="text-center">Emp Id</th>
                        <th class="text-center">Unit name</th>
                        <th class="text-center">Date</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody id="tbody">
                </tbody>
            </table>
        </div>
    </div>
    <br><br>

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title h4" id="myModalLabel"> Final Satalment</span>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="#" method="post" id="form">
                        <input type="hidden" name="form_id" id="form_id">
                        <div class="row" style="font-size: 15px;">
                            <div class="col-md-4">
                                নাম	:	<span id="full_name"></span>
                            </div>
                            <div class="col-md-4">
                                কার্ড	:	<span id="card_no" style="font-family: SutonnyMJ;"></span>
                            </div>
                            <div class="col-md-4">
                                পদবী	:	<span style="font-family: SutonnyMJ;" id="designation_name"></span>
                            </div>
                        </div>
                        <div class="row" style="font-size: 15px;">
                            <div class="col-md-4">
                                সেকশন	:	<span style="font-family: SutonnyMJ;" id="section_name"></span>
                            </div>
                            <div class="col-md-4">
                                যোগদানের তারিখ	:	<span id="joining_date" style="font-family: SutonnyMJ;"></span> ইং

                            </div>
                            <div class="col-md-4">
                                শেষ কর্মদিবস	:	<span id="last_working_date" style="font-family: SutonnyMJ;"> </span> ইং
                            </div> 
                        </div>
                        <div class="row" style="font-size: 15px;">
                            <div class="col-md-4">
                                চাকুরীকাল	:	<span id="job_duration"> </span>
                            </div>
                            <div class="col-md-4">
                                মোট বেতন	:	<span id="com_gross_salary" style="font-family:SutonnyMJ"> </span> টাকা
                            </div>
                            <div class="col-md-4">
                                মূল বেতন	:	<span id="basic_salary" style="font-family:SutonnyMJ"> </span> টাকা
                            </div>
                        </div>
                        <div class="row" style="font-size: 15px;">
                            <div class="col-md-4">
                                প্রতি ঘন্টার ওভার টাইম হার	:	<span id="ot_rate" style="font-family:SutonnyMJ"> </span> টাকা
                        </div>

                        <table class="table table-bordered ml-3 inputs tables" style="border: 1px solid #d6d1d1 !important;">
                                <!-- title section  -->
                            <tr class="text-center">
                                <th class="text-center" style="border: 1px solid #d6d1d1 !important;">বিষয় </th>
                                <th class="text-center" style="border: 1px solid #d6d1d1 !important;">দিন/ ঘন্টা </th>
                                <th class="text-center" style="border: 1px solid #d6d1d1 !important;">হার </th>
                                <th class="text-center" style="border: 1px solid #d6d1d1 !important;">টাকা</th>
                            </tr>
                            <!-- salary -->
                            <tr>
                                <td style="border: 1px solid #d6d1d1 !important; width:51%;">চলতি মাসের বেতন</td>
                                <td style="border: 1px solid #d6d1d1 !important;"><input type="number" class="form-control" name="salary_pay_day" id="salary_pay_day" onkeyup="current_sal_cal()"></td>
                                <td style="border: 1px solid #d6d1d1 !important;"><span id="pay_salary_har" style="font-size: 15px;font-family: SutonnyMJ;"></span></td>
                                <td style="border: 1px solid #d6d1d1 !important;"><span class="working_pay_salary" id="working_pay_salary" style="font-size: 15px;font-family: SutonnyMJ;" min="0"></td>
                            </tr>
                            <!-- attendance bonus -->
                            <tr>
                                <td style="border: 1px solid #d6d1d1 !important; width:51%;">হাজিরা বোনাস</td>
                                <td colspan="2" style="border: 1px solid #d6d1d1 !important; color:transparent">.</td>
                                <td style="border: 1px solid #d6d1d1 !important;"><input id="atten_bonus" type="number" class="form-control" name="atten_bonus">
                                </td>
                            </tr>

                            <?php 
                                $user_id = $this->session->userdata('data')->id;
                                $acl = check_acl_list($user_id);
                            ?>

                            <!-- ot 7 pm of 2 hours -->
                            <?php if(in_array(133,$acl)) { ?>
                            <tr>
                                <td style="border: 1px solid #d6d1d1 !important; width:51%;">চলতি মাসের ওভার টাইম </td>
                                <td style="border: 1px solid #d6d1d1 !important;"><input type="number" class="form-control" name="ot_pay_7pm" id="ot_pay_7pm" onkeyup="ot_pay_7pm_cal()"></td>
                                <td style="border: 1px solid #d6d1d1 !important;"><span class="ot_rate_ot" style="font-size: 15px;font-family: SutonnyMJ;"></span></td>
                                <td style="border: 1px solid #d6d1d1 !important;"><span id="ot_pay_amt_7am" style="font-size: 15px;font-family: SutonnyMJ;" min="0"></td>
                            </tr>
                            <?php } ?>

                            <!-- ot 9pm of 4 hours -->
                            <?php if(in_array(134,$acl)) { ?>
                            <tr>
                                <td style="border: 1px solid #d6d1d1 !important; width:51%;">চলতি মাসের ওভার টাইম </td>
                                <td style="border: 1px solid #d6d1d1 !important;"><input type="number" class="form-control" name="ot_pay_9pm" id="ot_pay_9pm" onkeyup="ot_pay_9pm_cal()"></td>
                                <td style="border: 1px solid #d6d1d1 !important;"><span class="ot_rate_ot" style="font-size: 15px;font-family: SutonnyMJ;"></span></td>
                                <td style="border: 1px solid #d6d1d1 !important;"><span id="ot_pay_amt_9am" style="font-size: 15px;font-family: SutonnyMJ;" min="0"></td>
                            </tr>
                            <?php } ?>

                            <!-- ot 12pm of 7 hours -->
                            <?php if(in_array(135,$acl)) { ?>
                            <tr>
                                <td style="border: 1px solid #d6d1d1 !important; width:51%;">চলতি মাসের ওভার টাইম </td>
                                <td style="border: 1px solid #d6d1d1 !important;"><input type="number" class="form-control" name="ot_pay_12pm" id="ot_pay_12pm" onkeyup="ot_pay_12pm_cal()"></td>
                                <td style="border: 1px solid #d6d1d1 !important;"><span class="ot_rate_ot" style="font-size: 15px;font-family: SutonnyMJ;"></span></td>
                                <td style="border: 1px solid #d6d1d1 !important;"><span id="ot_pay_amt_12am" style="font-size: 15px;font-family: SutonnyMJ;" min="0"></td>
                            </tr>
                            <?php } ?>

                            <!-- ot all with out w/h day -->
                            <?php if(in_array(136,$acl)) { ?>
                            <tr>
                                <td style="border: 1px solid #d6d1d1 !important; width:51%;">চলতি মাসের ওভার টাইম </td>
                                <td style="border: 1px solid #d6d1d1 !important;"><input type="number" class="form-control" name="ot_pay_all" id="ot_pay_all" onkeyup="ot_pay_all_cal()"></td>
                                <td style="border: 1px solid #d6d1d1 !important;"><span class="ot_rate_ot" style="font-size: 15px;font-family: SutonnyMJ;"></span></td>
                                <td style="border: 1px solid #d6d1d1 !important;"><span id="ot_pay_amt_all" style="font-size: 15px;font-family: SutonnyMJ;" min="0"></td>
                            </tr>
                            <?php } ?>

                            <!-- ot actual -->
                            <?php if(in_array(132,$acl)) { ?>
                            <tr>
                                <td style="border: 1px solid #d6d1d1 !important; width:51%;">চলতি মাসের ওভার টাইম </td>
                                <td style="border: 1px solid #d6d1d1 !important;"><input type="number" class="form-control" name="ot_pay_actual" id="ot_pay_actual" onkeyup="ot_pay_actual_cal()"></td>
                                <td style="border: 1px solid #d6d1d1 !important;"><span class="ot_rate_ot" style="font-size: 15px;font-family: SutonnyMJ;"></span></td>
                                <td style="border: 1px solid #d6d1d1 !important;"><span id="ot_pay_amt_actual" style="font-size: 15px;font-family: SutonnyMJ;" min="0"></td>
                            </tr>
                            <?php } ?>
                            <!-- salary and ot section -->
                            
                            <tr><td colspan="4" style="border: 1px solid #d6d1d1 !important; color:transparent">.</td></tr>

                            <!-- others calculation here -->
                            <tr>
                                <td style="border: 1px solid #d6d1d1 !important; width:51%;">চাকুরী হইতে অবসান এর নোটিশ পে বাংলাদেশ শ্রম আইন ২০০৬ এর ধারা ২৬ (১)</td>
                                <td style="border: 1px solid #d6d1d1 !important;"><input type="number" class="form-control" name="resign_pay_day" id="resign_pay_day" onkeyup=first_r()></td>
                                <td style="border: 1px solid #d6d1d1 !important;"><span class="service_benifit_rate" id="service_benifit_rate" style="font-size: 15px;font-family: SutonnyMJ;"></span></td>
                                <td style="border: 1px solid #d6d1d1 !important;"><span class="total_resign_pay_day" id="total_resign_pay_day" style="font-size: 15px;font-family: SutonnyMJ;" min="0"></td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid #d6d1d1 !important;">অতিরিক্ত ক্ষতিপূরণ </td>
                                <td style="border: 1px solid #d6d1d1 !important;"><input type="number" class="form-control" name="extra_payoff" id="extra_payoff" onkeyup=second_r()></td>
                                <td style="border: 1px solid #d6d1d1 !important;"><span class="service_benifit_rate" style="font-size: 15px;font-family: SutonnyMJ;"></span></td>
                                <td style="border: 1px solid #d6d1d1 !important;"><span class="total_extra_payoff" id="total_extra_payoff" style="font-size: 15px;font-family: SutonnyMJ;"></td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid #d6d1d1 !important;">জমাকৃত অর্জিত ছুটির দিন উপস্থিতি</td>
                                <td style="border: 1px solid #d6d1d1 !important;"><input type="number" style="font-family:SutonnyMJ;font-size: 15px;" id="earn_leave_day" class="earn_leave form-control" onkeyup=third_r()></td>
                                <td style="border: 1px solid #d6d1d1 !important;"><span style="font-family:SutonnyMJ;font-size: 15px;" class="per_day_rate"></span></td>
                                <td style="border: 1px solid #d6d1d1 !important;"><span style="font-family:SutonnyMJ;font-size: 15px;" class="total_earn_leave" id="total_earn_leave"></span></td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid #d6d1d1 !important;" colspan="3">অন্যান্য পাওনাদি</td>
                                <td style="border: 1px solid #d6d1d1 !important;"><input type="number" class="another_deposit form-control" name="another_deposit" id="another_deposit" onkeyup=parshial_mot()></td>
                            </tr>
                            <!-- others calculation end -->

                             <!-- deduction start -->
                            <tr>
                                <td style="border: 1px solid #d6d1d1 !important;" colspan="4">কর্তন</td>
                            </tr>
                            <!-- absent -->
                            <tr>
                                <td style="border: 1px solid #d6d1d1 !important;">চলতি মাসের অনুপস্থিত কর্তন</td>
                                <td style="border: 1px solid #d6d1d1 !important;"><input type="number" class="form-control" name="absent_day" id="absent_day" onkeyup="absent_deduct_cal()" ></td>
                                <td style="border: 1px solid #d6d1d1 !important;"><span class="service_benifit_rate" style="font-size: 15px;font-family: SutonnyMJ;"></span></td>
                                <td style="border: 1px solid #d6d1d1 !important;"><span class="absent_deduct_amt" id="absent_deduct_amt" style="font-size: 15px;font-family: SutonnyMJ;"></span></td>
                            </tr>
                            <!-- absent end -->
                            <tr>
                                <td style="border: 1px solid #d6d1d1 !important;">নোটিশ পিরিয়ড কম বা না দেয়ার কারনে কোম্পানীর প্রাপ্য বাবদ কর্তন (মোট মজুরি থেকে)</td>
                                <td style="border: 1px solid #d6d1d1 !important;"><input type="number" class="form-control" name="notice_deduct" id="notice_deduct" onkeyup=noticeDeduct() ></td>
                                <td style="border: 1px solid #d6d1d1 !important;"><span class="service_benifit_rate" style="font-size: 15px;font-family: SutonnyMJ;"></span></td>
                                <td style="border: 1px solid #d6d1d1 !important;"><span class="total_notice_deduct" id="total_notice_deduct" style="font-size: 15px;font-family: SutonnyMJ;"></span></td>
                            </tr>
                            <tr>
                                <td colspan="3" style="border: 1px solid #d6d1d1 !important;">অগ্রীম বেতন</td>
                                <td style="border: 1px solid #d6d1d1 !important;"><input type="number" class="form-control" name="advanced_salary" id="advanced_salary"></td>
                            </tr>
                            <!-- deduction end -->
                        </table>
                        <input type="hidden" class="total_get" name="total_get">
                        <input type="hidden" class="total_deduct" name="total_deduct">
                        <input type="hidden" id="net_pay" name="net_pay">
                        <input type="hidden" id="hidden_gross_salary" name="hidden_gross_salary">
                        <input type="hidden" id="hidden_basic_salary" name="hidden_basic_salary">
                        <input type="hidden" id="hidden_ot_rate" name="hidden_ot_rate">
                        <input type="hidden" id="service_benifit" name="service_benifit">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-primary" id="save_button">Save</button>
                        <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

<script>
    $('#myModal').on('hidden.bs.modal', function () {
        $(this).find("input,textarea,select").val('').end().find("input[type=checkbox], input[type=radio]").prop("checked", "").end().find("option:selected").removeAttr("selected");
    })
    function final_satalment(id) {
        document.getElementById("form").reset();
        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>grid_con/final_satalment",
            data: {id: id},
            success: function (data) {
                $('#form_id').val(id);
                var employeeData = JSON.parse(data);
                $("#full_name").html(employeeData.name_bn);
                $("#card_no").html(employeeData.emp_id);
                $("#designation_name").html(employeeData.desig_bangla);
                $("#section_name").html(employeeData.sec_name_bn);
                $("#year").html(employeeData.resign_year);
                $("#joining_date").html(employeeData.emp_join_date.split('-').reverse().join('-'));

                var d = new Date(employeeData.resign_date);
                var bnMonths = ["জানুয়ারি", "ফেব্রুয়ারি", "মার্চ", "এপ্রিল", "মে", "জুন", "জুলাই", "আগস্ট", "সেপ্টেম্বর", "অক্টোবর", "নভেম্বর", "ডিসেম্বর"];
                var resign_date = d.toLocaleString('bn-BD', { year: 'numeric', month: 'long' });
                var year_str = "<span style='font-family:sutonnyMJ;font-size:16px'>"+d.getFullYear()+'</span>';

                $("#resign_date").html(bnMonths[d.getMonth()] + " " + year_str);
                $("#last_working_date").html(d.toLocaleString('en-US', { day: '2-digit', month: '2-digit', year: 'numeric' }).replace(/[^0-9]/g, "-").replace(/^(..)-(..)-(....)$/, "$2-$1-$3"));
                $("#job_duration").html(calculateJobDuration(employeeData.emp_join_date, employeeData.resign_date));
                $("#gross_salary").html(employeeData.gross_sal);
                $("#com_gross_salary").html(employeeData.com_gross_sal);
                $("#basic_salary").html(employeeData.basic_sal);
                $("#ot_rate").html(employeeData.ot_rate);  
                $(".ot_rate_ot").html(employeeData.ot_rate);  

                // salaray and ot calculation
                $("#salary_pay_day").val(employeeData.working_days);
                $("#atten_bonus").val(employeeData.att_bonus);
                // ot calculation
                $("#ot_pay_7pm").val(employeeData.ot_hour);
                $("#ot_pay_9pm").val(employeeData.ot_eot_4pm_hour);
                $("#ot_pay_12pm").val(employeeData.ot_eot_12am_hour);
                $("#ot_pay_all").val(employeeData.eot_hr_for_sa);
                $("#ot_pay_actual").val(employeeData.eot_hour);
                
                // absent deduction
                $("#absent_day").val(employeeData.absent_days);
                
                $("#hidden_gross_salary").val(employeeData.gross_sal);
                $("#hidden_com_gross_salary").val(employeeData.com_gross_sal);
                $("#hidden_basic_salary").val(employeeData.basic_sal);
                $("#hidden_ot_rate").val(employeeData.ot_rate); 
                $("#resign_pay_day").val(0); 
                $("#extra_payoff").val(0); 
                $("#earn_leave_day").val(0); 
                $("#another_deposit").val(0); 
                $("#notice_deduct").val(0); 
                $("#advanced_salary").val(0); 
                $("#service_benifit").val(calculateServiceBenifit(employeeData.emp_join_date, employeeData.resign_date));
            },
            complete: function () {
                current_sal_cal();
                absent_deduct_cal();
                ot_pay_7pm_cal();
                ot_pay_9pm_cal();
                ot_pay_12pm_cal();
                ot_pay_all_cal();
                ot_pay_actual_cal();
                first_r();
                second_r();
                third_r();
            }
        });
    }

    // Function to calculate job duration
    function calculateJobDuration(startDate, endDate) {
        var start = new Date(startDate);
        var end = new Date(endDate);
        var duration = end - start;
        var days = duration / (1000 * 60 * 60 * 24);
        var years = Math.floor(days / 365);
        days = days % 365;
        var months = Math.floor(days / 30);
        days = days % 30;
        return "<span style='font-family:SutonnyMJ'> " + years + " </span>  বছর <span style='font-family:SutonnyMJ'>" + months + "</span> মাস <span style='font-family:SutonnyMJ'>" + days + "</span> দিন";
    }
    function calculatePerDayRate(grossSalary) {
        var basic = ((parseFloat(grossSalary)/30));
        return basic.toFixed(2);
    }
    function calculateServiceBenifit(startDate, endDate) {
        var start = new Date(startDate);
        var end = new Date(endDate);
        var duration = end - start;
        var days = duration / (1000 * 60 * 60 * 24);
        var years = Math.floor(days / 365);
        //var years = 18;
        days = days % 365;
        var months = Math.floor(days / 30);
        // var months = 5;
        // alert(months);return false;
        
        days = days % 30;
        if(years >=4 && months >=10){
        // alert("4 yeasr and 10 months");
            return 14*5;
        }
        if (years >= 5) {
        // alert("6 years");
            if (months < 11) {
                if (years > 9) {
                    return 30*years;
                }else{
                    return 14*years;
                }
            }else if(months > 11) {
                    if (years > 9) {
                    return 30*(years++);
                }else{
                    return 14*years;
                }
            } 
        }else{
            return 0;
        }
    }

    function absent_deduct_cal(){
        var d_day=$('#absent_day').val();
        var basic_sal=$('#hidden_basic_salary').val();
        var har=(basic_sal / 30).toFixed(2);
        pay = (har * d_day);
        var absent = Math.round(pay);
        $('#absent_deduct_amt').html(absent);
        parshial_mot();
    }

    function ot_pay_actual_cal(){
        var pay_day=$('#ot_pay_actual').val();
        var har=Number($('#ot_rate').html());
        var har=har.toFixed(2);
        var pay=har*pay_day;
        var pay=pay.toFixed(2);
        $('#ot_pay_amt_actual').html(pay);
        parshial_mot();
    }

    function ot_pay_all_cal(){
        var pay_day=$('#ot_pay_all').val();
        var har=Number($('#ot_rate').html());
        var har=har.toFixed(2);
        var pay=har*pay_day;
        var pay=pay.toFixed(2);
        $('#ot_pay_amt_all').html(pay);
        parshial_mot();
    }

    function ot_pay_12pm_cal(){
        var pay_day=$('#ot_pay_12pm').val();
        var har=Number($('#ot_rate').html());
        var har=har.toFixed(2);
        var pay=har*pay_day;
        var pay=pay.toFixed(2);
        $('#ot_pay_amt_12am').html(pay);
        parshial_mot();
    }

    function ot_pay_9pm_cal(){
        var pay_day=$('#ot_pay_9pm').val();
        var har=Number($('#ot_rate').html());
        var har=har.toFixed(2);
        var pay=har*pay_day;
        var pay=pay.toFixed(2);
        $('#ot_pay_amt_9am').html(pay);
        parshial_mot();
    }

    function ot_pay_7pm_cal(){
        var pay_day=$('#ot_pay_7pm').val();
        var har=Number($('#ot_rate').html());
        var har=har.toFixed(2);
        var pay=har*pay_day;
        var pay=pay.toFixed(2);
        $('#ot_pay_amt_7am').html(pay);
        parshial_mot();
    }

    function current_sal_cal(){
        var pay_day = $('#salary_pay_day').val();
        var gross_salary = Number($('#com_gross_salary').html());
        var day_of_month = new Date(new Date().getFullYear(), new Date().getMonth() + 1, 0).getDate();
        var har = gross_salary/day_of_month;
        var har=har.toFixed(2);
        var pay = har*pay_day;
        var pay = Math.round(pay);
        $('#pay_salary_har').html(har);
        $('#working_pay_salary').html(pay);
        parshial_mot();
    }

    function first_r(){
        var resign_pay_day=$('#resign_pay_day').val();
        var basic_salary=Number($('#basic_salary').html());
        var har=basic_salary/30;
        var har=har.toFixed(2);
        var pay=har*resign_pay_day;
        var pay=pay.toFixed(2);
        $('#total_resign_pay_day').html(pay);
        $('.service_benifit_rate').html(har);
        parshial_mot();
    }
    function second_r(){
        var extra_payoff=$('#extra_payoff').val();
        var basic_salary=Number($('#basic_salary').html());
        var har=basic_salary/30;
        var har=har.toFixed(2);
        var pay=har*extra_payoff;
        var pay=pay.toFixed(2);

        $('#total_extra_payoff').html(pay);
        $('.service_benifit_rate').html(har);
        parshial_mot();
    }
    function third_r(){
        var extra_payoff=$('#earn_leave_day').val();
        var ette=Number(extra_payoff)/18;
        var extra_payoff=ette.toFixed(2);
        var com_gross_salary=Number($('#com_gross_salary').html());
        var har=com_gross_salary/30;
        var har=har.toFixed(2);
        var pay=har*extra_payoff;
        var pay=pay.toFixed(2);

        $('#total_earn_leave').html(pay);
        $('.per_day_rate').html(extra_payoff);
        parshial_mot();
    }

    function parshial_mot(){
            var another_deposit=Number($('#another_deposit').val());
        another_deposit=isNaN(another_deposit) ? 0 : another_deposit;
            var total_earn_leave=Number($('#total_earn_leave').html());
        total_earn_leave=isNaN(total_earn_leave) ? 0 : total_earn_leave;
            var total_extra_payoff=Number($('#total_extra_payoff').html());
        total_extra_payoff=isNaN(total_extra_payoff) ? 0 : total_extra_payoff;
            var total_resign_pay_day=Number($('#total_resign_pay_day').html());
        total_resign_pay_day=isNaN(total_resign_pay_day) ? 0 : total_resign_pay_day;
            var total=another_deposit+total_earn_leave+total_extra_payoff+total_resign_pay_day;
            total=total.toFixed(2);
            $('#total_get').val(total);
            mot_total()
    }

    function noticeDeduct() {
        var noticeDeduct = parseFloat($('#notice_deduct').val());
        noticeDeduct = isNaN(noticeDeduct) ? 0 : noticeDeduct;
        var basic_salary=Number($('#basic_salary').html());
        
        var har=basic_salary/30;
        var har=har.toFixed(2);
        var pay=har*noticeDeduct;
        var pay=pay.toFixed(2);
        $('#total_notice_deduct').html(pay); 
    }


    function mot_total() {
        var total_get = parseFloat($('#total_get').val() || 0);
        var total_deduct = parseFloat($('.total_deduct').val() || 0);
        var mot_total = total_get - total_deduct;
        $('#net_pay').val(mot_total.toFixed(2));
    }

    $('#save_button').on('click', function() {
        var formData = {
            'form_id'                : $("#form_id").val(),
            'emp_id'                 : $("#card_no").html(),
            'gross_salary'           : $("#gross_salary").html(),
            'com_gross_salary'       : $("#com_gross_salary").html(),
            'basic_salary'           : $("#basic_salary").html(),
            'ot_rate'                : $("#ot_rate").html(),
            'hidden_gross_salary'    : $("#hidden_gross_salary").val(),
            'hidden_com_gross_salary': $("#hidden_com_gross_salary").val(),
            'hidden_basic_salary'    : $("#hidden_basic_salary").val(),
            'hidden_ot_rate'         : $("#hidden_ot_rate").val(),

            'salary_pay_day'         : $("#salary_pay_day").val(),
            'working_pay_salary'     : $("#working_pay_salary").html(),
            'atten_bonus'            : $("#atten_bonus").val(),
            'ot_pay_7pm'             : $("#ot_pay_7pm").val(),
            'ot_pay_9pm'             : $("#ot_pay_9pm").val(),
            'ot_pay_12pm'            : $("#ot_pay_12pm").val(),
            'ot_pay_all'             : $("#ot_pay_all").val(),
            'ot_pay_actual'          : $("#ot_pay_actual").val(),

            'ot_pay_amt_7am'         : $("#ot_pay_amt_7am").html(),
            'ot_pay_amt_9am'         : $("#ot_pay_amt_9am").html(),
            'ot_pay_amt_12am'        : $("#ot_pay_amt_12am").html(),
            'ot_pay_amt_all'         : $("#ot_pay_amt_all").html(),
            'ot_pay_amt_actual'      : $("#ot_pay_amt_actual").html(),

            // others benefit
            'resign_pay_day'         : $("#resign_pay_day").val(),
            'total_resign_pay_day'   : $("#total_resign_pay_day").html(),
            'extra_payoff'           : $("#extra_payoff").val(),
            'total_extra_payoff'     : $("#total_extra_payoff").html(),
            'earn_leave_day'         : $("#earn_leave_day").val(),
            'total_earn_leave'       : $("#total_earn_leave").html(),
            'another_deposit'        : $("#another_deposit").val(),
            
            'service_benifit'        : $("#service_benifit").val(),

            // deduction section
            'notice_deduct'          : $("#notice_deduct").val(),
            'total_notice_deduct'    : $("#total_notice_deduct").html(),
            'absent_day'             : $("#absent_day").val(),
            'absent_deduct_amt'      : $("#absent_deduct_amt").html(),
            'advanced_salary'        : $("#advanced_salary").val(),
        };
        $.ajax({
            url: "<?php echo base_url('entry_system_con/add_final_satalment'); ?>",
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function (data, textStatus, jqXHR) {
                var dataObj = (typeof data == "string") ? JSON.parse(data) : data;
                if(dataObj.success == true){
                    Swal.fire({
                        icon: 'success',
                        title: "Added Successfully"
                    }).then((result) => {
                        window.location.href = window.location.href;
                        setTimeout(function(){ $('#myModal').modal('hide'); }, 500);
                    });
                }
            },
            error: function (jqXHR, exception) {
                console.error('error message:', jqXHR.responseText);
                console.error('error status:', jqXHR.status);
                console.error('error statusText:', jqXHR.statusText);
            }
        });
    });

    function report(id, type){
        // alert(id);
        $.ajax({
            url: "<?php echo base_url('grid_con/grid_final_satalment'); ?>",
            type: 'POST',
            data: {spl: id, type: type},
            success: function (data) {
                var win = window.open('', '_blank', 'height=800,width=1024,scrollbars=yes,resizable=yes,toolbar=no,location=no,directories=no,status=no,menubar=no,top=10,left=10'); 
                win.document.write(data);
                win.document.close();
            },
            error: function(jqXHR, exception) {
                console.error('jqXHR:', jqXHR);
                console.error('exception:', exception);
            }
        });
    }
</script>




<!-- lazy loading script -->
<script>
    var offset = 0
    var limit = 15
    var i = 0
    $(document).ready(function() {
        get_data(offset)
    })
    var e=true;
    function get_data(offset=0) {
        if(e===false){
            return false
        }else{
            e=false
        }
        
        var deptSearch = $('#deptSearch').val()
        $.ajax({
            url: "<?php echo base_url('entry_system_con/resign_list_ajax') ?>",
            type: "post",
            data: {
                offset: offset,
                limit: limit,
                deptSearch: deptSearch
            },
            success: function(data) {
                var obj = JSON.parse(data)
                    <?php
                        $user_id = $this->session->userdata('data')->id;
                        $acl = check_acl_list($user_id);
                    ?>
                obj.forEach(element => {
                    var lid = ''

                    if (element.status == 1) {
                        <?php if(in_array(132,$acl)) { ?>
                        lid+= `<li><a class="btn btn-sm" onclick="report(${element.emp_id}, 1)">Satalement Acc</a></li>`
                        <?php } ?>
                        <?php if(in_array(133,$acl)) { ?>
                            lid+= `<li><a class="btn btn-sm" onclick="report(${element.emp_id}, 2)">Final Satalement 7pm </a></li>`
                        <?php } ?>
                        <?php if(in_array(134,$acl)) { ?>
                        lid+= `<li><a class="btn btn-sm" onclick="report(${element.emp_id}, 3)">Final Satalement 9pm</a></li>`
                        <?php } ?>
                        <?php if(in_array(135,$acl)) { ?>
                        lid+= `<li><a class="btn btn-sm" onclick="report(${element.emp_id}, 4)">Satalement 12am</a></li>`
                        <?php } ?>
                        <?php if(in_array(136,$acl)) { ?>
                        lid+= `<li><a class="btn btn-sm" onclick="report(${element.emp_id}, 5)">Satalement(W/H)</a></li>`
                        <?php } ?>
                    }else{
                        lid+= `<li><a class="btn btn-sm" data-toggle="modal" data-target="#myModal" onclick="final_satalment(${element.emp_id})">Add Final Satalment</a></li>`
                    }
                    lid+= `<li><a class="btn btn-sm" href="<?=base_url('entry_system_con/resign_delete/')?>${element.emp_id}">Delete</a></li>`

                    $('#tbody').append(`<tr>
                        <td>${++i}</td>
                        <td style="padding: 1px !important;" >${element.user_name}</td>
                        <td style="padding: 1px !important;" >${element.emp_id}</td>
                        <td style="padding: 1px !important;" >${element.unit_name}</td>
                        <td style="padding: 1px !important;" >${element.resign_date}</td>
                        <td style="padding: 1px !important;">
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm btn-info dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    Action <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                    <?php
                                        $user_id = $this->session->userdata('data')->id;
                                        $acl = check_acl_list($user_id);
                                    ?>
                                    ${lid}
                                </ul>
                            </div>
                        </td> 
                    </tr>`
                    )
                });
            },
            complete: function() {
                e = true
            }
        })
    }

    window.onscroll = function() {
        if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight) {
            offset += limit
            get_data(offset)
        }
    }

    $('#deptSearch').keyup(function() {
        $('#tbody').empty()
        offset = 0
        i = 0
        get_data(offset)
        $('#tbody').empty()
    })
</script>