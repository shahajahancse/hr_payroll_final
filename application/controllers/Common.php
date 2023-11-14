<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Common extends CI_Controller {

    function ajax_district_by_div($id){

    	$data = array();
        $this->db->select('id, name_bn');
        $this->db->from('emp_districts');
        $this->db->where('div_id', $id);
        $this->db->order_by('name_bn', 'ASC');
        $query = $this->db->get()->result();

        foreach ($query as $row) {
            $data[$row->id] = $row->name_bn;
        }

        header('Content-Type: application/x-json; charset=utf-8');
        echo json_encode($data);
        exit;
    }

    function ajax_upazila_by_dis($id){

    	$data = array();
        $this->db->select('id, name_bn');
        $this->db->from('emp_upazilas');
        $this->db->where('dis_id', $id);
        $this->db->order_by('name_bn', 'ASC');
        $query = $this->db->get()->result();

        foreach ($query as $row) {
            $data[$row->id] = $row->name_bn;
        }

        header('Content-Type: application/x-json; charset=utf-8');
        echo json_encode($data);
        exit;
    }
    
    function ajax_post_office_by_upa_id($id){

        $data = array();
        $this->db->select('id, name_bn');
        $this->db->from('emp_post_offices');
        $this->db->where('up_zil_id', $id);
        $this->db->order_by('name_bn', 'ASC');
        $query = $this->db->get()->result();

        foreach ($query as $row) {
            $data[$row->id] = $row->name_bn;
        }

        header('Content-Type: application/x-json; charset=utf-8');
        echo json_encode($data);
        exit;
    }
    
    function ajax_section_by_dept_id($id){

        $data = array();
        $this->db->select('*');
        $this->db->from('emp_section');
        $this->db->where('depertment_id', $id);
        $this->db->order_by('sec_name_bn', 'ASC');
        $query = $this->db->get()->result();

        foreach ($query as $row) {
            $data[$row->id] = $row->sec_name_bn;
        }

        header('Content-Type: application/x-json; charset=utf-8');
        echo json_encode($data);
        exit;
    }
    
    function ajax_line_by_sec_id($id){

        $data = array();
        $this->db->select('*');
        $this->db->from('emp_line_num');
        $this->db->where('section_id', $id);
        $this->db->order_by('line_name_en', 'ASC');
        $query = $this->db->get()->result();

        foreach ($query as $row) {
            $data[$row->id] = $row->line_name_en;
        }

        header('Content-Type: application/x-json; charset=utf-8');
        echo json_encode($data);
        exit;
    }
    
    function ajax_designation_by_line_id($id){

        $data = array();
        $this->db->select('dl.*, dg.desig_name, dg.desig_bangla');
        $this->db->from('emp_dasignation_line_acl dl');
        $this->db->join('emp_designation dg', 'dg.desig_id = dl.designation_id', 'left');
        $this->db->where('line_id', $id);
        $this->db->order_by('designation_id', 'ASC');
        $query = $this->db->get()->result();

        foreach ($query as $row) {
            $data[$row->designation_id] = $row->desig_name;
        }

        header('Content-Type: application/x-json; charset=utf-8');
        echo json_encode($data);
        exit;
    }

}

