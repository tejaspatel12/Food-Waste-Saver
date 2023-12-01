<?php
	session_start();
	include 'admin/connection.php';
	$Code = "Home";
?>
<!doctype html>
<html lang="en">




	<head>

		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="author" content="Food Waste Saver">	
		<meta name="description" content="Food Waste Saver App">
		<meta name="keywords" content="Responsive, HTML5, Food Waste Saver App">	
		<meta name="viewport" content="width=device-width, initial-scale=1">
				
  		<!-- SITE TITLE -->
		<title><?php echo $webname;?></title>
							
		<!-- FAVICON AND TOUCH ICONS -->
		<link rel="shortcut icon" href="assets/images/favicon.ico" type="image/x-icon">
		<link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">
		<link rel="apple-touch-icon" sizes="152x152" href="assets/images/apple-touch-icon-152x152.png">
		<link rel="apple-touch-icon" sizes="120x120" href="assets/images/apple-touch-icon-120x120.png">
		<link rel="apple-touch-icon" sizes="76x76" href="assets/images/apple-touch-icon-76x76.png">
		<link rel="apple-touch-icon" href="assets/images/apple-touch-icon.png">
		<link rel="icon" href="assets/images/apple-touch-icon.png" type="image/x-icon">

		<!-- GOOGLE FONTS -->
		<link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500;600;700&amp;display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&amp;display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&amp;display=swap" rel="stylesheet">
		
		<!-- BOOTSTRAP CSS -->
		<link href="assets/css/bootstrap.min.css" rel="stylesheet">
				
		<!-- FONT ICONS -->
		<link href="assets/css/flaticon.css" rel="stylesheet">

		<!-- PLUGINS STYLESHEET -->
		<link href="assets/css/menu.css" rel="stylesheet">	
		<link id="effect" href="assets/css/dropdown-effects/fade-down.css" media="all" rel="stylesheet">
		<link href="assets/css/magnific-popup.css" rel="stylesheet">	
		<link href="assets/css/owl.carousel.min.css" rel="stylesheet">
		<link href="assets/css/owl.theme.default.min.css" rel="stylesheet">
		<link href="assets/css/lunar.css" rel="stylesheet">

		<!-- ON SCROLL ANIMATION -->
		<link href="assets/css/animate.css" rel="stylesheet">

		<!-- TEMPLATE CSS -->
		<!-- <link href="assets/css/blue-theme.css" rel="stylesheet"> -->
		<!-- <link href="assets/css/crocus-theme.css" rel="stylesheet"> -->
		<!-- <link href="assets/css/green-theme.css" rel="stylesheet"> -->
		<!-- <link href="assets/css/magenta-theme.css" rel="stylesheet"> -->
		<!-- <link href="assets/css/pink-theme.css" rel="stylesheet"> -->
		<link href="assets/css/purple-theme.css" rel="stylesheet">
		<!-- <link href="assets/css/skyblue-theme.css" rel="stylesheet"> -->
		<!-- <link href="assets/css/red-theme.css" rel="stylesheet"> -->
		<!-- <link href="assets/css/violet-theme.css" rel="stylesheet"> -->
		
		<!-- RESPONSIVE CSS -->
		<link href="assets/css/responsive.css" rel="stylesheet">

	</head>




	<body>

		<!-- PRELOADER SPINNER
		============================================= -->	
		<div id="loading" class="loading--theme">
			<div id="loading-center"><span class="loader"></span></div>
		</div>

		<!-- PAGE CONTENT
		============================================= -->	
		<div id="page" class="page font--jakarta">

			<!-- HEADER
			============================================= -->
			<header id="header" class="tra-menu navbar-dark white-scroll">
				<div class="header-wrapper">


					<!-- MOBILE HEADER -->
				    <div class="wsmobileheader clearfix">	  	
				    	<span class="smllogo"><img src="assets/images/logo.png" alt="mobile-logo"></span>
				    	<a id="wsnavtoggle" class="wsanimated-arrow"><span></span></a>	
				 	</div>


				 	<!-- NAVIGATION MENU -->
				  	<div class="wsmainfull menu clearfix">
	    				<div class="wsmainwp clearfix">


	    					<!-- HEADER BLACK LOGO -->
	    					<div class="desktoplogo">
	    						<a href="#hero-4" class="logo-black"><img src="assets/images/logo.png" alt="logo"></a>
	    					</div>


	    					<!-- HEADER WHITE LOGO -->
	    					<div class="desktoplogo">
	    						<a href="#hero-4" class="logo-white"><img src="assets/images/logo-main-white.png" alt="logo"></a>
	    					</div>


	    					<!-- MAIN MENU -->
	      					<nav class="wsmenu clearfix">
	        					<ul class="wsmenu-list nav-theme">


	        						<!-- DROPDOWN SUB MENU -->

							    	<li class="nl-simple" aria-haspopup="true"><a href="#about" class="h-link">About</a></li>

								    <!-- SIMPLE NAVIGATION LINK -->
							    	<li class="nl-simple" aria-haspopup="true"><a href="#features-6" class="h-link">Features</a></li>


								    <!-- SIMPLE NAVIGATION LINK -->
							    	<li class="nl-simple" aria-haspopup="true"><a href="pricing-2.html" class="h-link">Pricing</a></li>


						          	<!-- SIMPLE NAVIGATION LINK -->
							    	<li class="nl-simple" aria-haspopup="true"><a href="#faqs-3" class="h-link">FAQs</a></li>



								    <!-- SIGN UP BUTTON -->
								    <li class="nl-simple" aria-haspopup="true">
								    	<a href="signup-2.html" class="btn r-04 btn--theme hover--tra-black last-link">Get Started</a>
								    </li> 


	        					</ul>
	        				</nav>	<!-- END MAIN MENU -->


	    				</div>
	    			</div>	<!-- END NAVIGATION MENU -->


				</div>     <!-- End header-wrapper -->
			</header>	<!-- END HEADER -->




			<!-- HERO-4
			============================================= -->	
			<section id="hero-4" class="bg--scroll hero-section">
				<div class="container text-center">


					<!-- HERO TEXT -->
					<div class="row justify-content-center">
						<div class="col-md-10 col-lg-9 col-xl-10">
							<div class="hero-4-txt wow fadeInUp">
						
								<!-- Title -->
								<h2 class="s-56 w-700">Good Food, Great Future: Let's Predict, Prevent, and Prosper Together!</h2>	

								<!-- Buttons -->	
								<div class="btns-group mt-15">
									<a href="https://activeit.in/restaurant/" target="_blank" class="btn r-04 btn--theme hover--black">Resturent Panel</a>
									<a href="https://activeit.in/foodbank/" target="_blank" class="btn r-04 btn--tra-black hover--black" style="margin-right: 10px;">Food Bank Panel</a>
									<a href="https://activeit.in/app/" target="_blank" class="btn r-04 btn--theme hover--black">User App</a>
								</div>	

								<!-- Buttons Group Text -->
								

							</div>
						</div>
					</div>	<!-- END HERO TEXT -->	


					<!-- HERO IMAGE -->
					<div class="row">
						<div class="col">
							<div class="hero-4-img video-preview wow fadeInUp">

								

								<!-- Preview Image --> 
								<img class="img-fluid" src="newplot.png" alt="video-preview">	
								<img class="img-fluid" src="newplot_color.png" alt="video-preview">	

							</div>
						</div>	
					</div>	<!-- END HERO IMAGE --> 	


				</div>    <!-- End container --> 
			</section>	<!-- END HERO-4 -->
			<!-- DIVIDER LINE -->
			<hr class="divider">
		</div>	<!-- END PAGE CONTENT -->	
		<!-- EXTERNAL SCRIPTS
		============================================= -->	
		<script src="assets/js/jquery-3.7.0.min.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>	
		<script src="assets/js/modernizr.custom.js"></script>
		<script src="assets/js/jquery.easing.js"></script>
		<script src="assets/js/jquery.appear.js"></script>
		<script src="assets/js/menu.js"></script>
		<script src="assets/js/owl.carousel.min.js"></script>
		<script src="assets/js/pricing-toggle.js"></script>
		<script src="assets/js/jquery.magnific-popup.min.js"></script>
		<script src="assets/js/request-form.js"></script>	
		<script src="assets/js/jquery.validate.min.js"></script>
		<script src="assets/js/jquery.ajaxchimp.min.js"></script>	
		<script src="assets/js/popper.min.js"></script>
		<script src="assets/js/lunar.js"></script>
		<script src="assets/js/wow.js"></script>
				
		<!-- Custom Script -->		
		<script src="assets/js/custom.js"></script>
	</body>
</html>