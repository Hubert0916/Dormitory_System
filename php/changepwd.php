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
        
    </head>
    <body>
        <div class="box">
            <h1>更改密碼</h1>
            <br>
            <br>
            <form id="changepwdForm" action="changepwd_check.php" method="get"  onsubmit="return validateForm(event)">
                <div class="write">
                    <div class="ID">學號 :<input type="text" id="ID" name="ID" ></div>
                    <div class="Password">舊密碼 : <input type="password" id="Password" name="Password" required></div>
                    <div class="Password1">新密碼 :<input type="password" id="Password1" name="Password1" required></div>
                    <div class="Password2">確認密碼 :<input type="password" id="Password2" name="Password2" required></div>
                    <button id="changepwdbtn" name="submit" value="Login" type="submit">提交</button>
                </div>
            </form>
        </div>
    <script src="../js/overlay.js"></script>
    </body>
    <body>
        <script>
            function validateForm(event) {
            var w = document.getElementById('Password').value;
            var x = document.getElementById('Password1').value;
            var y = document.getElementById('Password2').value;

            if(x.length<6){
                Swal.fire({
                    icon: 'warning',
                    title: 'Too short',
                    text: 'Please enter a password of more than 6 characters',
                })

                event.preventDefault();
            }
            else if (x != y) {
                Swal.fire({
                    icon: 'error',
                    title: 'Wrong password',
                    text: 'Confirm and Retype your password',
                })
                event.preventDefault();
            }
            else if (w == y) {
                Swal.fire({
                    icon: 'error',
                    title: 'Wrong',
                    text: 'The password has already been used before',
                })
                event.preventDefault();
            }
            else{
                document.getElementById('changepwdForm').submit();
            }
        }

    </script>
    </body>
</html>


<script>
    window.onload = function() {
        if ('<?= $_GET['wrong_pwd'] ?>' === 'true') {
        Swal.fire({
            icon : 'error',
            title: 'Wrong username or password',
            text : 'Please try again.',
        });
        }
    };

    if ('<?= $_GET['changepwd_success'] ?>' === 'false') {
        Swal.fire({
            icon : 'wrong',
            title: 'wrong password!',
        });
    };
</script>

<style>

*
{
    margin:0;
    padding:0;
    box-sizing: border-box;
    font-family: "Noto Serif TC", serif;

}
body
{
    background: rgba(11, 29, 64, 0.747);
    display:flex;
    justify-content:center;
    align-items:center;
    min-height:100vh;
    background-color: #576F72 !important;
}


h1
{
    font-size: 50px;
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
    margin-top: -10px;
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

.ID input {
    margin-left: 70px;
}

.Password input {
    margin-left: 50px;
}

.Password1 input {
    margin-left: 55px;
}

.Password2 input {
    margin-left: 40px;
}   

.write button
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
    margin-bottom: -30px;
    margin-top: 40px;
}

</style>
