var MessageBox = {
    messageType: {
        OK: 0,
        WARN: 1,
        remove: 2
    },
    showAlertMessageBoxOK: function (width, height, msg, btnText, callBack) {
        MessageBox.showMessageBox(width, height, MessageBox.messageType.OK, msg, btnText, callBack);
    },
    showAlertMessageBoxWarn: function (width, height, msg, btnText, callBack) {
        MessageBox.showMessageBox(width, height, MessageBox.messageType.WARN, msg, btnText, callBack);
    },
    showConfirmMeesageBox: function (width, height, msg, btnText, callBack) {
        MessageBox.showMessageBox(width, height, MessageBox.messageType.remove, msg, btnText, callBack);
    },
    showMessageBox: function (width, height, msgType, msg, btnText, callBack) {
        if ($("#showAlertMessageBox").length > 0) {
            $("#showAlertMessageBox").remove();
        }
        var msgHtml = '<div style="display:none;" id="showAlertMessageBox">';
        msgHtml += '<div id="alertMessageBox" class="clear ove popup" >';
        msgHtml += '<div class="clear popucon pad50">';
        msgHtml += '<a class="closebut" onclick="MessageBox.closeMessageBox()"></a>';
        msgHtml += '<div class="clear ove mailtips centers">';
        msgHtml += '<div class="clear ove mailtip">';
        switch (msgType) {
            case MessageBox.messageType.OK:
                msgHtml += '<img src="../images/main/check2.png" width="32" height="32" class="flo marr10 mar12">';
                break;
            case MessageBox.messageType.WARN:
                msgHtml += '<img src="../images/main/warn2.png" width="32" height="32" class="flo marr10 mar12">';
                break;
            case MessageBox.messageType.remove:
                msgHtml += '<img src="../images/main/deletes.png" width="32" height="32" class="flo marr10 mar12">';
                break;
            default:
        }
        msgHtml += '<p class="flo font16 mar20 lefts">';
        msgHtml += '<strong>';
        msgHtml += msg;
        msgHtml += '</strong>';
        msgHtml += '</p>';
        msgHtml += '</div>';
        msgHtml += '</div>';
        msgHtml += '<div class="clear ove mailtips centers" style="margin-top:25px;padding-bottom:20px">';
        msgHtml += '<div class="clear ove mailtip">';
        if (btnText == "") {
            msgHtml += '<a class="flo mar10 yellowbut" style="width:135px;height:42px;line-height:42px;font-size:14px;margin-right:14px;" onclick="'+callBack+'">Yes</a>';
            msgHtml += '<a style="width:135px;height:42px;line-height:42px;font-size:14px;" class="flo mar10 graybutton" onclick="MessageBox.closeMessageBox()";>Cancel</a>';
        } else {
            msgHtml += '<a class="yellowbut" style="width:170px;height:42px;line-height:42px;font-size:14px;" onclick="MessageBox.closeMessageBox(' + callBack + ')">';
            msgHtml += btnText;
            msgHtml += '</a>';
        }
        msgHtml += '</div>';
        msgHtml += '</div>';
        msgHtml += '</div>';
        msgHtml += '</div>';
        msgHtml += '</div>';

        $("body").append(msgHtml);

        $.colorbox({ width: width + "px;", height: height + "px", inline: true, href: "#alertMessageBox", overlayClose: true, onCleanup: false });
        $("#cboxClose").hide();
        /*
        $("#cboxOverlay").css("background", "#fff");
        $("#cboxContent").css("margin-top", "0px");
        $("#alertMessageBox").css({
            "width": "580px;",
            "height": "200px;",
            "margin-top": "20px",
            "margin-left": "20px",
            "position": "absolute",
            "z-index": "9999"
        });*/
    },
    closeMessageBox: function (callBack) {
        $("#cboxClose").click();
        if (typeof (callBack) == "function") {
            callBack();
        }
    },
    showConfirmMeesageBoxWith2Btn: function (width, height, msg, btnOKText, btnOKCallBack, btnCancelText, btnCancelCallBack, isShowDelImg) {
        if ($("#showAlertMessageBox").length > 0) {
            $("#showAlertMessageBox").remove();
        }
        var msgHtml = '<div style="display:none;" id="showAlertMessageBox">';
        msgHtml += '<div id="alertMessageBox" class="clear ove popup" >';
        msgHtml += '<div class="clear popucon pad50">';
        msgHtml += '<a class="closebut" onclick="MessageBox.closeMessageBox()"></a>';
        msgHtml += '<div class="clear ove mailtips centers">';
        msgHtml += '<div class="clear ove mailtip">';
        if (typeof (isShowDelImg) == "undefined" || isShowDelImg == true) {
            msgHtml += '<img src="http://img.yoybuy.com/v6/Common/deletes.png" width="32" height="32" class="flo marr10 mar12">';
        }
        msgHtml += '<p class="flo font16 mar20 lefts">';
        msgHtml += '<strong>';
        msgHtml += msg;
        msgHtml += '</strong>';
        msgHtml += '</p>';
        msgHtml += '</div>';
        msgHtml += '</div>';
        msgHtml += '<div class="clear ove mailtips centers" style="margin-top:25px;padding-bottom:20px">';
        msgHtml += '<div class="clear ove mailtip">';
        msgHtml += '<a class="flo mar10 yellowbut" style="width:135px;height:42px;line-height:42px;font-size:14px;margin-right:14px;" onclick="' + btnOKCallBack + '">' + btnOKText + '</a>';
        msgHtml += '<a style="width:135px;height:42px;line-height:42px;font-size:14px;" class="flo mar10 graybutton" onclick="MessageBox.closeMessageBox();' + btnCancelCallBack + '";>' + btnCancelText + '</a>';
        msgHtml += '</div>';
        msgHtml += '</div>';
        msgHtml += '</div>';
        msgHtml += '</div>';
        msgHtml += '</div>';

        $("body").append(msgHtml);

        $.colorbox({ width: width + "px;", height: height + "px", inline: true, href: "#alertMessageBox", overlayClose: true, onCleanup: false });
        $("#cboxClose").hide();
    }
}
