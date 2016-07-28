<?php
namespace Comment\Service;
class CommentService {
    public static function createComment($subjectid,$subjecttype,$title,$text) {
      return \Comment\DAO\CommentDAO::insert($title, $text, $subjectid, $subjecttype);
    }
    public static function getById($commentid) {
        return \Comment\DAO\CommentDAO::getById($commentid);
    }
}
