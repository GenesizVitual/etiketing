<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jenis_retribusi extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->model('Jenis_retribusi_model');
		if(empty($this->session->user)){
			redirect('Login');
		}
	}

	public function index()
	{
		$v = 'Jenis registrasi/content_default';
		$data['title']="Halaman Jenis Retribusi";
		$this->mylib->set_view($v,$data);
	}

	public function get_data() {
		$data = $this->Jenis_retribusi_model->get_data(null)->result();
		$table = array();
		$no = 1;
		foreach ($data as $key) {
			# code...
			$row = array();
			$row[] = $no++;
			$row[] = $key->jenis_retribusi;
			$row[] = $key->singkatan;
			$row[] = '<a href="'.site_url('Jenis_retribusi/edit/'.$key->id).'" class="btn btn-outline btn-warning"> Ubah </a>'.'<a href="javascript:void(0);" onclick="confirm_('.$key->id.')" class="btn btn-outline btn-danger"> Hapus </a>';
			$table []= $row;
		}
		$container = array('data'=>$table);
		echo json_encode($container);
	}


	public function edit($id) // form edit
	{
		$v = 'Jenis registrasi/edit';
		$data =array(
					'title'=> "Edit Jenis Retribusi",
					'data'=> $this->Jenis_retribusi_model->get_data(array('id'=>$id))->row()
				);
		$this->mylib->set_view($v,$data);
	}	

	public function form_insert()
	{
		$v = 'Jenis registrasi/insert';
		$data['title'] = "Tambah Jenis Retribusi";
		$this->mylib->set_view($v,$data);
	}


	public function insert() 
	{
		$this->form_validation->set_rules('jenis_retribusi', 'Jenis retribusi', 'required');
		$this->form_validation->set_rules('singkatan', 'Singkatan', 'required');
		if($this->form_validation->run() != false){
			$data = array(
							'jenis_retribusi'=> $this->input->post('jenis_retribusi'),
							'singkatan'=> $this->input->post('singkatan'),
						 );
			if($this->Jenis_retribusi_model->insert($data) == true){
				$this->session->set_flashdata('message_success',' Data Telah Berhasil Ditambahkan');
				redirect('Jenis_retribusi');
			}else{
				$this->session->set_flashdata('message_fail',' Data Telah Gagal Ditambahkan');
				redirect('Jenis_retribusi');
			}
		}else{
			$this->form_insert();
		}
	}


	public function update() 
	{
		$this->form_validation->set_rules('jenis_retribusi', 'Jenis_retribusi', 'required');
		$this->form_validation->set_rules('singkatan', 'Singkatan', 'required');
		$id=$this->input->post('id');
		if($this->form_validation->run() != false){
			$data = array(
							'id'=> $id,
							'jenis_retribusi'=> $this->input->post('jenis_retribusi'),
							'singkatan'=> $this->input->post('singkatan'),
						 );
			if($this->Jenis_retribusi_model->update($data) == true){
				$this->session->set_flashdata('message_success',' Data Telah Berhasil Diubah');
				redirect('Jenis_retribusi');
			}else{
				$this->session->set_flashdata('message_fail',' Data Telah Gagal Diubah');
				redirect('Jenis_retribusi');
			}
		}else{
			$this->edit($id);
		}
	}

	public function delete($id)
	{
		if($this->Jenis_retribusi_model->delete($id) == true){
			$this->session->set_flashdata('message_success',' Data Telah Berhasil Dihapus');
			redirect('Jenis_retribusi');
		}else{
			$this->session->set_flashdata('message_fail',' Data Telah Gagal Dihapus');
			redirect('Jenis_retribusi');
		}
	}
}
