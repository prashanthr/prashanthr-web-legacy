<?php 
	//introJs
	if(isset($_SESSION['NEW_USER']))
	{
		if($_SESSION['NEW_USER'] == "TRUE")
		{
			$introjsdeskclockattributes = "data-step='2' data-intro='This is your desk clock. It keeps ticking while you work. Yes thats right, you can throw away that ancient clock on the wall.' data-position='top'";
			$introjsplaypauseattributes = "data-step='3' data-intro='I am actually giving you the power to stop and resume time whenever you please. It is a great power and with great power comes great responsibility. Use it wisely!' data-position='bottom'";
		}			
		else
		{
			$introjsdeskclockattributes = "";
			$introjsplaypauseattributes = "";
		}
	}

	//timer.php
	$currentDate = date("F j, Y");
	
	//Logic to keep track of page refreshes and for use to track time properly in recordData.php
	if(isset($_SESSION['PG_REQ']))
	{
		$_SESSION['PG_REQ'] = $_SESSION['PG_REQ'] + 1;
	}
	else
	{
		$_SESSION['PG_REQ'] = 1;
	}
	$_SESSION['event_happen'] = 0;
?>

<script type='text/javascript'>
function testAjaxFn(str)
{
	//alert('hi');
	//$.post("http://prashanthr.info/portfolio/projects/coffee-break/app/handlers/recordTime.php", { name: "John", time: "2pm" } );
	//document.getElementById('paradebug').innerHTML = 'hello' + <?php echo $_SESSION['record']; ?>;
	var xmlhttp;
	if (str.length==0)
	  { 
	  document.getElementById("paradebug").innerHTML="";
	  return;
	  }
	if (window.XMLHttpRequest)
	  {// code for IE7+, Firefox, Chrome, Opera, Safari
	  xmlhttp=new XMLHttpRequest();
	  }
	else
	  {// code for IE6, IE5
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	xmlhttp.onreadystatechange=function()
	  {
	  if (xmlhttp.readyState==4 && xmlhttp.status==200)
	    {
	    //alert(xmlhttp.responseText);
	    document.getElementById("paradebug").innerHTML=xmlhttp.responseText;
	    //console.log('testing')
	    }
	  }
	xmlhttp.open("GET","/portfolio/projects/coffee-break/app/includes/gethint.php?q="+str,true);
	xmlhttp.send();

}
	
</script>

<div id='sleektable' class='' align='center'>
	<table cellspacing='0' class='circle' <?php echo $introjsdeskclockattributes; ?> >
		<tr><th colspan="3"><div align='center'>Desk Clock</th></div></tr>
		<tr>
			<td colspan="2"><div class='timer-class circle'><span id='time' name='time' class='timer'></span></div></td>
			<td>
				<!-- <a id='timerAction' href='#' onClick="pauseTimer();">Pause</a> -->
				<br />
				<div class="btn-group" <?php echo $introjsplaypauseattributes ?> >
				  <a id='pause-button' class="btn" href="#" onClick='pauseTimer()' alt='Pause'><i class="icon-pause"></i></a>
				  <a id='play-button' class="btn" href="#" onClick='resumeTimer()' alt='Resume'><i class="icon-play"></i></a>
				</div>
			</td>
		</tr>
		<!-- <tr><td colspan="2"><div class='timer-class circle'><span id='timerdebug' class='timer'></span></div></td><td></td></tr> -->
	</table>
	<!-- <div>
		PARADEBUG:<br />
		<span id='paradebug'></span>
		<br />
	</div> -->
</div>