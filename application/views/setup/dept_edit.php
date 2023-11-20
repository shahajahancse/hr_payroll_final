
  <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
  <div class="content">
    <nav class="navbar navbar-inverse">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" >Update Department</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a  href="<?php echo base_url('setup_con/department') ?>">Department List</a></li>
          </ul>
          <div class="pull-right">
            <form class="navbar-form pull-right" role="search">
              <div class="input-group">
                <input id="deptSearch" type="text" class="form-control" placeholder="Search">
                <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
                </div>
              </div>
            </form>
          </div>
        </div><!--/.nav-collapse -->
      </div><!--/.container-fluid -->
    </nav>

    <div class="row">
      <div class="col-md-8">
        <?php $success = $this->session->flashdata('success');
        if ($success != "") { ?>
         <div class="alert alert-success"><?php echo $success; ?></div>
         <?php } 
         $failuer = $this->session->flashdata('failuer');
         if ($failuer) { ?>
         <div class="alert alert-failuer"><?php echo $failuer; ?></div>
         <?php } ?>
      </div>
    </div>

    <div id="target-div">
      <div class="container-fluid">

    <h3>Update Department</h3>
    <hr>
    <form enctype="multipart/form-data" method="post" name="creatcompanyunit" action="<?php echo base_url("setup_con/dept_edit/$pr_dept->dept_id");?>">
      <div class="row">
        <div class="col-md-6">
          <input type="hidden" name="id" value="<?=$pr_dept->dept_id?>" class="form-control"> 

          <div class="form-group">
            <select name="unit_id" id= "unit_id" class="form-control input-sm select22">
              <option value="">Select Unit</option>
              <?php 
                foreach ($dept as $row)
                {
                  if($row['unit_id'] == $pr_dept->unit_id){
                    $select_data = "selected";
                  }else{
                    $select_data = '';
                  }
                  echo '<option '.$select_data.'  value="'.$row['unit_id'].'">'.$row['unit_name'].'</option>';
                }
              ?>
            </select>
          </div>

          <div class="form-group">
            <label>Department Name</label>
            <input type="text" name="dept_name"value="<?=set_value('dept_name',$pr_dept->dept_name)?>" class="form-control">
            <?php echo form_error('dept_name');?>
          </div>

          <div class="form-group">
            <label>Department Name Bangla</label>
            <input type="text" name="dept_bangla"value="<?=set_value('dept_bangla',$pr_dept->dept_bangla)?>" class="form-control">
            <?php echo form_error('dept_bangla');?>
          </div>
         
          <div class="form-group">
            <button class="btn btn-primary">Update</button>
            <a href=""class="btn-warning btn">Cancel</a>
          </div>
        </div>
      </div>
    </form>



      </div>
    </div>

  </div>