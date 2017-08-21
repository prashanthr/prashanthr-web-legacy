<?php
	/* portfolio/index.php */	
	include ('../includes/header.php');	
?>
<title>Portfolio | Prashanth Rajaram</title>
<link rel='stylesheet' href="<?php echo URI::GetURI('packages')."/justinaguilar/css/animations.css"; ?>" type='text/css' media='screen' />
	<link rel='stylesheet' href="<?php echo URI::GetURI('styles')."/index.css"; ?>" type='text/css' media='screen' />
	<link rel='stylesheet' href="<?php echo URI::GetURI('styles')."/portfolio.css"; ?>" type='text/css' media='screen' />
	<link rel='stylesheet' href="<?php echo URI::GetURI('slidesjs')."/slidesjs.css"; ?>" type='text/css' media='screen' />	
	<div class="headshot-animation-container">
			<div id="headshot-small" class="headshot-small bounce slideUp"></div>
	</div>
	<meta name="viewport" content="width=device-width">
	<div align="center"><h3><span class="dotted-underline">Projects</span></h3></div>
<div id="content-container">
		<div id="content">
			<div class="content-text">
					<!--<div id="slides">-->
						<!--<img src="http://prashanthr.info/new/packages/slidesjs/img/example-slide-1.jpg" alt="Photo by: Missy S Link: http://www.flickr.com/photos/listenmissy/5087404401/">
				    	<img src="http://prashanthr.info/new/packages/slidesjs/img/example-slide-2.jpg" alt="Photo by: Daniel Parks Link: http://www.flickr.com/photos/parksdh/5227623068/">
      					<img src="http://prashanthr.info/new/packages/slidesjs/img/example-slide-3.jpg" alt="Photo by: Mike Ranweiler Link: http://www.flickr.com/photos/27874907@N04/4833059991/">
      					<img src="http://prashanthr.info/new/packages/slidesjs/img/example-slide-4.jpg" alt="Photo by: Stuart SeegerLink: http://www.flickr.com/photos/stuseeger/97577796/">-->
      					<!--<img src="http://prashanthr.info/new/packages/slidesjs/img/1.jpg" alt="">-->
      					<!--<img src="http://prashanthr.info/new/packages/slidesjs/img/2.jpg" alt="">-->
					<!--</div>-->
				
				<script src="<?php echo URI::GetURI('slidesjs')."/jquery.slides.min.js"; ?>"></script>
				<script src="<?php echo URI::GetURI('slidesjs')."/slidesjs.js"; ?>"></script>
				<div id="projects">
				<span class="miniheader">Current Projects</span>
				<dl>
					<dt><a href="#">Pebble Kicks</a></dt>
					<dd>- A Pebble watch app to assist soccer players in recording statistics and keeping track of goals/shots/misses etc. Tech stack: C, Pebble, Javascript</dd>										
					<dt><a href="../portfolio/projects/coffee-break/">Coffee Break</a></dt>
					<dd>- A simple browser based HTML5 application that assists a user while working by reminding them to take regular breaks which results in increased engagement and productivity. Based on the <a href="https://en.wikipedia.org/wiki/Pomodoro_Technique">Pomodoro Technique</a>. The user can set up a time for a break and Coffee Break will take care of the rest. There is also additional functionality that helps improve the users' productivity. Tech stack: HTML5, PHP, JS, Webkit.</dd>
					<dd>- <i class="fa fa-desktop"></i> <a href="../portfolio/projects/coffee-break/app">View</a> (Note: Currently, desktop notifications only work in Firefox)</dd>
					<dt><a href="#">Universal Clipboard</a></dt>
					<dd>- A cloud clipboard application that syncs your clipboard content across multiple devices. Tech stack: C#, ASP.NET Web API 2.0, Android, Angular JS, Node.js (MEAN)</dd>										
				</dl>
				<span class="miniheader">Past Projects</span>
				<dl>
					<dt><a href="https://github.com/prashanthr/RecaptchaPHP">RecaptchaPHP</a></dt>
					<dd>- A PHP wrapper for Google's Recaptcha functionality to include in pages for web projects. Tech stack: PHP, JQuery</dd>
					<dd>- <i class="fa fa-github"></i> <a href="https://github.com/prashanthr/RecaptchaPHP">GitHub</a></dd>
					<dt><a href="https://www.empathyapp.org/">Empathy App</a></dt>
					<dd>- Empathy App connects trained empathizers via a webpage and/or smartphone to people in need of empathy.</dd>
					<dd>- <i class="fa fa-github"></i> <a href="https://github.com/EmpathyApp">GitHub</a></dd>
					<dt><a href="http://prashanthr.github.io/Aether/">Project Aether: Autonomous Weather Baloon Data Collector</a></dt>
					<dd>- An autonomous weather balloon module that can collect atmospheric data such as temperature, pressure etc for the purpose of scientific study. Tech stack: Embedded C, Luminary Micro Arm Cortex M3 Microcontroller by Texas Instruments, PIC18 by Microchip Technologies,Telit Wireless GM862 Module.</dd>
					<dd>- <i class="fa fa-github"></i> <a href="https://github.com/prashanthr/Aether/">GitHub</a> / <i class="fa fa-video-camera"></i> <a href="https://www.youtube.com/watch?v=o2UGFA5-HPI">Video</a> </dd>
					<dt><a href="../portfolio/projects/sinkorswim/">SinkOrSwim - E-commerce Website/Online Swim wear Merchandizing System</a></dt>
					<dd>- E-commerce online website for selling swimwear products (Similar to eBay.com/Amazon.com). Note: Website was created for Project purposes (Design prototype) only and no actual items can be purchased or sold. Tech stack: PHP, XHTML, CSS, JavaScript, JQuery, Photoshop, MySQL.</dd>
					<dd>- <i class="fa fa-desktop"></i> <a href="../portfolio/projects/sinkorswim/">View</a></dd>
					<dt><a href="#">Recycle Mania</a></dt>
					<dd>- An educational fun interactive (touch) game about recycling written in Java for the Google Android OS v2.1/2.2 that runs on the Android Phone or Tablet. Tech stack: Android Java.</dd>
					<dd>- <i class="fa fa-github"></i> <a href="https://github.com/prashanthr/RecycleMania/">GitHub</a> / <i class="fa fa-video-camera"></i> <a href="https://www.youtube.com/watch?v=4LokNHs8fHQ">Video</a> </dd>
					<dt><a href="../portfolio/projects/mediasnap/">MediaSnap - Instant Media At Your Fingertips</a></dt>
					<dd>- An online media website that gives users unrestricted access to media in the form of music, movies and e-books for a small annual fee. (Prototype Only - Displays best on Google Chrome Web Browser). Tech stack: PHP, Oracle SQL, XHTML, CSS, Photoshop.</dd>
					<dd>- <i class="fa fa-desktop"></i> <a href="../portfolio/projects/mediasnap/">View</a></dd>
					<dt><a href="">Library Database Management System</a></dt>
					<dd>- Extensive library database management and sale system to add/remove books, search for books/authors, buy books etc. Tech stack: Oracle Java.</dd>
					<dd>- <i class="fa fa-github"></i> <a href="https://github.com/prashanthr/LibraryManagementSystemJDBC">GitHub</a> </dd>
					<dt><a href="https://www.youtube.com/watch?v=2y00YUAzie8">Word Fun</a></dt>
					<dd>- Simple console game that selects a word from a list of words (file) and asks the user to guess the word within a certain number of tries. Tech stack: Oracle Java.</dd>
					<dd>- <i class="fa fa-github"></i> <a href="https://github.com/prashanthr/WordFun">GitHub</a> / <i class="fa fa-video-camera"></i> <a href="https://www.youtube.com/watch?v=2y00YUAzie8">Video</a> </dd>
				</dl>
				</div>
			</div>
			<?php 
				include('../includes/navmenu.php');
			?>				
		</div>
	</div>
<?php
	include('../includes/footer.php');
?>