<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace CustomPageControllers\Ajax\Controller;

/**
 * Controller ofr ajax calls to handle the facebook data of users logging in with facebook
 *
 * @author mark
 */
class FBController extends \MVDV\Core\Controller\BaseController {

    public function savedata() {
        //check if email already exists
        
        
        \CustomPageControllers\Ajax\Service\FBService::saveData($_POST['useremail'], $_POST['fbuserid'], $_POST['username'], $_POST['userimage']['url'], $_POST['thirdpartyid']);
        $user = \Custompagecontrollers\Loginregister\Service\UserService::getUser($_POST['useremail']);
        if ($user) {
            echo json_encode($user);
        } else {
            echo (json_encode(false));
        }
        exit(0);
    }

    public function saveimage() {
        //be really careful here, check extension of the file to make sure it hasnt been tampered with in javascript
        echo json_encode(\CustomPageControllers\Ajax\Service\FBService::saveImage($_POST['url']));
        exit(0);
    }

}
