<div id="siteconfigcontainer">
    <label>Site Base Title</label>
    <div>
        <?php echo $this->data['siteconfig']->getSitetitle()?>
    </div>
    <div>
        <?php echo $this->data['siteconfig']->getDefaultlanguage()->getLanguagename()?>
    </div>
    <label>Site Defaulturl</label>
    <div>
        <?php echo $this->data['siteconfig']->getDefaulturl()?>
    </div>
    <label>Site Defaulturl for not logged in users</label>
    <div>
        <?php echo $this->data['siteconfig']->getNotloggedinredirect()?>
    </div>
    <label>Site Defaulturl redirect after logging in</label>
    <div>
        <?php echo $this->data['siteconfig']->getLoginredirect()?>
    </div>
    <label>Site Defaulturl redirect after logging out</label>
    <div>
        <?php echo $this->data['siteconfig']->getLogoutredirect()?>
    </div>
    <label>Site Logo</label>
    <img src="<?php echo $this->data['siteconfig']->getSitelogo()->getBasefilepath()."/".$this->data['siteconfig']->getSitelogo()->getBasefilename()?>">
</div>
