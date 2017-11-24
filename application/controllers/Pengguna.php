<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengguna extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('Login_model');
		$this->load->database();

		if(empty($this->session->user)){
			redirect('Login');
		}
	}

	public function index()
	{
		$v = 'Pengguna/content_default';
		$data['title']="Halaman Pengguna";
		$this->mylib->set_view($v,$data);
	}

	public function get_data() {
		$data = $this->Login_model->get_data(null)->result();
		$table = array();
		$no = 1;
		foreach ($data as $key) {
			# code...
			$row = array();
			$row[] = $no++;
			$row[] = $key->nama_user;
			$row[] = $key->username;
			$row[] = $key->password;
			$row[] = '<a href="'.site_url('Pengguna/edit/'.$key->id).'" class="btn btn-outline btn-warning"> Ubah </a>'.'<a href="'.site_url('Pengguna/delete/'.$key->id).'" class="btn btn-outline btn-danger"> Hapus </a>';
			$table []= $row;
		}
		$container = array('data'=>$table);
		echo json_encode($container);
	}


	public function edit($id) // form edit
	{
		$v = 'Pengguna/edit';
		$data =array(
					'title'=> "Edit Pengguna",
					'data'=> $this->Login_model->get_data(array('id'=>$id))->row()
				);
		$this->mylib->set_view($v,$data);
	}	

	public function form_insert()
	{
		$v = 'Pengguna/insert';
		$data['title'] = "Tambah Pengguna";
		$this->mylib->set_view($v,$data);
	}


	public function insert() 
	{
		$this->form_validation->set_rules('nama_user', 'Nama', 'required');
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[5]');
		$this->form_validation->set_rules('level', 'Level Pengguna', 'required');
		if($this->form_validation->run() != false){
			$pass = md5($this->input->post('password'));
			$data = array(
							'nama_user'=> $this->input->post('nama_user'),
							'username'=> $this->input->post('username'),
							'password'=> md5($pass),
							'level'=> $this->input->post('level'),
						 );
			if($this->Login_model->insert($data) == true){
				$this->session->set_flashdata('message_success',' Data Telah Berhasil Ditambahkan');
				redirect('Pengguna');
			}else{
				$this->session->set_flashdata('message_fail',' Data Telah Gagal Ditambahkan');
				redirect('Pengguna');
			}
		}else{
			$this->form_insert();
		}
	}


	public function update() 
	{
		$this->form_validation->set_rules('nama_user', 'Nama', 'required');
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[5]');
		$this->form_validation->set_rules('level', 'Level Pengguna', 'required');
		$id=$this->input->post('id');
		if($this->form_validation->run() != false){
			$pass = md5($this->input->post('password'));
			$data = array(
							'id'=> $id,
							'nama_user'=> $this->input->post('nama_user'),
							'username'=> $this->input->post('username'),
							'password'=> md5($pass),
							'level'=> $this->input->post('level'),
						 );
			if($this->Login_model->update($data) == true){
				$this->session->set_flashdata('message_success',' Data Telah Berhasil Diubah');
				redirect('Pengguna');
			}else{
				$this->session->set_flashdata('message_fail',' Data Telah Gagal Diubah');
				redirect('Pengguna');
			}
		}else{
			$this->edit(md5($id));
		}
	}

	public function delete($id)
	{
		if($this->Login_model->delete($id) == true){
			$this->session->set_flashdata('message_success',' Data Telah Berhasil Dihapus');
			redirect('Pengguna');
		}else{
			$this->session->set_flashdata('message_fail',' Data Telah Gagal Dihapus');
			redirect('Pengguna');
		}
	}
}
