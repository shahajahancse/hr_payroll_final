

<div class="content">
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
            <a class="navbar-brand" href="#">Add Comapny Unit</a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li class="active"><a href="<?php echo base_url('index.php/payroll_con') ?>">Home</a></li>
            </ul>
            
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>

  <h3>Update Company Unit</h3>
  <hr>
  <form enctype="multipart/form-data" method="post" name="creatcompanyunit" action="<?php echo base_url().'index.php/setup_con/company_edit/'.$company_infos->id;?>">
  <div class="row">
    <div class="col-md-6">
      <input type="hidden" name="id"value="<?=$company_infos->id?>" class="form-control">
      <div class="form-group">
      <?php //print_r($company_infos);exit(); ?>
        <label>Company Name English</label>
        <input type="text" name="name"value="<?=set_value('company_name_english',$company_infos->company_name_english)?>" class="form-control">
        <?php echo form_error('name');?>
      </div>
      <div class="form-group">
        <label>Company Name Bangla</label>
        <input type="text" name="bname"value="<?php echo set_value('company_name_bangla',$company_infos->company_name_bangla)?>" class="form-control">
        <?php echo form_error('bname');?>
      </div>
      <div class="form-group">
        <label>Company Address English</label>
        <input type="text" name="en_add"value="<?php echo set_value('company_add_english',$company_infos->company_add_english)?>" class="form-control">
        <?php echo form_error('en_add');?>
      </div>
      <div class="form-group">
        <label>Company Address Bangla</label>
        <input type="text" name="bn_add"value="<?php echo set_value('company_add_bangla',$company_infos->company_add_bangla)?>" class="form-control">
        <?php echo form_error('bn_add');?>
      </div>
      <div class="form-group">
        <label>Company Phone No</label>
        <input type="text" name="phn"value="<?php echo set_value('company_phone',$company_infos->company_phone)?>" class="form-control">
        <?php echo form_error('phn');?>
      </div>
      <div class="form-group">
        <label>Company Logo</label>
        <img width="55" height="55" src="<?=base_url()?>images/<?=$company_infos->company_logo ?>" />
        <input type="file" name="comlogo" id="comlogo" value="<?php echo set_value('company_logo',$company_infos->company_logo)?>" class="form-control">
      </div>
      <div class="form-group">
        <label>Company Signature</label>
        <img width="55" height="55" src="<?=base_url()?>images/<?=$company_infos->company_signature ?>" />
        <input type="file" name="comsign"value="" class="form-control">
      </div>
      <div class="form-group">
        <button class="btn btn-primary">Update</button>
        <a href=""class="btn-warning btn">Cancel</a>
      </div>
    </div>
  </div>
</form>
</div>
