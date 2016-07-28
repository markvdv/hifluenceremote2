<?php

namespace MVDV\Core\Controller;

/**
 * 
 */
class BaseController extends \MVDV\Core\Performance\Logger {

    protected $session;
    protected $post;
//    protected $get;
    protected $server;
    protected $files;
    protected $data;

    /** startupconfig for everything controller 
     * 
     */
    public function __construct() {
        parent::__construct();
        //check on ip if some potential malicious request has come from it before
        
        if (\MVDV\Core\Security\Service\IpLoggerService::checkIpAccess($_SERVER['REMOTE_ADDR'])) {
            $view = new \MVDV\Core\Security\View\URBlockedView();
            $view->render();
            exit(0);
        }
        //checking if $_SESSION variable is set
        if (!isset($_SESSION)) {
            session_start();
        }
        //setting PHP global variables
        $this->session = &$_SESSION;
        $this->post = $_POST;
        $this->files = $_FILES;
        $this->cookie = $_COOKIE;
        $this->server = $_SERVER;
    }

}
