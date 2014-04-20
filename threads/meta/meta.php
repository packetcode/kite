<?php
/*	KITE 			- A NANO PHP MVC FRAMEWORK
 *	package 		- root
 *	file 				- index.php
 * 	Developer 	- Krishna Teja G S
 *	Website		- http://www.packetcode.com/projects/kite
 *	license			- GNU General Public License version 2 or later
*/
defined('_KITE') or die;

class threadMeta
{
	public function main()
	{
		$kite = Kite::getInstance('kite');
		$node = Kite::GetInstance('node');
		//$check = $node->get('n1');
		//if($check == 'about')
		$kite->set('meta_title','abc');
	}
}

?>

