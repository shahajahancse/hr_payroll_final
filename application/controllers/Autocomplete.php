<?php
class Autocomplete extends CI_Controller {

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
	}
    public function employee_id(){
        $id=$this->input->post('id');
        $this->db->select('emp_id');
        $this->db->like('emp_id', $id);
        $this->db->limit(70);
        $query = $this->db->get('pr_emp_com_info');


        $outputArray = array_map(function ($obj) {
            return $obj["emp_id"];
        }, $query->result_array());
        echo json_encode($outputArray);
    }
    public function english_name(){
        $english_name=$this->input->post('english_name');
        $this->db->select('name_en');
        $this->db->like('name_en', $english_name);
        $this->db->limit(70);
        $query = $this->db->get('pr_emp_per_info');
        $outputArray = array_map(function ($obj) {
            return $obj["name_en"];
        }, $query->result_array());
        echo json_encode($outputArray);
    }
    public function bangla_name(){
        $bangla_name=$this->input->post('bangla_name');
        $this->db->select('name_bn');
        $this->db->like('name_bn', $bangla_name);
        $this->db->limit(70);
        $query = $this->db->get('pr_emp_per_info');
        $outputArray = array_map(function ($obj) {
            return $obj["name_bn"];
        }, $query->result_array());
        echo json_encode($outputArray);
    }





    public function english_village(){
        $english_village=$this->input->post('english_village');
        $this->db->select('per_village');
        $this->db->like('per_village', $english_village);
        $this->db->limit(70);
        $query = $this->db->get('pr_emp_per_info');
        $outputArray = array_map(function ($obj) {
            return $obj["per_village"];
        }, $query->result_array());
        echo json_encode($outputArray);
    }

    public function bangla_village(){
        $bangla_village=$this->input->post('bangla_village');
        $this->db->select('per_village_bn');
        $this->db->like('per_village_bn', $bangla_village);
        $this->db->limit(70);
        $query = $this->db->get('pr_emp_per_info');
        $outputArray = array_map(function ($obj) {
            return $obj["per_village_bn"];
        }, $query->result_array());
        echo json_encode($outputArray);
    }




	
}

