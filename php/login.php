<?php
    require_once dirname(__FILE__)."/connection.php";
    require_once dirname(__FILE__) . "/overlay_nav.php";
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Indie+Flower&family=Nanum+Pen+Script&display=swap" rel="stylesheet">   
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Indie+Flower&family=Nanum+Pen+Script&family=Noto+Serif+TC:wght@200..900&display=swap" rel="stylesheet">

        <title>Login</title>
        
    </head>
    <body>
        <div class="box">
            <h1>登入</h1>
            <br>
            <form action="model/login_check.php" method="get">
                <div class="write">
                    <div class="input-group Name">
                        <label for="Name">姓名 :</label>
                        <input type="text" id="Name" name="Name" required>
                    </div>
                    <div>
                        <label for="Password">密碼 : </label>
                        <input type="password" id="Password" name="Password" required>
                    </div>
                </div>
                <br>
                <button name="submit" type="submit">提交</button>
                <br>
            </form>
            </div>
    </body>
    <script src="../js/overlay.js"></script>
</html>

<style>
*
{
    margin:0;
    padding:0;
    box-sizing: border-box;
}
body
{
    background: rgba(11, 29, 64, 0.747);
    display:flex;
    justify-content:center;
    align-items:center;
    min-height:100vh;
    background-color: #576F72 !important;
    font-family: "Noto Serif TC", serif;
}

h1
{
    font-size: 50px;
    text-align: center;
    color: #576F72;
}

.box 
{
    padding: 80px;
    border-radius: 10px;
    background-color: #F0EBE3 !important;
}
.write
{
    font-size: 20px; 
    margin-bottom: 15px;
    display: flex;
    flex-direction: column;
    text-align: center;
    color: #576F72;
}
.write input {
    font-size: 15px; 
    margin: 17px;
    width: 150px;
    border-radius: 5px;
    background-color: #f2f2f2;
    color: #576F72;
}

button
{
    font-size: 20px;
    padding: 9px 22px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    display: block;
    margin: 0 auto;
    background-color: #576f72d8;
    color: #F0EBE3;
    font-family: "Noto Serif TC", serif;

}

p 
{
    font-size: 15px; 
    text-align: center;
}
p a
{
    color: #576F72;
}

</style>
<script>
   
   window.onload = function() {
        if ('<?= $_GET['registration_success'] ?>' === 'true') {
            Swal.fire({
                icon : 'success',
                title: 'Already Registration ',
                text : 'Log in now !!',
                confirmButtonColor: 'rgba(11, 29, 64, 0.747)'
                   
            });
        }
        if ('<?= $_GET['wrong_login'] ?>' === 'true') {
            Swal.fire({
                icon : 'error',
                title: 'wrong username or password',
                text : 'Try again',
                confirmButtonColor: 'rgba(11, 29, 64, 0.747)'
            
            });
        }
    };
</script>

