<?php (defined('BASEPATH')) OR exit('No direct script access allowed');


class Admin_Controller extends MY_Controller {

  function __construct() {
    parent::__construct();
  }

  public function load_view($view, $vars = array()) 
  {
    $this->load->view('admin_template/header');
    $this->load->view('admin_template/menu');
    $this->load->view($view, $vars);
    $this->load->view('admin_template/footer');
  }
}
