<?php
/*	PATHANG			- A SLEAK PHP MVC FRAMEWORK
 *	package 		- lib
 *	file 			- basket.php
 * 	Developer	 	- Krishna Teja G S
 *	Website			- http://www.pathang.net
 *	license			- GNU General Public License version 2 or later
*/

// The basket object is used to carry data to the view
// any data extracted from database is stored in basket object
defined('_KITE') or die;

class user{

	function get($key)
	{
		$session = kite::getInstance('session');
		$session->start();
		$user = $session->get('user');
		if($user)
			if(isset($user->$key))
			return $user->$key;
			else
				return null;
		else
			return null;
	}
}
?>