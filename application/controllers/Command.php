<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	/**
	 * Index Page for this controller.
	 * This controller used to only manual scripts command run
	 * So not used/create any method this contrller to main app development 
	 */

class Command extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		ini_set('memory_limit', -1);
		ini_set('max_execution_time', 0);
	    set_time_limit(0);
		
		/* Standard Libraries */
		// $this->load->library('grocery_CRUD');
		// $this->load->model('acl_model');
		$this->load->dbforge();
	}




	//  per_info address add gender, religion, marital_status, blood group
	public function indexddddddd()
	{
		echo "hello, ci";
		$results = $this->db->where('unit_id !=', 1)->get('pr_emp_com_info')->result();

		foreach ($results as $key => $row) {

			$rs = $this->db->where('emp_id',$row->emp_id)->get('pr_emp_per_info_copy')->row();


			if ($rs->emp_religion == 1) {
				$rel = 'Islam';
			} elseif ($rs->emp_religion == 2) {
				$rel = 'Hindu';
			} elseif ($rs->emp_religion == 3) {
				$rel = 'Christian';
			} elseif ($rs->emp_religion == 4) {
				$rel = 'Buddhish';
			} else {
				$rel = '';
			}

			if ($rs->emp_marital_status == 1) {
				$mar = 'Unmarried';
			} else {
				$mar = 'Married';
			}

			if ($rs->emp_sex == 1) {
				$gen = 'Male';
			} elseif ($rs->emp_sex == 2) {
				$gen = 'Female';
			} else {
				$gen = 'Common';
			}
			
			if ($rs->emp_blood == 1) {
				$blo = 'A+';
			} elseif ($rs->emp_blood == 2) {
				$blo = 'A-';
			} elseif ($rs->emp_blood == 3) {
				$blo = 'B+';
			} elseif ($rs->emp_blood == 4) {
				$blo = 'B-';
			} elseif ($rs->emp_blood == 5) {
				$blo = 'AB+';
			} elseif ($rs->emp_blood == 6) {
				$blo = 'AB-';
			} elseif ($rs->emp_blood == 7) {
				$blo = 'O+';
			} elseif ($rs->emp_blood == 8) {
				$blo = 'O-';
			} else {
				$blo = 'None';
			}
			

			$data = array(
				'religion'			=> $rel,
				'marital_status'	=> $mar,
				'gender'			=> $gen,
				'blood'				=> $blo,
			);
			$this->db->where('emp_id',$row->id)->update('pr_emp_per_info', $data);
			echo "<pre> $row->emp_id =  emp id set";
		}
		dd('exit');
	}

	//  per_info address add gender, religion, marital_status, blood group
	public function gen_mar_blo_per_info()
	{
		echo "hello, ci";
		$results = $this->db->where('unit_id !=', 1)->get('pr_emp_com_info')->result();

		foreach ($results as $key => $row) {

			$rs = $this->db->where('emp_id',$row->emp_id)->get('pr_emp_per_info_copy')->row();


			if ($rs->emp_religion == 1) {
				$rel = 'Islam';
			} elseif ($rs->emp_religion == 2) {
				$rel = 'Hindu';
			} elseif ($rs->emp_religion == 3) {
				$rel = 'Christian';
			} elseif ($rs->emp_religion == 4) {
				$rel = 'Buddhish';
			} else {
				$rel = '';
			}

			if ($rs->emp_marital_status == 1) {
				$mar = 'Unmarried';
			} else {
				$mar = 'Married';
			}

			if ($rs->emp_sex == 1) {
				$gen = 'Male';
			} elseif ($rs->emp_sex == 2) {
				$gen = 'Female';
			} else {
				$gen = 'Common';
			}
			
			if ($rs->emp_blood == 1) {
				$blo = 'A+';
			} elseif ($rs->emp_blood == 2) {
				$blo = 'A-';
			} elseif ($rs->emp_blood == 3) {
				$blo = 'B+';
			} elseif ($rs->emp_blood == 4) {
				$blo = 'B-';
			} elseif ($rs->emp_blood == 5) {
				$blo = 'AB+';
			} elseif ($rs->emp_blood == 6) {
				$blo = 'AB-';
			} elseif ($rs->emp_blood == 7) {
				$blo = 'O+';
			} elseif ($rs->emp_blood == 8) {
				$blo = 'O-';
			} else {
				$blo = 'None';
			}
			

			$data = array(
				'religion'			=> $rel,
				'marital_status'	=> $mar,
				'gender'			=> $gen,
				'blood'				=> $blo,
			);
			$this->db->where('emp_id',$row->id)->update('pr_emp_per_info', $data);
			echo "<pre> $row->emp_id =  emp id set";
		}
		dd('exit');
	}

	//  per_info address add
	public function per_info_address()
	{
		echo "hello, ci";
		$results = $this->db->where('unit_id !=', 4)->get('pr_emp_com_info')->result();

		foreach ($results as $key => $row) {

			$rs = $this->db->where('emp_id',$row->emp_id)->get('pr_emp_add')->row();

			$data = array(
				'pre_village'	=> $rs->emp_pre_add?$rs->emp_pre_add:'',
				'per_village' 	=> $rs->emp_par_add?$rs->emp_par_add:'',
			);
			$this->db->where('emp_id',$row->id)->update('pr_emp_per_info', $data);
			echo "<pre> $row->emp_id =  emp id set";
		}
		dd('exit');
	}

	//  pr_emp_com_info table update to proxi id add pr_id_proxi table drop
	public function com_info()
	{
		echo "hello, ci";

		$results = $this->db->select('emp_id')->get('pr_emp_com_info')->result();

		foreach ($results as $key => $row) {
			$rs = $this->db->where('emp_id', $row->emp_id)->get('pr_id_proxi')->row();
			$data = array(
				'proxi_id' => ($rs->proxi_id) ? $rs->proxi_id:$row->emp_id,
			);
			$this->db->where('emp_id',$row->emp_id)->update('pr_emp_com_info', $data);
			echo "<pre> $row->emp_id = proxi id set";
		}
		dd('exit');
	}

	// Delete pr_holiday table data 2013-10-30 to 2021-10-01 
	public function holiday()
	{
		echo "hello, ci";
		$i = '2021-10-01';

		while ($i >= '2013-10-30') {

			$rs = $this->db->where('holiday_date', $i)->get('pr_holiday')->row();;
			if (!empty($rs))
			{
				$this->db->where('holiday_date', $i)->delete('pr_holiday');
				echo "<pre> $i Delete data";
			}

			$i = date('Y-m-d', strtotime('-1 days'. $i));

		}
		dd('exit');
	}

	// Delete pr_work_off table data 2013-10-30 to 2021-10-01 
	public function work_off()
	{
		echo "hello, ci";
		$i = '2021-10-01';

		while ($i >= '2013-10-30') {

			$rs = $this->db->where('work_off_date', $i)->get('pr_work_off')->row();;
			if (!empty($rs))
			{
				$this->db->where('work_off_date', $i)->delete('pr_work_off');
				echo "<pre> $i Delete data";
			}

			$i = date('Y-m-d', strtotime('-1 days'. $i));

		}
		dd('exit');
	}

	// Delete pr_emp_shift_log table data 2013-10-30 to 2021-10-01 
	public function shift_log()
	{
		echo "hello, ci";
		$i = '2021-10-01';

		while ($i >= '2013-10-30') {

			$rs = $this->db->where('shift_log_date', $i)->get('pr_emp_shift_log')->row();;
			if (!empty($rs))
			{
				$this->db->where('shift_log_date', $i)->delete('pr_emp_shift_log');
				echo "<pre> $i Delete data";
			}

			$i = date('Y-m-d', strtotime('-1 days'. $i));

		}
		dd('exit');
	}

	// Delete att_year_month (att_2020_07) table 
	public function att_year_month()
	{
		echo "hello, ci";
		$i = '2021-09';
		while ($i >= '2013-09') {

			$att = 'att_'.date('Y_m', strtotime($i));

			if ($this->db->table_exists($att))
			{
				$this->dbforge->drop_table($att);
				echo "<pre>".$att;
			}

			$i = date('Y-m', strtotime('-1 months'. $i));

		}
		dd('exit');
	}

	// Delete all temp table 
	public function temp()
	{
		echo "hello, ci";
		$results = $this->db->select('emp_id')->get('pr_emp_com_info')->result(); //->where('unit_id',4)

		foreach ($results as $key => $row) {
			// Produces: DROP TABLE table_name
			$temp = "temp_$row->emp_id";

			if ($this->db->table_exists($temp))
			{
				$this->dbforge->drop_table($temp);
				echo "<pre> Id = $row->emp_id";
			}
		}
		dd('exit');
	}

	function file_read(){
		// exit('this function create to manual data insert in to db');
		$file_name = "import/aj_add.txt";

		if (file_exists($file_name)){

			$lines = file($file_name);
			foreach(array_values($lines)  as $line) {
				list($id,$per,$pre) = explode("\t", trim($line));

				$rs = $this->db->where('emp_id',$id)->get('pr_emp_com_info')->row();
				// dd($rs);

				if (!empty($rs)) {
					$data = array(
						'pre_village' 	=> trim($pre),
						'per_village' 	=> trim($per),
					);
					$this->db->where('emp_id',$rs->id)->update('pr_emp_per_info', $data);
					echo "<br> Upload done = ".$id ;
				}
			}
			echo "Upload successfully done";
		}

		exit("wait");
	}



}