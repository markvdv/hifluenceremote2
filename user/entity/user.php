<?php

namespace User\Entity;

class User extends \MVDV\Core\Entity\BaseEntity implements \JsonSerializable {

    protected $userid;
    protected $useremail;
    protected $username;
    protected $usersalt;
    protected $userpassword;
    protected $usertimestamp;
    protected $userimage;

    function getUsertimestamp() {
        return $this->usertimestamp;
    }

    function setUsertimestamp($usertimestamp) {
        $this->usertimestamp = $usertimestamp;
        return $this;
    }

    function getUserid() {
        return $this->userid;
    }

    function getUsername() {
        return $this->username;
    }

    function getUsersalt() {
        return $this->usersalt;
    }

    function setUserid($userid) {
        $this->userid = $userid;
        return $this;
    }

    function setUsername($username) {
        $this->username = $username;
        return $this;
    }

    function setUsersalt($usersalt) {
        $this->usersalt = $usersalt;
        return $this;
    }

    function getUserpassword() {
        return $this->userpassword;
    }

    function setUserpassword($userpassword) {
        $this->userpassword = $userpassword;
        return $this;
    }

    function getUserroles() {
        return $this->userroles;
    }

    function setUserroles($roles) {
        $this->userroles = $roles;
        return $this->userroles;
    }

    function getUserpreferences() {
        return $this->userpreferences;
    }

    function setUserpreferences($userpreferences) {
        $this->userpreferences = $userpreferences;
        return $this;
    }

    function getUseremail() {
        return $this->useremail;
    }

    function setUseremail($useremail) {
        $this->useremail = $useremail;
        return $this;
    }

    function getUserimage() {
        return $this->userimage;
    }

    function setUserimage($userimage) {
        $this->userimage = $userimage;
    }

    public function jsonSerialize() {
        $objvars = get_object_vars($this);
        unset($objvars['userpassword']);
        unset($objvars['usersalt']);
        return json_encode($objvars);
    }

}
