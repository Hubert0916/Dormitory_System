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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
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
    <?php
    require_once dirname(__FILE__) . "/overlay_nav.php";
    ?>
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
                <h1>Dormitory System</h1>
                <p>Manage your dormitory with ease</p>
                <img src="../pic/cutehome.gif" alt="">
                <a href="#service">Learn More</a>
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
    </div>
    <!-- Container (End) -->
</main>
<footer>
    <div class="footer">
        <p class="foot">© 2024 Dormitory System</p>
    </div>
</footer>
<!-- Animations (Script) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="js/animations/css3-animate-it.js"></script>
<script src="../js/overlay.js"></script>
</body>
</html>
