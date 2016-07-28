<?php

namespace MVDV\File\DAO;

/**
 * database access object for files
 */
class FileDAO extends \MVDV\Core\DAO\DAO {

    public static function getAll() {
        $sql = "SELECT basefilename, basefilemimetype, basefilepath, basefilesize FROM file";
        $resultSet = parent::execPreppedStmt($sql)->fetchall(\PDO::FETCH_ASSOC);
        foreach ($resultSet as $result) {
            \MVDV\File\Entity\BaseFile::create($result);
        }
        return \MVDV\File\Entity\BaseFile::getIdMap();
    }

    public static function getById($id) {
        $sql = "SELECT basefileid, basefilename, basefilemimetype, basefilepath, basefilesize FROM file where basefileid=?";
        $result=parent::execPreppedStmt($sql, func_get_args())->fetch(\PDO::FETCH_ASSOC);
        return \MVDV\File\Entity\BaseFile::create($result);
    }
    public static function getIdByName($name) {
        $sql = "SELECT basefileid,FROM file where basefilename=?";
        $result=parent::execPreppedStmt($sql, func_get_args())->fetch(\PDO::FETCH_ASSOC);
        return \MVDV\File\Entity\BaseFile::create($result);
    }

    public static function insert($mimetype, $name, $path, $size) {
        $sql = "INSERT INTO file (basefilemimetype, basefilename , basefilepath, basefilesize) VALUES (?,?,?,?)";
        parent::execPreppedStmt($sql, func_get_args());
        return self::$lastInsertId;
    }

    public static function update($id, $name, $mimetype, $path, $size, $contentid) {
        $sql = "UPDATE basefile SET basefilename=?,basefilemimetype=?,basefilepath=?,basefilesize=?,basefilecontentid=? WHERE basefileid=?";
        $args = array($name, $mimetype, $path, $size, $contentid, $id);
        return parent::execPreppedStmt($sql, $args)->rowCount();
    }

    public static function delete($id) {
        $sql = "DELETE FROM file where fileid=?";
        return parent::execPreppedStmt($sql, func_get_args())->rowCount();
    }

}
