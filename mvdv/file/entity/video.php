<?php

namespace MVDV\File\Entity;

class Video extends BaseFile {

    private $length;
    private $compressedpath;

    function getLength() {
        return $this->length;
    }

    function getCompressedpath() {
        return $this->compressedpath;
    }

    function setLength($length) {
        $this->length = $length;
    }

    function setCompressedpath($compressedpath) {
        $this->compressedpath = $compressedpath;
    }

}
