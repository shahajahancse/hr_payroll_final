<?php
class Monitoring_con extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		ini_set('memory_limit', -1);
		ini_set('max_execution_time', 0);
	    set_time_limit(0);

		$this->load->model('Common_model');
        $this->load->model('Monitoring_model');

        if ($this->session->userdata('logged_in') == false) {
            redirect("authentication");
        }
        $this->data['user_data'] = $this->session->userdata('data');
	}

	public function entry_list()
    {
        $this->db->select('training_type.*,pr_units.unit_name');
        $this->db->from('training_type');
        $this->db->join('pr_units', 'pr_units.unit_id = training_type.unit_id');
        $this->data['pr_line'] = $this->db->get()->result_array();
        $this->data['title'] = 'Training List';
        $this->data['username'] = $this->data['user_data']->id_number;
        $this->data['subview'] = 'training/training_list';
        $this->load->view('layout/template', $this->data);
    }






    
    public function training_add()
    {

        $this->load->library('form_validation');
        $this->load->model('Crud_model');
        $this->form_validation->set_rules('title', 'Title', 'trim|required');

        if ($this->form_validation->run() == false) {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $this->session->set_flashdata('failure', $this->form_validation->error_array());
            }

            //$this->db->select('pr_units.*');
            $this->data['unit'] = $this->pr_units_get();
            $this->data['title'] = 'Add Training';
            $this->data['username'] = $this->data['user_data']->id_number;
            $this->data['subview'] = 'training/training_add';
            $this->load->view('layout/template', $this->data);
        } else {
            $formArray = array(
                'title' => $this->input->post('title'),
                'unit_id' => $this->input->post('unit_id'),
                'description' => $this->input->post('description'),
				'status' => 1
            );

            if ($this->db->insert('training_type', $formArray)) {
                $this->session->set_flashdata('success', 'Record add successfully!');
            } else {
                $this->session->set_flashdata('failure', 'Record add failed!');
            }
            redirect(base_url() . 'training_con/training');
        }
    }

    public function training_edit($id)
    {
        $this->load->library('form_validation');
        $this->load->model('Crud_model');
		$this->form_validation->set_rules('title', 'Title', 'trim|required');


        if ($this->form_validation->run() == false) {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $this->session->set_flashdata('failure', $this->form_validation->error_array());
            }

            $this->db->select('pr_units.*');
            $this->data['unit'] = $this->db->get('pr_units')->result();
			$this->db->where('id', $id);
            $this->data['training'] = $this->db->get('training_type')->row();

            $this->data['title'] = 'Edit Training';
            $this->data['username'] = $this->data['user_data']->id_number;
            $this->data['subview'] = 'training/training_edit';
            $this->load->view('layout/template', $this->data);
        } else {
            $formArray = array(
				'title' => $this->input->post('title'),
				'unit_id' => $this->input->post('unit_id'),
				'description' => $this->input->post('description'),
				'status' => 1
            );
            $this->db->where('id', $id);
            if ($this->db->update('training_type', $formArray)) {
                $this->session->set_flashdata('success', 'Record Updated successfully!');
            } else {
                $this->session->set_flashdata('failure', 'Record Update failed!');
            }
            redirect(base_url() . 'training_con/training');

        }

    }

    public function training_delete($line_id)
    {
        $this->db->where('id', $line_id);
        $this->db->delete('training_type');
        $this->session->set_flashdata('success', 'Record Deleted successfully!');
        redirect(base_url() . 'training_con/training');
    }



}
