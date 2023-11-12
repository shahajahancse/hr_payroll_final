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

}

