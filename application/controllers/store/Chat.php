<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class chat extends CI_Controller {
	function __construct(){
	parent::__construct();
		$this->load->helper('dateindo_helper');
		$this->load->model('getkod_model');
		$this->getsecurity();
        $this->load->library('form_validation');
		date_default_timezone_set("Asia/Jakarta");
	}
	function getsecurity($value=''){
		$username = $this->session->userdata('email');
		if (empty($username)) {
			$this->session->sess_destroy();
			redirect('home');
		}
	}
	public function index(){
		$this->getsecurity();
		$entrepreneur_id = $this->session->userdata('entrepreneur_id');
		$data['title'] = "ข้อความ";
		// $data['ticket'] = $this->db->query("SELECT * FROM tbl_ticket WHERE status_ticket = 2 ")->result_array();
		$data['chatHeader'] = $this->db->query("SELECT chats.chat_id, chats.customer_id, MAX(chats.text) as text, 
		MAX(chats.chat_image) as chat_image,
		MAX(chats.sender) as sender, MAX(chats.date) as date, MAX(chats.time) as time,
		MAX(chats.new) as new, MAX(customer.username_customer) as username_customer,
		MAX(customer.img_customer) as img_customer,
		customer.img_customer
		FROM chats
		LEFT JOIN customer ON chats.customer_id = customer.id_customer 
		WHERE chats.entrepreneur_id = '".$entrepreneur_id."'
		AND chats.sender != '".$entrepreneur_id."'
		GROUP BY chats.customer_id
		ORDER BY MAX(chats.date) ASC, MAX(chats.time) ASC")->result_array();

		
		$this->load->view('store/chat', $data);
	}

	public function view($customer_id){
		$this->getsecurity();
		$entrepreneur_id = $this->session->userdata('entrepreneur_id');
		$data['title'] = "ข้อความ";
		// $data['ticket'] = $this->db->query("SELECT * FROM tbl_ticket WHERE status_ticket = 2 ")->result_array();
		$data['chatHeader'] = $this->db->query("SELECT chats.chat_id, chats.customer_id, MAX(chats.text) as text, 
		MAX(chats.chat_image) as chat_image,
		MAX(chats.sender) as sender, MAX(chats.date) as date, MAX(chats.time) as time,
		MAX(chats.new) as new, MAX(customer.username_customer) as username_customer,
		MAX(customer.img_customer) as img_customer,
		customer.img_customer
		FROM chats
		LEFT JOIN customer ON chats.customer_id = customer.id_customer 
		WHERE chats.entrepreneur_id = '".$entrepreneur_id."'
		AND chats.sender != '".$entrepreneur_id."'
		GROUP BY chats.customer_id
		ORDER BY MAX(chats.date) ASC, MAX(chats.time) ASC")->result_array();

		$data['chat'] = $this->db->query("SELECT chats.entrepreneur_id, chats.customer_id, 
		chats.chat_id, chats.text,	chats.chat_image, chats.sender,
		chats.date, chats.time, entrepreneurs.store_name, entrepreneurs.store_image, customer.username_customer,
		customer.img_customer
		FROM chats
		LEFT JOIN entrepreneurs ON chats.entrepreneur_id = entrepreneurs.entrepreneur_id
		LEFT JOIN customer ON chats.customer_id = customer.id_customer 
		WHERE chats.customer_id = '".$customer_id."' 
		AND chats.entrepreneur_id = '".$entrepreneur_id."'
		ORDER BY chats.date ASC, chats.time ASC")->result_array();
		$this->load->view('store/chat', $data);
	}

	public function add(){
		if(empty($_FILES["fileToUpload"]["name"])){
			$id = $this->getkod_model->get_id_chat();
			$data = array(
				'chat_id' => $id,
				'entrepreneur_id'  => $this->session->userdata('entrepreneur_id'),
				'customer_id'   => $this->input->post('customer_id'),
				'text'      => $this->input->post('text'),
				'sender'    => $this->session->userdata('entrepreneur_id'),
			);
			$this->db->insert('chats', $data);
	
			// fetch the latest messages from the database
			$customer_id = $this->input->post('customer_id');
			$chat = $this->db
							// ->where('chat_id', $id)
							 ->where('customer_id', $customer_id)
							 ->where('entrepreneur_id', $this->session->userdata('entrepreneur_id'))
							 ->join('customer', 'chats.customer_id = customer.id_customer')
							 ->order_by('date', 'asc')
							 ->order_by('time', 'asc')
							 ->get('chats')
							 ->result_array();
	
			// pass the latest messages to the view
			$data['chat'] = $chat;
			$this->load->view('store/chatNew', $data);
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
			
			$id = $this->session->userdata('id_customer');
			$newImageName = $id . "-".time(); // Generate new image name
            $newImageName .= '.' . $imageFileType;
			$fileDestination = 'assets/images/chats/'.$newImageName;
			move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $fileDestination); 
		}
		}

		$id = $this->getkod_model->get_id_chat();
		$data = array(
			'chat_id' => $id,
			'entrepreneur_id'  => $this->session->userdata('entrepreneur_id'),
			'customer_id'	=> $this->input->post('customer_id'),
			'text'		=> $this->input->post('text'),
			'chat_image'		=> $newImageName,
			'sender'	=> $this->session->userdata('entrepreneur_id'),
			);
			$this->db->insert('chats', $data);
			// $this->session->set_flashdata('message', 'swal("Succeed", "New schedule has been added", "success");');
			// redirect('profile/profilesaya/');
		}
	}

	public function check_new_messages() {
		$this->getsecurity();
		$id = $this->getkod_model->get_id_chat();
		// $customer_id = $this->input->post('customer_id');
		// $entrepreneur_id = $this->session->userdata('entrepreneur_id');

		$customer_id = $this->input->get('customer_id');
		// $customer_id = 'CA0024';
		$q = intval(substr($id, 8));
		$chat = $this->db
            ->select('chats.*, customer.*')
            ->from('chats')
            ->join('customer', 'chats.customer_id = customer.id_customer')
            ->where('chats.customer_id', $customer_id)
			->where('chats.entrepreneur_id', $this->session->userdata('entrepreneur_id'))
            ->order_by('chats.date', 'asc')
            ->order_by('chats.time', 'asc')
            ->get()
            ->result_array();

		$data['chat'] = $chat;
		$this->load->view('store/chatNew', $data);
	  }
}

/* End of file ticket.php */
/* Location: ./application/controllers/store/ticket.php */