<?php
    session_start();

    include_once 'vendor/classes/XMLdb.php';

    if (isset($_SESSION['auth']) && $_SESSION['auth']){
        if (isset($_COOKIE['login']) && $_COOKIE['login'] === $_SESSION['login']){
            $users = simplexml_load_file("vendor/XMLdb/users.xml");

            foreach ($users as $user) {
                if ((string)$user->cookiekey === $_COOKIE['cookiekey'] && (string)$user->sessionkey === $_SESSION['sessionkey'] && (string)$user->login === $_SESSION['login']){
                    header('Location: user_profile.php');
                }
            }
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link href="css/styles.css" rel="stylesheet">
</head>
<body>
    <h1>Login</h1>
    <form id="autorization-form">
        <input type="text" name="login" placeholder="Login">
        <input type="password" name="password" placeholder="Password">
        <button class="login-btn" type="submit" id="submit-form">Login</button>
        <div id="noJsBanner">Enable JavaScript!</div>
    </form>
    <noscript>
            <style type="text/css">
                #submit-form {
                    display: none; 
                }

                #noJsBanner
                {
                    display: block;
                }
            </style>
    </noscript>
    <p class="autorization-message"></p>
    <a href="registration_page.php">Sign up</a>
    <script src=js/jquery.js></script>
    <script src=js/login_button.js></script>
</body>
</html>