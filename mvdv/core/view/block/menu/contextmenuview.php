<?php

namespace MVDV\Core\View\Block\Menu;

/**
 * base class that is to be extended in all menu view classes
 */
class ContextMenuView extends BaseMenuView {

    public function __construct($viewconfig = null, $defaults = null) {
        parent::__construct($viewconfig, $defaults);
        if(!isset(self::$js['footer']['hidemenu'])) {
            self::$js['footer']['hidemenu'] = "/mvdv/core/js/custom/hidemenu.js";
        }
    }

}
