<?php
	/* about/index.php */	
	include ('../includes/header.php');	
?>
<script src="http://code.highcharts.com/highcharts.js"></script>
<?php
	//echo "<script src="."'".URI::GetURI('scripts')."/js/soccer.js'></script>";
	//include('soccer.php');
?>

<link rel='stylesheet' href="<?php echo URI::GetURI('packages')."justinaguilar/css/animations.css"; ?>" type='text/css' media='screen' />
	<link rel='stylesheet' href="<?php echo URI::GetURI('styles')."/index.css"; ?>" type='text/css' media='screen' />
	<div class="headshot-animation-container">
			<div id="headshot-test" class="headshot-test bounce slideUp"></div>
	</div>
<div id="content-container">
		<div id="content">
			<div class="content-text">
				
			</div>
			<?php 
				include('../includes/navmenu.php');
			?>				
		</div>
	</div>
<?php
	include('../includes/footer.php');
?>