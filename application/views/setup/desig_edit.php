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
                    <select name="unit_id" onchange="get_data(this.value);" id="unit_id" class=" form-control ">
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
                    <select name="attn_id"  id="attn_id" class="form-control  ">
                        <option value="">Select Attendance Bonus</option>
                        <option value="<?php echo $emp_designation->attn_id; ?>" selected><?= $emp_designation->allowance_attn_bonus ?></option>
                    </select>
                    <?= (isset($failuer['attn_id'])) ? '<div class="alert alert-failuer">' . $failuer['attn_id'] . '</div>' : ''; ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="holiday_weekend_id">Holiday/Weekend <span style="color: red;">*</span></label>
                    <select name="holiday_weekend_id"  id="holiday_weekend_id" class="form-control  ">
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
                    <select name="iftar_id"  id="iftar_id" class="form-control  ">
                        <option value="">Select Iftar Allowance</option>
                        <option value="<?php echo $emp_designation->iftar_id; ?>" selected><?= $emp_designation->allowance_iftar ?></option>
                    </select>
                    <?= (isset($failuer['iftar_id'])) ? '<div class="alert alert-failuer">' . $failuer['iftar_id'] . '</div>' : ''; ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Select  Night Allowance <span style="color: red;">*</span></label>
                    <select name="night_al_id"  id="night_al_id" class="form-control  ">
                        <option value="">Select Night Allowance</option>
                        <option value="<?php echo $emp_designation->night_al_id; ?>" selected><?= $emp_designation->allowance_night_rules ?></option>
                    </select>
                    <?= (isset($failuer['night_al_id'])) ? '<div class="alert alert-failuer">' . $failuer['night_al_id'] . '</div>' : ''; ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Select Tiffin Allowance  <span style="color: red;">*</span></label>
                    <select name="tiffin_id"  id="tiffin_id" class="form-control  ">
                        <option value="">Select Tiffin Allowance</option>
                        <option value="<?php echo $emp_designation->tiffin_id; ?>" selected><?= $emp_designation->allowance_tiffin ?></option>
                    </select>
                    <?= (isset($failuer['tiffin_id'])) ? '<div class="alert alert-failuer">' . $failuer['tiffin_id'] . '</div>' : ''; ?>
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
        <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Job Description</label>
                            <textarea name="desig_desc" id="desig_desc" class="form-control" style="height: 200px;"><?= $emp_designation->desig_desc ?></textarea>
                            <?=(isset($failuer['desig_desc'])) ? '<div class="alert alert-failuer">' . $failuer['desig_desc'] . '</div>' : ''; ?>
                        </div>
                    </div>
                </div>
            
                <script src="https://cdn.ckeditor.com/ckeditor5/35.1.0/classic/ckeditor.js"></script>
                <script>
                    ClassicEditor
                        .create(document.querySelector('#desig_desc'), {
                            toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote' ],
                            heading: {
                                options: [
                                    { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                                    { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                                    { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                                    { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' }
                                ]
                            }
                        })
                        .then(editor => {
                            window.editor = editor;
                        })
                        .catch(error => {
                            console.error(error);
                        });
                </script>
        <br>
        <div class="form-group">
            <button type="submit" class="btn btn-primary ">Submit</button></button>
            <a href="<?= base_url('index.php/setup_con/designation') ?>" class="btn-warning btn">Cancel</a>
        </div>
    </form>
</div>
</div>
<script>
    function get_data(e,if_lg=null) {
        var unit_id =e;
        console.log(unit_id);
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
            if (if_lg !=null) {
                attnIdSelect.empty()
                holidayWeekendIdSelect.empty()
                iftarIdSelect.empty()
                nightAlIdSelect.empty()
                tiffinIdSelect.empty()
            }
               attnIdSelect.empty().append("<option value='0'>Select Attendance Bonus</option>");
               attn_bonus.forEach(function(item) {
                if (item.id == <?= $emp_designation->attn_id?>) {
                    var data ='selected';
                }else{
                    var data =''
                }
                 attnIdSelect.append(`<option ${data} value='${item.id}'>${item.rule_name} >> ${item.rule}</option>`);
               });

             attnIdSelect.append("<option value='0'>None</option>");

               holidayWeekendIdSelect.empty().append("<option value='0'>Select Holiday/Weekend</option>");
               holiday_weekend.forEach(function(item) {
                if (item.id == <?= $emp_designation->holiday_weekend_id?>) {
                    var data ='selected';
                }else{
                    var data =''
                }
                 holidayWeekendIdSelect.append(`<option ${data} value='${item.id}'>${item.rule_name} >> ${item.allowance_amount}</option>`);
               });

             holidayWeekendIdSelect.append("<option value='0'>None</option>");


               iftarIdSelect.empty().append("<option value='0'>Select Iftar</option>");
               iftar.forEach(function(item) {
                if (item.id == <?= $emp_designation->iftar_id?>) {
                    var data ='selected';
                }else{
                    var data =''
                }
                 iftarIdSelect.append(`<option ${data} value='${item.id}'>${item.rule_name} >> ${item.allowance_amount}</option>`);
               });

             iftarIdSelect.append("<option value='0'>None</option>");


               nightAlIdSelect.empty().append("<option value='0'>Select Night Allowance</option>");
               night.forEach(function(item) {
                if (item.id == <?= $emp_designation->night_al_id?>) {
                    var data ='selected';
                }else{
                    var data =''
                }
                 nightAlIdSelect.append(`<option ${data} value='${item.id}'>${item.rule_name} >> ${item.night_allowance}</option>`);
               });

             nightAlIdSelect.append("<option value='0'>None</option>");


               tiffinIdSelect.empty().append("<option value='0'>Select Tiffin</option>");
               tiffin.forEach(function(item) {
                if (item.id == <?= $emp_designation->tiffin_id?>) {
                    var data ='selected';
                }else{
                    var data =''
                }
                 tiffinIdSelect.append(`<option ${data} value='${item.id}'>${item.rule_name} >> ${item.allowance_amount}</option>`);
               });

             tiffinIdSelect.append("<option value='0'>None</option>");
           },
            error: function(data) {
            }
        })
    }
    get_data('<?= $emp_designation->unit_id ?>','e');
</script>
