<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Comment\View\Block;

/**
 * Description of commentblock
 *
 * @author mark
 */
class CommentBlock extends \MVDV\Core\View\View{

        public function __construct($defaults = array("templatename" => "commentblock", "templatedir" => "\\comment\\view\\templates\\block\\")) {
        parent::__construct($defaults);
    }
    
    
}
