<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace CustomPageControllers\Ajax\Controller;

/**
 * Controller ofr ajax calls to handle field validation
 *
 * @author mark
 */
class ValidateController extends \MVDV\Core\Controller\BaseController {

    public function index() {
        $form = new \User\View\Form\UserAddFormView();
        echo json_encode($form->validateValues($this->post));
        exit(0);
    }

}
