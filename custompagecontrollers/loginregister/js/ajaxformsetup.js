

jQuery(function () {


    $("#fakecheckbox").click(function () {
        //perform click on real checkbox
        $('#loginformcontainer input[type=checkbox]').click();
        if ($('#loginformcontainer input[type=checkbox]:checked').length === 1) {
            this.className = "checked";
        }
        if ($('#loginformcontainer input[type=checkbox]:checked').length === 0) {
            this.className = "";
        }
    });
    //styling jquery validation
//    $("input").click(function (e) {
//        if (e.currentTarget.nextSibling.innerHTML !== "") {
//            e.currentTarget.nextSibling.innerHTML = "";
//            e.currentTarget.nextSibling.style = "display:none;";
//        }
//    });



//get all forms and add ajaxsubmitfunction on submit event
    $('#container').on('submit', "form", function (e) {
        if (typeof e.currentTarget.dataset["ajax"] !== "undefined") {
            var ajaxurl = e.currentTarget.dataset["ajax"];
            e.stopPropagation();
            e.preventDefault();
            if (e.currentTarget.name === "userregistration") {
                UserFunc.data = AjaxForm.data
            }
            if (e.currentTarget.name === "userlogin" && e.currentTarget.elements[2].checked) {
                //set cookie
                var now = new Date();
                now.setDate(now.getDate() + 30);
                document.cookie = "useremail=".concat(AjaxForm.data.useremail).concat(';expires=').concat(now.toGMTString()).concat(';');
            }
            if (e.currentTarget.name === "userregistration") {
//               
//                  AjaxForm.submitHandler(e, function () {
//                            UserFunc.loginUser();
//                        })

                //form validation
                $.ajax({url: "/ajax/validate", data: AjaxForm.Data, type: "POST", dataType: "json"}).done(function (data) {
                    if (data.length == 0) {
                        AjaxForm.submitHandler(e, function () {
                            UserFunc.loginUser();
                        })
                    } else {
                        var msg = "Please correct the following fields:\n";
                        for (var i in data) {
                            msg.concat(i.concat("\n"));
                        }
                    }
                })
            } else {
                AjaxForm.submitHandler(e);
            }

        }
        ;
    });

    if (typeof $().validate==="function") {
//form validation
        var loginformrules = {"username": {required: true, minlength: 3}, "userpassword": {required: true, minlength: 10}};
        $('#loginformcontainer>form').validate({rules: loginformrules});

        var registerformrules = {"username": {required: true, minlength: 3}, "userpassword": {required: true, minlength: 10}};
        $('#registerformcontainer>form').validate({rules: registerformrules});
    }


    jQuery(".logoutlink").on("click", function (e) {
        e.preventDefault();
        e.stopPropagation();
        FB.logout(function (response) {
            statusChangeCallback(response);
        });
        return true;
    });













    //<editor-fold defaultstate="collapsed" desc="add instant validation top input fields">

    /**
     * javascript file validatie om server load te vermidneren 
     * TESTEN VOOR CROSSBROWSER
     * http://stackoverflow.com/questions/3717793/javascript-file-upload-size-validation
     * set files to variable 
     * http://abandon.ie/notebook/simple-file-uploads-using-jquery-ajax
     */
    $("#container").on('change', 'input[type=file]', function () {
        if (this.files && this.files[0]) {
            AjaxForm.files = this.files;
            if (window.File && window.FileReader && window.FileList && window.Blob) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    if ($('#uploadbutton .imgholder').length === 1) {
                        $('#uploadbutton .imgholder').remove();
                        $('#uploadbutton').append('<img>');
                        $('#uploadbutton img').css('width', "100%");
                        $('#uploadbutton img').css('height', "100%");
                        $('#uploadbutton img').css('zindex', "30");
                    }
                    $('#uploadbutton img').attr('src', e.target.result);
                };
                reader.readAsDataURL(this.files[0]);
            }
        }
    });
});


// Check for the various File API support.


