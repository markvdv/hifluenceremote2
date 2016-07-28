jQuery(function () {
    if (typeof $("#content").tabs('instance')=== "undefined"&&jQuery('#tablinks').css("display")!=="none") {
        $("#content").tabs();
    }
    jQuery(window).resize(function () {
        if (typeof $("#content").tabs('instance')=== "undefined"&&jQuery('#tablinks').css("display")!=="none") {
            $("#content").tabs();
        }else if (jQuery('#tablinks').css("display")==="none"&&typeof $("#content").tabs('instance')!== "undefined"){
            $("#content").tabs("destroy");
            
        }
    });
});