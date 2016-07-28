<?php

namespace Taxonomy\Entity;

class Tag extends \MVDV\Core\Entity\BaseEntity implements \JsonSerializable{

    protected $tagid;
    protected $tagname;
    protected $tagtimestamp;

    function getTagid() {
        return $this->tagid;
    }

    function getTagname() {
        return $this->tagname;
    }

    function getTagtimestamp() {
        return $this->tagtimestamp;
    }

    function setTagname($tagname) {
        $this->tagname = $tagname;
    }
    public function jsonSerialize() {
        return $this->tagname;
    }
}
