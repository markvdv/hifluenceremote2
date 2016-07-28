<?php

namespace MVDV\Core\Error\View\Block;

class ErrorView extends \MVDV\Core\View\View {

    public function __construct($defaults = array("templatename" => "error", "templatedir" => "\\mvdv\\core\\error\\view\\templates\\block\\", "data" => array('title' => 'Default Error Page Title'))) {
        parent::__construct($defaults);
    }
}
