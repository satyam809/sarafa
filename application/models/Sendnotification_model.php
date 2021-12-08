<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Sendnotification_model extends CI_Model 
{
    /*-----------------------delivery boy get notification --------------------- */
//    public function block_unblock_notification($var_deviceid,$chr_flag) 
//    {
//        if ($chr_flag == 'U') {
//            $chr_type = 'Unblock';
//            $message = "You are ".$chr_flag." From Your Vendor !";
//        } else {
//            $chr_type = 'Block';
//            $message = "You are ".$chr_flag." From Your Vendor , Please contact your Vendor or Admin !";
//        }
//
//        $url = 'https://fcm.googleapis.com/fcm/send';
//
//        $target = $var_deviceid;
//
//        $data['type'] = 'block_unblock';
//
//        $data['message'] = $message;
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
//        return TRUE;  
//
//    }
//
//    /*----------------------- assign order send user notification --------------------- */
//    public function assign_notification_user($user,$device_token,$delivery_boy) 
//    {
//        $message = "Dear ".$user.", Your order has been assigned  to ".$delivery_boy."";
//        
//        $url = 'https://fcm.googleapis.com/fcm/send';
//
//        $target = $device_token;
//
//        $data['type'] = 'Assign Order';
//
//        $data['message'] = $message;
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
//        return TRUE;  
//
//    }
//
//    /*----------------------- complete order notification --------------------- */
//    public function complete_order_notification($vendor,$device_token) 
//    {
//        $message = "Dear ".$vendor.", Your Order has been successfully Completed !";
//        
//        $url = 'https://fcm.googleapis.com/fcm/send';
//
//        $target = $device_token;
//
//        $data['type'] = 'Complete Order';
//
//        $data['message'] = $message;
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
//        return TRUE;  
//
//    }
//
//    /*----------------------- complete order notification --------------------- */
//    public function complete_order_user($name,$orderId,$device_token) 
//    {
//        $message = "Dear ".$name.", Your Order has been delivered successfully (Order ID: ".$orderId.")";
//        
//        $url = 'https://fcm.googleapis.com/fcm/send';
//
//        $target = $device_token;
//
//        $data['type'] = 'Complete Order';
//
//        $data['message'] = $message;
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
//        return TRUE;  
//
//    }
//
//    /*----------------------- update order notification vendor --------------------- */
//    public function update_order_venor($name,$orderId,$device_token) 
//    {
//        $message = "Dear ".$name.", Order updated by user , please check order (Order ID: ".$orderId.")";
//        
//        $url = 'https://fcm.googleapis.com/fcm/send';
//
//        $target = $device_token;
//
//        $data['type'] = 'Update Order';
//
//        $data['message'] = $message;
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
//        return TRUE;  
//
//    }
//
//    /*------------------------------ assigned order user --------------------------------*/
//    public function assigned_user_sms($name,$delivery_boy,$var_mobile) 
//    {
//        $message = 'Dear '.$name.', Your order has been assigned to '.$delivery_boy.'';
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
//    /*------------------------------ update order user --------------------------------*/
//    public function update_user_sms($name,$delivery_boy,$var_mobile) 
//    {
//        $message = 'Dear '.$name.', Order updated by user, please check your order list '.$delivery_boy.'';
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

    public function order_request_notification($id,$order_id,$device_token,$flag,$msg) 
    {
   
        $url = 'https://fcm.googleapis.com/fcm/send';

        $target = $device_token;

        $data['message'] = $msg;
        $data['flag'] = $flag;
        $data['order_id'] = $id;
        $data['order_num'] = $order_id;

        $fields = array();

        $fields['data'] = $data;

        if (is_array($target)) {
            $fields['registration_ids'] = $target;
        } else {
            $fields['to'] = $target;
        }

        $headers = array(
            'Content-Type:application/json',
            'Authorization:key=' . NOTIFICATION_KEY
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
       // print_r($result);
        curl_close($ch);

        return TRUE;  

    }
    
}