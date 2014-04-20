<?php
defined('_KITE') or die;

class InterfaceControllerConfiguration {
	
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
		if(kite::getInstance('request')->get('task'))
		{
			$this->_push();
		}
		$config = json_decode(file_get_contents('config.json'));
		$basket = kite::getInstance('basket');
		foreach($config as $key =>$value)
		$basket->set($key,$value);
		kite::render('configuration','default');
	}
	
	public function _push()
	{
		$model = kite::getModel('config');
		$request = kite::getInstance('request');
		$basket = kite::getInstance('basket');
		$secure = $request->get('secure');
	
		if($secure != null)
		{
				$model->updateConfig();
				$basket->set('status'," Configuration updated");	
		}
	}
	
}

?>