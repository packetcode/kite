<?php
defined('_KITE') or die;

class UserModelData{
	
	public function getUserData($item,$feild,$value)
	{
		$pdo = kite::getInstance('pdo');
		$table = kite::getTablePrefix('users');
		$sql = "SELECT $item FROM $table WHERE $feild = '$value'";
		$stmt = $pdo->query($sql);
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
		if($result)
		foreach ($result as $key => $value)
			return $value[$item];
	}
	
	public function getUserAllData($feild,$value)
	{
		$pdo = kite::getInstance('pdo');
		$table = kite::getTablePrefix('users');
		$sql = "SELECT id,name,username,email,image FROM $table WHERE $feild = '$value'";
		$stmt = $pdo->query($sql);
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
		if($result)
			return $result['0'];
		else
			return null;
	}
}
?>