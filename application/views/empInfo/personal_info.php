
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
        <form enctype="multipart/form-data" method="post" name="creatdepartment" action="<?php echo base_url('emp_info_con/personal_info_add')?>">

	        <h3 style="font-weight: bold;"><?= $title ?></h3>
	        <hr style="margin-bottom: 0px !important;">
	        <div style="background-color: white; padding: 15px !important;">
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
	                <input type="text" name="proxi_id" id="proxi_id" readonly class="form-control input-sm" required>
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
	                <label>Male Child </label>
	                <input type="number" name="m_child" class="form-control input-sm">
	                <?php echo form_error('m_child');?>
	              </div>
	            </div>

	            <div class="col-md-3">
	              <div class="form-group">
	                <label>Female Child </label>
	                <input type="number" name="f_child" class="form-control input-sm">
	                <?php echo form_error('f_child');?>
	              </div>
	            </div>
	            <div class="col-md-3">
	              <div class="form-group">
	                <label>Education </label>
	                <input type="text" name="education" class="form-control input-sm">
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
	        </div>

          <h3 style="font-weight: 600;">Present Address</h3>
	        <hr style="margin-bottom: 0px !important;">
	        <div style="background-color: white; padding: 15px !important;">
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
	        </div>

          <h3 style="font-weight: 600;">Permanent Address</h3>
	        <hr style="margin-bottom: 0px !important;">
	        <div style="background-color: white; padding: 15px !important;">
	          <div class="row">
	            <div class="col-md-3">
	              <div class="form-group">
	                <label>Village Name (English) <span style="color: red;">*</span> </label>
	                <input type="text" name="per_village" id="per_village" class="form-control input-sm" required>
	                <?php echo form_error('per_village');?>
	              </div>
	            </div>
	            <div class="col-md-3">
	              <div class="form-group">
	                <label>Village Name (Bangla) <span style="color: red;">*</span> </label>
	                <input type="text" name="per_village_bn" id="per_village_bn" class="form-control input-sm" required>
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
	        </div>

	        <h3 style="font-weight: 600;">Official Information</h3>
	        <hr style="margin-bottom: 0px !important;">
	        <div style="background-color: white; padding: 15px !important;">
	        	<?php $depts = $this->db->get('emp_depertment')->result(); ?>
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
	                <label>Emp Shift <span style="color: red;">*</span> </label>
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
	          </div>
		        
	          <div class="row">
	          	<div class="col-md-3">
	              <div class="form-group">
	                <label>Salary Type <span style="color: red;">*</span> </label>
	                <?php echo form_error('salary_type');?>
	                <select name="salary_type" id= "salary_type" class="form-control input-sm" required>
	                	<option value=""> Salary Type </option>
	                	<option value="1">Fixed</option>
	                	<option value="2">Production</option>
	                </select>
	              </div>
	            </div>
	            <div class="col-md-3">
	              <div class="form-group">
	                <label>Salary Withdraw <span style="color: red;">*</span> </label>
	                <?php echo form_error('salary_draw');?>
	                <select name="salary_draw" id= "salary_draw" class="form-control input-sm" required>
	                	<option value="">Select</option>
	                	<option value="1">cash</option>
	                	<option value="2">bank</option>
	                </select>
	              </div>
	            </div>

	            <div class="col-md-2">
	              <div class="form-group">
	                <label>OT Entitle <span style="color: red;">*</span> </label>
	                <?php echo form_error('ot_entitle');?>
	                <select name="ot_entitle" id= "ot_entitle" class="form-control input-sm" required>
	                	<option value="">Select</option>
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
	                	<option value="">Select</option>
	                	<option value="0">Yes</option>
	                	<option selected value="1">No</option>
	                </select>
	              </div>
	            </div>
	            <div class="col-md-2">
	              <div class="form-group">
	                <label>Transport <span style="color: red;">*</span> </label>
	                <?php echo form_error('transport');?>
	                <select name="transport" id= "transport" class="form-control input-sm" required>
	                	<option value="">Select </option>
	                	<option value="0">Yes</option>
	                	<option selected value="1">No</option>
	                </select>
	              </div>
	            </div>
	          </div>

	          <div class="row">
	            <div class="col-md-2">
	              <div class="form-group">
	                <label>Gross Salary <span style="color: red;">*</span> </label>
	                <?php echo form_error('gross_sal');?>
	                <input type="text" onchange="salary_structure_cal()" name="gross_sal" id="gross_sal" class="form-control input-sm" required>
	              </div>
	            </div>
	            <div class="col-md-2">
	              <div class="form-group">
	                <label>Basic Salary </label>
	                <?php echo form_error('basic_sal');?>
	                <input type="text" name="basic_sal" id="basic_sal" disabled class="form-control input-sm" required>
	              </div>
	            </div>
	            <div class="col-md-2">
	              <div class="form-group">
	                <label>House </label>
	                <?php echo form_error('house_rent');?>
	                <input type="text" name="house_rent" id="house_rent" disabled class="form-control input-sm" required>
	              </div>
	            </div>

	            <div class="col-md-2">
	              <div class="form-group">
	                <label>Medical </label>
	                <?php echo form_error('medical');?>
	                <input type="text" name="medical" id="medical" disabled class="form-control input-sm" required>
	              </div>
	            </div>
	            <div class="col-md-2">
	              <div class="form-group">
	                <label>Transport </label>
	                <?php echo form_error('trans_allow');?>
	                <input type="text" name="trans_allow" id="trans_allow" disabled class="form-control input-sm" required>
	              </div>
	            </div>
	            <div class="col-md-2">
	              <div class="form-group">
	                <label>	Food </label>
	                <?php echo form_error('food');?>
	                <input type="text" name="food" id="food" disabled class="form-control input-sm" required>
	              </div>
	            </div>
	          </div>
					</div>

          <h3 style="font-weight: 600;">Nominee Information</h3>
	        <hr style="margin-bottom: 0px !important;">
	        <div style="background-color: white; padding: 15px !important;">
	          <?php $nominees = $this->db->get('emp_nomini_relation')->result(); ?>
	          <div class="row">
	            <div class="col-md-3">
	              <div class="form-group">
	                <label>Nominee Name <span style="color: red;">*</span> </label>
	                <?php echo form_error('nominee_name');?>
	                <input type="text" name="nominee_name" id="nominee_name" class="form-control input-sm" required>
	              </div>
	            </div>
	            <div class="col-md-3">
	              <div class="form-group">
	                <label>Village Name <span style="color: red;">*</span> </label>
	                <?php echo form_error('nominee_vill');?>
	                <input type="text" name="nominee_vill" id="nominee_vill" class="form-control input-sm" required>
	              </div>
	            </div>
	            <div class="col-md-3">
	              <div class="form-group">
	                <label>District<span style="color: red;">*</span> </label>
	                <?php echo form_error('nomi_district');?>
	                <select name="nomi_district" id= "nomi_district" class="form-control input-sm" required>
	                	<option value="">-- Select District --</option>
	                	<?php foreach ($districts as $key => $row) { ?>
		                  <option value="<?= $row->id ?>"><?= $row->name_en; ?></option>
	                	<?php } ?>
		              </select>
	              </div>
	            </div>
	            <div class="col-md-3">
	              <div class="form-group">
	                <label>Upazila/Thana<span style="color: red;">*</span> </label>
	                <?php echo form_error('nomi_thana');?>	                
	                <select name="nomi_thana" id= "nomi_thana" class="nomi_thana form-control input-sm" required>
	                	<option value="">-- Select District --</option>
	                </select>
	              </div>
	            </div>
	          </div>

	          <div class="row">
	            <div class="col-md-3">
	              <div class="form-group">
	                <label>Post Office<span style="color: red;">*</span> </label>
	                <?php echo form_error('nomi_post');?>
	                <select name="nomi_post" id= "nomi_post" class="nomi_post form-control input-sm" required>
	                	<option value="">-- Select Post Office --</option>
	                </select>
	              </div>
	            </div>
	            <div class="col-md-3">
	              <div class="form-group">
	                <label>Nominee DOB <span style="color: red;">*</span> </label>
	                <?php echo form_error('nomi_age');?>
	                <input type="date" name="nomi_age" id="nomi_age" class="form-control input-sm" required>
	              </div>
	            </div>
	            <div class="col-md-3">
	              <div class="form-group">
	                <label>Nominee Mobile <span style="color: red;">*</span> </label>
	                <?php echo form_error('nomi_mobile');?>
	                <input type="number" name="nomi_mobile" id="nomi_mobile" class="form-control input-sm" required>
	              </div>
	            </div>
	            <div class="col-md-3">
	              <div class="form-group">
	                <label>Relation<span style="color: red;">*</span> </label>
	                <?php echo form_error('nomi_relation');?>
	                <select name="nomi_relation" id= "nomi_relation" class="form-control input-sm" required>
	                	<option value="">-- Select Relation --</option>
	                	<?php foreach ($nominees as $key => $row) { ?>
		                  <option value="<?= $row->id ?>"><?= $row->nomini_relation; ?></option>
	                	<?php } ?>
		              </select>
	              </div>
	            </div>
	          </div>
	        </div>

          <h3 style="font-weight: 600;">Reference/Guardian</h3>
	        <hr style="margin-bottom: 0px !important;">
	        <div style="background-color: white; padding: 15px !important;">
	          <div class="row">
	            <div class="col-md-3">
	              <div class="form-group">
	                <label>Name <span style="color: red;">*</span> </label>
	                <?php echo form_error('refer_name');?>
	                <input type="text" name="refer_name" id="refer_name" class="form-control input-sm" required>
	              </div>
	            </div>

	            <div class="col-md-5">
	              <div class="form-group">
	                <label>Address <span style="color: red;">*</span> </label>
	                <?php echo form_error('refer_address');?>
	                <input type="text" name="refer_address" id="refer_address" class="form-control input-sm" required>
	              </div>
	            </div>
	            <div class="col-md-2">
	              <div class="form-group">
	                <label>Number<span style="color: red;">*</span> </label>
	                <?php echo form_error('refer_mobile');?>
	                <input type="number" name="refer_mobile" class="form-control input-sm" required>
	              </div>
	            </div>
	            <div class="col-md-2">
	              <div class="form-group">
	                <label>Rrelation<span style="color: red;">*</span> </label>
	                <?php echo form_error('refer_relation');?>	                
	                <select name="refer_relation" id= "refer_relation" class="form-control input-sm" required>
	                	<option value="">-- Select --</option>
	                	<?php foreach ($nominees as $key => $row) { ?>
		                  <option value="<?= $row->id ?>"><?= $row->nomini_relation; ?></option>
	                	<?php } ?>
		              </select>
	              </div>
	            </div>
	          </div>	
	        </div>

          <h3 style="font-weight: 600;">Experience</h3>
	        <hr style="margin-bottom: 0px !important;">
	        <div style="background-color: white; padding: 15px !important;">
	          <div class="row">
	            <div class="col-md-3">
	              <div class="form-group">
	                <label>Exp. Factory Name <span style="color: red;">*</span> </label>
	                <?php echo form_error('exp_factory_name');?>
	                <input type="text" name="exp_factory_name" id="exp_factory_name" class="form-control input-sm" required>
	              </div>
	            </div>
	            <div class="col-md-3">
	              <div class="form-group">
	                <label>Exp, Duration <span style="color: red;">*</span> </label>
	                <?php echo form_error('exp_duration');?>
	                <input type="text" name="exp_duration" id="exp_duration" class="form-control input-sm" required>
	              </div>
	            </div>
	            <?php $desig = $this->db->get('emp_designation')->result(); ?>
	            <div class="col-md-3">
	              <div class="form-group">
	                <label>Designation<span style="color: red;">*</span> </label>
	                <?php echo form_error('exp_designation');?>	                
	                <select name="exp_designation" id= "exp_designation" class="form-control input-sm" required>
	                	<option value="">-- Select --</option>
	                	<?php foreach ($desig as $key => $row) { ?>
		                  <option value="<?= $row->desig_id ?>"><?= $row->desig_name; ?></option>
	                	<?php } ?>
		              </select>
	              </div>
	            </div>
	            <div class="col-md-3">
	              <div class="form-group">
	                <label>Image<span style="color: red;">*</span> </label>
	                <?php echo form_error('img_source');?>	                
	                <input type="file" name="img_source" id="img_source" class="form-control" style="height: 35px !important; line-height: 20px !important;">
	              </div>
	            </div>
	          </div>
	        </div>

	        <br>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group pull-right">
                <a href=""class="btn-warning btn">Cancel</a>
                <input class="btn btn-success" type="submit" name="pi_edit" id="pi_edit" value="EDIT">
                <input class="btn btn-primary" type="submit" name="pi_save" value="SAVE">
              </div>
            </div>
          </div>
        </form>

      </div>
    </div>
  </div>



  <script type="text/javascript">
    $(document).ready(function () {
      //Designation dropdown
      $('#emp_id').change(function(){
        var emp_id = $('#emp_id').val();
        $("#proxi_id").empty();
        $('#proxi_id').val(emp_id);
      });

      //Designation dropdown
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

      //nominee Upazila dropdown
      $('#nomi_district').change(function(){
        $('.nomi_thana').addClass('form-control input-sm');
        $(".nomi_thana > option").remove();
        $(".nomi_post > option").remove();
        var id = $('#nomi_district').val();
        $.ajax({
            type: "POST",
            url: hostname +"common/ajax_upazila_by_dis/" + id,
            success: function(func_data)
            {
              $('.nomi_thana').append("<option value=''>-- Select District --</option>");
              $.each(func_data,function(id,name)
              {
                  var opt = $('<option />');
                  opt.val(id);
                  opt.text(name);
                  $('.nomi_thana').append(opt);
              });
            }
        });
      });

      //nominee post office dropdown
      $('#nomi_thana').change(function(){
        $('.nomi_post').addClass('form-control input-sm');
        $(".nomi_post > option").remove();
        var id = $('#nomi_thana').val();
        $.ajax({
            type: "POST",
            url: hostname +"common/ajax_post_office_by_upa_id/" + id,
            success: function(func_data)
            {
              $('.nomi_post').append("<option value=''>-- Select District --</option>");
              $.each(func_data,function(id,name)
              {
                  var opt = $('<option />');
                  opt.val(id);
                  opt.text(name);
                  $('.nomi_post').append(opt);
              });
            }
        });
      });

      //Upazila dropdown
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

      //Post Office dropdown
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

      //Upazila dropdown
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

      //Post Office dropdown
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