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
                    <a class="btn btn-info" href="<?php echo base_url('index.php/setup_con/shift_schedule') ?>">Back</a>
                            <a class="btn btn-primary" href="<?php echo base_url('index.php/payroll_con') ?>">Home</a>
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
    <!-- Static navbar -->

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

    <!-- <h3>Create Shift Schedule</h3> -->
    <!-- <hr> -->
    <div class="tablebox">

        <form enctype="multipart/form-data" method="post" name="creatshiftschedule"
        action="<?php echo base_url().'index.php/setup_con/shiftschedule_add'?>">
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="unit_id">Unit</label>
                    <select name="uname" id="uname" class="form-control input-sm select22">
                        <option value="">Select Unit</option>
                        <?php
                        foreach ($allUnit as  $row){
                            echo '<option value="'.$row['unit_id'].'">'.$row['unit_name'].'</option>';
                            }
                        ?>
                    </select>
                </div>

            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Shift Type</label>
                    <input type="text" name="stype" value="" class="form-control  input-sm">
                    <?php echo form_error('stype');?>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>IN Start</label>
                    <input type="text" name="instrt" value="" class="form-control input-sm">
                    <?php echo form_error('instrt');?>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>IN Time</label>
                    <input type="text" name="intime" value="" class="form-control input-sm">
                    <?php echo form_error('intime');?>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label>Late Start</label>
                    <input type="text" name="ltstart" value="" class="form-control input-sm">
                    <?php echo form_error('ltstart');?>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>IN End</label>
                    <input type="text" name="inend" value="" class="form-control input-sm">
                    <?php echo form_error('inend');?>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>OUT Start</label>
                    <input type="text" name="outstart" value="" class="form-control input-sm">
                    <?php echo form_error('outstart');?>
                </div>
            </div>
            <div class="col-md-3">
                
                <div class="form-group">
                    <label>OUT End</label>
                    <input type="text" name="outend" value="" class="form-control input-sm">
                    <?php echo form_error('outend');?>
                </div>
            </div>
        </div>
        <div class="row">



            <div class="col-md-3">
                <div class="form-group">
                    <label>OT Start</label>
                    <input type="text" name="otstart" value="" class="form-control input-sm">
                    <?php echo form_error('otstart');?>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>OT Minute</label>
                    <input type="text" name="otminute" value="" class="form-control input-sm">
                    <?php echo form_error('otminute');?>
                </div>

            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>One Hour OT Time</label>
                    <input type="text" name="onehrottime" value="" class="form-control input-sm">
                    <?php echo form_error('onehrottime');?>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Two Hour OT Time</label>
                    <input type="text" name="twohrottime" value="" class="form-control input-sm">
                    <?php echo form_error('twohrottime');?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <button class="btn btn-primary">Create</button>
            <a href="" class="btn btn-warning">Cancel</a>
        </div>
    </form>
</div>

</div>