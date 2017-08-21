<?php
/* profile.php - Prashanth Rajaram*/

include('../includes/header.php')
?>
<body>
<?php
	if(isset($_SESSION['LOGINSTATUS']))
	{
		if (isset($_GET['action']))
		{
			$action = $_GET['action'];
		}
		else
		{
			$action = 'view';
		}
	}
	else
	{
		header("Location: $login");
	}
?>
<div id="left" class="left">
</div>
<div id="center" class="center">
<?php
	displayProfile($action);
?>
</div>
<div id="right" class="right">
</div>
</body>
<?php 
	include('../includes/footer.php');
?>
</html>