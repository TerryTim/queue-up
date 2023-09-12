<!-- 
<script type="text/javascript">
      document.getElementById("image").onchange = function(){
          document.getElementById("add_product").submit();
      };
    </script> -->

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class category extends CI_Controller {
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
	$data['title'] = "จัดการหมวดหมู่สินค้า";
	$data['category'] = $this->db->query("SELECT * FROM categories")->result_array();
	$this->load->view('store/category', $data);	
	}
	/* Log on to codeastro.com for more projects */
	public function view($product){
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
		$data['title'] = "เพิ่มหมวดหมู่สินค้า";
		$this->load->view('store/add_category', $data);
	}
    public function add(){
		$id = $this->getkod_model->get_id_category();

		$data = array(
			'category_id' => $id,
			'category_name' => $this->input->post('category_name'),
			'category_description' => $this->input->post('category_description')
			 );
			// die(print_r($simpan));
			$this->db->insert('categories', $data);
			// $this->session->set_flashdata('message', 'swal("Succeed", "New schedule has been added", "success");');
			$this->session->set_flashdata('success', 'เพิ่มหมวดหมู่สินค้าแล้ว');
			redirect('store/category');
		}
	

	public function editForm($category_id){
		$data['title'] = "แก้ไขหมวดหมู่สินค้า";
		$data['category'] = $this->db->query("SELECT * FROM categories WHERE category_id = '".$category_id."' ")->result_array();
		$this->load->view('store/edit_category', $data);
	}

	public function edit(){
			$category_id = $this->input->post('category_id');
			$data = array(
				'category_name' => $this->input->post('category_name'),
				'category_description' => $this->input->post('category_description')
				);
				$this->db->where('category_id', $category_id);
				$this->db->update('categories', $data);
				// $this->session->set_flashdata('message', 'swal("Succeed", "New schedule has been added", "success");');
				$this->session->set_flashdata('success', 'แก้ไขหมวดหมู่สินค้าแล้ว');
				redirect('store/category');
		
	}

	public function delete($category_id){
		$delete = $this->db->query("DELETE FROM categories where category_id = '".$category_id."' ");
		$this->session->set_flashdata('message', 'ลบหมวดหมู่สินค้าแล้ว');
		redirect('store/category');
	}
}

/* End of file ticket.php */
/* Location: ./application/controllers/store/ticket.php */