<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category_model extends CI_Model {

	
	public function __construct() {
		
		parent::__construct();
		$this->load->database();
		$this->load->model('common_model');
	}

    /*------------------------ get records count ------------------------- */
    public function records_count($search = ''){

        $this->db->select('int_glcode,var_title,chr_delete');
        $this->db->from('mst_category'); 
        $this->db->where('home_display','N');

        if ($search != '') {

        $this->db->group_start();
        $this->db->like("var_title" , $search);
        $this->db->or_like("int_glcode" , $search);
        $this->db->group_end();

        }

        $this->db->where('chr_delete','N');        

        $result = $this->db->get();
        $row = $result->result_array();
        //echo $this->db->last_query();die();
        return count($row);
    
    }

    /*------------------------ get parent category  ------------------------- */
    public function getParentCategory()
    {
        $this->db->select('int_glcode,var_title');
        $this->db->from('mst_category');
        $this->db->where('home_display','N');
        $this->db->where('chr_publish','Y');
        $this->db->where('chr_delete','N');
        $query = $this->db->get();
        $row = $query->result_array();

        return $row;
    }

    /*------------------------ get records  ------------------------- */
    public function getData($rowno,$rowperpage,$search = '',$_field = 'c.int_glcode',$_sort = 'desc')
    {          
        $this->db->select('c.int_glcode,c.fk_parent,c.var_title,c.var_icon,c.chr_publish,c.chr_delete,c.dt_createddate');
        $this->db->from('mst_category c');
        $this->db->where('c.chr_delete','N');
        $this->db->where('c.home_display','N');
        $this->db->order_by($_field,$_sort);
        $this->db->limit($rowperpage , $rowno);

        if ($search != '') {

            $this->db->group_start();
            $this->db->like("c.var_title" , $search);
            $this->db->or_like("int_glcode" , $search);   
            $this->db->group_end();
        }


        $result = $this->db->get();
        //echo $this->db->last_query(); exit();
        $row = $result->result_array();

        $data = array();
        foreach ($row as $key => $value) {
            $value['parent_name'] = $this->getParentTitle($value['fk_parent']);
            $data[] = $value;
        }

        //echo "<pre>"; print_r($data); exit();
        return $data;
    }

    public function getParentTitle($id)
    {
        $this->db->select('var_title');
        $this->db->from('mst_category');
        $this->db->where('int_glcode',$id);
        $query = $this->db->get();
        $row = $query->row_array();

        return $row['var_title'];
    }


    /*------------------------ get id by record ------------------------- */
    public function getIdByData($userId)
    {
        $this->db->select('*');
        $this->db->from('mst_category');
        $this->db->where('int_glcode',$userId);
        $this->db->where('chr_delete','N');
        $query = $this->db->get();
        $row = $query->row_array();

        return $row;
    }

    /*------------------------ add record ------------------------- */
    public function addRecord()
    {
        if($_FILES['var_image']['name'] != '')
        {
	        if (!is_dir('uploads/category')) {
			 	mkdir('uploads/category', 0777, TRUE);
			}
	            $filename = time().'_'.$_FILES['var_image']['name'];
	            $filename = str_replace('&', "_", $filename);
	            $filename = preg_replace('/[^a-zA-Z0-9\[\]\.(\)&-\']/s', '', $filename);
	            $destination = 'uploads/category/';
	            move_uploaded_file($_FILES['var_image']['tmp_name'],$destination.$filename);
	        } else {
	            $filename =  '';
	        }

	        $data = array(
		        'fk_parent' => 0,
		        'var_title' => $this->input->post('var_title'),
		        'var_icon' => $filename,
		        'chr_publish' => 'Y',
		        'chr_delete' => 'N',
		        'dt_createddate' => date('Y-m-d H:i:s'),
		        'dt_modifydate' => date('Y-m-d H:i:s'),
		        'var_ipaddress' => $_SERVER['REMOTE_ADDR']
	     	);

        $id = $this->common_model->insertRow($data, "mst_category");
        //echo $this->db->last_query(); exit();
           
        return TRUE;

    }

    /*---------------------------- update user app ----------------------*/
    public function updateRecord($Id)
    {
        if($_FILES['var_image']['name'] != '')
        {
            if (!is_dir('uploads/category')) {
                mkdir('uploads/category', 0777, TRUE);
            }

            $filename = time().'_'.$_FILES['var_image']['name'];
            $filename = str_replace('&', "_", $filename);
            $filename = preg_replace('/[^a-zA-Z0-9\[\]\.(\)&-\']/s', '', $filename);
            $destination = 'uploads/category/';
            move_uploaded_file($_FILES['var_image']['tmp_name'],$destination.$filename);
        } else {
            $filename =  $this->input->post('hidvar_image');
        }
       
        $data = array(
            'fk_parent' => 0,
            'var_title' => $this->input->post('var_title'),
            'var_icon' => $filename,
            'dt_modifydate' => date('Y-m-d H:i:s'),
            'var_ipaddress' => $_SERVER['REMOTE_ADDR']
        );

        $this->common_model->updateRow('mst_category', $data, array("int_glcode" => $Id)); 
        //echo $this->db->last_query(); exit();
        return TRUE;

    }
    
    /*---------------- If vairable return null value then return blank --------------*/
    public function emptyVar($field)
    {
      if($field == NULL) {
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
            if($this->db->update("mst_category",$data))
            {
                $i++;
                $smsg = $i." Records successfully deleted...";
            }
            else
            {
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
            $this->input->get_post('fieldname')=>$this->input->get_post('value')
        );

        $this->db->where('int_glcode', $this->input->get_post('id'));
        $a=$this->db->update($this->input->get_post('tablename'), $data);

        echo ($a) ? "1" : "0";
        exit;
    }

    
}