<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin extends CI_Controller {
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
	 public function __construct()
	 {
		 parent::__construct();
		 $this->load->model('admin/Common_model');
		 $this->load->model('admin/Admin_model');
	 }
	
	
	
	public function login(){
		if($this->input->post()){
			$this->form_validation->set_rules('username', 'Username', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required',
					array('required' => 'You must provide a %s.')
			);
			if ($this->form_validation->run() == FALSE)
			{
				$this->load->view('admin/adminPages/login');
			}
			else{
				$result = $this->Admin_model->login();
				if(!empty($result))
				{
					$sess_array = array(
						 'admin_id' => $result['id'],
						 'username' => $result['username'],
						 'email' => $result['email'],   
					);
					$this->session->set_userdata('admin_details', $sess_array);
					redirect(site_url().'admin/admin/dashboard');
				}
				else
				{
					$this->session->set_flashdata('error', ' Invalid Login Details, Please Try Again!');
					redirect( site_url() . "admin"); 
				}
				 
			}
		}
		else{  
			$this->load->view('frontend/include/header.php');
			$this->load->view('frontend/user/login');
			$this->load->view('frontend/include/footer.php');
		}
	}
	
	public function dashboard(){
		if(!$this->session->userdata('admin_details'))
		{
			redirect(site_url('admin'));
			exit;
		}
		if(!$this->session->userdata('language')){
			$this->session->set_userdata('language', 'en');
		}
		$data['active'] = 'dashboard';
		$data['title']  = 'Dashboard';
		$admin_details = $this->session->userdata('admin_details');
		$data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);
		$data['countService'] = $this->db->get_where('services')->num_rows();
		$data['countProduct'] = $this->db->get_where('product')->num_rows();
		$data['countUserDetails'] = $this->db->get_where('userDetails')->num_rows();
		$this->load->view('admin/includes/header',$data);
		$this->load->view('admin/adminPages/dashboard');
		$this->load->view('admin/includes/footer');
	}
	
	public function profile(){
		if(!$this->session->userdata('admin_details'))
		{
			redirect(site_url('admin'));
			exit;
		}
		$admin_details = $this->session->userdata('admin_details');
		$data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);
		if($this->input->post()){
			$this->form_validation->set_rules('username', 'Username', 'required');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
			$this->form_validation->set_rules('phone', 'Phone', 'required');
			$this->form_validation->set_rules('address', 'Address', 'required');
			if ($this->form_validation->run() == FALSE)
			{
				$this->load->view('admin/includes/header',$data);
				$this->load->view('admin/adminPages/profile');
				$this->load->view('admin/includes/footer');
			}
			else{
				if(!empty($_FILES["image"]["name"])){
					$name= time().'_'.$_FILES["image"]["name"];
					$liciense_tmp_name=$_FILES["image"]["tmp_name"];
					$error=$_FILES["image"]["error"];
					$liciense_path='uploads/admin/'.$name;
					move_uploaded_file($liciense_tmp_name,$liciense_path);
					$details['image']=base_url().$liciense_path;
				}
				$details['username'] = $this->input->post('username');
				$details['email'] = $this->input->post('email');
				$details['phone'] = $this->input->post('phone');
				$details['address'] = $this->input->post('address');
				$details['updated'] = date('y-m-d h:i:s');
				$update = $this->Common_model->update('admin',$details,'id',$admin_details['admin_id']);
				if($update){
					$this->session->set_flashdata('message', 'Admin Profile Update Successfully.');
					redirect(site_url().'admin/admin/profile');
				}
			}
		}
		else{	
			$this->load->view('admin/includes/header',$data);
			$this->load->view('admin/adminPages/profile');
			$this->load->view('admin/includes/footer');
		}
	}
	
	public function changePassword(){
		if(!$this->session->userdata('admin_details')){
			redirect(site_url('admin'));
			exit;
		}
		$admin_details = $this->session->userdata('admin_details');
		$data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);
		$admin_name = $admin_details['username'];
		$user_id = $admin_details['admin_id'];
		if($this->input->post()){
			$this->form_validation->set_rules('old_password', 'Old Password', 'required');
			$this->form_validation->set_rules('new_password', 'New Password', 'required');
			$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[new_password]');
			if ($this->form_validation->run() == FALSE)
			{
				$this->load->view('admin/includes/header',$data);
				$this->load->view('admin/adminPages/changePassword');
				$this->load->view('admin/includes/footer');
			}
			else{
				$old_password=$this->input->post('old_password');
				$new_password=$this->input->post('new_password');

				$admin_info=$this->Admin_model->chngpass($admin_name,$old_password,$user_id);
				if(empty($admin_info)){
					$this->session->set_flashdata("error", "Old Password Does't Match"); 
					redirect( site_url() . "admin/admin/changePassword" );
				}
				else{	 
					$result=$this->Admin_model->chng_pass($admin_name,$new_password);
				
					if ($result) {
						$this->session->set_flashdata("message", "Password Change Successfully"); 
					}else {
						$this->session->set_flashdata("error", "Password Can't Change "); 
					}		
					redirect( site_url() . "admin/admin/changePassword" );
				}
			}
		}
		else{
			$this->load->view('admin/includes/header',$data);
			$this->load->view('admin/adminPages/changePassword');
			$this->load->view('admin/includes/footer');
		}
	}
	
	public function changeLanguage(){
		if($this->uri->segment(4) == 'en'){
			$this->session->set_userdata('language', 'en');
			redirect( site_url() . "admin/admin/dashboard"); 
		}
		else{
			$this->session->set_userdata('language', 'fr');
			redirect( site_url() . "admin/admin/dashboard"); 
		}
	}
	
	public function logout()
	{
		$this->session->sess_destroy();
		redirect( site_url() . "admin"); 
	}
}