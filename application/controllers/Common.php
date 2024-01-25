<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Common extends CI_Controller {

    function grid_emp_list($unit, $dept=NULL, $section=NULL, $line=NULL, $desig=NULL){

    	$data = array();
        $this->db->select('com.id, com.emp_id, per.name_en, per.name_bn');
        $this->db->from('pr_emp_com_info as com');
        $this->db->join('pr_emp_per_info as per', 'per.emp_id = com.emp_id', 'left');
        $this->db->where('com.unit_id', $unit);

        if (!empty($dept)) {
            $this->db->where('com.emp_dept_id', $dept);
        }
        if (!empty($section)) {
            $this->db->where('com.emp_sec_id', $section);
        }
        if (!empty($line)) {
            $this->db->where('com.emp_line_id', $line);
        }
        if (!empty($desig)) {
            $this->db->where('com.emp_desi_id', $desig);
        }
        if (!empty($_GET['status'])) {
            $this->db->where('com.emp_cat_id', $_GET['status']);
        }

        $this->db->group_by('com.emp_id');
        $this->db->order_by('com.emp_id', 'asc');
        $result = $this->db->get()->result();

        header('Content-Type: application/x-json; charset=utf-8');
        echo json_encode($result);
        return;
    }

    function salary_emp_list($unit, $dept=NULL, $section=NULL, $line=NULL, $desig=NULL){
        $data = array();
        $this->db->select('ss.emp_id, per.name_en, per.name_bn');
        $this->db->from('pay_salary_sheet as ss');
        $this->db->join('pr_emp_com_info as com', 'ss.emp_id = com.emp_id', 'left');
        $this->db->join('pr_emp_per_info as per', 'ss.emp_id = per.emp_id', 'left');
        $this->db->where('ss.unit_id', $unit);
        $this->db->where('ss.salary_month', date('Y-m-01', strtotime($_GET['salary_month'])));

        if (!empty($dept)) {
            $this->db->where('com.emp_dept_id', $dept);
        }
        if (!empty($section)) {
            $this->db->where('com.emp_sec_id', $section);
        }
        if (!empty($line)) {
            $this->db->where('com.emp_line_id', $line);
        }
        if (!empty($desig)) {
            $this->db->where('com.emp_desi_id', $desig);
        }
        if (!empty($_GET['status'])) {
            $this->db->where('com.emp_cat_id', $_GET['status']);
        }
        if (!empty($_GET['stop_salary'])) {
            $this->db->where('ss.stop_salary', $_GET['stop_salary']);
        }

        $this->db->group_by('ss.emp_id');
        $this->db->order_by('ss.emp_id', 'asc');
        $result = $this->db->get()->result();

        header('Content-Type: application/x-json; charset=utf-8');
        echo json_encode($result);
        return;
    }

    function ajax_department_by_unit_id($id){

        $data = array();
        $this->db->select('*');
        $this->db->from('emp_depertment');
        $this->db->where('unit_id', $id);
        $this->db->order_by('dept_name', 'ASC');
        $query = $this->db->get()->result();

        foreach ($query as $row) {
            $data[$row->dept_id] = $row->dept_name;
        }

        header('Content-Type: application/x-json; charset=utf-8');
        echo json_encode($data);
        exit;
    }
    
    function ajax_section_by_dept_id($id, $unit_id = null){

        $data = array();
        $this->db->select('*');
        $this->db->from('emp_section');
        $this->db->where('depertment_id', $id);
        if (!empty($unit_id)) {
            $this->db->where('unit_id', $unit_id);
        }
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
        $this->db->join('emp_designation dg', 'dg.id = dl.designation_id', 'left');
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

    function ajax_designation_by_unit($id){

        $data = array();
        $this->db->select('ed.*');
        $this->db->from('emp_designation ed');
        $this->db->where('unit_id', $id);
        $this->db->order_by('desig_name', 'ASC');
        $query = $this->db->get()->result();

        foreach ($query as $row) {
            $data[$row->id] = $row->desig_name;
        }

        header('Content-Type: application/x-json; charset=utf-8');
        echo json_encode($data);
        exit;
    }

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
    
    function get_emp_info_by_id($id, $unit_id = null){

        $this->db->select('
                    com.*,
                    per.name_en,
                    per.name_bn,
                    per.img_source,

                    dept.dept_name,
                    dept.dept_bangla,
                    sec.sec_name_bn,
                    sec.sec_name_en,
                    line.line_name_en,
                    line.line_name_bn,
                    deg.desig_name,
                    deg.desig_bangla,
                ');
        $this->db->from('pr_emp_com_info as com');
        $this->db->join('pr_emp_per_info as per', 'per.emp_id = com.emp_id', 'left');
        $this->db->join('emp_depertment as dept', 'dept.dept_id = com.emp_dept_id', 'left');
        $this->db->join('emp_section as sec', 'sec.id = com.emp_sec_id', 'left');
        $this->db->join('emp_line_num as line', 'line.id = com.emp_line_id', 'left');
        $this->db->join('emp_designation as deg', 'deg.id = com.emp_desi_id', 'left');
        $r = $this->db->where('com.emp_id', $id)->get()->row();

        header('Content-Type: application/x-json; charset=utf-8');
        echo json_encode($r);
         return;
    }


}

