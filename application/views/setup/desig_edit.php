 <!-- < ?php dd($emp_designation)?> -->
<div class="content">
    <nav class="navbar navbar-inverse bg_none">
        <div class="container-fluid nav_head">
            <div class="navbar-header col-md-3" style="padding: 7px;">
                <div>
                    <a class="btn btn-info" href="<?php echo base_url('index.php/setup_con/designation') ?>">
                        Back</a>
                        <a class="btn btn-primary" href="<?php echo base_url('index.php/payroll_con') ?>">Home</a>
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
    <?php $failuer = $this->session->flashdata('failure');?>
    <div class="tablebox">
    <h3>Update Designation</h3>
    <hr>
    <form action="<?= base_url('setup_con/designation_edit').'/'.$emp_designation->id?>"
        enctype="multipart/form-data" method="post">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="unit_id">Unit Id <span style="color: red;">*</span></label>
                    <select name="unit_id" onchange="get_data();getDepertment(this.value)" id="unit_id" class="select22 form-control input-lg">
                        <option value="">Select Unit</option>
                        <?php foreach ($pr_units as $key => $value) {?>
                        <option value="<?php echo $value->unit_id; ?>" <?php echo $value->unit_id == $emp_designation->unit_id ? 'selected' : ''; ?>><?php echo $value->unit_name; ?></option>
                        <?php } ?>
                    </select>
                    <?= (isset($failuer['unit_id'])) ? '<div class="alert alert-failuer">' . $failuer['unit_id'] . '</div>' : ''; ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="atttn_id">Attendance Bonus <span style="color: red;">*</span></label>
                    <select name="attn_id"  id="attn_id" class="form-control input-lg select22">
                        <option value="">Select Attendance Bonus</option>
                        <option value="<?php echo $emp_designation->attn_id; ?>" selected><?= $emp_designation->allowance_attn_bonus ?></option>
                    </select>
                    <?= (isset($failuer['attn_id'])) ? '<div class="alert alert-failuer">' . $failuer['attn_id'] . '</div>' : ''; ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="holiday_weekend_id">Holiday/Weekend <span style="color: red;">*</span></label>
                    <select name="holiday_weekend_id"  id="holiday_weekend_id" class="form-control input-lg select22">
                        <option value="">Select Holyday/Weekend</option>
                        <option value="<?php echo $emp_designation->holiday_weekend_id; ?>" selected><?= $emp_designation->allowance_holiday_weekend ?></option>
                    </select>
                    <?= (isset($failuer['holiday_weekend_id'])) ? '<div class="alert alert-failuer">' . $failuer['holiday_weekend_id'] . '</div>' : ''; ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>Select  Iftar Allowance <span style="color: red;">*</span></label>
                    <select name="iftar_id"  id="iftar_id" class="form-control input-lg select22">
                        <option value="">Select Iftar Allowance</option>
                        <option value="<?php echo $emp_designation->iftar_id; ?>" selected><?= $emp_designation->allowance_iftar ?></option>
                    </select>
                    <?= (isset($failuer['iftar_id'])) ? '<div class="alert alert-failuer">' . $failuer['iftar_id'] . '</div>' : ''; ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Select  Night Allowance <span style="color: red;">*</span></label>
                    <select name="night_al_id"  id="night_al_id" class="form-control input-lg select22">
                        <option value="">Select Night Allowance</option>
                        <option value="<?php echo $emp_designation->night_al_id; ?>" selected><?= $emp_designation->allowance_night_rules ?></option>
                    </select>
                    <?= (isset($failuer['night_al_id'])) ? '<div class="alert alert-failuer">' . $failuer['night_al_id'] . '</div>' : ''; ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Select Tiffin Allowance  <span style="color: red;">*</span></label>
                    <select name="tiffin_id"  id="tiffin_id" class="form-control input-lg select22">
                        <option value="">Select Tiffin Allowance</option>
                        <option value="<?php echo $emp_designation->tiffin_id; ?>" selected><?= $emp_designation->allowance_tiffin ?></option>
                    </select>
                    <?= (isset($failuer['tiffin_id'])) ? '<div class="alert alert-failuer">' . $failuer['tiffin_id'] . '</div>' : ''; ?>
                </div>
            </div>
        </div>
        <!-- < ?php 

// dd($unit_id);
?> -->
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <?php 
                        $depts = $this->db->where('unit_id',$unit_id)->get('emp_depertment')->result(); 
                        // $sec = $this->db->where('unit_id',$unit_id)->get('emp_section')->result(); 
                        // $line = $this->db->where('unit_id',$unit_id)->get('emp_line_num')->result(); 
                        ?>
                    <label>Select Department <span style="color: red;">*</span> </label>
                    <?php echo form_error('emp_dept_id');?>
                    <select name="emp_dept_id" id= "emp_dept_id" onchange="get_section(this.value)" class="form-control input-lg" required>
	                	<option  >Select Department</option>
	                	<?php foreach ($depts as $key => $row) { ?>
                        <option value="<?php echo $row->dept_id ?>" <?php echo $emp_designation->dept_id == $row->dept_id ? 'selected':''?>  ><?= $row->dept_name ?></option>
	                	<?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
            <div class="form-group">
                <label>Section <span style="color: red;">*</span> </label>
                <?php echo form_error('emp_sec_id');?>
                    <select name="emp_sec_id" id= "emp_sec_id" onchange="get_line(this.value)" class="form-control input-lg " required>
	                	<option  >Select Section</option>
                        <option value="<?php echo $emp_designation->sec_id; ?>" selected><?= $emp_designation->sec_name ?></option>
                    </select>
            </div>
            </div>
            <div class="col-md-4" style="padding-left: 0px !important;">
            <div class="form-group">
                <label>Line<span style="color: red;">*</span> </label>
                <?php echo form_error('emp_line_id');?>
                 <!-- <label>Select Line</label> -->
                    <select name="emp_line_id" id= "emp_line_id" class="form-control input-lg" required>
	                	<option  >Select Line</option>
                        <option value="<?php echo $emp_designation->line_id; ?>" selected><?= $emp_designation->line_name ?></option>
                    </select>
            </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Designation Name English</label>
                    <input type="text" name="desig_name" value="<?= $emp_designation->desig_name ?>" placeholder="Designation Name" class="form-control">
                    <?=(isset($failuer['desig_name'])) ? '<div class="alert alert-failuer">' . $failuer['desig_name'] . '</div>' : ''; ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Designation Name Bangla</label>
                    <input type="text" name="desig_bangla" value="<?= $emp_designation->desig_bangla ?>" placeholder="Designation Name Bangla" class="form-control">
                    <?=(isset($failuer['desig_bangla'])) ? '<div class="alert alert-failuer">' . $failuer['desig_bangla'] . '</div>' : ''; ?>
                </div>
            </div>
        </div>  
        <br>
        <div class="form-group">
            <button type="submit" class="btn btn-primary ">Submit</button></button>
            <a href="<?= base_url('index.php/setup_con/designation') ?>" class="btn-warning btn">Cancel</a>
        </div>
    </form>
</div>
</div>
<script>
    function get_data(e = null) {
        console.log('get_data');
        var unit_id = $('#unit_id').val();
        $.ajax({
            type: "POST",
            url: "<?= base_url('index.php/setup_con/get_data_degi') ?>",
            data: {
                unit_id: unit_id
            },
           success: function(d) {
             var data = JSON.parse(d);
             var attn_bonus = data.attn_bonus;
             var holiday_weekend = data.holiday_weekend;
             var iftar = data.iftar;
             var night = data.night;
             var tiffin = data.tiffin;
             
             var attnIdSelect = $("#attn_id");
             var holidayWeekendIdSelect = $("#holiday_weekend_id");
             var iftarIdSelect = $("#iftar_id");
             var nightAlIdSelect = $("#night_al_id");
             var tiffinIdSelect = $("#tiffin_id");
             if (e===null) {
                console.log('ko');
              attnIdSelect.empty().append("<option value=''>Select Attendance Bonus</option>");
              holidayWeekendIdSelect.empty().append("<option value=''>Select Holiday/Weekend</option>")
              iftarIdSelect.empty().append("<option value=''>Select Iftar Allowance</option>")
              nightAlIdSelect.empty().append("<option value=''>Select Night Allowance</option>")
              tiffinIdSelect.empty().append("<option value=''>Select Tiffin Allowance</option>")
             }
             
             if (attn_bonus.length > 0) {
               attn_bonus.forEach(function(item) {
                 attnIdSelect.append(`<option value='${item.id}'>${item.rule_name}</option>`);
               });
             }
             attnIdSelect.append("<option value='0'>None</option>");
             
             if (holiday_weekend.length > 0) {
               holiday_weekend.forEach(function(item) {
                 holidayWeekendIdSelect.append(`<option value='${item.id}'>${item.rule_name}</option>`);
               });
             }
             holidayWeekendIdSelect.append("<option value='0'>None</option>");

             
             if (iftar.length > 0) {
               iftar.forEach(function(item) {
                 iftarIdSelect.append(`<option value='${item.id}'>${item.rule_name}</option>`);
               });
             }
             iftarIdSelect.append("<option value='0'>None</option>");

             
             if (night.length > 0) {
               night.forEach(function(item) {
                 nightAlIdSelect.append(`<option value='${item.id}'>${item.rule_name}</option>`);
               });
             }
             nightAlIdSelect.append("<option value='0'>None</option>");

             
             if (tiffin.length > 0) {
               tiffin.forEach(function(item) {
                 tiffinIdSelect.append(`<option value='${item.id}'>${item.rule_name}</option>`);
               });
             }
             tiffinIdSelect.append("<option value='0'>None</option>");
           },
            error: function(data) {
              
            }
        })
    }
    get_data(1);
</script>

<script>
function getDepertment(unit_id,how=null) {
            console.log('getDepertment');

    $.ajax({
        url: "<?php echo base_url('index.php/setup_con/get_department') ?>",
        method: "POST",
        data: {
          unit_id: unit_id
        },
        success: function(data) {
            var parsedData = JSON.parse(data);
            var item = '<option value="">Select Depertment</option>';
            for (let index = 0; index < parsedData.length; index++) {
             item+=`<option value="${parsedData[index].dept_id}">${parsedData[index].dept_name}</option>`
            }
            $('#emp_dept_id').html(item);
            $('#emp_dept_id').val(<?= $emp_designation->dept_id ?>);
        }
    })
    if(how){
        get_section(<?= $emp_designation->dept_id ?>, 'dept') 
    }
}
function get_section(depertment_id,how=null) {
                console.log('get_section');

    $.ajax({

        url: "<?php echo base_url('index.php/setup_con/get_section') ?>",
        method: "POST",
        data: {
            depertment_id: depertment_id
        },
        success: function(data) {
            var parsedData = JSON.parse(data);
            var item = '<option value="">Select Section</option>';
            for (let index = 0; index < parsedData.length; index++) {
                item +=
                    `<option value="${parsedData[index].id}">${parsedData[index].sec_name_en}</option>`
            }
            $('#emp_sec_id').html(item);
            $('#emp_sec_id').val(<?= $emp_designation->sec_id ?>);
        }
    })
        if(how){
                get_line(<?= $emp_designation->sec_id ?>, how)
        }
}
function get_line(id) {
                console.log('get_line');

    $.ajax({
        url: "<?php echo base_url('index.php/setup_con/get_line') ?>",
        method: "POST",
        data: {
            id: id
        },
        success: function(data) {
            var parsedData = JSON.parse(data);
            var item = '<option value="">Select Line</option>';
            for (let index = 0; index < parsedData.length; index++) {
                item +=
                    `<option value="${parsedData[index].id}">${parsedData[index].line_name_en}</option>`
            }
            $('#emp_line_id').html(item);
            $('#emp_line_id').val(<?= $emp_designation->line_id ?>);
        }
    })
}

getDepertment(<?= $emp_designation->unit_id ?>,'hello')
</script>






