<?php
defined('_KITE') or die;

class InterfaceControllerCode {

	public function	__Construct()
	{
		$kite = kite::GetInstance('kite');
		$kite->set('LAYOUT','code');
	}
	
	public function main()
	{
		kite::render('editor');
	}
	
	
}

?>