<?php
	function showOptions($pageContext)
	{
		switch ($pageContext) {
			case 'Dashboard':
				?>
				<script type='text/javascript'>
					
					function handleUserMenuUI()
					{
						userMenuClassName = document.getElementById('usermenuid').className;
						if(userMenuClassName == 'btn-group')
						{
							document.getElementById('usermenuid').setAttribute('class','btn-group open');
						}
						else
						{
							document.getElementById('usermenuid').setAttribute('class','btn-group');
						}
					}
				</script>
				<div id='usermenuid' class="btn-group">
				  <a class="btn" href="#"><i class="icon-list"></i> Options</a>
				  <a class="btn dropdown-toggle" data-toggle="dropdown" href="#" onClick="handleUserMenuUI();">
				    <span class="icon-caret-down"></span></a>
				  <ul class="dropdown-menu">
				  	<?php echo "DESK URL IS $desk"; ?>
				    <li><a href="<?php echo $desk ?>"><i class="icon-fixed-width icon-laptop"></i> Begin Working</a></li>
				    <li><a href="<?php echo $account ?>"><i class="icon-fixed-width icon-user"></i> View Account</a></li>
				    <li><a href="<?php echo $account ?>"><i class="icon-fixed-width icon-gear"></i> Settings</a></li>

				    <li class="divider"></li>
				    <li><a href="<?php echo $GuestLogoutUrl ?>"><i class="icon-signout"></i> Logout</a></li>
				  </ul>
				</div>
				<br />
				<br />
				<br />

				

				<?php
				break;
			
			default:
				# code...
				break;
		}

		?>
		<br />
		<div class="actions-dropdown">
      		<select id="actionList" onChange="handleAction(document.getElementById('actionList').value);" class="actions-dropdown-select">
        		<option value="">Select An Action</option>
        		<option value="work">Begin Working</option>
        		<option value="qbreak">Take a Break Now!</option>
        		<option value="tbreak">Take a break Later</option>
      		</select>
    		<input id='breaklatertextbox' type='hidden'></input>
    	</div>
    	<div class="actions-buttons">
    		<!-- <a href="#" onClick="performAction('work');" ><img class='actions-buttons' src="http://www.prashanthr.info/portfolio/projects/coffee-break/app/images/buttons/work.png"/></a>
    		<a href="#" onClick="performAction('qbreak');" ><img class='actions-buttons' src="http://www.prashanthr.info/portfolio/projects/coffee-break/app/images/buttons/break.png"/></a>
    		<a href="#" onClick="performAction('tbreak');" ><img class='actions-buttons' src="http://www.prashanthr.info/portfolio/projects/coffee-break/app/images/buttons/break-timed.png"/></a> -->
    		<!-- <a href="#" onClick="performAction('work');" class="button white"> Work Now </a>
    		<a href="#" onClick="performAction('qbreak');" class="button white">Take a Break (Now)</a>
    		<a href="#" onClick="performAction('tbreak');" class="button white">Take a Break Later</a> -->
    		<div class="btn-group">
  				<a class="btn" href="#" onClick="performAction('work');"><i class="icon-laptop"></i></a>
  				<a class="btn" href="#" onClick="performAction('qbreak');"><i class="icon-coffee"></i></a>
  				<a class="btn" href="#" onClick="performAction('tbreak');"><i class="icon-time"></i></a>
  			</div>


    	</div>
    	<br />
    	<?php	
	}
?>