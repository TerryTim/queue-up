<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller {
	function __construct(){
	parent::__construct();
		$this->load->helper('dateindo_helper');
		$this->load->model('getkod_model');
		$this->getsecurity();
		date_default_timezone_set("Asia/Jakarta");
	}
	function getsecurity($value=''){
		if (empty($this->session->userdata('email'))) {
			$this->session->sess_destroy();
			redirect('login');
		}
	}
	public function index(){
		$entrepreneur_id = $this->session->userdata('entrepreneur_id');
		$data['title'] = "รายการคำสั่งจอง";
		$data['order'] = $this->db->query("SELECT order_id, order_status_name, orders.quantity,
		order_status.order_status_id,
		pickup_option, payment_status, payment_proof, customer_id, orders.create_at,
		product_name, new, entrepreneurs.entrepreneur_id
		FROM orders
		LEFT JOIN order_status ON orders.order_status_id=order_status.order_status_id
		LEFT JOIN pickup ON orders.pickup_id=pickup.pickup_id
		LEFT JOIN products ON orders.product_id=products.product_id
        LEFT JOIN entrepreneurs ON orders.entrepreneur_id=entrepreneurs.entrepreneur_id
        WHERE entrepreneurs.entrepreneur_id = '".$entrepreneur_id."'
        ORDER BY orders.create_at DESC;")->result_array();
 		// $data['order'] = $this->db->query("SELECT * FROM tbl_order group by id_order")->result_array();
		// die(print_r($data));
		$this->load->view('store/order', $data);
	}

	public function select_today(){
		$entrepreneur_id = $this->session->userdata('entrepreneur_id');
		$data['title'] = "รายการคำสั่งจอง";
		$data['order'] = $this->db->query("SELECT order_id, order_status_name, orders.quantity,
		order_status.order_status_id,
		pickup_option, payment_status, payment_proof, customer_id, orders.create_at,
		product_name, new, entrepreneurs.entrepreneur_id
		FROM orders
		LEFT JOIN order_status ON orders.order_status_id=order_status.order_status_id
		LEFT JOIN pickup ON orders.pickup_id=pickup.pickup_id
		LEFT JOIN products ON orders.product_id=products.product_id
		LEFT JOIN entrepreneurs ON orders.entrepreneur_id=entrepreneurs.entrepreneur_id
		WHERE entrepreneurs.entrepreneur_id = '".$entrepreneur_id."'
		AND DATE(orders.create_at) = CURDATE()
		ORDER BY orders.create_at DESC;")->result_array();
 		// $data['order'] = $this->db->query("SELECT * FROM tbl_order group by id_order")->result_array();
		// die(print_r($data));
		$this->load->view('store/order', $data);
	}
	/* Log on to codeastro.com for more projects */
	public function vieworder($id=''){
		// die(print_r($_GET));
		$entrepreneur_id = $this->session->userdata('entrepreneur_id');
		$check = $this->input->get('order').$id;
		$checkEntrepreneur = $this->db->query("SELECT entrepreneur_id FROM orders WHERE order_id = '".$check."'");

		if ($checkEntrepreneur->num_rows() > 0) {
			$row = $checkEntrepreneur->row();
			$db_entrepreneur_id = $row->entrepreneur_id;
			
			// Check if the entrepreneur ID matches
			if ($db_entrepreneur_id !== $entrepreneur_id) {
			  // Redirect the user if the IDs don't match
			  redirect('store/order');
			}
		  }
	 	$sqlcheck = $this->db->query("SELECT order_id, orders.order_status_id, order_status_name, 
		orders.quantity, orders.shipping_tracking, orders.shipping_address, orders.pickup_date, orders.create_at,
		pickup.pickup_id, pickup.pickup_option, payment_status, payment_proof, customer_id, orders.create_at,
		product_name, product_price, product_image, shipping_cost, id_customer, username_customer,
		name_customer,
		parcel_delivery_companies.company_id, parcel_delivery_companies.company_name
		FROM orders
		INNER JOIN order_status ON orders.order_status_id=order_status.order_status_id
		INNER JOIN pickup ON orders.pickup_id=pickup.pickup_id
		INNER JOIN products ON orders.product_id=products.product_id
		INNER JOIN customer ON orders.customer_id=customer.id_customer
		INNER JOIN parcel_delivery_companies ON orders.parcel_delivery_company_id=parcel_delivery_companies.company_id
		WHERE order_id ='".$check."' ")->result_array();
	 	if ($sqlcheck) {
	 		$data['order'] = $sqlcheck;
			$data['title'] = "View Bookings";
			$data['parcel_company'] = $this->db->query("SELECT * FROM parcel_delivery_companies")->result_array();
			// die(print_r($sqlcheck));
			$this->load->view('store/view_order',$data);
	 	}else{
	 		// $this->session->set_flashdata('message', 'swal("Empty", "No Order", "error");');
    		redirect('store/order');
	 	}
	}

	public function accept($order_id=''){
		// $order_id = $this->input->post('order_id');
		$data = array(
			'new'  => '0',
			'order_status_id' => 'ORD_S002'
		);
		$this->db->where('order_id', $order_id);
		$this->db->update('orders', $data);
		$this->session->set_flashdata('success', 'อนุมัติคำสั่งจองแล้ว');
		redirect('store/order/vieworder/'.$order_id);
	}

	public function deny($order_id=''){
		// $order_id = $this->input->post('order_id');
		$data = array(
			'new'  => '0',
			'order_status_id' => 'ORD_S006'
			// 'note' => $this->input->post('note');
		);
		$this->db->where('order_id', $order_id);
		$this->db->update('orders', $data);
		$this->session->set_flashdata('message', 'ปฏิเสธคำสั่งจองแล้ว');	
		redirect('store/order/vieworder/'.$order_id);
	}

	public function addTracking(){
		$order_id = $this->input->post('order_id');
		$data = array(
			'order_status_id' => 'ORD_S004',
			'parcel_delivery_company_id'  => $this->input->post('company_id'),
			'shipping_tracking' => $this->input->post('shipping_tracking')
		);
		$this->db->where('order_id', $order_id);
		$this->db->update('orders', $data);
		$this->session->set_flashdata('success', 'เพิ่มหมายเลขพัสดุแล้ว');
		redirect('store/order/vieworder/'.$order_id);
	}

	public function prepare($order_id=''){
		// $order_id = $this->input->post('order_id');
		$data = array(
			'order_status_id' => 'ORD_S003'
			// 'note' => $this->input->post('note');
		);
		$this->db->where('order_id', $order_id);
		$this->db->update('orders', $data);
		$this->session->set_flashdata('success', 'เปลี่ยนสถานะเป็นกำลังเตรียมสินค้าแล้ว');
		redirect('store/order/vieworder/'.$order_id);
	}

	public function done($order_id=''){
		// $order_id = $this->input->post('order_id');
		$data = array(
			'order_status_id' => 'ORD_S007'
			// 'note' => $this->input->post('note');
		);
		$this->db->where('order_id', $order_id);
		$this->db->update('orders', $data);
		$this->session->set_flashdata('success', 'เปลี่ยนสถานะเป็นเตรียมสินค้าเสร็จแล้ว');
		redirect('store/order/vieworder/'.$order_id);
	}

	public function customer_has_received($order_id=''){
		// $order_id = $this->input->post('order_id');
		$data = array(
			'order_status_id' => 'ORD_S005'
			// 'note' => $this->input->post('note');
		);
		$this->db->where('order_id', $order_id);
		$this->db->update('orders', $data);
		$this->session->set_flashdata('success', 'เปลี่ยนสถานะเป็นลูกค้าได้รับสินค้าแล้ว');
		redirect('store/order/vieworder/'.$order_id);
	}

	public function insertticket($value=''){
		$id = $this->input->post('id_order');
		$origin = $this->input->post('origin_beli');
		$ticket = $this->input->post('id_ticket');
		$name = $this->input->post('name');
		$seat = $this->input->post('no_seat');
		$age = $this->input->post('age_seat');
		$price = $this->input->post('price');
		$date = $this->input->post('date_beli');
		$status = $this->input->post('status');
		$where = array('id_order' => $id );
		$update = array('status_order' => $status );
		$this->db->update('tbl_order', $update,$where);
		$data['origin'] = $this->db->query("SELECT * FROM tbl_destination WHERE id_destination ='".$origin."'")->row_array();
		$data['print'] = $this->db->query("SELECT * FROM tbl_order LEFT JOIN tbl_timetable on tbl_order.id_timetable = tbl_timetable.id_timetable LEFT JOIN tbl_destination on tbl_timetable.id_destination = tbl_destination.id_destination WHERE id_order ='".$id."'")->result_array();
		$customer = $this->db->query("SELECT email_customer FROM customer WHERE id_customer ='".$data['print'][0]['id_customer']."'")->row_array();
		$pdfFilePath = "assets/store/upload/eticket/".$id.".pdf";
		$html = $this->load->view('frontend/printticket', $data, TRUE);
		$this->load->library('m_pdf');
		$this->m_pdf->pdf->WriteHTML($html);
		$this->m_pdf->pdf->Output($pdfFilePath);
		for ($i=0; $i < count($name) ; $i++) { 
			$simpan = array(
				'id_ticket' => $ticket[$i],
				'id_order' => $id,
				'name_ticket' => $name[$i],
				'seat_ticket' => $seat[$i],
				'age_ticket' => $age[$i],
				'origin_beli_ticket' => $origin,
				'price_ticket' => $price,
				'status_ticket' => $status,
				'eticket_ticket' => $pdfFilePath,
				'create_date_ticket' => date('Y-m-d'),
				'create_admin_ticket' => $this->session->userdata('username_admin')
			);
		$this->db->insert('tbl_ticket', $simpan);
		}
		$this->session->set_flashdata('message', 'swal("Succeed", "Ticket Order Processed Successfully", "success");');
		redirect('store/order');

		
	}
	/* Log on to codeastro.com for more projects */
	public function kirimemail($id=''){
		$data['print'] = $this->db->query("SELECT * FROM tbl_order LEFT JOIN tbl_timetable on tbl_order.id_timetable = tbl_timetable.id_timetable LEFT JOIN tbl_destination on tbl_timetable.id_destination = tbl_destination.id_destination WHERE id_order ='".$id."'")->result_array();
		$origin = $data['print'][0]['origin_order'];
		$kodeplg = $data['print'][0]['id_customer'];
		$data['origin'] = $this->db->query("SELECT * FROM tbl_destination WHERE id_destination ='$origin'")->row_array();
		$customer = $this->db->query("SELECT email_customer FROM customer WHERE id_customer ='$kodeplg'")->row_array();
		//email
		$subject = 'E-ticket - Order ID '.$id.' - '.date('dmY');
		$message = $this->load->view('frontend/printticket', $data ,TRUE);
		$attach  = base_url("assets/store/upload/eticket/".$id.".pdf");
		$to 	= $customer['email_customer'];
		$config = array(
			   'mailtype'  => 'html',
               'charset'   => 'utf-8',
               'protocol'  => 'smtp',
               'smtp_host' => 'ssl://smtp.gmail.com',
               'smtp_user' => 'demo@email.com',    // Ganti dengan email gmail kamu
               'smtp_pass' => 'P@$$\/\/0RD',      // Password gmail kamu
               'smtp_port' => 465,
               'crlf'      => "rn",
               'newline'   => "rn"
		);
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from('BTBS');
        $this->email->to($to);
        $this->email->attach($attach);
        $this->email->subject($subject);
        $this->email->message($message);
        if ($this->email->send()) {
        	$this->session->set_flashdata('message', 'swal("Succeed", "E-Ticket sent!", "success");');
			redirect('store/order/vieworder/'.$id);
        } else {
            $this->session->set_flashdata('message', 'swal("Failed", "E-Tickets Failed to Send Contact the IT Team", "error");');
			redirect('store/order/vieworder/'.$id);
        }

	}

}

/* End of file Order.php */
/* Log on to codeastro.com for more projects */
/* Location: ./application/controllers/store/Order.php */