<?php

class Db extends CI_Model
{
    public function __construct()	
    {
      $this->load->database(); 
    }

    public function add_data($table, $data)
    {
        return $this->db->insert($table, $data);
    }

    public function delete_data($table, $id)
    {
        return $this->db->where("ID", $id)->delete($table);
    }

    public function update_data($table, $id, $data)
    {
        return $this->db->where("ID", $id)->update($table, $data);
    }

    public function getall_data($table)
    {
        return $this->db->get($table);
    }

    public function get_data($table, $field, $value)
    {
        return $this->db->where($field, $value)->get($table);
    }
}
