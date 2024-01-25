<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Continuous <?php echo $status; ?> Report</title>
    <link rel="stylesheet" type="text/css" href="../../../../../../css/SingleRow.css" />
</head>

	<style>
		@media print{
			.page_break_t{
				display: block;
				border: none;
			}
			.page_break{
				page-break-before: always;
			}
		}
	</style>
<body>
    <div style="margin:0 auto; width:800px;">
        <?php $this->load->view("head_english");?>
        <div align="center" style=" margin:0 auto;  overflow:hidden; font-family: 'Times New Roman', Times, serif;">
            <span style="font-size:13px; font-weight:bold;">
		<?php echo $status; ?> Report from
		<?php 
			$year= trim(substr($start_date,0,4));
			$month = trim(substr($start_date,5,2));
			$tarik = trim(substr($start_date,8,2));
			$date_format = date("d-M-Y", mktime(0, 0, 0, $month, $tarik, $year));
			echo $date_format;
			
			echo " - TO - ";
			
			$year= trim(substr($end_date,0,4));
			$month = trim(substr($end_date,5,2));
			$tarik = trim(substr($end_date,8,2));
			$date_format = date("d-M-Y", mktime(0, 0, 0, $month, $tarik, $year));
			echo $date_format;
			
		?></span>
		<br />
		<br />
		<table class="sal" border="1" cellpadding="0" cellspacing="0" align="center" style="font-size:13px;">

<<<<<<< HEAD
<<<<<<< HEAD
<?php

	$section=array();
	$i=0;
	$count = count($values["empid"]);
	for($i=0; $i<$count; $i++ ){
=======
                <?php
$section=array();
$i=0;
$r=0;
$per_page=35;
$count = count($values["empid"]);
for($i=0; $i<$count; $i++ )
{
	
>>>>>>> 41bf2ac86bc15436190edb307181b178ed23ee70
	if($section!=$values["sec_name_en"][$i]){
	echo "<tr bgcolor='#CCCCCC'>";
	$r++;
	echo "<td colspan='7' style='font-size:16px'>Section :".$values["sec_name_en"][$i]."</td>";
	echo "</tr>";
<<<<<<< HEAD
?>
		
	<th>SL</th>
	<th>Emp ID</th>
	<th>Name</th>
	<th>Designation</th>
	<th>Line</th>
	<th>Total <?php echo $status; ?></th> 
	<?php
=======
	
	 ?>

			<tr>
				<?php $r++;?>	
                <th>SL</th>
                <th>Emp ID</th>
                <th>Name</th>
                <!--<th>DOJ</th><th>Dept.</th><th>Section</th>-->
                <th> Line</th>
                <th>Designation</th>
                <th>Total <?php echo $status; ?></th>
			</tr>
                <?php
>>>>>>> 41bf2ac86bc15436190edb307181b178ed23ee70
	
	}
	
	echo "<tr>";
	$r++;
	
	echo "<td>";
	echo $i+1;
	echo "</td>";
	
	echo "<td>";
	echo $values["empid"][$i];
	echo "</td>";
<<<<<<< HEAD
=======

>>>>>>> 41bf2ac86bc15436190edb307181b178ed23ee70
	
	echo "<td>";
	echo $values["fullname"][$i];
	echo "</td>";
<<<<<<< HEAD

=======
	
	
>>>>>>> 41bf2ac86bc15436190edb307181b178ed23ee70
	echo "<td>";
	echo $values["line_name"][$i];
	echo "</td>";
	
	echo "<td>";
	echo $values["desig"][$i];
	echo "</td>";
	
	echo "<td style='text-align:center; font-weight:bold;'>";
	echo $values["total"][$i];
	echo "</td>";
	
	echo "<tr>";
	$section=$values["sec_name_en"][$i];
	if ($r==$per_page) {?>
		<tr class="page_break_t" style="border: none;">
			<td colspan="7" class="page_break"></td>
		</tr>
		<?php
		$per_page+=$per_page;
	}
}
?>
            </table>
        </div>
=======
			<?php
				$section=array();
				$i=0;
				$r=0;
				$per_page=35;
				$count = count($values["empid"]);
				for($i=0; $i<$count; $i++ )
				{
					
					if($section!=$values["sec_name_en"][$i]){
					echo "<tr bgcolor='#CCCCCC'>";
					$r++;
					echo "<td colspan='7' style='font-size:16px'>Section :".$values["sec_name_en"][$i]."</td>";
					echo "</tr>";
					
					?>

						<tr>
							<?php $r++;?>	
							<th>SL</th>
							<th>Emp ID</th>
							<th>Name</th>
							<!--<th>DOJ</th><th>Dept.</th><th>Section</th>-->
							<th> Line</th>
							<th>Designation</th>
							<th>Total <?php echo $status; ?></th>
						</tr>
					<?php }
					
					echo "<tr>";
					$r++;
					
					echo "<td>";
					echo $i+1;
					echo "</td>";
					
					echo "<td>";
					echo $values["empid"][$i];
					echo "</td>";
					
					echo "<td>";
					echo $values["fullname"][$i];
					echo "</td>";
					
					
					echo "<td>";
					echo $values["line_name"][$i];
					echo "</td>";
					
					echo "<td>";
					echo $values["desig"][$i];
					echo "</td>";
					
					echo "<td style='text-align:center; font-weight:bold;'>";
					echo $values["total"][$i];
					echo "</td>";
					
					echo "<tr>";
					$section=$values["sec_name_en"][$i];
					// if ($r==$per_page) {?>
					<!-- // 	<tr class="page_break" style="border: none;"> -->
					<!-- // 		<td colspan="7" class="page_break"></td> -->
					<!-- // 	</tr> -->
					<!-- // 	<?php -->
					// 	$per_page+=$per_page;
					// }
				}
			?>
		</table>
	</div>
>>>>>>> d7b5bd89312dc5023d9309a9555592e51dee54b8
</body>

</html>