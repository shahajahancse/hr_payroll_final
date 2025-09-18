<?php
class Setting_con extends CI_Controller {

	function __construct(){
		parent::__construct();

		/* Standard Libraries */
		$this->data['user_data'] = $this->session->userdata('data');
		// $this->load->library('Grocery_crud');
		$this->load->model('Acl_model');
		$this->load->model('Common_model');

        if ($this->session->userdata('logged_in') == false) {
            redirect("authentication");
        }
        // /*if (!check_acl_list($this->data['user_data']->id, 17)) {
        //     echo "<SCRIPT LANGUAGE=\"JavaScript\">alert('Sorry! Acess Deny');</SCRIPT>";
        //     redirect("payroll_con");
        //     exit;
        // }*/

	}

	function crud(){
		if ($this->session->userdata('logged_in') == false) {
            redirect("authentication");
        }
		$this->db->order_by('id', 'desc');
		$this->data['data'] = $this->db->get('member_acl_list')->result();
        $this->data['username'] = $this->data['user_data']->id_number;
        $this->data['title'] = 'User Mode';
        $this->data['subview'] = 'settings/acl_access';
        $this->load->view('layout/template', $this->data);
	}

	function activity_log(){

		$this->db->select('active_log.*, members.id_number');
		$this->db->join('members', 'members.id = active_log.member_id', 'left');
		$this->db->where('members.unit_name', $_SESSION['data']->unit_name);
		$this->db->order_by('id', 'desc');
		$this->data['data'] = $this->db->get('active_log')->result();
        $this->data['username'] = $this->data['user_data']->id_number;
        $this->data['title'] = 'Activity Log';
        $this->data['subview'] = 'settings/activity_log';
        $this->load->view('layout/template', $this->data);
		
	}

	function acl_access_add(){
		if ($this->db->insert('member_acl_list', array('acl_name' => $this->input->post('acl_name'), 'type' => $this->input->post('type')))) {
			$this->session->set_flashdata('success', 'ACL Added Successfully');
		}else{
			$this->session->set_flashdata('failuer', 'ACL Added Failed');
		}
		redirect('setting_con/crud');
	}

	function acl_access_edit($id){

		if ($this->session->userdata('logged_in') == false) {
            redirect("authentication");
        }

		if (!empty($_POST['acl_name'])) {
			$data =	array(
				'acl_name' => $_POST['acl_name'],
				'type' 	   => $_POST['type']
			);
			$this->db->where('id', $id);
			$this->db->update('member_acl_list', $data);
			$this->session->set_flashdata('success', 'ACL Updated Successfully');
			redirect('setting_con/crud');
		}
		$this->db->select('pr_units.*');
        $this->data['units'] = $this->db->get('pr_units')->result_array();

		$this->data['row']      = $this->db->where('id', $id)->get('member_acl_list')->row();
        $this->data['username'] = $this->data['user_data']->id_number;
        $this->data['title']    = 'Access List Edit';
        $this->data['subview']  = 'settings/acl_access_edit';
        $this->load->view('layout/template', $this->data);
	}

	function acl_access_delete($id){
		if ($this->db->delete('member_acl_list', array('id' => $id))) {
			$this->session->set_flashdata('success', 'ACL Deleted Successfully');
		}else{
			$this->session->set_flashdata('failuer', 'ACL Deleted Failed');
		}
		redirect('setting_con/crud');
	}

	public function left_menu_acl()
    {
        if ($this->session->userdata('logged_in') == false) {
            redirect("authentication");
        }
		$id = $this->data['username'] = $this->data['user_data']->id;
		$this->db->order_by('id', 'desc');
		$this->db->where_in('type', [1,2,5]);
		$this->data['access_list'] = $this->db->get('member_acl_list')->result();

		$this->db->where('username_id', $id);
		$level_list = $this->db->get('member_acl_level')->result();
		$level_array = [];
		foreach ($level_list as $key => $value) {
			$level_array[] = $value->acl_id;
		}
		$this->data['level_array'] = $level_array;
		$this->data['user_id'] = $id;

		$this->data['users'] = $this->get_member();
		// dd($this->data['users']);
        $this->data['title'] = 'User Access HRM';
        $this->data['username'] = $this->data['user_data']->id_number;
		$this->data['subview'] = 'settings/left_menu_acl';
        $this->load->view('layout/template', $this->data);
    }

	public function user_acl_hrm()
    {
        if ($this->session->userdata('logged_in') == false) {
            redirect("authentication");
        }

		$this->data['users'] = $this->get_member();
        $this->data['title'] = 'User Access HRM';
        $this->data['username'] = $this->data['user_data']->id_number;
		$this->data['subview'] = 'settings/user_acl_hrm';
        $this->load->view('layout/template', $this->data);
    }
	public function hide_designation_employee()
    {
        if ($this->session->userdata('logged_in') == false) {
            redirect("authentication");
        }
        $this->data['employees'] = array();
        $this->db->select('pr_units.*');
        $this->data['dept'] = $this->db->get('pr_units')->result_array();
        if (!empty($this->data['user_data']->unit_name) && $this->data['user_data']->unit_name != 'All') {
            $this->data['employees'] = $this->get_emp_by_unit($this->data['user_data']->unit_name)->result();
        }

        $this->db->select('emp_depertment.*, pr_units.unit_name');
        $this->db->from('emp_depertment');
        $this->db->join('pr_units', 'pr_units.unit_id = emp_depertment.unit_id', 'left');
        if (!empty($this->data['user_data']->unit_name) && $this->data['user_data']->unit_name != 'All') {
            $this->db->where('emp_depertment.unit_id', $this->data['user_data']->unit_name);
        }
        $this->data['departments'] = $this->db->get()->result();



		$this->data['users'] = $this->get_member();
        $this->data['title'] = 'Hide Designation Employee';
        $this->data['username'] = $this->data['user_data']->id_number;
		$this->data['subview'] = 'settings/hide_designation_employee';
        $this->load->view('layout/template', $this->data);
    }
	public function get_emp_by_unit($unit) {
        $this->db->select('
                    pr_emp_com_info.id,
                    pr_emp_com_info.emp_id,
                    pr_emp_com_info.unit_id,
                    pr_emp_per_info.name_en,
                    pr_emp_per_info.name_bn,
                ');
        $this->db->from('pr_emp_com_info');
        $this->db->join('pr_units', 'pr_units.unit_id = pr_emp_com_info.unit_id', 'left');
        $this->db->join('pr_emp_per_info', 'pr_emp_per_info.emp_id = pr_emp_com_info.emp_id', 'left');
        $this->db->where('pr_units.unit_id', $unit);
        $this->db->where('pr_emp_com_info.emp_cat_id', 1);
        return $this->db->get();
    }
	public function hide_designation($id, $value){
		$this->db->where('id', $id);
		if($this->db->update('emp_designation', array('hide_status' => $value))){
			echo 'success';
		}else{
			echo 'failed';
		}
	}

	public function user_acl_pr()
    {
        if ($this->session->userdata('logged_in') == false) {
            redirect("authentication");
        }

		$this->data['users'] = $this->get_member();
		// dd($this->data['users']);
        $this->data['title'] = 'User Access HRM';
        $this->data['username'] = $this->data['user_data']->id_number;
		$this->data['subview'] = 'settings/user_acl_pr';
        $this->load->view('layout/template', $this->data);
    }

    function get_member()
    {
    	$this->db->select('members.id, members.id_number, pr_units.unit_name');
    	$this->db->join('pr_units', 'members.unit_name = pr_units.unit_id', 'left');
    	// $this->db->where('members.unit_name !=', '0');
    	$this->db->order_by('members.id', 'desc');
		return $this->db->get('members')->result();
    }

	public function checkbox_get_user_acl_hrm(){
		$id = $this->input->post('id');
		$type = $this->input->post('type');

		$this->db->order_by('id', 'desc');
		if ($type == 1) {
			$this->db->where_in('type', [1,2,5]);
		} else {
			$this->db->where('type', $type);
		}
		$this->data['access_list'] = $this->db->get('member_acl_list')->result();

		$this->db->where('username_id', $id);
		$level_list = $this->db->get('member_acl_level')->result();
		$level_array = [];
		foreach ($level_list as $key => $value) {
			$level_array[] = $value->acl_id;
		}
		$this->data['level_array'] = $level_array;
		$this->data['user_id'] = $id;
		echo $this->load->view('settings/chackbox_user_acl_hrm', $this->data, true);
	}

	public function check_level(){
		$id = $this->input->post('id');
		$user_id = $this->input->post('user_id');
		$this->db->where('username_id', $user_id);
		$this->db->where('acl_id', $id);
		$check = $this->db->get('member_acl_level')->num_rows();
		if ($check > 0) {
			$this->db->delete('member_acl_level', array('username_id' => $user_id, 'acl_id' => $id));
		}else{
			$this->db->insert('member_acl_level', array('username_id' => $user_id, 'acl_id' => $id));
		}
	}

	public function report_setting(){
		if ($this->session->userdata('logged_in') == false) {
            redirect("authentication");
        }
		$this->db->select('pr_units.*');
        $this->data['units'] = $this->db->get('pr_units')->result_array();

		$this->db->select('rs.*, ,ss.sh_type, pr_units.unit_name');
		$this->db->join('pr_emp_shift_schedule ss', 'ss.id = rs.schedule_id', 'left');
		$this->db->join('pr_units', 'rs.unit_id = pr_units.unit_id', 'left');
		$this->db->where('pr_units.unit_id', $_SESSION['data']->unit_name);
		$this->db->order_by('id', 'desc');
		$this->data['data'] = $this->db->get('pr_report_setting rs')->result_array();
		
        $this->data['username'] = $this->data['user_data']->id_number;
        $this->data['title'] = 'Report setting';
        $this->data['subview'] = 'settings/report_setting';
        $this->load->view('layout/template', $this->data);
	}

	public function report_setting_save($id){
		$unit_id = $this->input->post('unit_id');
		$schedule_id = $this->input->post('schedule_id');
		$first_date = date('Y-m-d', strtotime($this->input->post('first_date')));
		$second_date = date('Y-m-d', strtotime($this->input->post('second_date')));
		$max_ot = $this->input->post('max_ot');
		$type = $this->input->post('type');
		$active_status = $this->input->post('active_status');

		$data = array(
			'unit_id' => $unit_id,
			'schedule_id' => $schedule_id,
			'first_date' => $first_date,
			'second_date' => $second_date,
			'max_ot' => $max_ot,
			'type' => $type,  // 1=9pm job card, 2=12pm job card, 3=without fri/holiday ot
			'status' => $active_status,
			'created_by' =>  $this->data['user_data']->id,
		);

		if ($id == 0) {
			$this->db->insert('pr_report_setting', $data);
		}else{
			$this->db->where('id', $id);
			$this->db->update('pr_report_setting', $data);
		}
		
		$schedule = $this->db->where('id', $schedule_id)->get('pr_emp_shift_schedule')->row();
		$results = $this->db->distinct()->select('log.emp_id, com.com_ot_entitle')
			->from('pr_emp_com_info AS com')->join('pr_emp_shift_log AS log', 'com.emp_id = log.emp_id', 'left')
			->where("log.shift_log_date BETWEEN '{$first_date}' AND '{$second_date}'", null, false)
			// ->where('log.emp_id', 5006248) // comment on for all employee
			// ->where('log.shift_log_date', '2025-08-04')
			->where('log.present_status', 'P')->where('log.schedule_id', $schedule_id)->get()->result();
		// dd($results);

		foreach ($results as $key => $value) {
			$emp_id = $value->emp_id;
			$com_ot_entitle = $value->com_ot_entitle;
			// $logs = $this->db->where('shift_log_date', '2025-08-04')
			$logs = $this->db->where("shift_log_date BETWEEN '{$first_date}' AND '{$second_date}'", null, false)
			->where('emp_id', $emp_id)->where('present_status', 'P')->get('pr_emp_shift_log')->result();
			foreach ($logs as $key => $log) {
				$log_id = $log->id;
				$out_time = $log->out_time;
				if ($type == 1 && $active_status == 1) {
					if ($log->ot_eot_4pm <= $max_ot) {
						$up_data = array(
							'false_4_out' => $this->get_time_format_buyer($out_time),
							'false_ot_4' => $com_ot_entitle == 0 ? $log->ot_eot_4pm : 0,
							'false_4_st' => 1
						);
					} else {
						$up_data = array(
							'false_4_out' => $this->get_schedule_out_time($schedule, $max_ot, $out_time),
							'false_ot_4' => $com_ot_entitle == 0 ? $max_ot : 0,
							'false_4_st' => 1
						);
					}
				} else if ($type == 2 && $active_status == 1) {
					if ($log->ot_eot_12am <= $max_ot) {
						$up_data = array(
							'false_12_out' => $this->get_time_format_buyer($out_time),
							'false_ot_12' => $com_ot_entitle == 0 ? $log->ot_eot_12am : 0,
							'false_12_st' => 1
						);
					} else {
						$up_data = array(
							'false_12_out' => $this->get_schedule_out_time($schedule, $max_ot, $out_time),
							'false_ot_12' => $com_ot_entitle == 0 ? $max_ot : 0,
							'false_12_st' => 1
						);
					}
				} else if ($type == 3 && $active_status == 1) {
					if ($log->com_eot <= $max_ot) {
						$up_data = array(
							'false_wof_out' => $this->get_time_format_buyer($out_time),
							'with_out_friday_ot' => $com_ot_entitle == 0 ? $log->com_eot : 0,
							'false_wof_st' => 1
						);
					} else {
						$up_data = array(
							'false_wof_out' => $this->get_schedule_out_time($schedule, $max_ot, $out_time),
							'with_out_friday_ot' => $com_ot_entitle == 0 ? $max_ot : 0,
							'false_wof_st' => 1
						);
					}
				} else if ($type == 1 && $active_status == 2) {
					$up_data = array(
						'false_4_out' => null,
						'false_ot_4' => 0,
						'false_4_st' => 0
					);
				} else if ($type == 2 && $active_status == 2) {
					$up_data = array(
						'false_12_out' => null,
						'false_ot_12' => 0,
						'false_12_st' => 0
					);
				} else {
					$up_data = array(
						'false_wof_out' => null,
						'with_out_friday_ot' => 0,
						'false_wof_st' => 0
					);
				} 
				$this->db->where('id', $log_id);
				$this->db->update('pr_emp_shift_log', $up_data);
			}
		}

		echo 'true';
	}

	function get_time_format_buyer($out_time){
		$real_hour_min_sec  = $this->get_hour_min_sec($out_time);
		$real_minute  		= $real_hour_min_sec['minute'];
		if (49 < $real_minute) {
			$time = strtotime($out_time);
			return date("H:i:s ", strtotime('+11 minutes', $time));
		} else {
			return $this->get_buyer_in_time($out_time);
		}
	}

	function get_buyer_in_time($out_time){
		$real_hour_min_sec = $this->get_hour_min_sec($out_time);
		$exact_hour   		= $real_hour_min_sec['hour'];
		$real_minute  		= $real_hour_min_sec['minute'];
		$real_second 		= $real_hour_min_sec['second'];

		$min_1st_digit = substr($real_minute,0,1);
		$min_2nd_digit = substr($real_minute,1,1);

		$buyer_minute = $min_1st_digit + $min_2nd_digit;
		return $time_format = date("H:i:s ", mktime($exact_hour, $buyer_minute, $real_second, 0, 0, 0));
	}	

	function get_schedule_out_time($schedule, $hour, $out_time) {
    	$th_out_time = date('H:i:s', strtotime($schedule->two_hour_ot_out_time) + (int)$hour * 60 * 60);
		
		$exact_hour_min_sec = $this->get_hour_min_sec($th_out_time);
		$exact_hour   		= $exact_hour_min_sec['hour'];
		
		$hour_min_sec 		= $this->get_hour_min_sec($out_time);
		$real_minute  		= $hour_min_sec['minute'];
		$real_second 		= $hour_min_sec['second'];

		$min_1st_digit = substr($real_minute,0,1);
		$min_2nd_digit = substr($real_minute,1,1);
		$buyer_minute = $min_1st_digit + $min_2nd_digit;

		$time_format = date("H:i:s ", mktime($exact_hour, $buyer_minute, $real_second, 0, 0, 0));
		return $time_format;
	}
	function get_hour_min_sec($time){
		$data = array();
		$data['hour']   = substr($time,0,2);
		$data['minute'] = substr($time,3,2);
		$data['second'] = substr($time,6,2);
		return $data;
	}

	public function get_schedule(){
		$id = $this->input->post('id');
		$this->db->where('unit_id', $id);
		$data = $this->db->get('pr_emp_shift_schedule')->result();
		echo json_encode($data);
	}

	public function get_report_setting(){
		$id = $this->input->post('id');
		$this->db->select('rs.*, ,ss.sh_type');
		$this->db->join('pr_emp_shift_schedule ss', 'ss.id = rs.schedule_id', 'left');
		$this->db->where('rs.id', $id);
		$data=$this->db->get('pr_report_setting rs')->row();
		$data->date=date('Y-m-d',strtotime($data->date));

		echo json_encode($data);
	}

	public function delete_report_setting(){
		$id = $this->input->post('id');
		$data = $this->db->where('id', $id)->get('pr_report_setting')->row();
		$type = $data->type;
		$schedule_id = $data->schedule_id;
		$first_date = $data->first_date;
		$second_date = $data->second_date;

		$schedule = $this->db->where('id', $schedule_id)->get('pr_emp_shift_schedule')->row();
		$results = $this->db->distinct()->select('emp_id')
			->from('pr_emp_shift_log')
			->where("shift_log_date BETWEEN '{$first_date}' AND '{$second_date}'", null, false)
			->where('emp_id', 5006248) // comment on for all employee
			// ->where('shift_log_date', '2025-08-04')
			->where('present_status', 'P')->where('schedule_id', $schedule_id)->get()->result();
		// dd($results);

		foreach ($results as $key => $value) {
			$emp_id = $value->emp_id;
			// $logs = $this->db->where('shift_log_date', '2025-08-04')
			$logs = $this->db->where("shift_log_date BETWEEN '{$first_date}' AND '{$second_date}'", null, false)
			->where('emp_id', $emp_id)->where('present_status', 'P')->get('pr_emp_shift_log')->result();
			foreach ($logs as $key => $log) {
				$log_id = $log->id;
				$out_time = $log->out_time;
				if ($type == 1) {
					$up_data = array(
						'false_4_out' => null,
						'false_ot_4' => 0,
						'false_4_st' => 0
					);
				} else if ($type == 2) {
					$up_data = array(
						'false_12_out' => null,
						'false_ot_12' => 0,
						'false_12_st' => 0
					);
				} else {
					$up_data = array(
						'false_wof_out' => null,
						'with_out_friday_ot' => 0,
						'false_wof_st' => 0
					);
				} 
				$this->db->where('id', $log_id);
				$this->db->update('pr_emp_shift_log', $up_data);
			}
		}
		$this->db->where('id', $id);
		$this->db->delete('pr_report_setting');
		echo 'true';
	}

	public function dasig_group($id = null, $unit_id = null)
    {
        if ($this->session->userdata('logged_in') == false) {
            redirect("authentication");
        }

        $this->data['units'] = $this->db->get('pr_units')->result();
		if (!empty($id) && !empty($unit_id)) {
			$dd = $this->get_manage_gd_id($id, $unit_id);
			$this->data['match']     = $dd['match'];
			$this->data['not_match'] = $dd['not_match'];
			$this->data['row'] = $this->db->where('id', $id)->get('emp_group_dasignation')->row();
			$this->data['results'] = $this->get_dasignations($unit_id);

			$this->data['title'] = 'Manage Dasignation';
			$this->data['subview'] = 'settings/manage_gd';
		} else if(!empty($id)) {
			$this->data['row'] = $this->db->where('id', $id)->get('emp_group_dasignation')->row();
	        $this->data['title'] = 'Edit Dasignation Group';
			$this->data['subview'] = 'settings/dasig_group_edit';
		} else {
			// dd($unit_id);
	        $this->db->select('g.*, u.unit_name')->from('emp_group_dasignation as g')->where('g.unit_id',$_SESSION['data']->unit_name)->order_by('u.unit_id', 'ASC');
	        $this->data['groups'] = $this->db->join('pr_units as u', 'g.unit_id = u.unit_id')->get()->result();

			$this->data['subview'] = 'settings/dasig_group';
	        $this->data['title'] = 'Dasignation Group';
		}

        $this->data['username'] = $this->data['user_data']->id_number;
        $this->load->view('layout/template', $this->data);
    }

	function dasig_group_add($id = null){
		$data = array(
			'name_en' 	  => $this->input->post('name_en'),
			'name_bn' 	  => $this->input->post('name_bn'),
			'unit_id' 	  => $this->input->post('unit_id'),
			'status'  	  => $this->input->post('status'),
			'serial'  	  => $this->input->post('serial'),
			'updated_by'  => $this->data['user_data']->id,
		);

		if (!empty($id)) {
			$this->db->where('id', $id)->update('emp_group_dasignation',$data);
			$this->session->set_flashdata('success', 'Updated Successfully');
		} else if ($this->db->insert('emp_group_dasignation', $data)) {
			$this->session->set_flashdata('success', 'Added Successfully');
		}else{
			$this->session->set_flashdata('failuer', 'Added Failed');
		}
		redirect('setting_con/dasig_group');
	}

	function get_manage_gd_id($id, $unit_id){
		$this->db->select('id')->where('group_id', $id);
		$rows = $this->db->get('emp_designation')->result();
		$data1 = array();
		foreach ($rows as $key => $r) {
			$data1[$key] = $r->id;
		}

		$this->db->select('id')->where('unit_id', $unit_id);
		if (!empty($data1)) {
			$this->db->where_not_in('id', $data1);
		}
		$rows = $this->db->get('emp_designation')->result();
		$data2 = array();
		foreach ($rows as $key => $r) {
			$data2[$key] = $r->id;
		}
		$data = array(
			'match'     => $data1,
			'not_match' => $data2,
		);
		return $data;
	}

	function get_dasignations($unit_id){
		$this->db->select("dg.id, dg.desig_name, dg.unit_id, dg.group_id,  gd.name_en");
		$this->db->from("emp_designation as dg");
		$this->db->join("emp_group_dasignation gd", 'gd.id = dg.group_id', 'left');
		$this->db->where("dg.unit_id", $unit_id);
		$this->db->group_by("dg.id");
		return $this->db->get()->result();
	}

	public function check_level_dg(){
		$id 	 = $this->input->post('id');
		$gd_id   = $this->input->post('gd_id');
		$unit_id = $this->input->post('unit_id');
		$is_check = $this->input->post('is_check');
		if ($is_check == 1) {
			$d['group_id'] = $gd_id;
		} else {
			$d['group_id'] = 0;
		}
		$this->db->where('id', $id)->where('unit_id', $unit_id);
		$this->db->update('emp_designation', $d);
	}

	function acl($start=0){
		$this->data['username'] = $this->data['user_data']->id_number;
		$this->db->select('SQL_CALC_FOUND_ROWS members.*, pr_units.unit_name', false);
		$this->db->join('pr_units', 'pr_units.unit_id = members.unit_name', 'left');
		$this->db->where('members.unit_name',$_SESSION['data']->unit_name);
		$this->data['members'] = $this->db->get('members')->result_array();
		$this->data['subview'] = 'settings/acl';
        $this->load->view('layout/template', $this->data);
	}

	function member_add(){
		$this->data['username'] = $this->data['user_data']->id_number;

		$this->data['pr_units'] = $this->db->get('pr_units')->result();
		// $param['acls'] = $this->db->select('cl.*')->get('member_acl_list as cl')->result();

		$this->data['subview'] = 'settings/member_add';
        $this->load->view('layout/template', $this->data);
	}

	function member_insert(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('id_number', 'members Name', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');

		$data = array();
		$data['id_number'] = $this->input->post('id_number');
		$data['password'] = $this->input->post('password');
		$data['level'] = $this->input->post('level');
		$data['unit_name'] = $this->input->post('unit_name');
		$data['user_mode'] = $this->input->post('mode');
		$data['status'] = $this->input->post('status');
		$this->db->insert('members',$data);
		$this->session->set_flashdata('success','Record Insert successfully!');
		redirect(base_url('setting_con/acl'));
	}

	function member_edit($id){
        $this->db->where('members.id', $id);
		$this->data['row'] = $this->db->get('members')->row();

        $this->data['username'] = $this->data['user_data']->id_number;
		$this->data['pr_units'] = $this->db->get('pr_units')->result();

		$this->data['subview'] = 'settings/member_edit';
        $this->load->view('layout/template', $this->data);
		// $this->load->view('', $param);
	}

	function update_member($id=0){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('id_number', 'members Name', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');

		$data = array();
		$data['id_number'] = $this->input->post('id_number');
		$data['password'] = $this->input->post('password');
		$data['level'] = $this->input->post('level');
		$data['unit_name'] = $this->input->post('unit_name');
		$data['user_mode'] = $this->input->post('mode');
		$data['status'] = $this->input->post('status');
		$this->db->where('members.id',$id);
		$this->db->update('members',$data);

		$this->session->set_flashdata('success','Record Updated successfully!');
		redirect(base_url('setting_con/acl'));
	}

	function members_delete($id=0){
		$this->db->where('members.id',$id);
		$data=$this->db->delete('members');
		$this->session->set_flashdata('success','Record Deleted successfully!');
		redirect(base_url('setting_con/acl'));
	}


    //-------------------------------------------------------------------------------------------------------
    // CRUD for manage line wise designation of attendance summary report start
    //-------------------------------------------------------------------------------------------------------
	public function line_wise_atn_desig()
    {
        $this->db->select('per.*,info.*,pr_units.unit_name,n.line_name_en,emp_designation.desig_name, num.line_name_en snum');
        $this->db->from('pr_emp_com_info info');
        $this->db->join('pr_units', 'pr_units.unit_id = info.unit_id');
        $this->db->join('emp_line_num n', 'n.id = info.emp_line_id');
        $this->db->join('emp_line_num num', 'num.id = info.attn_sum_line_id');
        $this->db->join('emp_designation emp_designation', 'info.emp_desi_id = emp_designation.id');
        $this->db->join('pr_emp_per_info per', 'per.emp_id = info.emp_id', 'left');
        $this->db->where('info.attn_sum_line_id IS NOT NULL');
        $this->db->where('info.unit_id', $_SESSION['data']->unit_name);
        $this->data['pr_line'] = $this->db->get()->result_array();
		// dd($this->data['pr_line']);

        $this->data['title'] = 'Line Wise Designation List';
        $this->data['username'] = $this->data['user_data']->id_number;
        $this->data['subview'] = 'settings/line_wise_atn_desig';
        $this->load->view('layout/template', $this->data);
    }

	function line_wise_atn_add_form()
	{
        if ($this->session->userdata('logged_in') == false) {
            redirect("authentication");
        }
        $this->data['employees'] = array();
        $this->db->select('pr_units.*');
        $this->data['dept'] = $this->db->get('pr_units')->result_array();
        if (!empty($this->data['user_data']->unit_name)) {
	        $this->data['employees'] = $this->Common_model->get_emp_by_unit($this->data['user_data']->unit_name);
        }

        $this->data['username'] = $this->data['user_data']->id_number;
		$this->data['user_id'] = $this->data['user_data']->unit_name;
        $this->data['title'] = 'Line wise designation Add';
        $this->data['subview'] = 'settings/line_wise_atn_add_form';
        $this->load->view('layout/template', $this->data);
	}

	function line_add()
	{
		$line_id = $_POST['line_id'];
		$emp_id = $_POST['spl'];
		
		$this->db->where('emp_id', $emp_id);
		$this->db->update('pr_emp_com_info', array('attn_sum_line_id' => $line_id));
		echo '1';
	}

    function line_delete($id)
    {
        $this->db->where('emp_id', $id);
        $this->db->update('pr_emp_com_info', array('attn_sum_line_id' =>null));
        $this->session->set_flashdata('success', 'Record Deleted successfully!');
		redirect(base_url('setting_con/line_wise_atn_desig'));
    }
    //-------------------------------------------------------------------------------------------------------
    // CRUD for manage line wise designation of attendance summary report end
    //-------------------------------------------------------------------------------------------------------

}

