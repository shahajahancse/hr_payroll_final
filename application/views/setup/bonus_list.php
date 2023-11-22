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
                    <a class="btn btn-info" href="<?php echo base_url('index.php/setup_con/bonus_add') ?>">Add Bonus</a>
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
    <!-- <br> -->
    <div class="row tablebox">

        <div class="col-md-12">
            <table class="table table-striped" id="mytable">
                <thead>
                    <tr>
                        <th>Unit Name</th>
                        <th>Emp type</th>
                        <th>Bonus first month</th>
                        <th>Bonus second month</th>
                        <th>Bonus amount</th>
                        <th>Bonus amount fraction</th>
                        <th>Bonus percent</th>
                        <th>Effective date</th>
                        <th width="80">Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                         // print_r($pr_bonus_rules);exit('keno?');


                            if(!empty($pr_bonus_rules)){ foreach($pr_bonus_rules as $pr_bonus_rule){?>

                    <tr>
                        <td><?php echo $pr_bonus_rule['unit_name'] ?></td>
                        <td><?php echo $pr_bonus_rule['emp_type'] ?></td>
                        <td><?php echo $pr_bonus_rule['bonus_first_month'] ?></td>
                        <td><?php echo $pr_bonus_rule['bonus_second_month'] ?></td>
                        <td><?php echo $pr_bonus_rule['bonus_amount'] ?></td>
                        <td><?php echo $pr_bonus_rule['bonus_amount_fraction'] ?></td>
                        <td><?php echo $pr_bonus_rule['bonus_percent'] ?></td>
                        <td><?php echo $pr_bonus_rule['effective_date'] ?></td>


                        <td>
                            <a href="<?=base_url('index.php/setup_con/bonus_edit').'/'.$pr_bonus_rule["id"]?>"
                                target='_blank' class="btn btn-primary" role="button">Edit</a>
                        </td>

                        <td>
                            <a href="<?=base_url('index.php/setup_con/bonus_delete').'/'.$pr_bonus_rule["id"]?>"
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
        oTable.search($(this).val()).draw();
    })
});
</script>