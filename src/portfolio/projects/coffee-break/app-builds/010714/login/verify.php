<?php
/* verify.php - Prashanth Rajaram */

include('../includes/preheader.php');

	if(isset($_SESSION['LOGINSTATUS']))
	{
		header("Location: $home");
	}
	else
	{
		//echo "GUSER is ".$_GET['USER'];
		if(isset($_GET['USER'])) // GUEST CHECK
		{
			$userType = $_GET['USER'];
			if($userType == 'GUEST')
			{
				echo "logging in as guest\n";
				guestLogIn();
			}
			else
			{
				header("Location: $login");
			}

		}
		else if(isset($_POST['coffee-login-submit'])) // USER ENTERED INFO
		{
			$_SESSION['LOGIN_TYPE'] = "Coffee";
			$loginID = make_safe($_POST['login-email']);
			$password = make_safe($_POST['login-pwd']);
			$token = $_POST['post.token'];
			
			//echo $loginID." ".$password;
			$loginSuccess = verifyLoginDetails($loginID,$password,$token);
			if($loginSuccess == 1)
			{
				//echo "pass";
				header("Location: $home");
			}
			else
			{
				//echo "fail";
				header("Location: $login");
			}
		}
		else if(isset($_POST['coffee-register-submit'])) // NEW USER ENTERED INFO
		{
			$registerName = make_safe($_POST['register-full-name']);
			$registerEmail = make_safe($_POST['register-email']);
			$registerPwd = make_safe($_POST['register-pwd']);			
			$registrationSuccess = registerNewUser($registerName, $registerEmail, $registerPwd);
			if($registrationSuccess == 1)
			{
				header("Location: $register/?register=success");
			}
			else if($registrationSuccess == 2)
			{
				header("Location: $register/?register=duplicate");
			}
			else
			{
				header("Location: $register/?register=fail");
			}
		}		
		else
		{
			//header("Location: $login");			
		}
	}
include('../includes/postheader.php');
?>
<body>
<div id="left" class="left">
</div>
<div id="center" class="center">
</div>
<div id="right" class="right">
</div>
</body>
<?php 
	include('../includes/footer.php');
?>
</html>