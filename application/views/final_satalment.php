<!doctype html>
<html lang="en">
<head>
    <title>Final Satalment</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            /* font-family: SutonnyMJ; */
        }
        .table-bordered td, .table-bordered th {
            border: 1px solid #000000;
            padding:2px;
        }
    </style>
</head>

<body>
        <!-- < ?php dd($values)?> -->
    <div class="container w-75">
        <div class="d-flex flex-row justify-content-between">
            <p style="font-family: Arial, Helvetica, sans-serif;">Effective Date : 15.01.2022</p>
            <p style="font-family: Arial, Helvetica, sans-serif;">Version # 00</p>
            <p style="font-family: Arial, Helvetica, sans-serif;">Document Code : HGL/HRD/HR/03/008</p>
        </div>
        <div class="d-flex">
            <div class="col-md-2">
                <img src="<?php $image =  $this->db->select('company_logo')->get('company_infos')->row('company_logo');
                                echo base_url('/images'.'/'.$image)?>" alt="Logo" style="max-width: 50%;">
            </div>
            <div class="col-md-12">
                <h2 class="text-center" style="margin-left: -420px;">হানিওয়েল গার্মেন্টস লিমিটেড</h2>
            </div>
        </div>
        <div class="col-md-12" style="border-bottom: 1px solid black!important;">
            <p class="text-center h5">৭৯৯, (পুরাতন প্লট নং- ১০১০/১০১১), আমবাগ, মৌজা বাঘিয়া, কোনাবাড়ী, গাজীপুর-১৭০০।</p>
        </div>
        <div class="d-flex">
        </div>
        <br>
        <div>
            <h5 class="text-center" style="border-bottom: 2px solid black;width: 300px;margin: 0 auto;">চুড়ান্ত (হিসাব) নিস্পত্তি প্রতিবেদন</h5>
        </div>

        <?php foreach($values as $row){?>
            <div class="ml-3">
                <table>
                    <tr>
                        <td class="mt-3">প্রতি,</td>
                    </tr>
                    <tr>
                        <td>নাম</td>
                        <td>:</td>
                        <td> <?php echo $row->name_bn?></td>
                    </tr>
                    <tr>
                        <td>কার্ড</td>
                        <td>:</td>
                        <td>  <?php echo $row->emp_id?></td>
                    </tr>
                    <tr>
                        <td>পদবী</td>
                        <td>:</td>
                        <td>  <?php echo $row->desig_bangla?></td>
                    </tr>
                
                    <tr>
                        <td>সেকশন</td>
                        <td>:</td>
                        <td> <?php echo $row->sec_name_bn?></td>
                    </tr>
                    <tr>
                        <td>লাইন</td>
                        <td>:</td>
                        <td> <?php echo $row->line_name_bn?></td>
                    </tr>
                    <tr>
                        <td>যোগদানের তারিখ</td>
                        <td>:</td>
                        <td style="font-size:19px;font-family:SutonnyMJ"> <?php echo $join_date = date('d-m-Y', strtotime($row->emp_join_date))?> Bs</td>
                    </tr>
                    <?php $last_day = $this->db->select('left_date')->where('emp_id',$row->emp_id)->get('pr_emp_left_history')->row('left_date')?>
                    <tr>
                        <td>শেষ কর্মদিবস</td>
                        <td>:</td>
                        <td style=" font-size:19px;font-family:SutonnyMJ"> <?php echo $last_day= date('d-m-Y', strtotime('-1 day'.$last_day))?> Bs</td>
                    </tr>
                    <tr>
                        <td>চাকুরীকাল</td>
                        <td>:</td>
                        <td>
                        <?php 
                            $date1 = new DateTime($join_date);
                            $date2 = new DateTime($last_day);
                            $interval = $date1->diff($date2);
                            echo $interval->format('<span style="font-size:19px;font-family:SutonnyMJ"> %y eQi %m gvm %d w`b</span>');
                        ?>
                        </td>
                    </tr>
                    <tr>
                        <td>মোট বেতন</td>
                        <td>:</td>
                        <td style=" font-size:19px;font-family:SutonnyMJ"> <?php echo $row->gross_sal?> UvKv</td>
                    </tr>
                    <tr>
                        <td>মূল বেতন</td>
                        <td>:</td>
                        <td style="font-size:19px;font-family:SutonnyMJ"> <?php echo ($row->gross_sal -2450)?> UvKv</td>
                    </tr>
                    <tr>
                        <td>প্রতি ঘন্টার ওভার টাইম হার</td>
                        <td>:</td>
                        <td style="font-size:19px;font-family:SutonnyMJ"> <?php echo round($row->gross_sal * 2  / 208,2) ?>UvKv </td>
                    </tr>
                </table>
            </div>
            <br>
            <h6 class="text-center"><b>প্রাপ্য বিষয়াদির হিসাব</b></h6>
            <table class="table table-bordered ml-3 ">
                <tr>
                    <th>বিষয় </th>
                    <th>দিন/ ঘন্টা </th>
                    <th>হার </th>
                    <th>টাকা</th>
                </tr>
                <tr>
                    <td>ডিসেম্বর - ২০২৪/</td>
                    <td>১৩  </td>
                    <td>৬৭৪.৪৫  </td>
                    <td>৮৭৬৮</td>
                </tr>
                <tr>
                    <td>চলতি মাসের ওভার টাইম  </td>
                    <td>১৮  </td>
                    <td>১১৮.৩২  </td>
                    <td>২১৩০</td>
                </tr>
                <tr>
                    <td>হাজিরা বোনাস </td>
                    <td>০</td>
                    <td>০.০</td>
                    <td>০</td>
                </tr>
                <tr>
                    <td>চাকুরী হইতে অবসান এর নোটিশ পে বাংলাদেশ শ্রম আইন ২০০৬ এর ধারা ২৬ (১)</td>
                    <td>০</td>
                    <td>৪১০.১৮</td>
                    <td>০</td>
                </tr>
                <tr>
                    <td>অতিরিক্ত ক্ষতিপূরণ </td>
                    <td>০ </td>
                    <td>৪১০.১৮ </td>
                    <td>০</td>
                </tr>
                <tr>
                    <td>জমাকৃত অর্জিত ছুটির দিন ( ৫৬৩) উপস্থিতি</td>
                    <td>৩১.২৮</td>
                    <td>৬৯৬.৯৩</td>
                    <td>২১৭৯৯</td>
                </tr>
                <tr>
                    <td>সার্ভিস বেনিফিট   </td>
                    <td>০   </td>
                    <td>৪১০.১৮</td>
                    <td>০</td>
                </tr>
                <tr>
                    <td colspan="3">অন্যান্য পাওনাদি</td>
                    <td >০</td>
                </tr>
                <tr>
                    <td colspan="3">মোট প্রাপ্য টাকা</td>
                    <td >৩২৬৯৯</td>
                </tr>
                <tr>
                    <td colspan="4">কর্তন</td>
                </tr>
                <tr>
                    <td>নোটিশ পিরিয়ড কম বা না দেয়ার কারনে কোম্পানীর প্রাপ্য বাবদ কর্তন (মোট মজুরি থেকে)</td>
                    <td>০</td>
                    <td>৪১০.১৮</td>
                    <td>০</td>
                </tr>
                <tr>
                    <td>ষ্ট্যাম্প বাবদ কর্তন</td>
                    <td>০</td>
                    <td>১০.১০</td>
                    <td>১০</td>
                </tr>
                <tr>
                    <td>অনুপস্থিত বাবদ কর্তন (মূল মজুরি থেকে)</td>
                    <td>০</td>
                    <td>৪১০.১৮</td>
                    <td>১০</td>
                </tr>
                <tr>
                    <td colspan="3">অগ্রীম বেতন</td>
                    <td>০</td>
                </tr>
                <tr>
                    <td colspan="3">মোট কর্তন</td>
                    <td>১০</td>
                </tr>
                <tr>
                    <td colspan="3">নিট প্রাপ্য / প্রদেয় টাকা</td>
                    <td>৩২৮৬৮</td>
                </tr>
            </table>
        <?php }?>

        <div class="ml-3 d-flex justify-content-between">
            <p>প্রস্তুতকারী</p>
            <p>নিরিক্ষক</p>
            <p>মানব সম্পদ বিভাগ</p>
            <p>অনুমোদনকারী</p>
        </div>
        <h6 class="text-center" style="border:2px solid black;width: fit-content;margin: 0 auto;padding: 4px;">প্রাপ্তি স্বীকার</h6>

        <p class="text-justify ml-3">আমি মোঃ <span>আবদুর রাজ্জাক</span> পদবীঃ <span>কাটার ম্যান</span> র্কাড নম্বরঃ <span>৫০০০১৭৫</span> সকেশন এন্ড লাইনঃ <span>কাটিং, কাটিং</span>, চুড়ান্ত  নিষ্পত্তকিরন বাবদঃ
        <span>৩২৬৮৬</span> টাকা এর প্রাপ্তি স্বীকার করছি এবং এই প্রতিষ্ঠানে আমার আর কোন আর্থিক পাওনা কিংবা দাবী-দাওয়া নাই।
        </p>
        <p class="text-right"> স্বাক্ষরঃ</p>
    </div>
</body>
</html>