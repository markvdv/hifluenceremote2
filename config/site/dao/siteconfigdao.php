<?php

namespace Config\Site\DAO;

/**
 * Data access object for site configuration entities
 */
class SiteConfigDAO extends \MVDV\Core\DAO\DAO {

    /**
     * gets general configuration for site data
     * @return \Install\Entity\SiteConfig
     */
    public static function getSiteConfig() {
        $sql = "SELECT defaulturl,loginredirect,logoutredirect,notloggedinredirect,sitetitle,defaultlanguage,sitelogo FROM siteconfig";
        $result = parent::execPreppedStmt($sql)->fetch(\PDO::FETCH_ASSOC);
        return new \Config\Site\Entity\SiteConfig($result);
    }

    public static function getDefaultLanguage() {
        $sql = "SELECT * FROM siteconfig left join language on defaultlanguage=language.languageid";
        $siteconfig = new \Config\Site\Entity\SiteConfig(parent::execPreppedStmt($sql)->fetch(\PDO::FETCH_ASSOC));
        return $siteconfig->getDefaultLanguage();
    }

    public static function getDefaultUrl() {
        $sql = "SELECT defaulturl FROM siteconfig";
        $siteconfig = new \Config\Site\Entity\SiteConfig(parent::execPreppedStmt($sql)->fetch(\PDO::FETCH_ASSOC));
        return $siteconfig->getDefaulturl();
    }
    public static function getSiteTitle() {
        $sql = "SELECT sitetitle FROM siteconfig";
        $siteconfig = new \Config\Site\Entity\SiteConfig(parent::execPreppedStmt($sql)->fetch(\PDO::FETCH_ASSOC));
        return $siteconfig->getSiteTitle();
    }
    public static function updateSiteConfig($sitetitle,$defaulturl,$loginredirect,$logoutredirect,$notloggedinredirect,$sitelogo) {
        $sql="UPDATE siteconfig set sitetitle=?, defaulturl=?,loginredirect=?,logoutredirect=?,notloggedinredirect=?,sitelogo=?";
        return parent::execPreppedStmt($sql, func_get_args())->rowCount();
    }
}
