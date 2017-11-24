<?php
class Deposit_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_data($data)
    {
        $this->db->select('deposit.id, deposit.id_user,klien.id_klien, deposit.tgl_depos, klien.nama_klien, klien.kode_barcode, deposit.jumlah_depos');
        $this->db->join('klien',' deposit.id_klien= klien.id_klien','Inner');

        if(!empty($data['id'])){
            $this->db->where('deposit.id', $data['id']);
        }
        if(!empty($data['id_klien'])){
            $this->db->where('deposit.id_klien', $data['id_klien']);
        }

        if(!empty($data['tanggal'])){
            $this->db->where('deposit.tgl_depos >=',$data['tanggal']);
        }  

        if(!empty($data['tanggal_awal'])){
            $this->db->where('deposit.tgl_depos >=',$data['tanggal_awal']);
        }
        if(!empty($data['tanggal_akhir'])){
            $this->db->where('deposit.tgl_depos <=',$data['tanggal_akhir']);
        }


        $this->db->order_by('deposit.tgl_depos','DESC');
        $query = $this->db->get('deposit');
        return $query;
    }    

    public function Sum_depoist($data)
    {
        $this->db->select('sum(deposit.jumlah_depos) as jumlah_total');
    
        if(!empty($data['tanggal'])){
            $this->db->where('deposit.tgl_depos >=',$data['tanggal']);
        }  

        if(!empty($data['tanggal_awal'])){
            $this->db->where('deposit.tgl_depos >=',$data['tanggal_awal']);
        }
        if(!empty($data['tanggal_akhir'])){
            $this->db->where('deposit.tgl_depos <=',$data['tanggal_akhir']);
        }


        $this->db->order_by('deposit.tgl_depos','ASC');
        $query = $this->db->get('deposit');
        return $query;
    }

    public function insert($data)
    {
        $this->db->insert('deposit', $data);
        return $this->db->affected_rows();
    }

    public function update($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('deposit', $data);
        return $this->db->affected_rows();
    }       

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('deposit');
        return $this->db->affected_rows();
    }    


}