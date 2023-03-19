<?php
class Deliveries_pagination_model extends CI_Model
{
   public function getRows($table,$postData,$column_order,$column_search,$order=null,$where=null)
   {
        $this->_get_datatables_query($table,$postData,$column_order,$column_search,$order,$where);
        if($postData['length'] != -1){
            $this->db->limit($postData['length'], $postData['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }
    public function countAll($table,$where=null){
        $this->db->from($table);
        if($where!=null){
          $this->db->where($where);
        }
        return $this->db->count_all_results();
    }
    public function countFiltered($table,$postData,$column_order,$column_search,$order=null,$where=null){
        $this->_get_datatables_query($table,$postData,$column_order,$column_search,$order,$where);
        $query = $this->db->get();
        return $query->num_rows();
    }
    public function _get_datatables_query($table,$postData,$column_order,$column_search,$order=null,$where=null)
    {
    	$this->db->select("
    		orders_detail.id as id,
    		orders_detail.customer_id as customer_id,
            orders_detail.rider_id as rider_id,
    		orders_detail.master_id as master_id,
    		orders_detail.bility_no as bility_no,
    		orders_detail.bility_desc as bility_desc,
    		orders_detail.qty as qty,
    		orders_detail.price as price,
            orders_detail.unloading_expenses as unloading_expenses,
            orders_detail.expenses as expenses,
            orders_detail.total as total,
    		orders_detail.status as status,
    		orders_detail.created_at as created_at,
            customers.customer_name as customer_name,
    		riders.rider_name as rider_name
    	");
        $this->db->from($table);
        $this->db->join('customers', 'customers.id = orders_detail.customer_id', "inner");
        $this->db->join('riders', 'riders.id = orders_detail.rider_id', "inner");
        if($where!=null){
          $this->db->where($where);
        }
        $i = 0;
        foreach($column_search as $item){
            if($postData['search']['value']){
                if($i===0){
                    $this->db->group_start();
                    $this->db->like($item, $postData['search']['value']);
                }else{
                    $this->db->or_like($item, $postData['search']['value']);
                }
                if(count($column_search) - 1 == $i){
                    $this->db->group_end();
                }
            }
            $i++;
        }
        if(isset($postData['order'])){
            $this->db->order_by($column_order[$postData['order']['0']['column']], $postData['order']['0']['dir']);
        }else if(isset($order) && $order!=null){
            $order = $order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
}