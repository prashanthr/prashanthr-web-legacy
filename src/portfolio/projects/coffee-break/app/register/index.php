<?php
/* Register - Prashanth Rajaram */

//Include Files
include('../includes/preheader.php');
include('../includes/postheader.php');
?>
<title>
<?php echo $titleArray['Register']; ?>
</title>
<div id='container'>
	<div id='menubox' class='circle'>
		<?php include ("$includes/menu.php"); ?>
	</div>
	<div id='contentbox' class=''>
		<div class='register-table-div'>
			<?php
				if(!isset($_GET['register']))
				{
					echo "<p class='alert alert-para'>Please register through the <a href='$login'>registration page</a>.</p>";
				}
				else
				{
					$registerMsg = $_GET['register'];
					switch ($registerMsg) {
						case 'success':
							echo "<p class='alert alert-para'>Registration Successful. Please <a href='$login'>Log In</a> to use the app.</p>";
							break;
						case 'fail':
							echo "<p class='alert alert-para'>Registration Unsuccessful. Please <a href='$login'>try again</a> later.</p>";
							break;
						case 'duplicate':
							echo "<p class='alert alert-para'>Registration Unsuccessful. This email address is already taken. Please <a href='$login'>try again</a>.</p>";
							break;
						default:
							echo "<p class='alert alert-para'>Registration Unsuccessful. Please <a href='$login'>try again</a> later.</p>";
							break;
					}
				}
			?>
		</div>
	</div>
</div>
</body>
<?php 
	include("$includes/footer.php");
?>
</html>