<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Backup_database extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->database();
		//$this->load->model(array('Beli_tiket_model','Registrasi_model','Total_deposit','Rute_model','Jenis_tarif_model','klien_model'));
		if(empty($this->session->user)){
			redirect('Login');
		}
	}

	public function index()
	{
		//$v = 'Beli_tiket/content_default';
		//$data['title']="Halaman Retribusi dan Beli Tiket";
		//$this->mylib->set_view($v,$data);
		echo "backupdatase";
	}


}
