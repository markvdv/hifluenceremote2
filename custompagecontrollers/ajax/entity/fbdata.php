<?php

namespace CustomPageControllers\Ajax\Entity;

class FBData extends \MVDV\Core\Entity\BaseEntity {

    protected $fbuseremail;
    protected $fbid;
    protected $fbname;
    protected $fbimageurl;
    protected $thirdpartyid;

    function getFbuseremail() {
        return $this->fbuseremail;
    }

    function getFbid() {
        return $this->fbid;
    }

    function getFbname() {
        return $this->fbname;
    }

    function getFbimageurl() {
        return $this->fbimageurl;
    }

    function getThirdpartyid() {
        return $this->thirdpartyid;
    }

    function setFbuseremail($fbuseremail) {
        $this->fbuseremail = $fbuseremail;
        return $this;
    }

    function setFbid($fbid) {
        $this->fbid = $fbid;
        return $this;
    }

    function setFbname($fbname) {
        $this->fbname = $fbname;
        return $this;
    }

    function setFbimageurl($fbimageurl) {
        $this->fbimageurl = $fbimageurl;
        return $this;
    }

    function setThirdpartyid($thirdpartyid) {
        $this->thirdpartyid = $thirdpartyid;
        return $this;
    }

}
