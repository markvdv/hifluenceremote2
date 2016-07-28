<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace CustomPageControllers\Ajax\Controller;

/**
 * Description of logincontroller
 *
 * @author mark
 */
class LoginController extends \MVDV\Core\Controller\BaseController {

    public function index() {
        $user = \Custompagecontrollers\Loginregister\Service\UserService::login($_POST['username'], $_POST['userpassword']);
        if ($user) {
            $this->session['loggedin'] = true;
            $user->setUserpassword(null);
            $user->setUsersalt(null);
            $this->session['user'] = serialize($user);
        }
        echo json_encode($user);
        exit(0);
    }
    public function loginFB(){
        $user= \Custompagecontrollers\Loginregister\Service\UserService::getUser($_POST['useremail']);
        if ($user) {
            $this->session['loggedin'] = true;
            $user->setUserpassword(null);
            $user->setUsersalt(null);
            $this->session['user'] = serialize($user);
        }
        echo json_encode($user);
        exit(0);
    }
    public function logOut() {
        
        unset($this->session['user']);
        unset($this->session['loggedin']);
        header('location:/loginregister');
        exit(0);
    }

}
