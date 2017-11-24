<?php
class Beli_tiket_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_data($data)
    {
        $this->db->select('beli_tiket.id_bt,klien.id_klien as id_klien,beli_tiket.id_user, jenis_tarif.jenis_tarif, jenis_tarif.harga, beli_tiket.qty, beli_tiket.tgl_beli, jenis_retribusi.jenis_retribusi, beli_tiket.jumlah_total , klien.nama_klien, total_deposit.total_deposit, klien.kode_barcode, beli_tiket.status, beli_tiket.jumlah_total');
        $this->db->join('jenis_tarif','beli_tiket.id_jt = jenis_tarif.id','inner');
        $this->db->join('jenis_retribusi','jenis_tarif.id_jt = jenis_retribusi.id','inner');
       $this->db->join('klien','klien.id_klien = beli_tiket.id_klien','inner');
        $this->db->join('total_deposit','total_deposit.id_klien = beli_tiket.id_klien','inner');
    
        if(!empty($data['id'])){
            $this->db->where('beli_tiket.id_bt', $data['id']);
        }

        if(!empty($data['kode_barcode'])){
            $this->db->where('klien.kode_barcode', $data['kode_barcode']);
        }

        if(!empty($data['id_klien'])){
            $this->db->where('beli_tiket.id_klien', $data['id_klien']);
            //$this->db->where('beli_tiket.status', 0);
        }

        if(!empty($data['tgl_beli'])){
            $this->db->where('beli_tiket.tgl_beli >=', $data['tgl_beli']);
        }


        if(!empty($data['tanggal'])){
            $this->db->where('beli_tiket.tgl_beli >=',$data['tanggal']);
        }  

        if(!empty($data['tanggal_awal'])){
            $this->db->where('beli_tiket.tgl_beli >=',$data['tanggal_awal']);
        }
        if(!empty($data['tanggal_akhir'])){
            $this->db->where('beli_tiket.tgl_beli <=',$data['tanggal_akhir']);
        } 

        if(!empty($data['status'])){
            $this->db->where('beli_tiket.status',$data['status']);
        }

        $this->db->order_by('tgl_beli','DESC');
        $query = $this->db->get('beli_tiket');
        return $query;
    }

    public function sum_total($data)
    {
        $this->db->select('sum(jumlah_total) as total_keseluruhan')->where('id_klien', $data['id_klien'])->where('tgl_beli >=', date('Y-m-d', time()))->where('status',$data['status']);
        return $this->db->get('beli_tiket');
    }

    public function sum_total_laporan($data)
    {
        $this->db->select('sum(jumlah_total) as jumlah_total')->where('tgl_beli >=', $data['tanggal_awal'])->where('tgl_beli <=', $data['tanggal_akhir']);
        return $this->db->get('beli_tiket');
    }

    public function insert($data)
    {
        $this->db->insert('beli_tiket', $data);
        return $this->db->affected_rows();
    }


    // public function update($data)
    // {
    //     $this->db->where('id_bt', $data['id']);
    //     $this->db->update('beli_tiket', $data);
    //     return $this->db->affected_rows();
    // }

    public function delete($id)
    {
        $this->db->where('id_bt', $id);
        $this->db->delete('beli_tiket');
        return $this->db->affected_rows();
    }    


}