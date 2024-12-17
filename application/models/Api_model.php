<?php
class Api_model extends CI_Model{


	function __construct()
	{
		parent::__construct();

		/* Standard Libraries */
	}


	public function get_dashboard($unit,$department,$section,$line,$date){

		$data["unit"] = $unit;

		//department
		if (empty($department)) {
			$data["department"] = count($this->get_department($unit));
		}else{
			$data["department"] = 1;
		}
		//department

		//section
		if (empty($section)) {
			$data["section"] = count($this->get_section($unit,$department));
		}else{
			$data["section"] = 1;
		}
		//section

		//line
		if (empty($line)) {
			$data["line"] = count($this->get_line($unit,$department,$section));
		}else{
			$data["line"] = 1;
		}
		//line
		$data["designation"] = count($this->get_designation($unit));
		$data["total_manpower"] = $this->get_total_manpower($unit,$department,$section,$line);
		$data["attendance"] = $this->get_attendance($unit,$department,$section,$line,$date);
		$data["salary"] = $this->get_salary($unit,$department,$section,$line,$date);
		//$data["employee_status"] = $this->get_employee_status($unit,$department,$section,$line,$date);
		return $data;
	}

	public function get_designation($unit){
		if (!empty($unit)) {
			$this->db->where("unit_id", $unit);
		}
		$query = $this->db->get("emp_designation");
		return $query->result();
	}
	public function get_department($unit){
		if (!empty($unit)) {
			$this->db->where("unit_id", $unit);
		}
		$query = $this->db->get("emp_depertment");
		return $query->result();
	}

	public function get_section($unit,$department){
		//dd($unit);
		if (!empty($unit)) {
			$this->db->where("unit_id", $unit);
		}
		if (!empty($department)) {
			$this->db->where("depertment_id", $department);
		}
		$query = $this->db->get("emp_section");
		return $query->result();
	}
	public function get_line($unit,$department,$section){
		if (!empty($unit)) {
			$this->db->where("unit_id", $unit);
		}
		if (!empty($department)) {
			$this->db->where("dept_id", $department);
		}
		if (!empty($section)) {
			$this->db->where("section_id", $section);
		}
		$query = $this->db->get("emp_line_num");
		return $query->result();
	}

	public function get_total_manpower($unit,$department,$section,$line){

		$this->db->select("
		SUM(case when pr_emp_per_info.emp_id is null then 0 else 1 end) as total_manpower,
		SUM(case when pr_emp_per_info.gender = 'Male' then 1 else 0 end) as total_male_manpower,
		SUM(case when pr_emp_per_info.gender = 'Female' then 1 else 0 end ) as total_female_manpower
		");
		$this->db->from("pr_emp_per_info");
		$this->db->join("pr_emp_com_info", "pr_emp_per_info.emp_id = pr_emp_com_info.emp_id");
		if (!empty($unit)) {
			$this->db->where("pr_emp_com_info.unit_id", $unit);
		}
		if (!empty($department)) {
			$this->db->where("pr_emp_com_info.emp_dept_id", $department);
		}
		if (!empty($section)) {
			$this->db->where("pr_emp_com_info.emp_sec_id", $section);
		}
		if (!empty($line)) {
			$this->db->where("pr_emp_com_info.emp_line_id", $line);
		}
		$this->db->where("pr_emp_com_info.emp_cat_id", 1);
		//$this->db->group_by("pr_emp_com_info.emp_id");
		$query = $this->db->get()->row();
		return $query;
	}
	public function get_attendance($unit,$department,$section,$line,$date){
		$this->db->select("
		SUM(case when pr_emp_shift_log.present_status = 'P' then 1 else 0 end) as total_present,
		SUM(case when pr_emp_shift_log.present_status = 'A' then 1 else 0 end) as total_absent,
		SUM(case when pr_emp_shift_log.present_status = 'L' then 1 else 0 end) as total_leave,
		SUM(case when pr_emp_shift_log.late_status = 1 then 1 else 0 end) as total_late,
		");
		$this->db->from("pr_emp_per_info");
		$this->db->join("pr_emp_com_info", "pr_emp_per_info.emp_id = pr_emp_com_info.emp_id");
		$this->db->join("pr_emp_shift_log", "pr_emp_per_info.emp_id = pr_emp_shift_log.emp_id");
		$this->db->where("pr_emp_shift_log.shift_log_date", $date);
		if (!empty($unit)) {
			$this->db->where("pr_emp_com_info.unit_id", $unit);
		}
		if (!empty($department)) {
			$this->db->where("pr_emp_com_info.emp_dept_id", $department);
		}
		if (!empty($section)) {
			$this->db->where("pr_emp_com_info.emp_sec_id", $section);
		}
		if (!empty($line)) {
			$this->db->where("pr_emp_com_info.emp_line_id", $line);
		}
		
		$query = $this->db->get()->row();
		return $query;
	}
	public function get_salary($unit,$department,$section,$line,$date){
		$this->db->select("
			SUM(pay_salary_sheet.net_pay) as total_salary,
			SUM(pay_salary_sheet.att_bonus) as total_att_bonus,
			SUM(pay_salary_sheet.ot_hour) as total_ot_hour,
			SUM(pay_salary_sheet.eot_hour) as total_eot_hour,
		");
		$this->db->from("pay_salary_sheet");
		if (!empty($unit)) {
			$this->db->where("pay_salary_sheet.unit_id", $unit);
		}
		if (!empty($department)) {
			$this->db->where("pay_salary_sheet.dept_id", $department);
		}
		if (!empty($section)) {
			$this->db->where("pay_salary_sheet.sec_id", $section);
		}
		if (!empty($line)) {
			$this->db->where("pay_salary_sheet.line_id", $line);
		}
		$this->db->where("pay_salary_sheet.salary_month", date("Y-m-01", strtotime($date)));
		
		$query = $this->db->get()->row();
		return $query;
	}
	public function get_employee_status($unit,$department,$section,$line,$date){
		$this->db->select("
		SUM(case when pr_emp_shift_log.late_status = 1 then 1 else 0 end) as total_late,
		");
		$this->db->from("pr_emp_per_info");
		$this->db->join("pr_emp_com_info", "pr_emp_per_info.emp_id = pr_emp_com_info.emp_id");
		$this->db->where("pr_emp_shift_log.shift_log_date", $date);
		if (!empty($unit)) {
			$this->db->where("pr_emp_com_info.unit_id", $unit);
		}
		if (!empty($department)) {
			$this->db->where("pr_emp_com_info.emp_dept_id", $department);
		}
		if (!empty($section)) {
			$this->db->where("pr_emp_com_info.emp_sec_id", $section);
		}
		if (!empty($line)) {
			$this->db->where("pr_emp_com_info.emp_line_id", $line);
		}
		
		$query = $this->db->get()->row();
		return $query;
	}
}
?>