//Notifications
//Referred from https://github.com/aiannacc/Goko-Salvager/blob/f35bbd61d8b9b57befed10ccc92725a0e6a3be47/src/ext/notifications.js
function init()
{
	var Notification = window.Notification || window.mozNotification
                                               || window.webkitNotification;

        var openNotifications = [];

        var requestNotificationPermission = function () {
            Notification.requestPermission(function (p) {
                console.log('Notification permission: ' + p);
            });
        };

        var ALLOWED = 0;
        var NOT_SET = 1;
        var BLOCKED = 2;
        var getNotificationPermission = function () {
            switch (Notification.permission) {
            case 'granted':
                return 0;
            case 'default':
                return 1;
            case 'denied':
                return 2;
            default:
                throw 'Impossible Notification.permission value: '
                    + Notification.permission;
            }
}


var createDesktopNotification = function (message) {
            var n = new Notification(message, {icon: GS.salvagerIconURL});
            openNotifications.push(n);
        };



function notifyUser(message)
{
	var p = getNotificationPermission();
                if (p === ALLOWED) {
                    createDesktopNotification(message);
                } else if (p === NOT_SET) {
                	return
                }
}