<?php
class Total_deposit extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_data($data)
    {
        $this->db->select('*');
        $this->db->join('klien','klien.id_klien = total_deposit.id_klien','inner');

        if(!empty($data['id_klien'])){
            $this->db->where('total_deposit.id_klien', $data['id_klien']);
        }

        $query = $this->db->get('total_deposit');
        return $query;
    }

    public function insert($data)
    {
        $this->db->insert('total_deposit', $data);
        return $this->db->affected_rows();
    }

    // public function update($data)
    // {
    //     $this->db->where('id', $data['id']);
    //     $this->db->update('deposit', $data);
    //     return $this->db->affected_rows();
    // }       

    // public function delete($id)
    // {
    //     $this->db->where('id', $id);
    //     $this->db->delete('deposit');
    //     return $this->db->affected_rows();
    // }    


}