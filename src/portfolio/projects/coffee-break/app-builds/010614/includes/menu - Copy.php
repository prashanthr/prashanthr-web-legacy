<?php
/* menu.php - Prashanth Rajaram */
?>
<div id='cssmenu'>
<ul>
   <li><a href='<?php echo $home ?>'><span>Home</span></a></li>
   <li class='has-sub'><a href='#'><span>Account</span></a>
      <ul>
         <li class='has-sub'><a href='#'><span>Profile</span></a>
            <ul>
               <li><a href='<?php echo "$profile?action=view" ?>'><span>View Profile</span></a></li>
               <li class='last'><a href='$profile?action=edit'><span>Edit Profile</span></a></li>
            </ul>
         </li>
         <li class='has-sub'><a href='#'><span>Schedules</span></a>
            <ul>
               <li><a href='#'><span>View Schedules</span></a></li>
               <li class='last'><a href='#'><span>Manage Schedules</span></a></li>
            </ul>
         </li>
      </ul>
   </li>
   <li class='has-sub'><a href='#'><span>Actions</span></a>
      <ul>
         <li class='has-sub'><a href='#'><span>Take a Break</span></a>
            <ul>
               <li><a href='<?php echo "$home?action=qbreak" ?>' id='311' class='tooltip' onMouseOver='setInterval(function(){showToolTip(311)},1000);'>Quick Break</a></li>
               <li class='last'><a href='<?php echo "$home?action=tbreak" ?>' id='312' class='tooltip' onMouseOver='setInterval(function(){showToolTip(312)},1000);'>Timed Break</a></li>
            </ul>
         </li>
         <li class='has-sub'><a href='#'><span>Work</span></a>
            <ul>
               <li><a href='<?php echo "$home?action=normal" ?>' id='321' class='tooltip' onMouseOver='setInterval(function(){showToolTip(321)},1000);'>Normal Mode</a></li>
               <li class='last'><a href='<?php echo "$home?action=rapid" ?>' id='322' class='tooltip' onMouseOver='setInterval(function(){showToolTip(322)},1000);'>Rapid Mode</a></li>
            </ul>
         </li>
      </ul>
   </li>
   <li class='active last'><a href='#'><span>Info</span></a></li>
</ul>
</div>