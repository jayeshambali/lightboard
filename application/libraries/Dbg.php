<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 *	A class to make debugging much easier.
 *
 *	@author	jayesh ambali
 */
class Dbg 
{	 
	// --------------------------------------------------------------------
	
	/**
	 */
	public $dbg_queue = array();
	
	// --------------------------------------------------------------------
	
	/**
	 *	Constructor - Setup CI instance and log a message.
	 *
	 *	@author	jayesh ambali
	 */
	public function __construct ()
	{
		$this->CI =& get_instance();
		log_message('debug', "Dbg Class Initialized");	
	}
	
	// --------------------------------------------------------------------
	
	/**
	 *	Method to display an object, array, or variable to the screen for debugging purposes.
	 *
	 *	@author	jayesh ambali
	 *
	 *	@param	var		An object, an array, or a variable
	 *	@output	string	Echo output to the screen
	 */
	public function display($obj)
	{
		echo "<pre style=\"color:red;\">";	
		if (is_bool($obj)) {
			$bool_val = ($obj) ? 'true' : 'false' ;
			echo "[bool] = $bool_val\n";
		} else {
			echo $this->parse($obj);
		}
		echo "</pre>";	
	}
	
	// --------------------------------------------------------------------
	
	/**
	 *  Method to add debug data to the queue
	 *	@author jayesh ambali
	 */
	public function queue($key, $obj, $file = "", $line = "", $class = "", $method = "")
	{		
		$this->dbg_queue += array($key => array($obj,$file,$line,$class,$method));
	}
		 
	// --------------------------------------------------------------------
	
	/**
	 * 	Method to parse the string representation of this object.
	 *
	 *	@author	jayesh ambali
	 *
	 * 	@return  The string representation of this object.
	 */
	public function parse($obj)
	{
		$retval = "";
		global $__level_deep;
		
		if (!isset($__level_deep)) {
			$__level_deep = array();
		}
		
		if (is_object($obj)) {
			$retval .= print_r($obj, true);
		} elseif (is_array($obj)) {
			foreach(array_keys($obj) as $keys) {
				if ($keys == "0" || intval($keys)) {
					array_push($__level_deep,"[".$keys."]");
				} else {
					array_push($__level_deep,"[\"".$keys."\"]");
				}
				$retval .= $this->parse($obj[$keys]);
				array_pop($__level_deep);
			}
		} else {
			$retval .= implode("",$__level_deep)." = $obj\n";
		}
		return $retval;
	}
	
	// --------------------------------------------------------------------
	
	/**
	 *	Helper method to return the last query for debugging
	 *
	 *	@author	jayesh ambali	 
	 */	
	public function last_query($db)
	{
		$this->display(end($db->queries));
	}	
		 
	// --------------------------------------------------------------------
	
}
