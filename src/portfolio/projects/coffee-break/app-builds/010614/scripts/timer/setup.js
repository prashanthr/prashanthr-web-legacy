/* setup.js  - Checks and Sets up HTML 5 Notifications */
/* Author - Prashanth Rajaram */

function RequestPermission(callback) {
  window.webkitNotifications.requestPermission(callback);
}