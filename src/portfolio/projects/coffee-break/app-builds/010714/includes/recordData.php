<?php
	session_start();
	//connect to db
	include('db.php');

	$method = $_GET['callee'];
	$time = $_GET['time'];

	$_SESSION['currentStopTime'] = $time;

	if(!isset($_SESSION['session']))
	{
		$_SESSION['session'] = TRUE;
		$_SESSION['todayworkhrs'] = 0.00;
		$_SESSION['todaybreakhrs'] = 0.00;
	}

	$_SESSION['lastResumeComputedHours'] = (float) 0.00;
	$_SESSION['lastPauseComputedHours'] = (float) 0.00;
	$_SESSION['lastHourlyComputedHours'] = (float) 0.00;
	$_SESSION['lastComputedHours'] = (float) 0.00;

	

	//perform Computations
	$workhrs = "0.00";
	$breakhrs = "0.00";
	$level = "0";
	
	$timeSlots = explode("-", $time);
	$hours = (float) $timeSlots[0];
	$minutes = (float) $timeSlots[1];
	$seconds = (float) $timeSlots[2];
	
	$computedHours = $hours + ($minutes/60) + ($seconds/(60*60));
	$_SESSION['lastComputedHours'] = (float) $computedHours;

	function computeHours($time)
	{
		$timeSlots = explode("-", $time);
		$hours = (float) $timeSlots[0];
		$minutes = (float) $timeSlots[1];
		$seconds = (float) $timeSlots[2];
	
		$computedHours = $hours + ($minutes/60) + ($seconds/(60*60));
		return $computedHours;
	}

	function handlePause()
	{
		global $computedHours;
		//$_SESSION['lastPauseTime'] = computeHours(Date("g-i-s"));
		$pauseTime = strtotime("now");
		$_SESSION['lastPauseTime'] = $pauseTime;
		$_SESSION['lastPauseComputedHours'] = (float) $computedHours;
		$_SESSION['event_happen'] = 1;
	}

	function handleResume()
	{
		global $computedHours;
		//$_SESSION['todaybreakhrs'] = computeHours(Date("g-i-s")) - $_SESSION['lastPauseTime'];
		$resumeTime  = strtotime("now");
				
		$pauseTime = $_SESSION['lastPauseTime'];
		
		$todaybreakhrs = ($resumeTime - $pauseTime)/(60*60);
		
		if (isset($_SESSION['todaybreakhrs']))
		{
			$_SESSION['todaybreakhrs'] = $_SESSION['todaybreakhrs'] + $todaybreakhrs;
		}
		else
		{
			$_SESSION['todaybreakhrs'] = $todaybreakhrs;
		}
		
		$_SESSION['lastResumeComputedHours'] = (float) $computedHours;
		//echo $resumeTime."--".$pauseTime."-=".$todaybreakhrs;
		//$_SESSION['todaybreakhrs'] = (float) $todaybreakhrs->h;
		$_SESSION['event_happen'] = 1;
	}

	function handleHourly()
	{
		global $computedHours;
		
		$lastResumeComputedHours = (float) $_SESSION['lastResumeComputedHours'];
		$lastPauseComputedHours = (float) $_SESSION['lastPauseComputedHours'];
		$_SESSION['lastHourlyComputedHours'] = ($lastPauseComputedHours > $lastResumeComputedHours ? $lastPauseComputedHours : $lastResumeComputedHours);
		$_SESSION['lastResumeComputedHours'] = $_SESSION['lastHourlyComputedHours'];
		$_SESSION['lastPauseComputedHours'] = $_SESSION['lastHourlyComputedHours'];
		$_SESSION['event_happen'] = 1;
	}

	function updateWorkHrs()
	{
		global $workhrs, $computedHours, $method;

		echo "computedHrs$computedHours/";
		if(isset($_SESSION['todayworkhrs']))
		{
			$todayworkhrs = (float) $_SESSION['todayworkhrs'];
		}
		else
		{
			$todayworkhrs = (float) 0.00;
		}	
		
		// if($method == 'pause')
		// {
		// 	$diffTime = (float) $_SESSION['lastResumeComputedHours'];
		// }
		// else if($method == 'resume')
		// {
		// 	$diffTime = (float) $_SESSION['lastPauseComputedHours'];
		// }
		// else if($method == 'hourly')
		// {
		// 	$diffTime = (float) $_SESSION['lastHourlyComputedHours'];
		// }
		// else
		// {
		// 	$lastResumeComputedHours = (float) $_SESSION['lastResumeComputedHours'];
		// 	$lastPauseComputedHours = (float) $_SESSION['lastPauseComputedHours'];
		// 	$diffTime =  ($lastPauseComputedHours > $lastResumeComputedHours ? $lastPauseComputedHours : $lastResumeComputedHours);
			
		// }
		
		// if($computedHours >= $todayworkhrs)
		// {
		// 	if($diffTime < $computedHours)
		// 	{
		// 		$_SESSION['todayworkhrs'] = (float) $_SESSION['todayworkhrs'] + ($computedHours - $diffTime); 	
		// 	}
		// 	else
		// 	{
		// 		$_SESSION['todayworkhrs'] = (float) $_SESSION['todayworkhrs'] + $computedHours;
		// 	}
			
		// 	echo "true/";
		// }
		// else
		// {
		// 	$_SESSION['todayworkhrs'] = (float) $_SESSION['todayworkhrs'] + ($computedHours - $diffTime); 	
		// 	echo "false/";
		// }

		// echo "//".((float) $_SESSION['todayworkhrs'] + $computedHours - (float)$_SESSION['todaybreakhrs'])."//";
		



			// if($computedHours >= (float) $_SESSION['lastResumeComputedHours'])
			// {
			// 	$_SESSION['todayworkhrs'] = (float) $_SESSION['todayworkhrs'] + ($computedHours - ((float) $_SESSION['lastResumeComputedHours'])); 
			// 	echo "updatingdiff/";
			// }
			// else
			// {
			// 	$_SESSION['todayworkhrs'] = (float) $_SESSION['todayworkhrs'] + $computedHours; 
			// 	echo "updatingfull/";
			// }

		



		if($_SESSION['PG_REQ'] == 1)
		{
		  $_SESSION['todayworkhrs'] = $computedHours;
		}
		else
		{
			
			//first
			if($_SESSION['event_happen'] == 0)
			{
				
				$_SESSION['todayworkhrs_last'] = $_SESSION['todayworkhrs'];
				$_SESSION['todayworkhrs'] = $_SESSION['todayworkhrs_last'] + $computedHours; 
				


			}
			else
			{
				$_SESSION['todayworkhrs'] = $_SESSION['todayworkhrs_last'] + $computedHours; 
			}
			
			
		}


		$workhrs = format_hours($_SESSION['todayworkhrs']);
		$_SESSION['USER_TOTAL_WORK_HRS_SESSION'] = (float) $_SESSION['USER_TOTAL_WORK_HRS'] + $workhrs;
		echo "FINAL/$workhrs/";
	}

	function updateBreakHrs()
	{
		global $breakhrs, $computedHours, $method;

		if(isset($_SESSION['todaybreakhrs']))
		{
			$todaybreakhrs = (float) $_SESSION['todaybreakhrs'];	
		}
		else
		{
			$todaybreakhrs = 0.00;
		}

		
		$breakhrs = format_hours($todaybreakhrs);
		$_SESSION['USER_TOTAL_BREAK_HRS_SESSION'] = (float) $_SESSION['USER_TOTAL_BREAK_HRS'] + $breakhrs;
	}


	function format_hours($hrs)
	{

		$input = number_format($hrs);
	    $input_count = substr_count($input, ',');
	    if($input_count != '0')
	    {
	        if ($input_count == '1')
	        {
	            //return substr($input, 0, -4).'k';
	            return substr($input, 0, -4).'.'.substr($input, 2, -1).'K';
	        } 
	        else if ($input_count == '2')
	        {
	            //return substr($input, 0, -8).'M';
	            return substr($input, 0, -8).'.'.substr($input, 2, -5).'M';
	        } 
	        else if ($input_count == '3')
	        {
	            return substr($input, 0,  -12).'B';
	        } 
	        else 
	        {
	            return;
	        }
	    } 
	    else 
	    {
	        return number_format($hrs, 2, '.', '');
	    }

	}

	function updateRecord($workhrs,$breakhrs, $totw, $totb)
	{
		global $method;

		if($_SESSION["LOGGED_IN"] == "TRUE")
		{
			if($_SESSION['USER'] == "GUEST")
			{
				//echo "GUESTMAN!";
			}
			else
			{
				$email = $_SESSION['USEREMAIL'];
				$updateQuery = mysql_query("UPDATE users SET total_hours_worked='$totw',total_break_hours='$totb' WHERE email='$email'");
				$break_week_update_query = mysql_query("UPDATE break_week SET zero='$breakhrs' WHERE email='$email'");
				$work_week_update_query = mysql_query("UPDATE work_week SET zero='$workhrs' WHERE email='$email'");
				
				//Record Event
				$event_time = date("Y-m-d H:i:s"); // 2001-03-10 17:16:18 (the MySQL DATETIME format)
				$record_time = date("Y-m-d H:i:s"); // 2001-03-10 17:16:18 (the MySQL DATETIME format)
				mysql_query("INSERT INTO events (email,event_name,event_time,record_time) VALUES ('$email','$method','$event_time', '$record_time')") or die(mysql_error());
						
				
				if($updateQuery && $break_week_update_query && $work_week_update_query)
				{
					echo "DB UPDATED!";
				}
				else
				{
					echo "DB NOT UPDATED(";
				}

			}
		}
		
	}

	function updateLevel()
	{
		global $method;
		calculatePoints();
		calculateLevel();		
	}

	/*POINTS ENGINE*/
	function calculatePoints()
	{
		if($_SESSION['LOGGED_IN'] == "TRUE" && (!$_SESSION['USER'] == "GUEST"))
		{
			$email = $_SESSION['USEREMAIL'];
			$scaleFactor = 2.0;
			$constant = (float) $_SESSION['todaybreakhours'] + (float) $_SESSION['todayworkhrs'];
			if($constant >= 2.0)
			{
				$constant = $constant/2.0;
			}
			else
			{
				$constant = $constant;
			}

			if(!isset($_SESSION['POINTS_ENGINE_STARTUP']))
			{
				$_SESSION['POINTS_ENGINE_STARTUP'] = "TRUE";
				$currentPoints = getPoints($email);
				$_SESSION['POINTS_OF_THE_DAY'] = $currentPoints;
				$newPoints = $currentPoints + ($scaleFactor * $constant);
				$_SESSION['POINTS_OF_THE_SESSION'] = $newPoints;

			}
			else
			{
				$newPoints = $_SESSION['POINTS_OF_THE_DAY'] + $scaleFactor * (float)($_SESSION['todaybreakhours']);
				$_SESSION['POINTS_OF_THE_SESSION'] = $newPoints;				
			}

			setPoints($newPoints,$email);
		}
		else
		{
			$_SESSION['POINTS_OF_THE_SESSION'] = (float) 0.00;				
		}
	}

	function getPoints($email)
	{
		$currentPointsQuery = mysql_query("SELECT caffeine_points FROM users WHERE email='$email'");
		while($row = mysql_fetch_array($currentPointsQuery))
		{
			$currentPoints = $row['caffeine_points'];
		}
		return $currentPoints;
	}

	function setPoints($newPoints,$email)
	{
		$setPointsQuery = mysql_query("UPDATE users SET caffeine_points='$newPoints' WHERE email='$email'");
	}

	function calculateLevel()
	{
		$points = $_SESSION["POINTS_OF_THE_SESSION"];
		
		$numDigits = countDigits($points);

		if($points >= 0 && $points <= 49)
		{
			$userLevel = "1";
		}
		else if($points >= 50 && $points <= 99)
		{
			$userLevel = "2";
		}
		else if($points >=100 && $points <= 199)
		{
			$userLevel = "3";
		}
		else if($points >=200 && $points <= 299)
		{
			$userLevel = "4";
		}
		else if($points >=300 && $points <= 399)
		{
			$userLevel = "5";
		}
		else if($points >=400 && $points <= 499)
		{
			$userLevel = "6";
		}
		else if($points >=500 && $points <= 999)
		{
			$userLevel = "7";
		}
		else if($points >=1000 && $points <= 1499)
		{
			$userLevel = "8";
		}
		else if($points >=1500 && $points <= 1999)
		{
			$userLevel = "9";
		}
		else if($points >=2000 && $points <= 2999)
		{
			$userLevel = "10";
		}
		else if($points >=3000 && $points <= 4999)
		{
			$userLevel = "11";
		}
		else if($points >=5000 && $points <= 9999)
		{
			$userLevel = "12";
		}
		else if($points >=10000)
		{
			$userLevel = "13";
		}
		else 
		{
			$userLevel = "N/A";
		}

		$_SESSION["LEVEL_OF_THE_SESSION"] = $userLevel;
	}

	function countDigits( $str )
	{
    	return preg_match_all( "/[0-9]/", $str );
	}



	if($method == 'pause')
	{
		handlePause();
		//updateWorkHrs();
	}
	else if($method == 'resume')
	{
		handleResume();
		//updateBreakHrs();
	}
	else if($method == 'hourly')
	{
		handleHourly();
	}
	else
	{

	}
	

	
	
	updateWorkHrs();
	updateBreakHrs();
	updateLevel();
	
	$totw = (float) $_SESSION['USER_TOTAL_WORK_HRS_SESSION'];
	$totb = (float) $_SESSION['USER_TOTAL_BREAK_HRS_SESSION'];
	
	updateRecord($workhrs,$breakhrs, $totw, $totb);
		
	
	$workhrs = $workhrs." / ".$totw;
	$breakhrs = $breakhrs." / ".$totb;
	
	$level = $_SESSION['LEVEL_OF_THE_SESSION'];

	if($method == 'work')
	{
		echo "message:Work now, break later!:workhrs:$workhrs:breakhrs:$breakhrs:level:$level";
	}
	else if($method == 'qbreak')
	{
		echo "message:Take a break now. Resume when you're ready!:workhrs:$workhrs:breakhrs:$breakhrs:level:$level";
	}
	else if($method == 'tbreak')
	{
		echo "message:Work now, I'll remind you when it's time to take a break.:workhrs:$workhrs:breakhrs:$breakhrs:level:$level";
	}
	else if($method == 'pause')
	{
		echo "message:Time is frozen. You can go fight dragons and return.:workhrs:$workhrs:breakhrs:$breakhrs:level:$level";
	}
	else if($method == 'resume')
	{
		echo "message:Back to work chief:workhrs:$workhrs:breakhrs:$breakhrs:level:$level";
	}
	else if($method == 'hourly')
	{
		echo "message:Your time has been recorded for the past hour:workhrs:$workhrs:breakhrs:$breakhrs:level:$level";
	}
	else
	{
		echo "message:Your time has been recorded for this session:workhrs:$workhrs:breakhrs:$breakhrs:level:$level";
	}	
?>