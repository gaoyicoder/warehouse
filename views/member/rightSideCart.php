<?php
/**
 * Created by PhpStorm.
 * User: gaoyi
 * Date: 9/17/17
 * Time: 12:15 AM
 */

/* @var $this \yii\web\View */
/* @var $cartArray array */
/* @var $totalMoney float */
/* @var $totalCount int */

use yii\helpers\BaseUrl;
?>
<!--Right Side Cart Start-->
<div class="shopcrt">
    <h6>Shopping cart ( <span><?=$totalCount?></span> )</h6>
    <div class="BuyYesUlLoad"></div>
    <div class="grydiv">
        <div class="spctht">
            <?php if($cartArray) {?>
                <?php foreach($cartArray as $shopName => $cartItem) {?>
                    <span class="shptit"><?=$shopName?> <em class="shopTotalPrice"><?=Yii::$app->securityTools->cnyToUsd($cartItem['totalMoney'])?></em><em style="margin-right: 0;">$</em></span>
                    <ul class="spcrtul">
                        <?php foreach($cartItem['list'] as $item) {?>
                        <li style="border: 0px;">
                            <a href="<?=$item['url']?>" class="prodcta" title=""><img src="http:<?=$item['photoUrl']?>" alt=""></a>
                            <div class="protms">
                                <p class="limitwd" title="<?=$item['name']?>"><?=$item['name']?></p>
                                <p class="limitwd col999" title="<?=$item['remark']?>"><?=$item['remark']?></p>
                                <p class="addtjbtn">
                                    <span class="btnmins itemsQTYMinus">–</span>
                                    <input type="text" value="<?=$item['amount']?>" class="flo centers arial cartItemQty" data-cartid="<?=$item['id']?>" data-oldnum="<?=$item['amount']?>" style="width:38px;height:18px;line-height:18px;">
                                    <span class="btnplus itemsQTYAdd">+</span>
                                    <em class="prcjg">$<?=Yii::$app->securityTools->cnyToUsd($item['price'])?></em>
                                </p>
                            </div>
                            <em class="closeX" onclick="RightSideCartManager.itemDelete(<?=$item['id']?>)"></em>
                        </li>
                        <?php }?>

                    </ul>
                <?php }?>
            <?php } else {?>
                <p class="cartBox-box">Want it? Then add it to cart.</p>
            <?php }?>
        </div>
        <p class="totlprc">
            Total:
            <span>
                <span class="font18 redtips" id="alltotalprice">$<?=Yii::$app->securityTools->cnyToUsd($totalMoney)?></span>
            </span>
        </p>
        <a href="<?= BaseUrl::to(array('cart/shopping-cart'), true);?>" class="chekot" style="white-space: pre-line;">支付订单</a>
    </div>
</div>
<script>
    var RightSideCartManager ={
        init: function() {
            //增加商品数量
            this.itemsQTYAdd();
            //减少商品数量
            this.itemsQTYMinus();
            //光标离开商品数量文本框
            this.itemQTYTextKeyUp();
        },

        itemsQTYAdd: function() {
            $(".itemsQTYAdd").bind("click", function () {
                var numInput = $(this).prev();//原有数量
                var afterAddOne = RightSideCartManager.intAddOne(numInput); //新数量
                RightSideCartManager.itemQTYChanged(numInput, afterAddOne);
            });
        },

        itemsQTYMinus: function () {
            $(".itemsQTYMinus").bind("click", function () {
                var numInput = $(this).next();//原有数量
                var afterMinusOne = RightSideCartManager.intMinusOne(numInput); //新数量
                RightSideCartManager.itemQTYChanged(numInput, afterMinusOne);
            });
        },

        itemQTYTextKeyUp: function () {
            $(".cartItemQty").bind("blur", function () {
                RightSideCartManager.checkInt(this);
                var amount = $(this).val();
                RightSideCartManager.itemQTYChanged(this, amount);
            });
        },

        intAddOne: function (obj) {
            //数字加1
            var toObjId = obj;

            if (typeof ($(toObjId).val()) == "undefined") {
                return 1;
            }
            var addOne = parseInt($(toObjId).val()) + 1;

            if (addOne >= 10000) {
                addOne = 1;
            }

            return addOne;
        },

        intMinusOne: function (obj) {
            //数字减1
            var toObjId = obj;

            if (typeof ($(toObjId).val()) == "undefined") {
                return 1;
            }

            var nowvalue = parseInt($(toObjId).val());

            if (nowvalue > 1) {
                return nowvalue - 1;
            }

            return 1;
        },

        checkInt: function (object) {
            //验证只能是整数
            var reg = /^[0-9]*$/;
            if ($.trim($(object).val()) == "" || $(object).val() == "0") {
                $(object).val("1");
            }
            if (!reg.test($(object).val())) {
                $(object).val("1");
            } else {
                if (parseInt($(object).val()) >= 10000) {
                    $(object).val("1");
                }
            }
        },

        itemQTYChanged: function (numInput, amount) {
            //改完数量后的处理data-cartid
            var numInputObj = $(numInput);


            var oldAmount = numInputObj.attr("data-oldnum");

            if (amount == oldAmount) {
                //same
                return false;
            }

            var cartId = numInputObj.attr("data-cartid");

            $.ajax({
                url: "<?= BaseUrl::to(array('cart/update-cart-item-amount'), true);?>",
                dataType: "json",
                cache: false,
                type: 'POST',
                data: { cartId: cartId, amount: amount, "<?=Yii::$app->request->csrfParam?>": '<?=Yii::$app->request->getCsrfToken()?>' },
                success: function (data) {
                    if (data.result == true) {

                        var amountBacked = data.data.amount;

                        var shopTotalPriceUsd = data.data.shopTotalMoneyUsd;

                        var totalPriceUsd = data.data.totalMoneyUsd;

                        numInputObj.val(amountBacked);

                        numInputObj.attr("data-oldnum", amountBacked);
                        $(numInputObj).parents(".spcrtul").prev().find("em.shopTotalPrice").html(shopTotalPriceUsd);
                        $("#alltotalprice").text("$" + totalPriceUsd);

                        currentCartList = 0;
                    }
                }
            });

        },
        itemDelete: function(cartId) {
            $.ajax({
                url: "<?= BaseUrl::to(array('cart/delete-cart-item-right'), true);?>",
                dataType: "json",
                type: 'POST',
                cache: false,
                data:{cartId:cartId, "<?=Yii::$app->request->csrfParam?>": '<?=Yii::$app->request->getCsrfToken()?>'},
                success: function (data) {
                    if (data.result == true) {
                        $(".shopcrt").html(data.data);
                        currentCartList = 0;
                    }
                }
            });
        }
    };

    $(document).ready(function () {
        RightSideCartManager.init();
    });
</script>
<!--Right Side Cart End-->