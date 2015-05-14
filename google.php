<?php

include "socialmedia_oauth_connect.php";

$oauth = new socialmedia_oauth_connect();

$oauth->provider="Google";

$oauth->client_id = "990249133375.apps.googleusercontent.com";
$oauth->client_secret = "CYPRhxPZfeqNnhcKfmr0p-ph";
$oauth->scope="https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/plus.me https://www.google.com/m8/feeds";
$oauth->redirect_uri  ="http://www.fiberstore.com/social_media/google.php";

$oauth->Initialize();

@$code = ($_REQUEST["code"]) ?  ($_REQUEST["code"]) : "";

if(empty($code)) {
	$oauth->Authorize();
}else{
	$oauth->code = $code;
	$getData = json_decode($oauth->getUserProfile());
	/* redirect here */
	//$oauth->debugJson($getData);
	$oauth->debugGoogleJson($getData);
}

if(isset($_GET['error']) && 'access_denied' == $_GET['error']){
	header('Location: http://www.fiberstore.com');
}
?>