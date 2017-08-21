/* timer.js */

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