<?php
/*
** KITE - A NANO PHP MVC FRAMEWORK
** Author - Krishna Teja G S
** website - packetcode.com
*/
defined('_KITE') or die;
//package - apps/pages/controllers/root.php
// Pages application class
class PagesControllerNew
{

	function main()
	{
		
		echo "new main";
	}
	
	function about()
	{
		$node = kite::getInstance('node');
		$o1=$node->get('o1');
		var_dump($node);
		$route = kite::route('pages/new/about/teja/raja/bcd/obd');
		echo $route."<br>";
		if($o1)
			echo $o1;
		else	
		echo "new about";
	}
	
	function services()
	{
		
		echo "new services";
	}
	
	function contact()
	{
		KITE::render('contact');
	}

}


?>
