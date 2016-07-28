$(function () {

    function getTags(callback) {
        $.ajax({
            url: "/tag/",
            type: "get",
            dataType: "json"
        }).done(function (data) {
            callback(data);
        });
    }
    getTags(function (data) {
        $("[name=tagname]").autocomplete({
            source: data
        });
    })
    function getNewComment(data) {
        $.ajax({
            url: "/ajax/comment/newcomment",
            data: {commentid: data},
            type: "post"
        })
                .done(function (data) {
                    jQuery('#comments').append(data);
                })



    }

    //refresh tag list after form submit (in case a tag has been added)
    jQuery('#tags+label+form').on('submit', function (e) {
        var addedtag = e.currentTarget.elements[2].value;
        if (addedtag && addedtag.replace(/\s+/g, '') !== "" && $.inArray(addedtag.replace(/\s+/g, '') == -1, $("[name=tagname]").autocomplete("option", "source"))) {
            AjaxForm.submitHandler(e, function () {
                getTags(function (data) {
                    $("[name=tagname]").autocomplete("option", "source", data);
                    $('#tags>h4+div').text($('#tags>h4+div').text().concat(addedtag.replace(/\s+/g, '')).concat(", "))
                });
            });
        } else {
            jQuery('#tags+label+form+div.msg').html("Tag name cannot be empty! Or the tag has already been linked to your account!");
        }
    });



    jQuery("#comments+label+form").on("submit", function (e) {
        AjaxForm.submitHandler(e, function (data) {
            getNewComment(data);
        })
    })
});