<!DOCTYPE html>
<html lang="en">
<head>
  <title>Line Edit</title>
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
            <a class="navbar-brand" href="#">Update line</a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li class="active"><a href="<?php echo base_url('index.php/payroll_con') ?>">Home</a></li>
            </ul>
            
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>

  <h3>Update Line</h3>
  <hr>
  <form enctype="multipart/form-data" method="post" name="creatcompanyline" action="<?php echo base_url().'index.php/crud_con/line_edit/'.$pr_line->line_id;?>">
  <div class="row">
    <div class="col-md-6">
      <input type="hidden" name="id"value="<?=$pr_line->line_id?>" class="form-control">
      <div class="form-group">
    
        <label>Line Name</label>
        <input type="text" name="name"value="<?=set_value('line_name',$pr_line->line_name)?>" class="form-control">
        <?php echo form_error('name');?>
      </div>
      <div class="form-group">
    
        <label>line Name Bangla</label>
        <input type="text" name="bname"value="<?=set_value('line_bangla',$pr_line->line_bangla)?>" class="form-control">
        <?php echo form_error('bname');?>
      </div>
      <div class="form-group">
    
        <label>Strength</label>
        <input type="text" name="strn"value="<?=set_value('strength',$pr_line->strength)?>" class="form-control">
        <?php echo form_error('strn');?>
      </div>
      
      <div class="form-group">
    
      <div class="form-group">
          <select name="line" id= "line" class="form-control input-lg">
            <option value="">Select Unit</option>
            <?php 
            // print_r($line);exit('mafiz');
              foreach ($line as $row)
              {
              	if($row[unit_id]==$pr_line->unit_id){
              		$select_data="selected";
              	}else{
              		$select_data='';
              	}
                 echo '<option '.$select_data.'  value="'.$row[unit_id].'">'.$row[unit_name].
                 '</option>';                  
              }

             ?>
            
          </select>
        </div>

         <label>line index</label>
        <input type="text" name="indx"value="<?=set_value('indexing',$pr_line->indexing)?>" class="form-control">
        <?php echo form_error('indx');?>
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