<!-- < ?php dd($values)?> -->
<!doctype html>
<html lang="en">
<head>
    <title>Increment Letter</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family:SutonnyMJ;
            font-size:20px;
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
            <p style="font-family: Arial, Helvetica, sans-serif;">Effective Date : 03.10.2020 </p>
            <p style="font-family: Arial, Helvetica, sans-serif;">Version # 00</p>
            <p style="font-family: Arial, Helvetica, sans-serif;">Document Code : AJFL/HRAC(HR)/03/009 </p>
        </div>
        <?php } else if ($unit_id == 2) { ?>
        <div class="d-flex flex-row justify-content-between">
            <p style="font-family: Arial, Helvetica, sans-serif;">Effective Date : 01-01-2020 </p>
            <p style="font-family: Arial, Helvetica, sans-serif;">Version # 00</p>
            <p style="font-family: Arial, Helvetica, sans-serif;">Document Code : LSAL/HR/03/091 </p>
        </div>
        <?php } else { ?>
        <div class="d-flex flex-row justify-content-between">
            <p style="font-family: Arial, Helvetica, sans-serif;">Effective Date : 15.01.2022 </p>
            <p style="font-family: Arial, Helvetica, sans-serif;">Version # 00</p>
            <p style="font-family: Arial, Helvetica, sans-serif;">Document Code : HGL/HRD/HR/03/009</p>
        </div>
        <?php } ?>  
        <div class="d-flex justify-content-between">
             <div class="col-md-2">
                <img src="<?php echo base_url('/images/AJ_Logo_copy4.png')?>" alt="Logo" style="max-width: 40%;">
             </div>
          <div class="col-md-10 text-center">
              <?php  $com_info = $this->db->where('unit_id', $unit_id)->get('company_infos')->row(); ?>
              <h3><?= $com_info->company_name_bangla ?></h3>
          <?php  $com_info = $this->db->where('unit_id', $unit_id)->get('company_infos')->row(); ?>
             </div>
         </div>
        <div class="col-md-12" style="border-bottom: 1px solid black!important;">
            <p class="text-center h5"><?= $com_info->company_add_bangla ?></p>
        </div>
        <!-- <br> -->
        <div>
            <h3 class="text-center" style="border-bottom: 2px solid black;width: 200px;margin: 0 auto;">QywUi Av‡e`b cÎ</h3>
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
                    <?php echo "<span style='font-family:SutonnyMJ;font-size:20px'>".date('d/m/Y',strtotime($first_date))."</span>"?> ZvwiL nB‡Z <?php echo "<span style='font-family:SutonnyMJ;font-size:20px'>".date('d/m/Y',strtotime($second_date))."</span>"?> ZvwiL পর্যন্ত  ‡gvU <?php  $date1 = new DateTime($first_date);
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
                            echo 'gvZ…Z¡ RwbZ';
                        }else{
                            echo '........................................';
                        }
                        ?>
                         QywU gÄy‡ii Rb¨ Av‡e`b Rvbvw”Q|
                </p><br>
                <p>Av‡e`b Kvixi ¯^v¶i .............................................................................</p>
                <br>

                <div style="line-height:10px">
                    <p>Av‡e`bKvixi bvg : <?php echo $values['emp_info']->name_bn?></p>
                    <p>‡hvM`v‡bi ZvwiL : <?php echo  "<span style='font-size:20px'>".date('d/m/Y',strtotime($values['emp_info']->emp_join_date))."</span>" ?></p>
                    <p>KvW© bs : <?php echo "<span style='font-size:20px'>".$values['emp_info']->emp_id."</span>"?></p>
                    <p>c`we : <?php echo $values['emp_info']->desig_bangla?></p>
                    <p>‡mKkb/jvBb : <?php echo $values['emp_info']->line_name_bn?></p>
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
                <br>
                <p><span style="border-top: 1px solid black;">Awdm KZ©…K hvPvBK…Z I ¯^v¶ixZ</span> <span style="float: inline-end;border-top: 1px solid black;display:none">প্রশাসনিক কর্মকর্তার স্বাক্ষর</span></p>
               <br>
               <br>
               <br>
                <p class="text-justify">Av‡e`bKvix‡K  <?php echo "<span style='font-family:SutonnyMJ;font-size:20px'>".date('d/m/Y',strtotime($first_date))."</span>"?> ZvwiL n‡Z  <?php echo "<span style='font-family:SutonnyMJ;font-size:20px'>".date('d/m/Y',strtotime($second_date))."</span>"?> পর্যন্ত ‡gvU <?php  $date1 = new DateTime($first_date);
                                $date2 = new DateTime($second_date);
                                $interval = $date2->diff($date1);
                                $interval->d += 1;
                                echo  "<span style='font-family:SutonnyMJ;font-size:20px'>".$interval->format('%d ')."</span>";
                        ?>   w`b  <?php echo $type == 'cl' ? ' ‰bwgwËK': 'অসুস্থতা' ?> QywU gÄyi Kiv ‡h‡Z cv‡i|</p>
                <p>D³ mycvwik ‡gvZv‡eK QywU <span style="font-size:23px ; font-family:SutonnyMJ">gÄyi</span> Kiv nBj|</p>
            </div>
            <br>
            <br>
            <br>
            <div class="ml-3 d-flex justify-content-between">
                <p style="border-top:1px solid black">wefvMxh় c«avb</p>
                <p style="border-top:1px solid black">c«kvmwbK wefvM</p>
                <p style="border-top:1px solid black">gnve¨e¯’vcK</p>
                <p style="border-top:1px solid black">cwiPvjK</p>
            </div>
    </div>
</body>
</html>
<br><br><br>
<?php exit(); ?>
