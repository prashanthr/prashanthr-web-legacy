			
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
						window.sparklineArray = new Array();

						var j = 0;
						for (var i = 0; i < 7; i++) {
						            				window.workArray[j] = parseFloat (window.responseStringArray[i]);
						            				j++;
						            			};

						j = 0;
						for (var i = 7; i < window.responseStringArray.length; i++) {
						            				window.breakArray[j] = parseFloat (window.responseStringArray[i]);
						            				window.sparklineArray[j] = parseFloat (window.responseStringArray[i]);
						            				j++;
						            			};


                       //window.chart.series[0].setData([test,test,test,test,test,test,test]);
                        window.chart.series[0].setData([window.workArray[0], window.workArray[1], window.workArray[2], window.workArray[3], window.workArray[4], window.workArray[5], window.workArray[6] ]);
            			window.chart.series[1].setData([window.breakArray[0], window.breakArray[1], window.breakArray[2], window.breakArray[3], window.breakArray[4], window.breakArray[5], window.breakArray[6] ]);
            			$('.sparkline').sparkline(window.sparklineArray);
            		}
        
    			}
    
   				xmlhttp.open("GET","/portfolio/projects/coffee-break/app/includes/graph.php",true);
   				xmlhttp.send();
   				document.write("<script src='graph.js'></script>");
   				document.write("<script src='../includes/highcharts-graphs/js/highcharts.js'></script>");
				document.write("<script src='../includes/highcharts-graphs/js/modules/exporting.js'></script>");	
			
			
			