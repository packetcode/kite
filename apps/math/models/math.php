<?php
defined('_KITE') or die;

class MathModelMath{

	public function insert($operation,$a,$b,$result)
	{
		$pdo = KITE::getInstance('pdo');
		$time_stamp = date("Y:m:d H:i:s");
		$table = Kite::getTablePrefix('maths');
		$pdo->exec("INSERT INTO $table (operation,a,b,result,time_stamp) VALUES('$operation',$a,$b,$result,'$time_stamp')");
		
	}
	
	public function load()
	{
		$pdo = KITE::getInstance('pdo');
		$time_stamp = date("Y:m:d H:i:s");
		$table = Kite::getTablePrefix('maths');
		$pdo->exec("INSERT INTO $table (operation,a,b,result,time_stamp) VALUES('$operation',$a,$b,$result,'$time_stamp')");
		
	}
	
	public function ohlc()
	{
			$dom = DOMDocument::load( 'testing.xml');
			$rows = $dom->getElementsByTagName( 'Row' );
			$b=0;
		  foreach ($rows as $row)
		  {
			$cells = $row->getElementsByTagName( 'Cell' );
			$one = true;
			$i=0;
			$break=0;
			  foreach( $cells as $cell )
			  { 
				if($i==0)
					$dat = $cell->nodeValue;
				if($i==1)
					$o =round($cell->nodeValue, 5);
				if($i==2)
					$h= round($cell->nodeValue, 5);
				if($i==3)
					$l= round($cell->nodeValue, 5);
				if($i==4)
					$c =round($cell->nodeValue, 5);
			  if(!$one)
			  echo "";//round($cell->nodeValue, 5)."&nbsp;&nbsp;&nbsp;";
			  else
			  {
				$a =$this->dat($cell->nodeValue);
				if($a-1 !=$b)
					$break =  1;	
				$b =$this->dat($cell->nodeValue);
				// echo $cell->nodeValue."&nbsp;&nbsp;&nbsp;";
				} 
				$one = false;
				$i=$i+1;
			  }
			  $pdo = KITE::getInstance('pdo');
			$table = Kite::getTablePrefix('ohlc');
			echo "<br>".$dat." ".$o." ".$h." ".$l." ".$c."<br><br>";
			$pdo->exec("INSERT INTO $table (date,break,o,h,l,c) VALUES('$dat',$break,$o,$h,$l,$c)");
			  //echo "<br>";
		  }
		  
	}
  function dat($dat)
  {
	$dat =explode('.',$dat);
	return $dat[2];
  }
	
	public function log()
	{
		$pdo = KITE::getInstance('pdo');
		$table = Kite::getTablePrefix('maths');
		$stmt = $pdo->query("SELECT * from $table");
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$basket = KITE::getInstance('basket');
		foreach($result as $key =>$value)
			$basket->set('a'.$key,$value);
	}	
	
	public function stats()
	{
		$pdo = KITE::getInstance('pdo');
		$table = Kite::getTablePrefix('ohlc');
		$stmt = $pdo->query("SELECT * from $table");
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$basket = KITE::getInstance('basket');
		foreach($result as $key =>$value)
			$basket->set('a'.$key,$value);
		$a = $this->demark();	
		foreach ($basket as $key => $value) {
            unset($basket->$key);
        }
		foreach($a as $key =>$value)
			$basket->$key = $value;
		//var_dump($basket);	
	}
	
	public function demark()
	{
		$basket = KITE::getInstance('basket');
		$i=$j=$k=$o=$h=$l=$c=$sum=0;
		foreach($basket as $key =>$value)
		{
			
			if($c <$o)
				$x= ($h+($l*2)+$c);
			if($c>$o)
				$x = (($h*2)+$l+$c);
			if($c==$o)
				$x = ($h+$l+($c*2));
			$r=($x/2)-$l;
			$s=($x/2)-$h;
			$p =$x/4;
			$a->$key->r = round($r, 5);
			$a->$key->s =round($s, 5);
			$a->$key->p =round($p, 5);
			
			$dat = $value['date'];
			$o = round($value['o'], 5) ;
			$h = round($value['h'], 5);
			$l = round($value['l'], 5);
			$c = round($value['c'], 5);
			$a->$key->o = (float)$o;
			$a->$key->h = (float)$h;
			$a->$key->l =  (float)$l;
			$a->$key->c = (float)$c;
			$a->$key->dat = $dat;
			$a->$key->pip =round($a->$key->p - $a->$key->o, 5) * 10000;
			if($a->$key->pip <0)
			{
				if($a->$key->l < $a->$key->p)
					$a->$key->hit = 'yes';
				else
					$a->$key->hit = 'no';
					$a->$key->max = $a->$key->l - $a->$key->o;
			}else{
				if($a->$key->h > $a->$key->p)
					$a->$key->hit = 'yes';
				else
					$a->$key->hit = 'no';
					$a->$key->max = $a->$key->h - $a->$key->o;
			}
			if($a->$key->hit =='no')
				$k= $k+1;
			$a->$key->max = round($a->$key->max, 5) * 10000;
			if($value['break']==1)
			{
				$j=$j+1;
				foreach($a->$key as $p => $q)
					$a->$key->$p = '';
			}		
			$i=$i+1;
			if($a->$key->pip <0)
				$sum= $sum+(-1 *$a->$key->pip);
			else
				$sum = $sum +$a->$key->pip;
		}
		
			echo $i-$j." ".$sum/($i-$j);
		return $a;
	}

}

?>