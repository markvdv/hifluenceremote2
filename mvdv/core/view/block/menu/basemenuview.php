<?php

namespace MVDV\Core\View\Block\Menu;

/**
 * base class that is to be extended in all menu view classes
 */
class BaseMenuView extends \MVDV\Core\View\View {

    /**
     *
     * @var array the links that are going to be in the menu
     */
    private $links = array();

    public function __construct($viewconfig = null, $defaults = null) {
        if (!isset(self::$js['footer']['menunavigationajax'])) {
            self::$js['footer']['menunavigationajax'] = "/mvdv/core/js/custom/menunavigationajax.js";
        }
        parent::__construct($viewconfig, $defaults);
    }

    public static function create($viewconfig = null, $defaults = array("templatedir" => "/mvdv/core/view/templates/general/menu/", "templatename" => "nav")) {
        return parent::create($viewconfig, $defaults);
    }

    public function setLinks($links) {
        $this->links = $links;
    }

}
