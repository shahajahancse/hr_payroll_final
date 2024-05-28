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
        table tr td {
            font-family:sutonnyMJ;
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

        <?php  foreach($values as $row){ ?>
            <br>
            <div class="ml-3">
                <table class="table table-bordered">
                    <tr>
                        <td>নাম</td>
                        <td> <?php echo $row->name_bn?></td>
                    </tr>
                    <tr>
                        <td>কার্ড</td>
                        <td>  <?php echo $row->emp_id?></td>
                    </tr>
                    <tr>
                        <td>পদবী</td>
                        <td>  <?php echo $row->desig_bangla?></td>
                    </tr>
                
                    <tr>
                        <td>সেকশন</td>
                        <td> <?php echo $row->sec_name_bn?></td>
                    </tr>
                    <tr>
                        <td>লাইন</td>
                        <td> <?php echo $row->line_name_bn?></td>
                    </tr>
                    <tr>
                        <td>যোগদানের তারিখ</td>
                        <td style="font-size:19px;font-family:SutonnyMJ"> <?php echo $join_date = date('d-m-Y', strtotime($row->emp_join_date))?> Bs</td>
                    </tr>
                    <tr>
                        <td>শেষ কর্মদিবস</td>
                        <td style=" font-size:19px;font-family:SutonnyMJ"> <?php echo $last_day = date('d-m-Y', strtotime($row->resign_date))?> Bs</td>
                    </tr>
                    <tr>
                        <td>চাকুরীকাল</td>
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
                        <td>বেতন গ্রেড</td>
                        <td style=" font-size:19px;font-family:SutonnyMJ"> <?php echo $row->gr_str_basic?> </td>
                    </tr>
                    <tr>
                        <td>মোট বেতন</td>
                        <td style=" font-size:19px;font-family:SutonnyMJ"> <?php echo $row->gross_sal?> UvKv</td>
                    </tr>
                    <tr>
                        <td>মূল বেতন</td>
                        <td style="font-size:19px;font-family:SutonnyMJ"> <?php echo round(($row->gross_sal - 2450)/1.5)?> UvKv</td>
                    </tr>
                    <tr>
                        <td>প্রতি ঘন্টার ওভার টাইম হার</td>
                        <td style="font-size:19px;font-family:SutonnyMJ"> <?php echo $total_value->ot_rate; ?> UvKv </td>
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
                    <td><?php echo date('M, Y', strtotime($row->resign_date))?> </td>
                    <td><?php echo $total_value->working_days ?> </td>
                    <td><?php echo $rptt =  round(($row->gross_sal / date('t', strtotime($row->resign_date))), 2) ?></td>
                    <td><?php echo $ptt =  $rptt * $total_value->working_days ?></td>
                </tr>
                <tr>
                    <td>চলতি মাসের ওভার টাইম </td>
                    <?php $eot = 0; if ($type == 1) {
                        $eot = $total_value->ot_eot;
                    } elseif ($type == 2) {
                        $eot = $total_value->ot_2pm;
                    } elseif ($type == 3) {
                        $eot = $total_value->ot_eot_4pm;
                    } elseif ($type == 4) {
                        $eot = $total_value->ot_eot_12am;
                    }  elseif ($type == 5) {
                        $eot = $total_value->all_eot_woh;
                    }  ?>
                    <td><?php echo $eot; ?></td>
                    <td><?php echo $total_value->ot_rate ?> </td>
                    <td><?php echo $eot_amt = $eot * $total_value->ot_rate ?></td>
                </tr>
                <tr>
                    <td>হাজিরা বোনাস </td>
                    <td><?php echo 0 ?></td>
                    <td><?php echo 0 ?></td>
                    <td><?php echo $total_value->attn_bonus ?></td>
                </tr>
                <tr>
                    <td>চাকুরী হইতে অবসান এর নোটিশ পে বাংলাদেশ শ্রম আইন ২০০৬ এর ধারা ২৬ (১)</td>
                    <td><?php echo $total_value->resign_pay_day ?> </td>
                    <td><?php echo $total_value->per_day_rate ?></td>
                    <td><?php echo $total_value->resign_pay_day * $total_value->per_day_rate ?></td>
                </tr>
                <tr>
                    <td>অতিরিক্ত ক্ষতিপূরণ </td>
                    <td><?php echo $total_value->extra_payoff ?></td>
                    <td><?php echo $total_value->per_day_rate ?></td>
                    <td><?php echo $total_value->extra_payoff * $total_value->per_day_rate ?></td>
                </tr>
                <tr>
                    <td>জমাকৃত অর্জিত ছুটির দিন</td>
                    <td><?php echo $total_value->earn_leave ?></td>
                    <td><?php echo round(($total_value->earn_leave / 18),) ?></td>
                    <td><?php echo round(($total_value->earn_leave / 18), 2) * $total_value->service_benifit_rate;?></td>
                </tr>
                <tr>
                    <td colspan="3">সার্ভিস বেনিফিট </td>
                    <!-- <td>0</td>
                    <td>0</td> -->
                    <td><?php echo $total_value->service_benifit?></td>
                </tr>
                <tr>
                    <td colspan="3">অন্যান্য পাওনাদি</td>
                    <td ><?php echo $total_value->another_deposit ?></td>
                </tr>
                <tr>
                    <td colspan="3">মোট প্রাপ্য টাকা</td>
                    <td ><?php echo $total_value->net_pay + $total_value->attn_bonus + $eot_amt + $ptt; ?></td>
                </tr>
                <tr>
                    <td colspan="4">কর্তন</td>
                </tr>
                <tr>
                    <td>নোটিশ পিরিয়ড কম বা না দেয়ার কারনে কোম্পানীর প্রাপ্য বাবদ কর্তন (মোট মজুরি থেকে)</td>
                    <td><?php echo $total_value->notice_deduct ?></td>
                    <td><?php echo $total_value->per_day_rate ?></td>
                    <td><?php echo $total_value->notice_deduct*$total_value->per_day_rate ?></td>
                </tr>
                <tr>
                    <td>ষ্ট্যাম্প বাবদ কর্তন</td>
                    <td>০</td>
                    <td>১০.০০</td>
                    <td>১০</td>
                </tr>
                <tr>
                    <td>অনুপস্থিত বাবদ কর্তন (মূল মজুরি থেকে)</td>
                    <td><?php echo $total_value->absent ?></td>
                    <td><?php echo $total_value->per_day_rate ?></td>
                    <td><?php echo $total_value->absent*$total_value->per_day_rate ?></td>
                </tr>
                <tr>
                    <td colspan="3">অগ্রীম বেতন</td>
                    <td><?php echo $total_value->advanced_salary ?></td>
                </tr>
                <tr>
                    <td colspan="3">মোট কর্তন</td>
                    <td><?php echo $total_value->total_deduct ?></td>
                </tr>
                <tr>
                    <td colspan="3">নিট প্রাপ্য / প্রদেয় টাকা</td>
                    <td><?php echo ($total_value->net_pay + $eot_amt + $ptt) - 10; ?></td>
                </tr>
            </table>
 

            <div class="ml-3 d-flex justify-content-between">
                <p>প্রস্তুতকারী</p>
                <p>নিরিক্ষক</p>
                <p>মানব সম্পদ বিভাগ</p>
                <p>অনুমোদনকারী</p>
            </div>
            <h6 class="text-center" style="border:2px solid black;width: fit-content;margin: 0 auto;padding: 4px;">প্রাপ্তি স্বীকার</h6>

            <p class="text-justify ml-3">আমি  <span><?php echo $row->name_bn?></span>, পদবীঃ <span><?php echo $row->desig_bangla?></span>, র্কাড নম্বরঃ <span style="font-family:sutonnyMJ;font-size:19px"><?php echo $row->emp_id?></span>, সেকশন এন্ড লাইনঃ <span><?php $row->sec_name_bn.' ,'.$row->line_name_bn?></span>, চুড়ান্ত  নিষ্পত্তকিরন বাবদঃ
            <span style="font-family:sutonnyMJ;font-size:19px"><?php echo ($total_value->net_pay + $eot) - $total_value->total_deduct; ?></span> টাকা এর প্রাপ্তি স্বীকার করছি এবং এই প্রতিষ্ঠানে আমার আর কোন আর্থিক পাওনা কিংবা দাবী-দাওয়া নাই। </p>
            <p class="text-right"> স্বাক্ষরঃ</p>
        <?php }?>
    </div>
</body>
</html>





