<?php

/**
 * maybe a factory function to handle rest calls?
 */

namespace MVDV\Core\App;

/**
 * this class the requested url and instantiates the corresponding controller object if it exists or else returns page not found, if url is empty it defaults to set homepageurl
 */
class Bootstrap extends \MVDV\Core\Performance\Logger {
    /**
     *
     * @var string parts of the url that represent classname, methodname, etc,..
     */
    private static $folder, $controller, $method, $fullControllerName,$param;

    public function __construct($url) {
     
        // Script start//for debugging
        parent::__construct();
        if ($url === "/") {//if url not empty then pagenotfound error, else redirect to set homepage
            new \MVDV\Core\Controller\HomePageController(); //gets default url if it is set
            exit(0);
        }
    
        $urlParts = array_values(array_filter(explode("/", $url))); //explode url on / to get namesapce, module, controller and function names
        if (count($urlParts) == 1) {
            list(self::$folder) = $urlParts;
            self::$controller = "index";
        } else if (count($urlParts) == 2 && strpos(urldecode($urlParts[1]), " ") === false &&!is_numeric($urlParts[1])) {
            list(self::$folder, self::$controller) = $urlParts;
        } else if (count($urlParts) == 2 && (strpos(urldecode($urlParts[1]), " ") !== false || is_numeric($urlParts[1]))) {
            list(self::$folder, self::$param) = $urlParts;
            self::$controller = "index";
            self::$param=  urldecode(self::$param);
        } else if (count($urlParts) == 3) {
            list(self::$folder, self::$controller, self::$method) = $urlParts;
        }

        // <editor-fold defaultstate="collapsed" desc="SETTING CONTROLLERCLASSNAME">
        if (is_file($_SERVER['DOCUMENT_ROOT'] . "/custompagecontrollers/" . self::$folder . "/controller/" . self::$controller . "controller.php")) {
            self::$fullControllerName = "\\custompagecontrollers\\" . self::$folder . "\\controller\\" . self::$controller . "controller";
        } elseif (is_file($_SERVER['DOCUMENT_ROOT'] . "/restcontrollers/" . self::$folder . "controller.php")) {
            self::$fullControllerName = "\\restcontrollers\\" . self::$folder . "controller";
        } elseif (is_file($_SERVER['DOCUMENT_ROOT'] . "/mvdv/" . self::$folder . "controller.php")) {
            self::$fullControllerName = "\\mvdv\\" . self::$folder . "controller";
        } else {
            self::$fullControllerName = "";
        }

        // </editor-fold>
        // <editor-fold defaultstate="collapsed" desc="CONTROLLER INSTANTIATION">
        if (self::$fullControllerName !== "") {
            $controller = new self::$fullControllerName();
            //catching otehr fnctions defined in the controller for normal page loads
            if (isset(self::$method) && method_exists($controller, self::$method)) {
                $controller->{self::$method}();
                exit(0);
            } else {
                $controller->index(self::$param);
                exit(0);
            }
            new self::$fullControllerName();
            exit(0);
        }
        new \MVDV\Core\Error\PageNotFound\Controller\PageNotFoundController($url, $_SERVER['REMOTE_ADDR']);
                echo "GOOD HERE";
die;
        exit(0);
        // </editor-fold>
    }

}
