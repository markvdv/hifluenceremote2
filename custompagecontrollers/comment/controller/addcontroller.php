<?php

namespace CustomPageControllers\Comment\Controller;
class AddController extends \MVDV\Core\Controller\BaseController{

    public function index() {
        
        $comment=\Comment\Service\CommentService::createComment($_POST['commentsubjectid'],$_POST['commentsubjecttype'],$_POST['commenttitle'],$_POST['commenttext']);
       if($comment){
           echo json_encode($comment);
       }
       else{
           echo false;
       }
       exit(0);
    }
    
}
