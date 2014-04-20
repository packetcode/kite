<?php
/*	KITE 			- A NANO PHP MVC FRAMEWORK
 *	package 		- lib
 *	file 				- request.php
 * 	Developer 	- Krishna Teja G S
 *	Website		- http://www.packetcode.com/projects/kite
 *	license			- GNU General Public License version 2 or later
*/
defined('_KITE') or die;
//stores the request parameters to request object

class request {

		
		//function to retrieve the data from object varaibles
		public function get($key)
		{
			$key = strtoupper($key);
			if(isset($this->$key))
				return $this->$key;
			else
				return null;
		}
		
		public function set($key,$value)
		{
			$key = strtoupper($key);
			$this->$key=$value;
		}

		public function clear($key){
			$key = strtoupper($key);
			unset($this->$key);
		}
	public function __construct()
	{
		foreach($_REQUEST as $key => $value)
		{
			$key = strtoupper($key);
			$this->$key= $value;
		}	
	}
	
	public function filterHTML($key)
	{
		$key = strtoupper($key);
		if(isset($this->$key))
		{
		$value = $this->$key;
		return htmlentities($value,ENT_COMPAT,'UTF-8');
		}else
			return null;
	}
	
	public function filterSQL($key)
	{
		$key = strtoupper($key);
		if(isset($this->$key))
		{
		$value = $this->$key;
		return filter_var($value, FILTER_SANITIZE_STRING);  
		}else
			return null;
	}
}