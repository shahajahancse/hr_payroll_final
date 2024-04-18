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
                        <!-- <div class="form-group">
                            <label for="final_satalment">Final Satalment</label>
                            <input type="text" class="form-control" id="final_satalment" name="final_satalment" required>
                        </div> -->
                        <div class="row" style="font-size: 15px;">
                            <div class="col-md-4">
                                নাম	:	মোছাঃ ফাতেমা
                            </div>
                            <div class="col-md-4">
                                কার্ড	:	5001303
                            </div>
                            <div class="col-md-4">
                                পদবী	:	জুনিঃ অপারেটর
                            </div>
                        </div>
                        <div class="row" style="font-size: 15px;">
                            <div class="col-md-4">
                                সেকশন	:	Sewing Section
                            </div>
                            <div class="col-md-4">
                                যোগদানের তারিখ	:	16-11-2020 Bs
                            </div>
                            <div class="col-md-4">
                                শেষ কর্মদিবস	:	16-11-2023 Bs
                            </div>
                        </div>
                        <div class="row" style="font-size: 15px;">
                            <div class="col-md-4">
                                চাকুরীকাল	:	3 eQi 0 gvm 0 w`b
                            </div>
                            <div class="col-md-4">
                                মোট বেতন	:	10244 UvKv
                            </div>
                            <div class="col-md-4">
                                মূল বেতন	:	7794 UvKv
                            </div>
                        </div>
                        <div class="row" style="font-size: 15px;">
                            <div class="col-md-4">
                                প্রতি ঘন্টার ওভার টাইম হার	:	98.5UvKv
                            </div>
                        </div>

                    <table class="table table-bordered ml-3 inputs tables" style="border: 1px solid #d6d1d1 !important;">
                            <tr class="text-center">
                                <th class="text-center" style="border: 1px solid #d6d1d1 !important;">বিষয় </th>
                                <th class="text-center" style="border: 1px solid #d6d1d1 !important;">দিন/ ঘন্টা </th>
                                <th class="text-center" style="border: 1px solid #d6d1d1 !important;">হার </th>
                                <th class="text-center" style="border: 1px solid #d6d1d1 !important;">টাকা</th>
                            </tr>
                            <tr>
                                <td style="border: 1px solid #d6d1d1 !important;">ডিসেম্বর - ২০২৪/</td>
                                <td style="border: 1px solid #d6d1d1 !important;">১৩  </td>
                                <td style="border: 1px solid #d6d1d1 !important;">৬৭৪.৪৫  </td>
                                <td style="border: 1px solid #d6d1d1 !important;">৮৭৬৮</td>
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
    function final_satalment(id) {
        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>index.php/grid_con/final_satalment",
            data: {id: id},
            success: function (data) {
                console.log(data);
                return false;
                $("#final_satalment_report").html(data);

            }
        });
    }
</script>