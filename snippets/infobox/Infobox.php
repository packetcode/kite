<?php
/*	KITE 			- A NANO PHP MVC FRAMEWORK
 *	package 		- root
 *	file 				- index.php
 * 	Developer 	- Krishna Teja G S
 *	Website		- http://www.packetcode.com/projects/kite
 *	license			- GNU General Public License version 2 or later
*/


class snippetInfobox
{
	
	public function main()
	{
		$packet = kite::getInstance('packet');
		$kite= kite::getInstance('kite');
		$packet->version = $kite->SITE->VERSION;
		$packet->app = $kite->SITE->APP;
		$packet->theme = $kite->SITE->TMPL;	
		if($kite->SITE->SECURE == 0)
			$packet->secure = 'disabled';
		else
			$packet->secure = 'enabled';
		$packet->apps = $this->_count('apps');
		$packet->snippets = $this->_count('snippets');
		$packet->threads= $this->_count('threads');
		$packet->themes = $this->_count('themes');
		$packet->routes = $this->_count('routes/node_routes');
		Kite::display();
	}
	
	public function _count($dir)
	{
		 if (is_dir($dir)) {
            $files = scandir($dir);
			$i=0;
            foreach ($files as $file)
			{
                if ($file != "." && $file != "..") 
						$i=$i+1;
            }
        }
		return $i;
	}
}

?>

