<!DOCTYPE html>
<html lang="en">
<head id="top">
	<title>Dormitory System</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta charset="UTF-8">
	<!-- Favicon -->
	<link href="images/favicon.ico" rel="icon" type="image/x-icon">
	<link href="images/favicon-32x32.png" rel="icon" type="image/png" sizes="32x32">
	<link href="images/favicon-96x96.png" rel="icon" type="image/png" sizes="96x96">
	<link href="images/favicon-16x16.png" rel="icon" type="image/png" sizes="16x16">
	<link href="../css/home.css" rel="stylesheet" type="text/css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<!-- Smooth Scrolling (Script) -->
	<script>
	$(document).ready(function(){
	  $("a").on('click', function(event) {
		if (this.hash !== "") {
		  event.preventDefault();
		  var hash = this.hash;
		  $('html, body').animate({
			scrollTop: $(hash).offset().top
		  }, 800, function(){
			window.location.hash = hash;
		  });
		}
	  });
	});
	</script>

</head>

<body>
<main>
	<!-- Overlay Navigation -->
	<div class="burger-background nav-overlay"></div>
	<div class="navbar-header nav-overlay">
		<div class="toggle-button toogle-background" id="toggle">
			<span class="bar top"></span>
			<span class="bar middle"></span>
			<span class="bar bottom"></span>
		</div>
	</div>
	<!-- PHP-Overlay-Navigation -->
		<div class="overlay" id="overlay">
		<ul>
			<li><a href="#home">Home</a></li>
			<li><a href="#service">Services</a></li>
			<li><a href="#profile">Profile</a></li>
			<li><a href="#">Sign Up</a></li>
            <li><a href="#">Login</a></li>
            <li><a href="#">HI</a></li>
		</ul>
	</div>
    <!-- Function Bar -->
	<div class="function-bar">
		Dormitory System
	</div>	
	<div class="function-bar-arrow">
		<a href="#top"><img src="../pic/arrow.png" alt=""></a>
	</div>
	<!-- Function Bar (End) -->
    <!-- Container -->
	<div class="container animatedParent animateOnce clearfix">
		<!-- PHP-Navigation -->
		<!-- Navigation -->
		<nav class="navigation animated fadeInDownShort clearfix">
			<ul>
                <li><a href="#home">Home</a></li>
                <li><a href="#service">Services</a></li>
                <li><a href="#profile">Profile</a></li>
                <li><a href="#">Sign Up</a></li>
                <li><a href="#">Login</a></li>
                <li><a href="#">HI</a></li>
            </ul>
		</nav>
		<!-- Navigation (End) -->

    <div class="content">
        <div class="tab-content">
            <div id="home" class="tab-pane fade in active">
                <h1>Welcome to Dormitory System</h1>
            </div>
            <div id="service" class="tab-pane fade">
                <h1>Our Services</h1>
                <p>Our services include:</p>
                <ul>
                    <li>Find the best dormitory for you</li>
                    <li>Provide you with the most comfortable living environment</li>
                    <li>Help you with any problems you may have</li>
                </ul>
            </div>
            <div id="profile" class="tab-pane fade">
                <h1>Your Profile</h1>
                <p>Here is your profile:</p>
                <ul>
                    <li>Name: </li>
                    <li>Age: </li>
                </ul>
            </div>
        </div>
    </div>   
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
<footer>
    <div class="footer">
        <p class="foot">© 2024 Dormitory System</p>
    </div>
</footer>
</html>
