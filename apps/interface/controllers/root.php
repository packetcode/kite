<?php
defined('_KITE') or die;

class InterfaceControllerRoot extends kite{

	public function __construct()
	{
	}
	public function main()
	{
		$session = Kite::getInstance('session');
		$shash=$session->get('hash');
		$route = ROOT.kite::route('interface/root/login');
		if(!$shash)
			kite::redirect($route);
		else
			$this->render('dashboard');
	}
	
	function login()
	{
		$request = Kite::getInstance('request');
		$kite = Kite::getInstance('kite');
		$basket = Kite::getInstance('basket');
		$session = Kite::getInstance('session');
		
		$shash=$session->get('hash');
		$route=ROOT.$session->get('back_url');
		$hash = $request->get('hash');
		$md5 = md5($hash);
		

		if(!$route)
		$route = ROOT.kite::route('interface/root/main');
		if($route == ROOT)
		$route = ROOT.kite::route('interface/root/main');

		if($shash === $kite->get('SHASH'))
		{
				kite::redirect($route);
		}
		elseif($hash!=null)
		{
			if($kite->get('SHASH') === $md5)
			{	
				$session->set('hash',$md5);
				$user->id = '9931';
				$user->name = 'Admin';
				$session->set('user',$user);
				$session->clear('back_url');
				kite::redirect($route);
			}
			else
			{
				$basket->set('msg',"Invalid Hash code <b>$hash</b>");
				$this->render('dashboard','hash');
			}
		}else	
		$request->page = 'hash'; 
		$this->render('dashboard','hash');
	}
	
	function logout()
	{
		$session = Kite::getInstance('session');
		$basket = Kite::getInstance('basket');	
		$request = Kite::getInstance('request');
		$hash = $session->get('hash');
		$session->clear('hash');
		$session->clear('user');
		$request->layout = 'hash';
		if(	$hash !=null)
		$basket->set('msg',"Successfully <b>logged out</b>");
		$request->set('layout','hash');
		$this->render('dashboard','hash');
	}

}
