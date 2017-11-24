<?php
class Pelabuhan_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_data($data)
    {
        $this->db->select('pelabuhan.id, pelabuhan.nama_pelabuhan, pelabuhan.alamat_pel');
         if(!empty($data['id'])){
            $this->db->where('pelabuhan.id', $data['id']);
        }

        $query = $this->db->get('pelabuhan');
        return $query;
    }

    public function insert($data)
    {
        $this->db->insert('pelabuhan', $data);
        return $this->db->affected_rows();
    }

    public function update($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('pelabuhan', $data);
        return $this->db->affected_rows();
    }       

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('pelabuhan');
        return $this->db->affected_rows();
    }    


}