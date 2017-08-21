<?php
/* Notes - Prashanth Rajaram */

//Include Files
include('../includes/preheader.php');
include('../includes/postheader.php');
?>
<title>
<?php echo $titleArray['Notes']; ?>
</title>
<div id='container'>
	<div id='menubox' class='circle'>
		<?php include ("$includes/menu.php"); ?>
	</div>
	<div id='infobox' class='circle'>
		<?php 
			//include("$includes/info.php");
		?>
	</div>
	<div id='contentbox' class=''>
	<?php
		if($_SESSION['LOGGED_IN'] == "TRUE")
		{
			if($_SESSION['USER'] == "GUEST")
			{
				echo "Nothing to see here.";
			}
			else
			{
				include("view.php");
			}
		
			
		}
		else
		{
			echo "Please login to view your saved notes.";
		}
	?>		
	</div>
</div>
</body>
<?php 
	include("$includes/footer.php");
?>
</html>