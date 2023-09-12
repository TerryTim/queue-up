<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/* Log on to codeastro.com for more projects */
class Home extends CI_Controller {
	function __construct()
    {
        parent::__construct();
        $this->load->helper(array('url', 'form'));
        $this->load->library(array('form_validation', 'Recaptcha'));
    }
    function getsecurity($value=''){
        $username = $this->session->userdata('username');
        if (empty($username)) {
            $this->session->sess_destroy();
            redirect('login');
        }
    }
	public function index(){
		$data = array(
            'captcha' => $this->recaptcha->getWidget(), // menampilkan recaptcha
            'script_captcha' => $this->recaptcha->getScriptTag(), // javascript recaptcha ditaruh di head
        );
        // die(print_r($data));
        $data['products'] = $this->db->query("SELECT products.product_id, products.product_image, 
        product_name, product_price,
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
        GROUP BY products.product_id")->result_array();
		$this->load->view('frontend/home',$data);		
	}
	public function profile($value='')
	{
		$this->load->view('frontend/profile');
	}
	public function editprofile($id=''){
		$this->load->view('frontend/profile');
	}
	public function newslatter($value=''){
        $this->form_validation->set_rules('news', ' ', 'trim|required');
        
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
 
        $recaptcha = $this->input->post('g-recaptcha-response');
        $response = $this->recaptcha->verifyResponse($recaptcha);
 
        if ($this->form_validation->run() == FALSE || !isset($response['success']) || $response['success'] <> true) {
            $this->index();
        } else {
            echo 'Succeed';
        }
	}
}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */