<?php
/* Flex Slider */
?>
<div class="flexslider">
  <ul class="slides">
    <li>
      <img src="http://www.prashanthr.info/portfolio/projects/coffee-break/app/images/site/slider/productivity.jpg" />
    </li>
    <li>
      <img src="http://www.prashanthr.info/portfolio/projects/coffee-break/app/images/site/slider/thechart.jpg" />
    </li>
    <li>
      <img src="http://www.prashanthr.info/portfolio/projects/coffee-break/app/images/site/slider/alerts.jpg" />
    </li>
    <li>
      <img src="http://www.prashanthr.info/portfolio/projects/coffee-break/app/images/site/slider/joe.jpg" />
    </li>
  </ul>
</div>
<script type='text/javascript'>
// Can also be used with $(document).ready()
$(window).load(function() {
  $('.flexslider').flexslider({
    animation: "slide",    
  });
});
</script>