<?php
/* Desk - Prashanth Rajaram */

//Include Files
include('../includes/preheader.php');
include('../includes/postheader.php');
$pageContext = "Desk";
readUserSettings();
?>
<script type="text/javascript">document.getElementById('body').setAttribute("onLoad","startTimerEngine();executeWideAreaMethods();");</script>
<script type='text/javascript' src='<?php echo "$scripts/smartcaffeine.js"?>'></script>
<?php
//IntroJs
if(isset($_SESSION['NEW_USER']))
{
	if($_SESSION['NEW_USER'] == "TRUE")
	{
		echo "<script type='text/javascript'>var pg = '$pageContext'; var n = document.getElementsByTagName('body')[0].getAttribute('onLoad');document.getElementById('body').setAttribute('onLoad', n + 'executeIntroJSMethods(pg)');</script>";
	}			
}
?>
<title>
<?php echo $titleArray["$pageContext"]; ?>
</title>
<div id='container' data-step='1' data-intro="<?php echo $introJSDeskArray['intro']; ?>" data-position='left'>
	<div id='menubox' class='circle'>
		<?php include ("$include_file_prefix/menu.php"); ?>
	</div>
	<div id='infobox-desk' class='circle' data-step='4' data-intro="<?php echo $introJSDeskArray['info']; ?>" data-position='left'>
		<?php 
			include("$include_file_prefix/info.php");
			showManaBar($pageContext);
			showOptions($pageContext);
		?>
	</div>
	<div id='contentbox' class=''>
		<div class='desktablecontainer'>
		<?php
			if($_SESSION['LOGGED_IN'] == "TRUE")
			{
				executeMethods($pageContext);
				?>
		</div>
		<script type='text/javascript'>
				//Get data for graph
				var xmlhttp;
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
            			window.responseString = xmlhttp.responseText;
            			//window.responseStringArray = new Array();
            			window.responseStringArray = window.responseString.split(",");
						
						window.workArray = new Array();
						window.breakArray = new Array();
						window.sparklineWorkArray = new Array();
						window.sparklineBreakArray = new Array();

						var j = 0;
						for (var i = 0; i < 7; i++) {
						            				window.workArray[j] = parseFloat (window.responseStringArray[i]);
						            				window.sparklineWorkArray[j] = parseFloat (window.responseStringArray[i]);
						            				j++;
						            			};

						j = 0;
						for (var i = 7; i < window.responseStringArray.length; i++) {
						            				window.breakArray[j] = parseFloat (window.responseStringArray[i]);
						            				window.sparklineBreakArray[j] = parseFloat (window.responseStringArray[i]);
						            				j++;
						            			};


                        //window.chart.series[0].setData([window.workArray[0], window.workArray[1], window.workArray[2], window.workArray[3], window.workArray[4], window.workArray[5], window.workArray[6] ]);
            			//window.chart.series[1].setData([window.breakArray[0], window.breakArray[1], window.breakArray[2], window.breakArray[3], window.breakArray[4], window.breakArray[5], window.breakArray[6] ]);
            			$('.sparkline').sparkline(window.sparklineWorkArray);
            			$('.sparkline').sparkline(window.sparklineBreakArray, {composite: true});
            		}
        
    			}
    
   				xmlhttp.open("GET","/portfolio/projects/coffee-break/app/includes/graph.php",true);
   				xmlhttp.send();

			</script>
			<?php
		}
		else
		{

		}
	?>
	</div>
</div>
</body>
<?php 
	include("$include_file_prefix/footer.php");
?>
</html>