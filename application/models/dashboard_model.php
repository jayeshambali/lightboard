<?php if (! defined ( "BASEPATH" )) exit ( "No direct script access allowed" );

/**
 * Model class to manage the database table : cell
 *
 *
 *  
 *
 * @author Jayesh
 */
class Dashboard_model extends MY_Model{

        /**
	 *	Define table attributes
	 */
	public $db_table 	   = "cellinfo";
	public $primary_key	   = "cellid";
     



	/**
	 *	Define all valid columns
	 */
	public $valid_columns = array(
                                        "cellid",			// int(11)
                                        "userid",		// varchar(255)
                                        "color",             // varchar(255
                                       
	);
        public function  __construct() {
            parent::__construct();
        }
        // --------------------------------------------------------------------
	// CREATE METHODS
	// --------------------------------------------------------------------

	/**
	 *	method to create a new cell
	 *
	 *	@param	array	An assoc array of data
	 *	@return	int   The new cellid
	 */
	public function create_new_cell($data = array())
	{
		return $this->insert_data($data);
	}

	// --------------------------------------------------------------------
	// GET METHODS
	// --------------------------------------------------------------------

	/**
	 *	method to get a all cells
	 *
	 *	@author	jayesh
	 *
	 *	@return	array	The array of data, or false if not found
	 */
	public function get_all_cells()
	{
		$this->db->from($this->db_table);
		$query = $this->db->get();

		/** / // For debugging.
		$this->dbg->last_query($this->db);
		$this->dbg->display($query->result_array()); exit;
		/**/

		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		} else {
			return FALSE;
		}
	}

	// --------------------------------------------------------------------

	/**
	 *	method to get a single cell by cellid
	 *
	 *	@author	jayesh
	 *
	 *	@param	int The cellid
	 *	@return	array	The array of data, or false if not found
	 */
	public function get_cell_by_id($cellid)
	{
		$this->db->from($this->db_table);
		$this->db->where("cellid", (int) $cellid);
		$query = $this->db->get();

		/** / // For debugging.
		$this->dbg->last_query($this->db);
		$this->dbg->display($query->result_array()); exit;
		/**/

		if ($query->num_rows() == 1)
		{
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
	 *	method to update a cell
	 *
	 *	@author	jayesh
	 *
	 *	@param	int The cell id
	 *	@param	array	An assoc array of data
	 * 	@return boolean	True on success, false on failure
	 */
	public function set_cell_data($cellid, $data = array())
	{
		$where = array(
			"cellid" => (int) $cellid
		);
		return $this->set_data($where, $data);
	}

	
        // --------------------------------------------------------------------
	// DELETE METHOD
	// --------------------------------------------------------------------

	/**
	 *	method to delete a cell
	 *
	 *	@return	int   The cellid
	 */
	public function delete_cell($cellid)
	{
		$this->db->where('cellid', $cellid);
                $this->db->delete($this->db_table);
                return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}
       

        
}
?>
