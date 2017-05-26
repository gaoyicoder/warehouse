/**
 * Created by gaoyi on 4/5/17.
 */
$(function() {
    $(document).click(function () {
        $("#country").find("dd").hide();
    });
    $("#country").find("dt").click(function (e) {
        var obj = $("#country").find("dd");
        if (obj.is(":visible")) {
            obj.hide();
        } else {
            obj.show();

        }
        e.preventDefault();
        return false;
    });

    $("#country").find("a").bind({
        'click': function (event) {
            var countryName = $.trim($(this).html());
            var countryId = $.trim($(this).attr("data-countryId"));
            $("#country").children().eq(0).children().eq(0).html(countryName);
            if(countryId == 0) {
                $("#registerform-countryid").val('');
            } else {
                $("#registerform-countryid").val(countryId);
            }

            var $form = $('#register-form');
            $form.yiiActiveForm("validateAttribute", "registerform-countryid");
            $("#country").find("dd").hide();
            event.stopPropagation();
        }
    });

});