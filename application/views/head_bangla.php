
<h3 style="text-align: center;line-height: 1px;"><?php echo $unit_name_bangla = $this->db->where("unit_id",$unit_id)->get('pr_units')->row()->unit_name_bangla;?></h3>
<h5 style="text-align: center;line-height: 1px;"><?php echo $unit_add_bangla = $this->db->where("unit_id",$unit_id)->get('pr_units')->row()->unit_add_bangla;?></h5>
