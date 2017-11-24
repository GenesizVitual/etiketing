<?php
class Klien_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_data($data)
    {
        $this->db->select('*');

        if(!empty($data['id'])){
            $this->db->where('id_klien', $data['id']);
        }
        if(!empty($data['kode_barcode'])){
            $this->db->where('kode_barcode', $data['kode_barcode']);
        }
        $this->db->order_by('created_at', 'DESC');
       // $this->db->limit(1);
        $query = $this->db->get('klien');
        return $query;
    }

    public function insert($data)
    {
        $this->db->insert('klien', $data);
        return $this->db->affected_rows();
    }

    public function update($data)
    {
        $this->db->where('id_klien', $data['id_klien']);
        $this->db->update('klien', $data);
        return $this->db->affected_rows();
    }       

    public function delete($id)
    {
        $this->db->where('id_klien', $id);
        $this->db->delete('klien');
        return $this->db->affected_rows();
    }    


}