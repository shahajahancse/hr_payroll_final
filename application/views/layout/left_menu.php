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

      <!-- Personal -->
      <?php if(in_array(1,$acl)) { ?>
      <li class="start <?= activate_class('emp_info_con') ?>"> <a href="javascript:;"> <i class="fa fa-users"></i>
        <span class="title">HRM</span> <span class="selected"></span> <span class="arrow <?= arrow_open('emp_info_con') ?>"></span> </a>
        <ul class="sub-menu ">
        <li class="start <?= activate_method('personal_info') ?>"> <a href="<?=base_url('emp_info_con/personal_info')?>" >Emp Information</a></li>
        <li class="start <?= activate_method('personal_info_short') ?>"> <a href="<?=base_url('emp_info_con/personal_info_short')?>" >Emp Short Information </a></li>
        </ul>
      </li>
      <?php } ?>

      <!-- Enty System -->
      <?php if(in_array(3,$acl)) { ?>
      <li class="start <?= activate_class('entry_system_con') ?>"> <a href="javascript:;"> <i class="fa fa-users"></i>
        <span class="title">Entry System</span> <span class="selected"></span> <span class="arrow <?= arrow_open('entry_system_con') ?>"></span> </a>
        <ul class="sub-menu ">
          <li class="start <?= activate_method('grid_entry_system')?> "><a href="<?= base_url('entry_system_con/grid_entry_system')?>" class="anchor_cls">All Entry</a> </li>
          <li class="start <?= activate_method('shift_change')?> "><a href="<?= base_url('entry_system_con/shift_change')?>" class="anchor_cls">Shift Change</a> </li>

          <li class="start <?= activate_method('emp_weekend_add')?> "><a href="<?= base_url('entry_system_con/emp_weekend_add')?>" class="anchor_cls">Weeked add</a> </li>

          <li class="start <?= activate_method('emp_holiday_add')?> "><a href="<?= base_url('entry_system_con/emp_holiday_add')?>" class="anchor_cls">Holiday add</a> </li>
          <li class="start <?= activate_method('gov_holiday_list')?> "><a href="<?= base_url('entry_system_con/gov_holiday_list')?>" class="anchor_cls">Gov. Holiday</a> </li>

          <li class="start <?= activate_method('leave_transation')?> "><a href="<?= base_url('entry_system_con/leave_transation')?>" class="anchor_cls">Leave Transaction</a> </li>
          <li class="start <?= activate_method('maternity_entry')?> "><a href="<?= base_url('entry_system_con/maternity_entry')?>" class="anchor_cls">Maternity entry</a> </li>
          <li class="start <?= activate_method('leave_list')?> "><a href="<?= base_url('entry_system_con/leave_list')?>" class="anchor_cls">Leave List</a></li>

          <li class="start <?= activate_method('left_resign_entry')?> "><a href="<?= base_url('entry_system_con/left_resign_entry')?>" class="anchor_cls">Left / Resign / Regular</a> </li>
          <li class="start <?= activate_method('left_list')?> "><a href="<?= base_url('entry_system_con/left_list');?>" class="anchor_cls" >Left List</a></li>
          <li class="start <?= activate_method('resign_list')?> "><a href="<?= base_url('entry_system_con/resign_list');?>" class="anchor_cls" >Resign List</a></li>

          <li class="start <?= activate_method('incre_prom_entry')?> "><a href="<?= base_url('entry_system_con/incre_prom_entry')?>" class="anchor_cls">Increment / Promotion</a> </li>
          <li class="start <?= activate_method('inter_unit_transfer') ?>"> <a href="<?=base_url('entry_system_con/inter_unit_transfer')?>" class="anchor_cls" id="acl">Unit Transfer</a> </li>

          <li class="start <?= activate_method('advance_salary')?> "><a href="<?= base_url('entry_system_con/advance_salary')?>" class="anchor_cls">Advance Salary </a> </li>
          <li class="start <?= activate_method('advance_loan')?> "><a href="<?= base_url('entry_system_con/advance_loan')?>" class="anchor_cls">Advance Loan & Tax</a> </li>
          <!-- <li class="start <?= activate_method('letter_notification')?> "><a href="<?= base_url('entry_system_con/letter_notification')?>" class="anchor_cls">Letter Notification</a> </li> -->
          <!-- <li class="start <?= activate_method('tax_others_deduction')?> "><a href="<?= base_url('entry_system_con/tax_others_deduction')?>" class="anchor_cls">Tax & Others Deduction</a> </li> -->
        </ul>
      </li>
      <?php } ?>

      <!-- Attendance -->
      <?php if(in_array(4,$acl)) { ?>
      <li class="start <?= activate_class('attn_process_con') ?>"> <a href="javascript:;"> <i class="fa fa-star-o"></i>
        <span class="title">Attendance</span> <span class="selected"></span> <span class="arrow <?= arrow_open('emp_info_con') ?>"></span> </a>
        <ul class="sub-menu ">
          <li class="start <?= activate_method('file_upload') ?>"> <a href="<?=base_url('attn_process_con/file_upload')?>" >File Upload</a></li>
          <li class="start <?= activate_method('attn_process_form') ?>"> <a href="<?=base_url('attn_process_con/attn_process_form')?>" class="anchor_cls">Attendance Process</a> </li>
          <?php if(in_array(5,$acl)) { ?>
            <li class="start <?= activate_method('grid_window') ?>"> <a href="<?=base_url('attn_process_con/grid_window')?>" class="anchor_cls">Reports</a> </li>
          <?php } ?>
        </ul>
      </li>
      <?php } ?>

      <!-- Payroll -->
      <?php if(in_array(7,$acl)) { ?>
      <li class="start <?= activate_class('salary_process_con') ?>"> <a href="javascript:;"> <i class="fa fa-money"></i>
        <span class="title">Payroll </span> <span class="selected"></span> <span class="arrow <?= arrow_open('salary_process_con') ?>"></span> </a>
        <ul class="sub-menu ">
          <li class="start <?= activate_method('salary_process_form') ?>"> <a href="<?=base_url('salary_process_con/salary_process_form')?>" class="anchor_cls" id="acl">Process</a> </li>
          <?php if(in_array(8,$acl)) { ?>
            <li class="start <?= activate_method('adv_salary_report') ?>"> <a href="<?=base_url('salary_process_con/adv_salary_report')?>" class="anchor_cls">Adv. Salary</a> </li>
            <li class="start <?= activate_method('grid_salary_report') ?>"> <a href="<?=base_url('salary_process_con/grid_salary_report')?>" class="anchor_cls">Reports</a> </li>
          <?php } ?>
          <!-- < ?php if(in_array(125,$acl)) { ?>
            <li class="start < ?= activate_method('grid_salary_report') ?>"> <a href="< ?=base_url('salary_process_con/festival_bonus_form')?>" class="anchor_cls">Festival Bonus</a> </li>
          < ?php } ?> -->
        </ul>
      </li>
      <?php } ?>

      <!-- Training -->
      <li class="start <?= activate_class('training_con') ?>"> <a href="javascript:;"> <i class="fa fa-users"></i>
        <span class="title">Training</span> <span class="selected"></span> <span class="arrow <?= arrow_open('training_con') ?>"></span> </a>
        <ul class="sub-menu ">
          <li class="start <?= activate_method('training_list') ?>"> <a href="<?=base_url('training_con/training_list')?>" >Training List</a></li>
          <li class="start <?= activate_method('training') ?>"> <a href="<?=base_url('training_con/training')?>" >Training Type</a></li>
          <li class="start <?= activate_method('training_report') ?>"> <a href="<?=base_url('training_con/training_report')?>" >Training Report</a></li>
        </ul>
      </li>

      <!-- Setup -->
      <?php if(in_array(2,$acl)) { ?>
      <li class="start <?= activate_class('setup_con') ?>"> <a href="javascript:;"> <i class="fa fa-cog"></i>
        <span class="title">Setup Section </span> <span class="selected"></span> <span class="arrow <?= arrow_open('setup_con') ?>"></span> </a>
        <ul class="sub-menu ">

          <li class="start <?= activate_method('company_info_setup') ?>"> <a href="<?=base_url('setup_con/company_info_setup')?>" class="anchor_cls">Company Information</a> </li>

          <li class="start <?= activate_method('department') ?>"> <a href="<?=base_url('setup_con/department')?>" class="anchor_cls">Department</a> </li>
          <li class="start <?= activate_method('section') ?>"> <a href="<?=base_url('setup_con/section')?>" class="anchor_cls">Section</a> </li>
          <li class="start <?= activate_method('line') ?>"> <a href="<?=base_url('setup_con/line')?>" class="anchor_cls">Line</a> </li>

          <li class="start <?= activate_method('designation') ?>"> <a href="<?=base_url('setup_con/designation')?>" class="anchor_cls">Designation</a> </li>

          <li class="start <?= activate_method('manage_designation') ?>"> <a href="<?=base_url('setup_con/manage_designation')?>" class="anchor_cls">Manage Designation</a> </li>

          <li class="start <?= activate_method('attendance_bonus') ?>"> <a href="<?=base_url()?>setup_con/attendance_bonus" class="anchor_cls">Attendance Bonus</a> </li>
          <li class="start <?= activate_method('weekend_allowance_setup') ?>"> <a href="<?=base_url()?>setup_con/weekend_allowance_setup" >Weekend Allowance</a> </li>
          <li class="start <?= activate_method('night_allowance_setup') ?>"> <a href="<?=base_url('setup_con/night_allowance_setup')?>" >Night Allowance</a> </li>
          <li class="start <?= activate_method('tiffin_bill_setup') ?>"> <a href="<?=base_url('setup_con/tiffin_bill_setup')?>" >Tiffin Bill</a> </li>
          <li class="start <?= activate_method('iftar_bill_setup') ?>"> <a href="<?=base_url('setup_con/iftar_bill_setup')?>" >Iftar Allowance</a> </li>

          <li class="start <?= activate_method('shift_schedule') ?>"> <a href="<?=base_url('setup_con/shift_schedule')?>" class="anchor_cls">Shift Schedules</a> </li>
          <li class="start <?= activate_method('shift_management') ?>"> <a href="<?=base_url('setup_con/shift_management')?>" class="anchor_cls">Shift Manage</a> </li>
          <li class="start <?= activate_method('emp_roster_shift') ?>"> <a href="<?=base_url('setup_con/emp_roster_shift')?>" class="anchor_cls">Roster Shift</a> </li>

          <li class="start <?= activate_method('alternet_day') ?>"> <a href="<?=base_url('setup_con/alternet_day')?>" >Alternet Day</a> </li>

          <li class="start <?= activate_method('salary_grade') ?>"> <a href="<?=base_url('setup_con/salary_grade')?>" class="anchor_cls">Salary Grade</a> </li>
          <li class="start <?= activate_method('leave_setup') ?>"> <a href="<?=base_url()?>setup_con/leave_setup" class="anchor_cls">Leave</a> </li>
          <li class="start <?= activate_method('bonus_setup') ?>"> <a href="<?=base_url()?>setup_con/bonus_setup" class="anchor_cls">Bonus</a> </li>
          <!-- <li class="start <?= activate_method('district') ?>"> <a href="<?=base_url('setup_con/district')?>" class="anchor_cls">District</a> </li> -->
          <!-- <li class="start <?= activate_method('upazila') ?>"> <a href="<?=base_url('setup_con/upazila')?>" class="anchor_cls">Upazila / Thana</a> </li> -->
          <li class="start <?= activate_method('post_office') ?>"> <a href="<?=base_url('setup_con/post_office')?>" class="anchor_cls">Post Office</a> </li>
        </ul>
      </li>
      <?php } ?>

      <!-- Setting -->
      <?php if($this->session->userdata('data')->level == "All" || in_array(17,$acl)) { ?>
      <li class="start <?= activate_class('setting_con') ?>"> <a href="javascript:;"> <i class="fa fa-cog"></i>
        <span class="title">Settings </span> <span class="selected"></span> <span class="arrow <?= arrow_open('setting_con') ?>"></span> </a>
        <ul class="sub-menu ">
          <?php //if(in_array(17,$acl)) { ?>
          <li class="start <?= activate_method('crud') ?>"> <a href="<?=base_url('setting_con/crud')?>" class="anchor_cls" id="acl">Access</a> </li>
          <?php //} ?>
          <li class="start <?= activate_method('left_menu_acl') ?>"> <a href="<?=base_url('setting_con/left_menu_acl')?>" class="anchor_cls" id="acl">Left Menu Access</a> </li>
          <li class="start <?= activate_method('user_acl_hrm') ?>"> <a href="<?=base_url('setting_con/user_acl_hrm')?>" class="anchor_cls" id="acl">User Access HRM</a> </li>
          <li class="start <?= activate_method('user_acl_pr') ?>"> <a href="<?=base_url('setting_con/user_acl_pr')?>" class="anchor_cls" id="acl">User Access Payroll</a> </li>
          <li class="start <?= activate_method('report_setting') ?>"> <a href="<?=base_url('setting_con/report_setting')?>" class="anchor_cls" id="acl">Report Setting</a> </li>
          <li class="start <?= activate_method('hide_designation_employee') ?>"> <a href="<?=base_url('setting_con/hide_designation_employee')?>" class="anchor_cls" id="acl">Hide Designation</a> </li>
          <li class="start <?= activate_method('dasig_group') ?>"> <a href="<?=base_url('setting_con/dasig_group')?>" class="anchor_cls" id="acl">Group Dasignation</a> </li>
          <li class="start <?= activate_method('line_wise_atn_desig') ?>"> <a href="<?=base_url('setting_con/line_wise_atn_desig')?>" class="anchor_cls" id="acl">line wise Designation</a> </li>
          <li class="start <?= activate_method('acl') ?>"> <a href="<?=base_url('setting_con/acl')?>" class="anchor_cls" id="acl">User ACL</a> </li>
          <li class="start <?= activate_method('activity_log') ?>"> <a href="<?=base_url('setting_con/activity_log')?>" class="anchor_cls" id="activity_log">Activity Log</a> </li>
        </ul>
      </li>
      <?php } ?>

      <li class="start">
         <a href="<?=base_url('payroll_con/first_body')?>"> <i class="fa fa-phone"></i>  <span class="title">Support</span></a>
      </li>
      <li class="start"><a href="<?=base_url('logout_FE')?>"> <i class="fa fa-power-off"></i>  <span class="title">Log Out</span></a>
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

