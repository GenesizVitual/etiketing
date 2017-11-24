<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Deposit extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->model(array('Deposit_model','Total_deposit','Registrasi_model'));
		
		if(empty($this->session->user)){
			redirect('Login');
		}
	}

	public function index()
	{
		$v = 'Deposit/content_default';
		$data['title']="Halaman Deposit";
		$this->mylib->set_view($v,$data);
	}
	
	public function get_data($parameter) {
		$data = $this->Registrasi_model->get_data(array('kode_barcode'=>$parameter))->result();
		$table = array();
		$no = 1;			
		foreach ($data as $key) {
			# code...
			$row = array();
			$row[] = $no++;
			$row[] = $key->nama_klien;
			$row[] = $key->kode_barcode;
			$row[] ='<a href="'.site_url('Deposit/deposit_in/'.$key->id_klien).'" id="registrasi_" class="btn btn-outline btn-primary"> Deposit </a>'.'<a href="'.site_url('Deposit/lihat_deposit/'.$key->id_klien).'" id="registrasi_" class="btn btn-outline btn-primary"> Lihat Deposit </a>';
			$table[]= $row;
		}
		$container = array('data'=>$table);
		echo json_encode($container);
	}

	public function getData($id_klien) {
		$data = $this->Deposit_model->get_data(array('id_klien'=>$id_klien))->result();
		$table = array();
		$no = 1;			
		foreach ($data as $key) {
			# code...
			$row = array();
			$row[] = $no++;
			$row[] = $key->nama_klien;
			$dsk=explode("-", $key->tgl_depos); $sd = explode(" ", $dsk[2]);  
			$row[] = $sd[0]."-".$dsk[1].'-'.$dsk[0].' '.$sd[1];
			$row[] = $key->jumlah_depos;
			$row[] ='<a href="javascript:void(0)" onclick="confirm_('.$key->id.','.$key->id_klien.')" id="registrasi_" class="btn btn-outline btn-primary"> Hapus </a>'.'<a href="'.site_url('Deposit/cetak_deposit_klien/'.$key->id).'" class="btn btn-outline btn-warning"> Cetak </a>';
			$table[]= $row;
			//'.site_url('Deposit/deposit_in/'.$key->id).'
		}
		$container = array('data'=>$table);
		echo json_encode($container);
	}	

	public function cetak_deposit_klien($id_deposit) {
		$data['data'] = $this->Deposit_model->get_data(array('id'=>$id_deposit))->row();
		$v = "Laporan/cetak_deposit_klien";
		$this->load->view($v, $data);
		//$this->mylib->set_view($v,$data);
	}


	public function deposit_in($key_klien)
	{
		$v = 'Deposit/insert';
		$data = array(
						'title'=> "Halaman Deposit",
						'data' =>$this->Registrasi_model->get_data(array('id_klien'=>$key_klien))->row()
					);

		$this->mylib->set_view($v,$data);
	}
	public function lihat_deposit ($key_klien)
	{
		$v = 'Deposit/lihat_deposit';
		$data = array(
						'title'=> "Halaman Klien Deposit",
						'id_klien'=> $key_klien,
					);
		$this->mylib->set_view($v,$data);
	}

	public function insert() 
	{
		$this->form_validation->set_rules('nama_klien', 'Nama Klien', 'required');
		$this->form_validation->set_rules('kode_barcode', 'Kode Barcode', 'required');
		$this->form_validation->set_rules('jumlah_deposit', 'Jumlah Deposit', 'required|numeric');
		$array =array();
		$id= $this->input->post('id_klien');
		if($this->form_validation->run() != false){
			$data = array(
							'id_klien'=> $this->input->post('id_klien'),
							'tgl_depos'=> date('Y-m-d H:i:s', time()),
							'jumlah_depos' => $this->input->post('jumlah_deposit'),
							'id_user'=> $this->session->user
						 );
			$cek = $this->Total_deposit->get_data(array('id_klien'=>$this->input->post('id_klien')))->row();
			if($this->Deposit_model->insert($data) == true){
				$this->session->set_flashdata('message_success',' Data deposit Telah Berhasil Ditambahkan');
			
				//redirect('Deposit');
				if(empty($cek)){
					$this->Total_deposit->insert(array('id_klien'=>$this->input->post('id_klien'), 'total_deposit'=>$this->input->post('jumlah_deposit')));
					//redirect('Deposit');
					$array['total_deposit'] = $this->total_deposit();
					$array['id'] = $id;
					$array['output'] = true;


				}else{
					//redirect('Deposit');
					$array['total_deposit'] = $this->total_deposit();
					$array['id'] = $id;
					$array['output'] = true;
				}
			}else{
				$this->session->set_flashdata('message_fail',' Data deposit Telah Gagal Ditambahkan');
				//redirect('Deposit');
				$array['total_deposit'] = $this->total_deposit();
				$array['id'] = $id;
				$array['output'] = false;
			}
		}else{
			//$this->form_insert();
			$array['total_deposit'] = $this->total_deposit();
			$array['id'] = $id;
			$array['output'] = false;
		}
		echo json_encode($array);
	}

	public function delete($id,$id_klien){
		$array=array();
		$status = $this->Deposit_model->delete($id);
		if($status == true){
			$this->session->set_flashdata('message_success',' Data deposit Telah Berhasil dihapus');
						
			$array['total_deposit'] = $this->total_deposit();
			$array['id'] = $id_klien;
			$array['output'] = true;	
		}else{
			$this->session->set_flashdata('message_fail',' Data deposit tidak terhapus');
			$array['total_deposit'] = $this->total_deposit();
			$array['id'] = $id_klien;
			$array['output'] = true;
		}
		echo json_encode($array);
	}

	public function print_daftarS()
	{	
		$v = 'Laporan/laporan_content_deposit';
		$data['title'] = "Daftar Deposit Klien";
		$this->mylib->set_view($v,$data);
	}

	public function table_deposit($var)
	{
		$var = array('tanggal'=> date('Y-m-d', time()));
		echo json_encode($this->data_deposit($var));
	}

	public function data_deposit($data){
		$data = $this->Deposit_model->get_data($data)->result();
		$container = array();
		$x=1;
		foreach ($data as $key => $value) {
			# code...
			$row = array();
			$row[] = $x++;
				$dsk=explode("-", $value->tgl_depos); $sd = explode(" ", $dsk[2]);  
			//$row[] = $sd[0]."-".$dsk[1].'-'.$dsk[0].' '.$sd[1];
			$row[] = $sd[0]."-".$dsk[1].'-'.$dsk[0].' '.$sd[1];
			$row[] = $value->nama_klien;
			$user = $this->db->select('nama_user')->where('id', $value->id_user)->get('user')->row();
			$row[] = $user->nama_user;
			$row[] = number_format($value->jumlah_depos,0,'.','.');

			$container[] = $row;
		}
		$output = array('data' => $container);
		//echo json_encode($output);
		return $output;
	}

	public function printBaseOnDate($var)
	{
		$tanggal = explode("%7C", $var);
		$var = array('tanggal_awal'=> $tanggal[0], 'tanggal_akhir'=>$tanggal[1]);
		$data = $this->data_deposit($var);
		$data['total'] = $this->Deposit_model->Sum_depoist($var)->row();
		$v = 'Laporan/laporan_print_deposit';
		$this->load->view($v, $data);
		//$this->mylib->set_view($v,$data);
		//echo json_encode($data);
		//echo json_encode();
	}

	
	public function total_deposit()// DasdBoard
	{
		$date = Date('d-m-Y',Time());
		$tahun = explode("-", $date);
		$data = $this->db->select('sum(jumlah_depos) as total_deposit')->where('year(tgl_depos)='.$tahun[2])->get('deposit')->row();
		// $arra['total_deposit'] =$data->total_deposit;
		// echo json_encode($data);
		return $data->total_deposit;
	}


}

