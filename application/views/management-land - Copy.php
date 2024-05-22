<?php //print_r($username);exit; ?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<meta charset="utf-8" />
<link rel="icon" type="image/ico" href="<?=base_url()?>awedget/assets/img/mysoft-logo.png"/>

<title>Management Dashboard</title>
<link href="<?php echo base_url(); ?>js/calendar/fullcalendar.min.css" rel='stylesheet' />
<link href="<?php echo base_url(); ?>js/calendar/fullcalendar.print.min.css" rel='stylesheet' media='print' />
<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link href="<?=base_url()?>awedget/assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
<link href="<?=base_url()?>awedget/assets/css/management.css" rel="stylesheet" >
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<!-- <script src="//code.jquery.com/jquery-1.11.1.min.js"></script> -->
<script src="<?php echo base_url(); ?>js/jquery-3.1.1.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>js/highcharts.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>js/highcharts-more.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>js/exporting.js" type="text/javascript"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="<?php echo base_url(); ?>js/calendar/moment.min.js"></script>
<script src="<?php echo base_url(); ?>js/calendar/fullcalendar.min.js"></script>

<style type="text/css">

</style>

<script>
$(document).ready(function() {
  $('.custom_loader').show();
  $('.container_page').hide();
  setInterval(function(){
    $('.container_page').show();
    $('.custom_loader').hide();
     }, 1000);
});
</script>
<script type="text/javascript">
  $(document).ready(function() {

    $('#calendar').fullCalendar({
      defaultDate: '2019-03-07',
      editable: true,
      eventLimit: true, // allow "more" link when too many events
      events: [
        {
          title: 'All Day Event',
          start: '2019-03-07'
        },
        {
          title: 'Long Event',
          start: '2019-03-07',
          end: '2019-03-10'
        },
        {
          id: 999,
          title: 'Repeating Event',
          start: '2019-03-07T16:00:00'
        },
        {
          id: 999,
          title: 'Repeating Event',
          start: '2019-03-07T16:00:00'
        },
        {
          title: 'Conference',
          start: '2019-03-07',
          end: '2019-03-13'
        },
        {
          title: 'Meeting',
          start: '2019-03-07T10:30:00',
          end: '2019-03-07T12:30:00'
        },
        {
          title: 'Lunch',
          start: '2019-03-07T12:00:00'
        },
        {
          title: 'Meeting',
          start: '2019-03-07T14:30:00'
        },
        {
          title: 'Happy Hour',
          start: '2019-03-07T17:30:00'
        },
        {
          title: 'Dinner',
          start: '2019-03-07T20:00:00'
        },
        {
          title: 'Birthday Party',
          start: '2019-03-07T07:00:00'
        },
        {
          title: 'Click for Google',
          url: 'http://google.com/',
          start: '2019-03-07'
        }
      ]
    });

  });
</script>
</head> <!-- END HEAD -->
  <body>
  <!-- BEGIN CONTAINER -->
  <div class="container-fluid">
    <div class="row">
      <div class="header_container">
        <div class="col-md-3">
          <a href="<?=base_url()?>"><span style="color:#ffffff; font-size: 19px; padding-left: 15px;">MHL KORMOCHARI</span></a>
        </div>
        <div class="col-md-5 text-center">
          <div class="user-info">
              <span style="font-size: 20px;color:#8DC65E"> 
                <strong><?=$unit_name?></strong>
              </span>
          </div>
        </div>

        <div class="col-md-3">
          <div class="pull-right">
              <div class="chat-toggler">
                <div class="user-details" style="float:right;">                
                  <div class="username">
                    <span class="" style="margin-left: 20px;color:#fff">Welcome, <b><?=$username?></b> <img src="<?=base_url()?>awedget/assets/img/avater.jpg"  alt="Profile Image" data-src="<?=base_url()?>awedget/assets/img/avater.jpg" data-src-retina="<?=base_url()?>awedget/assets/img/avater.jpg" width="35" height="35" style="border-radius: 35px;" /> 
                    </span>
                  </div>
                </div>
              </div>
          </div>
        </div>
          <div class="col-md-1">
              <ul class="nav quick-section pull-left">
                <li class="quicklinks"> <a data-toggle="dropdown" class="dropdown-toggle pull-right" href="javascript:;" id="user-options">
                 <i class="fa fa-cog" style="font-size: 22px; color: #006ba3 !important;"></i>
                 </a>
                 <ul class="dropdown-menu pull-right" role="menu" aria-labelledby="user-options">   
                    <li><a href="<?=base_url()?>change_password"><i class="fa fa-lock"></i>&nbsp;&nbsp;Change Password</a></li>
                    <li><a href="<?=base_url()?>logout_FE"><i class="fa fa-power-off"></i>&nbsp;&nbsp;Log Out</a></li>
                  </ul>
                </li>
              </ul>
            </div> <!-- END CHAT TOGGLER -->
          </div>
      </div>
    </div>
  <div class="container">
    <div class="row">
      <?php
          $all_emp = $values["all_emp"];
          $all_present = $values["all_present"];
          $all_absent = $values["all_absent"];
          $all_male = $values["all_male"];
          $all_female = $values["all_female"];
          $all_late = $values["all_late"];
          $all_leave = $values["all_leave"];

          $monthly_join_id = $values["monthly_join_id"];
          $monthly_resign_id = $values["monthly_resign_id"];
          $monthly_left_id = $values["monthly_left_id"];
          $salary = $values["salary"];
          $ot = $values["ot"];
          $att_bonus = $values["att_bonus"];
          $day_1 = $values["day_1"];
          $day_2 = $values["day_2"];
          $day_3 = $values["day_3"];
          $day_4 = $values["day_4"];
          $day_5 = $values["day_5"];
          $day_6 = $values["day_6"];
          $day_7 = $values["day_7"];
          $all_present_2 = $values["all_present_2"];
          $all_present_3 = $values["all_present_3"];
          $all_present_4 = $values["all_present_4"];
          $all_present_5 = $values["all_present_5"];
          $all_present_6 = $values["all_present_6"];
          $all_present_7 = $values["all_present_7"];

          $all_absent_2 = $values["all_absent_2"];
          $all_absent_3 = $values["all_absent_3"];
          $all_absent_4 = $values["all_absent_4"];
          $all_absent_5 = $values["all_absent_5"];
          $all_absent_6 = $values["all_absent_6"];
          $all_absent_7 = $values["all_absent_7"];

         ?>
        <div class="col-sm-6 col-md-3 temp_info">
          <h4 style="vertical-align: top;color:#ffffff;background-color: #4CAF50">Total Employee</h4>
          <h5>
            <span style="margin-right: 14px;">Emp:</span>
            <span class="amount"><?php echo $all_emp;?></span>
          </h5>
          <h5>
            <span style="margin-right: 14px;">Male:</span>
            <span class="amount"><?php echo $all_male;?></span>
          </h5>
          <h5>
            <span style="margin-right: 14px;">Female:</span>
            <span class="amount"><?php echo $all_female;?></span>
          </h5>
        </div>
      <div class="col-sm-6 col-md-3 temp_daily_report">
        <h4 style="vertical-align: top;color:#ffffff;background-color: #4CAF50">Daily Attendance</h4>
        <h5>Present:<span class="amount"><?php echo $all_present;?></span></h5>
        <h5>Absent:<span class="amount"><?php echo $all_absent;?></span></h5>
        <h5>Leave:<span class="amount"><?php echo $all_leave; ?></span></h5>
        <h5>Late:<span class="amount"><?php echo $all_late;?></span></h5>
      </div>
      <div class="col-sm-6 col-md-3 temp_monthly_report">
        <h4 style="vertical-align: top;color:#ffffff;background-color: #4CAF50">Monthly Employee Status</h4>
        <h5>New Join:<span class="amount"><?php echo $monthly_join_id; ?></span></h5>
        <h5>Resign:<span class="amount"><?php echo $monthly_resign_id; ?></span></h5>
        <h5>Lefty:<span class="amount"><?php echo $monthly_left_id; ?></span></h5>
      </div>
      <div class="col-sm-6 col-md-3 last_month_expansive_report">
        <h4 style="vertical-align: top;color:#ffffff;background-color: #4CAF50">Last Month Salary Expense</h4>
        <h5>Salary:<span class="amount"><?php echo $salary;?></span></h5>
        <h5>OverTime:<span class="amount"><?php echo $ot;?></span></h5>
        <h5>Attn.Bonus:<span class="amount"><?php echo $att_bonus;?></span></h5>
      </div>
    </div>
    <div class="clearfix" style="height: 10px;"></div>
    <div class="row"> <!--- Department row start -->
      <div class="col-sm-6 col-md-3 department">
        <h5>Total Department:
          <span class="amount">
            <?php 
             $this->db->select('*');
             $this->db->from('pr_dept');
             echo $query = $this->db->get()->num_rows();
            ?>
            
          </span>
        </h5>
      </div>
      <div class="col-sm-6 col-md-3 section">
          <h5>Total Section:
            <span class="amount">
              <?php 
                $this->db->select('*');
                $this->db->from('pr_section');
                echo $query = $this->db->get()->num_rows();
               ?>
            </span>
          </h5>
      </div>
      <div class="col-sm-6 col-md-3 designation">
        <h5>Total Designation:
          <span class="amount">
            <?php 
              $this->db->select('*');
              $this->db->from('pr_designation');
              echo $query = $this->db->get()->num_rows();
             ?>
          </span>
        </h5>
      </div>
      <div class="col-sm-6 col-md-3 line">
        <h5>Total Line:
          <span class="amount">
            <?php 
              $this->db->select('*');
              $this->db->from('pr_line_num');
              $query = $this->db->get()->num_rows();
               echo $gtotal_line = $query - 1;
             ?>
          </span>
        </h5>
      </div>
    </div><!--- Department row end -->
    <div class="clearfix" style="height: 10px;"></div>
      <div class="row">
        <div class="col-md-5">
          <h3 style="background-color: #808080;width: 380px;height: 25px;">Daily Attendance Percentage With Graph</h3>
          <div id="piechart" style=""></div>
          <h3 style="background-color: #808080;width: 380px;height: 25px;">Monthly Present With Line Chart</h3>
          <div id="container_page"></div>
        </div>
        <div class="col-md-7">
          <h3 style="background-color: #808080;width: 380px;">Weekly Attendance With Graph</h3>
          <div id="weekly_attn" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
        </div>
     </div>
     
     <!-- <div class="row">
        <div class="col-md-12">
            <div id='calendar'></div>
         </div>
     </div> -->
 </div>
  <div class="container-fluid">
    <div class="row">
      <div class="footer_container">
        <div class="col-md-4"></div>
        <div class="col-md-4">
          <div class="copyrights text-center" style="">
            <span style=""> <span style="vertical-align: bottom; font-size: 11px;color:#fff">Developed By |</span> <a href="http://www.mysoftheaven.com/" target="_blank"> 
            <img src="<?=base_url()?>awedget/assets/img/mysoft-logo.png" height="18"> Mysoftheaven (BD) Ltd.</a> </span>
          </div>
        </div>
        <div class="col-md-4"></div>
      </div>
    </div>
  </div>

<script src="<?=base_url()?>awedget/assets/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script> 

<script src="<?=base_url()?>awedget/assets/plugins/boostrap-3.3.7/js/bootstrap.min.js" type="text/javascript"></script> 
<script src="<?=base_url()?>awedget/assets/plugins/breakpoints.js" type="text/javascript"></script> 
<script src="<?=base_url()?>awedget/assets/plugins/jquery-unveil/jquery.unveil.min.js" type="text/javascript"></script> 
<script src="<?=base_url()?>awedget/assets/plugins/jquery-block-ui/jqueryblockui.js" type="text/javascript"></script> 
<!-- END CORE JS FRAMEWORK --> 
<!-- BEGIN PAGE LEVEL JS -->  
<script src="<?=base_url()?>awedget/assets/plugins/jquery-slider/jquery.sidr.min.js" type="text/javascript"></script>  
<script src="<?=base_url()?>awedget/assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script> 
<script src="<?=base_url()?>awedget/assets/plugins/jquery-numberAnimate/jquery.animateNumbers.js" type="text/javascript"></script>
<script src="<?=base_url()?>awedget/assets/plugins/pace/pace.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>awedget/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js" type="text/javascript"></script>
<script src="<?=base_url()?>awedget/assets/plugins/jquery-inputmask/jquery.inputmask.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>awedget/assets/plugins/jquery-autonumeric/autoNumeric.js" type="text/javascript"></script>
<script src="<?=base_url()?>awedget/assets/plugins/ios-switch/ios7-switch.js" type="text/javascript"></script>
<script src="<?=base_url()?>awedget/assets/plugins/bootstrap-select2/select2.min.js" type="text/javascript"></script>

<script src="<?=base_url()?>awedget/assets/plugins/boostrap-form-wizard/js/jquery.bootstrap.wizard.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>awedget/assets/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>awedget/assets/plugins/jquery-validation/dist/additional-methods.min.js" type="text/javascript"></script>
<script src="//oss.maxcdn.com/jquery.mask/1.11.4/jquery.mask.min.js"></script>


<script src="<?=base_url()?>awedget/assets/plugins/jquery-superbox/js/superbox.js" type="text/javascript"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.js"></script>
  
<!-- BEGIN PAGE DATATABLE -->   
<script src="<?=base_url()?>awedget/assets/plugins/jquery-datatable/js/jquery.dataTables.min.js" type="text/javascript" ></script>
<script src="<?=base_url()?>awedget/assets/plugins/jquery-datatable/extra/js/TableTools.min.js" type="text/javascript" ></script>
<script src="<?=base_url()?>awedget/assets/plugins/datatables-responsive/js/datatables.responsive.js" type="text/javascript"></script>
<script src="<?=base_url()?>awedget/assets/plugins/datatables-responsive/js/lodash.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- <script src="<?=base_url()?>awedget/assets/js/datatables.js" type="text/javascript"></script> -->
<script src="<?=base_url()?>awedget/assets/js/tabs_accordian.js" type="text/javascript"></script>
<script src="<?=base_url()?>awedget/assets/plugins/fullcalendar/fullcalendar.min.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<script src="<?=base_url()?>awedget/assets/js/messages_notifications.js" type="text/javascript"></script>
<!-- BEGIN CORE TEMPLATE JS --> 
<script src="<?=base_url()?>awedget/assets/js/core.js" type="text/javascript"></script> 
<!-- <script src="<?=base_url()?>awedget/assets/js/chat.js" type="text/javascript"></script>  -->
<script src="<?=base_url()?>awedget/assets/js/demo.js" type="text/javascript"></script> 

<script src="<?=base_url()?>awedget/assets/croper/js/cropper.min.js"></script>
<script src="<?=base_url()?>awedget/assets/croper/js/main.js"></script>

<!-- END CORE TEMPLATE JS --> 
<!-- <script src="<?=base_url()?>awedget/assets/js/dashboard_v2.js" type="text/javascript"></script> -->
<script type="text/javascript">
  $(document).ready(function () {
      // $(".live-tile,.flip-list").liveTile();
      $(".source").select2();
  });
</script>

<script src="<?=base_url()?>awedget/assets/js/jquery.bongabdo.js"></script>
<!-- <script src="https://cdn.ckeditor.com/4.10.0/standard/ckeditor.js"></script> -->
<script type="text/javascript">
var chart = Highcharts.chart('container_page', {

    xAxis: {
        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
    },

    series: [{
        type: 'column',
        colorByPoint: true,
        data: [29.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4],
        showInLegend: false
    }]

});

</script>

<script type="text/javascript">
  
Highcharts.chart('piechart', {
  chart: {
    plotBackgroundColor: null,
    plotBorderWidth: null,
    plotShadow: false,
    type: 'pie'
  },
  title: {
    text: 'Browser market shares in January, 2018'
  },
  tooltip: {
    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
  },
  plotOptions: {
    pie: {
      allowPointSelect: true,
      cursor: 'pointer',
      dataLabels: {
        enabled: true,
        format: '<b>{point.name}</b>: {point.percentage:.1f} %',
        style: {
          color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
        }
      }
    }
  },
  series: [{
    name: 'Brands',
    colorByPoint: true,
    data: [{
      name: 'Present',
      y: <?php echo $all_present;?>,
      sliced: true,
      selected: true
    }, {
      name: 'Absent',
      y: <?php echo $all_absent;?>
    }]
  }]
});
</script>

<script type="text/javascript">
  
Highcharts.chart('weekly_attn', {
  chart: {
    type: 'areaspline'
  },
  title: {
    text: 'Average fruit consumption during one week'
  },
  legend: {
    layout: 'vertical',
    align: 'left',
    verticalAlign: 'top',
    x: 150,
    y: 100,
    floating: true,
    borderWidth: 1,
    backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'
  },
  xAxis: {
    categories: [
      '<?php echo $day_7; ?>',
      '<?php echo $day_6; ?>',
      '<?php echo $day_5; ?>',
      '<?php echo $day_4; ?>',
      '<?php echo $day_3; ?>',
      '<?php echo $day_2; ?>',
      '<?php echo $day_1; ?>'
    ],
    plotBands: [{ // visualize the weekend
      from: 4.5,
      to: 6.5,
      color: 'rgba(68, 170, 213, .2)'
    }]
  },
  yAxis: {
    title: {
      text: 'Weekly Attendance'
    }
  },
  tooltip: {
    shared: true,
    valueSuffix: ' units'
  },
  credits: {
    enabled: false
  },
  plotOptions: {
    areaspline: {
      fillOpacity: 0.5
    }
  },
  series: [{
    name: 'Present',
    data: [<?php echo $all_present_7.','.$all_present_6.','.$all_present_5.','.$all_present_4.','.$all_present_3.','.$all_present_2.','.$all_present;?>]
  }, {
    name: 'Absent',
    data: [<?php echo $all_absent_7.','.$all_absent_6.','.$all_absent_5.','.$all_absent_4.','.$all_absent_3.','.$all_absent_2.','.$all_absent;?>]
  }]
});
</script>
</body>
</html>