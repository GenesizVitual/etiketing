<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jenis_kapal extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->model('Jenis_kapal_model');
		if(empty($this->session->user)){
			redirect('Login');
		}
	}

	public function index()
	{
		$v = 'Jenis kapal/content_default';
		$data['title']="Halaman Jenis Kapal";
		$this->mylib->set_view($v,$data);
	}

	public function get_data() {
		$data = $this->Jenis_kapal_model->get_data(null)->result();
		$table = array();
		$no = 1;
		foreach ($data as $key) {
			# code...
			$row = array();
			$row[] = $no++;
			$row[] = $key->nama_kapal;
			$row[] = $key->kapasitas_penumpang;
			$row[] = $key->thn_pembuatan;
			$row[] = '<a href="'.site_url('Jenis_kapal/form_edit/'.$key->id).'" class="btn btn-outline btn-warning"> Ubah </a>'.'<a href="'.site_url('Jenis_kapal/delete/'.$key->id).'" class="btn btn-outline btn-danger"> Hapus </a>';
			$table []= $row;
		}
		$container = array('data'=>$table);
		echo json_encode($container);
	}


	public function form_insert()
	{
		$v = 'Jenis kapal/insert';
		$data['title'] = "Tambah Jenis Kapal";
		$this->mylib->set_view($v,$data);
	}


	public function insert() 
	{
		$this->form_validation->set_rules('nama_kapal', 'Nama Kapal', 'required');
		$this->form_validation->set_rules('kapasitas_penumpang', 'Kapasitas Penumpang', 'required|numeric');
		$this->form_validation->set_rules('thn_pembuatan', 'Tahun Pembuatan', 'required|numeric');
		if($this->form_validation->run() != false){
			$data = array(
							'nama_kapal'=> $this->input->post('nama_kapal'),
							'kapasitas_penumpang'=> $this->input->post('kapasitas_penumpang'),
							'thn_pembuatan'=> $this->input->post('thn_pembuatan'),
						 );
			if($this->Jenis_kapal_model->insert($data) == true){
				$this->session->set_flashdata('message_success',' Data Telah Berhasil Ditambahkan');
				redirect('Jenis_kapal');
			}else{
				$this->session->set_flashdata('message_fail',' Data Telah Gagal Ditambahkan');
				redirect('Jenis_kapal');
			}
		}else{
			$this->form_insert();
		}
	}

	public function form_edit($id) // form edit
	{
		$v = 'Jenis kapal/edit';
		$data =array(
					'title'=> "Edit Jenis Kapal",
					'data'=> $this->Jenis_kapal_model->get_data(array('id'=>$id))->row()
				);
		$this->mylib->set_view($v,$data);
	}	


	public function update() 
	{
		$this->form_validation->set_rules('nama_kapal', 'Nama Kapal', 'required');
		$this->form_validation->set_rules('kapasitas_penumpang', 'Kapasitas Penumpang', 'required|numeric');
		$this->form_validation->set_rules('thn_pembuatan', 'Tahun Pembuatan', 'required|numeric');
		$id=$this->input->post('id');
		if($this->form_validation->run() != false){
			$data = array(
							'id'=> $id,
							'nama_kapal'=> $this->input->post('nama_kapal'),
							'kapasitas_penumpang'=> $this->input->post('kapasitas_penumpang'),
							'thn_pembuatan'=> $this->input->post('thn_pembuatan'),
						);
			if($this->Jenis_kapal_model->update($data) == true){
				$this->session->set_flashdata('message_success',' Data Telah Berhasil Diubah');
				redirect('Jenis_kapal');
			}else{
				$this->session->set_flashdata('message_fail',' Data Telah Gagal Diubah');
				redirect('Jenis_kapal');
			}
		}else{
			$this->edit($id);
		}
	}

	public function delete($id)
	{
		if($this->Jenis_kapal_model->delete($id)== true){
			$this->session->set_flashdata('message_success',' Data Telah Berhasil Dihapus');
			redirect('Jenis_kapal');
		}else{
			$this->session->set_flashdata('message_fail',' Data Telah Gagal Dihapus');
			redirect('Jenis_kapal');
		}
	}
}
