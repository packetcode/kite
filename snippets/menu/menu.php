<?php
/*	KITE 			- A NANO PHP MVC FRAMEWORK
 *	package 		- root
 *	file 				- index.php
 * 	Developer 	- Krishna Teja G S
 *	Website		- http://www.packetcode.com/projects/kite
 *	license			- GNU General Public License version 2 or later
*/


class snippetMenu
{
	
	public function main()
	{
		$params = kite::getInstance('packet')->getParams();
		if(!isset($params->TYPE))
			kite::display();
		else{
			kite::display($params->TYPE);
		}
		
	}
}

?>

