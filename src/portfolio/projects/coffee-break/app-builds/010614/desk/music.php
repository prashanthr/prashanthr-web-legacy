<?php
 /* desk/music.php - Prashanth Rajaram */
 include("../includes/includes.php");
?>
<script type='text/javascript'>
	if(window.music == 1)
	{
		turnOnMusic();
	}
	else
	{
		turnOffMusic();
	}

</script>

<div id='sleektable' class='' align='center'>
	<table cellspacing='0' class='circle musicbox'>
		<tr><th>Music Box <br /> (Playing From <script type='text/javascript'>document.write(window.musicSource.charAt(0).toUpperCase() + window.musicSource.slice(1));</script> )</th></tr>
		<tr><td>
<?php
 /*if(isset($_SESSION['USER_MUSIC_SETTING']))
 {
 	$user_music_setting = $_SESSION['USER_MUSIC_SETTING'];
 	if($user_music_setting == "TRUE")
 	{
 		echo "Turning on!";
 		turnOnMusic(); 		
 	}
 	else
 	{
 		echo "Turning Off though set";
 		turnOffMusic();
 	}
 }
 else
 {
 	echo "Turning Off though not set";
 	turnOffMusic();
 }

 function turnOnMusic()
 {
 	//$email = $_SESSION['USEREMAIL'];
 	//$musicEmbedQuery = mysql_query("SELECT music_embed_code FROM app_settings WHERE email='$email'");
 	$musicEmbedCode = $_SESSION['music_embed_code'];
 	echo $musicEmbedCode;
 }

 function turnOffMusic()
 {
 	global $account;
 	echo "Music is turned off. <a href='$account/?tab=settings'>Turn On</a>.";
 }*/

?>
<script type='text/javascript'>document.write(window.musicScript);</script>
</td></tr>
</table>
</div>