<?php

final class AuthenticationHelper {
	
	public function generateAuthenticationOAuth(){
	
		$time = time()*1000;
		$microtime = microtime();
		$rand = mt_rand();
	
		$signature = array(
				"oauth_consumer_key"=>Config::oAuthConsumerKey,
				"oauth_nonce"=>md5( $microtime . $rand ),
				"oauth_signature_method"=>Config::oAuthSignatureMethod,
				"oauth_timestamp"=>$time,
				"oauth_version"=>Config::oAuthVersion,
		);
	
		$signature = base64_encode(http_build_query($signature, '', '&'));
	
		$oAuth = array("Authorization: OAuth realm=".Config::oAuthRealm.
				",oauth_consumer_key=".Config::oAuthConsumerKey.
				",oauth_nonce=".md5( $microtime. $rand ).
				",oauth_signature=".$signature.
				",oauth_signature_method=".Config::oAuthSignatureMethod.
				",oauth_timestamp=".$time.
				",oauth_version=".Config::oAuthVersion,
				"Content-Type:application/x-www-form-urlencoded; charset=".Config::transactionCharset,
		);
		return $oAuth;
	}
	
	public function generateAuthenticationBasic(){
		return array(
				'Authorization: Basic '.base64_encode(Config::credentialsEmail.':'.Config::credentialsToken),
				"Content-Type: application/x-www-form-urlencoded; charset=".Config::accountCharset);
	}
}
?>