<?php

namespace Config\Site\Entity;

/**
 * entity for siteconfiguration holds data like title, redirecturls for (non)loggedin, homepageurl,...
 */
class SiteConfig extends \MVDV\Core\Entity\BaseEntity {

    /**
     *
     * @var string the default homepage urlto redirect to 
     */
    protected $defaulturl;

    /**
     *
     * @var string url to redirect to after logging in 
     */
    protected $loginredirect;

    /**
     *
     * @var string url to redirect to after logging out 
     */
    protected $logoutredirect;

    /**
     *
     * @var string url to redirect to when users open a page that needs authorization and they are not authorized yet
     */
    protected $notloggedinredirect;

    /**
     *
     * @var string title of the site in general to be appended on every view
     */
    protected $sitetitle;
    protected $defaultlanguage;

    /**
     *
     * @var type 
     */
    protected $sitelogo;

    function getDefaulturl() {
        return $this->defaulturl;
    }

    function getLoginredirect() {
        return $this->loginredirect;
    }

    function getLogoutredirect() {
        return $this->logoutredirect;
    }

    function getNotloggedinredirect() {
        return $this->notloggedinredirect;
    }

    function setDefaulturl($defaulturl) {
        $this->defaulturl = $defaulturl;
        return $this;
    }

    function setLoginredirect($loginredirect) {
        $this->loginredirect = $loginredirect;
        return $this;
    }

    function setLogoutredirect($logoutredirect) {
        $this->logoutredirect = $logoutredirect;
        return $this;
    }

    function setNotloggedinredirect($notloggedinredirect) {
        $this->notloggedinredirect = $notloggedinredirect;
        return $this;
    }

    function getSitetitle() {
        return $this->sitetitle;
    }

    function getDefaultlanguage() {
        return $this->defaultlanguage;
    }

    function setSitetitle($sitetitle) {
        $this->sitetitle = $sitetitle;
        return $this;
    }

    function setDefaultlanguage($defaultlanguage) {
        $this->defaultlanguage = $defaultlanguage;
        return $this;
    }

    function getSitelogo() {
        return $this->sitelogo;
    }

    function setSitelogo($sitelogo) {
        $this->sitelogo = $sitelogo;
        return $this;
    }

}
