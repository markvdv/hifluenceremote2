<?php

namespace Config\Site\View\Form;

class SiteconfigFormView extends \MVDV\Core\View\Form\FormView {
    /*
     * override the parent::__contruct() function to add the form input fields etc..
     */

    public function __construct($viewconfig, $defaults) {
        parent::__construct($viewconfig, $defaults);
        $this->action = "/admin/siteconfig/editpost";
        $this->dataattributes['ajax'] = "/admin/siteconfig/editpost";
//        //define input fields
        $this->inputs['sitetitle'] = new \stdClass();
        $this->inputs['sitetitle']->tag = "input";
        $this->inputs['sitetitle']->type = "text";
        $this->inputs['sitetitle']->name = "sitetitle";
        $this->inputs['sitetitle']->placeholder = "sitetitle";
        $this->inputs['sitetitle']->required = true;

        $this->inputs['defaulturl'] = new \stdClass();
        $this->inputs['defaulturl']->tag = "input";
        $this->inputs['defaulturl']->type = "text";
        $this->inputs['defaulturl']->name = "defaulturl";
        $this->inputs['defaulturl']->placeholder = "defaulturl";
        $this->inputs['defaulturl']->required = true;

        $this->inputs['loginredirect'] = new \stdClass();
        $this->inputs['loginredirect']->tag = "input";
        $this->inputs['loginredirect']->type = "text";
        $this->inputs['loginredirect']->name = "loginredirect";
        $this->inputs['loginredirect']->placeholder = "loginredirect";
        $this->inputs['loginredirect']->required = true;

        $this->inputs['logoutredirect'] = new \stdClass();
        $this->inputs['logoutredirect']->tag = "input";
        $this->inputs['logoutredirect']->type = "text";
        $this->inputs['logoutredirect']->name = "logoutredirect";
        $this->inputs['logoutredirect']->placeholder = "logoutredirect";
        $this->inputs['logoutredirect']->required = true;

        $this->inputs['notloggedinredirect'] = new \stdClass();
        $this->inputs['notloggedinredirect']->tag = "input";
        $this->inputs['notloggedinredirect']->type = "text";
        $this->inputs['notloggedinredirect']->name = "notloggedinredirect";
        $this->inputs['notloggedinredirect']->placeholder = "notloggedinredirect";
        $this->inputs['notloggedinredirect']->required = true;

        $this->inputs['defaultlanguage'] = new \stdClass();
        $this->inputs['defaultlanguage']->tag = "select";
        $this->inputs['defaultlanguage']->name = "defaultlanguage";
        $this->inputs['defaultlanguage']->options = \MVDV\Translation\Service\LanguageService::getAllLanguages();
        $this->inputs['defaultlanguage']->optionclass = "language";
        $this->inputs['defaultlanguage']->required = true;


        $this->inputs['sitelogo'] = new \stdClass();
        $this->inputs['sitelogo']->tag = "input";
        $this->inputs['sitelogo']->name = "sitelogo";
        $this->inputs['sitelogo']->type = "file";
        $this->inputs['sitelogo']->label = "site logo";

        //radio/checkbox test
//        $this->inputs['defaultlanguage'] = new \stdClass();
//        $this->inputs['defaultlanguage']->tag = "input";
//        $this->inputs['defaultlanguage']->type = "radio";
//        $this->inputs['defaultlanguage']->name = "defaultlanguage";
//        $this->inputs['defaultlanguage']->options = \MVDV\Translation\Service\LanguageService::getAllLanguages();
//        $this->inputs['defaultlanguage']->optionclass = "language";

        $this->inputs['submit'] = new \stdClass();
        $this->inputs['submit']->tag = "input";
        $this->inputs['submit']->type = "submit";
        $this->inputs['submit']->name = "submit";
        $this->inputs['submit']->placeholder = "text";
        $this->formattributes["enctype"] = "multipart/form-data";
        $this->formattributes["name"] = "exampleform";
    }

}
