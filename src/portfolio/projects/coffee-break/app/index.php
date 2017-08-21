<?php
/* index.php - Prashanth Rajaram */

include('includes/preheader.php');
include('includes/postheader.php');
$pageContext = "Home";
//setup();
	if($_SESSION['LOGGED_IN'] == "TRUE")
	{
		//removeCookie();
		$checkSetup = checkSetup();
		if($checkSetup == "true")
		{

			echo "<script type='text/javascript'>redirectTo('$dashboard')</script>";
		}
		else
		{
			echo "<script type='text/javascript'>redirectTo('$setup')</script>";
		}	
	}
	else 
	{
		//Display Front Page Content
		
		
?>
<title>
<?php echo $titleArray['Home']; ?>
</title>
<div id='container'>
	<div id='menubox' class='circle'>
		<?php include ('includes/menu.php'); ?>
	</div>
	<?php 
		//SLIDER
		echo "<div class='slider'>";
		include("$includes/flex-slider.php");
		echo "</div>";
	?>
	<div id='infobox' class='circle'>
		<?php 
			include('includes/info.php');
		?>
	</div>
	<div id='contentbox' class=''>
<?php
		
		//CONTENT
		$page_query = mysql_query("SELECT * FROM site_data WHERE page='$pageContext'");
		while($row = mysql_fetch_array($page_query))
		{
			$title = $row['title'];
			$description = $row['description'];
			echo "<h3>";
			echo "$title";
			echo "</h3>";
			echo "<p>";
			echo "$description";
			echo "</p>";			
		}
	}	

?>			
	</div>
</div>
</body>
<?php 
	include('includes/footer.php');
?>
</html>