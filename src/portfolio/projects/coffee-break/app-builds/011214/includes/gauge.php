<?php
/* gauge.php */
	//connect to db
	session_start();
	include('db.php');

	
		$local_user_email = $_SESSION['USEREMAIL'];
		
		$infoQuery = mysql_query("SELECT caffeine_points,caffeine_level FROM users WHERE email = '$local_user_email' ");
		while($row = mysql_fetch_row($infoQuery))
		{	
			$c_points = $row[0];
			$c_level = $row[1];			
		}
			
			
		//$sparkline_sample_data_array = new Array(7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 11.0, 20.0, 11.0, 14.0, 18.0, 7.0, 13.7);
		//$_SESSION['sparkline_data'] = $sparkline_sample_data_array;
		//echo "7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 11.0, 20.0, 11.0, 14.0, 18.0, 7.0, 13.7";
		echo "10";
		//echo "$c_level";
?>