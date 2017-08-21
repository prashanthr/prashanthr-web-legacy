<?php
/* music/lastfm/auth/index.php - Prashanth Rajaram */
/*
API Key: 862cc5abce0d843b1ff21f9ddf16e0c6
Secret: is 1bc556c6492c24dd940adc6aa11fbdfb
*/
/* Test Authentication http://www.last.fm/api/auth/?api_key=862cc5abce0d843b1ff21f9ddf16e0c6 */

session_start();
$api_key = "862cc5abce0d843b1ff21f9ddf16e0c6";
$secret = "1bc556c6492c24dd940adc6aa11fbdfb";
$api_root = "http://ws.audioscrobbler.com/2.0";
$message = "";
$settingsPg = "http://www.prashanthr.info/portfolio/projects/coffee-break/app/account/?tab=settings&message=";
$get_session_url = "$api_root/";
$get_session_method = "auth.getSession";
$token_append_string="&token=";
$api_key_append_string="&api_key=";
$api_sig_append_string = "&api_sig=";
// if(isset($_GET['token']))
// {
// 	$lastfm_token = $_GET['token'];
// 	$_SESSION['USER_LASTFM_TOKEN'] = $lastfm_token;
// 	//echo "USER SESSION TOKEN IS - ".$lastfm_token;
// 	$message= "lastfm_auth_success";
// 	header("Location: $settingsPg$message");
// }
// else
// {
// 	//echo "NO TOKEN RECEIVED FROM LAST FM";
// 	$message = "lastfm_auth_error";
// 	header("Location: $settingsPg$message");
// }

if(isset($_GET['token']))
{
	$lastfm_token = $_GET['token'];
	$_SESSION['USER_LASTFM_TOKEN'] = $lastfm_token;
	//echo "USER SESSION TOKEN IS - ".$lastfm_token;
	$message= "lastfm_auth_success";
	//header("Location: $settingsPg$message");
	$api_sig_pre = "api_key".$api_key."method".$get_session_method."token".$lastfm_token.$secret;
	$api_sig = md5($api_sig_pre);
	header("Location: $get_session_url$token_append_string$lastfm_token$api_key_append_string$api_key$api_sig_append_string$api_sig");
}
else
{
	//echo "NO TOKEN RECEIVED FROM LAST FM";
	$message = "lastfm_auth_error";
	header("Location: $settingsPg$message");
}
?>