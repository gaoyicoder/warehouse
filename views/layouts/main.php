<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use app\assets\AppAsset;
use yii\helpers\BaseUrl;


AppAsset::register($this);

$this->title = Yii::t('app', 'Chinese Buying Agent Help Buy from China and Ship World Widely | ChinaInAir Taobao Agent');
$this->registerMetaTag(['name' => 'keywords', 'content' => Yii::t('app','China buying agent, 1688 agent, how to Buy from Tao bao, buy from China, taobao english version, taobao shopping service, taobao usa, taobao uk, alibaba 1688 online shopping')]);

$this->registerMetaTag(['name' => 'description', 'content' => Yii::t('app','ChinaInAir - Taobao english version helps non-chinese customers easily buy from China and deliver products with our fast international shipping service world widely. | China buying agent')]);
$this->registerJsFile('@web/js/main.js',['depends'=>['app\assets\AppAsset']]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0025)http://www.yoybuy.com/en/ -->
<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="language" content="en">
    <meta http-equiv="language" content="en">
    <!-- Need To be Modified Start-->
    <link rel="canonical" href="http://www.yoybuy.com/en/">
    <link rel="alternate" hreflang="en" href="http://www.yoybuy.com/en/">
    <link rel="alternate" hreflang="zh-cn" href="http://www.yoybuy.com/cn/">
    <!-- Need To be Modified End-->

    <link rel="shortcut icon" href="<?=Yii::getAlias('@imagePath'); ?>/main/favicon.ico" type="image/x-icon">
    <title><?= Html::encode($this->title) ?></title>
    <?= Html::csrfMetaTags() ?>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<script type="text/javascript">
    var USDRate = <?=Yii::$app->params['usdRate'];?>;
    var currentCartList = 0;

    $(function () {
        Head.languageFun();
        Head.submitUrlFun();
        Head.cartMoveFun();
    });

    var Head = {
        languageFun: function() {
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
        },

        submitUrlFun: function() {
            $("#sumbiturl").click(function () {
                var verified = false;
                var itemUrl = $("#taobaourl").val();
                $(".main_url_rules").each(function() {
                    var rule = new RegExp($(this).val(),'i');
                    if(rule.test(itemUrl)) {
                        verified = true;
                    }
                });
                if (verified) {
                    jump($('#MainAddItemUrl').val()+"?url="+encodeURIComponent(itemUrl));
                } else {
                    MessageBox.showAlertMessageBoxWarn(630, 260, $('#MainMsgContent').val(), $('#MainMsgBtn').val(), "");
                }
            });
        },

        cartMoveFun: function() {
            $(".carthover").mouseleave(function () {
                $(".shoplist").hide();
            }).mouseover(function () {
                Head.getCartList();
            });
        },

        getCartList: function() {
            $(".shoplist:eq(0)").show();
            if(currentCartList == 0) {
                $.ajax({
                    url: '<?= BaseUrl::to(array('member/get-cart-list'), true);?>',
                    dataType: "json",
                    cache: "false",
                    success: function(data) {
                        if (data.result == true) {
                            var htmlValue = "";
                            currentCartList = 1;
                            for(var i = 0; i < data.data.length; i++) {
                                if (i == 3) {
                                    $("#ShopingCart").next().show();
                                    break;
                                };
                                htmlValue += "<div class='clear ove shopcone'><a href='" + data.data[i].url + "' target='_blank' class='flo product50'><img src='https:" + data.data[i].photoUrl + "' width='50' height='50' /></a><dl class='floR'><dt class='clear ove'><a href='" + data.data[i].url + "' target='_blank' class='norcol' title='" + data.data[i].name + "'>" + data.data[i].name + "</a></dt><dd class='clear ove mar2'><em class='flo'>US<span class='orangetip'>$" + data.data[i].price + "</span> X " + data.data[i].amount + "</em><a class='floR centers norcol noline' onclick=\"Head.deleteCart(" + data.data[i].id + ",this)\" ><div class='mailtip'><img src='http://img.yoybuy.com/V6/Common/newdelete.png' width='14' height='15' class='flo mar5 marr4' /><span class='flo'>Delete</span></div></a></dd></dl></div>";
                            }
                            $("#ShopingCart").html(htmlValue);
                            Head.showList(1);
                        } else {
                            currentCartList = 2;
                            Head.showList(2);
                        }
                    },
                    error: function() {
                        currentCartList = 0;
                        Head.showList(2);
                    }
                });
            } else {
                Head.showList(currentCartList);
            }
        },

        showList: function(listNum) {
            $(".shoplist").hide();
            $(".shoplist:eq("+listNum+")").show();
        },
        deleteCart: function(cartId, obj) {
            $.ajax({
                url: '<?= BaseUrl::to(array('member/delete-cart-item'), true);?>',
                cache: false,
                type: 'POST',
                dataType:"json",
                data: { "cartId": cartId, "<?=Yii::$app->request->csrfParam?>": '<?=Yii::$app->request->getCsrfToken()?>'},
                success: function (data) {
                    if (data.result) {
                        $(obj).parent().parent().parent().remove();
                        var cartNum = $("#goodsNum").html().replace("(", "").replace(")", "");
                        if (cartNum > 0) {
                            cartNum = cartNum - 1;
                        }
                        $("#goodsNum").html("(" + cartNum + ")");
                        if (cartNum == 0) {
                            Head.showList(2);
                        }
                    }
                }
            });
        }
    };
</script>
<div id="wrap">
    <!-- header start-->
    <div id="header">
        <div style="height:30px;" class="headerin homebor">
            <div class="floR langtab marl4" style="width:92px;">
                <p style="width:80px;padding:0 6px;">
                <span id="langSelectedItem" class="flo height30">
                    <em>
                        <img src="<?=Yii::getAlias('@imagePath'); ?>/main/lang<?=$this->params['userLanguage']?>.png" width="16" height="13" class="flo mar8 marr4">
                        <span class="flo"><?=Yii::$app->params['availableLanguage'][$this->params['userLanguage']][1]?></span>
                    </em>
                </span>
                    <img id="langSelectedItem1" src="<?=Yii::getAlias('@imagePath'); ?>/main/arrowdown.png" width="7" height="5" class="floR mar12">
                </p>
                <ul id="langSelectItems" style="display:none;width:90px;">
                    <?php foreach(Yii::$app->params['availableLanguage'] as $key => $lan) {?>
                        <li id="<?=$key ?>" toUrl="<?= BaseUrl::to(array('user/change-lan','id'=>$key), true);?>" class="clear ove">
                            <em>
                                <img src="<?=Yii::getAlias('@imagePath'); ?>/main/lang<?=$key?>.png" width="16" height="13" class="flo mar8 marr4">
                                <span class="flo"><?=$lan[1]?></span>
                            </em>
                        </li>
                    <?php } ?>
                </ul>
            </div>
            <img src="<?=Yii::getAlias('@imagePath'); ?>/main/topbg.png" width="1" height="14" class="floR marl10 mar8">
            <div class="floR marl10 max130" style="max-width:40px;">
                <div class="clear shopcarnum">
                    <a href="http://www.yoybuy.com/en/help.html" class="norcol noline">
                        <span class="floR height30">Help</span>
                    </a>
                    <p class="clear ove"></p>
                </div>
            </div>
            <img src="<?=Yii::getAlias('@imagePath'); ?>/main/topbg.png" width="1" height="14" class="floR marl10 mar8">
            <div class="floR marl10 langtab" style="width:115px;">
                <p>
                    <a href="javascript:void(0)" class="noline norcol">
                        <img src="<?=Yii::getAlias('@imagePath'); ?>/main/arrowdown.png" width="7" height="5" class="floR mar12 marl4">
                        <span class="floR height30">Customer Service</span>
                    </a>
                </p>
                <ul class="clear ove homservice" style="width:107px;">
                    <li class="clear ove" style="padding:0;">
                        <a onclick="Comm100API.open_chat_window(event, 448);" class="noline norcol"><em>Live Chat</em></a>
                    </li>
                    <li class="clear ove" style="padding:0;">
                        <a href="http://www.yoybuy.com/en/help.html?cateid=12888" target="_blank" class="noline norcol"><em>Contact Us</em></a>
                    </li>
                    <li class="clear ove" style="padding:0;">
                        <a href="javascript:Common100Position();" class="noline norcol"><em>Submit Ticket</em></a>
                    </li>
                </ul>
            </div>
            <img src="<?=Yii::getAlias('@imagePath'); ?>/main/topbg.png" width="1" height="14" class="floR marl10 mar8">
            <div class="floR marl10 max130 carthover">
                <div class="clear shopcarnum">
                    <a href="<?= BaseUrl::to(array('member/shopping-cart'), true);?>" rel="nofollow" target="_blank" class="norcol noline">
                    <span class="floR height30 marl4">
                        Shopping Cart <span class="orangetip" id="goodsNum">(<?=$this->params['cartList']['count']?>)</span>
                    </span>
                        <img src="<?=Yii::getAlias('@imagePath'); ?>/main/cart.png" width="17" height="13" class="floR mar8">
                    </a>
                    <p class="clear ove"></p>
                </div>
                <div class="clear ove shoplist" style="display:none;">
                    <img style="margin: 5px auto;" src="<?=Yii::getAlias('@imagePath'); ?>/main/loading.gif" alt="load">
                </div>
                <div class="clear ove shoplist" style="display:none;">
                    <div id="ShopingCart">

                    </div>
                    <p class="clear ove itemore centers" style="display:none;">
                        <a href="<?= BaseUrl::to(array('member/shopping-cart'), true);?>" target="_blank" rel="nofollow" class="gray">More items &gt;&gt;</a>
                    </p>
                    <div class="clear ove mar15">
                        <em class="flo font14 mar4">Total：<span class="orangetip" id="totalMoney">$63.2</span></em>
                        <a href="<?= BaseUrl::to(array('member/shopping-cart'), true);?>" rel="nofollow" target="_blank" class="floR
yellowbut" style="width:130px;height:24px;line-height:24px;font-size:12px;font-weight:normal;border-radius:4px;">
                            shopping cart
                        </a>
                    </div>
                </div>
                <div class="clear ove shoplist" style="display:none;">
                    <p class="clear ove centers mar10">The shopping cart is empty</p>
                    <p class="clear ove mar12">
                        <a href="<?= BaseUrl::to(array('member/shopping-cart'), true);?>" class="yellowbut marauto" style="width:130px;height:24px;line-height:24px;font-size:12px;font-weight:normal;border-radius:4px;" rel="nofollow">shopping cart</a>
                    </p>
                </div>
            </div>
            <div id="regOrSignOut">
                <img src="<?=Yii::getAlias('@imagePath'); ?>/main/topbg.png" width="1" height="14" class="floR marl10 mar8">
                <? if(Yii::$app->user->isGuest) {?>
                    <div class="floR marl10 horegister">
                        <a href="<?= BaseUrl::to(array('user/register'), true);?>" class="noline norcol height30" rel="nofollow"><?=Yii::t('app', 'Register') ?></a>
                        <p class="clear ove"><?=Yii::t('app', '$10 for new register') ?></p>
                    </div>
                <? } else { ?>
                    <a href="<?=BaseUrl::to(array('user/logout'), true) ?>" class="floR noline norcol height30 marl5" rel="nofollow"><?=Yii::t('app', 'Sign Out') ?></a>
                <? } ?>
                <img src="<?=Yii::getAlias('@imagePath'); ?>/main/topbg.png" width="1" height="14" class="floR marl10 mar8">
                <? if(Yii::$app->user->isGuest) {?>
                    <a href="<?=BaseUrl::to(array('user/login'), true) ?>" class="floR noline norcol height30 marl5" rel="nofollow"><?=Yii::t('app', 'Sign In') ?></a>
                <? } else {?>
                    <a href="<?=BaseUrl::to(array('member/index'), true) ?>" class="floR noline norcol height30 marl5" rel="nofollow"><?=Yii::t('app', 'Welcome, ') ?><?=Yii::$app->user->identity->userName ?></a>
                <? } ?>
            </div>
            <p class="floR height30" id="username"></p>
        </div>
        <div class="clear ove headereal mar25">
            <div class="clear ove minwidth">
                <h1 class="flo inlogo">
                    <a href="<?=BaseUrl::home(true);?>"></a>
                </h1>
                <div class="floR mar10 homesear">
                    <div class="clear ove homesearT">
                        <input id="taobaourl" type="text" placeholder="<?=Yii::t('app', 'Please enter Taobao URL here')?>" class="flo font14 arial" style="width:400px;height:30px;line-height:30px;border:3px solid #FF6C10;border-right:none;border-radius:0;">
                        <input id="MainAddItemUrl" type="hidden" value="<?=BaseUrl::to(array("member/add-item"))?>" />
                        <?php foreach(Yii::$app->params['urlRules'] as $rule) { ?>
                            <input class="main_url_rules" type="hidden" value="<?=$rule ?>">
                        <?php } ?>
                        <input id="MainMsgContent" type="hidden" value="<?=Yii::t('app','* Error website address, please check it!')?>" />
                        <input id="MainMsgBtn" type="hidden" value="<?=Yii::t('app','OK')?>" />
                        <a class="flo yellowbut" style="width:127px;height:42px;line-height:42px;font-size:20px;border-radius:0;font-weight:normal;" id="sumbiturl"><?=Yii::t('app', 'Buy Now')?></a>
                    </div>
                    <p class="clear ove height30 font14">
                        <a onclick="redirectStoreUrl(&#39;http://www.taobao.com/&#39;, &#39;Taobao&#39;)" class="noline norcol orangea marr5">Taobao</a>
                        <span class="marr5">|</span>
                        <a onclick="redirectStoreUrl(&#39;http://www.tmall.com/&#39;, &#39;Tmall&#39;)" class="noline norcol orangea marr5">Tmall</a>
                        <span class="marr5">|</span>
                        <a onclick="redirectStoreUrl(&#39;http://www.1688.com/&#39;, &#39;1688&#39;)" class="noline norcol orangea marr5">1688</a>
                        <span class="marr5">|</span>
                        <a onclick="redirectStoreUrl(&#39;http://www.mi.com/&#39;, &#39;Mi&#39;)" class="noline norcol orangea marr5">Mi</a>
                        <span class="marr5">|</span>
                        <a onclick="redirectStoreUrl(&#39;http://www.jd.com/&#39;, &#39;JD&#39;)" class="noline norcol orangea marr5">JD</a>
                        <span class="marr5">|</span>
                        <a onclick="redirectStoreUrl(&#39;http://www.meilishuo.com/?frm=baidupz_shouye&#39;, &#39;Meilishuo&#39;)" class="noline norcol orangea marr5">Meilishuo</a>
                        <span class="marr5">|</span>
                        <a onclick="redirectStoreUrl(&#39;http://www.yoybuy.com/en/BestSelling.html&#39;, &#39;YOYBUY&#39;)" class="noline norcol orangea marr5">YOYBUY</a>
                        <span class="marr5">|</span>
                        <a onclick="redirectStoreUrl(&#39;http://www.moonbasa.com/?cn=83318&amp;type=0&amp;adsiteid=10000007&#39;, &#39;Moonbasa&#39;)" class="noline norcol orangea marr5">Moonbasa</a>
                    </p>
                </div>
            </div>
        </div>
        <div class="clear mar30 headerB">
            <div class="clear minwidth">
                <div class="flo navlink">
                    <a href="http://www.yoybuy.com/en/addurl.html" rel="nofollow" target="_blank" class="centers noline inlinka">
                        <div class="mailtip">
                            <span class="flo marr7">BuyForMe</span>
                            <img src="<?=Yii::getAlias('@imagePath'); ?>/main/navlink.png" width="9" height="5" class="flo mar28">
                        </div>
                    </a>
                    <div class="clear ove font14 navmenu">
                        <ul>
                            <li>
                                <a href="http://www.yoybuy.com/en/BuyForMe.html" target="_blank" class="noline norcol orangea">How It Works</a>
                            </li>
                            <li>
                                <a href="<?=BaseUrl::to(array('member/add-url'), true)?>" rel="nofollow" target="_blank" class="noline norcol orangea"><?=Yii::t("app/member", 'Add URL')?></a>
                            </li>
                            <li>
                                <a href="http://order.yoybuy.com/en/myorder" target="_blank" class="noline norcol orangea" rel="nofollow">My Items</a>
                            </li>
                            <li>
                                <a href="http://order.yoybuy.com/en/myparcels" target="_blank" class="noline norcol orangea" rel="nofollow">My Parcels</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="flo navlink">
                    <a href="http://www.yoybuy.com/en/Forwarding.html" target="_blank" class="centers noline inlinka">
                        <div class="mailtip">
                            <span class="flo marr7">ShipForMe</span>
                            <img src="<?=Yii::getAlias('@imagePath'); ?>/main/navlink.png" width="9" height="5" class="flo mar28">
                        </div>
                    </a>
                    <div class="clear ove font14 navmenu">
                        <ul>
                            <li>
                                <a href="http://www.yoybuy.com/en/Forwarding.html" target="_blank" class="noline norcol orangea">How It Works</a>
                            </li>
                            <li>
                                <a href="http://order.yoybuy.com/en/chineseaddress.html" target="_blank" class="noline norcol orangea" rel="nofollow">My Warehouse</a>
                            </li>
                            <li>
                                <a href="http://order.yoybuy.com/en/myforwardingparcels" target="_blank" class="noline norcol orangea" rel="nofollow">My Parcels</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <a href="http://customercenter.yoybuy.com/en/userindex.html" target="_blank" class="flo noline inlinka" rel="nofollow">
                    My YOYBUY
                </a>
                <style>
                    .bstsell{ position:relative;}
                    .bstsell em{ position:absolute; left:55%; top:-8px; width:44px; height:24px; background:url(http://img.yoybuy.com/www/home/hoticon.gif) no-repeat;}
                </style>
                <a href="http://www.yoybuy.com/en/BestSelling.html" target="_blank" class="flo noline inlinka bstsell">
                    Best Selling<em></em>
                </a>
                <a href="http://www.yoybuy.com/en/salespromotion.html" target="_blank" class="flo noline inlinka" style="display:none;">
                    Sales Promotion
                </a>
                <a href="http://www.yoybuy.com/en/service/tools/costestimation.html" target="_blank" class="flo noline inlinka">Cost Calculator</a>
            </div>
        </div>
        <form id="AddUrl" action="http://www.yoybuy.com/en/addurl.html" rel="nofollow" method="POST">
            <input type="hidden" name="url">
        </form>

        <!--过渡页-->
        <form id="storeFormSubmit" action="http://www.yoybuy.com/en/RedictionStore" style="display: none;" method="POST" target="_blank">
            <input type="hidden" value="en" name="lan">
            <input type="hidden" value="" id="storeUrl" name="storeUrl">
            <input type="hidden" value="" id="storeName" name="storeName">
        </form>
        <!--ENd-->
    </div>
    <!-- header end-->


    <?= $content ?>

    <!-- footer start-->
    <div id="footer">
        <div class="foot01">
            <div class="left_sar">
                <p class="tit">YOYBUY.COM ON</p>
                <div class="sar_main">
                    <a href="http://www.facebook.com/TaobaoAgent.Yoybuy" class="s1" rel="nofollow"></a>
                    <a href="https://twitter.com/yoybuy" class="s2" rel="nofollow"></a>
                    <a href="https://plus.google.com/100763840872179026876/posts" class="s3" rel="nofollow"></a>
                    <a href="http://www.pinterest.com/yoybuy/" class="s4" rel="nofollow"></a>
                    <a href="http://yoybuy.tumblr.com/" class="s5" rel="nofollow"></a>
                    <a href="https://www.youtube.com/yoybuy" class="s6" rel="nofollow"></a>
                    <a href="http://www.stumbleupon.com/stumbler/Yoybuy" class="s7" rel="nofollow"></a>
                    <a href="http://www.taobao399.com/" class="s8" rel="nofollow"></a>
                </div>
            </div>
            <div class="center_cu">
                <p class="tit">CONTACT US</p>
                <p>
                    <span>Tel: +86-10-56147027</span>
                    <span>Email: service@yoybuy.com</span>
                </p>
                <p>
                    <span>Service Time: 9:30~18:30 Mo-Su</span>
                <span>Beijing Time: <span style="width: auto" id="spantime1"><em>16</em>:<em>20</em>:<em>06</em></span>
                    <span style="width: auto" id="spanDate1">24/03/2017</span></span>
                </p>
            </div>
            <div class="right_oh">
                <p class="tit">Need Help</p>
                <p>Need any help? Click Live Chat</p>
                <p><a class="clear ove yellowbut" style="width:115px;height:32px;line-height:32px;font-size:14px;font-weight:normal;border-radius:0;" onclick="Comm100API.open_chat_window(event, 448); ">              	<span class="mailtip">
                    	<img src="<?=Yii::getAlias('@imagePath'); ?>/main/lave_cate.png" width="25" height="19" class="flo mar6 marr10">
                        <em class="flo">Live Chat</em>
                    </span>
                    </a>
                </p>
            </div>
            <div class="subscribe" id="SpreadfrmSample">
                <p class="subtitle">Get Promo Codes &amp; Coupon by Your Email</p>
                <p class="clear ove font13 orangetip">
                    <strong id="spreadShowSuccessMsg" style="display: none">You subscribed successfully.</strong>
                </p>
                <div class="clear ove mar5">
                    <input id="txtSpreadEmail" type="text" name="spread_email" placeholder="Your Email Address" class="flo wei" style="border: 1px solid #E2E2E2; padding: 3px 5px; width: 260px; height: 26px; line-height: 26px; border-right: none; border-

radius: 0;">
                    <a class="flo yellowbut" onclick="spreadNoFormSubmit(&#39;en&#39;)" style="width: 100px; height: 34px; line-height:

34px; border-radius: 0; font-size: 18px; font-weight: normal;cursor: pointer">Subscribe</a>
                    <input type="hidden" name="user" value="18487" style="visibility:hidden;width:0px;height:0px;">
                    <input type="hidden" name="re" value="" style="visibility:hidden;width:0px;height:0px;">
                    <input type="hidden" name="target" value="427749" style="visibility:hidden;width:0px;height:0px;">
                    <input type="hidden" name="redirect" value="False" style="visibility:hidden;width:0px;height:0px;">
                    <input type="hidden" name="skip_detail" value="false" style="visibility:hidden;width:0px;height:0px;">
                </div>
                <p class="clear ove font13 redtips mar5 substips" id="spreadShowErrorMsg" style="display: none">Wrong email format,

                    please input the correct one.</p>
                <p class="clear ove mar8">Sign up to receive the latest updates, promotions, and news from YOYBUY.</p>
            </div>
        </div>
        <div class="foot02">
            <ul class="foot_tool">
                <li>
                    <p><strong>Making an Order</strong></p>
                    <p><a href="http://www.yoybuy.com/en/help.html?cateid=136">BuyForMe Tutorial</a></p>
                    <p><a href="http://www.yoybuy.com/en/help.html?cateid=12882">Order Status</a></p>
                    <p><a href="http://www.yoybuy.com/en/help.html?cateid=12885">Pricing &amp; Purchasing</a></p>
                    <!--<p><a href="http://oneclickorder.yoybuy.com/en/show">1 Click Order</a></p>-->
                    <p><a href="http://www.yoybuy.com/en/help.html?cateid=13191">ShipForMe Tutorial</a></p>
                    <p><a href="http://www.yoybuy.com/en/dhl/">Shipping Category</a></p>
                </li>

                <li>
                    <p><strong>Payment &amp; Shipping</strong></p>
                    <p><a href="http://www.yoybuy.com/en/help.html?cateid=139">Payment Methods</a></p>
                    <p><a href="http://www.yoybuy.com/en/help.html?cateid=599">Points and coupons</a></p>
                    <p><a href="http://www.yoybuy.com/en/help.html?cateid=601">Shipping Methods</a></p>
                    <p><a href="http://www.yoybuy.com/en/shippingprice.html">Shipping Price</a></p>
                    <p><a href="http://www.yoybuy.com/en/help.html?cateid=159">Parcel Tracking</a></p>
                    <p><a href="http://www.yoybuy.com/en/dhl" style="display:none">Shipping Category</a></p>
                </li>

                <li>
                    <p><strong>Customer Service</strong></p>
                    <p><a href="http://www.yoybuy.com/en/help.html?cateid=12888">Contact Us</a></p>
                    <p><a href="http://www.yoybuy.com/en/help.html?cateid=12884">Complaint &amp; Return</a></p>
                    <p><a href="http://www.yoybuy.com/en/help.html?cateid=142">Refund Policy</a></p>
                    <!--<p><a href="http://www.yoybuy.com/en/help.html?cateid=602">Yoybuy Member Grade</a></p>-->
                    <p><a href="http://www.yoybuy.com/en/VIPClub.html">VIP Club</a></p>
                    <p><a href="http://www.yoybuy.com/en/help.html?cateid=12883">Customs</a></p>
                </li>

                <li>
                    <p><strong>Other</strong></p>
                    <p><a href="http://www.yoybuy.com/en/sitemap.html">Site Map</a></p>
                    <!--<p><a href="http://www.yoybuy.com/en/help.html?cateid=3244057" >Hot Taobao Sellers</a></p>-->
                    <p><a href="http://www.yoybuy.com/en/help.html?cateid=156">Taobao Shopping Tips</a></p>
                    <p><a href="http://www.yoybuy.com/en/help.html?cateid=154">Size Conversion</a></p>
                    <p><a href="http://www.yoybuy.com/en/send-to/">International  Shipping</a></p>
                    <p><a href="http://www.yoybuy.com/en/affiliate-program">Affiliate program</a></p>



                </li>
            </ul>
            <div class="clear"></div>
            <div class="foot_ysfs">
                <a>
                    <img src="<?=Yii::getAlias('@imagePath'); ?>/main/ysfs_35.png" alt=""></a>
                <a>
                    <img src="<?=Yii::getAlias('@imagePath'); ?>/main/ysfs_20.png" alt=""></a>
                <a>
                    <img src="<?=Yii::getAlias('@imagePath'); ?>/main/ysfs_28.png" alt=""></a>
                <a href="https://passport.webmoney.ru/asp/certview.asp?wmid=167442449693" rel="nofollow">
                    <img src="<?=Yii::getAlias('@imagePath'); ?>/main/ysfs_32.png" alt=""></a>
                <a>
                    <img src="<?=Yii::getAlias('@imagePath'); ?>/main/ysfs_22.png" alt=""></a>
                <a>
                    <img src="<?=Yii::getAlias('@imagePath'); ?>/main/ysfs_11.png" alt=""></a>
                <a>
                    <img src="<?=Yii::getAlias('@imagePath'); ?>/main/ysfs_13.png" alt=""></a>
                <a>
                    <img src="<?=Yii::getAlias('@imagePath'); ?>/main/ysfs_15.png" alt=""></a>
                <a>
                    <img src="<?=Yii::getAlias('@imagePath'); ?>/main/ysfs_25.png" alt=""></a>
                <a>
                    <img src="<?=Yii::getAlias('@imagePath'); ?>/main/ysfs_17.png" alt=""></a>
                <a>
                    <img src="<?=Yii::getAlias('@imagePath'); ?>/main/ysfs_05.png" alt=""></a>
            </div>
        </div>
        <div class="foot_cop">
            <!--<p><a href="http://www.yoybuy.com/en/sitemap.html">Site Map</a> | --><a href="http://www.yoybuy.com/en/help.html?cateid=3237174">About Us</a> | <a href="http://www.yoybuy.com/en/help.html?cateid=3237175">Terms of Service</a> | <a href="http://www.yoybuy.com/en/help.html?cateid=3237176">Privacy Policy</a> | <a href="http://www.yoybuy.com/en/help.html?cateid=3237177">Insurance Policy</a> | <a href="http://www.yoybuy.com/en/selling-to-china.html">Sell to China</a> <p></p>
            <p>Copyright © 2008-2016 YOYBUY Ltd. All Rights Reserved
                <a href="http://www.miitbeian.gov.cn/" target="_blank">京ICP备 15030389号</a>
            </p>
        </div>
    </div>
    <!-- footer end-->

</div>
<!--MENLeft-->
<div class="clear ove hovering downWin" style="display: none;">
    <div class="clear ove hovercon">
        <p class="clear ove hoverp"></p>
        <div class="clear ove hovercont">
            <div class="clear minwidth hotips centers">
                <div class="mailtip">
                    <div class="flo marr50" id="addItemUrlDiv">
                        <input type="text" placeholder="Please enter item URL here..." class="flo font14 arial" style="width: 600px; height: 30px; line-height: 30px; border: 3px solid #FF6C10; border-right: none; border-radius: 0;" id="taobaourl1">
                        <a class="flo yellowbut" style="width: 127px; height: 42px; line-height: 42px; font-size: 20px; border-radius: 0; font-weight: normal;" id="sumbiturl1">Buy Now</a>
                    </div>
                    <div id="logOrRegBtn" class="flo">
                        <p class="flo font24 hovertip">
                            <a href="http://login.yoybuy.com/en/login">Sign In</a> / <a href="http://login.yoybuy.com/en/Register">Register</a>
                        </p>
                    </div>
                </div>
                <a class="clear ove hoverclo closeLogOrReg"></a>
            </div>
        </div>
    </div>
</div>
<?php $this->endBody() ?>
</body></html>
<?php $this->endPage() ?>