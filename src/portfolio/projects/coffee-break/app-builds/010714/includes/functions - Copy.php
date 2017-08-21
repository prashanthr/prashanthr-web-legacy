<?php
/* functions.php - Prashanth Rajaram */

	/*function showLoginBox()
	{
		$token = generateToken();

		echo "<form id='login' name='loginForm' action='$verifyLogin' method='POST'>";
		echo "<h1>Log In</h1>";
		
		echo "<input type='hidden' id='post.token' name='post.token' value='{$token}' />";
		echo "<fieldset id='inputs'>";
		echo "<input id='username' type='text' name='loginID' placeholder='Username' autofocus required>";   
        echo "<input id='password' type='password' name='password' placeholder='Password' required>";
		echo "</fieldset>";

		echo "<fieldset id='actions'>";
		echo "<input type='submit' id='submit' name='submitLogin' value='Log in'>";
        echo "<a href=''>Forgot your password?</a><a href=''>Register</a>";
		//echo "<a href='$verifyLogin?user=GUEST'>Continue</a> as a GUEST";
		echo "</fieldset>";

		echo "</form>";
	}*/		

	function showLoginBox()
	{
		global $verifyLogin;
		$token = generateToken();

		echo "<form name='loginForm' action='$verifyLogin' method='POST'>";
		echo "<table id='loginTable' class='loginTable'>";
		
		echo "<tr><td><input type='hidden' id='post.token' name='post.token' value='{$token}' /></td></tr>";
		
		echo "<tr>";
		echo "<td>";
		echo "Login ID";
		echo "</td>";
		echo "<td>";
		echo "<input type='text' name='loginID' id='loginIDField' />";
		echo "</td>";
		echo "</tr>";
		
		echo "<tr>";
		echo "<td>";
		echo "Password";
		echo "</td>";
		echo "<td>";
		echo "<input type='password' name='password' id='passwordField' />";
		echo "</td>";
		echo "</tr>";

		echo "<tr>";
		echo "<td>";
		echo "</td>";
		echo "<td>";
		echo "<input type='submit' value='Login' name='submitLogin' id='submitLoginButton' />";
		echo "</td>";
		echo "</tr>";
		
		echo "<tr>";
		echo "<td colspan='2'>------OR-----</td>";
		echo "</tr>";

		echo "<tr>";
		echo "<td colspan='2'><a href='$verifyLogin?user=GUEST'>Continue</a href> as a GUEST</td>";
		echo "</tr>";

		echo "</table>";
		echo "</form>";

	}

	function make_safe($variable) 
	{
    	$variable = mysql_real_escape_string(trim($variable));
    	return $variable;
	}

	function generateToken()
	{
		// set token 
		$token_local = md5(rand(0, 9999999999)); 
		// set session token var 
		$_SESSION["post.token"] = $token_local;

		return $token_local; 
	}

	function verifyLoginDetails($id,$pass,$tokn)
	{
		$pass = md5($pass);
		$loginQuery = mysql_query("SELECT firstname, lastname, email FROM users WHERE email = '$id' AND password = '$pass'");
		while($row = mysql_fetch_row($loginQuery))
		{
			$userEmail = $row['email'];
		}
		
		if($userEmail == NULL)
		{
			$loginSuccess = 0;
			
			if( isset($_SESSION['LOGINATTEMPTS']) )
			{
				$_SESSION['LOGINATTEMPTS'] = $_SESSION['LOGINATTEMPTS'] + 1;	
			}
			else
			{
				$_SESSION['LOGINATTEMPTS'] = 1;
			}

			$_SESSION['LASTATTEMPT'] = time(); // update last attempt time stamp

			header("Location: $login?error=1");
		}
		else
		{
			$loginSuccess = 1;
			$_SESSION['USER'] = $userEmail;
			$_SESSION['LOGINSTATUS'] = 'TRUE';
			$_SESSION['LOGINDATE'] = getdate();
		}

		return $loginSuccess;
	}

	function guestLogIn()
	{
		$_SESSION['USER'] = "GUESTUSER";
		$_SESSION['LOGINSTATUS'] = 'TRUE';
		$_SESSION['LOGINDATE'] = getdate();
		alertCache('You have been logged in as a Guest');
		echo "You have been logged in as a Guest!~";
		header("Location: $home");
	}

	function checkLoginAttempt()
	{
		if (isset($_SESSION['LASTATTEMPT']) && (time() - $_SESSION['LASTATTEMPT'] > 1800)) 
		{
    		// last login attempt was more than 30 minutes ago
    		session_unset();     // unset $_SESSION variable for the run-time 
    		session_destroy();   // destroy session data in storage
			return true;
		}
		else
		{
			return false;
		}	
	}
	
	function cacheCurrentData()
	{

	}

	function calculateAverages()
	{

	}

	function getLevel($value)
	{
		$levelQuery = mysql_query("SELECT name FROM levels WHERE caffeine_level = '$value' ");
		while($row = mysql_fetch_row($levelQuery))
		{
			$levelName = $row['name'];
		}

		return $levelName;
	}

/* DISPLAY FUNCTIONS */
	
	//Displays a Javascript/JQuery based pop up message to notify the user
	function alertCache($message)
	{
		$_SESSION['ALERT'] = $message;
	}

	function clearCache()
	{
		alertCache('none');
	}

	function toast()
	{
		// echo "<div class='toast' id='toast'>";
		// echo "<p>";
		// echo $message;
		// echo "<p>";
		// echo "</div>";
		$message = $_SESSION['ALERT'];
	
		echo "curr_msg is ".$message;

		echo "<script type='text/javascript'>";
		echo "message = '$message';";
		//echo "showAlert();";
		//echo "alert(message)";
		echo "</script>";

		//echo '$'.'.notify.'.'alert('.'hello'.')';		
	}

	//Displays the User Menu, shown on all pages
	function displayMenu()
	{
		showInfo();
		showActions();
	}

	function displayContent($context)
	{
		if($_SESSION['USER'] == "GUESTUSER") //GUEST USER
		{
			switch ($context) {
				case 'home':
					showGuestStats();
					break;
				case 'qbreak': //quick break
					quickBreak();
					showTime();
					break;			
				case 'tbreak': //timed break
					timedBreak();
					showTime();
					break;
				default:
					displayContent('home');
					break;
			}
		}
		else //REGULAR USER
		{
			switch ($context) {
				case 'home':
					showStats();
					break;
				case 'qbreak': //quick break
					quickBreak();
					showTime();
					break;			
				case 'tbreak': //timed break
					timedBreak();
					showTime();
					break;
				case 'normal': //normal work mode
					normalMode();
					showTime();
					break;
				case 'rapid': //rapid work mode
					rapidMode();
					showTime();
					break;
						
				default:
					//displayContent('home');
					break;
			}
		}

	}

	function displayProfile($context)
	{
		switch ($context) {
				case 'view': //view profile
					showProfile();
					break;
				case 'edit': //edit profile
					editProfile();
					break;			
				default:
					displayProfile('view');
					break;
			}
	}

	function showNoInfo()
	{
		echo "<table id='userInfoTable' class='userInfoTable'>";
		echo "<tr><td>Please <a href='$login'>Login</a> to View Personalized Information</td></tr>";
		echo "</table>";
	}

	function showInfo()
	{
		if($_SESSION['USER'] == "GUESTUSER")
		{
			$userEmail = "GUESTUSER";
		}
		else
		{
			$userEmail = $_SESSION['USER'];	
		}
		
		$infoQuery = mysql_query("SELECT * FROM users WHERE email = '$userEmail' ");
		while($row = mysql_fetch_row('$infoQuery'))
		{
			$fn = $row['firstname'];
			$ln = $row['lastname'];
			$age = $row['age'];
			$lastLogIn = $row['last_login'];
			$cLevel = $row['caffeine_level'];
			$totHrsWorked = $row['total_hours_worked'];
			$totBrkHours = $row['total_break_hours'];
			$avgBrkTime = $row['avg_break_time'];
			$avgWrkTime = $row['avg_work_time'];
		}

		echo "<table id='userInfoTable' class='userInfoTable'>";
		
		echo "<tr>";
		echo "<td>";
		echo "Name:";
		echo "</td>";
		echo "<td>";
		echo "$fn $ln";
		echo "</td>";
		echo "</tr>";

		echo "<tr>";
		echo "<td>";
		echo "Level:";
		echo "</td>";
		echo "<td>";
		echo "<a href='#' onClick='this.innerHTML=getLevel();'>$cLevel</a>";
		echo "</td>";
		echo "</tr>";

		echo "<tr>";
		echo "<td>";
		echo "Total Hrs. Worked / Avg. Hrs. Worked";
		echo "</td>";
		echo "<td>";
		echo "$totHrsWorked / $avgWrkTime";
		echo "</td>";
		echo "</tr>";

		echo "<tr>";
		echo "<td>";
		echo "Total Break Hrs. / Avg. Break Hrs.";
		echo "</td>";
		echo "<td>";
		echo "$totBrkHours / $avgBrkTime";
		echo "</td>";
		echo "</tr>";

		echo "</table>";
	}

	function showProfile()
	{
		
	}

	function editProfile()
	{

	}
	
	function showStats()
	{
		//Draw Graph
		echo "GRAPH";
		$abc = $_SESSION['LOGINSTATUS'];
		echo $abc;
	}

	function showGuestStats()
	{
		//Display GUEST MSG
		//Draw Sample Graph
		echo "GUEST GRAPH";
	}

	function showTime()
	{
		?>

		<script type="text/javascript">
			function displayClock()
			{

			}
		</script>

		<?php
	}

	function quickBreak()
	{

	}

	function timedBreak()
	{

	}

	function normalMode()
	{

	}

	function rapidMode()
	{
		
	}

?>