<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('order_model');
		$this->load->model('customer_model');
	}
	public function index()
	{
		$data_c['firstname'] = 'Chutirat';
		$data_c['lastname'] = 'Chaisan';
		$customer = $this->customer_model->get($data_c);
		
		$data_o['total'] = '555';
		$data_o['date'] = date('Y-m-d H:i:s');
		
		$data_p = [
			array("product_id" => "1", "price" => "111", "qty" => 15),
			array("product_id" => "2", "price" => "222", "discount" => "5", "qty" => 10),
		];
		
		if(is_array($customer) && count($customer) > 0){
			$data_o['customer_id'] = $customer[0]['id'];
			$this->order_model->insert($data_o, $data_p);
		}else{
			$customer_id = $this->customer_model->insert($data_c);
			if($customer_id === null || empty($customer_id)) return false;
			
			$data_o['customer_id'] = $this->customer_model->insert($data_c);
			$this->order_model->insert($data_o, $data_p);			
		}
		
		//$this->order_model->insert($data);
		//$this->load->view('store', $data);
	}
}
