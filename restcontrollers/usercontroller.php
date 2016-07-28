<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace RestControllers;

/**
 * Description of usercontroller
 *
 * @author mark
 */
class UserController extends \REST\Controller\BaseController {

    public function __construct() {
        parent::__construct();
        if ($this->resourceid === null && $this->requestmethod == "GET" && $this->resource == "user") {
            //retrieve list of users
            echo json_encode(\User\Service\UserService::getUserList());
            exit(0);
        } elseif ($this->resourceid === null && $this->requestmethod == "POST" && $this->resource == "user") {
            //create user using post
            $data = array();
            parse_str(file_get_contents('php://input'), $data); //get data of the request and put it in a array
            
            if (isset($data['userimage']) && is_array($data["userimage"])) {
                $userimage = new \MVDV\File\Entity\Image($data['userimage']);
                $imageid = $userimage->getBasefileid();
            } else {
                $imageid = null;
            }
            if (!isset($data['userfblinked'])) {
                $data['userfblinked'] = 0;
            }
            $user = \User\Service\UserService::createUser($data['username'], $data['useremail'], $data['userpassword'], $imageid, $data['userfblinked']);
            if ($user) {
                echo json_encode(\Custompagecontrollers\Loginregister\Service\UserService::getUser($user->getUserId()));
            }
            exit(0);
        } elseif ($this->resource === "user") {
            parse_str(file_get_contents('php://input'), $data); //get data of the request and put it in a array
//a unique id has been provided so use function of userservice according to request method
            switch ($this->requestmethod) {
                case "GET"://retrieve user with specified id
                    echo json_encode(\Custompagecontrollers\Loginregister\Service\UserService::getUser($this->resourceid));
                    break;
                case "PUT"://editing profile
                    echo json_encode(\Custompagecontrollers\Loginregister\Service\UserService::updateUser($data['username'], $data['useremail'], $data['userfblinked']));
                    break;
                case "DELETE"://delete profile
                    echo json_encode(\User\Service\UserService::deleteUserById($this->resourceid));
                    break;
            }
            exit(0);
        } else {
            echo "This resource has not been found";
            exit(0);
        }
    }

}
