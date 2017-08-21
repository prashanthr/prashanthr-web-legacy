<?php
/* footer.php - Prashanth Rajaram */
session_start();
echo "<br />";
echo "<div id='footer' class='footer' align='center'>";
echo "<table id='footerTable' class='footerTable'>";
//echo "<tr>";
//echo "<td><a href='$about'>About</a> | <a href='$contact'>Contact</a> | <a href='$help'>Help</a></td>";
//echo "</tr>";
echo "<tr>";
echo "<td><i class='icon-coffee'></i> Coffee Break v$app_version<span class='hidden-phone'> . </span>$sign</td>";
echo "</tr>";
echo "<tr>";
echo "<td><a href='$terms'>Terms</a><span class='hidden-phone'> . </span><a href='$credits'>Credits</a><span class='hidden-phone'> . </span><a href='$help'>Help</a><span class='hidden-phone'> . </span><a href='$contact'>Contact</a></td>";
echo "</tr>";
echo "<tr>";
echo "<td>";
echo "<a href='$contact'><i class='icon-bug'> Report a Bug</i></a><span class='hidden-phone'> . </span><a href='$contact'><i class='icon-lightbulb'></i> Got an idea?</a>";
echo "</td>";
echo "</tr>";
echo "</table>";
echo "</div>";

?>