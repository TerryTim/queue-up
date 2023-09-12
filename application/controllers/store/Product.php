<!-- 
<script type="text/javascript">
      document.getElementById("image").onchange = function(){
          document.getElementById("add_product").submit();
      };
    </script> -->

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class product extends CI_Controller {
	function __construct(){
	parent::__construct();
		$this->load->helper('dateindo_helper');
		$this->load->model('getkod_model');
		$this->getsecurity();
        $this->load->library('form_validation');
		date_default_timezone_set("Asia/Jakarta");
		$this->load->library('session');
	}
	function getsecurity($value=''){
		$username = $this->session->userdata('email');
		if (empty($username)) {
			$this->session->sess_destroy();
			redirect('login');
		}
	}
	public function index(){
	$entrepreneur_id = $this->session->userdata('entrepreneur_id');
	$data['title'] = "จัดการสินค้า";
	// $data['ticket'] = $this->db->query("SELECT * FROM tbl_ticket WHERE status_ticket = 2 ")->result_array();
	$data['product'] = $this->db->query("SELECT * FROM products WHERE entrepreneur_id = '".$entrepreneur_id."'")->result_array();
	// $this->session->remove('success');
	$this->load->view('store/product', $data);	
	}
	/* Log on to codeastro.com for more projects */
	public function view($product){
		$entrepreneur_id = $this->session->userdata('entrepreneur_id');
		$checkEntrepreneur = $this->db->query("SELECT entrepreneur_id FROM products WHERE product_id = '".$product."'");
		if ($checkEntrepreneur->num_rows() > 0) {
			$row = $checkEntrepreneur->row();
			$db_entrepreneur_id = $row->entrepreneur_id;
			
			// Check if the entrepreneur ID matches
			if ($db_entrepreneur_id !== $entrepreneur_id) {
			  // Redirect the user if the IDs don't match
			  redirect('store/product');
			}
		  }
		$data['title'] = "รายละเอียดสินค้า";
		$data['product'] = $this->db->query("SELECT * FROM products
		INNER JOIN categories ON products.category_id=categories.category_id
		INNER JOIN pickup ON products.pickup_id=pickup.pickup_id
		WHERE product_id = '".$product."' ")->row_array();
		if ($data['product']) {
			$this->load->view('store/view_product', $data);
		}else{
			// $this->session->set_flashdata('message', 'swal("Empty", "No Ticket", "error");');
    		redirect('store/product');
		}	
	}

	public function addForm(){
		$data['title'] = "เพิ่มสินค้า";
		$data['categories'] = $this->db->query("SELECT * FROM categories")->result_array();
		$data['pickup'] = $this->db->query("SELECT * FROM pickup")->result_array();
		$this->load->view('store/add_product', $data);
	}
    public function add(){
		$id = $this->getkod_model->get_id_product();

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
			$fileDestination = 'assets/images/products/'.$newImageName;
			move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $fileDestination); 

		} else {
			echo "File is not an image.";
			$uploadOk = 0;
		}
		}

		$data = array(
			'product_id' => $id,
			'product_name' => $this->input->post('product_name'),
			'product_description' => $this->input->post('product_description'),
			'product_image' => $newImageName,
			'product_price' => $this->input->post('product_price'),
			'pickup_id' =>  $this->input->post('pickup_id'),
			'shipping_cost' =>  $this->input->post('shipping_cost'),
			'quantity' =>  $this->input->post('quantity'),
			'category_id' =>  $this->input->post('category_id'),
			'entrepreneur_id' =>  $this->session->userdata('entrepreneur_id')
			 );
			// die(print_r($simpan));
			$this->db->insert('products', $data);
			// $this->session->set_flashdata('message', 'swal("Succeed", "New schedule has been added", "success");');
			$this->session->set_flashdata('success', 'เพิ่มสินค้าแล้ว');
			redirect('store/product');
		}
	

	public function editForm($product_id){
		$data['title'] = "แก้ไขสินค้า";
		$data['product'] = $this->db->query("SELECT * FROM products WHERE product_id = '".$product_id."' ")->result_array();
		$data['categories'] = $this->db->query("SELECT * FROM categories")->result_array();
		$data['pickup'] = $this->db->query("SELECT * FROM pickup")->result_array();
		$this->load->view('store/edit_product', $data);
	}

	public function edit(){

		if(empty($_FILES["fileToUpload"]["name"])){
			$product_id = $this->input->post('product_id');
			$data = array(
				'product_name' => $this->input->post('product_name'),
				'product_description' => $this->input->post('product_description'),
				'product_price' => $this->input->post('product_price'),
				'pickup_id' =>  $this->input->post('pickup_id'),
				'shipping_cost' =>  $this->input->post('shipping_cost'),
				'quantity' =>  $this->input->post('quantity'),
				'category_id' =>  $this->input->post('category_id')
				);
				$this->db->where('product_id', $product_id);
				$this->db->update('products', $data);
				// $this->session->set_flashdata('message', 'swal("Succeed", "New schedule has been added", "success");');
				$this->session->set_flashdata('success', 'แก้ไขสินค้าแล้ว');
				redirect('store/product');
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
			$fileDestination = 'assets/images/products/'.$newImageName;
			move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $fileDestination); 
		}
		}

		$product_id = $this->input->post('product_id');
		$data = array(
			'product_name' => $this->input->post('product_name'),
			'product_description' => $this->input->post('product_description'),
			'product_image' => $newImageName,
			'product_price' => $this->input->post('product_price'),
			'pickup_id' =>  $this->input->post('pickup_id'),
			'shipping_cost' =>  $this->input->post('shipping_cost'),
			'quantity' =>  $this->input->post('quantity'),
			'category_id' =>  $this->input->post('category_id')
			);
			$this->db->where('product_id', $product_id);
        	$this->db->update('products', $data);
			// $this->session->set_flashdata('message', 'swal("Succeed", "New schedule has been added", "success");');
			$this->session->set_flashdata('success', 'แก้ไขข้อมูลสินค้าแล้ว');
			redirect('store/product');
		}
	}

	public function delete($product_id){
		$delete = $this->db->query("DELETE FROM products where product_id = '".$product_id."' ");
		$this->session->set_flashdata('message', 'ลบสินค้าแล้ว');
		redirect('store/product');
	}
}

/* End of file ticket.php */
/* Location: ./application/controllers/store/ticket.php */