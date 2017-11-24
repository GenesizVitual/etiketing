<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Klien extends CI_Controller {

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
		$v = 'Klien/content_default';
		$data['title']="Halaman Klien";
		$this->mylib->set_view($v,$data);
	}

	public function cek_klien($parameter){
		if($parameter=="null"){
			$data = $this->Klien_model->get_data(null)->result();
		}else{
			$data = $this->Klien_model->get_data(array('kode_barcode'=>$parameter))->row();	
		}
		echo json_encode($data);
	}

	public function get_data($parameter) {
		$level = $this->session->level_user;
		if($parameter=="null"){
			$data = $this->Klien_model->get_data(null)->result();
		}else{
			$data = $this->Klien_model->get_data(array('kode_barcode'=>$parameter))->result();	
		}		

		$table = array();
		$no = 1;
		foreach ($data as $key) {
			# code...
			$row = array();
			$row[] = $no++;
			$row[] = $key->nik;
			$row[] = $key->nama_klien;
			$row[] = $key->kode_barcode;
			$row[] = $key->tempat_lahir.', '.$key->tgl_lahir;
			$row[] = $key->jenis_kel;
			$row[] = $key->alamat;
			$row[] = $key->rt.'/'.$key->rw;
			$row[] = $key->desa;
			$row[] = $key->kec;
			$row[] = $key->kab;
			$row[] = $key->pekerjaan;
			$row[] = $key->warga_negara;
			$row[] = $key->status;
			if($level==0){
				$row[] = '<a href="'.site_url('Klien/edit/'.$key->id_klien).'" class="btn btn-outline btn-warning"> Ubah </a>'.'<a href="'.site_url('Klien/delete/'.$key->id_klien).'" class="btn btn-outline btn-danger"> Hapus </a>'
			.'<a href="'.site_url('Main/make_card/'.$key->id_klien).'" class="btn btn-outline btn-primary"> Cetak Kartu </a>'.
			'<button  onclick="proses_registrasi('.$key->id_klien.')" id="registrasi_" class="btn btn-outline btn-primary"> Registrasi kartu </button>';
			}else if($level==1){
			$row[] = '<a href="'.site_url('Klien/edit/'.$key->id_klien).'" class="btn btn-outline btn-warning"> Ubah </a>'.'<a href="'.site_url('Klien/delete/'.$key->id_klien).'" class="btn btn-outline btn-danger"> Hapus </a>'
			.'<a href="'.site_url('Main/make_card/'.$key->id_klien).'" id="registrasi_" class="btn btn-outline btn-primary"> Cetak Kartu </a>'.
			'<button  onclick="proses_registrasi('.$key->id_klien.')" id="registrasi_" class="btn btn-outline btn-primary"> Registrasi kartu </button>';
			}else{

			$row[] ='<button  onclick="proses_registrasi('.$key->id_klien.')" id="registrasi_" class="btn btn-outline btn-primary"> Registrasi kartu </button>';
			}


			$table []= $row;
		}
		$container = array('data'=>$table);
		echo json_encode($container);
	}

	public function form_insert()
	{
		$v = 'Klien/insert';
		$data['title'] = "Tambah Klien";
		$this->mylib->set_view($v,$data);
	}

	public function edit($id) // form edit
	{
		$v = 'Klien/edit';
		$data =array(
					'title'=> "Edit Klien",
					'data'=> $this->Klien_model->get_data(array('id'=>$id))->row()
				);
		$this->mylib->set_view($v,$data);
	}	

	public function insert() 
	{
		$this->form_validation->set_rules('nik', 'No Nik', 'required|numeric');
		$this->form_validation->set_rules('nama_klien', 'Nama Klien', 'required');
		$this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'required');
		$this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'required');
		$this->form_validation->set_rules('jenis_kel', 'Jenis Kelamin', 'required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required');
		$this->form_validation->set_rules('rt', 'RT', 'required|numeric');
		$this->form_validation->set_rules('rw', 'RW', 'required|numeric');
		$this->form_validation->set_rules('desa', 'Desa', 'required');
		$this->form_validation->set_rules('kec', 'Kecamatan', 'required');
		$this->form_validation->set_rules('kab', 'Kabupaten', 'required');
		$this->form_validation->set_rules('pekerjaan', 'Pekerjaan', 'required');
		$this->form_validation->set_rules('warga_negara', 'Warga negara', 'required');
		$this->form_validation->set_rules('status', 'Status', 'required');
		$array =array();
		if($this->form_validation->run() != false){

			$tgl = explode("-", $this->input->post('tgl_lahir'));
			$random_number = rand(10,9999);
			$kode_barcode = "PLU-".$tgl[0].$tgl[1].$tgl[2].'-'.$random_number;

			$data = array(
							'nik'=> $this->input->post('nik'),
							'nama_klien'=> $this->input->post('nama_klien'),
							'tempat_lahir'=> $this->input->post('tempat_lahir'),
							'kode_barcode'=> $kode_barcode,
							'tgl_lahir'=> $this->input->post('tgl_lahir'),
							'jenis_kel'=> $this->input->post('jenis_kel'),
							'alamat'=> $this->input->post('alamat'),
							'rt'=> $this->input->post('rt'),
							'rw'=> $this->input->post('rw'),
							'desa'=> $this->input->post('desa'),
							'kec'=> $this->input->post('kec'),
							'kab'=> $this->input->post('kab'),
							'pekerjaan'=> $this->input->post('pekerjaan'),
							'warga_negara'=> $this->input->post('warga_negara'),
							'status'=> $this->input->post('status'),
							'id_user'=> $this->session->user,
						 );
			if($this->Klien_model->insert($data) == true){
				$this->session->set_flashdata('message_success',' Data Telah Berhasil Ditambahkan');
				$array['total_klien'] = $this->jumlah_klien();
				$array['output'] = true;
				//redirect('Klien');
				//return true;
			}else{
				$this->session->set_flashdata('message_fail',' Data Telah Gagal Ditambahkan');
				//redirect('Klien');
				//return false;
				$array['total_klien'] = $this->jumlah_klien();
				$array['output'] = false;
			}
		}else{
			//$this->form_insert();
			//return false;
			$array['total_klien'] = $this->jumlah_klien();
			$array['output'] = false;
		}
		echo json_encode($array);
	}


	public function update() 
	{
		$this->form_validation->set_rules('nik', 'No Nik', 'required|numeric');
		$this->form_validation->set_rules('nama_klien', 'Nama Klien', 'required');
		$this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'required');
		$this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'required');
		$this->form_validation->set_rules('jenis_kel', 'Jenis Kelamin', 'required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required');
		$this->form_validation->set_rules('rt', 'RT', 'required|numeric');
		$this->form_validation->set_rules('rw', 'RW', 'required|numeric');
		$this->form_validation->set_rules('desa', 'Desa', 'required');
		$this->form_validation->set_rules('kec', 'Kecamatan', 'required');
		$this->form_validation->set_rules('kab', 'Kabupaten', 'required');
		$this->form_validation->set_rules('pekerjaan', 'Pekerjaan', 'required');
		$this->form_validation->set_rules('warga_negara', 'Warga negara', 'required');
		$this->form_validation->set_rules('status', 'Status', 'required');
		$this->form_validation->set_rules('kode_barcode', 'Kode barcode', 'required');
		
		$id=$this->input->post('id');
		if($this->form_validation->run() != false){

			$tgl = explode("-", $this->input->post('tgl_lahir'));
			$random_number = rand(10,9999);
			$kode_barcode = "PLU-".$tgl[0].$tgl[1].$tgl[2].'-'.$random_number;

			$data = array(
							'id_klien'=> $id,
							'nik'=> $this->input->post('nik'),
							'nama_klien'=> $this->input->post('nama_klien'),
							'tempat_lahir'=> $this->input->post('tempat_lahir'),
							'kode_barcode'=> $this->input->post('kode_barcode'),
							'tgl_lahir'=> $this->input->post('tgl_lahir'),
							'jenis_kel'=> $this->input->post('jenis_kel'),
							'alamat'=> $this->input->post('alamat'),
							'rt'=> $this->input->post('rt'),
							'rw'=> $this->input->post('rw'),
							'desa'=> $this->input->post('desa'),
							'kec'=> $this->input->post('kec'),
							'kab'=> $this->input->post('kab'),
							'pekerjaan'=> $this->input->post('pekerjaan'),
							'warga_negara'=> $this->input->post('warga_negara'),
							'status'=> $this->input->post('status'),
							
						 );
			if($this->Klien_model->update($data) == true){
				$this->session->set_flashdata('message_success',' Data Telah Berhasil Diubah');
				redirect('Klien');
			}else{
				$this->session->set_flashdata('message_fail',' Data Telah Gagal Diubah');
				redirect('Klien');
			}
		}else{
			$this->edit($id);
		}
	}

	public function delete($id)
	{
		if($this->Klien_model->delete($id) == true){
			$this->session->set_flashdata('message_success',' Data Telah Berhasil Dihapus');
			redirect('Klien');
		}else{
			$this->session->set_flashdata('message_fail',' Data Telah Gagal Dihapus');
			redirect('Klien');
		}
	}


	public function jumlah_klien()
	{
		$data = $this->db->select('count(id_klien) as total_klien')->get('klien')->row();
		return $data->total_klien;
	}

	
}
