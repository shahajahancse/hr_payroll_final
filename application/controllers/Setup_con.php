<?php
class Setup_con extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        /* Standard Libraries */
        $this->load->library('grocery_CRUD');
        $this->load->model('acl_model');
        $this->load->model('common_model');
        $this->load->library('pagination_bootstrap');
        $this->load->helper('url');
        $this->load->model('crud_model');

        if ($this->session->userdata('logged_in') == false) {
            redirect("authentication");
        }
        $this->data['user_data'] = $this->session->userdata('data');
        if (!check_acl_list($this->data['user_data']->id, 2)) {
            echo "<SCRIPT LANGUAGE=\"JavaScript\">alert('Sorry! Acess Deny');</SCRIPT>";
            redirect("payroll_con");
            exit;
        }
    }

    //----------------------------------------------------------------------------------
    // CRUD for Department
    //----------------------------------------------------------------------------------
    public function department($start = 0)
    {
        $this->load->library('pagination');
        $limit = 10;
        $config['base_url'] = base_url() . "setup_con/department/";
        $config['per_page'] = $limit;

        $condition = 0;
        if ($this->input->get('request')) {
            $query = $this->input->get('request');
            $condition = "(pr_units.unit_name LIKE '" . $query . "%' OR emp_depertment.dept_name LIKE '%" . $query . "%' OR emp_depertment.dept_bangla LIKE '%" . $query . "%')";
        }

        $this->load->model('crud_model');
        $pr_dept = $this->crud_model->dept_infos($limit, $start, $condition);
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
    public function dept_add()
    {

        $this->db->select('pr_units.*');
        $this->data['dept'] = $this->db->get('pr_units')->result_array();

        $this->form_validation->set_rules('dept_name', 'dept Name', 'trim|required');
        $this->form_validation->set_rules('dept_bangla', 'dept Bangla Name', 'trim|required');

        if ($this->form_validation->run() == true) {
            $formArray = array(
                'dept_name' => $this->input->post('dept_name'),
                'dept_bangla' => $this->input->post('dept_bangla'),
                'unit_id' => $this->input->post('unit_id'),
            );

            if ($this->db->insert('emp_depertment', $formArray)) {
                $this->session->set_flashdata('success', 'Record adder successfully!');
            } else {
                $this->session->set_flashdata('failuer', 'Sorry!, Something wrong.');
            }
            redirect(base_url('setup_con/department'));
        }

        $this->data['title'] = 'Add Department';
        $this->data['username'] = $this->data['user_data']->id_number;

        $this->data['subview'] = 'setup/dept_add';
        $this->load->view('layout/template', $this->data);
    }

    // department update
    public function dept_edit($deptId)
    {
        $this->db->select('pr_units.*');
        $this->data['dept'] = $this->db->get('pr_units')->result_array();

        $this->form_validation->set_rules('dept_name', 'dept Name', 'trim|required');
        $this->form_validation->set_rules('dept_bangla', 'dept Bangla Name', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->db->where('dept_id', $deptId);
            $this->data['pr_dept'] = $this->db->get('emp_depertment')->row();

            $this->data['title'] = 'Update Department';
            $this->data['username'] = $this->data['user_data']->id_number;

            $this->data['subview'] = 'setup/dept_edit';
            $this->load->view('layout/template', $this->data);
        } else {

            $formArray = array(
                'dept_name' => $this->input->post('dept_name'),
                'dept_bangla' => $this->input->post('dept_bangla'),
                'unit_id' => $this->input->post('unit_id'),
            );
            $this->db->where('dept_id', $deptId);
            $this->db->update('emp_depertment', $formArray);

            $this->session->set_flashdata('success', 'Record Updated successfully!');
            //alert('Record adder successfully!');
            redirect('/setup_con/department');
        }
    }

    // Department delete
    public function dept_delete($deptId)
    {
        $dept = $this->db->where('dept_id', $deptId)->get('emp_depertment')->row();
        if (empty($dept)) {
            $this->session->set_flashdata('failuer', 'Record Not Found in DataBase!');
            redirect('setup_con/department');
        }
        $this->db->where('dept_id', $deptId)->delete('emp_depertment');
        $this->session->set_flashdata('success', 'Record Deleted successfully!');
        redirect('setup_con/department');
    }
    //----------------------------------------------------------------------------------
    // CRUD End for Department
    //----------------------------------------------------------------------------------

    //----------------------------------------------------------------------------------
    // CRUD for Post Office
    //----------------------------------------------------------------------------------
    public function post_office($start = 0)
    {

        $this->load->library('pagination');
        $limit = 10;
        $config['base_url'] = base_url() . "setup_con/post_office/";
        $config['per_page'] = $limit;

        $condition = 0;
        if ($this->input->get('request')) {
            $query = $this->input->get('request');
            $condition = "(pr_units.unit_name LIKE '" . $query . "%' OR emp_depertment.dept_name LIKE '%" . $query . "%' OR emp_depertment.dept_bangla LIKE '%" . $query . "%')";
        }

        $this->load->model('crud_model');
        $pr_dept = $this->crud_model->get_post_office($limit, $start, $condition);
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
    public function post_office_add()
    {

        $this->form_validation->set_rules('division', 'Division Name', 'trim|required');
        $this->form_validation->set_rules('district', 'District Name', 'trim|required');
        $this->form_validation->set_rules('upazila', 'Upazila Name', 'trim|required');
        $this->form_validation->set_rules('post_office', 'Post Office Bangla Name', 'trim|required');
        $this->form_validation->set_rules('post_office_en', 'Post Office English Name', 'trim|required');
        if ($this->form_validation->run() == true) {
            $formArray = array(
                'div_id' => $this->input->post('division'),
                'dis_id' => $this->input->post('district'),
                'up_zil_id' => $this->input->post('upazila'),
                'name_bn' => $this->input->post('post_office'),
                'name_en' => $this->input->post('post_office_en'),
                'status' => 1,
            );

            if ($this->db->insert('emp_post_offices', $formArray)) {
                $this->session->set_flashdata('success', 'Record adder successfully!');
            } else {
                $this->session->set_flashdata('failuer', 'Sorry!, Something wrong.');
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
    public function post_office_edit($id)
    {

        $this->form_validation->set_rules('division', 'Division Name', 'trim|required');
        $this->form_validation->set_rules('district', 'District Name', 'trim|required');
        $this->form_validation->set_rules('upazila', 'Upazila Name', 'trim|required');
        $this->form_validation->set_rules('post_office', 'Post Office Bangla Name', 'trim|required');
        $this->form_validation->set_rules('post_office_en', 'Post Office English Name', 'trim|required');

        if ($this->form_validation->run() == true) {
            $formArray = array(
                'div_id' => $this->input->post('division'),
                'dis_id' => $this->input->post('district'),
                'up_zil_id' => $this->input->post('upazila'),
                'name_bn' => $this->input->post('post_office'),
                'name_en' => $this->input->post('post_office_en'),
                'status' => 1,
            );
            $this->db->where('id', $id);
            $this->db->update('emp_post_offices', $formArray);

            $this->session->set_flashdata('success', 'Record Updated successfully!');
            redirect('/setup_con/post_office');
        }

        $this->data['divisions'] = $this->db->get('emp_divisions')->result_array();
        $this->data['post'] = $this->db->where('id', $id)->get('emp_post_offices')->row();
        $this->data['title'] = 'Update Post Office';
        $this->data['username'] = $this->data['user_data']->id_number;

        $this->data['subview'] = 'setup/post_office_edit';
        $this->load->view('layout/template', $this->data);
    }

    // Post Office delete
    public function post_office_delete($id)
    {
        $post = $this->db->where('id', $id)->get('emp_post_offices')->row();
        if (empty($post)) {
            $this->session->set_flashdata('failuer', 'Record Not Found in DataBase!');
            redirect('setup_con/post_office');
        }
        $this->db->where('id', $id)->delete('emp_post_offices');
        $this->session->set_flashdata('success', 'Record Deleted successfully!');
        redirect('setup_con/post_office');
    }
    //----------------------------------------------------------------------------------
    // End CRUD Post Office
    //----------------------------------------------------------------------------------

    //----------------------------------------------------------------------------------
    // CRUD for Section
    //----------------------------------------------------------------------------------
    public function section($start = 0)
    {
        $this->load->model('crud_model');
        $this->data['pr_sec'] = $this->crud_model->sec_infos();
        $this->data['title'] = 'Section List';
        $this->data['username'] = $this->data['user_data']->id_number;
        $this->data['subview'] = 'setup/sec_list';
        $this->load->view('layout/template', $this->data);
    }

    public function get_unit()
    {
        $department_id = $_POST['department_id'];
        $this->db->select('emp_depertment.*,pr_units.*');
        $this->db->from('emp_depertment');
        $this->db->join('pr_units', 'pr_units.unit_id=emp_depertment.unit_id');
        $this->db->where('emp_depertment.dept_id', $department_id);
        $unit = $this->db->get()->result_array();
        echo json_encode($unit);

    }
    public function sec_add()
    {

        $this->load->library('form_validation');
        $this->load->model('crud_model');
        $this->form_validation->set_rules('sec_name_en', 'Section Name', 'trim|required');
        $this->form_validation->set_rules('sec_name_bn', 'Section Bangla Name', 'trim|required');
        $this->form_validation->set_rules('depertment_id', 'Department', 'required');
        $this->form_validation->set_rules('unit_id', 'Unit', 'required');

        if ($this->form_validation->run() == false) {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $this->session->set_flashdata('failure', $this->form_validation->error_array());
            }

            $this->db->select('emp_depertment.*');
            $this->data['department'] = $this->db->get('emp_depertment')->result();
            $this->db->select('pr_units.*');
            $this->data['unit'] = $this->db->get('pr_units')->result();
            $this->data['title'] = 'Add Section';
            $this->data['username'] = $this->data['user_data']->id_number;
            $this->data['subview'] = 'setup/sec_add';
            $this->load->view('layout/template', $this->data);
        } else {

            $formArray = array(
                'sec_name_en' => $this->input->post('sec_name_en'),
                'sec_name_bn' => $this->input->post('sec_name_bn'),
                'depertment_id' => $this->input->post('depertment_id'),
                'unit_id' => $this->input->post('unit_id'),
            );

            if ($this->db->insert('emp_section', $formArray)) {
                $this->session->set_flashdata('success', 'Record adder successfully!');
            } else {
                $this->session->set_flashdata('failure', 'Record adder failed!');
            }
            redirect(base_url() . 'index.php/setup_con/section');
        }

    }

    public function sec_edit($secId)
    {
        $this->load->model('crud_model');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('sec_name_en', 'Section Name', 'trim|required');
        $this->form_validation->set_rules('sec_name_bn', 'Section Bangla Name', 'trim|required');
        $this->form_validation->set_rules('depertment_id', 'Department', 'required');
        $this->form_validation->set_rules('unit_id', 'Unit', 'required');

        if ($this->form_validation->run() == false) {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $this->session->set_flashdata('failure', $this->form_validation->error_array());
            }
            $this->db->select('emp_depertment.*');
            $this->data['department'] = $this->db->get('emp_depertment')->result();
            $this->db->select('pr_units.*');
            $this->data['unit'] = $this->db->get('pr_units')->result();

            $this->data['emp_section'] = $this->crud_model->getsec($secId);
            $this->data['title'] = 'Edit Section';
            $this->data['username'] = $this->data['user_data']->id_number;
            $this->data['subview'] = 'setup/sec_edit';
            $this->load->view('layout/template', $this->data);
        } else {
            $formArray = array(
                'sec_name_en' => $this->input->post('sec_name_en'),
                'sec_name_bn' => $this->input->post('sec_name_bn'),
                'depertment_id' => $this->input->post('depertment_id'),
                'unit_id' => $this->input->post('unit_id'),
            );
            $this->db->where('id', $secId);
            if ($this->db->update('emp_section', $formArray)) {
                $this->session->set_flashdata('success', 'Record Updated successfully!');
            } else {
                $this->session->set_flashdata('failure', 'Record Update failed!');
            }
            redirect(base_url() . 'index.php/setup_con/section');

        }

    }

    public function sec_delete($secId)
    {
        $this->load->model('crud_model');
        $sec = $this->crud_model->getsec($secId);
        if (empty($sec)) {
            $this->session->set_flashdata('failure', 'Record Not Found in DataBase!');
            redirect(base_url() . 'index.php/setup_con/section');
        }
        $this->crud_model->sec_delete($secId);
        $this->session->set_flashdata('success', 'Record Deleted successfully!');
        redirect(base_url() . 'index.php/setup_con/section');
    }

    //----------------------------------------------------------------------------------
    // CRUD for Section END
    //----------------------------------------------------------------------------------

    //----------------------------------------------------------------------------------
    // CRUD for LINE start
    //----------------------------------------------------------------------------------

    public function line()
    {

        $this->data['pr_line'] = $this->crud_model->line_infos();
        $this->data['title'] = 'Line List';
        $this->data['username'] = $this->data['user_data']->id_number;
        $this->data['subview'] = 'setup/line_list';
        $this->load->view('layout/template', $this->data);
    }

    public function get_unit_s()
    {
        $section_id = $_POST['section_id'];
        $this->db->select('emp_section.*,pr_units.*');
        $this->db->from('emp_section');
        $this->db->join('pr_units', 'pr_units.unit_id=emp_section.unit_id');
        $this->db->where('emp_section.id', $section_id);
        $unit = $this->db->get()->result_array();
        echo json_encode($unit);
    }

    public function line_add()
    {

        $this->load->library('form_validation');
        $this->load->model('crud_model');
        $this->form_validation->set_rules('line_name_en', 'Line English Name', 'trim|required');
        $this->form_validation->set_rules('line_name_bn', 'Line Bangla Name', 'trim|required');
        $this->form_validation->set_rules('section_id', 'Section', 'required');
        $this->form_validation->set_rules('unit_id', 'Unit', 'required');

        if ($this->form_validation->run() == false) {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $this->session->set_flashdata('failure', $this->form_validation->error_array());
            }

            $this->db->select('emp_section.*');
            $this->data['emp_section'] = $this->db->get('emp_section')->result();
            $this->data['title'] = 'Add Line';
            $this->data['username'] = $this->data['user_data']->id_number;
            $this->data['subview'] = 'setup/line_add';
            $this->load->view('layout/template', $this->data);
        } else {

            $formArray = array(
                'line_name_en' => $this->input->post('line_name_en'),
                'line_name_bn' => $this->input->post('line_name_bn'),
                'section_id' => $this->input->post('section_id'),
                'unit_id' => $this->input->post('unit_id'),
            );

            if ($this->db->insert('emp_line_num', $formArray)) {
                $this->session->set_flashdata('success', 'Record adder successfully!');
            } else {
                $this->session->set_flashdata('failure', 'Record adder failed!');
            }
            redirect(base_url() . 'index.php/setup_con/line');
        }

    }

    public function line_edit($line_id)
    {
        $this->load->library('form_validation');
        $this->load->model('crud_model');
        $this->form_validation->set_rules('line_name_en', 'Line English Name', 'trim|required');
        $this->form_validation->set_rules('line_name_bn', 'Line Bangla Name', 'trim|required');
        $this->form_validation->set_rules('section_id', 'Section', 'required');
        $this->form_validation->set_rules('unit_id', 'Unit', 'required');

        if ($this->form_validation->run() == false) {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $this->session->set_flashdata('failure', $this->form_validation->error_array());
            }
            $this->db->select('emp_section.*');
            $this->data['emp_section'] = $this->db->get('emp_section')->result();

            $this->data['line'] = $this->crud_model->getline($line_id);
            $this->data['title'] = 'Edit Section';
            $this->data['username'] = $this->data['user_data']->id_number;
            $this->data['subview'] = 'setup/line_edit';
            $this->load->view('layout/template', $this->data);
        } else {
            $formArray = array(
                'line_name_en' => $this->input->post('line_name_en'),
                'line_name_bn' => $this->input->post('line_name_bn'),
                'section_id' => $this->input->post('section_id'),
                'unit_id' => $this->input->post('unit_id'),
            );
            $this->db->where('id', $line_id);
            if ($this->db->update('emp_line_num', $formArray)) {
                $this->session->set_flashdata('success', 'Record Updated successfully!');
            } else {
                $this->session->set_flashdata('failure', 'Record Update failed!');
            }
            redirect(base_url() . 'index.php/setup_con/line');

        }

    }

    public function line_delete($line_id)
    {
        $this->db->where('id', $line_id);
        $this->db->delete('emp_line_num');
        $this->session->set_flashdata('success', 'Record Deleted successfully!');
        redirect(base_url() . 'index.php/setup_con/line');
    }

    //----------------------------------------------------------------------------------
    // CRUD for LINE end
    //----------------------------------------------------------------------------------
    //----------------------------------------------------------------------------------
    // CRUD for attn_bonus start
    //----------------------------------------------------------------------------------

    public function attendance_bonus()
    {
		$this->db->select('allowance_attn_bonus.*,pr_units.unit_name');
		$this->db->from('allowance_attn_bonus');
		$this->db->join('pr_units', 'pr_units.unit_id=allowance_attn_bonus.unit_id');
        $this->data['attendance_bonus'] = $this->db->get()->result_array();
        $this->data['title'] = 'Attendance Bonus List';
        $this->data['username'] = $this->data['user_data']->id_number;
        $this->data['subview'] = 'setup/attbn_list';
        $this->load->view('layout/template', $this->data);
    }

    public function attn_bonus_add()
    {

        $this->load->library('form_validation');
        $this->load->model('crud_model');
        $this->form_validation->set_rules('unit_id', 'Unit', 'required');
        $this->form_validation->set_rules('rule_name', 'Rule Name', 'trim|required');
        $this->form_validation->set_rules('rule', 'Rule', 'required');

        if ($this->form_validation->run() == false) {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $this->session->set_flashdata('failure', $this->form_validation->error_array());
            }
            $this->db->select('pr_units.*');
            $this->data['pr_units'] = $this->db->get('pr_units')->result();
            $this->data['title'] = 'Add Attendance Bonus';
            $this->data['username'] = $this->data['user_data']->id_number;
            $this->data['subview'] = 'setup/attbn_add';
            $this->load->view('layout/template', $this->data);
        } else {

            $formArray = array(
                'unit_id' => $this->input->post('unit_id'),
                'rule_name' => $this->input->post('rule_name'),
                'rule' => $this->input->post('rule'),
            );

            if ($this->db->insert('allowance_attn_bonus', $formArray)) {
                $this->session->set_flashdata('success', 'Record adder successfully!');
            } else {
                $this->session->set_flashdata('failure', 'Record adder failed!');
            }
            redirect(base_url() . 'index.php/setup_con/attendance_bonus');
        }

    }

    public function attn_bonus_edit($rule_id)
    {
        $this->load->library('form_validation');
        $this->load->model('crud_model');
		$this->form_validation->set_rules('unit_id', 'Unit', 'required');
        $this->form_validation->set_rules('rule_name', 'Rule Name', 'trim|required');
        $this->form_validation->set_rules('rule', 'Rule', 'required');

        if ($this->form_validation->run() == false) {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $this->session->set_flashdata('failure', $this->form_validation->error_array());
            }
			$this->db->select('pr_units.*');
            $this->data['pr_units'] = $this->db->get('pr_units')->result();

            $this->data['attbn'] = $this->crud_model->getattbn($rule_id);
            $this->data['title'] = 'Edit Attendance Bonus';
            $this->data['username'] = $this->data['user_data']->id_number;
            $this->data['subview'] = 'setup/attbn_edit';
            $this->load->view('layout/template', $this->data);
        } else {
			$formArray = array(
                'unit_id' => $this->input->post('unit_id'),
                'rule_name' => $this->input->post('rule_name'),
                'rule' => $this->input->post('rule'),
            );
            $this->db->where('id', $rule_id);
            if ($this->db->update('allowance_attn_bonus', $formArray)) {
                $this->session->set_flashdata('success', 'Record Updated successfully!');
            } else {
                $this->session->set_flashdata('failure', 'Record Update failed!');
            }
            redirect(base_url() . 'index.php/setup_con/attendance_bonus');

        }

    }

    public function attn_bonus_delete($line_id)
    {
        $this->db->where('id', $line_id);
        $this->db->delete('allowance_attn_bonus');
        $this->session->set_flashdata('success', 'Record Deleted successfully!');
        redirect(base_url() . 'index.php/setup_con/attendance_bonus');
    }

    //----------------------------------------------------------------------------------
    // CRUD for attn_bonus end
    //----------------------------------------------------------------------------------
    //----------------------------------------------------------------------------------
    // CRUD for weekend_allowance start
    //----------------------------------------------------------------------------------

    public function weekend_allowance_setup()
    {
		$this->db->select('allowance_holiday_weekend_rules.*,pr_units.unit_name');
		$this->db->from('allowance_holiday_weekend_rules');
		$this->db->join('pr_units', 'pr_units.unit_id=allowance_holiday_weekend_rules.unit_id');
        $this->data['allowance_holiday_weekend_rules'] = $this->db->get()->result_array();
        $this->data['title'] = 'Attendance Bonus List';
        $this->data['username'] = $this->data['user_data']->id_number;
        $this->data['subview'] = 'setup/weekend_allowance_list';
        $this->load->view('layout/template', $this->data);
    }

    public function weekend_allowance_add()
    {

        $this->load->library('form_validation');
        $this->load->model('crud_model');
        $this->form_validation->set_rules('unit_id', 'Unit', 'required');
        $this->form_validation->set_rules('rule_name', 'Rule Name', 'trim|required');
        $this->form_validation->set_rules('rule', 'Amount', 'required');

        if ($this->form_validation->run() == false) {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $this->session->set_flashdata('failure', $this->form_validation->error_array());
            }
            $this->db->select('pr_units.*');
            $this->data['pr_units'] = $this->db->get('pr_units')->result();
            $this->data['title'] = 'Add Holyday/Weekend Allowance';
            $this->data['username'] = $this->data['user_data']->id_number;
            $this->data['subview'] = 'setup/weekend_allowance_add';
            $this->load->view('layout/template', $this->data);
        } else {
            $formArray = array(
                'unit_id' => $this->input->post('unit_id'),
                'rule_name' => $this->input->post('rule_name'),
                'allowance_amount' => $this->input->post('rule'),
            );
            if ($this->db->insert('allowance_holiday_weekend_rules', $formArray)) {
                $this->session->set_flashdata('success', 'Record adder successfully!');
            } else {
                $this->session->set_flashdata('failure', 'Record adder failed!');
            }
            redirect(base_url() . 'index.php/setup_con/weekend_allowance_setup');
        }

    }

    public function weekend_allowance_edit($id)
    {
        $this->load->library('form_validation');
        $this->load->model('crud_model');
        $this->form_validation->set_rules('unit_id', 'Unit', 'required');
        $this->form_validation->set_rules('rule_name', 'Rule Name', 'trim|required');
        $this->form_validation->set_rules('rule', 'Amount', 'required');

        if ($this->form_validation->run() == false) {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $this->session->set_flashdata('failure', $this->form_validation->error_array());
            }
			$this->db->select('pr_units.*');
            $this->data['pr_units'] = $this->db->get('pr_units')->result();

            $this->db->where('id', $id);
            $this->data['attbn'] = $this->db->get('allowance_holiday_weekend_rules')->row($id);
            $this->data['title'] = 'Edit Holyday/Weekend Allowance';
            $this->data['username'] = $this->data['user_data']->id_number;
            $this->data['subview'] = 'setup/weekend_allowance_edit';
            $this->load->view('layout/template', $this->data);
        } else {
            $formArray = array(
                'unit_id' => $this->input->post('unit_id'),
                'rule_name' => $this->input->post('rule_name'),
                'allowance_amount' => $this->input->post('rule'),
            );
            $this->db->where('id', $id);
            if ($this->db->update('allowance_holiday_weekend_rules', $formArray)) {
                $this->session->set_flashdata('success', 'Record Updated successfully!');
            } else {
                $this->session->set_flashdata('failure', 'Record Update failed!');
            }
            redirect(base_url() . 'index.php/setup_con/weekend_allowance_setup');

        }

    }

    public function weekend_allowance_delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('allowance_holiday_weekend_rules');
        $this->session->set_flashdata('success', 'Record Deleted successfully!');
        redirect(base_url() . 'index.php/setup_con/weekend_allowance_setup');
    }

    //----------------------------------------------------------------------------------
    // CRUD for holiday/weekend allowance end
    //----------------------------------------------------------------------------------
    //----------------------------------------------------------------------------------
    // CRUD for tiffin bill start
    //----------------------------------------------------------------------------------

    public function tiffin_bill_setup()
    {
		$this->db->select('allowance_tiffin_bill.*,pr_units.unit_name');
		$this->db->from('allowance_tiffin_bill');
		$this->db->join('pr_units', 'pr_units.unit_id=allowance_tiffin_bill.unit_id');
        $this->data['allowance_tiffin_bill'] = $this->db->get()->result_array();
        $this->data['title'] = 'Attendance Bonus List';
        $this->data['username'] = $this->data['user_data']->id_number;
        $this->data['subview'] = 'setup/tiffin_bill_list';
        $this->load->view('layout/template', $this->data);
    }

    public function tiffin_bill_add()
    {

        $this->load->library('form_validation');
        $this->load->model('crud_model');
        $this->form_validation->set_rules('unit_id', 'Unit', 'required');
        $this->form_validation->set_rules('rule_name', 'Rule Name', 'trim|required');
        $this->form_validation->set_rules('rule', 'Amount', 'required');

        if ($this->form_validation->run() == false) {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $this->session->set_flashdata('failure', $this->form_validation->error_array());
            }
            $this->db->select('pr_units.*');
            $this->data['pr_units'] = $this->db->get('pr_units')->result();
            $this->data['title'] = 'Add Holyday/Weekend Allowance';
            $this->data['username'] = $this->data['user_data']->id_number;
            $this->data['subview'] = 'setup/tiffin_bill_add';
            $this->load->view('layout/template', $this->data);
        } else {
            $formArray = array(
                'unit_id' => $this->input->post('unit_id'),
                'rule_name' => $this->input->post('rule_name'),
                'allowance_amount' => $this->input->post('rule'),
            );
            if ($this->db->insert('allowance_tiffin_bill', $formArray)) {
                $this->session->set_flashdata('success', 'Record adder successfully!');
            } else {
                $this->session->set_flashdata('failure', 'Record adder failed!');
            }
            redirect(base_url() . 'index.php/setup_con/tiffin_bill_setup');
        }

    }

    public function tiffin_bill_edit($id)
    {
        $this->load->library('form_validation');
        $this->load->model('crud_model');
        $this->form_validation->set_rules('unit_id', 'Unit', 'required');
        $this->form_validation->set_rules('rule_name', 'Rule Name', 'trim|required');
        $this->form_validation->set_rules('rule', 'Amount', 'required');

        if ($this->form_validation->run() == false) {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $this->session->set_flashdata('failure', $this->form_validation->error_array());
            }
			$this->db->select('pr_units.*');
            $this->data['pr_units'] = $this->db->get('pr_units')->result();

            $this->db->where('id', $id);
            $this->data['attbn'] = $this->db->get('allowance_tiffin_bill')->row($id);
            $this->data['title'] = 'Edit Holyday/Weekend Allowance';
            $this->data['username'] = $this->data['user_data']->id_number;
            $this->data['subview'] = 'setup/tiffin_bill_edit';
            $this->load->view('layout/template', $this->data);
        } else {
            $formArray = array(
                'unit_id' => $this->input->post('unit_id'),
                'rule_name' => $this->input->post('rule_name'),
                'allowance_amount' => $this->input->post('rule'),
            );
            $this->db->where('id', $id);
            if ($this->db->update('allowance_tiffin_bill', $formArray)) {
                $this->session->set_flashdata('success', 'Record Updated successfully!');
            } else {
                $this->session->set_flashdata('failure', 'Record Update failed!');
            }
            redirect(base_url() . 'index.php/setup_con/tiffin_bill_setup');

        }

    }

    public function tiffin_bill_delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('allowance_tiffin_bill');
        $this->session->set_flashdata('success', 'Record Deleted successfully!');
        redirect(base_url() . 'index.php/setup_con/tiffin_bill_setup');
    }

    //----------------------------------------------------------------------------------
    // CRUD for Tiffin Bill end
    //----------------------------------------------------------------------------------


    public function iftar_bill_setup()
    {
		$this->db->select('allowance_iftar_bill.*,pr_units.unit_name');
		$this->db->from('allowance_iftar_bill');
		$this->db->join('pr_units', 'pr_units.unit_id=allowance_iftar_bill.unit_id');
        $this->data['allowance_iftar_bill'] = $this->db->get()->result_array();
        $this->data['title'] = 'Attendance Bonus List';
        $this->data['username'] = $this->data['user_data']->id_number;
        $this->data['subview'] = 'setup/iftar_bill_list';
        $this->load->view('layout/template', $this->data);
    }

    public function iftar_bill_add()
    {

        $this->load->library('form_validation');
        $this->load->model('crud_model');
        $this->form_validation->set_rules('unit_id', 'Unit', 'required');
        $this->form_validation->set_rules('rule_name', 'Rule Name', 'trim|required');
        $this->form_validation->set_rules('rule', 'Amount', 'required');

        if ($this->form_validation->run() == false) {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $this->session->set_flashdata('failure', $this->form_validation->error_array());
            }
            $this->db->select('pr_units.*');
            $this->data['pr_units'] = $this->db->get('pr_units')->result();
            $this->data['title'] = 'Add Holyday/Weekend Allowance';
            $this->data['username'] = $this->data['user_data']->id_number;
            $this->data['subview'] = 'setup/iftar_bill_add';
            $this->load->view('layout/template', $this->data);
        } else {
            $formArray = array(
                'unit_id' => $this->input->post('unit_id'),
                'rule_name' => $this->input->post('rule_name'),
                'allowance_amount' => $this->input->post('rule'),
            );
            if ($this->db->insert('allowance_iftar_bill', $formArray)) {
                $this->session->set_flashdata('success', 'Record adder successfully!');
            } else {
                $this->session->set_flashdata('failure', 'Record adder failed!');
            }
            redirect(base_url() . 'index.php/setup_con/iftar_bill_setup');
        }

    }

    public function iftar_bill_edit($id)
    {
        $this->load->library('form_validation');
        $this->load->model('crud_model');
        $this->form_validation->set_rules('unit_id', 'Unit', 'required');
        $this->form_validation->set_rules('rule_name', 'Rule Name', 'trim|required');
        $this->form_validation->set_rules('rule', 'Amount', 'required');

        if ($this->form_validation->run() == false) {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $this->session->set_flashdata('failure', $this->form_validation->error_array());
            }
			$this->db->select('pr_units.*');
            $this->data['pr_units'] = $this->db->get('pr_units')->result();

            $this->db->where('id', $id);
            $this->data['attbn'] = $this->db->get('allowance_iftar_bill')->row($id);
            $this->data['title'] = 'Edit Holyday/Weekend Allowance';
            $this->data['username'] = $this->data['user_data']->id_number;
            $this->data['subview'] = 'setup/iftar_bill_edit';
            $this->load->view('layout/template', $this->data);
        } else {
            $formArray = array(
                'unit_id' => $this->input->post('unit_id'),
                'rule_name' => $this->input->post('rule_name'),
                'allowance_amount' => $this->input->post('rule'),
            );
            $this->db->where('id', $id);
            if ($this->db->update('allowance_iftar_bill', $formArray)) {
                $this->session->set_flashdata('success', 'Record Updated successfully!');
            } else {
                $this->session->set_flashdata('failure', 'Record Update failed!');
            }
            redirect(base_url() . 'index.php/setup_con/iftar_bill_setup');

        }

    }

    public function iftar_bill_delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('allowance_iftar_bill');
        $this->session->set_flashdata('success', 'Record Deleted successfully!');
        redirect(base_url() . 'index.php/setup_con/iftar_bill_setup');
    }

    //----------------------------------------------------------------------------------
    // CRUD for Ifter end
    //----------------------------------------------------------------------------------

    //----------------------------------------------------------------------------------
    // CRUD for Night Allowance Start
    //----------------------------------------------------------------------------------
    public function night_allowance_setup()
    {
		$this->db->select('allowance_night_rules.*,pr_units.unit_name');
		$this->db->from('allowance_night_rules');
		$this->db->join('pr_units', 'pr_units.unit_id=allowance_night_rules.unit_id');
        $this->data['allowance_night_rules'] = $this->db->get()->result_array();
        $this->data['title'] = 'Night Allowance List';
        $this->data['username'] = $this->data['user_data']->id_number;
        $this->data['subview'] = 'setup/night_allowance_list';
        $this->load->view('layout/template', $this->data);
    }

    public function night_allowance_add()
    {
        $this->load->library('form_validation');
        $this->load->model('crud_model');
        $this->form_validation->set_rules('unit_id', 'Unit', 'required');
        $this->form_validation->set_rules('rule_name', 'Rule Name', 'trim|required');
        $this->form_validation->set_rules('rule', 'Amount', 'required');
        $this->form_validation->set_rules('night_time', 'Time', 'required');


        if ($this->form_validation->run() == false) {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $this->session->set_flashdata('failure', $this->form_validation->error_array());
            }
            $this->db->select('pr_units.*');
            $this->data['pr_units'] = $this->db->get('pr_units')->result();
            $this->data['title'] = 'Add Night Allowance';
            $this->data['username'] = $this->data['user_data']->id_number;
            $this->data['subview'] = 'setup/night_allowance_add';
            $this->load->view('layout/template', $this->data);
        } else {
            $formArray = array(
                'unit_id' => $this->input->post('unit_id'),
                'rule_name' => $this->input->post('rule_name'),
                'night_allowance' => $this->input->post('rule'),
                'night_time' => $this->input->post('night_time'),
            );
            if ($this->db->insert('allowance_night_rules', $formArray)) {
                $this->session->set_flashdata('success', 'Record adder successfully!');
            } else {
                $this->session->set_flashdata('failure', 'Record adder failed!');
            }
            redirect(base_url() . 'index.php/setup_con/night_allowance_setup');
        }

    }

    public function night_allowance_edit($id)
    {
        $this->load->library('form_validation');
        $this->load->model('crud_model');
        $this->form_validation->set_rules('unit_id', 'Unit', 'required');
        $this->form_validation->set_rules('rule_name', 'Rule Name', 'trim|required');
        $this->form_validation->set_rules('rule', 'Amount', 'required');
        $this->form_validation->set_rules('night_time', 'Time', 'required');

        if ($this->form_validation->run() == false) {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $this->session->set_flashdata('failure', $this->form_validation->error_array());
            }
			$this->db->select('pr_units.*');
            $this->data['pr_units'] = $this->db->get('pr_units')->result();

            $this->db->where('id', $id);
            $this->data['attbn'] = $this->db->get('allowance_night_rules')->row($id);
            $this->data['title'] = 'Edit Night Allowance';
            $this->data['username'] = $this->data['user_data']->id_number;
            $this->data['subview'] = 'setup/night_allowance_edit';
            $this->load->view('layout/template', $this->data);
        } else {
            $formArray = array(
                'unit_id' => $this->input->post('unit_id'),
                'rule_name' => $this->input->post('rule_name'),
                'night_allowance' => $this->input->post('rule'),
                'night_time' => $this->input->post('night_time'),
            );
            $this->db->where('id', $id);
            if ($this->db->update('allowance_night_rules', $formArray)) {
                $this->session->set_flashdata('success', 'Record Updated successfully!');
            } else {
                $this->session->set_flashdata('failure', 'Record Update failed!');
            }
            redirect(base_url() . 'index.php/setup_con/night_allowance_setup');

        }

    }
    public function night_allowance_delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('allowance_night_rules');
        $this->session->set_flashdata('success', 'Record Deleted successfully!');
        redirect(base_url() . 'index.php/setup_con/night_allowance_setup');
    }
    //----------------------------------------------------------------------------------
    // CRUD for Night Allowance end
    //----------------------------------------------------------------------------------

    //----------------------------------------------------------------------------------
    // CRUD for Night Allowance Start
    //----------------------------------------------------------------------------------
    public function designation()
    {
        $this->db->select('emp_designation.*, IFNULL(pr_units.unit_name, "none") as unit_name, 
        IFNULL(allowance_attn_bonus.rule_name, "none") as allowance_attn_bonus, 
        IFNULL(allowance_holiday_weekend_rules.rule_name, "none") as allowance_holiday_weekend, 
        IFNULL(allowance_iftar_bill.rule_name, "none") as allowance_iftar, 
        IFNULL(allowance_night_rules.rule_name, "none") as allowance_night_rules, 
        IFNULL(allowance_tiffin_bill.rule_name, "none") as allowance_tiffin');
        $this->db->from('emp_designation');
        $this->db->join('pr_units', 'pr_units.unit_id=emp_designation.unit_id', 'left');
        $this->db->join('allowance_attn_bonus', 'allowance_attn_bonus.id=emp_designation.attn_id', 'left');
        $this->db->join('allowance_holiday_weekend_rules', 'allowance_holiday_weekend_rules.id=emp_designation.holiday_weekend_id', 'left');
        $this->db->join('allowance_iftar_bill', 'allowance_iftar_bill.id=emp_designation.iftar_id', 'left');
        $this->db->join('allowance_night_rules', 'allowance_night_rules.id=emp_designation.night_al_id', 'left');
        $this->db->join('allowance_tiffin_bill', 'allowance_tiffin_bill.id=emp_designation.tiffin_id', 'left');
        $this->data['emp_designation'] = $this->db->get()->result_array();
        // dd($this->data['emp_designation']);
        $this->data['title'] = 'Designation List';
        $this->data['username'] = $this->data['user_data']->id_number;
        $this->data['subview'] = 'setup/desig_list';
        $this->load->view('layout/template', $this->data);
    }

    public function get_data_degi()
    {
        $unit_id = $_POST['unit_id'];
    
        $data = [];
    
        $data['attn_bonus'] = $this->db->where('allowance_attn_bonus.unit_id', $unit_id)
                                       ->get('allowance_attn_bonus')
                                       ->result_array();
    
        $data['holiday_weekend'] = $this->db->where('allowance_holiday_weekend_rules.unit_id', $unit_id)
                                             ->get('allowance_holiday_weekend_rules')
                                             ->result_array();
    
        $data['iftar'] = $this->db->where('allowance_iftar_bill.unit_id', $unit_id)
                                  ->get('allowance_iftar_bill')
                                  ->result_array();
    
        $data['night'] = $this->db->where('allowance_night_rules.unit_id', $unit_id)
                                  ->get('allowance_night_rules')
                                  ->result_array();
    
        $data['tiffin'] = $this->db->where('allowance_tiffin_bill.unit_id', $unit_id)
                                   ->get('allowance_tiffin_bill')
                                   ->result_array();
    
        echo json_encode($data);
    }


    public function designation_add()
    {
        $this->load->library('form_validation');
        $this->load->model('crud_model');
        $this->form_validation->set_rules('desig_name', 'Designation Name English', 'required');
        $this->form_validation->set_rules('desig_bangla', 'Designation Bangla', 'required');
        $this->form_validation->set_rules('unit_id', 'Unit', 'required');
        $this->form_validation->set_rules('attn_id', 'Attendence Bonus', 'required');
        $this->form_validation->set_rules('holiday_weekend_id', 'Holiday Weekend', 'required');
        $this->form_validation->set_rules('iftar_id', 'Iftar Allowance', 'required');
        $this->form_validation->set_rules('night_al_id', 'Night Allowance', 'required');
        $this->form_validation->set_rules('tiffin_id', 'Tiffin Allowance', 'required');




        if ($this->form_validation->run() == false) {

            if ($_SERVER["REQUEST_METHOD"] == "POST") {

                $this->session->set_flashdata('failure', $this->form_validation->error_array());
            
            }
            $this->db->select('pr_units.*');
            $this->data['pr_units'] = $this->db->get('pr_units')->result();
            $this->data['title'] = 'Add Designation';
            $this->data['username'] = $this->data['user_data']->id_number;
            $this->data['subview'] = 'setup/desig_add';
            $this->load->view('layout/template', $this->data);
        } else {
            // dd($_POST);
            // Array
            // (
            //     [desig_name] => Hello
            //     [desig_bangla] => hi
            //     [unit_id] => 1
            //     [attn_id] => 9
            //     [holiday_weekend_id] => 8
            //     [iftar_id] => 8
            //     [night_al_id] => 22
            //     [tiffin_id] => 0
            // )
            $formArray = array(
                'unit_id' => $this->input->post('unit_id'),
                'desig_name' => $this->input->post('desig_name'),
                'desig_bangla' => $this->input->post('desig_bangla'),
                'attn_id' => $this->input->post('attn_id'),
                'holiday_weekend_id' => $this->input->post('holiday_weekend_id'),
                'iftar_id' => $this->input->post('iftar_id'),
                'night_al_id' => $this->input->post('night_al_id'),
                'tiffin_id' => $this->input->post('tiffin_id'),
            );
            if ($this->db->insert('emp_designation', $formArray)) {
                $this->session->set_flashdata('success', 'Record adder successfully!');
            } else {
                $this->session->set_flashdata('failure', 'Record adder failed!');
            }
            redirect(base_url() . 'index.php/setup_con/designation');
        }

    }

    public function designation_edit($id)
    {
        $this->load->library('form_validation');
        $this->load->model('crud_model');
        $this->form_validation->set_rules('desig_name', 'Designation Name English', 'required');
        $this->form_validation->set_rules('desig_bangla', 'Designation Bangla', 'required');
        $this->form_validation->set_rules('unit_id', 'Unit', 'required');
        $this->form_validation->set_rules('attn_id', 'Attendence Bonus', 'required');
        $this->form_validation->set_rules('holiday_weekend_id', 'Holiday Weekend', 'required');
        $this->form_validation->set_rules('iftar_id', 'Iftar Allowance', 'required');
        $this->form_validation->set_rules('night_al_id', 'Night Allowance', 'required');
        $this->form_validation->set_rules('tiffin_id', 'Tiffin Allowance', 'required');

        if ($this->form_validation->run() == false) {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $this->session->set_flashdata('failure', $this->form_validation->error_array());
            }
			$this->db->select('pr_units.*');
            $this->data['pr_units'] = $this->db->get('pr_units')->result();

            $this->db->select('emp_designation.*, IFNULL(pr_units.unit_name, "none") as unit_name, 
            IFNULL(allowance_attn_bonus.rule_name, "none") as allowance_attn_bonus, 
            IFNULL(allowance_holiday_weekend_rules.rule_name, "none") as allowance_holiday_weekend, 
            IFNULL(allowance_iftar_bill.rule_name, "none") as allowance_iftar, 
            IFNULL(allowance_night_rules.rule_name, "none") as allowance_night_rules, 
            IFNULL(allowance_tiffin_bill.rule_name, "none") as allowance_tiffin');
            $this->db->from('emp_designation');
            $this->db->join('pr_units', 'pr_units.unit_id=emp_designation.unit_id', 'left');
            $this->db->join('allowance_attn_bonus', 'allowance_attn_bonus.id=emp_designation.attn_id', 'left');
            $this->db->join('allowance_holiday_weekend_rules', 'allowance_holiday_weekend_rules.id=emp_designation.holiday_weekend_id', 'left');
            $this->db->join('allowance_iftar_bill', 'allowance_iftar_bill.id=emp_designation.iftar_id', 'left');
            $this->db->join('allowance_night_rules', 'allowance_night_rules.id=emp_designation.night_al_id', 'left');
            $this->db->join('allowance_tiffin_bill', 'allowance_tiffin_bill.id=emp_designation.tiffin_id', 'left');
            $this->db->where('emp_designation.id', $id);
            $this->data['emp_designation'] = $this->db->get()->row();

            $this->data['title'] = 'Edit Designation';
            $this->data['username'] = $this->data['user_data']->id_number;
            $this->data['subview'] = 'setup/desig_edit';
            $this->load->view('layout/template', $this->data);
        } else {
            $formArray = array(
                'unit_id' => $this->input->post('unit_id'),
                'desig_name' => $this->input->post('desig_name'),
                'desig_bangla' => $this->input->post('desig_bangla'),
                'attn_id' => $this->input->post('attn_id'),
                'holiday_weekend_id' => $this->input->post('holiday_weekend_id'),
                'iftar_id' => $this->input->post('iftar_id'),
                'night_al_id' => $this->input->post('night_al_id'),
                'tiffin_id' => $this->input->post('tiffin_id'),
            );
            $this->db->where('id', $id);
            if ($this->db->update('emp_designation', $formArray)) {
                $this->session->set_flashdata('success', 'Record Updated successfully!');
            } else {
                $this->session->set_flashdata('failure', 'Record Update failed!');
            }
            redirect(base_url() . 'index.php/setup_con/designation');

        }

    }
    public function designation_delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('emp_designation');
        $this->session->set_flashdata('success', 'Record Deleted successfully!');   
        redirect(base_url() . 'index.php/setup_con/designation');
    }
    //----------------------------------------------------------------------------------
    // CRUD for Night Allowance end
    //----------------------------------------------------------------------------------

    //-------------------------------------------------------------------------------------------------------
    // CRUD for Shift Schedules start
    //-------------------------------------------------------------------------------------------------------
    public function shift_schedule()
    {
        $pr_emp_shift_schedule = $this->crud_model->shiftschedule_infos();
        $this->data['pr_emp_shift_schedule'] = $pr_emp_shift_schedule;
        $this->data['title'] = 'Shift Schedule List';
        $this->data['username'] = $this->data['user_data']->id_number;
        $this->data['subview'] = 'setup/shift_schedule_list';
        $this->load->view('layout/template', $this->data);
    }
    function shiftschedule_add(){

        $this->load->library('form_validation');
        $this->load->model('crud_model');
        $data['shiftscheduleinfo'] = $this->crud_model->shiftschedule_fetch();
        // print_r($data);exit();
        $this->form_validation->set_rules('stype', 'shiftschedule Shift Type', 'trim|required');
        $this->form_validation->set_rules('instrt', 'shiftschedule In Start', 'trim|required');
        $this->form_validation->set_rules('intime', 'shiftschedule In Time', 'trim|required');
        $this->form_validation->set_rules('ltstart', 'shiftschedule Late Start', 'trim|required');
        $this->form_validation->set_rules('inend', 'shiftschedule In End', 'trim|required');
        $this->form_validation->set_rules('outstart', 'shiftschedule Out Start', 'trim|required');
        $this->form_validation->set_rules('outend', 'shiftschedule Out End', 'trim|required');
        $this->form_validation->set_rules('otstart', 'shiftschedule Ot Start', 'trim|required');
        $this->form_validation->set_rules('otminute', 'shiftschedule Ot Minute', 'trim|required');
        $this->form_validation->set_rules('onehrottime', 'shiftschedule One Hour Ot Time', 'trim|required');
        $this->form_validation->set_rules('twohrottime', 'shiftschedule Two Hour Ot Time', 'trim|required');


       if($this->form_validation->run() == false){

            $this->data['title'] = 'Shift Schedule Add';
            $this->data['allUnit'] = $this->crud_model->getallUnit();
            $this->data['username'] = $this->data['user_data']->id_number;
            $this->data['subview'] = 'setup/shiftschedule_add';
            $this->load->view('layout/template', $this->data);
       }else{
           // print_r($_FILES['logoAAAAA']);
           // print_r($_POST);exit();
            $formArray = array();
            $formArray['unit_id'] = $this->input->post('uname');
            $formArray['sh_type'] = $this->input->post('stype');
            $formArray['in_start'] = $this->input->post('instrt');
            $formArray['in_time'] = $this->input->post('intime');
            $formArray['late_start'] = $this->input->post('ltstart');
            $formArray['in_end'] = $this->input->post('inend');
            $formArray['out_start'] = $this->input->post('outstart');
            $formArray['out_end'] = $this->input->post('outend');
            $formArray['ot_start'] = $this->input->post('otstart');
            $formArray['ot_minute_to_one_hour'] = $this->input->post('otminute');
            $formArray['one_hour_ot_out_time'] = $this->input->post('onehrottime');
            $formArray['two_hour_ot_out_time'] = $this->input->post('twohrottime');


           $this->crud_model->shiftschedule_add($formArray);
           $this->session->set_flashdata('success','Record adder successfully!');
           redirect(base_url().'index.php/setup_con/shift_schedule');
       }

   }


       function shiftschedule_edit($shiftscheduleId)
       {
           $data = array();
           $this->load->model('crud_model');
           $this->load->library('form_validation');
            $data['shiftschedule'] = $this->crud_model->shiftschedule_fetch();


            $this->form_validation->set_rules('uname', 'shiftschedule Unit Name', 'trim|required');
            $this->form_validation->set_rules('stype', 'shiftschedule Shift Type', 'trim|required');
            $this->form_validation->set_rules('instrt', 'shiftschedule In Start', 'trim|required');
            $this->form_validation->set_rules('intime', 'shiftschedule In Time', 'trim|required');
            $this->form_validation->set_rules('ltstart', 'shiftschedule Late Start', 'trim|required');
            $this->form_validation->set_rules('inend', 'shiftschedule In End', 'trim|required');
            $this->form_validation->set_rules('outstart', 'shiftschedule Out Start', 'trim|required');
            $this->form_validation->set_rules('outend', 'shiftschedule Out End', 'trim|required');
            $this->form_validation->set_rules('otstart', 'shiftschedule Ot Start', 'trim|required');
            $this->form_validation->set_rules('otminute', 'shiftschedule Ot Minute', 'trim|required');
            $this->form_validation->set_rules('onehrottime', 'shiftschedule One Hour Ot Time', 'trim|required');
            $this->form_validation->set_rules('twohrottime', 'shiftschedule Two Hour Ot Time', 'trim|required');

           $data['shiftschedule'] = $this->crud_model->shiftschedule_fetch();


            if($this->form_validation->run() == false)
           {
            $this->data['allUnit'] = $this->crud_model->getallUnit();

           $this->data['pr_emp_shift_schedule'] = $this->crud_model->getshiftschedule($shiftscheduleId);
           $this->data['title'] = 'Shift Schedule Edit';
           $this->data['username'] = $this->data['user_data']->id_number;
           $this->data['subview'] = 'setup/shiftschedule_edit';
           $this->load->view('layout/template', $this->data);
           }
           else
           {
               $this->crud_model->shiftschedule_edit($shiftscheduleId);
               $this->session->set_flashdata('success','Record Updated successfully!');

               redirect('/setup_con/shift_schedule');


           }


       }


       function shiftschedule_delete($shiftscheduleId)
       {
           $this->load->model('crud_model');
           $shiftschedule = $this->crud_model->getshiftschedule($shiftscheduleId);
           if (empty($shiftschedule)) {
               $this->session->set_flashdata('failure','Record Not Found in DataBase!');
               redirect('/setup_con/shift_schedule');
           }
           $this->crud_model->shiftschedule_delete($shiftscheduleId);
           $this->session->set_flashdata('success','Record Deleted successfully!');
               redirect('/setup_con/shift_schedule');
       }

  //-------------------------------------------------------------------------------------------------------
    // CRUD for Shift Schedules end
    //-------------------------------------------------------------------------------------------------------

  //-------------------------------------------------------------------------------------------------------
    // CRUD for Shift Management start
    //-------------------------------------------------------------------------------------------------------
    public function shift_management()
    {
        $pr_emp_shift = $this->crud_model->shiftmanagement_infos();
        $this->data['pr_emp_shift'] = $pr_emp_shift;
        $this->data['title'] = 'Shift Management List';
        $this->data['username'] = $this->data['user_data']->id_number;
        $this->data['subview'] = 'setup/shift_management_list';
        $this->load->view('layout/template', $this->data);

    }
    function shiftmanagement_add(){

        $this->load->library('form_validation');
        $this->load->model('crud_model');
        $data['shiftmanagementinfo'] = $this->crud_model->shiftmanagement_fetch();
        $this->form_validation->set_rules('stype', 'shiftmanagement Shift Type', 'trim|required');
        $this->form_validation->set_rules('stname', 'shiftmanagement In Start', 'trim|required');
        $this->form_validation->set_rules('unitid', 'shiftmanagement In Time', 'trim|required');
       if($this->form_validation->run() == false){

        $this->data['title'] = 'Shift Management Add';
        $this->data['username'] = $this->data['user_data']->id_number;
        $this->data['subview'] = 'setup/shiftmanagement_add';
        $this->load->view('layout/template', $this->data);

       }else{
           // print_r($_FILES['logoAAAAA']);
           // print_r($_POST);exit();
            $formArray = array();
            $formArray['shift_name'] = $this->input->post('stname');
            $formArray['unit_id'] = $this->input->post('unitid');
            $formArray['shift_duty'] = $this->input->post('stype');



           $this->crud_model->shiftmanagement_add($formArray);
           $this->session->set_flashdata('success','Record adder successfully!');
           redirect(base_url().'index.php/setup_con/shift_management');
       }

   }


       function shiftmanagement_edit($shiftmanagementId)
       {
           $data = array();
           $this->load->model('crud_model');
           $this->load->library('form_validation');
            $data['shiftmanagement'] = $this->crud_model->shiftmanagement_fetch();

           // print_r($data);

            $this->form_validation->set_rules('stype', 'shiftmanagement Shift Type', 'trim|required');
            $this->form_validation->set_rules('stname', 'shiftmanagement Shift Name', 'trim|required');
            $this->form_validation->set_rules('unitid', 'shiftmanagement Unit ID', 'trim|required');


           // $data['shiftmanagement'] = $this->crud_model->shiftmanagement_fetch();


            if($this->form_validation->run() == false)
           {
                $this->data['pr_emp_shift'] = $this->crud_model->getshiftmanagement($shiftmanagementId);
                $this->data['title'] = 'Shift Management Edit';
                $this->data['username'] = $this->data['user_data']->id_number;
                $this->data['subview'] = 'setup/shiftmanagement_edit';
                $this->load->view('layout/template', $this->data);
           }
           else
           {

               $this->crud_model->shiftmanagement_edit($shiftmanagementId);
               $this->session->set_flashdata('success','Record Updated successfully!');

               redirect('/setup_con/shift_management');


           }


       }


       function shiftmanagement_delete($shiftmanagementId)
       {
           $this->load->model('crud_model');
           $shiftmanagement = $this->crud_model->getshiftmanagement($shiftmanagementId);
           if (empty($shiftmanagement)) {
               $this->session->set_flashdata('failure','Record Not Found in DataBase!');
               redirect('/setup_con/shift_management');
           }
           $this->crud_model->shiftmanagement_delete($shiftmanagementId);
           $this->session->set_flashdata('success','Record Deleted successfully!');
               redirect('/setup_con/shift_management');
       }



//-------------------------------------------------------------------------------------------------------
// CRUD for Shift Management end
//-------------------------------------------------------------------------------------------------------


    // old code

    //-------------------------------------------------------------------------------------------------------
    // Company info Setup
    //-------------------------------------------------------------------------------------------------------
    public function company_info_setup()
    {
        $company_infos = $this->common_model->company_information();
        $data = array();
        $data['company_infos'] = $company_infos;
        $this->load->view('output2', $data);
    }

    //-------------------------------------------------------------------------------------------------------
    // CRUD output method
    //-------------------------------------------------------------------------------------------------------
    public function crud_output($output = null)
    {
        $this->load->view('output.php', $output);
    }

    // function staff_id_entry()
    // {
    //     $crud = new grocery_CRUD();

    //     $crud->set_table('staff_ot_list_emp');
    //     $crud->set_subject('Entry Emp Id');
    //     $crud->display_as( 'emp_id' , 'EMP_ID' );
    //     $crud->unset_delete();

    //     $output = $crud->render();

    //     $this->crud_output($output);
    // }

    // function proxi_id_entry()
    // {
    //     $crud = new grocery_CRUD();

    //     $crud->set_table('pr_id_proxi');
    //     $crud->set_subject('Entry Emp Id');
    //     $crud->display_as( 'emp_id' , 'EMP_ID' );
    //     $crud->display_as( 'proxi_id' , 'Proxi Id' );
    //     $crud->unset_delete();
    //     $crud->unset_add();

    //     $output = $crud->render();

    //     $this->crud_output($output);
    // }

    public function dashboard_date_setup()
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
        $this->load->view('dash_board_date.php', $output);
        $this->crud_output($output);

    }

    //-------------------------------------------------------------------------------------------------------
    // CRUD for Section
    //-------------------------------------------------------------------------------------------------------

    public function sec_name_check($str)
    {
        $id = $this->uri->segment(4);
        $unit_id = $_POST['unit_id'];
        if (!empty($id) && is_numeric($id)) {
            $sec_name_old = $this->db->where("sec_id", $id)->get('emp_section')->row()->sec_name;
            $this->db->where("sec_name !=", $sec_name_old);
        }
        $num_row = $this->db->where('sec_name', $str)->where('unit_id', $unit_id)->get('emp_section')->num_rows();
        if ($num_row >= 1) {
            $this->form_validation->set_message('sec_name_check', $str . ' already exists');
            return false;
        } else {
            return true;
        }
    }

    public function floor_name_check($str)
    {
        $unit_id = $_POST['unit_id'];
        $id = $this->uri->segment(4);
        if (!empty($id) && is_numeric($id)) {
            $line_name_old = $this->db->where("floor_name", $id)->get('pr_floor')->row()->line_name;
            $this->db->where("floor_name !=", $line_namee_old);
        }
        $num_row = $this->db->where('floor_name', $str)->where('unit_id', $unit_id)->get('pr_floor')->num_rows();
        if ($num_row >= 1) {
            $this->form_validation->set_message('floor_name_check', $str . ' already exists');
            return false;
        } else {
            return true;
        }
    }
    //-------------------------------------------------------------------------------------------------------
    // CRUD for Line
    //-------------------------------------------------------------------------------------------------------

    public function line_name_check($str)
    {
        $unit_id = $_POST['unit_id'];
        $id = $this->uri->segment(4);
        if (!empty($id) && is_numeric($id)) {
            $line_name_old = $this->db->where("line_id", $id)->get('pr_line_num')->row()->line_name;
            $this->db->where("line_name !=", $line_namee_old);
        }
        $num_row = $this->db->where('line_name', $str)->where('unit_id', $unit_id)->get('pr_line_num')->num_rows();
        if ($num_row >= 1) {
            $this->form_validation->set_message('line_name_check', $str . ' already exists');
            return false;
        } else {
            return true;
        }
    }
    //-------------------------------------------------------------------------------------------------------
    // CRUD for Designation
    //-------------------------------------------------------------------------------------------------------
   

    public function desig_name_check($str)
    {
        $unit_id = $_POST['unit_id'];
        $id = $this->uri->segment(4);
        if (!empty($id) && is_numeric($id)) {
            $desig_name_old = $this->db->where("desig_id", $id)->get('pr_designation')->row()->desig_name;
            $this->db->where("desig_name !=", $desig_name_old);
        }
        $num_row = $this->db->where('desig_name', $str)->where('unit_id', $unit_id)->get('pr_designation')->num_rows();
        if ($num_row >= 1) {
            $this->form_validation->set_message('desig_name_check', $str . ' already exists');
            return false;
        } else {
            return true;
        }
    }

    //-------------------------------------------------------------------------------------------------------
    // CRUD for Operation
    //-------------------------------------------------------------------------------------------------------
    public function operation()
    {
        $crud = new grocery_CRUD();

        $crud->set_table('pr_emp_operation');
        $crud->set_subject('Weight');
        $crud->display_as('ope_name', 'Weight');
        $crud->required_fields('ope_name');
        $crud->unset_delete();

        $output = $crud->render();

        $this->crud_output($output);
    }

    //-------------------------------------------------------------------------------------------------------
    // CRUD for Job Description Setup
    //-------------------------------------------------------------------------------------------------------
    public function job_desc()
    {
        $crud = new grocery_CRUD();
        $crud->set_table('pr_emp_job_desc');
        $crud->set_subject('Job Description');

        $crud->set_relation('emp_desig_id', 'pr_designation', 'desig_name');

        $crud->required_fields('emp_desig_id', 'description');
        $crud->display_as('description', 'Job Description')
            ->display_as('emp_desig_id', 'Designation');

        //$crud->unset_add();
        //$crud->unset_edit();
        //$crud->unset_delete();

        //$crud->set_rules('emp_desig_id','Designation','trim|required|callback_designation_check');
        $output = $crud->render();
        $this->crud_output($output);
    }

    public function nid_wk_typ()
    {
        $crud = new grocery_CRUD();
        $crud->set_table('pr_emp_nid_wk_typ');
        $crud->set_subject('N.Id & Work Type');

        //$crud->set_relation( 'emp_id' , 'pr_emp_com_info','emp_id' );

        $crud->display_as('n_id', 'National Id')->display_as('wk_type', 'Work Type');

        //$crud->unset_edit_fields('emp_id');
        //$crud->field_type('emp_id', 'readonly');
        $crud->unset_delete();

        $output = $crud->render();
        $this->crud_output($output);
    }
    public function work_process_type()
    {
        $crud = new grocery_CRUD();
        $crud->set_table('pr_work_process');
        $crud->set_subject('Process Type');

        //$crud->set_relation( 'emp_id' , 'pr_emp_com_info','emp_id' );

        $crud->display_as('id', 'Id')->display_as('process', 'Work Process Name');

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
  
    //-------------------------------------------------------------------------------------------------------
    // CRUD for Salary Grade
    //-------------------------------------------------------------------------------------------------------
    public function salary_grade($start = 0)
    {
        $this->load->library('pagination');
        $param = array();
        $limit = 10;
        $config['base_url'] = base_url() . "index.php/setup_con/salary_grade/";
        $config['per_page'] = $limit;
        $this->load->model('crud_model');
        $pr_grade = $this->crud_model->salgrd_infos($limit, $start);
        $total = $this->db->query("SELECT FOUND_ROWS() as count")->row()->count;
        $config['total_rows'] = $total;
        $config["uri_segment"] = 3;
        // $this->load->library('pagination');

        $this->pagination->initialize($config);
        $param['links'] = $this->pagination->create_links();

        $param['pr_grade'] = $pr_grade;
        $this->load->view('salgrd_list', $param);

    }
  
  
    //-------------------------------------------------------------------------------------------------------
    // CRUD for Leave Setup
    //-------------------------------------------------------------------------------------------------------
    public function leave_setup($start = 0)
    {

        $this->load->library('pagination');
        $param = array();
        $limit = 10;
        $config['base_url'] = base_url() . "index.php/setup_con/floor/";
        $config['per_page'] = $limit;
        $this->load->model('crud_model');
        $pr_leave = $this->crud_model->leave_infos($limit, $start);
        $total = $this->db->query("SELECT FOUND_ROWS() as count")->row()->count;
        $config['total_rows'] = $total;
        $config["uri_segment"] = 3;
        // $this->load->library('pagination');

        $this->pagination->initialize($config);
        $param['links'] = $this->pagination->create_links();

        $param['pr_leave'] = $pr_leave;
        $this->load->view('leave_list', $param);

    }

    //-------------------------------------------------------------------------------------------------------
    // CRUD for Deduction Setup
    //-------------------------------------------------------------------------------------------------------
    public function attributes_setup()
    {
        $crud = new grocery_CRUD();

        $crud->set_table('pr_setup');
        $crud->set_subject('Attributes');
        $crud->unset_delete();
        $crud->unset_add();
        $crud->change_field_type('attributes', 'readonly');
        $output = $crud->render();
        $this->crud_output($output);
    }

    //-------------------------------------------------------------------------------------------------------
    // CRUD for Night Allowance Setup
    //-------------------------------------------------------------------------------------------------------
  
    //-------------------------------------------------------------------------------------------------------
    // CRUD for Holiday Allowance Setup
    //-------------------------------------------------------------------------------------------------------
    public function holiday_allowance_setup($start = 0)
    {

        $this->load->library('pagination');
        $param = array();
        $limit = 10;
        $config['base_url'] = base_url() . "setup_con/holiday_allowance_setup/";
        $config['per_page'] = $limit;
        $this->load->model('crud_model');
        $pr_holiday_allowance_rules = $this->crud_model->holidayallowence_infos($limit, $start);
        $total = $this->db->query("SELECT FOUND_ROWS() as count")->row()->count;
        $config['total_rows'] = $total;
        $config["uri_segment"] = 3;
        // $this->load->library('pagination');

        $this->pagination->initialize($config);
        $param['links'] = $this->pagination->create_links();

        $param['pr_holiday_allowance_rules'] = $pr_holiday_allowance_rules;

        $this->load->view('holiday_allowance_list', $param);

    }

    //-------------------------------------------------------------------------------------------------------
    // CRUD for Weekend Allowance Setup
    //-------------------------------------------------------------------------------------------------------

    //-------------------------------------------------------------------------------------------------------
    // CRUD for Allowance Setup
    //-------------------------------------------------------------------------------------------------------
    public function tiffin_allowance_setup()
    {
        $crud = new grocery_CRUD();

        $crud->set_table('pr_tiffin_allowance_rules');
        $crud->set_subject('Tiffin Allowance Rules');
        $crud->required_fields('rule_name', 'allowance_amount', 'allowance_time');
        $crud->display_as('rule_name', 'Rules Name')
            ->display_as('allowance_amount', 'Amount')
            ->display_as('allowance_time', 'Time');

        //$crud->unset_delete();
        $crud->set_relation_n_n('Section', 'pr_tiffin_allowance_level', 'emp_section', 'rules_id', 'sec_id', 'sec_name', 'priority');
        //$crud->unset_add();
        //$crud->change_field_type('emp_category','readonly');
        $output = $crud->render();
        $this->crud_output($output);
    }
    //-------------------------------------------------------------------------------------------------------
    // CRUD for Festival Bonus Setup
    //-------------------------------------------------------------------------------------------------------
    public function bonus_setup($start = 0)
    {
        $this->load->library('pagination');
        $param = array();
        $limit = 10;
        $config['base_url'] = base_url() . "index.php/setup_con/bonus_setup/";
        $config['per_page'] = $limit;
        $this->load->model('crud_model');
        $pr_bonus_rules = $this->crud_model->bnruls_infos($limit, $start);
        $total = $this->db->query("SELECT FOUND_ROWS() as count")->row()->count;
        $config['total_rows'] = $total;
        $config["uri_segment"] = 3;
        // $this->load->library('pagination');

        $this->pagination->initialize($config);
        $param['links'] = $this->pagination->create_links();

        $param['pr_bonus_rules'] = $pr_bonus_rules;

        $this->load->view('bnrules_list', $param);

    }

    //-------------------------------------------------------------------------------------------------------
    // CRUD for Providend Fund Setup
    //-------------------------------------------------------------------------------------------------------
    public function pf_setup()
    {
        $crud = new grocery_CRUD();

        $crud->set_table('pr_provident_fund_rules');
        $crud->set_subject('Provident Fund Rules');
        $crud->required_fields('pf_start_month', 'pf_end_month', 'pf_percentage', 'pf_deduct_percentage', 'salay_type');
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
    public function unit()
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
        $this->load->view('output2', $data);
    }

    public function night_rules()
    {
        $crud = new grocery_CRUD();

        $crud->set_table('pr_night_rules');
        $crud->set_subject('Night_rules');
        $crud->set_relation('unit_id', 'pr_units', 'unit_name');
        $crud->display_as('unit_id', 'Unit Name')->display_as('deduct_hour', 'Deduct Hour');
        $crud->required_fields('unit_id', 'deduct_hour');
        $crud->unset_delete();
        $output = $crud->render();

        $this->crud_output($output);
    }

    public function attn_summary_setup()
    {

        $crud = new grocery_CRUD();
        $get_session_user_unit = $this->common_model->get_session_unit_id_name();
        if ($get_session_user_unit != 0) {
            $crud->where('pr_attn_summary_list.unit_id', $get_session_user_unit);
        }
        $crud->set_table('pr_attn_summary_list');
        $crud->set_subject('Attendance Summary');

        if ($get_session_user_unit != 0) {
            $crud->set_relation('unit_id', 'pr_units', 'unit_name', array('unit_id' => $get_session_user_unit));
        } else {
            $crud->set_relation('unit_id', 'pr_units', 'unit_name');
        }
        $where = "desig_id==2";
        $crud->set_relation_n_n('AttnSummary', 'pr_attn_summary_level', 'pr_designation', 'group_id', 'desig_id', 'desig_name', 'priority', array('pr_designation.desig_id' == 2), null);

        $output = $crud->render();
        $this->crud_output($output);
    }

}
