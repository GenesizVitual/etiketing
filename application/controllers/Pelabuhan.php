<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelabuhan extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->model(array('Rute_model','Pelabuhan_model','Jenis_kapal_model'));
		if(empty($this->session->user)){
			redirect('Login');
		}

	}

	public function index()
	{
		$v = 'Pelabuhan/content_default';
		$data['title']="Halaman Pelabuhan";
		$this->mylib->set_view($v,$data);
	}

	public function get_data() {
		$data = $this->Pelabuhan_model->get_data(null)->result();
		$table = array();
		$no = 1;
			
		foreach ($data as $key) {
			# code...
			$row = array();
			$row[] = $no++;
			$row[] = $key->nama_pelabuhan;
			$row[] = $key->alamat_pel;
			$row[] = '<a href="'.site_url('Pelabuhan/form_edit/'.$key->id).'" class="btn btn-outline btn-warning"> Ubah </a>'.'<a href="'.site_url('Pelabuhan/delete/'.$key->id).'" class="btn btn-outline btn-danger"> Hapus </a>';
			$table []= $row;
		}
		$container = array('data'=>$table);
		echo json_encode($container);
	}


	public function form_insert()
	{
		$v = 'Pelabuhan/insert';
		$data = array(
						'title'=> "Tambah Pelabuhan",
						'kapal' =>$this->Jenis_kapal_model->get_data(null)
					);

		$this->mylib->set_view($v,$data);
	}


	public function insert() 
	{
		$this->form_validation->set_rules('pelabuhan', 'Nama Pelabuhan', 'required');
		$this->form_validation->set_rules('alamat_pel', 'Alamat Pelabuhan', 'required');
		if($this->form_validation->run() != false){
			$data = array(
							'nama_pelabuhan'=> $this->input->post('pelabuhan'),
							'alamat_pel'=> $this->input->post('alamat_pel'),
						 );
			if($this->Pelabuhan_model->insert($data) == true){
				$this->session->set_flashdata('message_success',' Data Telah Berhasil Ditambahkan');
				redirect('Pelabuhan');
			}else{
				$this->session->set_flashdata('message_fail',' Data Telah Gagal Ditambahkan');
				redirect('Pelabuhan');
			}
		}else{
			$this->form_insert();
		}
	}

	public function form_edit($id) // form edit
	{
		$v = 'Pelabuhan/edit';
		$data =array(
					'title' => "Edit Jenis Kapal",
					'data'  => $this->Pelabuhan_model->get_data(array('id'=>$id))->row()
				);
		$this->mylib->set_view($v,$data);
	}	


	public function update() 
	{
		$this->form_validation->set_rules('pelabuhan', 'Nama Pelabuhan', 'required');
		$this->form_validation->set_rules('alamat_pel', 'Alamat', 'required');
		$id=$this->input->post('id');
		if($this->form_validation->run() != false){
			$data = array(
							'id'=> $id,
							'nama_pelabuhan'=> $this->input->post('pelabuhan'),
							'alamat_pel'=> $this->input->post('alamat_pel'),
						);
			if($this->Pelabuhan_model->update($data) == true){
				$this->session->set_flashdata('message_success',' Data Telah Berhasil Diubah');
				redirect('Pelabuhan');
			}else{
				$this->session->set_flashdata('message_fail',' Data Telah Gagal Diubah');
				redirect('Pelabuhan');
			}
		}else{
			$this->edit($id);
		}
	}

	public function delete($id)
	{
		if($this->Pelabuhan_model->delete($id)== true){
			$this->session->set_flashdata('message_success',' Data Telah Berhasil Dihapus');
			redirect('Pelabuhan');
		}else{
			$this->session->set_flashdata('message_fail',' Data Telah Gagal Dihapus');
			redirect('Pelabuhan');
		}
	}
}
