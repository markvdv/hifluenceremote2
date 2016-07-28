<div>
    <label>
        User Profile Picture
    </label>
    <div id="userimage">
        <img src="
        <?php if($this->data['user']->getUserimage()){echo $this->data['user']->getUserimage()->getImagepath();} ?>
             ">
    </div>
</div>
<div>
    <label>
        User ID
    </label>
    <div id="userid">
        <?php echo $this->data['user']->getUserid(); ?>
    </div>
</div>
<div>
    <label>
        User Time Created
    </label>
    <div id="usertimestamp">
        <?php echo $this->data['user']->getUsertimestamp(); ?>
    </div>
</div>
<div>
    <label>
        User Name
    </label>
    <div id="username">
        <?php echo $this->data['user']->getUsername(); ?>
    </div>
</div>
<div>
    <label>
        User Email
    </label>
    <div id="useremail">
        <?php echo $this->data['user']->getUseremail(); ?>
    </div>
</div>