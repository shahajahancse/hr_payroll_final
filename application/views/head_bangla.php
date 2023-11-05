<div style="font-size:20px; font-weight:bold; line-height: 10px; padding-top: 5px; position:relative; text-align:center; font-family:SolaimanLipi;"><?php 
echo $unit_name_bangla = $this->db->where("unit_id",$unit_id)->get('pr_units')->row()->unit_name_bangla;
//echo $company_name_bangla = $this->common_model->company_information("company_name_bangla"); 
?></div>
<div style="font-size:14px; line-height: 10px;padding-top: 10px; position:relative; font-weight:bold; text-align:center;"> <?php 
echo $unit_add_bangla = $this->db->where("unit_id",$unit_id)->get('pr_units')->row()->unit_add_bangla;
//echo $company_add_bangla = $this->common_model->company_information("company_add_bangla"); 
?></div>