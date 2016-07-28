<?php

namespace CustomPageControllers\LoginRegister\Controller;

class DEVController extends \MVDV\Core\Controller\BaseController {

    public function userprofile() {
        $data = array();
        $data['user'] = \Custompagecontrollers\Loginregister\Service\UserCommentService::getUserprofileAndComments('17');
        echo PHP_EOL;
        var_dump($data);
        echo PHP_EOL;
        echo "on line: " . __LINE__ . ", in file: " . __FILE__ . PHP_EOL;
        $view = new \User\View\Block\UserProfileViewBlock();
        $view->setData($data);
        $view->render();
        exit(0);
    }

    public function usercommenttagtest() {

        //profilepageblock to be called in ajax call and replace the formcontainer
         $user= \Custompagecontrollers\Loginregister\Service\UserCommentService::getUserprofileAndComments("17");   
        
        $view = new \User\View\Block\UserProfileViewBlock();
        $view->setData(array("user" => $user));
        $view->render();
        exit(0);
    }

    public function generateUsers($number = 100) {
        for ($i = 0; $i < $number; $i++) {
            $useremail = "SomeoneNr" . $i . "@" . substr(md5(rand()), 0, 10) . "emailprovider.com";
            $username = substr(md5(rand()), 0, 10);
            $userpassword = substr(md5(rand()), 0, 10);
            $userimage = null;
            \User\Service\UserService::createUser($username, $useremail, $userpassword, $userimage);
        }
    }

    public function generateTags($number = 30) {
        for ($i = 0; $i < $number; $i++) {
            $tagname = substr(md5(rand()), 0, 10);
            \Taxonomy\DAO\TagDAO::insert($tagname);
        }
    }

    public function generateComments($number = 30) {
        for ($i = 0; $i < $number; $i++) {
            $commenttitle = substr(md5(rand()), 0, 10);
            $commenttext = "";
            for ($i = 0; $i < rand(0, 10); $i++) {
                $commenttext.=PHP_EOL . substr(md5(rand()), 0, 10) . PHP_EOL;
            }
            //insert comment in db
            \Comment\DAO\CommentDAO::insert($commenttitle, $commenttext, 17, 17, "user");
        }
    }

}
