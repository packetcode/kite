<?php
defined('_KITE') or die;

class InterfaceControllerTools {

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
		kite::render('editor');
	}

	public function getCode()
	{
		$file = kite::getInstance('request')->get('file');
		if(file_exists($file))
		{	
			if(is_dir($file)){
			echo '{"DATA":"ERROR : Cannot open directory "}';
			exit();
			}
		$file_handle = fopen($file, "r");
		$data='';
		while (!feof($file_handle)) {
		   $line = fgets($file_handle);
		   $data=$data."".$line;
		}
		fclose($file_handle);
		kite::getInstance('basket')->set('data',$data);
		kite::render('editor');
		}
		else
		echo '{"DATA":"ERROR : FILE NOT FOUND"}';
	}

	public function editor(){
		$file = kite::getInstance('request')->get('file');
		$code = kite::getInstance('request')->get('code');
		
		$app = kite::getInstance('kite');
		$app->set('layout','editor');	
		if($file==null)
			$file = "lib/codemirror-3.21/ReadMe.txt";
		if(!is_dir($file) && file_exists($file))
		{	
			$file_handle = fopen($file, "r");
			$data='';
			while (!feof($file_handle)) {
			   $line = fgets($file_handle);
			   $data=$data."".$line;
			}
			fclose($file_handle);		
		}
		kite::getInstance('basket')->set('data',$data);
		kite::render('editor');
	}
	
	public function save()
	{
		$file = kite::getInstance('request')->get('file');
		$code = kite::getInstance('request')->get('code');

		if($code && $file)
		{
			$fp = fopen($file, 'w');
			fwrite($fp, $code);
			fclose($fp);
			kite::getInstance('basket')->set('file',$file);
			kite::getInstance('basket')->set('data',$code);
		}
		kite::render('editor');
	}
	
}

?>