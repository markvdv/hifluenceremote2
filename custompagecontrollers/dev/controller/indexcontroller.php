<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of indexcontroller
 *
 * @author mark
 */
class indexcontroller {
      // <editor-fold defaultstate="collapsed" desc="tempdev functions">

    public function generateUsers() {
        for ($i = 0; $i < 1000; $i++) {
            $email = substr(md5(rand()), 0, 10) . $i."@".substr(md5(rand()), 0, 10).".".substr(md5(rand()), 0, 10);
            $name = substr(md5(rand()), 0, 10);
            $pw = substr(md5(rand()), 0, 10);
            $tags=array();
            
            
            
            \User\Service\UserService::createUser( $name,$email, $pw,$tags);
        }
    }
    public function generateTags() {
        
    }
    public function generateComments() {
        
    }
// </editor-fold>
}
