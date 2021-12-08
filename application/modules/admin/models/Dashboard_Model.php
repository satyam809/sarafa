<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * User_model class.
 * 
 * @extends CI_Model
 */
class Dashboard_model extends CI_Model {

	
	public function __construct() {
		
		parent::__construct();

		 $this->load->database();
		 $this->load->model('common_model');
	}

    /*------------------------ get total data in dashboard ------------------------- */
    public function getTotalData($tableName)
    {
        $this->db->select('int_glcode');
        $this->db->from($tableName);
        if($tableName != 'mst_orders'){
        	$this->db->where('chr_delete','N');
        }
        
        $query = $this->db->get();
        $row = $query->num_rows();

        return $row;
    }

    

}