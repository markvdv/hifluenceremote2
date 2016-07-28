<?php

namespace MVDV\File\DAO;
/**
 * database access object for images
 */
class ImageDAO extends \MVDV\File\DAO\FileDAO {

//  public static function getAll() {
//    $sql = "SELECT * FROM image";
//    $resultSet = parent::execPreppedStmt($sql)->fetchall(\PDO::FETCH_ASSOC);
//    foreach ($resultSet as $result) {
//      \MVDV\File\Entity\Image::create($result);
//    }
//    return \MVDV\File\Entity\Image::getIdMap();
//  }

//  public static function insert($name, $mimetype, $path, $size,$contentid, $resizedPath) {
//    $parentid = parent::insert($name, $mimetype, $path, $size,$contentid);
//    $args = array($parentid, $resizedPath);
//    $sql = "INSERT INTO image (fid,resizedpath) VALUES (?,?)";
//    parent::execPreppedStmt($sql, $args);
//    return $parentid;
//  }

//  public static function getById($id) {
//    $sql = "SELECT * FROM image LEFT JOIN file on file.beid=image.fid LEFT JOIN baseentity as be on be.id= image.fid WHERE fid=?";
//    $result = parent::execPreppedStmt($sql, func_get_args())->fetch(\PDO::FETCH_ASSOC);
//    return \MVDV\File\Entity\Image::create($result);
//  }
//  public static function getByContentId($id) {
//    $sql = "SELECT * FROM image LEFT JOIN file on file.beid=image.fid LEFT JOIN baseentity as be on be.id= image.fid WHERE contentid=?";
//    $args = func_get_args();
//    $resultSet = parent::execPreppedStmt($sql, $args)->fetchall(\PDO::FETCH_ASSOC);
//     foreach ($resultSet as $result) {
//      \MVDV\File\Entity\Image::create($result);
//    }
//    return \MVDV\File\Entity\Image::getIdMap();
//  }
//
//  public static function update($id, $name, $mimetype, $path, $size,$contentid, $resizedPath) {
//    parent::update($id, $name, $mimetype, $path, $size,$contentid);
//    $sql = "UPDATE image SET resizedpath=? WHERE fid=?";
//    $args = array($resizedPath, $id);
//    return parent::execPreppedStmt($sql, $args)->rowCount();
//  }

}
