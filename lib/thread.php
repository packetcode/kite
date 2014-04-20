<?php
/*	KITE 			- A NANO PHP MVC FRAMEWORK
 *	package 		- lib
 *	file 				- packet.php
 * 	Developer 	- Krishna Teja G S
 *	Website		- http://www.packetcode.com/projects/kite
 *	license			- GNU General Public License version 2 or later
*/
defined('_KITE') or die;
// The packet object is used to carry data from snippet to view

class Thread{

	public function run($checkpoint)
	{
		$this->CHECKPOINT = $checkpoint;
		
		//execute Global 
		$this->_threadExecute('global');
		//execute checkpoint
		$this->_threadExecute($checkpoint);
		
		//execute app specific threads
		if($checkpoint!='first')
		{
			$appl = Kite::getInstance('application');
			$app = $appl->APPLICATION;
			$file = 'apps'.DS.$app.DS.'core'.DS.'checkpoints'.DS.$checkpoint.'.json';
			if(file_exists($file))
			{
				$cp = json_decode(file_get_contents($file));
				foreach($cp as $key => $value)
				{
					
					$file =  'threads'.DS.$value.DS.$value.'.php';
					if(file_exists($file))
					{
						if(!class_exists($value))
							require_once $file;
						$threadName = 'thread'.$value;
						$this->thread = $value;
						$threadObj = new $threadName();
						$threadObj->main();
					}
				}
			}
		}
		
	}
	
	function _threadExecute($checkpoint)
	{
		$file = 'threads'.DS.'_checkpoints'.DS.$checkpoint.'.json';
		if(file_Exists($file))
		{
		$cp = json_decode(file_get_contents($file));
		foreach($cp as $key => $value)
		{
			$file =  'threads'.DS.$value.'.php';
			if(file_exists($file))
			{
			if(!class_exists($value))
				require_once $file;
			$threadName = 'thread'.$value;
			$this->thread = $value;
			$threadObj = new $threadName();
			$threadObj->main();
			}
		}
		}
	}
	
	//function to store the values to object variables
		public function set($key,$value)
		{
			$key = strtoupper($key);
			$this->$key = $value;
		}
		
		//function to retrieve the data from object varaibles
		public function get($key)
		{
			$key = strtoupper($key);
			if(isset($this->$key))
				return $this->$key;
			else
				return null;
		}
	
}
?>