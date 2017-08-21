<?php
	/* contact/index.php */	
	include ('../includes/header.php');	
?>
<title>Contact | Prashanth Rajaram</title>
<link rel='stylesheet' href="<?php echo URI::GetURI('packages')."/justinaguilar/css/animations.css"; ?>" type='text/css' media='screen' />
	<link rel='stylesheet' href="<?php echo URI::GetURI('styles')."/index.css"; ?>" type='text/css' media='screen' />
	<link rel='stylesheet' href="<?php echo URI::GetURI('styles')."/contact.css"; ?>" type='text/css' media='screen' />
	<script src='https://www.google.com/recaptcha/api.js'></script>
	<div class="headshot-animation-container">
			<div id="headshot" class="headshot bounce slideUp"></div>
	</div>
<div id="content-container">
		<div id="content">
			<div class="content-text">
				<ul style="list-style-type:none" class="content-text contact-content fireLink">
					<li>
						<?php
						$secretkey = "6Lfp3CUTAAAAAPZ0JXKFtIU6i-h1KRWP3JzCSlOL";
						if(isset($_POST['g-recaptcha-response'])){
					          $captcha=$_POST['g-recaptcha-response'];
					        
					        if(!$captcha){
					          echo '<h2>Recaptcha was incorrectly entered.</h2>';
					          exit;
					        }
					        $response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretkey&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']);
					        if($response.success==false)
					        {
					          echo "<div class='highlight'>Nice try, spammer! Spam along...</div>";
					        }else
					        {
					          echo "You can e-mail me at <span class='highlight'>".URI::GetURI('email')."</span>";
					        }
					    }
					    else
					    {
						?>
						<li>You can send me a <i class="fa fa-paper-plane-o"></i> <a href="#" onClick="document.getElementById('recaptcha-div').style.display = 'block';">Message</a>.</li>
						<div id="recaptcha-div"align="center" style="font-size:20px;display:none">
  							<div class="highlight">Just checking if you're human...</div><br />
    						<form action="?" method="POST" id="recaptcha-form">
  							<div class="g-recaptcha" data-sitekey="6Lfp3CUTAAAAAI9jtdzcuk9GUFipL_CyglQOIuMj"></div>      						
				      		<input type="submit" value="Continue" />
    						</form>
						</div>
						<?php 
							}
						?>
					</li>					
					<li>You can fork me on <i class="fa fa-github"></i> <a href="<?php echo URI::GetURI('github-pr'); ?>">GitHub</a>.</li>
					<li>You can find me on <i class="fa fa-linkedin"></i> <a href="<?php echo URI::GetURI('linkedin-pr'); ?>">LinkedIn</a>.</li>					
				</ul>
			</div>
			<?php 
				include('../includes/navmenu.php');
			?>				
		</div>
	</div>
<?php
	include('../includes/footer.php');
?>