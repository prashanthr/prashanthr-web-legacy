function recordNotesAjax(value)
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
	    	document.getElementById('save-status-para').innerHTML = responseString;
	    	//var responseStringArray = responseString.split(":");
	    	//$.notify.alert(responseStringArray[1],{ autoClose : 3000 });
	    	//document.getElementById("workhrs").innerHTML = responseStringArray[3];	
	    	//document.getElementById("breakhrs").innerHTML = responseStringArray[5];	
	    	//document.getElementById("level").innerHTML = responseStringArray[7];
	  		//console.log('lvl' + responseStringArray[7]);
	    }
	    
	}
	
	var timeSplits = value.split(":");

	xmlhttp.open("POST","/portfolio/projects/coffee-break/app/includes/recordNotes.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("notes=" + document.getElementById("scratchpad").value);	
}

function SaveNotepadContent()
{
	recordNotesAjax(document.getElementById("scratchpad").value);
}