<?php
/*	KITE 			- A NANO PHP MVC FRAMEWORK
 *	package 		- clips/
 *	file 			- timeago.php
 * 	Developer 		- Krishna Teja G S
 *	Website			- http://www.packetcode.com/projects/kite
 *	license			- GNU General Public License version 2 or later
*/
defined('_KITE') or die;

class clipTime
{

	function sqlDateTime(){
		return date("Y-m-d H:i:s"); 
	}

	function sqlTimeAgo($date){
		$time = strtotime($date);
		return $this->timeAgo($time);
	}
	
	function timeAgo($tm,$rcs = 0) {
	   $cur_tm = time(); $dif = $cur_tm-$tm;
	   $pds = array('second','minute','hour','day','week','month','year','decade');
	   $lngh = array(1,60,3600,86400,604800,2630880,31570560,315705600);
	   for($v = sizeof($lngh)-1; ($v >= 0)&&(($no = $dif/$lngh[$v])<=1); $v--); if($v < 0) $v = 0; $_tm = $cur_tm-($dif%$lngh[$v]);

	   $no = floor($no); if($no <> 1) $pds[$v] .='s'; $x=sprintf("%d %s ",$no,$pds[$v]);
	   if(($rcs == 1)&&($v >= 1)&&(($cur_tm-$_tm) > 0)) $x .= time_ago($_tm);
	   return $x;
	}
	
}