

<div class="content" style="padding-top: 10px;">
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
  <form enctype="multipart/form-data" method="post" name="creatcompanyline" action="<?php echo base_url().'index.php/setup_con/line_edit/'.$line->id;?>">
  <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <select name="section_id" id="section_id" onchange="get_unit()" class="form-control input-lg">
                  <option value="">Select Section</option>
                  <?php foreach ($emp_section as $key => $value) {
                    ?>
                        <option value="<?php echo $value->id; ?>" <?= ($value->id == $line->section_id) ? 'selected' : ''; ?>><?php echo $value->sec_name_bn; ?></option>
                        <?php } ?>
                      </select>
                      <?= (isset($failuer['section_id'])) ? '<div class="alert alert-failuer">' . $failuer['section_id'] . '</div>' : ''; ?>
                </div>
                <div class="form-group">
                  
                  <label>Line Name Bangla</label>
                  <input type="text" name="line_name_bn" value="<?= $line->line_name_bn ?>" placeholder="Line Name Bangla"
                  class="form-control">
                  <?=(isset($failuer['line_name_bn'])) ? '<div class="alert alert-failuer">' . $failuer['line_name_bn'] . '</div>' : ''; ?>
                </div>
                <div class="form-group">
                  <label>Line Name English</label>
                  <input type="text" name="line_name_en" value="<?= $line->line_name_en ?>" placeholder="Line Name english"
                  class="form-control">
                  <?=(isset($failuer['line_name_en'])) ? '<div class="alert alert-failuer">' . $failuer['line_name_en'] . '</div>' : ''; ?>
                </div>
               <div class="form-group">
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
    var section_id = $('#section_id').val();
    $.ajax({
      
      url:"<?php echo base_url('index.php/setup_con/get_unit_s') ?>",
      method:"POST",
      data:{section_id:section_id},
        success: function(data) {
       
          var parsedData = JSON.parse(data)[0];
          console.log(parsedData.unit_id);
          $('#unit_id').val(parsedData.unit_id);
          $('#unit_name').val(parsedData.unit_name);
        }
    })
  }
  get_unit()
</script>