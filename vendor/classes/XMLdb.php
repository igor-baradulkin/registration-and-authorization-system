<?php
    class XMLdb{

        public static function createNewRecord(User $newUserRecord){
            $db = self::readDbRecord();

            $user = $db->addChild('user');
            $user->addChild('login', $newUserRecord->login);
            $user->addChild('name', $newUserRecord->name);
            $user->addChild('email', $newUserRecord->email);
            $user->addChild('salt', $newUserRecord->getSalt());
            $user->addChild('hashedpassword', $newUserRecord->getHashedPassword());
            $user->addChild('cookiekey', $newUserRecord->getCookieKey());
            $user->addChild('sessionkey', $newUserRecord->getSessionKey());

            $db->asXML("XMLdb/users.xml");

        }

        public static function readDbRecord(){
            return simplexml_load_file("XMLdb/users.xml");
        }

        public static function updateDbRecord($userLogin, $updateParams, $paramsValue){
            $db = self::readDbRecord();

            foreach($db as $user){
                if ((string)$user->login === $userLogin){
                    for($i = 0; $i < count($updateParams); $i++){
                        $tag = $updateParams[$i];
                        $value = $paramsValue[$i];
                        $user->$tag = $value;
                    }
                    break;
                }
            }

            file_put_contents('XMLdb/users.xml', $db->asXML());
        }

        public static function deleteDbRecord($userLogin, $deleteParams){
            $db = self::readDbRecord();

            foreach($db as $user){
                if ((string)$user->login === $userLogin){
                    foreach($deleteParams as $param){
                        $user->$param = '';
                    }
                    break;
                }
            }
            file_put_contents('XMLdb/users.xml', $db->asXML());
        }
    }
?>