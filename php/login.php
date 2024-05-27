<?php
  require_once dirname(__FILE__) . "/head.php";
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Login</title>   
    </head>
    <body>
        <div class="box">
            <h1>登入</h1>
            <br>
            <form action="login_check.php" method="post">
                <div class="write">
                    <div class="ID">學號 :<input type="text" id="ID" name="ID" ></div>
                    <div class="Password">密碼 :<input type="password" id="Password" name="Password" ></div>
                </div>
                <br>
                <button name="submit" type="submit">提交</button>
                <br>
                <p><a href="changepwd.php">修改密碼</a></p>
            </form>
        </div>
    </body>
    <script src="../js/overlay.js"></script>
</html>


<?php
require_once dirname(__FILE__)."/connection.php";
require_once dirname(__FILE__) . "/overlay_nav.php";
?>

<script>
   window.onload = function() {
        if ('<?= $_GET['wrong_login'] ?>' === 'true') {
            Swal.fire({
                icon : 'error',
                title: 'Login Failed',
                text : 'Please check your ID and Password again.',
                confirmButtonColor: 'rgba(11, 29, 64, 0.747)'
            
            });
        }
        
        if ('<?= $_GET['changepwd_success'] ?>' === 'true') {
            Swal.fire({
                icon : 'success',
                title: 'Password Changed',
                text : 'Please login again.',
                confirmButtonColor: 'rgba(11, 29, 64, 0.747)'
            });
        }
    };

</script>

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
    font-size: 40px;
    text-align: center;
    color: #576F72;
    margin-top: -15px;
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

.Name {
    margin-top: 10px;

}
button
{
    font-size: 19px;
    padding: 7px 16px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    display: block;
    margin: 0 auto;
    background-color: #576f72d8;
    color: #F0EBE3;
    font-family: "Noto Serif TC", serif;
    margin-bottom: -30px;

}

p 
{
    font-size: 15px; 
    text-align: center;
    margin-top: 30px;

}
p a
{
    color: #576F72;

}

</style>

