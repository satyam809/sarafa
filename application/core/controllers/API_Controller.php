<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

//

class API_Controller extends MY_Controller {

  public function __construct() {

    parent::__construct();
    header('Content-Type: application/json');
  }

}