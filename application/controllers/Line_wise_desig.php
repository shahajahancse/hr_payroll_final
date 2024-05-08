<?php
class Line_wise_desig extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		ini_set('memory_limit', -1);
		ini_set('max_execution_time', 0);
	    set_time_limit(0);
		/* Standard Libraries */
		// $this->load->library('Grocery_crud');
		$this->load->model('Attn_process_model');
		$this->load->model('Log_model');
		$this->load->model('Acl_model');
		$this->load->model('Common_model');
        $this->load->model('grid_model');


        if ($this->session->userdata('logged_in') == false) {
            redirect("authentication");
        }
        $this->data['user_data'] = $this->session->userdata('data');
        if (!check_acl_list($this->data['user_data']->id, 4)) {
            echo "<SCRIPT LANGUAGE=\"JavaScript\">alert('Sorry! Acess Deny');</SCRIPT>";
            redirect("payroll_con");
            exit;
        }
	}



	public function index()
    {
        $this->db->select('pr_emp_per_info.*,pr_emp_com_info.*,pr_units.unit_name,pr_line_num.line_name_en');
        $this->db->from('pr_emp_com_info');
        $this->db->join('pr_units', 'pr_units.unit_id = pr_emp_com_info.unit_id');
        $this->db->join('pr_line_num', 'pr_line_num.id = pr_emp_com_info.emp_line_id');
        $this->db->join('pr_emp_per_info', 'pr_emp_per_info.emp_id = pr_emp_com_info.emp_id', 'left');
        $this->db->where('pr_emp_com_info.attn_sum_line_id IS NOT NULL');
        $this->data['pr_line'] = $this->db->get()->result_array();
        $this->data['title'] = 'Line Wise Designation List';
        $this->data['username'] = $this->data['user_data']->id_number;
        $this->data['subview'] = 'line_wise_desig/list';
        $this->load->view('layout/template', $this->data);
    }

	function add_form()
	{
        if ($this->session->userdata('logged_in') == false) {
            redirect("authentication");
        }
        $this->data['employees'] = array();
        $this->db->select('pr_units.*');
        $this->data['dept'] = $this->db->get('pr_units')->result_array();
        if (!empty($this->data['user_data']->unit_name)) {
	        $this->data['employees'] = $this->Common_model->get_emp_by_unit($this->data['user_data']->unit_name);
        }

        $this->data['username'] = $this->data['user_data']->id_number;
		$this->data['user_id'] = $this->data['user_data']->unit_name;
        $this->data['title'] = 'Line wise designation Add';
        $this->data['subview'] = 'line_wise_desig/add_form';
        $this->load->view('layout/template', $this->data);

	}

	function line_add()
	{
		$line_id = $_POST['line_id'];
		$grid_data = $_POST['spl'];
		$emp_id = explode(',', trim($grid_data));
		foreach ($emp_id as $key => $value) {
            $this->db->where('emp_id', $value);
            $this->db->update('pr_emp_com_info', array('attn_sum_line_id' => $line_id));
		}
		echo '1';
	}

    function line_delete($id)
    {
        $this->db->where('emp_id', $id);
        $this->db->update('pr_emp_com_info', array('attn_sum_line_id' =>null));
        $this->session->set_flashdata('success', 'Record Deleted successfully!');
        redirect(base_url() . 'line_wise_desig');
    }
}
