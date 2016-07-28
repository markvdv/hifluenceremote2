<?php

namespace MVDV\File\Entity;

/**
 * entity for images
 */
class Image extends BaseFile {

    private $resizedpath;

    function getResizedpath() {
        return $this->resizedpath;
    }

    function setResizedpath($resizedpath) {
        $this->resizedpath = $resizedpath;
    }

}
