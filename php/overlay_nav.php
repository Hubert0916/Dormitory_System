<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Indie+Flower&family=Nanum+Pen+Script&family=Noto+Serif+TC:wght@200..900&display=swap" rel="stylesheet">
<link href="../css/nav.css" rel="stylesheet" type="text/css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
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
			<ul>
				<li><a href="../php/home.php">首頁</a></li>
				<li><a href="#service">服務</a></li>
				<li><a href="#profile">個人資訊</a></li>
				<li><a href="../php/registratio.php">註冊</a></li>
				<li><a href="../php/login.php">登入</a></li>
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
<script>
    $('#toggle').click(function() {
        $(this).toggleClass('toggle-active');
        $('#overlay').toggleClass('nav-active');
    });
    $('#overlay a').click(function() {
        $('#toggle').removeClass('toggle-active');
        $('#overlay').removeClass('nav-active');
    });
</script>  