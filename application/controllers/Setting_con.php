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
        if (!check_acl_list($this->data['user_data']->id, 17)) {
            echo "<SCRIPT LANGUAGE=\"JavaScript\">alert('Sorry! Acess Deny');</SCRIPT>";
            redirect("payroll_con");
            exit;
        }
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
        $this->data['title'] = 'User Access HRM'; 
        $this->data['username'] = $this->data['user_data']->id_number;
		$this->data['subview'] = 'settings/user_acl_pr';
        $this->load->view('layout/template', $this->data);
    }

    function get_member()
    {
    	$this->db->select('members.id, members.id_number, pr_units.unit_name');
    	$this->db->join('pr_units', 'members.unit_name = pr_units.unit_id', 'left');
    	$this->db->where('members.unit_name !=', '0');
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
}

