<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {
	public function __construct(){
		parent::__construct();
		date_default_timezone_set("Asia/Jakarta");
	}
	public function index(){
		// $this->load->view('frontend/profile');
		$id = $this->session->userdata('id_customer');
		$data['profile'] = $this->db->query("SELECT * FROM customer WHERE id_customer LIKE '".$id."'")->row_array();
		$this->load->view('frontend/profile',$data);
	}
	public function profilesaya(){
		$id = $this->session->userdata('id_customer');
		$data['profile'] = $this->db->query("SELECT * FROM customer WHERE id_customer = '".$id."'")->row_array();
		// die(print_r($data));
		$this->load->view('frontend/profile',$data);
	}
	public function editprofile(){
		// $id = $this->input->post('kode');
		// $where = array('id_customer' => $id );
		$id = $this->session->userdata('id_customer');
		if(empty($_FILES["fileToUpload"]["name"])){
			$id_customer = $this->input->post('id_customer');
			$data = array(
				'name_customer'  => $this->input->post('name'),
				'email_customer'	    	=> $this->input->post('email'),
				'address_customer'		=> $this->input->post('address'),
				'phone_customer'		=> $this->input->post('phone_number'),
				);
			$sess = [
				'name_lengkap'   => $this->input->post('name'),
				'email'   => $this->input->post('email'),
				'phone'   => $this->input->post('phone_number'),
				'address'	=> $this->input->post('address'),
			];
				$this->db->where('id_customer', $id_customer);
				$this->db->update('customer', $data);
				$this->session->set_flashdata('success', 'แก้ไขข้อมูลส่วนตัวแล้ว');
				redirect('profile/profilesaya/');
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
			$fileDestination = 'assets/images/profiles/customers/'.$newImageName;
			move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $fileDestination); 
		}
		}

		$id_customer = $this->input->post('id_customer');
		$data = array(
			'name_customer'  => $this->input->post('name'),
			'email_customer'	    	=> $this->input->post('email'),
			'img_customer'		=> $newImageName,
			'address_customer'		=> $this->input->post('address'),
			'phone_customer'		=> $this->input->post('phone_number'),
			);
		$sess = [
			'name_lengkap'	=> $this->input->post('name'),
			'img_customer'	=> $newImageName,
			'email'   => $this->input->post('email'),
			'phone'   => $this->input->post('phone_number'),
			'address'	=> $this->input->post('address'),
		];
			$this->db->where('id_customer', $id_customer);
        	$this->db->update('customer', $data);
			$this->session->set_flashdata('success', 'แก้ไขข้อมูลส่วนตัวแล้ว');
			redirect('profile/profilesaya/');
		}
	}
	
	public function history(){
		$this->getsecurity();
		$id = $this->session->userdata('id_customer');
		$data['customer'] = $this->db->query("SELECT 
		customer.username_customer, 
		orders.order_id, orders.payment_proof, orders.create_at, orders.quantity,
		products.product_name, products.product_image, products.product_price, 
		products.shipping_cost, pickup.pickup_option, 
		entrepreneurs.store_name,
		order_status.order_status_id, order_status.order_status_name 
		FROM customer 
		INNER JOIN orders ON customer.id_customer=orders.customer_id
		INNER JOIN products ON orders.product_id=products.product_id
		INNER JOIN pickup ON orders.pickup_id=pickup.pickup_id
		INNER JOIN entrepreneurs ON orders.entrepreneur_id=entrepreneurs.entrepreneur_id
		INNER JOIN order_status ON orders.order_status_id=order_status.order_status_id
		WHERE id_customer ='".$id."' ORDER BY orders.create_at DESC")->result_array();
		// die(print_r($data));
		$this->load->view('frontend/history2',$data);
	}

	public function order($order_id){
		$this->getsecurity();
		// $id = $this->session->userdata('id_customer');
		$data['order'] = $this->db->query("SELECT
		order_id, orders.payment_proof, orders.create_at, orders.quantity, orders.payment_status,
		orders.shipping_address, orders.parcel_delivery_company_id, orders.shipping_tracking,
		products.product_id, products.product_name, products.product_image, products.product_price, 
		products.shipping_cost, pickup.pickup_id, pickup.pickup_option, 
		entrepreneurs.store_name,
		order_status.order_status_id, order_status.order_status_name, 
		parcel_delivery_companies.company_id, parcel_delivery_companies.company_name
		FROM orders 
		INNER JOIN products ON orders.product_id=products.product_id
		INNER JOIN pickup ON orders.pickup_id=pickup.pickup_id
		INNER JOIN entrepreneurs ON orders.entrepreneur_id=entrepreneurs.entrepreneur_id
		INNER JOIN order_status ON orders.order_status_id=order_status.order_status_id
		INNER JOIN parcel_delivery_companies ON orders.parcel_delivery_company_id=parcel_delivery_companies.company_id
		WHERE order_id = '".$order_id."' ")->result_array();
		$data['rating'] = $this->db->query("SELECT order_id, customer_id FROM ratings
		WHERE order_id = '".$order_id."' ")->result_array();

		$data['product'] = $this->db->query("SELECT entrepreneurs.entrepreneur_id, 
		entrepreneurs.store_name
		FROM orders
		INNER JOIN entrepreneurs ON orders.entrepreneur_id=entrepreneurs.entrepreneur_id 
		WHERE order_id ='".$order_id."' ")->result_array();

		$data['chat'] = $this->db->query("SELECT chats.entrepreneur_id, chats.text, chats.chat_image, chats.sender,
		chats.date, chats.time, entrepreneurs.store_name, entrepreneurs.store_image, customer.username_customer,
		customer.img_customer
		FROM chats
		LEFT JOIN entrepreneurs ON chats.entrepreneur_id = entrepreneurs.entrepreneur_id
		LEFT JOIN customer ON chats.customer_id = customer.id_customer 
		WHERE chats.customer_id = '".$this->session->userdata('id_customer')."' 
		AND chats.entrepreneur_id = '".$data['product'][0]['entrepreneur_id']."'
		ORDER BY chats.date ASC, chats.time ASC"
		)->result_array();
		// die(print_r($data));
		$this->load->view('frontend/order',$data);
	}

	public function changepassword($id=''){
		$this->load->library('form_validation');
		$customer = $this->db->query("SELECT password_customer FROM customer where id_customer ='".$id."'")->row_array();
		// die(print_r($customer));
		$this->form_validation->set_rules('currentpassword', 'currentpassword', 'trim|required|min_length[8]',array(
			'required' => 'Enter Password',
			 ));
		$this->form_validation->set_rules('new_password1', 'new_password1', 'trim|required|min_length[8]|matches[new_password2]',array(
			'required' => 'Enter Password.',
			'matches' => 'Password Not Same.',
			'min_length' => 'Password Minimal 8 Characters.'
			 ));
		$this->form_validation->set_rules('new_password2', 'new_password2', 'trim|required|min_length[8]|matches[new_password1]',array(
			'required' => 'Enter Password.',
			'matches' => 'Password Not Same.',
			'min_length' => 'Password Minimal 8 Characters.'
			 ));
		if ($this->form_validation->run() == false) {
			$this->load->view('frontend/changepassword');
		} else {
			$currentpassword = $this->input->post('currentpassword');
			$newpassword 	 = $this->input->post('new_password1');
			if (!password_verify($currentpassword, $customer['password_customer'])) {
				$this->session->set_flashdata('gagal', '<div class="alert alert-danger" role="alert">Previous Password Wrong</div>');
				redirect('profile/changepassword');
			}elseif ($currentpassword == $newpassword) {
				$this->session->set_flashdata('gagal', '<div class="alert alert-danger" role="alert">
				Passwords cant be the same before
					</div>');
				redirect('profile/changepassword');
			}else{
				$password_hash = password_hash($newpassword, PASSWORD_DEFAULT);
				$where = array('id_customer' => $id );
				$update = array(
				'password_customer'			=> $password_hash,
				 );
				$this->db->update('customer', $update,$where);
				// $this->session->set_flashdata('message', 'swal("Success", "Your password has been changed successfully", "success");');
				redirect('profile/profilesaya/'.$id);
			}
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