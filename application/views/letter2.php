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
    width:740px;
  }
  table.table-heading tr td{
    width:33.33%;
    font-size: 14px
    font-weight: bold;
  }       

</style>
</head>
  <!--<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/appointment_letter.css"> -->
  <?php  foreach($values->result() as $row){
  	
  	$emp_id = $row->emp_id;
  	$absent_start_date = $this->grid_model->get_absent_start_date($emp_id,$firstdate,$limit=10); ?>
    <div style="width:770px; margin:0 auto; text-align:justify; font-family:SolaimanLipi; font-size:14px margin-bottom:120px;">
      <table width="740" style="font-family:SolaimanLipi;">
        <tr>
          <?php $company_logo = $this->common_model->company_information("company_logo"); ?>
          <td width="105"><img width="55" height="55" src="<?php echo base_url(); ?>images/<?php echo $company_logo; ?>" /></td>
          <td width="740" style="font-size:14pxtext-align:center;padding-right: 60px;"><span style="text-align:center"> <?php $this->load->view('head_bangla'); ?>  </span></td>
        </tr>
      </table>
      <div align="center" style="width:740px; border-bottom:2px solid #000;"></div>
      <table width="740px" cellpadding="3" style="">
          <tr>
            <td style="width: 450px;text-align: left;font-size: 14px;font-weight: normal;">সূত্রঃ <span>রেজিস্ট্রি ডাকযোগে প্রেরিত</span></td>
            <td style="width: 250px;text-align: right;font-size: 14px">২য় চিঠি</td>
          </tr>
      </table>
      <table width="740px" cellpadding="3" style="">
          <tr>
            <td style="font-size: 14px;font-weight: normal;">তারিখ :  .........................</td>
          </tr>
      </table>

      <table class="table-heading" style="display: table; font-size: 14px">
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

      <table class="table-heading" style="display: table; width: 720px; font-size: 14px">
        <tr>
          <td style="padding-left:6px;">বর্তমান ঠিকানা</td>
        </tr>
      </table>

      <table width=370px cellpadding="3" style="font-family:SutonnyMJ; overflow: auto; font-size: 14px;">
        <tr>
          <td style="vertical-align: top;">ঠিকানা </td>
          <!-- <td><span class="colon">:</span><div class="border_div"><?php echo $vill_pre;?></div></td> -->
          <td><span class="colon">:</span><div class="border_div"><?php echo $row->emp_pre_add;?></div></td>
        </tr>
      </table>
      <table class="table-heading" style="display: table;font-size: 14px; width: 720px;">
         <tr>
          <td style="padding-left:9px;text-align: left;">স্থায়ী ঠিকানা</td>
        </tr>
      </table>

      <table width=720px cellpadding="3" style="font-family:SutonnyMJ;font-size: 12px;overflow: auto;">
         <tr>
          <td>পিতা/স্বামী </td>
          <td><span class="colon">:</span><?php echo $row->emp_fname; ?></td>
        </tr>
       
        <tr>
          <td style="vertical-align: top;">ঠিকানা</td>
          <td><span class="colon">:</span><?php echo $row->emp_par_add; ?></td>
        </tr>

      </table>


      <div id="sub" style="width:720px;"><h5 style="text-align:left;font-size: 14px;">বিষয়ঃ বাংলাদেশ শ্রম আইন ২০০৬ ও সংশোধিত ২০১৩ এর ২৭(৩ক) ধারা মোতাবেক, ১০ দিনের অধিক অনুপস্থিতির জন্য আত্মপক্ষ সমর্থনের সুযোগ প্রদান প্রসঙ্গে।</h5></div>

      <div style="float:left; width:740px;position:relative;font-size:14px;">
        <p>জনাব / জনাবা,<br>আপনি গত <span style="padding: 0 5px;font-family:SutonnyMJ;"><?php echo date('Y-m-d',strtotime($row->left_date)); ?> </span> ইং তারিখ থেকে কারখানা কর্তৃপক্ষের বিনা অনুমতিতে কর্মস্থলে অনুপস্থিত রয়েছেন। এ প্রেক্ষিতে কারখানা কর্তৃপক্ষ আপনার স্থায়ী ও বর্তমান ঠিকানায় রেজিষ্ট্রি ডাকযোগে গত <!-- .......................... --> <span style="padding: 0 5px;font-family:SutonnyMJ;"> <?php echo date('Y-m-d',strtotime($row->left_date .' + 10 days')); ?> </span>  ইং তারিখে বিনা অনুমতিতে চাকুরীতে অনুপস্থিতির কারণ ব্যাখ্যা সহ কাজে যোগদানের জন্য পত্র প্রেরণ করেছে। কিন্তু অদ্যবধি আপনি উপরোক্ত বিষয়ে কোন ধরনের লিখিত ব্যাখ্যা প্রদান করেন নাই এবং চাকুরীতেও যোগদান করেন নাই।</p>

        <p>অতএব,  অত্র পত্র প্রাপ্তির ০৭ (সাত) দিনের মধ্যে আত্মপক্ষ সমর্থন সহ কাজে যোগদান করতে আপনাকে নির্দেশ দেয়া গেল।</p>

        <p>
        	উক্ত সময়ের মধ্যে আপনি আত্মপক্ষ সমর্থনের জবাব সহ কাজে যোগদান করতে ব্যর্থ হলে বাংলাদেশ শ্রম আইন ২০০৬ ও সংশোধিত ২০১৩ এর ২৭(৩ক) ধারা অনুযায়ী আপনি স্বেচ্ছায় চাকুরী থেকে অব্যাহতি গ্রহন করেছেন বলে গন্য হবে।
        </p>
      </div>

      <div style="clear:both;width:740px;position:relative; height:30px;"></div>
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