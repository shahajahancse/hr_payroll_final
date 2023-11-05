<!DOCTYPE html>
<html lang="en">
<head>
  <title>Add Line</title>
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
            <a class="navbar-brand" href="<?php echo base_url('index.php/setup_con/line')?>">Back To List</a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li class="active"><a href="<?php echo base_url('index.php/payroll_con')?>">Home</a></li>
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

  <h3>Create Line</h3>
  <hr>
  <form enctype="multipart/form-data" method="post" name="crealLine" action="<?php echo base_url().'index.php/crud_con/line_add'?>">
	  <div class="row">
	    <div class="col-md-6">
	      <div class="form-group">
	        <label>Line Name</label>
	        <input type="text" name="name"value="" class="form-control">
	        <?php echo form_error('name');?>
	      </div>
	      <div class="form-group">
	        <label>Line Name Bangla</label>
	        <input type="text" name="bname"value="" class="form-control">
	        <?php echo form_error('bname');?>
	      </div>
	      <div class="form-group">
	        <label>Strength</label>
	        <input type="text" name="strn"value="" class="form-control">
	        <?php echo form_error('strn');?>
	      </div>

        <div class="form-group">
          <select name="line" id= "line" class="form-control input-lg">
            <option value="">Select Unit</option>
            <?php
            // print_r($line);exit('mafiz');
              foreach ($line as $row)
              {

                 echo '<option value="'.$row[unit_id].'">'.$row[unit_name].
                 '</option>';
              }

             ?>

          </select>
        </div>
        <div class="form-group">
	        <label>Line index</label>
	        <input type="text" name="indx"value="" class="form-control">
	        <?php echo form_error('indx');?>
	      </div>

      <br>

		<div class="form-group">
	        <button class="btn btn-primary">Create</button>
	        <a href=""class="btn-warning btn">Cancel</a>
	      </div>
	    </div>
	  </div>
</form>
</div>

</body>
</html>
