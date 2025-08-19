
<style>
    #mytable {
        border-collapse: collapse;
    }

    #mytable, th, td {
        border: 1px solid #b0c0df;
        text-align: center;
        vertical-align: middle !important;
    }
    .table td {
        padding: 0px 3px !important;
        font-size: 13px;
      
    }
    table.dataTable thead th, table.dataTable thead td {
        border-bottom: none;
      white-space: nowrap;

    }
    table.dataTable tbody th, table.dataTable tbody td {
      padding: 4px !important;
      white-space: nowrap;
    }
    .center-text {
        vertical-align: center;
        padding: 5px 10px;
        /* line-height: 40px; Should be equal to the button's height */

    }
</style>

<div class="content">
    <nav class="navbar navbar-inverse bg_none">
        <div class="container-fluid nav_head">
            <div class="navbar-header col-md-5" style="padding: 7px;">
                <div>
                    <a class="btn btn-info" href="<?php echo base_url('training_con/employee_training_form') ?>">Add training</a>
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
        </div>
    <div class="col-md-12">
        <?php
            $success = $this->session->flashdata('success');
            if ($success != "") {
        ?>
        <div class="alert alert-success alert-dismissible"><?php echo $success; ?></div>
        <?php }
            $failuer = $this->session->flashdata('failuer');
            if ($failuer) {
        ?>
        <div class="alert alert-danger alert-dismissible"><?php echo $failuer; ?></div>
        <?php }  ?>
    </div>
    <br><br>
    <script>
        setTimeout(function() {
            $('.alert-dismissible').fadeOut('slow');
        }, 2000);
    </script>

    <div id="target-div" class="row tablebox">
        <div class="col-md-6" style="margin-left:-16px">
             <h3 style="font-weight:bold">Training List</h3>
         </div>

        <!-- MULTI ACTION FORM -->
        <form id="multiActionForm" method="post">
            <div style="margin-bottom:10px;">
                <button type="submit" formaction="<?= base_url('training_con/employee_training_done') ?>" 
                        class="btn btn-success btn-mini" id="doneSelectedBtn" disabled>Done Selected</button>

                <button type="submit" formaction="<?= base_url('training_con/employee_training_delete') ?>" 
                        class="btn btn-danger btn-mini" id="deleteSelectedBtn" disabled>Delete Selected</button>
            </div>

            <table class="table" id="mytable">
                <thead>
                    <tr>
                        <th><input type="checkbox" id="allCheck" /></th>
                        <th>Sl. No.</th>
                        <th>Employee Id</th>
                        <th>Employee Name</th>
                        <th>Training Name</th>
                        <th>Training Date</th>
                        <th>Unit</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($pr_line)) { foreach ($pr_line as $key => $pr_lines) { ?>
                        <tr>
                            <td>
                                <input type="checkbox" 
                                    name="done[]" 
                                    class="actionCheck" 
                                    value="<?php echo $pr_lines["id"] ?>" 
                                    <?php echo (!empty($pr_lines["status"]) && $pr_lines["status"] == "2") ? 'disabled' : ''; ?> />
                            </td>
                            <td><?php echo $key + 1 ?></td>
                            <td><?php echo $pr_lines["emp_id2"] ?></td>
                            <td><?php echo $pr_lines["emp_name"] ?></td>
                            <td><?php echo $pr_lines["training_name"] ?></td>
                            <td><?php echo $pr_lines["date"] ?></td>
                            <td><?php echo $pr_lines["unit_name"] ?></td>
                            <td>
                                <?php if (!empty($pr_lines["status"]) && $pr_lines["status"] == "2") { ?>
                                    <span style="background:#79ca10;padding:3px 5px;border-radius:4px;color:#ffffff"><b>Done</b></span>
                                <?php } else { ?>
                                    <span  style="background:#5e8300;padding:3px 5px;border-radius:4px;color:white"><b>Pending</b></span>
                                <?php } ?>
                            </td>
                            <td>
                                <?php if (!empty($pr_lines["status"]) && $pr_lines["status"] == "2") { ?>
                                    <!-- Disable Done button if already Done -->
                                    <button class="btn btn-success btn-mini" disabled>Done</button>
                                <?php } else { ?>
                                    <a class="btn btn-success btn-mini" href="<?= base_url('training_con/single_employee_training_done/'.$pr_lines["id"]) ?>" role="button">Done</a>
                                <?php } ?>
                                <a class="btn btn-danger btn-mini" href="<?= base_url('training_con/single_employee_training_delete/'.$pr_lines["id"]) ?>" role="button">Delete</a>
                            </td>
                        </tr>
                    <?php }} else { ?>
                        <tr>
                            <td colspan="12">Records not Found</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </form>
    </div>
    <br><br>
</div>

<!-- DATATABLE + ACTION SCRIPT -->
<script type="text/javascript">
$(document).ready(function() {
    $("#mytable").dataTable();
    $('#mytable_filter').css({"display": "none"});
    $('#mytable_length').css({"display": "none"});

    oTable = $('#mytable').DataTable();
    $('#deptSearch').keyup(function() {
        oTable.search($(this).val()).draw();
    });

    // Select/Deselect all
    $('#allCheck').on('click', function() {
        $('.actionCheck').prop('checked', this.checked);
        toggleButtons();
    });

    $(document).on('change', '.actionCheck', function() {
        toggleButtons();
        $('#allCheck').prop('checked', $('.actionCheck:checked').length === $('.actionCheck').length);
    });

    function toggleButtons() {
        const hasChecked = $('.actionCheck:checked').length > 0;
        $('#deleteSelectedBtn, #doneSelectedBtn').prop('disabled', !hasChecked);
    }

    // Confirm before bulk action
    $('#multiActionForm').on('submit', function(e) {
        if (!$('.actionCheck:checked').length) {
            e.preventDefault();
            return false;
        }
        if (!confirm('Are you sure you want to perform this action on selected records?')) {
            e.preventDefault();
            return false;
        }
    });
});
</script>
