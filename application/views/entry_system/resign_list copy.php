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

            <table class="table table-striped text-center" id="mytable">
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

                </thead>

                <tbody>

                    <?php  
                            // dd($results);

                  if (!empty($results)) {foreach ($results as $key => $r) {?>
                    <tr>
                        <td style="padding: 1px !important;" ><?php echo $key + 1  ?></td>
                        <td style="padding: 1px !important;" ><?php echo $r->user_name ?></td>
                        <td style="padding: 1px !important;" ><?php echo $r->emp_id ?></td>
                        <td style="padding: 1px !important;" ><?php echo $r->unit_name ?></td>
                        <td style="padding: 1px !important;" ><?php echo date('d-m-Y', strtotime($r->resign_date))?></td>
                        <!-- <td>
                            <?php if($r->status == 1){?>
                            <a href="#" style="padding: 3px 12px;" class="btn btn-sm btn-info" onclick="report(<?= $r->emp_id ?>)" >Report</a>
                            <?php }else{ ?>
                            <a href="#" style="padding: 3px 12px;" class="btn btn-sm btn-info" role="button" data-toggle="modal" data-target="#myModal" onclick="final_satalment(< ?= $r->emp_id ?>)" >Add Final Satalment</a>
                            <?php }?>
                            <a href="<?=base_url('entry_system_con/resign_delete/'.$r->emp_id)?>"class="btn btn-sm btn-danger" style="padding: 3px 12px;" role="button">Delete</a>
                        </td> -->
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
                                    <?php if($r->status == 1){?>
                                    <?php if(in_array(116,$acl)) { ?>
                                    <li><a class="btn btn-sm" onclick="report(<?= $r->emp_id ?>, 1)">Satalement Acc</a></li>
                                    <?php } ?>
                                    <?php if(in_array(117,$acl)) { ?>
                                        <li><a class="btn btn-sm" onclick="report(<?= $r->emp_id ?>, 2)">Final Satalement 7pm </a></li>
                                    <?php } ?>
                                    <?php if(in_array(118,$acl)) { ?>
                                    <li><a class="btn btn-sm" onclick="report(<?= $r->emp_id ?>, 3)">Final Satalement 10pm</a></li>
                                    <?php } ?>
                                    <?php if(in_array(119,$acl)) { ?>
                                    <li><a class="btn btn-sm" onclick="report(<?= $r->emp_id ?>, 4)">Satalement 12am</a></li>
                                    <?php } ?>
                                    <?php if(in_array(120,$acl)) { ?>
                                    <li><a class="btn btn-sm" onclick="report(<?= $r->emp_id ?>, 5)">Satalement all</a></li>
                                    <?php } ?>
                                    <?php }else{ ?>
                                    <li><a class="btn btn-sm" data-toggle="modal" data-target="#myModal" onclick="final_satalment(<?= $r->emp_id ?>)">Add Final Satalment</a></li>
                                   <?php }?>
                                    <li><a class="btn btn-sm" href="<?=base_url('entry_system_con/resign_delete/'.$r->emp_id)?>">Delete</a></li>
                                </ul>
                            </div>

                        </td>
                    </tr>
                    <?php }} else {?>

                    <tr>
                        <td colspan="12">Records not Found</td>
                    </tr>
                    <?php }?>

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
                        <div class="row" style="font-size: 15px;">
                            <div class="col-md-4">
                                নাম	:	<span id="full_name"></span>
                            </div>
                            <div class="col-md-4">
                                কার্ড	:	<span id="card_no" style="font-family: SutonnyMJ;"></span>
                            </div>
                            <div class="col-md-4">
                                পদবী	:	<span id="designation_name"></span>
                            </div>
                        </div>
                        <div class="row" style="font-size: 15px;">
                            <div class="col-md-4">
                                সেকশন	:	<span id="section_name"></span>
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
                                মোট বেতন	:	<span id="gross_salary" style="font-family:SutonnyMJ"> </span> টাকা
                            </div>
                            <div class="col-md-4">
                                মূল বেতন	:	<span id="basic_salary" style="font-family:SutonnyMJ"> </span> টাকা
                            </div>
                        </div>
                        <div class="row" style="font-size: 15px;">
                            <div class="col-md-4">
                                প্রতি ঘন্টার ওভার টাইম হার	:	<span class="ot_rate" style="font-family:SutonnyMJ"> </span> টাকা
                        </div>

                        <table class="table table-bordered ml-3 inputs tables" style="border: 1px solid #d6d1d1 !important;">
                            <tr class="text-center">
                                <th class="text-center" style="border: 1px solid #d6d1d1 !important;">বিষয় </th>
                                <th class="text-center" style="border: 1px solid #d6d1d1 !important;">দিন/ ঘন্টা </th>
                                <th class="text-center" style="border: 1px solid #d6d1d1 !important;">হার </th>
                                <th class="text-center" style="border: 1px solid #d6d1d1 !important;">টাকা</th>
                            </tr>
                            <!-- <tr>
                                <td style="border: 1px solid #d6d1d1 !important;"><span id='resign_date'></span></td>
                                <td style="border: 1px solid #d6d1d1 !important;"><span style="font-family:SutonnyMJ;font-size: 15px;" id="working_days"></span></td>
                                <td style="border: 1px solid #d6d1d1 !important;"><span style="font-family:SutonnyMJ;font-size: 15px;" class="per_day_rate"></span></td>
                                <td style="border: 1px solid #d6d1d1 !important;"><span style="font-family:SutonnyMJ;font-size: 15px;" id="total1"></span></td>
                            </tr> -->
                            <!-- <tr>
                                <td style="border: 1px solid #d6d1d1 !important;">চলতি মাসের ওভার টাইম  </td>
                                <td style="border: 1px solid #d6d1d1 !important;"><span style="font-family:SutonnyMJ;font-size: 15px;" id="ot_eot"></span></td>
                                <td style="border: 1px solid #d6d1d1 !important;"><span style="font-family:SutonnyMJ;font-size: 15px;" class="ot_rate"></td>
                                <td style="border: 1px solid #d6d1d1 !important;"><span style="font-family:SutonnyMJ;font-size: 15px;" id="total_ot_rate"></td>
                            </tr> -->
                            <!-- <tr>
                                <td style="border: 1px solid #d6d1d1 !important;">হাজিরা বোনাস </td>
                                <td style="border: 1px solid #d6d1d1 !important;">০</td>
                                <td style="border: 1px solid #d6d1d1 !important;"><span style="font-family:SutonnyMJ;font-size: 15px;" class="ot_rate"></td>
                                <td style="border: 1px solid #d6d1d1 !important;">০</td>
                            </tr> -->

                                <input type="hidden" id="ot_2pm">
                                <input type="hidden" id="ot_eot_4pm">
                                <input type="hidden" id="ot_eot_12am">
                                <input type="hidden" id="all_eot_woh">
                            <tr>
                                <td style="border: 1px solid #d6d1d1 !important; width:51%;">চাকুরী হইতে অবসান এর নোটিশ পে বাংলাদেশ শ্রম আইন ২০০৬ এর ধারা ২৬ (১)</td>
                                <td style="border: 1px solid #d6d1d1 !important;"><input type="number" class="form-control" name="resign_pay_day" id="resign_pay_day"></td>
                                <td style="border: 1px solid #d6d1d1 !important;"><span class="service_benifit_rate" style="font-size: 15px;font-family: SutonnyMJ;"></span></td>
                                <td style="border: 1px solid #d6d1d1 !important;"><span class="total_resign_pay_day" style="font-size: 15px;font-family: SutonnyMJ;" min="0"></td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid #d6d1d1 !important;">অতিরিক্ত ক্ষতিপূরণ </td>
                                <td style="border: 1px solid #d6d1d1 !important;"><input type="number" class="form-control" name="extra_payoff" id="extra_payoff"></td>
                                <td style="border: 1px solid #d6d1d1 !important;"><span class="service_benifit_rate" style="font-size: 15px;font-family: SutonnyMJ;"></span></td>
                                <td style="border: 1px solid #d6d1d1 !important;"><span class="total_extra_payoff" style="font-size: 15px;font-family: SutonnyMJ;"></td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid #d6d1d1 !important;">জমাকৃত অর্জিত ছুটির দিন (<span id="earn_leave_days" style="font-family:SutonnyMJ;font-size: 15px;" class=""></span>) উপস্থিতি</td>
                                <td style="border: 1px solid #d6d1d1 !important;"><input type="number" style="font-family:SutonnyMJ;font-size: 15px;" class="earn_leave form-control"></td>
                                <td style="border: 1px solid #d6d1d1 !important;"><span style="font-family:SutonnyMJ;font-size: 15px;" class="per_day_rate"></span></td>
                                <td style="border: 1px solid #d6d1d1 !important;"><span style="font-family:SutonnyMJ;font-size: 15px;" class="total_earn_leave"></span></td>
                            </tr>
                            <!-- <tr>
                                <td style="border: 1px solid #d6d1d1 !important;">সার্ভিস বেনিফিট   </td>
                                <td style="border: 1px solid #d6d1d1 !important;"><span class="service_benifit" style="font-size: 15px;font-family: SutonnyMJ;"></span></td>
                                <td style="border: 1px solid #d6d1d1 !important;"><span class="service_benifit_rate" style="font-size: 15px;font-family: SutonnyMJ;"></span></td>
                                <td style="border: 1px solid #d6d1d1 !important;"><span class="total_service_benifit" style="font-size: 15px;font-family: SutonnyMJ;"></span></td>
                            </tr> -->
                            <tr>
                                <td style="border: 1px solid #d6d1d1 !important;" colspan="3">অন্যান্য পাওনাদি</td>
                                <td style="border: 1px solid #d6d1d1 !important;"><input type="number" class="another_deposit form-control" name="another_deposit"></td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid #d6d1d1 !important;" colspan="3">মোট প্রাপ্য টাকা</td>
                                <td style="border: 1px solid #d6d1d1 !important;"><span id="total_get" style="font-family:sutonnyMJ;font-size: 15px;"></span"></td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid #d6d1d1 !important;" colspan="4">কর্তন</td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid #d6d1d1 !important;">নোটিশ পিরিয়ড কম বা না দেয়ার কারনে কোম্পানীর প্রাপ্য বাবদ কর্তন (মোট মজুরি থেকে)</td>
                                <td style="border: 1px solid #d6d1d1 !important;"><input type="number" class="form-control" name="notice_deduct" id="notice_deduct"></td>
                                <td style="border: 1px solid #d6d1d1 !important;"><span class="service_benifit_rate" style="font-size: 15px;font-family: SutonnyMJ;"></span></td>
                                <td style="border: 1px solid #d6d1d1 !important;"><span class="total_notice_deduct_rate" style="font-size: 15px;font-family: SutonnyMJ;"></span></td>
                            </tr>
                            <!-- <tr>
                                <td style="border: 1px solid #d6d1d1 !important;">ষ্ট্যাম্প বাবদ কর্তন</td>
                                <td style="border: 1px solid #d6d1d1 !important;">০</td>
                                <td style="border: 1px solid #d6d1d1 !important;">১০</td>
                                <td style="border: 1px solid #d6d1d1 !important;">১০</td>
                            </tr> -->
                            <!-- <tr>
                                <td style="border: 1px solid #d6d1d1 !important;">অনুপস্থিত বাবদ কর্তন (মূল মজুরি থেকে)</td>
                                <td style="border: 1px solid #d6d1d1 !important;"><span id="absent" style="font-size: 15px;font-family: SutonnyMJ;"></span></td>
                                <td style="border: 1px solid #d6d1d1 !important;"><span class="service_benifit_rate" style="font-size: 15px;font-family: SutonnyMJ;"></span></td>
                                <td style="border: 1px solid #d6d1d1 !important;"><span class="absent_deduct" style="font-size: 15px;font-family: SutonnyMJ;"></span></td>
                            </tr> -->
                             <tr>
                                <td colspan="3" style="border: 1px solid #d6d1d1 !important;">অগ্রীম বেতন</td>
                                <td style="border: 1px solid #d6d1d1 !important;"><input type="number" class="form-control" name="advanced_salary" id="advanced_salary" ></td>
                            </tr>
                            <tr>
                                <td colspan="3" style="border: 1px solid #d6d1d1 !important;">মোট কর্তন</td>
                                <td style="border: 1px solid #d6d1d1 !important;"><span class="total_deduct" style="font-size: 15px;font-family: SutonnyMJ;"></span></td>
                            </tr>
                            <tr>
                                <td colspan="3" style="border: 1px solid #d6d1d1 !important;">নিট প্রাপ্য / প্রদেয় টাকা</td>
                                <td style="border: 1px solid #d6d1d1 !important;"><span id="net_pay" style="font-family: SutonnyMJ;font-size: 15px"></span"></td>
                            </tr>
                        </table>
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

<script type="text/javascript">
    $(document).ready(function() {
        $("#mytable").dataTable();
        $('#mytable_filter').css({
            "display": "none"
        })
        $('#mytable_length').css({
            "display": "none"
        })
        $("#mytable").dataTable();
        oTable = $('#mytable').DataTable();
        $('#deptSearch').keyup(function() {
            oTable.search($(this).val()).draw();
        })
    });
</script>
<script>
    $('#myModal').on('hidden.bs.modal', function () {
        $(this).find("input,textarea,select").val('').end().find("input[type=checkbox], input[type=radio]").prop("checked", "").end().find("option:selected").removeAttr("selected");
    })
    function final_satalment(id) {
        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>grid_con/final_satalment",
            data: {id: id},
            success: function (data) {
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
                // $("#resign_date").html(resign_date);
                $("#resign_date").html(bnMonths[d.getMonth()] + " " + year_str);
                $("#last_working_date").html(d.toLocaleString('en-US', { day: '2-digit', month: '2-digit', year: 'numeric' }).replace(/[^0-9]/g, "-").replace(/^(..)-(..)-(....)$/, "$2-$1-$3"));
                $("#job_duration").html(calculateJobDuration(employeeData.emp_join_date, employeeData.resign_date));
                $("#gross_salary").html(employeeData.gross_sal);
                $("#basic_salary").html(calculateBasicSalary(employeeData.gross_sal));
                $(".ot_rate").html(calculateOtRate(employeeData.gross_sal));
                $("#working_days").html(employeeData.working_days);
                $("#absent").html(employeeData.status);
                $(".per_day_rate").html(calculatePerDayRate(employeeData.gross_sal));
                $("#total1").html( parseFloat(employeeData.working_days* calculatePerDayRate(employeeData.gross_sal)).toFixed(2));
                $("#ot_eot").html( (employeeData.ot_hour==="" || employeeData.ot_hour==null)? 0 : parseInt(employeeData.ot_hour) + parseInt(employeeData.eot_hour) );

                $("#ot_2pm").val( parseInt(employeeData.ot_hour) );
                $("#ot_eot_4pm").val( parseInt(employeeData.ot_eot_4pm) );
                $("#ot_eot_12am").val( parseInt(employeeData.ot_eot_12am) );
                $("#all_eot_woh").val( parseInt(employeeData.all_eot_woh) );

                $("#total_ot_rate").html(parseFloat((parseInt(employeeData.ot_hour) + parseInt(employeeData.eot_hour)) * calculateOtRate(employeeData.gross_sal)).toFixed(2));
                $('.total_resign_pay_day').html(0);
                $('.total_earn_leave').html(0);
                $('.total_notice_deduct_rate').html(0);
                $('.total_extra_payoff').html(0);
                if(isNaN($(".another_deposit").val())){
                   $(".another_deposit").val(0);
                    $("#total_get").html(0);
                }else{
                    parseFloat($(".another_deposit").val());
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

                //  employeeData.emp_join_date, 
                // employeeData.resign_date


                // calculate service benifit eligiblity

                $(".service_benifit").html(calculateServiceBenifit(employeeData.emp_join_date, employeeData.resign_date));
                $(".service_benifit_rate").html(parseFloat(calculateBasicSalary(employeeData.gross_sal)/30).toFixed(2));

                function calculateServiceBenifit(startDate, endDate) {
                    var start = new Date(startDate);
                    var end = new Date(endDate);
                    var duration = end - start;
                    var days = duration / (1000 * 60 * 60 * 24);
                     var years = Math.floor(days / 365);
                    //var years = 18;
                    days = days % 365;
                    var months = Math.floor(days / 30);
                    var months = 5;
                    console.log(months);
                    
                    days = days % 30;
                    if (years >= 5) {
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
                
                // Function to calculate basic salary (assuming it's 40% of the gross salary)
                function calculateBasicSalary(grossSalary) {
                    var basic = ((parseFloat(grossSalary) -2450)/1.5);
                    return basic.toFixed(2);
                }
                function calculateOtRate(grossSalary) {
                    var basic = (parseFloat((((grossSalary)-2450)/ 1.5)/104));
                    return basic.toFixed(2);
                }
                function calculatePerDayRate(grossSalary) {
                    var basic = ((parseFloat(grossSalary)/30));
                    return basic.toFixed(2);
                }
                

                $("#resign_pay_day").on("input", function() {
                    var resign_pay_day = parseFloat($(this).val());
                    var ot_rate = parseFloat($(".service_benifit_rate").html());
                     if (isNaN(resign_pay_day)){
                        resign_pay_day = 0;
                        $("#total_get").html(0);
                     }
                    var total_resign_pay_day = resign_pay_day * ot_rate;
                   return  $(".total_resign_pay_day").html(total_resign_pay_day.toFixed(2));
                });

                $("#extra_payoff").on("input", function() {
                    var extra_payoff = parseFloat($(this).val());
                    var ot_rate = parseFloat($(".service_benifit_rate").html());
                    if (isNaN(extra_payoff)){
                        extra_payoff = 0;
                        $("#total_get").html(0);
                     }
                    var total_extra_payoff = extra_payoff * ot_rate;
                   return  $(".total_extra_payoff").html(total_extra_payoff.toFixed(2));
                });

                $("#notice_deduct").on("input", function() {
                    var notice_deduct = parseFloat($(this).val());
                    var notice_deduct_rate = parseFloat($(".service_benifit_rate").html());
                    if (isNaN(notice_deduct)){
                        notice_deduct = 0;
                        $("#total_get").html(0);
                     }
                    var total_notice_deduct_rate = notice_deduct * notice_deduct_rate;
                   return  $(".total_notice_deduct_rate").html(total_notice_deduct_rate.toFixed(2));
                });
                $(".earn_leave").on("input", function() {
                    var earn_leave = parseFloat($(this).val());
                    var earn_leave_rate = parseFloat($(".per_day_rate").html());
                    if (isNaN(earn_leave)){
                        earn_leave = 0;
                        $("#total_get").html(0);
                     }
                    var total_earn_leave = parseFloat((earn_leave/18) * earn_leave_rate);
                   return  $(".total_earn_leave").html(total_earn_leave.toFixed(2));
                });


                var service_benifit = parseFloat($(".service_benifit").html());
                var service_benifit_rate = parseFloat($(".service_benifit_rate").html());
                var total_service_benifit = service_benifit * service_benifit_rate;
                $(".total_service_benifit").html(total_service_benifit.toFixed(2));


                // absent_deduct 

                var absent = parseFloat($("#absent").html());
                var service_benifit_rate = parseFloat($(".service_benifit_rate").html());
                var absent_deduct = absent * service_benifit_rate;
                $(".absent_deduct").html(absent_deduct.toFixed(2));

                // end

                $("#extra_payoff, #resign_pay_day, .another_deposit").val(0);

                var total_get = 0;
                $("#extra_payoff, #resign_pay_day, .another_deposit, .earn_leave").on("input", function(){
                    var total_get = 0;
                    $("#total1, #total_ot_rate, .total_resign_pay_day, .total_extra_payoff, .total_service_benifit,.total_earn_leave").each(function(){
                        var html = $(this).html();
                            var value = parseFloat(html);
                            if (isNaN(value)) {
                                value = 0;
                            }
                            total_get += value;
                    });
                    total_get += parseFloat($(".another_deposit").val()) ==NaN ? 0 : parseFloat($(".another_deposit").val());
                    $("#total_get").html(total_get.toFixed(2));
                    var total_get = parseFloat($('#total_get').html());
                    var total_deduct = parseFloat($('.total_deduct').html());
                    $('#net_pay').html(parseFloat(total_get - total_deduct-10).toFixed(2));
                });
                $("#total_get").html(0);
                 $("#advanced_salary, #notice_deduct").val(0);
                var total_deduct = 0;
                
                $('#advanced_salary, #notice_deduct').on('input', function() {
                    var total_deduct = 0;
                    $(".absent_deduct, .total_notice_deduct_rate").each(function(){
                    var html = $(this).html();
                    var value = parseFloat(html);
                    if (isNaN(value)) {
                        value = 0;
                    }
                    total_deduct += value;
                });
                    total_deduct += parseFloat($("#advanced_salary").val()) == NaN ? 0 : parseFloat($("#advanced_salary").val());
                    $(".total_deduct").html(total_deduct.toFixed(2));
                    var total_get = parseFloat($('#total_get').html());
                    var total_deduct = parseFloat($('.total_deduct').html());
                    $('#net_pay').html(parseFloat(total_get - total_deduct -10).toFixed(2));
                }); 
                   $(".total_deduct").html(0);
            }
        });

        $('#save_button').on('click', function() {
            var formData = {
                'emp_id'                : $("#card_no").html(),
                'working_days'          : $("#working_days").html(),
                'ot_eot'                : $("#ot_eot").html(),
                'ot_2pm'                : $("#ot_2pm").val(),
                'ot_eot_4pm'            : $("#ot_eot_4pm").val(),
                'ot_eot_12am'           : $("#ot_eot_12am").val(),
                'all_eot_woh'           : $("#all_eot_woh").val(),
                'per_day_rate'          : $(".per_day_rate").html(),
                'ot_rate'               : $(".ot_rate").html(),
                'resign_pay_day'        : $("#resign_pay_day").val(),
                'service_benifit_rate'  : $(".service_benifit_rate").html(),
                'extra_payoff'          : $("#extra_payoff").html(),
                'earn_leave'            : $(".earn_leave").val(),
                'service_benifit'       : $(".service_benifit").html(),
                'another_deposit'       : $(".another_deposit").val(),
                'notice_deduct'         : $("#notice_deduct").val(),
                'absent'                : $("#absent").html(),
                'advanced_salary'       : $("#advanced_salary").val(),
                'total_deduct'          : $(".total_deduct").html(),
                'net_pay'               : $("#net_pay").html(),
                'status'                : 1,
                'total_get'             : $("#total_get").html(),
            };
            $.ajax({
                url: "<?php echo base_url('entry_system_con/add_final_satalment'); ?>",
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function (data) {
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
                error: function(jqXHR, exception) {
                    console.error('jqXHR:', jqXHR);
                    console.error('exception:', exception);
                }
            });
        });
    }

    function report(id, type){
        // alert(id);
        $.ajax({
            url: "<?php echo base_url('grid_con/grid_final_satalment'); ?>",
            type: 'POST',
            data: {spl: id, type: type},
            success: function (data) {
                // console.log(data);/
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


    //  function edit(id){
    //     $.ajax({
    //         url: "< ?php echo base_url('grid_con/grid_final_satalment_edit'); ?>",
    //         type: 'POST',
    //         data: {spl: id},
    //         success: function (data) {

    //               var employeeData = JSON.parse(data);

    //             // console.log(employeeData);return false;
    //             // Set values to respective HTML elements
    //             $("#full_name").html(employeeData.name_bn);
    //             $("#card_no").html(employeeData.emp_id);
    //             $("#designation_name").html(employeeData.desig_bangla);
    //             $("#section_name").html(employeeData.sec_name_bn);
    //             $("#year").html(employeeData.resign_year);
    //             $("#joining_date").html(employeeData.emp_join_date.split('-').reverse().join('-'));
    //             var d = new Date(employeeData.resign_date);
    //             var bnMonths = ["জানুয়ারি", "ফেব্রুয়ারি", "মার্চ", "এপ্রিল", "মে", "জুন", "জুলাই", "আগস্ট", "সেপ্টেম্বর", "অক্টোবর", "নভেম্বর", "ডিসেম্বর"];
    //             var resign_date = d.toLocaleString('bn-BD', { year: 'numeric', month: 'long' });
    //             var year_str = "<span style='font-family:sutonnyMJ;font-size:16px'>"+d.getFullYear()+'</span>';
    //             // $("#resign_date").html(resign_date);
    //             $("#resign_date").html(bnMonths[d.getMonth()] + " " + year_str);
    //             $("#last_working_date").html(d.toLocaleString('en-US', { day: '2-digit', month: '2-digit', year: 'numeric' }).replace(/[^0-9]/g, "-").replace(/^(..)-(..)-(....)$/, "$2-$1-$3"));
    //             // $("#job_duration").html( calculateJobDuration(employeeData.emp_join_date, employeeData.resign_date) );
    //             $("#gross_salary").html(employeeData.gross_sal);
    //             // $("#basic_salary").html(calculateBasicSalary(employeeData.gross_sal));
    //             // $(".ot_rate").html(calculateOtRate(employeeData.gross_sal));
    //             $("#working_days").html(employeeData.working_days);
    //             $("#absent").html(employeeData.status);
    //             $(".per_day_rate").html(calculatePerDayRate(employeeData.gross_sal));
    //             // $("#total1").html( parseFloat(employeeData.working_days* calculatePerDayRate(employeeData.gross_sal)).toFixed(2));
    //             $("#ot_eot").html( (employeeData.ot_hour==="" || employeeData.ot_hour==null)? 0 : parseInt(employeeData.ot_hour) + parseInt(employeeData.eot_hour) );
    //             $("#total_ot_rate").html(parseFloat((parseInt(employeeData.ot_hour) + parseInt(employeeData.eot_hour)) * calculateOtRate(employeeData.gross_sal)).toFixed(2));

    //             $("#working_days").html(employeeData.working_days),
    //             $("#ot_eot").html(employeeData.ot_eot),
    //             $(".per_day_rate").html(employeeData.per_day_rate),
    //             $(".ot_rate").html(employeeData.ot_rate),
    //             $("#resign_pay_day").val(employeeData.resign_pay_day),
    //             $(".service_benifit_rate").html(employeeData.service_benifit_rate),
    //             $("#extra_payoff").html(employeeData.extra_payoff),
    //             $(".earn_leave").val(employeeData.earn_leave),
    //             $(".service_benifit").html(employeeData.service_benifit),
    //             $(".another_deposit").val(employeeData.another_deposit),
    //             $("#notice_deduct").val(employeeData.notice_deduct),
    //             $("#absent").html(employeeData.absent),
    //             $("#advanced_salary").val(employeeData.advanced_salary),
    //             $(".total_deduct").html(employeeData.total_deduct),
    //             $("#net_pay").html(employeeData.net_pay),
    //             $("#total_get").html(employeeData.total_get),

    //             // function calculateJobDuration(startDate, endDate) {
    //             //     var start = new Date(startDate);
    //             //     var end = new Date(endDate);
    //             //     var duration = end - start;
    //             //     var days = duration / (1000 * 60 * 60 * 24);
    //             //     var years = Math.floor(days / 365);
    //             //     days = days % 365;
    //             //     var months = Math.floor(days / 30);
    //             //     days = days % 30;
    //             //     return "<span style='font-family:SutonnyMJ'> " + years + " </span>  বছর <span style='font-family:SutonnyMJ'>" + months + "</span> মাস <span style='font-family:SutonnyMJ'>" + days + "</span> দিন";
    //             // }
    //             function calculateBasicSalary(grossSalary) {
    //                 var basic = ((parseFloat(grossSalary) -2450)/1.5);
    //                 return basic.toFixed(2);
    //             }
    //             function calculateOtRate(grossSalary) {
    //                 var basic = (parseFloat((((grossSalary)-2450)/ 1.5)/104));
    //                 return basic.toFixed(2);
    //             }
    //             // console.log(data);/
    //             // var win = window.open('', '_blank', 'height=800,width=1024,scrollbars=yes,resizable=yes,toolbar=no,location=no,directories=no,status=no,menubar=no,top=10,left=10'); 
    //             // win.document.write(data);
    //             // win.document.close();
    //         },
    //         error: function(jqXHR, exception) {
    //             console.error('jqXHR:', jqXHR);
    //             console.error('exception:', exception);
    //         }
    //     });
    // }

    $(".earn_leave").on('input', function() {
         $("#earn_leave_days").html(parseFloat($(this).val()/18).toFixed(2));
    })
</script>