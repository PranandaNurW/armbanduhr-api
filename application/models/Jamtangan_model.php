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

    public function deleteJamtangan($id)
    {
        $this->db->delete('product', ['item_id' => $id]);
        return $this->db->affected_rows();
    }

    public function createJamtangan($data)
    {
        $this->db->insert('product', $data);
        return $this->db->affected_rows();
    }

    public function updateJamtangan($data, $id)
    {
        $this->db->update('product', $data, ['item_id' => $id]);
        return $this->db->affected_rows();
    }
}