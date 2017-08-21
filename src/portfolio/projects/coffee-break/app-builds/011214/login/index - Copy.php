<?php
/* login.php - Prashanth Rajaram */

include('../includes/preheader.php');

	if(isset($_SESSION['LOGINSTATUS'])) //If logged in
	{
		header("Location: $home");
	}
	else
	{
include('../includes/postheader.php');
?>
<body>
<div id="left" class="left">
</div>
<div id="center" class="center">
<?php
		if(isset($_GET['error'])) //Check for error flag
		{
			$error = $_GET['error'];
			if($error == 1)
			{
				//Check for Login Attempts
				if($_SESSION['LOGINATTEMPTS'] > 4)
				{
					toast("TOO MANY INVALID LOGIN ATTEMPTS. PLEASE TRY LATER");
					
					$returnValue = checkLoginAttempt();
					if($returnValue == true) //Time passed after Invalid Login Attempt
					{
						showLoginBox(); 
					}
					else
					{
						//Temporarily Unavailable due to Invalid Login
					}
				}
			}
			else // error flag is tampered with
			{
				showLoginBox();
			}
		}
		else //Regular Login
		{
			showLoginBox();
		}
		
	}
?>
</div>
<div id="right" class="right">
</div>
</body>
<?php 
	include('../includes/footer.php');
?>
</html>
