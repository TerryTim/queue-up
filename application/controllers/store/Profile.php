<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {
	public function __construct(){
		parent::__construct();
		date_default_timezone_set("Asia/Jakarta");
		$this->load->library('session');
	}
	public function index(){
		// $this->load->view('frontend/profile');
		$id = $this->session->userdata('id_customer');
		$data['profile'] = $this->db->query("SELECT * FROM customer WHERE id_customer LIKE '".$id."'")->row_array();
		$this->load->view('frontend/profile',$data);
	}
	public function editprofile(){
		// $id = $this->input->post('kode');
		// $where = array('id_customer' => $id );
		$id = $this->session->userdata('entrepreneur_id');
		if(empty($_FILES["fileToUpload"]["name"])){
			$entrepreneur_id = $this->input->post('entrepreneur_id');
			$data = array(
				'firstname'  => $this->input->post('firstname'),
				'lastname'	    	=> $this->input->post('lastname'),
				'email'		=> $this->input->post('email'),
				'store_name'		=> $this->input->post('store_name'),
				'store_address'		=> $this->input->post('store_address'),
				'phone_number'		=> $this->input->post('phone_number'),
				'bank_account'		=> $this->input->post('bank_account'),
				'bank_account_name'	=> $this->input->post('bank_account_name'),
				'number_bank_account'		=> $this->input->post('number_bank_account'),
				);
			$sess = [
				'firstname	'  => $this->input->post('firstname	'),
				'lastname'	    	=> $this->input->post('lastname'),
				'email'		=> $this->input->post('email'),
				'store_name'		=> $this->input->post('store_name'),
				'store_address'		=> $this->input->post('store_address'),
				'phone_number'		=> $this->input->post('phone_number'),
				'bank_account'		=> $this->input->post('bank_account'),
				'bank_account_name'	=> $this->input->post('bank_account_name'),
				'number_bank_account'		=> $this->input->post('number_bank_account'),
			];
				$this->db->where('entrepreneur_id', $entrepreneur_id);
				$this->db->update('entrepreneurs', $data);
				$this->session->set_flashdata('success', 'แก้ไขข้อมูลร้านค้าแล้ว');
				header("Location: " . $_SERVER['HTTP_REFERER']);
				exit();
		}
		else{
		$target_dir = "uploads/";
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		// Check if image file is a actual image or fake image
		if(isset($_POST["submit"])) {
		$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		if($check !== false) {
			echo "File is an image - " . $check["mime"] . ".";
			$uploadOk = 1;
			$imageName = $_FILES["fileToUpload"]["name"];
			
			$newImageName = $id . "-".time(); // Generate new image name
            $newImageName .= '.' . $imageFileType;
			$fileDestination = 'assets/images/profiles/entrepreneurs/'.$newImageName;
			move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $fileDestination); 
		}
		}

		$entrepreneur_id = $this->input->post('entrepreneur_id');
		$data = array(
			'firstname'  => $this->input->post('firstname'),
			'lastname'	    	=> $this->input->post('lastname'),
			'email'		=> $this->input->post('email'),
			'store_name'		=> $this->input->post('store_name'),
			'store_address'		=> $this->input->post('store_address'),
			'phone_number'		=> $this->input->post('phone_number'),
			'bank_account'		=> $this->input->post('bank_account'),
			'bank_account_name'	=> $this->input->post('bank_account_name'),
			'number_bank_account'		=> $this->input->post('number_bank_account'),
			'store_image'	=>	$newImageName
			);
		$sess = [
			'firstname	'  => $this->input->post('firstname	'),
			'lastname'	    	=> $this->input->post('lastname'),
			'email'		=> $this->input->post('email'),
			'store_name'		=> $this->input->post('store_name'),
			'store_address'		=> $this->input->post('store_address'),
			'phone_number'		=> $this->input->post('phone_number'),
			'bank_account'		=> $this->input->post('bank_account'),
			'bank_account_name'	=> $this->input->post('bank_account_name'),
			'number_bank_account'		=> $this->input->post('number_bank_account'),
			'store_image'	=>	$newImageName
		];
			$this->db->where('entrepreneur_id', $entrepreneur_id);
			$this->db->update('entrepreneurs', $data);
			$this->session->set_flashdata('success', 'แก้ไขข้อมูลร้านค้าแล้ว');
			header("Location: " . $_SERVER['HTTP_REFERER']);
				exit();
		}
	}
	
	function getsecurity($value=''){
		$customer_id = $this->session->userdata('id_customer');
		// $order_customer_id = $this->db->query("SELECT customer_id FROM orders WHERE order_id = '".$value."' ");
		if (empty($customer_id)) {
			$this->session->sess_destroy();
			redirect('home');
		}
		// else if($customer_id !== $order_customer_id) {
		// 	redirect('profile/history');
		// }
	}
}

/* End of file Profile.php */
/* Location: ./application/controllers/Profile.php */