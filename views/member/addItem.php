<?php
/**
 * Created by PhpStorm.
 * User: gaoyi
 * Date: 6/23/17
 * Time: 4:41 PM
 */

/* @var $this \yii\web\View */
/* @var $urlAddress string */


use yii\helpers\BaseUrl;

$this->registerCssFile('@web/css/member/addItem.css', ['depends'=>['app\assets\AppAsset']]);
?>
<!--Content Start-->
<div id="container" style="margin-bottom: 50px">
    <!-- content -->
    <div id="content">
        <div class="admi_section01">
            <div class="load loadadd" id="getgoodsloadingdiv" style="display: none;">
                <p>Please wait, loading item information ...</p>
            </div>
            <div class="goodsboxs">
                <div id="goodsinfodiv"><input type="hidden" data-name="Source" value="淘宝网">     <input type="hidden" data-name="ShopUrl" value="http://shop111419850.taobao.com">     <input type="hidden" data-name="Shop" value="潇洒的风66289">     <input type="hidden" data-name="DHLInvoiceDescription" value="">     <input type="hidden" data-name="NumIid" value="0">     <input type="hidden" data-name="Url" value="https://item.taobao.com/item.htm?spm=a230r.1.14.328.QUFKSj&amp;id=535608330129&amp;ns=1&amp;abbucket=8">     <div class="add_main addurlcont">         <div class="addurlft">             <div class="right">                 <div class="clear imglist box">                     <div class="imglistT">                         <div class="tb-booth tb-pic tb-s310">                             <a href="#"><img data-name="bigimage" src="https://img.alicdn.com/bao/uploaded/i4/1113969501/TB29sSWoUlnpuFjSZFjXXXTaVXa_!!1113969501.jpg" alt="" rel="https://img.alicdn.com/bao/uploaded/i4/1113969501/TB29sSWoUlnpuFjSZFjXXXTaVXa_!!1113969501.jpg_600x600.jpg" class="jqzoom" style="cursor: crosshair;"></a>                         </div>                     </div>                     <div class="imglistB">                                                  <a class="flo  hoverimg">                             <div class="imgdivcell"><img class="curr_base" src="https://img.alicdn.com/bao/uploaded/i4/1113969501/TB29sSWoUlnpuFjSZFjXXXTaVXa_!!1113969501.jpg_50x50.jpg" mid="https://img.alicdn.com/bao/uploaded/i4/1113969501/TB29sSWoUlnpuFjSZFjXXXTaVXa_!!1113969501.jpg" big="https://img.alicdn.com/bao/uploaded/i4/1113969501/TB29sSWoUlnpuFjSZFjXXXTaVXa_!!1113969501.jpg_600x600.jpg"></div>                         </a>                                                  <a class="flo">                             <div class="imgdivcell"><img class="curr_base" src="https://img.alicdn.com/bao/uploaded/i4/1113969501/TB2VRwRsFXXXXbKXpXXXXXXXXXX_!!1113969501.jpg_50x50.jpg" mid="https://img.alicdn.com/bao/uploaded/i4/1113969501/TB2VRwRsFXXXXbKXpXXXXXXXXXX_!!1113969501.jpg" big="https://img.alicdn.com/bao/uploaded/i4/1113969501/TB2VRwRsFXXXXbKXpXXXXXXXXXX_!!1113969501.jpg_600x600.jpg"></div>                         </a>                                                  <a class="flo">                             <div class="imgdivcell"><img class="curr_base" src="https://img.alicdn.com/bao/uploaded/i1/1113969501/TB25sNDsVXXXXXqXXXXXXXXXXXX_!!1113969501.jpg_50x50.jpg" mid="https://img.alicdn.com/bao/uploaded/i1/1113969501/TB25sNDsVXXXXXqXXXXXXXXXXXX_!!1113969501.jpg" big="https://img.alicdn.com/bao/uploaded/i1/1113969501/TB25sNDsVXXXXXqXXXXXXXXXXXX_!!1113969501.jpg_600x600.jpg"></div>                         </a>                                                  <a class="flo">                             <div class="imgdivcell"><img class="curr_base" src="https://img.alicdn.com/bao/uploaded/i2/1113969501/TB2KcAzsFXXXXXZXFXXXXXXXXXX_!!1113969501.jpg_50x50.jpg" mid="https://img.alicdn.com/bao/uploaded/i2/1113969501/TB2KcAzsFXXXXXZXFXXXXXXXXXX_!!1113969501.jpg" big="https://img.alicdn.com/bao/uploaded/i2/1113969501/TB2KcAzsFXXXXXZXFXXXXXXXXXX_!!1113969501.jpg_600x600.jpg"></div>                         </a>                                                  <a class="flo">                             <div class="imgdivcell"><img class="curr_base" src="https://img.alicdn.com/bao/uploaded/i2/1113969501/TB23zlCsVXXXXXkXXXXXXXXXXXX_!!1113969501.jpg_50x50.jpg" mid="https://img.alicdn.com/bao/uploaded/i2/1113969501/TB23zlCsVXXXXXkXXXXXXXXXXXX_!!1113969501.jpg" big="https://img.alicdn.com/bao/uploaded/i2/1113969501/TB23zlCsVXXXXXkXXXXXXXXXXXX_!!1113969501.jpg_600x600.jpg"></div>                         </a>                                               </div>                 </div>             </div>              <div class="left">                 <ul>                     <li class="all_error" data-name="addCartError" style="display: none;"></li>                     <li><span style="font-size: 12px">标题：</span><input style="width: 442px;" type="text" value="飞科电动剃须刀FS337正品 全身水洗智能液晶显示充电式男三头独立" maxlength="150" data-name="title" disabled="disabled"></li>                      <li><span style="font-size: 12px">Merchant:</span><input style="width: 442px;" type="text" value="潇洒的风66289" maxlength="150" data-name="title" disabled="disabled"></li>                      <li><span style="font-size: 12px">价格：</span><input type="text" value="145" data-name="pricermb" style="width: 60px" disabled="disabled"><em class="fh">CNY</em><em class="fh">≈</em><input type="text" data-name="priceusd" value="22.31" disabled="disabled" style="width: 60px" id=""><em class="fh">USD</em></li>                      <li><span style="font-size:12px">国内运费：</span><input type="text" value="0" data-name="shippingrmb" style="width: 60px" name="" id="" disabled="disabled"><em class="fh">CNY</em><em class="fh">≈</em><input data-name="shippingusd" type="text" style="width: 60px" disabled="disabled" value="0" name="" id=""><em class="fh">USD</em></li>                                           <li>                         <span style="font-size:12px">颜色：</span><div class="img_box cp_type">                                                                                       <a class="" style="cursor: pointer" data-prop="word" data-propid="1627207" data-propvalueid="1432715678">337充电器<em class="ico_dg"></em></a>                                                                                                                    <a class="" style="cursor: pointer" data-prop="word" data-propid="1627207" data-propvalueid="1783061753">337官配+3刀头+飞科鼻毛器+布袋<em class="ico_dg"></em></a>                                                                                                                    <a class="" style="cursor: pointer" data-prop="word" data-propid="1627207" data-propvalueid="1432537345">3刀头刀片<em class="ico_dg"></em></a>                                                                                                                    <a class="" style="cursor: pointer" data-prop="word" data-propid="1627207" data-propvalueid="1783061758">飞科337官方标配+收纳布袋<em class="ico_dg"></em></a>                                                                                                                    <a class="" style="cursor: pointer" data-prop="word" data-propid="1627207" data-propvalueid="1783061756">飞科337官配+1刀头刀片+布袋<em class="ico_dg"></em></a>                                                                                                                    <a class="" style="cursor: pointer" data-prop="word" data-propid="1627207" data-propvalueid="1783061757">飞科337官配+2刀头刀片+布袋<em class="ico_dg"></em></a>                                                                                                                    <a class="" style="cursor: pointer" data-prop="word" data-propid="1627207" data-propvalueid="1783061760">飞科337官配+3刀头刀片+布袋<em class="ico_dg"></em></a>                                                                                                                    <a class="" style="cursor: pointer" data-prop="word" data-propid="1627207" data-propvalueid="1783061752">飞科337官配+飞科鼻毛器+布袋<em class="ico_dg"></em></a>                                                                                   </div>                     </li>                                           <li><span style="font-size:12px">数量：</span><input type="text" id="" value="1" data-name="quantity" style="width: 60px;" name=""><input type="button" data-name="addQuantity" value="+" style="line-height:0px;"><input type="button" data-name="subQuantity" value="–" style="line-height:0px;"></li>                     <li><span style="font-size:12px">备注：</span><textarea class="text_com" data-name="comments">Please enter the purchasing information of this item, such as color, size or other requirements.</textarea></li>                     <li>                         <p class="mag">*注意： 若产品的相关信息没有被完全调取过来，请您自己手动填写。</p>                     </li>                 </ul>                 <style>                     .admi_section01 .add_main .left .ami_btn a.cancl-btn {                         float: right;                         margin-right: 40px;                         background: #e5e5e5;                         color: #999;                     }                      .favorite {                         width: 28px;                         height: 48px;                         background: #e5e5e5;                         border: 0;                         min-width: 26px;                         margin-top: -1px;                         position: relative;                     }                          .favorite em {                             display: block;                             width: 26px;                             height: 22px;                             margin-top: 13px;                             background: url(http://img.yoybuy.com/V6/ShoppingCart/lovesc.jpg) no-repeat;                         }                      .favsuccess em {                         background: url(http://img.yoybuy.com/V6/ShoppingCart/lovescw.jpg) no-repeat;                     }                      .favtips {                         position: absolute;                         bottom: -35px;                         left: 30px;                         font-size: 12px;                         color: #333;                         background: #fff;                         padding: 0 10px;                         border: 1px solid #eeeeee;                         white-space: nowrap;                         height: 24px;                         line-height: 24px;                         font-weight: normal;                         display: none;                     }                          .favtips i {                             position: absolute;                             left: 17px;                             top: -5px;                             width: 10px;                             height: 5px;                             background: url(http://img.yoybuy.com/V6/ShoppingCart/sanj-1.jpg) no-repeat;                         }                      .favorite:hover .favtips {                         display: block;                     }                      .favsuccess:hover .favtips {                         display: none;                     }                 </style>                 <div class="ami_btn">                     <a style="cursor: pointer" class="btn01 flo" data-name="addCart"><em class="ico_cart"></em>加入购物车</a>                     <a style="cursor: pointer;display:none" data-name="cancel" class="btn02 flo cancl-btn">取消</a>                      <a id="addGoodsToFav" class="flo mar6 favorite orangea noline centers">                         <em></em>                         <div class="favtips">                             <p>加入收藏夹</p>                             <i></i>                         </div>                     </a>                  </div>             </div>              <div class="clear"></div>             <div class="clear ove prodetail">                 <div class="clear ove protit font14" id="menuDiv">                     <a class="flo noline norcol marr10 current" data-menuindex="0">产品详情</a>                     <a class="flo noline norcol" data-menuindex="1">支付 &amp; 运送</a>                 </div>                 <div class="clear">                     <div class="describeproduct">                         <ul class="attributes-list">                                                          <li title="其他智能">智能类型:其他智能</li>                                                          <li title="飞科337官方标配+收纳布袋,飞科337官配+1刀头刀片+布袋,飞科337官配+2刀头刀片+布袋,飞科337官配+3刀头刀片+布袋,3刀头刀片,337充电器,飞科337官配+飞科鼻毛器+布袋,337官配+3刀头+飞科鼻毛器+布袋">颜色分类:飞科337官方标配+收纳布袋,飞科337官配+1刀头刀片+布袋,飞科337官配+2刀头刀片+布袋,飞科337官配+3刀头刀片+布袋,3刀头刀片,337充电器,飞科337官配+飞科鼻毛器+布袋,337官配+3刀头+飞科鼻毛器+布袋</li>                                                          <li title="有">修发器/修剪器:有</li>                                                          <li title="1小时">充电时间:1小时</li>                                                          <li title="旋转式3刀头">刀头:旋转式3刀头</li>                                                          <li title="Flyco/飞科">品牌:Flyco/飞科</li>                                                          <li title="FS337">飞科剃须刀型号:FS337</li>                                                          <li title="60分钟">完全充电使用时间:60分钟</li>                                                          <li title="全身水洗">清洁方式:全身水洗</li>                                                          <li title="充电式">电源方式:充电式</li>                                                          <li title="全球通用电压(100-240V)">适用电压:全球通用电压(100-240V)</li>                                                          <li title="全国联保">售后服务:全国联保</li>                                                      </ul>                     </div><p><span style="color:#000000;text-align:center;line-height:72.0px;font-size:48.0px;">温馨提示：</span><span style="text-align:center;line-height:72.0px;color:#0000ff;font-size:48.0px;">亲们刀头是易耗品，用久了是需要更换的，建议亲们购买剃须刀时搭配备用刀头一起选购，防止日后单独购买时需要承担高昂的运费。颜色分内中的刀头刀网都为原厂刀头刀网！！！！！！</span></p>
                                    <p> <img style="max-width:750.0px;" src="https://img.alicdn.com/imgextra/i2/1113969501/TB2SQEHsFXXXXXbXFXXXXXXXXXX_!!1113969501.jpg" align="absmiddle"><img style="max-width:750.0px;" src="https://img.alicdn.com/imgextra/i1/1113969501/TB2fYVfsVXXXXcKXXXXXXXXXXXX_!!1113969501.jpg" align="absmiddle"><img style="max-width:750.0px;" src="https://img.alicdn.com/imgextra/i1/1113969501/TB2IuwOsFXXXXcbXpXXXXXXXXXX_!!1113969501.jpg" align="absmiddle"><img style="max-width:750.0px;" src="https://img.alicdn.com/imgextra/i1/1113969501/TB26u0csVXXXXc9XXXXXXXXXXXX_!!1113969501.jpg" align="absmiddle"><img style="max-width:750.0px;" src="https://img.alicdn.com/imgextra/i4/1113969501/TB2TkkQsFXXXXb7XpXXXXXXXXXX_!!1113969501.jpg" align="absmiddle"><img style="max-width:750.0px;" src="https://img.alicdn.com/imgextra/i1/1113969501/TB2QvpesVXXXXcUXXXXXXXXXXXX_!!1113969501.jpg" align="absmiddle"><img style="max-width:750.0px;" src="https://img.alicdn.com/imgextra/i2/1113969501/TB2UrhasVXXXXXlXpXXXXXXXXXX_!!1113969501.jpg" align="absmiddle"><img style="max-width:750.0px;" src="https://img.alicdn.com/imgextra/i4/1113969501/TB2I9IHsFXXXXXpXFXXXXXXXXXX_!!1113969501.jpg" align="absmiddle"><img style="max-width:750.0px;" src="https://img.alicdn.com/imgextra/i1/1113969501/TB2CRRbsVXXXXcPXXXXXXXXXXXX_!!1113969501.jpg" align="absmiddle"><img style="max-width:750.0px;" src="https://img.alicdn.com/imgextra/i1/1113969501/TB2QIdvsVXXXXaGXXXXXXXXXXXX_!!1113969501.jpg" align="absmiddle"><img style="max-width:750.0px;" src="https://img.alicdn.com/imgextra/i4/1113969501/TB2VmVHsVXXXXXbXXXXXXXXXXXX_!!1113969501.jpg" align="absmiddle"><img style="max-width:750.0px;" src="https://img.alicdn.com/imgextra/i1/1113969501/TB2EddwsVXXXXaJXXXXXXXXXXXX_!!1113969501.jpg" align="absmiddle"><img style="max-width:750.0px;" src="https://img.alicdn.com/imgextra/i2/1113969501/TB2DFBesVXXXXc0XXXXXXXXXXXX_!!1113969501.jpg" align="absmiddle"><img style="max-width:750.0px;" src="https://img.alicdn.com/imgextra/i1/1113969501/TB2GPsLsFXXXXcvXpXXXXXXXXXX_!!1113969501.jpg" align="absmiddle"><img style="max-width:750.0px;" src="https://img.alicdn.com/imgextra/i4/1113969501/TB2Mh4vsVXXXXaGXXXXXXXXXXXX_!!1113969501.jpg" align="absmiddle"> </p>

                                    <p>&nbsp;</p>                 </div>                 <!--Payment & Shipping-->                 <div class="clear" style="display:none;">                     <div class="clear ove protype mar12">                         <img src="http://img.yoybuy.com/V6/Product/passed.png" width="98" height="52" class="flo marr20">                         <ul class="flo norton mar5">                             <li class="clear ove"><strong class="font14">Norton by symantec </strong></li>                             <li class="clear ove col666 nortond">YOYBUY.com can use Symantec services to protect your credit card and other confidential information.</li>                         </ul>                     </div>                     <div class="clear ove protype mar12">                         <p class="clear ove">                             <strong class="font14">Payment Methods: &nbsp;&nbsp; </strong> &nbsp;&nbsp;                             <span class="gray">We accept these payment</span>                         </p>                         <p class="clear ove paymentp mar10">                             <a><img src="http://img.yoybuy.com/V6/Common/payment1.png" width="45" height="27"></a>                             <a><img src="http://img.yoybuy.com/V6/Common/payment2.png" width="45" height="27"></a>                             <a><img src="http://img.yoybuy.com/V6/Common/payment3.png" width="45" height="27"></a>                             <a><img src="http://img.yoybuy.com/V6/Common/payment4.png" width="45" height="27"></a>                             <a><img src="http://img.yoybuy.com/V6/Common/payment5.png" width="45" height="27"></a>                             <a><img src="http://img.yoybuy.com/V6/Common/payment6.png" width="45" height="27"></a>                             <a><img src="http://img.yoybuy.com/V6/Common/payment7.png" width="45" height="27"></a>                         </p>                     </div>                     <div class="clear ove protype mar12">                         <p class="clear ove">                             <strong class="font14">Shipping Methods: &nbsp;&nbsp; </strong> &nbsp;&nbsp;                             <span class="gray">We accept these shipping metho</span>                         </p>                         <p class="clear ove paymentp mar10">                             <a><img src="http://img.yoybuy.com/V6/Common/ship1.png" width="45" height="27"></a>                             <a><img src="http://img.yoybuy.com/V6/Common/ship2.png" width="45" height="27"></a>                             <a><img src="http://img.yoybuy.com/V6/Common/ship3.png" width="45" height="27"></a>                             <a><img src="http://img.yoybuy.com/V6/Common/ship4.png" width="45" height="27"></a>                                                          <a><img src="http://img.yoybuy.com/V6/Common/ship6.png" width="45" height="27"></a>                         </p>                     </div>                 </div>                 <!--Payment & Shipping End-->             </div>         </div>                  <div class="clear"></div>     </div></div>


                <div class="shopcrt">
                    <h6>Shopping cart ( <span>1</span> )</h6>
                    <div class="grydiv">
                        <div class="spctht">
                            <span class="shptit">优贝全体员工 <em id="totalPrice_2803197">28.46</em><em style="margin-right: 0;">$</em></span>
                            <ul class="spcrtul">

                                <li style="border: 0px;">
                                    <a href="http://www.yoybuy.com/en/show/7437y" class="prodcta" title=""><img src="http://imgs.yoybuy.com/uploadimg/onlinechatimage/2017/06/14/16/20170614160943585.jpg" alt="http://imgs.yoybuy.com/uploadimg/onlinechatimage/2017/06/14/16/20170614160943585.jpg"></a>
                                    <div class="protms">
                                        <p class="limitwd" title="Summer&amp;Spring yoga suit sports suit">Summer&amp;Spring yoga suit sports suit</p>
                                        <p class="limitwd col999" title="color:Fluorescent green;size:L;">color:Fluorescent green;size:L;</p>
                                        <p class="addtjbtn">
                                            <span class="btnmins itemsQTYMinus">–</span>
                                            <input type="text" value="1" class="flo centers marr5 arial cartItemQty" data-cartid="2803197" data-oldnum="1" style="width:38px;height:18px;line-height:18px;">
                                            <span class="btnplus itemsQTYAdd">+</span>
                                            <em class="prcjg">$28.46</em>
                                        </p>
                                    </div>
                                    <em class="closeX" onclick="DelteItemsCompleted(2803197)"></em>
                                </li>

                            </ul>
                        </div>
                        <p class="totlprc">
                            Total: <span>
                                        <span class="font18 redtips" id="alltotalprice">$28.46</span>
                                </span>
                        </p>
                        <a href="http://shoppingcart.yoybuy.com/en/shoppingcart.html" class="chekot" style="white-space: pre-line;">支付
                            订单</a>
                    </div>
                </div>

                <script>
                    //购物车使用的方法

                </script>





            </div>
            <div class="hr01"></div>
            <div class="mag_text">
                <p class="tit"><strong>温馨提示:</strong></p>
                <p><em>*</em> 除了不能运送违禁品或其他需要特殊处理的商品外，我们几乎可以处理所有商品。</p>
                <p style="text-indent: 6px;">例如：易燃，易爆，干货，液体，粉状，膏状，磁铁，打火机，电池，管制刀具，压缩气体和半成品，<a href="http://www.yoybuy.com/en/help.html?cateid=601">更多的违禁物品 &gt;&gt;</a></p>
                <p style="margin-top: 15px;"><em>*</em> 请输入商品的源网址URL，或者直接从我们的网站上添加商品!</p>
            </div>
        </div>

    </div>
    <div id="successcontent" style="display: none">
        <div class="bs_box">
            <p class="big"><strong>商品已成功加入购物车！</strong></p>
            <p data-name="title"></p>
            <p>Unit Price: $<span data-name="price"></span>  Domestic Shipping: $<span data-name="shipping"></span>  Qty: <span data-name="qty"></span></p>
            <div class="hr01"></div>
            <div class="btn_box">
                <a class="btn01" style="cursor: pointer" data-name="add">[+] 继续购物</a>
                <a class="btn02" style="cursor: pointer" href="http://shoppingcart.yoybuy.com/en/shoppingcart.html">查看我的购物车 &gt;&gt;</a>
            </div>
        </div>

    </div>
    <!-- //content -->
</div>
<script>
    var AddUrlMessage = {

    };

    var AddUrlManager = {
        _urlAddress : null,
        _urlLoadingElement : null,
        _urlRules : [
            <?php foreach(Yii::$app->params['urlRules'] as $rule) { ?>
            "<?=$rule?>",
            <? } ?>
        ],
        init : function (url) {
            this._urlAddress = url;
            this._initElement();
            if (url != null && typeof(url) == "string" && url.length > 0) {
                this._submitUrl();
            }
        },
        _initElement : function () {
            this._urlLoadingElement = $("#getgoodsloadingdiv");
        },

        _submitUrl : function() {
            if (AddUrlManager._checkUrl()) {
                this._submitUrlSuccess();
            } else {
                this._submitUrlFail();

            }
        },
        _checkUrl : function() {
            var verified = false;
            var url = this._urlAddress;
            this._urlRules.forEach(function(value){
                var rule = new RegExp(value,'i');
                if(rule.test(url)) {
                    verified = true;
                }
            });
            return verified;
        },
        _submitUrlSuccess : function() {
            this._showLoading();
            var url = this._urlAddress;
            $.ajax({
                url: "<?= BaseUrl::to(array('member/get-goods'), true);?>",
                data: { goodsUrl:  url },
                cache: false,
                success: function (data) {

                },
                error: function() {

                }
            });
        },
        _submitUrlFail : function() {
            MessageBox.showAlertMessageBoxWarn(630, 260, $('#MainMsgContent').val(), $('#MainMsgBtn').val(), function() { jump('<?= BaseUrl::to(array('member/add-url'), true);?>'); });
        },
        _showLoading : function() {
            this._urlLoadingElement.show();
        }
    };
    $(function() {
        AddUrlManager.init("<?=$urlAddress?>");
    });
</script>
<!--Content End-->