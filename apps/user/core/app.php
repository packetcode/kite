<?php
/*
** KITE - A NANO PHP MVC FRAMEWORK
** Author - Krishna Teja G S
** website - packetcode.com
*/
defined('_KITE') or die;
//package - app/config/sql.php
//This is used to intereact with database

class UserApp{

		public function data()
		{
			$this->NAME= "Pages";		
			$this->DESC="This is a simple mathematics application which performs addition,subtraction,multiplication and division";
			$this->AUTHOR="Krishna Teja";
			$this->EMAIL= "shaadomanthra@yahoo.com";
			$this->WEBSITE="http://www.packetcode.com";
			$this->VERSION="1.1";
			return $this;
		}
				
		public function css()
		{
			$this->css->a = 'lib/font-awesome/css/font-awesome.min.css';
		}
		
		public function dependencies()
		{
			$this->dependency = array( "pages","math","login");
		}
		
		public function sql()
		{
			$this->create = array("CREATE TABLE #prefix_pages
													( id INT NOT NULL AUTO_INCREMENT, operation VARCHAR(20),
													a INT , b  INT,result INT,time_stamp   datetime , primary key ( id ));"
											);
		    $this->insert	 = array("INSERT INTO #prefix_pages 
												(operation,a,b,time_stamp) 
												VALUES('add',5,10,'2013-10-16 19:11:12');"
											);	
		}
}
?>