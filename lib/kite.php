<?php
/*	KITE 			- A NANO PHP MVC FRAMEWORK
 *	package 		- lib
 *	file 			- kite.php
 * 	Developer 		- Krishna Teja G S
 *	Website			- http://www.packetcode.com/projects/kite
 *	license			- GNU General Public License version 2 or later
*/

defined('_KITE') or die;
// Kite is the core class of application
// which handles the core switching mechanism

class kite extends Error
{
		// varaible to store object references	
		private static $instance = array();
		private function __construct(){}

		// the main function of the class
		public function main()
		{
			//set the configuration
			self::_config();
			
			//load the node file and initiate the process of routing
			require_once "lib".DS."router.php";
			//$node = KITE::getInstance('node');
			$router = KITE::getInstance('router');
			
			$router->main();
		}
		
		//load the configuration from config.json to KITE object
		private function _config()
		{
			$config = json_decode(file_get_contents('config.json'));
			
			// config is std obj so we recast it to kite object
			self::_recast('kite',$config);
			$kite = KITE::getInstance('kite');
			//echo $_SERVER['HTTP_HOST'];
			$path = rtrim($_SERVER['PHP_SELF'],'index.php');
			$path = "http://".$_SERVER["SERVER_NAME"].$path;
			define('ROOT',$path);
			if($_SERVER["SERVER_NAME"]=='localhost')
			{
				$this->DB_NAME = $this->DB_LOCAL_NAME;
				$this->DB_HOST =$this->DB_LOCAL_HOST;
				$this->DB_USERNAME =$this->DB_LOCAL_USERNAME;
				$this->DB_PASSWORD =$this->DB_LOCAL_PASSWORD;
			}
		}
		
		// function to cast the stdObject to a class object 
		// assigns the varaibles to object class
		public  function _recast($className, stdClass &$object)
		{
			//if (!class_exists($className))
			//throw new InvalidArgumentException(sprintf('Inexistant class %s.', $className));

			$new = KITE::getInstance($className);
			
			foreach($object as $property => &$value)
			{
				$new->$property = &$value;
				unset($object->$property);
			}
			unset($value);
			$object = (unset) $object;
		}
		
		//function to load the classes automatically
		private function _autoload($class)
		{
			$path= 'lib';
			$file = $path.DS.$class.'.php';
			if(file_exists($file))
				require $file;
		}
		
		//function to store the values to object variables
		public function set($key,$value)
		{
			$key = strtoupper($key);
			$this->$key = $value;
		}
		
		//function to retrieve the data from object varaibles
		public function get($key)
		{
			$key = strtoupper($key);
			if(isset($this->$key))
				return $this->$key;
			else
				return null;
		}
		
		// function to contruct and store the reference of the object
		public static function getInstance($class)
		{
			
			if(isset(self::$instance[$class]))
			{
				return self::$instance[$class];
			}else
			{
			
				//if the class doesnot exists call the autoload function
				if(!class_exists($class))
				self::_autoload($class);
				
				//if the object required is pdo then 
				// extract the config data from kite object
				// and create a pdo object using it
				if($class == 'pdo')
				{
					$kite = KITE::getInstance('kite');
					$host = $kite->DB_HOST;
					$db_name = $kite->DB_NAME;
					$username = $kite->DB_USERNAME;
					$password = $kite->DB_PASSWORD;
					self::$instance[$class] = new PDO("mysql:host=$host;dbname=$db_name", "$username", "$password");
				}else	
				self::$instance[$class] = new $class();
				return self::$instance[$class];
			}	
		}
		
		//function to render the view to template or json/html format
		public static function render($view,$tpl=null)
		{
			$kite = KITE::getInstance('kite');
			// get the current app from kite object
			$appl = KITE::getInstance('application');
			$app = $appl->get('APPLICATION');
			if(isset($kite->CONNECT))
				return true;
			// Thread run before view
			$thread = KITE::getInstance('thread');
			$thread->run('view');
			
			// get the terminal node extension
			$node = KITE::getInstance('node');
			$ext= $node->get('terminal_ext');
			
			// set the view as kite object variable
			//so as to use in the application call from template
			$appl->set('VIEW',$view);
			//get the details of template and hash from kite object
			$theme = $kite->get('THEME');
			$layout = $kite->get('LAYOUT');
			$site_hash = $kite->get('HASH');
			//check if security to display html/json is true or false
			$secure = $kite->get('SECURE');
			
			//setting the view template to default
			if($tpl==null)
				$tpl = 'default';
			/*
			if(isset($kite->TMPL))
				$tmpl=$kite->TMPL;
			if(isset($kite->PAGE))
				$page=$kite->PAGE;
				*/	
			//get the url parameters for template and hash if they exists
			
			$request = KITE::getInstance('request');
			if($request->get('theme')!=null)
			$theme= $request->get('theme');
			if($request->get('layout')!=null)
			$layout = $request->get('layout');
			//if($request->get('hash')!=null)
			$hash =$request->get('hash');
			
			//if secure is not true then give access to display json/html format
			if($secure ==0)
				$hash = $site_hash;
				
			$basket = KITE::getInstance('basket');
			
			//if terminal extension is json then display json format
			if($ext==='json')
			{
				if( $site_hash===$hash)
					echo json_encode($basket);
				else
					Error::message('Access Restricted: Hash code required to access');
			//if the terminal extension is html then render only html without template	
			}else if(	$ext==='html' )
			{
				if( $site_hash===$hash)
					require_once "apps".DS.$app.DS."views".DS.$view.DS.$tpl.DS.$tpl.".php";
				else
					Error::message('Access Restricted: Hash code required to access');
			//else display template +view		
			}else
			{	
				$appl->set('theme',$theme);
				$appl->set('layout',$layout);
				$appl->set('tpl',$tpl);
				
				if($layout=='index')
				$theme_file = "themes".DS.$theme.DS.$layout.".php";
				else
				$theme_file = "themes".DS.$theme.DS.'layouts'.DS.$layout.".php";
				if(file_exists($theme_file))
				{
					require_once  "themes".DS.$theme.DS.'defaults'.DS."header.php";
					require_once 	$theme_file;
					require_once  "themes".DS.$theme.DS.'defaults'.DS."footer.php";
				}else{
					$theme_file = "themes".DS.$theme.DS.'defaults'.DS."default.php";
						if(file_exists($theme_file))
						{
								$appl->set('layout','default');
							require_once  "themes".DS.$theme.DS.'defaults'.DS."header.php";
							require_once 	$theme_file;
							require_once  "themes".DS.$theme.DS.'defaults'.DS."footer.php";
						}else
							Error::message("Theme <b>$theme</b> ($layout layout) not found");	
				}		
			}	
			// Thread run before end
			$thread = KITE::getInstance('thread');
			$thread->run('last');					
		}
		
		//function called from the template
		//to load the application
		public static function app()
		{
			//get the values of app and the view to 
			//be rendered from the kite object
			
			$appl = KITE::getInstance('application');
			$app = $appl->get('APPLICATION');
			$view = $appl->get('VIEW');
			$tpl = $appl->get('TPL');
			require_once "apps".DS.$app.DS."views".DS.$view.DS.$tpl.DS.$tpl.".php";	
		}
		
		//function to call te model of the application
		public static function getModel($model)
		{
			$appl = KITE::getInstance('application');
			$app = $appl->get('APPLICATION');
			
			$file = "apps".DS.$app.DS."models".DS.$model.".php";
			//check if the model exists then load the model file
			if(file_exists($file))
			{
				// Thread run before Model
				$thread = KITE::getInstance('thread');
				$thread->run('model');
								
				require_once $file;
				$modelName = $app.'Model'.$model;
				$modelObj = new $modelName();
				return $modelObj;
			}
			else
				Error::message("model doesnt exists");
		}
		
		public static function getTablePrefix($table)
		{
			$kite = Kite::getInstance('kite');
			$appl = Kite::getInstance('application');
			$prefix = $kite->DB_PREFIX;
			$app = $appl->APPLICATION;
			$table_prefix = $prefix.'_'.$app.'_';
			return $table_prefix.$table;
		}
		
		
		public static function block($block){
			$app = Kite::getInstance('application');
			$theme = $app->get('theme');
			$layout = $app->get('layout');
			$file = 'themes'.DS.$theme.DS.'blocks'.DS.$layout.'.json';
			if(!isset($app->BLOCKS))
			if(file_exists($file))
			{
				$blocksjson = json_decode(file_get_contents($file));
				foreach($blocksjson as $key => $value)
				{
					$key = strtoupper($key);
					$app->BLOCKS->$key = $value;
				}
			}

			if(isset($app->BLOCKS))
			{
				$block = strtoupper($block);
				?><div class = 'kite_sortable'><?php
				foreach($app->BLOCKS->$block as $a => $b)
				{	
					$c=null;
					if (strpos($b,'-') !== false) {
					    $pieces = explode('-',$b);
					    $b= $pieces[0];
					    $c = $pieces[1];
					}
					?><div id='item_<?php echo $b;?>' ><?php
					if($b!='app')					
						 kite::getInstance('kite')->snippet($b,$c);
					else
						kite::getInstance('kite')->app();
					?></div><?php
						}
						?></div><?php
					
			}
		}
		public static function snippet($snippet,$instance=null)
		{
			$file = 'snippets'.DS.$snippet.DS.$snippet.'.php';
			$kite = Kite::getInstance('kite');
			$packet = Kite::getInstance('packet');
			unset($packet->PARAMS);
			unset($packet->CONFIG);
			$application = Kite::getInstance('application');
			$kite->set('snippet',$snippet);

			if(!$instance)
				$instance = 'default';

			//checking snippet enable and loading params
			$app = $application->get('application');
			$controller = $application->get('controller');
			$method = $application->get('method');
			$page_param_file = $app.'.'.$controller.'.'.$method.'.json';
			$page_param_path = 'snippets'.DS.$snippet.DS.'page_params'.DS.$instance.DS.$page_param_file;
			
			//check for page params else global params
			if(file_exists($page_param_path))
			{

				$snippet_params_json= json_decode(file_get_contents($page_param_path));
					
			}else
			{
				$param_path = 'snippets'.DS.$snippet.DS.'params'.DS.$instance.'.json';
				if(file_exists($param_path))
				$snippet_params_json= json_decode(file_get_contents($param_path));
			}

			//if params exists load them to packet object
			if(isset($snippet_params_json))
			foreach($snippet_params_json as $a => $b)
			{
					$a = strtoupper($a);
					$packet->PARAMS->$a = $b;
			}
			
			//check and load config file
			$config_path = 'snippets'.DS.$snippet.DS.'config.json';
			if(file_exists($config_path)){
				$config_json= json_decode(file_get_contents($config_path));
			foreach($config_json as $a => $b)
			{
					$a = strtoupper($a);
					$packet->CONFIG->$a = $b;
			}
			}

			$snippetName = 'snippet'.$snippet;
			if(!class_exists($snippetName))
			{
				if(file_exists($file))
					require_once $file;
				else
				Error::message("Snippet($snippet) not found");
			}
			
			if(isset($snippet_params_json))
			{	
				//checking the global enable
				if($packet->CONFIG->ENABLE == '1')
				if($packet->PARAMS->ENABLE=='1')
				{	
				$snippetObj = new $snippetName();
				$snippetObj->main();
				}
			}else
			 	Error::warning("Snippet($snippet) instance($instance) not found");
			
		}
		

		public static function getClip($clip)
		{	
			$file = "clips".DS.$clip.".php";
			//check if the model exists then load the model file
			if(file_exists($file))
			{			
				require_once $file;
				$clipName = 'Clip'.$clip;
				$clipObj = new $clipName();
				
				return $clipObj;
			}
			else
				Error::message("Clip doesnt exists");
		}
		//function used in snippets to display output
		public static function display($tmpl=null)
		{
			if($tmpl==null)
				$tmpl='default';
			$kite = Kite::getInstance('kite');
			$snippet = $kite->get('snippet');	

			$file = $file = 'snippets'.DS.$snippet.DS.'tmpl'.DS.$tmpl.'.php';
			
			if(file_exists($file))
			{
					require $file;
			}
			else
				Error::message("Snippet $snippet template file $tmpl not found");
		}
		
		// get site information
		public static function getSiteFiles($key)
		{
			$kite = KITE::getInstance('kite');
			$appl = KITE::getInstance('application');
			$theme = $appl->get('theme');
			$layout = $appl->get('layout');
			$theme_config_json = 'themes'.DS.$theme.DS.'config.json';
			if($theme !=null)
			{
				
				$theme_config = json_decode(file_get_contents($theme_config_json));
				$kite->set('theme_config',$theme_config);
			}
			//setting global data
			$globals = 'themes'.DS.$theme.DS.$key.DS.'global'.'.'.$key;
			$defaults = 'themes'.DS.$theme.DS.$key.DS.'default'.'.'.$key;
			if(file_exists($globals))
					$global_file = $globals;
			if($layout=='default')
			if(file_exists($defaults))
					$default_file = $defaults;
					
			$obj = $kite->_appLoad($key);
			if(isset($global_file))
			$obj->globals = $global_file;
			if(isset($default_file))
			$obj->defaults = $default_file;
			if(isset($theme_config->PRESET)){
			if($theme_config->PRESET!='default'){
				$preset =$theme_config->PRESET;
				$preset_file = 'themes'.DS.$theme.DS.'preset'.DS.$preset.DS.$key.DS.$layout.'.'.$key;
				if(file_exists($preset_file)){
					$obj->site = $preset_file;
				}else{
					$layout_default_file = 'themes'.DS.$theme.DS.$key.DS.$layout.'.'.$key;
					if(file_exists($layout_default_file))
						$obj->site = $layout_default_file;
				}			
			}else{
				$layout_default_file = 'themes'.DS.$theme.DS.$key.DS.$layout.'.'.$key;
				if(file_exists($layout_default_file))
					$obj->site = $layout_default_file;
			}
			}
			if(isset($obj))
			foreach($obj as $a => $b)
			{
				$url = ROOT.$b;
				if($key=='css')
						echo  "\n<link href='$url' rel='stylesheet'>";
				else
						echo "\n<script src='$url' type='text/javascript'></script>";		
			}		
			echo "\n";
		}
		
		public static function getSite($key)
		{
			$kite = kite::getInstance('kite');
			$key = 'meta_'.$key;
			echo $kite->get($key);
		}
		
		public static function _appLoad($key)
		{
			$appl = KITE::getInstance('application');
		
			$app = $appl->APPLICATION;
			$view = $appl->VIEW;
			$tpl = $appl->TPL;
			$href ='apps'.DS.$app.DS.'views'.DS.$view.DS.$tpl.DS.$tpl.'.'.$key;
			$file = 'apps'.DS.$app.DS.'core'.DS.'app.php';
			if(file_exists($file))
			{
				$class = $app.'App';
				if(!class_exists($class))
					require_once $file;
				$obj = new $class();
			
				if(method_exists($class,$key))
				{
					$obj->$key();
					foreach($obj->$key as $a => $b)
						$c->$a = $b;
				}
			}if(file_exists($href))
						$c->main = $href;
			if(isset($c))			
			return $c;	
			return null;	
		}
		
		public static function connect($app,$hook,$options=null)
		{
	
			$request = Kite::getInstance('request');
			$kite = Kite::getInstance('kite');
			$appl = Kite::getInstance('application');
			$appl->CONNECT->APPLICATION = $appl->APPLICATION;
			$appl->CONNECT->THEME= $kite->get('theme');
			$appl->CONNECT->LAYOUT = $kite->get('layout');
			$appl->APPLICATION = $app;
			if($options!=null)
			foreach($options as $key => $value)
				$request->set($key,$value);
			else
				$options->none ='none';
				
			$results = null;
			$file = 'apps'.DS.$app.DS.'core'.DS.'hooks.php';	
	
			if(file_exists($file))
			{
				require_once $file;
				$hookClass = $app.'Hooks';
				$hookObj = new $hookClass();
				if(method_exists($hookClass,$hook))
				{
					$hookObj->$hook();
					$controller = $hookObj->controller;
					$method = $hookObj->method;
					
					$file = 'apps'.DS.$app.DS.'controllers'.DS.$controller.'.php';
					$controllerName = $app.'Controller'.$controller;
					if(!class_exists($controllerName))
					if(file_exists($file))
						require_once $file;
					$appObj = new $controllerName();
					$kite = Kite::getInstance('kite');
					$kite->set('CONNECT', '1');
				
					if(method_exists($controllerName,$method))
					{
						$basket = kite::getInstance('basket');
						foreach($basket as $key => $value)
							$a->$key = $value;
							
						$appObj->$method();
						
						foreach($basket as $key => $value)
						{
							if(!isset($a->$key))
							$results->$key = $value;
							else
							{
								if($a->$key!=$value)
									$results->$key = $value;
							}	
							unset($basket->$key);
						}
						if(isset($a))
						foreach($a as $key => $value)
							$basket->set($key,$value);
						unset($kite->CONNECT);
						
					}
				}	
			}
			$appl->APPLICATION = $appl->CONNECT->APPLICATION;
			$kite->set('theme',$appl->CONNECT->THEME);
			$kite->set('layout',$appl->CONNECT->LAYOUT);
			return $results;
		}
		
		public static function route($path)
		{
			$router = kite::getInstance('router');
			return $router->appRoutes($path);
		}
		
		public static function prettyJson($json) {

		 if (!is_string($json)) {
		    if (phpversion() && phpversion() >= 5.4) {
		      return json_encode($json, JSON_PRETTY_PRINT);
		    }
		    $json = json_encode($json);
		  }
		  
		  //defaults
		  $result      = '';
		  $pos         = 0;               // indentation level
		  $strLen      = strlen($json);
		  $indentStr   = "\t";
		  $newLine     = "\n";
		  $prevChar    = '';
		  $outOfQuotes = true;

		  for ($i = 0; $i < $strLen; $i++) {
		    // Grab the next character in the string
		    $char = substr($json, $i, 1);

		    // Are we inside a quoted string?
		    if ($char == '"' && $prevChar != '\\') {
		      $outOfQuotes = !$outOfQuotes;
		    }
		    // If this character is the end of an element,
		    // output a new line and indent the next line
		    else if (($char == '}' || $char == ']') && $outOfQuotes) {
		      $result .= $newLine;
		      $pos--;
		      for ($j = 0; $j < $pos; $j++) {
		        $result .= $indentStr;
		      }
		    }
		    // eat all non-essential whitespace in the input as we do our 
		    //own here and it would only mess up our process
		    else if ($outOfQuotes && false !== strpos(" \t\r\n", $char)) {
		      continue;
		    }

		    // Add the character to the result string
		    $result .= $char;
		    // always add a space after a field colon:
		    if ($char == ':' && $outOfQuotes) {
		      $result .= ' ';
		    }

		    // If the last character was the beginning of an element,
		    // output a new line and indent the next line
		    if (($char == ',' || $char == '{' || $char == '[') && $outOfQuotes) {
		      $result .= $newLine;
		      if ($char == '{' || $char == '[') {
		        $pos++;
		      }
		      for ($j = 0; $j < $pos; $j++) {
		        $result .= $indentStr;
		      }
		    }
		    $prevChar = $char;
		  }

		  return $result;
		}

		public static function redirect($key)
		{
			header("Location: $key");
		}

		

}

?>