<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Comment\Entity;

class Comment extends \MVDV\Core\Entity\BaseEntity {

    /**
     *
     * @var int unique identifier for a comment
     */
    protected $commentid;

    /**
     *
     * @var timestamp time when comment is created 
     */
    protected $commenttimestamp;

    /**
     *
     * @var timestamp time when comment is last updated
     */
    protected $commentupdated;

    /**
     *
     * @var string title of the comment
     */
    protected $commenttitle;

    /**
     *
     * @var string message of the comment
     */
    protected $commenttext;

    /**
     *
     * @var User object of user that has created the comment 
     */
    protected $commentauthor;

    /**
     *
     * @var subject object upon which was commented 
     */
    protected $commentsubject;

    /**
     *
     * @var string string representing the type of the subject upon, which has been commented e.g. 'user','comment' 
     */
    protected $commentsubjecttype;

    function getCommentid() {
        return $this->commentid;
    }

    function getCommenttimestamp() {
        return $this->commenttimestamp;
    }

    function getCommentupdated() {
        return $this->commentupdated;
    }

    function getCommenttitle() {
        return $this->commenttitle;
    }

    function getCommenttext() {
        return $this->commenttext;
    }

    function getCommentauthor() {
        return $this->commentauthor;
    }

    function getCommentsubject() {
        return $this->commentsubject;
    }

    function getCommentsubjecttype() {
        return $this->commentsubjecttype;
    }

    function setCommentid($commentid) {
        $this->commentid = $commentid;
    }

    function setCommenttimestamp($commenttimestamp) {
        $this->commenttimestamp = $commenttimestamp;
    }

    function setCommentupdated($commentupdated) {
        $this->commentupdated = $commentupdated;
    }

    function setCommenttitle($commenttitle) {
        $this->commenttitle = $commenttitle;
    }

    function setCommenttext($commenttext) {
        $this->commenttext = $commenttext;
    }

    function setCommentauthor($commentauthor) {
        $this->commentauthor = $commentauthor;
    }

    function setCommentsubject($commentsubject) {
        $this->commentsubject = $commentsubject;
    }

    function setCommentsubjecttype($commentsubjecttype) {
        $this->commentsubjecttype = $commentsubjecttype;
    }

}
