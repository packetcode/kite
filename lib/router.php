<?php
/*	KITE 			- A NANO PHP MVC FRAMEWORK
 *	package 		- lib
 *	file 				- router.php
 * 	Developer 		- Krishna Teja G S
 *	Website		- http://www.packetcode.com/projects/kite
 *	license			- GNU General Public License version 2 or later
*/

defined('_KITE') or die;

// A class which deals with url and its fragments(nodes)
// the nodes are named as n1,n2,n3... respectively
// the first few nodes are used for understand the application
// and the rest will be sent to the application as options 
// options are names ad o1,o2,o3....and so on

class router{
		
		//defining object variable options
		var $option = 0;
		
		// routing function
		public function _installation()
		{
				//check for installation
			$file = 'apps'.DS.'interface'.DS.'controllers'.DS.'installation.php';
			require_once($file);
			$install = new InterfaceControllerInstallation();
			$request = kite::getInstance('request');
			$request->set('app','interface');
			$install_check = $install->checkInstallationSettings();

			if(!$install_check)
			{
				$kite->APP_APPLICATION = 'interface';
				$install->main();
			}
		}
		
		public function main()
		{
			$node = KITE::getInstance('node');
			//get the nodes to node object
			$node->_nodes();

			//load the route root.json
			$file = 'routes'.DS.'node_routes'.DS.'root.json';
			$routejson = json_decode(file_get_contents($file));
			$this->overwriteConfig($routejson);
			
			
			//setting defaults
			$kite = KITE::getInstance('kite');
			//check/update the controller and method
			if($kite->get('app_controller')==null)
				$kite->set('app_controller','root');
			if($kite->get('app_method')==null)
				$kite->set('app_method','main');
			
			$app= $kite->get('app_application');
			$controller = $kite->get('app_controller');
			$method = $kite->get('app_method');
			
			$call = null;
				
			if($kite->get('installation') != "1")
			{
				$this->_installation();
				$call = 'installation';
			}else
			{
				
				if(isset($node->N3))
				{
					$a = $node->get('n1');
					$c = $node->get('n2');
					$m = $node->get('n3');
						
					$file = 'apps'.DS.$a.DS.'controllers'.DS.$c.'.php';
					if(file_exists($file))
					{
						require_once $file;
						$class_name = $a.'Controller'.$c;
						if(method_exists($class_name,$m))
						{
							$this->route($a,$c,$m,3);	
							$call = 'direct';							
						}	
					}
				}
				
				if($call==null)
				if($this->findRouteJson('routes/node_routes/',$node->get('terminal_position')))
				{
					
					$route = $this->findRouteJson('routes/node_routes/',$node->get('terminal_position'));
					$option = $route['position'];
					
					if($route['file']!=null)
					{		
						$file = 'routes'.DS.'node_routes'.DS.$route['file'];
						$routejson = json_decode(file_get_contents($file));
						
						if(isset($routejson->APP_APPLICATION))
						{
							if($routejson->ENABLE == '1')
							{

								$this->overwriteConfig($routejson);
								$this->setParams($routejson);
								$app = $routejson->APP_APPLICATION;
								if(isset($routejson->APP_CONTROLLER))
								{
										
									$controller = $routejson->APP_CONTROLLER;
									$appName = $app.'Controller'.$controller;
									$file = 'apps'.DS.$app.DS.'controllers'.DS.$controller.'.php';
									if(file_exists($file))
										require_once $file;
									if(isset($routejson->APP_METHOD))
									{
										
										$method = $routejson->APP_METHOD;
										for($k=1;$k<10;$k++)
										{
											$o = 'O'.$k;
											if(!isset($routejson->$o))
												break;
												$opt = 'O'.$k;
											$node->$opt = $routejson->$o;
											$option_index=$k+1;
										}
									}else
									{		
										$i= $option+1;
										$item = 'N'.$i;
										if(isset($node->$item))
										{			
											if(method_exists($appName,$node->$item))
											{
												$method = $node->$item;
												$option = $i;
											}else{
												$method='main';
											}
										}else
										{	
										$method = 'main';
										$option = $i-1;
										}
									}	
								}else
								{
									$i= $option+1;
									$item = 'N'.$i;
									if(isset($node->$item))
									{
										$file = 'apps'.DS.$app.DS.'controllers'.DS.$node->$item.'.php';
										if(file_Exists($file))
										{
											$controller = $node->$item;
											$appName = $app.'Controller'.$controller;
											require_once $file;
											$i = $i+1;
											$item = 'N'.$i;
											if(isset($node->$item))
											{	
												if(method_exists($appName,$node->$item))
												{
													$method = $node->$item;
													$option = $i;	
												}
												else
												{									
													$method = 'main';
													$option = $i-1;
												}	
											}else
											{									
												$method = 'main';
												$option = $i-1;
											}	
										}	
									}	
								}	
							}
						}

						if(isset($option_index))
						$this->route($app,$controller,$method,$option,$option_index);	
						else
						$this->route($app,$controller,$method,$option);	
					}
			
					
				}
		
			}
			
		}
		
		// A recursive function to trace the route json file 
		// the function builds the route json file path with node elements
		// iterates back ward by removing the terminal node in each iteration
		// retunrs null is not found
		public function findRouteJson($path,$terminal)
		{
			// variable to store the route details
			$route = array();
			$node =  kite::getInstance('node');

			// building the route path
			$file='root';
			$i=0;
			if($terminal != 0)
			for($i=1;$i<=$terminal;$i++)
			{
				$item = 'N'.$i;
				if(isset($node->$item))
				$file=$file.".".$node->$item;		
			}
			
			$file = $file.".json";

			// check for existance for file
			if(file_exists($path.$file))
			{
				
				$route['file'] = $file;
				$route['position'] = $i-1;
				if($file == 'root.json')
					$route['position'] = 0;
				return $route;
			}elseif($terminal==0){
				$route['file'] = null;
				$route['position'] = 0;
				return $route;
			}else
			{
				// recursive iteration
				return self::findRouteJson($path,$terminal-1);
			}
		}
		
		// if the controller exists then call the controller
		//also store the values in Kite object
		public function route($application,$controller,$method,$option,$option_index=null)
		{

			if($option_index==null)
				$option_index=1;
			$this->setOptions($option,$option_index);
			$appl = KITE::getInstance('application');
			$appl->set('APPLICATION',$application);
			$appl->set('CONTROLLER',$controller);
			$appl->set('METHOD',$method);
			
			$file = 'apps'.DS.$application.DS.'controllers'.DS.$controller.'.php';
			if(file_exists($file))
			{
				require_once $file;
				$class_name = $application.'Controller'.$controller;
				
				// Thread run before controller
				$thread = KITE::getInstance('thread');
				$thread->run('controller');
				//create object
				$app = new $class_name();
				//loading the application config data
				$config = 'apps'.DS.$application.DS.'config'.DS.'config.json';
				if(file_exists($config))
				{
					$config = json_decode(file_get_contents($config));
					kite::_recast('application',$config);
				}
				
				if(method_exists($app, $method)){	
				if(substr($method, 0, 1) === '_')
					Error::message(" <b>Access Denied:</b> Call to $method cannot be executed");
				else	
				$app->$method();
				}else{
					Error::message(" <b>Routint Error:</b> method ($method) not found in controller ($controller)");
				}
			}else
				Error::message("Routing Error: Controller File ($controller) not Found");
		}
				
		//function to set the options so as to send to 
		//the application for processing
		public function setOptions($option,$j=null)
		{
		
			$node = Kite::getInstance('node');
			$option++;
			if($j==null)
			$j=1;
			// after the usage of first few nodes the rest are set 
			// as o1,o2,o3,...
			while(1)
			{
				$n = 'N'.$option;
				if(isset($node->$n))
					$node->set('O'.$j,$node->$n);
				else
					break;
				$option++;$j++;
			}
		}
		

		public function appRoutes($route)
		{
			$items = explode('/',$route);
			$path = 'routes'.DS.'app_routes';

			$i=sizeof($items)-1;
			$app_alias='';	
			for($i;$i>-1;$i--)
			{
				$file_name = 'json';
				for($j=$i;$j>-1;$j--)
					$file_name = $items[$j].'.'.$file_name;
				$file = $path.'/'.$file_name;
				if(file_Exists($file))
				{
					$app_alias = self::_getAppRoute($file);
					if($app_alias == 'root'.DS)
					{
						$app_alias = '';
						for($k=$i+1;$k<sizeof($items);$k++)
						$app_alias = $app_alias.$items[$k].'/';
						break;
					}
					elseif($app_alias != '')
					{
						for($k=$i+1;$k<sizeof($items);$k++)
						$app_alias = $app_alias.$items[$k].'/';
						break;
					}
					
				}
			}
			if($app_alias=='')
				$app_alias=$route;
			$app_alias = rtrim($app_alias, DS);
			$app_alias = rtrim($app_alias, '/').'/';
			return $app_alias;
			//return $app_alias;
		}
		
		public function _getAppRoute($file)
		{
				$data = json_decode(file_get_contents($file));
				$r = $data->R0;
				if($r==null)
					return '';
				$items = $data->$r;
				$node='';
				if($items->ENABLE != '0')
				foreach($items as $key => $value)
				if($key != 'NODE_ROUTE_FILE')
				if($key != 'ENABLE')
				if($value!='null')
					$node = $node.$value.DS;
				return $node;		
		}
		
		public function overwriteConfig($json)
		{
			$kite = kite::getInstance('kite');
			foreach($json as $key => $value)
				$kite->set($key,$value);
		}

		public function setParams($json)
		{
			$request = kite::getInstance('request');
			if(isset($json->PARAMS)){
			parse_str($json->PARAMS,$params);
			foreach($params as $key => $item)
			{
				$key = strtoupper($key);
				$request->$key = $item;
			}
				
			}
		}
}
?>