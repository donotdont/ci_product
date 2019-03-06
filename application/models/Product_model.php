<?php

class Product_model extends CI_Model{
	public function __construct(){
		parent::__construct();
	}
	public function get($data = null){
		if($data === null){
			$q = $this->db->get('product');
		}elseif(is_array($data)){
			$q = $this->db->get_where('product', $data);
		}else{
			$q = $this->db->get_where('product', array('id' => $data));
		}
		$this->db->like('status', 'active');
		return $q->result_array();
	}
	public function search($data = null){
		if($data){
			$this->db->like('id', $data);
			$this->db->or_like('title', $data);
			$this->db->or_like('description', $data);
			$this->db->or_like('status', 'active');
			$q = $this->db->get('product');
		}
		return $q->result_array();
	}
}