<?php
class Jenis_tarif_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_data($data)
    {
        $this->db->select('jenis_tarif.id,jenis_retribusi.id as id_jr, jenis_retribusi.jenis_retribusi,jenis_tarif.jenis_tarif, jenis_tarif.harga, jenis_tarif.satuan');
        $this->db->join('jenis_retribusi','jenis_retribusi.id = jenis_tarif.id_jt','inner');

        if(!empty($data['id'])){
            $this->db->where('jenis_tarif.id', $data['id']);
        }

        $query = $this->db->get('jenis_tarif');
        return $query;
    }

    public function insert($data)
    {
        $this->db->insert('jenis_tarif', $data);
        return $this->db->affected_rows();
    }


    public function update($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('jenis_tarif', $data);
        return $this->db->affected_rows();
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('jenis_tarif');
        return $this->db->affected_rows();
    }    


}