<?php
class Earn_leave_con extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
		/* Standard Libraries */
		$this->load->library('grocery_CRUD');
		$this->load->model('earn_leave_model');
		$this->load->model('common_model');
		$this->load->model('log_model');
		set_time_limit(0);
		ini_set("memory_limit","512M");
		$this->load->model('acl_model');
		$access_level = 7;
		$acl = $this->acl_model->acl_check($access_level);
	}
	
	function earn_process_form()
	{

		$crud = new grocery_CRUD();
		$get_session_user_unit = $this->common_model->get_session_unit_id_name();
		if($get_session_user_unit != 0)
		{
			$crud->where('pr_earn_leave_block.unit_id',$get_session_user_unit);
		}
		$crud->set_table('pr_earn_leave_block');
		$crud->set_subject('Salary Block');
		$crud->display_as('block_year','Final Year');
		$crud->order_by('block_year','desc');
			if($get_session_user_unit != 0)
			{
				$crud->set_relation( 'unit_id' , 'pr_units','unit_name',array('unit_id' => $get_session_user_unit));
			}
			else
			{
				$crud->set_relation( 'unit_id' , 'pr_units','unit_name' );
			}
		$crud->unset_columns('status');
		$crud->unset_delete();
		$crud->unset_add();
		$crud->unset_edit();
		$output = $crud->render();
		$this->load->view('form/earn_leave_process',$output);
	}
	
	function earn_leave_process(){
		$month_year = $this->input->post('month_year');
		$ids = explode(',', trim($this->input->post('emp_ids')));
		$type = $this->input->post('type');
		// dd($this->input->post('emp_ids'));
		$result = $this->earn_leave_model->earn_leave_process_db($ids,$type,$month_year);
		echo $result;
	}
	function grid_earn_report()
	{
		$this->load->view('grid_earn_report');
	}
	
	function grid_earn_leave_general_info()
	{
		$year 			= $this->input->post('year');
		$firstdate 		= $this->input->post('firstdate');
		$seconddate 	= $this->input->post('seconddate');
		$grid_status 	= $this->input->post('grid_status');
		$unit_id		= $this->input->post('unit_id');	
		$grid_data 		= $this->input->post('spl');
		$grid_emp_id = explode('xxx', trim($grid_data));
		//print_r($grid_emp_id);
		$data["values"] = $this->earn_leave_model->grid_earn_leave_general_info($firstdate,$seconddate, $year, $grid_status, $grid_emp_id);
		$data["unit_id"] = $unit_id;
		$data["year"] = $year;
		if($data["values"] == "empty")
		{
			echo "Requested List Is Empty.";
			
		}
		elseif($data["values"] =="Not Process")
		{
			echo "Please Process Earn Leave for $year";
		}
		else
		{
			$this->load->view('earn_leave_general_info_report',$data);
		}
	}
	
	function grid_earn_leave_payment_buyer()
	{
		$year 			= $this->input->post('year');
		$status 	= $this->input->post('status');
		$unit_id		= $this->input->post('unit_id');	
		$grid_data 		= $this->input->post('spl');
		$grid_emp_id = explode('xxx', trim($grid_data));
		$data["values"] = $this->earn_leave_model->grid_earn_leave_payment_buyer($year, $status, $grid_emp_id);
		$data["unit_id"] = $unit_id;
		$data["year"] = $year;
		// dd($data);
		if($data["values"] == "empty")
		{
			echo "Requested List Is Empty.";
			
		}
		elseif($data["values"] =="Not Process")
		{
			echo "Please Process Earn Leave for $year";
		}
		else
		{
			$this->load->view('earn_leave_general_info_report_buyer',$data);
		}
	}
	function grid_earn_leave_summery()
	{
		$year			= $this->input->post('year');
		$grid_status 	= $this->input->post('grid_status');
		$unit_id		= $this->input->post('unit_id');	
		$grid_data 		= $this->input->post('spl');
		$grid_emp_id = explode('xxx', trim($grid_data));
		//print_r($grid_emp_id);
		$data["values"] = $this->earn_leave_model->grid_earn_leave_summery($unit_id,$year);
		$data["unit_id"] = $unit_id;
		$data["year"] = $year;
		if($data["values"] == "empty")
		{
			echo "Requested List Is Empty.";
		}
		elseif($data["values"] =="Not Process")
		{
			echo "Please Process Earn Leave for $year";
		}
		else
		{
			$this->load->view('earn_leave_summery_report',$data);
		}
	}
	function grid_earn_leave_payment()
	{
		$sal_year_month = $this->input->post('sal_year_month');
		$grid_status 	= $this->input->post('grid_status');
		$unit_id		= $this->input->post('unit_id');	
		$grid_data 		= $this->input->post('spl');
		$grid_emp_id = explode('xxx', trim($grid_data));
		
		$data["values"] = $this->earn_leave_model->grid_earn_leave_general_info($sal_year_month, $grid_status, $grid_emp_id);
		//print_r($data);
		$data["unit_id"] = $unit_id;
		$data["year_month"] = $sal_year_month;
		if($data["values"] == "empty")
		{
			echo "Requested List Is Empty.";
			
		}
		else
		{
			$this->load->view('earn_leave_payment_report',$data);
		}
	}
	
	
	function earn_leave_payment()
	{
		
		$data["values"] = $this->earn_leave_model->earn_leave_payment_db();
		echo "Data Inserted Successfully!";
	}
	
	function grid_earn_leave_payment_at_atime()
	{
		
		$sal_year_month = $this->input->post('sal_year_month');
		$grid_status 	= $this->input->post('grid_status');
		$unit_id		= $this->input->post('unit_id');	
		$grid_data 		= $this->input->post('spl');
		$grid_emp_id = explode('xxx', trim($grid_data));
		$data["values"] = $this->earn_leave_model->grid_earn_leave_general_info($sal_year_month, $grid_status, $grid_emp_id);
		$data["unit_id"] = $unit_id;
		$data["year_month"] = $sal_year_month;
		if($data["values"] == "empty")
		{
			echo "Requested List Is Empty.";
			
		}
		else
		{
			$this->load->view('earn_leave_payment_at_atime',$data);
		}
	}
	
	function all_search()
	{
		$dept 	= $this->uri->segment(3);
		$section= $this->uri->segment(4);
		$line	= $this->uri->segment(5);
		$desig	= $this->uri->segment(6);
		$sex	= $this->uri->segment(7);
		$status	= $this->uri->segment(8);
		$unit	= $this->uri->segment(9);
		
		$this->db->select('pr_emp_per_info.*');
		$this->db->from('pr_emp_per_info');
		$this->db->from('pr_emp_com_info');
		$this->db->where('pr_emp_per_info.emp_id = pr_emp_com_info.emp_id');
		$this->db->where('pr_emp_com_info.unit_id',$unit);
		
		if($dept !="Select")
		{
			$this->db->where("pr_emp_com_info.emp_dept_id", $dept);
		}
		if($section !="Select")
		{
			$this->db->where("pr_emp_com_info.emp_sec_id", $section);
		}
		if($line !="Select")
		{
			$this->db->where("pr_emp_com_info.emp_line_id ", $line);
		}
		if($desig !="Select")
		{
			$this->db->where("pr_emp_com_info.emp_desi_id", $desig);
		}
		if($sex !="Select")
		{
			$this->db->where("pr_emp_per_info.emp_sex", $sex);
		}
		if($status !="Select")
		{
			if($status != 'ALL')
			{
				$this->db->where("pr_emp_com_info.emp_cat_id", $status);
			}
		}
		$this->db->order_by("pr_emp_com_info.emp_id");
		$query = $this->db->get();
		//echo $this->db->last_query();
		$i = 0;
		foreach($query->result_array() as $row)
		{
			$responce->rows[$i]['id']=$row['emp_id'];
			$responce->rows[$i]['cell']=array($row['emp_id'],$row['emp_full_name'],$row['emp_dob']);
			$i++;
		}
		echo json_encode($responce);
		exit;
		
	}
	function get_all_data()
	{
		$units	= $this->uri->segment(3);
		
		$this->db->select('pr_emp_per_info.*');
		$this->db->from('pr_emp_per_info');
		$this->db->from('pr_emp_com_info');
		$this->db->where('pr_emp_per_info.emp_id = pr_emp_com_info.emp_id');
		$this->db->where('pr_emp_com_info.unit_id',$units);
		$this->db->order_by("pr_emp_com_info.emp_id");
		$query = $this->db->get();
		//echo $this->db->last_query();
		$i = 0;
		foreach($query->result_array() as $row)
		{
			$responce->rows[$i]['id']=$row['emp_id'];
			$responce->rows[$i]['cell']=array($row['emp_id'],$row['emp_full_name'],$row['emp_dob']);
			$i++;
		}
		echo json_encode($responce);
		exit;

		
	}
	
}


?>
