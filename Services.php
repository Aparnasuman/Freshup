<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Services extends CI_Controller {
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
		$data['datas'] = $this->Common_model->get_data('services');
		$admin_details = $this->session->userdata('admin_details');
		$data['active'] = 'services';
		if($this->session->userdata('language') == 'en'){
			$data['title']  = 'Manage Services';
		}
		else{
			$data['title']  = 'gérer les services';
		}
		$data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);
		$this->load->view('admin/includes/header',$data);
		$this->load->view('admin/services/manageServices');
		$this->load->view('admin/includes/footer');
	}
	
	public function InsertServices(){
		$data['active'] = 'services';
		if($this->session->userdata('language') == 'en'){
			$data['title']  = 'Add Services';
		}
		else{
			$data['title']  = 'Ajouter un service';
		}
		$admin_details = $this->session->userdata('admin_details');
		$data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);
		if($this->input->post()){
			$this->form_validation->set_rules('title', 'Title', 'required');
			$this->form_validation->set_rules('frenchTitle', 'Title', 'required');
			if ($this->form_validation->run() == FALSE)
			{
				$this->load->view('admin/includes/header',$data);
				$this->load->view('admin/services/insertServices');
				$this->load->view('admin/includes/footer');
			}
			else{
				$details['title'] = $this->input->post('title');
				$details['frenchTitle'] = $this->input->post('frenchTitle');
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
				$insert = $this->Common_model->insert_data($details,'services');
				if($insert){
					$this->session->set_flashdata('success', 'Services Insert Successfully');
					redirect(site_url().'admin/Services');
				}
			}
		}
		else{
			$this->load->view('admin/includes/header',$data);
			$this->load->view('admin/services/insertServices');
			$this->load->view('admin/includes/footer');
		}
	}
	
	public function UpdateServices(){
		$data['active'] = 'services';
		if($this->session->userdata('language') == 'en'){
			$data['title']  = 'Update Services';
		}
		else{
			$data['title']  = 'Services de mise à jour';
		}
		$admin_details = $this->session->userdata('admin_details');
		$data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);
		if($this->input->post()){
			$this->form_validation->set_rules('title', 'Title', 'required');
			$this->form_validation->set_rules('frenchTitle', 'Title', 'required');
			if ($this->form_validation->run() == FALSE)
			{
				$data['details'] = $this->Common_model->get_data_by_id('services','id',$this->uri->segment(4));
				$this->load->view('admin/includes/header',$data);
				$this->load->view('admin/services/updateServices');
				$this->load->view('admin/includes/footer');
			}
			else{
				$details['title'] = $this->input->post('title');
				$details['frenchTitle'] = $this->input->post('frenchTitle');
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
				$update = $this->Common_model->update('services',$details,'id',$this->input->post('id'));
				if($update){
					$this->session->set_flashdata('success', 'Services Update Successfully');
					redirect(site_url().'admin/Services');
				}
			}
		}
		else{
			$data['details'] = $this->Common_model->get_data_by_id('services','id',$this->uri->segment(4));
			$this->load->view('admin/includes/header',$data);
			$this->load->view('admin/services/updateServices');
			$this->load->view('admin/includes/footer');
		}
	}
	
	public function DeleteServices($id){
		$delete = $this->Common_model->delete('services','id',$id);
		if($delete){
			 $this->session->set_flashdata('success', 'Services Delete Successfully.');
		}
		redirect(site_url().'admin/Services');
	}
	
	
	
	public function subServices(){
		$data['datas'] = $this->Common_model->getSubService();
		$admin_details = $this->session->userdata('admin_details');
		$data['active'] = 'subServices';
		if($this->session->userdata('language') == 'en'){
			$data['title']  = 'Manage Category';
		}
		else{
			$data['title']  = 'Gérer la catégorie';
		}
		$data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);
		$this->load->view('admin/includes/header',$data);
		$this->load->view('admin/services/manageSubServices');
		$this->load->view('admin/includes/footer');
	}
	
	public function InsertSubServices(){
		$data['active'] = 'subServices';
		if($this->session->userdata('language') == 'en'){
			$data['title']  = 'Add Category';
		}
		else{
			$data['title']  = 'ajouter une catégorie';
		}
		$admin_details = $this->session->userdata('admin_details');
		$data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);
		if($this->input->post()){
			$this->form_validation->set_rules('title', 'Title', 'required');
			$this->form_validation->set_rules('frenchTitle', 'Title', 'required');
			if ($this->form_validation->run() == FALSE)
			{
				$data['serviceData'] = $this->Common_model->get_data('services');
				$this->load->view('admin/includes/header',$data);
				$this->load->view('admin/services/insertSubServices');
				$this->load->view('admin/includes/footer');
			}
			else{
				$details['title'] = $this->input->post('title');
				$details['frenchTitle'] = $this->input->post('frenchTitle');
				$details['serviceId'] = $this->input->post('serviceId');
				$insert = $this->Common_model->insert_data($details,'subServices');
				if($insert){
					$this->session->set_flashdata('success', 'Category Insert Successfully');
					redirect(site_url().'admin/Services/subServices');
				}
			}
		}
		else{
			$data['serviceData'] = $this->Common_model->get_data('services');
			$this->load->view('admin/includes/header',$data);
			$this->load->view('admin/services/insertSubServices');
			$this->load->view('admin/includes/footer');
		}
	}
	
	public function DeleteSubServices($id){
		$delete = $this->Common_model->delete('subServices','id',$id);
		if($delete){
			 $this->session->set_flashdata('success', 'Category Delete Successfully.');
		}
		redirect(site_url().'admin/Services/subServices');
	}
	
	public function UpdateSubServices(){
		$data['active'] = 'subServices';
		if($this->session->userdata('language') == 'en'){
			$data['title']  = 'Update Category';
		}
		else{
			$data['title']  = 'Mettre à jour la catégorie';
		}
		$admin_details = $this->session->userdata('admin_details');
		$data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);
		if($this->input->post()){
			$this->form_validation->set_rules('title', 'Title', 'required');
			$this->form_validation->set_rules('frenchTitle', 'Title', 'required');
			if ($this->form_validation->run() == FALSE)
			{
				$data['serviceData'] = $this->Common_model->get_data('services');
				$data['details'] = $this->Common_model->get_data_by_id('subServices','id',$this->uri->segment(4));
				$this->load->view('admin/includes/header',$data);
				$this->load->view('admin/services/updateSubService');
				$this->load->view('admin/includes/footer');
			}
			else{
				$details['title'] = $this->input->post('title');
				$details['frenchTitle'] = $this->input->post('frenchTitle');
				$details['serviceId'] = $this->input->post('serviceId');
				$update = $this->Common_model->update('subServices',$details,'id',$this->input->post('id'));
				if($update){
					$this->session->set_flashdata('success', 'Category Update Successfully');
					redirect(site_url().'admin/Services/subServices');
				}
			}
		}
		else{
			$data['serviceData'] = $this->Common_model->get_data('services');
			$data['details'] = $this->Common_model->get_data_by_id('subServices','id',$this->uri->segment(4));
			$this->load->view('admin/includes/header',$data);
			$this->load->view('admin/services/updateSubService');
			$this->load->view('admin/includes/footer');
		}
	}
	
	public function subSubServices(){
		$data['datas'] = $this->Common_model->getSubSubService();
		$admin_details = $this->session->userdata('admin_details');
		$data['active'] = 'subSubServices';
		if($this->session->userdata('language') == 'en'){
			$data['title']  = 'Manage Sub Category';
		}
		else{
			$data['title']  = 'Gérer la sous catégorie';
		}
		$data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);
		$this->load->view('admin/includes/header',$data);
		$this->load->view('admin/services/manageSubSubServices');
		$this->load->view('admin/includes/footer');
	}
	
	public function InsertSubSubServices(){
		$data['active'] = 'subSubServices';
		if($this->session->userdata('language') == 'en'){
			$data['title']  = 'Add Sub Category';
		}
		else{
			$data['title']  = 'Ajouter une sous catégorie';
		}
		$admin_details = $this->session->userdata('admin_details');
		$data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);
		if($this->input->post()){
			$this->form_validation->set_rules('title', 'Title', 'required');
			$this->form_validation->set_rules('frenchTitle', 'Title', 'required');
			$this->form_validation->set_rules('price', 'Price', 'required');
			if ($this->form_validation->run() == FALSE)
			{
				$data['serviceData'] = $this->Common_model->get_data('services');
				$this->load->view('admin/includes/header',$data);
				$this->load->view('admin/services/insertSubSubServices');
				$this->load->view('admin/includes/footer');
			}
			else{
				$details['title'] = $this->input->post('title');
				$details['frenchTitle'] = $this->input->post('frenchTitle');
				$details['price'] = $this->input->post('price');
				$details['serviceId'] = $this->input->post('serviceId');
				$details['subServiceId'] = $this->input->post('subServiceId');
				$insert = $this->Common_model->insert_data($details,'subSubServices');
				if($insert){
					$this->session->set_flashdata('success', 'Sub Category Insert Successfully');
					redirect(site_url().'admin/Services/subSubServices');
				}
			}
		}
		else{
			$data['serviceData'] = $this->Common_model->get_data('services');
			$this->load->view('admin/includes/header',$data);
			$this->load->view('admin/services/insertSubSubServices');
			$this->load->view('admin/includes/footer');
		}
	}
	
	public function UpdateSubSubServices(){
		$data['active'] = 'subSubServices';
		if($this->session->userdata('language') == 'en'){
			$data['title']  = 'Update Sub Category';
		}
		else{
			$data['title']  = 'Mettre à jour la sous catégorie';
		}
		$admin_details = $this->session->userdata('admin_details');
		$data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);
		if($this->input->post()){
			$this->form_validation->set_rules('title', 'Title', 'required');
			$this->form_validation->set_rules('frenchTitle', 'Title', 'required');
			$this->form_validation->set_rules('price', 'Price', 'required');
			if ($this->form_validation->run() == FALSE)
			{
				$data['serviceData'] = $this->Common_model->get_data('services');
				$data['details'] = $this->Common_model->get_data_by_id('subSubServices','id',$this->uri->segment(4));
				$data['subServiceData'] = $this->db->get_where('subServices',array('serviceId' => $data['details']['serviceId']))->result_array();
				$this->load->view('admin/includes/header',$data);
				$this->load->view('admin/services/updateSubSubServices');
				$this->load->view('admin/includes/footer');
			}
			else{
				$details['title'] = $this->input->post('title');
				$details['frenchTitle'] = $this->input->post('frenchTitle');
				$details['price'] = $this->input->post('price');
				$details['serviceId'] = $this->input->post('serviceId');
				$details['subServiceId'] = $this->input->post('subServiceId');
				$update = $this->Common_model->update('subSubServices',$details,'id',$this->input->post('id'));
				if($update){
					$this->session->set_flashdata('success', 'Sub Category Update Successfully');
					redirect(site_url().'admin/Services/subSubServices');
				}
			}
		}
		else{
			$data['serviceData'] = $this->Common_model->get_data('services');
			$data['details'] = $this->Common_model->get_data_by_id('subSubServices','id',$this->uri->segment(4));
			$data['subServiceData'] = $this->db->get_where('subServices',array('serviceId' => $data['details']['serviceId']))->result_array();
			$this->load->view('admin/includes/header',$data);
			$this->load->view('admin/services/updateSubSubServices');
			$this->load->view('admin/includes/footer');
		}
	}
	
	public function getCategory(){
		$data['subServicesDetails'] = $this->db->get_where('subServices',array('serviceId' => $this->input->post('serviceId')))->result_array();
		$this->load->view('admin/services/subServiceTemplate',$data);
	}
	
	public function DeleteSubSubServices($id){
		$delete = $this->Common_model->delete('subSubServices','id',$id);
		if($delete){
			 $this->session->set_flashdata('success', 'Sub Category Delete Successfully.');
		}
		redirect(site_url().'admin/Services/subSubServices');
	}
	
	
	
}