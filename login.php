<?php
require_once('dbhelp.php');
session_start();

if (isset($_POST['login'])) {

    $user = $_POST['user'];
    $pass = $_POST['pass'];

    $sql = "select * from user where userName =  '$user' and password ='$pass'";

    $UserList = excuteResult($sql);


    if (count($UserList) > 0) {

        header('Location: ManagerStudent.php');
        $_SESSION['loggedIn'] = '1';
        $_SESSION['user'] = $user;
        exit('<font color="green">Login success full... </font>');
    } else {
        exit('<font color="red">wrong... </font>');
    }
}

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="styleLogin.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
</head>

<body>
    <div class="login-wrap">
        <div class="login-html">
            <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Sign In</label>
            <input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab">Sign Up</label>
            <div class="login-form">
                <form action="login.php" method="POST">
                    <div class="sign-in-htm">
                        <div class="group">
                            <label for="user" class="label">Username</label>
                            <input id="user" type="text" class="input">
                        </div>
                        <div class="group">
                            <label for="pass" class="label">Password</label>
                            <input id="pass" type="password" class="input" data-type="password">
                        </div>
                        <div class="group">
                            <input id="check" type="checkbox" class="check" checked>
                            <label for="check"><span class="icon"></span> Keep me Signed in</label>
                        </div>
                        <div class="group">
                            <input type="button" id="login" class="button" value="Sign In">
                            <p style="text-align:center;" id="response"></p>
                        </div>
                        <div class="hr"></div>
                        <div class="foot-lnk">
                            <a href="#forgot">Forgot Password?</a>

                        </div>
                    </div>

                </form>

                <div class="sign-up-htm">
                    <div class="group">
                        <label for="user" class="label">Username</label>
                        <input id="user" type="text" class="input">
                    </div>
                    <div class="group">
                        <label for="pass" class="label">Password</label>
                        <input id="pass" type="password" class="input" data-type="password">
                    </div>
                    <div class="group">
                        <label for="pass" class="label">Repeat Password</label>
                        <input id="pass" type="password" class="input" data-type="password">
                    </div>
                    <div class="group">
                        <label for="pass" class="label">Email Address</label>
                        <input id="pass" type="text" class="input">
                    </div>
                    <div class="group">
                        <input type="submit" class="button" value="Sign Up">
                    </div>
                    <div class="hr"></div>
                    <div class="foot-lnk">
                        <label for="tab-1">Already Member?</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js'></script>
    <script type="text/javascript">
        $(document).ready(function() {

            $("#login").on('click', function() {
                var user = $("#user").val();
                var pass = $("#pass").val();
                console.log(pass);
                if (user == "" || pass == "") {
                    alert('Your input empty');
                } else {
                    $.ajax({
                        url: 'login.php',
                        method: 'POST',
                        data: {
                            login: 1,
                            user: user,
                            pass: pass,
                        },
                        success: function(response) {
                            $("#response").html(response);

                            if (response.indexOf('success') >= 0)
                                window.location = 'ManagerStudent.php';
                        },
                        dataType: 'text'

                    })
                }


            });
        });
    </script>
</body>

</html>