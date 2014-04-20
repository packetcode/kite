<?php
/*
** KITE - A NANO PHP MVC FRAMEWORK
** Author - Krishna Teja G S
** website - packetcode.com
*/
defined('_KITE') or die;
//package - app/config/sql.php
//This is used to intereact with database

class MathHooks{

		public function add()
		{
			$this->controller ="root";
			$this->method= "addition";
		}
		
		public function subtract()
		{
			$this->controller ="root";
			$this->method= "subtraction";
		}
}
?>