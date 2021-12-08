<?php

defined("BASEPATH") or exit("No direct script access allowed");

class User_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();

        $this->load->database();

        $this->load->model("common_model");
    }


    /*------------------------------ add user ---------------------------- */

    public function addCustomer()
    {
        //$refferal_code = $this->common_model->generateRandomString1(8);
        $data = [
            "regAs" => "Customer",
            "fname" => $this->input->post("fname"),
            "lname" => $this->input->post("lname"),
            "var_email" => $this->input->post("var_email"),
            "var_mobile_no" => $this->input->post("var_mobile_no"),
            "var_alt_mobile" => $this->input->post("var_alt_mobile"),
            "var_password" => $this->mylibrary->cryptPass(
                $this->input->post("var_password")
            ),
            "address" => $this->input->post("address"),
            "var_state" => $this->input->post("var_state"),
            "var_city" => $this->input->post("var_city"),
            //'var_device_token' => $this->input->post('var_device_token'),
            "var_otp" => "1234",
            "chr_publish" => "Y",
            "chr_delete" => "N",
            "dt_createddate" => date("Y-m-d H:i:s"),
            "dt_modifydate" => date("Y-m-d H:i:s"),
        ];

        $id = $this->common_model->insertRow($data, "mst_users");
        if ($id != "") {
            return $id;
        } else {
            return false;
        }
    }
    
    public function editCustomer($userId)
    {
        //$refferal_code = $this->common_model->generateRandomString1(8);
        $data = array(
            "regAs" => "Customer",
            "fname" => $this->input->post("fname"),
            "lname" => $this->input->post("lname"),
            "var_email" => $this->input->post("var_email"),
            "var_alt_mobile" => $this->input->post("var_alt_mobile"),
            "address" => $this->input->post("address"),
            "var_state" => $this->input->post("var_state"),
            "var_city" => $this->input->post("var_city"),
            "dt_modifydate" => date("Y-m-d H:i:s"),
        );
        
         $this->common_model->updateRow('mst_users', $data, array("int_glcode" => $userId));
        
            return $data;
     
    }
    public function addBusiness()
    {
        //$refferal_code = $this->common_model->generateRandomString1(8);
        if (isset($_FILES["var_image"])) {
            if (!is_dir("uploads/user")) {
                mkdir("uploads/user", 0777, true);
            }

            $filename = time() . "_" . $_FILES["var_image"]["name"];

            $filename = str_replace("&", "_", $filename);

            $filename = preg_replace(
                '/[^a-zA-Z0-9\[\]\.(\)&-\']/s',
                "",
                $filename
            );

            $destination = "uploads/user/";

            move_uploaded_file(
                $_FILES["var_image"]["tmp_name"],
                $destination . $filename
            );
        } else {
            $filename = "";
        }
        if (isset($_FILES["c_logo"])) {
            if (!is_dir("uploads/user")) {
                mkdir("uploads/user", 0777, true);
            }

            $c_logo = time() . "_" . $_FILES["c_logo"]["name"];

            $c_logo = str_replace("&", "_", $c_logo);

            $c_logo = preg_replace(
                '/[^a-zA-Z0-9\[\]\.(\)&-\']/s',
                "",
                $c_logo
            );

            $destination = "uploads/user/";

            move_uploaded_file(
                $_FILES["c_logo"]["tmp_name"],
                $destination . $c_logo
            );
        } else {
            $c_logo = "";
        }
        if (isset($_FILES["p_images"])) {
            if (!is_dir("uploads/userProduct")) {
                mkdir("uploads/userProduct", 0777, true);
            }
            $count = count($_FILES['p_images']['name']);
            $p_images = "";
            for ($i = 0; $i < $count; $i++) {
                $p_image = time() . "_" . $_FILES["p_images"]["name"][$i];

                $p_image = str_replace("&", "_", $p_image);

                $p_image = preg_replace(
                    '/[^a-zA-Z0-9\[\]\.(\)&-\']/s',
                    "",
                    $p_image
                );

                $destination = "uploads/userProduct/";
                //echo $p_image;
                if (move_uploaded_file(
                    $_FILES["p_images"]["tmp_name"][$i],
                    $destination . $p_image
                )) {
                    $p_images .= $p_image . ",";
                }

                //die;
            }
            //die;
        } else {
            $p_images = "";
        }
        
        if (isset($_FILES["image_offer"])) {
            if (!is_dir("uploads/offer")) {
                mkdir("uploads/offer", 0777, true);
            }

            $image_offer = time() . "_" . $_FILES["image_offer"]["name"];

            $image_offer = str_replace("&", "_", $image_offer);

            $image_offer = preg_replace(
                '/[^a-zA-Z0-9\[\]\.(\)&-\']/s',
                "",
                $image_offer
            );

            $dest = "uploads/offer/";

            move_uploaded_file(
                $_FILES["image_offer"]["tmp_name"],
                $dest . $image_offer
            );
        } else {
            $image_offer = "";
        }
        
        // if($_FILES['image_offer']['name'] != '')
        // {
        //     if (!is_dir('uploads/offer')) {
        //         mkdir('uploads/offer', 0777, TRUE);
        //     }
        //         $image_offer = time().'_'.$_FILES['image_offer']['name'];
        //         $image_offer = str_replace('&', "_", $image_offer);
        //         $image_offer = preg_replace('/[^a-zA-Z0-9\[\]\.(\)&-\']/s', '', $image_offer);
        //         $destination = 'uploads/offer/';
        //         move_uploaded_file($_FILES['image_offer']['tmp_name'],$destination.$image_offer);

        //         if (!is_dir('uploads/offer/thumb_img')) {
        //             mkdir('uploads/offer/thumb_img', 0777, TRUE);
        //         }

        //             $config['image_library'] = 'gd2';
        //             $config['source_image'] = $destination.$image_offer;
        //             $config['new_image'] =  'uploads/offer/thumb_img/'.$image_offer;
        //             $config['create_thumb'] = FALSE;
        //             $config['maintain_ratio'] = TRUE;
        //             $config['width']     = 100;
        //             $config['height']   = 100;

        //             $this->image_lib->clear();
        //             $this->image_lib->initialize($config);
        //             $this->image_lib->resize();
        //     } else {
        //         $image_offer =  '';
        //     }
            
            if($_POST['text_offer'] != ""){
                $text_offer = $_POST['text_offer'];
            }else{
                $text_offer = "";
            }
            
        $data = array(
            "regAs" => "Business",
            "fname" => $this->input->post("fname"),
            "lname" => $this->input->post("lname"),
            "var_email" => $this->input->post("var_email"),
            "var_mobile_no" => $this->input->post("var_mobile_no"),
            "var_alt_mobile" => $this->input->post("var_alt_mobile"),
            "var_password" => $this->mylibrary->cryptPass(
                $this->input->post("var_password")
            ),
            "address" => $this->input->post("address"),
            "var_state" => $this->input->post("var_state"),
            "var_city" => $this->input->post("var_city"),
            "catAs" => $this->input->post("catAs"),
            "company" => $this->input->post("company"),
            "businessCat" => $this->input->post("businessCat"),
            'var_device_token' => $this->input->post('var_device_token'),
            "var_otp" => "1234",
            "var_image" => $filename,
            "c_logo" => $c_logo,
            "gistin" => $this->input->post('gistin'),
            "bisno" => $this->input->post('bisno'),
            "message" => $this->input->post('message'),
            "offers" => $text_offer,
            "image_offer" => $image_offer,
            "p_desc" => $this->input->post('p_desc'),
            "p_images" => $p_images,
            "chr_publish" => "Y",
            "chr_delete" => "N",
            "dt_createddate" => date("Y-m-d H:i:s"),
            "dt_modifydate" => date("Y-m-d H:i:s"),
        );
        // print_r($data);
        // die;
        $id = $this->common_model->insertRow($data, "mst_users");
        if ($id != "") {
            return $id;
        } else {
            return false;
        }
    }
    public function addSarafa()
    {
        //$refferal_code = $this->common_model->generateRandomString1(8);
        if (isset($_FILES["var_image"])) {
            if (!is_dir("uploads/user")) {
                mkdir("uploads/user", 0777, true);
            }

            $filename = time() . "_" . $_FILES["var_image"]["name"];

            $filename = str_replace("&", "_", $filename);

            $filename = preg_replace(
                '/[^a-zA-Z0-9\[\]\.(\)&-\']/s',
                "",
                $filename
            );

            $destination = "uploads/user/";

            move_uploaded_file(
                $_FILES["var_image"]["tmp_name"],
                $destination . $filename
            );
        } else {
            $filename = "";
        }
        if (isset($_FILES["c_logo"])) {
            if (!is_dir("uploads/user")) {
                mkdir("uploads/user", 0777, true);
            }

            $c_logo = time() . "_" . $_FILES["c_logo"]["name"];

            $c_logo = str_replace("&", "_", $c_logo);

            $c_logo = preg_replace(
                '/[^a-zA-Z0-9\[\]\.(\)&-\']/s',
                "",
                $c_logo
            );

            $destination = "uploads/user/";

            move_uploaded_file(
                $_FILES["c_logo"]["tmp_name"],
                $destination . $c_logo
            );
        } else {
            $c_logo = "";
        }
        if (isset($_FILES["p_images"])) {
            if (!is_dir("uploads/userProduct")) {
                mkdir("uploads/userProduct", 0777, true);
            }
            $count = count($_FILES['p_images']['name']);
            $p_images = "";
            for ($i = 0; $i < $count; $i++) {
                $p_image = time() . "_" . $_FILES["p_images"]["name"][$i];

                $p_image = str_replace("&", "_", $p_image);

                $p_image = preg_replace(
                    '/[^a-zA-Z0-9\[\]\.(\)&-\']/s',
                    "",
                    $p_image
                );

                $destination = "uploads/userProduct/";
                //echo $p_image;
                if (move_uploaded_file(
                    $_FILES["p_images"]["tmp_name"][$i],
                    $destination . $p_image
                )) {
                    $p_images .= $p_image . ",";
                }

                //die;
            }
            //die;
        } else {
            $p_images = "";
        }
        
        if (isset($_FILES["image_offer"])) {
            if (!is_dir("uploads/offer")) {
                mkdir("uploads/offer", 0777, true);
            }

            $image_offer = time() . "_" . $_FILES["image_offer"]["name"];

            $image_offer = str_replace("&", "_", $image_offer);

            $image_offer = preg_replace(
                '/[^a-zA-Z0-9\[\]\.(\)&-\']/s',
                "",
                $image_offer
            );

            $dest = "uploads/offer/";

            move_uploaded_file(
                $_FILES["image_offer"]["tmp_name"],
                $dest . $image_offer
            );
        } else {
            $image_offer = "";
        }
            
            if($_POST['text_offer'] != ""){
                $text_offer = $_POST['text_offer'];
            }else{
                $text_offer = "";
            }
            
        $data = array(
            "regAs" => "Sarafa Association",
            "fname" => $this->input->post("fname"),
            "lname" => $this->input->post("lname"),
            "var_email" => $this->input->post("var_email"),
            "var_mobile_no" => $this->input->post("var_mobile_no"),
            "var_alt_mobile" => $this->input->post("var_alt_mobile"),
            "var_password" => $this->mylibrary->cryptPass(
                $this->input->post("var_password")
            ),
            "address" => $this->input->post("address"),
            "var_state" => $this->input->post("var_state"),
            "var_city" => $this->input->post("var_city"),
            "catAs" => $this->input->post("catAs"),
            "company" => $this->input->post("company"),
            "businessCat" => $this->input->post("businessCat"),
            'var_device_token' => $this->input->post('var_device_token'),
            "var_otp" => "1234",
            "var_image" => $filename,
            "c_logo" => $c_logo,
            "gistin" => $this->input->post('gistin'),
            "bisno" => $this->input->post('bisno'),
            "message" => $this->input->post('message'),
            "offers" => $text_offer,
            "image_offer" => $image_offer,
            "p_desc" => $this->input->post('p_desc'),
            "p_images" => $p_images,
            "chr_publish" => "Y",
            "chr_delete" => "N",
            "dt_createddate" => date("Y-m-d H:i:s"),
            "dt_modifydate" => date("Y-m-d H:i:s"),
        );

        $id = $this->common_model->insertRow($data, "mst_users");
        if ($id != "") {
            return $id;
        } else {
            return false;
        }
    }
    public function showBusinessCategory()
    {
        $this->db->select("*");

        $this->db->from("mst_category");
        
        $this->db->where('home_display','N');
        
        $this->db->where('chr_publish','Y');
        
        $this->db->where('chr_delete','N');

        $query = $this->db->get();

        $row = $query->result_array();

        return $row;
    }
    
    public function homeCategory()
    {
        $this->db->select("*");

        $this->db->from("mst_category");
        
        $this->db->where('chr_publish','Y');
        
        $this->db->where('chr_delete','N');

        $query = $this->db->get();

        $row = $query->result_array();

        return $row;
    }


    public function getVendors($var_state="", $var_city="", $cat)
    {
        $this->db->select("int_glcode,fname,lname,var_email,var_mobile_no,company,c_logo,gistin,bisno,catAs");

        $this->db->from("mst_users");
        
            $wherecat = "(catAs='$cat' OR regAs='$cat')";
            $this->db->where($wherecat);
       
        if($var_state != ""){
            $this->db->where('var_state',$var_state);
        }
        if($var_city != ""){
            $this->db->where('var_city',$var_city);
        }
        // $where = "(var_state='$var_state' AND var_city='$var_city') AND ";
        // $this->db->where($where);
        $query = $this->db->get();

        $row = $query->result_array();

        return $row;
    }
    public function getCatvendors()
    {
        $categoryId = $this->input->post('categoryId');
        $catAs = $this->input->post('catAs');
        $regAs = $this->input->post('regAs');
        //echo $categoryId, $catAs, $regAs;
        //die; 
        if ($regAs == "Customer") {
            $this->db->select("int_glcode,fname,lname,var_email,var_mobile_no,company,c_logo,gistin,bisno,catAs");

            $this->db->from("mst_users");
            $where = "(catAs='Retailer' and FIND_IN_SET($categoryId,businessCat))";
            $this->db->where($where);
            $query = $this->db->get();

            $row = $query->result_array();

            return $row;
        } elseif ((($regAs == "Business") || ($regAs == "Sarafa Association")) && ($catAs == "Manufacturer")) {

            $this->db->select("int_glcode,fname,lname,var_email,var_mobile_no,company,c_logo,gistin,bisno,catAs");

            $this->db->from("mst_users");
            $where = "(catAs IN ('Manufacturer','Dealer') and FIND_IN_SET($categoryId,businessCat))";
            $this->db->where($where);
            $query = $this->db->get();

            $row = $query->result_array();

            return $row;
        } elseif ((($regAs == "Business") || ($regAs == "Sarafa Association")) && ($catAs == "Dealer")) {
            $this->db->select("int_glcode,fname,lname,var_email,var_mobile_no,company,c_logo,gistin,bisno,catAs");

            $this->db->from("mst_users");
            $where = "(catAs IN ('Manufacturer','Dealer','Wholesaler') and FIND_IN_SET($categoryId,businessCat))";
            $this->db->where($where);
            $query = $this->db->get();

            $row = $query->result_array();

            return $row;
        } elseif ((($regAs == "Business") || ($regAs == "Sarafa Association")) && ($catAs == "Wholesaler")) {

            $this->db->select("int_glcode,fname,lname,var_email,var_mobile_no,company,c_logo,gistin,bisno,catAs");

            $this->db->from("mst_users");
            $where = "(catAs IN ('Retailer','Dealer','Wholesaler') and FIND_IN_SET($categoryId,businessCat))";
            $this->db->where($where);
            $query = $this->db->get();

            $row = $query->result_array();

            return $row;
        }
    }
    public function get_city_search($search)
    {
        $sql = "SELECT var_city FROM mst_users WHERE var_city LIKE '%{$search}%' group by var_city";
        $result = $this->db->query($sql);
        $row = $result->result_array();

        return $row;
    }
    public function get_state_search($search)
    {
        $sql = "SELECT var_state FROM mst_users WHERE var_state LIKE '%{$search}%' group by var_state";
        $result = $this->db->query($sql);
        $row = $result->result_array();

        return $row;
    }

    public function getUser($userId)
    {
        $this->db->select("*");

        $this->db->from("mst_users");
        $where = "int_glcode='$userId'";
        $this->db->where($where);
        $query = $this->db->get();

        $row = $query->result_array();
        
        foreach($row as $val){
            
            if($val['image_offer'] != ""){
                $val['image_offer'] = base_url()."uploads/offer/".$val['image_offer'];
            }
            
            $data[] = $val;
        }

        return $data;
    }

    /*--------------------------- get users search ------------------------------*/

    public function searchUser($keyword)
    {
        $this->db->select(
            "int_glcode,var_fname,var_uname,var_email,e_gender,var_phoneno,dt_bod"
        );

        $this->db->from("mst_user");

        $this->db->like("var_fname", $keyword);

        $query = $this->db->get();

        $row = $query->result_array();

        return $row;
    }

    /*--------------------------- get users list ------------------------------*/

    public function getProfileDetalis($userId)
    {
        $this->db->select("*");

        $this->db->from("mst_users");

        $this->db->where("int_glcode", $userId);

        $this->db->where("chr_delete", "N");

        $query = $this->db->get();

        $row = $query->result_array();

        $row_arr = [];

        foreach ($row as $value) {
            if ($value["var_alt_mobile"] != null) {
                $value["var_alt_mobile"] = $value["var_alt_mobile"];
            } else {
                $value["var_alt_mobile"] = "";
            }

            $row_arr[] = $value;
        }

        return $row_arr;
    }

    /*--------------------------- get id by users list --------------------*/

    public function getIdByUser($userId)
    {
        $this->db->select("*");

        $this->db->from("mst_user");

        $this->db->where("int_glcode", $userId);

        $this->db->where("chr_delete", "N");

        $query = $this->db->get();

        $row = $query->row_array();

        return $row;
    }

    /*--------------------------- get id by users list --------------------*/

    public function viewUserDetail($userId)
    {
        $this->db->select("*");

        $this->db->from("mst_users");

        $this->db->where("int_glcode", $userId);

        $this->db->where("chr_delete", "N");

        $query = $this->db->get();

        $row = $query->row_array();

        return $row;
    }

    /*--------------------------- get user details ---------------------------------*/

    public function getUserImage($id)
    {
        $this->db->select("var_image");

        $this->db->from("mst_users");

        $this->db->where("int_glcode", $id);

        $query = $this->db->get();

        $row = $query->row_array();

        return $row["var_image"];
    }
    
    public function getUserimage_offer($id)
    {
        $this->db->select("image_offer");

        $this->db->from("mst_users");

        $this->db->where("int_glcode", $id);

        $query = $this->db->get();

        $row = $query->row_array();

        return $row["image_offer"];
    }

    public function getLogo($id)
    {
        $this->db->select("c_logo");

        $this->db->from("mst_users");

        $this->db->where("int_glcode", $id);

        $query = $this->db->get();

        $row = $query->row_array();

        return $row["c_logo"];
    }
    public function getProductImages($id)
    {
        $this->db->select("p_images");

        $this->db->from("mst_users");

        $this->db->where("int_glcode", $id);

        $query = $this->db->get();

        $row = $query->row_array();

        return $row["p_images"];
    }

    /*--------------------------- update user ---------------------------*/

    public function updateUser($userId)
    {
        if (isset($_FILES["var_image"])) {
            if (!is_dir("uploads/user")) {
                mkdir("uploads/user", 0777, true);
            }

            $filename1 = time() . "_" . $_FILES["var_image"]["name"];

            $filename1 = str_replace("&", "_", $filename1);

            $filename1 = preg_replace(
                '/[^a-zA-Z0-9\[\]\.(\)&-\']/s',
                "",
                $filename1
            );

            $destination = "uploads/user/";

            move_uploaded_file(
                $_FILES["var_image"]["tmp_name"],
                $destination . $filename1
            );
        } else {
            $filename1 = $this->getUserImage($userId);
        }
        if (isset($_FILES["c_logo"])) {
            if (!is_dir("uploads/user")) {
                mkdir("uploads/user", 0777, true);
            }

            $filename2 = time() . "_" . $_FILES["c_logo"]["name"];

            $filename2 = str_replace("&", "_", $filename2);

            $filename2 = preg_replace(
                '/[^a-zA-Z0-9\[\]\.(\)&-\']/s',
                "",
                $filename2
            );

            $destination = "uploads/user/";

            move_uploaded_file(
                $_FILES["c_logo"]["tmp_name"],
                $destination . $filename2
            );
        } else {
            $filename2 = $this->getLogo($userId);
        }
        if (isset($_FILES["p_images"])) {
            if (!is_dir("uploads/userProduct")) {
                mkdir("uploads/userProduct", 0777, true);
            }
            $count = count($_FILES['p_images']['name']);
            $filename3 = "";
            for ($i = 0; $i < $count; $i++) {
                $p_image = time() . "_" . $_FILES["p_images"]["name"][$i];

                $p_image = str_replace("&", "_", $p_image);

                $p_image = preg_replace(
                    '/[^a-zA-Z0-9\[\]\.(\)&-\']/s',
                    "",
                    $p_image
                );

                $destination = "uploads/userProduct/";
                //echo $p_image;
                if (move_uploaded_file(
                    $_FILES["p_images"]["tmp_name"][$i],
                    $destination . $p_image
                )) {
                    $filename3 .= $p_image . ",";
                }

                //die;
            }
            //die;
        } else {
            $filename3 = $this->getProductImages($userId);
        }
        
        if (isset($_FILES["image_offer"])) {
            if (!is_dir("uploads/offer")) {
                mkdir("uploads/offer", 0777, true);
            }

            $image_offer = time() . "_" . $_FILES["image_offer"]["name"];

            $image_offer = str_replace("&", "_", $image_offer);

            $image_offer = preg_replace(
                '/[^a-zA-Z0-9\[\]\.(\)&-\']/s',
                "",
                $image_offer
            );

            $dest = "uploads/offer/";

            move_uploaded_file(
                $_FILES["image_offer"]["tmp_name"],
                $dest . $image_offer
            );
        } else {
            $image_offer = $this->getUserimage_offer($userId);
        }
            
            if($_POST['text_offer'] != ""){
                $text_offer = $_POST['text_offer'];
            }else{
                $text_offer = "";
            }
            
        $data = array(
            "regAs" => $this->input->post("regAs"),
            "fname" => $this->input->post("fname"),
            "lname" => $this->input->post("lname"),
            //"var_email" => $this->input->post("var_email"),
            //"var_mobile_no" => $this->input->post("var_mobile_no"),
            "var_alt_mobile" => $this->input->post("var_alt_mobile"),
            // "var_password" => $this->mylibrary->cryptPass(
            //     $this->input->post("var_password")
            // ),
            "address" => $this->input->post("address"),
            "var_state" => $this->input->post("var_state"),
            "var_city" => $this->input->post("var_city"),
            "catAs" => $this->input->post("catAs"),
            "company" => $this->input->post("company"),
            "businessCat" => $this->input->post("businessCat"),
            //'var_device_token' => $this->input->post('var_device_token'),
            //"var_otp" => "1234",
            "var_image" => $filename1,
            "c_logo" => $filename2,
            "gistin" => $this->input->post('gistin'),
            "bisno" => $this->input->post('bisno'),
            "message" => $this->input->post('message'),
            "offers" => $text_offer,
            "image_offer" => $image_offer,
            "p_desc" => $this->input->post('p_desc'),
            "p_images" => $filename3,
            "chr_publish" => "Y",
            "chr_delete" => "N",
            "dt_createddate" => date("Y-m-d H:i:s"),
            "dt_modifydate" => date("Y-m-d H:i:s"),
        );

        $this->common_model->updateRow('mst_users', $data, array("int_glcode" => $userId));

        return "true";
    }

    /*--------------------- user logout  --------------------*/

    public function user_logout($userId)
    {
        $data = array(
            "var_device_token" => "",
        );

        $this->common_model->updateRow('mst_users', $data, array("int_glcode" => $userId));

        return true;
    }

    /*---------------------  check email already exit or not --------------------*/

    public function checkEmail($eaddress)
    {
        $select =
            "select int_glcode from mst_users where chr_delete = 'N' and chr_publish = 'Y' and var_email = '" .
            $eaddress .
            "'";

        $result = $this->db->query($select);

        $count = $result->num_rows();

        if ($count > 0) {
            return false;
        } else {
            return true;
        }
    }

    public function get_userid($eaddress)
    {
        $select =
            "select int_glcode from mst_users where chr_delete = 'N' and var_email = '" .
            $eaddress .
            "'";

        $result = $this->db->query($select);

        $data = $result->row_array();

        return $data["int_glcode"];
    }

    public function updateTimeStamp($email)
    {
        $time_stamp = time();

        $this->db->set("dt_timestamp", $time_stamp);

        $this->db->where("var_email", $email);

        $this->db->update("mst_users");
    }

    /*---------------------  check email already exit or not --------------------*/

    public function checkUpdateEmail($userId, $eaddress)
    {
        $select =
            "select int_glcode from mst_users where int_glcode NOT IN (" .
            $userId .
            ") AND var_email = '" .
            $eaddress .
            "' AND chr_delete = 'N' AND chr_publish = 'Y'";

        $result = $this->db->query($select);

        $count = $result->num_rows();

        if ($count > 0) {
            return false;
        } else {
            return true;
        }
    }

    /*---------------------  check userId and token is same or not --------------------*/

    public function checkUserToken($userId, $token)
    {
        $select =
            "select * from mst_user where chr_delete = 'N' and int_glcode != '" .
            $userId .
            "' and var_auth_token = '" .
            $token .
            "' ";

        $result = $this->db->query($select);

        $count = $result->num_rows();

        if ($count > 0) {
            return false;
        } else {
            return true;
        }
    }

    /*--------------------- check email already exit or not in update time -----------------*/

    public function checkEmailUser($email, $userId)
    {
        $select =
            "select int_glcode from mst_users where chr_delete = 'N' and var_email = '" .
            $email .
            "' and int_glcode != '" .
            $userId .
            "'";

        $result = $this->db->query($select);

        $count = $result->num_rows();

        if ($count > 0) {
            return false;
        } else {
            return true;
        }
    }

    /*----------------------- user login API -------------------------*/

    public function user_login($username, $password)
    {
        $this->db->select("*");

        $this->db->from("mst_users");

        $this->db->where("var_mobile_no", $username);

        $this->db->where("var_password", $password);

        $this->db->where("chr_publish", "Y");

        $this->db->where("chr_delete", "N");

        $query = $this->db->get();

        //echo $this->db->last_query(); exit();

        $row = $query->row_array();

        return $row;
    }

    public function checkMobileNo($var_mobile)
    {
        $select =
            "select int_glcode from mst_users where chr_delete = 'N' and chr_publish = 'Y' and var_mobile_no = '" .
            $var_mobile .
            "'";

        $result = $this->db->query($select);

        $count = $result->num_rows();

        if ($count > 0) {
            return false;
        } else {
            return true;
        }
    }

    public function get_user_name($var_mobile)
    {
        $select =
            "select var_name from mst_users where chr_delete = 'N' and var_mobile_no = '" .
            $var_mobile .
            "'";

        $result = $this->db->query($select);

        $data = $result->row_array();

        return $data["var_name"];
    }

    public function get_username_id($mobile)
    {
        $select =
            "select int_glcode from mst_users where chr_delete = 'N' and var_mobile_no = '" .
            $mobile .
            "'";

        $result = $this->db->query($select);

        $data = $result->row_array();

        return $data["int_glcode"];
    }

    public function checkUpdateMobileNo($userId, $var_mobile)
    {
        $select =
            "select int_glcode from mst_users where int_glcode NOT IN (" .
            $userId .
            ") AND var_mobile_no = '" .
            $var_mobile .
            "' AND chr_delete = 'N' AND chr_publish = 'Y'";

        $result = $this->db->query($select);

        $count = $result->num_rows();

        if ($count > 0) {
            return false;
        } else {
            return true;
        }
    }

    /*------------------------------- get otp --------------------------- */

    public function get_otp($mobile, $var_otp)
    {
        $this->db->select("*");

        $this->db->from("mst_users");

        //$this->db->where("int_glcode", $user_id);
        $where = "var_mobile_no='$mobile' AND var_otp='$var_otp'";
        $this->db->where($where);

        $result = $this->db->get();

        $row = $result->row_array();

        if ($var_otp == $row["var_otp"]) {
            $data = array(
                "chr_verify" => "Y",
            );

            $this->db->where($where);

            $this->db->update("mst_users", $data);
        }

        return $row;
    }

    /*------------------------------- get otp --------------------------- */

    public function update_otp($vendor_id, $var_mobile_no, $var_otp)
    {
        $this->db->select("*");

        $this->db->from("mst_vendors");

        $this->db->where("int_glcode", $vendor_id);

        $this->db->where("var_otp", $var_otp);

        $result = $this->db->get();

        $row = $result->row_array();

        if ($var_otp == $row["var_otp"]) {
            $data = [
                "var_alt_mobile" => $var_mobile_no,
            ];

            $this->db->where("int_glcode", $vendor_id);

            $this->db->update("mst_vendors", $data);
        }

        return $row;
    }

    /*----------------------- update device ID on login time in API --------------------*/

    public function updateDeviceId($deviceId, $userId)
    {
        $this->db->set("var_device_token", $deviceId);

        $this->db->where("int_glcode", $userId);

        $this->db->update("mst_users");

        return true;
    }

    /*----------------------- change password ---------------------------*/

    public function chagePass($userId, $pass)
    {
        $this->db->select("int_glcode");

        $this->db->from("mst_users");

        $this->db->where("int_glcode", $userId);

        $this->db->where("var_password", $pass);

        $this->db->where("chr_publish", "Y");

        $this->db->where("chr_delete", "N");

        $query = $this->db->get();

        return $query;
    }

    /*----------------------- forgot password ---------------------------*/

    public function updatePass($newpass, $email)
    {
        $this->db->set("var_password", $newpass);

        $this->db->where("var_email", $email);

        $this->db->update("mst_user");
    }

    /*----------------------- chage password ---------------------------*/

    public function updatePassChange($newpass, $userId)
    {
        $this->db->set("var_password", $newpass);

        $this->db->where("int_glcode", $userId);

        $this->db->update("mst_users");
    }

    /*----------------------- If vairable return null value then return blank ------------*/

    public function emptyVar($field)
    {
        if ($field == null) {
            $field = "";
        }

        return $field;
    }



    /*---------------- check email already exit or not delivery --------------*/

    public function checkDEmail($eaddress)
    {
        $select =
            "select int_glcode from mst_delivery_boy where chr_delete = 'N' and chr_publish = 'Y' and var_email = '" .
            $eaddress .
            "'";

        $result = $this->db->query($select);

        $count = $result->num_rows();

        if ($count > 0) {
            return false;
        } else {
            return true;
        }
    }

    /*---------------- check mobile no. already exit or not delivery --------------*/

    public function checkDMobile($mobile)
    {
        $select =
            "select int_glcode from mst_delivery_boy where chr_delete = 'N' and chr_publish = 'Y' and var_mobile_no = '" .
            $mobile .
            "'";

        $result = $this->db->query($select);

        $count = $result->num_rows();

        if ($count > 0) {
            return false;
        } else {
            return true;
        }
    }


    public function sendFeedback($userId, $message)
    {
        $data = array(
            "fk_user" => $userId,

            "var_name" => $this->input->post("var_name"),

            "var_message" => $message,

            "dt_createddate" => date("Y-m-d H:i:s"),
        );

        $id = $this->common_model->insertRow($data, "mst_feedback");

        $this->common_model->send_feedback_admin(
            $this->input->post("var_name"),
            $this->input->post("var_email"),
            $message,
            "A"
        );

        $this->common_model->send_feedback_user(
            $this->input->post("var_name"),
            $this->input->post("var_email"),
            $message,
            "U"
        );

        return $id;
    }

    public function checkForgotLink($var_email)
    {
        $select =
            "select var_email from mst_users where chr_delete = 'N' and var_mobile_no = '" .
            $var_email .
            "'";

        $result = $this->db->query($select);

        $data = $result->row_array();

        if (!empty($data)) {
            $get_res = $data['var_email'];
        }

        $select1 =
            "select var_email from mst_users where chr_delete = 'N' and var_email = '" .
            $var_email .
            "'";

        $result1 = $this->db->query($select1);

        $data1 = $result1->row_array();

        if (!empty($data1)) {
            $get_res = $data1['var_email'];
        }

        if (empty($data) && empty($data1)) {
            $get_res = "failed_data";
        }

        return $get_res;
    }
}
