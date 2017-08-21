<?php
	$email = $_SESSION['USEREMAIL'];
	$notesQuery = mysql_query("SELECT id,save_time,notes,project_id FROM notes WHERE email='$email'");
?>
<div id='sleektable' class='' align='center'>
	<table cellspacing='0' class='circle'>
		<tr><th>Notes</th></tr>
		<?php
		while($row = mysql_fetch_array($notesQuery))
		{
			echo "<tr>";
			echo "<td>".$row['save_time']."</td>";
			//echo "<td>".$row['notes']."</td>";
			$notes = $row['notes'];
			echo "<td>".substr($notes, 0, round(0.25 * strlen($notes)))."</td>";
			echo "<td>".$row['project_id']."</td>";			
			//echo "<td><a href='#".$row['id']."'>View</a></td>";			
			//echo "<td><a href='#' onClick=showNotesDialog('".preg_replace('/[^A-Za-z0-9\-]/', '', $notes)."')>View</a></td>";			
			$json_notes = json_encode($notes);
			$preg_notes = preg_replace('/"([a-zA-Z]+[a-zA-Z0-9_]*)":/','$1',$json_notes);
			echo '<td><a href=# onClick=showNotesDialog(\''.$preg_notes.'\')>View</a></td>';			
			echo "<tr>";
		}
		?>		
	</table>
</div>
<div id='notesDialogWrapperDiv'>
			<div id='noteDialogDiv' class='ui-helper-hidden'></div>
</div>	