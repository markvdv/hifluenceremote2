<?php

namespace MVDV\Core\Security\View\Page;

class URBlockedPageView extends \MVDV\Core\View\BasePageView {

    public function __construct() {
        parent::__construct();
        $this->templates->content = array("header" => new \MVDV\Core\View\HeaderView(), new \MVDV\Core\Security\View\Block\URBlockedView(), "footer" => new \MVDV\Core\View\FooterView());
        self::$css[] = "/mvdv/core/css/jquery/jquery-ui.min.css";
        self::$css[] = "/mvdv/core/css/jquery/jquery-ui.structure.min.css";
        self::$css[] = "/mvdv/core/css/jquery/jquery-ui.theme.min.css";
        self::$css[] = "/mvdv/core/css/custom/basecss.css";
    }

}
