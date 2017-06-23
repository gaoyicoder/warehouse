/**
 * Created by gaoyi on 6/21/17.
 */
$(function(){

    $('#SumbitUrlBtn').click(function(){
        var verified = false;
        var itemUrl = $("#ItemUrl").val();
        $(".url_rules").each(function() {
            var rule = new RegExp($(this).val(),'i');
            if(rule.test(itemUrl)) {
                verified = true;
            }
        });
        if (verified) {
            location.href = $('#AddItemUrl').val()+"?url="+encodeURI(itemUrl);
        } else {
            $('#ItemUrlInputErrorMsg').html($('#MsgContent').val());
            $('#ItemUrlInputErrorMsg').show();
            //MessageBox.showAlertMessageBoxWarn(630, 260, $('#MsgContent').val(), $('#MsgBtn').val(), "");
        }
    });
});