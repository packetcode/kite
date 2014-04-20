<?php
defined('_KITE') or die;

class mathcontrollerroot {

	public function main()
	{
		$options= array('d'=>'2','e'=>'3');
		$results = Kite::connect('math','add',$options);
		$basket = KITE::getInstance('basket');
		$kite = KITE::getInstance('kite');
		$basket->set('msg','This sample message');
		kite::render('main');
	
	}
	
	public function addition()
	{
		$request = KITE::getInstance('request');
		$basket = KITE::getInstance('basket');
		if($request->get('a'))
		{

			$a = $request->get('a');
			$b =$request->get('b');
			$request->set('k','4');
			$result = $a+$b;
			$basket->set('result',$result);
			//$model=$this->getModel('math');
			//$model->insert('addition',$a,$b,$result);
		}
		$basket->set('operation','Addition');
		//var_dump(kite::getInstance('node'));
		
		kite::render('operation');
	}
	
	
	public function subtraction()
	{
		$request = KITE::getInstance('request');
		$basket = KITE::getInstance('basket');
		if(isset($request->a))
		{
			$a = $request->get('a');
			$b =$request->get('b');
			$result = $a-$b;
			$basket->set('result',$result);
			$model=$this->getModel('math');
			$model->insert('subtraction',$a,$b,$result);
		}
		$basket->set('operation','Subtraction');
		kite::render('operation');
	}
	
	public function multiplication()
	{
		$request = KITE::getInstance('request');
		$basket = KITE::getInstance('basket');
		if(isset($request->a))
		{
			$a = $request->get('a');
			$b =$request->get('b');
			$result = $a*$b;
			$basket->set('result',$result);
			$model=$this->getModel('math');
			$model->insert('multiplication',$a,$b,$result);
		}
		$basket->set('operation','Multiplication');
		$this->render('operation');
	}
	
	public function stats()
	{
		$model=$this->getModel('math');
		$model->stats();
		$this->render('stats');
	}
	
	public function load()
	{
		$time = kite::getClip('time')->sqlTimeAgo('2014-04-17 16:02:58');
		echo $time;
	}
	public function log()
	{
		$model=$this->getModel('math');
		$model->log();
		$this->render('log');
	}
	
	public function _abc()
	{
		return 'abc';
	}

}

?>