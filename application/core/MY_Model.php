<?php

/**
 * Description of MY_Model
 *
 * @author Jayesh
 */
class MY_Model extends CI_Model {

        public $db_table 	= "";
	public $current_table 	= "";
	public $table_prefix 	= "";
	public $primary_key 	= "";
	public $valid_columns	= array();

	/*
	*	Pagination variables
	*/
	public $pagination_total_rows = 0;
	public $pagination_num_rows = 0;

	// --------------------------------------------------------------------

	/**
	 *	PM_Model class constructor.
	 *
	 *	@author	jayesh ambali
	 */
	public function __construct() {
            parent::__construct();
        }

	// --------------------------------------------------------------------
	// CREATE METHODS
	// --------------------------------------------------------------------

	/**
	 * 	generic method to handle inserting a new record
	 *
	 *	@author	jayesh ambali
	 *
	 *	@param	array 	The assoc array of data to insert
	 * 	@return mixed	The last insert id or False on failure
	 */
	public function insert_data($data = array(), $alternate_table = NULL) {
            // insert only valid columns
            foreach($data as $key => $value) {
                if (in_array($key, $this->valid_columns)) {
                    $this->db->set($key, $value);
                }
            }

            $table = ($alternate_table) ? $this->prefix_table($alternate_table) : $this->prefix_table($this->db_table) ;

            if (! $this->db->insert($table) ) {
                return FALSE;
            }

            return $this->db->insert_id();
        }

	// --------------------------------------------------------------------
	// GET METHODS
	// --------------------------------------------------------------------

	/**
	 * 	generic method to count the number of records in a table
	 *
	 *	@author	jayesh ambali
	 *
	 * 	@return int		The number of records
	 */
	public function count_records() {
            return $this->db->count_all($this->prefix_table($this->db_table));
        }

	/**
	 * 	generic method to handle getting a single record's data
	 *
	 *	@author	jayesh ambali
	 *
	 * 	@param 	int		The primary key's $id
	 * 	@return boolean
	 */
	public function get_data_by_id($id) {
            $this->db->from($this->prefix_table($this->db_table));
            $this->db->where($this->primary_key, (int) $id);

            $query = $this->db->get();
            $this->query_num_rows = $query->num_rows;

            /** / // For debugging.
             $this->dbg->last_query($this->db);
             $this->dbg->display($query->result_array()); exit;
             /**/

            if ($this->query_num_rows == 1) {
                $data = $query->result_array();
                return $data[0];
            } else {
                return false;
            }
        }

	// --------------------------------------------------------------------
	// SET METHODS
	// --------------------------------------------------------------------

	/**
	 * 	generic method to handle updating a single record's data
	 *
	 *	@author	jayesh ambali
	 *
	 * 	@param 	array	An array of name=value pairs for the where clause
	 *	@param	array 	The assoc array of data to update
	 *	@param	bool 	Set to True to enable the table prfix (default), Set to False to disable the table prefix
	 * 	@return boolean	True on success, false on failure
	 */
	public function set_data($where, $data = array(), $set_prefix = TRUE) {
            // update only valid columns
            $valid_data = array();
            foreach($data as $key => $value) {
                if (in_array($key, $this->valid_columns)) {
                    $valid_data[$key] = $value;
                }
            }

            $_table_name = ($set_prefix) ? $this->prefix_table($this->db_table) : $this->db_table;

            if (! $this->db->update($_table_name, $valid_data, $where) ) {
                return FALSE;
            }

            return TRUE;
        }

	// --------------------------------------------------------------------
	// HELPER METHODS
	// --------------------------------------------------------------------

	/**
	 *	get the table with its prefix
	 *
	 *	@param	string	The table name
	 *	@return	string	The table_prefix.table_name
	 */
	public function prefix_table($table) {
            $retval = $table;
            if ($this->table_prefix) {
                $retval = $this->table_prefix.$table;
            }
            return $retval;
        }

	// --------------------------------------------------------------------
}
?>
