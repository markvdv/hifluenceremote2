<?php

namespace MVDV\Core\Error\Entity;

class PageNotFound extends \MVDV\Core\Entity\BaseEntity {

    private $pagenotfoundid;
    private $pagenotfoundtimestamp;
    private $pagenotfoundurl;
    private $pagenotfoundip;

    function getPagenotfoundid() {
        return $this->pagenotfoundid;
    }

    function getPagenotfoundtimestamp() {
        return $this->pagenotfoundtimestamp;
    }

    function getPagenotfoundurl() {
        return $this->pagenotfoundurl;
    }

    function getPagenotfoundip() {
        return $this->pagenotfoundip;
    }

    function setPagenotfoundid($pagenotfoundid) {
        $this->pagenotfoundid = $pagenotfoundid;
    }

    function setPagenotfoundtimestamp($pagenotfoundtimestamp) {
        $this->pagenotfoundtimestamp = $pagenotfoundtimestamp;
    }

    function setPagenotfoundurl($pagenotfoundurl) {
        $this->pagenotfoundurl = $pagenotfoundurl;
    }

    function setPagenotfoundip($pagenotfoundip) {
        $this->pagenotfoundip = $pagenotfoundip;
    }

}
