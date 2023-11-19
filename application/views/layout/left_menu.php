<!-- BEGIN SIDEBAR MENU -->
<div class="page-sidebar" id="main-menu">
  <!-- BEGIN MINI-PROFILE -->
  <div class="page-sidebar-wrapper" id="main-menu-wrapper">
    <!-- <div class="slimScrollDiv"> -->
    <!-- <div class="user-info-wrapper text-center" style=" padding-bottom: 10px; border-bottom: 1px solid #db0424;"></div> -->

    <!-- BEGIN SIDEBAR MENU -->
    <ul class="pull-left" style="margin-top: 5px">
      <li class="start <?= activate_class('payroll_con') ?>">
         <a href="<?=base_url('payroll_con')?>"> <i class="fa fa-tachometer"></i><span class="title">DashBoard</span></a>
      </li>

      <?php
        $user_id = $this->session->userdata('data')->id;
        $acl = check_acl_list($user_id);
      ?>

      <?php if(in_array(1,$acl)) { ?>
      <li class="start <?= activate_class('emp_info_con') ?>"> <a href="javascript:;">
        <span class="title">HRM</span> <span class="selected"></span> <span class="arrow <?= arrow_open('emp_info_con') ?>"></span> </a>
        <ul class="sub-menu ">
          <li class="start <?= activate_method('personal_info') ?>"> <a href="<?=base_url('emp_info_con/personal_info')?>" >Emp Information</a></li>
        </ul>
      </li>
      <?php } ?>

      <?php if(in_array(2,$acl)) { ?>
      <li class="start <?= activate_class('setup_con') ?>"> <a href="javascript:;">
        <span class="title">Setup Section </span> <span class="selected"></span> <span class="arrow <?= arrow_open('setup_con') ?>"></span> </a>
        <ul class="sub-menu ">

          <li class="start <?= activate_method('department') ?>"> <a href="<?=base_url('setup_con/department')?>" class="anchor_cls">Department</a> </li>
          <li class="start "> <a href="<?=base_url('setup_con/section')?>" class="anchor_cls">Section</a> </li>
          <li class="start "> <a href="<?=base_url('setup_con/line')?>" class="anchor_cls">Line</a> </li>
          <li class="start "> <a href="<?=base_url('setup_con/designation')?>" class="anchor_cls">Designation</a> </li>

          <li class="start "> <a href="<?=base_url()?>setup_con/attendance_bonus" class="anchor_cls">Attendance Bonus</a> </li>
          <li class="start "> <a href="<?=base_url()?>setup_con/salary_grade" class="anchor_cls">Salary Grade</a> </li>
          <li class="start "> <a href="<?=base_url()?>setup_con/shift_schedule" class="anchor_cls">Shift Schedules</a> </li>
          <li class="start "> <a href="<?=base_url()?>setup_con/shift_management" class="anchor_cls">Shift Manage</a> </li>
          <li class="start "> <a href="<?=base_url()?>setup_con/leave_setup" class="anchor_cls">Leave</a> </li>
          <li class="start "> <a href="<?=base_url()?>setup_con/bonus_setup" class="anchor_cls">Bonus</a> </li>
          <li class="start "> <a href="<?=base_url()?>setup_con/weekend_allowance_setup" class="anchor_cls">Weekend Allowance</a> </li>
          <li class="start "> <a href="<?=base_url()?>setup_con/night_allowance_setup" class="anchor_cls">Night Allowance</a> </li>
          <li class="start "> <a href="<?=base_url()?>setup_con/holiday_allowance_setup" class="anchor_cls">Holiday Allowance</a> </li>

          <li class="start <?= activate_method('post_office') ?>"> <a href="<?=base_url('setup_con/post_office')?>" class="anchor_cls">Post Office</a> </li>
        </ul>
      </li>
      <?php } ?>

          
      <li class="start"> <a href="<?=base_url('setup_con/company_info_setup')?>" class="anchor_cls" id="company_info_menu">Company Information</a> </li>

      <li class="start"> <a href="javascript:;" > <i class="fa fa-users"></i> <span class="title">HRM</span> <span class="selected"></span> <span class="arrow"></span> </a>
        <ul class="sub-menu ">

          <li class="start "> <a href="javascript:;"><span class="title">Entry System</span> <span class="selected"></span> <span class="arrow"></span> </a>
            <ul class="sub-menu">
              <li class="start "> <a href="<?=base_url()?>index.php/entry_system_con/grid_entry_system" class="anchor_cls">All Entry</a> </li>
              <li class="start "> <a href="<?=base_url()?>index.php/entry_system_con/tax_others_deduction" class="anchor_cls">Tax & Others Deduction</a> </li>
              <li class="start "> <a href="<?=base_url()?>index.php/entry_system_con/weekend_delete" class="anchor_cls">Weeked Delete</a> </li>
              <li class="start "> <a href="<?=base_url()?>index.php/entry_system_con/holiday_delete" class="anchor_cls">Holiday Delete</a> </li>

              <li class="start "> <a href="<?=base_url()?>index.php/entry_system_con/leave_transation" class="anchor_cls">Leave Transaction</a> </li>
              <li class="start"> <a href="<?=base_url()?>index.php/entry_system_con/leave_delete" class="anchor_cls">Leave Delete</a></li>

              <li class="start"> <a class="anchor_cls" href="<?php echo base_url();?>index.php/entry_system_con/left_delete">Left Delete</a></li>


              <li class="start "> <a href="<?=base_url()?>index.php/entry_system_con/advance_loan" class="anchor_cls">Advance Loan</a> </li>

              <li class="start "> <a href="<?=base_url()?>index.php/left_resign_con/left_resign_entry" class="anchor_cls">Left/Resign Entry</a> </li>
              <li class="start "> <a href="<?=base_url()?>index.php/entry_system_con/new_to_regular" class="anchor_cls">New To Regular</a> </li>
              <li class="start "> <a href="<?=base_url()?>index.php/emp_increment_con/increment_info" class="anchor_cls">Increment Entry</a> </li>
              <li class="start "> <a href="<?=base_url()?>index.php/emp_increment_con/promotion_info" class="anchor_cls">Promotion Entry</a> </li>
              <li class="start "> <a href="<?=base_url()?>index.php/entry_system_con/proximity_card_edit" class="anchor_cls">Proximity Card Edit</a> </li>
            </ul>
          </li>
          <li class="start "> <a href="javascript:;"><span class="title">Process</span> <span class="selected"></span> <span class="arrow"></span> </a>
            <ul class="sub-menu">
              <li class="start "> <a class="anchor_cls" href="<?=base_url()?>index.php/attn_process_con/file_upload">File Upload</a> </li>
              <li class="start "> <a href="<?=base_url()?>index.php/attn_process_con/attn_process_form" class="anchor_cls">Attendance Process</a> </li>
            </ul>
          </li>
          <li class="start "> <a href="javascript:;"><span class="title">Reports</span> <span class="selected"></span> <span class="arrow"></span> </a>
            <ul class="sub-menu">
              <li class="start "> <a href="<?=base_url()?>index.php/grid_con/grid_window" class="anchor_cls">All Report</a> </li>

              <li class="start "> <a href="<?=base_url()?>index.php/mars_con/others_report_front_end" class="anchor_cls">Others Report</a> </li>
            </ul>
          </li>
        </ul>
      </li>
      <li class="start ">
        <a href="javascript:;" > <i class="fa fa-money"></i> <span class="title">Payroll</span> <span class="selected"></span> <span class="arrow"></span> </a>
        <ul class="sub-menu">
          <li class="start "> <a href="javascript:;"><span class="title">Process</span> <span class="selected"></span> <span class="arrow"></span> </a>
            <ul class="sub-menu">
              <li class="start "> <a href="<?=base_url()?>index.php/salary_process_con/salary_process_form" class="anchor_cls">Salary Process</a> </li>
              <li class="start"><a href="<?=base_url()?>index.php/earn_leave_con/earn_process_form" class="anchor_cls">Earn Leave Process</a></li>
            </ul>
          </li>
          <li class="start "> <a href="javascript:;"><span class="title">Reports</span> <span class="selected"></span> <span class="arrow"></span> </a>
            <ul class="sub-menu">
              <li class="start "> <a href="<?=base_url()?>index.php/salary_report_con/grid_salary_report" class="anchor_cls">Salary Report</a> </li>
              <li class="start "> <a href="<?=base_url()?>index.php/earn_leave_con/grid_earn_report"class="anchor_cls" >Earn Leave Report</a> </li>
            </ul>
          </li>
        </ul>
      </li>
      <li class="start "> <a href="javascript:;" > <i class="fa fa-tasks"></i> <span class="title">Maintenance</span> <span class="selected"></span> <span class="arrow"></span> </a>
        <ul class="sub-menu">

          <li class="start "> <a href="javascript:;"><span class="title">User</span> <span class="selected"></span> <span class="arrow"></span> </a>
            <ul class="sub-menu">
              <li class="start "> <a href="<?=base_url()?>index.php/acl_con/acl" class="anchor_cls">ACL</a> </li>
            </ul>
          </li>
        </ul>
      </li>
      <li class="start">
         <a href="<?=base_url()?>index.php/payroll_con/first_body"> <i class="fa fa-phone"></i>  <span class="title">Support</span></a>
      </li>
      <li class="start"><a href="<?=base_url()?>index.php/logout_FE"> <i class="fa fa-power-off"></i>  <span class="title">Log Out</span></a>
      </li>
    </ul>
    <div id="notification_div"></div>
    <div class="clearfix"></div>
    <!-- END SIDEBAR MENU -->
  </div>
</div>

<a href="#" class="scrollup">Scroll</a>
<div class="footer-widget">
  <div class="copyrights text-center" style="width: 100%">
  <span style=" float: right;"> <span style="vertical-align: bottom; font-size: 11px;">Developed By |</span> <a href="https:mysoftheaven.com/" target="_blank">
  <img src="<?=base_url()?>awedget/assets/img/mysoft-logo.png" height="18"> Mysoftheaven (BD) Ltd.</a> </span>
  </div>
</div>
<!-- END SIDEBAR -->

