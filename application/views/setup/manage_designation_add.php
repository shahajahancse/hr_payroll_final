<div class="content">
    <nav class="navbar navbar-inverse bg_none">
        <div class="container-fluid nav_head">
            <div class="navbar-header col-md-3" style="padding: 7px;">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div>
                    <a class="btn btn-info" href="<?php echo base_url('setup_con/designation') ?>">
                        < < Back</a>
                            <a class="btn btn-primary" href="<?php echo base_url('payroll_con') ?>">Home</a>
                </div>
            </div>
            <div class="col-md-6">
                <div id="navbar" class="navbar-collapse collapse">
                    <div class="">
                        <form class="navbar-form pull-right" role="search">
                            <div class="input-group">
                            </div>
                        </form>
                    </div>
                </div>
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
    <!-- <h3>Create Designation</h3> -->
    <!-- <hr> -->
    <form action="<?= base_url('setup_con/manage_designation_add')?>" enctype="multipart/form-data"
        method="post">
        <div class="tablebox">
            <?php 
                if (!empty($user_data->unit_name)) {
                    $depts = $this->db->where('unit_id', $user_data->unit_name); 
                }
                $depts = $this->db->get('emp_depertment')->result(); 
            ?>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Unit <span style="color: red;">*</span> </label>
                        <select name="unit_id" id= "unit_id" id="unit_id" class="form-control input-sm" required>
                        <option  >Select Unit</option>
                        <?php 
                            foreach ($units as $row) {
                            if($row->unit_id == $user_data->unit_name){
                                $select_data="selected";
                            }else{
                                $select_data='';
                            }
                            echo '<option '.$select_data.'  value="'.$row->unit_id.'">'.$row->unit_name.
                            '</option>';
                            }
                        ?>
                        </select>
                    </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label>Department <span style="color: red;">*</span> </label>
                    <?php echo form_error('dept_id');?>
                    <select name="dept_id" id= "dept_id" class="form-control input-sm" required>
                        <option  >-- Select Department --</option>
                        <?php foreach ($depts as $key => $row) { ?>
                          <option value="<?= $row->dept_id ?>"><?= $row->dept_name.' >>'.$row->dept_bangla; ?></option>
                        <?php } ?>
                    </select>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label>Section <span style="color: red;">*</span> </label>
                    <?php echo form_error('section_id');?>
                    <select name="section_id" id= "section_id" class="section_id form-control input-sm" required>
                        <option  >-- Select Section --</option>
                    </select>
                  </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Line<span style="color: red;">*</span> </label>
                    <?php echo form_error('line_id');?>
                    <select name="line_id" id= "line_id" class="line_id form-control input-sm" required>
                        <option  >-- Select Section --</option>
                    </select>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label>Designation<span style="color: red;">*</span> </label>
                    <?php echo form_error('designation_id');?>
                    <select name="designation_id" id= "designation_id" class="designation_id form-control input-sm" >  <!--desig  -->
                        <option  >-- Select Section --</option>
                    </select>
                  </div>
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary ">Submit</button></button>
                <a href="<?= base_url('setup_con/manage_designation') ?>" class="btn-warning btn">Cancel</a>
            </div>
        </div>    

    </form>
</div>


<script type="text/javascript">

    //Designation dropdown
    $('#line_id').change(function(){
        $('.designation_id').addClass('form-control input-sm');
        $(".designation_id > option").remove();
        var id = $('#unit_id').val();
        $.ajax({
            type: "POST",
            url: hostname +"common/ajax_designation_by_unit/" + id,
            success: function(func_data)
            {
                $('.designation_id').append("<option value=''>-- Select District --</option>");
                $.each(func_data,function(id,name){
                    var opt = $('<option />');
                    opt.val(id);
                    opt.text(name);
                    $('.designation_id').append(opt);
                });
            }
        });
    });

    //Line dropdown
    $('#section_id').change(function(){
        $('.line_id').addClass('form-control input-sm');
        $(".line_id > option").remove();
        $(".designation_id > option").remove();
        var id = $('#section_id').val();
        $.ajax({
            type: "POST",
            url: hostname +"common/ajax_line_by_sec_id/" + id,
            success: function(func_data)
            {
                $('.line_id').append("<option value=''>-- Select District --</option>");
                $.each(func_data,function(id,name)
                {
                    var opt = $('<option />');
                    opt.val(id);
                    opt.text(name);
                    $('.line_id').append(opt);
                });
            }
        });
    });

    //section dropdown
    $('#dept_id').change(function(){
        $('.section_id').addClass('form-control input-sm');
        $(".section_id > option").remove();
        $(".line_id > option").remove();
        var id      = $('#dept_id').val();
        var unit_id = $('#unit_id').val();
        $.ajax({
            type: "POST",
            url: hostname +"common/ajax_section_by_dept_id/" + id +'/'+ unit_id,
            success: function(func_data)
            {
                $('.section_id').append("<option value=''>-- Select District --</option>");
                $.each(func_data,function(id,name)
                {
                    var opt = $('<option />');
                    opt.val(id);
                    opt.text(name);
                    $('.section_id').append(opt);
                });
            }
        });
    });

</script>


