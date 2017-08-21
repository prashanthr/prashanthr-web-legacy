/* desktopNotify.js */
/* Author - Prashanth Rajaram */

function RequestPermission(callback) {
  window.webkitNotifications.requestPermission(callback);
}

function checkNotificationAbility() {
  if (window.webkitNotifications.checkPermission() > 0) {
    RequestPermission(check);
	return true;
  }
  else
	return true;
}

function logoutNotify() {
	var b = checkNotificationAbility();
	if(b === true)	
	{
		notification = window.webkitNotifications.createNotification('http://prashanthr.info/images/me.jpg', 'Ahoy there!', 'Thanks for checking out Coffee Break');
		notification.show();	
		setTimeout('notification.cancel()', 4000);
	}
  }
  
function timedBreakNotification() {
	var b = checkNotificationAbility();
	if(b === true)	
	{
		notification = window.webkitNotifications.createNotification('http://prashanthr.info/images/icons/coffeecupicon.png', 'Ahoy there!', 'Time to take a break!');
		notification.show();
		notification.onclick = function(x) { window.focus(); this.cancel(); $(location).attr('href',path);};
		notification.onclose = function(x) { document.getElementById('timerupdate').innerHTML = 'The timer has expired!'; }
	}
}

function quickBreakNotification() {
	if(window.desktopNotifications == 1)
	{
		//$.notify.alert("Go Take a Break! I'll will use the power of the sands to stop time...");
		var b = checkNotificationAbility();
		if(b === true)	
		{
			notification = window.webkitNotifications.createNotification('http://prashanthr.info/images/icons/coffeecupicon.png', 'Ahoy there!', 'Time to take a break!');
			notification.show();
			notification.onclick = function(x) { window.focus(); this.cancel(); $(location).attr('href',path);};
			//notification.onclose = function(x) { document.getElementById('timerupdate').innerHTML = 'The timer has expired!'; }
		}
	}
}

function desktopNotification(text) {
	if(window.desktopNotifications == 1)
	{
		/*var b = checkNotificationAbility();
		if(b === true)	
		{
			notification = window.webkitNotifications.createNotification('http://prashanthr.info/images/icons/coffeecupicon.png', 'Ahoy there!', text);
			notification.show();
			notification.onclick = function(x) { window.focus(); this.cancel(); $(location).attr('href',path);};
			//notification.onclose = function(x) { document.getElementById('timerupdate').innerHTML = 'The timer has expired!'; }
		}*/
		desktopNotifyHandler("default","default",text);
	}
}

function desktopNotificationTest(text) {
	/*var b = checkNotificationAbility();
	if(b === true)	
	{
		notification = window.webkitNotifications.createNotification('http://prashanthr.info/images/icons/coffeecupicon.png', 'Ahoy there!', text);
		notification.show();
		notification.onclick = function(x) { window.focus(); this.cancel(); $(location).attr('href',path);};
		//notification.onclose = function(x) { document.getElementById('timerupdate').innerHTML = 'The timer has expired!'; }
	}*/

	desktopNotifyHandler("default","default","test");
}

function smartDesktopNotification(text) {
	var b = checkNotificationAbility();
	if(b === true)	
	{
		notification = window.webkitNotifications.createNotification('http://prashanthr.info/portfolio/projects/coffee-break/app/images/light-icon.png', 'Smart Caffeine Alert', text);
		notification.show();
		notification.onclick = function(x) { window.focus(); this.cancel(); $(location).attr('href',path);};
		//notification.onclose = function(x) { document.getElementById('timerupdate').innerHTML = 'The timer has expired!'; }
	}
}

/* FIREFOX HTML5 */
/* http://jsfiddle.net/robnyman/TuJHx/ */
/* http://notifications.spec.whatwg.org/ */
function authorizeNotificationFF() {
    Notification.requestPermission(function(perm) {
        //alert(perm);
    });
}

function showNotificationFF() {
    var notification = new Notification("This is a title", {
        dir: "auto",
        lang: "",
        body: "This is a notification body",
        tag: "sometag",
    });
    
     // notification.onclose = …
    //notification.onshow = alert('error');
    // notification.onerror = …
}

function desktopNotifyAuthHandler()
{
	if(BrowserDetect.browser == "Chrome")
	{
		authorizeNotificationChrome();
	}
	else if(BrowserDetect.browser == "Firefox")
	{
		authorizeNotificationFF();
	}
	else
	{
		authorizeNotificationChrome();
	}
}

function desktopNotifyHandler(image,title,text)
{
	if(image == "default")
	{
		image = "http://prashanthr.info/portfolio/projects/coffee-break/app/images/favicon.png";
	}
	else if(image == "smart")
	{
		image = "http://prashanthr.info/portfolio/projects/coffee-break/app/images/light-icon.png";
	}
	else
	{
		image = "http://prashanthr.info/portfolio/projects/coffee-break/app/images/favicon.png";
	}

	if(title == "default")
	{
		title = "Coffee Break";
	}
	else if(title == "smart")
	{
		title = "Smart Caffeine";
	}
	else
	{
		title = "Coffee Break";
	}

	if(text == "default")
	{
		text = "Time to take a break";
	}
	else if(text == "qbreak" || text == "break")
	{
		text = "Time to take a break";
	}
	else if(text == "test")
	{
		text = "This is a test notification";
	}
	else
	{
		text = text;
	}

	if(BrowserDetect.browser == "Chrome")
	{
		desktopNotifyForChrome(image,title,text);
	}
	else if(BrowserDetect.browser == "Firefox")
	{
		desktopNotifyForFirefox(image,title,text);
	}
	else
	{
		desktopNotifyForChrome(image,title,text);
	}
}


function authorizeNotificationChrome()
{
	if (window.webkitNotifications.checkPermission() > 0) {
    RequestPermission(check);
	return true;
  }
  else
	return true;
}

function desktopNotifyForChrome(image,title,text)
{
	var b = checkNotificationAbility();
	if(b === true)	
	{
		notification = window.webkitNotifications.createNotification(image, title, text);
		notification.show();
		notification.onclick = function(x) { window.focus(); this.cancel(); $(location).attr('href',path);};
		//notification.onclose = function(x) { document.getElementById('timerupdate').innerHTML = 'The timer has expired!'; }
	}
}

function desktopNotifyForFirefox(image,title,text)
{
	authorizeNotificationFF();
	var notification = new Notification(title, {
        dir: "auto",
        lang: "",
        body: text,
        icon: image,
        tag: "",
    });
    notification.onclick = function(x) { window.focus(); this.cancel(); $(location).attr('href',path);};

}