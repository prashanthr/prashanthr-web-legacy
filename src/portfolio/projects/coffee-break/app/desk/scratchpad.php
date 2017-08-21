<?php
/* desk/scratchpad.php - Prashanth Rajaram */
?>
<div id='sleektable' class='' align='center scratchpad'>
	<table cellspacing='0' class='circle scratchpad'>
		<tr><th>Scratchpad</th></tr>
		<tr>
			<td><textarea name="scratchpad" id="scratchpad" data-widearea="enable" placeholder="Scribble something..."></textarea></td>
		</tr>
		<tr>
			<td style='text-align:center'>
				<a class="btn btn-default btn-sm" href="#save-status-para" onClick='SaveNotepadContent()'>
  					<i class="icon-save"></i> Save</a>
  				<br />
  				<div class='save-status'>
  					<p id='save-status-para'></p>
  				</div>
  			</td>
		</tr>
	</table>
</div>