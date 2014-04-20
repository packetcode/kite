<?php
/*	KITE 			- A NANO PHP MVC FRAMEWORK
 *	package 		- root
 *	file 			- index.php
 * 	Developer 		- Krishna Teja G S
 *	Website			- http://www.packetcode.com/projects/kite
 *	license			- GNU General Public License version 2 or later
*/
defined('_KITE') or die;

class clipInterface
{

	public function _arrayMenuListing($arr,$path){
		$item = '';
		$pat = $path;
		foreach($arr as $a =>$b)
			if(is_array($b))
			{	
				$pat = $path.'/'.$a;
				$item=$item."<b class='menu_dir_name'><i class='fa fa-folder-open-o'></i> ".$a."</b>";
				$item=$item."<ul class='menu_dir_list' >".$this->_arrayMenuListing($b,$pat)."</ul>";
				$pat = $path;
			}
			else
			{
				$valid = array('php','json','js','html','css');
				$file_ext = $this->_extension($b);
				if(in_array($file_ext, $valid))
				$item=$item."<li class='menu_dir_item' url ='".$pat.'/'.$b."'><i class='fa fa-file-o'></i> ".$b."</li>";	
				else
				$item=$item."<li class='menu_dir_item invalid' url ='".$pat.'/'.$b."' ><i class='fa fa-file-o'></i> ".$b."</li>";					
			}
			return $item;	
	}

	public function menuListing($arr,$path){
		$a = "<ul class='menu_dir_list'><b class='menu_dir'>
		<i class='fa fa-caret-square-o-up'></i> $path</b><br> 
		".$this->_arrayMenuListing($arr,$path)."</ul>";
		return  $a;
	}

	public function _extension($file_name){
		return substr(strrchr($file_name,'.'),1);
	}

}