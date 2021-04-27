<?php
    session_start();

    include_once 'classes/User.php';
    include_once 'classes/Cookie.php';
    include_once 'classes/Session.php';
    include_once 'classes/XMLdb.php';
    include_once 'classes/Registration.php';

    $login = $_POST['login'];
    $email = $_POST['email'];
    $name = $_POST['name'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    $registration = new Registration;
    $registration->registrateUser($login, $password, $email, $confirmPassword, $name);

?>