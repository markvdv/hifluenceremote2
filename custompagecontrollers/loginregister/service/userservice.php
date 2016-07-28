<?php

namespace Custompagecontrollers\Loginregister\Service;

class UserService {

    public static function getUser($userid) {
        if (is_numeric($userid)) {
            $user = \Custompagecontrollers\Loginregister\DAO\UserDAO::getById($userid);
        } else if (is_string($userid)) {
            if (strpos($userid, "@") !== false) {
                $user = \Custompagecontrollers\Loginregister\DAO\UserDAO::getByEmail($userid);
            } else {
                $user = \Custompagecontrollers\Loginregister\DAO\UserDAO::getByName($userid);
            }
        }
        if ($user) {
            //get tags and comments
            $user->setTags(\Taxonomy\DAO\TagDAO::getAllByEntityIdAndEntityType($user->getUserid(), "user"));
            $user->setComments(\Comment\DAO\CommentDAO::getCommentsBySubjectIdAndSubjectType($user->getUserid(), "user"));
            if (is_numeric($user->getUserimage())) {
                $user->setUserimage(\MVDV\File\DAO\ImageDAO::getById($user->getUserimage()));
            }
            return $user;
        }
        return false;
    }

    public static function login($username, $userpassword) {
        $users = \Custompagecontrollers\Loginregister\DAO\LoginDAO::getUsersByName($username);
        if (!$users) {
            return false;
        }
        foreach ($users as $user) {

            if ($user->getUserpassword() == hash("sha512", $user->getUsersalt() . $userpassword)||$user->getUserpassword()===$userpassword) {
                //get tags and comments
                $user->setTags(\Taxonomy\DAO\TagDAO::getAllByEntityIdAndEntityType($user->getUserid(), "user"));
                $user->setComments(\Comment\DAO\CommentDAO::getCommentsBySubjectIdAndSubjectType($user->getUserid(), "user"));
                $user->setUserimage(\MVDV\File\DAO\ImageDAO::getById($user->getUserimage()));
                return $user;
            }
        }
        return false;
    }

    public static function updateUser($username, $useremail, $userfblinked) {
        $count = \Custompagecontrollers\Loginregister\DAO\UserDAO::updateUser($username, $userfblinked, $useremail);
        if ($count > 0) {
            return \Custompagecontrollers\Loginregister\DAO\UserDAO::getByEmail($useremail);
        }
        return false;
    }

}
