<?php
namespace Config\Site\View\Block;
class SiteconfigView extends \MVDV\Core\View\View{

    public static function create($viewconfig=null, $defaults=array("templatedir"=>"/config/site/view/templates/block/","templatename"=>"siteconfig")) {
        return parent::create($viewconfig, $defaults);
    }
    
    
}
