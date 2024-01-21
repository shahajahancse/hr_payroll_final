<?php
class Setting_con extends CI_Controller {

	function __construct(){
		parent::__construct();

		/* Standard Libraries */
		$this->data['user_data'] = $this->session->userdata('data');
		$this->load->library('grocery_CRUD');
		$this->load->model('acl_model');
		$this->load->model('common_model');

        if ($this->session->userdata('logged_in') == false) {
            redirect("authentication");
        }
        $this->data['user_data'] = $this->session->userdata('data');
        /*if (!check_acl_list($this->data['user_data']->id, 17)) {
            echo "<SCRIPT LANGUAGE=\"JavaScript\">alert('Sorry! Acess Deny');</SCRIPT>";
            redirect("payroll_con");
            exit;
        }*/
	}

	function crud()
	{
		if ($this->session->userdata('logged_in') == false) {
            redirect("authentication");
        }
		$this->db->order_by('id', 'desc');
		$this->data['data'] = $this->db->get('member_acl_list')->result();
        $this->data['username'] = $this->data['user_data']->id_number;
        $this->data['title'] = 'User Mode';
        $this->data['subview'] = 'settings/acl_access';
        $this->load->view('layout/template', $this->data);
	}

	function acl_access_add(){
		if ($this->db->insert('member_acl_list', array('acl_name' => $this->input->post('acl_name'), 'type' => $this->input->post('type')))) {
			$this->session->set_flashdata('success', 'ACL Added Successfully');
			
		}else{
			$this->session->set_flashdata('failuer', 'ACL Added Failed');
		}
		redirect('setting_con/crud');
	}

	function acl_access_delete($id){
		if ($this->db->delete('member_acl_list', array('id' => $id))) {
			$this->session->set_flashdata('success', 'ACL Deleted Successfully');
		}else{
			$this->session->set_flashdata('failuer', 'ACL Deleted Failed');
		}
		redirect('setting_con/crud');
	}

	public function left_menu_acl()
    {
        if ($this->session->userdata('logged_in') == false) {
            redirect("authentication");
        }
		
		$this->data['users'] = $this->get_member();
		// dd($this->data['users']);
        $this->data['title'] = 'User Access HRM'; 
        $this->data['username'] = $this->data['user_data']->id_number;
		$this->data['subview'] = 'settings/left_menu_acl';
        $this->load->view('layout/template', $this->data);
    }

	public function user_acl_hrm()
    {
        if ($this->session->userdata('logged_in') == false) {
            redirect("authentication");
        }

		$this->data['users'] = $this->get_member();
        $this->data['title'] = 'User Access HRM'; 
        $this->data['username'] = $this->data['user_data']->id_number;
		$this->data['subview'] = 'settings/user_acl_hrm';
        $this->load->view('layout/template', $this->data);
    }

	public function user_acl_pr()
    {
        if ($this->session->userdata('logged_in') == false) {
            redirect("authentication");
        }

		$this->data['users'] = $this->get_member();
		// dd($this->data['users']);
        $this->data['title'] = 'User Access HRM'; 
        $this->data['username'] = $this->data['user_data']->id_number;
		$this->data['subview'] = 'settings/user_acl_pr';
        $this->load->view('layout/template', $this->data);
    }

    function get_member()
    {
    	$this->db->select('members.id, members.id_number, pr_units.unit_name');
    	$this->db->join('pr_units', 'members.unit_name = pr_units.unit_id', 'left');
    	// $this->db->where('members.unit_name !=', '0');
    	$this->db->order_by('members.id', 'desc');
		return $this->db->get('members')->result();
    }

	public function checkbox_get_user_acl_hrm(){
		$id = $this->input->post('id');
		$type = $this->input->post('type');

		$this->db->order_by('id', 'desc');
		$this->db->where('type', $type);
		$this->data['access_list'] = $this->db->get('member_acl_list')->result();

		$this->db->where('username_id', $id);
		$level_list = $this->db->get('member_acl_level')->result();
		$level_array = [];
		foreach ($level_list as $key => $value) {
			$level_array[] = $value->acl_id;
		}
		$this->data['level_array'] = $level_array;
		$this->data['user_id'] = $id;
		echo $this->load->view('settings/chackbox_user_acl_hrm', $this->data, true);
	}

	public function check_level(){
		$id = $this->input->post('id');
		$user_id = $this->input->post('user_id');
		$this->db->where('username_id', $user_id);
		$this->db->where('acl_id', $id);
		$check = $this->db->get('member_acl_level')->num_rows();
		if ($check > 0) {
			$this->db->delete('member_acl_level', array('username_id' => $user_id, 'acl_id' => $id));
		}else{
			$this->db->insert('member_acl_level', array('username_id' => $user_id, 'acl_id' => $id));
		}
	}
	
	public function report_setting(){
		
		if ($this->session->userdata('logged_in') == false) {
            redirect("authentication");
        }
		$this->db->select('pr_units.*');
        $this->data['units'] = $this->db->get('pr_units')->result_array();
		
		$this->db->select('pr_report_setting.*, pr_units.unit_name');
		$this->db->join('pr_units', 'pr_report_setting.unit_id = pr_units.unit_id', 'left');
		$this->db->order_by('id', 'desc');
		$this->data['data'] = $this->db->get('pr_report_setting')->result_array();
        $this->data['username'] = $this->data['user_data']->id_number;
        $this->data['title'] = 'Report setting';
        $this->data['subview'] = 'settings/report_setting';
        $this->load->view('layout/template', $this->data);

	}
	public function report_setting_save($status){
		
		$unit_id = $this->input->post('unit_id');
		$date = date('Y-m-01', strtotime($this->input->post('date')));
		$max_ot = $this->input->post('max_ot');
		$active_status = $this->input->post('active_status');

		$data = array(
			'unit_id' => $unit_id,
			'date' => $date,
			'max_ot' => $max_ot,
			'status' => $active_status,
			'created_by' =>  $this->data['user_data']->id,
		);
		if ($status == '0') {
			$this->db->insert('pr_report_setting', $data);
		}else{
			$this->db->where('id', $status);
			$this->db->update('pr_report_setting', $data);
		}
		echo 'true';
	}
	public function get_report_setting(){
		$id = $this->input->post('id');
		$this->db->where('id', $id);
		$data=$this->db->get('pr_report_setting')->row();
		$data->date=date('Y-m',strtotime($data->date));

		echo json_encode($data);
	}
	public function delete_report_setting(){
		$id = $this->input->post('id');
		$this->db->where('id', $id);
		$this->db->delete('pr_report_setting');
		echo 'true';
	}

	public function dasig_group($id = null, $unit_id = null)
    {
        if ($this->session->userdata('logged_in') == false) {
            redirect("authentication");
        }

		if (!empty($id) && !empty($unit_id)) {
			$dd = $this->get_manage_gd_id($id, $unit_id);
			$this->data['match']     = $dd['match'];
			$this->data['not_match'] = $dd['not_match'];
			$this->data['row'] = $this->db->where('id', $id)->get('emp_group_dasignation')->row(); 
			$this->data['results'] = $this->get_dasignations($unit_id);

			$this->data['title'] = 'Manage Dasignation'; 
			$this->data['subview'] = 'settings/manage_gd';
		} else if(!empty($id)) {
	        $this->data['title'] = 'Edit Dasignation Group'; 
			$this->data['subview'] = 'settings/dasig_group_edit';
		} else {
	        $this->data['units'] = $this->db->get('pr_units')->result();
	        $this->db->select('g.*, u.unit_name')->from('emp_group_dasignation as g')->order_by('u.unit_id', 'ASC');
	        $this->data['groups'] = $this->db->join('pr_units as u', 'g.unit_id = u.unit_id')->get()->result();

			$this->data['subview'] = 'settings/dasig_group';
	        $this->data['title'] = 'Dasignation Group'; 
		}

        $this->data['username'] = $this->data['user_data']->id_number;
        $this->load->view('layout/template', $this->data);
    }

	function dasig_group_add(){
		$data = array(
			'name_en' 	  => $this->input->post('name_en'),
			'name_bn' 	  => $this->input->post('name_bn'),
			'unit_id' 	  => $this->input->post('unit_id'),
			'status'  	  => $this->input->post('status'),
			'updated_by'  => $this->data['user_data']->id,
		);

		if ($this->db->insert('emp_group_dasignation', $data)) {
			$this->session->set_flashdata('success', 'Added Successfully');
		}else{
			$this->session->set_flashdata('failuer', 'Added Failed');
		}
		redirect('setting_con/dasig_group');
	}

	function get_manage_gd_id($id, $unit_id){
		$this->db->select('id')->where('group_id', $id);
		$rows = $this->db->get('emp_designation')->result();
		$data1 = array();
		foreach ($rows as $key => $r) {
			$data1[$key] = $r->id;
		}

		$this->db->select('id')->where('unit_id', $unit_id);
		if (!empty($data1)) {
			$this->db->where_not_in('id', $data1);
		}
		$rows = $this->db->get('emp_designation')->result();
		$data2 = array();
		foreach ($rows as $key => $r) {
			$data2[$key] = $r->id;
		}
		$data = array(
			'match'     => $data1,
			'not_match' => $data2,
		);
		return $data;
	}

	function get_dasignations($unit_id){
		$this->db->select("dg.id, dg.desig_name, dg.unit_id, dg.group_id,  gd.name_en");
		$this->db->from("emp_designation as dg");
		$this->db->join("emp_group_dasignation gd", 'gd.id = dg.group_id', 'left');
		$this->db->where("dg.unit_id", $unit_id);
		$this->db->group_by("dg.id");
		return $this->db->get()->result();
	}

	public function check_level_dg(){

		$id 	 = $this->input->post('id');
		$gd_id   = $this->input->post('gd_id');
		$unit_id = $this->input->post('unit_id');

		$this->db->where('id', $id);
		$this->db->update('emp_designation', array('group_id' => $gd_id));
	}

}

