<?php

// defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'libraries/API_Controller.php';

class Admin extends API_Controller
{
    public function __construct()
    {
        header('Access-Control-Allow-Origin: *');
        // Allow methods: GET, POST, OPTIONS
        header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
        // Allow header Content-Type: application/json
        header("Access-Control-Allow-Headers: Content-Type");
        
        parent::__construct();
        $this->load->helper('api_helper');
        $this->load->model("Api_model");
        $this->load->library('upload');
    }

 
    public function test()
    {
        $authorization = $this->input->get_request_header('Authorization');
        $user_info = api_auth($authorization);
        if ($user_info['status'] == true) {
                // $offset = $this->input->post('offset');
                // $limit = $this->input->post('limit');
                // $status = $this->input->post('status');

                // $result = $this->Timesheet_model->get_leaves_with_info_with_pagi($offset, $limit, $status);
                $result = [
                    'name' => 'test',
                    'email' => 'test',
                    'phone' => 'test',
                ];
                if ($result) {
                    $this->api_return([
                        'status' => true,
                        'message' => 'successful',
                        'data' => $result,
                    ], 200);
                } else {
                    $this->api_return([
                        'status' => false,
                        'message' => 'Data not found',
                        'data' => [],
                    ], 200);
                }
        } else {
            $this->api_return([
                'status' => false,
                'message' => 'Unauthorized User',
                'data' => null,
            ], 401);
        }
    }
    public function dashboard()
    {
        $authorization = $this->input->get_request_header('Authorization');
        $user_info = api_auth($authorization);
        if ($user_info['status'] == true) {
            $unit=$this->input->post('unit');
            $department=$this->input->post('department');
            $section=$this->input->post('section');
            $line=$this->input->post('line');
            $date=$this->input->post('date');
            if (empty($date) || !$date) {
                $date = date('Y-m-d');
            }else{
                $date = date('Y-m-d', strtotime($date));
            }
                $result = $this->Api_model->get_dashboard($unit,$department,$section,$line,$date);
                if ($result) {
                    $this->api_return([
                        'status' => true,
                        'message' => 'Successful',
                        'data' => $result,
                    ], 200);
                } else {
                    $this->api_return([
                        'status' => false,
                        'message' => 'Data not found',
                        'data' => [],
                    ], 200);
                }
        } else {
            $this->api_return([
                'status' => false,
                'message' => 'Unauthorized User',
                'data' => null,
            ], 401);
        }
    }



    public function get_all_unit(){
        $authorization = $this->input->get_request_header('Authorization');
        $user_info = api_auth($authorization);
        if ($user_info['status'] == true) {
                //$unit_id = $this->input->post('unit_id');
                $result = $this->db->get('pr_units')->result();
                if ($result) {
                    $this->api_return([
                        'status' => true,
                        'message' => 'successful',
                        'data' => $result,
                    ], 200);
                } else {
                    $this->api_return([
                        'status' => false,
                        'message' => 'Data not found',
                        'data' => [],
                    ], 200);
                }
        } else {
            $this->api_return([
                'status' => false,
                'message' => 'Unauthorized User',
                'data' => null,
            ], 401);
        }
    }
    public function get_department_by_unit_id(){
        $authorization = $this->input->get_request_header('Authorization');
        $user_info = api_auth($authorization);
        if ($user_info['status'] == true) {
                $unit_id = $this->input->post('unit_id');
                $result = $this->Api_model->get_department($unit_id);
                if ($result) {
                    $this->api_return([
                        'status' => true,
                        'message' => 'successful',
                        'data' => $result,
                    ], 200);
                } else {
                    $this->api_return([
                        'status' => false,
                        'message' => 'Data not found',
                        'data' => [],
                    ], 200);
                }
        } else {
            $this->api_return([
                'status' => false,
                'message' => 'Unauthorized User',
                'data' => null,
            ], 401);
        }
    }
    public function get_section_by_unit_id_dept_id(){
        $authorization = $this->input->get_request_header('Authorization');
        $user_info = api_auth($authorization);
        if ($user_info['status'] == true) {
                $unit_id = $this->input->post('unit_id');
                $dept_id = $this->input->post('dept_id');
                $result = $this->Api_model->get_section($unit_id,$dept_id);
                if ($result) {
                    $this->api_return([
                        'status' => true,
                        'message' => 'successful',
                        'data' => $result,
                    ], 200);
                } else {
                    $this->api_return([
                        'status' => false,
                        'message' => 'Data not found',
                        'data' => [],
                    ], 200);
                }
        } else {
            $this->api_return([
                'status' => false,
                'message' => 'Unauthorized User',
                'data' => null,
            ], 401);
        }
    }
    public function get_line_by_unit_id_dept_id_section_id(){
        $authorization = $this->input->get_request_header('Authorization');
        $user_info = api_auth($authorization);
        if ($user_info['status'] == true) {
                $unit_id = $this->input->post('unit_id');
                $dept_id = $this->input->post('dept_id');
                $section_id = $this->input->post('sec_id');
                $result = $this->Api_model->get_line($unit_id,$dept_id,$section_id);
                if ($result) {
                    $this->api_return([
                        'status' => true,
                        'message' => 'successful',
                        'data' => $result,
                    ], 200);
                } else {
                    $this->api_return([
                        'status' => false,
                        'message' => 'Data not found',
                        'data' => [],
                    ], 200);
                }
        } else {
            $this->api_return([
                'status' => false,
                'message' => 'Unauthorized User',
                'data' => null,
            ], 401);
        }
    }
}