<div align="center" style=" margin:0 auto;  overflow:hidden; font-family: 'Times New Roman', Times, serif;">
<!-- <span style="font-size:18px; font-weight:bold;">
<?php //echo $unit_id;

	//echo $unit_name = $this->db->where("unit_id",$unit_id)->get('pr_units')->row()->unit_name;

   echo $company_name_english = $this->common_model->company_information("company_name_english");
?></span><br /> -->
<!-- <span class="style1" style="font-size:13px; font-weight:bold;"><?php

	//echo $unit_add = $this->db->where("unit_id",$unit_id)->get('pr_units')->row()->unit_add;

	//echo $company_add_english = $this->common_model->company_information("company_add_english");
 ?></span><br /> -->
  <!--<span class="style1" style="font-size:13px; font-weight:bold;">Corporate Office : 8813 NW 23 Street, Miami, FL 33172, USA. </span>-->
<?php $this->load->model('common_model');
	$comInfo = $this->common_model->company_info();
 ?>
<span style="font-size:18px; font-weight:bold;"><?=$comInfo->company_name_english?></span><br/>
	<span class="style1" style="font-size:13px; font-weight:bold;"><?=$comInfo->company_add_english?></span><br/>
	<span class="style1" style="font-size:13px; font-weight:bold;">Phone : <?=$comInfo->company_phone?>, 88-02-9007742</span>
</div>

