<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace CustomPageControllers\LoginRegister\View\Contentblock;

/**
 * Description of registerloginview
 *
 * @author mark
 */
class RegisterLoginView extends \MVDV\Core\View\View {

    public $blocks = array();

    public function __construct($defaults = array("templatename" => "registerlogin", "templatedir" => "/custompagecontrollers/loginregister/view/templates/")) {
        parent::__construct($defaults);
        $this->blocks["useraddform"] = new \CustomPageControllers\LoginRegister\View\Block\RegisterFormView();

        $this->blocks["userloginform"] = new \CustomPageControllers\LoginRegister\View\Block\LoginFormView();
        if (isset($_COOKIE['useremail'])) {
            $user = \Custompagecontrollers\Loginregister\Service\UserService::getUser($_COOKIE["useremail"]);
        }
        $this->blocks["userloginform"]->enterValues($user);
        $this->blocks["userprofile"] = new \CustomPageControllers\Account\View\Block\UserProfileViewBlock();
    }

}
