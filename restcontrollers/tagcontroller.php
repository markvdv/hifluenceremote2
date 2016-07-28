<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace RestControllers;

class TagController extends \REST\Controller\BaseController {

    public function __construct() {
        
            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            error_reporting(E_ALL);
        parent::__construct();
        if ($this->resourceid === null && $this->requestmethod == "GET" && $this->resource == "tag") {
            //retrieve list of users
            echo json_encode(array_values(\Taxonomy\Service\TagService::getTagList()));
            exit(0);
        }
        if ($this->resourceid === null && $this->requestmethod == "POST" && $this->resource == "tag") {
            //create a new tag   
            $data = array();
            parse_str(file_get_contents('php://input'), $data);
            echo json_encode(\Taxonomy\Service\TagService::createTag($data['tagname'],$data['entityid'],$data["entitytype"]));
            exit(0);
        }
    }

}
