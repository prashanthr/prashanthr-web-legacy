<?php
/* header.php - Contains head that all files have in common */
/* Author - Prashanth Rajaram */
include ('include.php');
?>
<!DOCTYPE html>
<html>
<!--Bootstrap and Font Awesome-->
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" />
<link rel="stylesheet" href="/font-awesome/css/font-awesome.min.css" />
<link rel='stylesheet' href="<?php echo URI::GetURI('styles')."/master.css"; ?>" type='text/css' media='screen' />
<link rel='icon' type='image/png' href="<?php echo URI::GetURI('favicon'); ?>" />
<meta charset="UTF-8">
<?php
echo "<script src='".URI::GetURI('jquery')."'></script>";
//echo "<link rel='stylesheet' href='".URI::GetURI('styles')."/master.css"."' type='text/css' media='screen' />";
//echo "<link rel='icon' type='image/png' href='".URI::GetURI('favicon')."'>";
?>