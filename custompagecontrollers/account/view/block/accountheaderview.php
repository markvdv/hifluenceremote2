<?php

namespace CustomPageControllers\Account\View\Block;

/**
 * Description of UserFormHeaderView
 *
 * @author mark
 */
class AccountHeaderView extends \MVDV\Core\View\HeaderView {

    public function __construct() {
        parent::__construct();
        self::$css[] = "/custompagecontrollers/loginregister/css/styles.css";
        self::$js['header']["jquery"] = "/mvdv/core/js/jquery/jquery-1.11.3.min.js";
        self::$js['header']["jqueryui"] = "http://code.jquery.com/ui/1.11.4/jquery-ui.js";
        self::$js["header"]["jqueryplugins"] = "http://jqueryui.com/jquery-wp-content/themes/jquery/js/plugins.js";
        self::$js["header"]["jquerymain"] = "http://jqueryui.com/jquery-wp-content/themes/jquery/js/main.js";
        self::$js['header']['ajaxform'] = "/mvdv/core/js/custom/ajaxform.js";
        self::$js["footer"]["ajaxformsetup"] = "/custompagecontrollers/loginregister/js/ajaxformsetup.js";
        self::$js["footer"]["userprofile"] = "/custompagecontrollers/loginregister/js/userprofile.js";
        $this->data['title'] = "HifluenceOefening - By MVDV";
    }

}
