<?php

/*
 * pageviews should be able to render viewblocks in their respective locations, 
 * in order to achieve this a page template is needed which contains the 
 * containerblocks id'd with the viewblocknames, this will allow for easier styling and overriding
 * views will ad their templatefiles to the viewfactory static variables
 */

namespace MVDV\Core\View\Page;

/**
 * Description of basepageview
 *
 * @author mark
 */
class BasePageView extends \MVDV\Core\View\BaseView {


    public function __construct() {
                \MVDV\Core\View\HeaderView::create()->render();
    //    \MVDV\Example\View\Block\ExampleBlockView::create(array('data' => array('example' => "this example data is rendered in a page")))->render();
        \MVDV\Core\View\Block\Menu\BaseMenuView::create()->setLinks(array('name'=>""))->render();
        \MVDV\Example\View\Form\ExampleFormView::create()->render();
        \MVDV\Core\View\FooterView::create()->render();
//        \MVDV\Core\ViewFactory\ViewFactory::$data['title']=$pagetitle;
//        \MVDV\Core\ViewFactory\ViewFactory::$templateMap["page"]["BasePageView"]["templatename"]="content";
//        \MVDV\Core\ViewFactory\ViewFactory::$templateMap["page"]["BasePageView"]["templatedir"]="/mvdv/core/templates/page/";
    }
}
