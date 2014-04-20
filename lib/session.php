<?php
/*	KITE 			- A NANO PHP MVC FRAMEWORK
 *	package 		- lib
 *	file 			- session.php
 * 	Developer 		- Krishna Teja G S
 *	Website			- http://www.packetcode.com/projects/kite
 *	license			- GNU General Public License version 2 or later
*/
defined('_KITE') or die;
// A class to store sessions

class session {
	
	
	public function __construct()
	{
		$this->start();
	}

	// function to start the session
	public function start()
	{
		
		if(session_id() == '') {
			session_start();
			session_regenerate_id(true);
		}
		
		if(isset($_SESSION['timeout']) ) {
			$session_life = time() - $_SESSION['timeout'];
			$expire = $_SESSION['expire'];
			if($session_life > $expire){
				$this->destroy(); 
			}
		}

		$kite = kite::getInstance('kite');
		$expire = $kite->get('SESSION_EXPIRE');
		self::expire($expire);
	}
	
	//function to set the session expire time
	public static function expire($time)
	{
		$_SESSION['timeout'] = time();
		$_SESSION['expire'] = $time;
	}

	
	// function to set the key and value in PHP session
	public static function set($key,$value)
	{
		$_SESSION[$key]=$value;
	}
	
	// function to retrieve the value based on key from PHP session
	public static function get($key)
	{
		if(isset($_SESSION[$key]))
			return $_SESSION[$key];
		else
			return null;
	}
	
	// function to clear the value of key in the session
	public static function clear($key)
	{
		if(isset($_SESSION[$key]))
		{
			unset($_SESSION[$key]);
			return true;
		}
		else
			return false;
	}
	
	// function to completely destroy the session
	public static function destroy()
	{
		session_unset();
		session_destroy();
	}

}
