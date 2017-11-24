<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rute extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->model(array('Rute_model','Jenis_kapal_model'));
		if(empty($this->session->user)){
			redirect('Login');
		}
	}

	public function index()
	{
		$v = 'Rute/content_default';
		$data['title']="Halaman Rute Kapal";
		$this->mylib->set_view($v,$data);
	}

	public function get_data() {
		$data = $this->Rute_model->get_data(null)->result();
		$table = array();
		$no = 1;
		foreach ($data as $key) {
			# code...
			$row = array();
			$row[] = $no++;
			$row[] = $key->nama_kapal;
			$row[] = $key->rute;
			$row[] = ucwords($key->rute);
			$row[] = '<a href="'.site_url('Rute/form_edit/'.$key->id).'" class="btn btn-outline btn-warning"> Ubah </a>'.'<a href="'.site_url('Rute/delete/'.$key->id).'" class="btn btn-outline btn-danger"> Hapus </a>';
			$table []= $row;
		}
		$container = array('data'=>$table);
		echo json_encode($container);
	}


	public function form_insert()
	{
		$v = 'Rute/insert';
		$data = array(
						'title'=> "Tambah Rute",
						'kapal' =>$this->Jenis_kapal_model->get_data(null)
					);

		$this->mylib->set_view($v,$data);
	}


	public function insert() 
	{
		$this->form_validation->set_rules('kapal', 'Nama Kapal', 'required');
		$this->form_validation->set_rules('awal', 'Titik Awal keberangkatan', 'required');
		$this->form_validation->set_rules('tujuan', 'Titik Tujuan keberangkatan', 'required');
		if($this->form_validation->run() != false){
			$data = array(
							'kapal_id'=> $this->input->post('kapal'),
							'rute'=> $this->input->post('awal')." - ". $this->input->post('tujuan'),
						 );
			if($this->Rute_model->insert($data) == true){
				$this->session->set_flashdata('message_success',' Data Telah Berhasil Ditambahkan');
				redirect('Rute');
			}else{
				$this->session->set_flashdata('message_fail',' Data Telah Gagal Ditambahkan');
				redirect('Rute');
			}
		}else{
			$this->form_insert();
		}
	}

	public function form_edit($id) // form edit
	{
		$v = 'Rute/edit';
		$data =array(
					'title' => "Edit Jenis Kapal",
					'kapal' => $this->Jenis_kapal_model->get_data(null),
					'data'  => $this->Rute_model->get_data(array('id'=>$id))->row()
				);
		$this->mylib->set_view($v,$data);
	}	


	public function update() 
	{
		$this->form_validation->set_rules('kapal', 'Nama Kapal', 'required');
		$this->form_validation->set_rules('awal', 'Titik Awal keberangkatan', 'required');
		$this->form_validation->set_rules('tujuan', 'Titik Tujuan keberangkatan', 'required');
		$id=$this->input->post('id');
		if($this->form_validation->run() != false){
			$data = array(
							'id'=> $id,
							'kapal_id'=> $this->input->post('kapal'),
							'rute'=> $this->input->post('awal')." - ".$this->input->post('tujuan'),
						);
			if($this->Rute_model->update($data) == true){
				$this->session->set_flashdata('message_success',' Data Telah Berhasil Diubah');
				redirect('Rute');
			}else{
				$this->session->set_flashdata('message_fail',' Data Telah Gagal Diubah');
				redirect('Rute');
			}
		}else{
			$this->edit($id);
		}
	}

	public function delete($id)
	{
		if($this->Rute_model->delete($id)== true){
			$this->session->set_flashdata('message_success',' Data Telah Berhasil Dihapus');
			redirect('Rute');
		}else{
			$this->session->set_flashdata('message_fail',' Data Telah Gagal Dihapus');
			redirect('Rute');
		}
	}
}
