<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Common_model extends CI_Model
{
    /* function to check user loged in or not. */
    //   function displayError($error_details) 
    //  {
    //     // display message
    //     $message = 'You got an error  <b>' . $error_details['error_name'] . '</b><br/> Model Name:- <b>' . $error_details['model_name'] . '</b> <br/>  model method is :-<b>' . $error_details['model_method_name'] . '</b><br/> Controller <b>' . $error_details['controller_name'] . '</b>  <br/> Controller method is :<b>' . $error_details['controller_method_name'] . '</b>';
    //     // return boolean value for message send

    //     return $message;

    // }
    /* common function to get records from the database table */


    public function __construct()
    {

        parent::__construct();
        $this->load->database();
        $this->load->library('mylibrary');
    }

    /* function to get record into the database */
    public function getRecord($fields = array(), $table_name)
    {
        $this->db->select($fields);
        $this->db->from($table_name);
        $this->db->where('chr_publish', 'Y');
        $this->db->where('chr_delete', 'N');
        $query = $this->db->get();
        $row = $query->result_array();

        return $row;
    }


    /* function to insert record into the database */
    public function insertRow($insert_data, $table_name)
    {

        $this->db->insert($table_name, $insert_data);
        // echo $this->db->last_query();
        // die;
        return $this->db->insert_id();
    }

    /* function to update record in the database
     * Modified by Arvind   
     */

    public function updateRow($table_name, $update_data, $condition)
    {
        if (is_array($condition)) {
            if (count($condition) > 0) {
                foreach ($condition as $field_name => $field_value) {
                    if ($field_name != '' && $field_value != '' && $field_value != NULL) {
                        $this->db->where($field_name, $field_value);
                    }
                }
            }
        } else if ($condition != "" && $condition != NULL) {
            $this->db->where($condition);
        }

        $this->db->update($table_name, $update_data);
        //echo $this->db->last_query();
        //  exit();
    }
    /* common function to delete rows from the table
     * Modified by Arvind

     */ //////////////generate authentication token for API  encrypted///////////////
    ///////////////////////////////////////////////////////////////////////////////
    public function generateToken($vendorId)
    {

        $project_name = 'vruits';
        $currenttimestamp = time();
        $token_id = $vendorId . $project_name . $currenttimestamp;
        $data = array(
            'var_auth_token' => base64_encode($token_id)
        );

        $this->updateRow('mst_vendors', $data, array("int_glcode" => $vendorId));
        return base64_encode($token_id);
    }

    /*----------------------- generate user tokens ------------------------------*/
    public function generateUserToken($userId)
    {
        $project_name = 'vruits_users';
        $currenttimestamp = time();
        $token_id = $userId . $project_name . $currenttimestamp;
        $data = array(
            'var_auth_token' => base64_encode($token_id)
        );

        $this->updateRow('mst_users', $data, array("int_glcode" => $userId));
        return base64_encode($token_id);
    }

    /*--------------- generate authentication token for API  encrypted -------------*/
    public function decryptToken($token)
    {
        $decrypt_token = base64_decode($token);
        return $decrypt_token;
    }

    /*------------------------ vendor match token --------------------------*/
    public function matchToken($userId)
    {
        $this->db->select('var_auth_token');
        $this->db->from('mst_vendors');
        $this->db->where('int_glcode', $userId);
        $this->db->where('chr_publish', 'Y');
        $this->db->where('chr_delete', 'N');
        $query = $this->db->get();
        $row = $query->row_array();
        return $row['var_auth_token'];
    }

    /*------------------------ user match token --------------------------*/
    public function userMatchToken($userId)
    {
        $this->db->select('var_auth_token');
        $this->db->from('mst_users');
        $this->db->where('int_glcode', $userId);
        $this->db->where('chr_publish', 'Y');
        $this->db->where('chr_delete', 'N');
        $query = $this->db->get();
        $row = $query->row_array();
        return $row['var_auth_token'];
    }

    /*-------------------------- generate random password -------------*/
    public function generateRandomString($length = 8)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function generateRandomString1($length = 8)
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    /*-------------------------- generate random password -------------*/
    public function generateRandomNumber($length = 4)
    {
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    /*------------- empty string -------------*/
    public function emptyVar($field)
    {
        if (($field == NULL) || ($field == '')) {
            $field = "";
        }
        return $field;
    }


    public function deleteRows($arr_delete_array, $table_name, $field_name)
    {
        if (count($arr_delete_array) > 0) {
            foreach ($arr_delete_array as $id) {
                if ($id) {
                    $this->db->where($field_name, $id);
                    $query = $this->db->delete($table_name);
                }
            }
        }
        exit();
    }
    /*
     * function to get absolute path for project
     */

    public function absolutePath($path = '')
    {
        $abs_path = str_replace('system/', $path, BASEPATH);
        //Add a trailing slash if it doesn't exist.
        $abs_path = preg_replace("#([^/])/*$#", "\\1/", $abs_path);
        exit();
        return $abs_path;
    }

    ////////////////////////// all tab delete records /////////////////////////////
    public function deleteModule($tbl_name, $tbl_id)
    {
        $data = array(
            'chr_delete' => 'Y'
        );
        $this->updateRow($tbl_name, $data, array("int_glcode" => $tbl_id));
        return TRUE;
    }

    public function insertinlogmanager($mode, $vendor)
    {

        $data = array(
            'fk_admin' => $_SESSION['adminuser'],
            'fk_vendor' => $vendor,
            'chr_mode' => $mode,
            'dt_createddate' => date('Y-m-d H:i:s'),
            'var_ipaddress' => $_SERVER['REMOTE_ADDR']
        );

        $query = $this->db->insert('mst_logmanager', $data);

        return true;
    }



    /*------------------------------- get user otp --------------------------- */
    public function send_otp_verification($var_mobile)
    {
        $OTP = '1234'; //$this->mylibrary->generateOTP(4);

        //        $message = $OTP." is your gramango verification code.";
        //        $data = "workingkey=Accac47e1d27cc04db21bd03bbcbd18de&to".$var_mobile."&sender=GRMNGO&message=".$message;
        //        $ch = curl_init('http://alerts.prioritysms.com/api/web2sms.php?');
        //        curl_setopt($ch, CURLOPT_POST, true);
        //        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        //        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //        $result = curl_exec($ch); // This is the result from the API
        //        curl_close($ch);

        $data = array(
            'var_otp' => $OTP,
        );

        $this->db->where('var_mobile_no', $var_mobile);
        $this->db->update('mst_users', $data);

        return TRUE;
    }
    //
    //    /*-----------------------delivery boy get notification --------------------- */
    //    public function assign_order_notification($name,$var_deviceid) 
    //    {
    //        $url = 'https://fcm.googleapis.com/fcm/send';
    //
    //        $target = $var_deviceid;
    //
    //        $data['type'] = 'Assign_order';
    //
    //        $data['message'] = 'Dear '.$name.',Congratulation! You have received a new order.';
    //
    //        $fields = array();
    //
    //        $fields['data'] = $data;
    //
    //        if (is_array($target)) {
    //            $fields['registration_ids'] = $target;
    //        } else {
    //            $fields['to'] = $target;
    //        }
    //
    //        $headers = array(
    //            'Content-Type:application/json',
    //            'Authorization:key=' . NOTIFICATION_KEY
    //        );
    //
    //        $ch = curl_init();
    //        curl_setopt($ch, CURLOPT_URL, $url);
    //        curl_setopt($ch, CURLOPT_POST, true);
    //        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    //        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    //        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    //        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
    //        $result = curl_exec($ch);
    //        curl_close($ch);
    //
    //        //echo $result; exit();
    //
    //        return TRUE;  
    //
    //    }
    //
    //    /*-----------------------delivery boy get notification --------------------- */
    //    public function complete_order_vendor($var_deviceid) 
    //    {
    //        $url = 'https://fcm.googleapis.com/fcm/send';
    //
    //        $target = $var_deviceid;
    //
    //        $data['type'] = 'Complete_order';
    //
    //        $data['message'] = 'Your order completed successfully !';
    //
    //        $fields = array();
    //
    //        $fields['data'] = $data;
    //
    //        if (is_array($target)) {
    //            $fields['registration_ids'] = $target;
    //        } else {
    //            $fields['to'] = $target;
    //        }
    //
    //        $headers = array(
    //            'Content-Type:application/json',
    //            'Authorization:key=' . NOTIFICATION_KEY
    //        );
    //
    //        $ch = curl_init();
    //        curl_setopt($ch, CURLOPT_URL, $url);
    //        curl_setopt($ch, CURLOPT_POST, true);
    //        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    //        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    //        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    //        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
    //        $result = curl_exec($ch);
    //        curl_close($ch);
    //
    //        //echo $result; exit();
    //
    //        return TRUE;  
    //
    //    }
    //
    //    public function send_register_user($name,$email,$phone,$flag )
    //    {
    //        if ($flag == 'A') {
    //            $message = 'This is to inform you that, Your account with Admin has been created successfully. Log it for more details.';
    //        } else {
    //            $message = 'This is to inform you that, your registration has been done successfully. Log in and start Shopping.';
    //        }
    //        //SMTP & mail configuration
    //        $this->load->library('smtpemail');
    //        $config = $this->smtpemail->globalEmail();
    //        
    //        $this->email->initialize($config);
    //        $this->email->set_mailtype("html");
    //        $this->email->set_newline("\r\n");
    //
    //        //Email content
    //
    //        $img_path = base_url();
    //        $htmlContent = file_get_contents('public/templates/registration.php');
    //        $htmlContent = str_replace("@MESSAGE", $message, $htmlContent);
    //        $htmlContent = str_replace("@IMG_LOGO", $img_path, $htmlContent);
    //        $htmlContent = str_replace("@NAME", $name, $htmlContent);
    //        $htmlContent = str_replace("@EMAIL", $email, $htmlContent);
    //        $htmlContent = str_replace("@MOBILENO", $phone, $htmlContent);
    //        $this->email->to($email);
    //        $this->email->from(FROM_EMAIL,'Vruits');
    //        $this->email->subject('Registration');
    //        $this->email->message($htmlContent);
    //
    //        //Send email
    //        $this->email->send();
    //    }
    //
    //    public function send_contact_user($name,$email,$phone,$subject,$message,$flag)
    //    {
    //        if ($flag == 'U') {
    //            $head_message = '<b>Dear '.$name.',</b> Thank you for contacting us. We will get back to you within 24 working hours.';
    //        } else {
    //            $head_message = '<b>Dear Admin,</b>This is to inform you that, '.$name.' has been generated inquiry.</b>';
    //        }
    //        //SMTP & mail configuration
    //        $this->load->library('smtpemail');
    //        $config = $this->smtpemail->globalEmail();
    //        $this->email->initialize($config);
    //        $this->email->set_mailtype("html");
    //        $this->email->set_newline("\r\n");
    //
    //        //Email content
    //
    //        $img_path = base_url();
    //        $htmlContent = file_get_contents('public/templates/user_contact.php');
    //        $htmlContent = str_replace("@HEADER_MESSAGE", $head_message, $htmlContent);
    //        $htmlContent = str_replace("@MESSAGE", $message, $htmlContent);
    //        $htmlContent = str_replace("@IMG_LOGO", $img_path, $htmlContent);
    //        $htmlContent = str_replace("@NAME", $name, $htmlContent);
    //        $htmlContent = str_replace("@EMAIL", $email, $htmlContent);
    //        $htmlContent = str_replace("@MOBILENO", $phone, $htmlContent);
    //        $htmlContent = str_replace("@SUBJECT", $subject, $htmlContent);
    //        $this->email->to($email);
    //        $this->email->from(FROM_EMAIL,'Vruits');
    //        $this->email->subject('Contact us');
    //        $this->email->message($htmlContent);
    //
    //        //Send email
    //        $this->email->send();
    //
    //    }
    //
    //    public function send_contact_us($name,$email,$phone,$subject,$message,$flag)
    //    {
    //        if ($flag == 'A') {
    //            $head_message = '<b>Dear Admin,</b>This is to inform you that, '.$name.' has been generated inquiry.</b>';
    //        } else {
    //            $head_message = '<b>Dear '.$name.',</b> Thank you for contacting us. We will get back to you within 24 working hours.';
    //        }
    //
    //        //SMTP & mail configuration
    //        $this->load->library('smtpemail');
    //        $config = $this->smtpemail->globalEmail();
    //        $this->email->initialize($config);
    //        $this->email->set_mailtype("html");
    //        $this->email->set_newline("\r\n");
    //
    //        //Email content
    //
    //        $img_path = base_url();
    //        $htmlContent = file_get_contents('public/templates/user_contact.php');
    //        $htmlContent = str_replace("@HEADER_MESSAGE", $head_message, $htmlContent);
    //        $htmlContent = str_replace("@MESSAGE", $message, $htmlContent);
    //        $htmlContent = str_replace("@IMG_LOGO", $img_path, $htmlContent);
    //        $htmlContent = str_replace("@NAME", $name, $htmlContent);
    //        $htmlContent = str_replace("@EMAIL", $email, $htmlContent);
    //        $htmlContent = str_replace("@MOBILENO", $phone, $htmlContent);
    //        $htmlContent = str_replace("@SUBJECT", $subject, $htmlContent);
    //        $this->email->to(ADMIN_EMAIL);
    //        $this->email->from(FROM_EMAIL,'Vruits');
    //        $this->email->subject('Contact us');
    //        $this->email->message($htmlContent);
    //
    //        //Send email
    //        $this->email->send();
    //           
    //    } 
    //
    //    public function send_feedback_user($name,$email,$message,$flag)
    //    {
    //        if ($flag == 'U') {
    //            $head_message = '<b>Dear '.$name.',</b> Thank you for your valuable feedback.';
    //        } else {
    //            $head_message = '';
    //        }
    //        //SMTP & mail configuration
    //        $this->load->library('smtpemail');
    //        $config = $this->smtpemail->globalEmail();
    //        $this->email->initialize($config);
    //        $this->email->set_mailtype("html");
    //        $this->email->set_newline("\r\n");
    //
    //        //Email content
    //
    //        $img_path = base_url();
    //        $htmlContent = file_get_contents('public/templates/user_feedback.php');
    //        $htmlContent = str_replace("@HEADER_MESSAGE", $head_message, $htmlContent);
    //        $htmlContent = str_replace("@MESSAGE", $message, $htmlContent);
    //        $htmlContent = str_replace("@IMG_LOGO", $img_path, $htmlContent);
    //        $this->email->to($email);
    //        $this->email->from(FROM_EMAIL,'Vruits');
    //        $this->email->subject('Feedback');
    //        $this->email->message($htmlContent);
    //
    //        //Send email
    //        $this->email->send();
    //
    //    }
    //
    //    public function send_feedback_admin($name,$email,$message,$flag)
    //    {
    //        if ($flag == 'A') {
    //            $head_message = '<b>Dear Admin,</b>This is to inform you that, '.$name.' has been generated feedback.';
    //        }
    //
    //        //SMTP & mail configuration
    //        $this->load->library('smtpemail');
    //        $config = $this->smtpemail->globalEmail();
    //        $this->email->initialize($config);
    //        $this->email->set_mailtype("html");
    //        $this->email->set_newline("\r\n");
    //
    //        //Email content
    //
    //        $img_path = base_url();
    //        $htmlContent = file_get_contents('public/templates/user_feedback.php');
    //        $htmlContent = str_replace("@HEADER_MESSAGE", $head_message, $htmlContent);
    //        $htmlContent = str_replace("@MESSAGE", $message, $htmlContent);
    //        $htmlContent = str_replace("@IMG_LOGO", $img_path, $htmlContent);
    //        $this->email->to(ADMIN_EMAIL);
    //        $this->email->from(FROM_EMAIL,'Vruits');
    //        $this->email->subject('Feedback');
    //        $this->email->message($htmlContent);
    //
    //        //Send email
    //        $this->email->send();
    //    }
    //
    //    public function send_register_admin($name,$email,$phone)
    //    {
    //        //SMTP & mail configuration
    //        $this->load->library('smtpemail');
    //        $config = $this->smtpemail->globalEmail();
    //        $this->email->initialize($config);
    //        $this->email->set_mailtype("html");
    //        $this->email->set_newline("\r\n");
    //
    //        //Email content
    //            
    //        $img_path = base_url();
    //        $htmlContent = file_get_contents('public/templates/admin_registration.php');
    //        $htmlContent = str_replace("@IMG_LOGO", $img_path, $htmlContent);
    //        $htmlContent = str_replace("@NAME", $name, $htmlContent);
    //        $htmlContent = str_replace("@EMAIL", $email, $htmlContent);
    //        $htmlContent = str_replace("@MOBILENO", $phone, $htmlContent);
    //        $this->email->to(ADMIN_EMAIL);
    //        $this->email->from(FROM_EMAIL,'Vruits');
    //        $this->email->subject('Registration');
    //        $this->email->message($htmlContent);
    //
    //        //Send email
    //        $this->email->send();
    //    }
    //    
    //    public function send_newsletter_user($email)
    //    {
    //        //SMTP & mail configuration
    //        $this->load->library('smtpemail');
    //        $config = $this->smtpemail->globalEmail();
    //        $this->email->initialize($config);
    //        $this->email->set_mailtype("html");
    //        $this->email->set_newline("\r\n");
    //
    //        //Email content
    //        $message = "Thank you for subscribing to our newsletter!";
    //        $img_path = base_url();
    //        $htmlContent = file_get_contents('public/templates/newsletter.php');
    //        $htmlContent = str_replace("@MESSAGE", $message, $htmlContent);
    //        $htmlContent = str_replace("@IMG_LOGO", $img_path, $htmlContent);
    //        $this->email->to($email);
    //        $this->email->from(FROM_EMAIL,'Vruits');
    //        $this->email->subject('Vruits - Newsletter');
    //        $this->email->message($htmlContent);
    //
    //        //Send email
    //        $this->email->send();
    //
    //        //echo $this->email->print_debugger();
    //    }
    //    
    //    public function send_newsletter_admin($email)
    //    {
    //        //SMTP & mail configuration
    //        $this->load->library('smtpemail');
    //        $config = $this->smtpemail->globalEmail();
    //        $this->email->initialize($config);
    //        $this->email->set_mailtype("html");
    //        $this->email->set_newline("\r\n");
    //
    //        //Email content
    //            
    //        $img_path = base_url();
    //        $htmlContent = file_get_contents('public/templates/admin_newsletter.php');
    //        $htmlContent = str_replace("@IMG_LOGO", $img_path, $htmlContent);
    //        $htmlContent = str_replace("@EMAIL", $email, $htmlContent);
    //        $this->email->to(ADMIN_EMAIL); 
    //        $this->email->from(FROM_EMAIL,'Vruits');
    //        $this->email->subject('Vruits - Newsletter');
    //        $this->email->message($htmlContent);
    //
    //        //Send email
    //        $this->email->send();
    //    }
    //    
    //    /*------------------------------- send user order msg --------------------------- */
    //    public function user_order_msg($name,$var_mobile,$chr_type,$orderId,$cancel_by='',$amount='') 
    //    {
    //        if ($chr_type == "CONTACT_NO") {
    //            $message = "Dear ".$name.", Your Contact No. Updated Successfully in Vruits !";
    //        } elseif ($chr_type == "cancel_order") {
    //            $message = "Dear ".$name.", your order with order id #".$orderId." For Rs ".$amount."/- has been cancelled successfully by (".$cancel_by."), Hope to see you soon again on Vruits!";
    //        } else {
    //            $message = "Dear ".$name.", your order with order id #".$orderId." For Rs ".$amount."/- has been placed successfully, Thank you for shopping with us.";
    //        }
    //        
    //        $curl = curl_init();
    //
    //        curl_setopt_array($curl, array(
    //          CURLOPT_URL => "https://sms.bulksmsflash.com/rest/services/sendSMS/sendGroupSms?AUTH_KEY=5d18e29d53784559d4dccb96ffd39d0",
    //          CURLOPT_RETURNTRANSFER => true,
    //          CURLOPT_ENCODING => "",
    //          CURLOPT_MAXREDIRS => 10,
    //          CURLOPT_TIMEOUT => 30,
    //          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //          CURLOPT_CUSTOMREQUEST => "POST",
    //          CURLOPT_POSTFIELDS => "{\"smsContent\":\"$message\",\"routeId\":\"1\",\"mobileNumbers\":\"$var_mobile\",\"senderId\":\"vruits\",\"smsContentType\":\"english\"}",
    //          CURLOPT_HTTPHEADER => array(
    //            "Cache-Control: no-cache",
    //            "Content-Type: application/json"
    //          ),
    //        ));
    //
    //        $response = curl_exec($curl);
    //        $err = curl_error($curl);
    //
    //        curl_close($curl);
    //
    //        if ($err) {
    //          //echo "cURL Error #:" . $err;
    //        } else {
    //          //echo $response;
    //        }
    //
    //        return TRUE;  
    //
    //    }
    //
    //    /*------------------------------- send user order msg --------------------------- */
    //    public function user_forgot_password($name,$url,$var_mobile) 
    //    {
    //        //echo $var_mobile; exit();
    //        $message = "Dear ".$name.", we have received your request for forgot password.We are requesting you click password link and change the password once.".$url;
    //        
    //        $curl = curl_init();
    //
    //        curl_setopt_array($curl, array(
    //          CURLOPT_URL => "https://sms.bulksmsflash.com/rest/services/sendSMS/sendGroupSms?AUTH_KEY=5d18e29d53784559d4dccb96ffd39d0",
    //          CURLOPT_RETURNTRANSFER => true,
    //          CURLOPT_ENCODING => "",
    //          CURLOPT_MAXREDIRS => 10,
    //          CURLOPT_TIMEOUT => 30,
    //          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //          CURLOPT_CUSTOMREQUEST => "POST",
    //          CURLOPT_POSTFIELDS => "{\"smsContent\":\"$message\",\"routeId\":\"1\",\"mobileNumbers\":\"$var_mobile\",\"senderId\":\"vruits\",\"smsContentType\":\"english\"}",
    //          CURLOPT_HTTPHEADER => array(
    //            "Cache-Control: no-cache",
    //            "Content-Type: application/json"
    //          ),
    //        ));
    //
    //        $response = curl_exec($curl);
    //        $err = curl_error($curl);
    //
    //        curl_close($curl);
    //
    //        if ($err) {
    //          //echo "cURL Error #:" . $err;
    //        } else {
    //          //echo $response;
    //        }
    //
    //        return TRUE;  
    //
    //    }
    //
    //    /*------------------------------- send user order msg --------------------------- */
    //    public function user_transactions($name,$var_mobile,$balance,$updateBalnce,$transaction_type) 
    //    {
    //        if ($transaction_type == "C") {
    //            $message = "Dear ".$name.", Rs. ".$balance." Added Successfully in your Vruits Account . Your Current Balace is ".$updateBalnce."";
    //        } else {
    //            $message = "Dear ".$name.", Rs. ".$balance." Paid Successfully in your Vruits. Your Current Balace is ".$updateBalnce."";
    //        }
    //        
    //        $curl = curl_init();
    //
    //        curl_setopt_array($curl, array(
    //          CURLOPT_URL => "https://sms.bulksmsflash.com/rest/services/sendSMS/sendGroupSms?AUTH_KEY=5d18e29d53784559d4dccb96ffd39d0",
    //          CURLOPT_RETURNTRANSFER => true,
    //          CURLOPT_ENCODING => "",
    //          CURLOPT_MAXREDIRS => 10,
    //          CURLOPT_TIMEOUT => 30,
    //          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //          CURLOPT_CUSTOMREQUEST => "POST",
    //          CURLOPT_POSTFIELDS => "{\"smsContent\":\"$message\",\"routeId\":\"1\",\"mobileNumbers\":\"$var_mobile\",\"senderId\":\"vruits\",\"smsContentType\":\"english\"}",
    //          CURLOPT_HTTPHEADER => array(
    //            "Cache-Control: no-cache",
    //            "Content-Type: application/json"
    //          ),
    //        ));
    //
    //        $response = curl_exec($curl);
    //        $err = curl_error($curl);
    //
    //        curl_close($curl);
    //
    //        if ($err) {
    //          //echo "cURL Error #:" . $err;
    //        } else {
    //          //echo $response;
    //        }
    //
    //        return TRUE;  
    //
    //    }


    function get_product_price($id, $size = '')
    {

        $this->db->select('int_glcode,var_quantity,var_price,var_discount_price');
        $this->db->where('fk_product', $id);
        if ($size != '') {
            $this->db->where('var_quantity', $size);
        }
        $sql = $this->db->get('trn_product_price');
        $res = $sql->result_array();
        return $res;
    }

    function get_product_img($id)
    {

        $this->db->select('int_glcode,var_images');
        $this->db->where('fk_product', $id);
        $sql = $this->db->get('trn_product_images');
        $res = $sql->result_array();
        return $res;
    }

    function getIdByData($id)
    {

        $this->db->select('*');
        $this->db->where('int_glcode', $id);
        $res = $this->db->get('mst_vendors');
        $row = $res->row_array();
        return $row;
    }

    function get_seen_count($uid)
    {

        $this->db->select('COUNT(int_glcode) as total');
        $this->db->where('fk_user', $uid);
        $this->db->where('int_seen', '0');
        $count = $this->db->get('mst_user_chat');
        $row = $count->row_array();
        return $row['total'];
    }

    function DateFormatter($date)
    {

        $note_date = "";

        $timeStamp = strtotime($date);

        $str_time = date("Y-m-d G:i:sP", $timeStamp);
        $time = strtotime($str_time);
        $d = new DateTime($str_time);

        $weekDays = ['Mon', 'Tue', 'Wed', 'Thur', 'Fri', 'Sat', 'Sun'];
        $months = ['Jan', 'Feb', 'Mar', 'Apr', ' May', 'Jun', 'Jul', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec'];

        if ($time > strtotime('-2 minutes')) {
            $note_date = 'Just now';
        } elseif ($time > strtotime('-59 minutes')) {
            $min_diff = floor((strtotime('now') - $time) / 60);
            $note_date =  $min_diff . ' min' . (($min_diff != 1) ? "s" : "") . ' ago';
        } elseif ($time > strtotime('-23 hours')) {
            $hour_diff = floor((strtotime('now') - $time) / (60 * 60));
            $note_date =  $hour_diff . ' hour' . (($hour_diff != 1) ? "s" : "") . ' ago';
        } elseif ($time > strtotime('today')) {
            $note_date =  $d->format('G:i');
        } elseif ($time > strtotime('yesterday')) {
            $note_date =  'Yesterday at ' . $d->format('G:i');
        } elseif ($time > strtotime('this week')) {
            $note_date =  $weekDays[$d->format('N') - 1] . ' at ' . $d->format('G:i');
        } else {
            $note_date =  $d->format('j') . ' ' . $months[$d->format('n') - 1] .
                (($d->format('Y') != date("Y")) ? $d->format(' Y') : "") .
                ' at ' . $d->format('G:i');
        }

        return $note_date;
    }
}
