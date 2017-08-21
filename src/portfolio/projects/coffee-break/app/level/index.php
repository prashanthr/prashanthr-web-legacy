<?php
/* Level - Prashanth Rajaram */

//Include Files
include('../includes/preheader.php');
include('../includes/postheader.php');
$pageContext = "Level";
?>
<title>
<?php echo $titleArray["$pageContext"]; ?>
</title>
<div id='container'>
	<div id='menubox' class='circle'>
		<?php include ("$include_file_prefix/menu.php"); ?>
	</div>
	<div id='infobox' class='circle'>
		<?php 
			include("$include_file_prefix/info.php");
			showOptions($pageContext);
		?>
	</div>
	<div id='contentbox' class=''>
	<?php
		if($_SESSION['LOGGED_IN'] == "TRUE")
		{
			$email = $_SESSION['USEREMAIL'];
			$statsQuery = mysql_query("SELECT caffeine_level,caffeine_points FROM users WHERE email='$email'");
			while($row = mysql_fetch_array($statsQuery))
			{
				$levelInQuestion = $row['caffeine_level'];
				$pointsInQuestion = $row['caffeine_points'];
			}

			$nextLevel = (int) $levelInQuestion + 1;
			$levelQuery = mysql_query("SELECT min,max,perks FROM levels WHERE level='$nextLevel'");
			while($row = mysql_fetch_array($levelQuery))
			{
				$min = $row['min'];
				$max = $row['max'];
				$perks = $row['perks'];
			}

			$pointsToNextLevel = (int) $pointsInQuestion - (int) $min;

			?>
			<div class='level-div'>
				<div class='level-info'>
					<div class='level-info-block'>
						<dl>
				          <dt><?php echo $levelInQuestion;?></dt>
				          <dd>Level</dd>
				        </dl>
					</div>
					<div class='level-info-block last'>
						<dl>
		          			<dt><?php echo $pointsToNextLevel; ?></dt>
		          			<dd>Points to next level</dd>
		        		</dl>
					</div>
				</div>	
				<div class='level-perks'>
					<div id='sleektable' class='' align='center'>
						<table cellspacing='0' class='circle'>
							<tr>
								<th>Level Perks</th>
							</tr>
							<tr>
								<td><p><?php echo $perks; ?></p></td>
							</tr>						
						</table>
					</div>
				</div>
			</div>
			<?php
		}
		else
		{
			if(isset($_GET['level']))
			{
				$levelInQuestion = $_GET['level'];
				$levelQuery = mysql_query("SELECT min,max,perks FROM levels WHERE level='$levelInQuestion'");
				while($row = mysql_fetch_array($levelQuery))
				{
					$min = $row['min'];
					$max = $row['max'];
					$perks = $row['perks'];
				}
				?>
				<div class='level-div'>
					<div class='level-info'>	
						<div class='level-info-block'>
							<dl>
					          <dt><?php echo $levelInQuestion;?></dt>
					          <dd>Level</dd>
					        </dl>
						</div>
						<div class='level-info-block last'>
							<dl>
			          			<dt><?php echo $min; ?></dt>
			          			<dd>Minimum points to reach next level</dd>
			        		</dl>
						</div>
					</div>
					<div class='level-perks'>
						<div id='sleektable' class='' align='center'>
						<table cellspacing='0' class='circle'>
							<tr>
								<th>Level Perks</th>
							</tr>
							<tr>
								<td><p><?php echo $perks; ?></p></td>
							</tr>						
						</table>
					</div>
					</div>
				</div>
				<?php

			}
			?>
				<form name='level-form' id='level-form' method='GET' action=''>
					<div class='input-prepend'>		
						<span class='add-on'><i class='icon-double-angle-right'></i> Enter a Level </span>
						<input class='span2' name='level' type='text'></input>
						<a href="#" onClick="document.getElementById('level-form').submit();return true;" class='btn'><i class='icon-rocket'></i> Go</a>
					</div>
				</form>
				<?php
		}
	?>
	</div>
</div>
</body>
<?php 
	include("$include_file_prefix/footer.php");
?>
</html>