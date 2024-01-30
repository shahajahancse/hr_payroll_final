<?php error_reporting(0); ?>
<!DOCTYPE html>
<html>
<head>
	<title> Letter 1</title>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
</head>
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
      <p>তারিখঃ  .........................</p>
      <p>প্রাপক,</p>
      <p>নামঃ<?php echo $row->bangla_nam; ?></p>
      <p>আইডি নংঃ <?php echo $row->emp_id; ?></p>
      <p>পদবীঃ<?php echo $row->desig_name; ?></p>
      <p>সেকশনঃ<?php echo $row->sec_name; ?></p>
      <p>বর্তমান ঠিকানাঃ</p>
      <p>ঠিকানাঃ <?php echo $row->emp_pre_add;?></p>
      <p>স্থায়ী ঠিকানাঃ</p>
      <p>পিতা/স্বামীঃ <span class="colon">:</span><?php echo $row->emp_fname; ?></p>
      <p>ঠিকানাঃ<?php echo $row->emp_par_add; ?></p>
      <div id="sub" style="width:720px;"><h5 style="text-align:left;font-size: 14px;">বিষয়ঃ বাংলাদেশ শ্রম আইন ২০০৬ ও সংশোধিত ২০১৩ এর ২৭(৩ক) ধারা মোতাবেক, ১০ দিনের অধিক অনুপস্থিতির জন্য আত্মপক্ষ সমর্থনের সুযোগ প্রদান প্রসঙ্গে।</h5></div>

      <div style="float:left; width:740px;position:relative;font-size:14px;">
        <p>জনাব / জনাবা,<br>আপনি গত <span style="padding: 0 5px;font-family:SutonnyMJ;"><?php echo date('Y-m-d',strtotime($row->left_date)); ?> </span> ইং তারিখ থেকে কারখানা কর্তৃপক্ষের বিনা অনুমতিতে কর্মস্থলে অনুপস্থিত রয়েছেন। এ প্রেক্ষিতে কারখানা কর্তৃপক্ষ আপনার স্থায়ী ও বর্তমান ঠিকানায় রেজিষ্ট্রি ডাকযোগে গত <!-- .......................... --> <span style="padding: 0 5px;font-family:SutonnyMJ;"> <?php echo date('Y-m-d',strtotime($row->left_date .' + 10 days')); ?> </span>  ইং তারিখে বিনা অনুমতিতে চাকুরীতে অনুপস্থিতির কারণ ব্যাখ্যা সহ কাজে যোগদানের জন্য পত্র প্রেরণ করেছে। কিন্তু অদ্যবধি আপনি উপরোক্ত বিষয়ে কোন ধরনের লিখিত ব্যাখ্যা প্রদান করেন নাই এবং চাকুরীতেও যোগদান করেন নাই।</p>

        <p>অতএব,  অত্র পত্র প্রাপ্তির ০৭ (সাত) দিনের মধ্যে আত্মপক্ষ সমর্থন সহ কাজে যোগদান করতে আপনাকে নির্দেশ দেয়া গেল।</p>

        <p>
        	উক্ত সময়ের মধ্যে আপনি আত্মপক্ষ সমর্থনের জবাব সহ কাজে যোগদান করতে ব্যর্থ হলে বাংলাদেশ শ্রম আইন ২০০৬ ও সংশোধিত ২০১৩ এর ২৭(৩ক) ধারা অনুযায়ী আপনি স্বেচ্ছায় চাকুরী থেকে অব্যাহতি গ্রহন করেছেন বলে গন্য হবে।
        </p>
      </div>

      <p>ধন্যবাদান্তে</p> কর্তৃপক্ষ
        <br><br>
        অনুলিপি:<br>
        ১। ব্যবস্থাপনা পরিচালক।<br>
        ২। নোটিশ বোর্ড।<br>
        ৩। ব্যক্তিগত নথি
    </div>
    <div style="page-break-after: always;"></div>
  <?php } ?>
</html>