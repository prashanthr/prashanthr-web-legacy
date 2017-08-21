<?php
/* header.php - Prashanth Rajaram */
session_start();
include ('includes.php');
include ('functions.php');
include ('db.php');

if($_GET['USER'] == "GUEST")
{
  $_SESSION['USER'] = "GUEST";
  $_SESSION['USEREMAIL'] = "GUESTUSER";
  $_SESSION['LOGGED_IN'] = "TRUE";
  $_SESSION['LOGIN_TYPE'] = "Guest";
}
else if($_GET['LOGIN_TYPE'] == "Coffee")
{
  $_SESSION['LOGIN_TYPE'] = "Coffee";
  $LOGIN_CREDENTIALS_EMAIL = $_POST['login-email'];
  $LOGIN_CREDENTIALS_PWD = $_POST['login-pwd'];
}
else if($_GET['LOGIN_TYPE'] == "Facebook")
{
  $_SESSION['LOGIN_TYPE'] = "Facebook";  

}
else if($_GET['LOGIN_TYPE'] == "Google")
{
  $_SESSION['LOGIN_TYPE'] = "Google";
}
else
{
   //$_SESSION['LOGIN_TYPE'] = "None";
   //$_SESSION['LOGGED_IN'] = "FALSE";   

}
  

if($_SESSION['LOGIN_TYPE'] == "Guest")
{
  //$user = "GUEST";
}
else if($_SESSION['LOGIN_TYPE'] == "Coffee")
{
  //echo "USER ".$LOGIN_CREDENTIALS_EMAIL." ";
  //echo "PWD ".$LOGIN_CREDENTIALS_PWD;
}
else if($_SESSION['LOGIN_TYPE'] == "Google")
{

}
else if($_SESSION['LOGIN_TYPE'] == "Facebook")
{

//FACEBOOK PHP SDK
  require_once("fbphpsdk/facebook.php");

  // $config = array();
  // $config[‘appId’] = '521518067900515';
  // $config[‘secret’] = '5d9008b06be657844061f011192c5315';
  // $config[‘fileUpload’] = false; // optional

  // $facebook = new Facebook($config);

//if(!isset($_GET['USER']))
// {
    $facebook = new Facebook(array(
      'appId'  => '521518067900515',
      'secret' => '5d9008b06be657844061f011192c5315',
    ));

      // Get User ID
      $user = $facebook->getUser();

      if ($user) {
      try {
        // Proceed knowing you have a logged in user who's authenticated.
        $user_profile = $facebook->api('/me');
        
        $_SESSION['LOGGED_IN'] = "TRUE";

      } catch (FacebookApiException $e) {
        error_log($e);
        $user = null;
      }
    }

    if ($user) {
      //$logoutUrl = $facebook->getLogoutUrl();
      $logoutUrl = $facebook->getLogoutUrl(array(
       'next'=>'http://www.prashanthr.info/portfolio/projects/coffee-break/app/logout/'
      ));
    } else {
      $loginUrl = $facebook->getLoginUrl();
      /*$loginUrl = $facebook->getLoginUrl(array(
            'redirect_uri' => 'http://www.prashanthr.info/portfolio/projects/coffee-break/app',
            ));*/
      header("Location: $loginUrl");
    }


// }
// else
// {
//    $user = "GUEST_USER";
//    echo "hi";
// } 
}
else
{

}
?>