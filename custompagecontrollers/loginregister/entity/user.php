<?php

namespace Custompagecontrollers\Loginregister\Entity;

class User extends \User\Entity\User {

    protected $tags;
    protected $comments;
    protected $userfblinked;

    function getTags() {
        return $this->tags;
    }

    function getComments() {
        return $this->comments;
    }

    function setTags($tags) {
        $this->tags = $tags;
    }

    function setComments($comments) {
        $this->comments = $comments;
    }
    function getUserfblinked() {
        return $this->userfblinked;
    }

    function setUserfblinked($userfblinked) {
        $this->userfblinked = $userfblinked;
        return $this;
    }


}
