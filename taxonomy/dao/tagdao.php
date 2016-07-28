<?php

namespace Taxonomy\DAO;

class TagDAO extends \MVDV\Core\DAO\DAO {

    public static function getAll() {
        $sql = "SELECT tagid, tagname, tagtimestamp from tag";
        $resultSet = parent::execPreppedStmt($sql)->fetchall(\PDO::FETCH_ASSOC);
        foreach ($resultSet as $result) {
            \Taxonomy\Entity\Tag::create($result);
        }
        return \Taxonomy\Entity\Tag::getIdMap();
    }

    public static function insert($tagname) {
        $sql = "INSERT INTO tag (tagname) VALUES (?)";
        parent::execPreppedStmt($sql, func_get_args());
        return parent::$lastInsertId;
    }

    public static function delete($tagid) {
        $sql = "DELETE FROM tag where tagid=?";
        return parent::execPreppedStmt($sql, func_get_args())->rowCount();
    }
/**
 * 
 * @param int $entityid
 * @param int $entityname
 * @return array array of all tags with respective entity and entitytype
 */
    public static function getAllByEntityIdAndEntityType($entityid, $entityname) {
        $sql = "SELECT * FROM tag LEFT JOIN tagentitylink on tag.tagid=tagentitylink.tagid WHERE entityid=? AND entityname=?";
        $resultSet = parent::execPreppedStmt($sql, func_get_args())->fetchall(\PDO::FETCH_ASSOC);
        foreach ($resultSet as $result) {
            \Taxonomy\Entity\Tag::create($result);
        }
        return \Taxonomy\Entity\Tag::getIdMap();
    }

    public static function createTaglink($tagid, $entityid, $entitytype) {
        $sql = "INSERT INTO tagentitylink VALUES (?,?,?)";
        parent::execPreppedStmt($sql, func_get_args());
        return parent::$lastInsertId;
    }

    public static function getByName($tagname) {
        $sql = "SELECT * FROM tag where tagname=?";
        $result = parent::execPreppedStmt($sql, func_get_args())->fetch(\PDO::FETCH_ASSOC);
        if ($result) {
            return \Taxonomy\Entity\Tag::create($result);
        }
        return false;
    }

}
