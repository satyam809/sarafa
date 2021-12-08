<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends Front_Controller {
	
	public function __construct() {
		
		parent::__construct();
		$this->load->library(array('session','form_validation','mylibrary'));
		$this->load->library('GoogleLoginApi');
		$this->load->library('facebook');
		$this->load->library('recaptcha');
		$this->load->helper(array('form'));
		$this->load->model('Login_Model','model');
		
	}

	public function store_user_reset_password($id){
        $user_id = base64_decode($id);
        $select = "select int_glcode,dt_timestamp from mst_users where chr_delete = 'N' and int_glcode = '".$user_id."'";
        $result = $this->db->query($select);
        $data = $result->row_array();
        // echo $select;
        // print_r($data); exit();
        $time_stamp = $data['dt_timestamp'] + 60*60*24 ;
        //echo $data['dt_timestamp'].'</br>'; 
        //echo $time_stamp; exit();
        $current_time = time();
        if ($current_time <= $time_stamp) {
	        $this->session->set_userdata('reset_user',$user_id);
	        redirect('user_reset_password');
        } else {
        	redirect('user_expired_password');
        }

    }

    public function user_reset_password()
	{   
        // if($this->session->userdata('reset_user') != ''){ 
			$this->load->view('login/reset_password');
       	// } else {
        // 	redirect(base_url());
        // }
	}

	public function user_expired_password()
	{   
		$this->load->view('login/expired_password');
	}
	
	public function reset_password_action(){
            
        $newp = $this->mylibrary->cryptPass($_POST["new_password"]);
        $conp = $this->mylibrary->cryptPass($_POST["confirm_password"]);
        $id = $this->session->userdata('reset_user');
        
        if($newp == $conp){
            
            $query = $this->db->query("update mst_users set var_password='".$newp."' where int_glcode='".$id."' ");
            echo 1;exit;
        }else{
            echo 'New password and confirm password do not match.';exit;
        }
    }

    public function change_password(){
        
        $cupass = $this->mylibrary->cryptPass($this->input->post('opassword'));
        $nepass = $this->mylibrary->cryptPass($this->input->post('npassword'));
        $copass = $this->mylibrary->cryptPass($this->input->post('rpassword'));
        $fk_user = $this->input->post('fk_user');
        $sel1 = $this->db->query("select var_password from mst_users where int_glcode='".$fk_user."' ");
        $res1 = $sel1->row_array();
        
        if($cupass == $res1['var_password']){
            if($nepass == $copass){
                
                $update = $this->db->query("update mst_users set var_password='$nepass' where int_glcode='".$fk_user."'");
                if (isset($_SESSION['login_user']) && $_SESSION['login_user'] == 'user') {
			
					foreach ($_SESSION as $key => $value) {
						unset($_SESSION[$key]);
					}
						
				} 	
                echo 1;exit;
            }else{
                echo 'new and confirm password does not match.';exit;
            }
        }else{
            echo 'current password does not match.';exit;
        }
    }   

	public function user_logout() 
	{            //echo '<pre>';print_r($_SESSION);
 		//if (isset($_SESSION['login_user']) && $_SESSION['login_user'] == 'user') {
			// remove session datas
			//echo "string"; exit(); 
            $this->model->update_shopping_cart();
                    
			foreach ($_SESSION as $key => $value) {
				unset($_SESSION[$key]);
			}
                        $this->session->set_flashdata('Invalid','Logout Success !');
			// user logout ok
			redirect(base_url().'signin','refresh');	
		//} 	
	}

	public function logout()
	{
		$this->facebook->destroy_session();
		redirect('login/facebook_logout');
	}
        
}                                    