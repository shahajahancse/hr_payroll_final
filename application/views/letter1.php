<?php error_reporting(0); ?>
<!DOCTYPE html>
<html>
<head>
	<title> Letter 1</title>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/appointment_letter.css">		 

<style type="text/css">
#wrapper {
          margin:0 auto;		  
		  width:700px;
		  height:2000px;;
		  overflow:hidden;
  		  margin-bottom:100px;
		 }
#header {
          width:700px;
		  height:auto;
		  background-color: #CCCCCC;

        } 
#h_left {
         width:500px;
		 height:auto;
		 float:left;
		 }
#h_right {
         width:200px;
		 height:auto;
		 float:right;
		 }
#nav {
         float:left;
		 width:700px;
		 height:auto;
		 padding:10px;
     }
#nav_inner {
         width:190px;
		 height:30px;
		 font-size:14px
		 font-weight:bold;
		 padding-top:5px;
		 border:1px solid #333333;
		 border-collapse:collapse;
		 border-radius:14px;
		 -moz-border-radius:14px;
		 -webkit-border-radius:14px;
		 background-color:#999999;
		 }
#nav_bottom {
         float:left;
         width:700px;
		 height:auto;
		 text-align:justify;
		 } 
#body {
         float:left;
         width:700px;
		 height:auto;
		 text-align:justify;
		}
#body_inner_left {
         float:left;
		 width:200px;
		 height:auto;
		 text-align:left;
		 } 
#body_inner_center {
         float:left;
		 width:100px;
		 height:auto;
		 }
#body_inner_right {
         float:left;
		 width:200px;
		 height:auto;
		 text-align:left;
		 } 
#body_inner_left_ep {
         float:left;
		 width:200px;
		 height:auto;
		 text-align:right;
		 } 
#break { 
         float:left;
		 width:700px;
		 height:auto;
       } 
#footer {
         float:left;
		 width:700px;
		 height:auto;   
         }  
#footer_left {
         float:left;
		 width:300px;
		 height:auto;   
         } 
#footer_right {
     float:right;
		 width:300px;
		 height:auto;   
    }

  .head1,.head2,.head3{
    display: inline;
    font-size: 15px;
    font-weight: bold;
  }
  .head1{
    width: 265px;
    float: left;
    margin-left:5px;
  }
  .head2{
    width: 265px;
    float: left;
  }
  .head3{
    width: 265px;
    float: right;
  }
  .colon{
    display: inline;
    margin-right:5px;
    font-weight: bolder;
  }
  .border_div{
    border-bottom: 1px dotted #000;
    display: inline;
  } 
  table{
    display: inline-block;
  }
  table.table-heading{
    width:720px;
  }
  table.table-heading tr td{
    width:33.33%;
    font-size: 14px
    font-weight: bold;
  }       

</style>

  <?php  
  foreach($values->result() as $row){
  	$emp_id = $row->emp_id;
  	$absent_start_date = $this->grid_model->get_absent_start_date($emp_id,$firstdate,$limit=10); ?>
    <div style="width:750px; margin:0 auto; text-align:justify; font-family:SolaimanLipi; font-size:14px margin-bottom:120px;">
      <table width="720" style="font-family:SolaimanLipi;">
        <tr>
          <?php $company_logo = $this->common_model->company_info()->company_logo; ?>
          <td width="105"><img width="55" height="55" src="<?php  echo base_url();?>images/<?php echo $company_logo = $this->common_model->company_info()->company_logo; ?>" /></td>
          <td width="491" style="font-size:15px;text-align:center;padding-left: 44px;">
            <span style="text-align:center"><span style="font-size:18px; font-weight:bold;">
             <?php echo $company_logo = $this->common_model->company_info()->company_name_bangla; ?></span><br>
             <?php echo $company_logo = $this->common_model->company_info()->company_add_bangla; ?>
            </span>
          </td>
        </tr>
      </table>

      <div align="center" style="width:720px; border-bottom:2px solid #000;"></div>
      <table width="720px" cellpadding="3" style="">
        <tr>
          <td style="width: 450px;text-align: left;font-size: 14px;font-weight: normal;">সূত্রঃ <span>রেজিস্ট্রি ডাকযোগে প্রেরিত</span></td>
          <td style="width: 250px;text-align: right;font-size: 14px;">১য় চিঠি</td>
        </tr>
      </table>
      <table width="720px" cellpadding="3" style="">
        <tr>
          <td style="font-size: 14px;font-weight: normal;">তারিখ :  .........................</td>
        </tr>
      </table>
      <?php
       $emp_add_pre = explode(';',$row->emp_pre_add_ban);
        $vill_pre = $emp_add_pre[0];
        $post_pre = $emp_add_pre[1];
        $thana_pre = $emp_add_pre[2];
        $dist_pre = $emp_add_pre[3];
        $emp_add_par = explode(';',$row->emp_par_add_ban);
        $vill = $emp_add_par[0];
        $post = $emp_add_par[1];
        $thana = $emp_add_par[2];
        $dist = $emp_add_par[3];
       ?>
      <table class="table-heading" style="display: table;font-size: 14px">
        <tr>
          <td>প্রাপক,</td>
        </tr>
      </table>
      <table width=300px cellpadding="3" style="vertical-align:top; font-size: 14px;">
        <tr>
          <td width=65px>নাম</td>
          <td><span class="colon">:</span><div style="font-family:SutonnyMJ;" class="border_div"><?php echo $row->bangla_nam; ?></div></td>
        </tr>
        <tr>
          <td width=70px>আইডি নং</td>
          <td><span class="colon">:</span><div class="border_div"><?php echo $row->emp_id; ?></div></td>
        </tr>
        <tr>
          <td width=65px>পদবী</td>
          <td><span class="colon">:</span><div class="border_div"><?php echo $row->desig_name; ?></div></td>
        </tr>
        <tr>
          <td width=65px>সেকশন</td>
          <td><span class="colon">:</span><div class="border_div"><?php echo $row->sec_name; ?></div></td>
        </tr>
        <tr><td width=65px></td><td></td></tr>
      </table>

      <table class="table-heading" style="display: table;font-size: 14px width: 720px;">
        <tr>
          <td style="padding-left:6px;">বর্তমান ঠিকানা</td>
        </tr>
      </table>

      <table width=370px cellpadding="3" style="font-family:SutonnyMJ;font-size: 14px;overflow: auto;">
        <tr>
          <td style="vertical-align: top;">ঠিকানা </td>
          <td><span class="colon">:</span><div class="border_div"><?php echo $row->emp_pre_add;?></div></td>
        </tr>
      </table>

      <table class="table-heading" style="display: table;font-size: 14px width: 720px;">
         <tr>
          <td style="padding-left:9px;text-align: left;">স্থায়ী ঠিকানা</td>
        </tr>
      </table>

      <table width=720px cellpadding="3" style="font-family:SutonnyMJ;font-size: 14px;overflow: auto;">
         <tr>
          <td>পিতা/স্বামী </td>
          <td><span class="colon">:</span><div class="border_div"><?php echo $row->emp_fname; ?></div></td>
        </tr>
       
        <tr>
          <td style="vertical-align: top;">ঠিকানা</td>
          <td><span class="colon">:</span><?php echo $row->emp_par_add; ?></td>
        </tr>
      </table>


      <div id="sub"><h5 style="text-align:left;font-size: 14px;">বিষয়ঃ বাংলাদেশ শ্রম  আইন ২০০৬ এর ২৭ (৩ক) ধারা মোতাবেক ব্যাখ্যা প্রদান সহ চাকুরীতে  যোগদানের জন্য নোটিশ।</h5></div>

      <div style="float:left; width:720px;position:relative;font-size:14px;">
        জনাব / জনাবা,<br>আপনি গত <span style="padding: 0 10px;font-family:SutonnyMJ;">
        <?php echo $ld = date('d-m-Y',strtotime($row->left_date));?></span>  ইং তারিখ হতে অদ্যবধি বিনা নোটিশে এবং কর্তৃপক্ষের বিনা অনুমতিতে কারখানায় অনুপস্থিত রয়েছেন। আপনার এ ধরণের অনুপস্থিতির কারণে কারখানার স্বাভাবিক উৎপাদন ব্যহত হচেছ বিধায় বাংলাদেশ শ্রম আইন ২০০৬ ও সংশোধিত ২০১৩ এর ২৭(৩ক) ধারা মতে অনতিবিলম্বে আপনাকে অনুপস্থিতির কারণ ব্যাখ্যাসহ কাজে যোগদানের  নির্দেশ প্রদান করা হলো।
        <br><br>
        <p>আপনি যদি অদ্য হতে ১০(দশ) দিনের মধ্যে কারখানায় যোগদান করতে ব্যর্থ বা আপনার এ ধরনের অনুনমোদিত অনুপস্থিতির কারণ উক্ত সময়ের মধ্যে কর্তৃপক্ষের নিকট ব্যাখ্যা প্রদান করতে ব্যর্থ হন তবে কর্তৃপক্ষ আপনার বিরূদ্ধে পরবর্তী আইনানুগ ব্যবস্থা গ্রহণ করবে।</p>
      </div>

      <div style="clear:both;width:720px;position:relative; height:30px;"></div>
      <p style="margin:0px;padding:0px;">ধন্যবাদান্তে</p> কর্তৃপক্ষ
      <br><br>
      অনুলিপি:<br>
      ১। ব্যবস্থাপনা পরিচালক।<br>
      ২। নোটিশ বোর্ড।<br>
      ৩। ব্যক্তিগত নথি
    </div>
    <div style="page-break-after: always;"></div>
  <?php } ?>
</html>