<?php

class Jamtangan_model extends CI_Model
{
    public function getJamtangan($id = null) 
    {
        if($id === null) {
            return $this->db->get('product')->result_array();
        } else {
            return $this->db->get_where('product', ['item_id' => $id])->result_array();
        }
    }
}