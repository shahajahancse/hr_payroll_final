<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ID Card English</title>
<link  rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/id_card_style_english.css" media="all" />
<style type="text/css">
.bangla{
font-family:SolaimanLipi;
}
.bijoy{
font-family:SutonnyMJ;
font-size:13px;
}
</style>
</head>

<body>
<?php
//print_r($values);
$i = 0;
$k = 0;
//for($k=0; $k<=100; $k++)
$count = $values->num_rows();
//echo $count;
$div_loop = ceil($count/9);
$data = $values->result_array();

for($j=1; $j<= $div_loop; $j++)
{
?>
<div style="width:8in; height:11.50in; overflow:hidden;">
	<table align="left" border="0" cellpadding="0" cellspacing="0">
	<tr>
	<?php
	//echo "Start".$k."<br>";
	//echo "End".$end = $k + 5;
	//echo "<br>";
	$end = $k + 8;
	$l = 0;
	//$i = 0;
	if($j == $div_loop)
	{
		//echo $div_loop;
		$end1	= $count - (($div_loop-1) *9);
		$last =($div_loop-1) *9;
		//$end = ($count - $div_loop)-1;
	$end = $end1 + ($last - 1);
		//echo "===".$last;
	}
	
	for($k; $i <= $end; $i++)
	{
		//echo $end." | ";
		//echo $i." | ";
		if($l % 3 == 0)
		{
			?>
			</tr><tr>
			<?php
		}
		?>
		<td style="width:2.5in; height:3.5in; "valign='top' align='center'>
	  <div id="container" style="width: 1.99in;height:3in;">
	
	
		 
		 <div id="id" align="center">	
		 
		  <div id="logo"> 
			<img src="<?php  echo base_url();?>images/<?php echo $company_logo = $this->common_model->company_information("company_logo"); ?>" height="33" alt="LOGO" /><br />
			<div style=" margin:0 auto; width:100%; height:auto;font-family:Arial, Helvetica, sans-serif; font-size:10px; font-weight:bold;"><?php echo $company_name_english = $this->common_model->get_unit_name_by_id($unit_id); ?>
			</div>
		  </div>
		  <div id="image"  >
			<img border="1" src="<?php echo base_url();?>uploads/photo/<?php echo $data[$i]["img_source"];?>" height="75"  />
		  </div>
		  
		  <div id="profile" align="left">
		  <table cellpadding="1" cellspacing="0">
		  <tr>
		  <td><b>Name</b> </td><td>:</td><td class="bangla"> <?php echo $data[$i]["emp_full_name"]; ?></td></tr>
			<tr>
		  <td><b>Card No.</b> </td><td>:</td><td > <?php echo $data[$i]["emp_id"] ?></td></tr>
		  
			<tr><td><b>Designation</b> </td><td>:</td><td> <?php echo $data[$i]["desig_name"]; ?></td></tr>
			<tr>
			  <td><b>Section</b> </td><td>:</td><td> <?php echo $data[$i]["sec_name"]; ?></td></tr>
            <tr>
			  <td><b>Line</b> </td><td>:</td><td> <?php echo $data[$i]["line_name"]; ?></td></tr>
			<tr><td><b>DOJ</b> </td><td>:</td><td><?php 
					$join_date = $data[$i]["emp_join_date"]; 
					$year=trim(substr($join_date,0,4));
					$month=trim(substr($join_date,5,2));
					$day=trim(substr($join_date,8,2));
					echo " ".$date_format = date("d-m-y", mktime(0, 0, 0, $month, $day, $year));
				?>	</td></tr>
            <tr><td><b>Sex</b> </td><td>:</td><td> <?php echo $data[$i]["sex_name"]; ?></td></tr>
			<tr>
				<br/><br/><br/><br/><br/>
				</table>
		  </div>
		  
		  <div id="sign"> 
			<span style="position:relative; right:16px;"><img src="<?php echo base_url();?>images/<?php echo $company_signature = $this->common_model->company_information("company_signature"); ?>" width="100" height="auto" /></span>
			<br />
			<span>Holder&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Authorized</span>
		  </div>
		  
		</div>
	   
	  </div>
	  </td>
	  <?php
	$k =$i+1;
	$l++;
	}
	?>
	</tr>
</table>

</div>
<br />
<?php
}
?>

</body>
</html>
