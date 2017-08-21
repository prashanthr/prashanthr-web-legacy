<?php
/* displayphotos.php - Prashanth R */
$album = "../photos/life";
?>
<div class='circle' align='center' id='aboutimgbox'>
<?php
	if ( ($filescan = scandir($album)) && (count($filescan) < 3) )
	{
		echo 'Sorry, no photos found!<br />';
	}
	else
	{
		//echo "album is $album";
		$folder = opendir($album);
		while($file = readdir($folder)) {
			if ($file[0] != "." && $file[0] != ".." ) {
					$files[$file] = $file;
			}
		}
		$i = 1;
		echo "<table>";
		echo "<tr><td>";
		foreach($files as $key => $value) {
				if($i == 5)
				{	
					echo "&nbsp;<span class='imgthumbs'><a href='$photos'>See More</a></span>";
					break;
				}
				echo "&nbsp;<a href='$album/$key' rel='lightbox[images]' onMouseOver=changeImage('$i')><img id='img$i' src='$album/$key' class='imgthumbs' /></a>";
				$i++;
		}
		echo "</td></tr>";
		echo "</table>";
	}
?>
</div>