<?php

namespace CustomPageControllers\LoginRegister\View\Block;

class LoginFormView extends \User\View\Form\UserLoginFormView{
    public function __construct() {
        parent::__construct();
        $this->dataattributes['ajax']="/ajax/login/";
    }
}
