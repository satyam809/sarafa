<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**

 * User_model class.

 * 

 * @extends CI_Model

 */

class Admin_Model extends CI_Model
{

    /**

     * __construct function.

     * 

     * @access public

     * @return void

     */

    public function __construct()
    {

        parent::__construct();
    }

    /**

     * resolveAdminLogin function.

     * 

     * @access public

     * @param mixed $username

     * @param mixed $password

     * @return bool true on success, false on failure

     */

    public function resolveAdminLogin($email, $password)

    {

        $select = "select * from mst_admin where var_email = '" . $email . "' and var_password = '" . $password . "' ";

        $result = $this->db->query($select);

        $row = $result->row_array();



        if (count($row) > 0) {

            return $row['int_glcode'];
        } else {

            return false;
        }
    }



    /**

     * getAdminId function.

     * 

     * @access public

     * @param mixed $username

     * @return int the user id

     */

    public function getAdminId($email)

    {

        $this->db->select('int_glcode ');

        $this->db->from('mst_admin');

        $this->db->where('var_email', $email);



        return $this->db->get()->row('int_glcode ');
    }

    /////////////////////// check email already exit or not //////////////
    public function checkEmail($email)
    {
        $this->db->where('chr_delete', 'N');
        $this->db->where('var_email', $email);
        $query = $this->db->get('mst_admin');

        $row_array = $query->num_rows();

        return $row_array;
    }


    public function updatePass($new_password, $email)
    {
        $this->db->set('var_password', $new_password);
        $this->db->where('var_email', $email);
        $this->db->update('mst_admin');
    }

    /**

     * getAdmin function.

     * 

     * @access public

     * @param mixed $admin_id

     * @return object the user object

     */

    public function getAdmin($admin_id)

    {

        $this->db->from('mst_admin');

        $this->db->where('int_glcode ', $admin_id);

        return $this->db->get()->row();
    }



    /**

     * hash_password function.

     * 

     * @access private

     * @param mixed $password

     * @return string|bool could be a string on success, or bool false on failure

     */

    private function hash_password($password)

    {

        return password_hash($password, PASSWORD_BCRYPT);
    }

    /**

     * verify_password_hash function.

     * 

     * @access private

     * @param mixed $password

     * @param mixed $hash

     * @return bool

     */

    private function verify_password_hash($password, $hash)

    {

        return password_verify($password, $hash);
    }
}
