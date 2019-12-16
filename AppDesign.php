<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class AppDesign extends CI_Controller {
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
	
	public function AppColor(){
		$data['datas'] = $this->Common_model->get_data('appColor');
		$admin_details = $this->session->userdata('admin_details');
		$data['active'] = 'AppColor';
		$data['title']  = 'Manage Color';
		$data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);
		$this->load->view('admin/includes/header',$data);
		$this->load->view('admin/appDesign/managecolor');
		$this->load->view('admin/includes/footer');
	}
	
	public function UpdateColor(){
		$data['active'] = 'AppColor';
		$data['title']  = 'Update Color';
		$admin_details = $this->session->userdata('admin_details');
		$data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);
		if($this->input->post()){
			$this->form_validation->set_rules('colorCode', 'Color Code', 'required');
			if ($this->form_validation->run() == FALSE)
			{
				$this->load->view('admin/includes/header',$data);
				$this->load->view('admin/appDesign/updateColor');
				$this->load->view('admin/includes/footer');
			}
			else{
				$details['colorCode'] = $this->input->post('colorCode');
				$update = $this->Common_model->update('appColor',$details,'id',$this->input->post('id'));
				if($update){
					$this->session->set_flashdata('success', 'Color Code update Successfully');
					redirect(site_url().'admin/AppDesign/AppColor');
				}
			}
		}
		else{
			
			$data['details'] = $this->Common_model->get_data_by_id('appColor','id',$this->uri->segment(4));
			$this->load->view('admin/includes/header',$data);
			$this->load->view('admin/appDesign/updateColor');
			$this->load->view('admin/includes/footer');
		}
	}
	
	public function AppLogo(){
		$data['datas'] = $this->Common_model->get_data('appLogo');
		$admin_details = $this->session->userdata('admin_details');
		$data['active'] = 'AppLogo';
		$data['title']  = 'Manage Logo';
		$data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);
		$this->load->view('admin/includes/header',$data);
		$this->load->view('admin/appDesign/manageLogo');
		$this->load->view('admin/includes/footer');
	}
	
	public function UpdateLogo(){
		$data['active'] = 'AppLogo';
		$data['title']  = 'Update Logo';
		$admin_details = $this->session->userdata('admin_details');
		$data['admin'] = $this->Common_model->get_data_by_id('admin','id',$admin_details['admin_id']);
		if($this->input->post()){
			$this->form_validation->set_rules('logoTitle', 'Title', 'required');
			if ($this->form_validation->run() == FALSE)
			{
				$this->load->view('admin/includes/header',$data);
				$this->load->view('admin/appDesign/updateLogo');
				$this->load->view('admin/includes/footer');
			}
			else{
				$details['logoTitle'] = $this->input->post('logoTitle');
				if(!empty($_FILES['logoimage']['name'])){
					
					$foto = $this->do_upload('logoimage');
					$details['logoimage'] = base_url().'uploads/logo/'.$foto['upload_data']['file_name'];
				}
				$update = $this->Common_model->update('appLogo',$details,'id',$this->input->post('id'));
				if($update){
					$this->session->set_flashdata('success', 'Logo update Successfully');
					redirect(site_url().'admin/AppDesign/AppLogo');
				}
			}
		}
		else{
			
			$data['details'] = $this->Common_model->get_data_by_id('appLogo','id',$this->uri->segment(4));
			$this->load->view('admin/includes/header',$data);
			$this->load->view('admin/appDesign/updateLogo');
			$this->load->view('admin/includes/footer');
		}
	}
	
	public function do_upload($file){
                $config['upload_path']          = './uploads/logo';
                $config['allowed_types']        = 'gif|jpg|png';
                //$config['max_size']             = 100;
               // $config['max_width']            = 1024;
                //$config['max_height']           = 768;
                $config['encrypt_name'] = TRUE;

                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload($file))
                {
                     return  $error = array('error' => $this->upload->display_errors());    
                }
                else
                {
                       return $data = array('upload_data' => $this->upload->data());
                }
    }
	
	
}