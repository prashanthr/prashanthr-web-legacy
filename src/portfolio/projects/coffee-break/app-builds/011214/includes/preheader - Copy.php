<?php
/* header.php - Prashanth Rajaram */
session_start();
include ('includes.php');
include ('functions.php');
include ('db.php');


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
    }
// }
// else
// {
//    $user = "GUEST_USER";
//    echo "hi";
// } 

?>