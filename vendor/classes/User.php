<?php
    class User{
        
        public $login;
        public $name;
        public $email;
        private $hashedPassword;
        private $cookieKey;
        private $sessionKey;
        private $salt;

        public function firstTimeUser($login, $name, $email, $password){
            $this->login = $login;
            $this->name = $name;
            $this->email = $email;
            $this->salt = $this->generateSalt(12);
            $this->hashedPassword = md5($password . $this->salt);
            $this->cookieKey = md5($this->generateSalt(16));
            $this->sessionKey = md5($this->generateSalt(16));

        }


        public function getHashedPassword(){
            return $this->hashedPassword;
        }

        public function getCookieKey(){
            return $this->cookieKey;
        }

        public function setCookieKey(){
            $this->cookieKey = md5(self::generateSalt(16));
        }

        public function setSessionKey(){
            $this->sessionKey = md5(self::generateSalt(16));
        }

        public function getSessionKey(){
            return $this->sessionKey;
        }

        public function getSalt(){
            return $this->salt;
        }

        public static function generateSalt($saltLength = 10){
            $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
            $salt = substr(str_shuffle($permitted_chars), 0, $saltLength);

            return $salt;
        }


    }
?>