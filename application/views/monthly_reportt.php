<html>
<head>
<title>Monthly Attendance Register</title>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/SingleRow.css" />
</head>
<body>

<?php
	$per_page_id = 11;
	$row_count=count($value);
	if($row_count > $per_page_id){
		$page=ceil($row_count/$per_page_id);
	} else {
		$page=1;
	}
	$i = 0;
	// for($counter = 1; $counter <= $page; $counter++){ ?>
        <div class="head-container" style="padding:20px 0px;width: 100%;display: inline-block;">
            <div style="text-align:center; position:relative;padding-left:269px;width:50%; overflow:hidden; float:left; display:block;">
                <?php $this->load->view("head_bangla"); ?>
                <span style="font-size:13px; font-weight:bold;">Attendance Register of <?php echo  $year_month ?> </span> 
            </div>
            <!-- <div style="text-align:left; position:relative;padding-left:10px;width:20%; overflow:hidden; float:right; display:inline; font-weight:bold">
                <?php //echo '<span style="">'."Page No. # $counter of $page<br>".'</span>';?>
            </div> -->
        </div>
        <table class="sal" border='1' cellpadding='0' cellspacing='0' style=" font-size:16px;">
            <tr>
                <th>SL #</th>
                <th>Emp Id </th>
                <th>Name</th>
                <th>designation</th>
                <th>Line</th>
                <?php
                    $last_date = date("t", strtotime("$year_month"));
                    for ( $k=1 ; $k <= $last_date; $k++ ){
                        echo "<th style='width:30px;'>$k</th>";
                } ?>
                <th>Pre.</th>
                <th>Abs.</th>
                <th>Week.</th>
                <th>Holi.</th>
                <th>Leave</th>
                <th>T. Day</th>
                <!-- <th>Deduct</th> -->
                <th>OT Hour</th>
            </tr>
            <?php 
            // if($counter == $page){
            //     $modulus = ($row_count-1) % $per_page_id;
            //     $per_page_row = $modulus;
            // }else{
            //     $per_page_row = $per_page_id - 1;
            // }
            for($j=0; $j < $row_count; $j++){
                $key = $i + 1;
                echo "<tr><td> $key </td><td>";
                echo $value[$i]['emp_id'];
                echo "</td><td>";
                echo $value[$i]['name_en'];
                echo "</td><td>";
                echo $value[$i]['desig_name'];                
                echo "</td><td>";
                echo $value[$i]['line_name_en'];
                echo "</td>";

                $p = 0 ;
                $a = 0 ;
                $l = 0 ;
                $w = 0 ;
                $h = 0 ;
                $total_ot = 0;
                $total_eot = 0;
                $total_meot = 0;
                $first_date   = date("Y-m-01", strtotime($year_month));
                $second_date  = date("Y-m-t", strtotime($year_month));

                $this->db->select('
                        ot as ot, 
                        eot as eot, 
                        modify_eot as modify_eot,
                        present_status as present_status,
                    ')
                    ->where('shift_log_date BETWEEN "'.$first_date.'" AND "'.$second_date.'"')
                    ->where('emp_id', $value[$i]['emp_id'])
                    ->from('pr_emp_shift_log');
                $logs = $this->db->get()->result_array();
                
                for ($k=0; $k < $last_date; $k++ ){

                    echo "<td style='text-align:center; font-size: 11px'>";
                    if(!empty($logs[$k])){
                        if($logs[$k]['present_status'] == "A"){
                            echo "<span style='background:#CCCCCC;'> ";
                            echo $logs[$k]['present_status'];
                            echo "</span>";
                        } else{
                            echo $logs[$k]['present_status'];
                            echo "<br>";

                            echo $logs[$k]['ot'];
                            echo " + ".$logs[$k]['eot'];

                            $total_ot = $total_ot + $logs[$k]['ot'];
                            $total_eot = $total_eot + $logs[$k]['eot'];	
                            // $total_meot = $total_meot + $logs[$k]['modify_eot'];	
                        }

                        if($logs[$k]['present_status'] == "P")
                        {
                            $p++;
                        }
                        if($logs[$k]['present_status'] == "A")
                        {
                            $a++;
                        }
                        if($logs[$k]['present_status'] == "L")
                        {
                            $l++;
                        }
                        if($logs[$k]['present_status'] == "W")
                        {
                            $w++;
                        }
                        if($logs[$k]['present_status'] == "H")
                        {
                            $h++;
                        }
                    } else {
                        echo "&nbsp;";
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

                // echo "<td style='text-align: center;'> $total_meot </td>";
                echo "<td style='text-align: center;'>";
                echo "$total_ot+$total_eot =";
                echo  $total_ot + $total_eot; 
                echo "</td>";
                echo "</tr>";
                $i++;
           } ?>
        </table>
        <div style="page-break-after:always;"></div>
    <?php //} ?>
</body>
</html>
<br><br><br>
<?php exit(); ?>