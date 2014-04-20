<?php
defined('_KITE') or die;

class InterfaceControllerApplications extends kite{


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
		$basket->apps = $this->_dir('apps');
		$basket->threads = $this->_dir('threads');
		$basket->snippets = $this->_dir('snippets');
		$basket->themes = $this->_dir('themes');
		$this->render('applications');
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
	public function installer()
	{
		$request = Kite::getInstance('request');
		$request->tmpl = 'interface';
		$node = Kite::getInstance('node');
		$o1=$node->get('o1');
		
		if($o1 !=null)
		{
			$options->app = $o1;
			$result = kite::connect('interface','check_installation',$options);
			if(!$result->installation)
			{
				kite::connect('interface','create_tables',$options);
				kite::connect('interface','update_installation',$options);
			}	
			var_dump($result);
		}
		//$this->render('install');
	}
	
	public function install()
	{
		
		$this->render('install');
	}
	
	public function upload()
	{
		
		if($_FILES["zip_file"]["name"]) {
			$filename = $_FILES["zip_file"]["name"];
			$source = $_FILES["zip_file"]["tmp_name"];
			$type = $_FILES["zip_file"]["type"];
			
			$name = explode(".", $filename);
			$accepted_types = array('application/zip', 'application/x-zip-compressed', 'multipart/x-zip', 'application/x-compressed');
			foreach($accepted_types as $mime_type) {
				if($mime_type == $type) {
					$okay = true;
					break;
				} 
			}
			
			$continue = strtolower($name[1]) == 'zip' ? true : false;
			if(!$continue) {
				$message = "The file you are trying to upload is not a .zip file. Please try again.";
			}

			$target_path = 'tmp'.DS.$filename;  
			if(move_uploaded_file($source, $target_path)) {
				$zip = new ZipArchive();
				$x = $zip->open($target_path);
		
				if ($x === true) {
					$folder = substr(md5(rand()), 0, 5);
					$tmp = 'tmp'.DS.$folder;
					$zip->extractTo($tmp); // change this to the correct site path
					$zip->close();
					unlink($target_path);
		
					// package installations
					$arr = array('app','snippet','thread','theme');
					 $files = scandir ( $tmp );
						foreach ( $files as $file )
						{
							$prefix = explode('_',$file);
							$prefix[0] = strtolower($prefix[0]);
							if (in_array($prefix[0], $arr)) {
								$src = $src=$tmp.DS.$file;
								if(isset($prefix[1]))
								{
								$dst = $prefix[0]."s".DS.$prefix[1];
								if($prefix[0]=='thread')
									$dst=$prefix[0]."s";
								$this->rcopy($src,$dst);
								}
							}
						}
						
					$this->rrmdir($tmp);	
				}
				$message = "Your .zip file was uploaded and unpacked.";
			} else {	
				$message = "There was a problem with the upload. Please try again.";
			}
		}
		return $message;
	}
	
	public function rrmdir($dir) {
        if (is_dir($dir)) {
            $files = scandir($dir);
            foreach ($files as $file)
                if ($file != "." && $file != "..") $this->rrmdir("$dir/$file");
            rmdir($dir);
        }
        else if (file_exists($dir)) unlink($dir);
    }

    // Function to Copy folders and files       
    public function rcopy($src, $dst) {
        //if (file_exists ( $dst ))
          //  $this->rrmdir ( $dst );
        if (is_dir ( $src )) {
            @mkdir ( $dst );
            $files = scandir ( $src );
            foreach ( $files as $file )
                if ($file != "." && $file != "..")
                    $this->rcopy ( "$src/$file", "$dst/$file" );
        } 
		else if (file_exists ( $src ))
            copy ( $src, $dst );
    }
	
}

?>