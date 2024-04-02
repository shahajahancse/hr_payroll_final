<div align="center" style=" margin:0 auto;  overflow:hidden; font-family: 'Times New Roman', Times, serif;">
<?php 
	$unit_id = $this->data['user_data']->unit_name;
	$CI =& get_instance();
	$CI->load->model('Common_model');
	$comInfo = $CI->Common_model->company_info($unit_id); 
	// dd($comInfo	); 
 ?>
<span style="font-size:18px; font-weight:bold;"><?=$comInfo->company_name_english?></span><br/>
	<span class="style1" style="font-size:13px; font-weight:bold;"><?=$comInfo->company_add_english?></span><br/>
	<span class="style1" style="font-size:13px; font-weight:bold;">Phone : <?=$comInfo->company_phone?></span>
</div>

