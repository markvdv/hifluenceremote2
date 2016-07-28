<?php

namespace Config\Site\Service;

/**
 * service for siteconfiguration
 */
class SiteConfigService {

    /**
     * gets general configuration for site data 
     * @return \Install\Entity\SiteConfig
     */
    public static function getSiteConfig() {
        $siteconfig = \Config\Site\DAO\SiteConfigDAO::getSiteConfig();
        $sitelogo= \MVDV\File\DAO\ImageDAO::getById($siteconfig->getSitelogo());
        return $siteconfig->setDefaultlanguage(\MVDV\Translation\DAO\LanguageDAO::getById($siteconfig->getDefaultlanguage()))->setSitelogo($sitelogo);
    }

    public static function getDefaultLanguage() {
        return \Config\Site\DAO\SiteConfigDAO::getDefaultLanguage();
    }

    public static function getDefaultUrl() {
        return \Config\Site\DAO\SiteConfigDAO::getDefaultUrl();
    }

    public static function getSiteTitle() {
        return \Config\Site\DAO\SiteConfigDAO::getSiteTitle();
    }

    public static function saveSiteConfig($sitetitle, $defaulturl, $loginredirect, $logoutredirect, $notloggedinredirect,$insertedfileid) {
        return \Config\Site\DAO\SiteConfigDAO::updateSiteConfig($sitetitle, $defaulturl, $loginredirect, $logoutredirect, $notloggedinredirect, $insertedfileid);
    }

}
