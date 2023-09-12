<!-- 
<script type="text/javascript">
      document.getElementById("image").onchange = function(){
          document.getElementById("add_product").submit();
      };
    </script> -->

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class parcel_delivery_company extends CI_Controller {
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
	$data['title'] = "จัดการบริษัทขนส่ง";
	$data['parcel_delivery_company'] = $this->db->query("SELECT * FROM parcel_delivery_companies")->result_array();
	$this->load->view('store/parcel_delivery_company', $data);	
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
		$data['title'] = "เพิ่มบริษัทขนส่ง";
		$this->load->view('store/add_parcel_delivery_company', $data);
	}
    public function add(){
		$id = $this->getkod_model->get_id_parcel_delivery_company();

		$data = array(
			'company_id' => $id,
			'company_name' => $this->input->post('company_name'),
			'description' => $this->input->post('description')
			 );
			// die(print_r($simpan));
			$this->db->insert('parcel_delivery_companies', $data);
			// $this->session->set_flashdata('message', 'swal("Succeed", "New schedule has been added", "success");');
			$this->session->set_flashdata('success', 'เพิ่มบริษัทขนส่งแล้ว');
			redirect('store/parcel_delivery_company');
		}
	

	public function editForm($company_id){
		$data['title'] = "แก้ไขบริษัทขนส่ง";
		$data['parcel_delivery_company'] = $this->db->query("SELECT * FROM parcel_delivery_companies WHERE company_id = '".$company_id."' ")->result_array();
		$this->load->view('store/edit_parcel_delivery_company', $data);
	}

	public function edit(){
			$company_id = $this->input->post('company_id');
			$data = array(
				'company_name' => $this->input->post('company_name'),
				'description' => $this->input->post('description')
				);
				$this->db->where('company_id', $company_id);
				$this->db->update('parcel_delivery_companies', $data);
				// $this->session->set_flashdata('message', 'swal("Succeed", "New schedule has been added", "success");');
				$this->session->set_flashdata('success', 'แก้ไขบริษัทขนส่งแล้ว');
				redirect('store/parcel_delivery_company');
		
	}

	public function delete($company_id){
		$delete = $this->db->query("DELETE FROM parcel_delivery_companies where company_id = '".$company_id."' ");
		$this->session->set_flashdata('message', 'ลบบริษัทขนส่งแล้ว');
		redirect('store/parcel_delivery_company');
	}
}

/* End of file ticket.php */
/* Location: ./application/controllers/store/ticket.php */