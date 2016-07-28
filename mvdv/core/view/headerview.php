<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace MVDV\Core\View;

/**
 * Description of headerview
 *
 * @author mark
 */
class HeaderView extends View {

    public function __construct($defaults = array("templatename" => "header", "templatedir" => "\\mvdv\\core\\view\\templates\\general\\", "data" => array('title' => '',"description"=>"","keywords"=>""))) {
        parent::__construct($defaults);
    }

}
