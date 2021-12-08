<?php

defined('BASEPATH') or exit('No direct script access allowed');

class User extends API_Controller
{

    public function __construct()
    {

        parent::__construct();
        $this->load->library('mylibrary', 'session');
        $this->load->model('User_model', 'model');
    }

    /*------------------------------------- user signup ---------------------------------*/
    public function customerRegistration()
    {
        $email = $this->input->post('var_email');
        $mobile_no = $this->input->post('var_mobile_no');
        $landline_no = $this->input->post('var_alt_mobile');
        $useremail = $this->model->checkEmail($email);
        $userMobile = $this->model->checkMobileNo($mobile_no);
        $userLandline = $this->model->checkMobileNo($landline_no);
        if ($useremail == false) {
            $response['status'] = 404;
            $response['message'] = UNIQUE_EMAIL;
        } elseif ($userMobile == false) {

            $response['status'] = 404;
            $response['message'] = UNIQUE_MOBILE;
        } elseif ($userLandline == false) {

            $response['status'] = 404;
            $response['message'] = UNIQUE_MOBILE;
        } else {
            $userId = $this->model->addCustomer();
            $data = $this->model->getProfileDetalis($userId);
            if (($userId != '') || ($userId == 0)) {
                //$this->model->send_otp($userId,$data[0]['var_mobile_no']);
                $response['status'] = 200;
                $response['message'] = USER_SIGNUP;
                $response['data'] = $data;
                $response['user_id'] = $userId;
            } else {
                $response['status'] = 404;
                $response['message'] = ADD_ERROR;
            }
        }

        echo (json_encode($response));
        exit;
    }

    public function showCatvendors()
    {
        $data = $this->model->getCatvendors();
        if ($data != '') {
            $response['status'] = true;
            $response['message'] = $data;
        } else {
            $response['status'] = false;
            $response['message'] = "No data";
        }
        echo (json_encode($response));
        exit;
    }

    public function showVendors()
    {
        $var_state = $this->input->post('var_state');
        $var_city = $this->input->post('var_city');
        $cat = $this->input->post('cat');
        $data = $this->model->getVendors($var_state, $var_city, $cat);
        if (($data != '') || ($data == 0)) {
            //$this->model->send_otp($userId,$data[0]['var_mobile_no']);
            $response['status'] = 200;
            $response['data'] = $data;
        } else {
            $response['status'] = 404;
            $response['message'] = ADD_ERROR;
        }
        echo (json_encode($response));
        exit;
    }

    public function showUser()
    {
        $userId = $this->input->post('user_id');
        $data = $this->model->getUser($userId);
        if (($data != '') || ($data == 0)) {
            //$this->model->send_otp($userId,$data[0]['var_mobile_no']);
            $response['status'] = 200;
            $response['data'] = $data;
        } else {
            $response['status'] = 404;
            $response['message'] = ADD_ERROR;
        }
        echo (json_encode($response));
        exit;
    }
    public function businessRegistration()
    {
        $email = $this->input->post('var_email');
        $mobile_no = $this->input->post('var_mobile_no');
        $landline_no = $this->input->post('var_alt_mobile');
        $useremail = $this->model->checkEmail($email);
        $userMobile = $this->model->checkMobileNo($mobile_no);
        $userLandline = $this->model->checkMobileNo($landline_no);
        if ($useremail == false) {
            $response['status'] = 404;
            $response['message'] = UNIQUE_EMAIL;
        } elseif ($userMobile == false) {

            $response['status'] = 404;
            $response['message'] = UNIQUE_MOBILE;
        } elseif ($userLandline == false) {

            $response['status'] = 404;
            $response['message'] = UNIQUE_MOBILE;
        } else {
            $userId = $this->model->addBusiness();
            $data = $this->model->getProfileDetalis($userId);
            if (($userId != '') || ($userId == 0)) {
                //$this->model->send_otp($userId,$data[0]['var_mobile_no']);
                $response['status'] = 200;
                $response['message'] = USER_SIGNUP;
                $response['data'] = $data;
                $response['user_id'] = $userId;
            } else {
                $response['status'] = 404;
                $response['message'] = ADD_ERROR;
            }
        }

        echo (json_encode($response));
        exit;
    }

    public function sarafaRegistration()
    {
        $email = $this->input->post('var_email');
        $mobile_no = $this->input->post('var_mobile_no');
        $landline_no = $this->input->post('var_alt_mobile');
        $useremail = $this->model->checkEmail($email);
        $userMobile = $this->model->checkMobileNo($mobile_no);
        $userLandline = $this->model->checkMobileNo($landline_no);
        if ($useremail == false) {
            $response['status'] = 404;
            $response['message'] = UNIQUE_EMAIL;
        } elseif ($userMobile == false) {

            $response['status'] = 404;
            $response['message'] = UNIQUE_MOBILE;
        } elseif ($userLandline == false) {

            $response['status'] = 404;
            $response['message'] = UNIQUE_MOBILE;
        } else {
            $userId = $this->model->addSarafa();
            $data = $this->model->getProfileDetalis($userId);
            if (($userId != '') || ($userId == 0)) {
                //$this->model->send_otp($userId,$data[0]['var_mobile_no']);
                $response['status'] = 200;
                $response['message'] = USER_SIGNUP;
                $response['data'] = $data;
                $response['user_id'] = $userId;
            } else {
                $response['status'] = 404;
                $response['message'] = ADD_ERROR;
            }
        }

        echo (json_encode($response));
        exit;
    }
    
    public function checkmobile(){
        
        $mobile_no = $this->input->post('var_mobile_no');
        $email = $this->input->post('var_email');
        $userMobile = $this->model->checkMobileNo($mobile_no);
        $useremail = $this->model->checkEmail($email); 
        if ($useremail == false) {
            $response['status'] = 404;
            $response['message'] = UNIQUE_EMAIL;
        } elseif ($userMobile == false) {

            $response['status'] = 404;
            $response['message'] = UNIQUE_MOBILE;
        }else{
            $response['status'] = 200;
            $response['message'] = "done";
        }
        echo (json_encode($response));
        exit;
    }
    
   

    public function showBusinessCategory()
    {
        $data = $this->model->showBusinessCategory();
        $response['status'] = 200;
        $response['data'] = $data;
        echo (json_encode($response));
        exit;
    }
    
    public function home()
    {
        $data = $this->model->homeCategory();
        $response['status'] = 200;
        $response['data'] = $data;
        echo (json_encode($response));
        exit;
    }

    /*--------------------------------- user edit profile -----------------------------*/
    public function userEditProfile()
    {
        $userId = $this->input->post('user_id');
        $updateStatus = $this->model->updateUser($userId);

        $data = $this->model->getProfileDetalis($userId);
        if ($updateStatus == 'true') {
            $response['status'] = 200;
            $response['message'] = USER_EDIT;
            $response['data'] = $data;
        } else {
            $response['status'] = 404;
            $response['message'] = EDIT_ERROR;
        }


        echo (json_encode($response));
        exit;
    }

    /*------------------------ delete product multiple images --------------------*/
    public function deleteProductImges()
    {
        //echo "hello";
        //die();
        $id = $_POST['id'];

        $del_image = $_POST['image'];
        //echo $del_image;
        //die;
        $sql = "select p_images from mst_users where int_glcode='$id'";
        $result = $this->db->query($sql);
        $row = $result->result_array();
        $images = $row[0]['p_images'];
        $update_images = str_replace($del_image . ',', '', $images);

        $filePath = "uploads/userProduct/" . $del_image;
        if (unlink($filePath)) {
            $sql1 = "update mst_users set p_images='$update_images' where int_glcode='$id'";
            if ($this->db->query($sql1)) {
                $response['status'] = true;
                $response['message'] = "image is deleted";
            } else {
                $response['status'] = false;
                $response['message'] = "image is not deleted";
            }
            echo (json_encode($response));
            exit;
        }
    }
    public function city_search()
    {
        $search = $this->input->post('search');
        $data = $this->model->get_city_search($search);
        if ($data != '') {
            $response['status'] = true;
            $response['message'] = $data;
        } else {
            $response['status'] = false;
            $response['message'] = "No data";
        }
        echo json_encode($response);
    }
    public function state_search()
    {
        $search = $this->input->post('search');
        $data = $this->model->get_state_search($search);
        if ($data != '') {
            $response['status'] = true;
            $response['message'] = $data;
        } else {
            $response['status'] = false;
            $response['message'] = "No data";
        }
        echo json_encode($response);
    }
    /*-------------------------------- user verify otp --------------------------- */
    public function userVerifyOTP()
    {
        $userId = $this->input->post('user_id');
        $var_otp = $this->input->post('var_otp');

        if (($userId == '') || ($var_otp == '')) {
            $response['status'] = 404;
            $response['message'] = INCOMPLTE_DETAIL;
        } else {

            $row_arr =  $this->model->get_otp($userId, '1234');
            $data = $this->model->getProfileDetalis($userId);
            if (!empty($row_arr)) {

                $response['status'] = 200;
                $response['message'] = OTP_VERIFY;
                $response['data'] = $data;
            } else {
                $response['status'] = 404;
                $response['message'] = OTP_FAILED;
            }
        }
        echo (json_encode($response));
        exit;
    }

    /*------------------------------------- user login ---------------------------------*/
    public function userSignin()
    {
        $var_username = $_POST['var_mobile_no'];
        $var_password = $this->mylibrary->cryptPass($_POST['var_password']);
        $device_id = $_POST['var_device_token'];

        if ($var_username == '' || $var_password == '') {
            $response['status'] = 404;
            $response['message'] = INCOMPLTE_DETAIL;
        } else {

            $query =  $this->model->user_login($var_username, $var_password);
            $user_id = $query['int_glcode'];

            if (count($query) > 0) {

                $this->model->updateDeviceId($device_id, $user_id);
                $data = $this->model->getProfileDetalis($user_id);
                if ($data[0]['chr_verify'] == 'N') {

                    //$send_otp =  $this->model->send_otp($data[0]['user_id'],$data[0]['var_mobile_no']);

                } else {
                }

                $response['status'] = 200;
                $response['message'] = USER_SIGNIN;
                $response['data'] = $data;
            } else {
                $response['status'] = 404;
                $response['message'] = NO_USER;
            }
        }

        echo (json_encode($response));
        exit;
    }



    /*--------------------------  change password  -----------------------------*/
    public function userChangePassword()
    {
        $user_id = $_POST['user_id'];

        $old_password = $this->mylibrary->cryptPass($_POST['old_password']);
        $new_password = $this->mylibrary->cryptPass($_POST['new_password']);

        if ($old_password == '' || $new_password == '') {
            $response['status'] = 404;
            $response['message'] = INCOMPLTE_DETAIL;
        } else if ($old_password == $new_password) {

            $response['status'] = 404;
            $response['message'] = SAME_PASSWORD;
        } else {

            $query = $this->model->chagePass($user_id, $old_password);
            $countmail = $query->num_rows();

            if ($countmail > 0) {

                $updateQuery = $this->model->updatePassChange($new_password, $user_id);
                $response['status'] = 200;
                $response['userdata'] = CHANGE_PASS;
            } else {

                $response['status'] = 404;
                $response['message'] = OLD_PASSWORD;
            }
        }

        echo (json_encode($response));
        exit;
    }

    /*------------------------------------- User Logout -------------------------------*/
    public function userLogout()
    {
        $user_id = $_POST['user_id'];

        if ($user_id != '') {
            if ($this->model->user_logout($user_id)) {
                $response['status'] = 200;
                $response['message'] = LOGOUT_USER;
            } else {
                $response['status'] = 404;
                $response['message'] = LOGOUT_ERROR;
            }
        } else {
            $response['status'] = 404;
            $response['message'] = INCOMPLTE_DETAIL;
        }
        echo (json_encode($response));
        exit;
    }

    /*------------------------------ send user otp ------------------------------- */
    public function sendMobileOTP()
    {
        //$userId = $this->input->post('user_id');
        $var_mobile = $this->input->post('mobile');


        if (($var_mobile == '')) {
            $response['status'] = 404;
            $response['message'] = INCOMPLTE_DETAIL;
        } else {
            $send_otp =  $this->common_model->send_otp_verification($var_mobile);

            $response['status'] = 200;
            $response['message'] = SEND_OTP;
        }

        echo (json_encode($response));
        exit;
    }
    /*------------------------------------ verify otp ----------------------------------- */
    public function verifyOTP()
    {
        $mobile = $this->input->post('mobile');
        $var_otp = $this->input->post('var_otp');

        if ($var_otp == '') {
            $response['status'] = 404;
            $response['message'] = INCOMPLTE_DETAIL;
        } else {

            $row_arr =  $this->model->get_otp($mobile, $var_otp);

            if (!empty($row_arr)) {
                $response['status'] = 200;
                $response['data'] = $row_arr;
                $response['message'] = OTP_VERIFY;
            } else {
                $response['status'] = 404;
                $response['message'] = OTP_FAILED;
            }
        }
        echo (json_encode($response));
        exit;
    }







    /*------------------------------- user forgot password --------------------------*/
    public function forgotPassword()
    {
        $var_email = $_POST['var_email'];
        $check_field = $this->model->checkForgotLink($var_email);

        //echo $check_field; exit();

        if ($check_field != 'failed_data') {

            // $this->load->library('email');
            // echo "email = ".$check_field." <br>";
            $id = $this->model->get_userid($check_field);
            // echo "id = ".$id." <br>";
            // $this->load->library('email');

            // //SMTP & mail configuration
            // $this->load->library('smtpemail');
            // $config = $this->smtpemail->globalEmail();
            // $this->email->initialize($config);
            // $this->email->set_mailtype("html");
            // $this->email->set_newline("\r\n");

            // //Email content
            // $img_path = base_url();
            $url = base_url() . 'store_user_reset_password/' . base64_encode($id);
            // $htmlContent = file_get_contents('public/templates/forgot.php');
            // $htmlContent = str_replace("@IMG_LOGO", $img_path, $htmlContent);
            // $htmlContent = str_replace("@BTN_URL", $url, $htmlContent);
            // $this->email->to($check_field);
            // $this->email->from(FROM_EMAIL, 'CI Ecommerce');
            // $this->email->subject('Forgot Password');
            // $this->email->message($htmlContent);
            
            $to = $check_field;

            $subject = 'Forgot Password';
    
            $headers = "From: " . FROM_EMAIL . "\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
            
            $message = 'Forgot Your Password <a href= "'.$url.'" >Here</a> ';
            // echo $to.", ".$subject.", ".$message.", ".$headers;exit;
            //Send email   $this->email->send()

            if (mail($to, $subject, $message, $headers)) {
                $updateTimeStamp = $this->model->updateTimeStamp($var_email);
                $response['status'] = 200;
                $response['message'] = FORGOT_MSG_SUCCESS;
            } else {
                $response['status'] = 404;
                $response['message'] = MAIL_FAILED;
            }
        }

        // if ($check_field == 'mobile_no') {

        //     $user_id = $this->model->get_username_id($_POST['var_email']);
        //     $user = base64_encode($user_id);
        //     //echo $user_id; exit();
        //     $url = base_url() . 'store_user_reset_password/' . $user;

        //     $var_name = $this->model->get_user_name($_POST['var_email']);
            // $this->common_model->user_forgot_password($var_name, $url, $_POST['var_email']);

        //     $response['status'] = 200;
        //     $response['message'] = FORGOT_MSG_SUCCESS;
        //     //exit();
        // }

        if ($check_field == 'failed_data') {
            $response['status'] = 404;
            $response['message'] = FORGOT_MSG;
        }

        echo (json_encode($response));
        exit;
    }
}
