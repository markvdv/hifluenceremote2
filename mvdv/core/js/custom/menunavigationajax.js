var MenuFunctionality = function () {
    /**
     * 
     * @param {type} e
     * @param {type} context
     * @returns {undefined}
     */
    this.ajaxNavigation = function (e, context) {
        e.preventDefault();
        jQuery.ajax({
            url: e.currentTarget,
            type: "POST",
            context: jQuery(context)
        }).done(function (data) {
            this.empty();
            this.append(data);
        });
    }
}
jQuery(function () {

    /**
     * event test with mutation object
     * 
     */

// create an observer instance
//    var observer = new MutationObserver(function (mutations) {
//        mutations.forEach(function (mutation) {
//            console.log(mutation.type);
//            alert(1)
//        });
//    });
//
//// configuration of the observer:
//    var config = {attributes: true, childList: true, characterData: true};
//    observer.observe(document.getElementById("content"), config);
////turn off observation
//    observer.disconnect();


var menufunc= new MenuFunctionality();



    jQuery('#container').on('click', 'nav#contextmenu a', function (e) {//subpage navigation
        menufunc.ajaxNavigation(e, "#content");
    });
    //CLEAN THIS SHIT UP!!!
    jQuery('#container').on('click', 'nav#mainmenu a', function (e) {//page navigation
        menufunc.ajaxNavigation(e, "#container");
        document.title = e.currentTarget.dataset['targettitle'];//change page title to link name, need to finjd a way to change keyword meta tag per page
        document.getElementsByName("description")[0].content = e.currentTarget.dataset['targetdescription'];
        document.getElementsByName("keywords")[0].content = e.currentTarget.dataset['targetkeywords'];
    });
});

