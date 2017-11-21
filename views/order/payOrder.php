<?php
/**
 * Created by PhpStorm.
 * User: gaoyi
 * Date: 11/21/17
 * Time: 4:14 PM
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
                    <p class="flo verdana font17 marr10 padb15"><strong>Choose your prefer payment method</strong></p>
                    <div class="flo shipdoubt mar5">
                        <img src="http://img.yoybuy.com/v6/Common/doubt.png" width="15" height="15" id="paymentHelp" style="cursor:pointer">
                        <div class="ark-poptip" style="position:absolute;top:-25px;left:22px;z-index:10;width:430px;display:none" id="paymentHelpTips">
                            <div class="ark-poptip-container" style="padding:13px 15px;">
                                <div class="ark-poptip-arrow" style="top:20px;left:-6px;">
                                    <em style="top:0;left:-1px;color:#83C3F5;">♦</em><span>♦</span>
                                </div>
                                <div class="ark-poptip-content">
                                    <p>
                                        <strong>Attention:</strong> no matter what currency you pay to us, it will be converted into US Dollar, Currently the exchange rate is 1:6.30, which will be adjusted according to the exchange rate
                                        of Bank of China from time to time.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clear ove methodtip">
                    <input name="" id="chkVirtualAccount" type="checkbox" value="0" disabled="disabled" class="flo marr10 norinput">
                    <ul class="flo col666 marr10">
                        <li><strong class="font14 marr25">Use my account balance</strong><span class="marr25">My balance: <strong class="font14">$0.00</strong></span><span><a href="https://account.yoybuy.com/en/AddMoney">Add money &gt;&gt;</a></span></li>
                    </ul>
                </div>

                <div class="clear ove padl19 mar15">
                    <p class="newcoptit">
                        <a class="norcol noline">
                            <span class="flo mar2 marr15"><img id="btnUseCoupon" data-coupon-use="true" style="cursor: pointer;" src="/Content/Images/Common/expansion.png" width="16" height="16"></span>
                            <strong class="flo font14">Use the coupon</strong>
                        </a>
                    </p>
                    <div class="clear ove newcopcon mar12" id="divCouponContainer">
                        <div class="clear ove newcoptits">
                            <strong class="flo font14">Choose A Coupon:</strong>
                            <span class="floR font14 redtips">* You do not have coupon!</span>
                        </div>
                        <div class="clear" style="max-height:300px;overflow-y:auto;" id="divInnerCouponContainer">
                        </div>
                    </div>
                </div>
                <div class="clear ove padl19 mar15">
                    <p class="newcoptit">
                        <a class="norcol noline">
                            <span class="flo mar2 marr15"><img id="btnUseOuterCoupon" data-coupon-use="false" style="cursor: pointer;" src="/Content/Images/Common/combine.png" width="16" height="16"></span>
                            <strong class="flo font14">Coupon Code ( Optional )</strong>
                        </a>
                    </p>
                    <div class="clear ove newcopcon mar12" id="divOuterCouponContainer" style="display:none">
                        <div class="clear ove newcoptits">
                            <strong class="flo font14">Use coupon code:</strong>
                        </div>
                        <div class="clear" style="max-height:300px;overflow-y:auto;" id="divInnerOuterCouponContainer">
                            <div class="clear ove couponone font14">
                                <input type="text" style="width:243px;" class="flo" placeholder="Input coupon code" id="txtCouponCode">
                                <a class="flo yellowbut" style="width:98px;height:32px;line-height:28px;font-size:14px;font-weight:normal;border-radius:2px;margin-top:3px;cursor: pointer;margin-left:10px;" id="useCouponCode">Apply</a>
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
                            <input type="radio" class="norinput" name="rdoThirdPay" value="CreditCard" data-payvalue="1.86" data-value="1.86" data-feerate="0.035" style="cursor:pointer">
                            <span></span>
                        </label>
                        <p class="flo shipp marr10"><img src="http://img.yoybuy.com/v6/Common/CreditCard.jpg" width="49" height="30" class="marauto"></p>
                        <dl class="flo paymentdl col666">
                            <dt>
                                <span class="flo col666">Pay On-line by Credit Card, the handling fee is <strong>3.5%</strong>, for one transaction there is a limit for 2000USD.</span>
                            </dt>
                        </dl>
                    </div>
                    <div class="clear ove shipone">
                        <label class="flo shipinput mar8 marr5" for="">
                            <input type="radio" class="norinput" name="rdoThirdPay" value="Qiwi" data-payvalue="2.13" data-value="2.13" data-feerate="0.04" style="cursor:pointer">
                            <span></span>
                        </label>
                        <p class="flo shipp marr10"><img src="http://img.yoybuy.com/v6/Common/payment6a.png" width="61" height="30" class="marauto"></p>
                        <dl class="flo paymentdl">
                            <dt>
                                <span class="flo col666">Pay On-line by QIWI, the handling fee is <strong>4%</strong>, for one transaction there is a limit for 500USD.</span>
                            </dt>
                            <dd id="QiWiDiv" style="display:none">
                                <strong class="flo mar12 marr5">Mobile phone number:</strong>
                                <select id="qiwititle" name="qiwititle" class="flo marr4 arial" style="width:177px;">
                                    <option value="7" selected="selected">Russia +7</option>
                                    <option value="374">Armenia +374</option>
                                    <option value="994">Azerbaidzhan +994</option>
                                    <option value="55">Brazil +55</option>
                                    <option value="9955">Georgia +9955</option>
                                    <option value="44">GreatBritain +44</option>
                                    <option value="91">India +91</option>
                                    <option value="972">Israel +972</option>
                                    <option value="972">Izrael +972</option>
                                    <option value="81">Japan +81</option>
                                    <option value="77">Kazakhstan +77</option>
                                    <option value="996">Kyrgyzstan +996</option>
                                    <option value="3712">Latvia +3712</option>
                                    <option value="3706">Lithuania +3706</option>
                                    <option value="373">Moldova +373</option>
                                    <option value="5076">Panama +5076</option>
                                    <option value="992">Tajikistan +992</option>
                                    <option value="66">Thailand +66</option>
                                    <option value="90">Thailand +90</option>
                                    <option value="380">Ukraine +380</option>
                                    <option value="1">USA +1</option>
                                    <option value="998">Uzbekistan +998</option>
                                    <option value="84">Vietnam +84</option>
                                </select>
                                <input type="text" value="" class="flo arial" style="width:165px;" id="qiwiTel" size="10" name="qiwiTel">
                            </dd>
                        </dl>
                    </div>
                    <div class="clear ove shipone">
                        <label class="flo shipinput mar8 marr5" for="">
                            <input type="radio" class="norinput" name="rdoThirdPay" value="WebmoneyOnline" data-payvalue="1.06" data-value="1.06" data-feerate="0.02" style="cursor:pointer">
                            <span></span>
                        </label>
                        <p class="flo shipp marr10"><img src="http://img.yoybuy.com/v6/Common/payment18a.png" width="84" height="30" class="marauto"></p>
                        <dl class="flo paymentdl">
                            <dt>
                                <span class="flo col666">Pay On-line by WebMoney Online, the handling fee is <strong>2%</strong>.</span>
                            </dt>
                        </dl>
                    </div>


                    <div class="clear ove shipone" id="deletePay" style="display: none;">
                        <label class="flo shipinput mar8 marr5" for="">
                            <input type="radio" class="norinput" name="rdoThirdPay" value="PayPal" data-payvalue="1.86" data-value="1.86" data-feerate="0.035" style="cursor:pointer" data-payoff="payoff">
                            <span></span>
                        </label>
                        <p class="flo shipp marr10"><img src="http://img.yoybuy.com/v6/Common/paypal.png" width="84" height="30" class="marauto"></p>
                        <dl class="flo paymentdl col666">
                            <dt>
                                <span class="flo col666">Pay On-line by Paypal, the handling fee is <strong>3.5% + $0.300</strong>, for one transaction there is a limit for 2000USD.</span>
                            </dt>
                        </dl>
                    </div>

                </div>



                <div class="resultip ove" style="padding:14px 0 14px 10px; margin-top:10px;">
                    <em class="flo marr5"><img src="http://img.yoybuy.com/v6/Common/error.png" width="15" height="15"></em>
                    <strong class="flo font14 marr5">Tips:</strong>
                    <ul class="flo mar2">
                        <li>If your use Western Union, Webmoney or Wire Transfer, because the three method are non-real time, please <a href="https://account.yoybuy.com/en/addmoney" class="norhover">Add money</a> in your YOYBUY balance firstly.</li>
                    </ul>
                </div>

                <div class="clear ove mar25">
                    <p class="clear"><strong class="font14 marr5">Items List</strong><span>(2 items)</span>&nbsp;&nbsp; <strong style="color:red"><input type="button" onclick="DeleteTortJavascript('2017111417173633636289')" style="height:24px;line-height:24px;padding:0 10px;border:1px solid #ff6600;color:#ff6600;border-radius:4px;background:none" value="Remove the sensitive branded item"></strong></p>
                    <table cellpadding="0" cellspacing="0" width="100%" class="centers weightab mar12">
                        <tbody><tr bgcolor="F5F5F5" class="weighthead">
                            <td width="13%"><strong>ID</strong></td>
                            <td width="49%"><strong>Items</strong></td>
                            <td width="13%"><strong>QTY</strong></td>
                            <td width="25%"><strong>Subtotal</strong></td>
                        </tr>
                        <tr>
                            <td>6939877</td>
                            <td>
                                <div class="clear ove weightitem">
                                    <p class="flo marr20"><a href="https://item.taobao.com/item.htm?id=560448763378" target="_blank" class="product70"><img src="https://img.alicdn.com/bao/uploaded/i4/35148661/TB29J.BpbsTMeJjy1zeXXcOCVXa_!!35148661.jpg" width="70" height="70"></a></p>
                                    <ul class="flo mar15">
                                        <li><a href="https://item.taobao.com/item.htm?id=560448763378" class="norcol orangea" title="Light Sky Blue OrganzapiecesTrereeendy Sky Blue Suit For Women Suit For WomenSuiter">PS4 Authentic second-hand game CD sold/PS4 Genuine second-hand game recycling/redemption</a></li>
                                        <li>
                                            <em>

                                            </em></li>
                                    </ul>
                                </div>

                            </td>
                            <td>1</td>
                            <td>$13.97</td>
                        </tr>
                        <tr>
                            <td>6941957</td>
                            <td>
                                <div class="clear ove weightitem">
                                    <p class="flo marr20"><a href="https://item.taobao.com/item.htm?id=535608330129" target="_blank" class="product70"><img src="https://img.alicdn.com/bao/uploaded/i3/1113969501/TB2o1d9XIaCJuJjy1zkXXbelVXa_!!1113969501.jpg" width="70" height="70"></a></p>
                                    <ul class="flo mar15">
                                        <li><a href="https://item.taobao.com/item.htm?id=535608330129" class="norcol orangea" title="Light Sky Blue OrganzapiecesTrereeendy Sky Blue Suit For Women Suit For WomenSuiter">Fei Ke electric shaver FS337 genuine body wash Intelligent liquid crystal display rechargeable male three head Independent</a></li>
                                        <li>
                                            <em>
                                                <em style="color:red">Sensitive branded item, it cannot be paid by PayPal</em>

                                            </em></li>
                                    </ul>
                                </div>

                            </td>
                            <td>1</td>
                            <td>$20</td>
                        </tr>
                        </tbody></table>
                    <input type="hidden" value="1" id="paypalOff">
                    <script type="text/javascript">
                        $(function(){
                            var paypalOff = parseInt($.trim($("#paypalOff").val()));
                            if(paypalOff > 0)
                            {
                                $("#deletePay").css('display','none');
                            }
                            //if(paypalOff > 0)
                            //{
                            //    $("input[data-payoff=\"payoff\"]").parents(".shipone").css("background","#efefef");
                            //}
                            //else
                            //{
                            //    $("input[data-payoff=\"payoff\"]").parents(".shipone").css("background","");
                            //}
                            //$("input[data-payoff=\"payoff\"]").click(function(){

                            //    if(paypalOff > 0)
                            //    {
                            //        $("input[data-payoff=\"payoff\"]").attr("checked",false);

                            //    }
                            //    else
                            //    {
                            //        $("input[data-payoff=\"payoff\"]").attr("checked",true);
                            //    }
                            //})
                        })
                    </script>
                </div>
            </div>
            <div class="floR stepR" id="rightPay" style="display: block; position: fixed; left: 1057.5px; top: 384px;">
                <div class="clear summery">
                    <div class="clear sumcont">
                        <p class="centers font14"><strong>First payment Summary</strong></p>
                        <div class="clear mar15">
                            <div class="clear ove payborder sumone">
                                <div class="flo sumoneL">Items subtotal:</div>
                                <span class="floR sumoneR">$<strong id="subtotal">33.97</strong></span>
                            </div>
                            <div class="clear ove payborder sumone padb15">
                                <div class="flo sumoneL">coupons:</div>
                                <span class="floR sumoneR">$<b id="coupons">0</b></span>
                            </div>
                            <div class="clear ove  sumlast" id="onlineDiv" style="display: none;">
                                <ul class="flo">
                                    <li><b id="PayMethodName"></b> handling fee<em id="PayMethodNameFee" class="gray">(4%)</em>:</li>
                                </ul>
                                <span class="floR">$<b id="PayMethodNamePrice"></b></span>
                            </div>
                        </div>
                    </div>
                    <p class="clear ove font18 centers mar20"><strong>Total Amount: &nbsp;<span class="redtips">$<b id="ShouldPay">33.97</b></span></strong></p>
                    <a class="clear ove marauto mar20 yellowbut" style="width: 255px; height: 42px; line-height: 42px; border-radius: 4px; background-color: rgb(204, 204, 204);" id="gotoPay">Pay</a>
                </div>
                <p class="clear ove centers gray mar12">Every order you place with us is safe and secure.</p>
                <p class="clear ove mar5">
                    <img src="http://img.yoybuy.com/v6/BuyForMe/versign.png" width="63" height="33" class="floR marr5">
                </p>
            </div>
        </div>
    </div>
</div>
