<?php

session_start();
require_once('lib/twitteroauth/twitteroauth.php');
$CONSUMER_KEY='QbKR8TZLPo2IXH5mmVA4A';
$CONSUMER_SECRET='9NcMtUhD6MTeFPLX28y9sLYFzNSg5kQczcHybS30Wlw';
$OAUTH_CALLBACK='http://feedstack.asia/user/ok';

$connection = new TwitterOAuth($CONSUMER_KEY, $CONSUMER_SECRET);
$request_token = $connection->getRequestToken($OAUTH_CALLBACK); //get Request Token
 
if( $request_token)
{
    $token = $request_token['oauth_token'];
    $_SESSION['request_token'] = $token ;
    $_SESSION['request_token_secret'] = $request_token['oauth_token_secret'];
 
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
?>
