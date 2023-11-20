<div class="content">
    <!-- Static navbar -->
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
                <a class="navbar-brand" href="<?php echo base_url('index.php/setup_con/shift_schedule')?>">Back To
                    List</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="<?php echo base_url('index.php/payroll_con')?>">Home</a></li>
                </ul>

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

    <h3>Create Shift Schedule</h3>
    <hr>
    <form enctype="multipart/form-data" method="post" name="creatshiftschedule"
        action="<?php echo base_url().'index.php/setup_con/shiftschedule_add'?>">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <select name="uname" id="uname" class="form-control input-lg select22">
                        <option value="">Select Unit</option>
                        <?php
              foreach ($allUnit as  $row){
                 echo '<option value="'.$row['unit_id'].'">'.$row['unit_name'].'</option>';
              }
             ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Shift Type</label>
                    <input type="text" name="stype" value="" class="form-control">
                    <?php echo form_error('stype');?>
                </div>
                <div class="form-group">
                    <label>IN Start</label>
                    <input type="text" name="instrt" value="" class="form-control">
                    <?php echo form_error('instrt');?>
                </div>
                <div class="form-group">
                    <label>IN Time</label>
                    <input type="text" name="intime" value="" class="form-control">
                    <?php echo form_error('intime');?>
                </div>
                <div class="form-group">
                    <label>Late Start</label>
                    <input type="text" name="ltstart" value="" class="form-control">
                    <?php echo form_error('ltstart');?>
                </div>
                <div class="form-group">
                    <label>IN End</label>
                    <input type="text" name="inend" value="" class="form-control">
                    <?php echo form_error('inend');?>
                </div>
                <div class="form-group">
                    <label>OUT Start</label>
                    <input type="text" name="outstart" value="" class="form-control">
                    <?php echo form_error('outstart');?>
                </div>
                <div class="form-group">
                    <label>OUT End</label>
                    <input type="text" name="outend" value="" class="form-control">
                    <?php echo form_error('outend');?>
                </div>
                <div class="form-group">
                    <label>OT Start</label>
                    <input type="text" name="otstart" value="" class="form-control">
                    <?php echo form_error('otstart');?>
                </div>
                <div class="form-group">
                    <label>OT Minute</label>
                    <input type="text" name="otminute" value="" class="form-control">
                    <?php echo form_error('otminute');?>
                </div>
                <div class="form-group">
                    <label>One Hour OT Time</label>
                    <input type="text" name="onehrottime" value="" class="form-control">
                    <?php echo form_error('onehrottime');?>
                </div>
                <div class="form-group">
                    <label>Two Hour OT Time</label>
                    <input type="text" name="twohrottime" value="" class="form-control">
                    <?php echo form_error('twohrottime');?>
                </div>


                <br>

                <div class="form-group">
                    <button class="btn btn-primary">Create</button>
                    <a href="" class="btn-warning btn">Cancel</a>
                </div>
            </div>
        </div>
    </form>
</div>
>