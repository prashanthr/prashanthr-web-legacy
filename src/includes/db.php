<?php
/* db.php - Database Connections	*/
/* Author - Prashanth Rajaram */	
	
	$server = "localhost";
	$username= "prashan8_site";
	$password= "contentMaster99";
	$dbname = "prashan8_personal";
	
	$connection = mysql_connect("$server","$username","$password");
	if (!$connection)
	{
		//die('Whoops! I seem to be having issues accessing the data from up here. Please try again later! ( ' . mysql_error() .' )');
		echo "<div align='center' class='circle noise fourteen' style='width:600px;margin-left:350px;'>".
		"<p>Whoops! I seem to be having issues accessing the data from up here. Some of the content here may look funny, so please try again later.".
		"</p></div>";
	}
	mysql_select_db("$dbname", $connection);	
	checkMaintenance();
	
	function checkMaintenance()
	{
		$query = mysql_query("SELECT repair FROM metadata");
		while($row = mysql_fetch_array($query))
		{
			$repair = $row['repair'];
		}
		if($repair == "off")
		{
		}
		else
		{
			 echo "<meta HTTP-EQUIV='REFRESH' content='0; url=http://prashanthr.info/error/?error=007'>";
		}
	}
	
?>