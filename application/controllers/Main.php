<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {


	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->model('Klien_model');
		if(empty($this->session->user)){
			redirect('Login');
		}
	}


	public function index()
	{
		//I'm just using rand() function for data example
		$temp = rand(3942, 382);
		$this->set_barcode($temp);
	}
	
	public function set_barcode($code)
	{

		//load library
		$this->load->library('zend');
		//load in folder Zend
		$this->zend->load('Zend/Barcode');
		//generate barcode
		Zend_Barcode::render('code128', 'image', array('text'=>$code), array());
		//imagepng($barcode,  base_url().'resource/barcode.png');	
	}
	
	public function make_card($data)
	{
		$data = $this->Klien_model->get_data(array('id'=>$data))->row();		
		$this->load->view('test_card', $data);
	}
}