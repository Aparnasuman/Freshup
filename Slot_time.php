<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Slot_time extends CI_Controller {
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
		$data['datas'] = $this->Common_model->get_data('slot_time');
		$admin_details = $this->session->userdata('admin_details');
		$data['active'] = 'slot_time';
		$data['title']  = 'Manage Time Slot';
		$data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);
		$this->load->view('admin/includes/header',$data);
		$this->load->view('admin/slot_time/manageSlot_time');
		$this->load->view('admin/includes/footer');
	}
	
	public function InsertSlot_time(){
		$data['active'] = 'slot_time';
		$data['title']  = 'Add Time Slot';
		$admin_details = $this->session->userdata('admin_details');
		$data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);
		if($this->input->post()){
			$this->form_validation->set_rules('slot_time', 'Time_slot', 'required');
			$this->form_validation->set_rules('start_time', 'Start Time', 'required');
			$this->form_validation->set_rules('end_time', 'End Time', 'required');
			if ($this->form_validation->run() == FALSE)
			{
				$this->load->view('admin/includes/header',$data);
				$this->load->view('admin/slot_time/insertSlot_time');
				$this->load->view('admin/includes/footer');
			}
			else{
				$details['slot_time'] = $this->input->post('slot_time');
				$details['start_time'] = $this->input->post('start_time');
				$details['end_time'] = $this->input->post('end_time');
				
				$insert = $this->Common_model->insert_data($details,'slot_time');
				if($insert){
					$this->session->set_flashdata('success', 'Time Slot Insert Successfully');
					redirect(site_url().'admin/Slot_time');
				}
			}
		}
		else{
			$this->load->view('admin/includes/header',$data);
			$this->load->view('admin/slot_time/insertSlot_time');
			$this->load->view('admin/includes/footer');
		}
	}
	
	public function UpdateSlot_time(){
		$data['active'] = 'slot_time';
		$data['title']  = 'Update Time Slot';
		$admin_details = $this->session->userdata('admin_details');
		$data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);
		if($this->input->post()){
			$this->form_validation->set_rules('slot_time', 'Time-Slot', 'required');
			$this->form_validation->set_rules('start_time', 'Start Time', 'required');
			$this->form_validation->set_rules('end_time', 'End Time', 'required');
			if(!empty($this->input->post('holiday_startDate'))){
			$this->form_validation->set_rules('holiday_endDate', 'End Time', 'required');	
			}
			if ($this->form_validation->run() == FALSE)
			{
				$data['details'] = $this->Common_model->get_data_by_id('slot_time','id',$this->uri->segment(4));
				$this->load->view('admin/includes/header',$data);
				$this->load->view('admin/slot_time/updateSlot_time');
				$this->load->view('admin/includes/footer');
			}
			else{
				$details['slot_time'] = $this->input->post('slot_time');
				$details['start_time'] = $this->input->post('start_time');
				$details['end_time'] = $this->input->post('end_time');
				$details['regularFirstShiftStartTime'] = $this->input->post('regularFirstShiftStartTime');
				$details['regularFirstShiftEndTime'] = $this->input->post('regularFirstShiftEndTime');
				$details['regularSecondShiftStartTime'] = $this->input->post('regularSecondShiftStartTime');
				$details['regularSecondShiftEndTime'] = $this->input->post('regularSecondShiftEndTime');
				$details['weekendFirstShiftStartTime'] = $this->input->post('weekendFirstShiftStartTime');
				$details['weekendFirstShiftEndTime'] = $this->input->post('weekendFirstShiftEndTime');
				$details['weekendSecondShiftStartTime'] = $this->input->post('weekendSecondShiftStartTime');
				$details['weekendSecondShiftEndTime'] = $this->input->post('weekendSecondShiftEndTime');
				$regular_times = $this->input->post('start_time1').",".$this->input->post('end_time1');
				$details['regular_times'] = $regular_times;
				$weekend_times = $this->input->post('start_time2').",".$this->input->post('end_time2');
				$details['weekend_times'] = $weekend_times;
				if(!empty($this->input->post('holiday_startDate'))){
				$details['holiday_startDate'] = date("d-m-Y", strtotime($this->input->post('holiday_startDate')));	
				$details['holiday_endDate'] = date("d-m-Y", strtotime($this->input->post('holiday_endDate')));
				}
				else{
					$details['holiday_startDate'] = '';
					$details['holiday_endDate'] = '';
				}
				
				$workingDays = $this->input->post('days');
				
				if(count($workingDays)=='1'){
					$details['working_days'] = $workingDays[0];
				}
				elseif(count($workingDays)!='1'){
					$details['working_days'] = implode(',',$workingDays);
				}
				else{
					$details['working_days'] = '';
				}
				
				$days = array('Monday','Tuesday','Wednesday','Thusday','Friday','Saturday','Sunday');
				
				foreach($days as $dats){
					if(!in_array($dats,$workingDays)){
						$notWorkingDays[] = $dats; 
					}
				}
				
				$countDays = count($notWorkingDays);
				$details['non_working_days'] = implode(',',$notWorkingDays);
				
				if($countDays > 2){
					$this->session->set_flashdata('error', 'Manjinder rana');
					redirect(site_url().'admin/Slot_time/UpdateSlot_time/'.$this->uri->segment(4));
				}			
				else{
					$update = $this->Common_model->update('slot_time',$details,'id',$this->uri->segment(4));
					if($update){
						$this->session->set_flashdata('success', 'Time Slot Update Successfully');
						redirect(site_url().'admin/Slot_time');
					}
				}
			}
		}
		else{
			$data['details'] = $this->Common_model->get_data_by_id('slot_time','id',$this->uri->segment(4));
			$this->load->view('admin/includes/header',$data);
			$this->load->view('admin/slot_time/updateSlot_time');
			$this->load->view('admin/includes/footer');
		}
	}
	
	public function DeleteSlot_time(){
		$delete = $this->Common_model->delete('slot_time','id',$this->uri->segment(4));
		if($delete){
			 $this->session->set_flashdata('success', 'Time Slot Delete Successfully.');
		}
		redirect(site_url().'admin/Slot_time');
	}
	
}