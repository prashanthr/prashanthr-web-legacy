<?php
/* include.php - Contains all information required by all pages - Global includes */
/* Author - Prashanth Rajaram */
	class URI
	{
		const home = "http://prashanthr.me";
		const about = "/about";
		const resume = "/resume";
		const portfolio = "/portfolio";
		const contact = "/contact";
		const photos = "/photos";
		const guestbook = "/guestbook";
		const help = "/help";
		const sitemap = "/sitemap";
		const error = "/error";
		const images = "/images";
		const includes = "/includes";
		const styles = "/styles";
		const scripts = "/scripts";
		const packages = "/packages";
		const lightbox = "/lightbox/lightbox2.7.1/lightbox";
		const lightboxjs = "/js/lightbox.js";
		const lightboxcss = "/css/lightbox.css";
		const fontawesome = "/font-awesome-4.3.0/font-awesome-4.3.0";
		const fontawesomecss = "/css";
		const jquery = "/js/jquery-2.1.3.min.js";
		const favicon = "/favicon/faviconpr3.ico";
		const linkedinpr = "https://linkedin.com/in/prashanthrajaram";
		const githubpr = "https://github.com/prashanthr";
		const skills = "/skills";
		const slidesjs = "/slidesjs";
		const email = "prashanthrweb@gmail.com";//"prash@prashanthr.info";

		function GetURI($item)
		{
			$home = self::home;
			$images = $home.self::images;
			$packages = $home.self::packages;
			$lightbox = $packages.self::lightbox;
			$fontawesome = $packages.self::fontawesome;
			$scripts = $home.self::scripts;			
			$resumePdf = "/resume.pdf";
			$slidesjs = $packages.self::slidesjs;

			switch ($item) {
				case 'root':
				case 'home':
					return $home;
				case 'about':
					return $home.self::about;					
				case 'resume':
					return $home.self::resume;
				case 'resumePdf':
					return $home.self::resume.$resumePdf;
				case 'portfolio':
					return $home.self::portfolio;
				case 'contact':
					return $home.self::contact;
				case 'photos':
					return $home.self::photos;
				case 'guestbook':
					return $home.self::guestbook;
				case 'help':
					return $home.self::help;
				case 'sitemap':
					return $home.self::sitemap;
				case 'error':
					return $home.self::error;
				case 'images':
					return $images;
				case 'includes':
					return $home.self::includes;
				case 'styles':
					return $home.self::styles;
				case 'scripts':
					return $home.self::scripts;
				case 'packages':
					return $packages;
				case 'lightbox':
					return $lightbox;
				case 'lightboxcss':
					return $lightbox.self::lightboxcss;
				case 'lightboxjs':
					return $lightbox.self::lightboxjs;
				case 'fontawesome':
					return $fontawesome;			
				case 'fontawesomecss':
					return $fontawesome.self::fontawesomecss;
				case 'jquery':
					return $scripts.self::jquery;
				case 'favicon':
					return $images.self::favicon;				 
				case 'github-pr':
					return self::githubpr;
				case 'linkedin-pr':
					return self::linkedinpr;
				case 'skills':
					return $home.self::skills;
				case 'slidesjs':
					return $slidesjs;
				case 'email':
					return self::email;
				default:					
					return "";
			}
		}

	}
	
?>