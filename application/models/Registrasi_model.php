<?php
class Registrasi_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_data($data)
    {
        $this->db->select('registrasi_kartu.id,registrasi_kartu.id_klien, klien.nama_klien, klien.kode_barcode, registrasi_kartu.tgl_reg, user.nama_user');
        $this->db->join('registrasi_kartu','klien.id_klien=registrasi_kartu.id_klien','inner');
        $this->db->join('user', 'registrasi_kartu.id_user = user.id','inner');

        if(!empty($data['id'])){
            $this->db->where('klien.id_klien', $data['id']);
        }  
        if(!empty($data['id_klien'])){
            $this->db->where('registrasi_kartu.id_klien', $data['id_klien']);
        } 
        if(!empty($data['kode_barcode'])){
            $this->db->where('klien.kode_barcode', $data['kode_barcode']);
        }

        if(!empty($data['tanggal'])){
            $this->db->where('registrasi_kartu.tgl_reg >=',$data['tanggal']);
        }  

        if(!empty($data['tanggal_awal'])){
            $this->db->where('registrasi_kartu.tgl_reg >=',$data['tanggal_awal']);
        }
        if(!empty($data['tanggal_akhir'])){
            $this->db->where('registrasi_kartu.tgl_reg <=',$data['tanggal_akhir']);
        }
        $this->db->order_by('tgl_reg', 'DESC');
        $query = $this->db->get('klien');
        return $query;
    }

    public function insert($data)
    {
        $this->db->insert('registrasi_kartu', $data);
        return $this->db->affected_rows();
    }

    public function update($data)
    {
        $this->db->where('id_klien', $data['id_klien']);
        $this->db->update('registrasi_kartu', $data);
        return $this->db->affected_rows();
    }       

    public function delete($id)
    {
        $this->db->where('id_klien', $id);
        $this->db->delete('registrasi_kartu');
        return $this->db->affected_rows();
    }    


}