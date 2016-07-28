<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Custompagecontrollers\Loginregister\DAO;

/**
 * Description of logindao
 *
 * @author mark
 */
class LoginDAO extends \MVDV\Core\DAO\DAO {

    //public function getUserByNameAndPassword($username,$userpassword) {
    public function getUsersByName($username) {
        $sql = "SELECT * FROM user where username=?";
        $resultSet = parent::execPreppedStmt($sql, func_get_args())->fetchall(\PDO::FETCH_ASSOC);
        if ($resultSet) {
            foreach($resultSet as $result){
             \Custompagecontrollers\Loginregister\Entity\User::create($result);
            }
            return \Custompagecontrollers\Loginregister\Entity\User::getIdMap();
        }
        return false;
    }

}
