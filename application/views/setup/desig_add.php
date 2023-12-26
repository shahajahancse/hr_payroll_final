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
                    Back</a>
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
    <form action="<?= base_url('setup_con/designation_add')?>" enctype="multipart/form-data"
        method="post">
            <div class="tablebox">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="unit">Unit</label>
                            <select name="unit_id" onchange="get_data();getDepertment(this.value)" id="unit_id" class="form-control input-lg select22">
                                <option value="">Select Unit</option>
                                <?php foreach ($pr_units as $key => $value) {?>
                                <option value="<?php echo $value->unit_id; ?>"><?php echo $value->unit_name; ?></option>
                                <?php } ?>
                            </select>
                            <?= (isset($failuer['unit_id'])) ? '<div class="alert alert-failuer">' . $failuer['unit_id'] . '</div>' : ''; ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="unit">Select Attendance Bonus</label>
                            <select name="attn_id"  id="attn_id" class="form-control input-lg  select22">
                                <option value="">Select Attendance Bonus</option>
                            </select>
                            <?= (isset($failuer['attn_id'])) ? '<div class="alert alert-failuer">' . $failuer['attn_id'] . '</div>' : ''; ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                            <div class="form-group">
                            <label for="unit">Select Holyday/Weekend</label>
                            <select name="holiday_weekend_id"  id="holiday_weekend_id" class="form-control input-lg select22">
                                <option value="">Select Holyday/Weekend</option>
                            </select>
                            <?= (isset($failuer['holiday_weekend_id'])) ? '<div class="alert alert-failuer">' . $failuer['holiday_weekend_id'] . '</div>' : ''; ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="unit">Select Iftar Allowance</label>
                            <select name="iftar_id"  id="iftar_id" class="form-control input-lg select22">
                                <option value="">Select Iftar Allowance</option>
                            </select>
                            <?= (isset($failuer['iftar_id'])) ? '<div class="alert alert-failuer">' . $failuer['iftar_id'] . '</div>' : ''; ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="unit">Select Night Allowance</label>
                            <select name="night_al_id"  id="night_al_id" class="form-control input-lg select22">
                                <option value="">Select Night Allowance</option>
                            </select>
                            <?= (isset($failuer['night_al_id'])) ? '<div class="alert alert-failuer">' . $failuer['night_al_id'] . '</div>' : ''; ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="unit">Select Tiffin Allowance</label>
                            <select name="tiffin_id"  id="tiffin_id" class="">
                                <option value="">Select Tiffin Allowance</option>
                            </select>
                            <?= (isset($failuer['tiffin_id'])) ? '<div class="alert alert-failuer">' . $failuer['tiffin_id'] . '</div>' : ''; ?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Designation Name English</label>
                            <input type="text" name="desig_name" value="" placeholder="Designation Name" class="form-control">
                            <?=(isset($failuer['desig_name'])) ? '<div class="alert alert-failuer">' . $failuer['desig_name'] . '</div>' : ''; ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                            <div class="form-group">
                            <label>Designation Name Bangla</label>
                            <input type="text" name="desig_bangla" value="" placeholder="Designation Name Bangla" class="form-control">
                            <?=(isset($failuer['desig_bangla'])) ? '<div class="alert alert-failuer">' . $failuer['desig_bangla'] . '</div>' : ''; ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary ">Submit</button></button>
                    <a href="<?= base_url('index.php/setup_con/designation') ?>" class="btn-warning btn">Cancel</a>
                </div>
            </div>    
    </form>
</div>
<script>
    function get_data() {
        var unit_id = $('#unit_id').val();
        $.ajax({
            type: "POST",
            url: "<?= base_url('setup_con/get_data_degi') ?>",
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
             
             if (attn_bonus.length > 0) {
               attnIdSelect.empty().append("<option value=''>Select Attendance Bonus</option>");
               attn_bonus.forEach(function(item) {
                 attnIdSelect.append(`<option value='${item.id}'>${item.rul}+">>"+${item.rule_name}</option>`);
               });
             }
             attnIdSelect.append("<option value='0'>None</option>");
             
             if (holiday_weekend.length > 0) {
               holidayWeekendIdSelect.empty().append("<option value=''>Select Holiday/Weekend</option>");
               holiday_weekend.forEach(function(item) {
                 holidayWeekendIdSelect.append(`<option value='${item.id}'>${item.rule_name}</option>`);
               });
             }
             holidayWeekendIdSelect.append("<option value='0'>None</option>");

             
             if (iftar.length > 0) {
               iftarIdSelect.empty().append("<option value=''>Select Iftar</option>");
               iftar.forEach(function(item) {
                 iftarIdSelect.append(`<option value='${item.id}'>${item.rule_name}</option>`);
               });
             }
             iftarIdSelect.append("<option value='0'>None</option>");

             
             if (night.length > 0) {
               nightAlIdSelect.empty().append("<option value=''>Select Night Allowance</option>");
               night.forEach(function(item) {
                 nightAlIdSelect.append(`<option value='${item.id}'>${item.rule_name}</option>`);
               });
             }
             nightAlIdSelect.append("<option value='0'>None</option>");

             
             if (tiffin.length > 0) {
               tiffinIdSelect.empty().append("<option value=''>Select Tiffin</option>");
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
</script>