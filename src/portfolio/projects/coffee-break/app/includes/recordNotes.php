<?php
session_start();
//connect to db
include('db.php');

$notes = $_POST['notes'];
saveNotes($notes);

function saveNotes($notes)
{
	if($_SESSION["LOGGED_IN"] == "TRUE")
	{
		if($_SESSION['USER'] == "GUEST")
		{
			//echo "GUESTMAN!";
		}
		else
		{
			$email = $_SESSION['USEREMAIL'];
			
			//$checkQuery = mysql_query("SELECT notes FROM notes WHERE email='$email'");
			//while($row = mysql_fetch_array($checkQuery))
			//{

			//}

			$save_time = date("Y-m-d H:i:s"); // 2001-03-10 17:16:18 (the MySQL DATETIME format)
			//$updateQuery = mysql_query("UPDATE notes SET notes='$notes', save_time='$saveTime' WHERE email='$email'");
			//mysql_query("INSERT INTO notes (save_time,notes,email) VALUES ('$save_time','$notes', '$email')") or die(mysql_error());
			$insertNotes = mysql_query("INSERT INTO notes (save_time,notes,email) VALUES ('$save_time','$notes', '$email')");
			
			if($insertNotes)
				echo "Saved"." (".date_format(date_create($save_time), 'g:i A').")";
			else
				echo "Save unsuccessful. Try again later.";
		}
	}
	
}


?>