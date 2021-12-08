<?php (defined('BASEPATH')) OR exit('No direct script access allowed');


class Vendor_Controller extends MY_Controller {

  function __construct() {
    parent::__construct();
  }

  public function load_view($view, $vars = array()) 
  {
    $this->load->view('vendor_template/header');
    $this->load->view('vendor_template/menu');
    $this->load->view($view, $vars);
    $this->load->view('vendor_template/footer');
  }
}
