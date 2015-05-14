<?php

include "socialmedia_oauth_connect.php";

$oauth = new socialmedia_oauth_connect();
$oauth->provider="Paypal";
$oauth->client_id = "AWQBhRCal-xSrqQ78Y_MikISpXF-ajVhAWYbZxK8qeyg85eMj1Wpa7jOdWqw";
$oauth->client_secret = "ENlY7RAK8DEEtjoGyxDq30bz7TGu2GBuubVXg7chd0BxOFmIRPp7AcsbqXrJ";
$oauth->scope="email profile";
$oauth->redirect_uri  ="http://www.fiberstore.com/social_media/paypal.php";

$oauth->Initialize();

@$code = ($_REQUEST["code"]) ?  ($_REQUEST["code"]) : "";

if(empty($code)) {
	$oauth->Authorize();
}else{
	$oauth->code = $code;
#	print $oauth->getAccessToken();
	$getData = json_decode($oauth->getUserProfile());
	//$oauth->debugJson($getData);
	$oauth->debugPaypalJson($getData);
}

if(isset($_GET['error']) && 'access_denied' == $_GET['error']){
	header('Location: http://www.fiberstore.com');
}
?>