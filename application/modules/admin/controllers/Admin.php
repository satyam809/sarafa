<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends MY_Controller
{

	public function __construct()
	{

		parent::__construct();
		$this->load->database();
		$this->load->library(array('session', 'form_validation', 'mylibrary', 'email'));
		$this->load->helper(array('form'));
		$this->load->model('admin_Model');
		//$this->load->library(array('session','form_validation','mylibrary','email'));
		//$this->load->helper(array('form'));
		//$this->load->helper('form'); 
	}

	public function index()
	{
		$this->load->view('login');
	}
	public function hello()
	{
		echo "Hello Good morning";
	}
	/**
	 * login function.
	 * 
	 * @access public
	 * @return void
	 */

	public function login()
	{
		//echo "string"; die();
		// set validation rules
		$this->form_validation->set_rules('email', 'Email Address', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if ($this->form_validation->run() == false) {
			// validation not ok, send validation errors to the view
			// Set flash data 
			$this->session->set_flashdata('Invalid', 'Please check your email');
			$this->load->view('login');
			// Get Flash data on view 
			$this->session->flashdata('Invalid');
		} else {

			// set variables from the form
			$email = $this->input->post('email');
			$password = $this->mylibrary->cryptPass($this->input->post('password'));

			if ($this->admin_Model->resolveAdminLogin($email, $password) != false) {

				$admin_id = $this->admin_Model->resolveAdminLogin($email, $password);
				$admin    = $this->admin_Model->getAdmin($admin_id);
				// set session user datas
				//$this->session->set_userdata("admin", $admin);
				// print_r($admin); exit;

				$_SESSION['admin_id']      = (int)$admin->int_glcode;
				$_SESSION['email']     = (string)$admin->var_email;
				$_SESSION['logged_in']    = (bool)true;
				$_SESSION['adminuser'] = (string)$admin->var_username;

				// user login ok
				redirect('admin/dashboard');
			} else {
				// login failed
				$this->session->set_flashdata('admin_notfount', 'Invalid email or password');
				// send error to the view
				redirect('admin');
				//$this->load->view('login');
			}
		}
	}

	////////////////////////////////// forgot password /////////////////////////////////////
	////////////////////////////////////////////////////////////////////////////////////////
	public function forgotPassword()
	{
		$this->load->library('email');
		$email = $this->input->post('email');

		//echo $email; exit;

		if ($email == '') {
			echo "Please fill your Email Address.";
			exit;
		} else {

			$check_email = $this->admin_Model->checkEmail($email);
			$var_password = $this->generateRandomString(8);

			//echo $check_email; exit;

			if ($check_email != 0) {

				$to = $email;
				$subject = "Vruits - Forgot Password Email";
				$img_path = base_url();
				$get_path = base_url() . "public/assets/email_temp/email_temp.php";
				$email_message = file_get_contents($get_path);
				$email_message = str_replace("@IMG_LOGO", $img_path, $email_message);
				$email_message = str_replace("@EMAIL", $email, $email_message);
				$email_message = str_replace("@PASSWORD", $var_password, $email_message);
				$headers = 'From: testbyconceptioni@gmail.com' . "\r\n" .
					'Reply-To: ' . $to . "\r\n" .
					'MIME-Version: 1.0' . "\r\n" .
					'Content-type: text/html; charset=iso-8859-1' . "\r\n" .
					'X-Mailer: PHP/' . phpversion();

				$new_password = $this->mylibrary->cryptPass($var_password);

				//echo "to"; echo $to; echo "subject"; echo $subject; echo "email_message"; echo $email_message; echo "headers"; echo $headers; exit;

				if (mail($to, $subject, $email_message, $headers)) {
					$var_email = $email;
					$updateQuery = $this->admin_Model->updatePass($new_password, $email);
					//print_r($updateQuery); 
					echo 1;
				} else {
					echo "Warning! Mail not sent please try again later.";
					exit;
				}
			} else {

				echo "Warning! This email-address not exists. Please enter valid email address.";
				exit;
			}
		}
	}


	public function generateRandomString($length = 10)
	{
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}

	/**

	 * logout function.

	 * 

	 * @access public

	 * @return void
	 */

	public function logout()
	{
		if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == '1') {
			// remove session datas
			//echo "string"; exit(); 
			foreach ($_SESSION as $key => $value) {
				unset($_SESSION[$key]);
			}
			// user logout ok
			$this->session->set_flashdata('Invalid', 'Logout Successfully');
			redirect(base_url('admin'));
		}
	}
}
