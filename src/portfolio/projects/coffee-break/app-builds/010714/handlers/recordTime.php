<?php

$bar = $_POST['name'].$_POST['time'];
$_SESSION['record'] = $bar;
?>
<script type="text/javascript">alert('I\'m here man!')</script>
<?php
?>