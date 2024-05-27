<!DOCTYPE html>
<html lang="en">
<head id="top">
	<title>Dormitory System</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Indie+Flower&family=Nanum+Pen+Script&family=Noto+Serif+TC:wght@200..900&display=swap" rel="stylesheet">
    <link href="../css/home.css" rel="stylesheet" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="../js/home.js"></script>
    <script src="https://kit.fontawesome.com/3a02e24f5d.js" crossorigin="anonymous"></script>
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
                <li><a href="#home">首 頁</a></li>
                <li class="dropdown">
                    <a href="#service">服 務</a><i class="fa-solid fa-chevron-down"></i>
                    <ul class="dropdown-menu">
                        <li><a href="../php/move.php">協 助 搬 遷</a></li>
                        <li><a href="#service2">配 對 室 友</a></li>
                        <li><a href="#service3">設 備 報 修</a></li>
                        <li><a href="../php/report.php">檢 舉 鄰 居</a></li>
                        <li><a href="#service5">吧 啦 吧 啦</a></li>
                    </ul>
                </li>
                <li><a href="../php/profile.php">個 人 資 訊</a></li>
                <li><a href="../php/registration.php">註 冊</a></li>
                <li><a href="../php/login.php">登 入</a></li>
            </ul>
		</nav>
		<!-- Navigation (End) -->
        <!-- Home -->
        <div class="home animated fadeInUpShort" id="home">
            <div class="home-content">
                <div class="title">
                    <div class="content-name">
                        <h1>宿 舍 系 統</h1>
                    </div>
                    <div class="learn">
                        <a href="#service" class="learn-more">Learn More</a>
                        <line class="learn-line"></line>
                    </div>
                </div>  
                <img src="../pic/greenhome.gif" alt="">
            </div>
        </div>
        <!-- Home (End) -->
        <!-- 介紹 Services 有哪些，跟一些服務的詳細資訊-->
        <div class="service animated fadeInUpShort" id="service">
            <div class="service-content">
                <div class="service-title">
                    <h1>服務</h1>
                </div>
                <div class="service-box">
                    <div class="service-box-content">
                        <div class="service-box-title">
                            <h2>協助搬遷</h2>
                        </div>
                        <div class="service-box-text">
                            <p>我們提供搬遷服務，讓您可以輕鬆搬遷到新的宿舍。</p>
                        </div>
                        <div class="service-box-link">
                            <a href="../php/move.php">Learn More</a>
                        </div>
                    </div>
                    <div class="service-box-content">
                        <div class="service-box-title">
                            <h2>配對室友</h2>
                        </div>
                        <div class="service-box-text">
                            <p>我們提供室友配對服務，讓您可以找到適合的室友。</p>
                        </div>
                        <div class="service-box-link">
                            <a href="#service2">Learn More</a>
                        </div>
                    </div>
                    <div class="service-box-content">
                        <div class="service-box-title">
                            <h2>設備報修</h2>
                        </div>
                        <div class="service-box-text">
                            <p>我們提供設備報修服務，讓您可以輕鬆報修。</p>
                        </div>
                        <div class="service-box-link">
                            <a href="#service3">Learn More</a>
                        </div>
                    </div>
                    <div class="service-box-content">
                        <div class="service-box-title">
                            <h2>檢舉鄰居</h2>
                        </div>
                        <div class="service-box-text">
                            <p>我們提供檢舉鄰居服務，讓您可以舉報不良鄰居。</p>
                        </div>
                        <div class="service-box-link">
                            <a href="../php/report.php">Learn More</a>
                        </div>
                    </div>
                    <div class="service-box-content">
                        <div class="service-box-title">
                            <h2>吧啦吧啦</h2>
                        </div>
                        <div class="service-box-text">
                            <p>我們提供吧啦吧啦服務，讓您可以與其他宿舍生互動。</p>
                        </div>
                        <div class="service-box-link">
                            <a href="#service5">Learn More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container (End) -->
</main>
<footer>
    <div class="footer">
        <p class="foot">© 2024 Dormitory System</p>
    </div>
</footer>
</body>
</html>

<script>
   window.onload = function() {
        if ('<?= $_GET['login_successful'] ?>' === 'true') {
            Swal.fire({
                icon : 'success',
                title: 'Login Success',
                text : 'Welcome to Dormitory Website',
                confirmButtonColor: 'rgba(11, 29, 64, 0.747)'
            
            });
        }

    };
</script>