<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_Model extends CI_Model {
   
    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('common_model');        
    }

    /*---------------- check email already exit or not --------------*/
    public function checkEmail($eaddress)
    {
        $select = "select int_glcode from mst_users where chr_delete = 'N' and chr_publish = 'Y' and var_email = '".$eaddress."'";
        $result = $this->db->query($select);
        $count = $result->num_rows();
        if($count > 0){
            return false;
        }else{
            return true;
        }
    } 

    public function checkForgotLink($var_email)
    {
        $select = "select int_glcode from mst_users where chr_delete = 'N' and var_mobile_no = '".$var_email."'";
        $result = $this->db->query($select);
        $data = $result->row_array();

        if (!empty($data)) {
            $get_res = 'mobile_no';
            
        }

        $select1 = "select int_glcode from mst_users where chr_delete = 'N' and var_email = '".$var_email."'";
        $result1 = $this->db->query($select1);
        $data1 = $result1->row_array();
      
        if (!empty($data1)) {
            $get_res = 'email';
            
        }

        if (empty($data) && empty($data1)) {
            $get_res = 'failed_data';
            
        }

        return $get_res;

    }

    /*---------------- check mobile no. already exit or not --------------*/
    public function checkMobile($mobile)
    {
        $select = "select int_glcode from mst_users where chr_delete = 'N' and chr_publish = 'Y' and var_mobile_no = '".$mobile."'";
        $result = $this->db->query($select);
        $count = $result->num_rows();
        if($count > 0){
            return false;
        }else{
            return true;
        }
    }

    public function get_userid($eaddress)
    {
        $select = "select * from mst_users where chr_delete = 'N' and var_email = '".$eaddress."'";
        $result = $this->db->query($select);
        $data = $result->row_array();
        return $data;
    }

    public function get_username_id($mobile)
    {
        $select = "select int_glcode from mst_users where chr_delete = 'N' and var_mobile_no = '".$mobile."'";
        $result = $this->db->query($select);
        $data = $result->row_array();
        return $data['int_glcode'];
    }

    public function get_user_name($var_mobile)
    {
        $select = "select var_name from mst_users where chr_delete = 'N' and var_mobile_no = '".$var_mobile."'";
        $result = $this->db->query($select);
        $data = $result->row_array();
        return $data['var_name'];
    }

    /////////////////////////// update time stamp ////////////////////////////
    public function updateTimeStamp($email)
    {
        $time_stamp = time();
        $this->db->set('dt_timestamp', $time_stamp); 
        $this->db->where('var_email', $email);   
        $this->db->update('mst_users'); 
        //echo $this->db->last_query(); exit();
    }

    /*----------------------- user login API -------------------------*/
    public function user_login($username,$password)
    {
        $this->db->select('*');
        $this->db->from('mst_users');
        $this->db->where('var_mobile_no',$username);
        $this->db->where('var_password', $password);
        $this->db->where('chr_publish','Y');
        $this->db->where('chr_delete','N');
        $query = $this->db->get();

        //echo $this->db->last_query(); exit();
        $row1 = $query->row_array();
if($row1['chr_verify'] == 'Y'){
        $_SESSION['login_user'] = 'user';
        $_SESSION['fk_user'] = $row1['int_glcode'];
        $_SESSION['user_name'] = $row1['var_name'];
        $_SESSION['mobile_no'] = $row1['var_mobile_no'];
        $_SESSION['email'] = $row1['var_email'];
}

            $this->db->select('c.*,p.var_image,p.var_offer,pp.var_discount_price,pp.var_price as price');
            $this->db->from('trn_cart_details c');
            $this->db->join('mst_products p','p.int_glcode = c.fk_product');
            $this->db->join('trn_product_price pp','pp.fk_product = c.fk_product AND pp.var_quantity = c.var_quantity');
            //$this->db->join('trn_product_price pp','pp.var_quantity = c.var_quantity');
            $this->db->where('c.fk_user' , $row1['int_glcode']);

            $query1 = $this->db->get();      
               $count = $query1->num_rows();
         
                if ($count > 0) {

                    $row_arr = $query1->result_array(); 

                    foreach($row_arr as $row){
                        
                        if($row['var_offer'] == '0'){
                            $price = $row["price"];
                            $dis_price = $row["price"];
                        }else{ 
                            $price = $row['price'];
                            $dis_price = $row['price'];
                        }
                        
                        $grand_total = $row["var_unit"] * $price;
            
                        if($row["var_image"] != ''){
                            $img = base_url().'uploads/products/'.$row["var_image"];
                        }else{
                            $img = base_url().'public/assets/img/site_imges/no_image.png';
                        }

                        $itemArray = array(
                            $row['fk_product'].$row["var_quantity"] => array(
                                    'int_glcode' => $row['fk_product'],
                                'vendor_id' => $row['fk_vendor'],
                                'discount' => $row["var_discount_price"],
                                    'image' => $img, 
                                    'price' => $price, 
                                'dis_price' => $dis_price,
                                    'title' => $row["var_name"], 
                                    'quantity' => $row["var_unit"], 
                                    'weigth' => $row["var_quantity"], 
                                'offer' => $row['var_offer'],
                                    'grand_total' => $grand_total
                                )
                            );
                        
                       
                          if (!empty($_SESSION["cart_item"])) {
                              $_SESSION["cart_item"] = $_SESSION["cart_item"] + $itemArray;
                          } else {
                              $_SESSION["cart_item"] = $itemArray;
                          }
            }
    
          }

          //echo "<pre>"; print_r($itemArray); exit();
          
        return $row1;
    }

    public function social_save($fk_user)
    {
        $this->db->select('c.*,p.var_image,p.var_offer,pp.var_discount_price,pp.var_price as price');
        $this->db->from('trn_cart_details c');
        $this->db->join('mst_products p','p.int_glcode = c.fk_product');
        $this->db->join('trn_product_price pp','pp.fk_product = c.fk_product AND pp.var_quantity = c.var_quantity');
        //$this->db->join('trn_product_price pp','pp.var_quantity = c.var_quantity');
        $this->db->where('c.fk_user' , $fk_user);

        $query1 = $this->db->get();      
   
           $count = $query1->num_rows();
     
            if ($count > 0) {
                $row_arr = $query1->result_array(); 

                //echo "<pre>"; print_r($row_arr); exit();
                
                foreach($row_arr as $row){
                    
                    $price = $row['price'];
                    $dis_price = $row['price'];
                    
                    $grand_total = $row["var_unit"] * $price;
        
                    if($row["var_image"] != ''){
                        $img = base_url().'uploads/products/'.$row["var_image"];
                    }else{
                        $img = base_url().'public/assets/img/site_imges/no_image.png';
                    }

                    $itemArray = array(
                        $row['fk_product'].$row["var_quantity"] => array(
                                'int_glcode' => $row['fk_product'],
                                'image' => $img, 
                                'price' => $price, 
                            'dis_price' => $dis_price,
                                'title' => $row["var_name"], 
                                'quantity' => $row["var_unit"], 
                                'weigth' => $row["var_quantity"], 
                            'offer' => $row['var_offer'],
                                'grand_total' => $grand_total
                            )
                        );
                    
                   
                      if (!empty($_SESSION["cart_item"])) {
                          $_SESSION["cart_item"] = $_SESSION["cart_item"] + $itemArray;
                      } else {
                          $_SESSION["cart_item"] = $itemArray;
                      }
            }
    
          }

          return True;
    }

    public function update_shopping_cart()
    {
      $user_id = $_SESSION['fk_user'];
      $delete = array("fk_user" => $user_id);
      $this->db->delete('trn_cart_details' , $delete);
      if (isset($_SESSION["cart_item"])) {
          foreach ($_SESSION["cart_item"] as $key => $value) {
        
            $data = array(
                'fk_product' => $value["int_glcode"],
                'fk_user' => $user_id,
                'fk_vendor' => $value['vendor_id'],
                'var_name' => $value["title"],
                'var_quantity' => $value["weigth"],
                'var_price' => $value["price"],
                'var_discount' => $value["discount"],
                'var_unit' => $value["quantity"],
                'dt_createddate' => date('Y-m-d-h-i-s'),
                'dt_modifydate' => date('Y-m-d-h-i-s'),
                'var_ipaddress' => $_SERVER['REMOTE_ADDR']
            );

            $this->db->insert('trn_cart_details' , $data);
          }
      }
      
    }
    
    /*--------------------------- get users list ------------------------------*/
    public function getProfileDetalis($userId)
    {
        $this->db->select('int_glcode as fk_user,var_mobile_no,chr_verify');
        $this->db->from('mst_users');
        $this->db->where('int_glcode',$userId);
        $this->db->where('chr_delete','N');
        $query = $this->db->get();
        $row = $query->row_array();

        return $row;
    }

    /*--------------------------- get users details ------------------------------*/
    public function getUserDetalis($userId)
    {
        $this->db->select('*');
        $this->db->from('mst_users');
        $this->db->where('int_glcode',$userId);
        $query = $this->db->get();
        $row = $query->row_array();
        //echo $this->db->last_query(); exit();
        return $row;
    }

    /*------------------------ add record ------------------------- */
    public function addRecord()
    {
        //echo "<pre>"; print_r($_POST); exit();
        $fk_user = $this->input->post('fk_user_id');

        if ($fk_user == '') {
            $data = array(
                'var_name' => $this->input->post('var_name'),
                'var_mobile_no' => $this->input->post('phone'),
                'var_default_no' => $this->input->post('phone'),
                'var_email' => $this->input->post('email'),
                'var_password' => $this->mylibrary->cryptPass($this->input->post('password')),
                'var_image' => '',
                'chr_publish' => 'Y',
                'chr_delete' => 'N',
                'dt_createddate' => date('Y-m-d H:i:s'),
                'dt_modifydate' => date('Y-m-d H:i:s'),
                'var_ipaddress' => $_SERVER['REMOTE_ADDR']
            );

            $id = $this->common_model->insertRow($data, "mst_users");

            $this->common_model->send_otp_verification($id,$this->input->post('phone'),'mst_users');

            if ($id != '') {

                $addData = array(
                    'fk_user' => $id,
                    'var_house_no' => $this->input->post('var_house_no'),
                    'var_app_name' => $this->input->post('var_app_name'),
                    'var_landmark' => $this->input->post('var_landmark'),
                    'var_country' => $this->input->post('var_country'),
                    'var_state' => $this->input->post('var_state'),
                    'var_city' => $this->input->post('var_city'),
                    'var_pincode' => $this->input->post('var_pincode'),
                    'chr_type' => 'Home',
                    'default_status' => 'Y',
                    'chr_publish' => 'Y',
                    'chr_delete' => 'N',
                    'dt_createddate' => date('Y-m-d H:i:s'),
                    'dt_modifydate' => date('Y-m-d H:i:s'),
                    'var_ipaddress' => $_SERVER['REMOTE_ADDR']
                );

                $this->common_model->insertRow($addData, "mst_user_address");
            }

            $var_email = $this->input->post('email');
            
            // $this->common_model->send_register_user($this->input->post('var_name'),$var_email,$this->input->post('phone'),'U');
            $user_get_id = $id;
        } else {
            $data = array(
                'var_name' => $this->input->post('var_name'),
                'var_mobile_no' => $this->input->post('phone'),
                'var_default_no' => $this->input->post('phone'),
                'var_email' => $this->input->post('email'),
                'var_password' => $this->mylibrary->cryptPass($this->input->post('password')),
                'var_image' => '',
                'chr_publish' => 'Y',
                'chr_delete' => 'N',
                'dt_createddate' => date('Y-m-d H:i:s'),
                'dt_modifydate' => date('Y-m-d H:i:s'),
                'var_ipaddress' => $_SERVER['REMOTE_ADDR']
            );

            $this->common_model->updateRow('mst_users', $data, array("int_glcode" => $fk_user));

            $this->common_model->send_otp_verification($fk_user,$this->input->post('phone'),'mst_users');

                $updateData = array(
                    'fk_user' => $fk_user,
                    'var_house_no' => $this->input->post('var_house_no'),
                    'var_app_name' => $this->input->post('var_app_name'),
                    'var_landmark' => $this->input->post('var_landmark'),
                    'var_country' => $this->input->post('var_country'),
                    'var_state' => $this->input->post('var_state'),
                    'var_city' => $this->input->post('var_city'),
                    'var_pincode' => $this->input->post('var_pincode'),
                    'chr_type' => 'Home',
                    'default_status' => 'Y',
                    'chr_publish' => 'Y',
                    'chr_delete' => 'N',
                    'dt_createddate' => date('Y-m-d H:i:s'),
                    'dt_modifydate' => date('Y-m-d H:i:s'),
                    'var_ipaddress' => $_SERVER['REMOTE_ADDR']
                );

                $this->common_model->insertRow($updateData, "mst_user_address");
            

            $var_email = $this->input->post('email');
            
            // $this->common_model->send_register_user($this->input->post('var_name'),$var_email,$this->input->post('phone'),'U');
            $user_get_id = $fk_user;
            
        }

        return $user_get_id;
        //echo $this->db->last_query(); exit();
        
    }

    /*------------------------------- get otp --------------------------- */
    public function get_otp($user_id,$var_otp) 
    {
        $this->db->select('int_glcode,var_otp,var_name,var_email,var_mobile_no');
        $this->db->from('mst_users');
        $this->db->where('int_glcode', $user_id);
        $this->db->where('var_otp', $var_otp);
        $result = $this->db->get(); 
        $row = $result->row_array();
        //echo "<pre>"; print_r($row); exit();
        if ($var_otp == $row['var_otp']) {
            $data = array(
                'chr_verify' => 'Y'
            );

            $this->db->where('int_glcode', $user_id);
            $this->db->update('mst_users', $data);

            $_SESSION['login_user'] = 'user';
            $_SESSION['fk_user'] = $row['int_glcode'];
            $_SESSION['user_name'] = $row['var_name'];
            $_SESSION['mobile_no'] = $row['var_mobile_no'];
            $_SESSION['email'] = $row['var_email'];
            
            $this->db->select('c.*,p.var_image,p.var_offer,pp.var_discount_price,pp.var_price as price');
            $this->db->from('trn_cart_details c');
            $this->db->join('mst_products p','p.int_glcode = c.fk_product');
            $this->db->join('trn_product_price pp','pp.fk_product = c.fk_product AND pp.var_quantity = c.var_quantity');
            //$this->db->join('trn_product_price pp','pp.var_quantity = c.var_quantity');
            $this->db->where('c.fk_user' , $row['int_glcode']);

            $query1 = $this->db->get();      
               $count = $query1->num_rows();
         
                if ($count > 0) {

                    $row_arr = $query1->result_array(); 

                    foreach($row_arr as $row){
                        
                        if($row['var_offer'] == '0'){
                            $price = $row["price"];
                            $dis_price = $row["price"];
                        }else{ 
                            $price = $row['price'];
                            $dis_price = $row['price'];
                        }
                        
                        $grand_total = $row["var_unit"] * $price;
            
                        if($row["var_image"] != ''){
                            $img = base_url().'uploads/products/'.$row["var_image"];
                        }else{
                            $img = base_url().'public/assets/img/site_imges/no_image.png';
                        }

                        $itemArray = array(
                            $row['fk_product'].$row["var_quantity"] => array(
                                    'int_glcode' => $row['fk_product'],
                                'vendor_id' => $row['fk_vendor'],
                                'discount' => $row["var_discount_price"],
                                    'image' => $img, 
                                    'price' => $price, 
                                'dis_price' => $dis_price,
                                    'title' => $row["var_name"], 
                                    'quantity' => $row["var_unit"], 
                                    'weigth' => $row["var_quantity"], 
                                'offer' => $row['var_offer'],
                                    'grand_total' => $grand_total
                                )
                            );
                        
                       
                          if (!empty($_SESSION["cart_item"])) {
                              $_SESSION["cart_item"] = $_SESSION["cart_item"] + $itemArray;
                          } else {
                              $_SESSION["cart_item"] = $itemArray;
                          }
            }
    
          }
          
            //$this->common_model->send_register_user($row['var_name'],$row['var_email'],$row['var_mobile_no'],'U');

            //$this->common_model->send_register_admin($row['var_name'],$row['var_email'],$row['var_mobile_no']);

        }

        return $row['int_glcode'];  

    }

}