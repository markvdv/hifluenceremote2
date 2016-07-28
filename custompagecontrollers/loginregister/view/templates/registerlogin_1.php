<!--CIRCLES-->
<div id="backgroundcircles">
    <div class="circle xxxs yellow star"></div>
    <div class="circle xxl purple hifluence"></div>
    <div class="circle l royalblue android"></div>
    <div class="circle xxs linkedinblue linkedin"></div>
    <div class="circle l facebookbluecircle facebook"></div>
    <div class="circle m purple hifluence"></div>
    <div class="circle l aquamarijn twitter"></div>
    <div class="circle xs linkedinblue2 linkedin"></div>
    <div class="circle xxl purple"></div>
    <div class="circle xxxl aquamarijn twitter"></div>
    <div class="circle xs aquamarijn"></div>
    <div class="circle s yellow star"></div>
    <div class="circle s greyblue android"></div>
    <div class="circle tussenxsens twitterblue twitter"></div>
</div>
<!--<section>-->

<div id="content">
    <h1>
        <div class="imgholder"><img src="/custompagecontrollers/loginregister/res/img/icons/compose.png"></div>
        <div class="headertext">
            Login To Your Account / Register New 
        </div> 
        <!--tablinks for small screen media-->
    </h1>
    <ul id="tablinks">
        <li class="linkedinblue"><a href="#loginformcontainer">Login </a></li>
        <li class="yellow"><a href="#registerformcontainer">Register</a></li>
    </ul>   
    <div id="registerlogincontainer">
        <!--<h3>Log In</h3>-->
        <div id="loginformcontainer">
            <!--FACEBOOK LOGIN-->
            <button class="fblogin facebookbluelight">
                <!-- fblogo -->
                <div class="fblogo facebookbluedark">
                    <img src="/custompagecontrollers/loginregister/res/img/icons/fb.png">
                </div>
                <!--text-->
                <div class="fblogintext">
                    Login With <em>Facebook</em>
                </div>
            </button>
            <div id="loginseparator">
                <div class="circle greyorsign">
                    /
                </div>
            </div>
            <!--FORM USER LOGIN-->
            <?php $this->blocks["userloginform"]->render(); ?>
        </div> 
        <div id="separator"></div>
        <div id="registerformcontainer">
            <h4>Register</h4>
            <!--FORM USER REGISTER-->
            <?php $this->blocks["useraddform"]->render(); ?>
        </div>   
        <!--USER PROFILE-->
        <div id="userprofile">
            <!--logout button-->
            <?php $this->blocks["userprofile"]->render(); ?>
        </div>
    </div>
</div>
<div id="selectName">
    <h4>Please select the name you want associated to your account for this site:</h4>
    <label>
        (Note: Your answer will be used for logging in to this site without facebook)
    </label>

    <label>Facebook name:</label>
    <button id="fbusername"></button>
    OR 
    <label>Name registered here:</label>
    <button id="siteusername"></button>

</div>
<!--</section>-->



