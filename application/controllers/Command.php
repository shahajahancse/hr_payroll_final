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

	// pr_incre_prom_pun
	public function stopyyy()
	{
		// dd("hello, ci");
		echo "hello, ci";
		$this->db->select('
				pay_emp_stop_salary.id as st_id,	
				pr_emp_com_info.id,
				pr_emp_com_info.emp_id,
			');
		$this->db->from('pay_emp_stop_salary');
		$this->db->from('pr_emp_com_info');
		$this->db->where('pay_emp_stop_salary.emp_id = pr_emp_com_info.emp_id');
		$this->db->limit(20000);
		$this->db->group_by('pay_emp_stop_salary.emp_id');
		$results = $this->db->get()->result();
		// dd(count($results));

		foreach ($results as $key => $row) {
			$data = array(
				'emp_id' 	 => $row->id,	
			);

			$this->db->where('emp_id', $row->emp_id)->update('pay_emp_stop_salary', $data);

			echo "<pre> $row->st_id =  month = $row->st_id";
		}
		dd('exit');
		// $this->db->insert_batch('pay_salary_sheet_2023', $results);
		// dd($this->db->last_query());
	}

	// pr_incre_prom_pun
	public function incre_prom()
	{
		// dd("hello, ci");
		echo "hello, ci";
		$this->db->select('
				pr_incre_prom_pun.prev_emp_id,
				pr_emp_com_info.id,
			');
		$this->db->from('pr_incre_prom_pun');
		$this->db->from('pr_emp_com_info');
		$this->db->where('pr_incre_prom_pun.prev_emp_id = pr_emp_com_info.emp_id');
		$this->db->limit(20000);
		$this->db->group_by('pr_incre_prom_pun.prev_emp_id');
		$this->db->group_by('pr_emp_com_info.emp_id');
		$results = $this->db->get()->result();
		// dd(count($results));

		foreach ($results as $key => $row) {
			$data = array(
				'prev_emp_id' 	 => $row->id,	
			);

			$this->db->where('prev_emp_id', $row->prev_emp_id)->update('pr_incre_prom_pun', $data);

			echo "<pre> $row->id =  month = $row->prev_emp_id";
		}
		dd('exit');
		// $this->db->insert_batch('pay_salary_sheet_2023', $results);
		// dd($this->db->last_query());
	}

	// pr_emp_left_history
	public function emp_left()
	{
		dd("hello, ci");
		echo "hello, ci";
		$this->db->select('
				pr_emp_left_history.left_id,	
				pr_emp_left_history.unit_id,	
				pr_emp_left_history.emp_id,
				pr_emp_com_info.id,
			');
		$this->db->from('pr_emp_left_history');
		$this->db->from('pr_emp_com_info');
		$this->db->where('pr_emp_left_history.emp_id = pr_emp_com_info.emp_id');
		$this->db->limit(100000);
		$results = $this->db->get()->result();
		// dd($results);

		foreach ($results as $key => $row) {

			$data = array(
				'emp_id' 	 => $row->id,	
			);


			$this->db->where('left_id', $row->left_id)->update('pr_emp_left_history', $data);

			echo "<pre> $row->id =  month = $row->emp_id";
		}
		dd('exit');
		// $this->db->insert_batch('pay_salary_sheet_2023', $results);
		// dd($this->db->last_query());
	}

	// pr_emp_resign_history
	public function emp_resign()
	{
		// dd("hello, ci");
		echo "hello, ci";
		$this->db->select('
				pr_emp_resign_history.resign_id,	
				pr_emp_resign_history.unit_id,	
				pr_emp_resign_history.emp_id,
				pr_emp_com_info.id,
			');
		$this->db->from('pr_emp_resign_history');
		$this->db->from('pr_emp_com_info');
		$this->db->where('pr_emp_resign_history.emp_id = pr_emp_com_info.emp_id');
		$this->db->limit(100000);
		$results = $this->db->get()->result();
		// dd($results);

		foreach ($results as $key => $row) {

			$data = array(
				'emp_id' 	 => $row->id,	
			);


			$this->db->where('resign_id', $row->resign_id)->update('pr_emp_resign_history', $data);

			echo "<pre> $row->id =  month = $row->emp_id";
		}
		dd('exit');
		// $this->db->insert_batch('pay_salary_sheet_2023', $results);
		// dd($this->db->last_query());
	}

	// separate salary  pay_salary_sheet_2022
	public function separate_salary()
	{
		dd("hello, ci");
		echo "hello, ci";
		$this->db->select('
				id,	
				unit_id,	
				emp_id,		
				gross_sal,	
				salary_structure,

				basic_sal,	
				house_r,	
				medical_a,	
				food_allow,	
				trans_allow,


				total_days,	
				num_of_workday,	
				att_days,	
				absent_days,	
				before_after_absent,	
				c_l,	
				s_l,	
				e_l,	
				m_l,	
				wp,	
				total_leave,	
				total_pay_leave,	
				holiday,	
				weekend,	
				total_holiday,	
				pay_days,	

				day_info,	
				salary_month,

			');
		$this->db->from('pay_salary_sheet_2022');
		$this->db->limit(100000);
		$results = $this->db->get()->result();

		foreach ($results as $key => $row) {
			$obj = array(
				'basic_sal' => $row->basic_sal,	
				'house_r' => $row->house_r,	
				'medical_a' => $row->medical_a,	
				'food_allow' => $row->food_allow,	
				'trans_allow' => $row->trans_allow,
			);

			$obj1 = array(
				'total_days' 	 => $row->total_days,	
				'num_of_workday' => $row->num_of_workday,	
				'att_days' 		 => $row->att_days,	
				'absent_days' 	 => $row->absent_days,	
				'ba_absent' 	 => $row->before_after_absent,
				'c_l' 		 	 => $row->c_l,
				's_l' 		 	 => $row->s_l,
				'e_l' 		 	 => $row->e_l,
				'm_l' 		 	 => $row->m_l,
				'wp' 		 	 => $row->wp,
				'total_leave' 	 => $row->total_leave,
				'pay_leave' 	 => $row->total_pay_leave,
				'holiday' 		 => $row->holiday,
				'weekend' 		 => $row->weekend,
				'total_holiday'  => $row->total_holiday,
				'pay_days' 		 => $row->pay_days,
			);

			// dd($data);
			$sdate = date('Y-m-01', strtotime($row->salary_month)); 
			$edate = date('Y-m-t', strtotime($row->salary_month)); 
			$this->db->select('
				    shift_log_date,
		            in_time,
		            out_time,
		            ot,
		            eot
				');

			$this->db->from('pr_emp_shift_log');
			$this->db->where("emp_id", $row->emp_id);
			$this->db->where("shift_log_date BETWEEN '$sdate' and '$edate'");
			$this->db->limit(100);
			$results = $this->db->get()->result();
			foreach ($results as $key => $rows) {
				$obj2[$key] = array(
					'log_date' 		=> $rows->shift_log_date,
					'in_time' 		=> $rows->in_time,
					'out_time' 		=> $rows->out_time,
					'ot' 		 	=> $rows->ot,
					'eot' 		 	=> $rows->eot,
				);
			}

			$data = array(
				'salary_structure'	=> json_encode($obj),
				'day_info'			=> json_encode($obj1),
				'log_info'			=> json_encode($obj2),
			);
			
			// dd($this->db->last_query());


			$this->db->where('id', $row->id)->where('salary_month', $row->salary_month)->update('pay_salary_sheet_2022', $data);

			echo "<pre> $row->emp_id =  month = $row->salary_month";
		}
		dd('exit');
		// $this->db->insert_batch('pay_salary_sheet_2023', $results);
		// dd($this->db->last_query());
	}

	// pay_salary_sheet
	// not used
	public function create_salary_sheet()
	{
		dd('ddd');
		$i = '2014';
		while ($i <= '2024') {
			$newTableName = "pay_salary_sheet_$i";
			if (!$this->db->table_exists($newTableName))
			{
				$query = $this->db->query("SHOW CREATE TABLE pay_salary_sheet");
				$row = $query->row_array();
				$newTableName = str_replace('pay_salary_sheet', $newTableName, $row['Create Table']);
				$this->db->query($newTableName);
			}
			$i = $i + 1;
		}

		echo "hello, ci";
		$this->db->select('*');
		$this->db->from('pay_salary_sheet');
		$this->db->where("pay_salary_sheet.salary_month BETWEEN '2023-01-01' and '2023-12-01'");
		$this->db->limit(100000);
		$results = $this->db->get()->result_array();

		$this->db->insert_batch('pay_salary_sheet_2023', $results);
		// dd($this->db->last_query());
		dd('ok');
	}

	//  salary     done
	public function salary_emp_id()
	{
		echo "hello, ci";
		$this->db->select('pr_emp_com_info.id, pr_emp_com_info.emp_id, pr_emp_com_info.unit_id');
		$this->db->from('pay_salary_sheet');
		$this->db->from('pr_emp_com_info');
		$this->db->where('pr_emp_com_info.emp_id = pay_salary_sheet.emp_id');
		$this->db->where('pr_emp_com_info.unit_id =', 3);
		$this->db->where('pay_salary_sheet.unit_id =', 3);
		$this->db->group_by('pr_emp_com_info.id');
		$results = $this->db->get()->result();
		// dd($results);

		foreach ($results as $key => $row) {

			$data = array(
				'emp_id'			=> $row->id,
			);
			// dd($data);

			$this->db->where('emp_id',$row->emp_id)->update('pay_salary_sheet', $data);

			echo "<pre> $row->emp_id =  emp id set = ";
		}
		dd('exit');
	}

	//  per_info address add gender, religion, marital_status, blood group  
	// nor used
	public function ot_eot()
	{
		dd('exit');
		echo "hello, ci";
		$this->db->select('emp_id, shift_log_date, ot, eot');
		$this->db->from('pr_emp_shift_log');
		$this->db->where('ot !=', 0);
		$this->db->where('unit_id =', 1);
		$results = $this->db->get()->result();

		foreach ($results as $key => $row) {

			$data = array(
				'ot'			=> ($row->ot * 60),
				'eot'			=> ($row->eot * 60),
			);
			// dd($data);

			$this->db->where('emp_id',$row->emp_id)->where('shift_log_date',$row->shift_log_date)->update('pr_emp_shift_log', $data);

			echo "<pre> $row->emp_id =  emp id set = ";
		}
		dd('exit');
	}

	//  pr_emp_shift_log employee id conver   done
	public function log_emp_id()
	{
		echo "hello, ci";
		$this->db->select('pr_emp_com_info.id, pr_emp_com_info.emp_id, pr_emp_com_info.unit_id');
		$this->db->from('pr_emp_shift_log');
		$this->db->from('pr_emp_com_info');
		$this->db->where('pr_emp_com_info.emp_id = pr_emp_shift_log.emp_id');
		$this->db->where('pr_emp_com_info.unit_id =', 3);
		$this->db->group_by('pr_emp_com_info.id');
		$results = $this->db->get()->result();
		// dd($results);

		foreach ($results as $key => $row) {
			$rs = $this->db->where('emp_id',$row->emp_id)->get('pr_emp_shift_log')->result();

			$data = array(
				'emp_id'			=> $row->id,
				'unit_id'			=> $row->unit_id,
			);
			$this->db->where('emp_id',$row->emp_id)->update('pr_emp_shift_log', $data);

			echo "<pre> $row->emp_id =  emp id set = ".count($rs);
		}
		dd('exit');
	}

	//  per_info address add gender, religion, marital_status, blood group   done
	public function gen_mar_blo_per_info()
	{
		echo "hello, ci";
		$results = $this->db->where('unit_id =', 1)->get('pr_emp_com_info')->result();

		foreach ($results as $key => $row) {

			$rs = $this->db->where('emp_id',$row->emp_id)->get('pr_emp_per_info')->row();


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

	//  per_info address add   done
	public function per_info_address()
	{
		echo "hello, ci";
		$results = $this->db/*->where('unit_id !=', 3)*/->get('pr_emp_com_info')->result();

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

	//  pr_emp_com_info table update to proxi id add pr_id_proxi table drop done
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

	// Delete attn_holiday table data 2013-10-30 to 2021-10-01 done
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

	// Delete attn_work_off table data 2013-10-30 to 2021-10-01  done
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

	// Delete att_year_month (att_2020_07) table  done
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

	// Delete all temp table  done
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

	public function risk($value='')
	{
		dd('not allow');
			$this->db->select('
				pr_emp_com_info.emp_id, 
				pr_emp_skill2.emp_com_name mobile,
				pr_emp_skill2.emp_skill,
				pr_emp_skill2.emp_yr_skill 	
			');

		$this->db->from('pr_emp_com_info');
		$this->db->from('pr_emp_skill2');
		$this->db->where('pr_emp_com_info.emp_id = pr_emp_skill2.emp_id');
		$this->db->where('pr_emp_com_info.unit_id', 4);
		$this->db->group_by("pr_emp_com_info.emp_id");
		$query = $this->db->get();	

		foreach ($query->result() as $key => $row) {
			$this->db->where('emp_id', $row->emp_id)->delete('pr_emp_skill');

			$data = array(
					'emp_id' => $row->emp_id,
					'emp_com_name' => $row->mobile,
					'emp_skill'		=> $row->emp_skill,
					'emp_yr_skill'	=> $row->emp_yr_skill
				);

			$dd = $this->db->where('emp_id', $row->emp_id)->get('pr_emp_skill')->row();
			if (empty($dd)) {
				$this->db->insert('pr_emp_skill', $data);
			}
			// dd($dd);
		}
		exit('ok');
	}



}