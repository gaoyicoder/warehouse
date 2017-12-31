<?php
/**
 * Created by PhpStorm.
 * User: gaoyi
 * Date: 11/21/17
 * Time: 4:14 PM
 */
/* @var $user \app\models\User
 * @var $itemsCount integer
 * @var $orderItemList Array
 * @var $order \app\models\Order
 */
use yii\helpers\BaseUrl;
$this->registerCssFile('@web/css/order/payOrder.css', ['depends'=>['app\assets\AppAsset']]);
?>
<div id="container" class="clear ove padb90">
    <div id="content">
        <?=$this->render('/layouts/shoppingSteps', ['shoppingStep' => 2])?>
        <div class="clear ove mar20">
            <div class="flo ove stepL">
                <div class="clear mar25">
                    <p class="flo verdana font17 marr10 padb15"><strong><?=Yii::t('app/order', 'Choose your prefer payment method') ?></a></li></strong></p>
                    <div class="flo shipdoubt mar5">
                        <img src="<?=Yii::getAlias('@imagePath'); ?>/order/doubt.png" width="15" height="15" id="paymentHelp" style="cursor:pointer">
                        <div class="ark-poptip" style="position:absolute;top:-25px;left:22px;z-index:10;width:430px;display:none" id="paymentHelpTips">
                            <div class="ark-poptip-container" style="padding:13px 15px;">
                                <div class="ark-poptip-arrow" style="top:20px;left:-6px;">
                                    <em style="top:0;left:-1px;color:#83C3F5;">♦</em><span>♦</span>
                                </div>
                                <div class="ark-poptip-content">
                                    <p>
                                        <?=Yii::t('app/order', '<strong>Attention:</strong> no matter what currency you pay to us, it will be converted into US Dollar, Currently the exchange rate is 1:{usdRate}, which will be adjusted according to the exchange rate of Bank of China from time to time.', ['usdRate' => number_format(Yii::$app->params['usdRate'], 2)]) ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clear ove methodtip">
                    <input name="" id="chkVirtualAccount" type="checkbox" value="0" disabled="disabled" class="flo marr10 norinput">
                    <ul class="flo col666 marr10">
                        <li><strong class="font14 marr25"><?=Yii::t('app/order', 'Use my account balance')?></strong><span class="marr25"><?=Yii::t('app/order', 'My balance')?>: <strong class="font14">$<?=number_format($user->balance, 2)?></strong></span><span><a href="https://account.yoybuy.com/en/AddMoney"><?=Yii::t('app/order', 'Add money')?> &gt;&gt;</a></span></li>
                    </ul>
                </div>

                <div class="clear ove padl19 mar15">
                    <p class="newcoptit">
                        <a class="norcol noline">
                            <span class="flo mar2 marr15"><img id="btnUseCoupon" data-coupon-use="true" style="cursor: pointer;" src="<?=Yii::getAlias('@imagePath'); ?>/order/expansion.png" width="16" height="16"></span>
                            <strong class="flo font14"><?=Yii::t('app/order', 'Use the coupon')?></strong>
                        </a>
                    </p>
                    <div class="clear ove newcopcon mar12" id="divCouponContainer">
                        <div class="clear ove newcoptits">
                            <strong class="flo font14"><?=Yii::t('app/order', 'Choose A Coupon')?>:</strong>
                            <span class="floR font14 redtips">* <?=Yii::t('app/order', 'You do not have coupon')?>!</span>
                        </div>
                        <div class="clear" style="max-height:300px;overflow-y:auto;" id="divInnerCouponContainer">
                        </div>
                    </div>
                </div>
                <div class="clear ove padl19 mar15">
                    <p class="newcoptit">
                        <a class="norcol noline">
                            <span class="flo mar2 marr15"><img id="btnUseOuterCoupon" data-coupon-use="false" style="cursor: pointer;" src="<?=Yii::getAlias('@imagePath'); ?>/order/combine.png" width="16" height="16"></span>
                            <strong class="flo font14"><?=Yii::t('app/order', 'Coupon Code ( Optional )')?></strong>
                        </a>
                    </p>
                    <div class="clear ove newcopcon mar12" id="divOuterCouponContainer" style="display:none">
                        <div class="clear ove newcoptits">
                            <strong class="flo font14"><?=Yii::t('app/order', 'Use coupon code')?>:</strong>
                        </div>
                        <div class="clear" style="max-height:300px;overflow-y:auto;" id="divInnerOuterCouponContainer">
                            <div class="clear ove couponone font14">
                                <input type="text" style="width:243px;" class="flo" placeholder="<?=Yii::t('app/order', 'Input coupon code')?>" id="txtCouponCode">
                                <a class="flo yellowbut" style="width:98px;height:32px;line-height:28px;font-size:14px;font-weight:normal;border-radius:2px;margin-top:3px;cursor: pointer;margin-left:10px;" id="useCouponCode"><?=Yii::t('app/order', 'Apply')?></a>
                                <span id="useCoding" class="clear ove font14 redtips flo" style="padding:10px;"></span>
                                <a class="flo yellowbut" style="width: 98px; height: 32px; line-height: 28px; font-size: 14px; font-weight: normal; border-radius: 2px; margin-top: 3px; cursor: pointer; margin-left: 10px; display: none;" id="removeCouponCode">Remove</a>
                            </div>
                            <div class="clear ove couponone font14 redtips" id="couponCodeTips" style="display:none;clear:both"></div>
                        </div>
                    </div>
                </div>

                <div style="clear:both;height:10px;">&nbsp;</div>
                <div class="clear ove" id="onlinePayDiv" style="margin-top:10px;">

                    <div class="clear ove shipone">
                        <label class="flo shipinput mar8 marr5" for="">
                            <input type="radio" class="norinput" name="rdoThirdPay" value="aliPay" style="cursor:pointer">
                            <span></span>
                        </label>
                        <p class="flo shipp marr10"><img src="<?=Yii::getAlias('@imagePath'); ?>/order/alipay.jpg" width="84" height="30" class="marauto"></p>
                        <dl class="flo paymentdl">
                            <dt>
                                <span class="flo col666"><?=Yii::t('app/order', 'Pay On-line by Alipay Online, the handling fee is <strong>{handingFee}</strong>.', ['handingFee' => Yii::$app->params['paymentType']['aliPay']['handingFeeText']])?></span>
                            </dt>
                        </dl>
                    </div>


                    <div class="clear ove shipone" id="deletePay">
                        <label class="flo shipinput mar8 marr5" for="">
                            <input type="radio" class="norinput" name="rdoThirdPay" value="payPal" style="cursor:pointer" data-payoff="payoff">
                            <span></span>
                        </label>
                        <p class="flo shipp marr10"><img src="<?=Yii::getAlias('@imagePath'); ?>/order/paypal.png" width="84" height="30" class="marauto"></p>
                        <dl class="flo paymentdl col666">
                            <dt>
                                <span class="flo col666"><?=Yii::t('app/order', 'Pay On-line by Paypal, the handling fee is <strong>{handingFee}</strong>, for one transaction there is a limit for 2000USD.', ['handingFee' => Yii::$app->params['paymentType']['payPal']['handingFeeText']])?></span>
                            </dt>
                        </dl>
                    </div>

                </div>
                <div class="clear ove mar25">
                    <p class="clear"><strong class="font14 marr5"><?=Yii::t('app/order', 'Items List')?></strong><span>(<?=$itemsCount?> <?=Yii::t('app/order', 'items')?>)</span></p>
                    <table cellpadding="0" cellspacing="0" width="100%" class="centers weightab mar12">
                        <tbody><tr bgcolor="F5F5F5" class="weighthead">
                            <td width="62%"><strong><?=Yii::t('app/order', 'Items')?></strong></td>
                            <td width="13%"><strong><?=Yii::t('app/order', 'QTY')?></strong></td>
                            <td width="25%"><strong><?=Yii::t('app/order', 'Subtotal')?></strong></td>
                        </tr>
                        <? /* @var $orderItem \app\models\OrderItem */?>
                        <? foreach($orderItemList as $orderItem) {?>
                        <tr>
                            <td>
                                <div class="clear ove weightitem">
                                    <p class="flo marr20"><a href="<?=$orderItem->url;?>" target="_blank" class="product70"><img src="<?=$orderItem->photoUrl;?>" width="70" height="70"></a></p>
                                    <ul class="flo mar15">
                                        <li><a href="<?=$orderItem->url;?>" class="norcol orangea" title="<?=$orderItem->name;?>"><?=$orderItem->name;?></a></li>
                                        <li>
                                            <em>
                                                <?=$orderItem->remark?>
                                            </em>
                                        </li>
                                    </ul>
                                </div>

                            </td>
                            <td><?=$orderItem->amount?></td>
                            <td>$<?=$orderItem->priceUsd?></td>
                        </tr>
                        <?}?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="floR stepR" id="rightPay" style="">
                <div class="clear summery">
                    <div class="clear sumcont">
                        <p class="centers font14"><strong><?=Yii::t('app/order', 'Payment Summary')?></strong></p>
                        <div class="clear mar15">
                            <div class="clear ove payborder sumone">
                                <div class="flo sumoneL"><?=Yii::t('app/order', 'Items subtotal')?>:</div>
                                <span class="floR sumoneR">$<strong id="subtotal"><?=$order->subtotalUsd?></strong></span>
                            </div>
                            <div class="clear ove payborder sumone padb15">
                                <div class="flo sumoneL"><?=Yii::t('app/order', 'Coupons')?>:</div>
                                <span class="floR sumoneR">$<b id="coupons">0</b></span>
                            </div>
                            <div class="clear ove  sumlast" id="onlineDiv" style="display: none">
                                <ul class="flo">
                                    <li><b id="PayMethodName"></b> <?=Yii::t('app/order', 'handling fee')?><em id="PayMethodNameFee" class="gray">(4%)</em>:</li>
                                </ul>
                                <span class="floR">$<b id="PayMethodNamePrice"></b></span>
                            </div>
                        </div>
                    </div>
                    <p class="clear ove font18 centers mar20"><strong><?=Yii::t('app/order', 'Total Amount')?>: &nbsp;<span class="redtips">$<b id="ShouldPay"><?=$order->subtotalUsd?></b></span></strong></p>
                    <a class="clear ove marauto mar20 yellowbut" style="width: 255px; height: 42px; line-height: 42px; border-radius: 4px; background-color: rgb(204, 204, 204);" id="gotoPay"><?=Yii::t('app/order', 'Pay')?></a>
                </div>
                <p class="clear ove centers gray mar12"><?=Yii::t('app/order', 'Every order you place with us is safe and secure.')?></p>
                <p class="clear ove mar5">
                    <img src="<?=Yii::getAlias('@imagePath'); ?>/order/versign.png" width="63" height="33" class="floR marr5">
                </p>
            </div>
        </div>
    </div>
</div>
<script>
    $(function(){
        PayManager.init('<?=$order->id?>', <?=$order->subtotalUsd?>, <?=$user->balance?>);
    });
</script>
<script>
    var PayManager = {

        couponsAmount: 0,//优惠券
        couponsCode: '',//优惠码
        userBalance: 0,//账户余额
        totalAmount: 0,//订单总金额
        orderId: '',//订单编号
        useVirtualAccountAmount: 0, //虚拟账户支付金额
        thirdPayment: "",//在线支付方式
        thirdPayAmount: 0,//第三方支付金额
        onlinePrice: 0,//在线手续费
        payTotal: 0,//实际支付金额


        init: function(orderId, totalAmount, userBalance) {

            this.userBalance = userBalance;
            this.totalAmount = totalAmount;
            this.orderId = orderId;

            //右侧样式
            $("#rightPay").css("position", "fixed");
            var rightPay = document.getElementById("rightPay");
            var w = document.body.scrollWidth;
            if (w <= 1230) {
                rightPay.style.left = "915px";
            } else if (w > 1230) {
                var nw = w - 1230;
                rightPay.style.left = nw / 2 + 925 + "px";
            }
            window.onresize = function () {
                var w = document.body.scrollWidth;
                if (w <= 1230) {
                    rightPay.style.left = "925px";
                } else if (w > 1230) {
                    var nw = w - 1230;
                    rightPay.style.left = nw / 2 + 925 + "px";
                }
            };
            window.onscroll = function () {
                var t = document.documentElement.scrollTop || document.body.scrollTop;
                var h = document.body.scrollHeight - 600 - 400;
                if (t >= $("#header").height()) {
                    rightPay.style.top = "50px";
                    if (t >= h) {
                        rightPay.style.display = "none";
                    } else {
                        rightPay.style.display = "block";
                    }
                } else {
                    rightPay.style.top = ($("#header").height() + 85) + "px";
                }
            };
            $("#rightPay").show().css("top", ($("#header").height() + 85) + "px");

            //payment tips
            $("#paymentHelp").hover(function () {
                $("#paymentHelpTips").show();
            }, function () {
                $("#paymentHelpTips").hide();
            });

            //优惠券
            $("#btnUseCoupon").unbind("click").bind("click", function () {
                if ($(this).attr("data-coupon-use") == "false") {
                    $(this).attr("data-coupon-use", "true");
                    $(this).attr("src", "<?=Yii::getAlias('@imagePath'); ?>/order/expansion.png");
                    $("#divCouponContainer").show();
                } else {
                    $(this).attr("data-coupon-use", "false");
                    $(this).attr("src", "<?=Yii::getAlias('@imagePath'); ?>/order/combine.png");
                    $("#divCouponContainer").hide();
                }
                if ($("#btnUseOuterCoupon").attr("data-coupon-use")) {
                    $("#btnUseOuterCoupon").attr("data-coupon-use", "false");
                    $("#btnUseOuterCoupon").attr("src", "<?=Yii::getAlias('@imagePath'); ?>/order/combine.png");
                    $("#divOuterCouponContainer").hide();
                }
            });
            //优惠码
            $("#btnUseOuterCoupon").unbind("click").bind("click", function () {
                if ($(this).attr("data-coupon-use") == "false") {
                    $(this).attr("data-coupon-use", "true");
                    $(this).attr("src", "<?=Yii::getAlias('@imagePath'); ?>/order/expansion.png");
                    $("#divOuterCouponContainer").show();
                } else {
                    $(this).attr("data-coupon-use", "false");
                    $(this).attr("src", "<?=Yii::getAlias('@imagePath'); ?>/order/combine.png");
                    $("#divOuterCouponContainer").hide();
                }
                if ($("#btnUseCoupon").attr("data-coupon-use")) {
                    $("#btnUseCoupon").attr("data-coupon-use", "false");
                    $("#btnUseCoupon").attr("src", "<?=Yii::getAlias('@imagePath'); ?>/order/combine.png");
                    $("#divCouponContainer").hide();
                }
            });

            //ThirdPay
            $(":radio[name='rdoThirdPay']").prop("checked", false);
            $(":radio[name='rdoThirdPay']").unbind("change").bind("change", function () {
                PayManager.onlinePayRemoveClass();
                if ($(this).is(":checked")) {
                    var span = $(this).next("span");
                    var parentDiv = $(this).parent().parent();
                    span.css("background-color", "#FF6D36");
                    parentDiv.append("<p class=\"clear ove shipico\" name='payts'><img src=\"<?=Yii::getAlias('@imagePath'); ?>/order/shipone.png\" width=\"36\" height=\"36\" /></p>").addClass("newbg");
                    PayManager.thirdPayment = $(this).val();
                    $("#onlineDiv").show();
                }
                PayManager.computePayAmount();
                PayManager.checkPay();
            });

            PayManager.computePayAmount();
            PayManager.checkPay();

        },

        onlinePayRemoveClass: function () {
            $("input[name='rdoThirdPay']").each(function () {
                var span = $(this).next("span");
                var parentDiv = $(this).parent().parent();
                span.css("background-color", "#fff");
                parentDiv.removeClass("newbg");
                parentDiv.find("p[name='payts']").remove();
                PayManager.thirdPayment = "";
            });
        },

        computePayAmount: function() {
            //优惠券
            var coupons = this.couponsAmount;

            //使用虚拟帐户金额
            this.useVirtualAccountAmount = this.userBalance;

            //第三支付金额
            this.thirdPayAmount = this.totalAmount - coupons - this.useVirtualAccountAmount;
            if (this.thirdPayAmount <= 0) {
                this.thirdPayAmount = 0;
            }
            //隐藏三方支付
            if (this.thirdPayAmount <= 0) {
                this.onlinePayHid();
            } else {
                this.onlinePayShow();
            }

            var thirdPayType = $("input[name='rdoThirdPay']:checked").val();
            if (thirdPayType == "aliPay") {
                this.onlinePrice = Tools.formatNum(PayManager.thirdPayAmount * <?=Yii::$app->params['paymentType']['aliPay']['handingFee']?>, 2);
                $("#PayMethodName").text("Alipay");
                $("#PayMethodNameFee").text("(<?=Yii::$app->params['paymentType']['aliPay']['handingFeeText']?>)");
                $("#PayMethodNamePrice").text(this.onlinePrice);
            } else if (thirdPayType == "payPal") {
                this.onlinePrice = Tools.formatNum(PayManager.thirdPayAmount * <?=Yii::$app->params['paymentType']['payPal']['handingFee']?>, 2);
                $("#PayMethodName").text("PayPal");
                $("#PayMethodNameFee").text("(<?=Yii::$app->params['paymentType']['payPal']['handingFeeText']?>)");
                $("#PayMethodNamePrice").text(this.onlinePrice);
            } else {
                this.onlinePrice = 0;
            }

            if (this.thirdPayAmount > 0) {
                //+ parseFloat(this.useVirtualAccountAmount)
                this.payTotal = parseFloat(this.thirdPayAmount) + parseFloat(this.onlinePrice);
            } else {
                this.payTotal = parseFloat(this.useVirtualAccountAmount) + parseFloat(this.thirdPayAmount) + parseFloat(this.onlinePrice);
            }
            if (this.payTotal <= 0) {
                this.payTotal = 0;
            }
            this.payTotal = Tools.formatNum(this.payTotal, 2);
            $("#ShouldPay").text(this.payTotal);
        },

        checkPay: function () {
            // 没有选择虚拟账户，没有选择第三方支付
            var totalAmount = this.payTotal;
            var useVirtualAccountAmount = this.useVirtualAccountAmount;
            var thirdPayAmount = this.thirdPayAmount;
            var waitPayAmount;
            if (thirdPayAmount > 0) {
                waitPayAmount = parseFloat(thirdPayAmount) + parseFloat(this.onlinePrice);
            } else {
                waitPayAmount = parseFloat(useVirtualAccountAmount) + parseFloat(thirdPayAmount) + parseFloat(this.onlinePrice);
            }
            if (waitPayAmount <= 0) {
                waitPayAmount = 0;
            }
            if (useVirtualAccountAmount <= 0) {
                useVirtualAccountAmount = 0;
            }
            if (totalAmount != Tools.formatNum(waitPayAmount, 2)) {
                this.unbindSubmit();
                return false;
            } else if ((useVirtualAccountAmount) == waitPayAmount) {
                this.bindSubmit();
                return true;
            } else if (PayManager.thirdPayment != "") {
                this.bindSubmit();
                return true;
            }
            else {
                this.unbindSubmit();
                return false;
            }
        },

        onlinePayHid: function() {
            $("#onlinePayDiv").hide();
            $(":radio[name='rdoThirdPay']").attr("disabled", "disabled").removeAttr("checked");
            this.onlinePayRemoveClass();
            $("#onlineDiv").hide();
            PayManager.thirdPayment = "";
        },

        onlinePayShow: function () {
            $("#onlinePayDiv").show();
            $(":radio[name='rdoThirdPay']").removeAttr("disabled", "disabled");
        },

        unbindSubmit: function () {
            $("#gotoPay").unbind("click").css("background-color", "#ccc");
        },

        bindSubmit: function () {
            $("#gotoPay").css("background-color", "#f60").unbind("click").bind("click", function () {
                var orderId = PayManager.orderId;
                var payType = PayManager.thirdPayment;
                var useBalance = $("#chkVirtualAccount").is(":checked");
                if (payType == "") {
                    useBalance = "true";
                }
                PayManager.unbindSubmit();

                var body = $(document.body),
                    form = $("<form method='post'></form>"),
                    input;

                form.attr({"action":"<?= BaseUrl::to(array('payment/pay-order'), true);?>"});

                var args = [
                    ['orderId',orderId],
                    ['payType',payType],
                    ['useBalance',useBalance],
                    ['<?=Yii::$app->request->csrfParam?>', '<?=Yii::$app->request->getCsrfToken()?>']
                ];
                $.each(args,function(key,value){
                    input = $("<input type='hidden'>");
                    input.attr({"name":value[0]});
                    input.val(value[1]);
                    form.append(input);
                });
                form.appendTo(body);
                form.submit();

            });
        }

    }
</script>
