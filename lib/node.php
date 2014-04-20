<?php
/*	KITE 			- A NANO PHP MVC FRAMEWORK
 *	package 		- lib
 *	file 				- node.php
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

class node {
				
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
		
		public function _nodes()
		{	
			// check if the url parameter is set
			if(isset($_GET['url']))
			{
				// load the url into url variable
				$url = $_GET['url'];
				
				//trim the url to remove slashes on right
				$url = rtrim($url,'/');
				define('ABS_REQUEST',ROOT.$url);
				define('REL_REQUEST',$url);
				//break the url to fragments
				$url = explode('/',$url);
				//load the url to the object variable 
				// as n1,n2,n3....
				foreach($url as $key => $value)
				{
					$key++;
					$this->set('N'.$key,$value);	
				}
				// store the terminal position of the node
				$terminal_node = 'N'.sizeof($url);
				$terminal_position = sizeof($url);
			
				$this->set('terminal_position',$terminal_position);			
				$this->set('terminal_node',$terminal_node);		
				$this->_node_terminal();	
			}else
			{
				$this->set('terminal_position',0);			
				$this->set('terminal_node',null);					
			}	
		}
		
		//function which analyses the last node 
		//and picks up the extension and stores in node object
		public function _node_terminal()
		{
			$terminal_node = $this->get('terminal_node');
			$terminal = $this->$terminal_node;
			$terminal_items = explode('.',$terminal);	
			
			if(isset($terminal_items[0]))
				$this->set('terminal_item',$terminal_items[0]);
			if(	isset($terminal_items[1]))
				$this->set('terminal_ext',$terminal_items[1]);
			
			//update the ternimal node
			$this->set($terminal_node,$terminal_items[0]);
		}


}
?>