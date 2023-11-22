<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
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
                    <a class="btn btn-info" href="<?php echo base_url('index.php/setup_con/department') ?>">
                        < < Back</a>
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
    <div class="row">
        <?php
            $failuer = $this->session->flashdata('failure');
            ?>
    </div>
    <div class="tablebox">
        <h3>Create Department</h3>
        <form enctype="multipart/form-data" method="post" name="creatdepartment"
            action="<?php echo base_url('setup_con/dept_add')?>">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <select name="unit_id" id="unit_id" class="form-control input-sm select22">
                                <option value="">Select Unit</option>
                                <?php 
                    foreach ($dept as $row) {
                      if($row['unit_id'] == $user_data->unit_name){
                        $select_data="selected";
                      }else{
                        $select_data='';
                      }  
                       echo '<option '.$select_data.'  value="'.$row['unit_id'].'">'.$row['unit_name'].
                       '</option>';
                    }
                  ?>
                            </select>
                        </div>
                    </div>

                    <div class="row">

                        <div class="form-group col-md-6">
                            <label>Department Name</label>
                            <input type="text" name="dept_name" value="" class="form-control">
                            <?php echo form_error('dept_name');?>
                        </div>

                        <div class="form-group col-md-6">
                            <label>Department Name Bangla</label>
                            <input type="text" name="dept_bangla" value="" class="form-control">
                            <?php echo form_error('dept_bangla');?>
                        </div>
                    </div>



                    <br>

                    <div class="form-group footer_button">
                        <button class="btn btn-primary">Create</button>
                        <a href="" class="btn-warning btn">Cancel</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>