
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
                    <a class="btn btn-info" href="<?php echo base_url('entry_system_con/leave_transation') ?>">Add Leave</a>
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
                        <th>SL</th>
                        <th>User name </th>
                        <th>Emp Id</th>
                        <th>Type</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Total Day</th>
                        <th>Unit name</th>
                        <th>Delete</th>
                    </tr>
                </thead>

                </thead>

                <tbody>

                    <?php if (!empty($results)) {foreach ($results as $key => $r) {?>

                    <tr>
                        <td><?php echo $key + 1  ?></td>
                        <td><?php echo $r->user_name ?></td>
                        <td><?php echo $r->emp_id ?></td>
                        <td><?php echo $r->leave_type ?></td>
                        <td><?php echo $r->leave_start ?></td>
                        <td><?php echo $r->leave_end ?></td>
                        <td><?php echo $r->total_leave ?></td>
                        <td><?php echo $r->unit_name ?></td>
                        <td>
                            <a href="<?=base_url('entry_system_con/emp_leave_del/'.$r->id)?>"
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
