<?php
defined('_KITE') or die;

class UserControllerCore{

	public function login()
	{
		$kite= kite::getInstance('kite');
		$session = kite::getInstance('session');
		$request = kite::getInstance('request');
		$basket = kite::getInstance('basket');
		$redirect= trim($request->get('redirect'));
		if($redirect==null)
			$redirect = ROOT.$kite->get('SESSION_REDIRECT_URL');
		$error = $request->get('error');
		if($error!=null)
			$basket->set('error',$error);
		
		$node = kite::getInstance('node');
		$ext = $node->get('terminal_ext');
		$session->start();
		$username = $request->get('username');
		$kite->set('layout','login');
		if($username==null)
		{
			$user = $session->get('user');
			if($user==null)
			{
				$basket->set('loggedin','0');
				if($ext)
					$basket->set('error','Username is empty');
				kite::render('login');
			}else
			{	
				$basket->set('loggedin','1');
				kite::render('login','loggedin');
			}	
		}else
		{
			$model = kite::getModel('login');
			$username = $request->filterSQL('username');
			$password = $request->filterSQL('password');
			
			$msg= $model->checkUser($username,$password);
			if($msg->check)
			{
				$basket->set('loggedin','1');
				if(!$ext){
					kite::redirect($redirect);
				}else{
					kite::render('login');
				}	
			}else{
				$basket = kite::getInstance('basket');
				$basket->set('loggedin','0');
				$basket->set('error',$msg->error);
				kite::render('login');
			}	
		}

	}
	
	
	public function twitter()
	{
		$appl = kite::getInstance('application');
		$session = kite::getInstance('session');
		$session->start();
		$twitter = $appl->get('twitter');
		require_once('apps/user/lib/twitteroauth/twitteroauth.php');
		
		$connection = new TwitterOAuth($twitter->CONSUMER_KEY, $twitter->CONSUMER_SECRET);
		$request_token = $connection->getRequestToken($twitter->OAUTH_CALLBACK); //get Request Token
		 
		if($request_token)
		{
			$token = $request_token['oauth_token'];
			$session->set('request_token',$token);
			$session->set('request_token_secret',$request_token['oauth_token_secret']);
			  switch ($connection->http_code) 
				{
					case 200:
						$url = $connection->getAuthorizeURL($token);
						//redirect to Twitter .
						header('Location: ' . $url); 
						break;
					default:
						echo "Connection with twitter Failed";
						break;
				}
			 
			}
			else //error receiving request token
			{
				echo "Error Receiving Request Token";
			}
	}
	
	public function twitter_log()
	{	 
		$appl = kite::getInstance('application');
		$session = kite::getInstance('session');
		$session->start();
		$twitter = $appl->get('twitter');
		require_once('apps/user/lib/twitteroauth/twitteroauth.php');
		$connection = new TwitterOAuth($twitter->CONSUMER_KEY, 
																	$twitter->CONSUMER_SECRET,
																	$session->get('request_token'),
																	$session->get('request_token_secret'));
		$access_token = $connection->getAccessToken($_REQUEST['oauth_verifier']);		
		
		if(isset($_GET['oauth_token']))
		{

			if($access_token)
			{
				$params =array();
				$params['include_entities']='false';
				$content = $connection->get('account/verify_credentials',$params);
				if($content && isset($content->screen_name) && isset($content->name))
				{
						$session->set('twitter',$content);
						$user->name = $content->name;
						$user->username = $content->screen_name;
						$user->image = $content->profile_image_url;
						$user->service = 'twitter';
						$this->_social_check($user);
					
					}
					else
					{
						   echo "<h4> Login Error one</h4>";
					}
				}	
			 }
			 else
			{
			 
				echo "<h4> Login Error two</h4>";
			}
	}
	
	public function _social_check($user)
	{	
			$model = kite::getModel('login');
			$check = $model->checkSocialUser($user->username);
			if(!$check->check)
			{
				$social_id = $model->insertSocialUser($user);
				$uid = $model->insertUser($user);
				$model->updateSocialUser($username,$uid);
			}
	}

	public function register()
	{
		$kite= kite::getInstance('kite');
		$kite->set('layout','login');
		kite::render('login','register');
	}
	
	public function logout()
	{
		$session = kite::getInstance('session');
		$session->start();
		$session->clear('user');
		$session->destroy();
		$path = kite::route('user/core/login');
		kite::redirect(ROOT.$path);
	}

}

?>