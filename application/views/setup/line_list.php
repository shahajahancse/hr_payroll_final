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
                    <a class="btn btn-info" href="<?php echo base_url('index.php/setup_con/line_add') ?>">Add Line</a>
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

    <div class="row tablebox">

        <div class="col-md-12">

            <table class="table table-striped" id="mytable">
                <thead>
                    <tr>
                        <th>SL</th>
                        <th>Line Name English </th>
                        <th>Line Name Bangla </th>
                        <th>Unit Name </th>
                        <th>Department Name </th>
                        <th>Section Name</th>
                        <th width="80">Edit</th>
                        <th>Delete</th>

                    </tr>
                </thead>

                </thead>

                <tbody>

                    <?php

                  if (!empty($pr_line)) {foreach ($pr_line as $key => $pr_lines) {?>

                    <tr>
                        <td><?php echo $key + 1  ?></td>
                        <td><?php echo $pr_lines['line_name_en'] ?></td>
                        <td><?php echo $pr_lines['line_name_bn'] ?></td>
                        <td><?php echo $pr_lines['unit_name'] ?></td>
                        <td><?php echo $pr_lines['dept_name'] ?></td>
                        <td><?php echo $pr_lines['sec_name_en'] ?></td>
                        <td>
                            <a href="<?=base_url('index.php/setup_con/line_edit') . '/' . $pr_lines["id"]?>"
                                 class="btn btn-primary" role="button">Edit</a>
                        </td>

                        <td>
                            <a href="<?=base_url('index.php/setup_con/line_delete') . '/' . $pr_lines["id"]?>"
                                class="btn btn-danger" role="button">Delete</a>
                        </td>
                    </tr>
                    <?php }} else {?>

                    <tr>
                        <td colspan="12">Records not Found</td>
                    </tr>
                    <?php }?>

                </tbody>
            </table>
            <!-- <div class="pagination"><?php echo $this->pagination->create_links(); ?></div> -->
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
        oTable.search($(this).val()).draw();
    })
});
</script>