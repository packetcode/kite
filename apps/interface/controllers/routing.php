<?php
defined('_KITE') or die;

class InterfaceControllerRouting {
	
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
		self::listing();
	}
	
	public function add()
	{
		$kite = kite::getInstance('kite');
		kite::render('routing','default');
	}	
	
	public function show()
	{
		$request =kite::getInstance('request');
		$basket=kite::getInstance('basket');
		$route = $request->get('route');

		if($route==null)
			Error::message('Route not mentioned');
		if($request->get('def'))
			$this->_defaults();
		if($request->get('enable'))
			$this->_enable();
		$route_file = $request->get('route');
		$path = 'routes'.DS.'node_routes'.DS.$route;
		$json = json_decode(file_get_contents($path));
		foreach($json as $key => $value)
			$basket->$key = $value;

		//set the app route file
		$app_file = $json->APP_ROUTE_FILE;
		
		//check if its root file	
		if($route != 'root.json')
			$route = ltrim($route,'root');
		else
			$route = '.'.$route;
		
		$route = rtrim($route,'json');
		$route = rtrim($route,'.');

		$nodes = explode('.',$route);
		$node = '';
			
		foreach($nodes as $a => $b)
		if($a!=0)
			$node = $node.$b.'/';
		$node = rtrim($node,'/');
		
		//check if the route is default and update the basket
		$default = $this->_app_check_default($app_file,$route_file);

		$basket->set('route',$node);
		$basket->set('default',$default);		
		$basket->set('app_file',$app_file);	
		$basket->set('file', $request->get('route'));
		kite::render('routing','show','main');
	}

	public function edit()
	{
		$request =kite::getInstance('request');
		$basket=kite::getInstance('basket');
		$route = $request->get('route');
		$route_file = $request->get('route');
		$path = 'routes'.DS.'node_routes'.DS.$route;
		$json = json_decode(file_get_contents($path));
		foreach($json as $key => $value)
			$basket->$key = $value;
		
		$app_file = $json->APP_ROUTE_FILE;
			
		if($route != 'root.json')
			$route = ltrim($route,'root');
			else
				$route = '.'.$route;
		
			$route = rtrim($route,'json');
			$route = rtrim($route,'.');

			$nodes = explode('.',$route);
			$node = '';
			
			foreach($nodes as $a => $b)
			if($a!=0)
				$node = $node.$b.'/';

		//check if the route is default and update the basket
		$default = $this->_app_check_default($app_file,$route_file);

		$basket->set('route',$node);
		$basket->set('default',$default);		
		$basket->set('app_file',$app_file);	
		$basket->set('file', $request->get('route'));
		kite::render('routing','edit','main');
	}

	public function _app_check_default($app_file,$route_file)
	{
		$app_route_path = 'routes'.DS.'app_routes'.DS.$app_file;
		$app_route = json_decode(file_get_contents($app_route_path));
		
		$r = $app_route->R0;
		if($r ==null)
			return 'no';
		$rou = $app_route->$r;
		$route_check=$rou->NODE_ROUTE_FILE;
		$default = 'no';
		if($route_check == $route_file)
			$default = 'yes';
		return $default;
	}

	public function _app_route_r($app_file,$route_file)
	{
		$app_route_path = 'routes'.DS.'app_routes'.DS.$app_file;
		$app_route = json_decode(file_get_contents($app_route_path));
		foreach($app_route as $key => $value)
		{
			
			if(isset($value->route))
			{
				if($value->route == $route_file)
						return $key;
			}
				
		}
		
		return false;
	}
	
	public function put()
	{
		$request =kite::getInstance('request');
		$route = $request->get('route');
		$default = $request->get('default');
		$basket = kite::getInstance('basket');
		$actual_file = $request->get('file');
		$app_file = $request->get('app_file');
 	
		//empty error string to update the status of operation
		$error = '';

		if($request->get('route'))
		{

			$route = $request->get('route');
			$route = rtrim($route,'/');
			$fragments = explode('/',$route);
			$node_route_file = $actual_file;


			//set options
			if($request->get('options')){
			$options = $request->get('options');
			$opts = trim($options,'/');
			$frag = explode('/',$opts);
			foreach($frag as $a => $b)
			{
				$k = 'O'.($a+1);
				$request->$k = $b;
			}
			}


			if($request->get('options')){
				if(!$request->get('app_method'))
					Error::message('Controller or Method cannot be empty');
				if(!$request->get('app_controller'))
					Error::message('Controller or Method cannot be empty');
			}

		}
		else
			Error::data('route data');
			

		if($actual_file==null)
			Error::message('Route Update Paramters not defined properly');

		if($request->get('APP_APPLICATION') == null)
			Error::message('Route Update Paramters not defined properly');
			
		//loading the node routes and app routes
		$node_route_path = 'routes'.DS.'node_routes'.DS.$actual_file;
		$node_route = json_decode(file_get_contents($node_route_path));
		$app_route_path = 'routes'.DS.'app_routes'.DS.$app_file;
		$app_route = json_decode(file_get_contents($app_route_path));

		//check if any change is there in application controller or method
		$a = $this->_app_Change_Check('APP_APPLICATION',$request,$node_route);
		$c = $this->_app_Change_Check('APP_CONTROLLER',$request,$node_route);
		$m = $this->_app_Change_Check('APP_METHOD',$request,$node_route);
		$o = $this->_app_Change_Check('OPTIONS',$request,$node_route);


		
		$change = 0;
		if($a==1 || $c ==1)
			$change = 1;

		if($m==1 || $o ==1)
			$change = 1;

			foreach($request as $key => $value)
			{
				if($key != 'URL')
				if($key != 'FILE')
				if($key != 'APP_FILE')
				if($key != 'ROUTE')
				if($key != 'DEFAULT')	
				if($value !='')
				{
					if($key === 'THEME_R')
						$json_node->THEME = $value;
					elseif($key === 'LAYOUT_R')
						$json_node->LAYOUT = $value;
					else	
						$json_node->$key = $value;
				}
			}
			$json_node->ENABLE = $node_route->ENABLE;
			$json_node->APP_ROUTE_FILE = $node_route->APP_ROUTE_FILE;
		

		if($change == 1){


			//remove the trace in app_file
			foreach($app_route as $r => $s)
			{
				if(isset($s->NODE_ROUTE_FILE))
				if($s->NODE_ROUTE_FILE == $actual_file)
				{
					unset($app_route->$r);
					if($app_route->R0 == $r)
						$app_route->R0 = null;
					break;
				}
			}
		

			//var_dump($app_route);
			$k=0;
			foreach($app_route as $a)
			{
				$k = $k +1;
			}
			if($k == 1)
			{
				unlink($app_route_path);
			}else
			{
			$app_data = kite::prettyJson(json_encode($app_route));
			//var_Dump($app_data);
			file_put_contents($app_route_path, $app_data);
			}
		

			//form the filename with the available app information
			if($request->get('APP_APPLICATION') != null)
			{
				$file = $request->APP_APPLICATION;
				if($request->get('APP_CONTROLLER') !=null)
				{
					$file = $file.'.'.$request->APP_CONTROLLER;
					if($request->get('APP_METHOD') != null)
					{
						$file = $file.'.'.$request->APP_METHOD;
						for($i=1;$i<10;$i++)
						{
							$o = 'O'.$i;
							if($request->get($o) ==null)
								break;
							$file = $file.'.'.$request->$o;	
						}
					}	
				}
			}	
			$file = $file.'.json';
			$path = 'routes'.DS.'app_routes'.DS.$file;
			$app_route_file = $file;
			//echo $app_route_file;
			//update the actual file with the app route
			$json_node->APP_ROUTE_FILE =$app_route_file;
			// If the file already exists 
			if(file_exists($path))
			{
				$json = json_decode(file_get_contents($path));
				for($i=1;$i<10;$i++)
				{
					$r='R'.$i;
					if(!isset($json->$r))
						break;
				}
				foreach($fragments as $key => $value)
				{
					$key=$key+1;
					$n = 'N'.$key;
					$json->$r->$n = $value;
				}

				$json->$r->ENABLE =  $node_route->ENABLE;
				$json->$r->NODE_ROUTE_FILE =$node_route_file;
			}
			else
			{
				foreach($fragments as $key => $value)
				{
					$key=$key+1;
					$n = 'N'.$key;
					$json->R1->$n = $value;
				}
				$json->R1->ENABLE = '1';
				$json->R1->NODE_ROUTE_FILE =$node_route_file;
					$json->R0 ='R1';
			}		
			$data_app= kite::prettyJson(json_encode($json)); 	
			//var_Dump($data_app);
			file_put_contents($path, $data_app);
			

		}

		$data= kite::prettyJson(json_encode($json_node)); 	
		//var_dump($data);
		file_put_contents($node_route_path, $data);

		$basket->set('status',"Successfully <b>updated</b> route <b>/$route</b> $error");
		$basket->set('stype','success');

		$request->set('route',$actual_file);
		self::show();
	}
	
	public function _app_Change_Check($item,$request,$node_route)
	{
		$req =$request->get($item);
		if(isset($node_route->$item))	
		{	
			if($node_route->$item == $request->$item)
			{
				return 0;
			}
		}else
		{
			if(!$req)
				return 0;
		}

		return 1;
	}

	public function push()
	{
		// get request basic data
		$request =kite::getInstance('request');
		$action = $request->get('action');
		$actual_file = $request->get('file');
		$default = $request->get('default');
		$app_file = $request->get('app_file');
		
		//check if the route is properly defined
		//if defined form the possible json file name
		// else send a error 
		if($request->get('ROUTE'))
		{
			$route = $request->get('route');
			$route = rtrim($route,'/');
			$fragments = explode('/',$route);
			$file='root';
			foreach($fragments as $key=>$value)
			if($value!='root')
				$file = $file.'.'.$value;
			$file = $file.'.json';
			$node_route_file = $file;

			//set options
			
			if($request->get('options')){
			$options = $request->get('options');
			$opts = trim($options,'/');
			$frag = explode('/',$opts);
			foreach($frag as $a => $b)
			{
				$k = 'O'.($a+1);
				$request->$k = $b;
			}
			}
			
			if($request->get('options')){
				if(!$request->get('app_method'))
					Error::message('Controller & Method has to be defined before setting options');
				if(!$request->get('app_controller'))
					Error::message('Controller & Method has to be defined before setting options');
			}
				
		}
		else
			Error::data('route data');
		//if application not mentioned throw error
		if(!$request->get('APP_APPLICATION'))
			Error::data('Application route');
			
		// If the route definition is already defined then throw an error
		$path = 'routes'.DS.'node_routes'.DS.$file;
		if(file_exists($path))
		{
			Error::message('Route already exists, either update the route or create a unique route');
			exit();
		}
		
		// unset the values which are no required to be included
		foreach($request as $key => $value)
		{
			if($value ==null || $key == 'URL')
				unset($request->$key);
			if($key === 'ROUTE')	
				unset($request->$key);		
			if($key === 'ACTION')	
				unset($request->$key);		
			if($key === 'DEFAULT')	
				unset($request->$key);			
			
		}	
		
		//form the variables data string
		// to  protect from config defaults theme and layout are taken with suffix r
		foreach($request as $key => $value)
		{
			$a = strtoupper($key);
			if($a === 'THEME_R')
				$req->THEME = $value;
			elseif($a === 'LAYOUT_R')
				$req->LAYOUT = $value;
			else	
			$req->$a = $value;
		}
		
		//if($actual_file!=null)
		//if($actual_file!=$file)
			//unlink('routes'.DS.'node_routes'.DS.$actual_file);
		
		//form the filename with the available app information
		if(isset($request->APP_APPLICATION))
		{
			$file = $request->APP_APPLICATION;
			if(isset($request->APP_CONTROLLER))
			{
				$file = $file.'.'.$request->APP_CONTROLLER;
				if(isset($request->APP_METHOD))
				{
					$file = $file.'.'.$request->APP_METHOD;
					for($i=1;$i<10;$i++)
					{
						$o = 'O'.$i;
						if(!isset($request->$o))
							break;
						$file = $file.'.'.$request->$o;	
					}
				}	
			}
		}	
		$file = $file.'.json';
		$path = 'routes'.DS.'app_routes'.DS.$file;
		$app_route_file = $file;
		
		// If the file already exists 
		if(file_exists($path))
		{
			$json = json_decode(file_get_contents($path));
			for($i=1;$i<10;$i++)
			{
				$r='R'.$i;
				if(!isset($json->$r))
					break;
			}
			foreach($fragments as $key => $value)
			{
				$key=$key+1;
				$n = 'N'.$key;
				$json->$r->$n = $value;
			}

			$json->$r->ENABLE = '1';
			$json->$r->NODE_ROUTE_FILE =$node_route_file;

			if($default =='yes')
			{
				$ro = 'R0';
				$json->$ro = $r;
			}
		}
		else
		{
			foreach($fragments as $key => $value)
			{
				$key=$key+1;
				$n = 'N'.$key;
				$json->R1->$n = $value;
			}
			$json->R1->ENABLE = '1';
			$json->R1->NODE_ROUTE_FILE =$node_route_file;
				$json->R0 ='R1';
		}		
		$data_app= kite::prettyJson(json_encode($json)); 	
		//var_Dump($data_app);
		file_put_contents($path, $data_app);
		
		//update the node route with app route file name
		if(isset($app_route_file)){
			$req->APP_ROUTE_FILE = $app_route_file;
			$req->ENABLE = '1';
		}
			
		//encode node route data to the file
		if(isset($req))
		{
			$path = 'routes'.DS.'node_routes'.DS.$node_route_file;
			$data_node = kite::prettyJson(json_encode($req));
			//var_dump($data_node);
			// save the content in the file
			file_put_contents($path, $data_node);			
		}else
		{
			Error::message('Route Data is not defined properly - (APP is empty)');
			exit();
		}

		$basket = kite::getInstance('basket');
		$basket->set('status',"Successfully <b>$action</b> route <b>/$route</b>");
		self::listing(); 
	}
	
	public function listing()
	{
		$dir = 'routes'.DS.'app_routes';
		$basket = kite::getInstance('basket');
		 if (is_dir($dir)) 
		{
            $files = scandir($dir);
            foreach ($files as $key=>$file)
             {
				if ($file != "." && $file != "..") 
				{
					$val = '.'.$file;
					$nodes = explode('.',$val);
					$node = '';
					foreach($nodes as $a => $b)
					{
						if($node=='' && $a!=0)
							$n1 = $b;
						if($a!=0)
						if($b!='json')
						$node = $node.'/'.$b;
					}	
					$basket->route->$key->route = $node;
					$data= $this->_app_route_new($file);
					$basket->route->$key->data =$data;
				}	
			}
        }
		kite::render('routing','list','main');		
	}

	public function _enable()
	{
		$request = kite::getInstance('request');
		$route = $request->get('route');
		if(!$route)
			Error::message('Route definition not found');
		
		$node_path = 'routes'.DS.'node_routes'.DS.$route;
		if($request->get('enable') == 'true')
		{
			if(!file_exists($node_path))
			{
				Error::message('Route doesnot exists');
			}else
			{
				$node_json = json_decode(file_get_contents($node_path));
				$app_route_file=$node_json->APP_ROUTE_FILE;

				$app_path = 'routes'.DS.'app_routes'.DS.$app_route_file;
				$app_json = json_decode(file_get_contents($app_path));
				
				//check if its the only route
					foreach($app_json as $key =>$value)
					{
						if(isset($value->NODE_ROUTE_FILE))
						if($value->NODE_ROUTE_FILE == $route)
						{	
							$app_json->$key->ENABLE = '1';
							$node_json->ENABLE = '1';
						}	
					}

				//update app route
				$data_app= kite::prettyJson(json_encode($app_json)); 	
				file_put_contents($app_path, $data_app);

				//update node route
				$data_node= kite::prettyJson(json_encode($node_json)); 	
				file_put_contents($node_path, $data_node);
				
				$action = 'Enabled';
				$basket = kite::getInstance('basket');
				$basket->set('status',"Successfully <b>$action</b> route ");
				$request->clear('enable');
				self::show(); 
			}	
		}elseif($request->get('enable') == 'false')
		{
			if(!file_exists($node_path))
			{
				Error::message('Route doesnot exists');
			}else
			{
				$node_json = json_decode(file_get_contents($node_path));
				$app_route_file=$node_json->APP_ROUTE_FILE;

				$app_path = 'routes'.DS.'app_routes'.DS.$app_route_file;
				$app_json = json_decode(file_get_contents($app_path));
				

				//check if its the only route
					foreach($app_json as $key =>$value)
					{
						if(isset($value->NODE_ROUTE_FILE))
						if($value->NODE_ROUTE_FILE == $route)
						{	
							$app_json->$key->ENABLE = '0';
							$node_json->ENABLE = '0';
							if($app_json->R0 == $key)
								$app_json->R0 = null;
						}	
					}
				
				//update app route
				$data_app= kite::prettyJson(json_encode($app_json)); 	
				file_put_contents($app_path, $data_app);

				//update node route
				$data_node= kite::prettyJson(json_encode($node_json)); 	
				file_put_contents($node_path, $data_node);
				
				$action = 'Disabled';
				$basket = kite::getInstance('basket');
				$basket->set('status',"Successfully <b>$action</b> route ");
				$request->clear('enable');
				self::show(); 
			}	
		}else
		{
			Error::data('route data');
		}
	}
	public function _defaults()
	{
		$request = kite::getInstance('request');
		$route = $request->get('route');
		$node = kite::getInstance('node');
		if(!$route)
			Error::message('Route definition not found');
		
		$node_path = 'routes'.DS.'node_routes'.DS.$route;
		if($request->get('def') == 'set')
		{
			if(!file_exists($node_path))
			{
				Error::message('Route doesnot exists');
				exit();
			}else
			{
				$node_json = json_decode(file_get_contents($node_path));
				$app_route_file=$node_json->APP_ROUTE_FILE;

				$app_path = 'routes'.DS.'app_routes'.DS.$app_route_file;
				$app_json = json_decode(file_get_contents($app_path));
				//unlink the app route
				//check if its the only route
					foreach($app_json as $key =>$value)
					{
						if(isset($value->NODE_ROUTE_FILE))
						if($value->NODE_ROUTE_FILE == $route)
						{	
							$app_json->R0 =$key;
							$app_json->$key->ENABLE = '1';
							$node_json->ENABLE = '1';
						}	
					}

				//update app route
				$data_app= kite::prettyJson(json_encode($app_json)); 	
				file_put_contents($app_path, $data_app);

				//update node route
				$data_node= kite::prettyJson(json_encode($node_json)); 	
				file_put_contents($node_path, $data_node);
				
				$action = 'set';
				$basket = kite::getInstance('basket');
				$basket->set('status',"Successfully <b>$action</b> to default ");
				$request->clear('def');
				self::show(); 
			}	
		}elseif($request->get('def') == 'unset')
		{
			if(!file_exists($node_path))
			{
				Error::message('Route doesnot exists');
				exit();
			}else
			{
				$node_json = json_decode(file_get_contents($node_path));
				$app_route_file=$node_json->APP_ROUTE_FILE;

				$app_path = 'routes'.DS.'app_routes'.DS.$app_route_file;
				$app_json = json_decode(file_get_contents($app_path));
				//unlink the app route
				//check if its the only route
					$app_json->R0 = null;
					$data_app= kite::prettyJson(json_encode($app_json)); 	
					//var_Dump($data_app);
					file_put_contents($app_path, $data_app);
				
				$action = 'updated';
				$basket = kite::getInstance('basket');
				$basket->set('status',"Successfully <b>unset</b> default");
				$request->clear('def');
				self::show(); 
			}	
		}else
		{
			Error::data('route data');
		}
	}

	public function delete()
	{
		$request = kite::GetInstance('request');
		$route = $request->get('route');
		if($route !=null && $route != 'root.json')
		{
			$node_path = 'routes'.DS.'node_routes'.DS.$route;
			if(!file_exists($node_path))
			{
				Error::message('Route doesnot exists');
				exit();
			}else
			{
				$node_json = json_decode(file_get_contents($node_path));
				$app_route_file=$node_json->APP_ROUTE_FILE;

				$app_path = 'routes'.DS.'app_routes'.DS.$app_route_file;
				$app_json = json_decode(file_get_contents($app_path));
				//unlink the app route
				//check if its the only route
				if(!isset($app_json->R2))
				{
					unlink($app_path);
				}else{
					foreach($app_json as $key =>$value)
					{
						
						if(isset($value->NODE_ROUTE_FILE))
						if($value->NODE_ROUTE_FILE == $route)
						{	
							//if route is default set it to null
							if($app_json->R0 == $key)
								$app_json->R0 =null;
							//unset route from the app route file
							unset($app_json->$key);
						}	
					}
					$data_app= kite::prettyJson(json_encode($app_json)); 	
					//var_Dump($data_app);
					file_put_contents($app_path, $data_app);
				}

				//unlink the node route
				unlink($node_path);
				$action = 'deleted';
				$basket = kite::GetInstance('basket');
				$basket->set('status',"Successfully <b>$action</b> route <b>$route</b>");
				self::listing(); 
			}	
		}
		else{
			Error::data('route data');
		}
	}
	
	function _app_route_new($file)
	{
		$dir = 'routes'.DS.'app_routes';
		$path = $dir.DS.$file;	
		$json= json_decode(file_get_contents($path));
		$r = $json->R0;

		$route->R01 = $r.'1';
		foreach($json as $key =>$value)
		{

			if($key!='R0')
			{
				$a = '';
				$x='root';
				for($i=1;$i<10;$i++)
				{
					$b='N'.$i;
					if(!isset($value->$b))
						break;
					if($value->$b=='null')
						$value->$b='root';
					$a=$a.'/'.$value->$b;
					if($value->$b!='root')	
					$x=$x.'.'.$value->$b;
				}
				$x=$x.'.json';
				$c=$key.'1';
				$route->$c->NODE = $a;
				$route->$c->FILE=$x;
				$route->$c->ENABLE = $value->ENABLE;
			}
		}
		return $route;
	}
	
}

?>