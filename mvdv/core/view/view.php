<?php

/**
 * BaseView : baseclass that shouldbe derived from to make a view class
 */

namespace MVDV\Core\View;

class View extends \MVDV\Core\Performance\Logger {

    /**
     *
     * @var array data to display/use in the template
     */
    protected $data;

    /**
     *
     * @var string name of the template file to use in the view
     */
    protected $templatename;

    /**
     *
     * @var string directory of the templatefile 
     */
    protected $templatedir;

    /**
     *
     * @var array default values (templatename,templatedir,data) of the view 
     */
    private $defaults;

    /**
     *
     * @var array adds javascript files with keys header and footer, each an associative array as well in this structure, e.g."jquery"=>"jquerydir+filename" 
     *              being a static variable every view can easily add to it altho a dump of the variable is needed to see if the same javascript hasnt been included yet
     */
    protected static $js = array();

    /**
     *
     * @var array adds css files to the header of the HTML output
     *              being a static variable every view can easily add to it
     */
    protected static $css = array();

    /**
     * 
     * @param array $viewconfig
     * @param array $defaults
     */
    function __construct($defaults) {
        parent::__construct();
        foreach ($defaults as $key => $value) {
            $this->{$key} = $value;
        }
        if (!isset(self::$js['header'])) {
            self::$js['header'] = array();
            self::$js['footer'] = array();
        }
    }

//    /**
//     * 
//     * @param array $viewconfig
//     * @param array $defaults
//     * @return array 
//     */
//    public static function create($viewconfig = null, $defaults = null) {
//        $defaults['viewname'] = get_called_class();
//        if (!isset(self::$idMap[$defaults['viewname']]) || $viewconfig !== null) {
//            self::$idMap[$defaults['viewname']] = new $defaults['viewname']($viewconfig, $defaults);
//        }
//        return self::$idMap[$defaults['viewname']];
//    }
//
    /**
     * renders the view
     */
    public function render() {
      include str_replace("\\","/",$_SERVER['DOCUMENT_ROOT'] . $this->templatedir . $this->templatename) . ".php";
    }
// <editor-fold defaultstate="collapsed" desc="(GET&&SET)TERS">

    function getViewname() {
        return $this->viewname;
    }

    function getData() {
        return $this->data;
    }
    function getTemplatename() {
        return $this->templatename;
    }

    function getTemplatedir() {
        return $this->templatedir;
    }

    function getDefaults() {
        return $this->defaults;
    }

    static function getJs() {
        return self::$js;
    }

    static function getCss() {
        return self::$css;
    }

    function setViewname($viewname) {
        $this->viewname = $viewname;
        return $this;
    }

    function setData($data) {
        $this->data = $data;
        return $this;
    }

    static function setIdMap($idMap) {
        self::$idMap = $idMap;
        return self;
    }

    function setTemplatename($templatename) {
        $this->templatename = $templatename;
        return $this;
    }

    function setTemplatedir($templatedir) {
        $this->templatedir = $templatedir;
        return $this;
    }

    function setDefaults($defaults) {
        $this->defaults = $defaults;
        return $this;
    }

    static function setJs($js) {
        self::$js = $js;
        return self;
    }

    static function setCss($css) {
        self::$css = $css;
        return self;
    }
// </editor-fold>
}
