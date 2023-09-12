<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class booking extends CI_Controller {
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

    public function checkout($product_id){
		$data['product'] = $this->db->query("SELECT product_id, product_name,product_description,
		product_image, product_price, quantity, shipping_cost, categories.category_name, entrepreneurs.store_name, 
		entrepreneurs.store_image, pickup.pickup_id, pickup.pickup_option, bank_account, bank_account_name, number_bank_account, firstname,
		lastname FROM `products` 
		LEFT JOIN categories ON products.category_id=categories.category_id 
		LEFT JOIN entrepreneurs ON products.entrepreneur_id=entrepreneurs.entrepreneur_id
		LEFT JOIN pickup ON products.pickup_id=pickup.pickup_id
		WHERE products.product_id = '".$product_id."' ")->result_array();
		$this->load->view('frontend/checkout', $data);
    }
	public function add($product_id){
		$info_product = $this->db->query("SELECT product_id, pickup_id, entrepreneur_id 
		FROM products WHERE product_id = '".$product_id."' ");
		// $info_product = "SELECT product_id, pickup_id, entrepreneur_id 
		// FROM products WHERE product_id = '".$product_id."' ";
        $id = $this->getkod_model->get_id_order();
		$target_dir = "uploads/";
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		$tmpName = $_FILES["fileToUpload"]["tmp_name"];
		// Check if image file is a actual image or fake image
		if(isset($_POST["submit"])) {
		$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		if($check !== false) {
			echo "File is an image - " . $check["mime"] . ".";
			$uploadOk = 1;
			$imageName = $_FILES["fileToUpload"]["name"];
			
			$newImageName = $id . "-".time(); // Generate new image name
            $newImageName .= '.' . $imageFileType;
			$fileDestination = 'assets/images/payment_proof/'.$newImageName;
			move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $fileDestination); 

		} else {
			echo "File is not an image.";
			$uploadOk = 0;
		}
		}
		$row = $info_product->row();
		$data = array(
			'order_id' => $id,
			'pickup_id' => $row->pickup_id,
			// 'pickup_time' => $this->input->post('pickup_time'),
			'product_id' => $row->product_id,
			'customer_id' => $this->session->userdata('id_customer'),
			'payment_status	' => "ชำระเงินแล้ว",
			'payment_proof' => $newImageName,
			'entrepreneur_id' =>  $row->entrepreneur_id,
			'quantity' =>  $this->input->post('quantity'),
			'pickup_date' =>  $this->input->post('pickup_date'),
			'shipping_address' =>  $this->input->post('address')
			);

			$this->db->insert('orders', $data);
			$this->session->set_flashdata('success', 'สั่งจองสินค้าแล้ว');
			redirect('profile/history');
	}
}