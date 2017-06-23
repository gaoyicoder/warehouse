<?php
/**
 * Created by PhpStorm.
 * User: gaoyi
 * Date: 6/16/17
 * Time: 3:24 PM
 */
use yii\helpers\BaseUrl;

$this->registerCssFile('@web/css/member/index.css', ['depends'=>['app\assets\AppAsset']]);
?>
<!--Right Box Start-->
<div class="right_box">

    <div class="uc_section01">
        <div class="left">
            <a href="http://customercenter.yoybuy.com/en/edituserinfo.html" class="flo userico">
                <img style="width:83px;height:83px;" src="http://img.yoybuy.com/20140808/pic_tx.png">
            </a>


            <ul class="flo">
                <li class="clear ove">
                    <strong class="flo font18 marr20">Hi, gaoyicoder</strong>

                    <a href="http://www.yoybuy.com/en/VIPClub/howtoupgradefaster.html"><img src="http://img.yoybuy.com/20150403/grade1.gif" width="85" height="19" class="flo"></a>
                </li>
                <li class="clear ove mar20">
                    <strong class="flo marr10"><a style="color: #000;">VIP</a></strong>
                            <span class="flo progress marr10">
                                    <em style="width:0% ;border-radius:5px;"></em>

                            </span>
                    <span class="flo gray">0/3000</span>
                    <em></em>
                </li>
                <li class="clear ove mar20">
                    <span class="marr25">My Balance: 0 CNY ≈  0 USD</span>
                    <a href="https://account.yoybuy.com/en/addmoney" class="orangetip norhover gray">Add Money&gt;</a>

                </li>
                <li class="clear ove mar10">
                    <a href="https://account.yoybuy.com/en/myyoybuypoints" class="norcol">My Points</a>: 200
                </li>

                <li class="clear ove">
                    <span class="flo mar15 marr5"><a href="http://customercenter.yoybuy.com/en/myprivileges.html" class="norcol">My Privilleges</a>:</span>

                    <a class="flo mar10 marr3" title="Benefits In YOYBUY Anniversary"><img src="http://img.yoybuy.com/20150403/privillege5.png" width="29" height="29"></a>


                </li>
            </ul>
        </div>
        <div class="right">
            <p class="tit"><strong><a style="color: black;" href="http://www.yoybuy.com/en/newsList.html" target="_blank" rel="nofollow">News</a></strong></p>
            <ul>

                <li><a href="http://www.yoybuy.com/en/newsDetail.html?id=289301" target="_blank">Dragon Boat Festival Notice In 2017</a><em>2017-05-25</em></li>
                <li><a href="http://www.yoybuy.com/en/newsDetail.html?id=289298" target="_blank">1688.com  WOMEN'S FASHION APPAREL! Ready for Stock up! ...</a><em>2017-05-17</em></li>
                <li><a href="http://www.yoybuy.com/en/newsDetail.html?id=289294" target="_blank">International Workers’  Day Notice In 2017</a><em>2017-04-27</em></li>
                <li><a href="http://www.yoybuy.com/en/newsDetail.html?id=289289" target="_blank">Qingming Holiday (2th-4th April) Notice In 2017</a><em>2017-03-31</em></li>
                <li><a href="http://www.yoybuy.com/en/newsDetail.html?id=289284" target="_blank">Resume Operation Notice! </a><em>2017-02-04</em></li>
            </ul>
        </div>
    </div>

    <div class="uc_section02">
        <h3 class="tit">
            <span class="flo" style="width:483px;">BuyForMe Service</span>
            <span class="flo">ShipForMe</span>
        </h3>
        <div class="left">
            <dl id="myItemsContent" style="">
                <dt style="width: 80px;"><a href="http://order.yoybuy.com/en/myorder"><strong>My Items</strong></a></dt>
                <dd>
                    <a href="http://order.yoybuy.com/en/order/myorder?type=Pending#tabs5">Pending<em id="myItemsContent_Pending">&nbsp;(0)</em></a>
                    <a href="http://order.yoybuy.com/en/order/myorder?type=AwaitPurchase#tabs6">Await Purchase<em id="myItemsContent_AwaitPurchace">&nbsp;(0)</em></a>
                    <a href="http://order.yoybuy.com/en/order/myorder?type=Inprocess#tabs7">In Process<em id="myItemsContent_InProcess">&nbsp;(0)</em></a>
                    <a href="http://order.yoybuy.com/en/order/myorder?type=Message#tabs13">Message<em id="myItemsContent_Message">&nbsp;(0)</em></a>
                    <a href="http://order.yoybuy.com/en/order/myorder?type=AwaitPayment#tabs8">Await Payment<em id="myItemsContent_AwaitPayment">&nbsp;(0)</em></a>
                    <a href="http://order.yoybuy.com/en/order/myorder?type=Bought#tabs9">Bought<em id="myItemsContent_Bought">&nbsp;(0)</em></a>
                    <a href="http://order.yoybuy.com/en/order/myorder?type=Arrived#tabs10">Arrived<em id="myItemsContent_Arrived">&nbsp;(0)</em></a>
                    <a href="http://order.yoybuy.com/en/order/myorder?type=Refund#tabs4">Refunded<em id="myItemsContent_Refunded">&nbsp;(0)</em></a>
                </dd>

            </dl>
            <dl id="myParcelsContent" style="">
                <dt style="width: 80px;"><a href="http://order.yoybuy.com/en/myparcels"><strong>My Parcels</strong></a></dt>
                <dd>
                    <a href="http://order.yoybuy.com/en/myparcels?crStateSelection=Pending">Pending<em id="myParcelsContent_Pending">&nbsp;(0)</em></a>

                    <a href="http://order.yoybuy.com/en/myparcels?crStateSelection=Processing">Processing<em id="myParcelsContent_Processing">&nbsp;(0)</em></a>
                    <a href="http://order.yoybuy.com/en/myparcels?crStateSelection=Await+payment">Await Payment<em id="myParcelsContent_AwaitPayment">&nbsp;(0)</em></a>
                    <a href="http://order.yoybuy.com/en/myparcels?crStateSelection=Shipped">Shipped<em id="myParcelsContent_Shipped">&nbsp;(0)</em></a>
                    <a href="http://order.yoybuy.com/en/myparcels?crStateSelection=Received">Received <em id="myParcelsContent_Received">&nbsp;(0)</em></a>
                    <a href="http://order.yoybuy.com/en/myparcels?crStateSelection=OK">OK<em id="myParcelsContent_OK">&nbsp;(0)</em></a>

                </dd>
            </dl>
            <div class="lodding" style="display: none;"></div>
        </div>
        <div class="hr04"></div>
        <div class="left right">

            <div>
                <dl id="myWarehouseContent" style="">
                    <dt style="width:150px;"><a href="http://order.yoybuy.com/en/chineseaddress.html"><strong>My Warehouse</strong><em id="myWarehouseContent_MyWarehouse" style="color:#f60;">&nbsp;(0)</em></a></dt>
                    <dd style="width:246px;">You can arrange delivery once your items status becomes "Arrived".</dd>
                </dl>
                <div class="lodding" style="display: none;"></div>
            </div>

            <dl id="myForwardingParcelContent" style="">
                <dt style="width: 150px;">
                    <a href="http://order.yoybuy.com/en/myforwardingparcels">
                        <strong>
                            My Forwarding

                            Parcels:
                        </strong>
                    </a>
                </dt>
                <dd style="width: 246px;">
                    <a href="http://order.yoybuy.com/en/myforwardingparcels?crStateSelection=Pending">
                        Pending<em id="myForwardingParcelContent_Pending">&nbsp;(0)</em>
                    </a>

                    <a href="http://order.yoybuy.com/en/myforwardingparcels?crStateSelection=Processing">
                        Processing<em id="myForwardingParcelContent_Process">&nbsp;(0)</em>
                    </a>
                    <a href="http://order.yoybuy.com/en/myforwardingparcels?crStateSelection=Await+payment">
                        Await Payment<em id="myForwardingParcelContent_AwaitPayment">&nbsp;(0)</em>
                    </a>
                    <a href="http://order.yoybuy.com/en/myforwardingparcels?crStateSelection=Shipped">
                        Shipped<em id="myForwardingParcelContent_Shipped">&nbsp;(0)</em>
                    </a>
                    <a href="http://order.yoybuy.com/en/myforwardingparcels?crStateSelection=Received">
                        Received<em id="myForwardingParcelContent_Received">&nbsp;(0)</em>
                    </a>
                    <a href="http://order.yoybuy.com/en/myforwardingparcels?crStateSelection=Ok">
                        OK<em id="myForwardingParcelContent_Ok">&nbsp;(0)</em>
                    </a>
                </dd>
            </dl>

            <div class="lodding" style="display: none;"></div>
        </div>
    </div>

    <div id="userView" class="uc_section04">
        <h3 class="tit">My Favorite<a href="http://shoppingcart.yoybuy.com/en/favorite.html">&gt;&gt;</a></h3>
        <span style="font-size:12px;color:#999;width: 978px; line-height: 180px; display: block; text-align: center;">No item here,go to save your favorite links now!</span>

    </div>
</div>
<!--Right Box End-->