<?php
/* Dashboard - Prashanth Rajaram */

//Include Files
include('../includes/preheader.php');
include('../includes/postheader.php');
$pageContext = "Dashboard";

//IntroJs
if(isset($_SESSION['NEW_USER']))
{
	if($_SESSION['NEW_USER'] == "TRUE")
	{
		echo "<script type='text/javascript'>var pg = '$pageContext'; document.getElementById('body').setAttribute('onLoad', 'executeIntroJSMethods(pg)');</script>";
	}			
}
?>
<title>
<?php echo $titleArray["$pageContext"]; ?>
</title>
<div id='container' data-step='1' data-intro="<?php echo $introJSDashboardArray['intro']; ?>" data-position='left'>
	<div id='menubox' class='circle' data-step='2' data-intro="<?php echo $introJSDashboardArray['menu']; ?>">
		<?php 
			include ("$include_file_prefix/menu.php"); 
		?>
	</div>
	<div id='infobox' class='circle' data-step='3' data-intro="<?php echo $introJSDashboardArray['info']; ?>" data-position='left'>
		<?php 
			include("$include_file_prefix/info.php");
			showOptions($pageContext);
		?>
	</div>
	<div id='contentbox' class=''>
	<?php
		if($_SESSION['LOGGED_IN'] == "TRUE")
		{
			executeMethods($pageContext);
			?>
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
            			//console.log(xmlhttp.responseText);
            			//document.getElementById("paradebug").innerHTML=xmlhttp.responseText;
            			window.responseString = xmlhttp.responseText;
            			// if(window.responseString.length = 1)
            			// {
            			// 	window.gauge.series[0].setData([window.responseString]);
            			// 	return;
            			// }
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


                        window.chart.series[0].setData([window.workArray[0], window.workArray[1], window.workArray[2], window.workArray[3], window.workArray[4], window.workArray[5], window.workArray[6] ]);
            			window.chart.series[1].setData([window.breakArray[0], window.breakArray[1], window.breakArray[2], window.breakArray[3], window.breakArray[4], window.breakArray[5], window.breakArray[6] ]);
            			$('.sparkline').sparkline(window.sparklineWorkArray);
            			$('.sparkline').sparkline(window.sparklineBreakArray, {composite: true});
            		}
        
    			}
    
   				xmlhttp.open("GET","/portfolio/projects/coffee-break/app/includes/graph.php",true);
   				xmlhttp.send();

	 			// xmlhttp.open("GET","/portfolio/projects/coffee-break/app/includes/gauge.php",true);
   				// xmlhttp.send();

			</script>
			<script src='../scripts/graph.js'></script>
			<script src="../includes/highcharts-graphs/js/highcharts.js"></script>
			<script src="../includes/highcharts-graphs/js/modules/exporting.js"></script>

			<?php
			if($_SESSION["USER"] == "GUEST")
			{
				echo "<div class='alert-para'><p class='alert alert-info'>The following graph includes sample data for a guest user. Log in & use the application to view live stats!</p></div>";
			}
			//Graph of Work & Break Trends
			echo"<div id='graph-container' data-step='5' data-position='right' data-intro='".$introJSDashboardArray['dashgraph']."'></div>";
			//Level Progression Gauge
			//echo "<br /><br /><br /><br /><br /><br /><br /><div id='gauge-container'></div>";
			echo "<div class='dashboard-stats' data-step='6' data-position='right' data-intro='".$introJSDashboardArray['dashstats']."'>";
			include('stats.php');
			echo "</div>";
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