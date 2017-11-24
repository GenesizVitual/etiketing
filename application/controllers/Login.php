<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {


	public function __construct()
	{
	     parent::__construct();	    
	     $this->load->helper('url');
	     $this->load->library(array('form_validation','session','table'));	
	     $this->load->model('Login_model');
		 $this->load->database();
		 
	}

	public function index()
	{
		$this->load->view('login');
	}

	public function login()
	{
		$this->form_validation->set_rules('user','Username','required');
		$this->form_validation->set_rules('password','Password','required');

		if($this->form_validation->run() !=false)
		{
			$user = $this->input->post('user');
			$password=md5($this->input->post('password'));
			$pass = md5($password);

			if($this->Login_model->get_data(array('username'=>$user, 'password'=>$pass)) ->num_rows() > 0){
				$account =$this->Login_model->get_data(array('username'=>$user, 'password'=>$pass)) ->row();
				$this->session->set_userdata('user',$account->id);
				$this->session->set_userdata('name_user',$account->nama_user);
				$this->session->set_userdata('level_user',$account->level);
				$this->session->set_flashdata('message_success', 'Selamat Datang');
				redirect('Welcome');
			}else {
				$this->session->set_flashdata('message_fail', 'Username atau Password anda salah');
				redirect('Login');
			}

		}
		else{
			$this->load->view('login');
		}
	}

	public function log_of()
	{
		$this->session->sess_destroy();
		redirect('login');
	}
}
