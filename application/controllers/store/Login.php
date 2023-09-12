<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->helper('dateindo_helper');
		$this->load->model('getkod_model');
		date_default_timezone_set("Asia/Jakarta");
	}
	function getsecurity($value=''){
		$username = $this->session->userdata('email');
		if ($username) {
			redirect('store/home');
			$this->session->sess_destroy();
			redirect('frontend/login');
		}else{
			redirect('frontend/login');
		}
    }
    /* Log on to codeastro.com for more projects */
	function getUserIP()
    {
        $client  = @$_SERVER['HTTP_CLIENT_IP'];
        $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remote  = $_SERVER['REMOTE_ADDR'];

        if(filter_var($client, FILTER_VALIDATE_IP))
        {
            $ip = $client;
        }
        elseif(filter_var($forward, FILTER_VALIDATE_IP))
        {
            $ip = $forward;
        }
        else
        {
            $ip = $remote;
        }

        return $ip;
        
    }
	public function index(){
		$data['ipaddres'] = $this->getUserIP();
		$this->load->view('store/login',$data);
	}
    
	public function logout(){
		$this->session->sess_destroy();
		redirect(base_url('home'));
	}
    /* Log on to codeastro.com for more projects */
	public function checker(){
    $username = strtolower($this->input->post('username'));
    $getUser = $this->db->query('select * from entrepreneurs where email = "'.$username.'"')->row();
    $password = $this->input->post('password');

    if (password_verify($password,$getUser->password)) {
    	// $this->db->where('username_admin',$username);
        // $query = $this->db->get('tbl_admin');
        $sess = array(
            'entrepreneur_id' => $getUser->entrepreneur_id,
            'firstname' => $getUser->firstname,
            'lastname' => $getUser->lastname,
            'password' => $getUser->password,            
            'email'   => $getUser->email,
            'store_name'     => $getUser->store_name,
            'store_address'	=> $getUser->store_address,
            'image'	=> $getUser->image,
            'phone_number'   => $getUser->phone_number,
            'bank_account'	=> $getUser->bank_account,
            'number_bank_account'	=> $getUser->number_bank_account
        );
        // die(print_r($sess));
        $this->session->set_userdata($sess);
        redirect('store/home');
        // }
    }else{
    	// $this->session->set_flashdata('message', 'swal("Failed", "Incorrect Login Details!", "error");');
        // unset($_SESSION['message']);
    	// redirect('store/login');
        $sqlCheck = $this->db->query('select * from customer where username_customer = "'.$username.'" OR email_customer = "'.$username.'" ')->row();
        if (password_verify($password,$sqlCheck->password_customer)) {
            $sess = [
                'id_customer' => $sqlCheck->id_customer,
                'username' => $sqlCheck->username_customer,
                'password' => $sqlCheck->password_customer,
                'id_card'     => $sqlCheck->no_id_card_customer,
                'name_lengkap'     => $sqlCheck->name_customer,
                'img_customer'	=> $sqlCheck->img_customer,
                'email'   => $sqlCheck->email_customer,
                'phone'   => $sqlCheck->phone_customer,
                'address'	=> $sqlCheck->address_customer
            ];
            $this->session->set_userdata($sess);
            if ($this->session->userdata('timetable') == NULL) {
                redirect('home');
            }
        }
    	}
	}

}

/* End of file Login.php */
/* Log on to codeastro.com for more projects */
/* Location: ./application/controllers/store/Login.php */