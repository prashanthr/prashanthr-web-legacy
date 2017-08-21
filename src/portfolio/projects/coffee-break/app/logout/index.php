<?php
session_start();
include ('../includes/includes.php');
include ('../includes/functions.php');
// include ('../includes/db.php');
// //var_dump($_SESSION); 
// session_unset();
// session_destroy();
// //session_write_close();
// session_start();
// alertCache('You have been logged out');
// header("Location: $home");

	/*require("http://www.prashanthr.info/portfolio/projects/coffee-break/app/includes/fbphpsdk/facebook.php");
	$facebook = new Facebook(array(
  	'appId'  => '521518067900515',
  	'secret' => '5d9008b06be657844061f011192c5315',
	));

   	//ovewrites the cookie
   	$facebook->setSession(null);
 */

    //delete graphs!
    include('../includes/updateBeforeLogout.php');
    
   	session_unset();
   	session_destroy();
 	
   	//redirects to index
   	header('Location: http://www.prashanthr.info/portfolio/projects/coffee-break/app');

?>