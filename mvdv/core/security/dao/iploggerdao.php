<?php

namespace MVDV\Core\Security\DAO;

class IpLoggerDAO extends \MVDV\Core\DAO\DAO {

    public static function getByIp($ipaddress) {
        $sql = "SELECT * FROM loggedipaddress WHERE loggedipaddress=?";
        $result = parent::execPreppedStmt($sql, func_get_args())->fetch(\PDO::FETCH_ASSOC);
        if ($result) {
            return \MVDV\Core\Security\Entity\loggedIpAddress::create($result);
        }
        return false;
    }

    public static function getByIpAndMaxlimit($ipaddress, $maxlogged) {
        $sql = "SELECT * FROM loggedipaddress WHERE loggedipaddress=? AND timeslogged=?";
        $result = parent::execPreppedStmt($sql, func_get_args())->fetch(\PDO::FETCH_ASSOC);
        if ($result) {
            return \MVDV\Core\Security\Entity\loggedIpAddress::create($result);
        }
        return false;
    }

    public static function create($ipadress) {
        $sql = "INSERT INTO loggedipaddress (loggedipaddress,timeslogged) VALUES(?,1)";
        return parent::execPreppedStmt($sql, func_get_args());
    }

    public static function update($ipaddress) {
        $sql = "UPDATE loggedipaddress SET timeslogged=timeslogged+1 WHERE loggedipaddress=?";
        return parent::execPreppedStmt($sql, func_get_args());
    }

}
