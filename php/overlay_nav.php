<!-- Google Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Indie+Flower&family=Nanum+Pen+Script&family=Noto+Serif+TC:wght@200..900&display=swap" rel="stylesheet">
<!-- Custom CSS -->
<link href="../css/nav.css" rel="stylesheet" type="text/css">
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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
					<a class="nav-link service-link" href="#">服務<i class="fa fa-long-arrow-down" aria-hidden="true"></i></a>
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
				<li class="nav-item">
					<a class="nav-link" href="../php/profile.php">個人資訊</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="../php/registration.php">註冊</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="../php/login.php">登入</a>
				</li>
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
            $('.service-link i').removeClass('fa-long-arrow-up').addClass('fa-long-arrow-down');
        }
	});
	$('#overlay').click(function(event) {
    // Check if the clicked element or its parent has the class 'services-dropdown' or 'dropdown-container'
    if ($(event.target).closest('.services-dropdown').length === 0 &&
        $(event.target).closest('.dropdown-container').length === 0) {
        $('#toggle').removeClass('toggle-active');
        $('#overlay').removeClass('nav-active');
		$('.dropdown-container').slideUp();
        $('.service-link i').removeClass('fa-long-arrow-up').addClass('fa-long-arrow-down');
    }
});
	document.addEventListener('DOMContentLoaded', function () {
		//click on the service-link, get the dropdown-container show
		//click on the service-link again, get the dropdown-container hide
		//一開始先將dropdown-container隱藏
		$('.dropdown-container').hide();
		$('.service-link').click(function () {
			$('.dropdown-container').slideToggle();
			//change the arrow direction
			$('.service-link i').toggleClass('fa-long-arrow-down fa-long-arrow-up');
		});
	});	
</script>