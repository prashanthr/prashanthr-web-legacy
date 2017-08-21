<?php
	/* index.php - about - Prashanth Rajaram */
include('../includes/preheader.php');

if($user || $_SESSION['USER'] == 'GUEST')
{
	header("Location: ../index.php");
}


include('../includes/postheader.php');
$pageContext = "About";
?>
<title>
<?php echo $titleArray['About']; ?>
</title>
<div id='container'>
	<div id='menubox' class='circle'>
		<?php include ('../includes/menu.php'); ?>
	</div>
	<div id='infobox' class='circle'>
		<?php 
			include('../includes/info.php');
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
		?>
	</div>
</div>
</body>
<?php 
	include('../includes/footer.php');
?>
</html>