<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jenis_tarif extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->model(array('Jenis_tarif_model','jenis_retribusi_model'));
		if(empty($this->session->user)){
			redirect('Login');
		}
	}

	public function index()
	{
		$v = 'Jenis tarif/content_default';
		$data['title']="Halaman Jenis Tarif";
		$this->mylib->set_view($v,$data);
	}

	public function get_data() {
		$data = $this->Jenis_tarif_model->get_data(null)->result();
		$table = array();
		$no = 1;
		foreach ($data as $key) {
			# code...
			$row = array();
			$row[] = $no++;
			$row[] = $key->jenis_retribusi;
			$row[] = $key->jenis_tarif;
			$row[] = $key->satuan;
			$row[] = $key->harga;
			$row[] = '<a href="'.site_url('Jenis_tarif/edit/'.$key->id).'" class="btn btn-outline btn-warning"> Ubah </a>'.'<a href="javascript:void(0);" onclick="confirm_('.$key->id.')" class="btn btn-outline btn-danger"> Hapus </a>';
			$table []= $row;
		}
		$container = array('data'=>$table);
		echo json_encode($container);
	}


	public function edit($id) // form edit
	{
		$v = 'Jenis tarif/edit';
		$data =array(
					'title'=> "Edit Jenis Tarif",
					'data'=> $this->Jenis_tarif_model->get_data(array('id'=>$id))->row(),
					'retribusi'=>$this->jenis_retribusi_model->get_data(null)
				);
		$this->mylib->set_view($v,$data);
	}	

	public function form_insert()
	{
		$v = 'Jenis tarif/insert';
		$data['title'] = "Tambah Jenis Tarif";
		$data['retribusi'] = $this->jenis_retribusi_model->get_data(null);
		$this->mylib->set_view($v,$data);
	}


	public function insert() 
	{
		$this->form_validation->set_rules('jenis_tarif', 'Jenis Tarif', 'required');
		$this->form_validation->set_rules('id_jt', 'Jenis Tarif', 'required');
		$this->form_validation->set_rules('satuan', 'satuan', 'required');
		$this->form_validation->set_rules('harga_tarif', 'Harga tarif', 'required|numeric');
		if($this->form_validation->run() != false){
			$data = array(
							'id_jt'=> $this->input->post('id_jt'),
							'jenis_tarif'=> $this->input->post('jenis_tarif'),
							'satuan'=> $this->input->post('satuan'),
							'harga'=> $this->input->post('harga_tarif'),
						 );
			if($this->Jenis_tarif_model->insert($data) == true){
				$this->session->set_flashdata('message_success',' Data Telah Berhasil Ditambahkan');
				redirect('Jenis_tarif');
			}else{
				$this->session->set_flashdata('message_fail',' Data Telah Gagal Ditambahkan');
				redirect('Jenis_tarif');
			}
		}else{
			$this->form_insert();
		}
	}


	public function update() 
	{
		$this->form_validation->set_rules('jenis_tarif', 'Jenis Tarif', 'required');
		$this->form_validation->set_rules('id_jt', 'Jenis Tarif', 'required');
		$this->form_validation->set_rules('satuan', 'satuan', 'required');
		$this->form_validation->set_rules('harga_tarif', 'Harga tarif', 'required|numeric');
		$id=$this->input->post('id');
		if($this->form_validation->run() != false){
			$data = array(
							'id'=> $id,
							'id_jt'=> $this->input->post('id_jt'),
							'jenis_tarif'=> $this->input->post('jenis_tarif'),
							'satuan'=> $this->input->post('satuan'),
							'harga'=> $this->input->post('harga_tarif'),
						 );
			if($this->Jenis_tarif_model->update($data) == true){
				$this->session->set_flashdata('message_success',' Data Telah Berhasil Diubah');
				redirect('Jenis_tarif');
			}else{
				$this->session->set_flashdata('message_fail',' Data Telah Gagal Diubah');
				redirect('Jenis_tarif');
			}
		}else{
			$this->edit($id);
		}
	}

	public function delete($id)
	{
		if($this->Jenis_tarif_model->delete($id) == true){
			$this->session->set_flashdata('message_success',' Data Telah Berhasil Dihapus');
			redirect('Jenis_tarif');
		}else{
			$this->session->set_flashdata('message_fail',' Data Telah Gagal Dihapus');
			redirect('Jenis_tarif');
		}
	}
}
