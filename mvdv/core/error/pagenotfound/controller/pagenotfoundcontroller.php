<?php

namespace MVDV\Core\Error\PageNotFound\Controller;

class PageNotFoundController extends \MVDV\Core\Controller\BaseController {

    public function __construct($url, $ip) {
        parent::__construct();
        self::log404($url, $ip);
        //set header to 404 responsecode 
        header("HTTP/1.0 404 Not Found");
        //header("status 404 Not Found");
        $header = new \MVDV\Core\View\HeaderView();
        $header->render();
        $content = new \MVDV\Core\Error\PageNotFound\View\Block\PageNotFoundView($url);
        $content->render();
        $footer = new \MVDV\Core\View\FooterView();
        $footer->render();
        exit(0);
    }

}
