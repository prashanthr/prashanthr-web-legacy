<?php
/* header.php - Prashanth Rajaram */
session_start();
include ('includes.php');
?>
<!DOCTYPE html>
<html>
<head>
<link href="<?php echo '$styles/menu.css' ?>" rel="stylesheet" type="text/css" />
<link href="<?php echo '$styles/tooltip.css' ?>" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo '$scripts/tooltip.js' ?>"> </script>
</head>
<?
include ('db.php');
include ('functions.php');
include ('menu.php');
include ('info.php');
?>