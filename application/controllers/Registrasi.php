<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registrasi extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->model(array('Registrasi_model','Klien_model'));
		if(empty($this->session->user)){
			redirect('Login');
		}
	}

	public function index()
	{
		$v = 'Registrasi/content_default';
		$data['title']="Halaman Registrasi";
		$this->mylib->set_view($v,$data);
	}

	public function Data()
	{
		$v = 'Registrasi/data_registrasi';
		$data['title']="Halaman Data Registrasi";
		$this->mylib->set_view($v,$data);
	}

	public function get_data() {
		$data = $this->Registrasi_model->get_data(null)->result();
		$table = array();
		$no = 1;			
		foreach ($data as $key) {
			# code...
			$row = array();
			$row[] = $no++;
			$row[] = $key->nama_klien;
			$row[] = $key->kode_barcode;
			$table []= $row;
		}
		$container = array('data'=>$table);
		echo json_encode($container);
	}

	public function register($id_barcode)
	{
		
		$data = array( 
					   'id_klien' => $id_barcode,
					   'tgl_reg' => date('Y-m-d H:i:s', time()),
					   'id_user' => $this->session->user,
					   'id_jt' => 3
					 );
		$cek_klien = $this->db->select('id_klien')->where('id_klien', $id_barcode)->get('registrasi_kartu')->num_rows();
		$array = array();
		//echo $cek_klien;
		if($cek_klien < 1){
			
			$status = $this->Registrasi_model->insert($data);
			if($status == true){
				$this->session->set_flashdata('message_success',' Data Klien Telah Berhasil Diregistrasi');
				$array['total_registrasi_klien'] = $this->jumlah_klien_teregistrasi();
				$array['output'] = true; 
				//redirect('Registrasi/Data');
			}else{
				$this->session->set_flashdata('message_fail',' Data Klien Telah Berhasil Diregistrasi');
				$array['total_registrasi_klien'] = $this->jumlah_klien_teregistrasi();
				$array['output'] = false; 
				//redirect('Registrasi');
			}
		}else{
			$this->session->set_flashdata('message_fail',' Kartu Sudah teregistrasi');
			//redirect('Registrasi/Data');
			$array['total_registrasi_klien'] = $this->jumlah_klien_teregistrasi();
			$array['output'] = false; 
		}
		echo json_encode($array);
	}

	public function print_daftar()
	{	
		$v = 'Laporan/laporan_content';
		$data['title'] = "Daftar Kartu yang telah teregistrasi";
		$this->mylib->set_view($v,$data);
	}

	public function data_registrasi($data)
	{
		$data = $this->Registrasi_model->get_data($data)->result();
		$container = array();
		$x=1;
		foreach ($data as $key => $value) {
			# code...
			$row = array();
			$row[] = $x++;
			$dsk=explode("-", $value->tgl_reg); $sd = explode(" ", $dsk[2]);  
			//$row[] = $sd[0]."-".$dsk[1].'-'.$dsk[0].' '.$sd[1];
			$row[] = $sd[0]."-".$dsk[1].'-'.$dsk[0].' '.$sd[1];
			$row[] = $value->kode_barcode;
			$row[] = $value->nama_klien;
			$row[] = $value->nama_user;

			$container[] = $row;
		}
		$output = array('data' => $container);
		//echo json_encode($output);
		return $output;
	}

	public function table_registrasi($var)
	{
		$var = array('tanggal'=> date('Y-m-d', time()));
		echo json_encode($this->data_registrasi($var));
	}

	public function printBaseOnDate($var)
	{
		$tanggal = explode("%7C", $var);
		$var = array('tanggal_awal'=> $tanggal[0], 'tanggal_akhir'=>$tanggal[1]);
		$data = $this->data_registrasi($var);
		$v = 'Laporan/laporan_print';
		$this->load->view($v, $data);
		
	}


	public function jumlah_klien_teregistrasi()
	{
		$data = $this->db->select('count(id) as total')->get('registrasi_kartu')->row();
		// $array['registrasi'] = $data->total;
		// echo json_encode($array);
		return $data->total;
	}

	// public function form_insert()
	// {
	// 	$v = 'Pelabuhan/insert';
	// 	$data = array(
	// 					'title'=> "Tambah Pelabuhan",
	// 					'kapal' =>$this->Jenis_kapal_model->get_data(null)
	// 				);

	// 	$this->mylib->set_view($v,$data);
	// }


	// public function insert() 
	// {
	// 	$this->form_validation->set_rules('pelabuhan', 'Nama Pelabuhan', 'required');
	// 	$this->form_validation->set_rules('alamat_pel', 'Alamat Pelabuhan', 'required');
	// 	if($this->form_validation->run() != false){
	// 		$data = array(
	// 						'nama_pelabuhan'=> $this->input->post('pelabuhan'),
	// 						'alamat_pel'=> $this->input->post('alamat_pel'),
	// 					 );
	// 		if($this->Pelabuhan_model->insert($data) == true){
	// 			$this->session->set_flashdata('message_success',' Data Telah Berhasil Ditambahkan');
	// 			redirect('Pelabuhan');
	// 		}else{
	// 			$this->session->set_flashdata('message_fail',' Data Telah Gagal Ditambahkan');
	// 			redirect('Pelabuhan');
	// 		}
	// 	}else{
	// 		$this->form_insert();
	// 	}
	// }

	// public function form_edit($id) // form edit
	// {
	// 	$v = 'Pelabuhan/edit';
	// 	$data =array(
	// 				'title' => "Edit Jenis Kapal",
	// 				'data'  => $this->Pelabuhan_model->get_data(array('id'=>$id))->row()
	// 			);
	// 	$this->mylib->set_view($v,$data);
	// }	


	// public function update() 
	// {
	// 	$this->form_validation->set_rules('pelabuhan', 'Nama Pelabuhan', 'required');
	// 	$this->form_validation->set_rules('alamat_pel', 'Alamat', 'required');
	// 	$id=$this->input->post('id');
	// 	if($this->form_validation->run() != false){
	// 		$data = array(
	// 						'id'=> $id,
	// 						'nama_pelabuhan'=> $this->input->post('pelabuhan'),
	// 						'alamat_pel'=> $this->input->post('alamat_pel'),
	// 					);
	// 		if($this->Pelabuhan_model->update($data) == true){
	// 			$this->session->set_flashdata('message_success',' Data Telah Berhasil Diubah');
	// 			redirect('Pelabuhan');
	// 		}else{
	// 			$this->session->set_flashdata('message_fail',' Data Telah Gagal Diubah');
	// 			redirect('Pelabuhan');
	// 		}
	// 	}else{
	// 		$this->edit($id);
	// 	}
	// }

	// public function delete($id)
	// {
	// 	if($this->Pelabuhan_model->delete($id)== true){
	// 		$this->session->set_flashdata('message_success',' Data Telah Berhasil Dihapus');
	// 		redirect('Pelabuhan');
	// 	}else{
	// 		$this->session->set_flashdata('message_fail',' Data Telah Gagal Dihapus');
	// 		redirect('Pelabuhan');
	// 	}
	// }
}
