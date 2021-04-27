<?php
    class Session{
        
        public function createSession(User $user){
            $_SESSION['auth'] = true;
            $_SESSION['login'] = $user->login;
            $_SESSION['name'] = $user->name;
            $_SESSION['sessionkey'] = $user->getSessionKey();
        }

        public static function destroySession(){
            unset($_SESSION['auth']);
            unset($_SESSION['login']);
            unset($_SESSION['name']);
            unset($_SESSION['sessionkey']);

            session_destroy();
        }
    }
?>