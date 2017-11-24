<?php
class Jenis_kapal_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_data($data)
    {
        $this->db->select('id, nama_kapal, kapasitas_penumpang, thn_pembuatan');

        if(!empty($data['id'])){
            $this->db->where('id', $data['id']);
        }

        $query = $this->db->get('jenis_kapal');
        return $query;
    }

    public function insert($data)
    {
        $this->db->insert('jenis_kapal', $data);
        return $this->db->affected_rows();
    }

    public function update($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('jenis_kapal', $data);
        return $this->db->affected_rows();
    }       

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('jenis_kapal');
        return $this->db->affected_rows();
    }    


}