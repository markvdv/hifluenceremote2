<?php

namespace User\View\Block;

/**
 * Description of userprofileview
 *
 * @author mark
 */
class UserProfileViewBlock extends \MVDV\Core\View\View {

    public function __construct($defaults=array("templatedir"=>"/user/view/templates/block/","templatename"=>"userprofile")) {
        parent::__construct($defaults);
    }
    public function render() {
        if(!isset($this->data['user'])){
            $this->data['user']= New \User\Entity\User();
        }
        parent::render();
    }
}
