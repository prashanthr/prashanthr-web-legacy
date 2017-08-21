<?php
	include('db.php');
	include('fbphpsdk/facebook.php');

	if($_SESSION['LOGGED_IN'] == "TRUE")
	{
		if($_SESSION['USER'] == "GUEST")
		{

		}
		else
		{
			if($user)
			{
				$email = $_SESSION['USEREMAIL'];
				$last_login_timestamp = date("Y-m-d H:i:s");
				mysql_query("UPDATE users SET last_login='$last_login_timestamp' WHERE email='$email'");
			}
		}
	}
	else
	{

	}
?>