$(document).ready(function () {
    //侧边栏
    if ($(document).width() > 1230) {
        $(window).scroll(function () {
            $(window).scrollTop() > 319 ? $(".hovering").css('display', '') : $(".hovering").css('display', 'none');
        });
    }

    if ($(document).width() > 1230) {
        $(window).scroll(function () {
            $(window).scrollTop() > 319 ? $(".appeardiv").css('display', '').find(".apptotop").click(function () {
                $(window).scrollTop(0);
            }) : $(".appeardiv").css('display', 'none');
        });
    }

    //展示运费单击事件
    $(".ShowDiv").mousemove(function () {
        ShowDiv($(this).attr("data-name"));
    });
    GetLeftCartNum();
    AddTaobaoToYoybuy();
    CloseWin();

    var thisUrlLanguage = location.href.substr(location.href.indexOf("com/") + 4, 2);
    var titleMsg = "";
    switch (thisUrlLanguage) {
        case "cn":
            titleMsg = "已经添加到收藏夹";
            break;
        case "en":
            titleMsg = "had  added  to Favorite";
            break;
        case "es":
            titleMsg = "Se ha añadido a Favoritos."
            break;
        case "ru":
            titleMsg = "Дабавлено в Избранное";
            break;
        default:
            titleMsg = "had  added  to Favorite";
    }


    var data1 = {
        name: "heke"
    }
    //异步加载淘宝热卖商品
    $.ajax({
        url: "http://www.yoybuy.com/en/GetHomeGoodsInfo",
        type: "post",
        cache: false,
        datatype: "jsonp",
        success: function (data) {
            if (data.result) {
                for (var i = 0; i < data.hotGoodsList.length; i++) {
                    data.hotGoodsList[i].EnEncodeName = encodeURIComponent(data.hotGoodsList[i].NameEn.replace(/[/\<>]+/g, "").replace(/[']+/g, "-").toLowerCase());
                }

                $("#hotGoodsTmpl").tmpl(data).appendTo("#hotGoodsDiv");

                for (var i = 0; i < data.isFavorit.length; i++) {
                    if (data.isFavorit[i].IsFavorit == true){
                        $("[data-itemid=" + data.isFavorit[i].ProductId + "]")
                            .attr("isFavorit", true)
                            .attr("href", "http://shoppingcart.yoybuy.com/" + thisUrlLanguage + "/Favorite/Index")
                            .find("img").attr("src", "http://img.yoybuy.com/V6/Home/like.png");
                    }
                }

                //收藏
                $(".addFavorite").click(function () {
                    var addfBtn = $(this);
                    var itemid = addfBtn.attr("data-itemid");
                    if (addfBtn.attr("isFavorit") == "true")
                    {
                        window.location.href = "http://shoppingcart.yoybuy.com/" + thisUrlLanguage + "/Favorite/Index";
                        return false;
                    }
                    $.ajax({
                        url: "http://www.yoybuy.com/en/AddProductToFavorite",
                        type: "post",
                        data: { "TaobaoProductId": itemid },
                        datatype: "jsonp",
                        cache: false,
                        success: function (data) {
                            if (data.result == true) {

                                addfBtn.attr("isFavorit", true)
                                        .attr("href", "http://shoppingcart.yoybuy.com/" + thisUrlLanguage + "/Favorite/Index")
                                        .find("img").attr("src", "http://img.yoybuy.com/V6/Home/like.png");

                            } else if (data.errcode == 0) { //没有该商品的信息
                                alert("no item");
                            } else if (data.errcode == 1) { //未登录
                                var currentlan = location.href.substr(location.href.indexOf("com/") + 4, 2);
                                window.open("http://login.yoybuy.com/" + currentlan);
                            } else if (data.errcode == 2) { //价格不对
                                alert("error" + data.errcode);
                            } else if (data.errcode == 3) {//收藏失败
                                alert("error" + data.errcode);
                            }
                        }
                    });
                });
            }
        }
    })
});
//function end!!!

CloseWin = function () {
    $(".closeLogOrReg").click(function () { $(".downWin").remove(); });
}
AddTaobaoToYoybuy = function () {
    //抓取url
    $("#sumbiturl1").live("click", function () {
        if ($("#taobaourl1").val() != "") {
            $("#AddUrl").find("[name=url]").val($("#taobaourl1").val());
        }
        $("#AddUrl").submit();
    });
}

GetLeftCartNum = function () {//获取购物车数量
    $.ajax({
        url: "http://shoppingcart.yoybuy.com/shoppingcart/GetGoodsCost",
        dataType: "jsonp",
        cache: false,
        success: function (data) {
            if (data.result == true) {
                cartNum = data.data;
                $("#cartGoodsNum").html("(" + data.data + ")");
            }
        }
    });
}

ShowDiv = function (obj) {
    $("#BuyForMeDiv").hide();
    $("#ShipForMeDiv").hide();
    $(".ShowDiv").attr("Class", "noline gray ShowDiv");
    $(".ShowDiv").each(function () {
        if ($(this).attr("data-name") == obj) {
            $(this).attr("Class", "noline orangetip ShowDiv");
            $("#" + obj + "Div").show();
        };
    });
};
