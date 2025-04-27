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

    // employee entry system start
	public function emp_list()
    {
        $this->db->select('
            com.emp_id,com.emp_join_date,com.gross_sal,
            per.name_en,per.father_name,per.mother_name,per.img_source,
            per.personal_mobile,per.emp_dob,per.gender,per.marital_status,
            dg.desig_name,line.line_name_en
        ');
        $this->db->from('pr_emp_com_info com');
        $this->db->join('pr_emp_per_info per', 'per.emp_id = com.emp_id', 'left');
        $this->db->join('emp_line_num line', 'line.id = com.emp_line_id', 'left');
        $this->db->join('emp_designation dg', 'dg.id = com.emp_desi_id', 'left');
        $this->data['results'] = $this->db->where('monotor_con', 2)->get()->result();
        // dd($this->data['results']);
        $this->data['title'] = 'Employee List';
        $this->data['username'] = $this->data['user_data']->id_number;
        $this->data['subview'] = 'monitoring/emp_list';
        $this->load->view('layout/template', $this->data);
    }

	public function approve_emp()
    {
        $emp_id = $this->input->post('emp_id');
        $this->db->trans_start();
        $data = array(
            'monotor_con' => 1,
        );
        $this->db->where('emp_id', $emp_id)->update('pr_emp_com_info', $data);
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            echo 'error';
        } else {
            $this->db->trans_commit();
            echo 'success';
        }
    }

    public function delete_emp()
    {
        $emp_id = $this->input->post('emp_id');

        $this->db->trans_start();
        $this->db->where('emp_id', $emp_id)->delete('pr_emp_com_info');
        $this->db->where('emp_id', $emp_id)->delete('pr_emp_per_info');
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            echo 'error';
        } else {
            $this->db->trans_commit();
            echo 'success';
        }
    }
    // employee entry system end

    // manual attendance entry start
	public function entry_list()
    {
        $last_month = array();
        $date = date("Y-m-d");
        if ($date < date('Y-m-15')) {
            $attn_table = "att_".date("Y_m", strtotime('-1 month', strtotime(date("Y-m-d"))));
            $last_month = $this->db->where('monitor_con', 2)->get($attn_table)->result();
        }
        $attn_table = "att_".date("Y_m");
        $current_data = $this->db->where('monitor_con', 2)->get($attn_table)->result();
        $this->data['results'] = array_merge($last_month, $current_data);

        $this->data['title'] = 'Training List';
        $this->data['username'] = $this->data['user_data']->id_number;
        $this->data['subview'] = 'monitoring/entry_list';
        $this->load->view('layout/template', $this->data);
    }

	public function approves()
    {

        $att_id = $this->input->post('id');
        $date_time = $this->input->post('date_time');
        $attn_table = "att_".date("Y_m", strtotime($date_time));

        $this->db->trans_start();
        $data = array(
            'monitor_con' => 1,
            'monitor_id' => $this->data['user_data']->id,
            'monitor_date' => date('Y-m-d H:i:s'),
        );
        $this->db->where('att_id', $att_id)->update($attn_table, $data);
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            echo 'error';
        } else {
            $this->db->trans_commit();
            echo 'success';
        }
    }

	public function deletes()
    {
        $att_id = $this->input->post('id');
        $date_time = $this->input->post('date_time');
        $attn_table = "att_".date("Y_m", strtotime($date_time));

        $this->db->trans_start();
        $this->db->where('att_id', $att_id)->delete($attn_table);
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            echo 'error';
        } else {
            $this->db->trans_commit();
            echo 'success';
        }
    }
    // manual attendance entry end
}
