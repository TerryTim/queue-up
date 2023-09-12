<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('session');

	}

	public function index(){
		$this->autlogin();
	}

	public function autlogin(){
		$this->load->view('frontend/login');
	}
	public function logout(){
		$this->session->sess_destroy();
		redirect(base_url('login'));
	}
	
	public function checker(){
		$this->session->unset_tempdata('message');
		$username = strtolower($this->input->post('email'));
		$password = $this->input->post('password');
		$sqlCheck = $this->db->query('select * from customer where username_customer = "'.$username.'" OR email_customer = "'.$username.'" ')->row();
		// die(print_r($sqlCheck));
		if ($sqlCheck) {
			if ($sqlCheck->status_customer == 1) { 
				if (password_verify($password,$sqlCheck->password_customer)) {
						$sess = [
							'id_customer' => $sqlCheck->id_customer,
							'username' => $sqlCheck->username_customer,
							'password' => $sqlCheck->password_customer,
							'name_lengkap'     => $sqlCheck->name_customer,
							'img_customer'	=> $sqlCheck->img_customer,
							'email'   => $sqlCheck->email_customer,
							'phone'   => $sqlCheck->phone_customer,
							'address'	=> $sqlCheck->address_customer
						];
						$this->session->set_userdata($sess);
						if ($this->session->userdata('timetable') == NULL) {
							$this->session->set_flashdata('success', 'เข้าสู่ระบบสำเร็จ');
							redirect('home');
						}else{
							redirect('ticket/beforebeli/'.$this->session->userdata('timetable').'/'.$this->session->userdata('origin').'/'.$this->session->userdata('tanggal'));
						}
					}else{
					$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Wrong Password</div>');
					redirect('home');
				}
			}else{
				$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
				Account Not verified yet!!
					</div>');
				redirect('login', $username);
			}
		}else{
			
			$sqlCheck = $this->db->query('select * from entrepreneurs where email = "'.$username.'" ')->row();
						if (password_verify($password,$sqlCheck->password)) {
							$sess = array(
								'entrepreneur_id' => $sqlCheck->entrepreneur_id,
								'firstname' => $sqlCheck->firstname,
								'lastname' => $sqlCheck->lastname,
								'password' => $sqlCheck->password,            
								'email'   => $sqlCheck->email,
								'store_name'     => $sqlCheck->store_name,
								'store_address'	=> $sqlCheck->store_address,
								'store_image'	=> $sqlCheck->store_image,
								'phone_number'   => $sqlCheck->phone_number,
								'bank_account'	=> $sqlCheck->bank_account,
								'number_bank_account'	=> $sqlCheck->number_bank_account
							);
							$this->session->set_userdata($sess);
							$this->session->set_flashdata('success', 'เข้าสู่ระบบสำเร็จ');
							redirect('store/home');
						}
						else {
							$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
							ไม่พบอีเมล กรุณาลองอีกครั้ง</div>');
							redirect('login');
						}
		}
	}

	public function register(){
		$this->session->unset_tempdata('message');
		$this->form_validation->set_rules('nomor', 'Nomor', 'trim|required|is_unique[customer.phone_customer]',array(
			'required' => 'กรุณากรอกเบอร์มือถือ',
			'is_unique' => 'หมายเลขถูกใช้งานแล้ว'
			 ));
		$this->form_validation->set_rules('name', 'Name', 'trim|required',array(
			'required' => 'กรุณากรอกชื่อ',
			 ));
		$this->form_validation->set_rules('address', 'address', 'trim|required');
		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]|is_unique[customer.username_customer]',array(
			'required' => 'กรุณากรอกชื่อผู้ใช้',
			'is_unique' => 'ชื่อผู้ใช้นี้ถูกใช้งานแล้ว',
			'min_length' => 'ชื่อผู้ใช้ต้องมีอย่างน้อย 5 ตัวอักษร'
			 ));
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[customer.email_customer]',array(
			'required' => 'กรุณากรอกอีเมล',
			'valid_email' => 'รูปแบบอีเมลไม่ถูกต้อง',
			'is_unique' => 'อีเมลนี้ถูกใช้งานแล้ว'
			 ));
		$this->form_validation->set_rules('password1', 'Password', 'trim|required|min_length[8]|matches[password2]',array(
			'matches' => 'รหัสผ่านไม่ตรงกัน',
			'min_length' => 'รหัสผ่านต้องมีอย่างน้อย 8 ตัวอักษร'
			 ));
		$this->form_validation->set_rules('password2', 'Password', 'trim|required|matches[password1]');
		if ($this->form_validation->run() == false) {
			$this->load->view('frontend/register');
		} else {
			// die(print_r($_POST));
			$this->load->model('getkod_model');
			$data = array(
			'id_customer'	=> $this->getkod_model->get_kodpel(),
			'name_customer'  => $this->input->post('name'),
			'email_customer'	    	=> $this->input->post('email'),
			'img_customer'		=> 'default.png',
			'address_customer'		=> $this->input->post('address'),
			'phone_customer'		=> $this->input->post('nomor'),
			'username_customer'		=> $this->input->post('username'),
			'status_customer' => 1,
			'date_create_customer' => time(),
			'password_customer'		=> password_hash($this->input->post('password1'),PASSWORD_DEFAULT)
			);
			$token = md5($this->input->post('email').date("d-m-Y H:i:s"));
			$data1 = array(
				'name_token' => $token,
				'email_token' => $this->input->post('email'),
				'date_create_token' => time()
				 );
			$this->db->insert('customer', $data);
			$this->db->insert('token_customer', $data1);
			$this->session->set_flashdata('success', 'สมัครสมาชิกสำเร็จ');
    		redirect('login');
		}

	}

	public function registerEntrepreneur(){
		$this->form_validation->set_rules('firstname','Firstname', 'trim|required',array(
			'required' => 'กรุณากรอกชื่อ',
			 ));
		$this->form_validation->set_rules('lastname','Lastname', 'trim|required',array(
			'required' => 'กรุณากรอกนามสกุล',
			 ));
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[entrepreneurs.email]',array(
			'required' => 'กรุณากรอกอีเมล',
			'valid_email' => 'รูปแบบอีเมลไม่ถูกต้อง',
			'is_unique' => 'อีเมลนี้ถูกใช้ไปแล้ว'
			 ));
		$this->form_validation->set_rules('store_name','Store_name', 'trim|required',array(
			'required' => 'กรุณากรอกชื่อร้านค้า',
			 ));
		$this->form_validation->set_rules('store_address', 'Store_address', 'trim|required');
		
		$this->form_validation->set_rules('phone_number','Phone_number', 
			'trim|required|is_unique[entrepreneurs.phone_number]',array(
			'required' => 'กรุณากรอกหมายเลขโทรศัพท์',
			'is_unique' => 'หมายเลขโทรศัพท์นี้ถูกใช้ไปแล้ว'
			 ));
		$this->form_validation->set_rules('password1', 'Password', 'trim|required|min_length[8]|matches[password2]',array(
			'matches' => 'รหัสผ่านไม่ตรงกัน',
			'min_length' => 'รหัสผ่านต้องมีอย่างน้อย 8 ตัวอักษร'
			 ));
		$this->form_validation->set_rules('bank_account','Bank_account', 'trim|required',array(
			'required' => 'กรุณาเลือกธนาคาร',
			 ));
		$this->form_validation->set_rules('number_bank_account','Number_bank_account', 'trim|required',array(
			'required' => 'กรุณากรอกชื่อบัญชีธนาคาร',
			));
		$this->form_validation->set_rules('number_bank_account','Number_bank_account', 'trim|required',array(
			'required' => 'กรุณากรอกหมายเลขบัญชีธนาคาร',
			 ));
		$this->form_validation->set_rules('password2', 'Password', 'trim|required|matches[password1]');
		$this->form_validation->set_rules('password2', 'Password', 'trim|required|matches[password1]');
		if ($this->form_validation->run() == false) {
			$this->load->view('frontend/registerEntrepreneur');
		} else {
			// die(print_r($_POST));
			$this->load->model('getkod_model');
			$data = array(
			'entrepreneur_id'	=> $this->getkod_model->get_entrepreneur_id(),
			'firstname'  => $this->input->post('firstname'),
			'lastname'  => $this->input->post('lastname'),
			'email'	    	=> $this->input->post('email'),
			'store_name'		=> $this->input->post('store_name'),
			'store_address'		=> $this->input->post('store_address'),
			'phone_number'		=> $this->input->post('phone_number'),
			'bank_account' => $this->input->post('phone_number'),
			'bank_account_name' => $this->input->post('bank_account_name'),
			'number_bank_account' => $this->input->post('number_bank_account'),
			'password'		=> password_hash($this->input->post('password1'),PASSWORD_DEFAULT),
			// 'create_at' => time()
			);
			// $token = md5($this->input->post('email').date("d-m-Y H:i:s"));
			// $data1 = array(
			// 	'name_token' => $token,
			// 	'email_token' => $this->input->post('email'),
			// 	'date_create_token' => time()
			// 	 );
			$this->db->insert('entrepreneurs', $data);
			// $this->db->insert('token_customer', $data1);
			$this->_sendmail($token,'verify');
			$this->session->set_flashdata('success', 'สมัครสมาชิกสำเร็จ');
    		redirect('login');
		}
	}

	Private function _sendmail($token='',$type=''){
		$config = [
               'mailtype'  => 'html',
               'charset'   => 'utf-8',
               'protocol'  => 'smtp',
               'smtp_host' => 'ssl://smtp.gmail.com',
               'smtp_user' => 'demo@email.com',    // Ganti dengan email gmail kamu
               'smtp_pass' => 'P@$$\/\/0RD',      // Password gmail kamu
               'smtp_port' => 465,
               'crlf'      => "rn",
               'newline'   => "rn"
           ];
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from('BTBS');
        $this->email->to($this->input->post('email'));
        // $this->email->attach('https://masrud.com/content/images/20181215150137-codeigniter-smtp-gmail.png');
        if ($type == 'verify') {
        	$this->email->subject('Account verify BTBS');
       		$this->email->message('Click the link to verify your account <a href="'.base_url('login/verify?email='.$this->input->post('email').'&token='.$token).'" >Verification</a>');
        }elseif ($type == 'forgot') {
        	$this->email->subject('BTBS Ticket Reset Account');
       		$this->email->message('Click the link to Reset your account <a href="'.base_url('login/forgot?email='.$this->input->post('email').'&token='.$token).'" >Reset Password</a>');
        }
        if ($this->email->send()) {
            return true;
        } else {
            echo 'Error! email cant be sent.';
        }
	}
	/* Log on to codeastro.com for more projects */
	public function verify($value=''){
		$email = $this->input->get('email');
		$token = $this->input->get('token');
		$sqlcheck = $this->db->get_where('customer',['email_customer' => $email])->row_array();
		if ($sqlcheck) {
			$sqlcheck_token = $this->db->get_where('token_customer',['name_token' => $token])->row_array();
			if ($sqlcheck_token) {
				if(time() - $sqlcheck_token['date_create_token'] < (60 * 60 * 24)){
					$update = array('status_customer' => 1, );
					$where = array('email_customer' => $email );
					$this->db->update('customer', $update,$where);
					$this->db->delete('token_customer',['email_token' => $email]);
					$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
					Successfully Verify Your Account, Login
					</div>');
					redirect('login');
				}else{
					$this->db->delete('customer',['email_customer' => $email]);
					$this->db->delete('token_customer',['email_token' => $email]);
					$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
					Token Expired, Please re-register your account
						</div>');
	    			redirect('login');
				}
			}else{
				$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
				Incorrect Token Verification Failed
						</div>');
	    		redirect('login');
			}
		}else{
		$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
		Email Verification Failed
						</div>');
	    redirect('login');
		}
	}
	/* Log on to codeastro.com for more projects */
	public function forgetpassword($value=''){
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email',array(
			'required' => 'Email Required.',
			'valid_email' => 'Enter Email Correctly',
			 ));
		if ($this->form_validation->run() == false) {
			$this->load->view('frontend/forgetpassword');
		} else {
			$email = $this->input->post('email');
			$sqlcheck = $this->db->get_where('customer',['email_customer' => $email],['status_customer' => 1])->row_array();
			if ($sqlcheck) {
				$token = md5($email.date("d-m-Y H:i:s"));
				$data = array(
				'name_token' => $token,
				'email_token' => $email,
				'date_create_token' => time()
				 );
			$this->db->insert('token_customer', $data);
			$this->_sendmail($token,'forgot');
			$this->session->set_flashdata('message', 'swal("Success", "Successfully Reset Password Please Check Your Email", "success");');
    		redirect('login');
			}else{
				$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
						No Email Or Account Not Active
						</div>');
	   			redirect('login/forgetpassword');
			}
		}
	}
	public function forgot($value=''){
		$email = $this->input->get('email');
		$token = $this->input->get('token');
		$sqlcheck = $this->db->get_where('customer',['email_customer' => $email])->row_array();
		if ($sqlcheck) {
			$sqlcheck_token = $this->db->get_where('token_customer',['name_token' => $token])->row_array();
			if ($sqlcheck_token) {
				$this->session->set_userdata('resetemail' ,$email);
				$this->changepassword();
			}else{
				$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
				Failed to Reset Wrong Email Token
						</div>');
	    		redirect('login');
			}
		}else{
		$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
		Failed to Reset Wrong Email
						</div>');
	    redirect('login');
		}
	}
	/* Log on to codeastro.com for more projects */
	public function changepassword($value=''){
		if ($this->session->userdata('resetemail') == NULL) {
			redirect('login/register');
		}
		$this->form_validation->set_rules('password1', 'Password', 'trim|required|min_length[8]|matches[password2]',array(
			'matches' => 'Password Not Same.',
			'min_length' => 'Password Minimum 8 Characters.'
			 ));
		$this->form_validation->set_rules('password2', 'Password', 'trim|required|matches[password1]');
		if ($this->form_validation->run() == false) {
			$this->load->view('frontend/resetpassword');
		}else{
			$email = $this->session->userdata('resetemail');
			$update = array(
				'status_customer' => 1,
				'password_customer' => password_hash($this->input->post('password1'),PASSWORD_DEFAULT)
			);
			$where = array('email_customer' => $email );
			$this->db->update('customer', $update,$where);
			$this->session->unset_userdata('resetemail');
			$this->db->delete('token_customer',['email_token' => $email]);
			$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
					Successfully Reset, Login Your Account Back
					</div>');
			redirect('login');
		}
	}
}

/* End of file Login.php */
/* Log on to codeastro.com for more projects */
/* Location: ./application/controllers/Login.php */