<?php
/* info.php - Prashanth Rajaram */
?>
<div id="infoDiv" class="infoDiv">
<?php
	if($_SESSION['USER'] == "GUEST")
	{
		/*if($pageContext == "Account")
		{
			showBasicInfo();
		}
		else
		{*/
			showInfo();	
		//}
		
		
		//Old Guest logout button
		//echo "<a href='$GuestLogoutUrl'>Logout</a>";
		echo "<br />";
	}
	else
	{

		if($user)
		{
			showInfo();
			//FB LOGOUT BUTTON
			//echo "<a class='fbbtn' href='$logoutUrl'>Logout</a>";
			
			//OLD FB LOGOUT
			//echo "<a href='$logoutUrl'><img class='f_logo' src='$images/f_logo.png' /> Logout </a>";
			echo "<br />";
		}
		else
		{
			showNoInfo();
			
			echo "<a href='$login' class='btn'><i class='icon-user'></i> Log In / Register </a>";

			/*echo "<a class='fbbtn' href='$loginUrl'>Login</a>";
			echo "<br />OR<br />";*/
			
			//GUEST LOGIN
			//echo "<a class='guestbtn' href='$GuestLoginUrl'>Guest Login</a>";
			//echo "<a href='$GuestLoginUrl' class='button white'><table><tr><td><img src='$images/guestlogin.png' class='guestloginimg'/></td><td>Guest</td></tr></table></a>";
			//echo "<a href='$GuestLoginUrl' class='button white'>Guest Login</a>";
			
			/*echo "<a href='$GuestLoginUrl' class='btn'><i class='icon-user'></i> Guest</a>";*/

			//OLD FB LOGIN
			//echo "<a href='$loginUrl'><img class='f_logo' src='$images/f_logo.png'/> Login </a>";
			
			echo "<br />";
		}
	}
?>
</div>
