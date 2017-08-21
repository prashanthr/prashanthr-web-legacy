/* notify.js */
/* Author - Prashanth Rajaram */

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
		notification = window.webkitNotifications.createNotification('http://localhost/prashanthr/images/me.jpg', 'Ahoy there!', 'How you doin?');
		notification2 = window.webkitNotifications.createNotification('http://localhost/prashanthr/images/me.jpg', '........', 'You didn\'t really think I was a real person did you?');		
		notification3 = window.webkitNotifications.createNotification('http://localhost/prashanthr/images/me.jpg', 'Just Kidding!', 'I simply wanted to thank you for visiting my website. You\'re Awesome!');		
		notification4 = window.webkitNotifications.createNotification('http://localhost/prashanthr/images/me.jpg', 'Check it out', 'Click this box to sign my Guest Book. Thanks a ton!');		
		notification.show();	
		setTimeout('notification.cancel()', 4000);
		setTimeout('notification2.show()', 4000);
		setTimeout('notification2.cancel()', 10000);
		setTimeout('notification3.show()', 10000);
		setTimeout('notification3.cancel()', 15000);
		setTimeout('notification4.show()', 18000);
		notification4.onclick = function(x) { window.open("http://localhost/prashanthr/guestbook/"); this.cancel(); };
	}
  }