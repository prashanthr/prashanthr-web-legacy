<?php
	/* error/index.php */	
	include ('../includes/header.php');	
	if(isset($_GET['error']))
	{
		$error = $_GET['error'];
	}
?>
<title>Error | Prashanth Rajaram</title>
<link rel='stylesheet' href="<?php echo URI::GetURI('packages')."/justinaguilar/css/animations.css"; ?>" type='text/css' media='screen' />
	<link rel='stylesheet' href="<?php echo URI::GetURI('styles')."/index.css"; ?>" type='text/css' media='screen' />
	<div class="headshot-animation-container">
			<div id="headshot" class="headshot bounce slideUp"></div>
	</div>
<div style="text-align:center">
<h3><span class="dotted-underline"> <i class="fa fa-exclamation-circle"></i> ERROR <?php echo $error;?></span></h3>
</div>
<div id="content-container">
		<div id="content">
			<div class="content-text">
				<?php
					if(!isset($error))
					{

					}
					else if($error = "404")
					{
				?>
					Oops! I can't find the page you are looking for. <br />
					Need some help? Use the navigation links at the bottom of the page to get where you need to be.<br />
				<?php
					}
					else if($error = "403")
					{
				?>
					Whoa! Sorry, you don't have permission to access that content.<br />
				<?php
					}
					else if($error = "505")
					{
				?>
					Oops! Something doesn't seem right. Please try your request again at a later time.<br />
				<?php
					}
				?>				
					If you need to report a bug or a problem, please send me a message from the contact page.
			</div>
			<?php 
				include('../includes/navmenu.php');
			?>				
		</div>
	</div>
<?php
	include('../includes/footer.php');
?>