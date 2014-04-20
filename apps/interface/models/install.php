<?php
defined('_KITE') or die;

class InterfaceModelInstall{


	public function createDB($db_name,$host,$user,$pass)
	{
			try {
				$db = new PDO("mysql:host=$host", $user, $pass);
				$db->exec("CREATE DATABASE `$db_name`;") 
				or die(print_r($db->errorInfo(), true));
			} catch (PDOException $e) {
				die("DB ERROR: ". $e->getMessage());
			}	
	}	

	function appDBTables()
	{
		$apps = array_diff(scandir('apps'), array('.', '..'));
		foreach ($apps as $app)
		{
			$request = kite::getInstance('request');
			$request->app = $app;
			$this->createTables();
		}	
			
		$this->updateConfigInstall();
	}
	
	function createTables()
	{
		$request = kite::getInstance('request');
		$app = $request->get('app');
		$db = kite::getInstance('pdo');
		$config = json_decode(file_get_contents('config.json'));	
		$file = 'apps'.DS.$app.DS.'settings.json';
			if(file_exists($file))
			{
				$setting = json_decode(file_get_contents($file));
				$table_prefix = $config->DB->PREFIX.'_'.$app.'_';
				foreach($setting as $key =>$value)
				if($key=='DB')
					foreach($value as $table =>$stmt)
					{
						$words = explode(' ', $stmt);
						$stmt_new='';
						foreach($words as $key=>$word)
						{
							if (substr($word, 0, 8) == "#prefix_")
							{
								$word = str_replace('#prefix_', '', $word);
								$table = $table_prefix.$word;
								$words[$key] =  $table;
							}	
							$stmt_new = $stmt_new.' '.$words[$key];
						}	
						$db->exec($stmt_new);
					}	
			}		
		$basket = Kite::getInstance('basket');
		$basket->set('create_tables','1');
	}
	
	function updateConfig($db_name,$host,$user,$pass)
	{
		$root= 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
		
		$config = json_decode(file_get_contents('config.json'));
		$request = Kite::getInstance('request');
		
		// Site Information
		$config->SITE->TITLE = $request->get('title');
		$config->SITE->AUTHOR = $request->get('author');
		$config->SITE->DESC = $request->get('desc');
		$config->SITE->KEYWORDS = $request->get('keywords');
		$config->SITE->ROOT = $root;
		$config->SITE->HASH = substr(md5(rand()), 0, 7);
		
		//Database information
		$config->DB->DB_NAME = $db_name;
		$config->DB->HOST = $host;
		$config->DB->USERNAME = $user;
		$config->DB->PASSWORD = $pass;
		$config->DB->PREFIX = substr(md5(rand()), 0, 3);

		file_put_contents('config.json', json_encode($config));
	}

	public function updateConfigInstall()
	{
		$config = json_decode(file_get_contents('config.json'));
		$config->SITE->INSTALLATION = 1;
		file_put_contents('config.json', json_encode($config));
	}
}

?>