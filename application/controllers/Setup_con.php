<?php
class Setup_con extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		/* Standard Libraries */
		$this->load->library('grocery_CRUD');
		$this->load->model('acl_model');
		$this->load->model('common_model');
		$this->load->library('pagination_bootstrap');
		$this->load->helper('url');

		if($this->session->userdata('logged_in')==FALSE)
		{
			redirect("authentication");
		}
		$this->data['user_data'] = $this->session->userdata('data');
		if (!check_acl_list($this->data['user_data']->id,2)) {
			echo "<SCRIPT LANGUAGE=\"JavaScript\">alert('Sorry! Acess Deny');</SCRIPT>";
			redirect("payroll_con");
			exit;
		}
	}

	//----------------------------------------------------------------------------------
	// CRUD for Department
	//----------------------------------------------------------------------------------
	function department($start=0)
	{

		$this->load->library('pagination');
		$limit = 10;
		$config['base_url'] = base_url()."setup_con/department/";
		$config['per_page'] = $limit;

		$condition = 0;
		if ($this->input->get('request')) {
			$query = $this->input->get('request');
			$condition = "(pr_units.unit_name LIKE '" . $query . "%' OR emp_depertment.dept_name LIKE '%" . $query . "%' OR emp_depertment.dept_bangla LIKE '%" . $query . "%')";
		}

		$this->load->model('crud_model');
		$pr_dept = $this->crud_model->dept_infos($limit,$start, $condition);
		$total = $this->db->query("SELECT FOUND_ROWS() as count")->row()->count;
		$config['total_rows'] = $total;
		$config["uri_segment"] = 3;
		 // $this->load->library('pagination');

		 $this->pagination->initialize($config);
		 $this->data['links'] = $this->pagination->create_links();
  		 $this->data['pr_dept'] = $pr_dept;

  		 // dd($this->data);

		$this->data['title'] = 'Department List';
		$this->data['username'] = $this->data['user_data']->id_number;

		$this->data['subview'] = 'setup/dept_list';
		$this->load->view('layout/template', $this->data);
	}

	// Department create
	function dept_add(){

	 	$this->db->select('pr_units.*');
        $this->data['dept'] = $this->db->get('pr_units')->result_array();

	 	$this->form_validation->set_rules('dept_name', 'dept Name', 'trim|required');
	 	$this->form_validation->set_rules('dept_bangla', 'dept Bangla Name', 'trim|required');

		if($this->form_validation->run() == true)
		{
            $formArray = array(
            	'dept_name' => $this->input->post('dept_name'),
            	'dept_bangla' => $this->input->post('dept_bangla'),
            	'unit_id' => $this->input->post('unit_id'),
            );

			if ($this->db->insert('emp_depertment',$formArray)) {
				$this->session->set_flashdata('success','Record adder successfully!');
			} else {
				$this->session->set_flashdata('failuer','Sorry!, Something wrong.');
			}
			redirect(base_url('setup_con/department'));
		}

    	$this->data['title'] = 'Add Department';
		$this->data['username'] = $this->data['user_data']->id_number;

		$this->data['subview'] = 'setup/dept_add';
		$this->load->view('layout/template', $this->data);
	}

	// department update
	function dept_edit($deptId)
	{
	 	$this->db->select('pr_units.*');
        $this->data['dept'] = $this->db->get('pr_units')->result_array();

	 	$this->form_validation->set_rules('dept_name', 'dept Name', 'trim|required');
	 	$this->form_validation->set_rules('dept_bangla', 'dept Bangla Name', 'trim|required');

	 	if($this->form_validation->run() == false)
		{
			$this->db->where('dept_id',$deptId);
        	$this->data['pr_dept'] = $this->db->get('emp_depertment')->row();

        	$this->data['title'] = 'Update Department';
			$this->data['username'] = $this->data['user_data']->id_number;
	
			$this->data['subview'] = 'setup/dept_edit';
			$this->load->view('layout/template', $this->data);
		}
		else
		{
        
            $formArray = array(
            	'dept_name' => $this->input->post('dept_name'),
            	'dept_bangla' => $this->input->post('dept_bangla'),
            	'unit_id' => $this->input->post('unit_id'),
            );
            $this->db->where('dept_id',$deptId);
            $this->db->update('emp_depertment',$formArray);

			$this->session->set_flashdata('success','Record Updated successfully!');
				//alert('Record adder successfully!');
			redirect('/setup_con/department');
		}
	}

	// Department delete
	function dept_delete($deptId)
	{
		$dept =  $this->db->where('dept_id',$deptId)->get('emp_depertment')->row();
		if (empty($dept)) {
			$this->session->set_flashdata('failuer','Record Not Found in DataBase!');
			redirect('setup_con/department');
		}
		$this->db->where('dept_id',$deptId)->delete('emp_depertment');
		$this->session->set_flashdata('success','Record Deleted successfully!');
			redirect('setup_con/department');
	}
	//----------------------------------------------------------------------------------
	// CRUD End for Department
	//----------------------------------------------------------------------------------


	//----------------------------------------------------------------------------------
	// CRUD for Post Office
	//----------------------------------------------------------------------------------
	function post_office($start=0)
	{

		$this->load->library('pagination');
		$limit = 10;
		$config['base_url'] = base_url()."setup_con/post_office/";
		$config['per_page'] = $limit;

		$condition = 0;
		if ($this->input->get('request')) {
			$query = $this->input->get('request');
			$condition = "(pr_units.unit_name LIKE '" . $query . "%' OR emp_depertment.dept_name LIKE '%" . $query . "%' OR emp_depertment.dept_bangla LIKE '%" . $query . "%')";
		}

		$this->load->model('crud_model');
		$pr_dept = $this->crud_model->get_post_office($limit,$start, $condition);
		$total = $this->db->query("SELECT FOUND_ROWS() as count")->row()->count;
		$config['total_rows'] = $total;
		$config["uri_segment"] = 3;
		 // $this->load->library('pagination');

		 $this->pagination->initialize($config);
		 $this->data['links'] = $this->pagination->create_links();
  		 $this->data['pr_dept'] = $pr_dept;

  		 // dd($this->data);

		$this->data['title'] = 'Post Office List';
		$this->data['username'] = $this->data['user_data']->id_number;

		$this->data['subview'] = 'setup/post_office_list';
		$this->load->view('layout/template', $this->data);
	}

	// Post Office create
	function post_office_add(){

	 	$this->form_validation->set_rules('division', 'Division Name', 'trim|required');
	 	$this->form_validation->set_rules('district', 'District Name', 'trim|required');
	 	$this->form_validation->set_rules('upazila', 'Upazila Name', 'trim|required');
	 	$this->form_validation->set_rules('post_office', 'Post Office Bangla Name', 'trim|required');
	 	$this->form_validation->set_rules('post_office_en', 'Post Office English Name', 'trim|required');
		if($this->form_validation->run() == true)
		{
            $formArray = array(
            	'div_id' => $this->input->post('division'),
            	'dis_id' => $this->input->post('district'),
            	'up_zil_id' => $this->input->post('upazila'),
            	'name_bn' => $this->input->post('post_office'),
            	'name_en' => $this->input->post('post_office_en'),
            	'status'  => 1
            );

			if ($this->db->insert('emp_post_offices',$formArray)) {
				$this->session->set_flashdata('success','Record adder successfully!');
			} else {
				$this->session->set_flashdata('failuer','Sorry!, Something wrong.');
			}
			redirect(base_url('setup_con/post_office'));
		}

        $this->data['divisions'] = $this->db->get('emp_divisions')->result_array();
	    $this->data['title'] = 'Add Post Office';
		$this->data['username'] = $this->data['user_data']->id_number;

		$this->data['subview'] = 'setup/post_office_add';
		$this->load->view('layout/template', $this->data);
	}

	// Post Office update
	function post_office_edit($id)
	{

	 	$this->form_validation->set_rules('division', 'Division Name', 'trim|required');
	 	$this->form_validation->set_rules('district', 'District Name', 'trim|required');
	 	$this->form_validation->set_rules('upazila', 'Upazila Name', 'trim|required');
	 	$this->form_validation->set_rules('post_office', 'Post Office Bangla Name', 'trim|required');
	 	$this->form_validation->set_rules('post_office_en', 'Post Office English Name', 'trim|required');

	 	if($this->form_validation->run() == true)
		{
            $formArray = array(
            	'div_id' => $this->input->post('division'),
            	'dis_id' => $this->input->post('district'),
            	'up_zil_id' => $this->input->post('upazila'),
            	'name_bn' => $this->input->post('post_office'),
            	'name_en' => $this->input->post('post_office_en'),
            	'status'  => 1
            );
            $this->db->where('id',$id);
            $this->db->update('emp_post_offices',$formArray);

			$this->session->set_flashdata('success','Record Updated successfully!');
			redirect('/setup_con/post_office');
		}

        $this->data['divisions'] = $this->db->get('emp_divisions')->result_array();
    	$this->data['post'] = $this->db->where('id',$id)->get('emp_post_offices')->row();
	    $this->data['title'] = 'Update Post Office';
		$this->data['username'] = $this->data['user_data']->id_number;

		$this->data['subview'] = 'setup/post_office_edit';
		$this->load->view('layout/template', $this->data);
	}

	// Post Office delete
	function post_office_delete($id)
	{
		$post =  $this->db->where('id',$id)->get('emp_post_offices')->row();
		if (empty($post)) {
			$this->session->set_flashdata('failuer','Record Not Found in DataBase!');
			redirect('setup_con/post_office');
		}
		$this->db->where('id',$id)->delete('emp_post_offices');
		$this->session->set_flashdata('success','Record Deleted successfully!');
			redirect('setup_con/post_office');
	}
	//----------------------------------------------------------------------------------
	// End CRUD Post Office
	//----------------------------------------------------------------------------------




	//----------------------------------------------------------------------------------
	// CRUD for Section
	//----------------------------------------------------------------------------------
	function section($start=0)
	{
		$this->load->model('crud_model');
		$this->data['pr_sec'] = $this->crud_model->sec_infos();
		$this->data['title'] = 'Section List';
		$this->data['username'] = $this->data['user_data']->id_number;
		$this->data['subview'] = 'setup/sec_list';
		$this->load->view('layout/template', $this->data);
	}

	function sec_add(){

		$this->load->library('form_validation');
		$this->load->model('crud_model');
		$this->data['sec'] = $this->crud_model->sec_fetch();
		$this->form_validation->set_rules('name', 'sec Name', 'trim|required');
		$this->form_validation->set_rules('bname', 'sec Bangla Name', 'trim|required');


		   if($this->form_validation->run() == false)
		   {
			$this->data['title'] = 'Add Section';
			$this->data['username'] = $this->data['user_data']->id_number;
			$this->data['subview'] = 'setup/sec_add';
			$this->load->view('layout/template', $this->data);
		   }
		   else
		   {
		
			   $formArray = array();
			   $formArray['name'] = $this->input->post('name');
			   $formArray['bname'] = $this->input->post('bname');
			   $formArray['strn'] = $this->input->post('strn');
			   $formArray['strf'] = $this->input->post('strf');
			   $formArray['indx'] = $this->input->post('indx');
			   $formArray['aindx'] = $this->input->post('aindx');
			   $formArray['sec'] = $this->input->post('sec');

			   $this->crud_model->sec_add($formArray);
			   $this->session->set_flashdata('success','Record adder successfully!');
				 //alert('Record adder successfully!');
			   redirect(base_url().'index.php/setup_con/section');


		   }

	   }


	   function sec_edit($secId)
	   {
		   $data = array();
		   $this->load->model('crud_model');
		   $this->load->library('form_validation');


			$this->form_validation->set_rules('name', 'sec Name', 'trim|required');
		   $data['sec'] = $this->crud_model->sec_fetch();


			if($this->form_validation->run() == false)
		   {

		   $data['pr_section'] = $this->crud_model->getsec($secId);

		   $this->load->view('sec_edit',$data);

		   }
		   else
		   {
			   $this->crud_model->sec_edit($secId);
			   $this->session->set_flashdata('success','Record Updated successfully!');
				 //alert('Record adder successfully!');
			   redirect('/setup_con/section');


		   }


	   }


	   function sec_delete($secId)
	   {
		   $this->load->model('crud_model');
		   $sec = $this->crud_model->getsec($secId);
		   if (empty($sec)) {
			   $this->session->set_flashdata('failure','Record Not Found in DataBase!');
			   redirect('/setup_con/section');
		   }
		   $this->crud_model->sec_delete($secId);
		   $this->session->set_flashdata('success','Record Deleted successfully!');
			   redirect('/setup_con/section');
	   }







	// old code

	//-------------------------------------------------------------------------------------------------------
	// Company info Setup
	//-------------------------------------------------------------------------------------------------------
	function company_info_setup()
	{
		$company_infos = $this->common_model->company_information();
		$data = array();
		$data['company_infos'] = $company_infos;
		$this->load->view('output2',$data);
	}

	//-------------------------------------------------------------------------------------------------------
	// CRUD output method
	//-------------------------------------------------------------------------------------------------------
	function crud_output($output = null)
	{
		$this->load->view('output.php',$output);
	}

	// function staff_id_entry()
	// {
	// 	$crud = new grocery_CRUD();

	// 	$crud->set_table('staff_ot_list_emp');
	// 	$crud->set_subject('Entry Emp Id');
	// 	$crud->display_as( 'emp_id' , 'EMP_ID' );
	// 	$crud->unset_delete();

	// 	$output = $crud->render();

	// 	$this->crud_output($output);
	// }

	// function proxi_id_entry()
	// {
	// 	$crud = new grocery_CRUD();

	// 	$crud->set_table('pr_id_proxi');
	// 	$crud->set_subject('Entry Emp Id');
	// 	$crud->display_as( 'emp_id' , 'EMP_ID' );
	// 	$crud->display_as( 'proxi_id' , 'Proxi Id' );
	// 	$crud->unset_delete();
	// 	$crud->unset_add();

	// 	$output = $crud->render();

	// 	$this->crud_output($output);
	// }


	function dashboard_date_setup()
	{
		$crud = new grocery_CRUD();

		$crud->set_table('dash_board_date');
		$crud->set_subject('Date');
		$crud->required_fields('date');

		/*$crud->set_theme('twitter-bootstrap');
		$crud->unset_search();*/
		$crud->unset_delete();
		$crud->unset_add();
		$output = $crud->render();
		$this->load->view('dash_board_date.php',$output);
		$this->crud_output($output);

	}

	//-------------------------------------------------------------------------------------------------------
	// CRUD for Section
	//-------------------------------------------------------------------------------------------------------

	function sec_name_check($str)
	{
		$id = $this->uri->segment(4);
		$unit_id = $_POST['unit_id'];
		if(!empty($id) && is_numeric($id))
		{
			$sec_name_old = $this->db->where("sec_id",$id)->get('pr_section')->row()->sec_name;
			$this->db->where("sec_name !=",$sec_name_old);
		}
		$num_row = $this->db->where('sec_name',$str)->where('unit_id',$unit_id)->get('pr_section')->num_rows();
		if ($num_row >= 1)
		{
			$this->form_validation->set_message('sec_name_check', $str.' already exists');
			return FALSE;
		}
		else
		{
			return true;
		}
	}


	function floor_name_check($str)
	{
		$unit_id = $_POST['unit_id'];
		$id = $this->uri->segment(4);
		if(!empty($id) && is_numeric($id))
		{
			$line_name_old = $this->db->where("floor_name",$id)->get('pr_floor')->row()->line_name;
			$this->db->where("floor_name !=",$line_namee_old);
		}
		$num_row = $this->db->where('floor_name',$str)->where('unit_id',$unit_id)->get('pr_floor')->num_rows();
		if ($num_row >= 1)
		{
			$this->form_validation->set_message('floor_name_check', $str.' already exists');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	//-------------------------------------------------------------------------------------------------------
	// CRUD for Line
	//-------------------------------------------------------------------------------------------------------
	function line($start=0)
	{
		$this->load->library('pagination');
		$param = array();
		$limit = 10;
		$config['base_url'] = base_url()."index.php/setup_con/line/";
		$config['per_page'] = $limit;
		$this->load->model('crud_model');
		$pr_line = $this->crud_model->line_infos($limit,$start);
		$total = $this->db->query("SELECT FOUND_ROWS() as count")->row()->count;
		$config['total_rows'] = $total;
		$config["uri_segment"] = 3;
		 // $this->load->library('pagination');

		 $this->pagination->initialize($config);
		 $param['links'] = $this->pagination->create_links();

		$param['pr_line'] = $pr_line;
		 $this->load->view('line_list',$param);



	}
	function line_name_check($str)
	{
		$unit_id = $_POST['unit_id'];
		$id = $this->uri->segment(4);
		if(!empty($id) && is_numeric($id))
		{
			$line_name_old = $this->db->where("line_id",$id)->get('pr_line_num')->row()->line_name;
			$this->db->where("line_name !=",$line_namee_old);
		}
		$num_row = $this->db->where('line_name',$str)->where('unit_id',$unit_id)->get('pr_line_num')->num_rows();
		if ($num_row >= 1)
		{
			$this->form_validation->set_message('line_name_check', $str.' already exists');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	//-------------------------------------------------------------------------------------------------------
	// CRUD for Designation
	//-------------------------------------------------------------------------------------------------------
	function designation($start=0)
	{

		 $this->load->library('pagination');
		 $param = array();
		 $limit = 10;
		 $config['base_url'] = base_url()."index.php/setup_con/designation/";
		 $config['per_page'] = $limit;
		 /*$config['num_links'] = 5;*/
		 $config['total_rows'] = $this->db->get('pr_designation')->num_rows();
		 $config["uri_segment"] = 3;
		 // $this->load->library('pagination');

		 $this->pagination->initialize($config);
		 $param['links'] = $this->pagination->create_links();
		 $this->load->model('crud_model');
		 $pr_designation = $this->crud_model->desig_infos($limit,$start);
		 // print_r($pr_designation);exit('ali');

		 $param['pr_designation'] = $pr_designation;
		 /* echo "<pre>";
		 print_r($param);exit('mafiz'); */
		 $this->load->view('desig_list',$param);




		 /*$this->load->model('crud_model');
		 $data['pr_designation'] = $this->crud_model->desig_infos();
		 // print_r($pr_designation);exit('ali');

		 // $this->pagination_bootstrap->offset(10);
		 // $data['pr_designation'] = $this->pagination_bootstrap->config("setup_con/designation",$pr_designation);
		 // print_r($data['pr_designation']);exit('mafiz');
		 // $data['pr_designation'] =


		 $this->load->library('pagination');

		$config['base_url'] = base_url('setup_con/designation');
		$config['total_rows'] = count($data['pr_designation']);
		$config['per_page'] = 20;

		$config['full_tag_open'] = "<ul class='pagination'>";
		$config['full_tag_close'] ="</ul>";
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
		$config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
		$config['next_tag_open'] = "<li>";
		$config['next_tagl_close'] = "</li>";
		$config['prev_tag_open'] = "<li>";
		$config['prev_tagl_close'] = "</li>";
		$config['first_tag_open'] = "<li>";
		$config['first_tagl_close'] = "</li>";
		$config['last_tag_open'] = "<li>";
		$config['last_tagl_close'] = "</li>";

		$this->pagination->initialize($config);

		$data['pagginations'] = $this->pagination->create_links();


		 $this->load->view('desig_list',$data);*/



	}


	function desig_name_check($str)
	{
		$unit_id = $_POST['unit_id'];
		$id = $this->uri->segment(4);
		if(!empty($id) && is_numeric($id))
		{
			$desig_name_old = $this->db->where("desig_id",$id)->get('pr_designation')->row()->desig_name;
			$this->db->where("desig_name !=",$desig_name_old);
		}
		$num_row = $this->db->where('desig_name',$str)->where('unit_id',$unit_id)->get('pr_designation')->num_rows();
		if ($num_row >= 1)
		{
			$this->form_validation->set_message('desig_name_check', $str.' already exists');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}

	//-------------------------------------------------------------------------------------------------------
	// CRUD for Operation
	//-------------------------------------------------------------------------------------------------------
	function operation()
	{
		$crud = new grocery_CRUD();

		$crud->set_table('pr_emp_operation');
		$crud->set_subject('Weight');
		$crud->display_as( 'ope_name' , 'Weight' );
		$crud->required_fields( 'ope_name');
		$crud->unset_delete();

		$output = $crud->render();

		$this->crud_output($output);
	}

	//-------------------------------------------------------------------------------------------------------
	// CRUD for Job Description Setup
	//-------------------------------------------------------------------------------------------------------
	function job_desc()
	{
		$crud = new grocery_CRUD();
		$crud->set_table('pr_emp_job_desc');
		$crud->set_subject('Job Description');

		$crud->set_relation( 'emp_desig_id' , 'pr_designation','desig_name' );

		$crud->required_fields('emp_desig_id','description');
		$crud->display_as( 'description' , 'Job Description' )
				->display_as( 'emp_desig_id' , 'Designation' );

			//$crud->unset_add();
			//$crud->unset_edit();
			//$crud->unset_delete();

		//$crud->set_rules('emp_desig_id','Designation','trim|required|callback_designation_check');
		$output = $crud->render();
		$this->crud_output($output);
	}

	function nid_wk_typ()
	{
		$crud = new grocery_CRUD();
		$crud->set_table('pr_emp_nid_wk_typ');
		$crud->set_subject('N.Id & Work Type');

		//$crud->set_relation( 'emp_id' , 'pr_emp_com_info','emp_id' );

		$crud->display_as( 'n_id' , 'National Id' )->display_as( 'wk_type' , 'Work Type' );

		//$crud->unset_edit_fields('emp_id');
		//$crud->field_type('emp_id', 'readonly');
		$crud->unset_delete();

		$output = $crud->render();
		$this->crud_output($output);
	}
	function work_process_type()
	{
		$crud = new grocery_CRUD();
		$crud->set_table('pr_work_process');
		$crud->set_subject('Process Type');

		//$crud->set_relation( 'emp_id' , 'pr_emp_com_info','emp_id' );

		$crud->display_as( 'id' , 'Id' )->display_as( 'process' , 'Work Process Name' );

		$output = $crud->render();
		$this->crud_output($output);
	}
/*
	function designation_check()
	{
		$id = $this->uri->segment(4);
		if(!empty($id) && is_numeric($id))
		{
			$desig_id_old = $this->db->where("emp_desig_id",$id)->get('pr_emp_job_desc')->row()->emp_desig_id;
			$this->db->where("emp_desig_id !=",$desig_id_old);
		}
		$num_row = $this->db->where('emp_desig_id',$str)->get('pr_emp_job_desc')->num_rows();
		if ($num_row >= 1)
		{
			$this->form_validation->set_message('designation_check', $str.' already exists');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
 *
 */
	//-------------------------------------------------------------------------------------------------------
	// CRUD for Attendance Bonus
	//-------------------------------------------------------------------------------------------------------
	function attendance_bonus($start=0)
	{
		$this->load->library('pagination');
		$param = array();
		$limit = 10;
		$config['base_url'] = base_url()."index.php/setup_con/attendance_bonus/";
		$config['per_page'] = $limit;
		$this->load->model('crud_model');
		$pr_attn_bonus = $this->crud_model->attbn_infos($limit,$start);
		$total = $this->db->query("SELECT FOUND_ROWS() as count")->row()->count;
		$config['total_rows'] = $total;
		$config["uri_segment"] = 3;
		 // $this->load->library('pagination');

		 $this->pagination->initialize($config);
		 $param['links'] = $this->pagination->create_links();

		$param['pr_attn_bonus'] = $pr_attn_bonus;

		 $this->load->view('attbn_list',$param);


	}

	function ab_rule_name_check($str)
	{
		$id = $this->uri->segment(4);
		if(!empty($id) && is_numeric($id))
		{
			$ab_rule_name_old = $this->db->where("ab_id",$id)->get('pr_attn_bonus')->row()->ab_rule_name;
			$this->db->where("ab_rule_name !=",$ab_rule_name_old);
		}
		$num_row = $this->db->where('ab_rule_name',$str)->get('pr_attn_bonus')->num_rows();
		if ($num_row >= 1)
		{
			$this->form_validation->set_message('ab_rule_name_check', $str.' already exists');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	//-------------------------------------------------------------------------------------------------------
	// CRUD for Salary Grade
	//-------------------------------------------------------------------------------------------------------
	function salary_grade($start=0)
	{
		$this->load->library('pagination');
		$param = array();
		$limit = 10;
		$config['base_url'] = base_url()."index.php/setup_con/salary_grade/";
		$config['per_page'] = $limit;
		$this->load->model('crud_model');
		$pr_grade = $this->crud_model->salgrd_infos($limit,$start);
		$total = $this->db->query("SELECT FOUND_ROWS() as count")->row()->count;
		$config['total_rows'] = $total;
		$config["uri_segment"] = 3;
		 // $this->load->library('pagination');

		 $this->pagination->initialize($config);
		 $param['links'] = $this->pagination->create_links();

		$param['pr_grade'] = $pr_grade;
		$this->load->view('salgrd_list',$param);



	}
	//-------------------------------------------------------------------------------------------------------
	// CRUD for Shift Schedules
	//-------------------------------------------------------------------------------------------------------
	function shift_schedule($start=0)
	{

		$this->load->library('pagination');
		$param = array();
		$limit = 10;
		$config['base_url'] = base_url()."index.php/setup_con/shift_schedule/";
		$config['per_page'] = $limit;
		$this->load->model('crud_model');
		$pr_emp_shift_schedule = $this->crud_model->shiftschedule_infos($limit,$start);
		$total = $this->db->query("SELECT FOUND_ROWS() as count")->row()->count;
		$config['total_rows'] = $total;
		$config["uri_segment"] = 3;
		 // $this->load->library('pagination');

		 $this->pagination->initialize($config);
		 $param['links'] = $this->pagination->create_links();

		$param['pr_emp_shift_schedule'] = $pr_emp_shift_schedule;

		 $this->load->view('shift_schedule_list',$param);

	}
	//-------------------------------------------------------------------------------------------------------
	// CRUD for Shift Management
	//-------------------------------------------------------------------------------------------------------
	function shift_management($start=0)
	{

		$this->load->library('pagination');
		$param = array();
		$limit = 10;
		$config['base_url'] = base_url()."index.php/setup_con/shift_management/";
		$config['per_page'] = $limit;
		$this->load->model('crud_model');
		$pr_emp_shift = $this->crud_model->shiftmanagement_infos($limit,$start);
		$total = $this->db->query("SELECT FOUND_ROWS() as count")->row()->count;
		$config['total_rows'] = $total;
		$config["uri_segment"] = 3;
		 // $this->load->library('pagination');

		 $this->pagination->initialize($config);
		 $param['links'] = $this->pagination->create_links();

		$param['pr_emp_shift'] = $pr_emp_shift;
		$this->load->view('shift_management_list',$param);

	}
	//-------------------------------------------------------------------------------------------------------
	// CRUD for Leave Setup
	//-------------------------------------------------------------------------------------------------------
	function leave_setup($start=0)
	{

		$this->load->library('pagination');
		$param = array();
		$limit = 10;
		$config['base_url'] = base_url()."index.php/setup_con/floor/";
		$config['per_page'] = $limit;
		$this->load->model('crud_model');
		$pr_leave = $this->crud_model->leave_infos($limit,$start);
		$total = $this->db->query("SELECT FOUND_ROWS() as count")->row()->count;
		$config['total_rows'] = $total;
		$config["uri_segment"] = 3;
		 // $this->load->library('pagination');

		 $this->pagination->initialize($config);
		 $param['links'] = $this->pagination->create_links();

		$param['pr_leave'] = $pr_leave;
		$this->load->view('leave_list',$param);

	}

	//-------------------------------------------------------------------------------------------------------
	// CRUD for Deduction Setup
	//-------------------------------------------------------------------------------------------------------
	function attributes_setup()
	{
		$crud = new grocery_CRUD();

		$crud->set_table('pr_setup');
		$crud->set_subject('Attributes');
		$crud->unset_delete();
		$crud->unset_add();
		$crud->change_field_type('attributes','readonly');
		$output = $crud->render();
		$this->crud_output($output);
	}

	//-------------------------------------------------------------------------------------------------------
	// CRUD for Night Allowance Setup
	//-------------------------------------------------------------------------------------------------------
	function night_allowance_setup($start=0)
	{

		$this->load->model('crud_model');
		$this->load->library('pagination');
		$param = array();
		$limit = 10;
		$config['base_url'] = base_url()."index.php/setup_con/night_allowance_setup/";
		$config['per_page'] = $limit;
		$pr_night_allowance_rules = $this->crud_model->nightallowence_infos($limit,$start);
		$total = $this->db->query("SELECT FOUND_ROWS() as count")->row()->count;
		$config['total_rows'] = $total;
		$config["uri_segment"] = 3;
		 // $this->load->library('pagination');

		 $this->pagination->initialize($config);
		 $param['links'] = $this->pagination->create_links();

		$param['pr_night_allowance_rules'] = $pr_night_allowance_rules;

		// print_r($pr_night_allowance_rules);exit('ali');
		$this->load->view('night_allowance_list',$param);

	}
	//-------------------------------------------------------------------------------------------------------
	// CRUD for Holiday Allowance Setup
	//-------------------------------------------------------------------------------------------------------
	function holiday_allowance_setup($start=0)
	{

		$this->load->library('pagination');
		$param = array();
		$limit = 10;
		$config['base_url'] = base_url()."index.php/setup_con/holiday_allowance_setup/";
		$config['per_page'] = $limit;
		$this->load->model('crud_model');
		$pr_holiday_allowance_rules = $this->crud_model->holidayallowence_infos($limit,$start);
		$total = $this->db->query("SELECT FOUND_ROWS() as count")->row()->count;
		$config['total_rows'] = $total;
		$config["uri_segment"] = 3;
		 // $this->load->library('pagination');

		 $this->pagination->initialize($config);
		 $param['links'] = $this->pagination->create_links();

		$param['pr_holiday_allowance_rules'] = $pr_holiday_allowance_rules;

		$this->load->view('holiday_allowance_list',$param);

	}



	//-------------------------------------------------------------------------------------------------------
	// CRUD for Weekend Allowance Setup
	//-------------------------------------------------------------------------------------------------------
	function weekend_allowance_setup($start=0)
	{

		 $this->load->library('pagination');
		 $param = array();
		 $limit = 10;
		 $config['base_url'] = base_url()."index.php/setup_con/weekend_allowance_setup/";
		 $config['per_page'] = $limit;
		 /*$config['num_links'] = 5;*/
		 $config['total_rows'] = $this->db->get('pr_weekend_allowance_level')->num_rows();
		 $config["uri_segment"] = 3;
		 // $this->load->library('pagination');

		 $this->pagination->initialize($config);
		 $param['links'] = $this->pagination->create_links();
		 $this->load->model('crud_model');
		 $pr_weekend_allowance_rules = $this->crud_model->weekendallowence_infos($limit,$start);

		 // echo "<pre>";
		 // print_r($pr_weekend_allowance_rules);exit('ali');

		 $param['pr_weekend_allowance_rules'] = $pr_weekend_allowance_rules;
		 /* echo "<pre>";
		 print_r($param);exit('mafiz'); */
		 $this->load->view('weekend_allowance_list',$param);



		// print_r($pr_weekend_allowance_rules);exit('ali');
		/*$data = array();
		$data['pr_weekend_allowance_rules'] = $pr_weekend_allowance_rules;
		$this->load->view('weekend_allowance_list',$data);*/
	}
	//-------------------------------------------------------------------------------------------------------
	// CRUD for Allowance Setup
	//-------------------------------------------------------------------------------------------------------
	function tiffin_allowance_setup()
	{
		$crud = new grocery_CRUD();

		$crud->set_table('pr_tiffin_allowance_rules');
		$crud->set_subject('Tiffin Allowance Rules');
		$crud->required_fields('rules_name','allowance_amount','allowance_time');
		$crud->display_as( 'rules_name' , 'Rules Name' )
				->display_as( 'allowance_amount' , 'Amount' )
				->display_as( 'allowance_time' , 'Time' );

		//$crud->unset_delete();
		$crud->set_relation_n_n('Section', 'pr_tiffin_allowance_level','pr_section','rules_id','sec_id','sec_name','priority');
		//$crud->unset_add();
		//$crud->change_field_type('emp_category','readonly');
		$output = $crud->render();
		$this->crud_output($output);
	}
	//-------------------------------------------------------------------------------------------------------
	// CRUD for Festival Bonus Setup
	//-------------------------------------------------------------------------------------------------------
	function bonus_setup($start=0)
	{
		$this->load->library('pagination');
		$param = array();
		$limit = 10;
		$config['base_url'] = base_url()."index.php/setup_con/bonus_setup/";
		$config['per_page'] = $limit;
		$this->load->model('crud_model');
		$pr_bonus_rules = $this->crud_model->bnruls_infos($limit,$start);
		$total = $this->db->query("SELECT FOUND_ROWS() as count")->row()->count;
		$config['total_rows'] = $total;
		$config["uri_segment"] = 3;
		 // $this->load->library('pagination');

		 $this->pagination->initialize($config);
		 $param['links'] = $this->pagination->create_links();

		$param['pr_bonus_rules'] = $pr_bonus_rules;

		$this->load->view('bnrules_list',$param);


	}

	//-------------------------------------------------------------------------------------------------------
	// CRUD for Providend Fund Setup
	//-------------------------------------------------------------------------------------------------------
	function pf_setup()
	{
		$crud = new grocery_CRUD();

		$crud->set_table('pr_provident_fund_rules');
		$crud->set_subject('Provident Fund Rules');
		$crud->required_fields( 'pf_start_month','pf_end_month','pf_percentage','pf_deduct_percentage','salay_type');
		//$crud->display_as( 'bonus_amount_fraction' , 'Bonus Fraction' );
		$crud->unset_delete();
		//$crud->unset_add();
		//$crud->change_field_type('attributes','readonly');
		$output = $crud->render();
		$this->crud_output($output);
	}



	//-------------------------------------------------------------------------------------------------------
	// CRUD for Units
	//-------------------------------------------------------------------------------------------------------
	function unit()
	{
		// $crud = new grocery_CRUD();

		// $crud->set_table('pr_units');
		// $crud->set_subject('Unit');
		// $crud->display_as( 'unit_name' , 'Unit Name' );
		// $crud->required_fields( 'unit_name');
		// $crud->unset_delete();
		// $crud->set_field_upload('logo','images/');
		// $crud->set_field_upload('unit_signature','images/');
		// $output = $crud->render();

		// $this->crud_output($output);


		 $this->load->model('common_model');
		 $company_infos = $this->common_model->company_information();
		 $data = array();
		 $data['company_infos'] = $company_infos;
		 $this->load->view('output2',$data);
	}


	function night_rules()
	{
		$crud = new grocery_CRUD();

		$crud->set_table('pr_night_rules');
		$crud->set_subject('Night_rules');
		$crud->set_relation( 'unit_id' , 'pr_units','unit_name' );
		$crud->display_as( 'unit_id' , 'Unit Name' )->display_as( 'deduct_hour' , 'Deduct Hour' );
		$crud->required_fields( 'unit_id','deduct_hour');
		$crud->unset_delete();
		$output = $crud->render();

		$this->crud_output($output);
	}

	function attn_summary_setup()
	{

		$crud = new grocery_CRUD();
		$get_session_user_unit = $this->common_model->get_session_unit_id_name();
		if($get_session_user_unit != 0)
		{
			$crud->where('pr_attn_summary_list.unit_id',$get_session_user_unit);
		}
		$crud->set_table('pr_attn_summary_list');
		$crud->set_subject('Attendance Summary');

		if($get_session_user_unit != 0)
		{
			$crud->set_relation( 'unit_id' , 'pr_units','unit_name',array('unit_id' => $get_session_user_unit) );
		}
		else
		{
			$crud->set_relation( 'unit_id' , 'pr_units','unit_name' );
		}
		$where="desig_id==2";
		$crud->set_relation_n_n('AttnSummary','pr_attn_summary_level','pr_designation','group_id','desig_id','desig_name','priority',array('pr_designation.desig_id'==2),null);

		$output = $crud->render();
		$this->crud_output($output);
	}

}?>
