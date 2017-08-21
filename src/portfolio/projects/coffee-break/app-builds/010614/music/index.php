<?php
 /* music/index.php - Prashanth Rajaram */
 include("../includes/include.php");
?>
<div id='sleektable' class='' align='center'>
	<table cellspacing='0' class='circle musicbox'>
		<tr><th>Music Box</th></tr>
		<tr><td>
<?php
 if(isset($_SESSION['USER_MUSIC_SETTING']))
 {
 	$user_music_setting = $_SESSION['USER_MUSIC_SETTING'];
 	if($user_music_setting == "true")
 	{
 		turnOnMusic(); 		
 	}
 	else
 	{
 		turnOffMusic();
 	}
 }
 else
 {
 	turnOffMusic();
 }

 function turnOnMusic()
 {

 }

 function turnOffMusic()
 {
 	global $account;
 	echo "Music is turned off. Click here to <a href='$account/?tab=settings'>turn on</a>.";
 }

?>
</td></tr>
</table>
</div>