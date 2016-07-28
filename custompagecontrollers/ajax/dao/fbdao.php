<?php

namespace CustomPageControllers\Ajax\DAO;

class FBDAO extends \MVDV\Core\DAO\DAO {

    public static function insert($email, $fbid, $fbname, $fnimageurl, $thirdpartyid) {
        $sql = "INSERT into userfbdata VALUES (?,?,?,?,?)";
        return parent::execPreppedStmt($sql, func_get_args())->rowCount();
    }

    public static function getByEmail($email) {
        $sql = "SELECT * FROM userfbdata where fbuseremail=?";
        $result = parent::execPreppedStmt($sql, func_get_args())->fetch(\PDO::FETCH_ASSOC);
        if ($result) {
            return \CustomPageControllers\Ajax\Entity\FBData::create($result);
        }
        return false;
    }

}
