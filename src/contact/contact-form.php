<?php 
/*contact/contact-form.php*/
	$secretkey = "6LdgqwcTAAAAAGWEipHQIDn1UXYnzj5gQKbnBTJY";
	if(isset($_POST['g-recaptcha-response'])){
          $captcha=$_POST['g-recaptcha-response'];
        
        if(!$captcha){
          echo '<h2>Recaptcha was incorrectly entered.</h2>';
          exit;
        }
        $response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretkey&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']);
        if($response.success==false)
        {
          echo '<h2>Nice try, spammer! Spam along...</h2>';
        }else
        {
          echo '<h2>You can e-mail me at abc@abc.com </h2>';
        }
    }
    else
    {


?>
<html>
  <head>
    <title>Bot Check</title>
     <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  </head>
  <body>
  	<div>
  		Just checking if you're human...<br />
    	<form action="?" method="POST">
      		<div class="g-recaptcha" data-sitekey="6LdgqwcTAAAAAFU_mQFBp75kEYM1g_mXurJuRpmm"></div>
      		<br/>
      		<input type="submit" value="Submit">
    	</form>
	</div>
  </body>
</html>
<?php 
	}
?>