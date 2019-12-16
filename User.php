<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		//$headers = apache_request_headers();
	   $this->load->model('api/Common_Model');
	   $this->load->model('api/User_model');
	    $this->load->model('admin/Common_model');
		 $this->load->model('admin/Admin_model');
	   $this->load->helper('date');
	   date_default_timezone_set("Asia/Calcutta");
	   if(!$this->session->userdata('admin_details'))
		{
			redirect(site_url('admin'));
			exit;
		}

	}

	public function index(){
		$data['datas'] = $this->db->get('userDetails')->result_array();
		$admin_details = $this->session->userdata('admin_details');
		$data['active'] = 'userDetails';
		if($this->session->userdata('language') == 'en'){
			$data['title']  = 'Manage Users';
		}
		else{
			$data['title'] = "détail de l'utilisateur";
		}
		$data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);
		$this->load->view('admin/includes/header',$data);
		$this->load->view('admin/userDetails/manageUserDetails');
		$this->load->view('admin/includes/footer');
		
	}
	
	
	public function ResetPassword(){
		if($this->input->post()){
			$this->form_validation->set_rules('new_password', 'New password', 'required|min_length[6]');
			$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[new_password]');
			if ($this->form_validation->run() == FALSE){
				$this->load->view('template/resetPassword');
			}
			else{
				$datas['password'] = md5($this->input->post('new_password'));
				$update = $this->Common_Model->update('userDetails',$datas,'id',$this->input->post('id'));
				if($update){
					$this->session->set_flashdata('success', 'Password Updated Successfully');
					redirect(site_url().'admin/user/ResetPassword/'.$this->input->post('id'));
				}
				else{
					$this->session->set_flashdata('error', 'Some error occurred');
					redirect(site_url().'admin/user/ResetPassword/'.$this->input->post('id'));
				}
			}
		}
		else{
			$this->load->view('template/resetPassword');
		}
	}
	
}