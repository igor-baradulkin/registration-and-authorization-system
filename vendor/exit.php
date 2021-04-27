<?php
    session_start();

    include_once 'classes/XMLdb.php';
    include_once 'classes/Cookie.php';
    include_once 'classes/Session.php';

    if ($_POST['event']){
        XMLdb::deleteDbRecord($_SESSION['login'], ['cookiekey', 'sessionkey']);
        
        Cookie::destroyCookie();
        Session::destroySession();

        $response = [
            "status" => true
        ];

        echo json_encode($response);
    }
?>