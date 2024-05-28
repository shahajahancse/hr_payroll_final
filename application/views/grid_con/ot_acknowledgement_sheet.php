<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title> OT <?php if ($status == 2) { echo "Female"; } ?>  Acknowledgement sheet </title>
    <style>
		@media print {
			table {
				widht: 700px !important;
			}
		}
    </style>
</head>

<body style="margin: 0px;">



<!-- heading  -->
    <?php if($status != 2){?>
		<div style="display:flex; justify-content:space-between;width:80%;margin:0 auto">
			<div>Effective Date: 15/01/2022</div>
			<div>Revision: 00</div>
			<div> Doc. Code: HGL/HRD(HR)/03/020</div>
		</div>
	<?php $this->load->view("head_bangla"); }?>
	<p style="text-align:center;font-size:15px; font-weight:bold;font-family:sutonnyMJ"> 
		<?php 
			if ($status == 2) { ?> 
				<div style="display:flex; justify-content:space-between;width:80%;margin:0 auto">
					<div>Effective Date: 15/01/2022</div>
					<div>Revision: 00</div>
					<div>Doc. Code: HGL/HRD(HR)/03/020</div>
 				</div>
				<p style="margin:0 auto;text-align:center;width:80%;font-family:sutonnyMJ ;font-size:20px">dig-35</p>
				<p style="margin:0 auto;text-align:center;width:80%;font-family:sutonnyMJ ;font-size:20px">[aviv 109 wewa 103(1) `«óe¨]</p>
				<p style="margin:0 auto;text-align:center;width:80%;font-family:sutonnyMJ ;font-size:20px">gwnjv‡`i ivwÎKvjxb KvR Kivi m¤§wZcÎ</p>
  			    <p style="margin:0 auto;text-align:center;width:80%;font-family:sutonnyMJ ;font-size:20px"><?php echo date("01/m/Y",strtotime($date))?> Bs nB‡Z <?php echo date("t/m/Y",strtotime($date))?> Bs</p><br>
				<p style="margin:0 auto;text-align:left;width:80%"><span  style="font-family:sutonnyMJ ;line-height:1px;font-size:20px">KviLvbv / c«wZôvbbi bvg :</span> <span style="font-size:13px"> <b><?php echo $unit_name_bangla = $this->db->where("unit_id",$unit_id)->get('pr_units')->row()->unit_name_bangla;?></b></span></p>
				<p style="margin:0 auto;text-align:left;width:80%"><span style="font-family:sutonnyMJ ;line-height:1px;font-size:20px">KviLvbv / c«wZôvbbi  wVKvbv :</span> <span style="font-size:13px"> <b><?php echo $unit_add_bangla = $this->db->where("unit_id",$unit_id)->get('pr_units')->row()->unit_add_bangla;?></b></span></p>
				<p style="font-family:sutonnyMJ ;text-align:justify;width:80%;margin:0 auto">
					Avwg GZØviv †Nvlbv Kwi‡ZwQ †h, e¨e¯’vcbv KZ…©c¶ KZ…©K Kv‡Ri mgq h_vh_ wbivcËv wbwðZ Kivi k‡Z© D³ cÖwZôv‡bi ‰bk cvjvq 
					ivZ 10 NwUKv nB‡Z †fvi 06 NwUKv ch©šÍ KvR Kwi‡Z Avwg m¤§Z iwnqvwQ|
					D³ m¤§wZcÎ Avgvi KZ©„K evwZj bv Kiv nB‡j Dnv 1 gvm ch©šÍ Kvh©Ki _vwK‡e|
				</p>
			<?php }else{?>
				<span style='font-size:18px;'>kÖwgK‡`i AwZwi³ Kg©N›Uvi m¤§wZ cÎ</span>
				<span style='font-size:18px;position:absolute;margin-left:30px'> ZvwiL: <?php echo date("d/m/Y",strtotime($date))?></span>
			<?php }
		?>
	</p>
    <div align="center" style=" margin:0 auto;  overflow:hidden; font-family: 'Times New Roman', Times, serif;">
        <table border="1" cellpadding="0" cellspacing="0" style="font-size:12px;margin-bottom:20px;width:80%;">
            <?php $this->load->model('Grid_model'); $i=1; ?>
			<tr style="font-family:sutonnyMJ;font-size:15px">
				<th style="padding:2px 2px;width:fit-content;">µwgK bs</th>
				<th style="padding:2px 2px;">AvBwW bs</th>
				<th style="padding:2px 2px;">bvg</th>
				<th style="padding:2px 2px;">c`ex</th>
				<th style="padding:2px 2px;"> ‡mKkb / jvBb</th>
				<th style="padding:2px 2px; width:100px">mvÿi</th>
			</tr>
<!-- heading -->

			<?php

			$per_page=22;
			
			
			foreach ($values as $key => $row) {?> 
				<tr>
					<td style="font-size: 13px;width:fit-content;padding:8px;text-align:center;font-family:sutonnyMJ;"><?php echo $key +1; ?></td>
					<td style="font-size: 13;width:fit-content;padding:8px;text-align:center;font-family:sutonnyMJ;"><?php echo $row['emp_id']?></td>
					<td style="font-size: 10px;width:fit-content;padding:8px;text-align:center;white-space:nowrap"><?php echo $row['name_bn']?></td>
					<td style="font-size: 10px;width:fit-content;padding:8px;text-align:center"><?php echo $row['desig_bangla']?></td>
					<td style="font-size: 13px;width:fit-content;padding:8px;text-align:center"><?php echo $row['line_name_bn']?></td>
					<td style="font-size: 13px;width:fit-content;padding:8px;text-align:center"></td>
				</tr>
			<?php

			if ($key!=0 && ($key % $per_page) == 0) {

			?>
			</table>
			</div>
			<br>
			<br>
			<div style="display:flex; justify-content:space-between;width:80%;margin:0 auto">
				<div style="border-top:1px solid black;width:fit-content">Prepared By</div>
				<div style="border-top:1px solid black;width:fit-content"> Check by</div>
				<div style="border-top:1px solid black;width:fit-content"> HR Departmen</div>
			</div>
			<br><br>
			<div style="page-break-after:always"></div>
			<!-- heading  -->
    <?php if($status != 2){?>
		<div style="display:flex; justify-content:space-between;width:80%;margin:0 auto">
			<div>Effective Date: 15/01/2022</div>
			<div>Revision: 00</div>
			<div> Doc. Code: HGL/HRD(HR)/03/020</div>
		</div>
	<?php $this->load->view("head_bangla"); }?>
	<p style="text-align:center;font-size:15px; font-weight:bold;font-family:sutonnyMJ"> 
		<?php 
			if ($status == 2) { ?> 
				<div style="display:flex; justify-content:space-between;width:80%;margin:0 auto">
					<div>Effective Date: 15/01/2022</div>
					<div>Revision: 00</div>
					<div>Doc. Code: HGL/HRD(HR)/03/020</div>
 				</div>
				<br>
				<p style="margin:0 auto;text-align:center;width:80%;font-family:sutonnyMJ ;font-size:20px">dig-35</p>
				<p style="margin:0 auto;text-align:center;width:80%;font-family:sutonnyMJ ;font-size:20px">[aviv 109 wewa 103(1) `«óe¨]</p>
				<p style="margin:0 auto;text-align:center;width:80%;font-family:sutonnyMJ ;font-size:20px">gwnjv‡`i ivwÎKvjxb KvR Kivi m¤§wZcÎ</p>
  			    <p style="margin:0 auto;text-align:center;width:80%;font-family:sutonnyMJ ;font-size:20px"><?php echo date("01/m/Y",strtotime($date))?> Bs nB‡Z <?php echo date("t/m/Y",strtotime($date))?> Bs</p><br>
				<p style="margin:0 auto;text-align:left;width:80%"><span  style="font-family:sutonnyMJ ;line-height:1px;font-size:20px">KviLvbv / c«wZôvbbi bvg :</span> <span style="font-size:13px"> <b><?php echo $unit_name_bangla = $this->db->where("unit_id",$unit_id)->get('pr_units')->row()->unit_name_bangla;?></b></span></p>
				<p style="margin:0 auto;text-align:left;width:80%"><span style="font-family:sutonnyMJ ;line-height:1px;font-size:20px">KviLvbv / c«wZôvbbi  wVKvbv :</span> <span style="font-size:13px"> <b><?php echo $unit_add_bangla = $this->db->where("unit_id",$unit_id)->get('pr_units')->row()->unit_add_bangla;?></b></span></p>
				<p style="font-family:sutonnyMJ ;text-align:justify;width:80%;margin:0 auto">
					Avwg GZØviv †Nvlbv Kwi‡ZwQ †h, e¨e¯’vcbv KZ…©c¶ KZ…©K Kv‡Ri mgq h_vh_ wbivcËv wbwðZ Kivi k‡Z© D³ cÖwZôv‡bi ‰bk cvjvq 
					ivZ 10 NwUKv nB‡Z †fvi 06 NwUKv ch©šÍ KvR Kwi‡Z Avwg m¤§Z iwnqvwQ|
					D³ m¤§wZcÎ Avgvi KZ©„K evwZj bv Kiv nB‡j Dnv 1 gvm ch©šÍ Kvh©Ki _vwK‡e|
				</p>
			<?php }else{?>
				<span style='font-size:18px;'>kÖwgK‡`i AwZwi³ Kg©N›Uvi m¤§wZ cÎ</span>
				<span style='font-size:18px;position:absolute;margin-left:30px'> ZvwiL: <?php echo date("d/m/Y",strtotime($date))?></span>
			<?php }
		?>
	</p>
    <div align="center" style=" margin:0 auto;  overflow:hidden; font-family: 'Times New Roman', Times, serif;">
        <table border="1" cellpadding="0" cellspacing="0" style="font-size:12px;margin-bottom:20px;width:80%;">
            <?php $this->load->model('Grid_model'); $i=1; ?>
			<tr style="font-family:sutonnyMJ;font-size:15px">
				<th style="padding:2px 2px;width:fit-content;">µwgK bs</th>
				<th style="padding:2px 2px;">AvBwW bs</th>
				<th style="padding:2px 2px;">bvg</th>
				<th style="padding:2px 2px;">c`ex</th>
				<th style="padding:2px 2px;"> ‡mKkb / jvBb</th>
				<th style="padding:2px 2px; width:100px">mvÿi</th>
			</tr>
			<!-- heading -->
			<?php }} ?>
		</table>
	</div>
	<br>
	<br>
	<br>
	<div style="display:flex; justify-content:space-between;width:80%;margin:0 auto">
		<div>Prepared By</div>
		<div> Check by</div>
		<div> HR Departmen</div>
	</div>
	<br><br>
</body>
</html>
<?php exit(); ?>
