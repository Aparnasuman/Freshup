<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Product extends CI_Controller {
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct(){
		 parent::__construct();
		 $this->load->model('admin/Common_model');
		 $this->load->model('admin/Admin_model');
		 if(!$this->session->userdata('admin_details'))
		{
			redirect(site_url('admin'));
			exit;
		}
	}
	
	public function index(){
		$data['datas'] = $this->Common_model->getProductListing();
		$admin_details = $this->session->userdata('admin_details');
		$data['active'] = 'product';
		$data['title']  = 'Manage Product';
		$data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);
		$this->load->view('admin/includes/header',$data);
		$this->load->view('admin/product/manageProduct');
		$this->load->view('admin/includes/footer');
	}
	
	public function InsertProduct(){
		$data['active'] = 'product';
		$data['title']  = 'Add Product';
		$admin_details = $this->session->userdata('admin_details');
		$data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);
		if($this->input->post()){
			$this->form_validation->set_rules('title', 'Title', 'required');
			$this->form_validation->set_rules('price', 'Price', 'required');
			$this->form_validation->set_rules('categoryId', 'Category', 'required');
			$this->form_validation->set_rules('subCategoryId', 'Sub Category', 'required');
			if ($this->form_validation->run() == FALSE)
			{
				$data['categoryDetails'] = $this->Common_model->get_data('productCategory');
				$this->load->view('admin/includes/header',$data);
				$this->load->view('admin/product/insertProduct');
				$this->load->view('admin/includes/footer');
			}
			else{
				$details['title'] = $this->input->post('title');
				$details['price'] = $this->input->post('price');
				$details['description'] = $this->input->post('description');
				$details['categoryId'] = $this->input->post('categoryId');
				$details['subCategoryId'] = $this->input->post('subCategoryId');
				foreach($_FILES["productImage"]["name"] as $key => $image_name){
					if(!empty($image_name)){
						$image_names= time().'_'.$image_name;
						$liciense_tmp_name=$_FILES["productImage"]["tmp_name"][$key];
						$error=$_FILES["productImage"]["error"][$key];
						$liciense_path='uploads/service/'.$image_names;
						move_uploaded_file($liciense_tmp_name,$liciense_path);
						$images[] = base_url().$liciense_path;
					}
				}
				$details['productImage'] = implode(',',$images);
				/*if(!empty($_FILES["productImage"]["name"])){
					$name= time().'_'.$_FILES["productImage"]["name"];
					$liciense_tmp_name=$_FILES["productImage"]["tmp_name"];
					$error=$_FILES["productImage"]["error"];
					$liciense_path='uploads/service/'.$name;
					move_uploaded_file($liciense_tmp_name,$liciense_path);
					$details['productImage']=base_url(). $liciense_path;
				}*/
				$insert = $this->Common_model->insert_data($details,'product');
				if($insert){
					$this->session->set_flashdata('success', 'Product Insert Successfully');
					redirect(site_url().'admin/Product');
				}
			}
		}
		else{
			$data['categoryDetails'] = $this->Common_model->get_data('productCategory');
			$this->load->view('admin/includes/header',$data);
			$this->load->view('admin/product/insertProduct');
			$this->load->view('admin/includes/footer');
		}
	}
	
	public function UpdateProduct(){
		$data['active'] = 'product';
		$data['title']  = 'Update Product';
		$admin_details = $this->session->userdata('admin_details');
		$data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);
		if($this->input->post()){
			$this->form_validation->set_rules('title', 'Title', 'required');
			$this->form_validation->set_rules('price', 'Price', 'required');
			$this->form_validation->set_rules('categoryId', 'Category', 'required');
			$this->form_validation->set_rules('subCategoryId', 'Sub Category', 'required');
			if ($this->form_validation->run() == FALSE)
			{
				$data['categoryDetails'] = $this->Common_model->get_data('productCategory');
				$data['details'] = $this->Common_model->get_data_by_id('product','id',$this->uri->segment(4));
				$data['subCategory'] = $this->db->get_where('productSubCategory',array('categoryId' => $data['details']['categoryId']))->result_array();
				$this->load->view('admin/includes/header',$data);
				$this->load->view('admin/product/updateProduct');
				$this->load->view('admin/includes/footer');
			}
			else{
				$details['title'] = $this->input->post('title');
				$details['price'] = $this->input->post('price');
				$details['description'] = $this->input->post('description');
				$details['categoryId'] = $this->input->post('categoryId');
				$details['subCategoryId'] = $this->input->post('subCategoryId');
				if(!empty($_FILES["productImage"]["name"])){
					$name= time().'_'.$_FILES["productImage"]["name"];
					$liciense_tmp_name=$_FILES["productImage"]["tmp_name"];
					$error=$_FILES["productImage"]["error"];
					$liciense_path='uploads/service/'.$name;
					move_uploaded_file($liciense_tmp_name,$liciense_path);
					$details['productImage']=base_url(). $liciense_path;
				}
				$update = $this->Common_model->update('product',$details,'id',$this->input->post('id'));
				if($update){
					$this->session->set_flashdata('success', 'Product Update Successfully');
					redirect(site_url().'admin/Product');
				}
			}
		}
		else{
			$data['categoryDetails'] = $this->Common_model->get_data('productCategory');
			$data['details'] = $this->Common_model->get_data_by_id('product','id',$this->uri->segment(4));
			$data['subCategory'] = $this->db->get_where('productSubCategory',array('categoryId' => $data['details']['categoryId']))->result_array();
			$this->load->view('admin/includes/header',$data);
			$this->load->view('admin/product/updateProduct');
			$this->load->view('admin/includes/footer');
		}
	}
	
	public function DeleteProduct($id){
		$delete = $this->Common_model->delete('product','id',$id);
		if($delete){
			 $this->session->set_flashdata('success', 'Product Delete Successfully.');
		}
		redirect(site_url().'admin/Product');
	}
	
	public function productCategory(){
		$data['datas'] = $this->Common_model->get_data('productCategory');
		$admin_details = $this->session->userdata('admin_details');
		$data['active'] = 'productCategory';
		$data['title']  = 'Manage Category';
		$data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);
		$this->load->view('admin/includes/header',$data);
		$this->load->view('admin/product/manageProductCategory');
		$this->load->view('admin/includes/footer');
	}
	
	public function InsertProductCategory(){
		$data['active'] = 'productCategory';
		$data['title']  = 'Add Category';
		$admin_details = $this->session->userdata('admin_details');
		$data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);
		if($this->input->post()){
			$this->form_validation->set_rules('title', 'Title', 'required');
			if ($this->form_validation->run() == FALSE)
			{
				$this->load->view('admin/includes/header',$data);
				$this->load->view('admin/product/insertProductCategory');
				$this->load->view('admin/includes/footer');
			}
			else{
				$details['title'] = $this->input->post('title');
				if(!empty($_FILES["image1"]["name"])){
					$name= time().'_'.$_FILES["image1"]["name"];
					$liciense_tmp_name=$_FILES["image1"]["tmp_name"];
					$error=$_FILES["image1"]["error"];
					$liciense_path='uploads/service/'.$name;
					move_uploaded_file($liciense_tmp_name,$liciense_path);
					$details['image1']=base_url(). $liciense_path;
				}
				if(!empty($_FILES["image2"]["name"])){
					$name= time().'_'.$_FILES["image2"]["name"];
					$liciense_tmp_name=$_FILES["image2"]["tmp_name"];
					$error=$_FILES["image2"]["error"];
					$liciense_path='uploads/service/'.$name;
					move_uploaded_file($liciense_tmp_name,$liciense_path);
					$details['image2']=base_url(). $liciense_path;
				}
				$insert = $this->Common_model->insert_data($details,'productCategory');
				if($insert){
					$this->session->set_flashdata('success', 'Category Insert Successfully');
					redirect(site_url().'admin/Product/productCategory');
				}
			}
		}
		else{
			$this->load->view('admin/includes/header',$data);
			$this->load->view('admin/product/insertProductCategory');
			$this->load->view('admin/includes/footer');
		}
	}
	
	public function DeleteProductCategory($id){
		$delete = $this->Common_model->delete('productCategory','id',$id);
		if($delete){
			 $this->session->set_flashdata('success', 'Category Delete Successfully.');
		}
		redirect(site_url().'admin/Product/productCategory');
	}
	
	public function UpdateProductCategory(){
		$data['active'] = 'productCategory';
		$data['title']  = 'Update Category';
		$admin_details = $this->session->userdata('admin_details');
		$data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);
		if($this->input->post()){
			$this->form_validation->set_rules('title', 'Title', 'required');
			if ($this->form_validation->run() == FALSE)
			{
				$data['details'] = $this->Common_model->get_data_by_id('productCategory','id',$this->uri->segment(4));
				$this->load->view('admin/includes/header',$data);
				$this->load->view('admin/product/updateProductCategory');
				$this->load->view('admin/includes/footer');
			}
			else{
				$details['title'] = $this->input->post('title');
				if(!empty($_FILES["image1"]["name"])){
					$name= time().'_'.$_FILES["image1"]["name"];
					$liciense_tmp_name=$_FILES["image1"]["tmp_name"];
					$error=$_FILES["image1"]["error"];
					$liciense_path='uploads/service/'.$name;
					move_uploaded_file($liciense_tmp_name,$liciense_path);
					$details['image1']=base_url(). $liciense_path;
				}
				if(!empty($_FILES["image2"]["name"])){
					$name= time().'_'.$_FILES["image2"]["name"];
					$liciense_tmp_name=$_FILES["image2"]["tmp_name"];
					$error=$_FILES["image2"]["error"];
					$liciense_path='uploads/service/'.$name;
					move_uploaded_file($liciense_tmp_name,$liciense_path);
					$details['image2']=base_url(). $liciense_path;
				}
				$update = $this->Common_model->update('productCategory',$details,'id',$this->input->post('id'));
				if($update){
					$this->session->set_flashdata('success', 'Category Update Successfully');
					redirect(site_url().'admin/Product/productCategory');
				}
			}
		}
		else{
			$data['details'] = $this->Common_model->get_data_by_id('productCategory','id',$this->uri->segment(4));
			$this->load->view('admin/includes/header',$data);
			$this->load->view('admin/product/updateProductCategory');
			$this->load->view('admin/includes/footer');
		}
	}
	
	public function productSubCategory(){
		$data['datas'] = $this->Common_model->getSubProductCategory();
		$admin_details = $this->session->userdata('admin_details');
		$data['active'] = 'productSubCategory';
		$data['title']  = 'Manage Sub Category';
		$data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);
		$this->load->view('admin/includes/header',$data);
		$this->load->view('admin/product/manageProductSubCategory');
		$this->load->view('admin/includes/footer');
	}
	
	public function InsertProductSubCategory(){
		$data['active'] = 'productSubCategory';
		$data['title']  = 'Add Sub Category';
		$admin_details = $this->session->userdata('admin_details');
		$data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);
		if($this->input->post()){
			$this->form_validation->set_rules('title', 'Title', 'required');
			if ($this->form_validation->run() == FALSE)
			{
				$data['categoryDetails'] = $this->Common_model->get_data('productCategory');
				$this->load->view('admin/includes/header',$data);
				$this->load->view('admin/product/insertProductSubCategory');
				$this->load->view('admin/includes/footer');
			}
			else{
				$details['title'] = $this->input->post('title');
				$details['categoryId'] = $this->input->post('categoryId');
				if(!empty($_FILES["image"]["name"])){
					$name= time().'_'.$_FILES["image"]["name"];
					$liciense_tmp_name=$_FILES["image"]["tmp_name"];
					$error=$_FILES["image"]["error"];
					$liciense_path='uploads/service/'.$name;
					move_uploaded_file($liciense_tmp_name,$liciense_path);
					$details['image']=base_url(). $liciense_path;
				}
				$insert = $this->Common_model->insert_data($details,'productSubCategory');
				if($insert){
					$this->session->set_flashdata('success', 'Sub Category Insert Successfully');
					redirect(site_url().'admin/Product/productSubCategory');
				}
			}
		}
		else{
			$data['categoryDetails'] = $this->Common_model->get_data('productCategory');
			$this->load->view('admin/includes/header',$data);
			$this->load->view('admin/product/insertProductSubCategory');
			$this->load->view('admin/includes/footer');
		}
	}
	
	public function DeleteProductSubCategory($id){
		$delete = $this->Common_model->delete('productSubCategory','id',$id);
		if($delete){
			 $this->session->set_flashdata('success', 'Sub Category Delete Successfully.');
		}
		redirect(site_url().'admin/Product/productSubCategory');
	}
	
	public function UpdateProductSubCategory(){
		$data['active'] = 'productSubCategory';
		$data['title']  = 'Update Sub Category';
		$admin_details = $this->session->userdata('admin_details');
		$data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);
		if($this->input->post()){
			$this->form_validation->set_rules('title', 'Title', 'required');
			if ($this->form_validation->run() == FALSE)
			{
				$data['details'] = $this->Common_model->get_data_by_id('productSubCategory','id',$this->uri->segment(4));
				$data['categoryDetails'] = $this->Common_model->get_data('productCategory');
				$this->load->view('admin/includes/header',$data);
				$this->load->view('admin/product/updateProductSubCategory');
				$this->load->view('admin/includes/footer');
			}
			else{
				$details['title'] = $this->input->post('title');
				$details['categoryId'] = $this->input->post('categoryId');
				if(!empty($_FILES["image"]["name"])){
					$name= time().'_'.$_FILES["image"]["name"];
					$liciense_tmp_name=$_FILES["image"]["tmp_name"];
					$error=$_FILES["image"]["error"];
					$liciense_path='uploads/service/'.$name;
					move_uploaded_file($liciense_tmp_name,$liciense_path);
					$details['image']=base_url(). $liciense_path;
				}
				$update = $this->Common_model->update('productSubCategory',$details,'id',$this->input->post('id'));
				if($update){
					$this->session->set_flashdata('success', 'Sub Category Updated Successfully');
					redirect(site_url().'admin/Product/productSubCategory');
				}
			}
		}
		else{
			$data['details'] = $this->Common_model->get_data_by_id('productSubCategory','id',$this->uri->segment(4));
			$data['categoryDetails'] = $this->Common_model->get_data('productCategory');
			$this->load->view('admin/includes/header',$data);
			$this->load->view('admin/product/updateProductSubCategory');
			$this->load->view('admin/includes/footer');
		}
	}
	
	public function getSubCategory(){
		$data['subCategory'] = $this->db->get_where('productSubCategory',array('categoryId' => $this->input->post('categoryId')))->result_array();
		$this->load->view('admin/product/subCategoryTemplate',$data);
	}
	
	
	
	
	
}