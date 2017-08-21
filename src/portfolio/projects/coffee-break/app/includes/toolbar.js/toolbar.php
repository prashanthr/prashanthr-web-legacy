<?php

?>
<html>
<head>
<link href='<?php echo "http://www.prashanthr.info/portfolio/projects/coffee-break/app/styles/toolbar.js/bootstrap.icons.css" ?>' rel='stylesheet' media='screen'></link>
<link href='<?php echo "http://www.prashanthr.info/portfolio/projects/coffee-break/app/styles/toolbar.js/jquery.toolbars.css" ?>' rel='stylesheet' media='screen'></link>
<script type='text/javascript' src='<?php echo "http://www.prashanthr.info/portfolio/projects/coffee-break/app/scripts/jquery-1.10.2.min.js" ?>'></script>	
<script type='text/javascript' src='<?php echo "http://www.prashanthr.info/portfolio/projects/coffee-break/app/scripts/toolbar.js/jquery.toolbar.js" ?>'></script>
<script type='text/javascript'>
	$('#vertical-toolbar').toolbar({
	content: '#user-toolbar-options', 
	position: 'left'
});
</script>
</head>
</body>
<div id="user-toolbar-options">
	<a href="#"><i class="icon-user"></i></a>
	<a href="#"><i class="icon-star"></i></a>
	<a href="#"><i class="icon-edit"></i></a>
	<a href="#"><i class="icon-delete"></i></a>
	<a href="#"><i class="icon-ban"></i></a>
</div>
</body>
</html>