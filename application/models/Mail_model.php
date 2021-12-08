<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mail_model extends CI_Model 
{

    public function send_register_user($name,$email,$phone,$flag )
    {

        if ($flag == 'A') {
            $message = 'This is to inform you that, Your account with Admin has been created successfully. Log it for more details.';
        } else {
            $message = 'This is to inform you that, your registration has been done successfully. Log in and start Shopping.';
        }

        //SMTP & mail configuration
        $this->load->library('smtpemail');
        $config = $this->smtpemail->globalEmail();
        $this->email->initialize($config);
        $this->email->set_mailtype("html");
        $this->email->set_newline("\r\n");

        //Email content

        $img_path = base_url();
        $htmlContent = file_get_contents('public/templates/registration.php');
        $htmlContent = str_replace("@MESSAGE", $message, $htmlContent);
        $htmlContent = str_replace("@IMG_LOGO", $img_path, $htmlContent);
        $htmlContent = str_replace("@NAME", $name, $htmlContent);
        $htmlContent = str_replace("@EMAIL", $email, $htmlContent);
        $htmlContent = str_replace("@MOBILENO", $phone, $htmlContent);
        $this->email->to($email);
        $this->email->from(FROM_EMAIL,'Vruits');
        $this->email->subject('Registration');
        $this->email->message($htmlContent);

        //Send email

        $this->email->send();

    }

    public function send_register_admin($name,$email,$phone)
    {
        //SMTP & mail configuration
        $this->load->library('smtpemail');
        $config = $this->smtpemail->globalEmail();
        $this->email->initialize($config);
        $this->email->set_mailtype("html");
        $this->email->set_newline("\r\n");

        //Email content

        $img_path = base_url();
        $htmlContent = file_get_contents('public/templates/admin_registration.php');
        $htmlContent = str_replace("@IMG_LOGO", $img_path, $htmlContent);
        $htmlContent = str_replace("@NAME", $name, $htmlContent);
        $htmlContent = str_replace("@EMAIL", $email, $htmlContent);
        $htmlContent = str_replace("@MOBILENO", $phone, $htmlContent);

        $this->email->to(ADMIN_EMAIL);
        $this->email->from($email,'Vruits');
        $this->email->subject('Registration');
        $this->email->message($htmlContent);

        //Send email
        $this->email->send();
    }

    /*----------------------------- user order --------------------------------- */
    public function user_order_email($name,$email,$productArr,$total_amt,$discount,$delivery_charges,$payable_amt,$add_Date,$orderId,$user_address)
    {
        $product_arr = json_decode($productArr);
        //echo "<pre>"; print_r($product_arr); exit();
        $set_data = '';
        $i = 1;

        foreach ($product_arr as $key => $value) {
            $sr_no = $i++;
            $set_data .= '
        <tr style="background-color:#ffffff;font-size:11px;font-family:arial;color:#6c6c6c;line-height:18px">
         <td style="text-align:center;padding:3px 0 3px 3px">'.$sr_no.'</td>
         <td style="width:240px;padding:3px 0 3px 3px" class="">
            <label style="line-height:18px">
            <a style="text-decoration:none" href="javascript:;">'.$value->var_name.' </a>
            </label>
         </td>
         <td style="width:20px">&nbsp;</td>
         <td style="text-align:center;padding:3px 0 3px 3px;width:30px">
            <label>'.$value->var_quantity.'</label>
         </td>
         <td style="text-align:center;width:70px;padding:3px 0 3px 3px">
            <label>'.$value->var_unit.'</label>
         </td>
         <td style="text-align:center;padding:3px 0 3px 3px;width:70px">
            <label>Rs. '.$value->var_price.'</label>
         </td>
        </tr>';

        } 
        //echo $set_data; exit();
        //SMTP & mail configuration
        $this->load->library('smtpemail');
        $config = $this->smtpemail->globalEmail();
        $config['charset'] = 'utf-8';
        $this->email->initialize($config);
        $this->email->set_mailtype("html");
        // $this->email->set_header("MIME-Version', '1.0; charset=utf-8");
        // $this->email->set_header('Content-type', 'text/html');
        $this->email->set_newline("\r\n");

        //Email content

        $img_path = base_url();    
        $htmlContent = file_get_contents('public/templates/user_order.php');
        $htmlContent = str_replace("@IMG_LOGO", $img_path, $htmlContent);
        $htmlContent = str_replace("@NAME", $name, $htmlContent);
        $htmlContent = str_replace("@ADDRESS", $user_address, $htmlContent);
        $htmlContent = str_replace("@PRODUCT_ARR", $set_data, $htmlContent);
        $htmlContent = str_replace("@TOTAL_AMT", $total_amt, $htmlContent);
        $htmlContent = str_replace("@DISCOUNT", $discount, $htmlContent);
        $htmlContent = str_replace("@DELIVERY_CHARGE", $delivery_charges, $htmlContent);
        $htmlContent = str_replace("@PAYABLE_AMT", $payable_amt, $htmlContent);
        $htmlContent = str_replace("@ADDDATE", $add_Date, $htmlContent);
        $htmlContent = str_replace("@ORDNO", $orderId, $htmlContent);
        //echo $htmlContent; exit();

        $this->email->to($email);
        $this->email->from(FROM_EMAIL,'Vruits');
        $this->email->subject('Your vruits order confirmation ( '.$orderId.' )');
        $this->email->message($htmlContent);
        //Send email
        $this->email->send();

    }


    /*----------------------------- user order --------------------------------- */
    public function user_order_cancel($name,$email,$productArr,$total_amt,$discount_amt,$delivery_charge,$payable_amt,$add_Date,$orderId)
    {
        $product_arr = json_decode($productArr);
        //echo "<pre>"; print_r($product_arr); exit();
        $set_data = '';
        $i = 1;

        foreach ($product_arr as $key => $value) {
            $sr_no = $i++;
            $set_data .= '
              <tr style="background-color:#ffffff;font-size:11px;font-family:arial;color:#6c6c6c;line-height:18px">
                 <td style="text-align:center;padding:3px 0 3px 3px">
                    '.$sr_no.'
                 </td>
                 <td style="width:240px;padding:3px 0 3px 3px" class="">
                    <label style="line-height:18px">
                    <a style="text-decoration:none" href="javascript:;">'.$value->var_name.' </a>
                    </label>
                 </td>
                 <td style="width:20px">&nbsp;</td>
                 <td style="text-align:center;padding:3px 0 3px 3px;width:30px">
                    <label>'.$value->var_quantity.'</label>
                 </td>
                 <td style="text-align:center;width:70px;padding:3px 0 3px 3px">
                    <label>'.$value->var_unit.'</label>
                 </td>
                 <td style="text-align:center;padding:3px 0 3px 3px;width:70px">
                    <label>Rs. '.$value->var_price.'</label>
                 </td>
              </tr>';
        } 

        //echo $set_data; exit();
        //SMTP & mail configuration
        $this->load->library('smtpemail');
        $config = $this->smtpemail->globalEmail();
        $config['charset'] = 'utf-8';
        $this->email->initialize($config);
        $this->email->set_mailtype("html");
        $this->email->set_newline("\r\n");

        //Email content
        $img_path = base_url();    
        $htmlContent = file_get_contents('public/templates/cancel_user_order.php');
        $htmlContent = str_replace("@IMG_LOGO", $img_path, $htmlContent);
        $htmlContent = str_replace("@NAME", $name, $htmlContent);
        $htmlContent = str_replace("@PRODUCT_ARR", $set_data, $htmlContent);
        $htmlContent = str_replace("@TOTAL_AMT", $total_amt, $htmlContent);
        $htmlContent = str_replace("@DISCOUNT", $discount_amt, $htmlContent);
        $htmlContent = str_replace("@DELIVERY_CHARGE", $delivery_charge, $htmlContent);
        $htmlContent = str_replace("@PAYABLE_AMT", $payable_amt, $htmlContent);
        $htmlContent = str_replace("@ADDDATE", $add_Date, $htmlContent);
        $htmlContent = str_replace("@ORDNO", $orderId, $htmlContent);

        //echo $htmlContent; exit();
        $this->email->to($email);
        $this->email->from(FROM_EMAIL,'Vruits');
        $this->email->subject('Cancellation of your Order No:'.$orderId.' at Vruits');
        $this->email->message($htmlContent);

        //Send email
        $this->email->send();

    }

    /*----------------------------- user order --------------------------------- */
    public function user_order_complete($name,$email,$productArr,$total_amt,$discount,$delivery_charges,$payable_amt,$add_Date,$orderId,$user_address)
    {
        $product_arr = json_decode($productArr);

        $add_Date = date('d/m/Y',strtotime($add_Date));

        $set_data = '';
        $i = 1;

        foreach ($product_arr as $key => $value) {
            $sr_no = $i++;
            $set_data .= '
                <tr style="background-color:#ffffff;font-size:11px;font-family:arial;color:#6c6c6c;line-height:18px">
                 <td style="text-align:center;padding:3px 0 3px 3px">'.$sr_no.'</td>
                 <td style="width:240px;padding:3px 0 3px 3px" class="">
                    <label style="line-height:18px">
                    <a style="text-decoration:none" href="javascript:;">'.$value->var_name.' </a>
                    </label>
                 </td>
                 <td style="width:20px">&nbsp;</td>
                 <td style="text-align:center;padding:3px 0 3px 3px;width:30px">
                    <label>'.$value->var_quantity.'</label>
                 </td>
                 <td style="text-align:center;width:70px;padding:3px 0 3px 3px">
                    <label>'.$value->var_unit.'</label>
                 </td>
                 <td style="text-align:center;padding:3px 0 3px 3px;width:70px">
                    <label>Rs. '.$value->var_price.'</label>
                 </td>
                </tr>';
        } 
        //echo $set_data; exit();
        //SMTP & mail configuration
        $this->load->library('smtpemail');
        $config = $this->smtpemail->globalEmail();
        $config['charset'] = 'utf-8';
        $this->email->initialize($config);
        $this->email->set_mailtype("html");
        $this->email->set_newline("\r\n");

        //Email content

        $img_path = base_url();    
        $htmlContent = file_get_contents('public/templates/order_complete.php');
        $htmlContent = str_replace("@IMG_LOGO", $img_path, $htmlContent);
        $htmlContent = str_replace("@NAME", $name, $htmlContent);
        $htmlContent = str_replace("@ADDRESS", $user_address, $htmlContent);
        $htmlContent = str_replace("@PRODUCT_ARR", $set_data, $htmlContent);
        $htmlContent = str_replace("@TOTAL_AMT", $total_amt, $htmlContent);
        $htmlContent = str_replace("@DISCOUNT", $discount, $htmlContent);
        $htmlContent = str_replace("@DELIVERY_CHARGE", $delivery_charges, $htmlContent);
        $htmlContent = str_replace("@PAYABLE_AMT", $payable_amt, $htmlContent);
        $htmlContent = str_replace("@ADDDATE", $add_Date, $htmlContent);
        $htmlContent = str_replace("@ORDNO", $orderId, $htmlContent);
        //echo $htmlContent; exit();

        $this->email->to($email);
        $this->email->from(FROM_EMAIL,'Vruits');
        $this->email->subject('Your Vruits Order has been delivered successfully ( '.$orderId.' )');
        $this->email->message($htmlContent);
        //Send email
        $this->email->send();

    }

    /*----------------------------- user update order --------------------------------- */
    public function user_update_order($name,$email,$productArr,$total_amt,$discount,$delivery_charges,$payable_amt,$add_Date,$orderId,$user_address)
    {
        $product_arr = json_decode($productArr);

        $add_Date = date('d/m/Y',strtotime($add_Date));

        $set_data = '';
        $i = 1;

        foreach ($product_arr as $key => $value) {
            if ($value->cancel_status == 'N') {
                $sr_no = $i++;
                $set_data .= '
                <tr style="background-color:#ffffff;font-size:11px;font-family:arial;color:#6c6c6c;line-height:18px">
                 <td style="text-align:center;padding:3px 0 3px 3px">'.$sr_no.'</td>
                 <td style="width:240px;padding:3px 0 3px 3px" class="">
                    <label style="line-height:18px">
                    <a style="text-decoration:none" href="javascript:;">'.$value->var_name.' </a>
                    </label>
                 </td>
                 <td style="width:20px">&nbsp;</td>
                 <td style="text-align:center;padding:3px 0 3px 3px;width:30px">
                    <label>'.$value->var_quantity.'</label>
                 </td>
                 <td style="text-align:center;width:70px;padding:3px 0 3px 3px">
                    <label>'.$value->var_unit.'</label>
                 </td>
                 <td style="text-align:center;padding:3px 0 3px 3px;width:70px">
                    <label>Rs. '.$value->var_price.'</label>
                 </td>
                </tr>';
            }
        } 
        //echo $set_data; exit();
        //SMTP & mail configuration
        $this->load->library('smtpemail');
        $config = $this->smtpemail->globalEmail();
        $config['charset'] = 'utf-8';
        $this->email->initialize($config);
        $this->email->set_mailtype("html");
        $this->email->set_newline("\r\n");

        //Email content

        $img_path = base_url();    
        $htmlContent = file_get_contents('public/templates/order_update.php');
        $htmlContent = str_replace("@IMG_LOGO", $img_path, $htmlContent);
        $htmlContent = str_replace("@NAME", $name, $htmlContent);
        $htmlContent = str_replace("@ADDRESS", $user_address, $htmlContent);
        $htmlContent = str_replace("@PRODUCT_ARR", $set_data, $htmlContent);
        $htmlContent = str_replace("@TOTAL_AMT", $total_amt, $htmlContent);
        $htmlContent = str_replace("@DISCOUNT", $discount, $htmlContent);
        $htmlContent = str_replace("@DELIVERY_CHARGE", $delivery_charges, $htmlContent);
        $htmlContent = str_replace("@PAYABLE_AMT", $payable_amt, $htmlContent);
        $htmlContent = str_replace("@ADDDATE", $add_Date, $htmlContent);
        $htmlContent = str_replace("@ORDNO", $orderId, $htmlContent);
        //echo $htmlContent; exit();

        $this->email->to($email);
        $this->email->from(FROM_EMAIL,'Vruits');
        $this->email->subject('Your Vruits Order has been modified successfully ( '.$orderId.' )');
        $this->email->message($htmlContent);
        //Send email
        $this->email->send();

    }

    /*----------------------------- user order --------------------------------- */
    public function contact_update($name,$email,$mobileNo)
    {
        //SMTP & mail configuration
        $this->load->library('smtpemail');
        $config = $this->smtpemail->globalEmail();
        $this->email->initialize($config);
        $this->email->set_mailtype("html");
        $this->email->set_newline("\r\n");

        //Email content
        $img_path = base_url();    
        $htmlContent = file_get_contents('public/templates/contact_update.php');
        $htmlContent = str_replace("@IMG_LOGO", $img_path, $htmlContent);
        $htmlContent = str_replace("@NAME", $name, $htmlContent);
        $htmlContent = str_replace("@MOBILENO", $mobileNo, $htmlContent);
        //echo $htmlContent; exit();

        $this->email->to($email);
        $this->email->from(FROM_EMAIL,'Vruits');
        $this->email->subject('Vruits - Contact number successfully updated');
        $this->email->message($htmlContent);
        //Send email
        $this->email->send();

    }

    /*----------------------------- user order --------------------------------- */
    public function user_transaction_wallet($email,$name,$mobileNo,$date,$orderId,$update_amt,$balance_amt,$mail_type)
    {
        if ($mail_type == 'C') {
            $money_msg = 'Money Added Successfully';
        } else {
            $money_msg = 'Money Paid Successfully';
        }

        $this->load->library('smtpemail');
        $config = $this->smtpemail->globalEmail();
        $this->email->initialize($config);
        $this->email->set_mailtype("html");
        $this->email->set_newline("\r\n");

        //Email content
        $img_path = base_url();    
        $htmlContent = file_get_contents('public/templates/debit_order.php');
        $htmlContent = str_replace("@IMG_LOGO", $img_path, $htmlContent);
        $htmlContent = str_replace("@NAME", $name, $htmlContent);
        $htmlContent = str_replace("@MONEY_MSG", $money_msg, $htmlContent);
        $htmlContent = str_replace("@MOBILE_NO", $mobileNo, $htmlContent);
        $htmlContent = str_replace("@DATE", $date, $htmlContent);
        $htmlContent = str_replace("@ORDERID", $orderId, $htmlContent);
        $htmlContent = str_replace("@UPDATE_BALANCE", $update_amt, $htmlContent);
        $htmlContent = str_replace("@BALANCE", $balance_amt, $htmlContent);

        //echo $htmlContent; exit();
        $this->email->to($email);
        $this->email->from(FROM_EMAIL,'Vruits');
        $this->email->subject('Your Transaction Has Been Successfull On Vruits.');
        $this->email->message($htmlContent);

        //Send email
        $this->email->send();

    }

    /*----------------------------- user cashback --------------------------------- */
    public function user_cashback($email,$name,$mobileNo,$date,$orderId,$update_amt,$balance_amt)
    {
        $this->load->library('smtpemail');
        $config = $this->smtpemail->globalEmail();
        $this->email->initialize($config);
        $this->email->set_mailtype("html");
        $this->email->set_newline("\r\n");

        //Email content
        $img_path = base_url();    
        $htmlContent = file_get_contents('public/templates/user_cashback.php');
        $htmlContent = str_replace("@IMG_LOGO", $img_path, $htmlContent);
        $htmlContent = str_replace("@NAME", $name, $htmlContent);
        $htmlContent = str_replace("@MOBILE_NO", $mobileNo, $htmlContent);
        $htmlContent = str_replace("@DATE", $date, $htmlContent);
        $htmlContent = str_replace("@ORDERID", $orderId, $htmlContent);
        $htmlContent = str_replace("@UPDATE_BALANCE", $update_amt, $htmlContent);
        $htmlContent = str_replace("@BALANCE", $balance_amt, $htmlContent);

        //echo $htmlContent; exit();
        $this->email->to($email);
        $this->email->from(FROM_EMAIL,'Vruits');
        $this->email->subject('Cashback Added.');
        $this->email->message($htmlContent);

        //Send email
        $this->email->send();

    }

    /*----------------------------- user assigned order --------------------------------- */
    public function assign_order_user($email,$name,$dboy_name)
    {
        $this->load->library('smtpemail');
        $config = $this->smtpemail->globalEmail();
        $this->email->initialize($config);
        $this->email->set_mailtype("html");
        $this->email->set_newline("\r\n");

        //Email content
        $img_path = base_url();    
        $htmlContent = file_get_contents('public/templates/assigned_order.php');
        $htmlContent = str_replace("@IMG_LOGO", $img_path, $htmlContent);
        $htmlContent = str_replace("@NAME", $name, $htmlContent);
        $htmlContent = str_replace("@DELIVERY_BOY", $dboy_name, $htmlContent);

        //echo $htmlContent; exit();
        $this->email->to($email);
        $this->email->from(FROM_EMAIL,'Vruits');
        $this->email->subject('Assigned Order');
        $this->email->message($htmlContent);

        //Send email
        $this->email->send();

    }

}