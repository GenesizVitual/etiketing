<?php
class Rute_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_data($data)
    {
        $this->db->select('rute.id, jenis_kapal.nama_kapal,rute.kapal_id, rute.rute');
        $this->db->join('jenis_kapal','jenis_kapal.id = rute.kapal_id','Inner');

        if(!empty($data['id'])){
            $this->db->where('rute.id', $data['id']);
        }
        if(!empty($data['kapal_id'])){
            $this->db->where('rute.kapal_id', $data['kapal_id']);
        }

        $query = $this->db->get('rute');
        return $query;
    }

    public function insert($data)
    {
        $this->db->insert('rute', $data);
        return $this->db->affected_rows();
    }

    public function update($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('rute', $data);
        return $this->db->affected_rows();
    }       

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('rute');
        return $this->db->affected_rows();
    }    


}