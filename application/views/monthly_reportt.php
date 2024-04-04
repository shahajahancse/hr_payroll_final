<html>
<head>
<title>Monthly Attendance Register</title>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/SingleRow.css" />
</head>
<body>

<?php 
// dd($this->session->userdata('data')->id);
$this->load->view("head_english");
?>
<div align="center" style=" margin:0 auto;  overflow:hidden; font-family: 'Times New Roman', Times, serif;"><span style="font-size:13px; font-weight:bold;">
Attendance Register of <?php echo  $year_month ?> </span><br/><br />
    <table class="sal" border='1' cellpadding='0' cellspacing='0' style=" font-size:13px;">
        <th>SL #</th><th>Emp Id </th><th>Name</th><th>Dsignation</th><th>Line</th>
        <?php 
                // dd($value);
                foreach ($value as $rows => $row){
                    $att_month = $year_month;
                }
                $first_y=date("Y", strtotime("$att_month"));
                $first_m=date("m", strtotime("$att_month"));
                $last_date = date("t", strtotime("$att_month"));
                for ( $k=1 ; $k <= $last_date ; $k++ ){
                    echo "<th style='width:20px;'>$k</th>";
                }
                echo "<th>Pre.</th>";
                echo "<th>Abs.</th>";
                echo "<th>Week.</th>";
                echo "<th>Holi.</th>";
                echo "<th>Leave</th>";
                echo "<th>T. Day</th>";
                echo "<th>Deduct</th>";
                echo "<th>OT Hour</th>";
                $i =1;
            foreach ($value as $rows => $row){
                echo "<tr><td>$i</td><td>";
                echo $row['emp_id'];
                echo "</td><td>";
                echo $row['name_en'];
                echo "</td><td>";
                echo $row['desig_name'];
                echo "</td><td>";
                echo $row['line_name_en'];
                echo "</td>";
                
                $p = 0 ;
                $a = 0 ;
                $l = 0 ;
                $w = 0 ;
                $h = 0 ;
                $total_ot = 0;
                $total_eot = 0;
                
                for ( $k=1 ; $k <= $last_date ; $k++ ){
                    $idate = $k;
                    $date = $idate;
                    // dd($date);
                    echo "<td style='text-align:center;'>";
                    if(!array_key_exists($date, $row)){
                        echo "&nbsp;";
                    }
                    else{
                        if($row[$date] == "A"){
                            echo "<span style='background:#CCCCCC;'> ";
                            echo $row[$date];
                            echo "</span>";
                        }
                        else{
                            echo $row[$date];
                            $ot_date = date("Y-m-d", mktime(0, 0, 0, $first_m, $k, (int)$first_y));
                            echo "<br>";
                            $daily_total_ot = $this->Grid_model->get_daily_total_ot_hour($row['emp_id'], $ot_date);
                            $daily_total_eot = $this->Grid_model->get_daily_total_eot_hour($row['emp_id'], $ot_date);
                            
                            $user_id = $this->session->userdata('data')->id;
                            // dd($user_id);
                            $acl     = 	 	$data = array();
                                            $this->db->select("acl_id");
                                            $this->db->where('username_id',$user_id);
                                            $query = $this->db->get('member_acl_level');
                                            foreach($query->result() as $rows){
                                                $data[] = $rows->acl_id;
                                            }	
                            if(in_array(14,$acl)){
                                
                                if($row[$date] == "W" or $row[$date] == "H")	{
                                    $daily_total_ot  = 0;
                                    $daily_total_eot = 0;
                                }
                                else{
                                    echo $daily_total_ot;
                                    echo "+$daily_total_eot";
                                }
                                $total_ot = $total_ot + $daily_total_ot;
                                $total_eot = $total_eot + $daily_total_eot;		
                            }
                            else{
                                echo $daily_total_ot;
                                echo "+$daily_total_eot";
                                $total_ot = $total_ot + $daily_total_ot;
                                $total_eot = $total_eot + $daily_total_eot;
                            }
                        }
                        if($row[$date] == "P")
                        {
                            $p++;
                        }
                        if($row[$date] == "A")
                        {
                            $a++;
                        }
                        if($row[$date] == "L")
                        {
                            $l++;
                        }
                        if($row[$date] == "W")
                        {
                            $w++;
                        }
                        if($row[$date] == "H")
                        {
                            $h++;
                        }
                    }
                    echo "</td>";
                }
                echo "<td style='text-align: center;'> $p </td>";
                echo "<td style='text-align: center;'> $a </td>";
                echo "<td style='text-align: center;'>  $w </td>";
                echo "<td style='text-align: center;'> $h </td>";
                echo "<td style='text-align: center;'> $l </td>";
                $t_day = $p+ $a+  $w + $h +$l;
                echo "<td style='text-align: center;'> $t_day </td>";
                $first_date= date("Y-m-01", strtotime($year_month));
                $last_date = date("Y-m-t", strtotime($first_date));
                $deduct=0;
                $eot_modify_eot = $this->db->select_sum('eot', 'eot')->select_sum('modify_eot', 'modify_eot')
                                    ->where('shift_log_date BETWEEN "'.$first_date.'" AND "'.$last_date.'"')
                                    ->where('emp_id', $row['id'])
                                    ->get('pr_emp_shift_log')
                                    ->row();
                $eot_deduct = $eot_modify_eot->eot - $eot_modify_eot->modify_eot;
                $deduct= $total_eot + $eot_modify_eot->modify_eot;
                
                echo "<td style='text-align: center;'> $eot_modify_eot->modify_eot </td>";
                echo "<td style='text-align: center;'>";
                echo "$total_ot+$eot_deduct =";
                echo $grand_total_ot = $total_ot + $eot_deduct; 
                echo "</td>";
                echo "</tr>";
                $i++;
            }
        ?>
    </table>
</body>
</html>