<?php

namespace MVDV\File\Entity;

class BaseFile extends \MVDV\Core\Entity\BaseEntity implements \JsonSerializable {

    protected $basefileid;
    protected $basefilename;
    protected $basefilemimetype;
    protected $basefilepath;
    protected $basefilesize;

    function getBasefileid() {
        return $this->basefileid;
    }

    function getBasefilename() {
        return $this->basefilename;
    }

    function getBasefilemimetype() {
        return $this->basefilemimetype;
    }

    function getBasefilepath() {
        return $this->basefilepath;
    }

    function getBasefilesize() {
        return $this->basefilesize;
    }

    function setBasefilename($basefilename) {
        $this->basefilename = $basefilename;
    }

    function setBasefilemimetype($basefilemimetype) {
        $this->basefilemimetype = $basefilemimetype;
    }

    function setBasefilepath($basefilepath) {
        $this->basefilepath = $basefilepath;
    }

    function setBasefilesize($basefilesize) {
        $this->basefilesize = $basefilesize;
    }

    public function jsonSerialize() {
        $vars = get_object_vars($this);
        unset($vars["basefilesize"]);
        unset($vars["basefilemimetype"]);
        return $vars;
    }

}
