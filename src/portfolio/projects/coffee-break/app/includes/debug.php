	<?php
	session_start();
	function handlePause()
	{
		//$_SESSION['lastPauseTime'] = computeHours(Date("g-i-s"));
		$pauseTime = new DateTime();
		$_SESSION['lastPauseTime'] = $pauseTime;
	}

	function handleResume()
	{
		//$_SESSION['todaybreakhrs'] = computeHours(Date("g-i-s")) - $_SESSION['lastPauseTime'];
		$resumeTime  = new DateTime();
		$pauseTime = $_SESSION['lastPauseTime'];
		$todaybreakhrs = $pauseTime->diff($resumeTime); 
		
		$_SESSION['todaybreakhrs'] = (float) $todaybreakhrs->h;
	}

	function computeHours($time)
	{
		$timeSlots = explode("-", $time);
		$hours = (float) $timeSlots[0];
		$minutes = (float) $timeSlots[1];
		$seconds = (float) $timeSlots[2];
	
		$computedHours = $hours + ($minutes/60) + ($seconds/(60*60));
		echo "returning ".$computedHours."\n";
		return $computedHours;
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

	//handlePause();
	//echo "hi";
	//sleep(30);
	//handleResume();
	//echo "Difference is = ";
	//echo format_hours($_SESSION['todaybreakhrs']);
	phpinfo();
	

	?>