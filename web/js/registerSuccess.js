/**
 * Created by gaoyi on 6/13/17.
 */
$(function(){
    var timeCount = 5;
    jumpToHome(timeCount);

});

function jumpToHome(timeCount) {
    $("#countdown").html(timeCount);
    timeCount = timeCount -1;
    if (timeCount > 0) {
        setTimeout("jumpToHome("+timeCount+")",1000);
    } else {
        location.href = $('.begnow').attr('href');
    }

}