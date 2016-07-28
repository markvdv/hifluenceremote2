<?php

namespace MVDV\Core\Error\PageNotFound\DAO;

class PageNotFoundDAO extends \MVDV\Core\DAO\DAO {

    public static function insert($url, $ip) {
        $sql = "INSERT INTO pagenotfound (pagenotfoundurl,pagenotfoundip) VALUES(?,?)";
        return parent::execPreppedStmt($sql, func_get_args())->rowCount();
    }

    public static function getAll() {
        $sql = "SELECT * FROM pagenotfound";
        $resultSet = parent::execPreppedStmt($sql)->fetchall(\PDO::FETCH_ASSOC);
        foreach ($resultSet as $result) {
            \MVDV\Core\Error\Entity\PageNotFound::create($result);
        }
        return \MVDV\Core\Error\Entity\PageNotFound::getIdMap();
    }

}
