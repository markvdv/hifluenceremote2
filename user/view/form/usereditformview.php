<?php

namespace MVDV\Auth\View\Form;

class UsereditFormView extends \MVDV\Core\View\BaseFormView {

    public function __construct($userid = null) {
        $user = \MVDV\Auth\Service\UserService::getUserById($userid);
        parent::__construct("usereditform"); //pass id voor containerdiv to constructor
        //prepare daat to create forminputs
        //userid field
        $this->inputs->userid = new \stdClass();
        $this->inputs->userid->tag = "input";
        $this->inputs->userid->type = "hidden";
        $this->inputs->userid->required = true;
        //useremail field
        $this->inputs->useremail = new \stdClass();
        $this->inputs->useremail->tag = "input";
        $this->inputs->useremail->type = "email";
        $this->inputs->useremail->placeholder = "email";
        $this->inputs->useremail->required = true;
        //   $this->inputs->useremail->value = $user->getUseremail();
        //username
        $this->inputs->username = new \stdClass();
        $this->inputs->username->tag = "input";
        $this->inputs->username->type = "text";
        $this->inputs->username->placeholder = "name";
        $this->inputs->username->required = true;
        // $this->inputs->username->value = $user->getName();
//userroles
        $this->inputs->userroles = new \stdClass();
        $this->inputs->userroles->tag = "select";
        $this->inputs->userroles->name = "userroles[]";
        $this->inputs->userroles->options = \MVDV\Auth\Service\RoleService::getRoles();
        $this->inputs->userroles->multiple = true;
        $this->inputs->userroles->optionclass = "role";


        $this->inputs->submit = new \stdClass();
        $this->inputs->submit->tag = "input";
        $this->inputs->submit->type = "submit";
        $this->inputs->submit->value = "save user";
        $this->enterValues($this->inputs, $user);
        //add additional needed data 
        $this->action = "/mvdv/user/useredit/post";
        $this->name = "userform";
        $this->formcontainerid = "useraddform";
        $this->dataattributes["ajax"]="/user/json/edit/";
    }

}
