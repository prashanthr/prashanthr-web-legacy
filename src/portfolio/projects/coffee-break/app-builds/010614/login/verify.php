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
			?><script type='text/javascript'>alert('hi');</script><?php
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
		else if(isset($_POST['submitLogin'])) // USER ENTERED INFO
		{
			$loginID = make_safe($_POST['loginID']);
			$password = make_safe($_POST['password']);
			$token = $_POST['post.token'];
			
			$loginSuccess = verifyLoginDetails($loginID,$password,$token);
			if($loginSuccess == 1)
			{
				header("Location: $home");
			}
			else
			{
				header("Location: $login");
			}
		}		
		else
		{
			//header("Location: $login");
			?><script type='text/javascript'>alert('hooi');</script><?php
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