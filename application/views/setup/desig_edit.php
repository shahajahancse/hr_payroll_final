<div class="content" style="padding-top: 10px;">
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
                <a class="navbar-brand" href="#">Update Night Allowance</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="<?php echo base_url('index.php/payroll_con') ?>">Home</a></li>
                </ul>

            </div>
            <!--/.nav-collapse -->
        </div>
        <!--/.container-fluid -->
    </nav>
    <?php

            $failuer = $this->session->flashdata('failure');
            ?>

    <h3>Update Night Allowance</h3>
    <hr>
    
    <form action="<?= base_url('index.php/setup_con/designation_edit').'/'.$emp_designation->id?> "
        enctype="multipart/form-data" method="post">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Designation Name English</label>
                    <input type="text" name="desig_name" value="<?= $emp_designation->desig_name ?>" placeholder="Designation Name" class="form-control">
                    <?=(isset($failuer['desig_name'])) ? '<div class="alert alert-failuer">' . $failuer['desig_name'] . '</div>' : ''; ?>
                </div>
                <div class="form-group">
                    <label>Designation Name Bangla</label>
                    <input type="text" name="desig_bangla" value="<?= $emp_designation->desig_bangla ?>" placeholder="Designation Name Bangla" class="form-control">
                    <?=(isset($failuer['desig_bangla'])) ? '<div class="alert alert-failuer">' . $failuer['desig_bangla'] . '</div>' : ''; ?>
                </div>
                <!-- unit -->
                <div class="form-group">
                    <select name="unit_id" onchange="get_data()" id="unit_id" class="form-control input-lg">
                        <option value="">Select Unit</option>
                        <?php foreach ($pr_units as $key => $value) {?>
                        <option value="<?php echo $value->unit_id; ?>" <?php echo $value->unit_id == $emp_designation->unit_id ? 'selected' : ''; ?>><?php echo $value->unit_name; ?></option>
                        <?php } ?>
                    </select>
                    <?= (isset($failuer['unit_id'])) ? '<div class="alert alert-failuer">' . $failuer['unit_id'] . '</div>' : ''; ?>
                </div>
                <!-- attn_id	holiday_weekend_id	iftar_id	night_al_id	tiffin_id	 -->

                <!-- attendance bonus -->
                <div class="form-group">
                    <select name="attn_id"  id="attn_id" class="form-control input-lg">
                        <option value="">Select Attendance Bonus</option>
                        <option value="<?php echo $emp_designation->attn_id; ?>" selected><?= $emp_designation->allowance_attn_bonus ?></option>
                    </select>
                    <?= (isset($failuer['attn_id'])) ? '<div class="alert alert-failuer">' . $failuer['attn_id'] . '</div>' : ''; ?>
                </div>
                <!-- Holyday/week off -->
                <div class="form-group">
                    <select name="holiday_weekend_id"  id="holiday_weekend_id" class="form-control input-lg">
                        <option value="">Select Holyday/Weekend</option>
                        <option value="<?php echo $emp_designation->holiday_weekend_id; ?>" selected><?= $emp_designation->allowance_holiday_weekend ?></option>
                    </select>
                    <?= (isset($failuer['holiday_weekend_id'])) ? '<div class="alert alert-failuer">' . $failuer['holiday_weekend_id'] . '</div>' : ''; ?>
                </div>
                <!-- iftar-->
                <div class="form-group">
                    <select name="iftar_id"  id="iftar_id" class="form-control input-lg">
                        <option value="">Select Iftar Allowance</option>
                        <option value="<?php echo $emp_designation->iftar_id; ?>" selected><?= $emp_designation->allowance_iftar ?></option>
                    </select>
                    <?= (isset($failuer['iftar_id'])) ? '<div class="alert alert-failuer">' . $failuer['iftar_id'] . '</div>' : ''; ?>
                </div>
                <!-- night allowance -->
                <div class="form-group">
                    <select name="night_al_id"  id="night_al_id" class="form-control input-lg">
                        <option value="">Select Night Allowance</option>
                        <option value="<?php echo $emp_designation->night_al_id; ?>" selected><?= $emp_designation->allowance_night_rules ?></option>
                    </select>
                    <?= (isset($failuer['night_al_id'])) ? '<div class="alert alert-failuer">' . $failuer['night_al_id'] . '</div>' : ''; ?>
                </div>
                <!-- tiffin -->
                <div class="form-group">
                    <select name="tiffin_id"  id="tiffin_id" class="form-control input-lg">
                        <option value="">Select Tiffin Allowance</option>
                        <option value="<?php echo $emp_designation->tiffin_id; ?>" selected><?= $emp_designation->allowance_tiffin ?></option>
                    </select>
                    <?= (isset($failuer['tiffin_id'])) ? '<div class="alert alert-failuer">' . $failuer['tiffin_id'] . '</div>' : ''; ?>
                </div>
               
                <br>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary ">Submit</button></button>
                    <a href="<?= base_url('index.php/setup_con/designation') ?>"
                        class="btn-warning btn">Cancel</a>
                </div>
            </div>
        </div>
    </form>
</div>
<script>
    function get_data(e = null) {
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