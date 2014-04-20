<?php
defined('_KITE') or die;

class InterfaceControllerThemes{

	public function __construct(){
		$session = Kite::getInstance('session');
		$request = kite::getInstance('request');
		$url = $request->get('url');
		$shash=$session->get('hash');
		$route = ROOT.kite::route('interface/root/login');
		if(!$shash)
		{
			$session->set('back_url',$url);
			kite::redirect($route);
		}
			
	}
	public function main()
	{
		$basket = Kite::getInstance('basket');
		$kite = kite::GetInstance('kite');
		$node = Kite::getInstance('node');
		$o1 = $node->get('o1');
		if($o1)
		{
			$this->_showTheme($o1);
		}else{
		$themes =  $this->_dir('themes');
		$temp = '';
		foreach($themes as $key => $value)
		{
			$config = 'themes/'.$value.'/config.json';
			
			$root = 'routes/node_routes/root.json';
			$rootjson = json_decode(file_get_contents($root));
			$configjson = json_decode(file_get_contents($config));
			$temp->$key->NAME = $configjson->NAME;
			$temp->$key->AUTHOR = $configjson->AUTHOR;
			$temp->$key->DESC= $configjson->DESC;
			$temp->$key->WEBSITE = $configjson->WEBSITE;
			$temp->$key->VERSION = $configjson->VERSION;
			$temp->$key->ALIAS = $value;
			if($rootjson->THEME ==$value)
				$temp->$key->DEFAULT = 'yes';
			else
				$temp->$key->DEFAULT = 'no';
		}
		$basket->set('themes',$temp);
		kite::render('themes');
		}
	}

	public function _dir($dir)
	{
		 if (is_dir($dir)) {
            $files = scandir($dir);
			$i=0;
            foreach ($files as $file)
			{
				$i=$i+1;
				$a = 'a'.$i;
                if ($file != "." && $file != "..") 
					$item->$a = $file;
            }
        }
		return $item;
	}

	public function _rec_dir($dir,$list=null)
	{
		$list=array();

		 if (is_dir($dir)) {
            $files = scandir($dir);
			$i=0;
			unset($files[0]);
			unset($files[1]);
            $files = $this->fsort($dir,$files);
			if($files)
            foreach ($files as $file)
			{
				$i=$i+1;
				$a = 'a'.$i;
				if(is_dir($dir.'/'.$file))
				{
					$list [$file]= $this->_rec_dir($dir.'/'.$file);
				//	$list->$dir->$i = $this->_rec_dir($dir.'/'.$file);
				}else{
					
				$list[$i] = $file;
				}
            }
		}	
        return $list;
	}
	
	public function fsort($path,$arr)
	{
		foreach($arr as $a => $b)
			if(is_dir($path.'/'.$b))
			{
				$d->$a = $b;
			}else
			{
				$f->$a = $b;
			}
		$i = 0;
		if(isset($d))
		foreach($d as $a=>$b){
			$items[$i] = $b;	
			$i=$i+1;
		}
		if(isset($f))
		foreach($f as $a => $b){
			$items[$i]=$b;
			$i=$i+1;
		}
		if(isset($items))
		return $items;		
	}
	public function _showTheme($theme)
	{
			$basket = kite::GetInstance('basket');
			$config = 'themes/'.$theme.'/config.json';
			$dir= 'themes/'.$theme;
			if(!file_exists($dir))
				Error::message('Theme not found');
			if(file_exists($config))
			{
			$configjson = json_decode(file_get_contents($config));
			$temp->NAME = $configjson->NAME;
			$temp->AUTHOR = $configjson->AUTHOR;
			$temp->DESC= $configjson->DESC;
			$temp->WEBSITE = $configjson->WEBSITE;
			$temp->VERSION = $configjson->VERSION;
			$temp->ALIAS = $theme;
			$basket->set('theme',$temp);
			}
			// $a=$this->directoryToArray($dir,true);
			 //foreach($a as $key => $value)
			 	//$a[$key] = str_replace($dir."/","",$value);
			 //var_dump($a);
			$list = $this->_rec_dir($dir);

			$menu = kite::getClip('Interface')->MenuListing($list,$dir);
			$basket->set('menu',$menu);

			$params= 'themes/'.$theme.'/params.json';
			if(file_exists($params))
			{
			$paramsjson = json_decode(file_get_contents($params));
			$basket->set('params',$paramsjson);
			}
			kite::render('themes','specific');
	}
	

	public function paramsave(){
		$request = kite::getInstance('request');
		$theme = $request->get('theme');
		$basket = kite::getInstance('basket');
		unset($request->THEME);
		unset($request->URL);
		$file='themes/'.$theme.'/params.json';
		if(file_exists($file)){
			file_put_contents($file, kite::prettyJson($request));
			$basket->set('param_save',true);
		}
		else
			$basket->set('param_save',false);
		$this->_showTheme($theme);
	}

}

?>