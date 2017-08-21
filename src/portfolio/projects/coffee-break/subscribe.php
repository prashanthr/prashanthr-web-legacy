<?php
/* COFFEE BREAK 2.0 - SUBSCRIBE */

if(isset($_POST['email']))
{
	if($_POST['email'] == 'email' || $_POST['email'] == '' )
	{
		header("Location: index.php");
	}
	else
	{
		$to      = 'admin@prashanthr.info';
		$subject = 'Coffee Break 2.0 Subscription';
		$message = 'I would like to subscribe to Coffee Break 2.0. My email is '.$_POST['email'];
		mail($to, $subject, $message);
		?>
		<script type='text/javascript'>
		alert('You have been subscribed! Thanks');
		window.location.href='index.php';
		</script>
		<?php
	}
}
else
{
	header("Location: index.php");
}
?>