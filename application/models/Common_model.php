<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Common_model extends CI_Model{
	public function insert($table,$data){
		$this->db->insert($table,$data);
		if($this->db->insert_id() > 0)
			return $this->db->insert_id();
		return false;
	}
	public function sumVFieldValue($table,$field,$where = null)
	{
		$this->db->select_sum($field);
		if($where!=null){
			$this->db->where($where);
		}
		$result = $this->db->get($table)->row();  
		return $result->{$field};
	}
	public function add($table,$data){
		$this->db->insert($table,$data);
		if($this->db->insert_id() > 0)
			return $this->db->insert_id();
		return false;
	}
	public function getAll($table,$where=null, $order_by = null){
		$this->db->select()->from($table);
		if($where != null){
			$this->db->where($where);
		}
		if($order_by != null) {
			$this->db->order_by($order_by[0], $order_by[1]);
		}
		$query=$this->db->get();
		if($query->num_rows() > 0)
			return $query->result();
		return false;
	}
	public function update($table,$where,$data){
			if($this->db->set($data)->where($where)->update($table))
				return true;
			return false;
		}
	public function getById($table, $id) {
			return $this->db->query("SELECT * FROM $table WHERE id = $id ")->row();
		}
		
	public function delete($table, $where) {
			return $this->db->where($where)->delete($table);
		}	
	public function getOne($table,$where=null){
		$query=$this->db->select()->from($table)->where($where)->get();
		if($query->num_rows()  > 0){
			return $query->row();
		}else{
			return false;
		}
	}
	public function universal($query=null){
		if($query!=null)
			return $this->db->query($query);
	}
	public function countRows($table,$where=null){
		if($where!=null)
			$this->db->where($where);
		$this->db->from($table);
		$count=$this->db->count_all_results();
		return $count;
	}
	public function getMaximumValue($table,$field=null){
		if($table != null) {
			$this->db->select_max($field);
			$query = $this->db->get($table);
			return ($query) ? $query->row() : false;
		}
		return false;
	}
}