<?php

namespace User\Service;

class LoginService {

    public static function login($useremail, $userpassword) {
        $user = \User\DAO\LoginDAO::getUserByName($username);
//        $user = \MVDV\Auth\DAO\LoginDao::getUserByEmail($useremail);
        if (!$user) {
            //user doesnt exist
            return false;
        }

        
        $key = \Defuse\Crypto\Key::loadFromAsciiSafeString($user->getUserSalt());
        if ($userpassword == \Defuse\Crypto\Crypto::decrypt($user->getUserpassword(), $key, true)) {
            return $user;
        } else {
            //wrong password
            return false;
        }
    }

}
