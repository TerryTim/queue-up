<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class rating extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->helper('dateindo_helper');
		$this->load->model('getkod_model');
		date_default_timezone_set("Asia/Jakarta");
	}
	function getsecurity($value=''){
		$email = $this->session->userdata('email');
		if (empty($email)) {
			redirect('login');
		}
	}

    public function rating($order_id){
        $id = $this->getkod_model->get_rating_id();
        $entrepreneur_id = $this->db->query("SELECT entrepreneur_id FROM orders 
        WHERE order_id = '".$order_id."' ");
        $row = $entrepreneur_id->row();
		$data = array(
			'rating_id' => $id,
			'customer_id' => $this->session->userdata('id_customer'),
			'order_id' => $order_id,
			'order_rating' => $this->input->post('order_rating'),
			'entrepreneur_id' => $row->entrepreneur_id,
			'store_rating' => $this->input->post('store_rating'),
			'comment' =>  $this->input->post('comment')
			 );
			$this->db->insert('ratings', $data);
			$this->session->set_flashdata('success', 'ให้คะแนนสินค้าและร้านค้าแล้ว');
			redirect('profile/order/'.$order_id);
    }
}