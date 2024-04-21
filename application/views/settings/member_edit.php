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
    <form enctype="multipart/form-data" method="post" name="creatcompanyunit" action="<?php echo base_url().'setting_con/update_member/'.$member->id;?>">
      <div class="row">
        <div class="col-md-6">
          <input type="hidden" name="id"value="<?=$member->id?>" class="form-control">
          <div class="form-group">

            <label>Member Name</label>
            <input type="text" name="id_number"value="<?=set_value('id_number',$member->id_number)?>" class="form-control">
            <?php echo form_error('id_number');?>
          </div>
          <div class="form-group">
            <label>Password</label>
            <input type="password" name="password"value="<?=set_value('password',$member->password)?>" class="form-control">
            <?php echo form_error('password');?>
          </div>
          <div class="form-group">
            <label>Level</label>
              <select name="level" id= "field-level" class="form-control chosen-select chzn-done">
                <!-- <option value="<?=set_value('level',$member->level)?>"><?php echo $member->level; ?></option> -->
                <option value="">Select level</option>
                <option value="All" <?php echo ($member->level == "All")? "selected":"";?>>All</option>
                <option value="Unit" <?php echo ($member->level == "Unit")? "selected":"";?>>Unit</option>
              </select>
          </div>
          <div class="form-group">
            <label>Unit Name</label>
              <select name="unit_name" id= "field-unit_name" class="form-control">
                <option value="<?=set_value('unit_name',$member->u_id)?>"><?=$member->unit_name?></option>
              </select>
          </div>
          <div class="form-group">
            <label>Status</label>
              <select name="status" id= "field-status" class="form-control">
                <option value="<?=set_value('id_number',$member->status)?>"><?php echo $member->status ?></option>
                <option value="Enable">Enable</option>
                <option value="Disable">Disable</option>
              </select>
          </div>
        </div>

        <div class="col-md-6" style="padding-left: 25px;">
          <div class="form-group">
            <label>ACL</label> <br>
            <?php foreach ($acls as $key => $acl) { ?>
              <label class="checkbox-inline">&nbsp;
              <input type="checkbox" name="acl_id[]" value="<?php echo $acl->id; ?>" <?php echo ($acl->acl_id != 0 )? "checked":"" ?>><?php echo $acl->acl_name; ?></label><br>
            <?php } ?>
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
