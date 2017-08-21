<?php
/* includes.php - Prashanth Rajaram */
$app_version = "2.0";
$prashanthr = "http://www.prashanthr.info";
$year = date("Y");

$home = "http://www.prashanthr.info/portfolio/projects/coffee-break/app";
$about = "$home/about";
$images = "$home/images";
$includes = "$home/includes";
$styles = "$home/styles";
$scripts = "$home/scripts";
$about = "$home/about";
$contact = "$prashanthr/contact/?version=message";//"$home/contact";
$help = "$home/help";
$account = "$home/account";
$profile = "$home/profile";
$dashboard = "$home/dashboard";
$desk = "$home/desk";
$technology = "$home/technology";
$setup = "$home/setup";
$levelpg = "$home/level";
$login = "$home/login";
$logout = "$home/logout";
$verifyLogin = "$login/verify.php";
$terms = "$home/terms";
$credits = "$home/credits";

$sign = "Prashanth Rajaram &copy;$year";
$fontawesomepath = "$includes/font-awesome/font-awesome/css/font-awesome.min.css"; 
$bootstrappath = "$includes/bootstrap/bootstrap/css/bootstrap.min.css";

$file_prefix = "..";
$include_file_prefix = "$file_prefix/includes";


$userAction = "";
$GuestLoginUrl = "$home?USER=GUEST";
$GuestLogoutUrl = "$logout";
$loginUrl = $GuestLoginUrl;
$logoutUrl = $GuestLogoutUrl;
$googleLoginURI = "";
$googleLogoutURI ="";
$preFacebookUri = "$home?LOGIN_TYPE=Facebook";
$preGoogleUri = "$home?LOGIN_TYPE=Google";

$titleArray = array("Home" => "Coffee Break - Home", "Dashboard" => "Coffee Break - Dashboard", "Desk" => "Coffee Break - Desk", "Account" => "Coffee Break - Account", "Help" => "Coffee Break - Help", "Technology" => "Coffee Break - Technology", "Setup" => "Coffee Break - Setup", "Terms" => "Coffee Break - Terms and Conditions", "Credits" => "Coffee Break - Credits", "Level" => "Coffee Break - Level", "Login" => "Coffee Break - Login");

$coffeeExplainerVideo = "<iframe width='220' height='150' src='http://www.youtube.com/embed/60MQ3AG1c8o' frameborder='0' allowfullscreen></iframe>";

?>