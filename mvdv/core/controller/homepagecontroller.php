<?php

namespace MVDV\Core\Controller;

class HomePageController extends BaseController {

    public function __construct() {
        //uit database homepagecontroller name ophalen en index gebruiken
        $defaulturl=\Config\Site\Service\SiteConfigService::getDefaultUrl();
        if ($defaulturl) {
            header('location:' . $defaulturl);
        }
        echo 'u havent set a homepageurl yet';
        exit(0);
    }

}
