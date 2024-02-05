<!doctype html>
<html lang="en">

<head>
    <title>Line Change Letter</title>
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
    </style>
</head>

<body>
   <?php foreach($values as $row){?>
    <div class="container w-75">
        <div class="d-flex flex-row justify-content-between">
            <p style="font-family: Arial, Helvetica, sans-serif;">Effective Date : 15.01.2022</p>
            <p style="font-family: Arial, Helvetica, sans-serif;">Version # 00</p>
            <p style="font-family: Arial, Helvetica, sans-serif;">Document Code : HGL/HRD/HR/03/008</p>
        </div>
        <div class="d-flex">
            <div class="col-md-2">
                <?php $image = $this->db->select('company_logo')->get('company_infos')->row()->company_logo?>
                <img src="<?php echo base_url('/images'.'/'.$image)?>" alt="Logo" style="max-width: 50%;">
            </div>
            <div class="col-md-12">
                <h1 class="text-center" style="margin-left: -420px;">হানিওয়েল গার্মেন্টস লিমিটেড</h1>
            </div>
        </div>
        <div class="col-md-12" style="border-bottom: 1px solid black!important;">
            <p class="text-center h5">৭৯৯, (পুরাতন প্লট নং- ১০১০/১০১১), আমবাগ, মৌজা বাঘিয়া, কোনাবাড়ী, গাজীপুর-১৭০০।</p>
        </div>
        <div class="d-flex">
            <div class="col-md-6">সূত্রঃ- এইচজিএল/অনু ১৫৯১/১/২০২৪-এ</div>
            <div class="col-md-6 text-right">তারিখঃ ২৫/০১/২০২৪</div>
        </div>

        <div>
            <h5 class="text-center" style="border-bottom: 2px solid black;width: 124px;margin: 0 auto;">অবগতি পত্র</h5>
        </div>

        <div class="ml-3" style="line-height: 10px;">
            <p class="mt-3">প্রতি,</p>
            <p>নামঃ <?php echo $row->name_bn?></p>
            <p>পদবীঃ <?php echo $row->new_desig_name?></p>
            <p>কার্ডঃ <?php echo $row->emp_id?></p>
            <p>সেকশনঃ <?php echo $row->new_sec_name?></p>
            <p>লাইনঃ <?php echo $row->new_line_name?></p>
            <p>যোগদানঃ <span style="font-family:SutonnyMJ;font-size:19px"><?php echo date('d/m/Y',strtotime($row->emp_join_date))?></span> ইং</p>           
        </div>
        <br>
        <h6 class="ml-3"><b>বিষয়: লাইন পরিবর্তন প্রসঙ্গে।</b></h6><br>
        <div class="ml-3">
            <p class="text-justify">
                <span>জনাব/জনাবা,</span><br>
                আপনার অবগতির জন্য জানানো যাচ্ছে যে, কোম্পানী কর্তৃপক্ষ কারখানার কাজের সুবিধার্থে এবং আপনার সর্ব সম্মতিক্রমে আপনাকে <b>সুইং
                সেকশন</b> এর  <b>সাধাঃ অপারেটর </b> থেকে <b>লাইন ৪ </b> এ পরিবর্তন করার সিদ্ধান্ত গ্রহন করা হল। যা আগামী <b>০১/১১/২০২৩</b> ইং তারিখ হতে কার্যকর করা
                হবে। আপনার যাবতীয় বেতন, ভাতা ও অন্যান্য পাওনাদি পূর্বের ন্যায় বহাল থাকবে।<br>
                অতএব, কোম্পানী কর্তৃপক্ষ আশা করছে যে, আপনি আপনার বর্তমান সেকশনের নির্ধারিত লাইনে আপনার উপর অর্পিত দায়িত্ব ও কর্তৃব্য
                পালনে আরও সচেতন হবেন এবং কোম্পানীর উত্তোরত্তর সমৃদ্ধিতে আরও সহায়ক ভূমিকা রাখবেন।
            </p>


            <div style="line-height: 10px;">
                <p style="margin-bottom: 117px !important;">ধন্যবাদান্তে,</p>
                <hr style="border: 1px solid black; width: 340px;float:left;display: block;"><br>
                <br><br>
                <p class="mt-2">বিভাগীয় প্রধান (এইচআর, এডমিন এন্ড কমপ্লায়েন্স)</p>
                <p>হানিওয়েল গার্মেন্টস লিমিটেড।</p>
                <p class="mt-5">অনুলিপিঃ</p>
                <p>১। গ্রুপ জেনারেল ম্যানেজার (এইচআর, এডমিন এন্ড কমপ্লায়েন্স)</p>
                <p>২। জেনারেল ম্যানেজার (প্রজেক্ট হেড)</p>
                <p>৩। বিভাগীয় প্রধান</p>
                <p>৪। ব্যক্তিগত নথি</p>
                <p class="text-justify">প্রাপ্তি স্বীকারঃ আমি এই পত্রের সকল বিষয় সমূহ পড়ে, বুঝে এবং মেনে নিয়ে স্ব-জ্ঞানে নিম্নে এর অনুলিপিতে স্বাক্ষর করে ১ (এক) কপি<br><br>গ্রহন করি।</p>
                <p class="text-right mt-5">গ্রহনকারীর স্বাক্ষর.......................................</p>
            </div>
        </div>
    </div>
    <?php }?>
</body>
</html>