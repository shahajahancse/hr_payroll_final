<?php error_reporting(0); ?>
<!DOCTYPE html>
<html>
<head>
  <title> Letter 3</title>
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
         font-size:16px;
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
        font-size: 16px;
        font-weight: bold;
      }       
  </style>
</head>
  <!--<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/appointment_letter.css"> -->
  <?php  foreach($values->result() as $row){
    
    $emp_id = $row->emp_id;
    $absent_start_date = $this->grid_model->get_absent_start_date($emp_id,$firstdate,$limit=10); ?>
    <div style="width:770px; margin:0 auto; text-align:justify; font-family:SolaimanLipi; font-size:16px; margin-bottom:120px;">
      <table width="740" style="font-family:SolaimanLipi;">
        <tr>
          <?php $company_logo = $this->common_model->company_information("company_logo"); ?>
          <td width="105"><img width="55" height="55" src="<?php echo base_url(); ?>images/<?php echo $company_logo; ?>" /></td>
          <td width="740" style="font-size:15px;text-align:center;padding-right: 60px;"><span style="text-align:center"> <?php $this->load->view('head_bangla'); ?>  </span></td>
        </tr>
      </table>
      <div align="center" style="width:740px; border-bottom:3px solid #000;"></div>
      <table width="740px" cellpadding="3" style="">
        <tr>
          <td style="width: 450px;text-align: left;font-size: 17px;font-weight: normal;">সূত্রঃ <span>রেজিস্ট্রি ডাকযোগে প্রেরিত</span></td>
          <td style="width: 250px;text-align: right;font-size: 15px;">৩য় চিঠি</td>
        </tr>
      </table>
      <table width="740px" cellpadding="3" style="">
        <tr>
          <td style="font-size: 17px;font-weight: normal;">তারিখ :  .........................</td>
        </tr>
      </table>
      <?php
       /* $emp_add_pre = explode(',',$row->emp_pre_add_ban);
        $vill_pre = $emp_add_pre[0];
        $post_pre = $emp_add_pre[1];
        $thana_pre = $emp_add_pre[2];
        $dist_pre = $emp_add_pre[3];
        $vill_pre = split('ঃ', $vill_pre);
        $post_pre = split('ঃ', $post_pre);
        $thana_pre = split('ঃ', $thana_pre);
        $dist_pre = split('ঃ', $dist_pre);
        $vill_pre = $vill_pre[1];
        $post_pre = $post_pre[1];
        $thana_pre = $thana_pre[1];
        $dist_pre = $dist_pre[1];


        $emp_add_par = explode(',',$row->emp_par_add_ban);
        $vill = $emp_add_par[0];
        $post = $emp_add_par[1];
        $thana = $emp_add_par[2];
        $dist = $emp_add_par[3];
        $vill = split('ঃ', $vill);
        $post = split('ঃ', $post);
        $thana = split('ঃ', $thana);
        $dist = split('ঃ', $dist);
        $vill = $vill[1];
        $post = $post[1];
        $thana = $thana[1];
        $dist = $dist[1];*/
      ?>

      <table class="table-heading" style="display: table;font-size: 14px;">
        <tr>
          <td style="font-size: 14px;">প্রাপক,</td>
        </tr>
      </table>
      <table width=300px cellpadding="3" style="vertical-align:top;">
        <tr>
          <td width=65px style="font-size: 14px;">নাম</td>
          <td><span class="colon">:</span><div class="border_div" style="font-family:SutonnyMJ; font-size: 14px;"><?php echo $row->bangla_nam; ?></div></td>
        </tr>
        <tr>
          <td width=70px style="font-size: 14px;"> আইডি নং</td>
          <td><span class="colon">:</span><div class="border_div"><?php echo $row->emp_id; ?></div></td>
        </tr>
        <tr>
          <td width=65px style="font-size: 14px;">পদবী</td>
          <td><span class="colon">:</span><div class="border_div"><?php echo $row->desig_name; ?></div></td>
        </tr>
        <tr>
          <td width=65px style="font-size: 14px;">সেকশন</td>
          <td><span class="colon">:</span><div class="border_div"><?php echo $row->sec_name; ?></div></td>
        </tr>
        <tr><td width=65px></td><td></td></tr>
      </table>

      <table class="table-heading" style="display: table;font-size: 13px; width: 720px;">
        <tr>
          <td style="padding-left:6px;font-size: 16px;"><b>বর্তমান ঠিকানা</b></td>
        </tr>
      </table>

      <table width=370px cellpadding="3" style="font-family:SutonnyMJ;font-size: 16px;overflow: auto;">
        <tr>
          <td style="vertical-align: top;font-size: 14px;">ঠিকানা </td>
          <!-- <td><span class="colon">:</span><div class="border_div"><?php echo $vill_pre;?></div></td> -->
          <td><span class="colon">:</span><div class="border_div"><?php echo $row->emp_pre_add;?></div></td>
        </tr>
       <!--  <tr>
          <td width=65px>ডাকঘর</td>
          <td><span class="colon">:</span><div class="border_div"><?php echo $post_pre;?></div></td>
        </tr>
        <tr>
          <td width=65px>থানা</td>
          <td><span class="colon">:</span><div class="border_div"><?php echo $thana_pre;?></div></td>
        </tr>
        <tr>
          <td width=65px>জেলা</td>
          <td><span class="colon">:</span><div class="border_div"><?php echo $dist_pre;?></div></td>
        </tr> -->
      </table>

      <table class="table-heading" style="display: table;font-size: 13px; width: 720px;">
         <tr>
          <td style="padding-left:9px;text-align: left; font-size:16px" >স্থায়ী ঠিকানা</td>
        </tr>
      </table>

      <table width=720px cellpadding="3" style="font-family:SutonnyMJ;font-size: 16px;overflow: auto;">
         <tr>
          <td style="font-size:14px">পিতা/স্বামী </td>
          <td><span class="colon">:</span><div class="border_div"><?php echo $row->emp_fname; ?></div></td>
        </tr>
       
        <tr>
          <td style="vertical-align: top;font-size:14px">ঠিকানা</td>
          <!-- <td><span class="colon">:</span><?php echo $vill;?></td> -->
          <td><span class="colon">:</span><?php echo $row->emp_par_add; ?></td>
        </tr>
        <!--<tr>
          <td width=65px>ডাকঘর</td>
          <td><span class="colon">:</span><div class="border_div"><?php echo $post;?></div></td>
        </tr>
        <tr>
          <td width=65px>থানা</td>
          <td><span class="colon">:</span><div class="border_div"><?php echo $thana;?></div></td>
        </tr>
        <tr>
          <td width=65px>জেলা</td>
          <td><span class="colon">:</span><div class="border_div"><?php echo $dist;?></div></td>
        </tr> -->
      </table>


      <div id="sub" style="width:720px;"><h5 style="text-align:left;font-size: 17px;">বিষয়ঃ বাংলাদেশ শ্রম আইন ২০০৬ ও সংশোধিত ২০১৩ এর ২৭(৩ক) ধারা মোতাবেক, শ্রমিক কর্তৃক স্বেচ্ছায় চাকুরী হইতে অব্যহতি প্রসংগে।</h5></div>

      <?php 
        $first_issue = date("Y-m-d", strtotime('10 days', strtotime($row->left_date))); 
        $second_issue = date("Y-m-d", strtotime('8 days', strtotime($first_issue))); 
      ?>

      <div style="float:left; width:740px;position:relative;font-size:13px;">
        <p style="line-height: 20px;">জনাব / জনাবা,<br>আপনি গত <span style="padding: 0 5px;font-family:SutonnyMJ;font-size:16px"><?php echo $row->left_date; ?></span> ইং তারিখ হতে অদ্যবধি পর্যন্ত  কর্তৃপক্ষের বিনা অনুমতিতে কর্মস্থলে অনুপস্থিত থাকার কারনে আপনাকে গত <?php echo "<span style='font-family:SutonnyMJ;font-size:16px'>". $first_issue ."</span>";?> ইং তারিখে পত্রের মাধ্যমে ১০ (দশ) দিনের সময় দিয়ে চাকুরীতে যোগদান সহ ব্যাখ্যা প্রদান করতে বলা হয়েছিল। কিন্তু আপনি নির্ধারিত সময়ের মধ্যে কর্মস্থলে উপস্থিত হননি এবং কোন ব্যাখ্যা প্রদান করেননি। তথাপি কর্তৃপক্ষ গত <?php echo   "<span style='font-family:SutonnyMJ;font-size:16px'>".$second_issue."</span>"?> ইং তারিখে আর একটি পত্রের মাধ্যমে আপনাকে আরো ৭ (সাত) দিনের সময় দিয়ে আত্মপক্ষ সমর্থন সহ চাকুরীতে যোগদানের জন্য পূনরায় নির্দেশ প্রদান করেন। তৎসত্ত্বেও আপনি নির্ধারিত সময়ের মধ্যে আত্মপক্ষ সমর্থন করেননি এবং চাকুরীতে যোগদান করেননি।</p>

        <p>সুতরাং বাংলাদেশ শ্রম আইন ২০০৬ ও সংশোধিত ২০১৩ এর ২৭ (৩ক) ধারা অনুযায়ী অনুপস্থিত দিন থেকে আপনি চাকুরী হতে স্বেচ্ছায় অব্যাহতি গ্রহন করেছেন বলে গণ্য করা হলো।</p>

        <p>
          অতএব, আপনার বকেয়া মজুরী ও আইনানুগ পাওনা (যদি থাকে) যে কোন কর্মদিবসে অফিস চলাকালীন সময়ে কারখানার হিসাব শাখা থেকে গ্রহন করার জন্য নির্দেশ দেয়া গেল।
        </p>
      </div>
      <div style="clear:both;width:740px;position:relative; height:15px;"></div>
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