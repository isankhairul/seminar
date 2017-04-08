<!DOCTYPE html>
<html>
<head>
<title>Event Organizer</title>
<!-- for-mobile-apps -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Tutelage Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
<script type="application/x-javascript"> 
addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); 
function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //for-mobile-apps -->
<link href="<?php echo base_url()?>assets/frontend/css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link href="<?php echo base_url()?>assets/frontend/css/style.css" rel="stylesheet" type="text/css" media="all" />
<link href="<?php echo base_url()?>assets/frontend/css/responsive-slider.css" rel="stylesheet" type="text/css" media="all" />
<link rel="stylesheet" href="<?php echo base_url()?>assets/frontend/css/swipebox.css">
<!-- fonts -->
<!-- <link href='//fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Alegreya:400,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'> -->
<!-- //fonts -->
</head>
<body>
<script>
/*  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
ga('create', 'UA-30027142-1', 'w3layouts.com');
  ga('send', 'pageview');*/
</script>
<script async type='text/javascript' src='//cdn.fancybar.net/ac/fancybar.js?zoneid=1502&serve=C6ADVKE&placement=w3layouts' id='_fancybar_js'></script>


<!-- header -->
<div class="header">
		<div class="container">
			<div class="header-nav">
				<nav class="navbar navbar-default">
					<!-- Brand and toggle get grouped for better mobile display -->
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
					    <h1><a class="navbar-brand" href="<?php echo base_url()?>"><i class="glyphicon glyphicon-education" aria-hidden="true"></i><span>Event</span>Organizer</a></h1>
					</div>
					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse nav-wil" id="bs-example-navbar-collapse-1">
						<ul class="nav navbar-nav">
							
							<li><a class="hvr-overline-from-center button2" href="<?php echo base_url()?>">Home</a></li>
							<li><a class="hvr-overline-from-center button2" href="<?php echo site_url('profil')?>" >Profil</a></li>

							<!-- <li><a class="hvr-overline-from-center button2" href="typography.html">Academics</a></li> -->
							<li><a class="hvr-overline-from-center button2" href="<?php echo base_url('seminar'); ?>">Seminar</a></li>
							<?php $session_mhs = $this->session->userdata('CMS_mahasiswa');	
								if(!$session_mhs){ ?>
								<!-- <li><a class="hvr-overline-from-center button2" href="contact.html">Contact</a></li> -->
						        <li><a class="hvr-overline-from-center button2" href="<?php echo site_url('login')?>">Login</a></li>
						    <?php }else{ ?>
						    	<li><a class="hvr-overline-from-center button2" href="<?php echo site_url('mahasiswa-dashboard')?>">Mahasiswa</a></li>
						    	<li><a class="hvr-overline-from-center button2" href="<?php echo site_url('logout')?>">Logout</a></li>
						    <?php } ?>
							
						</ul>
						<div class="search-box">
							<div id="sb-search" class="sb-search">
								<form action="<?php echo base_url('seminar'); ?>">
									<input class="sb-search-input" placeholder="Enter your search term..." type="search" name="search" id="search">
									<input class="sb-search-submit" type="submit" value="">
									<span class="sb-icon-search"> </span>
								</form>
							</div>
						</div>
					</div><!-- /navbar-collapse -->
				</nav>
			</div>
		</div>
</div>
<!-- header -->