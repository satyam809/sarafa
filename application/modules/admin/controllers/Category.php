<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends Admin_Controller {

	public function __construct() {
		
		parent::__construct();
		$this->load->library(array('session','form_validation','pagination','mylibrary'));
		$this->load->model('common_model');
		$this->load->model('category_model','model');
	}

	/*---------------------------- view data index -----------------------*/
	public function index()
	{
		$allcount = $this->model->records_count();
		$data['total_rows'] = $allcount;

		$query = $this->db->where('chr_delete', 'N')->where('home_display','N')->get('mst_category');
		$data['total_data'] = $query->num_rows();

		$data['data'] = $this->model->getData(0,10);
		
		// Pagination Configuration
		$config['base_url'] = base_url() . 'category/loadData/';
		$config['use_page_numbers'] = TRUE;
		$config['total_rows'] = $allcount;
		$config['per_page'] = 10;

        // Initialize
		$this->pagination->initialize($config);

        // Initialize $data Array
		$data['pagination'] = $this->pagination->create_links();
		$data['row'] = 0;

		$this->load_view('category/view_cate',$data);

	}

	/*---------------------------- Load view data -----------------------*/
	public function loadData($rowno=0) { 

		$search = $_GET['append'];           
		$_field = $_GET['field'];           
		$_sort = $_GET['sort'];           
           // Row per page
		$rowperpage = $_GET['entries'];

        // Row position
		if($rowno != 0){
			$rowno = ($rowno-1) * $rowperpage;
		}

        // All records count
		$allcount = $this->model->records_count($search);

		$data['total_rows'] = $allcount;

		$query = $this->db->where('chr_delete', 'N')->where('home_display','N')->get('mst_category');
		$data['total_data'] = $query->num_rows();
        // Get records
		$users_record = $this->model->getData($rowno,$rowperpage,$search,$_field,$_sort);

        // Pagination Configuration
		$config['base_url'] = base_url() . 'category/loadData/';
		$config['use_page_numbers'] = TRUE;
		$config['total_rows'] = $allcount;
		$config['per_page'] = $rowperpage;

        // Initialize
		$this->pagination->initialize($config);

        // Initialize $data Array
		$data['pagination'] = $this->pagination->create_links();
		$data['result'] = $users_record;
		$data['row'] = $rowno;

		echo json_encode($data);

	}

	/*------------------ add view record ----------------------*/ 
	public function add_category()
	{
		$data['parent_cate'] = $this->model->getParentCategory();
		$this->load_view('category/add_cate',$data);
	}

	/*------------------ add record in DB ----------------------*/ 
	public function insert_record()
	{
		// validation not ok, send validation errors to the view
		// Set flash data 
		$this->model->addRecord();
		$this->session->set_flashdata('Invalid', ADD_SUCCESS);
		redirect('admin/category');
	
	}

	/*------------------ edit view record ----------------------*/ 
	public function editCategory($categoryId)
	{
		$categoryId=base64_decode($categoryId);
		//echo $categoryId; exit();
		$data['data'] = $this->model->getIdByData($categoryId);
		$data['parent_cate'] = $this->model->getParentCategory();
		$this->load_view('category/edit_cate',$data);
	}

	/*------------------ edit record in DB ----------------------*/ 
	public function update_category($id)
	{
		if (isset($_POST['submit'])) {
			$this->model->updateRecord($id);
			$this->session->set_flashdata('Invalid', EDIT_SUCCESS);
			redirect('admin/category');
		} else {
			redirect('admin/category');
		}
	}

	/*----------------------- update publish  ----------------------*/ 
	public function UpdatePublish() 
	{
		$this->model->updatedisplay();
	}

	/*----------------------- delete multiple record  ----------------------*/ 
	public function delete_multiple() 
	{
		//$this->model->delMultiplePlan();
		$result = $this->model->delete_multiple();
		echo $result;
	}

}                                         