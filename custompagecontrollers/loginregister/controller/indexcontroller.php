<?php

namespace CustomPageControllers\LoginRegister\Controller;

/**
 * controller for initial page load
 */
class IndexController extends \MVDV\Core\Controller\BaseController {

//nog een content view block of body block maken waar andere blokviews in kunnen
    public function __construct() {
        parent::__construct();
        
        
//unset($this->session['loggedin']);
        if (isset($this->session['loggedin']) && $this->session['loggedin'] === true) {
            $user = unserialize($this->session['user']);
            header('location:/account/' . $user->getUserid());
            exit(0);
        }

        $header = new \CustomPageControllers\LoginRegister\View\Block\UserFormHeaderView();
        $header->render();
        $content = new \CustomPageControllers\LoginRegister\View\Contentblock\RegisterLoginView();
        $content->render();
        $footer = new \MVDV\Core\View\FooterView();
        $footer->render();
        exit(0);
    }

}
