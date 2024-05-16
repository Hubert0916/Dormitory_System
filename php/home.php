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
        <!-- Home -->
        <div class="home animated fadeInUpShort" id="home">
            <div class="home-content">
                <h1>Welcome to Dormitory System</h1>
                <p>Manage your dormitory with ease</p>
            </div>
        </div>
        <!-- Home (End) -->
        <!-- Services -->
        <div class="services animated fadeInUpShort" id="service">
            <h2>Services</h2>
            <div class="services-content">
                <div class="services-box">
                    <img src="../pic/bed.png" alt="">
                    <h3>Room Management</h3>
                    <p>Manage your room with ease</p>
                </div>
                <div class="services-box">
                    <img src="../pic/tenant.png" alt="">
                    <h3>Tenant Management</h3>
                    <p>Manage your tenant with ease</p>
                </div>
                <div class="services-box">
                    <img src="../pic/payment.png" alt="">
                    <h3>Payment Management</h3>
                    <p>Manage your payment with ease</p>
                </div>
            </div>
        </div>
        <!-- Services (End) -->
        <!-- Profile -->
        <div class="profile animated fadeInUpShort" id="profile">
            <h2>Profile</h2>
            <div class="profile-content">
                <div class="profile-box">
                    <img src="../pic/room.png" alt="">
                    <h3>Room</h3>
                    <p>Manage your room with ease</p>
                </div>
                <div class="profile-box">
                    <img src="../pic/tenant.png" alt="">
                    <h3>Tenant</h3>
                    <p>Manage your tenant with ease</p>
                </div>
                <div class="profile-box">
                    <img src="../pic/payment.png" alt="">
                    <h3>Payment</h3>
                    <p>Manage your payment with ease</p>
                </div>
            </div>
        </div>
        <!-- Profile (End) -->
    </div>
    <!-- Container (End) -->
</main>
<!-- Animations (Script) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="js/animations/css3-animate-it.js"></script>
<script src="../js/overlay.js"></script>
</body>
<footer>
    <div class="footer">
        <p class="foot">© 2024 Dormitory System</p>
    </div>
</footer>
</html>
