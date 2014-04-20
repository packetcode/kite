<?php
/*	KITE 			- A NANO PHP MVC FRAMEWORK
 *	package 		- lib
 *	file 			- packet.php
 * 	Developer 		- Krishna Teja G S
 *	Website			- http://www.packetcode.com/projects/kite
 *	license			- GNU General Public License version 2 or later
*/
defined('_KITE') or die;
// The packet object is used to carry data from snippet to view

class packet{

		//function to store the values to object variables
		public function set($key,$value)
		{
			$key = strtoupper($key);
			$this->$key = $value;
		}
		
		//function to retrieve the data from object varaibles
		public function get($key)
		{
			$key = strtoupper($key);
			if(isset($this->$key))
				return $this->$key;
			else
				return null;
		}

		public function getParams($key=null)
		{
			$key = strtoupper($key);
			if($key==null)
				return $this->PARAMS;
			if(isset($this->PARAMS->$key))
				return $this->PARAMS->$key;
			else
				return null;
		}
	
}
?>