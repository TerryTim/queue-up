<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class search extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->helper('dateindo_helper');
		$this->load->model('getkod_model');
		date_default_timezone_set("Asia/Jakarta");
	}
	function getsecurity($value=''){
		$username = $this->session->userdata('username');
		if (empty($username)) {
			redirect('login');
		}
	}
	// public function index(){
	// 	$this->session->unset_userdata(array('timetable','origin','tanggal'));
	// 	$data['title'] = "Check Schedule";
	// 	$data['origin'] = $this->db->query("SELECT * FROM `tbl_destination` ORDER BY city_destination ASC ")->result_array();
	// 	$data['destination'] = $this->db->query("SELECT * FROM `tbl_destination` group by city_destination ORDER BY city_destination ASC ")->result_array();
	// 	$data['list'] = $this->db->query("SELECT * FROM `tbl_destination` ORDER BY city_destination ASC ")->result_array();
    //     $data['ticket'] = $this->db->query("SELECT * FROM `tbl_ticket` ")->result_array();
	// 	$this->load->view('frontend/search',$data);
	// }
	/*public function index($id=''){
		// die(print_r($_GET));
		$check = $this->input->get('search').$id;
		$data['product'] = $this->db->query("SELECT products.product_id, products.product_image, product_name, product_price,
		entrepreneurs.store_name,
        categories.category_name,
        ratings.order_rating,
        COUNT(orders.product_id),
        COUNT(ratings.order_id),
        COALESCE(CAST(AVG(ratings.order_rating) AS DECIMAL(10,1)), 0)
        FROM `products` 
        INNER JOIN categories ON products.category_id = categories.category_id
        INNER JOIN entrepreneurs ON products.entrepreneur_id = entrepreneurs.entrepreneur_id
        LEFT JOIN orders ON products.product_id = orders.product_id
        LEFT JOIN ratings ON orders.order_id = ratings.order_id
		WHERE products.product_name OR categories.category_name LIKE '".$check."%'
        GROUP BY products.product_id ")->result_array();
		if($data['product'] == null){
			$data['product'] = $this->db->query("SELECT products.product_id, products.product_image, product_name, product_price,
			entrepreneurs.store_name,
			categories.category_name,
			ratings.order_rating,
			COUNT(orders.product_id),
			COUNT(ratings.order_id),
			COALESCE(CAST(AVG(ratings.order_rating) AS DECIMAL(10,1)), 0)
			FROM `products` 
			INNER JOIN categories ON products.category_id = categories.category_id
			INNER JOIN entrepreneurs ON products.entrepreneur_id = entrepreneurs.entrepreneur_id
			LEFT JOIN orders ON products.product_id = orders.product_id
			LEFT JOIN ratings ON orders.order_id = ratings.order_id
			WHERE products.product_name LIKE '".$check."%'
			GROUP BY products.product_id ")->result_array();
			if($data['product'] == null){
				$data['product'] = $this->db->query("SELECT products.product_id, products.product_image, product_name, product_price,
				entrepreneurs.store_name,
				categories.category_name,
				ratings.order_rating,
				COUNT(orders.product_id),
				COUNT(ratings.order_id),
				COALESCE(CAST(AVG(ratings.order_rating) AS DECIMAL(10,1)), 0)
				FROM `products` 
				INNER JOIN categories ON products.category_id = categories.category_id
				INNER JOIN entrepreneurs ON products.entrepreneur_id = entrepreneurs.entrepreneur_id
				LEFT JOIN orders ON products.product_id = orders.product_id
				LEFT JOIN ratings ON orders.order_id = ratings.order_id
				WHERE categories.category_name LIKE '".$check."%'
				GROUP BY products.product_id ")->result_array();
			}
		}
	 	$this->load->view('frontend/search',$data,$check);
	}*/
	public function index($id=''){
		$search = $this->input->get('search');
		$data['product'] = $this->db->query("
			SELECT products.product_id, products.product_image, product_name, product_price,
			entrepreneurs.store_name,
			categories.category_name,
			ratings.order_rating,
			COUNT(orders.product_id),
			COUNT(ratings.order_id),
			COALESCE(CAST(AVG(ratings.order_rating) AS DECIMAL(10,1)), 0)
			FROM `products` 
			LEFT JOIN categories ON products.category_id = categories.category_id
			LEFT JOIN entrepreneurs ON products.entrepreneur_id = entrepreneurs.entrepreneur_id
			LEFT JOIN orders ON products.product_id = orders.product_id
			LEFT JOIN ratings ON orders.order_id = ratings.order_id
			WHERE 
				products.product_name LIKE '%$search%' OR 
				categories.category_name LIKE '%$search%' OR 
				entrepreneurs.store_name LIKE '%$search%'
			GROUP BY products.product_id 
		")->result_array();
		
		$this->load->view('frontend/search', $data, $search);
	}
	public function detail($id=''){
		$check = $this->input->get('search').$id;
		$data['product'] = $this->db->query("SELECT products.product_id, 
		products.product_name, products.product_description,
		products.product_image, products.product_price, 
		categories.category_name, entrepreneurs.store_name, 
		entrepreneurs.entrepreneur_id, entrepreneurs.store_image, entrepreneurs.store_address,
		pickup.pickup_id, pickup.pickup_option,
		ratings.order_rating, ratings.store_rating,
		COUNT(orders.product_id),
		COUNT(ratings.order_id),
		COALESCE(CAST(AVG(ratings.order_rating) AS DECIMAL(10,1)), 0),
		COUNT(ratings.store_rating),
		COALESCE(CAST(AVG(ratings.store_rating) AS DECIMAL(10,1)), 0)
		FROM `products` 
		LEFT JOIN categories ON products.category_id=categories.category_id 
		LEFT JOIN entrepreneurs ON products.entrepreneur_id=entrepreneurs.entrepreneur_id
		LEFT JOIN pickup ON products.pickup_id=pickup.pickup_id
		LEFT JOIN orders ON products.product_id = orders.product_id
		LEFT JOIN ratings ON orders.order_id = ratings.order_id
		WHERE products.product_id = '".$check."' ")->result_array();

		$data['store_rating'] = $this->db->query("SELECT ratings.store_rating,
		COUNT(ratings.store_rating),
		COALESCE(CAST(AVG(ratings.store_rating) AS DECIMAL(10,1)), 0)
		FROM `ratings` 
        LEFT JOIN products ON products.entrepreneur_id = ratings.entrepreneur_id
		WHERE products.product_id = '".$check."' ")->result_array();

		$data['rating'] = $this->db->query("SELECT customer.username_customer, customer.img_customer,
		ratings.order_rating, ratings.store_rating, ratings.comment, ratings.create_at
		FROM `ratings`
		INNER JOIN customer ON customer.id_customer = ratings.customer_id
		INNER JOIN orders ON orders.order_id = ratings.order_id 
		INNER JOIN products ON products.product_id = orders.product_id 
		WHERE products.product_id = '".$check."' 
		ORDER BY ratings.create_at DESC")->result_array();

		$customer_id = $this->session->userdata('id_customer');
		$entrepreneur_id = $this->db->query("SELECT entrepreneur_id FROM products
			WHERE products.product_id = '".$check."'")->result_array();
		$data['chat'] = $this->db->query("SELECT chats.entrepreneur_id, chats.text, chats.chat_image, chats.sender,
			chats.date, chats.time, entrepreneurs.store_name, entrepreneurs.store_image, customer.username_customer,
			customer.img_customer
			FROM chats
			LEFT JOIN entrepreneurs ON chats.entrepreneur_id = entrepreneurs.entrepreneur_id
			LEFT JOIN customer ON chats.customer_id = customer.id_customer 
			WHERE chats.customer_id = '".$customer_id."' 
			AND chats.entrepreneur_id = '".$entrepreneur_id[0]['entrepreneur_id']."'
			ORDER BY chats.date ASC, chats.time ASC"
		)->result_array();


	 	$this->load->view('frontend/product_detail',$data);
	}

	/* Log on to codeastro.com for more projects */
	public function checkticket($value=''){
		$this->load->view('frontend/search');
	}
	public function checktimetable($date='' , $asl='', $tjn=''){
		$this->session->unset_userdata(array('timetable','origin','tanggal'));
		$data['title'] = 'Search Tickets';
		$data['tanggal'] = $this->input->get('tanggal').$date;
		$origin = $this->input->get('origin').$asl;
		$destination = $this->input->get('destination').$tjn;
		$data['origin'] = $this->db->query("SELECT * FROM tbl_destination
               WHERE id_destination ='$origin'")->row_array();
		$data['timetable'] = $this->db->query("SELECT * FROM tbl_timetable LEFT JOIN tbl_bus on tbl_timetable.id_bus = tbl_bus.id_bus LEFT JOIN tbl_destination on tbl_timetable.id_destination = tbl_destination.id_destination WHERE tbl_timetable.region_timetable ='$destination' AND tbl_timetable.id_origin = '$origin'")->result_array();
		if (!empty($data['timetable'])) {
			if ($destination == $data['origin']['city_destination']) {
				$this->session->set_flashdata('message', 'swal("check", "destination dan origin tidak boleh sama", "error");');
    			redirect('ticket');
			}else{
				for ($i=0; $i < count($data['timetable']); $i++) { 
					$data['seat'][$i] = $this->db->query("SELECT count(no_seat_order) FROM tbl_order WHERE id_timetable = '".$data['timetable'][$i]['id_timetable']."' AND date_of_leaving_order = '".$data['tanggal']."' AND origin_order = '".$origin."'")->result_array();
				};
				$this->load->view('frontend/checktimetable',$data);
			}
		}else{
			$this->session->set_flashdata('message', 'swal("Empty", "No Schedule", "error");');
    		redirect('ticket');
		}
	}
	/* Log on to codeastro.com for more projects */
	public function beforebeli($timetable="",$origin='',$tanggal=''){
		$array = array(
			'timetable' => $timetable,
			'origin'	=> $origin,
			'tanggal'	=> $tanggal
		);
		$this->session->set_userdata($array);
		if ($this->session->userdata('username')){
			$id = $timetable;
			$origin = $origin;
			$data['tanggal'] = $tanggal;
			$data['origin'] =  $this->db->query("SELECT * FROM tbl_destination
               WHERE id_destination ='".$origin."'")->row_array();
			$data['timetable'] = $this->db->query("SELECT * FROM tbl_timetable LEFT JOIN tbl_bus on tbl_timetable.id_bus = tbl_bus.id_bus LEFT JOIN tbl_destination on tbl_timetable.id_destination = tbl_destination.id_destination WHERE id_timetable ='".$id."'")->row_array();
			$data['seat'] = $this->db->query("SELECT no_seat_order FROM tbl_order WHERE id_timetable = '".$data['timetable']['id_timetable']."' AND date_of_leaving_order = '".$data['tanggal']."' AND origin_order = '".$origin."'")->result_array();
			$this->load->view('frontend/beli_step1',$data);
		}else{ 
			redirect('login/autlogin');
		}
	}
	public function afterbeli(){
		$data['seat'] = $this->input->get('seat');
		$data['bank'] = $this->db->query("SELECT * FROM `tbl_bank` ")->result_array();
		$data['id_timetable'] = $this->session->userdata('timetable');
		$data['origin'] = $this->session->userdata('origin');
		$data['dateberangkat'] = $this->input->get('date');
		if ($data['seat']) {
			$this->load->view('frontend/beli_step2', $data);
		}else{
			$this->session->set_flashdata('message', 'swal("Empty", "Choose Your Seat", "error");');
			redirect('ticket/beforebeli/'.$data['origin'].'/'.$data['id_timetable']);
		}
	}
	/* Log on to codeastro.com for more projects */
	public function getticket($value=''){
	    include 'assets/phpqrcode/qrlib.php';
	    $origin =  $this->db->query("SELECT * FROM tbl_destination
               WHERE id_destination ='".$this->session->userdata('origin')."'")->row_array();		
		$getkode =  $this->getkod_model->get_kodtmporder();
		$id_timetable = $this->session->userdata('timetable');
		$id_customer = $this->session->userdata('id_customer');
		$dateberangkat = $this->input->post('date');
		$jambeli = date("Y-m-d H:i:s");
		$name =  $this->input->post('name');
		$seat = $this->input->post('seat');
		$tahun = $this->input->post('tahun');
		$no_id_card = $this->input->post('no_id_card');
		$name_pemesan = $this->input->post('name_pemesan');
		$hp = $this->input->post('hp');
		$address = $this->input->post('address');
		$email = $this->input->post('email');
		$bank = $this->input->post('bank');
		$satu_hari        = mktime(0,0,0,date("n"),date("j")+1,date("Y"));
		$expired       = date("d-m-Y", $satu_hari)." ".date('H:i:s');
		$status 		= '1';
		QRcode::png($getkode,'assets/frontend/upload/qrcode/'.$getkode.".png","Q", 8, 8);
		$count = count($seat);
		$tanggal = hari_indo(date('N',strtotime($jambeli))).', '.tanggal_indo(date('Y-m-d',strtotime(''.$jambeli.''))).', '.date('H:i',strtotime($jambeli));
		for($i=0; $i<$count; $i++) {
			$simpan = array(
				'id_order' => $getkode,
				'id_ticket' => 'T'.$getkode.$id_timetable.str_replace('-','',$dateberangkat).$seat[$i],
				'id_timetable'	=> $id_timetable,
				'id_customer' => $id_customer,
				'origin_order' => $origin['id_destination'],
				'name_order'	=> $name_pemesan,
				'buy_order_date'	=> $tanggal,
				'date_of_leaving_order' => $dateberangkat,
				'no_seat_order'		=> $seat[$i],
				'name_seat_order' => $name[$i],
				'age_seat_order' => $tahun[$i],
				'no_id_card_order'	=> $no_id_card,
				'phone_number'	=> $hp,
				'address_order'	=> $address,
				'email_order'		=> $email,
				'id_bank' => $bank,
				'expired_order'	=> $expired,
				'qrcode_order'	=> 'assets/frontend/upload/qrcode/'.$getkode.'.png',
				'status_order'	=> $status
			);
			$this->db->insert('tbl_order', $simpan);
		}
		redirect('ticket/checkout/'.$getkode);
	}
	/* Log on to codeastro.com for more projects */
	public function checkorder($id=''){
		$id = $this->input->post('kodeticket');
		$sqlcheck = $this->db->query("SELECT * FROM tbl_order LEFT JOIN tbl_timetable on tbl_order.id_timetable = tbl_timetable.id_timetable LEFT JOIN tbl_bus on tbl_timetable.id_bus = tbl_bus.id_bus LEFT JOIN tbl_bank on tbl_order.id_bank = tbl_bank.id_bank WHERE id_order ='$id' AND status_order != 3 AND status_order != 2")->result_array();
		if ($sqlcheck) {
			$data['ticket'] = $sqlcheck;
			$data['count'] = count($sqlcheck);
			$this->load->view('frontend/payment',$data);
		}else{
			$this->session->set_flashdata('message', 'swal("Empty", "No Pending Tickets Found", "error");');
    		redirect('ticket/checkticket');
		}
	}
	public function payment($id=''){
		$this->getsecurity();
		$sqlcheck = $this->db->query("SELECT * FROM tbl_order LEFT JOIN tbl_timetable on tbl_order.id_timetable = tbl_timetable.id_timetable LEFT JOIN tbl_bus on tbl_timetable.id_bus = tbl_bus.id_bus LEFT JOIN tbl_bank on tbl_order.id_bank = tbl_bank.id_bank WHERE id_order ='$id'")->result_array();
		$data['count'] = count($sqlcheck);
		$data['ticket'] = $sqlcheck;
		$this->load->view('frontend/payment',$data);
	}
	public function checkout($value=''){
		$this->getsecurity();
		$data['ticket'] = $value;
		$send['sendmail'] = $this->db->query("SELECT * FROM tbl_order LEFT JOIN tbl_timetable on tbl_order.id_timetable = tbl_timetable.id_timetable LEFT JOIN tbl_destination on tbl_timetable.id_destination = tbl_destination.id_destination LEFT JOIN tbl_bank on tbl_order.id_bank = tbl_bank.id_bank WHERE id_order ='$value'")->row_array();
		$send['count'] = count($send['sendmail']);
		//email
		$subject = 'BTBS';
		$message = $this->load->view('frontend/sendmail',$send, TRUE);
		$to 	 = $this->session->userdata('email');
        $config = [
               'mailtype'  => 'html',
               'charset'   => 'utf-8',
               'protocol'  => 'smtp',
               'smtp_host' => 'ssl://smtp.gmail.com',
               'smtp_user' => 'demo@email.com',    // Ganti dengan email gmail kamu
               'smtp_pass' => 'P@$$\/\/0RD',      // Password gmail kamu
               'smtp_port' => 465,
		   ];
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from('BTBS');
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($message);
        if ($this->email->send()) {
			$this->session->set_flashdata('message', 'swal("Success", "Please proceed towards payment confirmation!", "success");');
            $this->load->view('frontend/checkout', $data);
        } else {
		//    echo 'Error! Send an error email';
		$this->session->set_flashdata('message', 'swal("Success", "Please proceed towards payment confirmation!", "success");');
            $this->load->view('frontend/checkout', $data);
        }
	}
	/* Log on to codeastro.com for more projects */
	public function cariticket(){
		$id = $this->input->post('kodeticket');
		$sqlcheck = $this->db->query("SELECT * FROM tbl_order LEFT JOIN tbl_bus on tbl_order.id_bus = tbl_bus.id_bus LEFT JOIN tbl_timetable on tbl_order.id_timetable = tbl_timetable.id_timetable WHERE id_order ='".$id."'")->result_array();
		if ($sqlcheck == NULL) {
			$this->session->set_flashdata('message', 'swal("Kosong", "Tidak Ada ticket", "error");');
    		redirect('ticket/checkticket');
		}else{
			$data['ticket'] = $sqlcheck;
			$this->load->view('frontend/payment', $data);
		}
	}
	public function confirmation($value='',$price=''){
		$this->getsecurity();
		$data['id'] = $value;
		$data['total'] = $price;
		$this->load->view('frontend/confirmation', $data);
	}
	public function insertconfirmation($value=''){
		$this->getsecurity();
		$config['upload_path'] = './assets/frontend/upload/payment';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$this->load->library('upload', $config);
		if ( ! $this->upload->do_upload('userfile')){
			$error = array('error' => $this->upload->display_errors());
			$this->session->set_flashdata('message', 'swal("Fail", "Check Your Confirmation Again", "error");');
			redirect('ticket/confirmation/'.$this->input->post('id_order').'/'.$this->input->post('total'));
		}
		else{
			$upload_data = $this->upload->data();
			$featured_image = '/assets/frontend/upload/payment/'.$upload_data['file_name'];
			$data = array(
						'id_confirmation' => $this->getkod_model->get_kodkon(),
						'id_order'	=> $this->input->post('id_order'),
						'name_bank_confirmation'		=> $this->input->post('bank_km'),
						'name_confirmation' =>  $this->input->post('name'),
						'account_number_confirmation'		=> $this->input->post('number'),
						'total_confirmation' => $this->input->post('total'),
						'photo_confirmation' => $featured_image
					);
			$this->db->insert('tbl_confirmation', $data);
			$this->session->set_flashdata('message', 'swal("Success", "Thank you. Please wait for the verification!", "success");');
			redirect('profile/ticketsaya/'.$this->session->userdata('id_customer'));
		}
	}
	/* Log on to codeastro.com for more projects */
	public function print($id=''){
		$this->getsecurity();
		$order = $id;
		$data['print'] = $this->db->query("SELECT * FROM tbl_order LEFT JOIN tbl_bus on tbl_order.id_bus = tbl_bus.id_bus LEFT JOIN tbl_timetable on tbl_order.id_timetable = tbl_timetable.id_timetable LEFT JOIN tbl_destination on tbl_timetable.id_destination = tbl_destination.id_destination WHERE id_order ='".$id."'")->result_array();
		$ticket = $this->db->query("SELECT email_customer FROM customer WHERE id_customer ='".$data['print'][0]['id_customer']."'")->row_array();
		die(print_r($ticket));
	}

}

/* End of file ticket.php */
/* Location: ./application/controllers/ticket.php */
