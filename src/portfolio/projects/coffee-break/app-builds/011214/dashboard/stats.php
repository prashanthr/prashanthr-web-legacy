<?php
/*stats.php - Prashanth Rajaram */
?>
<div id='sleektable' class='' align='center'>
	<table cellspacing='0' class='circle'>
		<tr><th>Your Statistics</th></tr>
		<tr><td>Total Hours Worked <span class='big-digit digit-blue'><?php echo $_SESSION['USER_TOTAL_WORK_HRS'];?></span></td></tr>
		<tr><td>Total Hours on Break <span class='big-digit digit-blue'><?php echo $_SESSION['USER_TOTAL_BREAK_HRS'];?></span></td></tr>
		<tr><td>Caffeine Points <span class='big-digit digit-blue'><?php echo $_SESSION['POINTS_OF_THE_SESSION'];?></span> [<a href='../level'>Info</a>]</td></tr>
	</table>
</div> 