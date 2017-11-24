<?php
class Jenis_retribusi_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_data($data)
    {
        $this->db->select('*');
        
       if(!empty($data['id'])){
            $this->db->where('jenis_retribusi.id', $data['id']);
        }

        $query = $this->db->get('jenis_retribusi');
        return $query;
    }

    public function insert($data)
    {
        $this->db->insert('jenis_retribusi', $data);
        return $this->db->affected_rows();
    }


    public function update($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('jenis_retribusi', $data);
        return $this->db->affected_rows();
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('jenis_retribusi');
        return $this->db->affected_rows();
    }    


}