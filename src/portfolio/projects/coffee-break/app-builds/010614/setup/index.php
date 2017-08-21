<?php
/* setup/index.php - Prashanth Rajaram */

include('../includes/preheader.php');
include('../includes/postheader.php');
$pageContext = "Setup";
?>
<title>
<?php echo $titleArray['Setup']; ?>
</title>
<div id='container'>
	<div id='menubox' class='circle'>
		<?php include("$include_file_prefix/menu.php"); ?>
	</div>
	<div id='infobox' class='circle'>
		<?php 
			include("$include_file_prefix/info.php");
		?>
	</div>
	<div id='contentbox' class=''>
<?php
	if($_SESSION['LOGGED_IN'] == "TRUE")
	{
		?>
		<div class='alert-para'>
		<?php
		setup();
		?>
		<p class='alert alert-info'>Click <a href='<?php echo $dashboard; ?>'>here</a> to visit your dashboard after setting up your browser.</p>
		</div>
		<?php
	}
	else 
	{
		//Display Front Page Content
		echo "test\n";
		echo $_SESSION['LOGGED_IN']."\n".$_SESSION['USER'];
	}	

?>			
	</div>
</div>
</body>
<?php 
	include("$include_file_prefix/footer.php");
?>
</html>