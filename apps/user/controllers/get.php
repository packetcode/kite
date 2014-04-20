<?php
defined('_KITE') or die;

class UserControllerGet {

	public function name()
	{
		$this->_getItem('name');
	}
	
	public function email()
	{
		$this->_getItem('email');
	}
	
	public function image()
	{
		$this->_getItem('image');
	}
	
	public function id()
	{
		$this->_getItem('id');
	}
	
	public function username()
	{
		$this->_getItem('username');
	}
	
	public function _getItem($item)
	{
		$request = kite::getInstance('request');
		$kite = kite::getInstance('kite');
		$kite->set('layout', 'default');
		$basket = kite::getInstance('basket');
		$feild='id';
		$username = $request->get('username');
		if(isset($username))
			$feild = 'username';
			
		$value = $request->get($feild);
		$usermodel = kite::getModel('data');
		
		if($value!=null)
		{
		$item = strtoupper($item);
		$data->$item = $usermodel->getUserData($item,$feild,$value);
		if($data->$item !=null)
		{
			$basket->set('data',$data);
		}else
		{
			unset($data->$item);
			$data->error = " $item for $feild=$value not found";
			$basket->set('data',$data);
		}
		}else
		{
			$data->error = "Enter the query item";
			$basket->set('data',$data);
		}
		kite::render('data');
	}	
	
	
	public function user()
	{
		$request = kite::getInstance('request');
		$kite = kite::getInstance('kite');
		$kite->set('layout','default');
		$basket = kite::getInstance('basket');
		$feild='id';
		if(isset($request->USERNAME))
			$feild = 'username';

		$value = $request->get($feild);
		$usermodel = kite::getModel('data');
		if($value!=null)
		{
		
		$data->user = $usermodel->getUserAllData($feild,$value);
		if($data->user !=null)
		{
			$basket->set('data',$data);
		}else
		{
			unset($data->user);
			$data->error = " user for $feild=$value not found";
			$basket->set('data',$data);
		}
		}else
		{
			$data->error = "Enter the query item";
			$basket->set('data',$data);
		}
		kite::render('data');
	}	
	

}

?>