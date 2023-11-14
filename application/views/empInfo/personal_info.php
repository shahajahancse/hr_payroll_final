
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
                <select name="unit_id" id= "unit_id" id="unit_id" class="form-control input-sm" required>
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
                <input type="text" name="emp_id" id="emp_id" class="form-control input-sm" required>
                <?php echo form_error('emp_id');?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>	Punch Card No. <span style="color: red;">*</span> </label>
                <input type="text" name="proxi_id" id="proxi_id" class="form-control input-sm" required>
                <?php echo form_error('proxi_id');?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Name (English) <span style="color: red;">*</span> </label>
                <input type="text" name="name_en" id="name_en" class="form-control input-sm" required>
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
                <?php echo form_error('per_district');?>
                <select name="per_district" id= "per_district" class="form-control input-sm" required>
                	<option value="">-- Select District --</option>
                	<?php foreach ($districts as $key => $row) { ?>
	                  <option value="<?= $row->id ?>"><?= $row->name_en.' >>'.$row->name_bn; ?></option>
                	<?php } ?>
                </select>
              </div>
            </div>
            <div class="col-md-2" style="padding-left: 0px !important;">
              <div class="form-group">
                <label>Upazila/Thana<span style="color: red;">*</span> </label>
                <?php echo form_error('per_thana');?>
                <select name="per_thana" id= "per_thana" class="per_thana form-control input-sm" required>
                	<option value="">-- Select District --</option>
                </select>
              </div>
            </div>
            <div class="col-md-2" style="padding-left: 0px !important;">
              <div class="form-group">
                <label>Post Office<span style="color: red;">*</span> </label>
                <?php echo form_error('per_post');?>
                <select name="per_post" id= "per_post" class="per_post form-control input-sm" required>
                	<option value="">-- Select District --</option>
                </select>
              </div>
            </div>
          </div>

        	<?php $depts = $this->db->get('emp_depertment')->result(); ?>

          <h3 style="font-weight: 600;">Official Information</h3>
	        <hr>
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>Department <span style="color: red;">*</span> </label>
                <?php echo form_error('emp_dept_id');?>
                <select name="emp_dept_id" id= "emp_dept_id" class="form-control input-sm" required>
                	<option value="">-- Select Department --</option>
                	<?php foreach ($depts as $key => $row) { ?>
	                  <option value="<?= $row->dept_id ?>"><?= $row->dept_name.' >>'.$row->dept_bangla; ?></option>
                	<?php } ?>
                </select>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Section <span style="color: red;">*</span> </label>
                <?php echo form_error('emp_sec_id');?>
                <select name="emp_sec_id" id= "emp_sec_id" class="emp_sec_id form-control input-sm" required>
                	<option value="">-- Select Section --</option>
                </select>
              </div>
            </div>
            <div class="col-md-3" style="padding-left: 0px !important;">
              <div class="form-group">
                <label>Line<span style="color: red;">*</span> </label>
                <?php echo form_error('emp_line_id');?>
                <select name="emp_line_id" id= "emp_line_id" class="emp_line_id form-control input-sm" required>
                	<option value="">-- Select Section --</option>
                </select>
              </div>
            </div>
            <div class="col-md-3" style="padding-left: 0px !important;">
              <div class="form-group">
                <label>Designation<span style="color: red;">*</span> </label>
                <?php echo form_error('emp_desi_id');?>
                <select name="emp_desi_id" id= "emp_desi_id" class="emp_desi_id form-control input-sm" required>
                	<option value="">-- Select Section --</option>
                </select>
              </div>
            </div>
          </div>
	        
          <div class="row">
          	<?php $sl_grade = $this->db->get('sl_grade')->result(); ?>
            <div class="col-md-3">
              <div class="form-group">
                <label>Salary Grade <span style="color: red;">*</span> </label>
                <?php echo form_error('emp_sal_gra_id');?>
                <select name="emp_sal_gra_id" id= "emp_sal_gra_id" class="form-control input-sm" required>
                	<option value="">-- Select Salary Grade --</option>
                	<?php foreach ($sl_grade as $key => $row) { ?>
	                  <option value="<?= $row->id ?>"><?= $row->gr_name; ?></option>
                	<?php } ?>
                </select>
              </div>
            </div>
						<?php $categorys = $this->db->get('emp_category_status')->result(); ?>
            <div class="col-md-3">
              <div class="form-group">
                <label>Emp Status <span style="color: red;">*</span> </label>
                <?php echo form_error('emp_cat_id');?>
                <select name="emp_cat_id" id= "emp_cat_id" class="form-control input-sm" required>
                	<option value="">-- Select Emp Status --</option>
                	<?php foreach ($categorys as $key => $row) { ?>
	                  <option value="<?= $row->id ?>"><?= $row->status_type; ?></option>
                	<?php } ?>
                </select>
              </div>
            </div>
						<?php $shifts = $this->db->where('unit_id',$user_data->unit_name)->get('pr_emp_shift')->result(); ?>
            <div class="col-md-3">
              <div class="form-group">
                <label>Emp Status <span style="color: red;">*</span> </label>
                <?php echo form_error('emp_shift');?>
                <select name="emp_shift" id= "emp_shift" class="form-control input-sm" required>
                	<option value="">-- Select Emp Shift --</option>
                	<?php foreach ($shifts as $key => $row) { ?>
	                  <option value="<?= $row->id ?>"><?= $row->shift_name; ?></option>
                	<?php } ?>
                </select>
              </div>
            </div>
            <div class="col-md-3" style="padding-left: 0px !important;">
              <div class="form-group">
                <label>Emp Joining Date <span style="color: red;">*</span> </label>
                <input type="date" name="emp_join_date" id="emp_join_date" class="form-control input-sm" required>
                <?php echo form_error('emp_join_date');?>
              </div>
            </div>
          </div>
	        
          <div class="row">
            <div class="col-md-2">
              <div class="form-group">
                <label>OT Entitle <span style="color: red;">*</span> </label>
                <?php echo form_error('ot_entitle');?>
                <select name="ot_entitle" id= "ot_entitle" class="form-control input-sm" required>
                	<option value="">-- OT Entitle --</option>
                	<option value="0">Yes</option>
                	<option value="1">No</option>
                </select>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label>Lunch <span style="color: red;">*</span> </label>
                <?php echo form_error('lunch');?>
                <select name="lunch" id= "lunch" class="form-control input-sm" required>
                	<option value="">-- Select lunch --</option>
                	<option value="0">Yes</option>
                	<option value="1">No</option>
                </select>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label>Salary Withdraw <span style="color: red;">*</span> </label>
                <?php echo form_error('salary_draw');?>
                <select name="salary_draw" id= "salary_draw" class="form-control input-sm" required>
                	<option value="">-- Salary Withdraw --</option>
                	<option value="1">cash</option>
                	<option value="2">bank</option>
                </select>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Transport <span style="color: red;">*</span> </label>
                <?php echo form_error('transport');?>
                <select name="transport" id= "transport" class="form-control input-sm" required>
                	<option value="">-- Select Transport --</option>
                	<option value="0">Yes</option>
                	<option value="1">No</option>
                </select>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Salary Type <span style="color: red;">*</span> </label>
                <?php echo form_error('salary_type');?>
                <select name="salary_type" id= "salary_type" class="form-control input-sm" required>
                	<option value="">-- Salary Type --</option>
                	<option value="1">Fixed</option>
                	<option value="2">Production</option>
                </select>
              </div>
            </div>
          </div>



					<!-- gross_sal	
					com_gross_sal	
					att_bonus	 -->


	


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


<!-- , exp_factory_name, exp_duration, exp_dasignation, nominee_name, nominee_vill, nomi_post, nomi_thana, nomi_district, nomi_age, nomi_relation, nomi_mobile, refer_name, refer_address, refer_mobile, refer_relation, img_source -->


  <script type="text/javascript">
    $(document).ready(function () {
      //Line dropdown
      $('#emp_line_id').change(function(){
        $('.emp_desi_id').addClass('form-control input-sm');
        $(".emp_desi_id > option").remove();
        var id = $('#emp_line_id').val();
        $.ajax({
            type: "POST",
            url: hostname +"common/ajax_designation_by_line_id/" + id,
            success: function(func_data)
            {
              $('.emp_desi_id').append("<option value=''>-- Select District --</option>");
              $.each(func_data,function(id,name)
              {
                  var opt = $('<option />');
                  opt.val(id);
                  opt.text(name);
                  $('.emp_desi_id').append(opt);
              });
            }
        });
      });

      //Line dropdown
      $('#emp_sec_id').change(function(){
        $('.emp_line_id').addClass('form-control input-sm');
        $(".emp_line_id > option").remove();
        $(".emp_desi_id > option").remove();
        var id = $('#emp_sec_id').val();
        $.ajax({
            type: "POST",
            url: hostname +"common/ajax_line_by_sec_id/" + id,
            success: function(func_data)
            {
              $('.emp_line_id').append("<option value=''>-- Select District --</option>");
              $.each(func_data,function(id,name)
              {
                  var opt = $('<option />');
                  opt.val(id);
                  opt.text(name);
                  $('.emp_line_id').append(opt);
              });
            }
        });
      });

      //section dropdown
      $('#emp_dept_id').change(function(){
        $('.emp_sec_id').addClass('form-control input-sm');
        $(".emp_sec_id > option").remove();
        $(".emp_line_id > option").remove();
        var id = $('#emp_dept_id').val();
        $.ajax({
            type: "POST",
            url: hostname +"common/ajax_section_by_dept_id/" + id,
            success: function(func_data)
            {
              $('.emp_sec_id').append("<option value=''>-- Select District --</option>");
              $.each(func_data,function(id,name)
              {
                  var opt = $('<option />');
                  opt.val(id);
                  opt.text(name);
                  $('.emp_sec_id').append(opt);
              });
            }
        });
      });

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

      //division dropdown
      $('#per_district').change(function(){
        $('.per_thana').addClass('form-control input-sm');
        $(".per_thana > option").remove();
        $(".per_post > option").remove();
        var id = $('#per_district').val();
        $.ajax({
            type: "POST",
            url: hostname +"common/ajax_upazila_by_dis/" + id,
            success: function(func_data)
            {
              $('.per_thana').append("<option value=''>-- Select District --</option>");
              $.each(func_data,function(id,name)
              {
                  var opt = $('<option />');
                  opt.val(id);
                  opt.text(name);
                  $('.per_thana').append(opt);
              });
            }
        });
      });

      //district dropdown
      $('#per_thana').change(function(){
        $('.per_post').addClass('form-control input-sm');
        $(".per_post > option").remove();
        var id = $('#per_thana').val();
        $.ajax({
            type: "POST",
            url: hostname +"common/ajax_post_office_by_upa_id/" + id,
            success: function(upazilaThanas)
            {
              $('.per_post').append("<option value=''>-- Select Upazila --</option>");
              $.each(upazilaThanas,function(id,ut_name)
              {
                  var opt = $('<option />');
                  opt.val(id);
                  opt.text(ut_name);
                  $('.per_post').append(opt);
              });
            }
        });
      });
  });
</script>