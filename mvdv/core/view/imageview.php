<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace MVDV\Core\View;

/**
 * Description of imageview
 *
 * @author mark
 */
class ImageView extends View {

    public $image;

    public static function create($viewconfig=null, $defaults = array("templatedir" => "/mvdv/core/view/templates/general/", "templatename" => "imgtag")) {
      return parent::create($viewconfig, $defaults);
    }

    public function setImage($image) {
        $this->image = $image;
        return $this;
    }
    public function getImage() {
        return $this->image;
    }
}
