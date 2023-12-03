<div class="content">

        <nav class="navbar navbar-inverse bg_none">
            <div class="container-fluid nav_head">
            <div class="navbar-header col-md-5" style="padding: 7px;">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div>
                    <a class="btn btn-info" href="<?php echo base_url('index.php/setup_con/shiftschedule_add')?>">Add Shift Schedule</a>
                            <a class="btn btn-primary" href="<?php echo base_url('index.php/payroll_con') ?>">Home</a>
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
            <?php
          $success = $this->session->flashdata('success');
          if ($success != "") {
           ?>
            <div class="alert alert-success"><?php echo $success; ?></div>
            <?php
            }
            $failuer = $this->session->flashdata('failuer');
            if ($failuer) {
             ?>
            <div class="alert alert-failuer"><?php echo $failuer; ?></div>
            <?php
            }
            ?>

        </div>
    </div>
    <!-- <div class="row">
        <div class="col-md-12">
            <div class="col-md-6">
                <h3 style="margin-top: 0px; margin-bottom: 8px;">Shift Schedule List</h3>
            </div>
            <div class="col-md-6 text-right">
                <a href="<?=base_url('index.php/setup_con/shiftschedule_add')?>"  class="btn btn-info"
                    role="button">Add Shift Schedule</a>
            </div>
        </div>
    </div> -->
    <!-- <br> -->
    <div class="row tablebox">
        <div class="col-md-12">

            <table class="table table-striped" id="mytable">
                <thead>
                    <tr>
                        <th>Unit Name </th>
                        <th>Shift Type</th>
                        <th>IN Start</th>
                        <th>IN Time</th>
                        <th>Late Start</th>
                        <th>IN End</th>
                        <th>OUT Start</th>
                        <th>OUT End</th>
                        <th>OT Start</th>
                        <th>OT Minute</th>
                        <th>One Hour OT Time</th>
                        <th>Two Hour OT Time</th>
                        <th width="80">Edit</th>
                        <th>Delete</th>

                    </tr>
                </thead>
                <tbody>


                    <?php
                            if(!empty($pr_emp_shift_schedule)){ foreach($pr_emp_shift_schedule as $pr_emp_shift_schedules){  ?>
                          
                    <tr>
                        <td><?php echo $pr_emp_shift_schedules['unit_name'] ?></td>
                        <td><?php echo $pr_emp_shift_schedules['sh_type'] ?></td>
                        <td><?php echo $pr_emp_shift_schedules['in_start'] ?></td>
                        <td><?php echo $pr_emp_shift_schedules['in_time'] ?></td>
                        <td><?php echo $pr_emp_shift_schedules['late_start'] ?></td>
                        <td><?php echo $pr_emp_shift_schedules['in_end'] ?></td>
                        <td><?php echo $pr_emp_shift_schedules['out_start'] ?></td>
                        <td><?php echo $pr_emp_shift_schedules['out_end'] ?></td>
                        <td><?php echo $pr_emp_shift_schedules['ot_start'] ?></td>
                        <td><?php echo $pr_emp_shift_schedules['ot_minute_to_one_hour'] ?></td>
                        <td><?php echo $pr_emp_shift_schedules['one_hour_ot_out_time'] ?></td>
                        <td><?php echo $pr_emp_shift_schedules['two_hour_ot_out_time'] ?></td>
                        <td>
                            <a href="<?=base_url('index.php/setup_con/shiftschedule_edit').'/'.$pr_emp_shift_schedules["id"]?>"
                                 class="btn btn-primary" role="button">Edit</a>
                        </td>
                        <td>
                            <a href="<?=base_url('index.php/setup_con/shiftschedule_delete').'/'.$pr_emp_shift_schedules["id"]?>"
                                class="btn btn-danger" role="button">Delete</a>
                        </td>
                    </tr>
                    <?php } }else{?>

                    <tr>
                        <td colspan="12">Records not Found</td>
                    </tr>
                    <?php }?>

                </tbody>
            </table>
        </div>
    </div>
    <br><br>
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
        oTable.search($(this).val()).draw()
    })
})
</script>