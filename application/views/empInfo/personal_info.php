
  <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
  <div class="content">
    <div class="row">
      <div class="col-md-8">
        <?php $success = $this->session->flashdata('success');
        if ($success != "") { ?>
         <div class="alert alert-success"><?php echo $success; ?></div>
         <?php } 
         $failuer = $this->session->flashdata('failuer');
         if ($failuer) { ?>
         <div class="alert alert-failuer"><?php echo $failuer; ?></div>
         <?php } ?>
      </div>
    </div>

    <div id="target-div">
      <div class="container-fluid">
        <form enctype="multipart/form-data" method="post" name="creatdepartment" action="<?php echo base_url('setup_con/dept_add')?>">

	        <h3 style="font-weight: bold;"><?= $title ?></h3>
	        <hr>
        	<div class="row">
	            <div class="col-md-3">
	              <div class="form-group">
	              	<label>Unit <span style="color: red;">*</span> </label>
	                <select name="unit_id" id= "unit_id" class="form-control input-sm" required>
	                  <option value="">Select Unit</option>
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
	          	<div class="col-md-3">
	              <div class="form-group">
	                <label>Emp Id <span style="color: red;">*</span> </label>
	                <input type="text" name="emp_id"value="" class="form-control input-sm" required>
	                <?php echo form_error('emp_id');?>
	              </div>
	            </div>
	            <div class="col-md-3">
	              <div class="form-group">
	                <label>	Punch Card No. <span style="color: red;">*</span> </label>
	                <input type="text" name="proxi_id"value="" class="form-control input-sm" required>
	                <?php echo form_error('proxi_id');?>
	              </div>
	            </div>
	            <div class="col-md-3">
	              <div class="form-group">
	                <label>Name (English) <span style="color: red;">*</span> </label>
	                <input type="text" name="name_en"value="" class="form-control input-sm" required>
	                <?php echo form_error('name_en');?>
	              </div>
	            </div>
	        </div>

	        <div class="row">
	            <div class="col-md-3">
	              <div class="form-group">
	                <label>Name (Bangla) <span style="color: red;">*</span> </label>
	                <input type="text" name="name_bn"value="" class="form-control input-sm" required>
	                <?php echo form_error('name_bn');?>
	              </div>
	            </div>
	            <div class="col-md-3">
	              <div class="form-group">
	                <label>Father's Name <span style="color: red;">*</span> </label>
	                <input type="text" name="father_name"value="" class="form-control input-sm" required>
	                <?php echo form_error('father_name');?>
	              </div>
	            </div>
	            <div class="col-md-3">
	              <div class="form-group">
	                <label>Mother's Name <span style="color: red;">*</span> </label>
	                <input type="text" name="mother_name"value="" class="form-control input-sm" required>
	                <?php echo form_error('mother_name');?>
	              </div>
	            </div>
	            <div class="col-md-3">
	              <div class="form-group">
	                <label>Spouse Name</label>
	                <input type="text" name="spouse_name"value="" class="form-control input-sm" >
	                <?php echo form_error('spouse_name');?>
	              </div>
	            </div>
            </div>

            <div class="row">
	            <div class="col-md-3">
	              <div class="form-group">
	                <label>Date Of Birth <span style="color: red;">*</span> </label>
	                <input type="date" name="emp_dob" id="emp_dob" class="form-control input-sm" required>
	                <?php echo form_error('emp_dob');?>
	              </div>
	            </div>
	            <div class="col-md-3">
	              <div class="form-group">
	              	<label>Gender <span style="color: red;">*</span> </label>
	              	<?php echo form_error('gender');?>
	                <select name="gender" id= "gender" class="form-control input-sm" required>
	                  <option value="Male">Male</option>
	                  <option value="Female">Female</option>
	                  <option value="Common">Common</option>
	                </select>
	              </div>
	            </div>
	            <div class="col-md-3">
	              <div class="form-group">
	                <label>Marital Status <span style="color: red;">*</span> </label>
	                <?php echo form_error('marital_status');?>
	                <select name="marital_status" id= "marital_status" class="form-control input-sm" required>
	                  <option value="Unmarried">Unmarried</option>
	                  <option value="Married">Married</option>
	                </select>
	              </div>
	            </div>
	            <div class="col-md-3">
	              <div class="form-group">
	                <label>Religion<span style="color: red;">*</span> </label>
	                <?php echo form_error('religion');?>
	                <select name="religion" id= "religion" class="form-control input-sm" required>
	                  <option value="Islam">Islam</option>
	                  <option value="Hindu">Hindu</option>
	                  <option value="Christian">Christian</option>
	                  <option value="Buddhish">Buddhish</option>
	                </select>
	              </div>
	            </div>
            </div>

            <div class="row">
	            <div class="col-md-3">
	              <div class="form-group">
	                <label>Blood Group<span style="color: red;">*</span> </label>
	                <?php echo form_error('blood');?>
	                <select name="blood" id= "blood" class="form-control input-sm" required>
	                  <option value="None">None</option>
	                  <option value="A+">A+</option>
	                  <option value="A-">A-</option>
	                  <option value="B+">B+</option>
	                  <option value="B-">B-</option>
	                  <option value="AB+">AB+</option>
	                  <option value="AB-">AB-</option>
	                  <option value="O+">O+</option>
	                  <option value="O-">O-</option>
	                </select>
	              </div>
	            </div>

	            <div class="col-md-3">
	              <div class="form-group">
	                <label>Male Child <span style="color: red;">*</span> </label>
	                <input type="number" name="m_child" class="form-control input-sm" required>
	                <?php echo form_error('m_child');?>
	              </div>
	            </div>

	            <div class="col-md-3">
	              <div class="form-group">
	                <label>Female Child <span style="color: red;">*</span> </label>
	                <input type="number" name="f_child" class="form-control input-sm" required>
	                <?php echo form_error('f_child');?>
	              </div>
	            </div>
	            <div class="col-md-3">
	              <div class="form-group">
	                <label>Education<span style="color: red;">*</span> </label>
	                <input type="text" name="education" class="form-control input-sm" required>
	                <?php echo form_error('education');?>
	              </div>
	            </div>
            </div>

            <div class="row">
	            <div class="col-md-3">
	              <div class="form-group">
	                <label>Identification Id<span style="color: red;">*</span> </label>
	                <?php echo form_error('nid_dob_id');?>
	                <input type="text" name="nid_dob_id" class="form-control input-sm" required>
	              </div>
	            </div>
	            <div class="col-md-3">
	              <div class="form-group">
	                <label>Identification Type<span style="color: red;">*</span> </label>
	                <?php echo form_error('nid_dob_check');?>
	                <input class="form-check-input" type="radio" value="1" name="nid_dob_check"> NID
	                <input class="form-check-input" type="radio" value="2" name="nid_dob_check"> DOB
	              </div>
	            </div>

	            <div class="col-md-3">
	              <div class="form-group">
	                <label>Personal Mobile <span style="color: red;">*</span> </label>
	                <input type="number" name="personal_mobile" class="form-control input-sm" required>
	                <?php echo form_error('personal_mobile');?>
	              </div>
	            </div>
	            <div class="col-md-3">
	              <div class="form-group">
	                <label>Banck account.<span style="color: red;">*</span> </label>
	                <input type="number" name="bank_bkash_no" class="form-control input-sm" required>
	                <?php echo form_error('bank_bkash_no');?>
	              </div>
	            </div>
            </div>

            <h3 style="font-weight: 600;">Present Address</h3>
	        <hr>
            <div class="row">
	            <div class="col-md-3">
	              <div class="form-group">
	                <label>Home Owner Name <span style="color: red;">*</span> </label>
	                <input type="text" name="pre_home_owner" class="form-control input-sm" required>
	                <?php echo form_error('pre_home_owner');?>
	              </div>
	            </div>
	            <div class="col-md-3">
	              <div class="form-group">
	                <label>Holding Nume<span style="color: red;">*</span> </label>
	                <input type="text" name="holding_num" class="form-control input-sm" required>
	                <?php echo form_error('holding_num');?>
	              </div>
	            </div>
	            <div class="col-md-3">
	              <div class="form-group">
	                <label>Home Owner Mobile<span style="color: red;">*</span> </label>
	                <input type="number" name="home_own_mobile" class="form-control input-sm" required>
	                <?php echo form_error('home_own_mobile');?>
	              </div>
	            </div>
	            <div class="col-md-3">
	              <div class="form-group">
	                <label>Village Name (English)<span style="color: red;">*</span> </label>
	                <input type="text" name="pre_village" class="form-control input-sm" required>
	                <?php echo form_error('pre_village');?>
	              </div>
	            </div>
            </div>

            <?php $districts = $this->db->get('emp_districts')->result(); ?>

            <div class="row">
	            <div class="col-md-3">
	              <div class="form-group">
	                <label>Village Name (Bangla) <span style="color: red;">*</span> </label>
	                <input type="text" name="pre_village_bn" class="form-control input-sm" required>
	                <?php echo form_error('pre_village_bn');?>
	              </div>
	            </div>
	            <div class="col-md-3">
	              <div class="form-group">
	                <label>District<span style="color: red;">*</span> </label>
	                <?php echo form_error('pre_district');?>	                
	                <select name="pre_district" id= "pre_district" class="form-control input-sm" required>
	                	<option value="">-- Select District --</option>
	                	<?php foreach ($districts as $key => $row) { ?>
		                  <option value="<?= $row->id ?>"><?= $row->name_en.' >>'.$row->name_bn; ?></option>
	                	<?php } ?>
	                </select>
	              </div>
	            </div>
	            <div class="col-md-3">
	              <div class="form-group">
	                <label>Upazila/Thana<span style="color: red;">*</span> </label>
	                <?php echo form_error('pre_thana');?>
	                <select name="pre_thana" id= "pre_thana" class="pre_thana form-control input-sm" required>
	                	<option value="">-- Select District --</option>
	                </select>
	              </div>
	            </div>

	            <div class="col-md-3">
	              <div class="form-group">
	                <label>Post Office<span style="color: red;">*</span> </label>
	                <?php echo form_error('pre_post');?>
	                <select name="pre_post" id= "pre_post" class="pre_post form-control input-sm" required>
	                	<option value="">-- Select District --</option>
	                </select>
	              </div>
	            </div>
            </div>
	
            <h3 style="font-weight: 600;">Permanent Address</h3>
	        <hr>
            <div class="row">
	            <div class="col-md-3">
	              <div class="form-group">
	                <label>Village Name (English) <span style="color: red;">*</span> </label>
	                <input type="text" name="per_village" class="form-control input-sm" required>
	                <?php echo form_error('per_village');?>
	              </div>
	            </div>
	            <div class="col-md-3">
	              <div class="form-group">
	                <label>Village Name (Bangla) <span style="color: red;">*</span> </label>
	                <input type="text" name="per_district" class="form-control input-sm" required>
	                <?php echo form_error('per_village_bn');?>
	              </div>
	            </div>
	            <div class="col-md-2">
	              <div class="form-group">
	                <label>District<span style="color: red;">*</span> </label>
	                <input type="text" name="per_district" class="form-control input-sm" required>
	                <?php echo form_error('per_district');?>
	              </div>
	            </div>
	            <div class="col-md-2" style="padding-left: 0px !important;">
	              <div class="form-group">
	                <label>Upazila/Thana<span style="color: red;">*</span> </label>
	                <input type="text" name="per_thana" class="form-control input-sm" required>
	                <?php echo form_error('per_thana');?>
	              </div>
	            </div>
	            <div class="col-md-2" style="padding-left: 0px !important;">
	              <div class="form-group">
	                <label>Post Office<span style="color: red;">*</span> </label>
	                <input type="text" name="per_post" class="form-control input-sm" required>
	                <?php echo form_error('per_post');?>
	              </div>
	            </div>
            </div>
	
            <h3 style="font-weight: 600;">Official Information</h3>
	        <hr>
            <div class="row">
	            <div class="col-md-3">
	              <div class="form-group">
	                <label>Village Name (English) <span style="color: red;">*</span> </label>
	                <input type="text" name="per_village" class="form-control input-sm" required>
	                <?php echo form_error('per_village');?>
	              </div>
	            </div>
	            <div class="col-md-3">
	              <div class="form-group">
	                <label>Village Name (Bangla) <span style="color: red;">*</span> </label>
	                <input type="text" name="per_district" class="form-control input-sm" required>
	                <?php echo form_error('per_village_bn');?>
	              </div>
	            </div>
	            <div class="col-md-2">
	              <div class="form-group">
	                <label>District<span style="color: red;">*</span> </label>
	                <input type="text" name="per_district" class="form-control input-sm" required>
	                <?php echo form_error('per_district');?>
	              </div>
	            </div>
	            <div class="col-md-2" style="padding-left: 0px !important;">
	              <div class="form-group">
	                <label>Upazila/Thana<span style="color: red;">*</span> </label>
	                <input type="text" name="per_thana" class="form-control input-sm" required>
	                <?php echo form_error('per_thana');?>
	              </div>
	            </div>
	            <div class="col-md-2" style="padding-left: 0px !important;">
	              <div class="form-group">
	                <label>Post Office<span style="color: red;">*</span> </label>
	                <input type="text" name="per_post" class="form-control input-sm" required>
	                <?php echo form_error('per_post');?>
	              </div>
	            </div>
            </div>
	
            <h3 style="font-weight: 600;">Nominee Information</h3>
	        <hr>
            <div class="row">
	            <div class="col-md-3">
	              <div class="form-group">
	                <label>Village Name (English) <span style="color: red;">*</span> </label>
	                <input type="text" name="per_village" class="form-control input-sm" required>
	                <?php echo form_error('per_village');?>
	              </div>
	            </div>
	            <div class="col-md-3">
	              <div class="form-group">
	                <label>Village Name (Bangla) <span style="color: red;">*</span> </label>
	                <input type="text" name="per_district" class="form-control input-sm" required>
	                <?php echo form_error('per_village_bn');?>
	              </div>
	            </div>
	            <div class="col-md-2">
	              <div class="form-group">
	                <label>District<span style="color: red;">*</span> </label>
	                <input type="text" name="per_district" class="form-control input-sm" required>
	                <?php echo form_error('per_district');?>
	              </div>
	            </div>
	            <div class="col-md-2" style="padding-left: 0px !important;">
	              <div class="form-group">
	                <label>Upazila/Thana<span style="color: red;">*</span> </label>
	                <input type="text" name="per_thana" class="form-control input-sm" required>
	                <?php echo form_error('per_thana');?>
	              </div>
	            </div>
	            <div class="col-md-2" style="padding-left: 0px !important;">
	              <div class="form-group">
	                <label>Post Office<span style="color: red;">*</span> </label>
	                <input type="text" name="per_post" class="form-control input-sm" required>
	                <?php echo form_error('per_post');?>
	              </div>
	            </div>
            </div>
	
            <h3 style="font-weight: 600;">Reference/Guardian</h3>
	        <hr>
            <div class="row">
	            <div class="col-md-3">
	              <div class="form-group">
	                <label>Village Name (English) <span style="color: red;">*</span> </label>
	                <input type="text" name="per_village" class="form-control input-sm" required>
	                <?php echo form_error('per_village');?>
	              </div>
	            </div>
	            <div class="col-md-3">
	              <div class="form-group">
	                <label>Village Name (Bangla) <span style="color: red;">*</span> </label>
	                <input type="text" name="per_district" class="form-control input-sm" required>
	                <?php echo form_error('per_village_bn');?>
	              </div>
	            </div>
	            <div class="col-md-2">
	              <div class="form-group">
	                <label>District<span style="color: red;">*</span> </label>
	                <input type="text" name="per_district" class="form-control input-sm" required>
	                <?php echo form_error('per_district');?>
	              </div>
	            </div>
	            <div class="col-md-2" style="padding-left: 0px !important;">
	              <div class="form-group">
	                <label>Upazila/Thana<span style="color: red;">*</span> </label>
	                <input type="text" name="per_thana" class="form-control input-sm" required>
	                <?php echo form_error('per_thana');?>
	              </div>
	            </div>
	            <div class="col-md-2" style="padding-left: 0px !important;">
	              <div class="form-group">
	                <label>Post Office<span style="color: red;">*</span> </label>
	                <input type="text" name="per_post" class="form-control input-sm" required>
	                <?php echo form_error('per_post');?>
	              </div>
	            </div>
            </div>	

            <h3 style="font-weight: 600;">Experience</h3>
	        <hr>
            <div class="row">
	            <div class="col-md-3">
	              <div class="form-group">
	                <label>Village Name (English) <span style="color: red;">*</span> </label>
	                <input type="text" name="per_village" class="form-control input-sm" required>
	                <?php echo form_error('per_village');?>
	              </div>
	            </div>
	            <div class="col-md-3">
	              <div class="form-group">
	                <label>Village Name (Bangla) <span style="color: red;">*</span> </label>
	                <input type="text" name="per_district" class="form-control input-sm" required>
	                <?php echo form_error('per_village_bn');?>
	              </div>
	            </div>
	            <div class="col-md-2">
	              <div class="form-group">
	                <label>District<span style="color: red;">*</span> </label>
	                <input type="text" name="per_district" class="form-control input-sm" required>
	                <?php echo form_error('per_district');?>
	              </div>
	            </div>
	            <div class="col-md-2" style="padding-left: 0px !important;">
	              <div class="form-group">
	                <label>Upazila/Thana<span style="color: red;">*</span> </label>
	                <input type="text" name="per_thana" class="form-control input-sm" required>
	                <?php echo form_error('per_thana');?>
	              </div>
	            </div>
	            <div class="col-md-2" style="padding-left: 0px !important;">
	              <div class="form-group">
	                <label>Post Office<span style="color: red;">*</span> </label>
	                <input type="text" name="per_post" class="form-control input-sm" required>
	                <?php echo form_error('per_post');?>
	              </div>
	            </div>
            </div>

            <div class="row">
              	<!-- <br> -->
              	<div class="col-md-12">
	              <div class="form-group">
	                <button class="btn btn-primary">Create</button>
	                <a href=""class="btn-warning btn">Cancel</a>
	              </div>
	            </div>
            </div>
        </form>

      </div>
    </div>
  </div>


exp_factory_name	
exp_duration	
exp_dasignation	


nominee_name	
nominee_vill	
nomi_post	
nomi_thana	
nomi_district	
nomi_age	
nomi_relation	
nomi_mobile	

refer_name	
refer_address	
refer_mobile	
refer_relation	


img_source


  <script type="text/javascript">
    $(document).ready(function () {
      //division dropdown
      $('#pre_district').change(function(){
        $('.pre_thana').addClass('form-control input-sm');
        $(".pre_thana > option").remove();
        $(".pre_post > option").remove();
        var id = $('#pre_district').val();
        $.ajax({
            type: "POST",
            url: hostname +"common/ajax_upazila_by_dis/" + id,
            success: function(func_data)
            {
              $('.pre_thana').append("<option value=''>-- Select District --</option>");
              $.each(func_data,function(id,name)
              {
                  var opt = $('<option />');
                  opt.val(id);
                  opt.text(name);
                  $('.pre_thana').append(opt);
              });
            }
        });
      });


      //district dropdown
      $('#pre_thana').change(function(){
        $('.pre_post').addClass('form-control input-sm');
        $(".pre_post > option").remove();
        var id = $('#pre_thana').val();
        $.ajax({
            type: "POST",
            url: hostname +"common/ajax_post_office_by_upa_id/" + id,
            success: function(upazilaThanas)
            {
              $('.pre_post').append("<option value=''>-- Select Upazila --</option>");
              $.each(upazilaThanas,function(id,ut_name)
              {
                  var opt = $('<option />');
                  opt.val(id);
                  opt.text(ut_name);
                  $('.pre_post').append(opt);
              });
            }
        });
      });

  });
</script>