<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <style>
@media print {
    @page {
        size: A4 landscape;
    }
    table {
        width: 100%;
    }
}
    </style>
<title>General Employee Report</title>
</head>
<body>
	<div class="container-fluid">
    
		<div height="85px" style="margin-top: 20px;">
			<span style="text-align:center;line-height:10px;margin-top:10px">
                <p>ফরম-৮</p>
                <p>[ধারা ৯ (১) (২) এবং বিধি ২৩ (১) দ্রষ্টব্য]</p>
                <p><b>শ্রমিক রেজিষ্টার</b></p>
				<!-- <span style="font-size:13px; font-weight:bold; text-align: center;">Section Wise All Employee List </span> -->
			</span>
		</div>
        <br><br>
        <div>
            <span  colspan="22" style="text-align:left;line-height:10px;">
                <p>কারখানা বা প্রতিষ্ঠানের নামঃ হানিওয়েল গার্মেন্টস লিমিটেড</p>
                <p>কারখানা বা প্রতিষ্ঠানের ঠিকানাঃ ৭৯৯, (পুরাতন প্লট নং- ১০১০/১০১১),আমবাগ,মৌজা বাঘিয়া, কোনাবাড়ী, গাজীপুর -১৭০০</p>
                <p>শ্রমিকের শ্রেনী বিভাগঃ স্থায়ী</p>
            </span>
        </div>
	<table  border="1" cellspacing="0" cellpadding="2" style="font-size:12px;">
		<th class="text-center">ক্রমিক<br>নং</th>
		<th class="text-center">শ্রমিক<br>রেজিস্টার<br>ক্রমিক<br>নং</th>
		<th class="text-center">শ্রমিকের নাম<br> ও <br>এন আই ডি নং</th>
		<th class="text-center">পিতার<br>নাম</th>
		<th class="text-center">মাতার<br>নাম </th>
		<th class="text-center">লিঙ্গ<br>জন্ম তারিখ<br>ও<br>বয়স</th>
		<th class="text-center">স্থায়ী<br>ঠিকানা </th>
		<th class="text-center">নিয়োগের<br>তারিখ</th>
		<th class="text-center">পদবী<br>ও<br>গ্রেড </th>
		<th class="text-center">কার্ড নং</th>
		<th class="text-center">পাওনা ছুটি</th>
		<th class="text-center">কর্ম সময়</th>
		<th class="text-center"> বিরতির সময়</th>
		<th class="text-center">সাপ্তাহিক<br>ছুটির<br>দিন</th>
		<th class="text-center">গ্রুপের নাম</th>
		<th class="text-center">পালাওরিলে</th>
		<th class="text-center">গ্রুপে<br>বদলির<br>বিবরণ</th>
		<th class="text-center">মন্তব্য</th>
		<?php ; $i= 1;foreach($values as $row){?>
		<tr>
			<td class="text-center"><?php echo "<span style='font-family:SutonnyMJ;font-size:18px'>".$i++."</span>"?></td>
			<td class="text-center"><?php echo "<span style='font-family:SutonnyMJ;font-size:18px'>".$row->id."</span>"?></td>
			<td class="text-center"><?php echo $row->name_bn .'<br>'.$row->nid_dob_id?></td> 
			<td class="text-center"><?php echo $row->father_name?></td>
			<td class="text-center"><?php echo $row->mother_name?></td>
			<td class="text-center">
                <?php 
                    echo $row->gender == 'Male' ? 'পুরুষ' : 'নারী'.' ,';echo '<br>'."<span style='font-family:SutonnyMJ;font-size:16px'>".date('d/m/Y',strtotime($row->emp_dob))."</span>";$currentDate = new DateTime();
                    $employeeDob = new DateTime($row->emp_dob);
                    $diff = $currentDate->diff($employeeDob);
                    echo '<br>'."<span style='font-family:SutonnyMJ;'>".$diff->format(' <span style = "font-size:16px">%y</span> বছর <span style = "font-size:16px">%m</span> মাস <span style = "font-size:16px">%d</span> দিন')."</span>";
                ?>
            </td>
			<td class="text-center" style="width: 150px;"><?php echo $row->per_village.','.$row->per_post_name_bn.','.$row->per_upa_name_bn.','.$row->per_dis_name_bn ?></td>
			<td class="text-center" style="white-space:nowrap"><?php echo "<span style='font-family:SutonnyMJ;font-size:16px'>".date('d/m/Y',strtotime($row->emp_join_date))."</span>"?></td>
			<td class="text-center" style="width: 80px;"><?php echo $row->desig_bangla.'<br>'.$row->emp_sal_gra_id?></td>
			<td class="text-center"><?php echo $row->emp_id?></td>
			<td class="text-center"><?php echo ''?></td>
			<td class="text-center"><?php echo 'সকাল ০৮ হইতে <br> বিকাল ০৫ টা <br> পর্যন্ত'?></td>
			<td class="text-center"><?php echo 'দুপুর ০১ হইতে <br>০২ টা <br> পর্যন্ত'?></td>  
			<td class="text-center"><?php echo 'শুক্রবার'?></td>
			<td class="text-center"><?php echo ''?></td>
			<td class="text-center"></td>
			<td class="text-center"></td>
			<td class="text-center"></td>
		</tr>
		<?php }?>
	</table>
	</div>
	<div style="page-break-after: always;"></div>
</body>
</html>