<div class="content">

    <!-- Static navbar -->
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo base_url("/index.php/setup_con/section");?>">Back To List</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="<?php echo base_url("/index.php/payroll_con");?>">Home</a></li>
                </ul>

            </div>
            <!--/.nav-collapse -->
        </div>
        <!--/.container-fluid -->
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
            $failuer = $this->session->flashdata('failure'); 
            ?>


        </div>
    </div>

    <h3>Create Section</h3>
    <hr>
    <form action="<?= base_url('index.php/setup_con/sec_add')?>" enctype="multipart/form-data" method="post" name="creatsection" >
        <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <select name="depertment_id" id="department" onchange="get_unit()" class="form-control input-lg select22">
                  <option value="">Select Department</option>
                  <?php foreach ($department as $key => $value) {
                    ?>
                        <option value="<?php echo $value->dept_id; ?>"><?php echo $value->dept_name; ?></option>
                        <?php } ?>
                      </select>
                      <?= (isset($failuer['depertment_id'])) ? '<div class="alert alert-failuer">' . $failuer['depertment_id'] . '</div>' : ''; ?>
                </div>
                <div class="form-group">
                  
                  <label>Section Name</label>
                  <input type="text" name="sec_name_en" value="" placeholder="Section Name English"
                  class="form-control">
                  <?=(isset($failuer['sec_name_en'])) ? '<div class="alert alert-failuer">' . $failuer['sec_name_en'] . '</div>' : ''; ?>
                </div>
                <div class="form-group">
                  <label>Section Name Bangla</label>
                  <input type="text" name="sec_name_bn" value="" placeholder="Section Name Bangla"
                  class="form-control">
                  <?=(isset($failuer['sec_name_bn'])) ? '<div class="alert alert-failuer">' . $failuer['sec_name_bn'] . '</div>' : ''; ?>
                </div>
               <div class="form-group">
                   <!-- <select name="unit_id" id="unit" class="form-control input-lg" readonly>
                       <option value="">Select Unit</option>
                       <?php foreach ($unit as $key => $value) { ?>
                           <option value="<?php echo $value->unit_id; ?>"><?php echo $value->unit_name; ?></option>
                       <?php } ?>
                   </select> -->
                   <input type="hidden" name="unit_id" id="unit_id">
                   <input type="text" name="unit_name" id="unit_name" class="form-control" readonly>
                   <?=(isset($failuer['unit_id'])) ? '<div class="alert alert-failuer">' . $failuer['unit_id'] . '</div>' : ''; ?>
               </div>
                <br>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary ">Submit</button></button>
                    <a href="" class="btn-warning btn">Cancel</a>
                </div>
            </div>
        </div>
    </form>
</div>
<script>
  function get_unit(){
    var department_id = $('#department').val();
    $.ajax({
      
      url:"<?php echo base_url('index.php/setup_con/get_unit') ?>",
      method:"POST",
      data:{department_id:department_id},
        success: function(data) {
       
          var parsedData = JSON.parse(data)[0];
          // console.log(parsedData.unit_id);
          $('#unit_id').val(parsedData.unit_id);
          $('#unit_name').val(parsedData.unit_name);
        }
    })
  }
</script>