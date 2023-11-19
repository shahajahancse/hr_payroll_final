<div class="content">

    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo base_url('index.php/setup_con/iftar_bill_add') ?>">Add Iftar Bill  Allowance</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="<?php echo base_url('index.php/payroll_con') ?>">Home</a></li>
                </ul>
                <div class="pull-right">
                    <form class="navbar-form pull-right" role="search">
                        <div class="input-group">
                            <input id="deptSearch" type="text" class="form-control" placeholder="Search">
                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-default"><span
                                        class="glyphicon glyphicon-search"></span></button>
                            </div>
                        </div>
                    </form>
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
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-6">
                <h3 style="margin-top: 0px; margin-bottom: 8px;">Iftar Bill  Allowance List</h3>
            </div>
            <div class="col-md-6 text-right">
                <a href="<?=base_url('index.php/setup_con/iftar_bill_add')?>" target='_blank' class="btn btn-info"
                    role="button">Add Iftar Bill  Allowance</a>
            </div>
        </div>
    </div>

    <!-- <br> -->
    <div class="row">

        <div class="col-md-12">

            <table class="table table-striped" id="mytable">
                <thead>
                    <tr>
                        <th>SL</th>
                        <th>Rule Name</th>
                        <th>Allowance Amount</th>
                        <th>Unit name</th>
                        <th width="80">Edit</th>
                        <th>Delete</th>

                    </tr>
                </thead>

                </thead>

                <tbody>

                    <?php

                  if (!empty($allowance_iftar_bill)) {foreach ($allowance_iftar_bill as $key => $pr_lines) {?>

                    <tr>
                        <td><?php echo $key + 1  ?></td>
                        <td><?php echo $pr_lines['rule_name'] ?></td>
                        <td><?php echo $pr_lines['allowance_amount'] ?></td>
                        <td><?php echo $pr_lines['unit_name'] ?></td>
                        <td>
                            <a href="<?=base_url('index.php/setup_con/iftar_bill_edit') . '/' . $pr_lines["id"]?>"
                                target='_blank' class="btn btn-primary" role="button">Edit</a>
                        </td>

                        <td>
                            <a href="<?=base_url('index.php/setup_con/iftar_bill_delete') . '/' . $pr_lines["id"]?>"
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