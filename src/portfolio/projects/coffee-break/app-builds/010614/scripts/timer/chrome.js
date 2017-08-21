document.querySelector('#show_button').addEventListener('click', function() {
  if (window.webkitNotifications.checkPermission() == 0) { // 0 is PERMISSION_ALLOWED
    // function defined in step 2
    window.webkitNotifications.createNotification(
        'http://prashanthr.info/images/me.jpg', 'Ahoy There', 'Thanks for checking out Coffee Break!');
  } else {
    window.webkitNotifications.requestPermission();
  }
}, false);