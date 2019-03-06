<?php

class Order_model extends CI_Model{
	public function __construct(){
		parent::__construct();
	}
	public function get($data = null){
		if($data === null){
			$q = $this->db->get('order');
		}elseif(is_array($data)){
			$q = $this->db->get_where('order', $data);
		}else{
			$q = $this->db->get_where('order', array('id' => $data));
		}
		return $q->result_array();
	}
	public function insert($data = null, $products = null){
		if(isset($data)){
			$data['date'] = date('Y-m-d H:i:s');
			$this->db->insert('order', $data);
			$order_id = $this->db->insert_id();
			if($order_id > 0 && isset($products)){
				
				foreach($products as $key_product => $product){
					$product['order_id'] = $order_id;
					$this->db->insert('order_product', $product);
				}
			}
		}
		return $this->db->insert_id();
	}
}