
//
////http://joelb.me/blog/2011/code-snippet-accessing-clipboard-images-with-javascript/
// 
// // We start by checking if the browser supports the 
// Clipboard object. If not, we need to create a 
// contenteditable element that catches all pasted data 



if (!window.Clipboard) {
    var pasteCatcher = document.getElementById("uploadbutton");
    pasteCatcher.firstElementChild.style.zIndex = "-50";
    // Firefox allows images to be pasted into contenteditable elements
    $(pasteCatcher).attr('contenteditable', '');
    // We can hide the element and append it to the body,
    $(pasteCatcher).css('opacity', "1");
    $(pasteCatcher).css('z-index', "1000");

}
// Add the paste event listener
$(window).on("paste", pasteHandler);

/* Handle paste events */
function pasteHandler(e) {
    // We need to check if event.clipboardData is supported (Chrome)
    if (e.clipboardData) {
        // Get the items from the clipboard
        var items = e.clipboardData.items;
        if (items) {
            // Loop through all items, looking for any kind of image
            for (var i = 0; i < items.length; i++) {
                if (items[i].type.indexOf("image") !== -1) {
                    // We need to represent the image as a file,
                    var blob = items[i].getAsFile();
                    // and use a URL or webkitURL (whichever is available to the browser)
                    // to create a temporary URL to the object
                    var URLObj = window.URL || window.webkitURL;
                    var source = URLObj.createObjectURL(blob);
                    // The URL can then be used as the source of an image
                    createImage(source);
                }
            }
        }
        // If we can't handle clipboard data directly (Firefox), 
        // we need to read what was pasted from the contenteditable element
    } else {
        // This is a cheap trick to make sure we read the data
        // AFTER it has been inserted.
        $(pasteCatcher).html("");
        $("#uploadbutton .imgholder").css("width","100%");
        $("#uploadbutton .imgholder").css("height","100%");
        
        setTimeout(checkInput, 1);
    }
}

/* Parse the input in the paste catcher element */
function checkInput() {
    // Store the pasted content in a variable
    var child = pasteCatcher.childNodes[0];

    // Clear the inner html to make sure we're always"
    // getting the latest inserted content
    if (child) {
        // If the user pastes an image, the src attribute
        // will represent the image as a base64 encoded string.
        if (child.tagName === "IMG") {
            createImage(child.src);
        }
    }
}

/* Creates a new image from a given source */
function createImage(source) {
    AjaxForm.files = source;
    var pastedImage = new Image();
    pastedImage.onload = function () {
    };
    pastedImage.src = source;
}