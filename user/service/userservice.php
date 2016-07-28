<?php

namespace User\Service;

class UserService {

    public static function getUser($name, $userpassword) {
        $user = \User\DAO\UserDAO::getUser($name);
        if (!$user) {
            return false;
        }
//        if ($user->getUserpassword() == hash('sha256', $pw . $user->getUsersalt())) {
        $key = \Defuse\Crypto\Key::loadFromAsciiSafeString($user->getUserSalt());
        
        if ($userpassword == \Defuse\Crypto\Crypto::decrypt($user->getUserpassword(), $key, true)) {
            return $user;
        } else {
            return false;
        }
    }

    public static function getUserById($id) {
        $user = \User\DAO\UserDAO::getById($id);
        $user->setUserimage(\MVDV\File\DAO\ImageDAO::getById($user->getUserimage()));
        if (!$user) {
            return false;
        }
        return $user;
    }

    public static function getUserList() {
        return \User\DAO\UserDAO::getAll();
    }

    public static function createUser($username, $useremail, $userpassword, $userimageid = null) {

        if(empty($userpassword)){
            $userpassword=self::generateSalt();
        }
        $salt= self::generateSalt();
        $hashedPw=hash('sha512',$salt.$userpassword);;
//        $salt=self::generateSalt();
//        $hashedPw=\Defuse\Crypto\Crypto::encryptWithPassword($userpassword,$salt,true);
        $newuserid = \User\DAO\UserDAO::create($username, $useremail, $hashedPw, $salt, $userimageid);
        if ($newuserid !== null) {
         //confirmation mail 
            $headers = "From: contact@markvanderveken.com";
            $headers .= "Reply-To: $useremail";
            mail($useremail,"Your account has been created","Your login info is name:".$username." password: ".$userpassword,$headers);
            
            return \User\DAO\UserDAO::getById($newuserid);
        }
        return false;
    }

    private static function generateSalt() {
        $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
        $salt = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 100; $i++) {
            $n = rand(0, $alphaLength);
            $salt[] = $alphabet[$n];
        }
        return implode($salt); //turn the array into a string
    }

    public static function deleteUser($id) {
        $data = new \stdClass();
        $data->success = false;
        if (\User\DAO\UserDAO::delete($id) === 1) {
            $data->success = true;
        }
        return $data;
    }

    //public static function updateUser($userid, $name, $password, $salt, $roles) {
    public static function updateUser($userdata) {
        $data = new \stdClass();
        $data->success = false;
        $user = self::getUserById($userdata["userid"]);
        if ($user) {
            foreach ($userdata as $propertyname => $propertyvalue) {
                if (property_exists($user, $propertyname) && $propertyvalue !== null) {
                    $user->{"set" . ucfirst($propertyname)}($propertyvalue);
                }
            }
            if (\User\DAO\UserDAO::update($user->getUserid(), $user->getUsername(), $user->getUseremail()) === 1) {
                $data->success = true;
                $data->entity = $user;
            }
        }
        return $data;
    }

}
