
<!doctype html>
<html lang="en">
  <head>
    <title>Letter 3</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            box-sizing: border-box;

        }
        .table-bordered td, .table-bordered th {
            border: 1px solid #000000;
            padding:2px;
        }
        p{
            font-size:15px
        }
    </style>
</head>

<body style="font-family: SutonnyMJ">
  <?php 
    if(count($values)==0){
      echo "<h6 style='font-family:Arial;margin-left:10px'>No Record Found</h6>";exit;
    }
    foreach($values as $value){
  ?>
    <div class="container w-75">
      <?php $unit_id =$this->session->userdata('data')->unit_name; if($unit_id ==1){?>
      <div class="d-flex flex-row justify-content-between">
          <p style="font-family: Arial, Helvetica, sans-serif;">Effective Date :03.10.2020</p>
          <p style="font-family: Arial, Helvetica, sans-serif;">Version # 00</p>
          <p style="font-family: Arial, Helvetica, sans-serif;">Document Code : AJFL/HRAC(HR)/03/026</p>
      </div>
      <?php } else if($unit_id == 2){?>
      <div class="d-flex flex-row justify-content-between">
          <p style="font-family: Arial, Helvetica, sans-serif;">Effective Date :01-01-2020</p>
          <p style="font-family: Arial, Helvetica, sans-serif;">Version # 00</p>
          <p style="font-family: Arial, Helvetica, sans-serif;">Document Code : LSAL/HR/03/168</p>
      </div>
      <?php }else if($unit_id == 4){?>
      <div class="d-flex flex-row justify-content-between">
          <p style="font-family: Arial, Helvetica, sans-serif;">Effective Date : 15.01.2022</p>
          <p style="font-family: Arial, Helvetica, sans-serif;">Version # 00</p>
          <p style="font-family: Arial, Helvetica, sans-serif;">Document Code : HGL/HRD/HR/03/025</p>
      </div>
      <?php }?>
      <div class="mt-3">
          <?php  $com_info = $this->db->where('unit_id', $unit_id)->get('company_infos')->row(); ?>
          <div class="d-flex">
              <img src="<?php echo base_url('/images/AJ_Logo_copy4.png')?>" alt="Logo" style="width: 60px;height: 50px;position: absolute;">
              <h1 class="text-center" style="margin:0 auto"><?= $com_info->company_name_bangla ?></h1>
          </div>
      </div>
      <div class="col-md-12" style="border-bottom: 1px solid black!important;">
        <p class="text-center h4"><?= $com_info->company_add_bangla ?></p>
      </div>

        <?php 
          if ($no_change == 2) {
            $this->db->where('left_id', $value->left_id)->update('pr_emp_left_history', array('status' => 4));
          }
        ?>
      
      <div class="d-flex">
          <div class="col-md-6" style="font-family: SutonnyMJ;font-size:19px">m~Ît- <?php echo ($unit_id == 1) ? 'G‡RGdGj' : (($unit_id == 2) ? 'GjGmGGj' : 'GBPwRGj') ?>/ Aby <span style="font-family: SutonnyMJ;font-size:17px"><?php echo $value->id?>/<?php echo date('m/Y',strtotime($value->left_date . '+1 days'))?></span><span style="font-family: SutonnyMJ;font-size:19px">-wm</span></div>
         <div class="col-md-6 text-right">তারিখঃ <span style="font-family: SutonnyMJ;font-size:21px">
          <?php 
            // set date left date to letter one print date
            // get latter one print date
            $s1_date = strtotime($value->left_date);
            $l_date = $s1_date;
            $days_added = 0;
            while ($days_added < 11) {
                $l_date = strtotime('+1 day', $l_date);
                if (!in_array(date('N', $l_date), [5])) { // Skip Friday (5) and Saturday (6)
                  $days_added++;
                }
            }
            // dd(date('Y-m-d', $s1_date) .' = '. date('Y-m-d', $l_date));
            $l_date = gov_holiday(date('Y-m-d', $s1_date), date('Y-m-d', $l_date));
            $l_date = coff_day($l_date);
            // again check
            if (date('N', strtotime($l_date)) == 5) {
              $l_date = date("Y-m-d", strtotime("+1 days".$l_date));
            }
            if (date('N', strtotime($l_date)) == 6) {
              $l_date = date("Y-m-d", strtotime("+1 days".$l_date));
            }
          ?>

          <?php 
            // set date left date to letter one print date
            // get latter one print date
            // $l_date = strtotime($value->left_date);
            // $days_added = 0;
            // while ($days_added < 11) {
            //     $l_date = strtotime('+1 day', $l_date);
            //     if (!in_array(date('N', $l_date), [5])) { // Skip Friday (5) and Saturday (6)
            //       $days_added++;
            //     }
            // }
            // if (date('N', $l_date) == 6) {
            //   $l_date = strtotime('+1 day', $l_date); // Skip Friday (5) and Saturday (6)
            // }
            // latter one print date end
          ?>
          <!-- // latter one print date end -->

          <!-- // get latter two print date -->
          <?php 
            $s2_date = strtotime('+1 day', strtotime($l_date));
            $l2_date = $s2_date;

            $days_added = 0;
            while ($days_added < 11) {
                $l2_date = strtotime('+1 day', $l2_date);
                if (!in_array(date('N', $l2_date), [5])) { // Skip Friday (5) and Saturday (6)
                  $days_added++;
                }
            }

            $l2_date = gov_holiday(date('Y-m-d', $s2_date), date('Y-m-d', $l2_date), null);
            $l2_date = coff_day($l2_date);
            // again check
            if (date('N', strtotime($l2_date)) == 5) {
              $l2_date = date("Y-m-d", strtotime("+1 days".$l2_date)); // Skip Friday (5) and Saturday (6)
            }
            if (date('N', strtotime($l2_date)) == 6) {
              $l2_date = date("Y-m-d", strtotime("+1 days".$l2_date)); // Skip Friday (5) and Saturday (6)
            }
            // latter two print date end
          ?>


          <?php 
            // get latter three print date
            $s3_date = strtotime('+1 day', strtotime($l2_date));
            if (date('N', $s3_date) == 5) {
              $s3_date = strtotime("+1 days", $s3_date); // Skip Friday (5) and Saturday (6)
            }

            $l3_date = $s3_date;
            $days_added = 0;
            while ($days_added < 8) {
                $l3_date = strtotime('+1 day', $l3_date);
                if (!in_array(date('N', $l3_date), [5])) { // Skip Friday (5) and Saturday (6)
                  $days_added++;
                }
            }

            $l3_date = gov_holiday(date('Y-m-d', $s3_date), date('Y-m-d', $l3_date)); 
            $l3_date = coff_day($l3_date);

            // again check
            if (date('N', strtotime($l3_date)) == 5) {
              $l3_date = date("Y-m-d", strtotime("+1 days".$l3_date)); // Skip Friday (5) and Saturday (6)
            }
            if (date('N', strtotime($l3_date)) == 6) {
              $l3_date = date("Y-m-d", strtotime("+1 days".$l3_date)); // Skip Friday (5) and Saturday (6)
            }
            // latter three print date end
            echo date('d/m/Y', strtotime($l3_date));
            ?></span> ইং</div>
      </div>

      <div>
        <h3 class="text-center mt-5 unicode-to-bijoy">"রেজিষ্ট্রি ডাক যোগে প্রেরিত" তৃতীয় চিঠি</h3>
      </div>

      <div class="d-flex ml-3 mt-3">
        <div class="col-md-4 border" style="line-height: 10px;">
          <p class="mt-3 unicode-to-bijoy" style="font-size:21px"><b>অফিস বিবরনীঃ</b></p>
          <p class='unicode-to-bijoy' style="font-size:21px">নামঃ <?php echo $value->name_bn?></p>
          <p class='unicode-to-bijoy' style="font-size:21px">পদবীঃ <?php echo $value->desig_bangla?></p>
          <p class='unicode-to-bijoy' style="font-size:21px">কার্ডঃ <span style="font-family: SutonnyMJ;font-size:19px"><?php echo $value->emp_id?></span></p>
          <p class='unicode-to-bijoy' style="font-size:21px">সেকশনঃ <?php echo $value->sec_name_bn?></p>
          <p class='unicode-to-bijoy' style="font-size:21px">লাইনঃ <?php echo $value->line_name_bn?></p>
          <p class='unicode-to-bijoy' style="font-size:21px">যোগদানঃ <span style="font-family: SutonnyMJ;font-size:19px"> <?php echo date('d/m/Y',strtotime($value->emp_join_date))?></span> ইং</p>
        </div>
        <div class="col-md-4 border" style="line-height: 10px;">
          <p class="mt-3 unicode-to-bijoy" style="font-size:21px"><b>বর্তমান ঠিকানাঃ</b></p>
          <p class='unicode-to-bijoy' style="font-size:20px;line-height: 21px;">হোল্ডিং নংঃ <span style="font-family: SutonnyMJ;font-size:15px">  <?php echo $value->holding_num.', '.$value->pre_village_bn?></sapn></p>
          <!-- <p>গ্রামঃ < ?php echo $value->pre_village_bn?></p> -->
          <p class='unicode-to-bijoy' style="font-size:21px;margin-top: -6px;">ডাকঘরঃ <?php echo $value->post_bn?></p>
          <p class='unicode-to-bijoy' style="font-size:21px">থানাঃ <?php echo $value->upa_bn?></p>
          <p class='unicode-to-bijoy' style="font-size:21px">জেলাঃ <?php echo $value->dis_bn?></p>
          
        </div>
        <div class="col-md-4 border" style="line-height: 10px;">
          <p class="mt-3 unicode-to-bijoy" style="font-size:21px"><b>স্থায়ী ঠিকানাঃ</b></p>
          <p class='unicode-to-bijoy' style="font-size:21px">পিতার নামঃ <?php echo $value->father_name?></p>
          <p class='unicode-to-bijoy' style="font-size:21px">মাতার নামঃ <?php echo $value->mother_name?></p>
          <p class='unicode-to-bijoy' style="font-size:21px">গ্রামঃ <?php echo $value->per_village_bn?></p>
          <p class='unicode-to-bijoy' style="font-size:21px">ডাকঘরঃ <?php echo $value->post_name_bn?></p>
          <p class='unicode-to-bijoy' style="font-size:21px">থানাঃ <?php echo $value->upa_name_bn?></p>
          <p class='unicode-to-bijoy' style="font-size:21px">জেলাঃ <?php echo $value->dis_name_bn?></p>

        </div>
      </div>

    
      <h6 class="ml-3 mt-5" style="font-size:16px">বিষয়: বাংলাদেশ শ্রম আইন ২০০৬ এর ২৭ (৩ক) ধারা মোতাবেক শ্রমিক কর্তৃক সে¦চ্ছায় চাকুরী হইতে ইস্তফা প্রসঙ্গে।</h6>
      <div class="ml-3 mt-5">
          <span class="unicode-to-bijoy" style="font-size:21px">জনাব/জনাবা,</span><br>
          <p class="text-justify unicode-to-bijoy" style="font-size:21px"> 
          আপনি গত <b><span style="font-family: SutonnyMJ;font-size:19px"><?php echo date('d/m/Y',strtotime($value->left_date . '+1 days'))?></span></b> ইং তারিখ হতে অদ্যবদি পর্যন্ত কর্তৃপক্ষের বিনা অনুমতিতে কর্মস্থলে অনুপস্থিত থাকার কারনে আপনাকে গত
          <b><span style="font-family: SutonnyMJ;font-size:19px">
          <?php  echo date('d/m/Y', strtotime($l_date)); ?>
          </span></b> ইং তারিখে যার <b><span  style="font-family: SutonnyMJ;font-size:19px">m~Ît- 
            <?php echo ($unit_id == 1) ? 'G‡RGdGj' : (($unit_id == 2) ? 'GjGmGGj' : 'GBPwRGj') ?>/ Aby 
            <span style="font-family: SutonnyMJ;font-size:19px">
            <?php echo $value->id?>/<?php echo date('m/Y',strtotime($value->left_date))?></span>
            <span style="font-family: SutonnyMJ;font-size:19px">-G</span></span></b> এর একটি পত্রের মাধ্যেমে ১০ (দশ) দিনের সময় দিয়ে চাকুরীতে যোগদান সহ ব্যাখ্যা প্রদান করতে বলা হয়েছিল। কিন্তু আপনি নির্ধারিত সময়ের মধ্যে কর্মস্থলে উপস্থিত হননি এবং কোন ব্যাখ্যাপ্রদান করেন নি। তথাপিও কর্তৃপক্ষ গত <b>
            <span style="font-family: SutonnyMJ;font-size:19px">
          <?php 
            echo date('d/m/Y', strtotime($l2_date));
          ?>
        </span></b> ইং তারিখে যার <b><span  style="font-family: SutonnyMJ;font-size:19px">m~Ît- <?php echo ($unit_id == 1) ? 'G‡RGdGj' : (($unit_id == 2) ? 'GjGmGGj' : 'GBPwRGj') ?>/ Aby <span style="font-family: SutonnyMJ;font-size:19px"><?php echo $value->id?>/<?php echo date('m/Y',strtotime($value->left_date))?></span><span style="font-family: SutonnyMJ;font-size:19px">-we</span></span></b> এর আরও একটি পত্রর মাধ্যেমে আপনাকে আরো ০৮ (আট) কর্মদিবসের সময় দিয়ে আত্মপক্ষ সমর্থন সহ চাকুরীতে যোগদানের জন্য পূণরায় নির্দেশ প্রদান করেন। তৎসত্বেও আপনি নির্ধারিত সময়ের মধ্যে আত্নপক্ষ সামর্থন করেননি এমনকি চাকুরীতেও যোগদান করেননি। সুতরাং বাংলাদেশ শ্রম আইন ২০০৬ এর ২৭ (৩ক) ধারা অনুযায়ী অনুপস্থিত দিন থেকে আপনি স্বেচ্ছায় চাকুরী হতে ইস্তফা গ্রহন করেছেন বলে গন্য করা হলো।
          <br><br>
          অতএব আপনার বকেয়া মজুরী ও আইনানুগ পাওনা (যদি থাকে) যে কোন কর্ম দিবসে অফিস চলাকালীন সময়ে কারখানার হিসাব বিভাগ থেকে গ্রহন করার জন্য নির্দেশ দেওয়া গেল।
        </p>

        <div class="mt-5">
          <p class='unicode-to-bijoy' style="margin-bottom: 100px !important; font-size:21px">ধন্যবাদান্তে,</p>
          <p class="mt-5 unicode-to-bijoy" style="border-top:2px solid black;width:fit-content;padding-top: 5px; font-size:21px">বিভাগীয় প্রধান</p>
          <p class="unicode-to-bijoy" style="font-size:21px">এইচআর, এডমিন এন্ড Kgcøv‡qÝ</p>
           <p class="unicode-to-bijoy" style="font-size:21px"><?php echo $com_info->company_name_bangla?></p>
          <p class="mt-5 unicode-to-bijoy" style="font-size:21px">অনুলিপিঃ</p>
          <p class='unicode-to-bijoy' style='font-size:21px'>১ . কোম্পানীর সংশ্লিষ্ট বিভাগ সমূহ</p>
          <p class='unicode-to-bijoy' style='font-size:21px'>২. কারখানার নোটিশ বোর্ড</p>
          <p class='unicode-to-bijoy' style='font-size:21px'>৩. শ্রমিকের ব্যক্তিগত নথি।</p>
        </div>
      </div>
    </div>    

    <div style="page-break-after:always"></div>
  <?php }?>


    <script src="<?=base_url()?>js/unicode_to_bijoy.js" type="text/javascript"></script>
    <?php echo "<script>applyUnicodeToBijoy()</script>"?>
  </body>
</html>
<?php exit(); ?>
