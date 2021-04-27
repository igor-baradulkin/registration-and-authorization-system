<?php
    class Cookie{
        const cookieLifeTime = 60 * 60 * 24 * 30;

        public function createCookie(User $user){
            setcookie("login", $user->login, time() + self::cookieLifeTime, '/');
            setcookie("cookiekey", $user->getCookieKey(), time() + self::cookieLifeTime, '/');
            header("Refresh:0");
        }

        public static function destroyCookie(){
            setcookie("login", '', time(), '/');
            setcookie("cookiekey", '', time(), '/');
        }
    }
?>