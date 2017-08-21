<?php
/* index.php - Prashanth Rajaram */

include('includes/preheader.php');
include('includes/postheader.php');
?>
<title>
<?php echo $titleArray['Home']; ?>
</title>
<div id='container'>
	<div id='menubox' class='circle'>
		<?php include ('includes/menu.php'); ?>
	</div>
	<div id='infobox' class='circle'>
		<?php 
			include('includes/info.php');
		?>
	</div>
	<div id='contentbox' class=''>
<?php
	if($_SESSION['LOGGED_IN'] == "TRUE")
	{
		setup();
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


                        window.chart.series[0].setData([window.workArray[0], window.workArray[1], window.workArray[2], window.workArray[3], window.workArray[4], window.workArray[5], window.workArray[6] ]);
            			window.chart.series[1].setData([window.breakArray[0], window.breakArray[1], window.breakArray[2], window.breakArray[3], window.breakArray[4], window.breakArray[5], window.breakArray[6] ]);
            			$('.sparkline').sparkline(window.sparklineWorkArray);
            			$('.sparkline').sparkline(window.sparklineBreakArray, {composite: true});
            		}
        
    			}
    
   				xmlhttp.open("GET","/portfolio/projects/coffee-break/app/includes/graph.php",true);
   				xmlhttp.send();

			</script>
			<script src='scripts/graph.js'></script>
			<script src="includes/highcharts-graphs/js/highcharts.js"></script>
			<script src="includes/highcharts-graphs/js/modules/exporting.js"></script>


		<?php
	}

	if($_SESSION['USER'] == "GUEST")
	{
			if(isset($_GET['action']))
			{
				$action=$_GET['action'];
			}
			else
			{
				$action="home";	
			}

			displayContent($action);
	}
	else
	{
		if($user)
		{
			if(isset($_GET['action']))
			{
				$action=$_GET['action'];
			}
			else
			{
				$action="home";	
			}

			displayContent($action);
			//echo "RECORDED: ".$_SESSION['record'];
		}
		else
		{
			//header("Location: $about");
			?>
			<script type='text/javascript'>window.location.href = '<?php echo $about; ?>' </script>
			<?php
		}
	}
	
	if($action == "home")
	{
		echo"<div id='graph-container'></div>";
	}	

	?>

			
	</div>
</div>
</body>
<?php 
	include('includes/footer.php');
?>
</html>