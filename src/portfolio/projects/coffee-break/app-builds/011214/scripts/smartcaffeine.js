/* Smart Caffeine v1.0 - Prashanth R */
/* Smart algorithm to notify user about intelligent events */

window.numHrsElapsed = 0.00;
window.lastBreakTime = 0.00;
window.lastResumeTime = 0.00;
window.lastHydrateTime = 0.00;

/* Update global vars */
function smart_updateBreakTime()
{
	window.lastBreakTime = new Date();
}
function smart_updateResumeTime()
{
	window.lastResumeTime = new Date();
}

function smart_updateNumHrsElapsed()
{
	window.numHrsElapsed = new Date();
}

/* Function to check duration of work and prevent user from working too hard */
function smart_workChecker()
{
	var now = new Date();
	if(((now - window.lastBreakTime)/1000) >  7200)
	{
		var message = "You have been working for more than 2 hrs - You need to take a break";
		console.log(message);
		//Notify User
		//alert(message);
		smartDesktopNotification(message);
		//Reset timer
		//setTimeout(smart_workChecker,7200000);
	}
}

/* Function to remind user to stay hydrated */
function smart_hydrationChecker()
{
	var now = new Date();
	if(((now - window.lastHydrateTime)/1000) >  5400)
	{
		var message = "Have you drunk water recently? You don't want to die working so hard!";
		console.log(message);
		//Notify User		
		//alert(message);
		smartDesktopNotification(message);
		//Reset Timer
		//setTimeout(smart_hydrationChecker,5400000);
	}
}

/* Function to monitor breaks */
function smart_breakChecker()
{
	var now = new Date();
	if(((now - window.lastBreakTime)/1000) >  1800)
	{
		smart_detectMouseMove();	
	}
	
}

/* Function to detect mouse movements - used during break */
function smart_detectMouseMove()
{
	document.addEventListener('mousemove', smart_handleMouseMove, false);
}

/* Function to handle mouse movement during break */
function smart_handleMouseMove()
{
	var message = "You're working while on a break? Et Tu Brute!";
	console.log(message);
	//Notify User
	//alert(message);
	smartDesktopNotification(message);
	document.removeEventListener('mousemove', smart_handleMouseMove, false);
}

//Inital Calls
// if(window.smartCaffeine == 1)
// {
// 	setTimeout(smart_workChecker,7200000);
// 	setTimeout(smart_hydrationChecker,5400000);
// }