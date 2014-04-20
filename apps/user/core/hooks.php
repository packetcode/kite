<?php
/*
** KITE - A NANO PHP MVC FRAMEWORK
** Author - Krishna Teja G S
** website - packetcode.com
*/
defined('_KITE') or die;
//package - app/config/sql.php
//This is used to intereact with database

class UserHooks{

		public function login()
		{
			$this->controller ="core";
			$this->method= "login";
		}
		
		public function getName()
		{
			$this->controller ="get";
			$this->method= "name";
		}
}
?>