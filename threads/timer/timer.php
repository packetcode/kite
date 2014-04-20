<?php
/*	KITE 			- A NANO PHP MVC FRAMEWORK
 *	package 		- root
 *	file 				- index.php
 * 	Developer 	- Krishna Teja G S
 *	Website		- http://www.packetcode.com/projects/kite
 *	license			- GNU General Public License version 2 or later
*/
defined('_KITE') or die;

class threadTimer
{
	public function main()
	{
		$thread = Kite::getInstance('thread');
		$checkpoint = $thread->get('checkpoint');
		$time =  microtime();
		$time= explode(' ',$time);
		$time= $time[1]+$time[0];
		$thread->timer->$checkpoint= $time;
		if($checkpoint=='last')
		{
			$last =0;
			foreach($thread->timer as $key => $value)
			{
				if($last==0)
				{
					$last = $value;
					$first = $value;
				}	
				$thread->laps->$key = $value-$last;
				$last = $value;
			}
			$thread->load_time = $last-$first;
			$this->display($thread);
		}
	}
	
	function display($thread)
	{
		var_Dump($thread);
	}
}

?>

