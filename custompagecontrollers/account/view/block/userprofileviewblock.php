<?php

namespace CustomPageControllers\Account\View\Block;

/**
 * Description of userprofileview
 *
 * @author mark
 */
class UserProfileViewBlock extends \MVDV\Core\View\View {

    public $blocks = array();

    public function __construct($defaults = array("templatedir" => "/custompagecontrollers/account/view/templates/block/", "templatename" => "userprofile")) {
        parent::__construct($defaults);
    }

    public function render() {
        if (!isset($this->data['user'])) {
            $this->data['user'] = New \CustomPageControllers\Loginregister\Entity\User();
        }else{
            $this->blocks['addcommentform'] = new \Comment\View\Block\AddCommentForm($this->data['user']->getUserid(),"user");
            $this->blocks['addtagform'] = new \Taxonomy\View\Block\AddTagForm($this->data['user']->getUserid(),"user");
        }
        parent::render();
    }

}
