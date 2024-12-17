

  <?php

    // 12/09/21 shahajahan

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
<style>
  .tiles {
    border-radius: 6px;
    box-shadow: 0px 0px 9px 4px #c1c1c1;
}
.tiles .tiles-title {
    font-size: 20px;
    font-family: 'Open Sans';
    text-align: center;
    font-weight: bold;
    color: #00acec;
}
.new2 tr:nth-child(1), .new1 .tiles-title {
    color: #000000 !important;
}
.new2 .heading {
    color: #fff !important;
    background: #00adef;
    box-shadow: 0px 0px 10px 2px #afafaf;
}
</style>
  <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
  <div class="content">
    <div class="row spacing-bottom-sm spacing-bottom">
      <div class="col-lg-3 col-sm-6 spacing-bottom-sm spacing-bottom">
        <div class="tiles white added-margin">
          <div class="tiles-body">
            <div class="tiles-title">Total Department</div>
            <div class="heading" style="text-align: center;">
              <span class="count" data-value="" data-animation-duration="1200" >
                <?php

                $user_level=$this->session->userdata('data')->level;
                  if($user_level=='All'){
                    $this->db->select('*');
                    $this->db->from('emp_depertment');
                    echo $query = $this->db->get()->num_rows();
                  }else{
                    
                    $this->db->select('*');
                    $this->db->from('emp_depertment');
                    echo $query = $this->db->where('unit_id',$this->session->userdata('data')->unit_name)->get()->num_rows();
                  }
                ?>
              </span>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-sm-6 spacing-bottom-sm spacing-bottom">
        <div class="tiles white added-margin">
          <div class="tiles-body">

            <div class="tiles-title">Total Section</div>
            <div class="heading" style="text-align: center;">
            <span class="count" data-value="" data-animation-duration="1200" >
              <?php
                if($user_level=='All'){
                  $this->db->select('*');
                  $this->db->from('emp_section');
                  echo $query = $this->db->get()->num_rows();
                }else{
                  $this->db->select('*');
                  $this->db->from('emp_section');
                  echo $query = $this->db->where('unit_id',$this->session->userdata('data')->unit_name)->get()->num_rows();
                }
              ?>
            </span>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-sm-6 spacing-bottom-sm spacing-bottom">
        <div class="tiles white added-margin">
          <div class="tiles-body">

            <div class="tiles-title"> Total Designation </div>
            <div class="heading" style="text-align: center;">
            <span class="count" data-value="" data-animation-duration="1000">
           

              <?php
                if($user_level=='All'){
                  $this->db->select('*');
                  $this->db->from('emp_designation');
                  echo $query = $this->db->get()->num_rows();
                }else{
                  $this->db->select('*');
                  $this->db->from('emp_designation');
                  echo $query = $this->db->where('unit_id',$this->session->userdata('data')->unit_name)->get()->num_rows();
                }
              ?>
            </span>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-sm-6 spacing-bottom">
        <div class="tiles white added-margin">
          <div class="tiles-body">

            <div class="tiles-title">Total Line</div>
            <div class="heading" style="text-align: center;">
              <span class="count" data-value="" data-animation-duration="1200" >
                


              <?php
                if($user_level=='All'){
                  $this->db->select('*');
                  $this->db->from('emp_line_num');
                  echo $query = $this->db->get()->num_rows();
                }else{
                  $this->db->select('*');
                  $this->db->from('emp_line_num');
                  echo $query = $this->db->where('unit_id',$this->session->userdata('data')->unit_name)->get()->num_rows();
                }
              ?>


              </span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div id="container">
      <div class="row spacing-bottom 2col">
        <div class="col-md-6 col-sm-6 spacing-bottom-sm spacing-bottom">
          <div class="tiles white added-margin new new2">
            <div class="tiles-body">
              <div class="heading">
                <span class="" data-value="" data-animation-duration="1200">Manpower</span>
              </div>

              <div style="border-bottom:1px solid #fff; margin-bottom: 10px"></div>
              <div class="description">
                <table class="report-table">
                  <tr>
                    <td>Total Employee</td>
                    <td class="sub-mark">:</td>
                    <td><?=$all_emp?></td>
                  </tr>
                  <tr>
                    <td>Total Male</td>
                    <td class="sub-mark">:</td>
                    <td><?=$all_male?></td>
                  </tr>
                  <tr>
                    <td>Total Female</td>
                    <td class="sub-mark">:</td>
                    <td><?=$all_female?></td>
                  </tr>
                  <tr style="">
                    <td style="visibility:hidden;">Demo</td>
                    <td class="sub-mark"></td>
                    <td style="visibility:hidden;">Demo</td>
                  </tr>
                </table>
              </div>
            </div>
            <div class="triangle-up"></div>
          </div>
        </div>
        <div class="col-md-6 col-sm-6 spacing-bottom-sm spacing-bottom">
          <div class="tiles white added-margin new new2">
            <div class="tiles-body">
              <div class="heading ">
                <span class="" data-value="" data-animation-duration="1000">Attendance</span>
              </div>

              <div style="border-bottom:1px solid #fff; margin-bottom: 10px"></div>
              <div class="description">
                <table class="report-table report-tabe2">
                  <tr>
                    <td>Present</td>
                    <td class="sub-mark">:</td>
                    <td><?=$all_present?></td>
                  </tr>
                  <tr>
                    <td>Absent</td>
                    <td class="sub-mark">:</td>
                    <td><?=$all_absent?></td>
                  </tr>
                  <tr>
                    <td>Leave</td>
                    <td class="sub-mark">:</td>
                    <td><?=$all_leave?></td>
                  </tr>
                  <tr>
                    <td>Late</td>
                    <td class="sub-mark">:</td>
                    <td><?=$all_late?></td>
                  </tr>
                </table>
              </div>
            </div>
            <div class="triangle-up"></div>
          </div>
        </div>
        <div class="col-md-6 col-sm-6 spacing-bottom">
          <div class="tiles white added-margin new new2">
            <div class="tiles-body">
              <div class="heading">
                <span class="" data-value="" data-animation-duration="1200">Monthly Status</span>
              </div>

              <div style="border-bottom:1px solid #fff; margin-bottom: 10px"></div>
              <div class="description">
                <table class="report-table">
                  <tr>
                    <td>New Join</td>
                    <td class="sub-mark">:</td>
                    <td><?=$monthly_join_id?></td>
                  </tr>
                  <tr>
                    <td>Resign</td>
                    <td class="sub-mark">:</td>
                   <td><?=$monthly_resign_id?></td>
                  </tr>
                  <tr>
                    <td>Lefty</td>
                    <td class="sub-mark">:</td>
                    <td><?=$monthly_left_id?></td>
                  </tr>
                  <tr style="">
                    <td style="visibility:hidden;">Demo</td>
                    <td class="sub-mark"></td>
                    <td style="visibility:hidden;">Demo</td>
                  </tr>
                </table>
              </div>
            </div>
            <div class="triangle-up"></div>
          </div>
        </div>
        <div class="col-md-6 col-sm-6">
          <div class="tiles white added-margin new new2">
            <div class="tiles-body">
              <div class="row-fluid ">
                <div class="heading">
                  <span class="" data-value="" data-animation-duration="700">Previous Status</span>
                </div>
              </div>
              <div style="border-bottom:1px solid #fff; margin-bottom: 10px"></div>
              <div class="description">
                <table class="report-table">
                  <tr>
                    <td>Salary</td>
                    <td class="sub-mark">:</td>
                    <td><?=$salary?></td>
                  </tr>
                  <tr>
                    <td>Over Time</td>
                    <td class="sub-mark">:</td>
                    <td><?=$ot?></td>
                  </tr>
                  <tr>
                    <td>Attn.Bonus</td>
                    <td class="sub-mark">:</td>
                    <td><?=$att_bonus?></td>
                  </tr>
                  <tr style="">
                    <td style="visibility:hidden;">Demo</td>
                    <td class="sub-mark"></td>
                    <td style="visibility:hidden;">Demo</td>
                  </tr>
                </table>
              </div>
            </div>
            <div class="triangle-up"></div>
          </div>
        </div>
      </div>
    </div>
  </div>

<script>
  $('.count').each(function () {
    $(this).prop('Counter',0).animate({
        Counter: $(this).text()
    }, {
        duration: 2000,
        easing: 'linear',
        step: function (now) {
            $(this).text(Math.ceil(now));
        }
    });
});
</script>
