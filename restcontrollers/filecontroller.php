<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace RestControllers;

/**
 * Description of filecontroller
 *
 * @author mark
 */
class FileController extends \REST\Controller\BaseController {

    public function __construct() {
        parent::__construct();
        if ($this->requestmethod === "POST") {
            $errors = \MVDV\File\Service\ImageService::validateImages($_FILES);
            if (empty($errors)) {
                $images = \MVDV\File\Service\ImageService::saveImages($_FILES);
            }
            if (is_object($images[0])) {
                echo json_encode($images);
                exit(0);
            }
            return false;
        }
    }

}
