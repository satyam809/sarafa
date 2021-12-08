<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sarafa_association_model extends CI_Model
{


    public function __construct()
    {

        parent::__construct();
        $this->load->database();
        $this->load->model('common_model');
    }

    /*------------------------ get records count ------------------------- */
    public function records_count($search = '')
    {

        $this->db->select('int_glcode,fname,lname,var_mobile_no,var_alt_mobile,company,catAs,var_email,chr_delete,address,regAs,var_city,var_state');
        //$this->db->join('mst_user_address a', 'a.fk_user = u.int_glcode');
        $this->db->from('mst_users');

        if ($search != '') {

            $this->db->group_start();
            $this->db->like("fname", $search);
            $this->db->or_like("lname", $search);
            $this->db->or_like("var_email", $search);
            $this->db->or_like("address", $search);
            $this->db->or_like("var_city", $search);
            $this->db->or_like("var_state", $search);
            $this->db->or_like("var_mobile_no", $search);
            $this->db->or_like("var_alt_mobile", $search);
            $this->db->or_like("catAs", $search);
            $this->db->or_like("int_glcode", $search);
            $this->db->group_end();
        }

        $this->db->where('chr_delete', 'N');

        $result = $this->db->get();
        $row = $result->result_array();
        //echo $this->db->last_query();die();
        return count($row);
    }

    /*------------------------ get records  ------------------------- */
    public function getData($rowno, $rowperpage, $search = '', $_field = 'int_glcode', $_sort = 'desc')
    {
        $this->db->select('int_glcode,fname,lname,var_mobile_no,var_alt_mobile,var_email,regAs,catAs,company,chr_publish,chr_delete,dt_createddate,address,var_city,var_state');
        //$this->db->join('mst_user_address a', 'a.fk_user = u.int_glcode');
        $this->db->from('mst_users');
        $where = "regAs='Sarafa Association' AND chr_delete='N'";
        $this->db->where($where);
        $this->db->order_by($_field, $_sort);
        $this->db->limit($rowperpage, $rowno);

        if ($search != '') {

            $this->db->group_start();
            $this->db->like("fname", $search);
            $this->db->or_like("lname", $search);
            $this->db->or_like("var_email", $search);
            $this->db->or_like("company", $search);
            $this->db->or_like("address", $search);
            $this->db->or_like("var_city", $search);
            $this->db->or_like("var_state", $search);
            $this->db->or_like("var_mobile_no", $search);
            $this->db->or_like("var_alt_mobile", $search);
            $this->db->or_like("catAs", $search);
            $this->db->or_like("int_glcode", $search);
            $this->db->group_end();
        }

        $result = $this->db->get();
        $row = $result->result_array();

        return $row;
    }

    /*------------------------ get id by record ------------------------- */
    public function getIdByData($businessId)
    {
        //$sql="select mst_users.int_glcode,mst_users.regAs,mst_users.fname,mst_users.lname,mst_users.var_email,mst_users.var_mobile_no,mst_users.var_alt_mobile,mst_users.company,mst_users.businessCat,mst_users.catAs,mst_users.address,mst_users.var_city,mst_users.var_state,mst_category.var_title from";
        $this->db->select('*');
        $this->db->from('mst_users');
        $this->db->where('int_glcode', $businessId);
        $this->db->where('chr_delete', 'N');
        $query = $this->db->get();
        $row = $query->row_array();

        return $row;
    }



    /*------------------------ add record ------------------------- */
    public function addRecord()
    {
        //echo "<pre>"; print_r($_POST); exit();
        $businessCat = $this->input->post('businessCat');
        $chk = "";
        foreach ($businessCat as $chk1) {
            $chk .= $chk1 . ",";
        }
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
        $data = array(
            'regAs' => $this->input->post('regAs'),
            'fname' => $this->input->post('fname'),
            'lname' => $this->input->post('lname'),
            'var_mobile_no' => $this->input->post('mobile'),
            'var_alt_mobile' => $this->input->post('landline'),
            'var_email' => $this->input->post('email'),
            "var_password" => $this->mylibrary->cryptPass(
                $this->input->post("password")
            ),
            'company' => $this->input->post('company'),
            'catAs' => $this->input->post('catAs'),
            'address' => $this->input->post('address'),
            'var_state' => $this->input->post('var_state'),
            'var_city' => $this->input->post('var_city'),
            'businessCat' => $chk,
            'var_image' => $filename,
            'c_logo' => $c_logo,
            'gistin' => $this->input->post('gistin'),
            'bisno' => $this->input->post('bisno'),
            'message' => $this->input->post('message'),
            'offers' => $this->input->post('offers'),
            'p_desc' => $this->input->post('p_desc'),
            "p_images" => $p_images,
            'chr_publish' => 'Y',
            'chr_delete' => 'N',
            'dt_createddate' => date('Y-m-d H:i:s'),
            'dt_modifydate' => date('Y-m-d H:i:s'),
            'var_ipaddress' => $_SERVER['REMOTE_ADDR']
        );
        $this->common_model->insertRow($data, "mst_users");
        return TRUE;
    }


    /*---------------------------- update user admin ----------------------*/
    public function updateRecord($businessId)
    {
        $businessCat = $this->input->post('businessCat');
        $chk = "";
        foreach ($businessCat as $chk1) {
            $chk .= $chk1 . ",";
        }
        if ($_FILES['var_image']['name'] != '') {
            if (!is_dir('uploads/user')) {
                mkdir('uploads/user', 0777, TRUE);
            }

            $filename = time() . '_' . $_FILES['var_image']['name'];
            $filename = str_replace('&', "_", $filename);
            $filename = preg_replace('/[^a-zA-Z0-9\[\]\.(\)&-\']/s', '', $filename);
            $destination = 'uploads/user/';
            move_uploaded_file($_FILES['var_image']['tmp_name'], $destination . $filename);
        } else {
            $filename =  $this->input->post('hidvar_image');
        }
        if ($_FILES['c_logo']['name'] != '') {
            if (!is_dir('uploads/user')) {
                mkdir('uploads/user', 0777, TRUE);
            }

            $c_logo = time() . '_' . $_FILES['c_logo']['name'];
            $c_logo = str_replace('&', "_", $c_logo);
            $c_logo = preg_replace('/[^a-zA-Z0-9\[\]\.(\)&-\']/s', '', $c_logo);
            $destination = 'uploads/user/';
            move_uploaded_file($_FILES['c_logo']['tmp_name'], $destination . $c_logo);
        } else {
            $c_logo =  $this->input->post('hidc_logo');
        }
        if (isset($_FILES["p_images"])) {
            if (!is_dir("uploads/userProduct")) {
                mkdir("uploads/userProduct", 0777, true);
            }
            $count = count($_FILES['p_images']['name']);
            $filename3 =  $this->input->post('hidp_images');
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
            $filename3 =  $this->input->post('hidp_images');
            //echo $filename3;
            //die;
        }
        $data = array(
            'fname' => $this->input->post('fname'),
            'lname' => $this->input->post('lname'),
            'var_mobile_no' => $this->input->post('phone'),
            'var_alt_mobile' => $this->input->post('landline'),
            'var_email' => $this->input->post('email'),
            'var_password' => $this->mylibrary->cryptPass($this->input->post('var_password')),
            'company' => $this->input->post('company'),
            'catAs' => $this->input->post('catAs'),
            'address' => $this->input->post('address'),
            'var_state' => $this->input->post('state'),
            'var_city' => $this->input->post('city'),
            'businessCat' => $chk,
            'var_image' => $filename,
            'c_logo' => $c_logo,
            'gistin' => $this->input->post('gistin'),
            'bisno' => $this->input->post('bisno'),
            'message' => $this->input->post('message'),
            'offers' => $this->input->post('offers'),
            'p_desc' => $this->input->post('p_desc'),
            "p_images" => $filename3,
            'dt_modifydate' => date('Y-m-d H:i:s'),
            'var_ipaddress' => $_SERVER['REMOTE_ADDR']
        );
        //print_r($data);
        //die;
        $this->common_model->updateRow('mst_users', $data, array("int_glcode" => $businessId));
        return TRUE;
    }

    /*------------------------ get product multiple images ----------------------- */
    public function getproductImages($productId)
    {
        $this->db->select('p_images');
        $this->db->from('mst_users');
        $this->db->where('int_glcode', $productId);
        $query = $this->db->get();
        $row = $query->result_array();

        return $row['p_images'];
    }

    public function fetch_business_category()
    {
        $sql = "select * from mst_category";
        $result = $this->db->query($sql);
        return $result;
    }

    /*---------------- check email already exit or not --------------*/
    public function checkEmail($eaddress)
    {
        $select = "select int_glcode from mst_users where chr_delete = 'N' and chr_publish = 'Y' and var_email = '" . $eaddress . "'";
        $result = $this->db->query($select);
        $count = $result->num_rows();
        if ($count > 0) {
            return false;
        } else {
            return true;
        }
    }

    /*---------------- check mobile no. already exit or not --------------*/
    public function checkMobile($mobile)
    {
        $select = "select int_glcode from mst_users where chr_delete = 'N' and chr_publish = 'Y' and var_mobile_no = '" . $mobile . "'";
        $result = $this->db->query($select);
        $count = $result->num_rows();
        if ($count > 0) {
            return false;
        } else {
            return true;
        }
    }
    /*---------------- check landline no. already exit or not --------------*/
    public function checkLandline($landline)
    {
        $select = "select int_glcode from mst_users where chr_delete = 'N' and chr_publish = 'Y' and var_alt_mobile = '" . $landline . "'";
        $result = $this->db->query($select);
        $count = $result->num_rows();
        if ($count > 0) {
            return false;
        } else {
            return true;
        }
    }

    /*---------------- If vairable return null value then return blank --------------*/
    public function emptyVar($field)
    {
        if ($field == NULL) {
            $field = "";
        }
        return $field;
    }

    /*-------------------------------- delete multiple -------------------------*/
    public function delete_multiple()
    {
        $id = [];
        $id = $_POST['id'];
        $i = 0;

        foreach ($id as $key => $value) {
            $data = array(
                'chr_delete' => 'Y'
            );
            //$this->db->set('column_header', $value); //value that used to update column  
            $this->db->where('int_glcode', $value);
            if ($this->db->update("mst_users", $data)) {
                $i++;
                $smsg = $i . " Records successfully deleted...";
            } else {
                $smsg = $this->db->_error_message();
            }
        }
        // $this->db->query("DELETE from ci_users WHERE id='$id'");
        return $smsg;
    }

    /*-------------------------------- update publish -------------------------*/
    public function updatedisplay()
    {
        $data = array(
            $this->input->get_post('fieldname') => $this->input->get_post('value')
        );

        $this->db->where('int_glcode', $this->input->get_post('id'));
        $a = $this->db->update($this->input->get_post('tablename'), $data);

        echo ($a) ? "1" : "0";
        exit;
    }

    public function getExportBusiness()
    {
        $this->db->select("mst_users.int_glcode,mst_users.catAs,mst_users.fname,mst_users.lname,mst_users.var_mobile_no,mst_users.var_alt_mobile,mst_users.var_email,mst_users.address,mst_users.var_state,mst_users.var_city,mst_users.company,mst_users.dt_createddate,mst_users.businessCat");

        //$this->db->select("mst_users.int_glcode,mst_users.catAs,mst_users.fname,mst_users.lname,mst_users.var_mobile_no,mst_users.var_alt_mobile,mst_users.var_email,mst_users.address,mst_users.var_state,mst_users.var_city,mst_users.company,mst_users.dt_createddate,GROUP_CONCAT(mst_category.var_title SEPARATOR ',')");
        $this->db->from('mst_users');
        // $this->db->join('mst_category', 'find_in_set(mst_category.int_glcode,mst_users.businessCat)<> 0');
        $where = "mst_users.chr_delete='N' AND mst_users.regAs='Sarafa Association'";
        $this->db->where($where);
        $query = $this->db->get();
        $row = $query->result_array();

        $data = array();

        foreach ($row as $key => $value) {

            $value['dt_createddate'] = date('d/m/Y', strtotime($value['dt_createddate']));

            $data[] = $value;
        }

        return $data;
    }
}
