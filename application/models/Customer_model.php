<?php

class Customer_model extends CI_Model{
	public function __construct(){
		parent::__construct();
	}
	public function get($data = null){
		if($data === null){
			$q = $this->db->get('customer');
		}elseif(is_array($data)){
			$q = $this->db->get_where('customer', $data);
		}else{
			$q = $this->db->get_where('customer', array('id' => $data));
		}
		return $q->result_array();
	}
	public function insert($data = null){
		if(isset($data)){
			$data['date'] = date('Y-m-d H:i:s');
			$this->db->insert('customer', $data);
		}
		return $this->db->insert_id();
	}
}