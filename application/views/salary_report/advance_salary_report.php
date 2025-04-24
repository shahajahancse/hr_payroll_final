<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Advance Salary Sheet </title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/print.css" media="print" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/SingleRow.css" />
    <style>
        .bottom_txt_design{
            border-top:1px solid;
            width:100px;
            font-weight:bold;
        }
        .bottom_txt_manager_design
        {
            border-top:1px solid;
            width:170px;
        }
        @media print {
            @page{
                size: auto;   /* auto is the initial value */
                margin: 15px;  /* this affects the margin in the printer settings */
            }
        }
    </style>
</head>

<body style="margin:0 2px;">
    <!-- < ?php dd($value)?> -->
    <table height="auto"  class="sal" border="1" cellspacing="0" cellpadding="0" style="font-size:13px; width:13.6in; font-family:SutonnyMJ, SolaimanLipi; border-collapse:collapse;">
    <!-- //hedding -->
        <tr height="85px">
            <td colspan="29" align="center">
                <div style="width:100%; font-family:Arial, Helvetica, sans-serif;">
                    <div style="text-align:left; position:relative;padding-left:10px;width:20%; float:left; font-weight:bold;">
                        <table>
                            <?php 
                                $date = date('d-m-Y');
                                $section_name = $value[0]->sec_name_en;
                                $last_day = date("t", strtotime($salary_month));
                                $dom = $last_day; 
                                echo "DOM : $dom <br>";  
                            ?>
                        </table>
                    </div>
                    <div style="text-align:center; position:relative;padding-left:10px;width:50%; overflow:hidden; float:left; display:block;">
                        <?php $this->load->view("head_english");?>
                        <?php 
                            $loan_date = $this->db->select('pay_day')->from('pr_advance_loan')->where('loan_month',$salary_month)->where('emp_id',$value[0]->emp_id)->get()->result();
                            echo '<span style="font-weight:bold;">';
                            echo "Advance Salary Sheet for ".date("d M y", strtotime($salary_month)).' to '.$loan_date[0]->pay_day.date(" M y", strtotime($salary_month));
                            echo '</span>';
                            // dd($value);
                        ?>
                    </div>
                    <div style="text-align:left; position:relative;padding-left:10px;width:20%; overflow:hidden; float:right; display:block; font-weight:bold">
                        <?php
                            echo "Page No # $counter of $page<br>";
                            echo "Payment Date : ";
                        ?>
                    </div>
                </div>
            </td>
        </tr>
        <tr height="20px">
            <td rowspan="2"  width="15" height="20px"><div align="center"><strong>নং</strong></div></td>
            <td rowspan="2" width="25" height="20px"><div align="center"><strong>কার্ড নং</strong></div></td>
            <td rowspan="2" width="200" height="20px"><div align="center"><strong>নাম, পদবী, যোগদান, গ্রেড</strong></div></td>
            <td rowspan="2" width="50" height="20px"><div align="center"><strong>লাইন</strong></div></td>
            <td rowspan="2" width="20" height="20px"> <div align="center"><strong>মূল বেতন</strong></div></td>
            <td rowspan="2" width="17" height="20px"><div align="center"><strong>বাড়ী ভাড়া</strong></div></td>
            <td rowspan="2" width="15" height="20px"><div align="center"><strong>চিকিৎসা ভাতা</strong></div></td>
            <td rowspan="2" width="15" height="20px"><div align="center"><strong>যাতায়াত</strong></div></td>
            <td rowspan="2" width="15" height="20px"><div align="center"><strong>খাদ্য ভাতা</strong></div></td>
            <td rowspan="2" width="35" height="20px"><div align="center"><strong>মোট বেতন</strong></div></td>
            <td colspan="3" width="30" height="20px"><div align="center"><strong>উপস্থিতি</strong></div></td>
            <td colspan="3" height="20px"><div align="center">           <strong>ছুটি</strong></div></td>
            <td rowspan="2" width="25" height="20px"><div align="center"><strong>পে ডে</strong></div></td>
            <td rowspan="2" width="25" height="20px"><div align="center"><strong>নেট পে</strong></div></td>
            <td rowspan="2" width="25" height="20px"><div align="center"><strong>ওটি ঘণ্টা</strong></div></td>
            <td rowspan="2" width="25" height="20px"><div align="center"><strong>ওটি রেট</strong></div></td>
            <td rowspan="2" width="25" height="20px"><div align="center"><strong>ওটি টাকা</strong></div></td>
            <td rowspan="2" width="25" height="20px"><div align="center"><strong>মোট বেতন</strong></div></td>
            <td rowspan="2" width="25" height="20px"><div align="center"><strong>প্রদেয় বেতন</strong></div></td>
            <td rowspan="2"  width="180"><div align="center"><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;গ্রহীতার স্বাক্ষর&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong></div></td>
        </tr>
        <tr height="10px">
            <td width="15" style="font-size:8px;"><div align="center"><strong>হাজিরা</strong></div></td>
            <td width="15" style="font-size:8px;"><div align="center"><strong>অফ ডে</strong></div></td>
            <td width="15" style="font-size:8px;"><div align="center"><strong>অনুপুস্থিত</strong></div></td>
            <td width="15"><div align="center" style="font-family:Arial, Helvetica, sans-serif;"><strong>CL</strong></div></td>
            <td width="15"><div align="center" style="font-family:Arial, Helvetica, sans-serif;"><strong>SL</strong></div></td>
            <td width="15"><div align="center" style="font-family:Arial, Helvetica, sans-serif;"><strong>EL</strong></div></td>
        </tr>
        <!-- //hedding -->

        <?php
        // dd($value);
        $per_page=8;
        $brack_page =$per_page+1;

        $total_basic_sal = 0;
        $total_house_r = 0;
        $total_medical_a = 0;
        $total_trans_allow = 0;
        $total_food_allow = 0;
        $total_gross_sal =0;
        $total_net_pay = 0;
        $total_ot_hour =   0;
        $total_ot_amount =0;
        $total_pay_amount =0;
        $i = 1; foreach($value as $key=>$row){
        if($j==$brack_page){  ?>
            <!-- per page total and footer heading -->
            <tr>
                <td align="center" colspan="4"><strong>প্রতি পৃষ্ঠার মোট </strong></td>
                <td align="right"><strong><?php echo $total_basic_sal?></strong></td>
                <td align="right"><strong><?php echo $total_house_r?></strong></td>
                <td align="right"><strong><?php echo $total_medical_a?></strong></td>
                <td align="right"><strong><?php echo $total_trans_allow?></strong></td>
                <td align="right"><strong><?php echo $total_food_allow?></strong></td>
                <td align="right"><strong><?php echo $total_gross_sal?></strong></td>
                <td align="right" colspan="7"></td>
                <td align="right"><strong><?php echo $total_net_pay?></strong></td>
                <td align="right"><strong><?php echo $total_ot_hour?></strong></td>
                <td align="right"></td>
                <td align="right"><strong><?php echo $total_ot_amount?></strong></td>
                <td align="right"></td>
                <td align="right"><strong><?php echo $total_pay_amount?></strong></td>
            </tr>
            </table>

            <table width="100%" height="80px" border="0" align="center" style="margin-bottom:85px; font-family:Arial, Helvetica, sans-serif; font-size:10px; font-weight:bold;">
                <?php   if($_SESSION['data']->unit_name ==1){ ?>
                    <tr >
                        <td colspan="28"></td>
                    </tr>
                    <tr>
                        <td colspan="28"></td>
                    </tr>
                    <tr>
                        <td colspan="28"></td>
                    </tr>
                    <tr height="25%">
                        <td  align="center" style="width:10%"><dt class="bottom_txt_design" >Prepared By</dt></td>
                        <td  align="center" style="width:10%"><dt class="bottom_txt_design" >Manager (HRD)</dt></td>
                        <td  align="center" style="width:10%"><dt class="bottom_txt_design" >Audit</dt></td>
                        <td  align="center" style="width:10%"><dt class="bottom_txt_design" >GM (Project Head)</dt></td>
                        <td  align="center" style="width:10%"><dt class="bottom_txt_design" >Group GM (HRD)</dt></td>
                        <td  align="center" style="width:10%"><dt class="bottom_txt_design" >COO</dt></td>
                        <td  align="center" style="width:10%"><dt class="bottom_txt_design" >DMD</dt></td>
                        <td  align="center" style="width:10%"><dt class="bottom_txt_design" >Managing Director</dt></td>
                
                    </tr>
                <?php }else{?>
                    <tr height="80%" >
                        <td colspan="28"></td>
                    </tr>
                        <tr height="20%">
                        <td  align="center" style="width:15%;"><dt class="bottom_txt_design" >Prepared By</dt></td>
                        <td align="center"  style="width:25%" ><dt class="bottom_txt_design" >Account Office / Executive</dt></td>
                        <td  align="center" style="width:20%" ><dt class="bottom_txt_design" >HR Manager</dt></td>
                        <td  align="center" style="width:20%" ><dt class="bottom_txt_design" >General Manager (GM)</dt></td>
                        <td  align="center" style="width:20%" ><dt class="bottom_txt_design" >Director</dt></td>
                    </tr>
                <?php }?>
            </table>

            <div style='page-break-after:always'></div>
            <!-- per page total and footer heading -->

            <!-- internal page heading -->
            <table height="auto"  class="sal" border="1" cellspacing="0" cellpadding="0" style="font-size:13px; width:13.6in; font-family:SutonnyMJ, SolaimanLipi; border-collapse:collapse;">
                <!-- //hedding -->
                <tr height="85px">
                    <td colspan="29" align="center">
                        <div style="width:100%; font-family:Arial, Helvetica, sans-serif;">
                            <div style="text-align:left; position:relative;padding-left:10px;width:20%; float:left; font-weight:bold;">
                                <table>
                                    <?php  
                                    
                                        $date = date('d-m-Y');
                                        $section_name = $value[0]->sec_name_en;
                                        $last_day = date("t", strtotime($salary_month));
                                        $dom = $last_day; 
                                        echo "DOM : $dom <br>";  
                                    ?>
                                </table>
                            </div>
                            <div style="text-align:center; position:relative;padding-left:10px;width:50%; overflow:hidden; float:left; display:block;">
                                <?php $this->load->view("head_english");?>
                                <?php 
                                    $loan_date = $this->db->select('pay_day')->from('pr_advance_loan')->where('loan_month',$salary_month)->where('emp_id',$value[0]->emp_id)->get()->result();
                                    echo '<span style="font-weight:bold;">';
                                    echo "Advance Salary Sheet for ".date("d M y", strtotime($salary_month)).' to '.$loan_date[0]->pay_day.date(" M y", strtotime($salary_month));
                                    echo '</span>';
                                ?>
                            </div>
                            <div style="text-align:left; position:relative;padding-left:10px;width:20%; overflow:hidden; float:right; display:block; font-weight:bold">
                                <?php
                                    echo "Page No # $counter of $page<br>";
                                    echo "Payment Date : ";
                                ?>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr height="20px">
                    <td rowspan="2"  width="15" height="20px"><div align="center"><strong>নং</strong></div></td>
                    <td rowspan="2" width="25" height="20px"><div align="center"><strong>কার্ড নং</strong></div></td>
                    <td rowspan="2" width="200" height="20px"><div align="center"><strong>নাম, পদবী, যোগদান, গ্রেড</strong></div></td>
                    <td rowspan="2" width="50" height="20px"><div align="center"><strong>লাইন</strong></div></td>
                    <td rowspan="2" width="20" height="20px"> <div align="center"><strong>মূল বেতন</strong></div></td>
                    <td rowspan="2" width="17" height="20px"><div align="center"><strong>বাড়ী ভাড়া</strong></div></td>
                    <td rowspan="2" width="15" height="20px"><div align="center"><strong>চিকিৎসা ভাতা</strong></div></td>
                    <td rowspan="2" width="15" height="20px"><div align="center"><strong>যাতায়াত</strong></div></td>
                    <td rowspan="2" width="15" height="20px"><div align="center"><strong>খাদ্য ভাতা</strong></div></td>
                    <td rowspan="2" width="35" height="20px"><div align="center"><strong>মোট বেতন</strong></div></td>
                    <td colspan="3" width="30" height="20px"><div align="center"><strong>উপস্থিতি</strong></div></td>
                    <td colspan="3" height="20px"><div align="center">           <strong>ছুটি</strong></div></td>
                    <td rowspan="2" width="25" height="20px"><div align="center"><strong>পে ডে</strong></div></td>
                    <td rowspan="2" width="25" height="20px"><div align="center"><strong>নেট পে</strong></div></td>
                    <td rowspan="2" width="25" height="20px"><div align="center"><strong>ওটি ঘণ্টা</strong></div></td>
                    <td rowspan="2" width="25" height="20px"><div align="center"><strong>ওটি রেট</strong></div></td>
                    <td rowspan="2" width="25" height="20px"><div align="center"><strong>ওটি টাকা</strong></div></td>
                    <td rowspan="2" width="25" height="20px"><div align="center"><strong>মোট বেতন</strong></div></td>
                    <td rowspan="2" width="25" height="20px"><div align="center"><strong>প্রদেয় বেতন</strong></div></td>
                    <td rowspan="2"  width="180"><div align="center"><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;গ্রহীতার স্বাক্ষর&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong></div></td>
                </tr>
                <tr height="10px">
                    <td width="15" style="font-size:8px;"><div align="center"><strong>হাজিরা</strong></div></td>
                    <td width="15" style="font-size:8px;"><div align="center"><strong>অফ ডে</strong></div></td>
                    <td width="15" style="font-size:8px;"><div align="center"><strong>অনুপুস্থিত</strong></div></td>
                    <td width="15"><div align="center" style="font-family:Arial, Helvetica, sans-serif;"><strong>CL</strong></div></td>
                    <td width="15"><div align="center" style="font-family:Arial, Helvetica, sans-serif;"><strong>SL</strong></div></td>
                    <td width="15"><div align="center" style="font-family:Arial, Helvetica, sans-serif;"><strong>EL</strong></div></td>
                </tr>
                <!-- //hedding -->
                <?php
                    $brack_page+=$per_page;
                    $total_basic_sal = 0;
                    $total_house_r = 0;
                    $total_medical_a = 0;
                    $total_trans_allow = 0;
                    $total_food_allow = 0;
                    $total_gross_sal =0;
                    $total_net_pay = 0;
                    $total_ot_hour =   0;
                    $total_ot_amount =0;
                    $total_pay_amount =0;
                ?>
        <?php } 
            
        ?>
        <!-- internal page heading -->

        <?php if($row->gross_sal == 0){
            continue;
        }
        $j++;

            $get_data = $this->db->select('*')->from('pay_salary_sheet')->where('emp_id', $row->emp_id)->where('salary_month', $salary_month)->get()->row();
            // $get_data = $this->db->select('*')->from('pay_salary_sheet')->where('emp_id',$row->emp_id)->where('salary_month',$salary_month)->get()->row();
            // dd($row);

            $loan_date = $this->db->select('*')->from('pr_advance_loan')->where('loan_month',$salary_month)->where('emp_id',$row->emp_id)->get()->row();
            // dd($loan_date);
            $gett_data = $this->db->select("
                SUM(CASE WHEN present_status= 'P' THEN 1 ELSE 0 END) as att_days,
                SUM(CASE WHEN present_status= 'A' THEN 1 ELSE 0 END) as absent_days,
                SUM(CASE WHEN present_status= 'W' THEN 1 ELSE 0 END) as weekend_days,
                SUM(CASE WHEN present_status= 'H' THEN 1 ELSE 0 END) as holiday_days,
                SUM(CASE WHEN present_status= 'L' THEN 1 ELSE 0 END) as leave_days,
                SUM(ot) as ot_hour,
            ")
            ->from('pr_emp_shift_log')
            ->where('emp_id',$row->emp_id)
            ->where("shift_log_date between '$loan_date->from_date' and '$loan_date->to_date'")
            ->get()->row();

            // dd($gett_data);

            $leave_type = $this->db->select("
               leave_type,total_leave
            ")
            ->from('pr_leave_trans')
            ->where('emp_id', $row->emp_id)
            ->where("leave_end  >=",$loan_date->from_date)
            ->where("leave_end  <=",$loan_date->to_date)
            ->get()->row();

            // dd($leave_type);

            $cl = $leave_type->leave_type == 'cl' ? $leave_type->total_leave : 0;
            $sl = $leave_type->leave_type == 'sl' ? $leave_type->total_leave : 0;
            $el = $leave_type->leave_type == 'el' ? $leave_type->total_leave : 0;

            $total_days = $gett_data->att_days+$gett_data->weekend_days+$gett_data->holiday_days+$sl+$cl+$el;
            $ot_rate      = round($get_data->basic_sal/104,2);

            if ($unit_id == 1) {
                $amptt = $this->db->where('pay_month',$salary_month)->where('emp_id',$row->emp_id)->get('pr_advance_loan_pay_history')->row();
                $net_pay = $amptt->pay_amount ? $amptt->pay_amount:0;
                $ot = 0;
                $ot_amount = 0;
                $net_pay = floor($net_pay/100)*100;
            } else {
                $net_pay      = round($get_data->gross_sal/date('t',strtotime($salary_month))*$total_days);
                $ot = $loan_date->ot == 2 ? 0 : $gett_data->ot_hour;
                $ot_amount = round($ot*$ot_rate);
            }
            
            // dd( $net_pay);
            
            $total_amount = $net_pay+$ot_amount;
            $pay_amount  = floor($total_amount/100)*100;

            $total_basic_sal += $get_data->basic_sal;
            $total_house_r += $get_data->house_r;
            $total_medical_a += $get_data->medical_a;
            $total_trans_allow += $get_data->trans_allow;
            $total_food_allow += $get_data->food_allow;
            $total_gross_sal += $get_data->gross_sal;
            $total_net_pay += $net_pay;
            $total_ot_hour +=   $loan_date->ot == 2 ? 0 : $gett_data->ot_hour;
            $total_ot_amount += $ot_amount;
            $total_pay_amount += $pay_amount;

            $grand_total_basic_sal  += $get_data->basic_sal;
            $grand_total_house_r    += $get_data->house_r;
            $grand_total_medical_a  += $get_data->medical_a;
            $grand_total_trans_allow+= $get_data->trans_allow;
            $grand_total_food_allow += $get_data->food_allow;
            $grand_total_gross_sal  += $get_data->gross_sal;
            $grand_total_net_pay    += $net_pay;
            $grand_total_ot_hour    += $ot_hour;
            $grand_total_ot_amount  += $ot_amount;
            $grand_total_pay_amount += $pay_amount;
        ?>
        <tr>
            <td align="center"><strong><?php echo $i++;?></strong></td>
            <td align="center"><?php echo $row->emp_id;?></td>
            <td>
                <span style="font-family:Arial, Helvetica, sans-serif"><?php echo $row->name_en;?><br>
                <?php echo $row->desig_name;?><br>
                <?php echo $row->emp_join_date;?><br>
                <?php echo $row->gr_name;?></span>
            </td>
            <td align="center" style="font-family:Arial, Helvetica, sans-serif"><?php echo $row->line_name_en;?></td>
            <td align="center"><?php echo $get_data->basic_sal;?></td>
            <td align="center"><?php echo $get_data->house_r;?></td>
            <td align="center"><?php echo $get_data->medical_a;?></td>
            <td align="center"><?php echo $get_data->trans_allow;?></td>
            <td align="center"><?php echo $get_data->food_allow;?></td>
            <td align="center"><?php echo $get_data->gross_sal;?></td>
            <td align="center"><?php echo $gett_data->att_days;?></td>
            <td align="center"><?php echo ($gett_data->holiday_days+$gett_data->weekend_days);?></td>
            <td align="center"><?php echo $gett_data->absent_days;?></td>
            <td align="center"><?php echo $cl ?></td>
            <td align="center"><?php echo $sl ?></td>
            <td align="center"><?php echo $el ?></td>
            <td align="center"><?php echo $total_days;?></td>
            <td align="center"><?php echo $net_pay;?></td>
            <td align="center"><?php echo $ot;?></td>
            <td align="center"><?php echo $ot_rate;?></td>
            <td align="center"><?php echo $ot_amount;?></td>
            <td align="center"><?php echo $total_amount;?></td>
            <td align="center"><?php echo $pay_amount;?></td>
            <td align="center"></td>
        </tr>
        <?php } ?>

        <tr>
            <td align="center" colspan="4"><strong>প্রতি পৃষ্ঠার মোট </strong></td>
            <td align="right"><strong><?php echo $total_basic_sal?></strong></td>
            <td align="right"><strong><?php echo $total_house_r?></strong></td>
            <td align="right"><strong><?php echo $total_medical_a?></strong></td>
            <td align="right"><strong><?php echo $total_trans_allow?></strong></td>
            <td align="right"><strong><?php echo $total_food_allow?></strong></td>
            <td align="right"><strong><?php echo $total_gross_sal?></strong></td>
            <td align="right" colspan="7"></td>
            <td align="right"><strong><?php echo $total_net_pay?></strong></td>
            <td align="right"><strong><?php echo $total_ot_hour?></strong></td>
            <td align="right"></td>
            <td align="right"><strong><?php echo $total_ot_amount?></strong></td>
            <td align="right"></td>
            <td align="right"><strong><?php echo $total_pay_amount?></strong></td>
        </tr>

        <tr height="10">
            <td colspan="4" align="center">
            <strong>সর্বমোট বেতন</strong></td>
            <td align="right"><strong><?php echo $grand_total_basic_sal?></strong></td>
            <td align="right"><strong><?php echo $grand_total_house_r?></strong></td>
            <td align="right"><strong><?php echo $grand_total_medical_a?></strong></td>
            <td align="right"><strong><?php echo $grand_total_trans_allow?></strong></td>
            <td align="right"><strong><?php echo $grand_total_food_allow?></strong></td>
            <td align="right"><strong><?php echo $grand_total_gross_sal?></strong></td>
            <td align="right" colspan="7"></td>
            <td align="right"><strong><?php echo $grand_total_net_pay?></strong></td>
            <td align="right"><strong><?php echo $grand_total_ot_hour?></strong></td>
            <td align="right"></td>
            <td align="right"><strong><?php echo $grand_total_ot_amount?></strong></td>
            <td align="right"></td>
            <td align="right"><strong><?php echo $grand_total_pay_amount?></strong></td>
        </tr>
    </table>
                    
    <table width="100%" height="80px" border="0" align="center" style="margin-bottom:85px; font-family:Arial, Helvetica, sans-serif; font-size:10px; font-weight:bold;">
            <?php 
                if($_SESSION['data']->unit_name ==1){
            ?>
                <tr >
                    <td colspan="28"></td>
                </tr>
                    <tr>
                    <td colspan="28"></td>
                </tr>
                    <tr>
                    <td colspan="28"></td>
                </tr>
                <tr height="25%">
                    <td  align="center" style="width:10%"><dt class="bottom_txt_design" >Prepared By</dt></td>
                    <td  align="center" style="width:10%"><dt class="bottom_txt_design" >Manager (HRD)</dt></td>
                    <td  align="center" style="width:10%"><dt class="bottom_txt_design" >Audit</dt></td>
                    <td  align="center" style="width:10%"><dt class="bottom_txt_design" >GM (Project Head)</dt></td>
                    <td  align="center" style="width:10%"><dt class="bottom_txt_design" >Group GM (HRD)</dt></td>
                    <td  align="center" style="width:10%"><dt class="bottom_txt_design" >COO</dt></td>
                    <td  align="center" style="width:10%"><dt class="bottom_txt_design" >DMD</dt></td>
                    <td  align="center" style="width:10%"><dt class="bottom_txt_design" >Managing Director</dt></td>
                
                </tr>
            <?php }else{?>
                <tr height="80%" >
                    <td colspan="28"></td>
                </tr>
                    <tr height="20%">
                    <td  align="center" style="width:15%;"><dt class="bottom_txt_design" >Prepared By</dt></td>
                    <td align="center"  style="width:25%" ><dt class="bottom_txt_design" >Account Office / Executive</dt></td>
                    <td  align="center" style="width:20%" ><dt class="bottom_txt_design" >HR Manager</dt></td>
                    <td  align="center" style="width:20%" ><dt class="bottom_txt_design" >General Manager (GM)</dt></td>
                    <td  align="center" style="width:20%" ><dt class="bottom_txt_design" >Director</dt></td>
                </tr>
            <?php }?>
        </table>
    </table>
</body>
</html>
