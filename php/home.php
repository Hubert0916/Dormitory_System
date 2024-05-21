<!DOCTYPE html>
<html lang="en">
<head id="top">
	<title>Dormitory System</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
	<link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Indie+Flower&family=Nanum+Pen+Script&family=Noto+Serif+TC:wght@200..900&display=swap" rel="stylesheet">
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
    <?php
    require_once dirname(__FILE__) . "/overlay_nav.php";
    ?>
    <!-- Container -->
	<div class="container animatedParent animateOnce clearfix">
		<!-- PHP-Navigation -->
		<!-- Navigation -->
		<nav class="navigation animated fadeInDownShort clearfix">
			<ul>
                <li><a href="#home">首頁</a></li>
                <li class="dropdown">
                    <a href="#service">服務</a>
                    <ul class="dropdown-menu">
                        <li><a href="move.php">協助搬遷</a></li>
                        <li><a href="#service2">配對室友</a></li>
                        <li><a href="#service3">設備報修</a></li>
                        <li><a href="report.php">一起來檢舉</a></li>
                        <li><a href="#service5">吧啦吧啦</a></li>
                    </ul>
                </li>
                <li><a href="#profile">個人資訊</a></li>
                <li><a href="#register">註冊</a></li>
                <li><a href="#login">登入</a></li>
            </ul>
		</nav>
		<!-- Navigation (End) -->
        <!-- Home -->
        <div class="home animated fadeInUpShort" id="home">
            <div class="home-content">
                <div class="title">
                    <h1>宿 舍 系 統</h1>
                    <button class="learn-more"><a href="#service">Learn More</a></button>
                </div>  
                <img src="../pic/dorm.gif" alt="">
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
<script src="../js/home.js"></script>
</body>
</html>
