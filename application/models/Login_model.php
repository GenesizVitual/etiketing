<?php

class Login_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_data($data)
    {
        $this->db->select('id, nama_user, nip, username, password, level');

        if(!empty($data['id'])){
            $this->db->where('id', $data['id']);
        }
        if(!empty($data['username'])){
            $this->db->where('username', $data['username']);
        }
        if(!empty($data['password'])){
            $this->db->where('password', $data['password']);
        }
        $this->db->order_by('nama_user','ASC');
        $query = $this->db->get('user');
        return $query;
    }

    public function insert($data)
    {
        $this->db->insert('user', $data);
        return $this->db->affected_rows();
    }


    public function update($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('user', $data);
        return $this->db->affected_rows();
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('user');
        return $this->db->affected_rows();
    }    


}