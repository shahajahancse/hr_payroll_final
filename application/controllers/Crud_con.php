<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Crud_con extends CI_Controller {


	function __construct()
	{
		parent::__construct();

		/* Standard Libraries */

		$this->load->model('common_model');
		$this->load->model('crud_model');


	}

	 function company_add(){

	 	$this->load->library('form_validation');
	 	$this->load->model('crud_model');

	 	$this->form_validation->set_rules('name', 'Company Name', 'trim|required');
	 	// $this->form_validation->set_rules('bname', 'Company Bangla Name', 'trim|required');
	 	$this->form_validation->set_rules('en_add', 'Company Address English ', 'trim|required');
	 	// $this->form_validation->set_rules('bn_add', 'Company Address Bangla', 'trim|required');

	 	// $this->form_validation->set_rules('phn', 'Mobile Number ', 'required|regex_match[/^[0-9]{10}$/]');
	 	// $this->form_validation->set_rules('logo','Company Logo','file_required|file_min_size[10KB]|file_max_size[500KB]|file_allowed_type[image]|file_image_mindim[50,50]|file_image_maxdim[400,300]');
		// $this->form_validation->set_rules('sign','file_min_size[10KB]|file_max_size[500KB]|file_allowed_type[image]|file_image_mindim[50,50]|file_image_maxdim[400,300]');


		if($this->form_validation->run() == false)
		{

			$this->load->view('company_add');
		}
		else
		{
				// print_r($_POST);exit();
				// print_r($_FILES['logoAAAAA']);
				// print_r($_POST);exit();
				$formArray = array();
				$formArray['name'] = $this->input->post('name');
				$formArray['bname'] = $this->input->post('bname');
				$formArray['en_add'] = $this->input->post('en_add');
				$formArray['bn_add'] = $this->input->post('bn_add');
				$formArray['phn'] = $this->input->post('phn');
				$formArray['comlogo'] = $this->input->post('comlogo');
				$formArray['comsign'] = $this->input->post('comsign');
				// print_r($_POST);exit();

				$this->crud_model->company_add($formArray);
				$this->session->set_flashdata('success','Record adder successfully!');
  				//alert('Record adder successfully!');
				redirect(base_url().'index.php/setup_con/unit');


			}

		}




		function company_edit($comId)
		{
			$data = array();
			$this->load->model('crud_model');
			$this->load->library('form_validation');


		 	$this->form_validation->set_rules('name', 'Company Name', 'trim|required');
		 	$this->form_validation->set_rules('bname', 'Company Bangla Name', 'trim|required');
		 	$this->form_validation->set_rules('en_add', 'Company Address English ', 'trim|required');
		 	$this->form_validation->set_rules('bn_add', 'Company Address Bangla', 'trim|required');

		 	// $this->form_validation->set_rules('phn', 'Mobile Number ', 'required|regex_match[/^[0-9]{10}$/]');

		 	if($this->form_validation->run() == false)
			{
// print_r($this->session->all_userdata());
			$data['company_infos'] = $this->crud_model->getUnit($comId);
			$this->load->view('company_edit',$data);

			}
			else
			{
				$this->crud_model->company_edit($comId);
				$this->session->set_flashdata('success','Record Updated successfully!');
  				//alert('Record adder successfully!');
				redirect('/setup_con/unit');


			}


		}

		function company_delete($comId)
		{
			$this->load->model('crud_model');
			$company = $this->crud_model->getUnit($comId);
			if (empty($company)) {
				$this->session->set_flashdata('failure','Record Not Found in DataBase!');
				redirect('/setup_con/unit');
			}
			$this->crud_model->company_delete($comId);
			$this->session->set_flashdata('success','Record Deleted successfully!');
				redirect('/setup_con/unit');
		}

//===================================Floor=======================================================//



		function floor_add(){

	 	$this->load->library('form_validation');
	 	$this->load->model('crud_model');
	 	$data['floor'] = $this->crud_model->floor_fetch();

	 	$this->form_validation->set_rules('name', 'Floor Name', 'trim|required');


			if($this->form_validation->run() == false)
			{

			 	$this->load->view('floor_add',$data);
			}
			else
			{
				// print_r($_FILES['logoAAAAA']);
				// print_r($_POST);exit();
				$formArray = array();
				$formArray['name'] = $this->input->post('name');
				$formArray['floor'] = $this->input->post('floor');

				$this->crud_model->floor_add($formArray);
				$this->session->set_flashdata('success','Record adder successfully!');
  				//alert('Record adder successfully!');
				redirect(base_url().'index.php/setup_con/floor');


			}

		}


		function floor_edit($floorId)
		{
			$data = array();
			$this->load->model('crud_model');
			$this->load->library('form_validation');


		 	$this->form_validation->set_rules('name', 'Floor Name', 'trim|required');
			$data['floor'] = $this->crud_model->floor_fetch();


		 	if($this->form_validation->run() == false)
			{

			$data['pr_floor'] = $this->crud_model->getfloor($floorId);

			$this->load->view('floor_edit',$data);

			}
			else
			{
				$this->crud_model->floor_edit($floorId);
				$this->session->set_flashdata('success','Record Updated successfully!');
  				//alert('Record adder successfully!');
				redirect('/setup_con/floor');


			}


		}


		function floor_delete($floorId)
		{
			$this->load->model('crud_model');
			$floor = $this->crud_model->getfloor($floorId);
			if (empty($floor)) {
				$this->session->set_flashdata('failure','Record Not Found in DataBase!');
				redirect('/setup_con/floor');
			}
			$this->crud_model->floor_delete($floorId);
			$this->session->set_flashdata('success','Record Deleted successfully!');
				redirect('/setup_con/floor');
		}


//=========================================Department===============================================//




	function dept_add(){

	 	$this->load->library('form_validation');
	 	$this->load->model('crud_model');
	 	$data['dept'] = $this->crud_model->dept_fetch();

	 	$this->form_validation->set_rules('name', 'dept Name', 'trim|required');
	 	$this->form_validation->set_rules('bname', 'dept Bangla Name', 'trim|required');


			if($this->form_validation->run() == false)
			{

			 	$this->load->view('dept_add',$data);
			}
			else
			{
				// print_r($_FILES['logoAAAAA']);
				// print_r($_POST);exit();
				$formArray = array();
				$formArray['name'] = $this->input->post('name');
				$formArray['bname'] = $this->input->post('bname');
				$formArray['dept'] = $this->input->post('dept');

				$this->crud_model->dept_add($formArray);
				$this->session->set_flashdata('success','Record adder successfully!');
  				//alert('Record adder successfully!');
				redirect(base_url().'index.php/setup_con/department');


			}

		}




		function dept_delete($deptId)
		{
			$this->load->model('crud_model');
			$dept = $this->crud_model->getdept($deptId);
			if (empty($dept)) {
				$this->session->set_flashdata('failure','Record Not Found in DataBase!');
				redirect('/setup_con/department');
			}
			$this->crud_model->dept_delete($deptId);
			$this->session->set_flashdata('success','Record Deleted successfully!');
				redirect('/setup_con/department');
		}



//============================================Section===============================================//








//============================================Line===============================================//




	function line_add(){

	 	$this->load->library('form_validation');
	 	$this->load->model('crud_model');
	 	$data['line'] = $this->crud_model->line_fetch();

	 	$this->form_validation->set_rules('name', 'line Name', 'trim|required');
	 	$this->form_validation->set_rules('bname', 'line Bangla Name', 'trim|required');


			if($this->form_validation->run() == false)
			{

			 	$this->load->view('line_add',$data);
			}
			else
			{
				// print_r($_FILES['logoAAAAA']);
				// print_r($_POST);exit();
				$formArray = array();
				$formArray['name'] = $this->input->post('name');
				$formArray['bname'] = $this->input->post('bname');
				$formArray['strn'] = $this->input->post('strn');
				$formArray['strf'] = $this->input->post('strf');
				$formArray['line'] = $this->input->post('line');
				$formArray['indx'] = $this->input->post('indx');

				$this->crud_model->line_add($formArray);
				$this->session->set_flashdata('success','Record adder successfully!');
  				//alert('Record adder successfully!');
				redirect(base_url().'index.php/setup_con/line');


			}

		}


		function line_edit($lineId)
		{
			$data = array();
			$this->load->model('crud_model');
			$this->load->library('form_validation');


		 	$this->form_validation->set_rules('name', 'line Name', 'trim|required');
			$data['line'] = $this->crud_model->line_fetch();


		 	if($this->form_validation->run() == false)
			{
			$data['pr_line'] = $this->crud_model->getline($lineId);

			$this->load->view('line_edit',$data);

			}
			else
			{
				$this->crud_model->line_edit($lineId);
				$this->session->set_flashdata('success','Record Updated successfully!');
  				//alert('Record adder successfully!');
				redirect('/setup_con/line');


			}


		}


		function line_delete($lineId)
		{
			$this->load->model('crud_model');
			$line = $this->crud_model->getline($lineId);
			if (empty($line)) {
				$this->session->set_flashdata('failure','Record Not Found in DataBase!');
				redirect('/setup_con/line');
			}
			$this->crud_model->line_delete($lineId);
			$this->session->set_flashdata('success','Record Deleted successfully!');
				redirect('/setup_con/line');
		}



//=========================================Designation===============================================//




	function desig_add(){

	 	$this->load->library('form_validation');
	 	$this->load->model('crud_model');
	 	$data['desig'] = $this->crud_model->desig_fetch();

	 	$this->form_validation->set_rules('name', 'desig Name', 'trim|required');
	 	$this->form_validation->set_rules('bname', 'desig Bangla Name', 'trim|required');


			if($this->form_validation->run() == false)
			{

			 	$this->load->view('desig_add',$data);
			}
			else
			{
				// print_r($_FILES['logoAAAAA']);
				// print_r($_POST);exit();
				$formArray = array();
				$formArray['name'] = $this->input->post('name');
				$formArray['bname'] = $this->input->post('bname');
				$formArray['desig'] = $this->input->post('desig');

				$this->crud_model->desig_add($formArray);
				$this->session->set_flashdata('success','Record adder successfully!');
  				//alert('Record adder successfully!');
				redirect(base_url().'index.php/setup_con/designation');


			}

		}


		function desig_edit($desigId)
		{
			$data = array();
			$this->load->model('crud_model');
			$this->load->library('form_validation');


		 	$this->form_validation->set_rules('name', 'desig Name', 'trim|required');
			$data['desig'] = $this->crud_model->desig_fetch();


		 	if($this->form_validation->run() == false)
			{

			$data['pr_designation'] = $this->crud_model->getdesig($desigId);

			$this->load->view('desig_edit',$data);

			}
			else
			{
				$this->crud_model->desig_edit($desigId);
				$this->session->set_flashdata('success','Record Updated successfully!');
  				//alert('Record adder successfully!');
				redirect('/setup_con/designation');


			}


		}


		function desig_delete($desigId)
		{
			$this->load->model('crud_model');
			$desig = $this->crud_model->getdesig($desigId);
			if (empty($desig)) {
				$this->session->set_flashdata('failure','Record Not Found in DataBase!');
				redirect('/setup_con/designation');
			}
			$this->crud_model->desig_delete($desigId);
			$this->session->set_flashdata('success','Record Deleted successfully!');
				redirect('/setup_con/designation');
		}




//============================================AttendanceBonus=============================================//




	function attbn_add(){

	 	$this->load->library('form_validation');
	 	// $data['attbn'] = $this->crud_model->attbn_fetch();

	 	$this->form_validation->set_rules('name', 'attbn Rule Name', 'trim|required');
	 	$this->form_validation->set_rules('amnt', 'attbn Amount', 'trim|required');


			if($this->form_validation->run() == false)
			{

			 	$this->load->view('attbn_add');
			}
			else
			{
				// print_r($_FILES['logoAAAAA']);
				// print_r($_POST);exit();
				$formArray = array();
				$formArray['name'] = $this->input->post('name');
				$formArray['amnt'] = $this->input->post('amnt');


				$this->crud_model->attbn_add($formArray);
				$this->session->set_flashdata('success','Record adder successfully!');
  				//alert('Record adder successfully!');
				redirect(base_url().'index.php/setup_con/attendance_bonus');


			}

		}


		function attbn_edit($attbnId)
		{
			$data = array();
			$this->load->model('crud_model');
			$this->load->library('form_validation');


		 	$this->form_validation->set_rules('name', 'attbn Name', 'trim|required');
	 		$this->form_validation->set_rules('amnt', 'attbn Amount', 'trim|required');

			// $data['attbn'] = $this->crud_model->attbn_fetch();


		 	if($this->form_validation->run() == false)
			{

			$data['pr_attn_bonus'] = $this->crud_model->getattbn($attbnId);
			print_r($data);

			$this->load->view('attbn_edit',$data);

			}
			else
			{
				$this->crud_model->attbn_edit($attbnId);
				$this->session->set_flashdata('success','Record Updated successfully!');

				redirect('/setup_con/attendance_bonus');


			}


		}


		function attbn_delete($attbnId)
		{
			$this->load->model('crud_model');
			$attbn = $this->crud_model->getattbn($attbnId);
			if (empty($attbn)) {
				$this->session->set_flashdata('failure','Record Not Found in DataBase!');
				redirect('/setup_con/attendance_bonus');
			}
			$this->crud_model->attbn_delete($attbnId);
			$this->session->set_flashdata('success','Record Deleted successfully!');
				redirect('/setup_con/attendance_bonus');
		}


//===========================================Salary Grade=============================================//




	function salgrd_add(){

	 	$this->load->library('form_validation');
	 	// $data['salgrd'] = $this->crud_model->salgrd_fetch();

	 	$this->form_validation->set_rules('name', 'salgrd Rule Name', 'trim|required');
	 	$this->form_validation->set_rules('bname', 'salgrd Name Bangla', 'trim|required');


			if($this->form_validation->run() == false)
			{

			 	$this->load->view('salgrd_add');
			}
			else
			{
				// print_r($_FILES['logoAAAAA']);
				// print_r($_POST);exit();
				$formArray = array();
				$formArray['name'] = $this->input->post('name');
				$formArray['bname'] = $this->input->post('bname');


				$this->crud_model->salgrd_add($formArray);
				$this->session->set_flashdata('success','Record adder successfully!');
  				//alert('Record adder successfully!');
				redirect(base_url().'index.php/setup_con/salary_grade');


			}

		}


		function salgrd_edit($salgrdId)
		{
			$data = array();
			$this->load->model('crud_model');
			$this->load->library('form_validation');


		 	$this->form_validation->set_rules('name', 'salgrd Name', 'trim|required');
	 		$this->form_validation->set_rules('bname', 'salgrd Name Bangla', 'trim|required');

			// $data['salgrd'] = $this->crud_model->salgrd_fetch();


		 	if($this->form_validation->run() == false)
			{

			$data['pr_grade'] = $this->crud_model->getsalgrd($salgrdId);
			// print_r($data);

			$this->load->view('salgrd_edit',$data);

			}
			else
			{
				$this->crud_model->salgrd_edit($salgrdId);
				$this->session->set_flashdata('success','Record Updated successfully!');

				redirect('/setup_con/salary_grade');


			}


		}


		function salgrd_delete($salgrdId)
		{
			$this->load->model('crud_model');
			$salgrd = $this->crud_model->getsalgrd($salgrdId);
			if (empty($salgrd)) {
				$this->session->set_flashdata('failure','Record Not Found in DataBase!');
				redirect('/setup_con/salary_grade');
			}
			$this->crud_model->salgrd_delete($salgrdId);
			$this->session->set_flashdata('success','Record Deleted successfully!');
				redirect('/setup_con/salary_grade');
		}



//==============================================Shift Schedule=============================================//






//=============================================Shift Management============================================//




	function shiftmanagement_add(){

	 	$this->load->library('form_validation');
	 	$this->load->model('crud_model');
	 	$data['shiftmanagementinfo'] = $this->crud_model->shiftmanagement_fetch();
	 	// print_r($data);exit();


	 	$this->form_validation->set_rules('stype', 'shiftmanagement Shift Type', 'trim|required');
	 	$this->form_validation->set_rules('stname', 'shiftmanagement In Start', 'trim|required');
	 	$this->form_validation->set_rules('unitid', 'shiftmanagement In Time', 'trim|required');




		if($this->form_validation->run() == false){
		 	$this->load->view('shiftmanagement_add',$data);
		}else{
			// print_r($_FILES['logoAAAAA']);
			// print_r($_POST);exit();
			 $formArray = array();
			 $formArray['shift_name'] = $this->input->post('stname');
             $formArray['unit_id'] = $this->input->post('unitid');
             $formArray['shift_duty'] = $this->input->post('stype');



			$this->crud_model->shiftmanagement_add($formArray);
			$this->session->set_flashdata('success','Record adder successfully!');
			redirect(base_url().'index.php/setup_con/shift_management');
		}

	}


		function shiftmanagement_edit($shiftmanagementId)
		{
			$data = array();
			$this->load->model('crud_model');
			$this->load->library('form_validation');
	 		$data['shiftmanagement'] = $this->crud_model->shiftmanagement_fetch();

			// print_r($data);

		 	$this->form_validation->set_rules('stype', 'shiftmanagement Shift Type', 'trim|required');
	 		$this->form_validation->set_rules('stname', 'shiftmanagement Shift Name', 'trim|required');
	 		$this->form_validation->set_rules('unitid', 'shiftmanagement Unit ID', 'trim|required');


			// $data['shiftmanagement'] = $this->crud_model->shiftmanagement_fetch();


		 	if($this->form_validation->run() == false)
			{

			$data['pr_emp_shift'] = $this->crud_model->getshiftmanagement($shiftmanagementId);

			$this->load->view('shiftmanagement_edit',$data);

			}
			else
			{

				$this->crud_model->shiftmanagement_edit($shiftmanagementId);
				$this->session->set_flashdata('success','Record Updated successfully!');

				redirect('/setup_con/shift_management');


			}


		}


		function shiftmanagement_delete($shiftmanagementId)
		{
			$this->load->model('crud_model');
			$shiftmanagement = $this->crud_model->getshiftmanagement($shiftmanagementId);
			if (empty($shiftmanagement)) {
				$this->session->set_flashdata('failure','Record Not Found in DataBase!');
				redirect('/setup_con/shift_management');
			}
			$this->crud_model->shiftmanagement_delete($shiftmanagementId);
			$this->session->set_flashdata('success','Record Deleted successfully!');
				redirect('/setup_con/shift_management');
		}






//=================================================Leave====================================================//


		function leave_edit($leaveId)
		{
			$data = array();
			$this->load->model('crud_model');
			$this->load->library('form_validation');
	 		// $data['leave'] = $this->crud_model->leave_fetch();

			// print_r($data);

	 		$this->form_validation->set_rules('lvname', 'leave Leave Name', 'trim|required');
	 		$this->form_validation->set_rules('stid', 'leave Status ID', 'trim|required');
	 		$this->form_validation->set_rules('sicklv', 'leave Sick Leave', 'trim|required');
	 		$this->form_validation->set_rules('cullv', 'leave Casual Leave', 'trim|required');
	 		$this->form_validation->set_rules('matrlv', 'leave Maternity Leave', 'trim|required');
	 		$this->form_validation->set_rules('patlv', 'leave Paternity Leave', 'trim|required');


			// $data['leave'] = $this->crud_model->leave_fetch();


		 	if($this->form_validation->run() == false)
			{

			$data['pr_leave'] = $this->crud_model->getleave($leaveId);

			$this->load->view('leave_edit',$data);

			}
			else
			{

				$this->crud_model->leave_edit($leaveId);
				$this->session->set_flashdata('success','Record Updated successfully!');

				redirect('/setup_con/leave_setup');


			}


		}




//============================================Bonus Rules=============================================//




	function bnruls_add(){

	 	$this->load->library('form_validation');
	 	// $data['bnruls'] = $this->crud_model->bnruls_fetch_unit();
	 	// $data['bnruls'] = $this->crud_model->bnruls_fetch_unit();
	 	$data['epmtype'] = $this->crud_model->units();
	 	$data['epmtype'] = $this->crud_model->emp_type();

	 	// print_r($data);exit('ali');

	 	// $this->form_validation->set_rules('unit', 'bnruls Unit id', 'trim|required');
	 	// $this->form_validation->set_rules('emptyp', 'bnruls Emp type', 'trim|required');
	 	$this->form_validation->set_rules('bfmnth', 'bnruls Bonus first month', 'trim|required');
	 	$this->form_validation->set_rules('bsmnth', 'bnruls Bonus second month', 'trim|required');
	 	$this->form_validation->set_rules('bamnt', 'bnruls Bonus amount', 'trim|required');
	 	$this->form_validation->set_rules('bamntf', 'bnruls Bonus amount fraction', 'trim|required');
	 	$this->form_validation->set_rules('bper', 'bnruls Bonus percent', 'trim|required');
	 	$this->form_validation->set_rules('date_out', 'bnruls Effective date', 'required');


			if($this->form_validation->run() == false)
			{

			 	$this->load->view('bnrules_add',$data);
			}
			else
			{

				$formArray = array();
				$formArray['unit_id'] = $this->input->post('unit');
				$formArray['emp_type'] = $this->input->post('emptyp');
				$formArray['bonus_first_month'] = $this->input->post('bfmnth');
				$formArray['bonus_second_month'] = $this->input->post('bsmnth');
				$formArray['bonus_amount'] = $this->input->post('bamnt');
				$formArray['bonus_amount_fraction'] = $this->input->post('bamntf');
				$formArray['bonus_percent'] = $this->input->post('bper');
				$formArray['effective_date'] = $this->input->post('date_out');


				$this->crud_model->bnruls_add($formArray);
				$this->session->set_flashdata('success','Record adder successfully!');
				redirect(base_url().'index.php/setup_con/bonus_setup');


			}

		}
	function bnruls_edit($bnrulsId){
			$data = array();
			$this->load->model('crud_model');
			$this->load->library('form_validation');
			// $data['bnruls'] = $this->crud_model->bnruls_fetch_unit();
			$data['units'] = $this->crud_model->units();
	 		$data['emp_type'] = $this->crud_model->emp_type();
	 		// print_r($data);
	 		// exit();




			// $this->form_validation->set_rules('unit', 'bnruls Unit id', 'trim|required');
		 	// $this->form_validation->set_rules('emptyp', 'bnruls Emp type', 'trim|required');
		 	$this->form_validation->set_rules('bfmnth', 'bnruls Bonus first month', 'trim|required');
		 	$this->form_validation->set_rules('bsmnth', 'bnruls Bonus second month', 'trim|required');
		 	$this->form_validation->set_rules('bamnt', 'bnruls Bonus amount', 'trim|required');
		 	$this->form_validation->set_rules('bamntf', 'bnruls Bonus amount fraction', 'trim|required');
		 	$this->form_validation->set_rules('bper', 'bnruls Bonus percent', 'trim|required');
		 	$this->form_validation->set_rules('date_out', 'bnruls Effective date', 'trim|required');

			// $data['bnruls'] = $this->crud_model->bnruls_fetch();


		 	if($this->form_validation->run() == false){
				$data['bonus_rules'] = $this->crud_model->getbnruls($bnrulsId);
				// print_r($data);exit();
				$this->load->view('bnrules_edit',$data);
			}else{
				$this->crud_model->bnruls_edit($bnrulsId);
				$this->session->set_flashdata('success','Record Updated successfully!');

				redirect('/setup_con/bonus_setup');
			}


		}


		function bnruls_delete($bnrulsId)
		{
			$this->load->model('crud_model');
			$bnruls = $this->crud_model->getbnruls($bnrulsId);
			if (empty($bnruls)) {
				$this->session->set_flashdata('failure','Record Not Found in DataBase!');
				redirect('/setup_con/bonus_setup');
			}
			$this->crud_model->bnruls_delete($bnrulsId);
			$this->session->set_flashdata('success','Record Deleted successfully!');
				redirect('/setup_con/bonus_setup');
		}



//==============================================Tax & Others===================================================//


		function taxnother_add(){

	 	$this->load->library('form_validation');
	 	$this->load->model('crud_model');
	 	$data['taxnother'] = $this->crud_model->units();

	 	$this->form_validation->set_rules('unit', 'taxnother Unit', 'trim|required');
	 	$this->form_validation->set_rules('empid', 'taxnother EMP ID', 'trim|required');
	 	$this->form_validation->set_rules('tax', 'taxnother Tax Amount', 'trim|required');
	 	$this->form_validation->set_rules('other', 'taxnother Other', 'trim|required');
	 	$this->form_validation->set_rules('date_out', 'taxnother Month', 'trim|required');


			if($this->form_validation->run() == false)
			{

			 	$this->load->view('taxnother_add',$data);
			}
			else
			{
				// print_r($_FILES['logoAAAAA']);
				// print_r($_POST);exit();
				$formArray = array();
				$formArray['unit_id'] = $this->input->post('unit');
				$formArray['emp_id'] = $this->input->post('empid');
				$formArray['tax_deduct'] = $this->input->post('tax');
				$formArray['others_deduct'] = $this->input->post('other');
				$formArray['deduct_month'] = $this->input->post('date_out');

				$this->crud_model->taxnother_add($formArray);
				$this->session->set_flashdata('success','Record adder successfully!');
  				//alert('Record adder successfully!');
				redirect(base_url().'index.php/entry_system_con/tax_others_deduction');


			}

		}



		function taxnother_delete($taxnotherId)
		{
			$this->load->model('crud_model');
			$taxnother = $this->crud_model->gettaxnother($taxnotherId);
			if (empty($taxnother)) {
				$this->session->set_flashdata('failure','Record Not Found in DataBase!');
				redirect('/entry_system_con/tax_others_deduction');
			}
			$this->crud_model->taxnother_delete($taxnotherId);
			$this->session->set_flashdata('success','Record Deleted successfully!');
				redirect('/entry_system_con/tax_others_deduction');
		}



		//========================Weekend Delete====================================//


		function weekend_delete($weekendId)
		{
			$this->load->model('crud_model');
			$weekend = $this->crud_model->getweekend($weekendId);
			if (empty($weekend)) {
				$this->session->set_flashdata('failure','Record Not Found in DataBase!');
				redirect('/entry_system_con/weekend_delete');
			}
			$this->crud_model->weekend_delete($weekendId);
			$this->session->set_flashdata('success','Record Deleted successfully!');
				redirect('/entry_system_con/weekend_delete');
		}

		//==========================Weekend Delete====================================//


		function holiday_delete($holidayId)
		{
			$this->load->model('crud_model');
			$holiday = $this->crud_model->getholiday($holidayId);
			if (empty($holiday)) {
				$this->session->set_flashdata('failure','Record Not Found in DataBase!');
				redirect('/entry_system_con/holiday_delete');
			}
			$this->crud_model->holiday_delete($holidayId);
			$this->session->set_flashdata('success','Record Deleted successfully!');
				redirect('/entry_system_con/holiday_delete');
		}

		//============================Salary Stop====================================//


		function salarystop_add(){

	 	$this->load->library('form_validation');
	 	$this->load->model('crud_model');
	 	$data['salarystop'] = $this->crud_model->units();

	 	$this->form_validation->set_rules('unit', 'salarystop Unit', 'trim|required');
	 	$this->form_validation->set_rules('empid', 'salarystop EMP ID', 'trim|required');
		$this->form_validation->set_rules('date_out', 'salarystop Salary Month', 'trim|required');


			if($this->form_validation->run() == false)
			{

			 	$this->load->view('salary_stop_add',$data);
			}
			else
			{
				// print_r($_FILES['logoAAAAA']);
				// print_r($_POST);exit();
				$formArray = array();
				$formArray['unit_id'] = $this->input->post('unit');
				$formArray['emp_id'] = $this->input->post('empid');
				$formArray['salary_month'] = $this->input->post('date_out');

				$this->crud_model->salarystop_add($formArray);
				$this->session->set_flashdata('success','Record adder successfully!');
  				//alert('Record adder successfully!');
				redirect(base_url().'index.php/entry_system_con/stop_salary');


			}

		}


		function salarystop_delete($salarystopId)
		{
			$this->load->model('crud_model');
			$salarystop = $this->crud_model->getsalarystop($salarystopId);
			if (empty($salarystop)) {
				$this->session->set_flashdata('failure','Record Not Found in DataBase!');
				redirect('/entry_system_con/stop_salary');
			}
			$this->crud_model->salarystop_delete($salarystopId);
			$this->session->set_flashdata('success','Record Deleted successfully!');
				redirect('/entry_system_con/stop_salary');
		}

		//=====================Leave Delete================================//
		function leave_delete($leaveId)
		{
			$this->load->model('crud_model');
			$leave = $this->crud_model->getleaveid($leaveId);
			if (empty($leave)) {
				$this->session->set_flashdata('failure','Record Not Found in DataBase!');
				redirect('/entry_system_con/leave_delete');
			}
			$this->crud_model->leave_delete($leaveId);
			$this->session->set_flashdata('success','Record Deleted successfully!');
				redirect('/entry_system_con/leave_delete');
		}

		//=====================Left Delete================================//
		function left_delete($leaveId)
		{
			// echo "$leaveId"; exit;
			$this->load->model('crud_model');
			$leave = $this->crud_model->getleftid($leaveId);
			if (empty($leave)) {
				$this->session->set_flashdata('failure','Record Not Found in DataBase!');
				redirect('/entry_system_con/left_delete');
			}

			if ($this->crud_model->left_delete($leave->emp_id)) {
				$this->session->set_flashdata('success','Record Deleted successfully!');
				redirect('/entry_system_con/left_delete');
			} else {
				$this->session->set_flashdata('failure','Record Not Found in DataBase!');
				redirect('/entry_system_con/left_delete');
			}
			
		}

		//===========================Proxi ID===================================//

		function proxi_edit($empId)
		{
			$data = array();
			$this->load->model('crud_model');
			$this->load->library('form_validation');


		 	$this->form_validation->set_rules('proxiId', 'Emp ID', 'trim|required');

		 	if($this->form_validation->run() == false)
			{

			$data['pr_id_proxi'] = $this->crud_model->getproxi($empId);
			// print_r($data);exit('ali');

			$this->load->view('proxi_edit',$data);

			}
			else
			{
				$this->crud_model->proxi_edit($empId);
				$this->session->set_flashdata('success','Record Updated successfully!');
  				//alert('Record adder successfully!');
				redirect('/entry_system_con/proximity_card_edit');


			}


		}





  }
  ?>
