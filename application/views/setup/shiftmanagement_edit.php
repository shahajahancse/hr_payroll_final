<!DOCTYPE html>
<html lang="en">
<head>
  <title>Shift Management Edit</title>
  <meta charset="utf-8">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="<?php echo base_url('/assets/bootstrap/css/bootstrap.min.css') ?>">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="<?php echo base_url('/assets/bootstrap/js/bootstrap.js') ?>"></script>
</head>
<body>



<div class="container" style="padding-top: 10px;">
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
            <a class="navbar-brand" href="#">Update Shift Management</a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li class="active"><a href="<?php echo base_url('index.php/payroll_con') ?>">Home</a></li>
            </ul>
            
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>

  <h3>Update Shift Management</h3>
  <hr>
  <form enctype="multipart/form-data" method="post" name="editshiftmanagement" action="<?php echo base_url().'index.php/crud_con/shiftmanagement_edit/'.$pr_emp_shift->shift_id;?>">
  <div class="row">
    <div class="col-md-6">
      <input type="hidden" name="id"value="<?=$pr_emp_shift->shift_id;?>" class="form-control"> 
      

     <div class="form-group">
        <label>Shift Name</label>
        <input type="text" name="stname"value="<?=set_value('shift_name',$pr_emp_shift->shift_name)?>" class="form-control">
        <?php echo form_error('stname');?>
      </div>
     <div class="form-group">
    
        <label>Unit ID</label>
        <input type="text" name="unitid"value="<?=set_value('unit_id',$pr_emp_shift->unit_id)?>" class="form-control">
        <?php echo form_error('unitid');?>
      </div>
     <div class="form-group">
          <select name="stype" id= "stype" class="form-control input-lg select22">
            <option value="">Shift Type</option>
            <?php 
            // print_r($shiftmanagement);exit('mafiz');
              foreach ($shiftmanagement as $row)
              {
              	if($row[shift_id]==$pr_emp_shift->shift_id){
              		$select_data="selected";
              	}else{
              		$select_data='';
              	}
                 echo '<option '.$select_data.'  value="'.$row[shift_id].'">'.$row[sh_type].'</option>';                  
              }

             ?>
            
          </select>
        </div>
     
     
      <div class="form-group">
        <button class="btn btn-primary">Update</button>
        <a href=""class="btn-warning btn">Cancel</a>
      </div>
    </div>
  </div>
</form>
</div>

</body>
</html>