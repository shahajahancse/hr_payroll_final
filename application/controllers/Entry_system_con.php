<?php
class Entry_system_con extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Common_model');
        $this->load->model('Attn_process_model');
        $this->load->helper('url');

        if ($this->session->userdata('logged_in') == false) {
            redirect("authentication");
        }
        $this->data['user_data'] = $this->session->userdata('data');
        if (!check_acl_list($this->data['user_data']->id, 3)) {
            echo "<SCRIPT LANGUAGE=\"JavaScript\">alert('Sorry! Acess Deny');</SCRIPT>";
            redirect("payroll_con");
            exit;
        }
    }

    //-------------------------------------------------------------------------------------------------------
    // GRID Display for advance System
    //-------------------------------------------------------------------------------------------------------
    public function advance_loan()
    {
        if ($this->session->userdata('logged_in') == false) {
            redirect("authentication");
        }

        $this->db->select('loan.*, per.name_en, pr_units.unit_name');
        $this->db->from('pr_advance_loan loan');
        $this->db->join('pr_emp_per_info per', 'loan.emp_id = per.emp_id', 'left');
        $this->db->join('pr_units', 'loan.unit_id = pr_units.unit_id', 'left');
        $this->data['results'] = $this->db->get()->result();

        $this->data['title'] = 'Advance Loan';
        $this->data['username'] = $this->data['user_data']->id_number;
        $this->data['subview'] = 'entry_system/advance_loan';
        $this->load->view('layout/template', $this->data);

    }

    public function tax_list()
    {
        if ($this->session->userdata('logged_in') == false) {
            redirect("authentication");
        }

        $this->db->select('tax.*, per.name_en, pr_units.unit_name');
        $this->db->from('emp_tax_entry tax');
        $this->db->join('pr_emp_per_info per', 'tax.emp_id = per.emp_id', 'left');
        $this->db->join('pr_units', 'tax.unit_id = pr_units.unit_id', 'left');
        $this->data['results'] = $this->db->get()->result();

        $this->data['title'] = 'Advance Loan';
        $this->data['username'] = $this->data['user_data']->id_number;
        $this->data['subview'] = 'entry_system/tax_list';
        $this->load->view('layout/template', $this->data);

    }

    public function advance_loan_form()
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

        $this->data['title'] = 'Advance Loan Entry';
        $this->data['username'] = $this->data['user_data']->id_number;
        $this->data['subview'] = 'entry_system/advance_loan_form';
        $this->load->view('layout/template', $this->data);

    }

    // advance loan entry system
    function advance_loan_entry() {
        $unit_id       = $_POST['unit_id'];
        $emp_id        = $_POST['emp_id'];
        $loan_amount   = $_POST['loan_amount'];
        $pay_amount    = $_POST['pay_amount'];
        $loan_month    = date('Y-m-01', strtotime($_POST['loan_month']));
        $effect_month  = date('Y-m-01', strtotime($_POST['effect_month']));
        $status        = $_POST['status'];
        $emp_ids       = explode(',', $emp_id);

        $st = false;
        foreach ($emp_ids as $row) {
            $id         = $row;
            $data = array(
                'emp_id'        => $id,
                'loan_amount'   => $loan_amount,
                'pay_amount'    => $pay_amount,
                'loan_month'    => $loan_month,
                'effect_month'  => $effect_month,
                'unit_id'       => $unit_id,
                'created_by'    => $this->data['user_data']->id,
                'status'        => $status,
            );

            $r = $this->db->where('emp_id', $id)->where('loan_month', $loan_month)->where('status', 1)->get('pr_advance_loan')->row();
            if (!empty($r)) {
                $this->db->where('emp_id', $id)->where('loan_month', $loan_month)->where('status', 1);
                if ($this->db->update('pr_advance_loan', $data)) {
                    $st = true;
                }
            } else {
                if ($this->db->insert('pr_advance_loan', $data)) {
                    $st = true;
                }
            }
        }
        if ($st == true) {
            echo 'success';
        } else {
            echo 'error';
        }
    }

    // Tax entry system
    function tax_entry() {
        $unit_id     = $_POST['unit_id'];
        $amount      = $_POST['amount'];
        $effect_date = date('Y-m-01', strtotime($_POST['effect_date']));
        $status      = $_POST['status'];
        $emp_id      = $_POST['emp_id'];

        $data = array(
            'emp_id'       => $emp_id,
            'unit_id'      => $unit_id,
            'amount'       => $amount,
            'effect_date'  => $effect_date,
            'status'       => $status,
            'created_by'   => $this->data['user_data']->id,
        );

        $st = false;
        $r = $this->db->where('emp_id', $emp_id)->where('effect_date', $effect_date)->where('status', 1)->get('emp_tax_entry')->row();
        if (!empty($r)) {
            $this->db->where('emp_id', $emp_id)->where('effect_date', $effect_date)->where('status', 1);
            if ($this->db->update('emp_tax_entry', $data)) {
                $st = true;
            }
        } else {
            if ($this->db->insert('emp_tax_entry', $data)) {
                $st = true;
            }
        }

        if ($st == true) {
            echo 'success';
        } else {
            echo 'error';
        }
    }
    //-------------------------------------------------------------------------------------------------------
    // GRID Display for Entry System
    //-------------------------------------------------------------------------------------------------------
    public function grid_entry_system()
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

        $this->data['title'] = 'Entry System';
        $this->data['username'] = $this->data['user_data']->id_number;
        $this->data['subview'] = 'entry_system/grid_entry_system';
        $this->load->view('layout/template', $this->data);
    }
    public function present_entry()
    {
        $sql         = $_POST['emp_id'];
        $unit_id     = $_POST['unit_id'];
        $first_date  = date('Y-m-d', strtotime($_POST['first_date']));
        $second_date = date('Y-m-d', strtotime($_POST['second_date']));
        $time        = date('H:i:s', strtotime($_POST['time']));
        $emp_ids     = explode(',', $sql);
        $mm = array();
        $emp_data = $this->Attn_process_model->get_all_employee($emp_ids, 1);
        while ($first_date <= $second_date) {
            $data = array();
            foreach ($emp_data->result() as $rows) {
                $com_id         = $rows->id;
                $proxi_id       = $rows->proxi_id;
                $shift_id       = $rows->shift_id;
                $schedule_id    = $rows->schedule_id;

                $emp_shift = $this->Attn_process_model->emp_shift_check_process($com_id,$shift_id,$schedule_id,$first_date);
                $schedule  = $this->Attn_process_model->get_emp_schedule($emp_shift->schedule_id);
                $out_end   = $schedule[0]["out_end"];

                if (strtotime($time) <= strtotime($out_end)) {
                    $date = date('Y-m-d', strtotime($first_date . ' + 1 days'));
                } else {
                    $date = $first_date;
                }
                $data[] = array(
                    'date_time'       => $date ." ".$time,
                    'proxi_id'         => $proxi_id,
                    'device_id'         => 0,
                );
            }
            $mm = $this->insert_attn_process($data, $first_date, $unit_id, $emp_ids);
            $first_date = date('Y-m-d', strtotime('+1 days'. $first_date));
		}

        if (!empty($mm) && $mm['massage'] == 1) {
            echo 'success';
        } else {
            echo 'error';
        }
    }
    function insert_attn_process($data, $date, $unit_id, $emp_ids) {
        $this->load->model('Attn_process_model');
        $att_table = "att_". date("Y_m", strtotime($date));
        if (!$this->db->table_exists($att_table)){
            $this->db->query('CREATE TABLE IF NOT EXISTS `'.$att_table.'`(
                    `att_id` int(11) NOT NULL AUTO_INCREMENT,
                    `device_id` int(11) NOT NULL,
                    `proxi_id` varchar(30) NOT NULL,
                    `date_time` datetime NOT NULL,
                    PRIMARY KEY (`att_id`),
                    KEY `device_id` (`device_id`,`proxi_id`,`date_time`)) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;'
            );
        }
        $this->db->insert_batch($att_table, $data);
        if ($this->Attn_process_model->attn_process($date, $unit_id, $emp_ids, 1)) {
            return array('massage' => 1);
        } else {
            return array('massage' => 0);
        }
    }
    public function log_sheet()
    {
        if ($this->session->userdata('logged_in') == false) {
            redirect("authentication");
        }

        $sql         = $_POST['emp_id'];
        $unit_id     = $_POST['unit_id'];
        $first_date  = date('Y-m-d', strtotime($_POST['first_date']));
        $second_date = date('Y-m-d', strtotime($_POST['second_date']));
        $emp_id      = explode(',', $sql);

        $this->db->select('
                    pr_emp_com_info.id,
                    pr_emp_com_info.emp_id,
                    pr_emp_com_info.unit_id,
                    pr_emp_com_info.proxi_id,
                    pr_emp_com_info.emp_join_date,
                    pr_emp_per_info.name_en,
                    emp_depertment.dept_name,
                    emp_section.sec_name_en,
                    emp_line_num.line_name_en,
                    emp_designation.desig_name,
                ');
        $this->db->from('pr_emp_com_info');
        $this->db->from('pr_emp_per_info');
        $this->db->from('emp_depertment');
        $this->db->from('emp_section');
        $this->db->from('emp_line_num');
        $this->db->from('emp_designation');

        $this->db->where('pr_emp_com_info.emp_dept_id = emp_depertment.dept_id');
        $this->db->where('pr_emp_com_info.emp_sec_id = emp_section.id');
        $this->db->where('pr_emp_com_info.emp_line_id = emp_line_num.id');
        $this->db->where('pr_emp_com_info.emp_desi_id = emp_designation.id');
        $this->db->where('pr_emp_per_info.emp_id = pr_emp_com_info.emp_id');
        $this->db->where_in('pr_emp_com_info.emp_id', $emp_id);
        $row = $this->db->get()->row();
        $this->data['row'] = $row;

        $this->db->select('pr_units.*')->where('unit_id', $row->unit_id);
        $this->data['unit'] = $this->db->get('pr_units')->row();

        $this->data['results']     = $this->Common_model->get_shift_log($row, $emp_id, $first_date, $second_date);
        $this->data['first_date']  = date('d-m-Y', strtotime($first_date));
        $this->data['second_date'] = date('d-m-Y', strtotime($second_date));
        $this->data['unit_id']     = $unit_id;
        $this->data['username']    = $this->data['user_data']->id_number;
        $this->load->view('entry_system/log_sheet', $this->data);
    }
    public function log_update()
    {
        if ($this->session->userdata('logged_in') == false) {
            redirect("authentication");
        }
        $proxi       = $_POST['proxi'];
        $emp_id      = $_POST['emp_id'];
        $unit_id      = $_POST['unit_id'];
        $date        = $_POST['date'];
        $in_time     = $_POST['in_time'];
        $out_time    = $_POST['out_time'];

        $emp_data = $this->Attn_process_model->get_all_employee(array($emp_id), null)->row();

        $com_id			= $emp_data->id;
        $emp_id			= $emp_data->emp_id;
        $shift_id		= $emp_data->shift_id;
        $schedule_id	= $emp_data->schedule_id;;

        $data = array();
        $data1 = array();
        foreach ($date as $key => $d) {
            //GET CURRENT SHIFT INFORMATION
            $emp_shift = $this->Attn_process_model->emp_shift_check_process($com_id, $shift_id, $schedule_id, $d);
            $schedule  = $this->Attn_process_model->get_emp_schedule($emp_shift->schedule_id);
            $out_end 	= $schedule[0]["out_end"];

            $data = array(
                'date_time'  => $d ." ".$in_time[$key],
                'proxi_id'   => $proxi,
                'device_id'  => 0,
            );

            if (strtotime($out_time[$key]) <= strtotime($out_end) && strtotime($out_time[$key]) <= strtotime('12:00:00')) {
                $dd = date('Y-m-d', strtotime($d . ' + 1 days'));
            } else {
                $dd = $d;
            }
            $data1 = array(
                'date_time'  => $dd ." ". $out_time[$key],
                'proxi_id'   => $proxi,
                'device_id'  => 0,
            );
            $mm = $this->update_attn_log($data, $data1, $d, $proxi, $com_id, $unit_id);
        }

        if (!empty($mm) && $mm['massage'] == 1) {
            echo 'success';
        } else {
            echo 'error';
        }
    }

    function update_attn_log($data, $data1, $date, $proxi, $emp_id, $unit_id) {
        $this->load->model('Attn_process_model');
        $att_table = "att_". date("Y_m", strtotime($date));
        if (!$this->db->table_exists($att_table)){
            $this->db->query('CREATE TABLE IF NOT EXISTS `'.$att_table.'`(
                    `att_id` int(11) NOT NULL AUTO_INCREMENT,
                    `device_id` int(11) NOT NULL,
                    `proxi_id` varchar(30) NOT NULL,
                    `date_time` datetime NOT NULL,
                    PRIMARY KEY (`att_id`),
                    KEY `device_id` (`device_id`,`proxi_id`,`date_time`)) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;'
            );
        }
        $check = $this->db->where('proxi_id', $proxi)->where('date_time', $data['date_time'])->get($att_table)->row();
        if (empty($check)) {
            $this->db->insert($att_table, $data);
        }
        $check1 = $this->db->where('proxi_id', $proxi)->where('date_time', $data1['date_time'])->get($att_table)->row();
        if (empty($check1)) {
            $this->db->insert($att_table, $data1);
        }
        if ($this->Attn_process_model->attn_process($date, $unit_id, array($emp_id))) {
            return array('massage' => 1);
        } else {
            return array('massage' => 0);
        }
    }

    public function present_absent()
    {
        $sql         = $_POST['emp_id'];
        $unit_id     = $_POST['unit_id'];
        $first_date  = date('Y-m-d', strtotime($_POST['first_date']));
        $second_date = date('Y-m-d', strtotime($_POST['second_date']));
        $seconde_dat = date("Y-m-d", strtotime('+ 1 day', strtotime($second_date)));
        $emp_ids     = explode(',', $sql);
        $att_table   = "att_" . date("Y_m", strtotime($first_date));
        $com_ids     = $this->get_com_emp_id($emp_ids);

        $first  = $first_date .' '. '06:30:00';
        $second  = $seconde_dat .' '. '06:30:00';
        if (date('t', strtotime($second_date)) == date('d', strtotime($second_date))) {
            $new_table = "att_" . date("Y_m", strtotime($second_date));
            $this->db->where("date_time BETWEEN '$first' and '$second' ");
            $this->db->where_in('proxi_id', $emp_ids)->delete($new_table);
        } else if (date('m', strtotime($first_date)) != date('m', strtotime($second_date))) {
            $new_table = "att_" . date("Y_m", strtotime($second_date));
            $this->db->where("date_time BETWEEN '$first' and '$second' ");
            $this->db->where_in('proxi_id', $emp_ids)->delete($new_table);
        }

        $this->db->where("date_time BETWEEN '$first' and '$second' ");
        $this->db->where_in('proxi_id', $emp_ids)->delete($att_table);

        $this->db->where("shift_log_date BETWEEN '$first_date' and '$second_date' ")->where_in('emp_id', $com_ids);
        if ($this->db->where('unit_id', $unit_id)->delete('pr_emp_shift_log')) {
            echo 'success';
        } else {
            echo 'error';
        }
    }
    public function log_delete()
    {
        $sql         = $_POST['emp_id'];
        $unit_id     = $_POST['unit_id'];
        $first_date  = date('Y-m-d', strtotime($_POST['first_date']));
        $second_date = date('Y-m-d', strtotime($_POST['second_date']));
        $emp_ids     = explode(',', $sql);
        $com_ids    = $this->get_com_emp_id($emp_ids);
        $this->db->where("shift_log_date BETWEEN '$first_date' and '$second_date' ")->where_in('emp_id', $com_ids);
        if ($this->db->where('unit_id', $unit_id)->delete('pr_emp_shift_log')) {
            echo 'success';
        } else {
            echo 'error';
        }
    }

    public function eot_modify_entry()
    {
        $sql         = $_POST['emp_id'];
        $unit_id     = $_POST['unit_id'];
        $first_date  = date('Y-m-d', strtotime($_POST['first_date']));
        $second_date = date('Y-m-d', strtotime($_POST['second_date']));
        $eot         = $_POST['eot'];
        $emp_ids     = explode(',', $sql);

        $com_ids    = $this->get_com_emp_id($emp_ids);
        $this->db->where("shift_log_date BETWEEN '$first_date' and '$second_date' ")->where_in('emp_id', $com_ids);
        if ($this->db->where('unit_id', $unit_id)->update('pr_emp_shift_log', array('modify_eot' => $eot))) {
            echo 'success';
        } else {
            echo 'error';
        }
    }
    function get_com_emp_id($emp_ids) {
        $this->db->select('id')->where_in("emp_id", $emp_ids);
        $ids = $this->db->get("pr_emp_com_info")->result();
        $data = array();
        foreach ($ids as $key => $r) {
            $data[] = $r->id;
        }
        return $data;
    }

    //-------------------------------------------------------------------------------
    // Increment and Promotion entry to the Database
    //-------------------------------------------------------------------------------
    public function incre_prom_entry()
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

        $this->data['title'] = 'Increment / Promotion';
        $this->data['username'] = $this->data['user_data']->id_number;
        $this->data['subview'] = 'entry_system/incre_prom_entry';
        $this->load->view('layout/template', $this->data);
    }
    public function special_entry()
    {
        $emp_id         = $_POST['emp_id'];
        $unit_id        = $_POST['unit_id'];
        $incr_date      = date('Y-m-01', strtotime($_POST['special_date']));
        $new_salary     = $_POST['gross_sal'];
        $new_com_salary = $_POST['com_gross_sal'];
        $old_salary     = $_POST['salary'];
        $old_com_salary = $_POST['com_salary'];
        $r = $this->db->where('emp_id', $emp_id)->where('unit_id', $unit_id)->get('pr_emp_com_info')->row();
        $data = array(
            'prev_emp_id' => $emp_id,
            'prev_dept' => $r->emp_dept_id,
            'prev_section' => $r->emp_sec_id,
            'prev_line' => $r->emp_line_id,
            'prev_desig' => $r->emp_desi_id,
            'prev_grade' => $r->emp_sal_gra_id,
            'new_emp_id' => $r->emp_id,
            'new_dept' => $r->emp_dept_id,
            'new_section' => $r->emp_sec_id,
            'new_line' => $r->emp_line_id,
            'new_desig' => $r->emp_desi_id,
            'new_grade' => $r->emp_sal_gra_id,
            'new_salary' => $new_salary,
            'new_com_salary' => $new_com_salary,
            'effective_month' => $incr_date,
            'ref_id' => $emp_id,
            'status' => 4,
        );

        $dd = array(
            'gross_sal' => $new_salary,
            'com_gross_sal' => $new_com_salary,
        );

        $check = $this->db->where('ref_id', $emp_id)->where('effective_month', $incr_date)->get('pr_incre_prom_pun');
        if ($check->num_rows() > 0) {
            $data['prev_salary']      = $check->row()->prev_salary;
            $data['prev_com_salary']  = $check->row()->prev_com_salary;
            $this->db->where('ref_id', $emp_id)->where('effective_month', $incr_date);
            if ( $this->db->update('pr_incre_prom_pun', $data) ) {
                $this->db->where('emp_id', $emp_id)->update('pr_emp_com_info', $dd);
                echo 'success';
            }else{
                echo 'error';
            }
        } else {
            $data['prev_salary']      = $r->gross_sal;
            $data['prev_com_salary']  = $r->com_gross_sal;
            if ( $this->db->insert('pr_incre_prom_pun', $data) ) {
                $this->db->where('emp_id', $emp_id)->update('pr_emp_com_info', $dd);
                echo 'success';
            }else{
                echo 'error';
            }
        }
    }
    public function special_delete_ajax(){
        $emp_id         = $_POST['sql'];
        $unit_id        = $_POST['unit_id'];
        $incr_date      = date('Y-m-01', strtotime($_POST['date']));
        $this->db->where('ref_id', $emp_id)->where('effective_month', $incr_date);
        $r = $this->db->order_by('effective_month', 'DESC')->get('pr_incre_prom_pun')->row();
        if (!empty($r)) {
            $dd = array(
                'gross_sal' => $r->prev_salary,
                'com_gross_sal' => $r->prev_com_salary,
            );
            if ( $this->db->where('emp_id', $emp_id)->update('pr_emp_com_info', $dd) ) {
                $this->db->where('ref_id', $emp_id)->where('effective_month', $incr_date)->delete('pr_incre_prom_pun');
                echo 'success';
            }else{
                echo 'error';
            }
        } else {
            echo 'error';
        }
    }
    public function increment_entry()
    {
        $emp_id         = $_POST['emp_id'];
        $unit_id        = $_POST['unit_id'];
        $incr_date      = date('Y-m-01', strtotime($_POST['incr_date']));
        $new_salary     = $_POST['gross_sal'];
        $new_com_salary = $_POST['com_gross_sal'];
        $old_salary     = $_POST['salary'];
        $old_com_salary = $_POST['com_salary'];
        $r = $this->db->where('emp_id', $emp_id)->where('unit_id', $unit_id)->get('pr_emp_com_info')->row();
        $data = array(
            'prev_emp_id' => $emp_id,
            'prev_dept' => $r->emp_dept_id,
            'prev_section' => $r->emp_sec_id,
            'prev_line' => $r->emp_line_id,
            'prev_desig' => $r->emp_desi_id,
            'prev_grade' => $r->emp_sal_gra_id,
            'new_emp_id' => $r->emp_id,
            'new_dept' => $r->emp_dept_id,
            'new_section' => $r->emp_sec_id,
            'new_line' => $r->emp_line_id,
            'new_desig' => $r->emp_desi_id,
            'new_grade' => $r->emp_sal_gra_id,
            'new_salary' => $new_salary,
            'new_com_salary' => $new_com_salary,
            'effective_month' => $incr_date,
            'ref_id' => $emp_id,
            'status' => 1,
        );

        $dd = array(
            'gross_sal' => $new_salary,
            'com_gross_sal' => $new_com_salary,
        );

        $check = $this->db->where('ref_id', $emp_id)->where('effective_month', $incr_date)->get('pr_incre_prom_pun');
        if ($check->num_rows() > 0) {
            $data['prev_salary']      = $check->row()->prev_salary;
            $data['prev_com_salary']  = $check->row()->prev_com_salary;
            $this->db->where('ref_id', $emp_id)->where('effective_month', $incr_date);
            if ( $this->db->update('pr_incre_prom_pun', $data) ) {
                $this->db->where('emp_id', $emp_id)->update('pr_emp_com_info', $dd);
                echo 'success';
            }else{
                echo 'error';
            }
        } else {
            $data['prev_salary']      = $r->gross_sal;
            $data['prev_com_salary']  = $r->com_gross_sal;
            if ( $this->db->insert('pr_incre_prom_pun', $data) ) {
                $this->db->where('emp_id', $emp_id)->update('pr_emp_com_info', $dd);
                echo 'success';
            }else{
                echo 'error';
            }
        }
    }
    public function increment_delete_ajax(){
        $emp_id         = $_POST['sql'];
        $unit_id        = $_POST['unit_id'];
        $incr_date      = date('Y-m-01', strtotime($_POST['date']));
        $this->db->where('ref_id', $emp_id)->where('effective_month', $incr_date);
        $r = $this->db->order_by('effective_month', 'DESC')->get('pr_incre_prom_pun')->row();
        if (!empty($r)) {
            $dd = array(
                'gross_sal' => $r->prev_salary,
                'com_gross_sal' => $r->prev_com_salary,
            );
            if ( $this->db->where('emp_id', $emp_id)->update('pr_emp_com_info', $dd) ) {
                $this->db->where('ref_id', $emp_id)->where('effective_month', $incr_date)->delete('pr_incre_prom_pun');
                echo 'success';
            }else{
                echo 'error';
            }
        } else {
            echo 'error';
        }
    }

    public function promotion_entry()
    {
        $emp_id         = $_POST['emp_id'];
        $unit_id        = $_POST['unit_id'];
        $prom_date      = date('Y-m-01', strtotime($_POST['prom_date']));
        $new_salary     = $_POST['prom_gross_sal'];
        $new_com_salary = $_POST['prom_com_gross_sal'];
        $department     = $_POST['department'];
        $section        = $_POST['section'];
        $line           = $_POST['line'];
        $designation    = $_POST['designation'];
        $grade_id       = $_POST['grade_id'];
        $old_salary     = $_POST['salary'];
        $old_com_salary = $_POST['com_salary'];

        $r = $this->db->where('emp_id', $emp_id)->where('unit_id', $unit_id)->get('pr_emp_com_info')->row();
        $dd = array(
            'gross_sal'         => $new_salary,
            'com_gross_sal'     => $new_com_salary,
            'emp_dept_id'       => $department,
            'emp_sec_id'        => $section,
            'emp_line_id'       => $line,
            'emp_desi_id'       => $designation,
            'emp_sal_gra_id'    => (!empty($grade_id))? $grade_id : $r->emp_sal_gra_id,
        );

        $check = $this->db->where('ref_id', $emp_id)->where('effective_month', $prom_date)->get('pr_incre_prom_pun');
        if ($check->num_rows() > 0) {
            $rr = $check->row();
            $data = array(
                'prev_emp_id'       => $emp_id,
                'prev_dept'         => $rr->prev_dept,
                'prev_section'      => $rr->prev_section,
                'prev_line'         => $rr->prev_line,
                'prev_desig'        => $rr->prev_desig,
                'prev_grade'        => $rr->prev_grade,
                'prev_salary'       => $rr->prev_salary,
                'prev_com_salary'   => $rr->prev_com_salary,
                'new_emp_id'        =>  $emp_id,
                'new_dept'          => $department,
                'new_section'       => $section,
                'new_line'          => $line,
                'new_desig'         => $designation,
                'new_grade'         => (!empty($grade_id))? $grade_id : $r->emp_sal_gra_id,
                'new_salary'        => $new_salary,
                'new_com_salary'    => $new_com_salary,
                'effective_month'   => $prom_date,
                'ref_id'            => $emp_id,
                'status'            => 2,
            );
            $this->db->where('ref_id', $emp_id)->where('effective_month', $prom_date);
            if ( $this->db->update('pr_incre_prom_pun', $data) ) {
                $this->db->where('emp_id', $emp_id)->update('pr_emp_com_info', $dd);
                echo 'success';
            }else{
                echo 'error';
            }
        } else {
            $data = array(
                'prev_emp_id'       => $emp_id,
                'prev_dept'         => $r->emp_dept_id,
                'prev_section'      => $r->emp_sec_id,
                'prev_line'         => $r->emp_line_id,
                'prev_desig'        => $r->emp_desi_id,
                'prev_grade'        => $r->emp_sal_gra_id,
                'prev_salary'       => $r->gross_sal,
                'prev_com_salary'   => $r->com_gross_sal,
                'new_emp_id'        =>  $emp_id,
                'new_dept'          => $department,
                'new_section'       => $section,
                'new_line'          => $line,
                'new_desig'         => $designation,
                'new_grade'         => (!empty($grade_id))? $grade_id : $r->emp_sal_gra_id,
                'new_salary'        => $new_salary,
                'new_com_salary'    => $new_com_salary,
                'effective_month'   => $prom_date,
                'ref_id'            => $emp_id,
                'status'            => 2,
            );
            if ( $this->db->insert('pr_incre_prom_pun', $data) ) {
                $this->db->where('emp_id', $emp_id)->update('pr_emp_com_info', $dd);
                echo 'success';
            }else{
                echo 'error';
            }
        }
    }
    public function prom_delete_ajax(){
        $emp_id         = $_POST['sql'];
        $unit_id        = $_POST['unit_id'];
        $incr_date      = date('Y-m-01', strtotime($_POST['date']));
        $this->db->where('ref_id', $emp_id)->where('effective_month', $incr_date);
        $r = $this->db->order_by('effective_month', 'DESC')->get('pr_incre_prom_pun')->row();
        if (!empty($r)) {
            $dd = array(
                'gross_sal'         => $r->prev_salary,
                'com_gross_sal'     => $r->prev_com_salary,
                'emp_dept_id'       => $r->prev_dept,
                'emp_sec_id'        => $r->prev_section,
                'emp_line_id'       => $r->prev_line,
                'emp_desi_id'       => $r->prev_desig,
                'emp_sal_gra_id'    => $r->prev_grade,
            );
            if ( $this->db->where('emp_id', $emp_id)->update('pr_emp_com_info', $dd) ) {
                $this->db->where('ref_id', $emp_id)->where('effective_month', $incr_date)->delete('pr_incre_prom_pun');
                echo 'success';
            }else{
                echo 'error';
            }
        } else {
            echo 'error';
        }
    }

    public function line_entry()
    {
        $emp_id         = $_POST['emp_id'];
        $unit_id        = $_POST['unit_id'];
        $line_date      = date('Y-m-01', strtotime($_POST['line_date']));
        $department     = $_POST['department'];
        $section        = $_POST['section'];
        $line           = $_POST['line'];
        $designation    = $_POST['designation'];

        $r = $this->db->where('emp_id', $emp_id)->where('unit_id', $unit_id)->get('pr_emp_com_info')->row();
            $dd = array(
                'emp_dept_id'       => $department,
                'emp_sec_id'        => $section,
                'emp_line_id'       => $line,
                'emp_desi_id'       => $designation,
            );

        $check = $this->db->where('ref_id', $emp_id)->where('effective_month', $line_date)->get('pr_incre_prom_pun');
        if ($check->num_rows() > 0) {
            $rr = $check->row();
            $data = array(
                'prev_emp_id'       => $emp_id,
                'prev_dept'         => $rr->prev_dept,
                'prev_section'      => $rr->prev_section,
                'prev_line'         => $rr->prev_line,
                'prev_desig'        => $rr->prev_desig,
                'prev_grade'        => $rr->prev_grade,
                'prev_salary'       => $rr->prev_salary,
                'prev_com_salary'   => $rr->prev_com_salary,
                'new_emp_id'        => $emp_id,
                'new_dept'          => $department,
                'new_section'       => $section,
                'new_line'          => $line,
                'new_desig'         => $designation,
                'new_grade'         => $rr->new_grade,
                'new_salary'        => $rr->new_salary,
                'new_com_salary'    => $rr->new_com_salary,
                'effective_month'   => $line_date,
                'ref_id'            => $emp_id,
                'status'            => 3,
            );

            $this->db->where('ref_id', $emp_id)->where('effective_month', $incr_date);
            if ( $this->db->update('pr_incre_prom_pun', $data) ) {
                $this->db->where('emp_id', $emp_id)->update('pr_emp_com_info', $dd);
                echo 'success';
            }else{
                echo 'error';
            }
        } else {
            $data = array(
                'prev_emp_id'       => $emp_id,
                'prev_dept'         => $r->emp_dept_id,
                'prev_section'      => $r->emp_sec_id,
                'prev_line'         => $r->emp_line_id,
                'prev_desig'        => $r->emp_desi_id,
                'prev_grade'        => $r->emp_sal_gra_id,
                'prev_salary'       => $r->gross_sal,
                'prev_com_salary'   => $r->com_gross_sal,
                'new_emp_id'        => $emp_id,
                'new_dept'          => $department,
                'new_section'       => $section,
                'new_line'          => $line,
                'new_desig'         => $designation,
                'new_grade'         => $r->emp_sal_gra_id,
                'new_salary'        => $r->gross_sal,
                'new_com_salary'    => $r->com_gross_sal,
                'effective_month'   => $line_date,
                'ref_id'            => $emp_id,
                'status'            => 3,
            );
            if ( $this->db->insert('pr_incre_prom_pun', $data) ) {
                $this->db->where('emp_id', $emp_id)->update('pr_emp_com_info', $dd);
                echo 'success';
            }else{
                echo 'error';
            }
        }
    }
    public function line_delete_ajax(){
        $emp_id         = $_POST['sql'];
        $unit_id        = $_POST['unit_id'];
        $incr_date      = date('Y-m-01', strtotime($_POST['date']));
        $this->db->where('ref_id', $emp_id)->where('effective_month', $incr_date);
        $r = $this->db->order_by('effective_month', 'DESC')->get('pr_incre_prom_pun')->row();
        if (!empty($r)) {
            $dd = array(
                'emp_dept_id'       => $r->prev_dept,
                'emp_sec_id'        => $r->prev_section,
                'emp_line_id'       => $r->prev_line,
                'emp_desi_id'       => $r->prev_desig,
            );
            if ( $this->db->where('emp_id', $emp_id)->update('pr_emp_com_info', $dd) ) {
                $this->db->where('ref_id', $emp_id)->where('effective_month', $incr_date)->delete('pr_incre_prom_pun');
                echo 'success';
            }else{
                echo 'error';
            }
        } else {
            echo 'error';
        }
    }
    //---------------------------------------------------------------------------
    // Increment and Promotion end
    //---------------------------------------------------------------------------

    //---------------------------------------------------------------------------------------
    // CRUD for weekend
    //---------------------------------------------------------------------------------------
    public function weekend_list()
    {
        $this->db->select('attn_work_off.*, pr_units.unit_name, pr_emp_per_info.name_en as user_name');
        $this->db->from('attn_work_off');
        $this->db->join('pr_units', 'pr_units.unit_id = attn_work_off.unit_id', 'left');
        $this->db->join('pr_emp_per_info', 'pr_emp_per_info.emp_id = attn_work_off.emp_id', 'left');
        $this->db->where('pr_units.unit_id', $this->data['user_data']->unit_name);
        $this->data['results'] = $this->db->get()->result();

        $this->data['title'] = 'Weekend List';
        $this->data['username'] = $this->data['user_data']->id_number;
        // dd($this->data);
        $this->data['subview'] = 'entry_system/weekend_list';
        $this->load->view('layout/template', $this->data);
    }
    public function emp_weekend_add()
    {
        if ($this->session->userdata('logged_in') == false) {
            redirect("authentication");
        }
        // dd($this->data['user_data']->unit_name);
        $this->data['employees'] = array();
        $this->db->select('pr_units.*');
        $this->data['dept'] = $this->db->get('pr_units')->result_array();
        if (!empty($this->data['user_data']->unit_name) && $this->data['user_data']->unit_name != 'All') {
            $this->data['employees'] = $this->get_emp_by_unit($this->data['user_data']->unit_name)->result();
        }

        $this->data['title'] = 'Weekend Add';
        $this->data['username'] = $this->data['user_data']->id_number;
        $this->data['subview'] = 'entry_system/emp_weekend_add';
        $this->load->view('layout/template', $this->data);
    }
    public function weekend_add_ajax()
    {
        $date = $this->input->post('date');
        $sql = $this->input->post('sql');
        $unit_id = $this->input->post('unit_id');
        $emp_ids = explode(',', $sql);
        $data = [];

        $this->db->where('work_off_date <=', date("Y-m-d", strtotime('-25 month', strtotime($date))));
        $this->db->delete('attn_work_off');

        foreach ($emp_ids as $value) {
            $data[] = array('work_off_date' => $date, 'emp_id' => $value, 'unit_id' => $unit_id);
        }
        if ( $this->db->insert_batch('attn_work_off', $data)) {
            echo 'success';
        }else{
            echo 'error';
        }
    }
    public function emp_weekend_del($id){
        $this->db->where('id', $id);
        $this->db->delete('attn_work_off');
        $this->session->set_flashdata('success', 'Record Deleted successfully!');
        redirect(base_url() . 'entry_system_con/weekend_list');

    }

    public function weekend_delete_all(){
        $date = $this->input->post('date');
        $sql = $this->input->post('sql');
        $unit_id = $this->input->post('unit_id');
        $emp_ids = explode(',', $sql);

        $this->db->where('work_off_date ', date("Y-m-d", strtotime($date)))->where('unit_id ', $unit_id);
        if ( $this->db->where_in('emp_id', $emp_ids)->delete('attn_work_off') ) {
            echo 'success';
        }else{
            echo 'error';
        }
    }
    //-------------------------------------------------------------------------------------
    // CRUD for weekend
    //-------------------------------------------------------------------------------------

    //-------------------------------------------------------------------------------------
    // CRUD for holiday
    //-------------------------------------------------------------------------------------
    public function holiday_list(){
        $this->db->select('attn_holyday_off.*, pr_units.unit_name, pr_emp_per_info.name_en as user_name');
        $this->db->from('attn_holyday_off');
        $this->db->join('pr_units', 'pr_units.unit_id = attn_holyday_off.unit_id');
        $this->db->join('pr_emp_per_info', 'pr_emp_per_info.emp_id = attn_holyday_off.emp_id');
        $this->db->where('pr_units.unit_id', $this->data['user_data']->unit_name);
        $this->data['results'] = $this->db->get()->result();

        $this->data['title'] = 'Holiday List';
        $this->data['username'] = $this->data['user_data']->id_number;
        $this->data['subview'] = 'entry_system/holiday_list';
        $this->load->view('layout/template', $this->data);
    }
    public function emp_holiday_add()
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

        $this->data['title'] = 'Holiday Add';
        $this->data['username'] = $this->data['user_data']->id_number;
        $this->data['subview'] = 'entry_system/emp_holiday_add';
        $this->load->view('layout/template', $this->data);
    }
    public function holiday_add_ajax(){
        $date = $this->input->post('date');
        $sql = $this->input->post('sql');
        $unit_id = $this->input->post('unit_id');
        $emp_ids = explode(',', $sql);

        $this->db->where('work_off_date <=', date("Y-m-d", strtotime('-25 month', strtotime($date))));
        $this->db->delete('attn_holyday_off');

        $data = [];
        foreach ($emp_ids as $value) {
            $data[] = array('work_off_date' => $date, 'emp_id' => $value, 'unit_id' => $unit_id);
        }
        if ( $this->db->insert_batch('attn_holyday_off', $data)) {
            echo 'success';
        }else{
            echo 'error';
        }
    }
    public function emp_holiday_del($id){
        $this->db->where('id', $id);
        $this->db->delete('attn_holyday_off');
        $this->session->set_flashdata('success', 'Record Deleted successfully!');
        redirect(base_url('entry_system_con/holiday_list'));
    }

    public function holiday_delete_all(){
        $date = $this->input->post('date');
        $sql = $this->input->post('sql');
        $unit_id = $this->input->post('unit_id');
        $emp_ids = explode(',', $sql);

        $this->db->where('holiday_date ', date("Y-m-d", strtotime($date)))->where('unit_id ', $unit_id);
        if ( $this->db->where_in('emp_id', $emp_ids)->delete('attn_holyday_off') ) {
            echo 'success';
        }else{
            echo 'error';
        }
    }
    //------------------------------------------------------------------------------------------
    // GRID for holiday
    //------------------------------------------------------------------------------------------

    //------------------------------------------------------------------------------------------
    // Leave entry to the Database
    //------------------------------------------------------------------------------------------
    public function leave_transation()
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
        $this->data['title'] = 'Leave Transaction';
        $this->data['username'] = $this->data['user_data']->id_number;
        $this->data['subview'] = 'entry_system/leave_transation';
        $this->load->view('layout/template', $this->data);
    }

    public function leave_entry(){
        // dd($_POST);
        $emp_id = $_POST['emp_id'];
        $from_date = $_POST['from_date'];
        $to_date = $_POST['to_date'];
        $leave_type = $_POST['leave_type'];
        $reason = $_POST['reason'];
        $unit_id = $_POST['unit_id'];
        $leave_start = date("Y-m-d", strtotime($from_date));
        $leave_end = date("Y-m-d", strtotime($to_date));
        $total_leave = date_diff(date_create($leave_start), date_create($leave_end))->format('%a');
        $formArray = array(
            'emp_id' => $emp_id,
            'unit_id' => $unit_id,
            'start_date' => $leave_start,
            'leave_type' => $leave_type,
            'leave_start' => $leave_start,
            'leave_end' => $leave_end,
            'total_leave' => $total_leave+1,
            'leave_descrip' => $reason,
        );
        if ($this->db->insert('pr_leave_trans', $formArray)) {
            echo "success";
        }else{
            echo "error";
        };
    }

    public function leave_balance_ajax(){
        $this->db->select('pr_emp_per_info.name_en, pr_emp_per_info.img_source');
        $this->db->where('emp_id', $_POST['emp_id']);
        $data['epm_info']=$this->db->get('pr_emp_per_info')->row();

        $this->db->where('emp_id', $_POST['emp_id']);
        $unit_id=$this->db->get('pr_emp_com_info')->row()->unit_id;

        $this->db->where('unit_id', $unit_id);
        $leave_entitle=$this->db->get('pr_leave')->row();

        $data['leave_entitle_casual']= $leave_entitle->lv_cl;
        $data['leave_entitle_sick']= $leave_entitle->lv_sl;
        $data['leave_entitle_maternity']= $leave_entitle->lv_ml;
        $data['leave_entitle_paternity']= $leave_entitle->lv_pl;

        $year = date( $_POST['year']);
        $first_date = $year . "-01-01";
        $last_date = $year . "-12-31";
        $this->db->where('emp_id', $_POST['emp_id']);
        $this->db->where('leave_start >=', $first_date);
        $this->db->where('leave_end <=', $last_date);
        $leavei = $this->db->get('pr_leave_trans')->result();

        $leave_taken_casual =0;
        $leave_taken_sick =0;
        $leave_taken_maternity =0;
        $leave_taken_paternity =0;

        foreach ($leavei as $key => $value) {
            if($value->leave_type == 'cl'){
                $leave_taken_casual += $value->total_leave;
            }else if($value->leave_type == 'sl'){
                $leave_taken_sick += $value->total_leave;
            }else if($value->leave_type == 'ml'){
                $leave_taken_maternity += $value->total_leave;
            }else if($value->leave_type == 'pl'){
                $leave_taken_paternity += $value->total_leave;
            }
        }
        $data['leave_taken_casual'] = $leave_taken_casual;
        $data['leave_taken_sick'] = $leave_taken_sick;
        $data['leave_taken_maternity'] = $leave_taken_maternity;
        $data['leave_taken_paternity'] = $leave_taken_paternity;

        $data['leave_balance_casual'] = $data['leave_entitle_casual'] - $data['leave_taken_casual'];
        $data['leave_balance_sick'] = $data['leave_entitle_sick'] - $data['leave_taken_sick'];
        $data['leave_balance_maternity'] = $data['leave_entitle_maternity'] - $data['leave_taken_maternity'];
        $data['leave_balance_paternity'] = $data['leave_entitle_paternity'] - $data['leave_taken_paternity'];
        echo json_encode($data);
    }

    public function leave_list(){
        $this->db->select('pr_leave_trans.*, pr_units.unit_name, pr_emp_per_info.name_en as user_name');
        $this->db->from('pr_leave_trans');
        $this->db->join('pr_units', 'pr_units.unit_id = pr_leave_trans.unit_id', 'left');
        $this->db->join('pr_emp_per_info', 'pr_emp_per_info.emp_id = pr_leave_trans.emp_id', 'left');
        $this->db->where('pr_units.unit_id', $this->data['user_data']->unit_name);
        $this->db->order_by('pr_leave_trans.leave_start', 'DESC');
        $this->data['results'] = $this->db->get()->result();

        $this->data['title'] = 'Leave List';
        $this->data['username'] = $this->data['user_data']->id_number;
        // dd($this->data);
        $this->data['subview'] = 'entry_system/leave_list';
        $this->load->view('layout/template', $this->data);
    }

    public function emp_leave_del($id){
        $this->db->where('id', $id);
        $this->db->delete('pr_leave_trans');
        $this->session->set_flashdata('success', 'Record Deleted successfully!');
        redirect(base_url('entry_system_con/leave_list'));
    }
    //--------------------------------------------------------------------------------------
    // Leave end
    //--------------------------------------------------------------------------------------

    //-------------------------------------------------------------------------------------
    // CRUD for // Left/Resign
    //-------------------------------------------------------------------------------------
    public function left_resign_entry()
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

        $this->data['title'] = 'Left / Resign Entry';
        $this->data['username'] = $this->data['user_data']->id_number;
        $this->data['subview'] = 'entry_system/left_resign_entry';
        $this->load->view('layout/template', $this->data);
    }

    public function add_left_regign()
    {
        $sql = $_POST['sql'];
        $date = $_POST['date'];
        $type = $_POST['type'];
        $unit_id = $_POST['unit_id'];
        $emp_ids = explode(',', $sql);

        if ($type == 1) {
            $this->db->where('unit_id', $unit_id)->where_in('emp_id', $emp_ids)->delete('pr_emp_left_history');
            $this->db->where('unit_id', $unit_id)->where_in('emp_id', $emp_ids)->delete('pr_emp_resign_history');

            $this->db->where('unit_id', $unit_id)->where_in('emp_id', $emp_ids);
            if ($this->db->update('pr_emp_com_info', array('emp_cat_id' => 1))) {
                echo 'success';
            }else{
                echo 'error';
            }
        } else if ($type == 3 && !empty($date)) {
            $data = [];
            foreach ($emp_ids as $value) {
                $data[] = array('unit_id' => $unit_id, 'emp_id' => $value, 'left_date' => $date);
            }
            $this->db->insert_batch('pr_emp_left_history', $data);

            $this->db->where('unit_id', $unit_id)->where_in('emp_id', $emp_ids);
            if ($this->db->update('pr_emp_com_info', array('emp_cat_id' => 3))) {
                echo 'success';
            }else{
                echo 'error';
            }
        } else {
            $data = [];
            foreach ($emp_ids as $value) {
                $data[] = array('unit_id' => $unit_id, 'emp_id' => $value, 'resign_date' => $date);
            }
            $this->db->insert_batch('pr_emp_resign_history', $data);

            $this->db->where('unit_id', $unit_id)->where_in('emp_id', $emp_ids);
            if ($this->db->update('pr_emp_com_info', array('emp_cat_id' => 4))) {
                echo 'success';
            }else{
                echo 'error';
            }
        }
    }

    public function left_list()
    {
        $this->db->select('lf.*, pr_units.unit_name, per.name_en as user_name');
        $this->db->from('pr_emp_left_history as lf');
        $this->db->join('pr_units', 'pr_units.unit_id = lf.unit_id', 'left');
        $this->db->join('pr_emp_per_info as per', 'per.emp_id = lf.emp_id', 'left');
        if (!empty($this->data['user_data']->unit_name) && $this->data['user_data']->unit_name != 'All') {
            $this->db->where('pr_units.unit_id', $this->data['user_data']->unit_name);
        }
        $this->db->group_by('lf.emp_id');
        $this->data['results'] = $this->db->get()->result();

        $this->data['title'] = 'Left List';
        $this->data['username'] = $this->data['user_data']->id_number;
        $this->data['subview'] = 'entry_system/left_list';
        $this->load->view('layout/template', $this->data);
    }

    public function resign_list()
    {
        $this->db->select('rs.*, pr_units.unit_name, per.name_en as user_name');
        $this->db->from('pr_emp_resign_history as rs');
        $this->db->join('pr_units', 'pr_units.unit_id = rs.unit_id', 'left');
        $this->db->join('pr_emp_per_info as per', 'per.emp_id = rs.emp_id', 'left');
        if (!empty($this->data['user_data']->unit_name) && $this->data['user_data']->unit_name != 'All') {
            $this->db->where('pr_units.unit_id', $this->data['user_data']->unit_name);
        }
        $this->db->group_by('rs.emp_id');
        $this->data['results'] = $this->db->get()->result();

        $this->data['title'] = 'Left List';
        $this->data['username'] = $this->data['user_data']->id_number;
        $this->data['subview'] = 'entry_system/resign_list';
        $this->load->view('layout/template', $this->data);
    }

    public function left_delete($id){
        $this->db->where('emp_id', $id);
        if ($this->db->delete('pr_emp_left_history')) {
            $this->db->where('emp_id', $id)->update('pr_emp_com_info', array('emp_cat_id' => 1));
        }

        $this->session->set_flashdata('success', 'Record Deleted successfully!');
        redirect(base_url('entry_system_con/left_list'));
    }

    public function resign_delete($id){
        $this->db->where('emp_id', $id);
        if ($this->db->delete('pr_emp_resign_history')) {
            $this->db->where('emp_id', $id)->update('pr_emp_com_info', array('emp_cat_id' => 1));
        }

        $this->session->set_flashdata('success', 'Record Deleted successfully!');
        redirect(base_url('entry_system_con/resign_list'));
    }
    //---------------------------------------------------------------------------
    // Left/Resign end
    //----------------------------------------------------------------------------
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












    ///////////////////////////////////////////////////////////////////
    // old code

    //-------------------------------------------------------------------------------------------------------
    // Form Display for Advance Loan
    //-------------------------------------------------------------------------------------------------------

    // Form Display for Due Amt. Entry
    public function due_amt_entry()
    {
        if ($this->session->userdata('logged_in') == false) {
            $this->load->view('login_message');
        } else {
            $this->load->view('form/due_amt_entry_form');
        }

    }
    //-------------------------------------------------------------------------------------------------------

    // Advance Loan entry to the Database
    //-------------------------------------------------------------------------------------------------------
    public function advance_loan_insert(){
        // dd($_POST);
        if(isset($_POST['btn'])){
            $emp_id = $this->input->post('emp_id');
            $loan_amt = $this->input->post('loan_amt');
            $pay_amt = $this->input->post('pay_amt');
            $loan_date = $this->input->post('loan_date');
            $loan_date = date("Y-m-d", strtotime($loan_date));
            $data = $this->processdb->advance_loan_insert($emp_id, $loan_amt, $pay_amt, $loan_date);
            if ($data) {
                $message = 'Leave Added Successfully';
                redirect('entry_system_con/advance_loan?status=success&message=' . urlencode($message), 'refresh');
            } else {
                $message = 'Leave Not Added';
                redirect('entry_system_con/advance_loan?status=error&message=' . urlencode($message), 'refresh');
            }

            // return $data;
        }
        // dd($data);
    }

    //-------------------------------------------------------------------------------------------------------
    // Advance Loan entry to the Database
    //-------------------------------------------------------------------------------------------------------
    public function due_amt_insert()
    {
        $emp_id = $this->input->post('emp_id');
        $due_amt = $this->input->post('due_amt');
        $due_pay_amt = $this->input->post('due_pay_amt');
        $due_pay_date = $this->input->post('due_pay_date');

        $due_pay_date = date("Y-m-d", strtotime($due_pay_date));

        $data = $this->processdb->due_amt_insert($emp_id, $due_amt, $due_pay_amt, $due_pay_date);
        echo $data;
    }


    //-------------------------------------------------------------------------------------------------------
    // Manual Attendance Entry
    //-------------------------------------------------------------------------------------------------------
    public function manual_attendance_entry()
    {
        $grid_firstdate = $this->input->post('firstdate');
        $grid_seconddate = $this->input->post('seconddate');

        $m_s_time = $this->input->post('m_s_time');
        // $m_e_time = $this->input->post('m_e_time');

        $grid_data = $this->input->post('spl');
        $grid_emp_id = explode('xxx', trim($grid_data));

        $grid_firstdate = date("Y-m-d", strtotime($grid_firstdate));
        $grid_seconddate = date("Y-m-d", strtotime($grid_seconddate));

        $data = $this->grid_model->manual_attendance_entry($grid_firstdate, $grid_seconddate, $m_s_time, $grid_emp_id);
        echo $data;
    }
    //-------------------------------------------------------------------------------------------------------
    // Attendance Delete manually (Present to Absent)
    //-------------------------------------------------------------------------------------------------------
    public function manual_entry_Delete()
    {
        $grid_firstdate = $this->input->post('firstdate');
        $grid_seconddate = $this->input->post('seconddate');

        $grid_data = $this->input->post('spl');
        $grid_emp_id = explode('xxx', trim($grid_data));
        //print_r($grid_emp_id);
        $grid_firstdate = date("Y-m-d", strtotime($grid_firstdate));
        $grid_seconddate = date("Y-m-d", strtotime($grid_seconddate));

        $this->load->model('file_process_model');
        $data = $this->grid_model->manual_entry_Delete($grid_firstdate, $grid_seconddate, $grid_emp_id);

        echo $data;
    }

    public function manual_attendance_sheet()
    {
        $grid_firstdate = $this->uri->segment(3);
        $grid_seconddate = $this->uri->segment(4);
        $grid_emp_id = $this->uri->segment(5);
        $get_session_user_unit = $this->Common_model->get_session_unit_id_name();
        $unit_id = $this->db->where("emp_id", $grid_emp_id)->get('pr_emp_com_info')->row()->unit_id;

        if ($get_session_user_unit != $unit_id) {
            echo "You Are Not Allowed.";
        } else {
            $query['values'] = $this->grid_model->manual_attendance_sheet($grid_firstdate, $grid_seconddate, $grid_emp_id);
            $query['grid_firstdate'] = $grid_firstdate;
            $query['grid_seconddate'] = $grid_seconddate;
            $query['grid_emp_id'] = $grid_emp_id;
            $query['unit_id'] = $unit_id;
            $this->load->view('manual_attendance_sheet', $query);
        }
    }

    public function manual_attendance_sheet_entry()
    {
        $data["values"] = $this->grid_model->manual_attendance_sheet_entry_db();
        echo "Data Inserted Successfully!";
    }

    public function manual_eot_modification()
    {
        $grid_firstdate = $this->uri->segment(3);
        $grid_seconddate = $this->uri->segment(4);
        $grid_emp_id = $this->uri->segment(5);
        $get_session_user_unit = $this->Common_model->get_session_unit_id_name();
        $unit_id = $this->db->where("emp_id", $grid_emp_id)->get('pr_emp_com_info')->row()->unit_id;

        /*if($get_session_user_unit != $unit_id)
        {
        echo "You Are Not Allowed.";
        }
        else
        {*/
        $query['values'] = $this->grid_model->manual_eot_modification($grid_firstdate, $grid_seconddate, $grid_emp_id);
        $query['grid_firstdate'] = $grid_firstdate;
        $query['grid_seconddate'] = $grid_seconddate;
        $query['grid_emp_id'] = $grid_emp_id;
        $query['unit_id'] = $unit_id;
        $this->load->view('manual_eot_modification_sheet', $query);
        //}
    }

    public function manual_ot_eot_modification_for_multiple()
    {
        $grid_firstdate = $this->input->post('firstdate');
        $manual_eot_hour = $this->input->post('manual_eot_hour');
        $grid_data = $this->input->post('spl');
        $grid_emp_id = explode('xxx', trim($grid_data));

        $query['values'] = $this->grid_model->manual_ot_eot_modification_for_multiple($grid_firstdate, $manual_eot_hour, $grid_emp_id);

        echo "EOT Modification Successfully!";

    }

    public function manual_eot_modify_entry()
    {
        $data["values"] = $this->grid_model->manual_eot_modify_entry_db();
        echo "Data Inserted Successfully!";
    }

    public function check_out_time_value()
    {
        $emp_id = $_POST['emp_id'];
        $manual_date = $_POST['manual_date'];
        $in_time = $_POST['in_time'];
        $out_time = $_POST['out_time'];
        $ot_hour_id = $_POST['ot_hour_id'];
        $eot_hour_id = $_POST['eot_hour_id'];
        $present_status = $_POST['present_status'];

        $weekend = $this->Attn_process_model->check_weekend($emp_id, $manual_date);
        $holiday = $this->Attn_process_model->check_holiday($emp_id, $manual_date);

        if ($manual_date == $weekend || $manual_date == $holiday) {
            // echo "hi";
            if ($weekend == 1) {
                $status = "w";
            }
            if ($holiday == 1) {
                $status = "h";
            }

            //=======Extra OT Calculation==========
            $weekend_eot_calculation = $this->Attn_process_model->weekend_holday_eot_calculation_auto($emp_id, $manual_date, $in_time, $out_time, $status, $present_status);
            $this->Attn_process_model->deduction_hour_process($emp_id, $manual_date);
            // print_r($weekend_eot_calculation);

            $over_hour = $weekend_eot_calculation['ot_hour'];
            $eot_hour = $weekend_eot_calculation['extra_ot_hour'];

            $output = array('ot_hour' => $over_hour, 'eot_hour' => $eot_hour, 'ot_hour_id' => $ot_hour_id, 'eot_hour_id' => $eot_hour_id);
            echo json_encode($output);

        } else {
            // echo "nai";
            //=================OT CALCULATION============================
            $ot_hour_calcultation = $this->Attn_process_model->ot_hour_auto_calcultation($emp_id, $in_time, $out_time, $manual_date);

            if ($ot_hour_calcultation["ot_hour"] != '') {
                if ($ot_hour_calcultation["ot_hour"] > 2) {
                    $extra_ot_hour = $ot_hour_calcultation["ot_hour"] - 2;
                    $ot_hour = $ot_hour_calcultation["ot_hour"] = 2;
                } else {
                    // echo "here";
                    $extra_ot_hour = 0;
                    $ot_hour = $ot_hour_calcultation["ot_hour"];
                }
            } else {
                $ot_hour = $ot_hour_calcultation["ot_hour"] = 0;
                $extra_ot_hour = 0;
            }

            $this->Attn_process_model->modify_ot_eot_update($emp_id, $in_time, $out_time, $ot_hour, $extra_ot_hour, $manual_date);
            $this->Attn_process_model->deduction_hour_process($emp_id, $manual_date);

            /*if($extra_ot_hour >= 0){
            $insert_extra_ot_hour = $this->insert_extra_ot_hour($emp_id, $att_date, $extra_ot_hour);
            }*/
            $over_hour = $ot_hour;
            $eot_hour = $extra_ot_hour;

            $output = array('ot_hour' => $over_hour, 'eot_hour' => $eot_hour, 'ot_hour_id' => $ot_hour_id, 'eot_hour_id' => $eot_hour_id);
            echo json_encode($output);
        }

    }

    public function ot_abstract()
    {
        $grid_firstdate = $this->input->post('grid_firstdate');
        $grid_emp_id = $this->input->post('grid_emp_id');
        $in_time = $this->input->post('in_time');
        $out_time = $this->input->post('out_time');
        $ot_hour = $this->input->post('ot_hour');
        $eot_hour = $this->input->post('eot_hour');
        $orginal_in_time = $this->input->post('orginal_in_time');
        $orginal_out_time = $this->input->post('orginal_out_time');
        $orginal_ot = $this->input->post('orginal_ot');
        $orginal_eot = $this->input->post('orginal_eot');

        $data["values"] = $this->grid_model->ot_abstract_entry_db($grid_firstdate, $grid_emp_id, $in_time, $out_time, $ot_hour, $eot_hour, $orginal_in_time, $orginal_out_time, $orginal_ot, $orginal_eot);
        /*print_r($data);
        exit;*/
        echo "Data Inserted Successfully!";
    }


    //-------------------------------------------------------------------------------------------------------
    // CRUD output method
    //-------------------------------------------------------------------------------------------------------
    public function crud_output($output = null)
    {
        $this->load->view('output.php', $output);
    }

    public function earn_leave_entry()
    {
        $crud = new grocery_CRUD();

        $crud->set_table('pr_leave_earn');
        $crud->set_subject('Earn Leave');
        $crud->required_fields('old_earn_balance', 'current_earn_balance', 'last_update');
        //$crud->fields('emp_id','old_earn_balance','last_update');
        $crud->display_as('emp_id', 'Employee ID');

        $state = $this->grocery_crud->getState();
        if ($state == 'edit') {
            $crud->change_field_type('emp_id', 'readonly');
        }
        if ($state == 'insert_validation') {
            $crud->set_rules('emp_id', 'Employee ID', 'required|callback_emp_id_check');
            //$crud->set_rules('last_update','Last Update','required|callback_last_update_check');
        }
        $crud->unset_delete();
        //$crud->unset_edit();
        $output = $crud->render();
        $this->crud_output($output);
    }

    public function last_update_check($str)
    {
        $date = $this->input->post('last_update');
        $start_date = strtotime($date);
        $last_up = date("Y-m-d", $start_date);

        echo "<SCRIPT LANGUAGE=\"JavaScript\">alert($last_up);</SCRIPT>";
    }

    public function emp_id_check($str)
    {
        $id = $this->uri->segment(4);
        if (!empty($id) && is_numeric($id)) {
            $emp_id_old = $this->db->where("id", $id)->get('pr_leave_earn')->row()->emp_id;
            $this->db->where("emp_id !=", $emp_id_old);
        }
        $num_row = $this->db->where('emp_id', $str)->get('pr_leave_earn')->num_rows();
        if ($num_row >= 1) {
            $this->form_validation->set_message('emp_id_check', "Employee ID field '$str' already exists");
            return false;
        } else {

            $num_row1 = $this->db->where('emp_id', $str)->get('pr_emp_com_info')->num_rows();
            if ($num_row1 < 1) {
                $this->form_validation->set_message('emp_id_check', "Invalid Employee ID");
                return false;
            } else {
                return true;
            }
        }
    }




    //-------------------------------------------------------------------------------------------------------
    // New to regular :Tofayel
    //-------------------------------------------------------------------------------------------------------
    public function new_to_regular()
    {
        $this->load->view('form/new_to_rg');
    }
    public function new_to_regular_process()
    {
        $month = $this->input->post('report_month_sal');
        $year = $this->input->post('report_year_sal');
        $this->load->model('log_model');
        $result = $this->processdb->new_to_regular_process($year, $month);
        if ($result == "Successfully Converted") {
            echo "<SCRIPT LANGUAGE=\"JavaScript\">alert('Successfully Converted');</SCRIPT>";
            //echo "This ISBN already exist";
        } else if ($result == "no data found") {
            echo "<SCRIPT LANGUAGE=\"JavaScript\">alert('No data found');</SCRIPT>";
            //echo "This ISBN already exist";
        }

        $this->log_model->log_new_to_regular($year, $month);
        $this->new_to_regular();
    }

    public function pf_bank_interest()
    {
        $crud = new grocery_CRUD();

        $crud->set_table('pr_pf_bank_interests');
        $crud->set_subject('PF Bank Interest Rate');
        $crud->required_fields('month', 'bank_interest_rate');
        $output = $crud->render();
        $this->crud_output($output);
    }
    //-------------------------------------------------------------------------------------------------------
    // CRUD for Others Deduction and Tax
    //-------------------------------------------------------------------------------------------------------
    public function tax_others_deduction(){
        $this->load->model('crud_model');
        $pr_deduct = $this->crud_model->taxnother_infos();
        $this->data = array();
        $this->data['user_data'] = $this->session->userdata('data');
        $this->data['username'] = $this->data['user_data']->id_number;
        $this->data['pr_deduct'] = $pr_deduct;
        $this->data['subview'] = 'taxnother_list';
        $this->load->view('layout/template', $this->data);
    }

    public function deduct_month_check($str){
        $id = $this->uri->segment(4);
        $emp_id = $_POST['emp_id'];
        $year_month = date('Y-m', strtotime($str));
        if (!empty($id) && is_numeric($id)) {
            $ab_rule_name_old = $this->db->where("emp_id", $emp_id)->like("deduct_month", $year_month)->get('pr_deduct')->row()->deduct_month;
            $this->db->where("ab_rule_name !=", $ab_rule_name_old);
        }
        $num_row = $this->db->where("emp_id", $emp_id)->like('deduct_month', $year_month)->get('pr_deduct')->num_rows();
        if ($num_row >= 1) {
            $this->form_validation->set_message('deduct_month_check', 'Failed! This Entry already exists');
            return false;
        } else {
            return true;
        }
    }
    public function employee_id_check($str){
        $unit_id_select = $_POST['unit_id'];
        $emp_num_rows = $this->db->where("emp_id", $str)->get('pr_emp_com_info')->num_rows();
        if ($emp_num_rows > 0) {
            $unit_id = $this->db->where("emp_id", $str)->get('pr_emp_com_info')->row()->unit_id;
            if ($unit_id != $unit_id_select) {
                $this->form_validation->set_message('employee_id_check', 'Access Denied !');
                return false;
            }
            return true;
        } else {
            $this->form_validation->set_message('employee_id_check', 'Employee ID not exists !');
            return false;
        }
    }

    public function proximity_card_edit($start = 0)
    {

        $this->load->library('pagination');
        $param = array();
        // $start = ($this->uri->segment(2)) ? ($this->uri->segment(2)+1) : 0 ;
        // print_r($start);exit('ali');
        $limit = 25;
        $config['base_url'] = base_url() . "index.php/entry_system_con/proximity_card_edit/";
        $config['per_page'] = $limit;
        /*$config['num_links'] = 5;*/
        $config['total_rows'] = $this->db->get('pr_id_proxi')->num_rows();
        $config["uri_segment"] = 3;

        // Config setup

        // print_r($config);exit('ali');
        $this->pagination->initialize($config);
        $param['links'] = $this->pagination->create_links();
        $this->load->model('crud_model');
        $pr_id_proxi = $this->crud_model->proxi_infos($limit, $start);

        $param['pr_id_proxi'] = $pr_id_proxi;
        // print_r($param);exit('ali');
        $this->load->view('proxi_card_list', $param);
    }

    public function proxi_id_month_check($str)
    {
        $id = $this->uri->segment(4);
        $emp_id = $_POST['emp_id'];

        $get_session_user_unit = $this->Common_model->get_session_unit_id_name();
        $unit_id = $this->db->where("emp_id", $emp_id)->get('pr_emp_com_info')->row()->unit_id;

        if ($get_session_user_unit == 0) {
            return true;

        }
        if ($unit_id != $get_session_user_unit) {
            $this->form_validation->set_message('proxi_id_month_check', 'Failed! Access Deny!');
            return false;
        } else {
            return true;
        }
    }

    public function stop_salary_update($post_array, $primary_key)
    {
        $this->db->where('id', $primary_key);
        $user = $this->db->get('pr_emp_stop_salary')->row();

        $emp_id = $user->emp_id;
        $salary_month = $user->salary_month;
        $unit_id = $user->unit_id;
        $salary_month = date("Y-m", strtotime($salary_month));

        $data['stop_salary'] = 2;
        $this->db->where('emp_id', $emp_id);
        $this->db->like('salary_month', $salary_month);
        $this->db->update('pr_pay_scale_sheet', $data);

        $this->db->where('emp_id', $emp_id);
        $this->db->like('salary_month', $salary_month);
        $this->db->update('pr_pay_scale_sheet_com', $data);

        return true;
    }

    public function stop_salary_before_delete($primary_key)
    {
        $this->db->where('id', $primary_key);
        $user = $this->db->get('pr_emp_stop_salary')->row();

        $emp_id = $user->emp_id;
        $salary_month = $user->salary_month;
        $unit_id = $user->unit_id;
        $salary_month = date("Y-m", strtotime($salary_month));

        $num_row = $this->db->like('block_month', $salary_month)->where('unit_id', $unit_id)->get('pr_salary_block')->num_rows();

        if ($num_row > 0) {
            return false; //"FAILED - This Month Already Finally Processed.";
        }

        $data['stop_salary'] = 1;
        $this->db->where('emp_id', $emp_id);
        $this->db->like('salary_month', $salary_month);
        $this->db->update('pr_pay_scale_sheet', $data);

        $this->db->where('emp_id', $emp_id);
        $this->db->like('salary_month', $salary_month);
        $this->db->update('pr_pay_scale_sheet_com', $data);

        return true;
    }

    public function stop_salary_month_check($str)
    {
        $date = str_replace('/', '-', $str);
        $salary_month = date('Y-m-d', strtotime($date));

        $emp_id = $_POST['emp_id'];

        $get_session_user_unit = $this->Common_model->get_session_unit_id_name();
        $unit_id = $this->db->where("emp_id", $emp_id)->get('pr_emp_com_info')->row()->unit_id;

        if ($unit_id != $get_session_user_unit) {
            $this->form_validation->set_message('stop_salary_month_check', 'Failed! Access Deny!');
            return false;
        }
        $salary_month = date("Y-m", strtotime($salary_month));
        $num_rows = $this->db->where("emp_id", $emp_id)->like("salary_month", $salary_month)->get('pr_emp_stop_salary')->num_rows();
        if ($num_rows > 0) {
            $this->form_validation->set_message('stop_salary_month_check', 'Duplicate Entry Not Allow!');
            return false;
        }

        $unit_id = $_POST['unit_id'];
        $num_row_block_month = $this->db->like('block_month', $salary_month)->where('unit_id', $unit_id)->get('pr_salary_block')->num_rows();

        if ($num_row_block_month > 0) {
            $this->form_validation->set_message('stop_salary_month_check', 'FAILED - This Month Already Finally Processed.');
            return false;
        }

        $num_row_salary_create = $this->db->like('emp_id', $emp_id)->like('salary_month', $salary_month)->get('pr_pay_scale_sheet')->num_rows();
        if ($num_row_salary_create < 1) {
            $this->form_validation->set_message('stop_salary_month_check', 'FAILED - Salary For This Month Does Not Processed.');
            return false;
        }

        return true;

    }





    public function letter_notification(){

        $this->data['title'] = 'Increment / Promotion';
        $this->data['username'] = $this->data['user_data']->id_number;
        $this->data['subview'] = 'letter_notification';
        $this->load->view('layout/template', $this->data);

    }




}
