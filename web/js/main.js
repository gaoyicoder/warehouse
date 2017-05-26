/**
 * Created by gaoyi on 3/31/17.
 */
$(function () {
    $("#langSelectedItem").click(function (e) {
        e ? e.stopPropagation() : event.cancelBubble = true;
    });

    $("#langSelectedItem").click(function () {
        if ($("#langSelectItems").css("display") == "none") {
            $("#langSelectItems").show();
        } else {
            $("#langSelectItems").hide();
        }
    });

    $("#langSelectedItem1").click(function (e) {
        e ? e.stopPropagation() : event.cancelBubble = true;
    });

    $("#langSelectedItem1").click(function () {
        if ($("#langSelectItems").css("display") == "none") {
            $("#langSelectItems").show();
        } else {
            $("#langSelectItems").hide();
        }

    });

    $(document).click(function () {
        $("#langSelectItems").hide();
    });

    $("#langSelectItems > li").click(function() {
        var obj = $(this);
        var toUrl = obj.attr('toUrl');
        jump(toUrl);
    });

});

function jump(url) {
    location.href = url;
}