<?php
class Salary_report_con extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		/* Standard Libraries */
		$this->load->model('grid_model');
		$this->load->model('leave_model');
		$this->load->model('acl_model');
		$this->load->model('salary_process_model');
		$access_level = 8;
		$acl = $this->acl_model->acl_check($access_level);
	}

	function grid_salary_report()
	{
		$this->load->view('grid_salary_report');
	}

	function actual_monthly_salary_sheet($type = null)
	{
		$salary_month = date('Y-m-01', strtotime($this->input->post('salary_month')));
		$unit_id 	  = $this->input->post('unit_id');
		$grid_unit	  = $this->input->post('grid_unit');
		$stop_salary  = $this->input->post('stop_salary');
		$status 	  = $this->input->post('status');
		$sql 		  = $this->input->post('sql');
		$grid_emp_id  = explode(',', trim($sql));

		$data["value"] = $this->grid_model->actual_monthly_salary_sheet($salary_month, $stop_salary, $grid_emp_id, $unit_id);
		dd($data["value"]);
		$data["salary_month"] = $salary_month;
		$data["grid_emp_id"]  = $grid_emp_id;
		$data["grid_status"]  = $status;
		$data["unit_id"]      = $unit_id;
		$this->load->view('salary_report/actual_monthly_salary_sheet', $data);
	}


	function grid_actual_monthly_salary_sheet_excel()
	{
		$sal_year_month = $this->input->post('salary_month');
		$grid_status 	= $this->input->post('grid_status');
		$grid_data 		= $this->input->post('grid_emp_id');
		$grid_emp_id = explode(',', trim($grid_data));
		$grid_unit		= $this->input->post('unit_id');
		$this->load->model('common_model');

		$data["value"] = $this->grid_model->grid_actual_monthly_salary_sheet($sal_year_month, $grid_status, $grid_emp_id);
		$data["salary_month"] = $sal_year_month;
		$data["grid_emp_id"] = $grid_emp_id;
		$data["grid_status"]  = $grid_status;
		$data["unit_id"]  = $grid_unit;

		$this->load->view('grid_actual_monthly_salary_sheet_excel', $data);
	}

	function monthly_salary_sheet()
	{
		$sal_year_month = $this->input->post('sal_year_month');
		$custom_salarydate = $this->input->post('custom_salarydate');
		$grid_status 	= $this->input->post('grid_status');
		$grid_data 		= $this->input->post('spl');
		$salary_draw 	= $this->input->post('salary_draw');
		$grid_emp_id = explode('xxx', trim($grid_data));
		$grid_unit		= $this->input->post('unit_id');
		$this->load->model('common_model');

		$data["value"] = $this->grid_model->grid_actual_monthly_salary_sheet($sal_year_month, $grid_status, $grid_emp_id);
		$data["salary_month"] = $sal_year_month;
		$data["grid_emp_id"] = $grid_emp_id;
		$data["grid_status"]  = $grid_status;
		$data["unit_id"]  = $grid_unit;

		$this->load->view('monthly_salary_sheet', $data);
	}

	function monthly_salary_sheet_nine_pm()
	{
		$sal_year_month = $this->input->post('sal_year_month');
		$custom_salarydate = $this->input->post('custom_salarydate');
		$grid_status 	= $this->input->post('grid_status');
		$grid_data 		= $this->input->post('spl');
		$salary_draw 	= $this->input->post('salary_draw');
		$grid_emp_id = explode('xxx', trim($grid_data));
		$grid_unit		= $this->input->post('unit_id');
		$this->load->model('common_model');

		$data["value"] = $this->grid_model->grid_actual_monthly_salary_sheet($sal_year_month, $grid_status, $grid_emp_id);
		$data["salary_month"] = $sal_year_month;
		$data["grid_emp_id"] = $grid_emp_id;
		$data["grid_status"]  = $grid_status;
		$data["unit_id"]  = $grid_unit;
		// echo "<pre>"; print_r($data["value"]); die;

		$this->load->view('monthly_salary_sheet_nine_pm', $data);
		// $this->load->view('salary_sheet_actual',$data);
		//$this->load->view('salary_sheet_actual_with_eot_new',$data);
	}

	function grid_monthly_salary_sheet()
	{
		// exit('ali');
		$sal_year_month = $this->input->post('sal_year_month');
		$grid_status 	= $this->input->post('grid_status');//$this->uri->segment(4);
		$grid_data 		= $this->input->post('spl');//$this->uri->segment(5);
		$grid_emp_id = explode('xxx', trim($grid_data));
		$grid_unit		= $this->input->post('unit_id');
		$this->load->model('common_model');
		//print_r($grid_emp_id);
		$data["deduct_status"]= $this->common_model->get_setup_attributes(1);

		$data["value"] = $this->grid_model->grid_monthly_salary_sheet_com($sal_year_month, $grid_status, $grid_emp_id);
		$data["grid_emp_id"] = $grid_emp_id;
		$data["salary_month"] = $sal_year_month;
		$data["grid_status"]  = $grid_status;
		$data["unit_id"]  = $grid_unit;

		$this->load->view('salary_sheet',$data);
	}

	function grid_monthly_salary_sheet_xl()
	{
		$sal_year_month = $this->input->post('sal_year_month');
		$grid_status 	= $this->input->post('grid_status');//$this->uri->segment(4);
		$grid_data 		= $this->input->post('grid_emp_id');//$this->uri->segment(5);
		$grid_emp_id = explode(',', trim($grid_data));
		$grid_unit		= $this->input->post('unit_id');
		$this->load->model('common_model');
		//print_r($grid_emp_id);
		$data["deduct_status"]= $this->common_model->get_setup_attributes(1);

		$data["value"] = $this->grid_model->grid_monthly_salary_sheet_com($sal_year_month, $grid_status, $grid_emp_id);
		$data["salary_month"] = $sal_year_month;
		$data["grid_status"]  = $grid_status;
		$data["unit_id"]  = $grid_unit;

		$this->load->view('salary_sheet_xl',$data);
	}

	function grid_mix_salary_sheet()
	{
		$sal_year_month = $this->input->post('sal_year_month');
		$custom_salarydate = $this->input->post('custom_salarydate');
		$grid_status 	= $this->input->post('grid_status');
		$grid_data 		= $this->input->post('spl');
		$grid_emp_id = explode('xxx', trim($grid_data));
		$grid_unit		= $this->input->post('unit_id');
		$this->load->model('common_model');
		//print_r($grid_emp_id);
		$data["deduct_status"]= $this->common_model->get_setup_attributes(1);

		$data["value"] = $this->grid_model->grid_mix_salary_sheet($sal_year_month, $grid_status, $grid_emp_id);
		$data["salary_month"] = $sal_year_month;
		$data["grid_emp_id"] = $grid_emp_id;
		$data["grid_status"]  = $grid_status;
		$data["unit_id"]  = $grid_unit;
		$data["custom_salarydate"]  = $custom_salarydate;

		$this->load->view('salary_sheet_mix_com_non_com',$data);
	}

	function grid_actual_monthly_salary_sheet_not_sec()
	{
		// echo "hi";exit;
		$sal_year_month = $this->input->post('sal_year_month');
		$custom_salarydate = $this->input->post('custom_salarydate');
		$grid_status 	= $this->input->post('grid_status');
		$grid_data 		= $this->input->post('spl');
		$salary_draw 	= $this->input->post('salary_draw');
		$grid_emp_id = explode('xxx', trim($grid_data));
		$grid_unit		= $this->input->post('unit_id');
		$this->load->model('common_model');
		//print_r($grid_emp_id);
		$data["deduct_status"]= $this->common_model->get_setup_attributes(1);

		$data["value"] = $this->grid_model->grid_monthly_salary_sheet_all($sal_year_month, $grid_status, $grid_emp_id);
		$data["salary_month"] = $sal_year_month;
		$data["grid_emp_id"] = $grid_emp_id;
		$data["grid_status"]  = $grid_status;
		$data["unit_id"]  = $grid_unit;
		$data["custom_salarydate"]  = $custom_salarydate;

		$this->load->view('salary_sheet_actual_all',$data);
	}

	function grid_actual_monthly_salary_sheet_with_eot_xl()
	{
		$sal_year_month = $this->input->post('sal_year_month');
		$custom_salarydate = $this->input->post('custom_salarydate');
		$grid_status = $this->input->post('grid_status');
		$grid_data 		= $this->input->post('grid_emp_id');
		$grid_emp_id = explode(',', trim($grid_data));
		//$grid_unit = $this->input->post('unit_id');
		$this->load->model('common_model');
		//print_r($grid_emp_id);exit;
		$data["deduct_status"]= $this->common_model->get_setup_attributes(1);

		$data["value"] = $this->grid_model->grid_monthly_salary_sheet($sal_year_month, $grid_status, $grid_emp_id);
		$data["salary_month"] = $sal_year_month;
		$data["grid_emp_id"] = $grid_emp_id;
		$data["grid_status"]  = $grid_status;
		//$data["unit_id"]  = $grid_unit;
		$data["custom_salarydate"]  = $custom_salarydate;

		//$this->load->view('salary_sheet_actual',$data);
		$this->load->view('salary_sheet_actual_with_eot_new_xl',$data);
	}

	function grid_actual_monthly_salary_sheet_with_eot()
	{
		$sal_year_month = $this->input->post('sal_year_month');
		$grid_status 	= $this->input->post('grid_status');//$this->uri->segment(4);
		$grid_data 		= $this->input->post('spl');//$this->uri->segment(5);
		$grid_emp_id = explode('xxx', trim($grid_data));
		$grid_unit		= $this->input->post('unit_id');
		$this->load->model('common_model');
		//print_r($grid_emp_id);
		$data["deduct_status"]= $this->common_model->get_setup_attributes(1);

		$data["value"] = $this->grid_model->grid_monthly_salary_sheet($sal_year_month, $grid_status, $grid_emp_id);
		$data["salary_month"] = $sal_year_month;
		$data["grid_status"]  = $grid_status;
		$data["unit_id"]  = $grid_unit;

		$this->load->view('salary_sheet_actual_with_eot',$data);
	}

	function  grid_monthly_allowance_with_eot()
	{
		$sal_year_month = $this->uri->segment(3);
		$grid_status 	= $this->uri->segment(4);
		$grid_data 		= $this->uri->segment(5);
		$grid_emp_id = explode('xxx', trim($grid_data));
		$this->load->model('common_model');
		//print_r($grid_emp_id);
		$data["deduct_status"]= $this->common_model->get_setup_attributes(1);

		$data["value"] = $this->grid_model->grid_monthly_salary_sheet($sal_year_month, $grid_status, $grid_emp_id);
		$data["salary_month"] = $sal_year_month;
		$data["grid_status"]  = $grid_status;

		$this->load->view('monthly_allowance_with_eot',$data);
	}

	function grid_bank_note_requisition()
	{
		$sal_year_month 	= $this->input->post('sal_year_month');
		$grid_status 	= $this->input->post('grid_status');
		$grid_unit 		= $this->input->post('unit_id');
		$grid_data 		= $this->input->post('spl');
		$grid_emp_id 	= explode('xxx', trim($grid_data));
		$this->load->model('common_model');
		//print_r($grid_emp_id);
		$data["deduct_status"]= $this->common_model->get_setup_attributes(1);

		$data["value"] = $this->grid_model->grid_monthly_salary_sheet($sal_year_month, $grid_status, $grid_emp_id);
		$data["salary_month"] 	= $sal_year_month;
		$data["grid_status"]  	= $grid_status;
		$data["unit_id"]  		= $grid_unit;

		$this->load->view('bank_note_requisition',$data);
	}
	function grid_festival_bonus()
	{
		$sal_year_month 	= $this->input->post('sal_year_month');
		$grid_status 	= $this->input->post('grid_status');
		$grid_unit 		= $this->input->post('unit_id');
		$grid_data 		= $this->input->post('spl');
		$grid_emp_id = explode('xxx', trim($grid_data));
		$this->load->model('common_model');
		$data["deduct_status"]	= $this->common_model->get_setup_attributes(1);
		$data["value"] 			= $this->grid_model->grid_festival_bonus($sal_year_month, $grid_status, $grid_emp_id);
		$data["salary_month"] 	= $sal_year_month;
		$data["grid_status"]  	= $grid_status;
		$data["unit_id"]  		= $grid_unit;

		$this->load->view('festival_bonus_report',$data);
	}

	function grid_advance_salary_sheet()
	{
		//$sal_year_month = $this->uri->segment(3);
		//$grid_status 	= $this->uri->segment(4);
		//$grid_data 		= $this->uri->segment(5);
		$sal_year_month 	= $this->input->post('sal_year_month');
		$grid_status 	= $this->input->post('grid_status');
		$grid_unit 		= $this->input->post('unit_id');
		$grid_data 		= $this->input->post('spl');
		$grid_emp_id = explode('xxx', trim($grid_data));
		$this->load->model('common_model');
		$data["deduct_status"]= $this->common_model->get_setup_attributes(1);
		$data["value"] = $this->grid_model->grid_general_info_another_format($grid_emp_id);
		$data["salary_date1"] = "2014-09-01";
		$data["salary_date2"] = "2014-09-30";
		$data["grid_status"]  = $grid_status;
		//$data["grid_section"]  = $grid_section;
		$data["unit_id"]  	= $grid_unit;

		$this->load->view('advance_salary_sheet_report_compliance',$data);
	}

	function get_deduct_status()
	{
		$this->db->select('deduct_status');
		$this->db->where("id",1);
		$query_ded = $this->db->get('pr_deduct_status');
		$rows_deduct = $query_ded->row();
		$deduct_status = $rows_deduct ->deduct_status;
		return $deduct_status;
	}

	function salary_summary()
	{
		//$salary_month = $this->uri->segment(3);
		//$grid_status = $this->uri->segment(4);
		//$grid_unit = $this->uri->segment(5);
		$salary_month 	= $this->input->post('sal_year_month');
		$grid_status 	= $this->input->post('grid_status');
		$grid_unit 	= $this->input->post('unit_id');
		$stop_salary 	= $this->input->post('stop_salary');

		$data["values"] = $this->grid_model->salary_summary($salary_month,$grid_status,$grid_unit,$stop_salary);
		$data["salary_month"] 	= $salary_month;
		$data["unit_id"] 		= $grid_unit;
		$data["grid_status"] 	= $grid_status;
		//print_r($data);
		$this->load->view('salary_summary',$data);
	}

	function sec_salary_summary()
	{
		//$salary_month = $this->uri->segment(3);
		//$grid_status = $this->uri->segment(4);
		//$grid_unit = $this->uri->segment(5);
		$salary_month 	= $this->input->post('sal_year_month');
		$grid_status 	= $this->input->post('grid_status');
		$grid_unit 	= $this->input->post('unit_id');
		$stop_salary 	= $this->input->post('stop_salary');

		$data["values"] = $this->grid_model->sec_salary_summary($salary_month,$grid_status,$grid_unit,$stop_salary);
		$data["salary_month"] 	= $salary_month;
		$data["unit_id"] 		= $grid_unit;
		$data["grid_status"] 	= $grid_status;
		//print_r($data);
		$this->load->view('sec_salary_summary',$data);
	}

	function salary_summary_compliance(){

		$salary_month 	= $this->input->post('sal_year_month');
		$grid_status 	= $this->input->post('grid_status');
		$grid_unit 	= $this->input->post('unit_id');
		$stop_salary 	= $this->input->post('stop_salary');
		// echo "";exit;
		$data["values"] = $this->grid_model->salary_summary_test($salary_month,$grid_status,$grid_unit,$stop_salary);
		$data["salary_month"]  = $salary_month;
		$data["unit_id"] 	   = $grid_unit;
		$data["grid_status"]   = $grid_status;

		$this->load->view('salary_summary_report_com', $data);
	}

	function salary_summary_test(){

		$salary_month 	= $this->input->post('sal_year_month');
		$grid_status 	= $this->input->post('grid_status');
		$grid_unit 	= $this->input->post('unit_id');
		$stop_salary 	= $this->input->post('stop_salary');
		// echo "";exit;
		$data["values"] = $this->grid_model->salary_summary_test($salary_month,$grid_status,$grid_unit,$stop_salary);
		$data["salary_month"]  = $salary_month;
		$data["unit_id"] 	   = $grid_unit;
		$data["grid_status"]   = $grid_status;

		$this->load->view('salary_summary_report_actual', $data);
	}

	function grid_festival_bonus_summary()
	{

		$salary_month 	= $this->input->post('sal_year_month');
		$grid_status 	= $this->input->post('grid_status');
		$grid_unit 	= $this->input->post('unit_id');

		$data["values"] = $this->grid_model->festival_bonus_summary($salary_month,$grid_status,$grid_unit);
		$data["salary_month"] = $salary_month;
		$data["unit_id"] = $grid_unit;
		$data["grid_status"] = $grid_status;
		//print_r($data);
		$this->load->view('festival_bonus_summary',$data);
	}
	function grid_festival_bonus_summary_sec_wise()
	{

		$salary_month 	= $this->input->post('sal_year_month');
		$grid_status 	= $this->input->post('grid_status');
		$grid_unit 	= $this->input->post('unit_id');

		$data["values"] = $this->grid_model->festival_bonus_summary_sec_wise($salary_month,$grid_status,$grid_unit);
		$data["salary_month"] = $salary_month;
		$data["unit_id"] = $grid_unit;
		$data["grid_status"] = $grid_status;
		//print_r($data);
		$this->load->view('festival_bonus_summary_sec_wise',$data);
	}

	function grid_comprative_salary_statement()
	{

		$salary_month 	= $this->input->post('sal_year_month');
		$salary_month2 	= $this->input->post('sal_year_month2');
		$grid_status 	= $this->input->post('grid_status');
		$grid_unit 	= $this->input->post('unit_id');
		$stop_salary 	= $this->input->post('stop_salary');

		$data["values"] = $this->grid_model->grid_comprative_salary_statement($salary_month,$salary_month2,$grid_status,$grid_unit,$stop_salary);

		$salary_month = date('F-Y', strtotime($salary_month));
		$salary_month2 = date('F-Y', strtotime($salary_month2));
		$data["unit_id"] = $grid_unit;
		$data["first_month"] = $salary_month;
		$data["second_month"] = $salary_month2;
		$data["grid_status"] = $grid_status;
		//print_r($data);
		$this->load->view('comprative_salary_statement_summary',$data);
	}

	function eot_summary_report()
	{
		//$salary_month = $this->uri->segment(3);
		//$grid_status = $this->uri->segment(4);
		//$grid_unit = $this->uri->segment(5);
		$salary_month 	= $this->input->post('sal_year_month');
		$grid_status 	= $this->input->post('grid_status');
		$grid_unit 	= $this->input->post('unit_id');
		$stop_salary 	= $this->input->post('stop_salary');
		$data["values"] = $this->grid_model->eot_summary_report($salary_month,$grid_status,$grid_unit,$stop_salary);
		$data["salary_month"] = $salary_month;
		$data["grid_status"] = $grid_status;
		$data["unit_id"] = $grid_unit;
		//print_r($data);
		$this->load->view('eot_summary',$data);
	}
	function eot_summary_report_sec()
	{
		//$salary_month = $this->uri->segment(3);
		//$grid_status = $this->uri->segment(4);
		//$grid_unit = $this->uri->segment(5);
		$salary_month 	= $this->input->post('sal_year_month');
		$grid_status 	= $this->input->post('grid_status');
		$grid_unit 	= $this->input->post('unit_id');
		$stop_salary 	= $this->input->post('stop_salary');
		$data["values"] = $this->grid_model->eot_summary_report_sec($salary_month,$grid_status,$grid_unit,$stop_salary);
		$data["salary_month"] = $salary_month;
		$data["grid_status"] = $grid_status;
		$data["unit_id"] = $grid_unit;
		//print_r($data);
		$this->load->view('eot_summary_sec',$data);
	}
	function grid_pay_slip()
	{
		$grid_firstdate = $this->input->post('year_month');
		$grid_data = $this->input->post('spl');
		$grid_unit = $this->input->post('unit_id');
		$grid_emp_id = explode('xxx', trim($grid_data));

		$year_month = date("Y-m", strtotime($grid_firstdate));
		$query['unit_id'] = $grid_unit;
		$query['values'] = $this->grid_model->grid_pay_slip($year_month, $grid_emp_id);
		if(is_string($query['values']))
		{
			echo $query['values'];
		}
		else
		{
			$this->load->view('pay_slip',$query);
		}
	}	

	function grid_pay_slip_com()
	{
		$grid_firstdate = $this->input->post('year_month');
		$grid_data = $this->input->post('spl');
		$grid_unit = $this->input->post('unit_id');
		$grid_emp_id = explode('xxx', trim($grid_data));

		$year_month = date("Y-m", strtotime($grid_firstdate));
		$query['unit_id'] = $grid_unit;
		$query['values'] = $this->grid_model->grid_pay_slip($year_month, $grid_emp_id);
		if(is_string($query['values']))
		{
			echo $query['values'];
		}
		else
		{
			$this->load->view('grid_pay_slip_com',$query);
		}
	}

	function grid_pay_slip_actual()
	{
		$grid_firstdate = $this->input->post('year_month');
		$grid_data = $this->input->post('spl');
		$grid_unit = $this->input->post('unit_id');
		$grid_emp_id = explode('xxx', trim($grid_data));

		$year_month = date("Y-m", strtotime($grid_firstdate));
		$query['unit_id'] = $grid_unit;
		$query['values'] = $this->grid_model->grid_pay_slip($year_month, $grid_emp_id);
		// echo "<pre>"; print_r($query['values']); die;
		if(is_string($query['values']))
		{
			echo $query['values'];
		}
		else
		{
			$this->load->view('grid_pay_slip_actual',$query);
		}
	}
	

	function grid_pay_slip_non_compliance()
	{
		$grid_firstdate = $this->input->post('year_month');//$this->uri->segment(3);
		$grid_data = $this->input->post('spl');
		$grid_unit = $this->input->post('unit_id');
		$grid_emp_id = explode('xxx', trim($grid_data));

		$year_month = date("Y-m", strtotime($grid_firstdate));
		$query['unit_id'] = $grid_unit;
		$query['values'] = $this->grid_model->grid_pay_slip_non_compliance($year_month, $grid_emp_id);
		if(is_string($query['values']))
		{
			echo $query['values'];
		}
		else
		{
			$this->load->view('pay_slip_actual',$query);
		}
	}

	function grid_pay_slip_com_non_com_mix()
	{
		$grid_firstdate = $this->input->post('year_month');//$this->uri->segment(3);
		$grid_data = $this->input->post('spl');
		$grid_unit = $this->input->post('unit_id');
		$grid_emp_id = explode('xxx', trim($grid_data));

		$year_month = date("Y-m", strtotime($grid_firstdate));
		$query['unit_id'] = $grid_unit;
		$query['values'] = $this->grid_model->grid_pay_slip_com_non_com_mix($year_month, $grid_emp_id);
		if(is_string($query['values']))
		{
			echo $query['values'];
		}
		else
		{
			$this->load->view('com_non_com_pay_slip',$query);
		}
	}


	function grid_provident_fund()
	{
		$this->load->model('salary_process_model');
		$grid_firstdate = $this->uri->segment(3);
		$grid_data = $this->uri->segment(4);
		$grid_emp_id = explode('xxx', trim($grid_data));

		$year_month = date("Y-m", strtotime($grid_firstdate));
		$query["salary_month"] = $grid_firstdate;
		$query['values'] = $this->grid_model->grid_provident_fund($year_month, $grid_emp_id);
		if(is_string($query['values']))
		{
			echo $query['values'];
		}
		else
		{
			$this->load->view('provident_fund',$query);
		}
	}

	function grid_maternity_benefit(){
		$grid_year = $this->uri->segment(3);
		$grid_data = $this->uri->segment(4);
		$grid_emp_id = explode('xxx', trim($grid_data));
		$data["values"] = $this->leave_model->grid_maternity_benefit($grid_emp_id,$grid_year);
		$this->load->view('maternity_benefit',$data);
	}

	function grid_earn_leave()
	{
		$sal_year_month = $this->uri->segment(3);
		$grid_status 	= $this->uri->segment(4);
		$grid_data 		= $this->uri->segment(5);
		$grid_emp_id = explode('xxx', trim($grid_data));
		$this->load->model('common_model');
		//print_r($grid_emp_id);
		$data["deduct_status"]= $this->common_model->get_setup_attributes(1);

		$data["value"] = $this->grid_model->grid_earn_leave($sal_year_month, $grid_status, $grid_emp_id);
		$data["salary_month"] = $sal_year_month;
		$data["grid_status"]  = $grid_status;

		//$this->load->view('salary_sheet_actual_with_eot',$data);
	}

	function grid_monthly_eot_sheet()
	{

		$sal_year_month = $this->input->post('sal_year_month');
		$grid_status 	= $this->input->post('grid_status');
		$grid_data 		= $this->input->post('spl');
		$grid_emp_id 	= explode('xxx', trim($grid_data));
		$grid_unit		= $this->input->post('unit_id');
		$this->load->model('common_model');
		//print_r($grid_emp_id);
		$data["deduct_status"]= $this->common_model->get_setup_attributes(1);
		$data["value"] = $this->grid_model->grid_monthly_salary_sheet($sal_year_month, $grid_status, $grid_emp_id);

		$data["salary_month"] = $sal_year_month;
		$data["grid_status"]  = $grid_status;
		$data["unit_id"]  = $grid_unit;

		$this->load->view('salary_sheet_for_eot',$data);
	}

	function grid_monthly_allowance_sheet()
	{
		$sal_year_month = $this->input->post('sal_year_month');
		$grid_status 	= $this->input->post('grid_status');
		$grid_data 		= $this->input->post('spl');
		$grid_emp_id = explode('xxx', trim($grid_data));
		$grid_unit		= $this->input->post('unit_id');
		$this->load->model('common_model');
		//print_r($grid_emp_id);
		$data["deduct_status"]= $this->common_model->get_setup_attributes(1);

		$data["value"] = $this->grid_model->grid_monthly_salary_sheet_for_allowance($sal_year_month, $grid_status, $grid_emp_id);
		$data["salary_month"] = $sal_year_month;
		$data["grid_status"]  = $grid_status;
		$data["unit_id"]  	= $grid_unit;

		$this->load->view('salary_sheet_for_allowance',$data);
	}


	function grid_monthly_weekend_allowance_sheet()
	{
		$sal_year_month = $this->input->post('sal_year_month');
		$grid_status 	= $this->input->post('grid_status');
		$grid_data 		= $this->input->post('spl');
		$grid_emp_id = explode('xxx', trim($grid_data));
		$grid_unit		= $this->input->post('unit_id');
		$this->load->model('common_model');
		//print_r($grid_emp_id);
		$data["deduct_status"]= $this->common_model->get_setup_attributes(1);

		$data["value"] = $this->grid_model->grid_monthly_salary_sheet_for_weeekend_allowance($sal_year_month, $grid_status, $grid_emp_id);
		$data["salary_month"] = $sal_year_month;
		$data["grid_status"]  = $grid_status;
		$data["unit_id"]  	= $grid_unit;

		$this->load->view('salary_sheet_for_weekend_allowance',$data);
	}

	function grid_monthly_stop_sheet()
	{

		$sal_year_month = $this->input->post('sal_year_month');
		$grid_status 	= $this->input->post('grid_status');
		$grid_data 		= $this->input->post('spl');
		$grid_emp_id 	= explode('xxx', trim($grid_data));
		$grid_unit		= $this->input->post('unit_id');
		$this->load->model('common_model');
		//print_r($grid_emp_id);
		$data["deduct_status"]= $this->common_model->get_setup_attributes(1);
		$data["value"] = $this->grid_model->grid_monthly_stop_sheet($sal_year_month, $grid_status, $grid_emp_id);
		if($data["value"]=="Requested List Is Empty")
		{
			echo $data["value"];
		}
		else{
			$data["salary_month"] = $sal_year_month;
			$data["grid_status"]  = $grid_status;
			$data["unit_id"]  = $grid_unit;

			$this->load->view('stop_salary_sheet',$data);
		}
	}

	// function office_start_time()
	// {
	// 	$this->db->select('*');
	// 	$this->db->from('pr_emp_com_info');
	// 	$emp=$this->db->get()->row();


	// 	$table = 'att_2018_04';
	// 	$this->db->select('*');
	// 	$this->db->from($table);
	// 	$this->db->where('trim(substr(date_time,1,10)) >=','2018-04-26');
	// 	$this->db->where('trim(substr(date_time,1,10)) <=','2018-04-30');
	// 	$this->db->order_by('trim(substr(date_time,1,10)) <=','2018-04-30');
	// 	$sql=$this->db->get()->row();

	// 	foreach ($sql as $item) {

	// 	}
	// 	echo '<pre>';
	// 	print_r($sql);

	// }


}

