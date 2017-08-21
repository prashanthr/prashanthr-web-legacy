<?php
	require_once('../recaptcha-php-1.11/recaptchalib.php');
	$publickey = "6LfXANYSAAAAAAiOHeYWfiwOaswKrQAKIo6xBKLt"; 
	echo recaptcha_get_html($publickey);
?>