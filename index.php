<?php
/*	PATHANG		- A SLEAK PHP MVC FRAMEWORK
 *	package 		- root
 *	file 				- index.php
 * 	Developer 		- Krishna Teja G S
 *	Website		- http://www.pathang.net
 *	license			- GNU General Public License version 2 or later
*/

//defining a global constant to block direct access to files
define('_KITE',true);
// directory separator
define('DS',DIRECTORY_SEPARATOR);

//load the error class and kite class
require_once "lib".DS."error.php";
require_once "lib".DS."kite.php";

//running the first thread
kite::getInstance('thread')->run('first');
//creating the instance of kite object
kite::getInstance('kite')->main();