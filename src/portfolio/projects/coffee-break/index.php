<?php
	/* TEMP INDEX FOR COFFEE BREAK 2.0 */
?>
<html>
<title>Coffee Break 2.0</title>
<style type='text/css'>
body
{
	margin:0;
	font-size:1em;
	line-height:1.4;
	/*background:#e2e2e2 url(Notify/bg.png);*/
	background:#D1D5D8;
	margin:0;
	padding:10px;
	font-family:sans-serif
}

body,button,input,select,textarea
{
	font-family:sans-serif;
	color:#222;
	text-align: justify;
}

.logo 
{	
	width:196px;
	height:100px;
	margin:10px auto;
	background:url(logo.png) 0 0 no-repeat;
}

#container
{
	max-width:800px;
	min-height: 400px;
	margin:0 auto;
	padding:20px;
	background:#fff;
	background:rgba(255,255,255,.8);
	border-radius:4px;
	box-shadow:0 2px 4px rgba(0,0,0,.3);
	position:relative;
}
</style>
<head>
</head>
<body>
	<div class='logo'>
		<a href='#'><img src='logo.png' /></a>
	</div>
	<div id='container'>
		<div id='contentbox' class=''>
			<div align="center"><h2>Coffee Break 2.0</h2></div>
			<h3>What is Coffee Break</h3>
			<img src="CBGraphic.jpg" width="100%" height="225"/>
			<p>Coffee Break is a simple productivity application that lets you manage your time and effort better by reminding you to take breaks at set times. You can configure break times or choose from the default configurations. Taking regular breaks helps you be more focused and alert. You can track your productivity and earn points.</p>
			<h3>Interested?</h3> 
			<!--<p>Leave your <form action="subscribe.php" method='POST'><input type='text' value='email' name='email' id='emailbox' onFocus="if(this.value = 'email') this.value=''"></input><input type='submit' value='Subscribe'></input></form> and I will let you know as soon as it's ready! <br /><br /> Thanks for checking this out. You won't be disappointed!<p>-->
			<iframe src="https://docs.google.com/forms/d/1yWGc3G3PPFyIkPIs5KdxT8UwuhK9wyqvf3tCeuK7qio/viewform?embedded=true" width="100%" height="450" frameborder="0" marginheight="0" marginwidth="0">Loading...</iframe>
		</div>
	</div>
	<div align='center'>
		<br />&copy; Prashanth Rajaram
		<br />
		<?php
			include('app/includes/paypal.php');
		?>
	</div>

</body>
</html>
