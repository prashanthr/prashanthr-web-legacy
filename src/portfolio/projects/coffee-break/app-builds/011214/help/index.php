<?php
/* Help - Prashanth Rajaram */

//Include Files
include('../includes/preheader.php');
include('../includes/postheader.php');
?>
<title>
<?php echo $titleArray['Help']; ?>
</title>
<div id='container'>
	<div id='menubox' class='circle'>
		<?php include ("$includes/menu.php"); ?>
	</div>
	<div id='infobox' class='circle'>
		<?php 
			include("$includes/info.php");
		?>
	</div>
	<div id='contentbox' class=''>
	<?php
		if($_SESSION['LOGGED_IN'] == "TRUE")
		{
			
			
		}
		else
		{

		}
	?>
	</div>
</div>
</body>
<?php 
	include("$includes/footer.php");
?>
</html>