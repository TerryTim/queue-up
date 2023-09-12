<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	
	function __construct(){
	parent::__construct();
		$this->load->helper('dateindo_helper');
		$this->load->model('getkod_model');
		$this->getsecurity();
		date_default_timezone_set("Asia/Jakarta");
	}
	public function index(){
		$entrepreneur_id = $this->session->userdata('entrepreneur_id');
		$data['title'] = "Home";
		$data['order_today'] = $this->db->query("SELECT count(order_id) FROM orders 
		WHERE entrepreneur_id = '".$entrepreneur_id."' AND DATE(create_at) = DATE(NOW())")->result_array();
		$data['order'] = $this->db->query("SELECT count(order_id) FROM orders WHERE entrepreneur_id = '".$entrepreneur_id."'")->result_array();
		$data['product'] = $this->db->query("SELECT count(product_id) FROM products WHERE entrepreneur_id = '".$entrepreneur_id."'")->result_array();

		$data['category'] = $this->db->query("SELECT count(category_id) FROM categories")->result_array();
		$data['parcel_delivery_company'] = $this->db->query("SELECT count(company_id) FROM parcel_delivery_companies")->result_array();
		// $data['confirmation'] = $this->db->query("SELECT count(id_confirmation) FROM tbl_confirmation ")->result_array();
		// $data['bus'] = $this->db->query("SELECT count(id_bus) FROM tbl_bus WHERE status_bus = 1 ")->result_array();
		// $data['terminal'] = $this->db->query("SELECT count(id_destination) FROM tbl_destination")->result_array();
		// $data['schedules'] = $this->db->query("SELECT count(id_timetable) FROM tbl_timetable")->result_array();
		// die(print_r($data));
		$this->load->view('store/home', $data);
	}
	function getsecurity($value=''){
		$username = $this->session->userdata('email');
		if (empty($username)) {
			$this->session->sess_destroy();
			redirect('home');
		}
	}
}

/* End of file Home.php */
/* Log on to codeastro.com for more projects */
/* Location: ./application/controllers/store/Home.php */