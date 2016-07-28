<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace MVDV\Core\View\Table;

/**
 * Description of basetableview
 *
 * @author mark
 */
class BaseTableView extends \MVDV\Core\View\View {

    protected $dataatributes;
    protected $columnnames;
    protected $ajaxurl;

    public function __construct($viewconfig=null, $defaults=null) {
        if (!isset(self::$js['footer']["datatables"])) {
            self::$js['footer']["datatables"] = "/mvdv/core/js/jquery/datatables-1.10.10/media/js/jquery.dataTables.min.js";
            self::$js['footer']["datatablessetup"] = "/mvdv/core/js/custom/fancytables.js";
        }
        parent::__construct($viewconfig, $defaults);
        $this->columnnames = [];
        $this->dataattributes = [];
        
        }
    public static function create($viewconfig = null, $defaults = array('templatedir' => "/mvdv/core/view/templates/block/table/", "templatename" => "table")) {
        return parent::create($viewconfig, $defaults);
    }

}
