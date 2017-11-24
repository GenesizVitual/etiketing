<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	
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
		$v = 'content_default';
		$data['title']="Halaman DasdBoard";
		$data['user'] = $this->session->user;
		$data['total_klien'] = $this->jumlah_klien();
		$data['total_registrasi_klien'] = $this->jumlah_klien_teregistrasi();
		$data['total_deposit'] = $this->total_deposit();
		$data['total_retribusi'] = $this->total_retribusi();
		$this->mylib->set_view($v,$data);
	}

	public function get_all_total()
	{
		$array =array();
		$array['total_klien'] = $this->jumlah_klien();
		$array['total_registrasi_klien'] = $this->jumlah_klien_teregistrasi();
		$array['total_deposit'] = $this->total_deposit();
		$array['total_retribusi'] = $this->total_retribusi();
		echo json_encode($array);
	}

	public function jumlah_klien()
	{
		$data = $this->db->select('count(id_klien) as total_klien')->get('klien')->row();
		return $data->total_klien;
	}

	public function jumlah_klien_teregistrasi()
	{
		$data = $this->db->select('count(id) as total')->get('registrasi_kartu')->row();
		// $array['registrasi'] = $data->total;
		// echo json_encode($array);
		return $data->total;
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


	public function total_retribusi() // DasdBoard
	{
		$date = Date('d-m-Y',Time());
		$tahun = explode("-", $date);
		$data = $this->db->select('sum(jumlah_total) as total_retribusi')->where('year(tgl_beli)='.$tahun[2])->get('beli_tiket')->row();
		// $arra['total_retribusi'] =$data->total_retribusi;
		// echo json_encode($data);
		return $data->total_retribusi;
	}

	public function get_chart(){
		$data =$this->db->query('SELECT sum(jumlah_total) as value,YEAR(tgl_beli) as year FROM beli_tiket GROUP by year(tgl_beli),month(tgl_beli)')->result();
		echo json_encode($data);
	}
}
