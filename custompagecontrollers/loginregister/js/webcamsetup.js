jQuery(function () {
    if ($('#my_camera').length > 0) {//needs better check this fails horribly

        Webcam.init();
        //check if flash or chrome and possible flash
        Webcam.set({
            width: 320,
            height: 240,
            image_format: 'jpeg',
            jpeg_quality: 90,
            upload_name: "0"
        });
        Webcam.attach('#my_camera');
        console.log($('#snapshot'))
        $('#snapshot').click(function () {
            document.getElementById("webcamui").style.display = "block";
//    takeSnapshot();
        });
    }
    jQuery('.closebutton').on('click',function(e){
        e.currentTarget.parentNode.style.display="none";
    })
})

function takeSnapshot() {
    // take snapshot and get image data
    Webcam.snap(function (data_uri, canvas, context) {
        if ($('#uploadbutton .imgholder').length === 1) {
            $('#uploadbutton .imgholder').remove();
            $('#uploadbutton').append('<img>');
            $('#uploadbutton img').css('width', "100%");
            $('#uploadbutton img').css('height', "100%");
            $('#uploadbutton img').css('zindex', "30");
        }
        $('#uploadbutton img').attr('src', data_uri);

        //keep data till it needs to be uploaded
        AjaxForm.files = data_uri;

        document.getElementById("webcamui").style.display = "none";

    });

}




