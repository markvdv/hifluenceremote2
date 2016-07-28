
/**
 * 
 * @object  custom object to namespace and group ajax call for user functionality
 */
var UserFunc = {
    data: {},
    /**
     * checks if email is already in the database, if not it creates a new account
     * if the email is present it will present the user witrh a choice for the username if they are different
     */
    loginUser: function () {
        jQuery.ajax(
                {url: "/ajax/login/loginFB",
                    data: UserFunc.data,
                    method: "POST",
                    dataType: "json"
                }

        ).done(function (data) {
            if (data) {
                var parseddata = JSON.parse(data);
                window.location.href = "/account/" + parseddata.userid;
            }
        })
    },
    logoutUser: function () {
        jQuery.ajax(
                {url: "/ajax/login/logout",
                    data: UserFunc.data,
                    method: "POST",
                    dataType: "json"
                }

        )
    },
    /**
     * creates a new user via ajax/rest call
     * 
     */
    createUser: function () {
        jQuery.ajax({
            url: "/user/",
            method: "POST",
            data: UserFunc.data,
            dataType: "json"
        }).done(function (data) {
            UserFunc.data = JSON.parse(data);
            if (window.location.href.indexOf("account" === false)) {
                UserFunc.loginUser();
            }
        });
    },
    /**
     * updates username if facebook username and database username arent the same
     * @returns {undefined}
     */
    updateUser: function () {
        jQuery.ajax({
            url: "/user/",
            method: "PUT",
            dataType: "json",
            data: UserFunc.data
        }).done(function (data) {
            console.log(data);
            if (data) {
                if (window.location.href.indexOf("account" === false)) {
                    UserFunc.loginUser();
                }

            } else {
                alert('something went wrong please try again');
            }
        });
    },
    /**
     * allow user to select the name he wants to use for this site when logging in
     * @param {obj} dbdata: data received from database
     * @returns {undefined}
     */
    showSelectName: function (dbdata) {
        jQuery('form[name=selectdata] input').unbind('click');
        //name options
        jQuery('form[name=selectdata] input')[0].nextElementSibling.innerHTML = this.data.username;
        jQuery('form[name=selectdata] input')[1].nextElementSibling.innerHTML = dbdata.username;
//        jQuery('form[name=selectdata] input')[2].nextElementSibling.firstElementChild.src = UserFunc.data.userimage.url;
//        jQuery('form[name=selectdata] input')[3].nextElementSibling.firstElementChild.src = dbdata.userimage.basefilepath.concat('/').concat(dbdata.userimage.basefilename);
        jQuery("#selectName").on('submit', 'form', function (e) {
            e.stopPropagation();
            e.preventDefault();
            for (var i = 0; i < e.currentTarget.elements.length; i++) {
                if (e.currentTarget.elements[i].type == "checkbox" && e.currentTarget.elements[i].checked) {
                    //if the selected value is FB we chnage the respectieve field of data thats connected to the site            
                    if (e.currentTarget.elements[i].value === "FB") {
                        dbdata[e.currentTarget.elements[i].name] = UserFunc.data[e.currentTarget.elements[i].name];
                    }
                }
            }
            dbdata.userfblinked = "1";
            UserFunc.data = dbdata;
            UserFunc.updateUser(function () {
                UserFunc.loginUser();
            });
            document.getElementById('selectName').style = "display:none;";
        });
        document.getElementById('selectName').style = "display:block;";
    },
    getFBUserdata: function (callback) {
        /* make the API calls, we can make calls using "me" as the userid since the user is loggedin to facebook at this point */
        FB.api('/me', {fields: "id,name,email,third_party_id"}, function (response) {
            if (response && !response.error) {/* handle the result */
                UserFunc.data.username = response.name;
                UserFunc.data.useremail = response.email;
                UserFunc.data.fbuserid = response.id;
                UserFunc.data.thirdpartyid = response.third_party_id;
                callback();
            }
        })
    },
    getFBUserImage: function (callback) {
        FB.api("/me/picture", function (response) {
            if (response && !response.error) {/* handle the result */
                UserFunc.data.userimage = {};
                UserFunc.data.userimage.url = response.data.url;
                callback();
            }
        });
    },
    saveFBUserImage: function (callback) {
        $.ajax({
            url: "/ajax/fb/saveimage",
            method: "post",
            dataType: "json",
            data: {url: UserFunc.data.userimage.url}
        }).done(function (data) {
            UserFunc.data.userimage = data;
            callback(data);
        });
    },
    saveFBData: function () {
        jQuery.ajax({
            url: "/ajax/fb/savedata",
            data: UserFunc.data,
            dataType: "json",
            method: "POST"
        }).done(function (data) {
            //if the user has loggedin with facebook the UserFunc.data is the Facebook data structured to comply with normal site login, we can tell by checking the structure of UserFunc.data.image whether or not this is a facebooklogin 
            //search for email in database if its exists if so retrieve it and compare the data
            if (data) {
                var parseddata = JSON.parse(data);
                //compare received data from database with facebook data
                if (UserFunc.data.username !== parseddata.username && parseddata.userfblinked === "0") {//in this case only the username being different is important, if it is present a possibility to change it
                    UserFunc.showSelectName(parseddata);
                }
                UserFunc.loginUser();
            } else {
                //create a user since the email address doesnt exist in the database
                UserFunc.saveFBUserImage(function () {
                    UserFunc.createUser();
                })
            }
        });
    }
};




// This is called with the results from from FB.getLoginStatus().
function statusChangeCallback(response) {
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if (response.status === 'connected') {
        // Logged into your app and Facebook.

        //handle facebook data and save/update it
        //unbind and rebind click event with proper callback function
        jQuery(".fblogin").unbind("click");
        jQuery(".fblogin").on("click", function () {
            FB.logout(function (response) {
                statusChangeCallback(response);
            });
        });
        FBLoggedin();
        //change text of login button
        if (typeof document.getElementsByClassName("fblogintext")[0] !== "undefined") {

            document.getElementsByClassName("fblogintext")[0].innerHTML = "Logout From <em>Facebook</em>";
        }
    } else if (response.status === 'not_authorized') {
        // The person is logged into Facebook, but not your app.


        //is dees nodig in dit geval?
        jQuery(".fblogin").unbind("click");
        jQuery(".fblogin").on("click", function () {
            FB.logout(function (response) {
                statusChangeCallback(response);
            });
        });
        //change text of login button
        if (typeof document.getElementsByClassName("fblogintext")[0] !== "undefined") {
            document.getElementsByClassName("fblogintext")[0].innerHTML = "Logout From <em>Facebook</em>";
        }
    } else {
        // The person is not logged into Facebook, so we're not sure if
        // they are logged into this app or not.

        //unbind and rebind click event with proper callback function
        jQuery(".fblogin").unbind("click");
        jQuery(".fblogin").on("click", function () {
            FB.login(function (response) {
                statusChangeCallback(response);
            });
        });
        //change text of login button
        if (typeof document.getElementsByClassName("fblogintext")[0] !== "undefined") {
            document.getElementsByClassName("fblogintext")[0].innerHTML = "Login With <em>Facebook</em>";
        }
    }
}


/**
 * handles the facebook data after a facebook login, then checks if the email address exists in the database
 */
function FBLoggedin() {
//get facebook data and save it 
    UserFunc.getFBUserImage(function () {
        UserFunc.getFBUserdata(function () {
            UserFunc.saveFBData();
        });
    });
}

//setup facebook SDK to work with jQuery
jQuery(function () {
    jQuery.ajaxSetup({cache: true}); //set cache to true to avoid uncached facebook sdk between calls;
    jQuery.getScript('//connect.facebook.net/en_US/sdk.js', function () {
        FB.init({
            appId: '1679228502299736',
            version: 'v2.6', // or v2.0, v2.1, v2.2, v2.3
            cookie: true, // enable cookies to allow the server to access 
            // the session
            xfbml: true, // parse social plugins on this page
        });
//        FB.getLoginStatus(function (response) {
//            statusChangeCallback(response)
//        }, true);
        jQuery(".fblogin").on("click", function () {
            FB.login(function (response) {
                statusChangeCallback(response);
            });
        });
    });

})