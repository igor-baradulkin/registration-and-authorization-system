<?php
    session_start();

    include_once 'classes/User.php';
    include_once 'classes/Cookie.php';
    include_once 'classes/Session.php';
    include_once 'classes/XMLdb.php';
    include_once 'classes/Autorization.php';

    $login = $_POST['login'];
    $password = $_POST['password'];

    $autorization = new Autorization;

    $autorization->autorizateUser($login, $password);

?>