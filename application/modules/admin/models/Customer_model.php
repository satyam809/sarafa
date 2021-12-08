<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Customer_model extends CI_Model
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

        $this->db->select('int_glcode,regAs,fname,lname,var_email,var_mobile_no,var_alt_mobile,chr_delete,address,var_city,var_state');
        //$this->db->join('mst_user_address a', 'a.fk_user = u.int_glcode');
        $this->db->from('mst_users');

        if ($search != '') {

            $this->db->group_start();
            $this->db->like("regAs", $search);
            $this->db->like("fname", $search);
            $this->db->like("lname", $search);
            $this->db->or_like("var_email", $search);
            $this->db->or_like("address", $search);
            $this->db->or_like("var_city", $search);
            $this->db->or_like("var_state", $search);
            $this->db->or_like("var_mobile_no", $search);
            $this->db->or_like("var_alt_mobile", $search);
            $this->db->or_like("int_glcode", $search);
            $this->db->group_end();
        }
        $where = "chr_delete='N' AND regAs='Customer'";
        $this->db->where($where);

        $result = $this->db->get();
        $row = $result->result_array();
        //echo $this->db->last_query();die();
        return count($row);
    }

    /*------------------------ get records  ------------------------- */
    public function getData($rowno, $rowperpage, $search = '', $_field = 'int_glcode', $_sort = 'desc')
    {
        $this->db->select('int_glcode,regAs,fname,lname,var_mobile_no,var_alt_mobile,var_email,chr_publish,chr_delete,dt_createddate,address,var_city,var_state');
        //$this->db->join('mst_user_address a', 'a.fk_user = u.int_glcode');
        $this->db->from('mst_users');
        $where = "chr_delete='N' AND regAs='Customer'";
        $this->db->where($where);
        $this->db->order_by($_field, $_sort);
        $this->db->limit($rowperpage, $rowno);

        if ($search != '') {

            $this->db->group_start();
            $this->db->or_like("regAs", $search);
            $this->db->or_like("fname", $search);
            $this->db->or_like("lname", $search);
            $this->db->or_like("var_email", $search);
            $this->db->or_like("address", $search);
            $this->db->or_like("var_city", $search);
            $this->db->or_like("var_state", $search);
            $this->db->or_like("var_mobile_no", $search);
            $this->db->or_like("var_alt_mobile", $search);
            $this->db->or_like("int_glcode", $search);
            $this->db->group_end();
        }

        $result = $this->db->get();
        $row = $result->result_array();

        return $row;
    }

    /*------------------------ get id by record ------------------------- */
    public function getIdByData($customerId)
    {
        $this->db->select('*');
        $this->db->from('mst_users');
        $this->db->where('int_glcode', $customerId);
        $this->db->where('chr_delete', 'N');
        $query = $this->db->get();
        $row = $query->row_array();

        return $row;
    }



    /*------------------------ add record ------------------------- */
    public function addRecord()
    {
        // echo "<pre>";
        // print_r($_POST);
        // exit();
        $landline = $this->input->post('landline');
        $data = array(
            'regAs' => $this->input->post('regAs'),
            'fname' => $this->input->post('fname'),
            'lname' => $this->input->post('lname'),
            'var_mobile_no' => $this->input->post('mobile'),
            'var_alt_mobile' => $landline,
            'var_email' => $this->input->post('email'),
            "var_password" => $this->mylibrary->cryptPass(
                $this->input->post("password")
            ),
            'address' => $this->input->post('address'),
            'var_state' => $this->input->post('var_state'),
            'var_city' => $this->input->post('var_city'),
            'chr_publish' => 'Y',
            'chr_delete' => 'N',
            'dt_createddate' => date('Y-m-d H:i:s'),
            'dt_modifydate' => date('Y-m-d H:i:s'),
            'var_ipaddress' => $_SERVER['REMOTE_ADDR']
        );
        // print_r($data);
        // die;
        $this->common_model->insertRow($data, "mst_users");
        return TRUE;
    }

    /*---------------------------- update user admin ----------------------*/
    public function updateRecord($customerId)
    {
        $data = array(
            'fname' => $this->input->post('fname'),
            'lname' => $this->input->post('lname'),
            'var_mobile_no' => $this->input->post('phone'),
            'var_alt_mobile' => $this->input->post('landline'),
            'var_email' => $this->input->post('email'),
            'var_password' => $this->mylibrary->cryptPass($this->input->post('var_password')),
            //'var_password1' => $this->input->post('var_password'),
            'address' => $this->input->post('address'),
            'var_state' => $this->input->post('state'),
            'var_city' => $this->input->post('city'),
            'dt_modifydate' => date('Y-m-d H:i:s'),
            'var_ipaddress' => $_SERVER['REMOTE_ADDR']
        );
        //print_r($data);
        //die;
        $this->common_model->updateRow('mst_users', $data, array("int_glcode" => $customerId));
        return TRUE;
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

    public function getExportcustomers()
    {
        $this->db->select('int_glcode,fname,lname,var_mobile_no,var_alt_mobile,var_email,address,var_city,var_state,dt_createddate');
        $this->db->from('mst_users');
        $where = "chr_delete='N' AND regAs='Customer'";
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
