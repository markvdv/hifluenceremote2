<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace REST\Controller;

/**
 * Description of basecontroller
 *
 * @author mark
 */
class BaseController {

    /**
     *
     * @var resource string "resource" or "domain",here part of the controllername that will call the respective controller
     */
    protected $resource;

    /**
     *
     * @var integer id to find or manipulate a specific resourceitem
     */
    protected $resourceid;

    /**
     *
     * @var string the verb of the http request(get, post, put,delete)
     */
    protected $requestmethod;

    /**
     * prepare variables for extended controller in construct
     */
    public function __construct() {
        $this->requestmethod = $_SERVER['REQUEST_METHOD'];
        $urlparts = array_values(array_filter(explode("/", $_SERVER['REQUEST_URI'])));
        if (count($urlparts) == 2) {
            list($this->resource, $this->resourceid) = $urlparts;
            $this->resourceid = urldecode($this->resourceid);
        } else {
            list($this->resource) = $urlparts;
        }
    }

}
