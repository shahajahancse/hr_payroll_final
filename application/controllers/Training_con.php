<?php
class Training_con extends CI_Controller {

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
        if (!check_acl_list($this->data['user_data']->id, 3)) {
            echo "<SCRIPT LANGUAGE=\"JavaScript\">alert('Sorry! Acess Deny');</SCRIPT>";
            redirect("payroll_con");
            exit();
        }
	}

	public function index()
	{
		$this->data['subview'] = 'training/training_list';
		$this->load->view('layout', $this->data);
	}
}

