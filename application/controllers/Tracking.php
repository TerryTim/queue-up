<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class tracking extends CI_Controller {
	public function __construct(){
		parent::__construct();
		date_default_timezone_set("Asia/Jakarta");
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
    function index(){
        $company_id = $this->input->post('company_id');
        $shipping_tracking = $this->input->post('shipping_tracking');
        if($company_id == 'PDC001'){
            $url = "https://th.kerryexpress.com/th/track/v2/?track=";
            redirect($url.$shipping_tracking);
        }
        elseif($company_id == 'PDC002'){
            $url = "https://track.thailandpost.co.th/?trackNumber=";
            redirect($url.$shipping_tracking);
        }
    }
}