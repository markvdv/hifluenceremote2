

var AjaxForm = {
    uploadurl: "/file/",
    files: {},
    data: {},
    event: {},
    /**
     * //prepares the AjaxForm.data before submitting the form
     * @param {element} form
     */
    prepareData: function (form) {
        this.data={};
        for (var i = 0; i < form.elements.length; i++) {
            //check if element has multiple enabled
//            if (form.elements[i].type === "file") {
//                this.files = form.elements[i].files;
//            }
            if (form.elements[i].multiple === false) {
                this.data[ form.elements[i].name] = form.elements[i].value;
            }
            if (form.elements[i].tagName === "SELECT") {
                this.data[ form.elements[i].name] = [];
                for (var j = 0; j < form.elements[i].options.length; j++) {
                    if (form.elements[i].options[j].selected === true) {
                        this.data[ form.elements[i].name].push(form.elements[i].options[j].value);
                    }
                }
            }
            if (form.elements[i].tagName === "TEXTAREA") {
                this.data[ form.elements[i].name] = form.elements[i].value;
            }
        }
    }
    ,
    /**
     * ajax file upload source http://abandon.ie/notebook/simple-file-uploads-using-jquery-ajax
     * @param {type} string
     * @returns {undefined}
     * 
     */
    uploadFiles: function (callback) {

// Create a formdata object and add the files
        if (this.files)
            var data = new FormData();
        $.each(this.files, function (key, value) {
            data.append(key, value);
        });
        $.ajax({
            context: this,
            url: this.uploadurl,
            type: 'POST',
            data: data,
            cache: false,
            dataType: 'json',
            processData: false, // Don't process the files
            contentType: false // Set content type to false as jQuery will tell the server its a query string request
        }).done(function (data) {
            if (data) {
                AjaxForm.files = {};
                AjaxForm.data.userimage = data[0];
                callback();
            }
        }
        ).error(function (a, b, c) {
            console.log(a);
            console.log(b);
            console.log(c);
        });
    },
    submit: function (callback) {
        var url = AjaxForm.event.currentTarget.dataset["ajax"];
        $.ajax({
            url: url,
            data: AjaxForm.data,
            dataType: 'json',
            type: "POST",
        }).error(function (a, b, c) {
            console.log(a);
            console.log(b);
            console.log(c);
        }).done(function (data) {
            if (data) {
                if (typeof data === "object") {
                    AjaxForm.data = data;
                } else {
                    AjaxForm.data = JSON.parse(data);
                }
                if (callback) {
                    callback(data);
                }
//                console.log(AjaxForm.data.userid)
//                window.location.href = "/account/" + AjaxForm.data.userid;
//            var jsondata = JSON.parse(data);
//            if (this.files instanceof FileList === true && this.files.length > 0) {
//                var files = this.data['files'];
//            }
//
//            this.data = jsondata;
//            if (this.files instanceof FileList === true && this.files.length > 0) {
//                this.data.userimage = files[0];
//            }
            }
        });

    },
    submitHandler: function (e, callback) {
        e.stopPropagation(); // Stop stuff happening
        e.preventDefault();
        AjaxForm.event = e;
        this.prepareData(e.currentTarget);
        if (AjaxForm.files instanceof FileList === true && AjaxForm.files.length > 0) {
            AjaxForm.uploadFiles(
                    function () {
                        AjaxForm.submit(callback);
                    }
            );
        } else if (typeof AjaxForm.files === "string") {//needs better checking
            //data uri from webcam, webcam.js auto changes the data uri to a file structure and copy paste
            AjaxForm.webcamUploadHandler(
                    function () {
                        AjaxForm.submit(callback);
                    }
            );
        } else {
            //normal login
            AjaxForm.submit(callback);
        }
    },
    webcamUploadHandler: function (callback) {
        Webcam.upload(this.files, "/file/", function (code, data) {
            if (data) {
                var parseddata = JSON.parse(data);
                AjaxForm.files = {};
                AjaxForm.data.userimage = parseddata[0];
                callback();
            }
        });
    }
};


