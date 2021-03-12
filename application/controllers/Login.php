<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('User_model');
	}
	
	public function index()
	{
		$this->load->view('login');
	}
	
	
	public function LoginUser()
	{
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		
		$this->form_validation->set_error_delimiters('<div class="error-msg">', '</div>');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('login');
		}
		else
		{
			$email 		= $this->security->xss_clean($this->input->post('email'));
			$password 	= $this->security->xss_clean($this->input->post('password'));
						
		
			$options = array("cost"=>4);
			$hashPassword = password_hash($password,PASSWORD_BCRYPT,$options);
			
			
			$checkEmail = $this->User_model->checkDuplicate($email);
			
			if($checkEmail  == 1)
			{
				$getUserDetails = $this->User_model->userExist($email);
				
				if(password_verify($password,$getUserDetails['password']))
				{
					unset($getUserDetails['password']);
					unset($getUserDetails['created']);
					unset($getUserDetails['phone']);

					$this->session->set_userdata($getUserDetails);
					
					redirect('film','refresh');
				}
				else
				{
					$data['errorMsg'] = "Wrong email or password";
					$this->load->view('login',$data);
				}			
			}
			else
			{
                $redirect = base_url('index.php/user/');
				$data['errorMsg'] = 'User not exist, <a href='.$redirect.'> Do you want to register? </a>';
				$this->load->view('login',$data);
			}
		}
	}
	
	
	function LoginThankyou()
	{
		if(!isset($this->session->email)){
			redirect('login','refresh');
		}
		
		redirect('film/index','refresh');
	}
	
	
	public function logout(){
		$this->session->sess_destroy();
		redirect('login','refresh');
	}
	
	
	
}
