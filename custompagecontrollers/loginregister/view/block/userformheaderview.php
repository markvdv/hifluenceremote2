<?php

namespace CustomPageControllers\LoginRegister\View\Block;

/**
 * Description of UserFormHeaderView
 *
 * @author mark
 */
class UserFormHeaderView extends \MVDV\Core\View\HeaderView {

    public function __construct() {
        parent::__construct();
        self::$css[] = "https://fonts.googleapis.com/css?family=Source+Sans+Pro:600";
        self::$css[] = "/custompagecontrollers/loginregister/css/styles.css";
        self::$js['header']["jquery"] = "/mvdv/core/js/jquery/jquery-1.11.3.min.js";
        self::$js['header']["jqueryui"] = "http://code.jquery.com/ui/1.11.4/jquery-ui.js";
        self::$js["header"]["jqueryplugins"] = "http://jqueryui.com/jquery-wp-content/themes/jquery/js/plugins.js";
        self::$js["header"]["jquerymain"] = "http://jqueryui.com/jquery-wp-content/themes/jquery/js/main.js";
        self::$js["header"]["webcam"] = "/custompagecontrollers/loginregister/js/webcam/webcam.js";
        self::$js['header']['ajaxform'] = "/mvdv/core/js/custom/ajaxform.js";
        self::$js["footer"]["webcamsetup"] = "/custompagecontrollers/loginregister/js/webcamsetup.js";
        self::$js["footer"]["tabsetup"] = "/custompagecontrollers/loginregister/js/tabsetup.js";
        self::$js["footer"]["ajaxformsetup"] = "/custompagecontrollers/loginregister/js/ajaxformsetup.js";
        self::$js["footer"]["fblogin"] = "/custompagecontrollers/loginregister/js/fblogin.js";
        self::$js["footer"]["copypaste"] = "/custompagecontrollers/loginregister/js/copypaste.js";
        self::$js['footer']["jqueryvalidation"] = "http://cdn.jsdelivr.net/jquery.validation/1.15.0/jquery.validate.min.js";
        self::$js['footer']["jqueryvalidationextra"] = "http://cdn.jsdelivr.net/jquery.validation/1.15.0/additional-methods.min.js";
        $this->data['title'] = "HifluenceOefening - By MVDV";
    }

}
