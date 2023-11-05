<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bonus Rules Edit</title>
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
            <a class="navbar-brand" href="#">Update Bonus Rules</a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li class="active"><a href="<?php echo base_url('index.php/payroll_con') ?>">Home</a></li>
            </ul>
            
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>

  <h3>Update Bonus Rules</h3>
  <hr>
  <form enctype="multipart/form-data" method="post" name="creatcompanyunit" action="<?php echo base_url().'index.php/crud_con/bnruls_edit/'.$bonus_rules[0]['id'];?>">
  <div class="row">
    <div class="col-md-6">
      <input type="hidden" name="id"value="<?=$bonus_rules[0]['id'];?>" class="form-control"> 
      
      <div class="form-group">
           <select name="unit" id= "unit" class="form-control input-lg">
            <option value="">Select Unit</option>
            <?php 
            // print_r($units);exit('mafiz');
             foreach ($units as $row)
              {
              	if($row[unit_id]==$bonus_rules[0]['unit_id']){
              		$select_data="selected";
              	}else{
              		$select_data='';
              	}
                 echo '<option '.$select_data.'  value="'.$row[unit_id].'">'.$row[unit_name].'</option>';                  
              }

             ?>
            
           </select>
         </div>

         <div class="form-group">
           <select name="emptyp" id= "emptyp" class="form-control input-lg">
            <option value="">Select EMP Type</option>
            <?php 
             foreach ($emp_type as $key => $row){
              	if( $row['emp_sts'] == $bonus_rules[0]['emp_type']){
              		$select_data = "selected";
              	}else{
              		$select_data = '';
              	}
                echo '<option '.$select_data.' value="'.$row['emp_sts'].'">'.$row['emp_sts'].'</option>';                
             }

             ?>
            
           </select>
         </div>


      	<div class="form-group">
    
        <label>Bonus first month</label>
        <input type="text" name="bfmnth"value="<?=set_value('bonus_first_month',$bonus_rules[0]['bonus_first_month'])?>" class="form-control">
        <?php echo form_error('bfmnth');?>
      </div>
      <div class="form-group">
    
        <label>Bonus second month</label>
        <input type="text" name="bsmnth"value="<?=set_value('bonus_second_month',$bonus_rules[0]['bonus_second_month'])?>" class="form-control">
        <?php echo form_error('bsmnth');?>
      </div>
     <div class="form-group">
           <select name="bamnt" id= "bamnt" class="form-control input-lg">
            <option value="">Bonus Amount</option>
            <option value="Gross" <?= $bonus_rules[0]['bonus_amount']== 'Gross'?"selected":'' ?> >Gross</option>
            <option value="Basic" <?= $bonus_rules[0]['bonus_amount']== 'Basic'?"selected":'' ?>>Basic</option>
            </select>
         </div>
     <div class="form-group">
    
        <label>Bonus amount fraction</label>
        <input type="text" name="bamntf"value="<?=set_value('bonus_amount_fraction',$bonus_rules[0]['bonus_amount_fraction'])?>" class="form-control">
        <?php echo form_error('bamntf');?>
      </div>
     <div class="form-group">
    
        <label>Bonus percent</label>
        <input type="text" name="bper"value="<?=set_value('bonus_percent',$bonus_rules[0]['bonus_percent'])?>" class="form-control">
        <?php echo form_error('bper');?>
      </div>
     <div class="form-group">
    
        <label>Effective date</label>
        <input type="date" class="form-control" name="date_out" value="<?php echo isset($itemOutData->date_out) ? set_value('date_out', date('Y-m-d', strtotime($itemOutData->date_out))) : set_value('effective_date',$bonus_rules[0]['effective_date']); ?>">
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