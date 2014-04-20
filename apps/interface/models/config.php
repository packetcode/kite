<?php
defined('_KITE') or die;

class InterfaceModelConfig{

	// function to update the configuration file config.json
	function updateConfig()
	{
		$config = json_decode(file_get_contents('config.json'));
		$request = Kite::getInstance('request');		
			
		// Set the Secure hash 		
		$shash = $request->get('SHASH');
		if($shash != 'empty')
		{
			$config->SHASH = md5($request->get('SHASH'));	
			unset($request->SHASH);
		}	
		if(isset($request->TASK))
		unset($request->TASK);
		
		// set the data from request to config 	
		foreach($config as $key => $value)
		if($key !='SHASH')
		{
			$config->$key = $request->get($key);
		}

		// write the content to config file
		file_put_contents('config.json', kite::prettyJson($config));
	}

	//function to set the installation in config file to '1'
	public function updateConfigInstall()
	{
		$config = json_decode(file_get_contents('config.json'));
		$config->INSTALLATION = 1;
		file_put_contents('config.json', json_encode($config));
	}
}
