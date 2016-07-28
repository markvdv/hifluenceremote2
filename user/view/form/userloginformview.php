<?php

namespace User\View\Form;

/**
 * Description of userloginformview
 *
 * @author mark
 */
class UserLoginFormView extends \MVDV\Core\View\Form\FormView {

    public function __construct() {
        parent::__construct();
                //prepare daat to create forminputs
        //username field
        $this->inputs['username'] = new \stdClass();
        $this->inputs['username']->tag = "input";
        $this->inputs['username']->type = "text";
        $this->inputs['username']->placeholder = "User Name";
        $this->inputs['username']->required = true;
        $this->inputs['username']->autofocus = true;

        //username
        $this->inputs['userpassword'] = new \stdClass();
        $this->inputs['userpassword']->tag = "input";
        $this->inputs['userpassword']->type = "password";
        $this->inputs['userpassword']->placeholder = "Password";
        $this->inputs['userpassword']->required = true;
        
        //remember me
        $this->inputs['rememberme'] = new \stdClass();
        $this->inputs['rememberme']->tag="input";
        $this->inputs['rememberme']->type="checkbox";
        $this->inputs['rememberme']->label="Remember My Password";
        $this->inputs['rememberme']->hidden=true;
        
        //submit
        $this->inputs['submit'] = new \stdClass();
        $this->inputs['submit']->tag = "input";
        $this->inputs['submit']->type = "submit";
        $this->inputs['submit']->value = "Login";

        $this->action = "/auth/login/post";
        $this->formattributes['name'] = "userlogin";
          $this->formattributes['accept-charset'] = "UTF-8";
        $this->dataattributes['ajax'] = "/user/";
        $this->formcontainerid = "userloginform";

    }

}
