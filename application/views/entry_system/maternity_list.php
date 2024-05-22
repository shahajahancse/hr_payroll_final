
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
                    <a class="btn btn-info" href="<?php echo base_url('entry_system_con/maternity_entry') ?>">Add Maternity</a>
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

        <div class="col-md-12 table-responsive">
            <table class="table table-striped" id="mytable">
                <thead>
                    <tr>
                        <th style="white-space: nowrap;" >SL</th>
                        <th style="white-space: nowrap;" >User name </th>
                        <th style="white-space: nowrap;" >Emp Id</th>
                        <th style="white-space: nowrap;" >Prev. M. Salary</th>
                        <th style="white-space: nowrap;" >Attendance Bonus</th>
                        <th style="white-space: nowrap;" >Festival Bonus</th>
                        <th style="white-space: nowrap;" >Other Benifit</th>
                        <th style="white-space: nowrap;" >Inform Date</th>
                        <th style="white-space: nowrap;" >Probable Date</th>
                        <th style="white-space: nowrap;" >Start Date</th>
                        <th style="white-space: nowrap;" >End Date</th>
                        <th style="white-space: nowrap;" >First Pay</th>
                        <th style="white-space: nowrap;" >Second Pay</th>
                        <th style="white-space: nowrap;" >Pay Day</th>
                        <th style="white-space: nowrap;" >Total Day</th>
                        <th style="white-space: nowrap;" >Unit name</th>
                        <th style="white-space: nowrap;" >Delete</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if (!empty($results)) {foreach ($results as $key => $r) {?>
                    <tr>
                        <td style="white-space: nowrap;"><?php echo $key + 1  ?></td>
                        <td style="white-space: nowrap;"><?php echo $r->name_en ?></td>
                        <td style="white-space: nowrap;"><?php echo $r->emp_id ?></td>
                        <td style="white-space: nowrap;"><?php echo $r->prev_month_salary ?></td>
                        <td style="white-space: nowrap;"><?php echo $r->attn_bonus ?></td>
                        <td style="white-space: nowrap;"><?php echo $r->festival_bonus ?></td>
                        <td style="white-space: nowrap;"><?php echo $r->ather_benifit ?></td>
                        <td style="white-space: nowrap;"><?php echo $r->inform_date ?></td>
                        <td style="white-space: nowrap;"><?php echo $r->probability ?></td>
                        <td style="white-space: nowrap;"><?php echo $r->start_date ?></td>
                        <td style="white-space: nowrap;"><?php echo $r->end_date ?></td>
                        <td style="white-space: nowrap;"><?php echo $r->first_pay ?></td>
                        <td style="white-space: nowrap;"><?php echo $r->second_pay ?></td>
                        <td style="white-space: nowrap;"><?php echo $r->pay_day ?></td>
                        <td style="white-space: nowrap;"><?php echo $r->total_day * 2?></td>
                        <td style="white-space: nowrap;"><?php echo $r->unit_name ?></td>
                        <td>
                            <a href="<?=base_url('entry_system_con/maternity_delete/'.$r->id)?>"
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
