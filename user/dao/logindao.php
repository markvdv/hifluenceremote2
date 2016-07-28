<?php

namespace User\DAO;

class LoginDAO extends \MVDV\Core\DAO\DAO {

    public static function getUserByName($username) {
        $sql = "SELECT user.userid,userpassword,usersalt,usernameFROM user WHERE username=?";
        $args = func_get_args();
        $resultSet = parent::execPreppedStmt($sql, $args)->fetchall(\PDO::FETCH_ASSOC);
        if ($resultSet) {
            $roles = array();
            foreach ($resultSet as $result) {
                $role = null;
                if ($result['roleid'] !== null) {
                    $roles[] = \MVDV\Auth\Entity\Role::create($result);
                }
            }
            $user = \MVDV\Auth\Entity\User::create($result, $roles);
            return $user;
        }
        return false;
    }

        public static function getUserByEmail($useremail) {
        $sql = "SELECT user.userid,userpassword,usersalt,username,rolename,role.roleid FROM user left join userrolelink on user.userid= userrolelink.userid left join role on userrolelink.roleid= role.roleid WHERE useremail=?";
        $args = func_get_args();
        $resultSet = parent::execPreppedStmt($sql, $args)->fetchall(\PDO::FETCH_ASSOC);
        if ($resultSet) {
            $roles = array();
            foreach ($resultSet as $result) {
                $role = null;
                if ($result['roleid'] !== null) {
                    $roles[] = \MVDV\Auth\Entity\Role::create($result);
                }
            }
            $user = \MVDV\Auth\Entity\User::create($result, $roles);
            return $user;
        }
        return false;
    }

}
