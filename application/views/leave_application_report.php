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
        }
        .table-bordered td, .table-bordered th {
            border: 1px solid #000000;
            padding:2px;
        }
    </style>
</head>
<body>
    <div class="container w-75">
        <div class="d-flex flex-row justify-content-between">
            <p style="font-family: Arial, Helvetica, sans-serif;">Effective Date : 15.01.2022</p>
            <p style="font-family: Arial, Helvetica, sans-serif;">Version # 00</p>
            <p style="font-family: Arial, Helvetica, sans-serif;">Document Code : HGL/HRD/HR/03/008</p>
        </div>
        <div class="d-flex">
            <div class="col-md-2">
                <!-- <img src="< ?php echo base_url('/images'.'/'.$image)?>" alt="Logo" style="max-width: 50%;"> -->
            </div>
            <div class="col-md-12">
                <h1 class="text-center" style="margin-left: -420px;">হানিওয়েল গার্মেন্টস লিমিটেড</h1>
            </div>
        </div>
        <div class="col-md-12" style="border-bottom: 1px solid black!important;">
            <p class="text-center h5">৭৯৯, (পুরাতন প্লট নং- ১০১০/১০১১), আমবাগ, মৌজা বাঘিয়া, কোনাবাড়ী, গাজীপুর-১৭০০।</p>
        </div>
        <br>
        <div>
            <h5 class="text-center" style="border-bottom: 2px solid black;width: 200px;margin: 0 auto;">ছুটির আবেদন পত্র</h5>
            <p class="ml-3">তারিখঃ <?php echo "<span style='font-family:SutonnyMJ;font-size:20px'>".date('d/m/Y')."</span>"?></p>
        </div>
        <?php 
           $data =  $this->db->select('leave_type,leave_start,leave_end,total_leave')->where('leave_start',date('Y-m-d',strtotime($first_date)))->where('emp_id',$values['emp_info']->emp_id)->order_by('leave_end','DESC')->get('pr_leave_trans')->row();
            // dd($this->db->last_query());
        ?>
        <div class="ml-3">
                <p>বরাবর,</p>
                <p>ব্যবস্থাপনা পরিচালক সাহেব/ মহাব্যবস্থাপক,</p>
                
                <p>বিনীত নিবেদন এই যে, অনুগ্রহ পূর্বক <span style="border-bottom: 2px dotted black"><?php echo $reason?></span>  কারনে 
                    <?php echo "<span style='font-family:SutonnyMJ;font-size:20px'>".date('d/m/Y',strtotime($first_date))."</span>"?> তারিখ হইতে <?php echo "<span style='font-family:SutonnyMJ;font-size:20px'>".date('d/m/Y',strtotime($second_date))."</span>"?> তারিখ পর্যন্ত 
                    মোট <?php  $date1 = new DateTime($first_date); 
                    $date2 = new DateTime($second_date);
                    $interval = $date2->diff($date1);
                    $interval->d += 1;
                    // dd($interval);
                                echo  "<span style='font-family:SutonnyMJ;font-size:20px'>".$interval->format('%d ')."</span>";
                        ?>  দিন আমাকে <?php echo $type == 'cl' ? ' নৈমিত্তিক': 'অসুস্থতা' ?> ছুটি মঞ্জুরের জন্য আবেদন জানাচ্ছি।
                </p><br>
                <p>আবেদন কারীর স্বাক্ষর .............................................................................</p>
                <br>

                <div style="line-height:10px">
                    <p>নাম: <?php echo $values['emp_info']->name_bn?></p>
                    <p>কার্ডনং: <?php echo $values['emp_info']->emp_id?></p>
                    <p>বিভাগ :<?php echo $values['emp_info']->dept_bangla?></p>
                    <p>পদবি : <?php echo $values['emp_info']->desig_bangla?></p>
                    <p>লাইন:<?php echo $values['emp_info']->line_name_bn?></p>
                    <p>অফিস রেকর্ড:</p>
                </div>
                <br>
                <p>আবেদন কারীর কাজে যোগদানের তারিখঃ <span style="font-family:SutonnyMJ;font-size:18px"><?php echo  date('d/m/Y',strtotime($values['emp_info']->emp_join_date))."</span>"?></span></p>

                <p style="font-family:SutonnyMJ;font-size:">১। নৈমিত্তিক ছুটি মোট প্রাপ্য ১০ দিন, ভোগকৃত ছুটি <?php echo "<span style='font-family:SutonnyMJ;font-size:20px'>".$values['leave_taken_casual']."</span>"?> দিন, অবশিষ্ট <?php echo "<span style='font-family:SutonnyMJ;font-size:20px'>".$values['leave_balance_casual']."</span>"?> দিন </p>
                <p style="font-family:SutonnyMJ;font-size:">২। অসুস্থতা <?php echo "<span style='font-family:SutonnyMJ;font-size:20px'>".$values['leave_entitle_sick']."</span>"?> দিন, ভোগকৃত ছুটি <?php echo "<span style='font-family:SutonnyMJ;font-size:20px'>".$values['leave_taken_sick']."</span>"?> দিন, অবশিষ্ট <?php echo "<span style='font-family:SutonnyMJ;font-size:20px'>".$values['leave_balance_sick']."</span>"?> দিন </p>
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
                
                <p>৩। অর্জিত <?= $earn_leave ?> দিন, ভোগকৃত ছুটি  <?= $leave_taken_earn ?> দিন, অবশিষ্ট <?= $leave_ba_earn ?> দিন </p>
                <br>
                <br>
                <br>
                <br>
                <p><span style="border-top: 1px solid black;">অফিস কর্তৃক যাচাইকৃত ও স্বাক্ষরীত</span> <span style="float: inline-end;border-top: 1px solid black;">প্রশাসনিক কর্মকর্তার স্বাক্ষর</span></p>
               <br>
               <br>
               <br>
                <p class="text-justify">আবেদনকারীকে  <?php echo "<span style='font-family:SutonnyMJ;font-size:20px'>".date('d/m/Y',strtotime($first_date))."</span>"?> তারিখ হতে  <?php echo "<span style='font-family:SutonnyMJ;font-size:20px'>".date('d/m/Y',strtotime($second_date))."</span>"?> পর্যন্ত মোট <?php  $date1 = new DateTime($first_date); 
                                $date2 = new DateTime($second_date);
                                $interval = $date2->diff($date1); 
                                $interval->d += 1; 
                                echo  "<span style='font-family:SutonnyMJ;font-size:20px'>".$interval->format('%d ')."</span>";
                        ?>   দিন  <?php echo $type == 'cl' ? ' নৈমিত্তিক': 'অসুস্থতা' ?> ছুটি মঞ্জুর করা যেতে পারে।</p>
                <p>উক্ত সুপারিশ মোতাবেক ছুটি মঞ্জুর করা হইল।</p>
            </div>
            <br>
            <br>
            <br>
            <div class="ml-3 d-flex justify-content-between">
                <p style="border-top:1px solid black">বিভাগীয় প্রধান</p> 
                <p style="border-top:1px solid black">প্রশাসনিক বিভাগ</p> 
                <p style="border-top:1px solid black">মহাব্যবস্থাপক</p> 
                <p style="border-top:1px solid black">পরিচালক</p>
            </div>
    </div>
</body>
</html>