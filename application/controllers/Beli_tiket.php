<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Beli_tiket extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->model(array('Beli_tiket_model','Registrasi_model','Total_deposit','Rute_model','Jenis_tarif_model','klien_model'));
		if(empty($this->session->user)){
			redirect('Login');
		}
	}

	public function index()
	{
		$v = 'Beli_tiket/content_default';
		$data['title']="Halaman Retribusi dan Beli Tiket";
		$this->mylib->set_view($v,$data);
	}

	public function get_data($parameter) {
		$tgl_sekarang = date('Y-m-d', time());
		$data = $this->Registrasi_model->get_data(array('kode_barcode'=>$parameter,'tgl_beli'=>$tgl_sekarang))->result();
		$table = array();
		$no = 1;			
		foreach ($data as $key) {
			# code...
			$row = array();
			$row[] = $no++;
			$row[] = $key->nama_klien;
			$row[] = $key->kode_barcode;
			$row[] ='<a href="'.site_url('Beli_tiket/Beli_tiket/'.$key->id_klien).'" id="registrasi_" class="btn btn-outline btn-primary"> Buat Tiket </a>';
			$table[]= $row;
		}
		$container = array('data'=>$table);
		echo json_encode($container);
	}	

	public function get_tiket($parameter) {
		$tgl_sekarang = date('Y-m-d', time());
		$data = $this->Beli_tiket_model->get_data(array('kode_barcode'=>$parameter ,'tgl_beli'=>$tgl_sekarang))->result();
		$table = array();
		$no = 1;			
		foreach ($data as $key) {
			# code...
			$row = array();
			$row[] = $no++;
			$row[] = $key->nama_klien;
			$row[] = $key->kode_barcode;
			$dsk=explode("-", $key->tgl_beli); $sd = explode(" ", $dsk[2]);  
			//$row[] = $sd[0]."-".$dsk[1].'-'.$dsk[0].' '.$sd[1];
			$row[] = $sd[0]."-".$dsk[1].'-'.$dsk[0].' '.$sd[1];
			$row[] = $key->qty;
			$row[] = $key->jenis_tarif;
			$row[] = $key->harga;
			$row[] = $key->jumlah_total;
			if($key->status==0){
			$row[] = "<button onclick='hapus_deposit(".$key->id_bt.")' class='btn btn-outline btn-primary'>Hapus</button>"."<input style='margin-left:20px' type='checkbox' name='yg_dicetak' value=".$key->id_bt." checked>";
			}else{
				$row[] = "<button onclick='hapus_deposit(".$key->id_bt.")' class='btn btn-outline btn-primary'>Hapus</button>";
			} //'<a href="'.site_url('Beli_tiket/hapus/'.$key->id_bt).'" id="registrasi_" class="btn btn-outline btn-primary"> Hapus </a>';
			//$row[] ='<a href="'.site_url('Beli_tiket/cetak_tiket/'.$key->id_bt).'" id="registrasi_" class="btn btn-outline btn-primary"> Cetak Tiket </a>';
			$table[]= $row;
		}
		$container = array('data'=>$table);
		echo json_encode($container);
	}

	public function cetak_tiket($id_bt) {
		$v = 'Beli_tiket/cetak_tiket';
		$data['data']= $this->Beli_tiket_model->get_data(array('id'=>$id_bt))->row();
		$this->load->view($v, $data);
	}

	public function cetak_tiket_x($id_klien) {
		$v = 'Beli_tiket/cetak_tiket';
		$tgl_sekarang = date('Y-m-d', time());
		$data['klien'] = $this->klien_model->get_data(array('id_klien'=>$id_klien))->row();
		$data['data']  = $this->Beli_tiket_model->get_data(array('id_klien'=>$id_klien,'tgl_beli'=>$tgl_sekarang, 'status'=>0))->result();
		$data['sisa_deposit']  = $this->db->select('total_deposit')->where('id_klien',$id_klien)->get('total_deposit')->row();
		$data['sum_total'] = $this->Beli_tiket_model->sum_total(array('id_klien'=>$id_klien, 'tgl_beli'=>$tgl_sekarang,'status'=>0))->row();
		$this->load->view($v, $data);
	}

	public function Beli_tiket ($id_klien) {
		$v =  'Beli_tiket/insert';
		$data = array(
						'id_klien' => $id_klien,
						'data' => $this->Total_deposit->get_data(array('id_klien'=>$id_klien))->row(),
						'jt'   => $this->Jenis_tarif_model->get_data(null)->result(),
						'title' => "Halaman Retribusi dan Buat Tiket"
					 );
		$this->mylib->set_view($v,$data);
	}

	public function insert() 
	{
		$this->form_validation->set_rules('nama_klien', 'Nama Klien', 'required');
		$this->form_validation->set_rules('kode_barcode', 'Kode Barcode', 'required');
		$this->form_validation->set_rules('jumlah_deposit', 'Jumlah Deposit', 'required|numeric');
		$this->form_validation->set_rules('qty', 'Quantitas', 'required|numeric');
		$this->form_validation->set_rules('jenis_tarif', 'Jenis Tarif', 'required');
		$id = $this->input->post('id_klien');
		$array =array();
		if($this->form_validation->run() != false){
			
			$tarif = $this->Jenis_tarif_model->get_data(array('id'=>$this->input->post('jenis_tarif')))->row();
			$totals = $tarif->harga*$this->input->post('qty');
			if($totals > $this->input->post('jumlah_deposit'))
			{
				$kurang = $this->input->post('jumlah_deposit') - $totals;
				$this->session->set_flashdata('message_fail',' Tidak Bisa Buat Tiket Karena Nilai Deposit Kurang Rp :'.number_format($kurang,2,',',','));
				$this->Beli_tiket($id);	
			}else{
					$data = array(
							 'id_klien'=> $this->input->post('id_klien'),
							 'tgl_beli'=> date('Y-m-d H:i:s', time()),
							 'id_jt' => $this->input->post('jenis_tarif'),
							 'qty' => $this->input->post('qty'),
							 'jumlah_total' => $tarif->harga*$this->input->post('qty'),
							 'status'=>0,
							 'id_user'=>$this->session->user,
							);
					if($this->Beli_tiket_model->insert($data) == true){
						$this->session->set_flashdata('message_success','Tiket Telah Dibuat');
						$array['total_retribusi'] = $this->total_retribusi();
						$array['output'] = true;
						//redirect('Beli_tiket');
					}else{
						$this->session->set_flashdata('message_fail','Tiket Gagal Dibuat');
						$array['total_retribusi'] = $this->total_retribusi();
						$array['output'] = false;
						//redirect('Beli_tiket');
					}
			}
			
		}else{
			//$this->Beli_tiket($id);
			$array['total_retribusi'] = $this->total_retribusi();
			$array['output'] = false;
		}
		echo json_encode($array);
	}

	public function hapus($id)
	{
		$array =array();
		$status= $this->Beli_tiket_model->delete($id);
		if($status == true)
		{
			$this->session->set_flashdata('message_success','Tiket Telah Dihapus');
			$array['total_retribusi'] = $this->total_retribusi();
			$array['output'] = true;
			//redirect('Beli_tiket');
		}else{
			$this->session->set_flashdata('message_fail','Tiket Gagal Dihapus');
			$array['total_retribusi'] = $this->total_retribusi();
			$array['output'] = false;
			//redirect('Beli_tiket');
		}
		echo json_encode($array);
	}


	public function data_retribusi($parameter) {
		$data = $this->Beli_tiket_model->get_data($parameter)->result();
		$table = array();
		$no = 1;			
		foreach ($data as $key) {
			# code...
			$row = array();
			$row[] = $no++;
			$dsk=explode("-", $key->tgl_beli); $sd = explode(" ", $dsk[2]);  
			//$row[] = $sd[0]."-".$dsk[1].'-'.$dsk[0].' '.$sd[1];
			$row[] = $sd[0]."-".$dsk[1].'-'.$dsk[0].' '.$sd[1];
			$row[] = $key->nama_klien;
			$row[] = $key->jenis_retribusi;
			$row[] = $key->jenis_tarif;
			$row[] = $key->qty;
			$row[] = number_format($key->harga,0,'.','.');
			$row[] = number_format($key->jumlah_total,0,'.','.');
			$user = $this->db->select('user.nama_user')->where('id', $key->id_user)->get('user')->row();
			$row[] = $user->nama_user;
			//$row[] ='<a href="'.site_url('Beli_tiket/cetak_tiket/'.$key->id_bt).'" id="registrasi_" class="btn btn-outline btn-primary"> Cetak Tiket </a>';
			$table[]= $row;
		}
		$container = array('data'=>$table);
		return $container;
		//echo json_encode($container);
	}

	public function table_retribusi($var)
	{
		$var = array('tanggal'=> date('Y-m-d', time()));
		echo json_encode($this->data_retribusi($var));
	}

	public function print_daftarS()
	{	
		$v = 'Laporan/laporan_content_retribusi';
		$data['title'] = "Daftar Retribusi";
		$this->mylib->set_view($v,$data);
	}

	public function printBaseOnDate($var)
	{
		$tanggal = explode("%7C", $var);
		$var = array('tanggal_awal'=> $tanggal[0], 'tanggal_akhir'=>$tanggal[1]);
		$data = $this->data_retribusi($var);
		$data['total'] = $this->Beli_tiket_model->sum_total_laporan($var)->row();
		$v = 'Laporan/laporan_print_retribusi';
		$this->load->view($v, $data);
		//$this->mylib->set_view($v,$data);
		//echo json_encode($data);
		//echo json_encode();
	}

	public function total_retribusi() // DasdBoard
	{
		$date = Date('d-m-Y',Time());
		$tahun = explode("-", $date);
		$data = $this->db->select('sum(jumlah_total) as total_retribusi')->where('year(tgl_beli)='.$tahun[2])->get('beli_tiket')->row();
		// $arra['total_retribusi'] =$data->total_retribusi;
		// echo json_encode($data);
		return $data->total_retribusi;
	}

}
