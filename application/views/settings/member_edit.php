<div class="content">
<!-- Static navbar -->
     <nav class="navbar navbar-inverse bg_none">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="btn" href="#">Update Member</a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li class="active"><a href="<?php echo base_url('payroll_con') ?>">Home</a></li>
            </ul>

          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>

  <!-- <h3>Update Member</h3> -->
  <!-- <hr> -->
  <div style="padding-left: 20px; padding-top: 10px;">
    <form enctype="multipart/form-data" method="post" name="creatcompanyunit" action="<?php echo base_url('setting_con/update_member/').$row->id;?>">
      <div class="row">
        <div class="col-md-6">
          <input type="hidden" name="id"value="<?=$row->id?>" class="form-control">
          <div class="form-group">

            <label>Member Name</label>
            <input type="text" name="id_number"value="<?=set_value('id_number',$row->id_number)?>" class="form-control">
            <?php echo form_error('id_number');?>
          </div>
          <div class="form-group">
            <label>Password</label>
            <input type="password" name="password"value="<?=set_value('password',$row->password)?>" class="form-control">
            <?php echo form_error('password');?>
          </div>
          <div class="form-group">
            <label>Level</label>
              <select name="level" id= "field-level" class="form-control chosen-select chzn-done">
                <option value="">Select level</option>
                <option value="All" <?php echo ($row->level == "All")? "selected":"";?>>All</option>
                <option value="Unit" <?php echo ($row->level == "Unit")? "selected":"";?>>Unit</option>
              </select>
          </div>
          <div class="form-group">
            <label>Unit Name</label>
              <select name="unit_name" id= "field-unit_name" class="form-control">
                <option value="">Select Unit</option>
                <?php foreach ($pr_units as $r) { ?>
                  <option <?= ($row->unit_name == $r->unit_id)? 'selected':'' ?> value="<?= $r->unit_id ?>"> <?= $r->unit_name?> </option>
                <?php } ?>
              </select>
          </div>
          <div class="form-group">
            <label>Status</label>
              <select name="status" id= "field-status" class="form-control">
                <option value="">select status</option>
                <option <?= ($row->status == 'Enable')? 'selected':'' ?> value="Enable">Enable</option>
                <option <?= ($row->status == 'Disable')? 'selected':'' ?> value="Disable">Disable</option>
              </select>
          </div>
        </div>

        <div class="clearfix"></div>
        <div class="col-md-6">
          <div class="form-group">
            <button class="btn btn-primary">Update</button>
            <a href=""class="btn-warning btn">Cancel</a>
          </div>
        </div>

      </div>
    </form>
  </div>

</div>
