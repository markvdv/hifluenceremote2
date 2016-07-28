<?php

namespace Comment\View\Block;

class AddCommentForm extends \MVDV\Core\View\Form\FormView {

    //put your code here
    //prepare daat to create forminputs
    //username field
    public function __construct($subjectid,$subjecttype) {
        parent::__construct();

        $this->inputs['commentsubjectid'] = new \stdClass();
        $this->inputs['commentsubjectid']->tag = "input";
        $this->inputs['commentsubjectid']->type = "hidden";
        $this->inputs['commentsubjectid']->value = $subjectid;
        $this->inputs['commentsubjectid']->required = true;
        $this->inputs['commentsubjecttype'] = new \stdClass();
        $this->inputs['commentsubjecttype']->tag = "input";
        $this->inputs['commentsubjecttype']->type = "hidden";
        $this->inputs['commentsubjecttype']->value = $subjecttype;

        $this->inputs['commentsubjecttype']->required = true;

        $this->inputs['commenttitle'] = new \stdClass();
        $this->inputs['commenttitle']->tag = "input";
        $this->inputs['commenttitle']->type = "text";
        $this->inputs['commenttitle']->placeholder = "title";

        $this->inputs['commenttext'] = new \stdClass();
        $this->inputs['commenttext']->tag = "textarea";
        $this->inputs['commenttext']->placeholder = "commenttext";
        $this->inputs['commenttext']->required = true;
        $this->inputs['commenttext']->name= "commenttext";
        $this->inputs['commenttext']->id= "commenttext";



        $this->inputs['submit'] = new \stdClass();
        $this->inputs['submit']->type = "submit";
        $this->inputs['submit']->tag = "input";
        $this->inputs['submit']->value = "add comment";
        $this->action = "/comment/add";
        $this->dataattributes['ajax'] = "/comment/add";
    }

}
