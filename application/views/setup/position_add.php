<div class="content">

    <nav class="navbar navbar-inverse bg_none">
        <div class="container-fluid nav_head">
            <div class="navbar-header col-md-3" style="padding: 7px;">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div>
                    <a class="btn btn-info" href="<?php echo base_url('setup_con/position') ?>">
                        < < Back</a>
                            <a class="btn btn-primary" href="<?php echo base_url('payroll_con') ?>">Home</a>
                </div>
            </div>
            <div class="col-md-6">
                <div id="navbar" class="navbar-collapse collapse">
                    <div class="">
                        <form class="navbar-form pull-right" role="search">
                            <div class="input-group">
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
        <?php
            $failuer = $this->session->flashdata('failure');
            ?>
    </div>
    <div class="tablebox">

        <h3>Create Position</h3>
        <hr>
        <form action="<?= base_url('setup_con/position_add')?>" enctype="multipart/form-data" method="post">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group col-md-6">
                        <label>Position Name English</label>
                        <input type="text" name="posi_name" value="" placeholder="Position Name english"
                            class="form-control">
                        <?=(isset($failuer['posi_name'])) ? '<div class="alert alert-failuer">' . $failuer['posi_name'] . '</div>' : ''; ?>
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label>Position Name Bangla</label>
                        <input type="text" name="posi_name_bn" value="" placeholder="Position Name Bangla"
                            class="form-control">
                        <?=(isset($failuer['posi_name_bn'])) ? '<div class="alert alert-failuer">' . $failuer['posi_name_bn'] . '</div>' : ''; ?>
                    </div>
                    <br>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary ">Submit</button></button>
                        <a href="" class="btn-warning btn">Cancel</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>