<?php

namespace Custompagecontrollers\Loginregister\DAO;

class UserDAO extends \MVDV\Core\DAO\DAO {

    public static function getById($userid) {
        $sql = "SELECT * FROM user WHERE userid=?";
        $result = parent::execPreppedStmt($sql, func_get_args())->fetch(\PDO::FETCH_ASSOC);
        if ($result) {
            return \Custompagecontrollers\Loginregister\Entity\User::create($result);
        }
        return false;
    }

    public static function getByName($username) {
        $sql = "SELECT * FROM user WHERE username=?";
        $result = parent::execPreppedStmt($sql, func_get_args())->fetch(\PDO::FETCH_ASSOC);
        if ($result) {
            return \Custompagecontrollers\Loginregister\Entity\User::create($result);
        }
        return false;
    }

    public static function getByEmail($email) {
        $sql = "SELECT * FROM user WHERE useremail=?";
        $result = parent::execPreppedStmt($sql, func_get_args())->fetch(\PDO::FETCH_ASSOC);
        if ($result) {
            return \Custompagecontrollers\Loginregister\Entity\User::create($result);
        }
        return false;
    }

    public static function updateUser($username,$userfblinked,$useremail) {
        echo PHP_EOL;
        var_dump(func_get_args());
        echo PHP_EOL;
        echo "on line: " . __LINE__ . ", in file: " . __FILE__ . PHP_EOL;
        $sql = "UPDATE user set username=?,userfblinked=? WHERE useremail=?";
        return parent::execPreppedStmt($sql, func_get_args())->rowCount();
    }

}
