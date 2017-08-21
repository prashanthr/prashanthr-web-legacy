/* tooltip.js */

function showToolTip(option)
{
   if(option == '311')
      document.getElementById(option).innerHTML = document.getElementById(option).innerHTML + '<span class=classic> Take a quick break now <br />(Pauses Timer)</span>';
   else if(option == '312')
      document.getElementById(option).innerHTML = document.getElementById(option).innerHTML + '<span class=classic> Take a break later <br />(Set break timer for later)</span>';
   else if(option == '321')
      document.getElementById(option).innerHTML = document.getElementById(option).innerHTML + '<span class=classic> Begin working normally <br />(Sets timers according to your normal work schedule)</span>';
   else if(option == '322')
      document.getElementById(option).innerHTML = document.getElementById(option).innerHTML + '<span class=classic> Begin working rapidly <br />(Sets timers according to your rapid work schedule)</span>';

}
