<?php

class Smtpemail {

    public function __construct() {
      
    }

    /*---------------------------- Global crediantial -------------------------------*/
    public function globalEmail() {
        $config = array(
            'protocol' => 'smtp', // 'mail', 'sendmail', or 'smtp'
            'smtp_host' => 'mail.cidev.in', 
            'smtp_port' => 465,
            'smtp_user' => '_mainaccount@cidev.in',
            'smtp_pass' => 'g:v@bH1O3w1M9V',
            'smtp_crypto' => 'ssl', //can be 'ssl' or 'tls' for example
            'mailtype' => 'html', //plaintext 'text' mails or 'html'
            'smtp_timeout' => '4', //in seconds
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE
        );

        return $config;
    }
    
}