<?php
/**
 * Created by PhpStorm.
 * User: gaoyi
 * Date: 6/23/17
 * Time: 4:41 PM
 */

/* @var $this \yii\web\View */
/* @var $urlAddress string */
/* @var $rightSideCart string */


use yii\helpers\BaseUrl;

$this->registerCssFile('@web/css/cart/addItem.css', ['depends'=>['app\assets\AppAsset']]);
$this->registerJsFile('@web/js/jquery.tmpl.min.js', ['depends'=>['app\assets\AppAsset']]);
$this->registerJsFile('@web/js/jquery.imagezoom.min.js', ['depends'=>['app\assets\AppAsset']]);
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
                <div id="goodsinfodiv">
                </div>
                <?=$rightSideCart; ?>
            </div>
            <div class="hr01"></div>
            <div class="mag_text">
                <p class="tit"><strong><?=Yii::t('app/cart','Tips:')?></strong></p>
                <p><em>*</em> <?=Yii::t('app/cart','We can handle almost everything, but we cannot deliver items that are prohibited or require special handling.')?></p>
                <p style="text-indent: 6px;"><?=Yii::t('app/cart','For example: Flammable, explosive, dry, liquid, powdered, Paste, Magnet, lighter, battery, controlled cutting tools, compressed gas and semi-manufactured,')?> <a href="http://www.yoybuy.com/en/help.html?cateid=601"><?=Yii::t('app/cart','more prohibited items')?> &gt;&gt;</a></p>
                <p style="margin-top: 15px;"><em>*</em> <?=Yii::t('app/cart','Please enter the original webpage URL of the item or add item from our Taobao in English directly!')?></p>
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
                <a class="btn02" style="cursor: pointer" href="<?= BaseUrl::to(array('cart/shopping-cart'), true);?>">查看我的购物车 &gt;&gt;</a>
            </div>
        </div>

    </div>
    <!-- //content -->
</div>
<script>
    //鼠标移上去事件。
    function imglistBOnblur(obj)
    {
        $(obj).addClass("hoverimg").siblings().removeClass("hoverimg");
        $(".jqzoom").attr('src', $(obj).find("img").attr("mid"));
        $(".jqzoom").attr('rel', $(obj).find("img").attr("big"));
    }

    var AddUrlMessage = {
        submitUrlFail: "<?=Yii::t('app','* Error website address, please check it!')?>",
        submitUrlFailBtn: "<?=Yii::t('app','OK')?>",
        submitUrlNotGet: "<?=Yii::t('app/cart','* Sorry, we can\' capture the product option data automatically, please fill out the form with item detail manually.')?>",
        addCartMissProduct: "<?=Yii::t('app/cart', 'Pls check the product information.')?>",
        addCartErrorMessage: "*Your item information error, please check again."
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

        _submitUrlFail : function() {
            MessageBox.showAlertMessageBoxWarn(630, 260, AddUrlMessage.submitUrlFail,
                AddUrlMessage.submitUrlFailBtn, function() { jump('<?= BaseUrl::to(array('cart/add-url'), true);?>'); });
        },

        _showLoading : function() {
            this._urlLoadingElement.show();
        },
        _hideLoading : function() {
            this._urlLoadingElement.hide();
        },
        _submitUrlSuccess : function() {
            this._showLoading();
            var url = this._urlAddress;
            $.ajax({
                url: "<?= BaseUrl::to(array('cart/get-goods'), true);?>",
                data: { goodsUrl:  url, "<?=Yii::$app->request->csrfParam?>": '<?=Yii::$app->request->getCsrfToken()?>' },
                cache: false,
                type: 'POST',
                dataType:"json",
                success: function (data) {
                    if(data.result == true) {
                        AddUrlManager._hideLoading();
                        GoodsInfoManager.init(data.data, url);
                    } else {
                        AddUrlManager._hideLoading();
                        MessageBox.showAlertMessageBoxWarn(630, 260, AddUrlMessage.submitUrlNotGet,
                            AddUrlMessage.submitUrlFailBtn, function() {});
                        GoodsInfoManager.init(data.data, url);
                    }
                },
                error: function() {
                    MessageBox.showAlertMessageBoxWarn(630, 260, AddUrlMessage.submitUrlFail,
                        AddUrlMessage.submitUrlFailBtn, function() { jump('<?= BaseUrl::to(array('cart/add-url'), true);?>'); });
                }
            });
        }
    };

    var GoodsInfoManager = {
        _data : null,
        _url : null,
        _goodsInfoDiv: null,
        _goodsTpl: null,
        init : function(data, url) {

            this._data = data;
            this._url = url;
            this._userselect = [];
            this._goodsInfoDiv = $("#goodsinfodiv");
            this._goodsTpl = $("#goodsinfotmpl");
            this._renderGoodsInfo();
            this._initElement();
            this.bindEvent();
            this._renderSku();
        },


        _initElement : function() {
            this._bigImageElement = this._goodsInfoDiv.find("[data-name=bigimage]");
            this._addCartBtn = this._goodsInfoDiv.find("[data-name=addCart]");
            this._titleInput = this._goodsInfoDiv.find("[data-name=title]");
            this._pricermbInput = this._goodsInfoDiv.find("[data-name=pricermb]");
            this._priceusdInput = this._goodsInfoDiv.find("[data-name=priceusd]");
            this._quantityInput = this._goodsInfoDiv.find("[data-name=quantity]");
            this._addQuantityBtn = this._goodsInfoDiv.find("[data-name=addQuantity]");
            this._subQuantityBtn = this._goodsInfoDiv.find("[data-name=subQuantity]");
            this._commentsInput = this._goodsInfoDiv.find("[data-name=comments]");

            this._propbtnList = this._goodsInfoDiv.find("[data-prop]");
            this._sourceInput = this._goodsInfoDiv.find("[data-name=source]");
            this._shopUrlInput = this._goodsInfoDiv.find("[data-name=shopUrl]");
            this._shopInput = this._goodsInfoDiv.find("[data-name=shop]");
            this._urlInput = this._goodsInfoDiv.find("[data-name=url]");
        },

        bindEvent: function() {
            this._bindAddCartEvent();
            this._bindPropEvent();
            this._bindTitleEvent();
            this._bindPriceRMBEvent();
            this._bindQuantityEvent();
            this._bindAddQuantityEvent();
            this._bindSubQuantityEvent();
            this._bindCommentsEvent();
        },

        _bindAddCartEvent: function() {
            this._addCartBtn.click(function() {
                var target = GoodsInfoManager;
                var isSelectSku = 0;
                if($("div.img_box").html()!=null){
                    for (var i = 0; i < $("div.img_box").length; i++) {
                        $($("div.img_box")[i]).find("a[data-propvalueid]").each(function(){
                            if($(this).attr("class").indexOf("active")!= -1 &&$(this).attr("class")!="no_active"){
                                isSelectSku++;
                            }
                        });
                    }
                    if(isSelectSku !=$("[data-propvalueid]").parent().length) {
                        alert(AddUrlMessage.addCartMissProduct);
                        return false;
                    }
                }

                target._disabledBtn();

                var checkTitle = target._checkTitle();
                var checkPriceRMB = target._checkPriceRMB();
                var checkQuantity = target._checkQuantity();
                var checkComments = target._checkComments();

                if (!checkTitle || !checkPriceRMB || !checkQuantity || !checkComments) {
                    GoodsInfoManager._showAddCartErrorMessage(AddUrlMessage.addCartErrorMessage);
                    target._enableBtn();
                    return false;
                }

                var name = target._titleInput.val();
                var price = target._pricermbInput.val();
                var amount = target._quantityInput.val();
                var postFeeType = $("input[name='postFee']:checked").val();
                var sorUrl = target._urlInput.val();
                var shopUrl = target._shopUrlInput.val();
                var shop = target._shopInput.val();
                var photoUrl = target._bigImageElement.attr("src");
                var source = target._sourceInput.val();
                var comments = target._commentsInput.val();

                var remark = target._getSelectedString() + comments;

                $(".BuyYesUlLoad").css('display','block');
                $("#msg-box").css('display','block');

                $.post(
                    "<?= BaseUrl::to(array('cart/add-cart'), true);?>",
                    {
                        "name": name,
                        "price": price,
                        "amount": amount,
                        "postFeeType": postFeeType,
                        "url": sorUrl,
                        "shopUrl": shopUrl,
                        "shop": shop,
                        "photoUrl": photoUrl,
                        "remark": $.trim(remark),
                        "source": source,
                        "<?=Yii::$app->request->csrfParam?>": '<?=Yii::$app->request->getCsrfToken()?>'
                    },

                    function(data) {
                        if (data.result == true) {
                            $(".shopcrt").html(data.data);
                            $("#msg-box").animate({"left":985,"top":60},350, function() {
                                $("#msg-box").hide().css({"left":340,"top":8});
                            });
                            currentCartList = 0;
                        } else {
                            $(".BuyYesUlLoad").css('display','none');
                            $("#msg-box").css('display','none');
                            GoodsInfoManager._showAddCartErrorMessage(data.errMsg);
                        }

                        target._enableBtn();
                    },
                );

            });

        },

        _bindPropEvent: function() {
            this._propbtnList.click(function() {
                if ($(this).attr("data-prop") == "img") {
                    GoodsInfoManager._imagePropClick($(this));
                } else {
                    GoodsInfoManager._propClick($(this));
                }
            });
        },

        _bindTitleEvent: function() {
            this._titleInput.blur(function() {
                GoodsInfoManager._checkTitle();
            });
        },

        _bindPriceRMBEvent: function() {
            this._pricermbInput.change(function() {
                GoodsInfoManager._priceRMBChange();
            }).keyup(function() {
                GoodsInfoManager._priceRMBChange();
            }).blur(function() {
                GoodsInfoManager._priceRMBChange();
            });
        },

        _bindQuantityEvent: function() {
            this._quantityInput.change(function() {
                GoodsInfoManager._checkQuantity();
            }).keyup(function() {
                GoodsInfoManager._checkQuantity();
            });
        },

        _bindAddQuantityEvent: function() {
            this._addQuantityBtn.click(function() {
                if (GoodsInfoManager._checkQuantity()) {
                    GoodsInfoManager._quantityInput.val(parseInt(GoodsInfoManager._quantityInput.val()) + 1);
                }
            });
        },

        _bindSubQuantityEvent: function() {
            this._subQuantityBtn.click(function() {
                if (GoodsInfoManager._checkQuantity() && GoodsInfoManager._quantityInput.val() != "1") {
                    GoodsInfoManager._quantityInput.val(parseInt(GoodsInfoManager._quantityInput.val()) - 1);
                }
            });
        },

        _bindCommentsEvent: function() {
            this._commentsInput.blur(function() {
                GoodsInfoManager._checkComments();
            });
        },

        _unbindAddCartEvent: function() {
            this._addCartBtn.unbind("click");
        },

        _renderSku: function(){
            var maxPrice = GoodsInfoManager._data.price;

            GoodsInfoManager._setAllEnable();

            var showList = GoodsInfoManager._data.goodsShowSkuItems;
            var skus = GoodsInfoManager._data.skus;

            var selectedItems = [];

            for(var i = 0; i < showList.length; i++) {
                var showsku = showList[i];
                var ppid = showsku.propertyAliasList[0].propId;
                var selected = GoodsInfoManager._getSelected(ppid);

                var prop = [];

                prop.propId = ppid;
                prop.propValues = [];

                if (selected.result == true) {
                    prop.propValues.push(selected.data);
                } else {

                    for (var l = 0; l < showsku.propertyAliasList.length; l++) {
                        prop.propValues.push(showsku.propertyAliasList[l]);
                    }
                }

                selectedItems.push(prop);
            }

            //验证
            for (i = 0; i < showList.length; i++) {
                var showItem = showList[i];

                for (var j = 0; j < showItem.propertyAliasList.length; j++) {
                    var p = showItem.propertyAliasList[j];
                    var otherProps = [];

                    for (var m = 0; m < selectedItems.length; m++) {
                        if (selectedItems[m].propId != showItem.propertyAliasList[0].propId) {
                            otherProps.push(selectedItems[m]);
                        }
                    }

                    var checkValues = [];

                    checkValues.push(p);

                    if (GoodsInfoManager._checkEnable(checkValues, otherProps) == false) {
                        GoodsInfoManager._setDisable(p.propId, p.propValueId);
                    }
                }
            }

            for (var k = 0; k < skus.length; k++) {
                var sku = skus[k];
                if (GoodsInfoManager._isContains(GoodsInfoManager._userselect, sku.properties) == true) {
                    if (sku.quantity > 0 && sku.price < maxPrice) {
                        maxPrice = sku.price;
                    }
                }
            }

            GoodsInfoManager._renderSelected();
            GoodsInfoManager._renderPrice(maxPrice);

        },

        _renderGoodsInfo : function() {
            this.emptyDiv();
            this._goodsTpl.tmpl(this._formatTplData()).appendTo(this._goodsInfoDiv);
            this._goodsInfoDiv.find(".describeproduct").after(this._formatTplData().desc);
            $(".imglistB > a:first").addClass("hoverimg");
            $(".jqzoom").imagezoom();
            $(".imglistB > a").hover(function(){
                imglistBOnblur(this);
            });
        },

        _renderSelected: function() {
            var selects = GoodsInfoManager._userselect;

            for (var i = 0; i < selects.length; i++) {
                GoodsInfoManager._setActive(selects[i].propId,selects[i].propValueId);
            }
        },

        _renderPrice: function(price) {
            GoodsInfoManager._pricermbInput.val(price);
            GoodsInfoManager._priceRMBChange();
        },

        _setAllEnable: function() {
            this._propbtnList.removeClass("active").removeClass("no_active").find("em").addClass("ico_dg").removeClass("mark");
        },

        _setDisable: function(propId, propValueId) {
            GoodsInfoManager._getPropElement(propId, propValueId).addClass("no_active").find("em").addClass("mark").removeClass("ico_dg");
        },

        _setActive: function(propId, propValueId) {
            GoodsInfoManager._getPropElement(propId, propValueId).addClass("active").addClass("ico_dg").removeClass("mark");
        },

        _getSelected: function(propId) {
            for (var j = 0; j < GoodsInfoManager._userselect.length; j++) {
                if (GoodsInfoManager._userselect[j].propId == propId && GoodsInfoManager._userselect[j].propValueId != 0) {
                    return { result: true, data: GoodsInfoManager._userselect[j] };
                }
            }
            return { result: false, data: null };
        },

        _getPropElement: function(propId, propValueId) {
            var tempThis=null;
            this._propbtnList.each(function(){
                if ($(this).attr("data-propid")  == propId && $(this).attr("data-propvalueid") == propValueId) {
                    tempThis= $(this);
                }
            });
            return tempThis;
        },

        _getSelectedString : function() {
            var str = "";

            for (var j = 0; j < GoodsInfoManager._userselect.length; j++) {
                str += this._getPropString(this._userselect[j].propId, this._userselect[j].propValueId);
            }

            return str;
        },

        _getPropString: function(propId, propValueId) {
            var list = this._data.goodsShowSkuItems;

            for (var i = 0; i < list.length; i++) {
                for (var j = 0; j < list[i].propertyAliasList.length; j++) {
                    var e = list[i].propertyAliasList[j];

                    if (e.propId == propId && e.propValueId == propValueId) {
                        return list[i].propName + ":" + e.customName + ";";
                    }
                }
            }
            return "";
        },

        _checkEnable: function(checkValues, otherProps) {
            if (checkValues == null) {
                checkValues = [];
            }

            var skus = this._data.skus;

            if (otherProps != null && otherProps.length > 0) {
                var prop = otherProps[0];
                var nextProps = [];

                if (otherProps.length > 1) {
                    for (i = 1; i < otherProps.length; i++) {
                        nextProps.push(otherProps[i]);
                    }
                }

                for (var i = 0; i < prop.propValues.length; i++) {
                    var tempValues = [];

                    for (var k = 0; k < checkValues.length; k++) {
                        tempValues.push(checkValues[k]);
                    }

                    tempValues.push(prop.propValues[i]);

                    if (nextProps.length > 0) {
                        if (GoodsInfoManager._checkEnable(tempValues, nextProps) == true) {
                            return true;
                        }
                    } else {
                        for (var j = 0; j < skus.length; j++) {
                            if (GoodsInfoManager._isContains(tempValues, skus[j].properties) == true) {
                                if (skus[j].quantity > 0) {
                                    return true;
                                }
                            }
                        }
                    }
                }
            } else {
                for (j = 0; j < skus.length; j++) {
                    if (GoodsInfoManager._isContains(checkValues, skus[j].properties) == true) {
                        if (skus[j].quantity > 0) {
                            return true;
                        }
                    }
                }
            }
            return false;
        },

        _checkPriceRMB: function() {
            var value = this._pricermbInput.val();

            var reg = /^([1-9][0-9]*)$|^([0]|[1-9][0-9]*)(.[0-9]{1,2})+$/;

            if (reg.test(value) == false) {
                this._pricermbInput.addClass("input_error");
                return false;
            } else {
                this._pricermbInput.removeClass("input_error");
                return true;
            }
        },

        _checkTitle: function() {
            var value = this._titleInput.val();

            var reg = /^[\s]+$/;

            if (value == "" || value.length > 249 || reg.test(value)) {
                this._titleInput.addClass("input_error");
                return false;
            } else {
                this._titleInput.removeClass("input_error");
                return true;
            }
        },

        _checkQuantity: function() {
            var value = this._quantityInput.val();

            var reg = /^[1-9][0-9]*$/;

            if (reg.test(value) == false) {
                this._quantityInput.addClass("input_error");
                return false;
            } else {
                this._quantityInput.removeClass("input_error");
                return true;
            }
        },

        _checkComments: function() {
            var value = this._commentsInput.val();

            if (value.length > 400) {
                this._commentsInput.addClass("input_error");
                return false;
            } else {
                this._commentsInput.removeClass("input_error");
                return true;
            }
        },

        _showAddCartErrorMessage: function(msg) {
            alert(msg);
        },

        _enableBtn: function() {
            this._bindAddCartEvent();
            this._addCartBtn.css("background", "#fd8529");
        },
        _disabledBtn: function() {
            this._unbindAddCartEvent();
            this._addCartBtn.css("background", "#999");
        },


        _priceRMBChange: function() {
            if (this._checkPriceRMB()) {
                this._priceusdInput.val(Tools.CNYToUSD(this._pricermbInput.val()));
            } else {
                this._priceusdInput.val(0);
            }
        },

        _imagePropClick: function(e) {
            if (this._isDisable(e) == false) {
                this._changePropSelect(e);
                this._bigImageElement.attr("src", e.attr("data-img"));
            }
        },

        _propClick: function(e) {
            if (this._isDisable(e) == false) {
                this._changePropSelect(e);
            }
        },

        _isDisable: function(e) {
            return $(e).hasClass("no_active");
        },
        _changePropSelect: function(e) {
            var pid = $(e).attr("data-propid");
            var pvalueid = $(e).attr("data-propvalueid");
            var userResult = true;
            var userSelect = GoodsInfoManager._userselect;

            if (userSelect.length == 0) {
                userSelect.push({
                    propId: pid,
                    propValueId: pvalueid
                });
            } else {
                for(var i = 0; i < userSelect.length; i++) {
                    if (userSelect[i].propId == pid) {
                        if (userSelect[i].propValueId != pvalueid) {
                            userSelect[i].propValueId = pvalueid;
                        } else {
                            userSelect.splice(i,1);
                        }
                        userResult = false;
                        break;
                    }
                }
                if (userResult) {
                    userSelect.push({ propId: pid, propValueId: pvalueid });
                }
            }
            GoodsInfoManager._renderSku();
        },
        _formatTplData : function() {
            var tData = new TplData();
            var data = this._data;

            $.each(data, function(index) {
                data[index] = data[index] ? data[index] : "";
                tData[index] = data[index];
            });

            tData.USDPrice = Tools.CNYToUSD(data.price);

            return tData;
        },

        _isContains: function(selecteds, propstr) {
            propstr = ";" + propstr + ";";

            for (var i = 0; i < selecteds.length; i++) {
                if (selecteds[i].propValueId != 0) {
                    var str = ";" + selecteds[i].propId + ":" + selecteds[i].propValueId + ";";

                    if (propstr.indexOf(str) < 0) {
                        return false;
                    }
                }
            }

            return true;
        },

        emptyDiv: function() {
            this._goodsInfoDiv.html("");
        }

    };

    var TplData = function(){
        this.source = "";
        this.shopUrl = "";
        this.shop = "";
        this.url = "";
        this.picUrl = "";
        this.goodsImage = "";
        this.title = "";
        this.price = "";
        this.USDPrice = 0;
        this.websiteType = false;
        this.desc = "";
        this.goodsShowSkuItems = [];
        this.skus = [];


    };

    $(function() {
        AddUrlManager.init("<?=$urlAddress?>");

        $("body").on("click", "#menuDiv a", function () {
            $(this).addClass("current").siblings("a").removeClass("current");
            $(this).parent().nextAll("div.clear").hide();
            $($(this).parent().nextAll("div.clear")[$(this).attr("data-menuindex")]).show(1500);
        });
    });
</script>
<script type="text/x-jquery-tmpl" id="goodsinfotmpl">
    <input type="hidden" data-name="source" value="${source}" />
    <input type="hidden" data-name="shopUrl" value="${shopUrl}" />
    <input type="hidden" data-name="shop" value="${shop}" />
    <input type="hidden" data-name="url" value="${url}" />
    <div class="add_main addurlcont">
        <div id="msg-box"><img src="${picUrl}" width="60" height="60" /></div>
        <div class="addurlft">
            <div class="right">
                <div class="clear imglist box">
                    <div class="imglistT">
                        <div class="tb-booth tb-pic tb-s310">
                            <a href="#"><img  data-name="bigimage" src="${picUrl}" alt="" rel="${picUrl}_350x350.jpg" class="jqzoom" style="cursor: crosshair;"></a>
                        </div>
                    </div>
                    <div class="imglistB">
                        {{each goodsImage}}
                        <a class="flo ">
                            <div class="imgdivcell"><img class="curr_base" src="${$value}_50x50.jpg" mid="${$value}" big="${$value}_600x600.jpg" /></div>
                        </a>
                        {{/each}}

                    </div>
                </div>
            </div>

            <div class="left">
                <ul>
                    <li><span style="font-size: 12px"><?=Yii::t('app/cart','Title: ')?></span><input style="width: 442px;" type="text" value="${title}" maxlength="150" data-name="title" {{if websiteType== 1}} disabled="disabled" {{/if}}></li>

                    <li><span style="font-size: 12px"><?=Yii::t('app/cart','Merchant: ')?></span><input style="width: 442px;" type="text" value="${shop}" maxlength="150" data-name="shop1" {{if websiteType== 1}} disabled="disabled" {{/if}}></li>

                    <li><span style="font-size: 12px"><?=Yii::t('app/cart','Unit price: ')?></span><input type="text" value="${price}" data-name="pricermb" style="width: 60px" {{if websiteType== 1}} disabled="disabled" {{/if}}><em class="fh">CNY</em><em class="fh">&asymp;</em><input type="text" data-name="priceusd" value="${USDPrice}" disabled="disabled" style="width: 60px" id=""><em class="fh">USD</em></li>

                    <li id="delivery_fee">
                        <span style="font-size:12px"><?=Yii::t('app/cart','Domestic Shipping: ')?></span>
                        <div style="float: left">
                            <div style="float: left">
                                <input type="radio" id="SelectService1" name="postFee" value="0" checked="checked">
                                <label for="SelectService1"><?=Yii::t('app/cart','Free or low cost delivery')?></label>
                            </div>
                            <div style="float: left">
                                <input type="radio" id="SelectService2" name="postFee" value="1">
                                <label for="SelectService2"><?=Yii::t('app/cart','Fastest delivery')?></label>
                            </div>
                            <div style="clear: both; width: 442px;">
                                <?=Yii::t('app/cart','Note: We will choose the most suitable delivery option according to your selection. The delivery cost will be charged to your account and payable when you ship the package home.')?>
                            </div>
                        </div>
                    </li>

                    {{each goodsShowSkuItems}}
                    <li>
                        <span style="font-size:12px">${$value.propName}:</span><div class="img_box {{if $value.isHasImage == false}}cp_type{{/if}}">
                            {{each $value.propertyAliasList}}
                            {{if $value.isImage == true}}
                            <a class="" style="cursor: pointer" data-prop="img" data-propid="${$value.propId}" data-propvalueid="${$value.propValueId}" data-img="${$value.bigImage}"><img src="${$value.smallImage}" alt=""><em class="ico_dg"></em></a>
                            {{else}}
                            <a class="" style="cursor: pointer" data-prop="word" data-propid="${$value.propId}" data-propvalueid="${$value.propValueId}">${$value.customName}<em class="ico_dg"></em></a>
                            {{/if}}
                            {{/each}}
                        </div>
                    </li>
                    {{/each}}

                    <li><span style="font-size:12px"><?=Yii::t('app/cart','Quantity: ')?></span><input type="text" id="" value="1" data-name="quantity" style="width: 60px;" name=""><input type="button" data-name="addQuantity" value="+" style="line-height:0px;"><input type="button" data-name="subQuantity" value="&ndash;" style="line-height:0px;"></li>
                    <li><span style="font-size:12px"><?=Yii::t('app/cart','Comments: ')?></span><textarea placeholder="<?=Yii::t('app/cart','Please enter the purchasing information of this item, such as color, size or other requirements.')?>" class="text_com" data-name="comments"></textarea></li>
                    <li>
                        <p class="mag"><?=Yii::t('app/cart','*Note: If the product option data is not completely captured here, please supplement in the comment box.')?></p>
                    </li>
                </ul>
                <div class="ami_btn">
                    <a style="cursor: pointer" class="btn01 flo" data-name="addCart"><em class="ico_cart"></em><?=Yii::t('app/cart','Add to Cart')?></a>
                </div>
            </div>

            <div class="clear"></div>
            <div class="clear ove prodetail">
                <div class="clear ove protit font14" id="menuDiv">
                    <a class="flo noline norcol marr10 current" data-menuindex="0"><?=Yii::t('app/cart','Product Details')?></a>
                    <a class="flo noline norcol" data-menuindex="1"><?=Yii::t('app/cart','Payment & Shipping')?></a>
                </div>
                <div class="clear">
                    <div class="describeproduct">
                        <ul class="attributes-list">
                            {{each goodsDetails}}
                            <li title="${$value.value}">${$value.key}:${$value.value}</li>
                            {{/each}}
                        </ul>
                    </div>
                </div>
                <!--Payment & Shipping-->
                <div class="clear" style="display:none;">
                    <div class="clear ove protype mar12">
                        <img src="http://img.yoybuy.com/V6/Product/passed.png" width="98" height="52" class="flo marr20">
                        <ul class="flo norton mar5">
                            <li class="clear ove"><strong class="font14">Norton by symantec </strong></li>
                            <li class="clear ove col666 nortond">YOYBUY.com can use Symantec services to protect your credit card and other confidential information.</li>
                        </ul>
                    </div>
                    <div class="clear ove protype mar12">
                        <p class="clear ove">
                            <strong class="font14">Payment Methods:    </strong> &nbsp;&nbsp;
                            <span class="gray">We accept these payment</span>
                        </p>
                        <p class="clear ove paymentp mar10">
                            <a><img src="http://img.yoybuy.com/V6/Common/payment1.png" width="45" height="27"></a>
                            <a><img src="http://img.yoybuy.com/V6/Common/payment2.png" width="45" height="27"></a>
                            <a><img src="http://img.yoybuy.com/V6/Common/payment3.png" width="45" height="27"></a>
                            <a><img src="http://img.yoybuy.com/V6/Common/payment4.png" width="45" height="27"></a>
                            <a><img src="http://img.yoybuy.com/V6/Common/payment5.png" width="45" height="27"></a>
                            <a><img src="http://img.yoybuy.com/V6/Common/payment6.png" width="45" height="27"></a>
                            <a><img src="http://img.yoybuy.com/V6/Common/payment7.png" width="45" height="27"></a>
                        </p>
                    </div>
                    <div class="clear ove protype mar12">
                        <p class="clear ove">
                            <strong class="font14">Shipping Methods:    </strong> &nbsp;&nbsp;
                            <span class="gray">We accept these shipping metho</span>
                        </p>
                        <p class="clear ove paymentp mar10">
                            <a><img src="http://img.yoybuy.com/V6/Common/ship1.png" width="45" height="27"></a>
                            <a><img src="http://img.yoybuy.com/V6/Common/ship2.png" width="45" height="27"></a>
                            <a><img src="http://img.yoybuy.com/V6/Common/ship3.png" width="45" height="27"></a>
                            <a><img src="http://img.yoybuy.com/V6/Common/ship4.png" width="45" height="27"></a>

                            <a><img src="http://img.yoybuy.com/V6/Common/ship6.png" width="45" height="27"></a>
                        </p>
                    </div>
                </div>
                <!--Payment & Shipping End-->
            </div>
        </div>

        <div class="clear"></div>
    </div>

</script>
<!--Content End-->