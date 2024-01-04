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

		


		
		$this->data['data'] = $this->db->get()->result();
		$this->data['users'] = $this->db->get('members')->result();
        $this->data['username'] = $this->data['user_data']->id_number;
        $this->data['title'] = 'User Mode';
        $this->data['subview'] = 'acl_con/user_mode';
        $this->load->view('layout/template', $this->data);
	}
}

