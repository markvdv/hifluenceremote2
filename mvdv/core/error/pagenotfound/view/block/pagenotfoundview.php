<?php
namespace MVDV\Core\Error\PageNotFound\View\Block;
class PageNotFoundView extends \MVDV\Core\Error\View\Block\ErrorView{
 public function __construct($url,$defaults = array("templatename" => "pagenotfound", "templatedir" => "\\mvdv\\core\\error\\pagenotfound\\view\\templates\\block\\", "data" => array('title' => 'Page Not Found!!!'))) {
     parent::__construct($defaults);
     $this->data['url']=$url;
    }
}
