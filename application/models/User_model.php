<?php if(!defined('BASEPATH')) exit('No direct script allowed');

class User_model extends CI_Model{

	public function get_user($q) {
		return $this->db->get_where('users',$q);
	}

	public function createUser($data)
    {
        $this->db->insert('users', $data);
        return $this->db->affected_rows();
    }

	
}