<?php
/*	KITE 			- A NANO PHP MVC FRAMEWORK
 *	package 		- lib
 *	file 			- session.php
 * 	Developer 	- Krishna Teja G S
 *	Website		- http://www.packetcode.com/projects/kite
 *	license		- GNU General Public License version 2 or later
*/
defined('_KITE') or die;

// Error Class
 class Error{

	public static function _display()
	{
		$kite = kite::getInstance('kite');
		$theme = $kite->get('theme');
		$error= 'themes'.DS.$theme.DS.'defaults'.DS.'error.php';
		require_once $error;
		exit();
	}
	
	public static function show()
	{
		$basket = kite::getInstance('basket');
		$error = $basket->get('error');
		echo $error;
	}	
	public static function message($error)
	{
		$basket = kite::getInstance('basket');
		$basket->set('error',$error);
		self::_display();
	}
	
	public static function data($key)
	{
		$error = "Data defenition '".$key."' is not found";
		$basket = kite::getInstance('basket');
		$basket->set('error',$error);
		self::_display();
	}
		
	public static function restricted($key)
	{
		$error = "Restricted Access to '".$key."'";
		$basket = kite::getInstance('basket');
		$basket->set('error',$error);
		self::_display();
	}
	
	public static function undefined($key)
	{
		$error = "Definition  for '".$key."' is not found";
		$basket = kite::getInstance('basket');
		$basket->set('error',$error);
		self::_display();
	}

	public static function warning($key)
	{
		echo "<div class='warning'>".$key."</div>";
	}
	
 }
?>