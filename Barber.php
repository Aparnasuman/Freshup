<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Barber extends CI_Controller {
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
		$data['datas'] = $this->Common_model->get_data('barber');
		$admin_details = $this->session->userdata('admin_details');
		$data['active'] = 'barber';
		$data['title']  = 'Manage Barber';
		$data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);
		$this->load->view('admin/includes/header',$data);
		$this->load->view('admin/barber/manageBarber');
		$this->load->view('admin/includes/footer');
	}
	
	public function Insertbarber(){
		$data['active'] = 'barber';
		$data['title']  = 'Add Barber';
		$admin_details = $this->session->userdata('admin_details');
		$data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);
		if($this->input->post()){
			$this->form_validation->set_rules('name', 'Name', 'required');
			if ($this->form_validation->run() == FALSE)
			{
				$this->load->view('admin/includes/header',$data);
				$this->load->view('admin/barber/insertBarber');
				$this->load->view('admin/includes/footer');
			}
			else{
				$details['name'] = $this->input->post('name');
				$details['phone'] = $this->input->post('phone');
				
				if(!empty($_FILES["image"]["name"])){
					$name= time().'_'.$_FILES["image"]["name"];
					$liciense_tmp_name=$_FILES["image"]["tmp_name"];
					$error=$_FILES["image"]["error"];
					$liciense_path='uploads/barber/'.$name;
					move_uploaded_file($liciense_tmp_name,$liciense_path);
					$details['image']=base_url(). $liciense_path;
				}
				$insert = $this->Common_model->insert_data($details,'barber');
				if($insert){
					$this->session->set_flashdata('success', 'Barber Insert Successfully');
					redirect(site_url().'admin/Barber');
				}
			}
		}
		else{
			$this->load->view('admin/includes/header',$data);
			$this->load->view('admin/barber/insertBarber');
			$this->load->view('admin/includes/footer');
		}
	}
	
	public function UpdateBarber(){
		$data['active'] = 'barber';
		$data['title']  = 'Update Barber';
		$admin_details = $this->session->userdata('admin_details');
		$data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);
		if($this->input->post()){
			$this->form_validation->set_rules('name', 'Name', 'required');
			if ($this->form_validation->run() == FALSE)
			{
				$data['details'] = $this->Common_model->get_data_by_id('barber','id',$this->uri->segment(4));
				$this->load->view('admin/includes/header',$data);
				$this->load->view('admin/barber/updateBarber');
				$this->load->view('admin/includes/footer');
			}
			else{
				$details['name'] = $this->input->post('name');
				$details['phone'] = $this->input->post('phone');
				
				if(!empty($_FILES["image"]["name"])){
					$name= time().'_'.$_FILES["image"]["name"];
					$liciense_tmp_name=$_FILES["image"]["tmp_name"];
					$error=$_FILES["image"]["error"];
					$liciense_path='uploads/barber/'.$name;
					move_uploaded_file($liciense_tmp_name,$liciense_path);
					$details['image']=base_url(). $liciense_path;
				}
				$update = $this->Common_model->update('barber',$details,'id',$this->input->post('id'));
				if($update){
					$this->session->set_flashdata('success', 'Barber Update Successfully');
					redirect(site_url().'admin/Barber');
				}
			}
		}
		else{
			$data['details'] = $this->Common_model->get_data_by_id('barber','id',$this->uri->segment(4));
			$this->load->view('admin/includes/header',$data);
			$this->load->view('admin/barber/updateBarber');
			$this->load->view('admin/includes/footer');
		}
	}
	
	public function BarberLeave(){
		$id = $this->uri->segment(4);
		$data['active'] = 'barber';
		$data['title']  = 'Barber Leave';
		$admin_details = $this->session->userdata('admin_details');
		$data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);
		if($this->input->post()){
			$this->form_validation->set_rules('startDate', 'Leave Start Date', 'required');
			$this->form_validation->set_rules('endDate', 'Leave End Date', 'required');
			$this->form_validation->set_rules('wrokingDateTime', 'Wroking Time', 'required');
			if ($this->form_validation->run() == FALSE)
			{
				$data['details'] = $this->Common_model->get_data_by_id('barber','id',$this->uri->segment(4));
				$data['datas'] = $this->db->get_where('barberLeave',array('barberId' => $this->uri->segment(4)))->result_array();
				$this->load->view('admin/includes/header',$data);
				$this->load->view('admin/barber/barberLeave');
				$this->load->view('admin/includes/footer');
			}
			else{
				$details['startDate'] = $this->input->post('startDate');
				$details['endDate'] = $this->input->post('endDate');
				$details['wrokingDateTime'] = $this->input->post('wrokingDateTime');
				$details['barberId'] = $this->input->post('barberId');
				$insert = $this->Common_model->insert_data($details,'barberLeave');
				if($insert){
					$this->session->set_flashdata('success', 'Barber Leave Insert Successfully');
					redirect(site_url().'admin/Barber/BarberLeave/'.$this->input->post('barberId'));
				}
			}
		}
		else{
			$data['details'] = $this->Common_model->get_data_by_id('barber','id',$this->uri->segment(4));
			$data['datas'] = $this->db->get_where('barberLeave',array('barberId' => $this->uri->segment(4)))->result_array();
			$this->load->view('admin/includes/header',$data);
			$this->load->view('admin/barber/barberLeave');
			$this->load->view('admin/includes/footer');
		}
	}
	
	public function barberCancelLeave(){
		$delete = $this->Common_model->delete('barberLeave','id',$this->uri->segment(4));
		if($delete){
			 $this->session->set_flashdata('success', 'Barber Leave Delete Successfully.');
		}
		redirect(site_url().'admin/Barber/BarberLeave/'.$this->uri->segment(5));
	}
	
	public function DeleteBarber(){
		$delete = $this->Common_model->delete('barber','id',$this->uri->segment(4));
		if($delete){
			 $this->session->set_flashdata('success', 'Barber Delete Successfully.');
		}
		redirect(site_url().'admin/Barber');
	}
	
	public function joinQueBarber(){
		$data['datas'] = $this->Common_model->getJoinQueBarber('joinQueBarber');
		$admin_details = $this->session->userdata('admin_details');
		$data['active'] = 'joinQueBarber';
		$data['title']  = 'Join Que Barber';
		$data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);
		$this->load->view('admin/includes/header',$data);
		$this->load->view('admin/barber/manageBarberJoinQue');
		$this->load->view('admin/includes/footer');
	}
	
	public function AddJoinQueBarber(){
		$data['active'] = 'joinQueBarber';
		$data['title']  = 'Add Join Que Barber';
		$admin_details = $this->session->userdata('admin_details');
		$data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);
		if($this->input->post()){
			$details['barberId'] = $this->input->post('barberId');
			$insert = $this->Common_model->insert_data($details,'joinQueBarber');
			if($insert){
				$this->session->set_flashdata('success', 'Join Que Barber Insert Successfully');
				redirect(site_url().'admin/Barber/joinQueBarber');
			}
		}
		else{
			$joinQueDetails = $this->Common_model->get_data('joinQueBarber');
			if(!empty($joinQueDetails)){
				foreach($joinQueDetails as $joinQue){
					$ids[] = $joinQue['barberId'];
				}
				$barberIDs = implode(',',$ids);
				$data['barberDetails'] = $this->Common_model->getNotInJoinQueBarber($barberIDs);
			}
			else{
				$data['barberDetails'] = $this->Common_model->get_data('barber');
			}
			$this->load->view('admin/includes/header',$data);
			$this->load->view('admin/barber/insertJoinQueBarber');
			$this->load->view('admin/includes/footer');
		}
	}
	
	public function joinQueBarberDelete($id){
		$delete = $this->Common_model->delete('joinQueBarber','id',$this->uri->segment(4));
		if($delete){
			 $this->session->set_flashdata('success', 'Barber Delete From Join Que Successfully.');
		}
		redirect(site_url().'admin/Barber/joinQueBarber');
	}
	
	
	
}