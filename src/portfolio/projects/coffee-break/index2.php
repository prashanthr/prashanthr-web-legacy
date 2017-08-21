<?php
/* Coffee - Break
   Author - Prashanth Rajaram
*/
if(isset($_GET['choice']))
{
	$setFlag = "1";
	$choice = $_GET['choice'];
}
else
{
	$setFlag = "0";
}

?>
<!DOCTYPE html>
<html>
<head>
<title>Coffee-Break | Prashanth Rajaram </title>
<link rel="icon" type="image/png" href="http://prashanthr.info/images/icons/coffeecupicon.png" />
<div align='center'>
<h3>Coffee Break</h3>
</div>
<?php
echo "<link rel='stylesheet' type='text/css' href='styles/theme.css' />";
echo "<script type='text/javascript' src='js/time.js'></script>";
?>
<script type="text/javascript">

function RequestPermission(callback) {
  window.webkitNotifications.requestPermission(callback);
}

function check() {
  if (window.webkitNotifications.checkPermission() > 0) {
    RequestPermission(check);
	return true;
  }
  else
	return true;
}

function notify() {
	var b = check();
	if(b === true)	
	{
		notification = window.webkitNotifications.createNotification('http://prashanthr.info/images/me.jpg', 'Ahoy there!', 'Thanks for checking out Coffee Break');
		notification.show();	
		setTimeout('notification.cancel()', 4000);
	}
  }
  
function breaktime() {
	var b = check();
	if(b === true)	
	{
		notification = window.webkitNotifications.createNotification('http://prashanthr.info/images/icons/coffeecupicon.png', 'Ahoy there!', 'Time to take a break!');
		notification.show();
		notification.onclick = function(x) { this.window.focus(); this.cancel(); $(location).attr('href',path);};
		notification.onclose = function(x) { document.getElementById('timerupdate').innerHTML = 'The timer has expired!'; }
	}
}

function playJazz() {
	//document.getElementById('musicframe').innerHTML = "<iframe height='100px' width='350px' src='http://betaplayer.radio.com/player/smooth-jazz-v987-hd2#info_social_box'></iframe>";
	document.getElementById('musicframe').innerHTML = "<object width='400' height='200' classid='clsid:D27CDB6E-AE6D-11cf-96B8-444553540000' id='gsPlaylist7775693864' name='gsPlaylist7775693864'><param name='movie' value='http://grooveshark.com/widget.swf' /><param name='wmode' value='window' /><param name='allowScriptAccess' value='always' /><param name='flashvars' value='hostname=cowbell.grooveshark.com&playlistID=77756938&bbg=000000&bth=000000&pfg=000000&lfg=000000&bt=FFFFFF&pbg=FFFFFF&pfgh=FFFFFF&si=FFFFFF&lbg=FFFFFF&lfgh=FFFFFF&sb=FFFFFF&bfg=666666&pbgh=666666&lbgh=666666&sbh=666666&p=0' /><object type='application/x-shockwave-flash' data='http://grooveshark.com/widget.swf' width='400' height='200'><param name='wmode' value='window' /><param name='allowScriptAccess' value='always' /><param name='flashvars' value='hostname=cowbell.grooveshark.com&playlistID=77756938&bbg=000000&bth=000000&pfg=000000&lfg=000000&bt=FFFFFF&pbg=FFFFFF&pfgh=FFFFFF&si=FFFFFF&lbg=FFFFFF&lfgh=FFFFFF&sb=FFFFFF&bfg=666666&pbgh=666666&lbgh=666666&sbh=666666&p=0' /><span><a href='http://grooveshark.com/playlist/Energize/77756938' title='Energize by Prashanth Rajaram on Grooveshark'>Energize by Prashanth Rajaram on Grooveshark</a></span></object></object>'></iframe>";
	document.getElementById('musicbutton').innerHTML = "";
}

function stopJazz() {
	document.location.reload(true);
}
  
</script>
<script type="text/javascript" src="chrome.js"></script>
<?php include("../../../includes/track.php"); ?>
</head>
<body onload=display_ct();>
<?php
if($setFlag == "1")
{
}
else
{
?>
<script type="text/javascript">setTimeout('notify()',2000) </script> 
<?php
}
?>
<div id="coffee-div" align="center">
<table>
<tr>
<td id="timebox"><span id='date'></span></td>
</tr>
<tr>
<td id="timebox">The current time is: <span id='time'></span></td>
</tr>
<?php
if($setFlag == 1)
{
?>
<tr>
<td id="actionbox">
<?php
$timerset = $choice/60;
$millitimer = $choice*1000;
date_default_timezone_set('America/Detroit');
$now = date("H:i"); 
echo "<span id='timerupdate'>The timer has been set for <span id='breaktime'>$timerset</span> min from $now.</span>"; 
echo "<script type='text/javascript'>setTimeout('breaktime()',$millitimer)</script>"; 
?>
</td>
</tr>
<tr>
<td>
<a href="index.php">Take another break</a>
</td>
</tr>

<?php
}

else
{
?>
<tr>
<td id="actionbox">
<p>Take a break after:  
<form class="options" name="break" action="index.php?set=1" method="GET">
<p><select class="options" name="choice" size="1">
<option class="options" value="0">Choose...</option>
<option class="options" value="300">5 mins</option>
<option class="options" value="600">10 mins</option>
<option class="options" value="1800">30 mins</option>
<option class="options" value="3600">1 hr</option>
<option class="options" value="7200">2 hrs</option>
</select><input type="submit" value="Go" name="submit"></p>
</form>
</p>
</td>
</tr>
<?php
}
?>
</table>
<div>
<a href='#' id='musicbutton' onClick='playJazz()'>Turn On Music</a>
<br /><span id='musicframe'></span>
</div>
</div>
<span id="chrome"><a href="#" onClick="check()">I'm using Google Chrome</a></span><br />
<a href='about/'>About</a><br /><span id='author'>By Prashanth R</span><br />&copy;2012
</body>
</html>

