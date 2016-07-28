<?php

namespace User\View\Form;

class UserAddFormView extends \MVDV\Core\View\Form\FormView {

    public function __construct() {
        parent::__construct();

        $this->inputs["userimage"]=new \stdClass();
        $this->inputs["userimage"]->tag="input";
        $this->inputs["userimage"]->type="file";
        $this->inputs["userimage"]->label="Profile Image";
        $this->inputs["userimage"]->accept="image/*";
        $this->inputs["userimage"]->capture="camera";

        //useremail field
        $this->inputs['useremail'] = new \stdClass();
        $this->inputs['useremail']->tag = "input";
        $this->inputs['useremail']->type = "email";
        $this->inputs['useremail']->label = "Email";
        $this->inputs['useremail']->pattern = "[A-Za-z0-9\.]+@[A-Za-z0-9\.]+";
        $this->inputs['useremail']->required = true;
        //username
        $this->inputs['username'] = new \stdClass();
        $this->inputs['username']->tag = "input";
        $this->inputs['username']->type = "text";
        $this->inputs['username']->label = "User Name";
        $this->inputs['username']->pattern = "[A-Za-z0-9 éùèà]+";
        $this->inputs['username']->required = true;

        //username
        $this->inputs['userpassword'] = new \stdClass();
        $this->inputs['userpassword']->tag = "input";
        $this->inputs['userpassword']->type = "password";
        $this->inputs['userpassword']->label = "Password";
        $this->inputs['userpassword']->pattern = "[A-Za-z0-9&!.éùèà]+";
        $this->inputs['userpassword']->required = true;
        
        $this->inputs['submit'] = new \stdClass();
        $this->inputs['submit']->tag = "input";
        $this->inputs['submit']->type = "submit";
        $this->inputs['submit']->value = "Register";

        $this->dataattributes["ajax"] = "/user/";
        $this->action = "/mvdv/user/useradd/post";
        $this->method="POST";
        $this->formattributes['name'] = "userregistration";
        $this->formattributes['enctype'] = "multipart/form-data";
        $this->formattributes['accept-charset'] = "UTF-8";
        $this->formcontainerid = "userregistrationform";
    }

}
