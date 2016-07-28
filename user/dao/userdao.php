<?php

namespace User\DAO;

class UserDAO extends \MVDV\Core\DAO\DAO {

    public static function getAll() {
        $sql = "SELECT userid,useremail, username,usertimestamp,userimage FROM user";
        // $sql = "SELECT user.userid,rolename,role.roleid, username from user left join userrolelink on user.userid= userrolelink.userid left join role on userrolelink.roleid=role.roleid order by user.userid";
        $resultSet = parent::execPreppedStmt($sql)->fetchall(\PDO::FETCH_ASSOC);
        if ($resultSet) {
            foreach ($resultSet as $result) {
                \User\Entity\User::create($result);
            }
        }
        return \User\Entity\User::getIdMap();
    }

    public static function getById($id) {
        //$sql = "SELECT user.userid,user.username,user.userpassword,user.usersalt, rolename,role.roleid, username,usertimestamp,useremail FROM user left join userrolelink on user.userid= userrolelink.userid left join role on userrolelink.roleid=role.roleid WHERE user.userid=? order by user.userid ";
        $sql = "SELECT user.userid,useremail, username,usertimestamp,userimage FROM user WHERE user.userid=?";
        $result = parent::execPreppedStmt($sql, func_get_args())->fetch(\PDO::FETCH_ASSOC);
        if ($result) {
            return \User\Entity\User::create($result);
        }
        return false;
    }

    public function create($name,$email, $pw, $salt,$userimageid) {
        $sql = "INSERT INTO user (username,useremail,userpassword,usersalt,userimage) VALUES(?,?,?,?,?)";
        parent::execPreppedStmt($sql, func_get_args());
        return parent::$lastInsertId;
    }

    public function delete($userid) {
        $sql = "DELETE FROM user WHERE userid=?";
        return parent::execPreppedStmt($sql, func_get_args())->rowCount();
    }

    public function update($userid, $name, $email) {
        $sql = "UPDATE user SET username=?, useremail=? WHERE userid= ?";
        $args = array($name, $email, $userid);
        return parent::execPreppedStmt($sql, $args)->rowCount();
    }

}
