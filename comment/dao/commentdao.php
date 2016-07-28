<?php

namespace Comment\DAO;

class CommentDAO extends \MVDV\Core\DAO\DAO {

    public function getAll() {
        $sql = "SELECT * FROM comment";
        $resultSet = parent::execPreppedStmt($sql)->fetchall(\PDO::FETCH_ASSOC);
        foreach ($resultSet as $result) {
            \Comment\Entity\Comment::create($result);
        }
        return \Comment\Entity\Comment::getIdMap();
    }

    public static function getCommentsBySubjectIdAndSubjectType($subjectid, $subjecttype) {
        $sql = "SELECT * FROM comment WHERE commentsubjectid=? AND commentsubjecttype=? ORDER BY commenttimestamp DESC";
        $resultSet = parent::execPreppedStmt($sql, func_get_args())->fetchall(\PDO::FETCH_ASSOC);
        foreach ($resultSet as $result) {
            \Comment\Entity\Comment::create($result);
        }
        return \Comment\Entity\Comment::getIdMap();
    }

    public static function insert($title, $text, $subjectid, $subjecttype) {
        $sql = "INSERT INTO comment (commenttitle,commenttext,commentsubjectid,commentsubjecttype) VALUES (?,?,?,?)";
        parent::execPreppedStmt($sql, func_get_args());
        return parent::$lastInsertId;
    }

    public static function getById($commentid) {
        $sql = "SELECT * FROM comment WHERE commentid=?";
        $result = parent::execPreppedStmt($sql, func_get_args())->fetch(\PDO::FETCH_ASSOC);
        if ($result) {
            return \Comment\Entity\Comment::create($result);
        }
        return false;
    }

}
