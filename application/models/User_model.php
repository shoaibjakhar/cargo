<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User_model extends CI_Model {
	public function user_login($table,$where=null) {
            $this->db->select();
            $this->db->from($table);
            $this->db->where($where);
            $query = $this->db->get();
            return $query->result_array();
    }
    public function update_password($table,$where=null,$data=null) {
            $this->db->select();
            $this->db->from($table);
            $this->db->where($where);
            $this->db->set($data);
           $query=$this->db->update();
           return $query;
    }
}