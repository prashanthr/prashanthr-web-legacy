/*actions.js*/
function handleAction(value){
	if(value == 'tbreak')
	{
		var result=prompt("Please enter the number of hours after which you want to take a break:","0.5");
		if (result!=null)
		  {
		  	value = 'tbreak' + '&break_time=' + result;
		  }
	}
  	
  	window.location.href = "http://www.prashanthr.info/portfolio/projects/coffee-break/app/?action=" + value;
}



function executeQuickBreakMethods()
			{
				pauseTimer();
				quickBreakNotification();
				recordDataAjax('qbreak',document.getElementById('time').innerHTML);
			}

function executeTimedBreakMethods()
			{
				recordDataAjax('tbreak',document.getElementById('time').innerHTML);
				//Clear Default Interval as User chosen break takes precedence
				clearInterval(window.interval_DTB);
			}


function executeNormalModeMethods()
			{
				recordDataAjax('work',document.getElementById('time').innerHTML);
				//recordDataAjax('work',document.getElementById('timerdebug').Value);
			}

function getTimeToBreak()
{
	var milliTimer=prompt("Please enter the number of hours/mins/secs followed by a space and the unit after which you want to take a break. For example you can enter: 1 h or 1 hr or 10 m or 10 mins. (Valid units are - h/hr/hrs/hour/hours, m/min/mins/minute/minutes, s/sec/secs/second/seconds )","0.5 h");
	if (milliTimer == null || milliTimer == '')
	{
	  	//User Cancelled
	  	return null;
	}

	var pieces = milliTimer.split(" ");
	var int_value =  pieces[0]; // number
	var unit_value = pieces[1]; // unit i.e hrs mins secs	
				
	if(unit_value == "hr" || unit_value == "hrs" || unit_value == "h" || unit_value == "hour" || unit_value == "hours")
	{
		milliTimer = int_value*3600000;
	}
	else if(unit_value == "min" || unit_value == "mins" || unit_value == "m" || unit_value == "minute" || unit_value == "minutes")
	{
		milliTimer = int_value*60000;
	}
	else if(unit_value == "sec" || unit_value == "secs" || unit_value == "s" || unit_value == "second" || unit_value == "seconds")
	{
		milliTimer = int_value*1000;
	}
	else
	{
		alert('Invalid Break Time');
		//Loop
		milliTimer = getTimeToBreak();
	}

	return milliTimer;
}


function performAction (value) {

	
	if(value == 'work')
	{
		executeNormalModeMethods();
			
	}
	else if(value == 'qbreak')
	{
		executeQuickBreakMethods();
			
	}
	else if(value == 'tbreak')
	{
		var milliTimer = getTimeToBreak();
		if(milliTimer == null)
		{
			return;
		}
		else
		{
			executeTimedBreakMethods();
			setTimeout('pauseTimer()',milliTimer);setTimeout('quickBreakNotification()',milliTimer);
		}
		
	}
	else if(value == 'dbreak')
	{
		var milliTimer = 3600000; // 1 Hr
		executeTimedBreakMethods();
		setTimeout('pauseTimer()',milliTimer);setTimeout('quickBreakNotification()',milliTimer);
	}
	else
	{
		
	}
	

}

function defaultTimedBreak() {
	if(window.defaultBreakIntervalNotification == 1)
	{
		pauseTimer();
		quickBreakNotification();
	}
	
}

