<?php
    require_once dirname(__FILE__) . "/session.php";
?>
<!-- Google Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Indie+Flower&family=Nanum+Pen+Script&family=Noto+Serif+TC:wght@200..900&display=swap" rel="stylesheet">
<!-- Custom CSS -->
<link href="../css/nav.css" rel="stylesheet" type="text/css">
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://kit.fontawesome.com/3a02e24f5d.js" crossorigin="anonymous"></script>
<!-- Overlay Navigation -->
<div class="nav-all">
	<div class="burger-background nav-overlay">
		<div class="navbar-header nav-overlay">
			<div class="toggle-button toogle-background" id="toggle">
				<span class="bar top"></span>
				<span class="bar middle"></span>
				<span class="bar bottom"></span>
			</div>
		</div>
		<!-- PHP-Overlay-Navigation -->
		<div class="overlay" id="overlay">
			<ul class="nav flex-column">
				<li class="nav-item">
					<a class="nav-link active" aria-current="page" href="../php/home.php">首頁</a>
				</li>
				<li class="nav-item services-dropdown">
					<a class="nav-link service-link" href="#">服務<i class="fa-solid fa-chevron-down"></i></a>
				</li>
				<div class="dropdown-container">
					<li class="nav-item">
						<a class="nav-link" href="../php/move.php">協助搬遷</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#">配對室友</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#">設備報修</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="../php/report.php">檢舉鄰居</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#">吧啦吧啦</a>
					</li>
				</div>
				<?php if ($loggedIn): ?>
					<li class="nav-item">
						<a class="nav-link" href="../php/profile.php">個人資訊</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="../php/logout.php">登出</a>
					</li>
				<?php else: ?>
					<li class="nav-item">
						<a class="nav-link" href="../php/registration.php">註冊</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="../php/login.php">登入</a>
					</li>
                <?php endif; ?>
			</ul>
		</div>
		<!-- Function Bar -->
		<div class="function-bar">
			Dormitory System
		</div>	
		<div class="function-bar-arrow" id="back-to-top">
			<img src="../pic/arrow.png" alt="top">
		</div>
		<!-- Function Bar (End) -->
	</div>
</div>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<!-- Custom JavaScript -->
<script>
	$('#toggle').click(function() {
    $(this).toggleClass('toggle-active');
    $('#overlay').toggleClass('nav-active');
    if (!$('#overlay').hasClass('nav-active')) {
        $('.dropdown-container').slideUp();
        // Reset the arrow direction when overlay is closed
        $('.service-link i').removeClass('rotate');
    }
});

$('#overlay').click(function(event) {
    // Check if the clicked element or its parent has the class 'services-dropdown' or 'dropdown-container'
    if ($(event.target).closest('.services-dropdown').length === 0 &&
        $(event.target).closest('.dropdown-container').length === 0) {
        $('#toggle').removeClass('toggle-active');
        $('#overlay').removeClass('nav-active');
        $('.dropdown-container').slideUp();
        // Reset the arrow direction when overlay is closed
        $('.service-link i').removeClass('rotate');
    }
});

document.addEventListener('DOMContentLoaded', function () {
    //click on the service-link, get the dropdown-container show
    //click on the service-link again, get the dropdown-container hide
    //一開始先將dropdown-container隱藏
    $('.dropdown-container').hide();
    $('.service-link').click(function () {
		event.preventDefault();
        $('.dropdown-container').slideToggle();
        //change the arrow direction
        $(this).find('i').toggleClass('rotate');
    });

    var backToTopButton = $('#back-to-top');

    $(window).scroll(function() {
        if ($(window).scrollTop() > 100) {
            backToTopButton.fadeIn();
        } else {
            backToTopButton.fadeOut();
        }
    });

    backToTopButton.click(function() {
        $('html, body').animate({scrollTop: 0}, 'fast');
        return false;
    });
});
	
</script>