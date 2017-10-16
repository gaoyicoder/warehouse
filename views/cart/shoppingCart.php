<?php
/**
 * Created by PhpStorm.
 * User: gaoyi
 * Date: 9/25/17
 * Time: 4:22 PM
 */

/* @var $this \yii\web\View */
/* @var $cartList array */
/* @var $totalPayment float */

use yii\helpers\BaseUrl;

$this->registerCssFile('@web/css/cart/shoppingCart.css', ['depends'=>['app\assets\AppAsset']]);
?>
<!--Content Start-->
<div id="container" class="clear ove padb90">
    <!-- content -->
    <div id="content">
        <?=$this->render('/layouts/shoppingSteps', ['shoppingStep' => 1])?>
        <table cellpadding="0" cellspacing="0" width="100%" class="clear collapse cartit centers">
            <tbody>
            <tr bgcolor="F5F5F5">
                <td width="36%">
                    <div class="lefts firstcart">
                        <input type="checkbox" id="AllCkb" class="norinput marr4" checked="checked">
                        <strong style="margin-right:150px;">All</strong>
                        <strong>Items</strong>
                    </div>
                </td>
                <td width="12%"><strong>Unit Price</strong></td>
                <td width="14%"><strong>Qty</strong></td>
                <td width="14%">
                    <div class="clear centers mailtip">
                        <strong class="flo marr5">Domestic Express Type</strong>
                        <div class="flo shipdoubt" style="cursor:pointer">
                            <img src="<?=Yii::getAlias('@imagePath'); ?>/cart/doubt.png" id="DomesticShipmentDesc" width="15" height="15">
                            <div class="ark-poptip lefts titleHts" style="position:absolute;top:-40px;left:22px;z-index:10;width:287px;display:none;">
                                <div class="ark-poptip-container" style="padding:13px 15px;">
                                    <div class="ark-poptip-arrow" style="top:35px;left:-6px;">
                                        <em style="top:0;left:-1px;color:#83C3F5;">◆</em><span>◆</span>
                                    </div>
                                    <div class="ark-poptip-content">
                                        <p><strong>Tips:</strong> If you choose more than one item from a same seller, we only charge you domestic express fee for once.For any special cases,our purchasers will contact you directly.</p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </td>
                <td width="12%"><strong>Total</strong></td>
                <td width="12"><strong>Action</strong></td>
            </tr>
            </tbody>
        </table>
        <? if ($cartList != []) {?>
            <!--have goods Start-->
            <? foreach($cartList as $shopUrl => $shopCart) {?>
            <table cellpadding="0" cellspacing="0" width="100%" class="clear collapse centers mar10">
                <tbody>
                <? foreach($shopCart['cart'] as $cart) {?>
                <tr class="carbor current">
                    <td width="36%">
                        <div class="clear ove weightitem" data-flag="2964916">
                            <p class="flo carinput">
                                <input type="checkbox" class="norinput mar30 selectItem" data-price="<?=$cart['price']?>" data-cartid="<?=$cart['id']?>" data-freight="<?=$cart['postFeeType']?>" data-totalprice="<?=$cart['price'] * $cart['amount']?>" data-shopurl="<?=$shopUrl?>" data-goodsname="<?=$cart['name']?>" checked="checked">
                            </p>
                            <p class="flo cartimgs marr20">
                                <a href="<?=$cart['url']?>" class="product70">
                                    <img class="loaddingImg" width="70" height="70" data-src="<?=$cart['photoUrl']?>_70x70.jpg">
                                </a>
                            </p>
                            <ul>
                                <li><a href="<?=$cart['url']?>" class="norcol orangea" title="<?=$cart['name']?>" target="_blank"><?=$cart['name']?></a></li>
                                <li class="mar5"><textarea class="flo col666 arial goodsRemark" data-cartid="2964916" data-oldremark="<?=$cart['remark']?>" style="width: 283px; height: 34px; overflow-y: hidden;"><?=$cart['remark']?></textarea></li>
                            </ul>

                        </div>
                    </td>
                    <td width="12%">$<?=Yii::$app->securityTools->cnyToUsd($cart['price'])?></td>
                    <td width="14%">
                        <div class="clear ove mailtip">
                            <a class="flo cartadd marr5 mar5 itemsQTYMinus" title="minus"><img src="<?=Yii::getAlias('@imagePath'); ?>/cart/cartcut.png" width="20" height="20"></a>
                            <input type="text" value="<?=$cart['amount']?>" class="flo centers marr5 arial cartItemQty" data-cartid="<?=$cart['id']?>" data-oldnum="<?=$cart['amount']?>" style="width:42px;height:22px;line-height:22px;">
                            <a class="flo cartadd mar5 itemsQTYAdd" title="add"><img src="<?=Yii::getAlias('@imagePath'); ?>/cart/cartadd.png" width="20" height="20"></a>
                        </div>
                    </td>
                    <td width="14%"><?=$cart['postFeeTypeStr']?></td>
                    <td width="12%"><strong class="font14 redtips" id="totalPrice_<?=$cart['id']?>">$<?=Yii::$app->securityTools->cnyToUsd($cart['price'] * $cart['amount'])?></strong></td>
                    <td style="padding-left: 5%" width="12%">
                        <a class="flo delete spcart_listj" data-cartid="<?=$cart['id']?>"></a>
                    </td>
                </tr>
                <? } ?>
                <tr>
                    <td colspan="6" class="col666 cartaddress">
                        <span class="floR marl15">Website: <?=$shopCart['source']?></span>
                        <span class="floR marl5">Shop: <a href="<?=$shopUrl?>" class="col666 wei" title="<?=$shopCart['shop']?>"><?=$shopCart['shop']?></a></span>
                        <span class="floR mar8"><img src="<?=Yii::getAlias('@imagePath'); ?>/cart/shopico.png" width="17" height="15"></span>
                    </td>
                </tr>
                </tbody>
            </table>
            <? } ?>
            <!--pay Start-->
            <div id="showSubBtn" class="spcart_pay" style="">
                <div class="clear ove cartbut ">
                    <a class="flo marr20 norcol noline">
                            <span class="flo" id="selectedAllLink">
                                <input type="checkbox" checked="checked" class="norinput flo marr5 mar17 spcart_payLeft">
                                Select All
                            </span>
                    </a>
                    <a class="flo norcol noline orangea marr20" id="deleteSelectedItems">Delete</a>
                    <a class="floR yellowbut" style="width:170px;margin-left:20px;" id="CartCheckout">Pay</a>

                    <strong class="floR font14" style="margin-left:30px;">
                        Total Payment:
                        <span class="font18 redtips" id="alltotalprice">$<?=$totalPayment?></span>
                    </strong>
                    <span class="floR">My Balance: <strong class="redtips font14">$0</strong></span>
                </div>
            </div>
            <div class="clear ove">
                <a href="<?=BaseUrl::to(array('cart/add-url'), true)?>" class="floR norcol mar15">Add more items &gt;&gt;</a>
            </div>
            <!--have goods end-->
        <? } else {?>
            <!--no goods Start-->
            <div class="clear ove centers mar60">
                <div class="clear ove mailtip">
                    <img src="<?=Yii::getAlias('@imagePath'); ?>/cart/cartno.png" width="95" height="75" class="flo marr20">
                    <ul class="flo">
                        <li class="mar20"><strong class="font16 col666">Your shopping cart is empty.</strong></li>
                        <li class="gray mar12">Please add your favorite items right now.</li>
                        <li class="mar30"><a href="<?=BaseUrl::to(array('cart/add-url'), true)?>" class="yellowbut" style="width:170px;height:42px;line-height:42px;font-size:14px;">Add new items &gt;&gt;</a></li>
                    </ul>
                </div>
            </div>
            <!--no goods END-->
        <? } ?>

    </div>
    <!-- //content -->
    <div style="display:none">
        <div id="deleteAllDiv" class="clear ove popup" style=" width:600px;height:200px;">
            <div class="clear popucon pad50 ">
                <a class="closebut"></a>
                <div class="clear ove mailtips centers">
                    <div class="clear ove mailtip">
                        <img src="http://img.yoybuy.com/V6/Common/deletes.png" width="42" height="54" class="flo marr20">
                        <p class="flo font16 mar20 lefts"><strong>Want to delete the collection to you?</strong></p>
                    </div>
                </div>
                <div class="clear ove mailtips centers mar15">
                    <div class="clear ove mailtip">
                        <a class="flo mar10 yellowbut" id="deleteAllYes" style="width:135px;height:42px;line-height:42px;font-size:14px;margin-right:14px;">Yes</a>
                        <a class="flo mar10 graybutton deleteAllCancel" style="width:135px;height:42px;line-height:42px;font-size:14px;">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div style="display:none;">
        <div id="DeleteItemDiv" class="clear ove popup" style="width:600px;height:210px;">
            <div class="clear popucon pad50 ">
                <a class="closebut"></a>
                <div class="clear ove mailtips centers">
                    <div class="clear ove mailtip">
                        <img src="http://img.yoybuy.com/V6/Common/deletes.png" width="42" height="54" class="flo marr20">
                        <p class="flo font16 mar20 lefts"><strong>Are you sure to delete?</strong></p>
                    </div>
                </div>
                <div class="clear ove mailtips centers mar25">
                    <div class="clear ove mailtip">
                        <a class="flo mar10 yellowbut " id="deleteItemYes" data-itemcartid="" style="width:135px;height:42px;line-height:42px;font-size:14px;margin-right:14px;">Yes</a>
                        <a class="flo mar10 graybutton deleteItemCancel" style="width:135px;height:42px;line-height:42px;font-size:14px;">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<script>
    var ShoppingCartManager = {

        allTotalPrice: 0.00,
        selectedItems: [],
        msg: {
            noSelectItemsDelete:  '<?=Yii::t("app/cart", "Please select items which you would like to delete!")?>',
        },

        init: function(){
            this.bindEvent();
        },

        bindEvent: function() {
            //备注高度自适应
            this.remarkAutoHeight();
            //国内运费说明
            this.domesticShipmentDescShow();
            //全选
            this.selectAll();
            //单选
            this.selectItem();
            //删除单个
            this.deleteItem();
            //删除多个
            this.deleteAll();
            //增加商品数量
//            this.itemQTYAdd();
            //减少商品数量
//            this.ItemsQTYMinus();
            //光标离开商品数量文本框
//            this.ItemQTYTextKeyUp();
            //单个商品备注功能
//            this.goodsRemarkChange();
            //Checkout的操作栏定位
            this.checkOutDivPosition();
            //checkout 操作
//            this.checkOut();
            //加载商品图片
            this.loadGoodsImg();

        },

        remarkAutoHeight: function() {
            var maxHeight = 80;
            var minHeight = 24;

            $(".goodsRemark").each(function () {
                var height, style = this.style;
                this.style.height = minHeight + 'px';
                if (this.scrollHeight > 24) {
                    if (maxHeight && this.scrollHeight > maxHeight) {
                        height = maxHeight;
                        style.overflowY = 'scroll';
                    } else {
                        height = this.scrollHeight;
                        style.overflowY = 'hidden';
                    }
                    style.height = height + 'px';
                }
            });


            $(".goodsRemark").autoTextarea({
                maxHeight: maxHeight,
                minHeight: minHeight
            });
        },
        domesticShipmentDescShow: function () {
            $("#DomesticShipmentDesc").hover(function () {
                $(".titleHts").show(300);

            }, function () {
                $(".titleHts").hide(500);
            });
        },
        selectAll: function () {
            //全选checkbox
            $("#AllCkb").bind("click", function () {

                if ($(this).is(':checked')) {
                    $(".selectItem").prop("checked", true);

                    $(".selectItem").parent().parent().parent().parent().attr("class", "carbor current");

                    $("#selectedAllLink").find("input[type='checkbox']").prop("checked", true);

                } else {
                    $(".selectItem").prop("checked",false);

                    $(".selectItem").parent().parent().parent().parent().attr("class", "carbor");

                    $("#selectedAllLink").find("input[type='checkbox']").prop("checked",false);



                }
                ShoppingCartManager.changeAllTotalPrice();
            });

            $("#selectedAllLink").bind("click", function () {
                if ($(this).find("input[type='checkbox']").is(':checked')) {
                    $(".selectItem").prop("checked", true);

                    $(".selectItem").parent().parent().parent().parent().attr("class", "carbor current");

                    $("#AllCkb").prop("checked", true);

                } else {
                    $(".selectItem").prop("checked",false);

                    $(".selectItem").parent().parent().parent().parent().attr("class", "carbor");

                    $("#AllCkb").prop("checked",false);

                }

                ShoppingCartManager.changeAllTotalPrice();
            });

        },

        selectItem: function () {
            $(".selectItem").bind("click", function () {
                if ($(this).is(":checked")) {
                    $(this).parent().parent().parent().parent().attr("class", "carbor current");
                } else {

                    $(this).parent().parent().parent().parent().attr("class", "carbor");

                    $("#AllCkb").removeAttr("checked");

                    $("#selectedAllLink").find("input[type='checkbox']").prop("checked",false);
                }

                ShoppingCartManager.changeAllTotalPrice();
            });
        },

        deleteItem: function () {
            $(".spcart_listj").bind("click", function () {
                var cartId = $(this).attr("data-cartid");
                $("#DeleteItemDiv").attr("data-ItemCartId", $.param({ "cartids": cartId }));
                $.colorbox({ width: "605px", height: "300px", inline: true, href: "#DeleteItemDiv" });
                $("#deleteItemYes").bind("click", function () {
                    ShoppingCartManager.deleteItemsCompleted($("#DeleteItemDiv").attr("data-ItemCartId"), true);
                });
                $(".deleteItemCancel").bind("click", function () {
                    $.colorbox.close();
                });
            });

        },

        deleteAll: function() {
            $("#deleteSelectedItems").bind("click", function () {
                $(".deleteAllCancel").bind("click", function () {
                    $.colorbox.close();
                    $("#deleteAllYes").unbind("click");
                });
                ShoppingCartManager.getSelectedItems();

                if (ShoppingCartManager.selectedItems.length == 0) {
                    MessageBox.showAlertMessageBoxWarn(630, 260, ShoppingCartManager.msg.noSelectItemsDelete, '<?=Yii::t('app','OK')?>', "");
                }
                else if (ShoppingCartManager.selectedItems.length > 0) {
                    $.colorbox({ width: "605px", height: "300px", inline: true, href: "#deleteAllDiv" });
                    $("#deleteAllYes").bind("click", function () {
                        var paramCartId = $.param({ "cartids": ShoppingCartManager.selectedItems }, true);
                        ShoppingCartManager.deleteItemsCompleted(paramCartId, false);
                    });
                }
            });
        },

        deleteItemsCompleted: function (paramCartId, forOne) {

            $.ajax({
                url: '<?= BaseUrl::to(array('cart/delete-cart-mul-items'), true);?>',
                dataType: "json",
                type: 'POST',
                cache: false,
                data: { "cartId": paramCartId, "<?=Yii::$app->request->csrfParam?>": '<?=Yii::$app->request->getCsrfToken()?>'},
                success: function (data) {
                    if (data.result) {
                        $.colorbox.close();
                        var ll = ShoppingCartManager.removeGoodsDiv(forOne, paramCartId);
                        if (ll == 0) {
                            window.location.reload();
                        }

                    }
                }
            });
        },

        removeGoodsDiv: function(forOne, paramCartId) {
            var removeDiv = $(".selectItem");
            var divLength = $(".selectItem").length;

            if (forOne || divLength == 1) {
                removeDiv.each(function () {
                    if ($(this).attr("data-cartid") == paramCartId.substr(8)) {
                        var shopUrl = $(this).attr("data-shopurl");
                        var isLast = true;
                        removeDiv.each(function () {
                            if ($(this).attr("data-shopurl") == shopUrl && $(this).attr("data-cartid") != paramCartId.substr(8)) {
                                isLast = false;
                            }
                        });
                        if (isLast) {
                            $(this).parent().parent().parent().parent().parent().parent().remove();
                        } else {
                            $(this).parent().parent().parent().parent().remove();
                        }
                        divLength--;
                    }
                });
            } else {

                removeDiv.each(function () {
                    if ($(this).prop("checked") == true) {
                        var shopUrl = $(this).attr("data-shopurl");
                        var paramCartId = $(this).attr("data-cartid");
                        var isLast = true;
                        removeDiv.each(function () {
                            if ($(this).attr("data-shopurl") == shopUrl && $(this).attr("data-cartid") != paramCartId) {
                                isLast = false;
                            }
                        });
                        if (isLast) {
                            $(this).parent().parent().parent().parent().parent().parent().remove();
                        } else {
                            $(this).parent().parent().parent().parent().remove();
                        }
                        divLength--;
                    }
                });
            }
            ShoppingCartManager.changeAllTotalPrice();

            return divLength;
        },

        changeAllTotalPrice: function () {
            ShoppingCartManager.getSelectedItems();

            $("#alltotalprice").text("$" + ShoppingCartManager.allTotalPrice);
        },

        getSelectedItems: function (itemsIsSend, selectedItems) {
            ShoppingCartManager.selectedItems = [];
            if (itemsIsSend) {
                ShoppingCartManager.selectedItems.push(selectedItems);
                return;
            }
            var allTotalPrice = 0.00;
            ShoppingCartManager.allTotalPrice = 0.00;

            $(".selectItem:checked").each(function () {

                var cartId = $(this).attr("data-cartid");

                ShoppingCartManager.selectedItems.push(cartId);

                var thisTotalPrice = parseFloat($(this).attr("data-price"));

                var num = $(this).parent().parent().parent().next().next().find("input").val();

                thisTotalPrice = thisTotalPrice * num;
                allTotalPrice += thisTotalPrice;
            });

            ShoppingCartManager.allTotalPrice = parseFloat(Tools.CNYToUSD(allTotalPrice));
        },

        checkOutDivPosition: function () {

            var height = $(".spcart_pay").offset().top;
            var fheight = $(".spcart_pay").height();
            var wheight = $(window).height();
            var sheight = height + fheight - wheight;

            if (height <= wheight) {

                $(".spcart_pay").attr("style", "");


            } else {
                $(".spcart_pay").attr("style", "position: fixed;left: 50%;margin-left: -615px;bottom: 0px;width:1230px");
            }
            $(window).bind("scroll", function () {


                var st = $(document).scrollTop();
                if (st >= sheight) {
                    $(".spcart_pay").attr("style", "");
                } else {
                    $(".spcart_pay").attr("style", "position: fixed;left: 50%;margin-left: -615px;width:1230px;bottom: 0px");
                }

            });
        },

        loadGoodsImg: function() {
            var goodsImgUrls = $(".loaddingImg");
            goodsImgUrls.each(function () {
                $(this).attr("src", $(this).attr("data-src"));
            });
        }
    };

    $(function(){
        ShoppingCartManager.init();
    });
</script>
<!--Content End-->