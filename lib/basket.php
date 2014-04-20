<?php
/*	KITE 			- A NANO PHP MVC FRAMEWORK
 *	package 		- lib
 *	file 				- basket.php
 * 	Developer 	- Krishna Teja G S
 *	Website		- http://www.packetcode.com/projects/kite
 *	license			- GNU General Public License version 2 or later
*/

// The basket object is used to carry data to the view
// any data extracted from database is stored in basket object
defined('_KITE') or die;

class basket{

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
	
}
?>