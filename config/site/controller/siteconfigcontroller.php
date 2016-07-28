<?php

namespace Config\Site\Controller;

class SiteconfigController extends \MVDV\Core\Controller\BaseController{

    public function index() {
        $siteconfig= \Config\Site\Service\SiteConfigService::getSiteConfig();
        \Config\Site\View\Block\SiteconfigView::create()->setData(array("siteconfig"=>$siteconfig))->render();
       // \MVDV\Core\View\ImageView::create()->setImage($siteconfig->getSitelogo())->render();
        exit(0);
    }
    
    
    public function edit() {
        \MVDV\Example\View\ExampleHeaderView::create()->render();
        \Config\Site\View\Form\SiteconfigFormView::create()->render(\Config\Site\Service\SiteConfigService::getSiteConfig());
        \MVDV\Core\View\FooterView::create()->render();
        exit(0);
    }

    public function editpost() {
        echo "<pre>";
        var_dump($this->post);
        echo "</pre>";
        echo __LINE__ . "<br>" . __FILE__ . "<br>";
        $test=\Config\Site\Service\SiteConfigService::saveSiteConfig($this->post['sitetitle'],$this->post['defaulturl'],$this->post['loginredirect'],$this->post['logoutredirect'],$this->post['notloggedinredirect'],$this->post['lastinsertids'][0]);
        echo "<pre>";
        var_dump($test);
        echo "</pre>";
        echo __LINE__ . "<br>" . __FILE__ . "<br>";
        exit(0);
    }

}
