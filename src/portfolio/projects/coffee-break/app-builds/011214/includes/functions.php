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
		//echo "input".$id, $pass, $tokn;
		$pass = md5($pass);
		//echo "md5".$pass;
		$loginQuery = mysql_query("SELECT firstname, lastname, email, image FROM users WHERE email = '$id' AND password = '$pass'");
		while($row = mysql_fetch_array($loginQuery))
		{
			$userEmail = $row['email'];
			$userFirstName = $row['firstname'];
			$userLastName = $row['lastname'];
			$userImage = $row['image'];
			//echo "row".print_r($row);
			//echo "[userEmail]".$userEmail;
		}
		
		if(!isset($userEmail))
		{
			//echo "loginSuccess0";
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

			//header("Location: $login?error=1");
		}
		else
		{
			//echo "loginsuccess1";
			$loginSuccess = 1;
			$_SESSION['USER'] = $userEmail;
			$_SESSION['LOGINSTATUS'] = 'TRUE';
			$_SESSION['LOGINDATE'] = getdate();
			$_SESSION['USERFIRSTNAME'] = $userFirstName;
			$_SESSION['USERLASTNAME'] = $userLastName;
			$_SESSION['USERIMAGE'] = $userImage;
			$_SESSION['LOGGED_IN'] = "TRUE";
		}

		return $loginSuccess;
	}

	function guestLogIn()
	{
		$_SESSION['USER'] = "GUEST"; //$_SESSION['USER'] = "GUESTUSER";
		$_SESSION['LOGINSTATUS'] = 'TRUE';
		$_SESSION['LOGINDATE'] = getdate();
		$_SESSION['LOGGED_IN'] = "TRUE";
		alertCache('You have been logged in as a Guest');
		//echo "You have been logged in as a Guest!~";
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
	
	function registerNewUser($registerName, $registerEmail, $registerPwd)
	{
		$checkQuery = mysql_query("SELECT COUNT(*) FROM users WHERE email = '$registerEmail'");
		while($countRow = mysql_fetch_row($checkQuery))
		{
			if($countRow[0] > 0)
			{
				return 2;
			}
			else
			{
				$registerPwd = md5($registerPwd);
				$registerNameArray = explode(" ", $registerName);
				$registerFirstName = $registerNameArray[0];
				$registerLastName = $registerNameArray[1];
				$insertQuery = mysql_query("INSERT into users (firstname, lastname, fullname, email, password) VALUES ('$registerFirstName', '$registerLastName', '$registerName', '$registerEmail', '$registerPwd') ");
				if($insertQuery)
				{
					$default_work_week_hrs = 0.00;
					$default_break_week_hrs = 0.00;

					mysql_query("INSERT INTO app_settings (email) VALUES ('$registerEmail')") or die(mysql_error());
					mysql_query("INSERT INTO work_week (seven,six,five,four,three,two,one,email) VALUES ('$default_work_week_hrs', '$default_work_week_hrs', '$default_work_week_hrs', '$default_work_week_hrs', '$default_work_week_hrs', '$default_work_week_hrs', '$default_work_week_hrs', '$registerEmail')") or die(mysql_error());
					mysql_query("INSERT INTO break_week (seven,six,five,four,three,two,one,email) VALUES ('$default_break_week_hrs', '$default_break_week_hrs', '$default_break_week_hrs', '$default_break_week_hrs', '$default_break_week_hrs', '$default_break_week_hrs', '$default_break_week_hrs', '$registerEmail')") or die(mysql_error());
				
					$_SESSION['NEW_USER'] = "TRUE";

					return 1;
				}
				else
				{
					return -1;
				}
			}
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
	
		//echo "curr_msg is ".$message;

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
				case 'work': //normal work mode
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
		//echo "$coffeeExplainerVideo";
		echo "<iframe width='220' height='150' src='http://www.youtube.com/embed/60MQ3AG1c8o' frameborder='0' allowfullscreen></iframe>";
		echo "<table id='userInfoTable' class='userInfoTable'>";
		echo "<tr><td>Once you log in, you can start using Coffee Break to improve your productivity.</td></tr>";
		echo "</table>";
	}

	function showInfo()
	{
		global $user, $user_profile, $facebook, $levelpg, $desk, $dashboard, $account, $logoutUrl;
		
		/* https://developers.facebook.com/docs/reference/fql/user
		https://developers.facebook.com/tools/explorer
		https://developers.facebook.com/docs/reference/php/facebook-api/
		*/
		
		/*if($user == "GUEST_USER")
		{
			$cLevel = 0;
			$totHrsWorked = $avgWrkTime = $totBrkHours = $avgBrkTime = 0.00;

			echo "<table id='userInfoTable' class='userInfoTable'>";
			
			echo "<tr>";
			echo "<td>";
			echo "<img src='' />";
			echo "</td>";
			echo "<td>";
			echo "GUEST USER";
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
			echo "Total Hrs. Worked (Avg/Total)";
			echo "</td>";
			echo "<td>";
			echo "$totHrsWorked / $avgWrkTime";
			echo "</td>";
			echo "</tr>";

			echo "<tr>";
			echo "<td>";
			echo "Total Break Hrs. (Avg/Total)";
			echo "</td>";
			echo "<td>";
			echo "$totBrkHours / $avgBrkTime";
			echo "</td>";
			echo "</tr>";
			
			echo "</table>";		

			return;
		}*/
		if($_SESSION['LOGIN_TYPE'] == 'Guest' || $_SESSION['USER'] == 'GUEST')
		{
			$local_user_email = "GUESTUSER";
			$local_user_name = "GUEST USER";
			$_SESSION['USEREMAIL'] = $local_user_email;
		}
		else if($_SESSION['LOGIN_TYPE'] == "Coffee")
		{
			//echo  "I'm a user";
			$local_user_email = $_SESSION['USER'];
			$local_user_name = $_SESSION['USERFIRSTNAME']." ".$SESSION['USERLASTNAME'];
			$_SESSION['USEREMAIL'] = $local_user_email;	
		}
		else
		{
			//echo "reaching FB!";

		if($user) {

	      // We have a user ID, so probably a logged in user.
	      // If not, we'll get an exception, which we handle below.
	      try {
	        $fql = 'SELECT name,email,birthday from user where uid = ' . $user;
	        $ret_obj = $facebook->api(array(
	                                   'method' => 'fql.query',
	                                   'query' => $fql,
	                                 ));

	        // FQL queries return the results in an array, so we have
	        //  to get the user's name from the first element in the array.
	        $local_user_name = $ret_obj[0]['name'];
	        $local_user_email = $ret_obj[0]['email'];
	        $local_user_birthday = $ret_obj[0]['birthday'];

      		$_SESSION['USEREMAIL'] = $local_user_email;
	      
	      } catch(FacebookApiException $e) {
	        // If the user is logged out, you can have a 
	        // user ID even though the access token is invalid.
	        // In this case, we'll get an exception, so we'll
	        // just ask the user to login again here.
	        $login_url = $facebook->getLoginUrl(); 
	        echo 'Please <a href="' . $login_url . '">login.</a>';
	        error_log($e->getType());
	        error_log($e->getMessage());
	      }   
	    } else {

	      // No user, so print a link for the user to login
	      $login_url = $facebook->getLoginUrl();
	      echo 'Please <a href="' . $login_url . '">login.</a>';

	    	}
		
		//echo "<img src='https://graph.facebook.com/$user/picture' /> $local_user_email";
		}//else

		
		
		$countQuery = mysql_query("SELECT COUNT(*) AS CNT FROM users WHERE email = '$local_user_email' ");
		
		while($countRow = mysql_fetch_row($countQuery))
		{
			if($countRow[0] > 0)
			{
				//USER EXISTS IN DB
				$infoQuery = mysql_query("SELECT last_login, caffeine_level, caffeine_points, total_hours_worked, total_break_hours, avg_break_time, avg_work_time FROM users WHERE email = '$local_user_email' ");
				while($row = mysql_fetch_row($infoQuery))
				{	
					$lastLogIn = $row[0];//$row['last_login'];
					$cLevel = $row[1];//$row['caffeine_level'];
					$cPoints = $row[2];//$row['caffeine_points'];
					$totHrsWorked = $row[3];//$row['total_hours_worked'];
					$totBrkHours = $row[4];//$row['total_break_hours'];
					$avgBrkTime = $row[5];//$row['avg_break_time'];
					$avgWrkTime = $row[6];//$row['avg_work_time'];
				}

				//Update Work and Break stats for regular user
				if($_SESSION['USER'] == "GUEST")
				{
					$_SESSION['NEW_USER'] = "TRUE";
				}
				else
				{

					$currentDay = date("Y-m-d");
					$lastLoginDay = date("Y-m-d", strtotime($lastLogIn));
					if($currentDay == $lastLoginDay)
					{
						//If User logged in previously today, don't update work and break week stats
					}
					else
					{
						$infoQuery = mysql_query("SELECT seven, six, five, four, three, two, one, zero FROM work_week WHERE email = '$local_user_email' ");
						while($row = mysql_fetch_row($infoQuery))
						{	
							$c_w_seven = $row[0];
							$c_w_six = $row[1];
							$c_w_five = $row[2];
							$c_w_four = $row[3];
							$c_w_three = $row[4];
							$c_w_two = $row[5];
							$c_w_one = $row[6];
							$c_w_zero = $row[7];
						}


						$infoQuery = mysql_query("SELECT seven, six, five, four, three, two, one, zero FROM break_week WHERE email = '$local_user_email' ");
						while($row = mysql_fetch_row($infoQuery))
						{	
							$c_b_seven = $row[0];
							$c_b_six = $row[1];
							$c_b_five = $row[2];
							$c_b_four = $row[3];
							$c_b_three = $row[4];
							$c_b_two = $row[5];
							$c_b_one = $row[6];
							$c_b_zero = $row[7];
						}

						//Update work and break hours
						$break_week_update_query = mysql_query("UPDATE break_week SET seven='$c_b_six',six='$c_b_five',five='$c_b_four',four='$c_b_three',three='$c_b_two',two='$c_b_one',one='$c_b_zero',zero='0.00' WHERE email='$local_user_email'");
						$work_week_update_query = mysql_query("UPDATE work_week SET seven='$c_w_six',six='$c_w_five',five='$c_w_four',four='$c_w_three',three='$c_w_two',two='$c_w_one',one='$c_w_zero',zero='0.00' WHERE email='$local_user_email'");
					}


					$currentLogIn = date("Y-m-d H:i:s");
					$update_user_last_login = mysql_query("UPDATE users SET last_login ='$currentLogIn' WHERE email='$local_user_email'");
				}
			}
			else
			{	
				//USER NOT EXISTS IN DB
				
				$lastLogIn = date("Y-m-d H:i:s");
				$cLevel = 1;
				$totHrsWorked = 0.00;
				$totBrkHours = 0.00;
				$avgBrkTime = 0.00;
				$avgWrkTime = 0.00;

				$default_work_week_hrs = 0.00;
				$default_break_week_hrs = 0.00;

				/* To ensure names with quotes are escaped */
				$local_user_name = addslashes($local_user_name);

				//ADD USER TO DATABASE
				mysql_query("INSERT INTO users (fullname,email,dob,last_login) VALUES ('$local_user_name','$local_user_email','$local_user_birthday','$lastLogIn')") or die(mysql_error());
				mysql_query("INSERT INTO app_settings (email) VALUES ('$local_user_email')") or die(mysql_error());
				mysql_query("INSERT INTO work_week (seven,six,five,four,three,two,one,email) VALUES ('$default_work_week_hrs', '$default_work_week_hrs', '$default_work_week_hrs', '$default_work_week_hrs', '$default_work_week_hrs', '$default_work_week_hrs', '$default_work_week_hrs', '$local_user_email')") or die(mysql_error());
				mysql_query("INSERT INTO break_week (seven,six,five,four,three,two,one,email) VALUES ('$default_break_week_hrs', '$default_break_week_hrs', '$default_break_week_hrs', '$default_break_week_hrs', '$default_break_week_hrs', '$default_break_week_hrs', '$default_break_week_hrs', '$local_user_email')") or die(mysql_error());
				
				$_SESSION['NEW_USER'] = "TRUE";
			}
		}		
		
		if($_SESSION['USER'] == "GUEST")
		{
			if(!isset($_SESSION['USER_TOTAL_WORK_HRS']))
			{
				$_SESSION['USER_TOTAL_WORK_HRS'] = (float) 0.00;
			}

			if(!isset($_SESSION['USER_TOTAL_BREAK_HRS']))
			{
				$_SESSION['USER_TOTAL_BREAK_HRS'] = (float) 0.00;
			}

			if(!isset($_SESSION['LEVEL_OF_THE_SESSION']))
			{
				$_SESSION['LEVEL_OF_THE_SESSION'] = 1;
			}

			if(!isset($_SESSION['POINTS_OF_THE_SESSION']))
			{
				$_SESSION['POINTS_OF_THE_SESSION'] = (float) 0.00;
			}
		}
		else
		{
			if(!isset($_SESSION['USER_TOTAL_WORK_HRS']))
			{
				$_SESSION['USER_TOTAL_WORK_HRS'] = $totHrsWorked;	
			}

			if(!isset($_SESSION['USER_TOTAL_BREAK_HRS']))
			{
				$_SESSION['USER_TOTAL_BREAK_HRS'] = $totBrkHours;	
			}
			
			if(!isset($_SESSION['LEVEL_OF_THE_SESSION']))
			{
				$_SESSION['LEVEL_OF_THE_SESSION'] = $cLevel;
			}

			if(!isset($_SESSION['POINTS_OF_THE_SESSION']))
			{
				$_SESSION['POINTS_OF_THE_SESSION'] = $cPoints;
			}
			
		}
		
		if($_SESSION['USER'] == "GUEST" || $_SESSION['LOGIN_TYPE'] == "Guest")
		{
			$logoutIcon = "icon-signout";
		}
		else if($_SESSION['LOGIN_TYPE'] == "Coffee")
		{
			$logoutIcon = "icon-signout";	
		}
		else
		{
			$logoutIcon = "icon-facebook-sign";
		}

		echo "<table id='userInfoTable' class='userInfoTable'>";
		
		echo "<tr>";
		echo "<td>";
		if($_SESSION['USER'] == "GUEST")
		{
			echo "<img src='http://coffee.prashanthr.info/app/images/guest/Man-icon.png' height='50px' width='50px' />";
		}
		else if($_SESSION['LOGIN_TYPE'] == "Coffee")
		{
			echo "<img src='".$_SESSION['USERIMAGE']."' height='60px' width='60px' />";
		}
		else
		{
			echo "<img src='https://graph.facebook.com/$user/picture' />";
		}
		echo "</td>";
		$name_pieces = explode(" ", $local_user_name);
		$local_user_first_name = $name_pieces[0];
		$local_user_last_name = $name_pieces[1];
		$local_user_last_initial = substr($local_user_last_name, 0, 1);
		echo "<td>";
			echo "<div id='options'>";
				echo "<div id='usermenuid' class='btn-group' $introjsoptionsattributes>";
					echo "<a class='btn' href='#'>$local_user_first_name $local_user_last_initial</a>";
					echo "<a class='btn dropdown-toggle' data-toggle='dropdown' href='#' onClick='handleUserMenuUI();'>";
		   			echo "<span class='icon-caret-down'></span></a>";
					echo "<ul class='dropdown-menu'>";
						echo "<li><a href='$desk'><i class='icon-fixed-width icon-laptop'></i> Work Now</a></li>";
					    echo "<li><a href='$dashboard'><i class='icon-fixed-width icon-dashboard'></i> Dashboard</a></li>";
					    echo "<li><a href='$account?tab=settings'><i class='icon-fixed-width icon-gear'></i> Settings</a></li>";
					    echo "<li class='divider'></li>";
					    echo "<li><a href='$logoutUrl'><i class='$logoutIcon'></i> Logout</a></li>";
					echo "</ul>";
				echo "</div>";
			echo "</div>";
		//echo "$local_user_name";
		echo "</td>";
		echo "</tr>";

		echo "<tr>";
		echo "<td>";
		echo "Level:";
		echo "</td>";
		echo "<td>";
		echo "<a href='$levelpg'><span id='level'>".$_SESSION["LEVEL_OF_THE_SESSION"]."</span></a>"." "."<span class='sparkline'><i class='icon-spinner icon-spin icon-small'></i></span>";
		echo "</td>";
		echo "</tr>";

		echo "<tr>";
		echo "<td>";
		echo "Total Hrs. Worked (Today/Total)";
		echo "</td>";
		echo "<td id='workhrs'>";
			if(isset($_SESSION['todayworkhours']))
			{
				$todayHrsWorked = $_SESSION['todayworkhours'];
			}
			else
			{
				$todayHrsWorked = "0.00";
			}
		echo "$todayHrsWorked / $totHrsWorked";
		echo "</td>";
		echo "</tr>";

		echo "<tr>";
		echo "<td>";
		echo "Total Break Hrs. (Today/Total)";
		echo "</td>";
		echo "<td id='breakhrs'>";
			if(isset($_SESSION['todaybreakhours']))
			{
				$todayHrsBreak = $_SESSION['todaybreakhours'];
			}
			else
			{
				$todayHrsBreak = "0.00";
			}

		echo "$todayHrsBreak / $totBrkHours";
		echo "</td>";
		echo "</tr>";
		
		echo "</table>";		
	}

	function showBasicInfo()
	{
		global $user, $user_profile, $facebook, $levelpg, $desk, $dashboard, $account, $logoutUrl;
				if($_SESSION['USER'] == 'GUEST')
		{
			$local_user_email = "GUESTUSER";
			$local_user_name = "GUEST USER";
			$_SESSION['USEREMAIL'] = $local_user_email;
		}
		else
		{

		if($user) {

	      // We have a user ID, so probably a logged in user.
	      // If not, we'll get an exception, which we handle below.
	      try {
	        $fql = 'SELECT name,email,birthday from user where uid = ' . $user;
	        $ret_obj = $facebook->api(array(
	                                   'method' => 'fql.query',
	                                   'query' => $fql,
	                                 ));

	        // FQL queries return the results in an array, so we have
	        //  to get the user's name from the first element in the array.
	        $local_user_name = $ret_obj[0]['name'];
	        $local_user_email = $ret_obj[0]['email'];
	        $local_user_birthday = $ret_obj[0]['birthday'];

      		$_SESSION['USEREMAIL'] = $local_user_email;
	      
	      } catch(FacebookApiException $e) {
	        // If the user is logged out, you can have a 
	        // user ID even though the access token is invalid.
	        // In this case, we'll get an exception, so we'll
	        // just ask the user to login again here.
	        $login_url = $facebook->getLoginUrl(); 
	        echo 'Please <a href="' . $login_url . '">login.</a>';
	        error_log($e->getType());
	        error_log($e->getMessage());
	      }   
	    } else {

	      // No user, so print a link for the user to login
	      $login_url = $facebook->getLoginUrl();
	      echo 'Please <a href="' . $login_url . '">login.</a>';

	    	}
		
		//echo "<img src='https://graph.facebook.com/$user/picture' /> $local_user_email";
		}//else
	
		$countQuery = mysql_query("SELECT COUNT(*) AS CNT FROM users WHERE email = '$local_user_email' ");
		
		while($countRow = mysql_fetch_row($countQuery))
		{
			if($countRow[0] > 0)
			{
				//USER EXISTS IN DB
				$infoQuery = mysql_query("SELECT last_login, caffeine_level, caffeine_points, total_hours_worked, total_break_hours, avg_break_time, avg_work_time FROM users WHERE email = '$local_user_email' ");
				while($row = mysql_fetch_row($infoQuery))
				{	
					$lastLogIn = $row[0];//$row['last_login'];
					$cLevel = $row[1];//$row['caffeine_level'];
					$cPoints = $row[2];//$row['caffeine_points'];
					$totHrsWorked = $row[3];//$row['total_hours_worked'];
					$totBrkHours = $row[4];//$row['total_break_hours'];
					$avgBrkTime = $row[5];//$row['avg_break_time'];
					$avgWrkTime = $row[6];//$row['avg_work_time'];
				}

				//Update Work and Break stats for regular user
				if($_SESSION['USER'] == "GUEST")
				{
					$_SESSION['NEW_USER'] = "TRUE";
				}
				else
				{

					$currentDay = date("Y-m-d");
					$lastLoginDay = date("Y-m-d", strtotime($lastLogIn));
					if($currentDay == $lastLoginDay)
					{
						//If User logged in previously today, don't update work and break week stats
					}
					else
					{
						$infoQuery = mysql_query("SELECT seven, six, five, four, three, two, one, zero FROM work_week WHERE email = '$local_user_email' ");
						while($row = mysql_fetch_row($infoQuery))
						{	
							$c_w_seven = $row[0];
							$c_w_six = $row[1];
							$c_w_five = $row[2];
							$c_w_four = $row[3];
							$c_w_three = $row[4];
							$c_w_two = $row[5];
							$c_w_one = $row[6];
							$c_w_zero = $row[7];
						}


						$infoQuery = mysql_query("SELECT seven, six, five, four, three, two, one, zero FROM break_week WHERE email = '$local_user_email' ");
						while($row = mysql_fetch_row($infoQuery))
						{	
							$c_b_seven = $row[0];
							$c_b_six = $row[1];
							$c_b_five = $row[2];
							$c_b_four = $row[3];
							$c_b_three = $row[4];
							$c_b_two = $row[5];
							$c_b_one = $row[6];
							$c_b_zero = $row[7];
						}

						//Update work and break hours
						$break_week_update_query = mysql_query("UPDATE break_week SET seven='$c_b_six',six='$c_b_five',five='$c_b_four',four='$c_b_three',three='$c_b_two',two='$c_b_one',one='$c_b_zero',zero='0.00' WHERE email='$local_user_email'");
						$work_week_update_query = mysql_query("UPDATE work_week SET seven='$c_w_six',six='$c_w_five',five='$c_w_four',four='$c_w_three',three='$c_w_two',two='$c_w_one',one='$c_w_zero',zero='0.00' WHERE email='$local_user_email'");
					}


					$currentLogIn = date("Y-m-d H:i:s");
					$update_user_last_login = mysql_query("UPDATE users SET last_login ='$currentLogIn' WHERE email='$local_user_email'");
				}
			}
			else
			{	
				//USER NOT EXISTS IN DB
				
				$lastLogIn = date("Y-m-d H:i:s");
				$cLevel = 1;
				$totHrsWorked = 0.00;
				$totBrkHours = 0.00;
				$avgBrkTime = 0.00;
				$avgWrkTime = 0.00;

				$default_work_week_hrs = 0.00;
				$default_break_week_hrs = 0.00;

				//ADD USER TO DATABASE
				mysql_query("INSERT INTO users (fullname,email,dob,last_login) VALUES ('$local_user_name','$local_user_email','$local_user_birthday','$lastLogIn')") or die(mysql_error());
				mysql_query("INSERT INTO app_settings (email) VALUES ('$local_user_email')") or die(mysql_error());
				mysql_query("INSERT INTO work_week (seven,six,five,four,three,two,one,email) VALUES ('$default_work_week_hrs', '$default_work_week_hrs', '$default_work_week_hrs', '$default_work_week_hrs', '$default_work_week_hrs', '$default_work_week_hrs', '$default_work_week_hrs', '$local_user_email')") or die(mysql_error());
				mysql_query("INSERT INTO break_week (seven,six,five,four,three,two,one,email) VALUES ('$default_break_week_hrs', '$default_break_week_hrs', '$default_break_week_hrs', '$default_break_week_hrs', '$default_break_week_hrs', '$default_break_week_hrs', '$default_break_week_hrs', '$local_user_email')") or die(mysql_error());
				
				$_SESSION['NEW_USER'] = "TRUE";
			}
		}
		if($_SESSION['USER'] == "GUEST")
		{
			$logoutIcon = "icon-signout";
		}
		else
		{
			$logoutIcon = "icon-facebook-sign";
		}

		echo "<table id='userInfoTable' class='userInfoTable'>";
		
		echo "<tr>";
		echo "<td>";
		if($_SESSION['USER'] == "GUEST")
		{
			echo "<img src='http://coffee.prashanthr.info/app/images/guest/Man-icon.png' height='50px' width='50px' />";
		}
		else
		{
			echo "<img src='https://graph.facebook.com/$user/picture' />";
		}
		echo "</td>";
		echo "<td>";
			echo "<div id='options'>";
				echo "<div id='usermenuid' class='btn-group' $introjsoptionsattributes>";
					echo "<a class='btn' href='#'>$local_user_name</a>";
					echo "<a class='btn dropdown-toggle' data-toggle='dropdown' href='#' onClick='handleUserMenuUI();'>";
		   			echo "<span class='icon-caret-down'></span></a>";
					echo "<ul class='dropdown-menu'>";
						echo "<li><a href='$desk'><i class='icon-fixed-width icon-laptop'></i> Work Now</a></li>";
					    echo "<li><a href='$dashboard'><i class='icon-fixed-width icon-dashboard'></i> Dashboard</a></li>";
					    echo "<li><a href='$account?tab=settings'><i class='icon-fixed-width icon-gear'></i> Settings</a></li>";
					    echo "<li class='divider'></li>";
					    echo "<li><a href='$logoutUrl'><i class='$logoutIcon'></i> Logout</a></li>";
					echo "</ul>";
				echo "</div>";
			echo "</div>";
		//echo "$local_user_name";
		echo "</td>";
		echo "</tr>";
		echo "</table>";
	}

	function showManaBar($pageContext)
	{
		global $desk,$dashboard,$account,$loginUrl,$logoutUrl,$setup;
		if($_SESSION["LOGGED_IN"] == "TRUE")
		{
			//echo "<div id='manabar'><div class='manabar-label' style='text-align:center'></div></div>";
			echo "<div id='manabar'></div>";
			echo "<div id='manabar-update'><a href='#' onClick='showReclaimManaDialog()'>Reclaim Mana</a></div>";
			//echo "<div id='reclaimManaDialog' title='Reclaim Mana'><div id='manaSlider'></div><br /><p>Slide the bar according to how much energy you think you have at this point in time.</p></div>";
		}
	}

	function showOptions($pageContext)
	{
		global $desk,$dashboard,$account,$loginUrl,$logoutUrl,$setup;
		
		if($_SESSION['USER'] == "GUEST")
		{
			$logoutIcon = "icon-signout";
		}
		else
		{
			$logoutIcon = "icon-facebook-sign";
		}
		
		switch ($pageContext) {
					case 'Dashboard':
					?>
					<a class="btn" href="<?php echo $dashboard; ?>"><i class="icon-refresh"></i> Reload Stats</a>
					<?php
					break;
					
					case 'Desk':
					$introjsactionsattributes = "data-step='5' data-position='right' data-intro='"."Here are a few little action buttons that will help you while you work. Whenever you need to immediately leave work, just hit the coffee button and I will know you are taking a quick break. Hit the center button with a [1 h] on it if you want to take a break in an hour from when you press it. Hit the last button to set your own time after which you want to take a break. Rememeber, based on your app settings, there is a default break timer running that will prompt you to take a break at the set time. Hitting any of these buttons will temporarily override that setting until you resume the clock after your custom set break. Thats it. Good Hunting!"."'";
					?>
					<br />
					<div class="actions-buttons" <?php echo $introjsactionsattributes ;?> >
						<div class="btn-group">
		  					<a class="btn" href="#" onClick="performAction('qbreak');" title='Take a break now'><i class="icon-coffee"></i></a>
		  					<a class="btn" href="#" onClick="performAction('dbreak');" title='Take a break in 1 hour'>1h <i class="icon-time"></i></a>
		  					<a class="btn" href="#" onClick="performAction('tbreak');" title='Take a break at your chosen time'><i class="icon-time"></i></a>
		  				</div>
		    		</div>
		    		<br />
					<?php
					showScratchpad();
					break;

					case 'Account':
					?>
					<br />

					<ul class="nav nav-list">
					<?php
					$settingsTabsArray = array("general"=>"General","settings"=>"App Settings","events"=>"Event Log","notifications"=>"Notifications");
					$settingTabsIconsArray = array("general"=>"icon-edit","settings"=>"icon-cogs","events"=>"icon-list-alt","notifications"=>"icon-bell-alt");
					foreach ($settingsTabsArray as $key => $value)						
					{
						if($key == $_SESSION['SETTINGS_MENU_ACTIVE'])
						{
							if($key == "general")
							{
								echo "<li class='active'>"."<a href='$account'><i class='icon-fixed-width ".$settingTabsIconsArray["$key"]."'></i> $value</a>"."</li>";								
							}
							else
							{
								echo "<li class='active'>"."<a href='$account/?tab=$key'><i class='icon-fixed-width ".$settingTabsIconsArray["$key"]."'></i> $value</a>"."</li>";	
							}

						}
						else
						{
							if($key == "general")
							{
								echo "<li>"."<a href='$account'><i class='icon-fixed-width ".$settingTabsIconsArray["$key"]."'></i> $value</a>"."</li>";								
							}
							else
							{
								echo "<li>"."<a href='$account/?tab=$key'><i class='icon-fixed-width ".$settingTabsIconsArray["$key"]."'></i> $value</a>"."</li>";	
							}
						}
					}
					
					/*
					  <li class="active"><a href="<?php echo $account?>"><i class="icon-fixed-width icon-edit"></i> General</a></li>
					  <li><a href="<?php echo $account."/?tab=settings"?>"><i class="icon-fixed-width icon-cogs"></i> App Settings</a></li>
					  <li><a href="<?php echo $account."/?tab=events"?>"><i class="icon-fixed-width icon-list-alt"></i> Event Log</a></li>
					  <li><a href="<?php echo $account."/?tab=notifications"?>"><i class="icon-fixed-width icon-bell"></i> Notifications</a></li>					  
					*/
					?>
					</ul>
					<br />
					<?php
					break;
			
					case 'Setup':
						break;
					
					case 'Help':
						break;
					
					default:						
						break;
		}

		?>
		<script type='text/javascript'>
					
					function handleUserMenuUI()
					{
						userMenuClassName = document.getElementById('usermenuid').className;
						if(userMenuClassName == 'btn-group')
						{
							document.getElementById('usermenuid').setAttribute('class', userMenuClassName +' open');
						}
						else
						{
							userMenuClassName = 'btn-group';
							document.getElementById('usermenuid').setAttribute('class', userMenuClassName);
						}
					}
				</script>
				<?php
				if($pageContext == "Dashboard")
				{
					$introjsoptionsattributes = "data-step='4' data-position='left' data-intro='"."With the options button, you can quickly jump to a feature."."'";
				}
				else
				{
					$introjsoptionsattributes = "";	
				}

				/*
				<!--<div id="options">
					<div id='usermenuid' class="btn-group" <?php echo $introjsoptionsattributes; ?> >
					  <a class="btn" href="#"><i class="icon-list"></i> Options</a>
					  <a class="btn dropdown-toggle" data-toggle="dropdown" href="#" onClick="handleUserMenuUI();">
					    <span class="icon-caret-down"></span></a>
					  <ul class="dropdown-menu">
					    <li><a href="<?php echo $desk ?>"><i class="icon-fixed-width icon-laptop"></i> Work Now</a></li>
					    <li><a href="<?php echo $dashboard ?>"><i class="icon-fixed-width icon-dashboard"></i> Dashboard</a></li>
					    <li><a href="<?php echo $account.'?tab=settings'; ?>"><i class="icon-fixed-width icon-gear"></i> Settings</a></li>

					    <li class="divider"></li>
					    <li><a href="<?php echo $logoutUrl ?>"><i class="<?php echo $logoutIcon ?>"></i> Logout</a></li>
					  </ul>
					</div>
				</div>-->*/
				?>	
				<br />
		<!-- <br />
		<div class="actions-dropdown">
      		<select id="actionList" onChange="handleAction(document.getElementById('actionList').value);" class="actions-dropdown-select">
        		<option value="">Select An Action</option>
        		<option value="work">Begin Working</option>
        		<option value="qbreak">Take a Break Now!</option>
        		<option value="tbreak">Take a break Later</option>
      		</select>
    		<input id='breaklatertextbox' type='hidden'></input>
    	</div>
 -->    	
    		<!-- <a href="#" onClick="performAction('work');" ><img class='actions-buttons' src="http://www.prashanthr.info/portfolio/projects/coffee-break/app/images/buttons/work.png"/></a>
    		<a href="#" onClick="performAction('qbreak');" ><img class='actions-buttons' src="http://www.prashanthr.info/portfolio/projects/coffee-break/app/images/buttons/break.png"/></a>
    		<a href="#" onClick="performAction('tbreak');" ><img class='actions-buttons' src="http://www.prashanthr.info/portfolio/projects/coffee-break/app/images/buttons/break-timed.png"/></a> -->
    		<!-- <a href="#" onClick="performAction('work');" class="button white"> Work Now </a>
    		<a href="#" onClick="performAction('qbreak');" class="button white">Take a Break (Now)</a>
    		<a href="#" onClick="performAction('tbreak');" class="button white">Take a Break Later</a> -->
    	<?php	
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
		//echo "GRAPH";
		
		//drawJPGraph();
		
		//echo "<div id='graph-container' style='width:70%;height:400px;'></div>";
		//echo "<script src='$scripts/graph.js'></script>";
		//echo "<script src='$includes/highcharts-graphs/js/highcharts.js'></script>";
		//echo "<script src='$includes/highcharts-graphs/js/modules/exporting.js'></script>";
		
		//include "graph.php";
		//drawHighStockGraph();
		//echo "<p>Heres your statistics for the last week:</p>";
	}

	function drawJPGraph()
	{
		require_once ('includes/jpgraph/src/jpgraph.php');
		require_once ('includes/jpgraph/src/jpgraph_line.php');
		
		$datay1 = array(20,15,23,15);
		$datay2 = array(12,9,42,8);
		$datay3 = array(5,17,32,24);
		
		// Setup the graph
		$graph = new Graph(300,250);
		$graph->SetScale("textlin");

		$theme_class=new UniversalTheme;

		$graph->SetTheme($theme_class);
		$graph->img->SetAntiAliasing(false);
		$graph->title->Set('Filled Y-grid');
		$graph->SetBox(false);

		$graph->img->SetAntiAliasing();

		$graph->yaxis->HideZeroLabel();
		$graph->yaxis->HideLine(false);
		$graph->yaxis->HideTicks(false,false);

		$graph->xgrid->Show();
		$graph->xgrid->SetLineStyle("solid");
		$graph->xaxis->SetTickLabels(array('A','B','C','D'));
		$graph->xgrid->SetColor('#E3E3E3');

		// Create the first line
		$p1 = new LinePlot($datay1);
		$graph->Add($p1);
		$p1->SetColor("#6495ED");
		$p1->SetLegend('Line 1');

		// Create the second line
		$p2 = new LinePlot($datay2);
		$graph->Add($p2);
		$p2->SetColor("#B22222");
		$p2->SetLegend('Line 2');

		// Create the third line
		$p3 = new LinePlot($datay3);
		$graph->Add($p3);
		$p3->SetColor("#FF1493");
		$p3->SetLegend('Line 3');

		$graph->legend->SetFrameWeight(1);

		// Output line
		$graph->Stroke("test.jpg");

		echo "<img src='test.jpg' />";
	}

	function drawHighStockGraph()
	{
			
		
	}

	function showGuestStats()
	{
		//Display GUEST MSG
		//Draw Sample Graph
		echo "GUEST GRAPH";
	}

	function showTime()
	{
		include('timer.php');
	}

	function showMusic()
	{
		global $desk;
		include("$desk/music.php");
	}

	function showScratchpad()
	{
		global $desk;
		include("$desk/scratchpad.php");
	}

	function quickBreak()
	{
		
		/*<script type='text/javascript'>
			if(document.loaded) 
			{
				executeQuickBreakMethods();
			} 
			else 
			{
				if (window.addEventListener) 
				{
					window.addEventListener('load', executeQuickBreakMethods, false);
				}
				else 
				{
					window.attachEvent('onload', executeQuickBreakMethods);
				}
			}

			function executeQuickBreakMethods()
			{
				pauseTimer();
				recordDataAjax('qbreak',document.getElementById('timerdebug').innerHTML);
				quickBreakNotification();

			}
		</script>
		*/
	}

	function timedBreak()
	{
		/*echo "<div align='center'>";
		if(isset($_GET['break_time']))
		{
			$break_time = $_GET['break_time'];

			$pieces = explode(" ", $break_time);
			$int_value =  $pieces[0]; // number
			$unit_value = $pieces[1]; // unit i.e hrs mins secs	
			
			if($unit_value == "hr" || $unit_value == "hrs" || $unit_value == "h" || $unit_value == "hour")
			{
				$millitimer = $int_value*3600000;
			}
			else if($unit_value == "min" || $unit_value == "mins" || $unit_value == "m" || $unit_value == "minutes")
			{
				$millitimer = $int_value*60000;
			}
			else if($unit_value == "sec" || $unit_value == "secs" || $unit_value == "s" || $unit_value == "seconds")
			{
				$millitimer = $int_value*1000;
			}
			else
			{
				echo "You have not chosen a proper break time. Select an action from the actions list whenever you want to take a break or set something up!\n";
				normalMode();
			}

			?>
			<script type='text/javascript'>
			if(document.loaded) 
			{
				executeTimedBreakMethods();
			} 
			else 
			{
				if (window.addEventListener) 
				{
					window.addEventListener('load', executeTimedBreakMethods, false);
				}
				else 
				{
					window.attachEvent('onload', executeTimedBreakMethods);
				}
			}

			function executeQuickBreakMethods()
			{
				recordDataAjax('tbreak',document.getElementById('timerdebug').innerHTML);
			}
			</script>
			<?php
			echo "You have chosen to take a break after $break_time. Work now and I'll remind you when it's time! \n";
			echo "<script type='text/javascript'>setTimeout('pauseTimer()',$millitimer);setTimeout('timedBreakNotification()',$millitimer)</script>";
		}
		else
		{
			echo "You have not chosen a proper break time. Select an action from the actions list whenever you want to take a break or set something up!\n";
			normalMode();
		}
		echo "</div>"; */
		
	}

	function normalMode()
	{
		?>
			<script type='text/javascript'>
			if(document.loaded) 
			{
				fn_executeNormalModeMethods();
			} 
			else 
			{
				if (window.addEventListener) 
				{
					window.addEventListener('load', fn_executeNormalModeMethods, false);
				}
				else 
				{
					window.attachEvent('onload', fn_executeNormalModeMethods);
				}
			}

			function fn_executeNormalModeMethods()
			{
				recordDataAjax('work',document.getElementById('time').innerHTML);
				//recordDataAjax('work',document.getElementById('timerdebug').Value);
			}
			</script>
		<?php
	}

	function removeCookie()
	{
		setcookie("coffee_n_cookie", "", time()-3600);
	}

	function checkSetup()
	{
		//Check Cookie
		if(isset($_COOKIE['coffee_n_cookie']))
		{
			//If Cookie present
			$cofee_n_cookie = $_COOKIE['coffee_n_cookie']; 
			echo "cookieyeah!";
			return "true";
		}		
		else
		{
			return "false";
		}
	}
	
	function setup()
	{
		//HTML 5 Notifications
		//Get Browser Information
		//$user_browser_information_inline = $_SERVER['HTTP_USER_AGENT'];
		//$user_browser_information_array = get_browser();
	
		$user_agent = getUserAgent();
		setupHTML5Notifications($user_agent);
		$numSecondsToSixMonths = 60 * 60 * 24 * 180 + time(); 
		setcookie('coffee_n_cookie', $user_agent, $numSecondsToSixMonths);
		
	}

	function getUserAgent()
	{
    	$agent = null;

    	if ( empty($agent) ) 
    	{
        	$agent = $_SERVER['HTTP_USER_AGENT'];
        	if ( stripos($agent, 'Firefox') !== false ) {
	            $agent = 'firefox';
	        } elseif ( stripos($agent, 'MSIE') !== false ) {
	            $agent = 'ie';
	        } elseif ( stripos($agent, 'iPad') !== false ) {
	            $agent = 'ipad';
	        } elseif ( stripos($agent, 'Android') !== false ) {
	            $agent = 'android';
	        } elseif ( stripos($agent, 'Chrome') !== false ) {
	            $agent = 'chrome';
	        } elseif ( stripos($agent, 'Safari') !== false ) {
	            $agent = 'safari';
	        } elseif ( stripos($agent, 'Opera') !== false ) {
	            $agent = 'opera';
	        } elseif ( stripos($agent, 'AIR') !== false ) {
	            $agent = 'air';
	        } elseif ( stripos($agent, 'Fluid') !== false ) {
	            $agent = 'fluid';
	        }
	    }

    	return $agent;
	}

	function setupHTML5Notifications($agent)
	{
		?>
		<p class='alert alert-info'>
		<?php
		echo "You are using ".$agent;
		?>
		</p>
		<p class='alert alert-info'>
			In order to enable an essential feature of Coffee Break, you must enable desktop notifications for this site.
			Please follow the instructions below to enable desktop notifcations.<br /><br />
		<?php
		switch ($agent) {
			case 'firefox':
				HTML5ForFirefox();
				break;
			case 'chrome':
				HTML5ForChrome();
				break;
			case 'MSIE':
				HTML5ForMSIE();
				break;
			case 'android':
				HTML5ForMobile();
			case 'ipad':
				HTML5ForMobile();
			default:
				HTMLForGeneric();
				break;
		}
		?>
		</p>
		<?php

	}

	/* HTML5 BROWSER SETUPS */
	function HTML5ForFirefox()
	{
		?>
		<!--Native desktop notification support is now available for your browser. I'm currently implementing support for this feature. Although, to use the notification feature in firefox at this time:<br />-->
		<ol>
			<!--<li>Please download and enable <a href='https://addons.mozilla.org/en-us/firefox/addon/html-notifications/'>HTML5 Desktop Notifications</a> add-on for Firefox.</li>-->
			<li>Please click <a href='#' onClick="desktopNotifyAuthHandler()">here</a> and click on "Allow" to enable desktop notifications.</li>
			<li>Click <a href='#' onClick="desktopNotificationTest('Test Notification')">here</a> when you are done with the above step to test it.</li>
		</ol>
		<?php
	}

	function HTML5ForChrome()
	{
		?>
		<ol>
			<li>Please click <a href='#' onClick="desktopNotifyAuthHandler()">here</a> and click on "Allow" to enable desktop notifications.</li>
			<li>Click <a href='#' onClick="desktopNotificationTest('Test Notification')">here</a> when you are done with the above step to test it.</li>
		</ol>
		<?php
	}

	function HTML5ForMSIE()
	{
		?>
		Sorry! This feature is not supported in Internet Explorer at this time. Please try a different browser.<br />
		<?php
	}

	function HTML5ForMobile()
	{
		?>
		Sorry! This feature is not supported for a mobile device. You will have to switch to a web browser on the desktop or contact me to request a mobile app.<br />
		<?php
	}

	function HTML5ForGeneric()
	{
		?>
		Sorry! This feature has not been tested or may not have been implemented for this browser. Please try a different browser or contact me so I can help you out.<br />
		<?php
	}

	function executeMethods($pageContext)
	{
		switch ($pageContext) {
			case 'Dashboard':
				executeDashboardMethods();
				break;
			case 'Desk':
				executeDeskMethods();
				break;
			default:
				break;
		}
	}

	function executeDashboardMethods()
	{
		//setup();
	}

	function executeDeskMethods()
	{
		//setup();
		normalMode();
		showTime();
		showMusic();
		//showScratchpad();				
	}

	function format_field_info($field_name)
	{
		switch ($field_name) {
			case 'fullname':
				$field_name = "Full Name";
				break;
		
			case 'email':
				$field_name = "Email";
				break;
		
			case 'dob':
				$field_name = "Date of Birth";
				break;
			
			case 'caffeine_level':
				$field_name = "Caffeine Level";
				break;
			
			case 'caffeine_points':
				$field_name = "Caffeine Points";
				break;
			
			case 'last_login':
				$field_name = "Last Login";
				break;
			
			case 'total_hours_worked':
				$field_name = "Total Hours Worked";
				break;
			
			case 'total_break_hours':
				$field_name = "Total Break Hours";
				break;
			
			case 'avg_break_time':
				$field_name = "Avg. Break Time";
				break;

			case 'avg_work_time':
				$field_name = "Avg. Work Time";
				break;
			
			case 'desktop_notifications':
				$field_name = "Desktop Notifications";
				break;
			
			case 'smart_caffeine':
				$field_name = "Smart Caffeine Engine";
				break;

			case 'default_timed_break':
				$field_name = "Default Timed Break";
				break;

			case 'default_timed_break_value':
				$field_name = "Default Timed Break Interval";
				break;

			case 'music':
				$field_name = "Music";
				break;

			case 'music_source':
				$field_name = "Music Source";
				break;
			
			case 'music_embed_code':
				$field_name = "Music Source Playlist URL";
				break;

			default:
				break;
		}

		return $field_name;
	}

	function format_field_value($field_name,$field_value,$field_type)
	{
		//echo "field_values asre is ".$field_name.$field_value.$field_type;
		if($field_type == "datetime")
		{
			if($field_name == 'dob')
			{
				$field_value = date('l\, F jS\, Y',strtotime($field_value));
			}
			else
			{
				$field_value = date('g:ia \o\n l\, F jS\, Y', strtotime($field_value));
			}
	
		}
		else
		{
			if($field_name == 'event_name')
			{
				if($field_value == 'resume')
				{
					$field_value = "resumed working";
				}
				else if($field_value == 'qbreak')
				{
					$field_value = "took a break";
				}
				else if($field_value == 'pause')
				{
					$field_value = "paused work";
				}
				else if($field_value == 'work')
				{
					$field_value = "continued working";
				}
				else
				{
					$field_value = $field_value;
				}
			}

		}
		
		return $field_value;
	}


	function readUserSettings()
	{
		$settingsSetFlag = "false";
		if($_SESSION["LOGGED_IN"] == "TRUE")
		{
			$email = $_SESSION['USEREMAIL'];
			$settingsQuery = mysql_query("SELECT * FROM app_settings WHERE email='$email'");
			while($row = mysql_fetch_array($settingsQuery))
			{
				$desktop_notifications = $row['desktop_notifications'];
				$default_break = $row['default_timed_break'];
				$default_break_interval = $row['default_timed_break_value'];
				$smart_caffeine = $row['smart_caffeine'];
				$music = $row['music'];
				$music_source = $row['music_source'];
				$music_embed_code = $row['music_embed_code'];
			}

			$settingsSetFlag = "true";
			$_SESSION['desktop_notifications'] = $desktop_notifications;
			$_SESSION['default_break'] = $default_break;
			$_SESSION['default_break_interval'] = $default_break_interval;
			$_SESSION['smart_caffeine'] = $smart_caffeine;
			$_SESSION['music'] = $music;
			$_SESSION['music_source'] = $music_source;
			$_SESSION['music_embed_code'] = $music_embed_code;
		}
		
		if($settingsSetFlag == "true")
		{
			if($_SESSION['desktop_notifications'] == "1")
			{
				?>
				<script type="text/javascript">
					window.desktopNotifications = 1;
				</script>
				<?php				

			}
			else
			{
				?>
				<script type="text/javascript">
					window.desktopNotifications = 0;
				</script>
				<?php

			}

			if($_SESSION['smart_caffeine'] == "1")
			{
				?>
				<script type="text/javascript">
					window.smartCaffeine = 1;
				</script>
				<?php		

			}
			else
			{
				?>
				<script type="text/javascript">
					window.smartCaffeine = 0;
				</script>
				<?php		
			}			

			if($_SESSION['music'] == "1")
			{
				?>
				<script type="text/javascript">
					window.music = 1;
				</script>
				<?php
			}
			else
			{
				?>
				<script type="text/javascript">
					window.music = 0;
				</script>
				<?php
			}

			if($_SESSION['default_break'] == "1")
			{
				$default_break_interval = $_SESSION['default_break_interval'];
				?>
				<script type='text/javascript'>
					window.defaultBreakIntervalNotification = 1;
					window.defaultBreakInterval = <?php echo $default_break_interval ?>;
				</script>		
				<?php
			}
			else
			{
				?>
				<script type="text/javascript">
					window.defaultBreakIntervalNotification = 0;
					window.defaultBreakInterval = "";
				</script>
				<?php
			}

			if($_SESSION['music'] == "1")
			{
				$_SESSION['USER_MUSIC_SETTING'] = "TRUE";
				$music_source = $_SESSION['music_source'];
				$music_embed_code = $_SESSION['music_embed_code'];
				?>
				<script type="text/javascript">
					window.musicSetting = 1;
					window.musicSource = <?php echo "'".$music_source."'" ?>;
					window.musicEmbedCode = <?php echo "'".$music_embed_code."'" ?>;
				</script>
				<?php

			}
			else
			{
				$_SESSION['USER_MUSIC_SETTING'] = "FALSE";
				?>
				<script type="text/javascript">
					window.musicSetting = 0;
					window.musicSource = "";
					window.musicEmbedCode = "";
				</script>
				<?php
			}
			
		}
			
	}

	function isMusicSourceSelected($musicSource,$dbValue)
	{
		//echo "Music Source is $musicSource & Dbvalue is $dbValue";
		$returnValue = ($musicSource == $dbValue ? true : false);
		if($returnValue == "true")
		{
			return "selected";
		}
		else
		{
			return " ";
		}
	}
?>