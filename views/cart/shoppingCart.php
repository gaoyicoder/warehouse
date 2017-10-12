<?php
/**
 * Created by PhpStorm.
 * User: gaoyi
 * Date: 9/25/17
 * Time: 4:22 PM
 */

/* @var $this \yii\web\View */

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
                        <strong class="flo marr5">Domestic Express</strong>
                        <div class="flo shipdoubt" style="cursor:pointer">
                            <img src="http://img.yoybuy.com/V6/Common/doubt.png" id="DomesticShipmentDesc" width="15" height="15">
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
        <table cellpadding="0" cellspacing="0" width="100%" class="clear collapse centers mar10">
            <tbody>
            <tr class="carbor current">
                <td width="36%">
                    <div class="clear ove weightitem" data-flag="2964916">
                        <p class="flo carinput">
                            <input type="checkbox" class="norinput mar30 selectItem" data-price="258.00" data-cartid="2964916" data-freight="0" data-totalprice="258.00" data-shopurl="http://shop142057283.taobao.com" data-goodsname="铝框拉杆箱20旅行箱24行李箱28学生密码箱包皮箱子万向轮26寸男女" checked="checked">
                        </p>
                        <p class="flo cartimgs marr20">
                            <a href="http://www.yoybuy.com/en/show/528465917423/" class="product70">
                                <img data-src="" class="loaddingImg" width="70" height="70" src="https://img.alicdn.com/bao/uploaded/i4/2594360131/TB2pozstXXXXXb2XpXXXXXXXXXX_!!2594360131.jpg_70x70q90.jpg">
                            </a>
                        </p>
                        <ul>
                            <li><a href="http://www.yoybuy.com/en/show/528465917423/" class="norcol orangea" title="铝框拉杆箱20旅行箱24行李箱28学生密码箱包皮箱子万向轮26寸男女" target="_blank">铝框拉杆箱20旅行箱24行李箱28学生密码箱包皮箱子万向轮26寸男女</a></li>
                            <li class="mar5"><textarea class="flo col666 arial goodsRemark" data-cartid="2964916" data-oldremark="颜色分类:小包角铝框镜面【玫瑰金】;尺寸:24寸;" style="width: 283px; height: 34px; overflow-y: hidden;">颜色分类:小包角铝框镜面【玫瑰金】;尺寸:24寸;</textarea></li>
                        </ul>

                    </div>
                </td>
                <td width="12%">$40.95</td>
                <td width="14%">
                    <div class="clear ove mailtip">
                        <a class="flo cartadd marr5 mar5 itemsQTYMinus" title="minus"><img src="http://img.yoybuy.com/V6/ShoppingCart/cartcut.png" width="20" height="20"></a>
                        <input type="text" value="1" class="flo centers marr5 arial cartItemQty" data-cartid="2964916" data-oldnum="1" style="width:42px;height:22px;line-height:22px;">
                        <a class="flo cartadd mar5 itemsQTYAdd" title="add"><img src="http://img.yoybuy.com/V6/ShoppingCart/cartadd.png" width="20" height="20"></a>
                    </div>
                </td>
                <td width="14%">$0</td>
                <td width="12%"><strong class="font14 redtips" id="totalPrice_2964916">$40.95</strong></td>
                <td width="12%">
                    <a class="flo marr20 padl40 addToFavoriteItem" data-cartid="2964916" title="add to Favorite" isfavorite="false">
                        <img src="http://img.yoybuy.com/V6/ShoppingCart/heartno.png" width="17" height="17">
                    </a>

                    <a class="flo delete spcart_listj" data-cartid="2964916"></a>



                </td>
            </tr>

            <tr>
                <td colspan="6" class="col666 cartaddress">
                    <span class="floR marl15">Website: Yoybuy.com</span>
                    <span class="floR marl5">Shop: <a href="http://shop142057283.taobao.com" class="col666 wei" title="柠檬镇衣衣">柠檬镇衣衣</a></span>
                    <span class="floR mar8"><img src="http://img.yoybuy.com/V6//ShoppingCart/shopico.png" width="17" height="15"></span>
                </td>
            </tr>
            </tbody>
        </table>
        <table cellpadding="0" cellspacing="0" width="100%" class="clear collapse centers mar10">
            <tbody>
            <tr class="carbor current">
                <td width="36%">
                    <div class="clear ove weightitem" data-flag="2964915">
                        <p class="flo carinput">
                            <input type="checkbox" class="norinput mar30 selectItem" data-price="24.00" data-cartid="2964915" data-freight="12.00" data-totalprice="36.00" data-shopurl="http://shop115870211.taobao.com" data-goodsname="进口YAMAWA螺旋N-SP丝攻UNC8-32 4-40 10-32 1/4-20美制螺旋丝锥" checked="checked">
                        </p>
                        <p class="flo cartimgs marr20">
                            <a href="http://www.yoybuy.com/en/show/43347324183/" class="product70">
                                <img data-src="" class="loaddingImg" width="70" height="70" src="https://img.alicdn.com/bao/uploaded/i4/2360411990/TB21Pm9kpXXXXbhXpXXXXXXXXXX_!!2360411990.jpg_70x70q90.jpg">
                            </a>
                        </p>
                        <ul>
                            <li><a href="http://www.yoybuy.com/en/show/43347324183/" class="norcol orangea" title="进口YAMAWA螺旋N-SP丝攻UNC8-32 4-40 10-32 1/4-20美制螺旋丝锥" target="_blank">进口YAMAWA螺旋N-SP丝攻UNC8-32 4-40 10-32 1/4-20美制螺旋丝锥</a></li>
                            <li class="mar5"><textarea class="flo col666 arial goodsRemark" data-cartid="2964915" data-oldremark="颜色分类:UNC1/4-20螺旋;" style="width: 283px; height: 34px; overflow-y: hidden;">颜色分类:UNC1/4-20螺旋;</textarea></li>
                        </ul>

                    </div>
                </td>
                <td width="12%">$3.81</td>
                <td width="14%">
                    <div class="clear ove mailtip">
                        <a class="flo cartadd marr5 mar5 itemsQTYMinus" title="minus"><img src="http://img.yoybuy.com/V6/ShoppingCart/cartcut.png" width="20" height="20"></a>
                        <input type="text" value="1" class="flo centers marr5 arial cartItemQty" data-cartid="2964915" data-oldnum="1" style="width:42px;height:22px;line-height:22px;">
                        <a class="flo cartadd mar5 itemsQTYAdd" title="add"><img src="http://img.yoybuy.com/V6/ShoppingCart/cartadd.png" width="20" height="20"></a>
                    </div>
                </td>
                <td width="14%">$1.90</td>
                <td width="12%"><strong class="font14 redtips" id="totalPrice_2964915">$5.71</strong></td>
                <td width="12%">
                    <a class="flo marr20 padl40 addToFavoriteItem" data-cartid="2964915" title="add to Favorite" isfavorite="false">
                        <img src="http://img.yoybuy.com/V6/ShoppingCart/heartno.png" width="17" height="17">
                    </a>

                    <a class="flo delete spcart_listj" data-cartid="2964915"></a>



                </td>
            </tr>

            <tr>
                <td colspan="6" class="col666 cartaddress">
                    <span class="floR marl15">Website: Yoybuy.com</span>
                    <span class="floR marl5">Shop: <a href="http://shop115870211.taobao.com" class="col666 wei" title="臻鼎刀具五金">臻鼎刀具五金</a></span>
                    <span class="floR mar8"><img src="http://img.yoybuy.com/V6//ShoppingCart/shopico.png" width="17" height="15"></span>
                </td>
            </tr>
            </tbody>
        </table>
        <table cellpadding="0" cellspacing="0" width="100%" class="clear collapse centers mar10">
            <tbody>
            <tr class="carbor current">
                <td width="36%">
                    <div class="clear ove weightitem" data-flag="2953533">
                        <p class="flo carinput">
                            <input type="checkbox" class="norinput mar30 selectItem" data-price="120.00" data-cartid="2953533" data-freight="0" data-totalprice="1440.00" data-shopurl="http://shop111419850.taobao.com" data-goodsname="FLYCO electric razor FS337 genuine, full body wash, smart LCD display, charging type, three men, independent" checked="checked">
                        </p>
                        <p class="flo cartimgs marr20">
                            <a href="http://www.yoybuy.com/en/show/535608330129/" class="product70">
                                <img data-src="" class="loaddingImg" width="70" height="70" src="https://img.alicdn.com/bao/uploaded/i3/1113969501/TB2o1d9XIaCJuJjy1zkXXbelVXa_!!1113969501.jpg_70x70q90.jpg">
                            </a>
                        </p>
                        <ul>
                            <li><a href="http://www.yoybuy.com/en/show/535608330129/" class="norcol orangea" title="FLYCO electric razor FS337 genuine, full body wash, smart LCD display, charging type, three men, independent" target="_blank">FLYCO electric razor FS337 genuine, full body wash, smart LCD display, charging type, three men, independent</a></li>
                            <li class="mar5"><textarea class="flo col666 arial goodsRemark" data-cartid="2953533" data-oldremark="color:FLYCO 337 official with 1 knives, knife blade cloth bag;" style="width: 283px; height: 40px; overflow-y: hidden;">color:FLYCO 337 official with 1 knives, knife blade cloth bag;</textarea></li>
                        </ul>

                    </div>
                </td>
                <td width="12%">$19.05</td>
                <td width="14%">
                    <div class="clear ove mailtip">
                        <a class="flo cartadd marr5 mar5 itemsQTYMinus" title="minus"><img src="http://img.yoybuy.com/V6/ShoppingCart/cartcut.png" width="20" height="20"></a>
                        <input type="text" value="12" class="flo centers marr5 arial cartItemQty" data-cartid="2953533" data-oldnum="12" style="width:42px;height:22px;line-height:22px;">
                        <a class="flo cartadd mar5 itemsQTYAdd" title="add"><img src="http://img.yoybuy.com/V6/ShoppingCart/cartadd.png" width="20" height="20"></a>
                    </div>
                </td>
                <td width="14%">$0</td>
                <td width="12%"><strong class="font14 redtips" id="totalPrice_2953533">$228.57</strong></td>
                <td width="12%">
                    <a class="flo marr20 padl40 addToFavoriteItem" data-cartid="2953533" title="add to Favorite" isfavorite="false">
                        <img src="http://img.yoybuy.com/V6/ShoppingCart/heartno.png" width="17" height="17">
                    </a>

                    <a class="flo delete spcart_listj" data-cartid="2953533"></a>



                </td>
            </tr>

            <tr>
                <td colspan="6" class="col666 cartaddress">
                    <span class="floR marl15">Website: Yoybuy.com</span>
                    <span class="floR marl5">Shop: <a href="http://shop111419850.taobao.com" class="col666 wei" title="潇洒的风66289">潇洒的风66289</a></span>
                    <span class="floR mar8"><img src="http://img.yoybuy.com/V6//ShoppingCart/shopico.png" width="17" height="15"></span>
                </td>
            </tr>
            </tbody>
        </table>
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
                <a class="flo norcol noline orangea tofavorite" id="addToFavorite">Add to favorite</a>
                <a class="floR yellowbut" style="width:170px;margin-left:20px;" id="CartCheckout">Pay</a>

                <strong class="floR font14" style="margin-left:30px;">
                    Total Payment:
                    <span class="font18 redtips" id="alltotalprice">$275.24</span>
                </strong>
                <span class="floR">My Balance: <strong class="redtips font14">$0</strong></span>
            </div>
        </div>
        <div class="clear ove">
            <a href="http://www.yoybuy.com/en/addurloptimize.html" class="floR norcol mar15">Add more items &gt;&gt;</a>
        </div>

    </div>
    <!-- //content -->
</div>
<script>
    var ShoppingCartManager = {
        init: function(){
            this.bindEvent();
        }

        bindEvent: function() {
            
        }
    };

    $(function(){
        ShoppingCartManager.init();
    });
</script>
<!--Content End-->