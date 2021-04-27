<?php
    class Autorization{

        public function autorizateUser($login, $password){
            $db = XMLdb::readDbRecord();

            $autorization = false;

            foreach($db as $user){
                $salt = (string)$user->salt;
                if ((string)$user->login === $login && (string)$user->hashedpassword === md5($password . $salt)){
                    $autorization = true;

                    $autorizedUser = new User;
                    $autorizedUser->login = $login;
                    $autorizedUser->name = (string)$user->name;
                    $autorizedUser->setCookieKey();
                    $autorizedUser->setSessionKey();

                    XMLdb::updateDbRecord($autorizedUser->login, ["cookiekey", "sessionkey"], [$autorizedUser->getCookieKey(), $autorizedUser->getSessionKey()]);

                    $cookie = new Cookie;
                    $cookie->createCookie($autorizedUser);

                    $session = new Session;
                    $session->createSession($autorizedUser);

                    break;
                }
            }

            if ($autorization){

                $response = [
                    "status" => true,
                ];

                echo json_encode($response);
            }
            else {
                $response = [
                    "status" => false,
                    "message" => "Incorrect login or username. Try again!"
                ];

                echo json_encode($response);
            }
        }
    }
?>