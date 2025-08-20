<div align="center" style=" margin:0 auto;  overflow:hidden; font-family: 'Times New Roman', Times, serif;">
	<?php
		if (empty($unit_id)) {
			$unit_ids = $this->session->userdata('data');
			if ($unit_ids->unit_name == 0) {
				echo "Please Login as unit user (Not allow Super admin)";
				exit();
			} 
		} 
		$CI =& get_instance();
		$CI->load->model('Common_model');
		$comInfo = $CI->Common_model->company_info($unit_id);
	?>
	<span style="font-size:18px; font-weight:bold;"><?=$comInfo->company_name_english?></span><br/>
	<span class="style1" style="font-size:13px; font-weight:bold;"><?=$comInfo->company_add_english?></span><br/>
</div>