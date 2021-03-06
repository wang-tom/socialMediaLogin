<?php

class socialmedia_oauth_connect
{

  	public $socialmedia_oauth_connect_version = '1.0';

	public $client_id;
	public $client_secret;
	public $scope;
	public $responseType;
	public $nonce;
	public $state;
	public $redirect_uri;
	public $code;
	public $oauth_version;
	public $provider;
	public $accessToken;  
	
	protected $requestUrl;
  	protected $accessTokenUrl;
  	protected $dialogUrl;
	protected $userProfileUrl;
	protected $header;
	
  	public function Initialize(){
  		$this->nonce = time() . rand();
  		switch($this->provider)
		{
			case '';
				break;
				
			case 'Paypal':
				$this->oauth_version="2.0";			
				$this->dialogUrl = 'https://www.paypal.com/webapps/auth/protocol/openidconnect/v1/authorize?';
				$this->accessTokenUrl = 'https://www.paypal.com/webapps/auth/protocol/openidconnect/v1/tokenservice?';
				$this->responseType="code";
				$this->state="";
				$this->userProfileUrl = "https://www.paypal.com/webapps/auth/protocol/openidconnect/v1/userinfo?schema=openid&access_token=";
				$this->header="";
				break;
				
			case 'Google':
				$this->oauth_version="2.0";			
				$this->dialogUrl = 'https://accounts.google.com/o/oauth2/auth?';
				$this->accessTokenUrl = 'https://accounts.google.com/o/oauth2/token';
				$this->responseType="code";
				$this->userProfileUrl = "https://www.googleapis.com/oauth2/v1/userinfo?access_token=";
				$this->header="Authorization: Bearer ";	
				break;
			case 'Microsoft':
				$this->oauth_version="2.0";			
				$this->dialogUrl = 'https://login.live.com/oauth20_authorize.srf?';
				$this->accessTokenUrl = 'https://login.live.com/oauth20_token.srf';
				$this->responseType="code";
				$this->userProfileUrl = "https://apis.live.net/v5.0/me?access_token=";
				$this->header="";
				break;
			
			case 'LinkedIn':
				$this->oauth_version="2.0";			
				$this->dialogUrl = 'https://www.linkedin.com/uas/oauth2/authorization?';
				$this->accessTokenUrl = 'https://www.linkedin.com/uas/oauth2/accessToken?';
				$this->responseType="code";
				$this->userProfileUrl = "https://api.linkedin.com/v1/people/~?format=json&oauth2_access_token=";
				break;

			default:
				return($this->provider.'is not yet a supported. We will release soon. Contact kayalshri@gmail.com!' );	
		}
  	}
  	
 

  	public function Authorize(){
  	
  		if($this->oauth_version == "2.0"){
  	    $dialog_url = $this->dialogUrl
  	    		."client_id=".$this->client_id
			."&response_type=".$this->responseType
			."&scope=".$this->scope
			/*."&nonce=".$this->nonce*/
			."&state=".$this->state
        	."&redirect_uri=".urlencode($this->redirect_uri);
     		echo("<script> top.location.href='" . $dialog_url . "'</script>");
     		}else{

			$date = new DateTime();
     			$request_url = $this->requestUrl;
     			$postvals ="oauth_consumer_key=".$this->client_id
     					."&oauth_signature_method=HMAC-SHA1"
     					."&oauth_timestamp=".$date->getTimestamp()
     					."&oauth_nonce=".$this->nonce
     					."&oauth_callback=".$this->redirect_uri
     					."&oauth_signature=".$this->client_secret
     					."&oauth_version=1.0";
     			$redirect_url = $request_url."".$postvals;
     			
   			

     			$oauth_redirect_value= $this->curl_request($redirect_url,'GET','');

  			$dialog_url = $this->dialogUrl.$oauth_redirect_value;
     			     			
     			echo("<script> top.location.href='" . $dialog_url . "'</script>");
     		}

  	}
  	

  	public function getAccessToken(){
		$postvals = "client_id=".$this->client_id
			."&client_secret=".$this->client_secret
			."&grant_type=authorization_code"
			."&redirect_uri=".urlencode($this->redirect_uri)
			."&code=".$this->code;
		return $this->curl_request($this->accessTokenUrl,'POST',$postvals);
  	}
  	
  	public function getUserProfile(){
  		$getAccessToken_value = $this->getAccessToken();
  		$getatoken = json_decode( stripslashes($getAccessToken_value) );

		if( $getatoken === NULL ){
			$atoken=$getAccessToken_value;
   		}else{
	   		$atoken = $getatoken->access_token;
   		}   
   		
   		if($this->provider=="Yammer"){
   			$atoken = $getatoken->access_token->token;
   		}
	  	
	  	if ($this->userProfileUrl){
  		$profile_url = $this->userProfileUrl."".$atoken;
  		#$_SESSION['atoken']=$atoken;
		#print "profile :".$profile_url;
		#exit();
		
		return $this->curl_request($profile_url,"GET",$atoken);
		}else{
		return $getAccessToken_value;
		}

  	} 
  	
  	public function APIcall($url){
	  	return $this->curl_request($url,"GET",$_SESSION['atoken']);
  	}
  	
  	public function debugJson($data){
  		echo "<pre>";
  		print_r($data);
  		echo "</pre>";
  		
		# Redirect where ever you need **************************************************************
		#$c_session = $this->provider."_profile";
  		#$_SESSION[$this->provider] = "true";
		#$_SESSION[$c_session] = $data;

		#echo("<script> top.location.href='index.php#".$this->provider."'</script>");
  		
  	}
	/*************googleapis***********/
	public function debugGoogleJson($data){
		//print_r($data);
		$id  = $data->id; $email = $data->email; $gName = $data->given_name; $fName = $data->family_name; $gender = $data->gender;
		echo "<script type=\"text/javascript\">
		$.ajax({
			url: '../ajax_customers_social_media_login.php?ajax_request_action=google',
			data: 'gid='+'".$id."'+'&email='+'".$email."'+'&gName='+'".$gName."'+'&fName='+'".$fName."'+'&gender='+'".$gender."', 
			type: 'POST',
		  	success: function(data){
				if('ok' == data) window.location.href ='http://www.fiberstore.com';
			}
		})
		</script>";
	}
	/*************paypalpis***********/
	public function debugPaypalJson($data){
		//print_r($data);
		$email = $data->email; $gName = $data->given_name; $fName = $data->family_name; $zoneinfo = $data->zoneinfo;
		echo "<script type=\"text/javascript\">
		$.ajax({
			url: '../ajax_customers_social_media_login.php?ajax_request_action=paypal',
			data: 'email='+'".$email."'+'&gName='+'".$gName."'+'&fName='+'".$fName."'+'&zoneinfo='+'".$zoneinfo."', 
			type: 'POST',
		  	success: function(data){
				if('ok' == data) window.location.href ='http://www.fiberstore.com';
			}
		})
		</script>";
		
	}
		/*************msnapis***********/
	public function debugMsnJson($data){
		print_r($data);
	}
	
	public function curl_request($url,$method,$postvals){
	
	$ch = curl_init($url);
	if ($method == "POST"){
	   $options = array(
                CURLOPT_POST => 1,
                CURLOPT_POSTFIELDS => $postvals,
                CURLOPT_RETURNTRANSFER => 1,
		);
	
	}else{
	
	   $options = array(
                CURLOPT_RETURNTRANSFER => 1,
		);
	
	}
	curl_setopt_array( $ch, $options );
	if($this->header){
	
		curl_setopt( $ch, CURLOPT_HTTPHEADER, array( $this->header . $postvals) );
	}
	
	$response = curl_exec($ch);
	curl_close($ch);
#	print_r($response);
	return $response;
	}
 
}

?>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>