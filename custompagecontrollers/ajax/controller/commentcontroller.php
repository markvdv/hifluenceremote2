<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace CustomPageControllers\Ajax\Controller;

/**
 * Description of commentcontroller
 *
 * @author mark
 */
class CommentController extends \MVDV\Core\Controller\BaseController{

    public function newComment() {
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        $comment=\Comment\Service\CommentService::getById($this->post["commentid"]);
        
        $view = new \Comment\View\Block\CommentBlock();
        $view->setData(array("comment"=>$comment));
        $view->render();
        exit(0);
    }
    
}
