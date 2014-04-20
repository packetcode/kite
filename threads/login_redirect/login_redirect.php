<?php
/*	KITE 			- A NANO PHP MVC FRAMEWORK
 *	package 		- root
 *	file 				- index.php
 * 	Developer 	- Krishna Teja G S
 *	Website		- http://www.packetcode.com/projects/kite
 *	license			- GNU General Public License version 2 or later
*/
defined('_KITE') or die;

class threadLogin_redirect
{
	public function main()
	{
		$session = kite::getInstance('session');
		$session->start();
		$user = $session->get('user');
		$path = kite::route('interface/root/login');
		$path_site_login = kite::route('user/core/login');
		$node = kite::getInstance('node');
		$url = '';
		for($i=1;$i<5;$i++)
		{
			$n = 'N'.$i;
			if(!isset($node->$n))
				break;
				$nd = $node->$n;
			$url = $url.$nd.DS;
		}
		
		if(substr($url , 0, 5 ) == substr($path , 0, 5 ))
		if($url != $path)
		{
			if(substr($url , 0, 10 ) == substr($path , 0, 10 ))
				$session->clear('back_url');
			if(substr($url , 0, 5 ) != substr($path , 0, 5 ))
				$session->set('back_url',$url);
			if(!$user)
					kite::redirect(ROOT.$path);
		}
	}
	
	public function _redirect($path)
	{
		
	}
	
}

?>

