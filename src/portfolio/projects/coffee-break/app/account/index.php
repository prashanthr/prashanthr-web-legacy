<?php
/* Account - Prashanth Rajaram */

//Include Files
include('../includes/preheader.php');
include('../includes/postheader.php');
$pageContext = "Account";

//IntroJs
if(isset($_SESSION['NEW_USER']))
{
	if($_SESSION['NEW_USER'] == "TRUE")
	{
		echo "<script type='text/javascript'>var pg = '$pageContext'; document.getElementById('body').setAttribute('onLoad', 'executeIntroJSMethods(pg)');</script>";
	}			
}

if(isset($_GET['tab']))
{
	$tab = $_GET['tab'];
	$_SESSION['SETTINGS_MENU_ACTIVE'] = $tab;	
}
else
{
	$tab = 'general';
	$_SESSION['SETTINGS_MENU_ACTIVE'] = $tab;
}

if(isset($_GET['update']))
{
	$updateFlag = $_GET['update'];
	if($updateFlag == "true")
	{
		$updateFlag = $updateFlag;
	}
	else
	{
		$updateFlag = "false";
	}	
}
else
{
	$updateFlag = "false";
}

if($updateFlag == "true")
{
	if($tab == "general")
	{
		$fullname = $_POST['fullname'];
	}
	else if($tab == "settings")
	{
		if(isset($_POST['desktop_notifications']))
		{
			$desktop_notification_setting = 1;
		}
		else
		{
			$desktop_notification_setting = 0;
		}

		if(isset($_POST['smart_caffeine']))
		{
			$smart_caffeine_setting = 1;
		}
		else
		{
			$smart_caffeine_setting = 0;
		}

		if(isset($_POST['default_timed_break']))
		{
			$default_break_notification_setting = 1;
		}
		else
		{
			$default_break_notification_setting = 0;
		}


		if(isset($_POST['music']))
		{
			$music_setting = 1;
			if(isset($_POST['music_source']) && $_POST['music_source'] != "")
			{
				$music_source_setting = $_POST['music_source'];
				if(isset($_POST['music_embed_code']) && $_POST['music_embed_code'] != "")
				{
					//$music_embed_code = htmlspecialchars($_POST['music_embed_code']);
					//$music_embed_code = strip_tags($_POST['music_embed_code']);
					$music_embed_code = $_POST['music_embed_code'];
					//echo "MUSIC EMBED CODE IS $music_embed_code";
				}
				else
				{
					$inPageMessage = "musicEmbedCodeError";
					$music_source_setting = null;
					$music_embed_code = null;		
				}
			}
			else
			{
					$inPageMessage = "musicSourceError";
					$music_source_setting = null;
					$music_embed_code = null;		
			}
		}
		else
		{
			$music_setting = 0;
			$music_source_setting = null;
			$music_embed_code = null;
		}

	
		$default_break_interval_setting = $_POST['default_timed_break_value'];
		$pieces = explode(" ", $default_break_interval_setting);
		$int_value =  $pieces[0]; // number
		$unit_value = $pieces[1]; // unit i.e hrs mins secs	
		
		if($unit_value == "hr" || $unit_value == "hrs" || $unit_value == "h" || $unit_value == "hour" || $unit_value == "hours" )
		{
			$millitimer = $int_value*3600000;
		}
		else if($unit_value == "min" || $unit_value == "mins" || $unit_value == "m" || $unit_value == "minute" || $unit_value == "minutes")
		{
			$millitimer = $int_value*60000;
		}
		else if($unit_value == "sec" || $unit_value == "secs" || $unit_value == "s" || $unit_value == "second" || $unit_value == "seconds")
		{
			$millitimer = $int_value*1000;
		}
		else
		{
			$millitimer = 3600000;
		}

		$default_break_interval_setting = $millitimer;
		
	}
	else
	{

	}
}

if(isset($_GET['message']) || isset($inPageMessage))
{
	if(isset($_GET['message']))
	{
		$message = $_GET['message'];	
	}
	else
	{
		$message = $inPageMessage;
	}
	

	switch($message)
	{
		case "lastfm_auth_error":
			$message = "Sorry! An error occured on Last.fm. Please try again later. Do submit a bug if the error is persistent";
			break;
		case "lastfm_auth_success":
			$message = "Last.fm authentication successful";
			break;
		case "musicSourceError":
			$message = "Please select a music source";
			break;
		case "musicEmbedCodeError":
			$message = "Please enter the exact embed code from your music source";
		default:
			break;	
	}
}



?>
<title>
<?php echo $titleArray["$pageContext"]; ?>
</title>
<script type='text/javascript'>executeWideAreaMethods();</script>
<div id='container' data-step='1' data-intro="<?php echo $introJSSettingsArray['intro']; ?>" data-position='left'>
	<div id='menubox' class='circle'>
		<?php include ("$include_file_prefix/menu.php"); ?>
	</div>
	<div id='infobox' class='circle' data-step='2' data-intro="<?php echo $introJSSettingsArray['info']; ?>" data-position='left'>
		<?php 
			//include("$include_file_prefix/info.php");
			?>
			<div id="infoDiv">
			<?php
				showBasicInfo();
				showOptions($pageContext);
			?>
			</div>
	</div>
	<div id='contentbox' class=''>
	<?php
		if($_SESSION['LOGGED_IN'] == "TRUE")
		{
			//Display Alert Messages if Any
			if(isset($_GET['message']) || isset($inPageMessage))
			{
				echo "<div class='alert-para'><p class='alert alert-info'>$message</p></div>";
			}

			$email = $_SESSION['USEREMAIL'];
			$field_info = array();
			$field_value = array();
			$field_type = array();
			if($tab == 'general')
			{
				if($updateFlag == "true")
				{
					if($_SESSION['USER'] == "GUEST")
					{
						echo "<p class='alert alert-info'>You need to log in as a regular user to save settings!</p>";
					}
					else
					{
						//Update Query in Database	
						$updateQuery = mysql_query("UPDATE users SET fullname='$fullname' WHERE email='$email'");
					}					

				}
				else
				{

				}

				$settingsQuery = mysql_query("SELECT * FROM users WHERE email='$email'");
				
				$num_fields = mysql_num_fields($settingsQuery);
				for($i = 0; $i < $num_fields ; $i++) 
				{
				    $meta = mysql_fetch_field($settingsQuery, $i);
				    array_push($field_info, $meta->name);
				    array_push($field_type, $meta->type);
				}

				while($row = mysql_fetch_row($settingsQuery))
				{
					foreach($row as $column_value) 
					{
					   array_push($field_value, $column_value);
					}
				}
				?>
				<div id="sleektable" class='account-general-table'>
					<table cellspacing="0" class='circle'>
						<form action="?tab=general&update=true" name='general-form' id='general-form' method="POST">
						<tr>
							<th colspan="2">General</th>
							
						</tr>
						<?php 
							for($i = 0;$i < count($field_info); $i++)
							{
								
								if($field_info[$i] == 'id' || $field_info[$i] == 'primary_email' || $field_info[$i] == 'cups' || $field_info[$i] == 'password' || $field_info[$i] == 'firstname' || $field_info[$i] == 'lastname')
								{
									continue;
								}

								if($field_info[$i] == 'image')
								{
									$field_value[$i] = format_field_value($field_info[$i],$field_value[$i],"image");
								}

								if($field_info[$i] == 'fullname')
								{
									$readOnlyAttribute = "";
								}
								else if($field_info[$i] == 'image')
								{
									$readOnlyAttribute = "disabled";
								}
								else
								{
									$readOnlyAttribute = "readonly";
								}

								if($i % 2 == 0)
								{
									echo "<tr class='even'>";	
								}
								else
								{
									echo "<tr>";
								}
								
								if($field_type[$i] == "datetime")
								{
									$field_value[$i] = format_field_value($field_info[$i],$field_value[$i],$field_type[$i]);
								}
								
								echo "<td>";
								echo "<div class='input-prepend'>";
								echo "<span class='add-on'><i class='icon-chevron-sign-right'></i> ".format_field_info($field_info[$i])."</span>";								
								echo "</td>";
								echo "<td>";
								if($field_info[$i] == "image")
								{
									echo $field_value[$i];
									echo "<br />";
									echo "<a class='btn btn-default btn-sm' href='#' onclick='' $readOnlyAttribute><i class='icon-edit'></i> Change</a>";									
								}
								else
								{
									echo "<input class='span2' name='$field_info[$i]' type='text' value='$field_value[$i]' $readOnlyAttribute>";								
								}
								echo "</div>";
								echo "</td>";


								echo "</tr>";
							}
						?>
					<tr><td align="center" style="text-align:center;vertical-align:middle" colspan='2'><a href="#" onClick="document.getElementById('general-form').submit();return true;" class='btn' data-step='3' data-intro="<?php echo $introJSSettingsArray['save']; ?>" data-position='top'><i class='icon-save'></i> Save</a></tr>
					</form>
					</table>
				</div>
				<?php


			}
			else if($tab == 'settings')
			{
				if($updateFlag == "true")
				{
					if($_SESSION['USER'] == "GUEST")
					{
						echo "<div class='alert-para'><p class='alert alert-info'>You need to log in as a regular user to save settings!</p></div>";
					}
					else
					{
						//Update Query in Database	
						
						$updateQuery = mysql_query("UPDATE app_settings SET desktop_notifications='$desktop_notification_setting',smart_caffeine='$smart_caffeine_setting',default_timed_break='$default_break_notification_setting',default_timed_break_value='$default_break_interval_setting', music='$music_setting', music_source='$music_source_setting', music_embed_code='$music_embed_code' WHERE email='$email'");
						
						//Update All
						//$updateQuery = mysql_query("UPDATE app_settings SET desktop_notifications='$desktop_notification_setting',smart_caffeine='$smart_caffeine_setting',default_timed_break='$default_break_notification_setting',default_timed_break_value='$default_break_interval_setting',music='$music_setting' WHERE email='$email'");
					}		
				}
				else
				{

				}

				$settingsQuery = mysql_query("SELECT * FROM app_settings WHERE email='$email'");
				$num_fields = mysql_num_fields($settingsQuery);
				for($i = 0; $i < $num_fields ; $i++) 
				{
				    $meta = mysql_fetch_field($settingsQuery, $i);
				    array_push($field_info, $meta->name);
				    array_push($field_type, $meta->type);
				}

				while($row = mysql_fetch_row($settingsQuery))
				{
					foreach($row as $column_value) 
					{
					   array_push($field_value, $column_value);
					}
				}
				?>
				<div id="sleektable" class='account-settings-table'>
					<table cellspacing="0" class='circle'>
						<form action="?tab=settings&update=true" name='settings-form' id='settings-form' method="POST">
						<tr>
							<th colspan="2">App Settings</th>
							
						</tr>
						<?php 
							for($i = 0;$i < count($field_info); $i++)
							{
								//echo $field_type[$i];
								if($field_info[$i] == 'id' || $field_info[$i] == 'email')
								{
									continue;
								}

								if($i % 2 == 0)
								{
									echo "<tr class='even'>";	
								}
								else
								{
									echo "<tr>";
								}
								
								
								echo "<td>";
								echo "<div class='input-prepend'>";
								echo "<span class='add-on'><i class='icon-chevron-sign-right'></i> ".format_field_info($field_info[$i])."</span>";
								echo "</div>";
								echo "</td>";
								echo "<td>";
								echo "<div>";								
								if($field_type[$i] == "int")
								{
									if($field_value[$i] == 1)
									{
										$checkedAttribute = "checked";
									}
									else
									{
										$checkedAttribute = "";
									}

									$onClickAttribute = "";
									$disabledAttribute = "";
									
									//Temporary Disable Logic For Music
									if(format_field_info($field_info[$i]) == "Music")
									{
										
										if($field_value[$i] == 1)
										{
											$music_flag = 1;
										}
										else
										{
											$music_flag = 0;
										}
										
									}

									/*if(format_field_info($field_info[$i]) == "Music")
									{
										$onClickAttribute = "alert('Sorry! This feature is not ready yet.')";
										$disabledAttribute = "disabled";
									}
									else
									{
										$onClickAttribute = "";
										$disabledAttribute = "";
									}*/


									?>
									<label class="checkbox toggle candy" onclick="<?php echo $onClickAttribute; ?>">
										<input id="view" type="checkbox" name="<?php echo $field_info[$i] ?>" <?php echo $checkedAttribute.' '.$disabledAttribute; ?>/>
										<p>
											<span>On</span>
											<span>Off</span>
										</p>
										<a class="slide-button"></a>
									</label>
									<?php
								}
								else
								{
									if($field_info[$i] == "default_timed_break_value")
									{
										$field_value[$i] = ((float) ($field_value[$i] / 3600000));
										if($field_value[$i] <= 1.0)
										{
											$unit_value = "hour";
										}
										else
										{
											$unit_value = "hours";	
										}
										echo "<input class='span2' name='$field_info[$i]' type='text' value='$field_value[$i] $unit_value'>";
										?>
										<a href='#' onClick="alert('Enter a meaniful interval with a interger or floating point value, followed by a space and an appropriate unit. Go ahead, I understand human language.')" ><i class='icon-question-sign'></i></a>
										<?php
									}
									else if($field_info[$i] == "music_source")
									{
										if($music_flag == 1)
										{
											echo "<select id='$field_info[$i]' name='$field_info[$i]'>";
								            echo "<option value=''>SELECT SOURCE</option>";
								            echo "<option value='lastfm' ".isMusicSourceSelected('lastfm',$field_value[$i]).">Last.FM</option>";
								            echo "<option value='grooveshark' ".isMusicSourceSelected('grooveshark',$field_value[$i]).">Grooveshark</option>";
								            echo "<option value='spotify' ".isMusicSourceSelected('spotify',$field_value[$i]).">Spotify</option>";
								            echo "</select>";								            
										}
										else
										{
											echo "Turn on the music setting above and save to configure this setting";
										}
									}
									else if($field_info[$i] == "music_embed_code")
									{
										if($music_flag == 1)
										{
											echo "<textarea name='$field_info[$i]' id='$field_info[$i]' placeholder='Paste Embed Code Here...' data-widearea='enable'>$field_value[$i]</textarea>";
											
										}
										else
										{
											echo "Turn on the music setting above and save to configure this setting";
										}

									}
									else
									{
										$unit_value = "";
										echo "<input class='span2' name='$field_info[$i]' type='text' value='$field_value[$i] $unit_value'>";
									}
								}					
								echo "</div>";
								echo "</td>";


								echo "</tr>";
							}
						?>
					<tr><td><div class='input-prepend'><span class='add-on'><i class='icon-chevron-sign-right'></i> Desktop Notifications</div></td><td><a href='<?php echo $setup; ?>'>Setup Desktop Notifications</a></td></tr>
					<tr><td align="center" style="text-align:center;vertical-align:middle" colspan='2'><a href="#" onClick="document.getElementById('settings-form').submit();return true;" class='btn'><i class='icon-save'></i> Save</a></tr>
					</form>
					</table>
				</div>
				<?php
			}
			
			else if($tab == 'events')
			{
				if($updateFlag == "true")
				{
					//Update Query in Database
				}
				else
				{

				}

				$settingsQuery = mysql_query("SELECT * FROM events WHERE email='$email'");
				
				$num_fields = mysql_num_fields($settingsQuery);
				for($i = 0; $i < $num_fields ; $i++) 
				{
				    $meta = mysql_fetch_field($settingsQuery, $i);
				    array_push($field_info, $meta->name);
				    array_push($field_type, $meta->type);
				}

				$eventNameQuery = mysql_query("SELECT event_name FROM events WHERE email='$email'");
				$eventTimeQuery = mysql_query("SELECT event_time FROM events WHERE email='$email'");

				$event_name = array();
				$event_time = array();

				while($row = mysql_fetch_row($eventNameQuery))
				{
					foreach($row as $column_value) 
					{
					   //echo $column_value;
					   array_push($event_name, $column_value);
					}
				}

				while($row = mysql_fetch_row($eventTimeQuery))
				{
					foreach($row as $column_value) 
					{
						//echo $column_value;
					   array_push($event_time, $column_value);
					}
				}

				?>
				<div id="sleektable" class='account-general-table'>
					<table cellspacing="0" class='circle'>
						<!-- <form action="" name='general-form'> -->
						<tr>
							<th colspan="2">Event Log</th>
							
						</tr>
						<?php
							$num_fields = count($event_name); //count($event_time);
							if($num_fields > 0)
							{
								for($i=0;$i<$num_fields;$i++)
								{
									echo "<tr>";
									echo "<td colspan=2>";
									echo "You ".format_field_value("event_name",$event_name[$i],"varchar")." at ".format_field_value("event_time",$event_time[$i],"datetime");
									echo "</td>";
									echo "</tr>";
		
								}	
							}
							else
							{
								echo "<tr>";
								echo "<td colspan=2>";
								echo "<p class='alert alert-info'>No events recorded</p>";
								echo "</td>";
								echo "</tr>";
							}
							
						?>
					<!-- <tr><td align="center" style="vertical-align:middle" colspan='2'><a href="?tab=general&update=true" class='btn'><i class='icon-save'></i> Save</a></tr> -->
					<!-- </form> -->
					</table>
				</div>
				<?php

			}

			else if($tab == 'notifications')
			{
				echo "<div class='alert-para'><p class='alert alert-info'><i class='icon-info-sign'></i>This feature is not ready yet!</p></div>";
			}

			else
			{

			}
			
		}
		else
		{

		}
	?>
	</div>
</div>
</body>
<?php 
	include("$include_file_prefix/footer.php");
?>
</html>