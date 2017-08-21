/* time.js */
/* Author - Prashanth Rajaram */

function display_c(){
var refresh=1000; // Refresh rate in milli seconds
mytime=setTimeout('display_ct()',refresh)
}

function display_ct() {
var strcount
var x = new Date();
//document.getElementById('ct').innerHTML = x;
var date = x.getDate();
var month = x.getMonth();
month = validateMonth (month);
var day = x.getDay();
day = validateDay (day);
var year = x.getFullYear()
var hour = x.getHours();
var shift = getShift(hour);
hour = validateHour(hour);
var min = x.getMinutes();
min = validateTwoDigits(min);
var seconds = x.getSeconds();
seconds = validateTwoDigits(seconds);
var milli = x.getMilliseconds();
document.getElementById('date').innerHTML = day+', '+month+' '+date+' '+year;
document.getElementById('time').innerHTML = hour+':'+min+':'+seconds+' '+shift;
tt=display_c();
}


function validateTwoDigits(value)
{
	return value < 10 ? '0'+value : value;	
}


function validateTwoDigit(value)
{
	if(value == 0)
		return '00';
	else if(value == 1)
		return '01';
	else if(value == 2)
		return '02';
	else if(value == 3)
		return '03';
	else if(value == 4)
		return '04';
	else if(value == 5)
		return '05';
	else if(value == 6)
		return '06';
	else if(value == 7)
		return '07';
	else if(value == 8)
		return '08';
	else if(value == 9)
		return '09';
	else
		return value;
}

function validateMonth(month)
{
	if(month == 0)
		return 'January';
	else if(month == 1)
		return 'February';
	else if(month == 2)
		return 'March';
	else if(month == 3)
		return 'April';
	else if(month == 4)
		return 'May';
	else if(month == 5)
		return 'June';
	else if(month == 6)
		return 'July';
	else if(month == 7)
		return 'August';
	else if(month == 8)
		return 'September';
	else if(month == 9)
		return 'October';
	else if(month == 10)
		return 'Novemeber';
	else
		return 'December';
}

function validateDay(day)
{
	if(day == 0)
		return 'Sunday';
	else if(day == 1)
		return 'Monday';
	else if(day == 2)
		return 'Tuesday';
	else if(day == 3)
		return 'Wednesday';
	else if(day == 4)
		return 'Thursday';
	else if(day == 5)
		return 'Friday';
	else
		return 'Saturday';
}

function validateHour(hour)
{
	if(hour == 00)
		return '12';
	else if(hour == 13)
		return '01';
	else if(hour == 14)
		return '02';
	else if(hour == 15)
		return '03';
	else if(hour == 16)
		return '04';		
	else if(hour == 17)
		return '05';
	else if(hour == 18)
		return '06';
	else if(hour == 19)
		return '07';
	else if(hour == 20)
		return '08';
	else if(hour == 21)
		return '09';
	else if(hour == 22)
		return '10';
	else if(hour == 23)
		return '11';
	else 
		return hour;
}

function getShift(hour)
{
	if(hour < 12)	
		return 'AM'
	else
		return 'PM'
}

function getTimeNow()
{
	var x = new Date();
	var hour = x.getHours();
	var min = x.getMinutes();
	var seconds = x.getSeconds();
	
	return hour+':'+min+':'+seconds;
}

var global_hour = 00;//01;
var global_min = 00;//59;
var global_seconds = 00;//45;

var global_paused_hour = 00;
var global_paused_min = 00;
var global_paused_seconds = 00;


function runTimer()
{
	document.getElementById('time').innerHTML = global_hour+':'+global_min+':'+global_seconds;
	//document.getElementById('timerdebug').innerHTML = global_hour+':'+global_min+':'+global_seconds;
	
	
	var local_seconds = parseInt(global_seconds);
	var local_min = parseInt(global_min);
	var local_hour = parseInt(global_hour);

	//document.getElementById('timerdebug').innerHTML = local_hour+':'+local_min+':'+local_seconds;

	//seconds
	if(local_seconds == 59)
	{
		local_seconds = 00;
		//local_seconds = parseInt(local_seconds + 1);
		
		//set min
		if(local_min == 59)
		{
			local_min = 00;
			local_hour = parseInt(local_hour + 1);
		}
		else
		{
			local_min = parseInt(local_min + 1);
		}
	}
	else
	{
		local_seconds = parseInt(local_seconds + 1);
	}
		
		/*global_seconds = local_seconds; 
		global_min = local_min;
		global_hour = local_hour;*/
		
		global_seconds = validateTwoDigits(local_seconds);
		// global_seconds = local_seconds;
		global_min = validateTwoDigits(local_min);
		// global_min = local_min;
		global_hour = validateTwoDigits(local_hour);
		// global_hour = local_hour;

	document.getElementById('time').innerHTML = global_hour+':'+global_min+':'+global_seconds;
	refreshTimer();
}

function refreshTimer()
{
	var refresh=1000; // Refresh rate in milli seconds
	mytime=setTimeout('runTimer()',refresh)
}

function pauseTimer()
{
	//recordTimeAjax(document.getElementById('time').innerHTML);
	//recordDataAjax('pause', document.getElementById('timerdebug').innerHTML);
	recordDataAjax('pause',document.getElementById('time').innerHTML);


	global_paused_hour = validateTwoDigits(parseInt(global_hour));
	global_paused_min = validateTwoDigits(parseInt(global_min));
	global_paused_seconds = validateTwoDigits(parseInt(global_seconds));

	document.getElementById('time').setAttribute('id','timerpause');
	document.getElementById('timerpause').innerHTML = global_paused_hour+':'+global_paused_min+':'+global_paused_seconds;

	// document.getElementById('timerAction').innerHTML = "Resume";
	// document.getElementById('timerAction').setAttribute('onClick','resumeTimer()');
	handleIcons('pause','play');
	
	//Smart Functions
	if(window.smartCaffeine == 1)
	{
		clearInterval(window.interval_SWC);
		clearInterval(window.interval_SHC);
		clearInterval(window.interval_SNHE);
		smart_updateBreakTime();
		smart_breakChecker();
	}

	//Clear Intervals
	clearInterval(window.interval_DTB);
}

function resumeTimer()
{
	recordDataAjax('resume', document.getElementById('timerpause').innerHTML);

	global_hour = validateTwoDigits(parseInt(global_paused_hour));
	global_min = validateTwoDigits(parseInt(global_paused_min));
	global_seconds = validateTwoDigits(parseInt(global_paused_seconds));
	
	document.getElementById('timerpause').setAttribute('id','time');
	document.getElementById('time').innerHTML = global_hour+':'+global_min+':'+global_seconds;

	// document.getElementById('timerAction').innerHTML = "Pause";
	// document.getElementById('timerAction').setAttribute('onClick','pauseTimer()');

	refreshTimer();
	handleIcons('play','pause');

	//Smart Functions
	if(window.smartCaffeine == 1)
	{
		window.interval_SWC = setInterval(function(){smart_workChecker()},7200000);
		window.interval_SHC = setInterval(function(){smart_hydrationChecker()},5400000);
		window.interval_SNHE = setInterval(function(){smart_updateNumHrsElapsed()},3600000);
		smart_updateResumeTime();
	}

	//Reset Intervals
	window.interval_DTB = setInterval(function(){defaultTimedBreak()}, window.defaultBreakInterval);
}

function recordTimeAjax(time)
{
	var xmlhttp;
	if (time.length==0)
  	{
  		document.getElementById("paradebug").innerHTML="";
	  	return;
	}
	
	if (window.XMLHttpRequest)
	{
		// code for IE7+, Firefox, Chrome, Opera, Safari
	  	xmlhttp=new XMLHttpRequest();
	}
	else
	{
		// code for IE6, IE5
	  	xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
	    {
	    	//alert(xmlhttp.responseText);
	    	//document.getElementById("paradebug").innerHTML=xmlhttp.responseText;
	    	var responseString = xmlhttp.responseText;
	    	var responseStringArray = responseString.split(":");
	    	$.notify.alert(responseStringArray[1],{ autoClose : 3000 });
	    	document.getElementById("workhrs").innerHTML = responseStringArray[3];	
	    	document.getElementById("breakhrs").innerHTML = responseStringArray[5];	
	    }
	    
	}
	
	var timeSplits = time.split(":");

	xmlhttp.open("GET","/portfolio/projects/coffee-break/app/includes/recordData.php?startTime="+timeSplits[0]+timeSplits[1]+timeSplits[2],true);
	xmlhttp.send();
}

function recordDataAjax(method, value)
{
	var xmlhttp;
	if (value.length==0)
  	{
  		//document.getElementById("paradebug").innerHTML="Invalid Params";
	  	return;
	}
	
	if (window.XMLHttpRequest)
	{
		// code for IE7+, Firefox, Chrome, Opera, Safari
	  	xmlhttp=new XMLHttpRequest();
	}
	else
	{
		// code for IE6, IE5
	  	xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
	    {
	    	//alert(xmlhttp.responseText);
	    	//document.getElementById("paradebug").innerHTML=xmlhttp.responseText;
	    	var responseString = xmlhttp.responseText;
	    	console.log(responseString)
	    	var responseStringArray = responseString.split(":");
	    	$.notify.alert(responseStringArray[1],{ autoClose : 3000 });
	    	document.getElementById("workhrs").innerHTML = responseStringArray[3];	
	    	document.getElementById("breakhrs").innerHTML = responseStringArray[5];	
	    	document.getElementById("level").innerHTML = responseStringArray[7];
	  		console.log('lvl' + responseStringArray[7]);
	    }
	    
	}
	
	var timeSplits = value.split(":");

	xmlhttp.open("GET","/portfolio/projects/coffee-break/app/includes/recordData.php?callee="+method+"&time="+timeSplits[0]+"-"+timeSplits[1]+"-"+timeSplits[2],true);
	xmlhttp.send();
}

function startTimerEngine()
{
	runTimer();
	//Set Default Timed Break based on account settings
	//defaultTimedBreak();
	window.interval_DTB = setInterval(function(){defaultTimedBreak()}, window.defaultBreakInterval);

	//Update Data Hourly
	//setTimeout(function(){recordDataAjax('hourly', document.getElementById('time').innerHTML);},3600000);
	window.interval_UDH = setInterval(function(){recordDataAjax('hourly', document.getElementById('time').innerHTML)}, 3600000);

	//Smart Functions
	if(window.smartCaffeine == 1)
	{
		window.interval_SWC = setInterval(function(){smart_workChecker()},7200000);
		window.interval_SHC = setInterval(function(){smart_hydrationChecker()},5400000);
		window.interval_SNHE = setInterval(function(){smart_updateNumHrsElapsed()},3600000);
	}

	//Update Mana Bar
	//Add code to check for manabar setting
	window.interval_UMB = setInterval(function(){releaseMana(10)},3600000);
	
}

function handleIcons(first,second)
{
	if(first == 'play')
	{
		document.getElementById('play-button').innerHTML = "<span class='icon-stack'><i class='icon-play'></i><i class='icon-ban-circle text-error'></i></span>";
		document.getElementById('pause-button').innerHTML = "<i class='icon-pause'></i>";
	}
	else
	{
		document.getElementById('pause-button').innerHTML = "<span class='icon-stack'><i class='icon-pause'></i><i class='icon-ban-circle text-error'></i></span>";
		document.getElementById('play-button').innerHTML = "<i class='icon-play'></i>";
	}
}