<?php
 //https://developers.google.com/api-client-library/php/guide/aaa_oauth2_web
//http://enarion.net/programming/php/google-client-api/google-client-api-php/
session_start();

  $google_dir = "http://www.prashanthr.info/portfolio/projects/coffee-break/app/includes/auth/Google";
  //$google_dir_client = $google_dir."$";
  //$google_dir_services = "http://www.prashanthr.info/portfolio/projects/coffee-break/app/includes/auth/Google";
  //$google_dir = "http://www.prashanthr.info/portfolio/projects/coffee-break/app/includes/auth/Google";
  include_once ($google_dir."/Client.php");
  include_once ($google_dir."/Service/Analytics.php");
//   $client = new Google_Client();
//   $client->setClientId('554125442476.apps.googleusercontent.com');
//   $client->setClientSecret('Hk15_ii5IXxHjvpt3N66scu6');
//   $client->setRedirectUri('http://www.google.com');
//   $client->setDeveloperKey('AIzaSyCK4T084bey0QxzzW-0Tq0yrixmdYRVGgc');
  
//   // $service = new Google_Service_Books($client);
//   // $optParams = array('filter' => 'free-ebooks');
//   // $results = $service->volumes->listVolumes('Henry David Thoreau', $optParams);

//   // foreach ($results as $item) {
//   //   echo $item['volumeInfo']['title'], "<br /> \n";
//   // }

//   if (isset($_GET['code'])) {
//     echo $GET['code'];  
//   $client->authenticate($_GET['code']);
//   $_SESSION['access_token'] = $client->getAccessToken();
//   $redirect = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
//   header('Location: ' . filter_var($redirect, FILTER_SANITIZE_URL));
//   //header('Location: http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']);
//   //header('Location: google.com');
// }


$scriptUri = "http://".$_SERVER["HTTP_HOST"].$_SERVER['PHP_SELF'];
//echo $scriptUri;

$client = new Google_Client();
$client->setAccessType('online'); // default: offline
$client->setApplicationName('Coffee Break');
$client->setClientId('554125442476-qmafbnfesorqof9iobcje6v61b9p6f95.apps.googleusercontent.com');
$client->setClientSecret('ASkRc7LPaXjSU-jhk8D5VYwh');
$client->setRedirectUri($scriptUri);
$client->setDeveloperKey('AIzaSyCK4T084bey0QxzzW-0Tq0yrixmdYRVGgc'); // API key

// $service implements the client interface, has to be set before auth call
$service = new Google_AnalyticsService($client);

if (isset($_GET['logout'])) { // logout: destroy token
    unset($_SESSION['token']);
  die('Logged out.');
}

if (isset($_GET['code'])) { // we received the positive auth callback, get the token and store it in session
    $client->authenticate();
    $_SESSION['token'] = $client->getAccessToken();
}

if (isset($_SESSION['token'])) { // extract token from session and configure client
    $token = $_SESSION['token'];
    $client->setAccessToken($token);
}

if (!$client->getAccessToken()) { // auth call to google
    $authUrl = $client->createAuthUrl();
    header("Location: ".$authUrl);
    die;
}
echo 'Hello, world.';


?>