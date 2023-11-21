
<div class="content" >
<!-- Static navbar -->
      <nav class="navbar navbar-inverse">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?=base_url('index.php/setup_con/company_info_setup')?>">Back Comapny Unit</a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li class="active"><a href="<?php echo base_url('index.php/payroll_con') ?>">Home</a></li>
            </ul>

          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
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

  <h3>Create Company Unit</h3>
  <hr>
  <form enctype="multipart/form-data" method="post" name="creatcompanyunit" action="<?php echo base_url().'index.php/setup_con/company_add'?>">
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label>Company Name English</label>
        <input type="text" name="name"value="" class="form-control">
        <?php echo form_error('name');?>
      </div>
      <div class="form-group">
        <label>Company Name Bangla</label>
        <input type="text" name="bname"value="" class="form-control">
        <?php echo form_error('bname');?>
      </div>
      <div class="form-group">
        <label>Company Address English</label>
        <input type="text" name="en_add"value="" class="form-control">
        <?php echo form_error('en_add');?>
      </div>
      <div class="form-group">
        <label>Company Address Bangla</label>
        <input type="text" name="bn_add"value="" class="form-control">
        <?php echo form_error('bn_add');?>
      </div>
      <div class="form-group">
        <label>Company Phone No</label>
        <input type="text" name="phn"value="" class="form-control">
        <?php echo form_error('phn');?>
      </div>
      <div class="form-group">
        <label>Company Logo</label>

        <input style="padding: 0px;" type="file" name="comlogo" id="comlogo" value="" class="form-control">
      </div>
      <div class="form-group">
        <label>Company Signature</label>
        <input style="padding: 0px;" type="file" name="comsign" id="comsign" value="" class="form-control">
      </div>
      <div class="form-group">
        <button class="btn btn-primary">Create</button>
        <a href=""class="btn-warning btn">Cancel</a>
      </div>
    </div>
  </div>
</form>
</div>
