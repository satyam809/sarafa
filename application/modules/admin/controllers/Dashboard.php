<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends Admin_Controller
{

    public function __construct()
    {

        parent::__construct();
        $this->load->library(array('session', 'mylibrary'));
        $this->load->model('Dashboard_Model', 'model');
    }

    public function index()
    {
        $start = $_GET['start_date'];
        $end = $_GET['end_date'];
        $data['users'] = $this->model->getTotalData('mst_users');

        $this->load_view('home', $data);
    }

    public function change_password()
    {

        $cupass = $this->mylibrary->cryptPass($this->input->post('opassword'));
        $nepass = $this->mylibrary->cryptPass($this->input->post('npassword'));
        $copass = $this->mylibrary->cryptPass($this->input->post('rpassword'));

        $sel1 = $this->db->query("select var_password from mst_admin where int_glcode='1' ");
        $res1 = $sel1->row_array();

        if ($cupass != $nepass) {
            if ($cupass == $res1['var_password']) {
                if ($nepass == $copass) {

                    $update = $this->db->query("update mst_admin set var_password='$nepass' where int_glcode='1'");
                    echo 1;
                    exit;
                } else {
                    echo 'new and confirm password does not match.';
                    exit;
                }
            } else {
                echo 'current password does not match.';
                exit;
            }
        } else {
            echo 'Last 3 passwords should not be used again.';
            exit;
        }
    }
}
