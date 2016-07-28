<?php

namespace MVDV\Core\Security\Entity;

class loggedIpAddress extends \MVDV\Core\Entity\BaseEntity {

    private $loggedipaddressid;
    private $loggedipaddress;
    private $timeslogged;

    function getTimeslogged() {
        return $this->timeslogged;
    }

    function setTimeslogged($timeslogged) {
        $this->timeslogged = $timeslogged;
    }

    function getLoggedipaddressid() {
        return $this->loggedipaddressid;
    }

    function getLoggedipaddress() {
        return $this->loggedipaddress;
    }

    function setLoggedipaddressid($loggedipaddressid) {
        $this->loggedipaddressid = $loggedipaddressid;
    }

    function setLoggedipaddress($loggedipaddress) {
        $this->loggedipaddress = $loggedipaddress;
    }

}
