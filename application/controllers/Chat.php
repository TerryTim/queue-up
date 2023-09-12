<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chat extends CI_Controller {
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

	public function view($entrepreneur_id){
		$customer_id = $this->session->userdata('id_customer');
		$data = $this->db->query("SELECT * FROM chats
		WHERE customer_id ='$customer_id' AND entrepreneur_id = '$entrepreneur_id' ")->result_array();
		$response = array('success' => true, 'message' => 'Form submitted successfully');
		echo json_encode($response);
		$this->load->view('frontend/chat'.$data);
		// $this->load->view('frontend/chat',$data);
	}

	public function add(){
		if(empty($_FILES["fileToUpload"]["name"])){
			$id = $this->getkod_model->get_id_chat();
			$data = array(
				'chat_id' => $id,
				'customer_id'  => $this->session->userdata('id_customer'),
				'entrepreneur_id'   => $this->input->post('entrepreneur_id'),
				'text'      => $this->input->post('text'),
				'sender'    => $this->session->userdata('id_customer'),
			);
			$this->db->insert('chats', $data);
	
			// fetch the latest messages from the database
			$entrepreneur_id = $this->input->post('entrepreneur_id');
			$data['chat'] = $this->db
							// ->where('chat_id', $id)
							 ->where('entrepreneur_id', $entrepreneur_id)
							 ->join('entrepreneurs', 'chats.entrepreneur_id = entrepreneurs.entrepreneur_id')
							 ->order_by('date', 'asc')
							 ->order_by('time', 'asc')
							 ->get('chats')
							 ->result_array();
	
			// pass the latest messages to the view
			// $data['chat'] = $chat;
			$this->load->view('frontend/chatNew', $data);
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
			'customer_id'  => $this->session->userdata('id_customer'),
			'entrepreneur_id'	=> $this->input->post('entrepreneur_id'),
			'text'		=> $this->input->post('text'),
			'chat_image'		=> $newImageName,
			'sender'	=> $this->session->userdata('id_customer'),
			);
			$this->db->insert('chats', $data);
			// $this->session->set_flashdata('message', 'swal("Succeed", "New schedule has been added", "success");');
			// redirect('profile/profilesaya/');
		}
	}

	public function check_new_messages() {
		$id = $this->getkod_model->get_id_chat();
		// $entrepreneur_id = $this->input->post('entrepreneur_id');
		// $entrepreneur_id = 'EN0002';
		$entrepreneur_id = $this->input->get('entrepreneur_id');
		$q = intval(substr($id, 8));
		// $chat = $this->db
		// 				// ->where('chat_id', $q)
		// 				->where('entrepreneur_id', $entrepreneur_id)
		// 				//  ->join('entrepreneurs', 'chats.entrepreneur_id = entrepreneurs.entrepreneur_id')
		// 				 ->order_by('date', 'asc')
		// 				 ->order_by('time', 'asc')
		// 				 ->get('chats')
		// 				 ->result_array();

		$chat = $this->db
            ->select('chats.*, entrepreneurs.*')
            ->from('chats')
            ->join('entrepreneurs', 'chats.entrepreneur_id = entrepreneurs.entrepreneur_id')
            ->where('chats.entrepreneur_id', $entrepreneur_id)
			->where('chats.customer_id', $this->session->userdata('id_customer'))
            ->order_by('chats.date', 'asc')
            ->order_by('chats.time', 'asc')
            ->get()
            ->result_array();

		$data['chat'] = $chat;
		$this->load->view('frontend/chatNew', $data);
	  }
	  
}