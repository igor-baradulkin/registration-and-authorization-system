<?php
    class Registration{
        
        public $validateErrors = [];

        public function registrateUser($login, $password, $email, $confirmPass, $name){
            $this->validateLogin($login);
            $this->validatePassword($password);
            $this->validateEmail($email); 
            $this->validateName($name);
            $this->checkRepeatPassword($confirmPass, $password);

            if (empty($this->validateErrors)){
                if ($this->checkUniqueInfo($login, $email)){
                    $user = new User;
                    $user->firstTimeUser($login, $name, $email, $password);

                    XMLdb::createNewRecord($user);

                    $session = new Session;
                    $session->createSession($user);

                    $cookies = new Cookie;
                    $cookies->createCookie($user);

                    $response = [
                        "status" => true,
                    ];

                    echo json_encode($response);

                }
                else{
                    $response = [
                        "status" => false,
                        "errorType" => 2,
                        "errorMessage" => "User is not unique"
                    ];

                    echo json_encode($response);
                }
            }
            else{
                $response = [
                    "status" => false,
                    "errorType" => 1, 
                    "errorsList" => $this->validateErrors
                ];
    
                echo json_encode($response);
            }
        }

        public function validateLogin($login){
            if ($login !== ''){
                if (preg_match('/[A-Za-z]/', $login) && preg_match('/[\d]/', $login) && !preg_match('/[^A-Za-z0-9]/', $login) && strlen($login) >= 6){
                    return;
                }
                else{
                    $this->validateErrors[] = "invalid-login:Bad login";
                }
            }
            else {
                $this->validateErrors[] = "invalid-login:This field must not be empty";
            }
        }

        public function validatePassword($password){
            if ($password !== ''){
                if (preg_match('/[A-Z]/', $password) && preg_match('/[a-z]/', $password) && preg_match('/[\d]/', $password) && preg_match('/[^A-Za-z\d]/', $password) && strlen($password) >= 6){
                    return;
                }
                else{
                    $this->validateErrors[] = 'invalid-password:This is an insecure password! Try again!';
                }
            }
            else{
                $this->validateErrors[] = "invalid-password:This field must not be empty";
            }
        }

        public function checkRepeatPassword($repeatPass, $password){
            if ($repeatPass !== ''){
                if ($repeatPass === $password){
                    return ;
                }
                else{
                    $this->validateErrors[] = 'unmatch-pass:Passwords don`t match';
                }
            }
            else{
                $this->validateErrors[] = "unmatch-pass:This field must not be empty";
            }
        }

        public function validateName($name){
            if ($name !== ''){
                if (preg_match('/[A-Za-z]/', $name) && preg_match('/[0-9]/', $name) && !preg_match('/[^A-Za-z0-9]/', $name) && strlen($name) >= 2){
                    return ;
                }
                else{
                    $this->validateErrors[] = 'invalid-name:Invalid name';
                }
            }
            else{
                $this->validateErrors[] = "invalid-name:This field must not be empty";
            }
        }

        public function validateEmail($email){
            if ($email !== ''){
                if (filter_var($email, FILTER_VALIDATE_EMAIL)){
                    return ;
                }
                else{
                    $this->validateErrors[] = 'invalid-email:Invalid email';
                }
            }
            else{
                $this->validateErrors[] = "invalid-email:This field must not be empty";
                return ;
            }

        }

        public function checkUniqueInfo($login, $email){
            $XMLdb = XMLdb::readDbRecord();

            $uniqueUser = true;

            foreach($XMLdb as $user){
                if ((string)$user->login === $login || (string)$user->login === $email){
                    $uniqueUser = false;
                    break;
                }
            }

            return $uniqueUser;
        }
    }
?>