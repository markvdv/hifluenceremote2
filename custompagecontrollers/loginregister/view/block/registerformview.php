<?php

/*
  overrides standard userform
 */

namespace CustomPageControllers\LoginRegister\View\Block;

class RegisterFormView extends \User\View\Form\UserAddFormView {

    public function __construct() {
        //userimage


        parent::__construct();
        $this->inputs['userimage']->hidden = 1;
        $this->inputs['userimage']->imgbuttonsrc = "/custompagecontrollers/loginregister/res/img/uploadbutton.png";
        $this->inputs['userimage']->id= "fileupload";
    }

}
