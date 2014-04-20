<?php

session_start();
require_once('lib/twitteroauth/twitteroauth.php');
$CONSUMER_KEY='QbKR8TZLPo2IXH5mmVA4A';
$CONSUMER_SECRET='9NcMtUhD6MTeFPLX28y9sLYFzNSg5kQczcHybS30Wlw';
$OAUTH_CALLBACK='http://feedstack.asia/user/ok';
?>
<?php
 
if(isset($_GET['oauth_token']))
{
	
    $connection = new TwitterOAuth($CONSUMER_KEY, $CONSUMER_SECRET, $_SESSION['request_token'], $_SESSION['request_token_secret']);
    $access_token = $connection->getAccessToken($_REQUEST['oauth_verifier']);

    if($access_token)
    {

		$params =array();
        $params['include_entities']='false';
        $content = $connection->get('account/verify_credentials',$params);

        if($content && isset($content->screen_name) && isset($content->name))
        {
 
            echo $content->name;
			echo "<br>".$content->profile_image_url;
			echo "<br>".$content->screen_name;
 
        }
        else
        {
               echo "<h4> Login Error </h4>";
        }
	}	
 }
 else
{
 
    echo "<h4> Login Error </h4>";
}
?>
