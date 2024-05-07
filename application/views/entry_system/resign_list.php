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

                  if (!empty($results)) {foreach ($results as $key => $r) {?>
                    <tr>
                        <td><?php echo $key + 1  ?></td>
                        <td><?php echo $r->user_name ?></td>
                        <td><?php echo $r->emp_id ?></td>
                        <td><?php echo $r->unit_name ?></td>
                        <td><?php echo date('d-m-Y', strtotime($r->resign_date))?></td>
                        <td>
                            <a href="#" class="btn btn-sm btn-info" role="button" data-toggle="modal" data-target="#myModal" onclick="final_satalment(<?= $r->emp_id ?>)" >Add Final Satalment</a>
                            <a href="<?=base_url('entry_system_con/resign_delete/'.$r->emp_id)?>"
                                class="btn btn-sm btn-danger" role="button">Delete</a>
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
                    <form action="<?= base_url('entry_system_con/add_final_satalment')?>" method="post">
                        <input type="hidden" name="emp_id" id="emp_id" required>
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
                                প্রতি ঘন্টার ওভার টাইম হার	:	<span id="ot_rate" style="font-family:SutonnyMJ"> </span> টাকা
                        </div>

                    <table class="table table-bordered ml-3 inputs tables" style="border: 1px solid #d6d1d1 !important;">
                            <tr class="text-center">
                                <th class="text-center" style="border: 1px solid #d6d1d1 !important;">বিষয় </th>
                                <th class="text-center" style="border: 1px solid #d6d1d1 !important;">দিন/ ঘন্টা </th>
                                <th class="text-center" style="border: 1px solid #d6d1d1 !important;">হার </th>
                                <th class="text-center" style="border: 1px solid #d6d1d1 !important;">টাকা</th>
                            </tr>
                            <tr>
                                <td style="border: 1px solid #d6d1d1 !important;"><span id='resign_date'></span></td>
                                <td style="border: 1px solid #d6d1d1 !important;"><span style="font-family:SutonnyMJ;font-size: 15px;" id="working_days"></span></td>
                                <td style="border: 1px solid #d6d1d1 !important;"><span style="font-family:SutonnyMJ;font-size: 15px;" id="per_day_rate"></span></td>
                                <td style="border: 1px solid #d6d1d1 !important;"><span style="font-family:SutonnyMJ;font-size: 15px;" id="total1"></span></td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid #d6d1d1 !important;">চলতি মাসের ওভার টাইম  </td>
                                <td style="border: 1px solid #d6d1d1 !important;">১৮  </td>
                                <td style="border: 1px solid #d6d1d1 !important;">১১৮.৩২  </td>
                                <td style="border: 1px solid #d6d1d1 !important;">২১৩০</td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid #d6d1d1 !important;">হাজিরা বোনাস </td>
                                <td style="border: 1px solid #d6d1d1 !important;">০</td>
                                <td style="border: 1px solid #d6d1d1 !important;">০.০</td>
                                <td style="border: 1px solid #d6d1d1 !important;">০</td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid #d6d1d1 !important; width:51%;">চাকুরী হইতে অবসান এর নোটিশ পে বাংলাদেশ শ্রম আইন ২০০৬ এর ধারা ২৬ (১)</td>
                                <td style="border: 1px solid #d6d1d1 !important;"><input type="text" class="form-control" name=""></td>
                                <td style="border: 1px solid #d6d1d1 !important;"><input type="text" class="form-control" name=""></td>
                                <td style="border: 1px solid #d6d1d1 !important;">০</td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid #d6d1d1 !important;">অতিরিক্ত ক্ষতিপূরণ </td>
                                <td style="border: 1px solid #d6d1d1 !important;"><input type="text" class="form-control" name=""></td>
                                <td style="border: 1px solid #d6d1d1 !important;"><input type="text" class="form-control" name=""></td>
                                <td style="border: 1px solid #d6d1d1 !important;">০</td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid #d6d1d1 !important;">জমাকৃত অর্জিত ছুটির দিন ( ৫৬৩) উপস্থিতি</td>
                                <td style="border: 1px solid #d6d1d1 !important;">৩১.২৮</td>
                                <td style="border: 1px solid #d6d1d1 !important;">৬৯৬.৯৩</td>
                                <td style="border: 1px solid #d6d1d1 !important;">২১৭৯৯</td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid #d6d1d1 !important;">সার্ভিস বেনিফিট   </td>
                                <td style="border: 1px solid #d6d1d1 !important;">০   </td>
                                <td style="border: 1px solid #d6d1d1 !important;">৪১০.১৮</td>
                                <td style="border: 1px solid #d6d1d1 !important;">০</td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid #d6d1d1 !important;" colspan="3">অন্যান্য পাওনাদি</td>
                                <td style="border: 1px solid #d6d1d1 !important;"><input type="text" class="form-control" name=""></td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid #d6d1d1 !important;" colspan="3">মোট প্রাপ্য টাকা</td>
                                <td style="border: 1px solid #d6d1d1 !important;">৩২৬৯৯</td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid #d6d1d1 !important;" colspan="4">কর্তন</td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid #d6d1d1 !important;">নোটিশ পিরিয়ড কম বা না দেয়ার কারনে কোম্পানীর প্রাপ্য বাবদ কর্তন (মোট মজুরি থেকে)</td>
                                <td style="border: 1px solid #d6d1d1 !important;"><input type="text" class="form-control" name=""></td>
                                <td style="border: 1px solid #d6d1d1 !important;"><input type="text" class="form-control" name=""></td>
                                <td style="border: 1px solid #d6d1d1 !important;"><input type="text" class="form-control" name=""></td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid #d6d1d1 !important;">ষ্ট্যাম্প বাবদ কর্তন</td>
                                <td style="border: 1px solid #d6d1d1 !important;">০</td>
                                <td style="border: 1px solid #d6d1d1 !important;">১০</td>
                                <td style="border: 1px solid #d6d1d1 !important;">১০</td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid #d6d1d1 !important;">অনুপস্থিত বাবদ কর্তন (মূল মজুরি থেকে)</td>
                                <td style="border: 1px solid #d6d1d1 !important;">০</td>
                                <td style="border: 1px solid #d6d1d1 !important;">৪১০.১৮</td>
                                <td style="border: 1px solid #d6d1d1 !important;">১০</td>
                            </tr>
                             <tr>
                                <td colspan="3" style="border: 1px solid #d6d1d1 !important;">অগ্রীম বেতন</td>
                                <td style="border: 1px solid #d6d1d1 !important;"><input type="text" class="form-control" name=""></td>
                            </tr>
                            <tr>
                                <td colspan="3" style="border: 1px solid #d6d1d1 !important;">মোট কর্তন</td>
                                <td style="border: 1px solid #d6d1d1 !important;">১০</td>
                            </tr>
                            <tr>
                                <td colspan="3" style="border: 1px solid #d6d1d1 !important;">নিট প্রাপ্য / প্রদেয় টাকা</td>
                                <td style="border: 1px solid #d6d1d1 !important;">৩২৮৬৮</td>
                            </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-sm btn-primary">Save</button>
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
            url: "<?php echo base_url(); ?>index.php/grid_con/final_satalment",
            data: {id: id},
            success: function (data) {
                var employeeData = JSON.parse(data);
                // console.log(employeeData);return false;
                // Set values to respective HTML elements
                $("#full_name").html(employeeData.values[0].name_bn);
                $("#card_no").html(employeeData.values[0].emp_id);
                $("#designation_name").html(employeeData.values[0].desig_bangla);
                $("#section_name").html(employeeData.values[0].sec_name_bn);
                $("#year").html(employeeData.values[0].resign_year);
                $("#joining_date").html(employeeData.values[0].emp_join_date.split('-').reverse().join('-'));
                var d = new Date(employeeData.values[0].resign_date);
                var bnMonths = ["জানুয়ারি", "ফেব্রুয়ারি", "মার্চ", "এপ্রিল", "মে", "জুন", "জুলাই", "আগস্ট", "সেপ্টেম্বর", "অক্টোবর", "নভেম্বর", "ডিসেম্বর"];
                var resign_date = d.toLocaleString('bn-BD', { year: 'numeric', month: 'long' });
                var year_str = "<span style='font-family:sutonnyMJ;font-size:16px'>"+d.getFullYear()+'</span>';
                $("#resign_date").html(resign_date);
                $("#resign_date").html(bnMonths[d.getMonth()] + " " + year_str);
                $("#last_working_date").html(d.toLocaleString('en-US', { year: 'numeric', month: '2-digit', day: '2-digit' }).replace(/[^0-9]/g, "-"));
                $("#job_duration").html(calculateJobDuration(employeeData.values[0].emp_join_date, employeeData.values[0].resign_date));
                $("#gross_salary").html(employeeData.values[0].gross_sal);
                $("#basic_salary").html(calculateBasicSalary(employeeData.values[0].gross_sal));
                $("#ot_rate").html(calculateOtRate(employeeData.values[0].gross_sal));
                $("#working_days").html(employeeData.values[0].working_days);
                $("#per_day_rate").html(calculatePerDayRate(employeeData.values[0].gross_sal));
                $("#total1").html( parseFloat(employeeData.values[0].working_days* calculatePerDayRate(employeeData.values[0].gross_sal)).toFixed(2));

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
                // Function to calculate basic salary (assuming it's 40% of the gross salary)
                function calculateBasicSalary(grossSalary) {
                    var basic = ((parseFloat(grossSalary) -2450)/1.5);
                    return basic.toFixed(2);
                }
                function calculateOtRate(grossSalary) {
                    var basic = (((parseFloat(grossSalary)-2450)/ 208)  * 2  );
                    return basic.toFixed(2);
                }
                function calculatePerDayRate(grossSalary) {
                    var basic = ((parseFloat(grossSalary)/30));
                    return basic.toFixed(2);
                }

            }
        });
    }
</script>