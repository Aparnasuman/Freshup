<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class UserBookingServices extends CI_Controller {
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
		//error_reporting(E_ALL);
	}
	
	public function index(){
		//$data['datas'] = $this->Common_model->get_data('userBookingServices');
		$admin_details = $this->session->userdata('admin_details');
		$data['active'] = 'userBookingServices';
		$data['title']  = 'Manage Booking Services';
		$data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);
		$data['details'] = $this->Common_model->userBookingServices(); 
		$data['subsub'] = $this->Common_model->get_data('subSubServices'); 
		 
		$this->load->view('admin/includes/header',$data);
		$this->load->view('admin/userBookingServices/manageBookingServices');
		$this->load->view('admin/includes/footer');
	}
	
	public function viewBookingServices(){
		$admin_details = $this->session->userdata('admin_details');
		$data['active'] = 'userBookingServices';
		$data['title']  = 'View Booking Services';
		$data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);
		$data['userBookingServicesDetails'] = $this->db->get_where('userBookingServices',array('id' => $this->uri->segment(4)))->row_array();
		$data['userDetails'] = $this->db->get_where('userDetails',array('id' => $data['userBookingServicesDetails']['user_id']))->row_array();
		$data['barberDetails'] = $this->db->get_where('barber',array('id' => $data['userBookingServicesDetails']['barber_id']))->row_array();
		if(!empty($data['userBookingServicesDetails']['subSubService_id'])){
			$data['serviceDetails'] = $this->Common_model->getServiceDetails($data['userBookingServicesDetails']['subSubService_id']);
		}
		$this->load->view('admin/includes/header',$data);
		$this->load->view('admin/userBookingServices/viewBookinServices');
		$this->load->view('admin/includes/footer');
	}
	
	public function updateStatus(){
		$data['status'] =$this->input->post('status');
		$update = $this->Common_model->update('userBookingServices',$data,'id',$this->input->post('id'));
		$userId  = $this->input->post('userId');
		if($update){
			if($this->input->post('status') == '1'){
				$reg_id = $this->db->get_where('userDetails', array('id'=> $userId))->row_array();
				$regIDs = $reg_id['reg_id'];
				$message = 'Hii "'.$reg_id['name'].'", your apointment is accepted';
				$registrationIds =  array($regIDs);
				define('API_ACCESS_KEY', 'AAAAXQEiJJo:APA91bEZEmyCW5ME6LV9MZ59DUi8r3OWXNWiZ5LEX6kD4orqEzVZrwmjto_xRyWjbiSNgP6eR2UpV3HE2T1R074dkjigJ5BbrHLWX8EXJfXDS5S2VDS9rcjFl1Z1EXSrx-8b0o9tsEXm');
						
				$msg = array
				(
					'message' 	=> $message,
					'title'		=> 'Freshup',
					'price'		=> $this->input->post('price'),
					'service'	=> $this->input->post('service'),
					'timeSlot'	=> $this->input->post('timeSlot'),
					'apointmentDate'	=> $this->input->post('apointmentDate'),
					'barberName'	=> $this->input->post('barberName'),
					'bookingServiceId'	=> $this->input->post('id'),
					'subtitle'	=> 'Request',
					'vibrate'	=> 1,
					'sound'		=> 1,
					'largeIcon'	=> 'large_icon',
					'smallIcon'	=> 'small_icon',
					'type'      => 'message'
				);			
				$fields = array
				(
					'registration_ids' 	=> $registrationIds,
					'data'			=> $msg
				);
								 
				$headers = array
				(
					'Authorization: key=' . API_ACCESS_KEY,
					'Content-Type: application/json'
				);
				 
				$ch = curl_init();
				curl_setopt( $ch,CURLOPT_URL, 'https://android.googleapis.com/gcm/send' );
				curl_setopt( $ch,CURLOPT_POST, true );
				curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
				curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
				curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
				curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
				$result = curl_exec($ch );
				print_r($result);
					die;
				curl_close( $ch );
			}
			elseif($this->input->post('status') == '3'){
				$reg_id = $this->db->get_where('userDetails', array('id'=> $userId))->row_array();
				$regIDs = $reg_id['reg_id'];
				$message = 'Hii '.$reg_id['name'].', your apointment is Completed';
				$registrationIds =  array($regIDs);
				define('API_ACCESS_KEY', 'AAAAXQEiJJo:APA91bEZEmyCW5ME6LV9MZ59DUi8r3OWXNWiZ5LEX6kD4orqEzVZrwmjto_xRyWjbiSNgP6eR2UpV3HE2T1R074dkjigJ5BbrHLWX8EXJfXDS5S2VDS9rcjFl1Z1EXSrx-8b0o9tsEXm');
						
				$msg = array
				(
					'message' 	=> $message,
					'title'		=> 'Freshup',
					'price'		=> $this->input->post('price'),
					'service'	=> $this->input->post('service'),
					'timeSlot'	=> $this->input->post('timeSlot'),
					'apointmentDate'	=> $this->input->post('apointmentDate'),
					'barberName'	=> $this->input->post('barberName'),
					'bookingServiceId'	=> $this->input->post('id'),
					'subtitle'	=> 'Request',
					'vibrate'	=> 1,
					'sound'		=> 1,
					'largeIcon'	=> 'large_icon',
					'smallIcon'	=> 'small_icon',
					'type'      => 'message'
				);			
				$fields = array
				(
					'registration_ids' 	=> $registrationIds,
					'data'			=> $msg
				);
								 
				$headers = array
				(
					'Authorization: key=' . API_ACCESS_KEY,
					'Content-Type: application/json'
				);
				 
				$ch = curl_init();
				curl_setopt( $ch,CURLOPT_URL, 'https://android.googleapis.com/gcm/send' );
				curl_setopt( $ch,CURLOPT_POST, true );
				curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
				curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
				curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
				curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
				$result = curl_exec($ch );
				print_r($result);
					die;
				curl_close( $ch );
			}
			else{
				$reg_id = $this->db->get_where('userDetails', array('id'=> $userId))->row_array();
				$regIDs = $reg_id['reg_id'];
				$message = 'Hii "'.$reg_id['name'].'", your apointment is canceled';
				$registrationIds =  array($regIDs);
				define('API_ACCESS_KEY', 'AAAAXQEiJJo:APA91bEZEmyCW5ME6LV9MZ59DUi8r3OWXNWiZ5LEX6kD4orqEzVZrwmjto_xRyWjbiSNgP6eR2UpV3HE2T1R074dkjigJ5BbrHLWX8EXJfXDS5S2VDS9rcjFl1Z1EXSrx-8b0o9tsEXm');
						
				$msg = array
				(
					'message' 	=> $message,
					'title'		=> 'Freshup',
					'price'		=> $this->input->post('price'),
					'service'	=> $this->input->post('service'),
					'timeSlot'	=> $this->input->post('timeSlot'),
					'apointmentDate'	=> $this->input->post('apointmentDate'),
					'barberName'	=> $this->input->post('barberName'),
					'bookingServiceId'	=> $this->input->post('id'),
					'subtitle'	=> 'Request',
					'vibrate'	=> 1,
					'sound'		=> 1,
					'largeIcon'	=> 'large_icon',
					'smallIcon'	=> 'small_icon',
					'type'      => 'message'
				);			
				$fields = array
				(
					'registration_ids' 	=> $registrationIds,
					'data'			=> $msg
				);
								 
				$headers = array
				(
					'Authorization: key=' . API_ACCESS_KEY,
					'Content-Type: application/json'
				);
				 
				$ch = curl_init();
				curl_setopt( $ch,CURLOPT_URL, 'https://android.googleapis.com/gcm/send' );
				curl_setopt( $ch,CURLOPT_POST, true );
				curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
				curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
				curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
				curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
				$result = curl_exec($ch );
				print_r($result);
					die;
				curl_close( $ch );
			}
			
			return true;
		}
	}

}