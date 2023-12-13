<?php
class Acl_con extends CI_Controller {

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
            exit;
        }
	}


	function user_mode()
	{
		if ($this->session->userdata('logged_in') == false) {
            redirect("authentication");
        }
		$this->db->select('pr_setup_com_report.*, members.id_number,pr_units.unit_name');
		$this->db->from('pr_setup_com_report');
		$this->db->join('members', 'members.id = pr_setup_com_report.user_id', 'left');
		$this->db->join('pr_units', 'pr_units.unit_id = pr_setup_com_report.unit_id', 'left');
		$this->db->order_by('id', 'desc');

		$this->data['data'] = $this->db->get()->result();
		$this->data['users'] = $this->db->get('members')->result();
        $this->data['username'] = $this->data['user_data']->id_number;
        $this->data['title'] = 'User Mode';
        $this->data['subview'] = 'acl_con/user_mode';
        $this->load->view('layout/template', $this->data);
	}
	function get_unit_member_id($id){
		$this->db->where('id', $id);
		$unit_name=$this->db->get('members')->row()->unit_name;

		$this->db->where('unit_id', $unit_name);
		echo json_encode($unit=$this->db->get('pr_units')->row());
	}
	function submit_user_mode(){
		$select_user=$this->input->post('select_user');
		$unit_id=$this->input->post('unit_id');
		$start_month=$this->input->post('start_month');
		$end_month=$this->input->post('end_month');
		$user_mode=$this->input->post('user_mode');
		$eot=$this->input->post('eot');
		$status=$this->input->post('status');
		$type=$this->input->post('type');

		$data = array(
			'user_id' => $select_user,
			'unit_id' => $unit_id,
			'start_month' => $start_month,
			'end_month' => $end_month,
			'user_mode' => $user_mode,
			'eot' => $eot,
			'status' => $status
		);
		if ($type==1) {
			if ($this->db->insert('pr_setup_com_report', $data)) {
				$insert_id=$this->db->insert_id();
				$this->db->select('pr_setup_com_report.*, members.id_number,pr_units.unit_name');
				$this->db->from('pr_setup_com_report');
				$this->db->join('members', 'members.id = pr_setup_com_report.user_id', 'left');
				$this->db->join('pr_units', 'pr_units.unit_id = pr_setup_com_report.unit_id', 'left');
				$this->db->where('pr_setup_com_report.id', $insert_id);
				$this->db->order_by('pr_setup_com_report.id', 'desc');
	
				echo json_encode($this->db->get()->row());
			}else{
				echo 'false';
			}
		}else{
			$this->db->where('id', $this->input->post('id'));
			if ($this->db->update('pr_setup_com_report', $data)) {
				$insert_id=$this->input->post('id');
				$this->db->select('pr_setup_com_report.*, members.id_number,pr_units.unit_name');
				$this->db->from('pr_setup_com_report');
				$this->db->join('members', 'members.id = pr_setup_com_report.user_id', 'left');
				$this->db->join('pr_units', 'pr_units.unit_id = pr_setup_com_report.unit_id', 'left');
				$this->db->where('pr_setup_com_report.id', $insert_id);
				$this->db->order_by('pr_setup_com_report.id', 'desc');
				echo json_encode($this->db->get()->row());
			}else{
				echo 'false';
			}
		}
	}
		function delete_user_mode($id){
			$this->db->where('id', $id);
			if ($this->db->delete('pr_setup_com_report')) {
				echo 'true';
			}else{
				echo 'false';
			}

		}
		function edit_user_mode($id){
			$this->db->where('id', $id);
			echo json_encode($this->db->get('pr_setup_com_report')->row());
		}
	














	// old code

	//-------------------------------------------------------------------------------------------------------
	// CRUD output method
	//-------------------------------------------------------------------------------------------------------
	function crud_output($output = null){
		$this->load->view('output.php',$output);
	}
	//-------------------------------------------------------------------------------------------------------
	// Access Control List
	//-------------------------------------------------------------------------------------------------------
	function acl_check($get_user_id){
		$access_level = 11;
		$num_row = $this->db->where('username_id',$get_user_id)->where('acl_id',$access_level)->get('members_acl_level')->num_rows();
		if($num_row > 0){
			return "true";
		}
		else{
			return "false";
		}
	}	


	function acl($start=0){
		$this->data['username'] = $this->data['user_data']->id_number;
		$this->db->select('SQL_CALC_FOUND_ROWS memberss.*, pr_pr_units.pr_units_name', false);
		$this->db->join('pr_pr_units', 'pr_pr_units.pr_units_id = memberss.pr_units_name', 'left');
		$this->data['memberss'] = $this->db->get('memberss')->result_array();
		$this->data['subview'] = 'memberss';
        $this->load->view('layout/template', $this->data);
		// $this->load->view('', $param);
	}

	function members_add(){
		$this->db->select('pr_pr_units.*', false);
		$param['pr_pr_units'] = $this->db->get('pr_pr_units')->result();
		$acls = $this->db->select('cl.*')->get('members_acl_list as cl')->result();
		$param['acls'] = $acls;
		$this->load->view('members_add', $param);
	}

	function members_insert(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('id_number', 'members Name', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');

		$data = array();
		$data['id_number'] = $this->input->post('id_number');
		$data['password'] = $this->input->post('password');
		$data['level'] = $this->input->post('level');
		$data['pr_units_name'] = $this->input->post('pr_units_name');
		$data['status'] = $this->input->post('status');
		$this->db->insert('memberss',$data);
		$id = $this->db->insert_id();

		$acl_count = $this->input->post('acl_id');

		if (count($acl_count)) {
			for ($i=0; $i < count($acl_count); $i++) {
				$acl_data['username_id'] = $id;
				$acl_data['acl_id'] = $this->input->post('acl_id')[$i];
				$acl_data['priority'] = $i;
				$this->db->insert('members_acl_level', $acl_data);
			}
		}

		$this->session->set_flashdata('success','Record Insert successfully!');
		redirect(base_url('index.php/acl_con/acl'));
	}

	function members_edit($id){
		$this->db->select('memberss.*, memberss.pr_units_name as u_id, pr_pr_units.pr_units_name', false);
		$this->db->join('pr_pr_units', 'pr_pr_units.pr_units_id = memberss.pr_units_name', 'left');
        $this->db->where('memberss.id', $id);
		$this->data['members'] = $this->db->get('memberss')->row();

		$acls = $this->db->select('cl.*, mcl.acl_id')
							->join('members_acl_level mcl', 'cl.id = mcl.acl_id and mcl.username_id = "'.$id.'"', 'left')
							->get('members_acl_list as cl')->result();

		$this->data['acls'] = $acls;
        $this->data['username'] = $this->data['user_data']->id_number;

		$this->data['subview'] = 'members_edit';
        $this->load->view('layout/template', $this->data);
		// $this->load->view('', $param);
		// $this->load->view('members_edit', $param);
	}

	function update_members($id=0){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('id_number', 'members Name', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');

		$data = array();
		$data['id_number'] = $this->input->post('id_number');
		$data['password'] = $this->input->post('password');
		$data['level'] = $this->input->post('level');
		$data['pr_units_name'] = $this->input->post('pr_units_name');
		$data['status'] = $this->input->post('status');
		$this->db->where('memberss.id',$id);
		$this->db->update('memberss',$data);

		$acl_count = $this->input->post('acl_id');

		if (count($acl_count)) {
			$this->db->where('members_acl_level.username_id',$id);
			$data=$this->db->delete('members_acl_level');

			for ($i=0; $i < count($acl_count); $i++) {
				$acl_data['username_id'] = $id;
				$acl_data['acl_id'] = $this->input->post('acl_id')[$i];
				$acl_data['priority'] = $i;
				$this->db->insert('members_acl_level', $acl_data);
			}
		}

		$this->session->set_flashdata('success','Record Updated successfully!');
		redirect(base_url('index.php/acl_con/acl'));
	}

	function members_delete($id=0){
		$this->db->where('memberss.id',$id);
		$data=$this->db->delete('memberss');
		$this->session->set_flashdata('success','Record Deleted successfully!');
		redirect(base_url('index.php/acl_con/acl'));
	}


	function acl_copy_08_09_21(){
		$username = $this->session->userdata('username');
		$get_user_id = $this->acl_model->get_user_id($username);
		$acl_check = $this->acl_check($get_user_id );


		$crud = new grocery_CRUD();
	 	$get_session_user_pr_units = $this->common_model->get_session_pr_units_id_name();
		 /*if($get_session_user_pr_units != 0)
		 {
			 $crud->where('memberss.pr_units_name',$get_session_user_pr_units);
			 $crud->where('id_number',$username);

			}*/
			$data = $crud->set_table('memberss');
			// echo "<pre>"; print_r($data); exit;
		$crud->set_subject('User');

		//$crud->set_relation_n_n('ACL', 'members_acl_level', 'members_acl_list', 'username_id', 'acl_id', 'acl_name','priority');
		if($get_session_user_pr_units != 0)
		{
			$crud->set_relation( 'pr_units_name' , 'pr_pr_units','pr_units_name',array('pr_units_id' => $get_session_user_pr_units) );
		}
		else
		{
			$crud->set_relation( 'pr_units_name' , 'pr_pr_units','pr_units_name' );
		}

		//This code use for unset relation n-n
		if($acl_check == "false")
		{
			$crud->unset_add();
			$crud->unset_delete();
			$crud->edit_fields('id_number','password');
			$state = $crud->getState();
			if ($state != 'insert' && $state != 'update') {
			$crud->set_relation_n_n('ACL', 'members_acl_level', 'members_acl_list', 'username_id', 'acl_id', 'acl_name','priority');
			  }
			  $crud->where('memberss.pr_units_name',$get_session_user_pr_units);
			$crud->where('id_number',$username);
		}
		else
		{
			$crud->set_relation_n_n('ACL', 'members_acl_level', 'members_acl_list', 'username_id', 'acl_id', 'acl_name','priority');
		}

		$crud->set_rules('id_number','Username','required|callback_id_number_check');
		$crud->display_as('id_number','Username');
		$crud->required_fields('id_number','password','level');
		$crud->change_field_type('password','password');
		$crud->where('id_number !=','kamrul');
		$output = $crud->render();
		$this->crud_output($output);
	}

	function id_number_check($str){
		$id = $this->uri->segment(4);
		if(!empty($id) && is_numeric($id))
		{
			$mem_id_old = $this->db->where("id",$id)->get('memberss')->row()->id_number;
			$this->db->where("id_number !=",$mem_id_old);
		}
		$num_row = $this->db->where('id_number',$str)->get('memberss')->num_rows();
		if ($num_row >= 1)
		{
			$this->form_validation->set_message('id_number_check', "This ID field '$str' already exists");
			return FALSE;
		}
		else
		{
			$level 		=  $_POST['level'];
			$pr_units_name 	=  $_POST['pr_units_name'];
			if($level == "pr_units")
			{
				if($pr_units_name == "")
				{
					$this->form_validation->set_message('id_number_check', "Please Select pr_units Name.");
					return FALSE;
				}


			}
			else
			{
				if($pr_units_name != "")
				{
					$this->form_validation->set_message('id_number_check', "Don't Select pr_units Name.");
					return FALSE;
				}

			}
			return TRUE;
		}
	}
	// do not run the code
	//  temp table create
	public function temp_create(){
		$result = $this->db->select("emp_id")->get("pr_emp_com_info")->result();
		foreach ($result as $key => $row) {
			// echo "<pre>"; print_r($row->emp_id);
			$emp_id = $row->emp_id;
			if (!$this->db->table_exists("temp_".$emp_id)){
				$query7 = "CREATE TABLE IF NOT EXISTS `temp_$emp_id` (`att_id` int(11) NOT NULL AUTO_INCREMENT, `device_id` int(11) DEFAULT NULL, `proxi_id` int(11) DEFAULT NULL, `date_time` datetime DEFAULT NULL, PRIMARY KEY (`att_id`) ) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";
				$this->db->query($query7);
			}
		}
		echo "done";
	}
}

