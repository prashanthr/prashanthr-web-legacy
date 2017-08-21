<?php
/* header.php - Prashanth Rajaram */
?>
<!DOCTYPE html>
<html>
<meta charset="UTF-8">
<head>
	<link href='<?php echo "$styles/style.css" ?>' type='text/css' rel='stylesheet' />
	<link href='<?php echo "$styles/notify.css" ?>'type='text/css' rel='stylesheet' />
	<link href='<?php echo "$styles/tooltip.css" ?>' rel='stylesheet' type='text/css' />
	<link href='<?php echo "$styles/login.css" ?>' rel='stylesheet' type='text/css' />
	<link href='<?php echo "$styles/menu.css" ?>' rel='stylesheet' type='text/css' />
	<link href='<?php echo "$styles/timer.css" ?>' rel='stylesheet' media='screen'></link>
	<link href='<?php echo "$styles/button.css" ?>' rel='stylesheet' media='screen'></link>
	<link href='<?php echo "$styles/table.css" ?>' rel='stylesheet' media='screen'></link>
	<link href='<?php echo "$styles/switch.css" ?>' rel='stylesheet' media='screen'></link>
	<link href='<?php echo "$styles/toggle-switch.css" ?>' rel='stylesheet' media='screen'></link>
	<link href='<?php echo "$styles/widearea/widearea.css" ?>' rel='stylesheet' media='screen'></link>
	<link href='<?php echo "$styles/flex-slider/flexslider.css" ?>' rel='stylesheet' media='screen'></link>
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
	<link rel="stylesheet" href='<?php echo "$bootstrappath" ?>'></link>
	<link rel="stylesheet" href='<?php echo "$fontawesomepath" ?>'></link>
	<!-- <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.no-icons.min.css" rel="stylesheet">
	<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet"> -->

	<link href='http://fonts.googleapis.com/css?family=Unica+One' rel='stylesheet' type='text/css'>
	<script type='text/javascript' src='<?php echo "$scripts/tooltip.js" ?>'></script>	
	<script type='text/javascript' src='<?php echo "$scripts/jquery-1.10.2.min.js" ?>'></script>	
	<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
	<script type='text/javascript' src='<?php echo "$scripts/notify.js" ?>'></script>
	<script type='text/javascript' src='<?php echo "$scripts/timer/time.js"?>'></script>
	<script type='text/javascript' src='<?php echo "$scripts/timer/timerfns.js"?>'></script>
	<script type='text/javascript' src='<?php echo "$scripts/actions.js"?>'></script>
	<script type='text/javascript' src='<?php echo "$scripts/notes.js"?>'></script>
	<script type='text/javascript' src='<?php echo "$scripts/dialog.js"?>'></script>
	<script type='text/javascript' src='<?php echo "$scripts/desktopNotify.js"?>'></script>
	<script type='text/javascript' src='<?php echo "$scripts/music.js"?>'></script>
	<script type='text/javascript' src='<?php echo "$scripts/ajax.js"?>'></script>
	<script type='text/javascript' src='<?php echo "$scripts/sparkline/jquery.sparkline.js"?>'></script>
	<script type='text/javascript' src='<?php echo "$scripts/widearea/widearea.js"?>'></script>
	<script type='text/javascript' src='<?php echo "$scripts/main.js"?>'></script>
	<script type='text/javascript' src='<?php echo "$scripts/userAgent.js"?>'></script>
	<script type='text/javascript' src='<?php echo "$scripts/flex-slider/jquery.flexslider.js"?>'></script>
	<script type='text/javascript' src='<?php echo "$scripts/knob/jquery.knob.js"?>'></script>
	<?php
		/*<script type='text/javascript' src='<?php echo "$scripts/uservoice.js"?>'></script>*/
		if(isset($_SESSION['NEW_USER']))
		{
			if($_SESSION['NEW_USER'] == "TRUE")
			{
				echo "<script type='text/javascript' src='$scripts/intro.js/intro.js'></script>";
				echo "<link rel='stylesheet' href='$styles/intro.js/introjs.css' media='screen'></link>";
				include ('introjs.php');	
			}			
		}
	?>
	<link rel="icon" type="image/png" href='<?php echo "$images/favicon.ico" ?>'></link>
</head>
<body id="body">

<?php
//toast(); //Display Alerts if Any
//include ('menu.php');
//include ('info.php');
?>
<div class='logo'>
	<a href='<?php echo "$home" ?>'><img src='<?php echo "$images/logo_beta.png" ?>' /></a>
</div>