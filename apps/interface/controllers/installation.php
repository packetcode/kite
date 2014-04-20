<?php
/*	KITE 			- A NANO PHP MVC FRAMEWORK
 *	package 		- lib/installer
 *	file 				- installer.php
 * 	Developer	 	- Krishna Teja G S
 *	Website		- http://www.packetcode.com/projects/kite
 *	license			- GNU General Public License version 2 or later
*/

//class used in installing the database and setting the configuration
class InterfaceControllerInstallation{

	
	public function main()
	{
		$request = Kite::getInstance('request');
		$request->tmpl = 'interface';
		
		if(isset($_POST['host']))
		{
			$db_name = $_POST['db_name'];
			$host = $_POST['host'];
			$user =$_POST['username'];
			$pass = $_POST['password'];
			
			$model = kite::getModel('install');
			$model->createDB($db_name,$host,$user,$pass);
			$model->updateConfig($db_name,$host,$user,$pass);
			$model->appDBTables();
			
			Kite::render('success');
		}	
		else{
			Kite::render('setup');
		}
	}
	
	function checkInstallationSettings()
	{
		$request = kite::getInstance('request');
		$app = $request->get('app');
		$file = 'apps'.DS.$app.DS.'settings.json';
			if(file_exists($file))
			{
				$setting = json_decode(file_get_contents($file));
				foreach($setting as $key =>$value)
				if($key=='APP')
				{
					if($value->INSTALLATION=='0')
					{
						$basket = Kite::getInstance('basket');
						$basket->set('installation','0');
						return 0;
					}else
					{
						$basket = Kite::getInstance('basket');
						$basket->set('installation','1');
						return 1;
					}
				}		
			}			
	}
	
	function updateInstallationSettings()
	{
		$request = kite::getInstance('request');
		$app = $request->get('app');
		$file = 'apps'.DS.$app.DS.'settings.json';
		$setting = json_decode(file_get_contents($file));
		$setting->APP->INSTALLATION = 1;		
		file_put_contents($file, json_encode($setting));
		$basket = Kite::getInstance('basket');
		$basket->set('update_installation','1');
	}
	
}
?>