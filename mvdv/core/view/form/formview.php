<?php

namespace MVDV\Core\View\Form;

/**
 * baseclass for formobjects that hold the data that needs to be rendered in the form as well as data binding
 */
class FormView extends \MVDV\Core\View\View {

    /**
     *
     * @var associative array where key is the name of the formelement and value is stdclass containing the type tag etc..., the inputsarray represents the formelements like inputs, selects, textareas, ...
     */
    public $inputs = array();

    /**
     *
     * @var string action attribute of the form, to be set in the extended class
     */
    public $action;

    /**
     *
     * @var string method attribute of the form, defaults to POST, to change set it in the extended class after parent::__construct()
     */
    public $method = "POST";

    /**
     *
     * @var array associative array where key is attribute name and value is attribute value, 
     * needed to add atttributes like :
     * autocomplete(on/off),
     * enctype(application/x-www-form-urlencoded, multipart/form-data, text/plain), 
     * novalidate (novalidate),
     * target (_blank,_self,_parent,_top,"framename"),
     * name ("name"),
     * accept-charset("character_set"),
     * 
     * for more information visit:
     * http://www.w3schools.com/tags/att_form_target.asp
     */
    public $formattributes = array();

    /**
     *
     * @var array :associative array used for data-binding , key is the name for the databind (e.g. passing the url for ajax calls to the form, this->dataattributes['ajax']="URL")
     */
    public $dataattributes = array();

    /**
     * instantiates the formview and adds necessary js to self::$js['footer']
     * @param array $viewconfig
     * @param array $defaults
     */
    public function __construct($defaults = array("templatename" => "form", "templatedir" => "\\mvdv\\core\\view\\templates\\general\\form\\")) {
        parent::__construct($defaults);
//            self::$js['header']['ajaxform'] = "/mvdv/core/js/custom/ajaxform.js";
//        if (!isset(self::$js['footer']['validationfunctions'])) {
////            self::$js['footer']['validationfunctions'] = "/mvdv/core/js/custom/validator.js";
//        }
    }

    /**
     * overridden create method sets default template for formviews
     * @param array $viewconfig
     * @param array $defaults
     * @return object of called class
     */
//    public static function create($viewconfig = null, $defaults = array("templatename" => "form", "templatedir" => "\\mvdv\\core\\view\\templates\\general\\form\\")) {
//        return parent::create($viewconfig, $defaults);
//    }

    /**
     * sets values for the form if an entity is given and then renders it
     */
    public function render($entity = null) {
        if ($entity) {
            $this->enterValues($entity);
        }
        parent::render();
    }

    /**
     * creates formelements based on passed input
     * @param stdclass $input
     * @param string $name
     * @param array $selected array with selected values for select box
     */
    static function createFormElement($input, $name, $selected = null) {
        switch ($input->tag) {
            case "input":
                if (isset($input->type)) {
                    //callinput function
                    if ($input->type == "submit") {
//                    self::createButton($input, $name);
                        include $_SERVER["DOCUMENT_ROOT"] . "/mvdv/core/view/templates/general/form/formelements/button.php";
                    } else if ($input->type === "file") {
                        include $_SERVER["DOCUMENT_ROOT"] . "/mvdv/core/view/templates/general/form/formelements/fileupload.php";
                    } else if ($input->type !== "checkbox" && $input->type !== "radio") {
//                    self::createInput($input, $name);
                        include $_SERVER["DOCUMENT_ROOT"] . "/mvdv/core/view/templates/general/form/formelements/input.php";
                    } else {
//                    self::createCheckboxRadio($input, $name);
                        include $_SERVER["DOCUMENT_ROOT"] . "/mvdv/core/view/templates/general/form/formelements/radiocheckbox.php";
                    }
                }
                break;
            case "select":
//                self::createSelect($input, $name, $selected);
                include $_SERVER["DOCUMENT_ROOT"] . "/mvdv/core/view/templates/general/form/formelements/select.php";
                break;
            case "textarea":
//                self::createTextarea($input, $name);
                include $_SERVER["DOCUMENT_ROOT"] . "/mvdv/core/view/templates/general/form/formelements/textarea.php";
                break;
        }
    }

    /**
     * creates an input formelement
     * @param stdclass $input
     * @param string $name
     */
    static function createInput($input, $name) {
        include $_SERVER["DOCUMENT_ROOT"] . "/mvdv/core/view/templates/general/form/formelements/input.php";
    }

    /**
     * creates a button formelement
     * @param stdclass $input
     * @param string $name
     */
    static function createButton($input, $name) {
        include $_SERVER["DOCUMENT_ROOT"] . "/mvdv/core/view/templates/general/form/formelements/button.php";
    }

    /**
     * creates a select formelement
     * @param stdclass $input
     * @param string $name
     */
    static function createSelect($input, $name) {
        include $_SERVER["DOCUMENT_ROOT"] . "/mvdv/core/view/templates/general/form/formelements/select.php";
    }

    /**
     * creates a checkbox or radio formelement
     * @param stdclass $input
     * @param string $name
     */
    static public function createCheckboxRadio($input, $name) {
        include $_SERVER["DOCUMENT_ROOT"] . "/mvdv/core/view/templates/general/form/formelements/radiocheckbox.php";
    }

    /**
     * creates a textarea formelement
     * @param stdclass $input
     * @param string $name
     */
    static public function createTextArea($input, $name) {
        include $_SERVER["DOCUMENT_ROOT"] . "/mvdv/core/view/templates/general/form/formelements/textarea.php";
    }

    /**
     * fills in form values
     * @param object $entity
     * @return \MVDV\Core\View\Form\FormView
     */
    public function enterValues($entity) {
        foreach ($this->inputs as $key => &$input) {
            if ($key !== "submit") {
                if ($input->tag == "select") {
                    $subentities = $entity->{"get" . ucfirst($key)}();
                    foreach ($subentities as $subentity) {
                        $input->options[$subentity->{"get" . ucfirst($input->optionclass) . "id"}()]->selected = true;
                    }
                } else {
                    if (method_exists($entity, "get" . ucfirst($key))) {
                        $input->value = $entity->{"get" . ucfirst($key)}();
                    }
                }
            }
        }
        return $this;
    }

    public function validateValues($data) {
        $errors = array();
        foreach ($data as $key => $value) {
            if (isset($this->inputs[$key]->pattern) && !preg_match($this->inputs[$key]->pattern, $value)) {
                $errors[$key] = "invalid pattern";
            }
        }
        return $errors;
    }

}
