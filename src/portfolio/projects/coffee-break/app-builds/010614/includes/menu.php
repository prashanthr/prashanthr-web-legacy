<?php
/* menu.php - Prashanth Rajaram */

	if(isset($_SESSION["LOGGED_IN"]))
	{
		if($_SESSION['USER'] == "GUEST")
		{
			//GUEST USER MENU
			$menuArray = array("Dashboard" => "$dashboard", "Desk" => "$desk", "Account" => "$account", "Help" => "$help");

		}
		else
		{
			//LOGGED IN USER MENU
			$menuArray = array("Dashboard" => "$dashboard", "Desk" => "$desk", "Account" => "$account", "Help" => "$help");
		}
	}
	else
	{
		//VISITOR MENU
		$menuArray = array("Home" => "$home", "About" => "$about", "Technology" => "$technology");

	}
		$numberOfMenuOptions = count($menuArray);
?>
   <div class='menuarea'>
      <div class="ph-line-nav navi">
      <div>
      	<?php
      		foreach ($menuArray as $i => $value)
      		{
    			echo "<a href='$value'>$i</a>";
			}
      	?>        
         <!--<div class="effect"></div>-->
      	</div>
      </div>
   </div>