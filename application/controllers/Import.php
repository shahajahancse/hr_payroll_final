<?php

class Import extends CI_Controller {
	function __construct(){
		parent::__construct();
	}

	function index(){
		?>
        <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml">
        <head>
	        <meta http-equiv="Content-Type" content="text/csv; charset=utf-8"/>
	        <title>IMPORT</title>
        </head>
		<body>

		<?php
		/********************************/
		/* Code at http://legend.ws/blog/tips-tricks/csv-php-mysql-import/
		/* Edit the entries below to reflect the appropriate values
		/********************************/
		$databasetable = "pr_emp_per_info";
		$fieldseparator = "\t";
		$lineseparator = "\n";
		// $csvfile = "import/Staff_txt_UTF.txt";
		$csvfile = "import/Staff_txt_UTF.txt";

		/********************************/

		/* Would you like to add an ampty field at the beginning of these records?

		/* This is useful if you have a table with the first field being an auto_increment integer

		/* and the csv file does not have such as empty field before the records.

		/* Set 1 for yes and 0 for no. ATTENTION: don't set to 1 if you are not sure.

		/* This can dump data in the wrong fields if this extra field does not exist in the table

		/********************************/

		$addauto = 1;

		/********************************/

		/* Would you like to save the mysql queries in a file? If yes set $save to 1.

		/* Permission on the file should be set to 777. Either upload a sample file through ftp and

		/* change the permissions, or execute at the prompt: touch output.sql && chmod 777 output.sql

		/********************************/

		$save = 1;

		// $outputfile = "import/output_staff.txt";
		$outputfile = "import/output_worker.txt";

		/********************************/

		if(!file_exists($csvfile)) {
			echo "File not found. Make sure you specified the correct path.\n";
			exit;
		}
		$file = fopen($csvfile,"r");

		if(!$file) {
			echo "Error opening data file.\n";
			exit;
		}

		$size = filesize($csvfile);
		if(!$size) {
			echo "File is empty.\n";
			exit;
		}
		$csvcontent = fread($file,$size);
		fclose($file);

		//echo $check = file_put_contents($tmpfile, str_replace("\t", ";",  iconv('UTF-16', 'UTF-8', file_get_contents($csvfile))));

		$lines = 0;
		$queries = "";
		$linearray = array();
		$line_by_array = explode($lineseparator,$csvcontent);

		//foreach(explode($lineseparator,$csvcontent) as $line) {

		$count = count($line_by_array);
		// for($i = 0 ; $i < $count - 1; $i++) {
		for($i = 1 ; $i < $count; $i++) {
			$lines++;
			$line = trim($line_by_array[$i]);
			//echo $line.'<br>';

			//$line = trim($line," \t");

			//$line = str_replace("\r","\t",$line);

			/***********************************

			This line escapes the special character. remove it if entries are already escaped in the csv file

			***********************************/

			//$line = str_replace("'","\'",$line);

			/************************************/

			//echo $line.'<br>';

			$linearray = explode($fieldseparator,$line);

			//print_r($linearray);
			//echo '=========================';
			//$linemysql = implode("','",$linearray);

			$emp_name  	= trim($linearray[0]);
			$emp_b_name	= trim($linearray[1]);
			echo $emp_id 	= trim($linearray[2]).',';
			$dept_name	= trim($linearray[3]);
			$sec_name	= trim($linearray[4]);
			$line_name	= trim($linearray[5]);
			$desig_name	= trim($linearray[6]);
			
			$sal_grade	= trim($linearray[7]);
			$doj 		= trim($linearray[8]);
			$dob 		= trim($linearray[9]);
			$sal_gross	= trim($linearray[10]);
			$att_bonus	= trim($linearray[11]);
			$gender		= trim($linearray[12]);
			$marital	= trim($linearray[13]);

			$ot			= trim($linearray[14]);

			$fthr_name= trim($linearray[15]);
			$fthr_name_b= trim($linearray[16]);
			$mthr_name= trim($linearray[17]);
			$mthr_name_b= trim($linearray[18]);

			$pre_add= trim($linearray[19]);
			$par_add= trim($linearray[20]);
			$pre_add_b= trim($linearray[21]);
			$par_add_b= trim($linearray[22]);

			$district		= trim($linearray[23]);
			$pr_emp_edu		= trim($linearray[24]);
			$religion		= trim($linearray[25]);

			$nid			= trim($linearray[26]);
			$emp_blood		= trim($linearray[27]);
			$bank_ac		= trim($linearray[28]);

			$com_gross	= $sal_gross;

			//$unit_id = substr($emp_id, 0, 1);
			
			$unit_id = 1;
			$emp_position_id = 1;//Stuff =1 And Worker =2

			if($gender 	=='F'  ){ $gender 	= 2; }else{ $gender = 1; }
			if($marital =='Married'){ $marital 	= 2; }else{ $marital= 1; }
			if($ot 		=='Yes'){ $ot 		= 0; }else{ $ot 	= 1; }

			if($line_name ==''){ $line_id 	= 0; }else{$line_id=$line_name;}

			if($dept_name ==''){ $dept_name 	= 'None'; }
			if($sec_name ==''){ $sec_name 	= 'None'; }
			if($district ==''){ $district 	= 'None'; }
			if($desig_name ==''){ $desig_name 	= 'None'; }
			if($sal_grade ==''){ $sal_grade 	= 'None'; }
			if($religion ==''){ $religion 	= 'None'; }
			if($att_bonus =='Yes'){ $att_bonus 	= '1'; }else{ $att_bonus 	= '2'; }

			/*$this->check_dept($dept_name,$unit_id);
			$this->check_section($sec_name,$unit_id);
			$this->check_district($district);
			$this->check_designation($desig_name,$unit_id);
			$this->check_salgrade($sal_grade);
			$this->check_religion($religion);*/
			// $this->check_att_bonus($bonus_name);

			/*$dept_id = $this->get_department_id_by_name($dept_name,$unit_id);
			$sec_id  = $this->get_section_id_by_name($sec_name,$unit_id);
			$district_id = $this->get_district_id_by_name($district);
			$desig_id = $this->get_designation_id_by_name($desig_name,$unit_id);
			$sal_grade_id = $this->get_salary_grade_id_by_name($sal_grade);
			$religion_id = $this->get_religion_id_by_name($religion);*/
			// $bonus_id = $this->get_bonus_id_by_name($bonus_name);
			
			
			$dob1 = date('Y-m-d', strtotime($dob));
			$doj1 = date('Y-m-d', strtotime($doj));

			//echo "$emp_id====$emp_name===$dob-->$dob1<br>";

			/*if($addauto){
				echo $query =  "INSERT INTO $databasetable (`emp_id`, `emp_full_name`, `bangla_nam`, `national_brn_id`, `emp_fname`, `emp_fname_bn`, `emp_mname`, `emp_mname_bn`, `emp_dob`, `emp_religion`, `emp_sex`, `emp_marital_status`, `emp_blood`, `bank_ac_no` ) VALUES ('$emp_id', '$emp_name', '$emp_b_name', '$nid','$fthr_name','$fthr_name_b','$mthr_name','$mthr_name_b','$dob1','$religion_id', '$gender', '$marital', '$emp_blood', '$bank_ac');";
				echo "<br>";

				echo $query2 = "INSERT INTO pr_emp_com_info (`emp_id`,`unit_id`,`emp_dept_id`, `emp_sec_id`, `emp_line_id`, `emp_desi_id`,`emp_operation_id`,`emp_position_id`, `emp_sal_gra_id`, `emp_cat_id`, `emp_shift`, `gross_sal`,`com_gross_sal`, `ot_entitle`, `transport`, `lunch`, `att_bonus`, `salary_draw`,`salary_type`,`emp_join_date`) VALUES ('$emp_id',$unit_id,$dept_id,$sec_id,$line_id,$desig_id,0,$emp_position_id,'$sal_grade_id',1,1,'$sal_gross','$com_gross',$ot,1,1,'$att_bonus',1,1,'$doj1' );";
				echo "<br>";

				echo $query3 =  "INSERT INTO pr_emp_add (`emp_id`, `emp_pre_add`, `emp_par_add`, `emp_par_dis`, `emp_pre_add_ban`, `emp_par_add_ban`) VALUES ('$emp_id','$pre_add','$par_add','$district_id','$pre_add_b','$par_add_b');";
				echo "<br>";

				echo $query4 =  "INSERT INTO pr_emp_edu (`emp_id`,`emp_degree`) VALUES ('$emp_id','$pr_emp_edu');";
				echo "<br>";

				echo $query5 =  "INSERT INTO pr_emp_skill (`emp_id`) VALUES ('$emp_id');";
				echo "<br>";

				echo $query6 =  "INSERT INTO pr_id_proxi (`emp_id`,`proxi_id`) VALUES ('$emp_id','$emp_id');";
				echo "<br>";

				echo $query7 = "CREATE TABLE IF NOT EXISTS `temp_$emp_id` (`att_id` int(11) NOT NULL AUTO_INCREMENT, `device_id` int(11) DEFAULT NULL, `proxi_id` int(11) DEFAULT NULL, `date_time` datetime DEFAULT NULL, PRIMARY KEY (`att_id`) ) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";

				echo "<br>";

				echo $query8 ="-- ======================================================================";
				}

			else

				echo $query =  "INSERT INTO $databasetable (`emp_id`,`emp_full_name`,`emp_dob`,`emp_marital_status`,`emp_blood`) VALUES ('$emp_id', '$emp_name', '$dob1', 1, 0);";

			$queries .= $query . "\n";
			$queries .= $query2 . "\n";
			$queries .= $query3 . "\n";
			$queries .= $query4 . "\n";
			$queries .= $query5 . "\n";
			$queries .= $query6 . "\n";
			$queries .= $query7 . "\n";
			$queries .= $query8 . "\n";
			echo "<br>";*/
			//@mysql_query($query);
		}

		//@mysql_close($con);
		/*if($save) {
			if(!is_writable($outputfile)) {
				echo "File is not writable, check permissions.\n";
			}else {
				$file2 = fopen($outputfile,"w");
				if(!$file2) {
					echo "Error writing to the output file.\n";
				}else {
					fwrite($file2,$queries);
					fclose($file2);
				}
			}
		}*/
		echo "Found a total of $lines records in this csv file.\n";
	?>
</body>
</html>
<?php
	}

	//Zuel
	function zuel_import_xlsx(){
		?>
        <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml">
        <head>
	        <meta http-equiv="Content-Type" content="text/csv; charset=utf-8"/>
	        <title>IMPORT</title>
        </head>
		<body>

		<?php
		$fieldseparator = "\t";
		$lineseparator = "\n";

		$csvfile = './uploads/files/Worker_List_Ucode.csv';
		if(!file_exists($csvfile)) {
			echo "File not found. Make sure you specified the correct path.\n";
			exit;
		}
		$file = fopen($csvfile,"r");

		if(!$file) {
			echo "Error opening data file.\n";
			exit;
		}

		$size = filesize($csvfile);
		if(!$size) {
			echo "File is empty.\n";
			exit;
		}
		$csvcontent = fread($file,$size);
		fclose($file);

		//echo $check = file_put_contents($tmpfile, str_replace("\t", ";",  iconv('UTF-16', 'UTF-8', file_get_contents($csvfile))));

		$lines = 0;
		$queries = "";
		$linearray = array();
		$line_by_array = explode($lineseparator,$csvcontent);

		//foreach(explode($lineseparator,$csvcontent) as $line) {

		$count = count($line_by_array);
		for($i = 0 ; $i < $count - 1; $i++) {
			$lines++;
			$line = trim($line_by_array[$i]);

			$linearray = explode($fieldseparator,$line);

			print_r($linearray);

			//echo '=========================';

			// $linemysql = implode("','",$linearray);
			// echo $linemysql = implode("','",$linearray);
			// print_r($linemysql);
			// echo $emp_name  	= $linearray[0];
			/*echo $emp_b_name	= $linearray[1];
			echo $emp_id 	= $linearray[2];
			echo $dept_name	= $linearray[3];
			echo $sec_name	= $linearray[4];*/
			echo "<br>";
		}
		echo "string";
	?>
</body>
</html>
<?php
	}

	function check_dept($dept_name,$unit_id){
		$num_row = $this->db->where('dept_name',trim($dept_name))->where('unit_id',$unit_id)->get('pr_dept')->num_rows();

		if($num_row < 1){
			$dept_name = trim($dept_name);
			$data = array(
				'unit_id' => $unit_id,
				'dept_name' => $dept_name
			);
			$this->db->insert('pr_dept', $data); 
		}
	}

	function check_section($sec_name,$unit_id){
		$num_row = $this->db->where('sec_name',trim($sec_name))->where('unit_id',$unit_id)->get('pr_section')->num_rows();
		if($num_row < 1){
			$sec_name = trim($sec_name);
			$data = array(
				'unit_id' => $unit_id,
				'sec_name' => $sec_name
			);
			$this->db->insert('pr_section', $data); 
		}
	}

	function check_district($district_name){
		$num_row = $this->db->where('name_en',trim($district_name))->get('district')->num_rows();
		if($num_row < 1){
			$district_name = trim($district_name);
			$data = array(
				'name_en' => $district_name
			);
			$this->db->insert('district', $data); 
		}
	}

	function check_designation($desig_name,$unit_id){
		$num_row = $this->db->where('desig_name',trim($desig_name))->where('unit_id',$unit_id)->get('pr_designation')->num_rows();
		if($num_row < 1){
			$desig_name = trim($desig_name);
			$data = array(
				'unit_id' => $unit_id,
				'desig_name' => $desig_name

			);
			$this->db->insert('pr_designation', $data);
		}
	}

	function check_salgrade($salgrade_name){
		$num_row = $this->db->where('gr_name',trim($salgrade_name))->get('pr_grade')->num_rows();
		if($num_row < 1){
			$salgrade_name = trim($salgrade_name);
			$data = array(
				'gr_name' => $salgrade_name
			);
			$this->db->insert('pr_grade', $data); 
		}
	}
	function check_religion($religion){
		$num_row = $this->db->where('religion_name',trim($religion))->get('pr_religions')->num_rows();
		if($num_row < 1){
			$religion_name = trim($religion);
			$data = array(
				'religion_name' => $religion_name
			);
			$this->db->insert('pr_religions', $data); 
		}
	}
	
	function check_att_bonus($bonus_name){
		$num_row = $this->db->where('ab_rule_name',trim($bonus_name))->get('pr_attn_bonus')->num_rows();
		if($num_row < 1){
			$bonus_name = trim($bonus_name);
			$data = array(
				'ab_rule_name' => $bonus_name
			);
			$this->db->insert('pr_attn_bonus', $data); 
		}
	}

	function get_unit_id_by_name($unit_name){
		$this->db->select('unit_id');
		$this->db->where('unit_name',trim($unit_name));
		$query = $this->db->get('pr_units');
		$row = $query->row();
		return $unit_id = $row->unit_id;
	}

	function get_department_id_by_name($dept_name,$unit_id){
		$this->db->select('dept_id');
		$this->db->where('dept_name',trim($dept_name));
		$this->db->where('unit_id',$unit_id);
		$query = $this->db->get('pr_dept');
		$row = $query->row();
		return $dept_id = $row->dept_id;
	}

	function get_section_id_by_name($sec_name,$unit_id){
		$this->db->select('sec_id');
		$this->db->where('sec_name',trim($sec_name));
		$this->db->where('unit_id',$unit_id);
		$query = $this->db->get('pr_section');
		$row = $query->row();
		return $sec_id = $row->sec_id;
	}

	function get_district_id_by_name($district_name){
		$this->db->select('id');
		$this->db->where('name_en',trim($district_name));
		// $this->db->where('unit_id',$unit_id);
		$query = $this->db->get('district');
		$row = $query->row();
		return $district_id = $row->id;
	}

	function get_designation_id_by_name($desig_name,$unit_id){
		$this->db->select('desig_id');
		$this->db->where('desig_name',trim($desig_name));
		$this->db->where('unit_id',$unit_id);
		$query = $this->db->get('pr_designation');
		$row = $query->row();
		return $desig_id = $row->desig_id;
	}

	function get_salary_grade_id_by_name($sal_grade){
		$this->db->select('gr_id');
		$this->db->where('gr_name',trim($sal_grade));
		$query = $this->db->get('pr_grade');
		$row = $query->row();
		return $gr_id = $row->gr_id;
	}
	function get_religion_id_by_name($religion_name){
		$this->db->select('religion_id');
		$this->db->where('religion_name',trim($religion_name));
		$query = $this->db->get('pr_religions');
		$row = $query->row();
		return $religion_id = $row->religion_id;
	}

	function get_bonus_id_by_name($bonus_name){
		$this->db->select('ab_id');
		$this->db->like('ab_rule_name', trim($bonus_name));
		$query = $this->db->get('pr_attn_bonus');
		$row = $query->row();
		//echo $this->db->last_query();
		return $ab_id = $row->ab_id;
	}

	function add_phone(){
		date_default_timezone_set('Asia/Dhaka');
		$file_name = "import/cn.txt";
		if (file_exists($file_name)){
			$lines = file($file_name);
			foreach(array_values($lines)  as $line) {
				list($id, $amt) = preg_split('/\s+/', trim($line));
				$data = array(
					'emp_id' 		=> $id,
					'emp_com_name'	=> $amt,
				);
				$this->db->where('emp_id', $id);
				$this->db->insert('pr_emp_skill', $data);
			}
			echo "Upload successfully done";
		}
	}

	function inc_pro(){
		date_default_timezone_set('Asia/Dhaka');
		$file_name = "import/promotion.txt";
		if (file_exists($file_name)){
			$lines = file($file_name);
			// dd($lines);
			foreach(array_values($lines)  as $line) {

				list($id, $desig_id,$salary,$grade,$effect_date) = preg_split('/\s+/', trim($line));
				$emp_pre_info = $this->db->select('emp_id,emp_dept_id,emp_sec_id,emp_line_id,emp_desi_id,emp_sal_gra_id,gross_sal,com_gross_sal')->from('pr_emp_com_info')->where('emp_id',$id)->get()->row();
				if (empty($emp_pre_info)) {
					// echo $id."<br>";
					continue;
				}
				// echo "<pre>";print_r($emp_pre_info);				
				$data = array(
					'prev_emp_id'     => $emp_pre_info->emp_id,
					'prev_dept'       => $emp_pre_info->emp_dept_id,
					'prev_section'    => $emp_pre_info->emp_sec_id,
					'prev_line'       => $emp_pre_info->emp_line_id,
					'prev_desig'      => $emp_pre_info->emp_desi_id,
					'prev_grade'      => $emp_pre_info->emp_sal_gra_id,
					'prev_salary'     => $emp_pre_info->gross_sal,
					'prev_com_salary' => $emp_pre_info->com_gross_sal,
					'new_emp_id'      => $emp_pre_info->emp_id,
					'new_dept'        => $emp_pre_info->emp_dept_id,
					'new_section'     => $emp_pre_info->emp_sec_id,
					'new_line'        => $emp_pre_info->emp_line_id,
					'new_desig'       => $desig_id,
					'new_grade'       => $grade,
					'new_salary'      => $salary,
					'new_com_salary'  => $salary,
					'effective_month' => date('Y-m-d',strtotime($effect_date)),
					'ref_id' 		  =>  $emp_pre_info->emp_id,
					'status' 		  =>2
				);
				// echo "<pre>";print_r($data);
				// dd($data);
				$insert = $this->db->where('prev_emp_id', $id)->insert('pr_incre_prom_pun', $data);
				if($insert){
					$data = array(
							// 'emp_id'		 =>$id,
							'emp_desi_id'	 =>$desig_id,	
							'emp_sal_gra_id' =>$grade,		
							'gross_sal'		 =>$salary,
							'com_gross_sal'  =>$salary 		
					);
					// $this->db->where('prev_emp_id', $id);
					$this->db->where('emp_id', $id)->update('pr_emp_com_info', $data);
				}
			}
			echo "Upload successfully done";
		}
	}

	function inc(){
		date_default_timezone_set('Asia/Dhaka');
		$file_name = "import/incre.txt";
		if (file_exists($file_name)){
			$lines = file($file_name);
			foreach(array_values($lines)  as $line) {
				list($id,$salary,$grade,$effect_date) = preg_split('/\s+/', trim($line));
				$emp_pre_info = $this->db->select('emp_id,emp_dept_id,emp_sec_id,emp_line_id,emp_desi_id,emp_sal_gra_id,gross_sal,com_gross_sal')->from('pr_emp_com_info')->where('emp_id',$id)->get()->row();
				if (empty($emp_pre_info)) {
					echo @$i++;
					continue;
				}			
				$data = array(
					'prev_emp_id'     => $emp_pre_info->emp_id,
					'prev_dept'       => $emp_pre_info->emp_dept_id,
					'prev_section'    => $emp_pre_info->emp_sec_id,
					'prev_line'       => $emp_pre_info->emp_line_id,
					'prev_desig'      => $emp_pre_info->emp_desi_id,
					'prev_grade'      => $emp_pre_info->emp_sal_gra_id,
					'prev_salary'     => $emp_pre_info->gross_sal,
					'prev_com_salary' => $emp_pre_info->com_gross_sal,
					'new_emp_id'      => $emp_pre_info->emp_id,
					'new_dept'        => $emp_pre_info->emp_dept_id,
					'new_section'     => $emp_pre_info->emp_sec_id,
					'new_line'        => $emp_pre_info->emp_line_id,
					'new_desig'       => $emp_pre_info->emp_desi_id,
					'new_grade'       => $grade,
					'new_salary'      => $salary,
					'new_com_salary'  => $salary,
					'effective_month' => date('Y-m-d',strtotime($effect_date)),
					'ref_id' 		  => $emp_pre_info->emp_id,
					'status' 		  => 1
				);
				// echo "<pre>";print_r($data);
				// dd($data);
				$insert = $this->db->where('prev_emp_id', $id)->insert('pr_incre_prom_pun', $data);
				if($insert){
					dd($emp_pre_info->id);
					$data = array(
							'emp_sal_gra_id' =>$grade,		
							'gross_sal'		 =>$salary,
							'com_gross_sal'  =>$salary 		
					);
					// $this->db->where('prev_emp_id', $id);
					$this->db->where('emp_id', $id)->update('pr_emp_com_info', $data);
				}
			}
			echo "Upload successfully done";
		}
	}
}
?>
