<?php
    require_once dirname(__FILE__) . "/session.php";
    require_once dirname(__FILE__) . "/overlay_nav.php";
?>

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
    <!-- Container -->
	<div class="container animatedParent animateOnce clearfix" id="home">
		<!-- PHP-Navigation -->
		<!-- Navigation -->
		<nav class="navigation animated fadeInDownShort clearfix">
			<ul>
                <li><a href="#home">首 頁</a></li>
                <li class="dropdown">
                    <a href="#service" class="service-link2">服 務<i class="fa-solid fa-chevron-down"></i></a>
                    <ul class="dropdown-menu">
                        <li><a href="../php/move.php">協 助 搬 遷</a></li>
                        <li><a href="../php/roomate.php">配 對 室 友</a></li>
                        <li><a href="../php/rating.php">評 分 室 友</a></li>
                        <li><a href="../php/report.php">檢 舉 鄰 居</a></li>
                        <li><a href="../php/makefriend.php">吧 啦 吧 啦</a></li>
                    </ul>
                </li>
                <?php if (!isset($_SESSION['ID'])): ?>
                    <li><a href="../php/registration.php">註 冊</a></li>
                    <li><a href="../php/login.php">登 入</a></li>
                <?php else: ?>
                    <li><a href="../php/profile.php">個 人 資 訊</a></li>
                    <li><a href="../php/changepwd.php">更 改 密 碼</a></li>
                    <li><a href="../php/logout.php">登 出</a></li>
                <?php endif; ?>
            </ul>
		</nav>
		<!-- Navigation (End) -->
        <!-- Home -->
        <div class="home animated fadeInUpShort">
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
        <div class="service animated fadeInUpShort">
            <div class="service-content">
                <div class="service-title" id="service">
                    <h1>服務</h1>
                </div>
                <div class="service-box">
                    <div class="service-box-content">
                        <div class="service-box-title">
                            <h2>協助搬遷</h2>
                        </div>
                        <div class="service-box-pic">
                            <img src="../pic/move.gif" alt="">
                        </div>
                        <div class="service-box-text">
                            <p>您可選擇提供搬遷服務或是尋找搬遷服務。</p>
                            <ul class="service-intro">
                                <li>選擇有空的時間</li>
                                <li>選擇搬遷的物品</li>
                                <li>選擇搬遷的地點</li>
                                <li>選擇交通工具</li>
                                <li>快來配對啦！</li>
                            </ul>
                            <div class="service-box-link">
                                <a href="../php/move.php" alt="">Learn More</a>
                            </div>
                        </div>
                    </div>
                    <div class="service-box-content">
                        <div class="service-box-title">
                            <h2>配對室友</h2>
                        </div>
                        <div class="service-box-text">
                            <p>我們提供室友配對服務，讓您可以找到合適的室友。</p>
                            <ul class="service-intro">
                                <li>選擇睡眠習慣</li>
                                <li>選擇宿舍音量</li>
                                <li>選擇住宿地點</li>
                                <li>輸入其他要求</li>
                                <li>快來配對啦！</li>
                            </ul>
                            <div class="service-box-link">
                                <a href="../php/roomate.php">Learn More</a>
                            </div>
                        </div>
                        <div class="service-box-pic">
                            <img src="../pic/roomate.gif" alt="" class="roomate">
                        </div>
                    </div>
                    <div class="service-box-content">
                        <div class="service-box-title">
                            <h2>評分室友</h2>
                        </div>
                        <div class="service-box-pic">
                            <img src="../pic/rating.gif" alt="">
                        </div>
                        <div class="service-box-text">
                            <p>我們提供室友評分服務，讓您可以評分室友。</p>
                            <ul class="service-intro">
                                <li>選擇室友</li>
                                <li>選擇評分分數</li>
                                <li>輸入評論</li>
                                <li>快來評分啦！</li>
                            </ul>
                            <div class="service-box-link">
                                <a href="../php/rating.php">Learn More</a>
                            </div>
                        </div>
                    </div>
                    <div class="service-box-content">
                        <div class="service-box-title">
                            <h2>檢舉鄰居</h2>
                        </div>
                        <div class="service-box-text">
                            <p>我們提供檢舉鄰居服務，讓您可以檢舉鄰居。</p>
                            <ul class="service-intro">
                                <li>選擇檢舉地點</li>
                                <li>選擇檢舉對象</li>
                                <li>選擇檢舉原因</li>
                                <li>快來檢舉啦！</li>
                            </ul>
                            <div class="service-box-link">
                                <a href="../php/report.php">Learn More</a>
                            </div>
                        </div>
                        <div class="service-box-pic">
                            <img src="../pic/report.gif" alt="">
                        </div>
                    </div>
                    <div class="service-box-content">
                        <div class="service-box-title">
                            <h2>吧啦吧啦</h2>
                        </div>
                        <div class="service-box-pic">
                            <img src="../pic/chat.gif" alt="">
                        </div>
                        <div class="service-box-text">
                            <p>我們提供吧啦吧啦服務，讓您可以吧啦吧啦。</p>
                            <ul class="service-intro">
                                <li>查看大家的個人資訊</li>
                                <li>快來吧啦吧啦啦！</li>
                            </ul>
                            <div class="service-box-link">
                                <a href="../php/makefriend.php">Learn More</a>
                            </div>
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
        if ('<?= $_GET['changepwd_success'] ?>' === 'true') {
            Swal.fire({
                icon : 'success',
                title: 'Successfully Change Password',
                text : 'Please remember your new password',
                confirmButtonColor: 'rgba(11, 29, 64, 0.747)'
            
            });
        }

    };
</script>