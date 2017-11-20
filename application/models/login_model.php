<?php if (! defined ( "BASEPATH" )) exit ( "No direct script access allowed" );

/**
 * Model class to manage the database table : user
 *
 *
 *
 *
 * @author Jayesh
 */
class Login_model extends MY_Model {

    /**
     *	Define table attributes
     */
    public $db_table 	   = "users";
    public $primary_key	   = "userid";




    /**
     *	Define all valid columns
     */
    public $valid_columns = array(
            "userid",		// int(11)
            "username",		// varchar(255)
            "password",             // varchar(255
            "lock",                  //tinyint
            "locktime"   //datetime

    );
    public function  __construct() {
        parent::__construct();
    }
    // --------------------------------------------------------------------
    // CREATE METHODS
    // --------------------------------------------------------------------

    /**
     *	method to create a new user
     *
     *	@param	array	An assoc array of data
     *	@return	int   The new userid
     */
    public function create_new_user($data = array()) {
        return $this->insert_data($data);
    }

    // --------------------------------------------------------------------
    // GET METHODS
    // --------------------------------------------------------------------

    /**
     *	method to get a all users
     *
     *	@author	jayesh
     *
     *	@return	array	The array of data, or false if not found
     */
    public function get_all_users() {
        $this->db->from($this->db_table);
        $query = $this->db->get();

        /** / // For debugging.
         $this->dbg->last_query($this->db);
         $this->dbg->display($query->result_array()); exit;
         /**/

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return FALSE;
        }
    }

    // --------------------------------------------------------------------

    /**
     *	method to get a single user by userid
     *
     *	@author	jayesh
     *
     *	@param	int The userid
     *	@return	array	The array of data, or false if not found
     */
    public function get_user_by_id($userid) {
        $this->db->from($this->db_table);
        $this->db->where("userid", (int) $userid);
        $query = $this->db->get();

        /** / // For debugging.
         $this->dbg->last_query($this->db);
         $this->dbg->display($query->result_array()); exit;
         /**/

        if ($query->num_rows() == 1) {
            $data = $query->result_array();
            return $data[0];
        } else {
            return FALSE;
        }
    }

    // --------------------------------------------------------------------
    // SET METHODS
    // --------------------------------------------------------------------

    /**
     *	method to update a user
     *
     *	@author	jayesh
     *
     *	@param	int The user id
     *	@param	array	An assoc array of data
     * 	@return boolean	True on success, false on failure
     */
    public function set_user_data($userid, $data = array()) {
        $where = array(
                "userid" => (int) $userid
        );
        return $this->set_data($where, $data);
    }


    // --------------------------------------------------------------------
    // DELETE METHOD
    // --------------------------------------------------------------------

    /**
     *	method to delete a user
     *
     *	@return	int   The userid
     */
    public function delete_user($userid) {
        $this->db->where('id', $userid);
        $this->db->delete($this->db_table);
        return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
    }
    // --------------------------------------------------------------------
    // VALIDATING USER METHOD
    // --------------------------------------------------------------------
    /**
     *	method to check whether a user is exists in system or not
     *
     *	@author	jayesh
     *
     *	@param	int The user id
     *	@param	array	An assoc array of data
     * 	@return boolean	True on success, false on failure
     */
    public function validate_user_credentials($username, $password ) {
        //echo "sdfsdf";
        $conditions = array('LOWER(username)'=> $username, 'password' => md5($password));
        $this->db->select($this->db_table.'.userid,'.$this->db_table.'.username,'.$this->db_table.'.password,');
        $this->db->from($this->db_table);
        $this->db->where($conditions);
        $query = $this->db->get();
        //echo '<pre>';
        //print_r($query); exit;
        if ($query->num_rows() == 1) {
            $data = $query->result_array();
            //echo '<pre>'; print_r($data);
            return $data;
        } else {
            return FALSE;
        }

    }

}
?>
