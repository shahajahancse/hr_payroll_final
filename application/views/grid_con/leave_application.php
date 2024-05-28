<!-- < ?php dd($values)?> -->
<!doctype html>
<html lang="en">
<head>
    <title>Leave Application</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family:SutonnyMJ;
            font-size:23px;
        }
        .table-bordered td, .table-bordered th {
            border: 1px solid #000000;
            padding:2px;
        }

    </style>
</head>
<body>
    <div class="container w-75">
        <?php if ($unit_id == 1) { ?>
        <div class="d-flex flex-row justify-content-between">
            <p style="font-family: Arial, Helvetica, sans-serif;font-size:15px">Effective Date : 03.10.2020 </p>
            <p style="font-family: Arial, Helvetica, sans-serif;font-size:15px">Version # 00</p>
            <p style="font-family: Arial, Helvetica, sans-serif;font-size:15px">Document Code : AJFL/HRAC(HR)/03/009 </p>
        </div>
        <?php } else if ($unit_id == 2) { ?>
        <div class="d-flex flex-row justify-content-between">
            <p style="font-family: Arial, Helvetica, sans-serif;font-size:15px">Effective Date : 01-01-2020 </p>
            <p style="font-family: Arial, Helvetica, sans-serif;font-size:15px">Version # 00</p>
            <p style="font-family: Arial, Helvetica, sans-serif;font-size:15px">Document Code : LSAL/HR/03/091 </p>
        </div>
        <?php } else { ?>
        <div class="d-flex flex-row justify-content-between">
            <p style="font-family: Arial, Helvetica, sans-serif;font-size:15px">Effective Date : 15.01.2022 </p>
            <p style="font-family: Arial, Helvetica, sans-serif;font-size:15px">Version # 00</p>
            <p style="font-family: Arial, Helvetica, sans-serif;font-size:15px">Document Code : HGL/HRD/HR/03/009</p>
        </div>
        <?php } ?>  
        <div class="mt-3">
            <?php  $com_info = $this->db->where('unit_id', $unit_id)->get('company_infos')->row(); ?>
            <div class="d-flex">
                <img src="<?php echo base_url('/images/AJ_Logo_copy4.png')?>" alt="Logo" style="width: 60px;height: 50px;position: absolute;">
                <h3 class="text-center" style="margin:0 auto"><?= $com_info->company_name_bangla ?></h3>
            </div>
        </div>
        <div class="col-md-12" style="border-bottom: 1px solid black!important;">
            <p class="text-center h6"><?= $com_info->company_add_bangla ?></p>
        </div>
        <!-- com info -->
        <!-- <br> -->
        <div>
            <h2 class="text-center mt-2" style="border-bottom: 2px solid black;width: 200px;margin: 0 auto;">QywUi Av‡e`b cÎ</h2>
            <p class="ml-3">ZvwiLt <?php echo "<span style='font-family:SutonnyMJ;font-size:20px'> <strong> ".$apply_date." </strong></span>"?></p>
        </div>
        <?php
           $data =  $this->db->select('leave_type,leave_start,leave_end,total_leave')->where('leave_start',date('Y-m-d',strtotime($first_date)))->where('emp_id',$values['emp_info']->emp_id)->order_by('leave_end','DESC')->get('pr_leave_trans')->row();
            // dd($this->db->last_query());
        ?>
        <div class="ml-3">
            <p>eivei,</p>
            <p>e¨e¯’vcbv cwiPvjK mv‡ne/ gnve¨e¯’vcK,</p>

            <p>webxZ wb‡e`b GB ‡h, AbyM«n c~e©K <span style="border-bottom: 2px dotted black"><?php echo $reason?></span>  Kvi‡Y
                <?php $f_date = $first_date;$s_date = $second_date; echo "<span style='font-family:SutonnyMJ;font-size:20px'>".date('d/m/Y',strtotime($first_date))."</span>"?> ZvwiL nB‡Z <?php echo "<span style='font-family:SutonnyMJ;font-size:20px'>".date('d/m/Y',strtotime($second_date))."</span>"?> ZvwiL <span style="font-family:SutonnyMJ;font-size:17px">পর্যন্ত</span>  ‡gvU <?php  $date1 = new DateTime($first_date);
                $date2 = new DateTime($second_date);
                $interval = $date2->diff($date1);
                $interval->d += 1;
                            echo  "<span style='font-family:SutonnyMJ;font-size:20px'>".$interval->format('%d ')."</span>";
                    ?>  w`b Avgv‡K <?php
                    if($type == 'cl'){
                        echo '‰bwgwËK';
                    }elseif($type == 'el') {
                        echo 'AwR©Z';
                    }elseif($type == 'sl') {
                        echo 'Amy¯’Zvi';
                    }elseif($type == 'ml') {
                        echo 'cªmywZKvjxb';
                    }else{
                        echo '........................................';
                    }
                    ?>
                        QywU gÄy‡ii Rb¨ Av‡e`b Rvbvw”Q|
            </p><br>
            <p>Av‡e`b Kvixi ¯^v¶i ...................................</p>
            <br>

            <div style="line-height:10px">
                <p>Av‡e`bKvixi bvg : <span style="font-family:SutonnyMJ;font-size:17px"><?php echo $values['emp_info']->name_bn?></span></p>
                <p>‡hvM`v‡bi ZvwiL : <span style="font-family:SutonnyMJ;font-size:17px"><?php echo  "<span style='font-size:20px'>".date('d/m/Y',strtotime($values['emp_info']->emp_join_date))."</span>" ?></span></p>
                <p>KvW© bs : <?php echo "<span style='font-size:20px'>".$values['emp_info']->emp_id."</span>"?></span></p>
                <p>c`we : <span style="font-family:SutonnyMJ;font-size:17px"><?php echo $values['emp_info']->desig_bangla?></span></p>
                <p>jvBb : <span style="font-family:SutonnyMJ;font-size:17px"><?php echo $values['emp_info']->line_name_bn?></span></p>
                <p>‡mKkb : <span style="font-family:SutonnyMJ;font-size:17px"><?php echo $values['emp_info']->sec_name_bn?></span></p>
            </div>



            <br>
            <p>Awdm ‡iKW©:</p>
            <p style="font-family:SutonnyMJ;font-size:">1| ‰bwgwËK QywU ‡gvU c«vc¨ 10 w`b, ‡fvMK…Z QywU <?php echo "<span style='font-family:SutonnyMJ;font-size:20px'>".$values['leave_taken_casual']."</span>"?> w`b, Aewkó <?php echo "<span style='font-family:SutonnyMJ;font-size:20px'>".$values['leave_balance_casual']."</span>"?> w`b </p>
            <p style="font-family:SutonnyMJ;font-size:">2| Amy¯’Zv <?php echo "<span style='font-family:SutonnyMJ;font-size:20px'>".$values['leave_entitle_sick']."</span>"?> w`b, ‡fvMK…Z QywU <?php echo "<span style='font-family:SutonnyMJ;font-size:20px'>".$values['leave_taken_sick']."</span>"?> w`b, Aewkó <?php echo "<span style='font-family:SutonnyMJ;font-size:20px'>".$values['leave_balance_sick']."</span>"?> w`b </p>
            <?php

            $year = date('Y', strtotime($first_date));
            if ($this->db->table_exists('pr_earn_'.$year)) {
                $this->db->where('emp_id', $_POST['emp_id']);
                $earn_l=$this->db->get('pr_earn_'.$year)->row();
                if (!empty($earn_l)) {
                    $earn_leave = $earn_l->earn_leave;
                }else{
                    $earn_leave = 0;
                }
            }else{
                $earn_leave = 0;
            }

            $first_date = $year . "-01-01";
            $last_date = $year . "-12-31";
            $this->db->where('emp_id', $_POST['emp_id']);
            $this->db->where('leave_start >=', $first_date);
            $this->db->where('leave_end <=', $last_date);
            $leavei = $this->db->get('pr_leave_trans')->result();

            $leave_taken_earn =0;

            foreach ($leavei as $key => $value) {
            if($value->leave_type == 'el'){
                    $leave_taken_earn += $value->total_leave;
                }
            }
            $leave_ba_earn = $earn_leave - $leave_taken_earn;
            ?>

            <p>3| AwR©Z <?= $earn_leave ?> w`b, ‡fvMK…Z QywU  <?= $leave_taken_earn ?> w`b, Aewkó <?= $leave_ba_earn ?> w`b </p>
            <br>
            <br>
            <br>
            <p><span style="border-top: 1px solid black;">Awdm KZ©…K hvPvBK…Z I ¯^v¶ixZ</span> <span style="float: inline-end;border-top: 1px solid black;display:none">প্রশাসনিক কর্মকর্তার স্বাক্ষর</span></p>
            <br>

            <p class="text-justify">Av‡e`bKvix‡K  
                <?php echo "<span style='font-family:SutonnyMJ;font-size:20px'>".date('d/m/Y',strtotime($f_date))."</span>"?> ZvwiL n‡Z  
                <?php echo "<span style='font-family:SutonnyMJ;font-size:20px'>".date('d/m/Y',strtotime($s_date))."</span>"?> <span style="font-family:SutonnyMJ;font-size:17px">পর্যন্ত</span> ‡gvU 
                <?php  $date1 = new DateTime($f_date);
                            $date2 = new DateTime($s_date);
                            $interval = $date2->diff($date1);
                            $interval->d += 1;
                            echo  "<span style='font-family:SutonnyMJ;font-size:20px'>".$interval->format('%d ')."</span>";
                    ?>   w`b <?= $type == 'cl' ? '‰bwgwËK' : ($type == 'el' ? 'AwR©Z' : ($type == 'sl' ? 'Amy¯’Zvi' : ($type == 'ml' ? 'cªmywZKvjxb' : '........................................'))) ?> QywU gÄyi Kiv ‡h‡Z cv‡i|</p>
            <p>D³ mycvwik ‡gvZv‡eK QywU gÄyi Kiv nBj|</p>
        </div>
        <br>
        <br>
        <br>
        <div class="ml-3 d-flex justify-content-between">
            <p style="border-top:1px solid black">wefvMxq cªavb</p>
            <p style="border-top:1px solid black">cªkvmwbK wefvM</p>
            <p style="border-top:1px solid black">gnve¨e¯’vcK</p>
            <p style="border-top:1px solid black">cwiPvjK</p>
        </div>
    </div>
</body>
</html>
<?php exit(); ?>