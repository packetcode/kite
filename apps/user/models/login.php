<?php
defined('_KITE') or die;

class UserModelLogin{

	public function checkUser($username,$password)
	{
		$pdo = kite::getInstance('pdo');
		$table = kite::getTablePrefix('users');
		$sql = "SELECT * FROM $table WHERE username = :name";
		$stmt = $pdo->prepare($sql);
		$stmt->execute(array('name' => $username));

		foreach ($stmt as $result) {
		}
		if(isset($result))
		{
			if($result['password']==md5($password))
			{
			$this->_setUserSession($result);
			$msg->check=1;
			}else
			{
			$msg->check=0;
			$msg->error = 'Wrong Password';
			}
		}else
		{
			$msg->check=0;
			$msg->error = 'User not found';
		}
		return $msg;

	}
	
	public function _setUserSession($result)
	{
		$session = kite::getInstance('session');
		$session->start();
		foreach($result as $key =>$value)
			if(!is_int($key))
				$user->$key = $value;
				unset($user->password);
		$session->set('user',$user);
	}
	
	public function checkSocialUser($username)
	{
		$pdo = kite::getInstance('pdo');
		$table = kite::getTablePrefix('social');
		$sql = "SELECT * FROM $table WHERE username = :name";
		$stmt = $pdo->prepare($sql);
		$stmt->execute(array('name' => $username));
		if(isset($result))
		{
			$msg->check=1;
		}else
		{
			$msg->check=0;
			$msg->error = 'User not found';
		}
		return $msg;
	}
	
	public function insertSocialUser($user)
	{
		$pdo = kite::getInstance('pdo');
		$table = kite::getTablePrefix('social');
		$username = $user->username;
		$service = $user->service;
		$image = $user->image;
		$pdo->exec("INSERT INTO $table (username,service,image) VALUES('$username','$service','$image')");
		return $pdo->lastInsertId();
	}
	
	public function insertUser($user)
	{
		$pdo = kite::getInstance('pdo');
		$table = kite::getTablePrefix('users');
		//user data
		$name = $user->name;
		$username = $user->username;
		$email = $user->email;
		$password = $user->password;
		$image = $user->image;
		$type = $user->type;
		$block = '0';
		$activation = $user->activation;
		$register_ts = $time;
		
		$sql = 	"INSERT INTO $table 
										(name,username,email,password,image,type,block,activation,register_ts) 
						VALUES ('$name','$username','$email','$password','$image',$type,$block,'$activation','$register_ts')";
		$pdo->exec($sql);
		return $pdo->lastInsertId();
	}
	
	public function updateSocialUserId($uid)
	{
	
	}
	

	
}
?>