<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
<style>

/* ===========================
   GLOBAL COMPACT TABLE STYLE
   =========================== */

table {
    width: 100%;
    border-collapse: collapse;
    font-size: 14px;
}

/* Remove padding + margin everywhere */
th, td {
    border: 1px solid #000;
    padding: 0 !important;
    margin: 0 !important;
    vertical-align: middle;
    line-height: 1 !important;
}

/* Reduce <p>, <li>, <ul> spacing */
p, ul, li {
    margin: 0 !important;
    padding: 0 !important;
    line-height: 1.1 !important;
}

/* Make UL bullet alignment clean */
ul {
    padding-left: 10px !important;
}

/* =====================================
   FORCE SMALL ROW HEIGHT (VERY COMPACT)
   ===================================== */
tr {
    height: 26px !important;   /* CHANGE THIS VALUE if needed */
}

/* Prevent normal columns from auto-expanding height */
td p {
    white-space: nowrap !important;
}

/* Rotated columns MUST allow wrapping */
td[style*="writing-mode"] p,
th[style*="writing-mode"] p {
    white-space: normal !important;
}

/* ===========================
   PRINT RULES
   =========================== */
@media print {

    @page {
        size: legal landscape;
        margin: 5px;
    }

    table {
        font-size: 14px;
    }

    th, td {
        border: 1px solid #000;
        padding: 0 !important;
        margin: 0 !important;
        vertical-align: middle;
        line-height: 1 !important;
    }

    tr {
        height: 26px !important;
        page-break-inside: avoid;
    }

    p, ul, li {
        margin: 0 !important;
        padding: 0 !important;
        line-height: 1.1 !important;
    }

    td p {
        white-space: normal !important;
    }

    td[style*="writing-mode"] p,
    th[style*="writing-mode"] p {
        white-space: normal !important;
    }

    .unicode-to-bijoy {
        font-size: 14px;
    }
}

</style>

<title>General Employee Report</title>
</head>
<body>
<div class="container-fluid">

    <div style="margin-top: 20px; text-align:center; line-height:10px;">
        <p class="unicode-to-bijoy" style="font-size:18px;font-weight:bold">ফরম-৮</p>
        <p class="unicode-to-bijoy" style="font-size:18px">[ধারা ৯ (১) (২) এবং বিধি ২৩ (১) দ্রষ্টব্য]</p>
        <p class="unicode-to-bijoy" style="font-size:18px"><b>শ্রমিক রেজিষ্টার</b></p>
    </div>
    <br>

    <?php 
    $unit_id = $this->session->userdata['data']->unit_name;
    $com_info = $this->db->select('*')->where('unit_id',$unit_id)->get('company_infos')->row();
    ?>

    <div>
        <p class="unicode-to-bijoy" style="font-size:18px">কারখানা বা প্রতিষ্ঠানের নামঃ <?php echo $com_info->company_name_bangla?></p>
        <p class="unicode-to-bijoy" style="font-size:18px">কারখানা বা প্রতিষ্ঠানের ঠিকানাঃ <?php echo $com_info->company_add_bangla?></p>
        <p class="unicode-to-bijoy" style="font-size:18px">শ্রমিকের শ্রেনী বিভাগঃ স্থায়ী</p>
    </div>
    <br>
    <?php
    $rowsPerPage = 5;
    $i = 1;

    function print_table_header() {
        echo '<table border="1" cellspacing="0" cellpadding="2" style="font-size:14px; width:100%">
            <tr>
                <th class="text-center unicode-to-bijoy">ক্রমিক নং</th>
                <th class="text-center unicode-to-bijoy">শ্রমিকের রেজিস্টার নং</th>
                <th class="text-center unicode-to-bijoy">শ্রমিকের নাম ও এন আই ডি নং/জন্মনিবন্ধন নং</th>
                <th class="text-center unicode-to-bijoy" style="writing-mode: sideways-lr;padding:10px 4px !important">পিতার নাম</th>
                <th class="text-center unicode-to-bijoy" style="writing-mode: sideways-lr;padding:10px 4px !important">মাতার নাম</th>
                <th class="text-center unicode-to-bijoy">লিঙ্গ জন্ম তারিখ ও বয়স</th>
                <th class="text-center unicode-to-bijoy">স্থায়ী ঠিকানা</th>
                <th class="text-center unicode-to-bijoy">নিয়োগের তারিখ</th>
                <th class="text-center unicode-to-bijoy">পদবী ও গ্রেড</th>
                <th class="text-center unicode-to-bijoy">কার্ড নং</th>
                <th class="text-center unicode-to-bijoy" style="font-family:SUtonnyMJ;font-size:17px">পাওনা ছুটি</th>
                <th class="text-center unicode-to-bijoy" style="writing-mode: sideways-lr;padding:10px 0px !important">কর্ম সময়</th>
                <th class="text-center unicode-to-bijoy" style="writing-mode: sideways-lr;padding:10px 0px !important">বিরতির সময়</th>
                <th class="text-center unicode-to-bijoy" style="writing-mode: sideways-lr;padding:10px 0px !important">সাপ্তাহিক ছুটির দিন</th>
                <th class="text-center unicode-to-bijoy" style="writing-mode: sideways-lr;padding:10px 0px !important">গ্রুপের নাম</th>
                <th class="text-center unicode-to-bijoy" style="writing-mode: sideways-lr;padding:10px 0px !important">গ্রুপ বদলির বিবরণ</th>
                <th class="text-center unicode-to-bijoy" style="writing-mode: sideways-lr;padding:10px 0px !important">gšÍe¨</th>
            </tr>
			<tr>
            <th class="unicode-to-bijoy" style="font-size:14px;text-align:center">1</th>
            <th class="unicode-to-bijoy" style="font-size:14px;text-align:center">2</th>
            <th class="unicode-to-bijoy" style="font-size:14px;text-align:center">3</th>
            <th class="unicode-to-bijoy" style="font-size:14px;text-align:center">4</th>
            <th class="unicode-to-bijoy" style="font-size:14px;text-align:center">5</th>
            <th class="unicode-to-bijoy" style="font-size:14px;text-align:center">6</th>
            <th class="unicode-to-bijoy" style="font-size:14px;text-align:center">7</th>
            <th class="unicode-to-bijoy" style="font-size:14px;text-align:center">8</th>
            <th class="unicode-to-bijoy" style="font-size:14px;text-align:center">9</th>
            <th class="unicode-to-bijoy" style="font-size:14px;text-align:center">10</th>
            <th class="unicode-to-bijoy" style="font-size:14px;text-align:center">11</th>
            <th class="unicode-to-bijoy" style="font-size:14px;text-align:center">12</th>
            <th class="unicode-to-bijoy" style="font-size:14px;text-align:center">13</th>
            <th class="unicode-to-bijoy" style="font-size:14px;text-align:center;padding:0px 10px !important">14</th>
            <th class="unicode-to-bijoy" style="font-size:14px;text-align:center;padding:0px 10px !important">15</th>
            <th class="unicode-to-bijoy" style="font-size:14px;text-align:center;padding:0px 10px !important">16</th>
            <th class="unicode-to-bijoy" style="font-size:14px;text-align:center;padding:0px 10px !important">17</th>
        </tr>'
			;
    }

    print_table_header();

    foreach($values as $row){
        if(($i-1) % $rowsPerPage == 0 && $i != 1){
            echo '</table><div style="page-break-after: always;"></div>';
            print_table_header();
        }
    ?>
        <tr>
            <td class="text-center"><span style='font-family:SutonnyMJ;font-size:18px;padding:10px 4px !important'><?php echo $i++?></span></td>
            <td class="text-center"> <span style='font-family:SutonnyMJ;font-size:18px'><?php echo $row->id?></span></td>
            <td class="text-center" style="line-height:0px">
                <p class="unicode-to-bijoy" style="font-size:16px"><?php echo $row->name_bn; ?></p>
                <p class="unicode-to-bijoy" style="font-size:16px"><?php echo ($row->nid_dob_check == 1 ? 'এন আইডি নংঃ ' : 'জন্মনিবন্ধনঃ '); ?></p>
                <p style="font-family:SutonnyMJ; font-size:16px"><?php echo $row->nid_dob_id; ?></p>
            </td>
            <td class=" unicode-to-bijoy" style='writing-mode: sideways-lr;padding:10px 4px !important'><?php echo $row->father_name?></td>
            <td class=" unicode-to-bijoy" style='writing-mode: sideways-lr;padding:10px 4px !important'><?php echo $row->mother_name?></td>
            <td class="text-center" style="line-height:1.2;">
                <p class="unicode-to-bijoy"><?php echo $row->gender == 'Male' ? 'পুরুষ' : 'নারী';?></p>
                <p style='font-family:SutonnyMJ;font-size:14px'><?= date('d/m/Y',strtotime($row->emp_dob)) ?></p>
                <p class="unicode-to-bijoy"><?php
                    $currentDate = new DateTime();
                    $employeeDob = new DateTime($row->emp_dob);
                    $diff = $currentDate->diff($employeeDob);
                    echo $diff->format('%y বছর %m মাস %d দিন');
                ?></p>
            </td>
            <td class=" unicode-to-bijoy text-center" style="line-height:1.2;">
                <?php echo 'গ্রামঃ '.$row->per_village_bn.', পোস্ট অফিসঃ '.$row->per_post_name_bn.', উপজেলাঃ '.$row->per_upa_name_bn.', জেলাঃ '.$row->per_dis_name_bn ?>
            </td>
            <td class="text-center"><span style='font-family:SutonnyMJ;font-size:14px'><?php echo date('d/m/Y',strtotime($row->emp_join_date))?></span></td>
            <td class="text-center unicode-to-bijoy" style="width: 80px;"><?php echo $row->desig_bangla.' '. ($row->gr_name == "None" ? '' : ', '.$row->gr_name);?></td>
            <td class="text-center unicode-to-bijoy" style="padding:10px 4px !important"><?php echo $row->emp_id?></td>
            <td>
                <ul style="list-style-type: none; padding-left:0; line-height:1.1;">
                    <li class="unicode-to-bijoy">বাৎসরিক = ১২</li>
                    <li class="unicode-to-bijoy">নৈমিত্তিক = ১০</li>
                    <li class="unicode-to-bijoy">পীড়া = ১৪</li>
                    <li class="unicode-to-bijoy">অর্জিত ছুটি = ( প্রতি ১৮ কর্ম দিবসের জন্য ১ দিন ) </li>
                </ul>
            </td>
            <td class="text-center unicode-to-bijoy" style=''>
                <p>সকাল ০৮ ঘটিকা</p>
                <p>হইতে বিকাল ০৫ ঘটিকা</p>
            </td>
            <td class="text-center unicode-to-bijoy" style=''>
                <p>দুপুর ০১ ঘটিকা</p>
                <p>হইতে ০২ ঘটিকা</p>
            </td>
            <td class=" unicode-to-bijoy" style='writing-mode: sideways-lr;padding:0px 0px 28px 0px !important'>শুক্রবার</td>
            <td class="text-center"></td>
            <td class="text-center"></td>
            <td class="text-center"></td>
        </tr>
    <?php } ?>
    </table>
</div>

<div style="page-break-after: always;"></div>
<script src="<?=base_url()?>js/unicode_to_bijoy.js" type="text/javascript"></script>
<script>applyUnicodeToBijoy()</script>
</body>
</html>
<?php exit(); ?>
