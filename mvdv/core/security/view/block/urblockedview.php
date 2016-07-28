<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace MVDV\Core\Security\View\Block;

/**
 * Description of urblockedview
 *
 * @author mark
 */
class URBlockedView extends \MVDV\Core\View\BaseBlockView {

    public function __construct() {
        parent::__construct();
        self::$data->title = "UH UH UUUH!!!";
        $this->templatedir= "/mvdv/core/security/templates";
        $this->templates->content = array("fkinghacker" => "urblocked");
    }

}
