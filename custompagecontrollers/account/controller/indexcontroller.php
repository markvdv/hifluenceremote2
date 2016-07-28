<?php

namespace CustomPageControllers\Account\Controller;

class IndexController extends \MVDV\Core\Controller\BaseController {

    public function index($arg) {
           if(!isset($this->session['loggedin'])){
            header('location:/loginregister');
            exit(0);
        }
        $header = new \CustomPageControllers\Account\View\Block\AccountHeaderView();
        $header->render();
        $user = \Custompagecontrollers\Loginregister\Service\UserService::getUser($arg);
        if ($user) {
            $view = new \CustomPageControllers\Account\View\Block\UserProfileViewBlock();
            $view->setData(array('user' => $user));
        } else {
            $view = new \MVDV\Core\Error\PageNotFound\View\Block\PageNotFoundView("/account/" . $arg);
        }
        $view->render();
        $footer = new \MVDV\Core\View\FooterView();
        $footer->render();
        exit(0);
    }

}
