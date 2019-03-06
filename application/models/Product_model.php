<?php

class Product_model extends CI_Model{
	public function __construct(){
		parent::__construct();
	}
	public function get($data = null){
		if($data === null){
			$q = $this->db->get('product');
		}elseif(isset($data)){
			$q = $this->db->get_where('product', $data);
		}else{
			$q = $this->db->get_where('product', array('id' => $data));
		}
		return $q->result_array();
	}
	public function search($data = null){
		if($data){
			$this->db->like('id', $data);
			$this->db->or_like('title', $data);
			$this->db->or_like('description', $data);
			$q = $this->db->get('product');
		}
		return $q->result_array();
	}
}