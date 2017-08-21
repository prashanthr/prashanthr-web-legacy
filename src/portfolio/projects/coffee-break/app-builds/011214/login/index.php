<?php
//Include Files
include('../includes/preheader.php');
include('../includes/postheader.php');
?>
<title>
<?php echo $titleArray['Login']; ?>
</title>
<div id='container'>
	<div id='menubox' class='circle'>
		<?php include ("$includes/menu.php"); ?>
	</div>
	<div id='contentbox' class=''>
	<?php
		if($_SESSION['LOGGED_IN'] == "TRUE")
		{
			?>
			<script type="text/javascript">
				window.location.href= window.homeuri;
			</script>
			<?php		
		}
		else
		{
			//echo "home ".$home;
			?>
				<style>
					#left {
						    width:200px;
						    /*height:200px;*/
						    float:left;
						    padding-top: 100px;
						    padding-left: 100px;
						    /*background:white;*/
						}

						#right {
						    width:200px;
						    /*height:200px;*/
						    float:right;
						    padding-top: 100px;
						    padding-right: 100px;
						    top:20%;
						    /*background:white;*/
						}

						.divider{
						    position:absolute;
						    left:50%;
						    top:35%;
						    bottom:20%;
						    border-left:1px solid #AB4800;
						}
						.coffee-button {
							background: #E0D67D;
						}
						.nodisplay {
							display:none;
						}
						.display {
							display:block;
						}
						.facebook-button {
							background: #3B5998;	
							color: white;
						}
						.google-plus-button {
							background: #D14836;
							color: white;
						}
						.guest-button {
							padding-left: 25px;
						}
						.login-footer {
							bottom:10%;
							top:50%;
						}

				</style>
				<script type="text/javascript">
					function showLoginForm()
					{
						$('#coffee-register-div').slideUp();
						$('#coffee-login-div').slideDown();
					}
					function showRegisterForm()
					{
						$('#coffee-register-div').slideDown();
						$('#coffee-login-div').slideUp();
					}
					function hideLoginAndRegisterForms()
					{
						$('#coffee-register-div').slideUp();
						$('#coffee-login-div').slideUp();
					}

					$(document).ready(hideLoginAndRegisterForms);
				</script>
				<div>
					<div id="left">
						<h3>Coffee Break</h3>
						<br />
    					<a class="btn coffee-button" href="#coffee-login-form" onClick='showLoginForm()'><i class="icon-coffee"></i>&nbsp;&nbsp;&nbsp;Login (Coffee Break)</a>
    					<div id='coffee-login-div'>
    						<br />
    						<form name='coffee-login-form' id='coffee-login-form' action="<?php echo $preCoffeeURI; ?>" method="POST">
  								<div class="input-prepend">
								    <span class="add-on"><i class="icon-envelope"></i></span>
								    <input class="span2" type="text" placeholder="Email address" name='login-email'>
								  </div>
								  <div class="input-prepend">
								    <span class="add-on"><i class="icon-key"></i></span>
								    <input class="span2" type="password" placeholder="Password" name='login-pwd'>
								  </div>
								  <input type='hidden' name='coffee-login-submit' />
								  <a class="btn btn-success" href="#" onClick="document.forms[0].submit();"><i class="icon-caret-right"></i>&nbsp;&nbsp;&nbsp;Go</a>
							</form>
    					</div>    					
    					<div id='coffee-register-div'>
    						<br />
    						<form name='coffee-register-form' id='coffee-register-form' action="<?php echo $preCoffeeURI; ?>" method='POST'>
  								<div class="input-prepend">
								    <span class="add-on"><i class="icon-user"></i></span>
								    <input class="span2" type="text" placeholder="Full Name" name='register-full-name'>
								</div>
  								<div class="input-prepend">
								    <span class="add-on"><i class="icon-envelope"></i></span>
								    <input class="span2" type="text" placeholder="Email address" name='register-email'>
								</div>
								<div class="input-prepend">
								    <span class="add-on"><i class="icon-key"></i></span>
								    <input class="span2" type="password" placeholder="Password" name='register-pwd'>
								</div>								  
								<div class="input-prepend">
								    <span class="add-on"><i class="icon-key"></i></span>
								    <input class="span2" type="password" placeholder="Re-enter Password" name='register-pwd-2'>
								</div>
								<input type='hidden' name='coffee-register-submit' />
								<a class="btn btn-success" href="#" onClick="document.forms[1].submit();"><i class="icon-caret-right"></i>&nbsp;&nbsp;&nbsp;Go</a>
							</form>
    					</div>
    					<br /><br />
    					<a class="btn coffee-button" href="#coffee-register-form" onClick='showRegisterForm()'><i class="icon-coffee"></i>&nbsp;&nbsp;&nbsp;Register</a>    					
    				</div>
    				<div class="divider"></div>
					<div id="right">
						<h3>Other Platforms</h3>
						<br />
						<a class="btn facebook-button" href="<?php echo $preFacebookUri; ?>"><i class="icon-facebook"></i>&nbsp;&nbsp;&nbsp;Log In with Facebook</a>
						<br /><br />
						<a class="btn google-plus-button" href="#"><i class="icon-google-plus"></i>&nbsp;&nbsp;&nbsp; Log In with Google</a>						
						<br /><br /><i class="icon-lock"></i> Your information is secured by respective platforms
					</div>
					<h3>Try Coffee Break first?</h3>
					<div class='guest-button'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a class="btn" href="<?php echo $GuestLoginUrl; ?>"><i class="icon-user"></i>&nbsp;&nbsp;&nbsp;Guest</a></div>
					</div>					
			<?php

		}
	?>
	</div>
</div>
</body>
<?php 
	include("$includes/footer.php");
?>
</html>