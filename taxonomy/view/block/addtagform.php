<?php

namespace Taxonomy\View\Block;

class AddTagForm extends \MVDV\Core\View\Form\FormView {

    public function __construct($subjectid, $subjecttype) {
        parent::__construct();

        $this->inputs['entityid'] = new \stdClass();
        $this->inputs['entityid']->tag = "input";
        $this->inputs['entityid']->type = "hidden";
        $this->inputs['entityid']->value = $subjectid;

        $this->inputs['entitytype'] = new \stdClass();
        $this->inputs['entitytype']->tag = "input";
        $this->inputs['entitytype']->type = "hidden";
        $this->inputs['entitytype']->value = $subjecttype;

        $this->inputs['tagname'] = new \stdClass();
        $this->inputs['tagname']->tag = "input";
        $this->inputs['tagname']->type = "text";
        $this->inputs['tagname']->placeholder = "tag name";




        $this->inputs['submit'] = new \stdClass();
        $this->inputs['submit']->tag = "input";
        $this->inputs['submit']->value = "add tag";
        $this->inputs['submit']->type = "submit";
        $this->dataattributes['ajax'] = "/tag/";
        $this->name = "addtagform";
        $this->id = "addtagform";
    }

}
