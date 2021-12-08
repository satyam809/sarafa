<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends MX_Controller {

    function __construct() {
        parent::__construct();
        date_default_timezone_set('Asia/Kolkata');
    }
}

// include base controllers
require APPPATH."core/controllers/Admin_Controller.php";
require APPPATH."core/controllers/Front_Controller.php";
require APPPATH."core/controllers/Vendor_Controller.php";
require APPPATH."core/controllers/API_Controller.php";
?>
