<?php
/**
 * Created by PhpStorm.
 * User: gaoyi
 * Date: 07/02/2018
 * Time: 11:04 PM
 */

$this->registerCssFile('@web/css/index/bfmIntroduce.css', ['depends'=>['app\assets\AppAsset']]);
$this->registerJsFile('@web/js/jquery.roundabout-1.0.min.js',['depends'=>['app\assets\AppAsset']]);
?>
<!--Content Start-->
<div id="container" class="clear ove padb90">
    <div id="content">
        <div class="clear guidecon">
            <div class="clear mar30 faqtit popucon">
                <p class="clear ove" style="width:320px;left:440px;">How It Works</p>
            </div>
            <div class="clear ove guideico mar50">
                <a class="flo guideone current" style="width:242px;" data-menu-optionindex="0">
                    <span class="mailtip">
                        <em class="flo marr10 guiico1"></em>
                        <em class="flo mar18">Place Order</em>
                    </span>
                    <span class="guidearrow"></span>
                </a>
                <a class="flo guideone" data-menu-optionindex="1">
                    <span class="mailtip">
                        <em class="flo marr10 guiico2"></em>
                        <em class="flo mar18">YOYBUY Purchasing</em>
                    </span>
                    <span class="guidearrow"></span>
                </a>
                <a class="flo guideone" data-menu-optionindex="2">
                    <span class="mailtip">
                        <em class="flo marr10 guiico3"></em>
                        <em class="flo mar18">Submit Delivery</em>
                    </span>
                    <span class="guidearrow"></span>
                </a>
                <a class="flo guideone" data-menu-optionindex="3">
                    <span class="mailtip">
                        <em class="flo marr10 guiico4"></em>
                        <em class="flo mar18">YOYBUY Distribution</em>
                    </span>
                    <span class="guidearrow"></span>
                </a>
                <a class="flo guideone" data-menu-optionindex="4">
                    <span class="mailtip">
                        <em class="flo marr10 guiico5"></em>
                        <em class="flo mar18">Parcel Confirmation</em>
                    </span>
                </a>
            </div>
            <div class="clear ove mar20 font13">
                <div class="clear ove faqslide" data-divname="orderDiv">
                    <div class="clear ove faqimg">
                        <img src="<?=Yii::getAlias('@imagePath'); ?>/index/work1_1en.jpg" width="1200" height="600">
                        <img src="<?=Yii::getAlias('@imagePath'); ?>/index/work1_2en.jpg" width="1200" height="600">
                        <img src="<?=Yii::getAlias('@imagePath'); ?>/index/work1_3en.jpg" width="1200" height="600">
                        <img src="<?=Yii::getAlias('@imagePath'); ?>/index/work1_4en.jpg" width="1200" height="600">
                        <img src="http://img.yoybuy.com/V6/BuyForMe/work1_5en.jpg" width="1200" height="600">
                        <img src="http://img.yoybuy.com/V6/BuyForMe/work1_6en.jpg" width="1200" height="600">
                    </div>

                    <div class="clear ove faqnum centers">
                        <div class="mailtip">
                            <a class="flo marr30 current" data-img-index="0"><span class="mar18">Copy<br>Product<br>Links</span></a>
                            <img src="http://img.yoybuy.com/V6/BuyForMe/turn.png" width="17" height="31" class="flo mar30 marr30">
                            <a class="flo marr30" data-img-index="1"><span class="mar18">Click<br>"Submit"<br>To Add</span></a>
                            <img src="http://img.yoybuy.com/V6/BuyForMe/turn.png" width="17" height="31" class="flo mar30 marr30">
                            <a class="flo marr30" data-img-index="2"><span class="mar18">Add To<br>Shopping<br>Cart</span></a>
                            <img src="http://img.yoybuy.com/V6/BuyForMe/turn.png" width="17" height="31" class="flo mar30 marr30">
                            <a class="flo marr30" data-img-index="3"><span class="mar25">Place<br>Order</span></a>
                            <img src="http://img.yoybuy.com/V6/BuyForMe/turn.png" width="17" height="31" class="flo mar30 marr30">
                            <a class="flo marr30" data-img-index="4"><span class="mar35">Checkout</span></a>
                            <img src="http://img.yoybuy.com/V6/BuyForMe/turn.png" width="17" height="31" class="flo mar30 marr30">
                            <a class="flo" data-img-index="5"><span class="mar25">View<br>The Order</span></a>
                        </div>
                    </div>
                    <a class="turnleft"></a>
                    <a class="turnright"></a>
                </div>
                <div class="clear ove faqslide" data-divname="purchasingDiv">
                    <div class="clear ove faqimg">
                        <img src="http://img.yoybuy.com/V6/BuyForMe/work2_1en.jpg" width="1200" height="600">
                        <img src="http://img.yoybuy.com/V6/BuyForMe/work2_2en.jpg" width="1200" height="600">
                    </div>
                    <div class="clear ove faqnum centers">
                        <div class="mailtip">
                            <a class="flo marr30" data-img-index="6"><span class="mar25">YOYBUY<br>Purchasing</span></a>
                            <img src="http://img.yoybuy.com/V6/BuyForMe/turn.png" width="17" height="31" class="flo mar30 marr30">
                            <a class="flo" data-img-index="7"><span class="mar25">Purchasing<br>Finished</span></a>
                        </div>
                    </div>
                    <a class="turnleft"></a>
                    <a class="turnright"></a>
                </div>
                <div class="clear ove faqslide" data-divname="DeliveryDiv">
                    <div class="clear ove faqimg">
                        <img src="http://img.yoybuy.com/V6/BuyForMe/work3_1en.jpg" width="1200" height="600">
                    </div>
                    <a data-img-index="8"></a>
                    <a class="turnleft"></a>
                    <a class="turnright"></a>
                </div>
                <div class="clear ove faqslide" data-divname="distributionDiv">
                    <div class="clear ove faqimg">
                        <img src="http://img.yoybuy.com/V6/BuyForMe/work4_1en.jpg" width="1200" height="600">
                    </div>
                    <a data-img-index="9"></a>
                    <a class="turnleft"></a>
                    <a class="turnright"></a>
                </div>
                <div class="clear ove faqslide" data-divname="confirmationDiv">
                    <div class="clear ove faqimg">
                        <img src="http://img.yoybuy.com/V6/BuyForMe/work5_1en.jpg" width="1200" height="600">
                        <img src="http://img.yoybuy.com/V6/BuyForMe/work5_2en.jpg" width="1200" height="600">
                    </div>
                    <div class="clear ove faqnum centers">
                        <div class="mailtip">
                            <a class="flo marr30" data-img-index="10"><span class="mar25">Parcel<br>Confirmation</span></a>
                            <img src="http://img.yoybuy.com/V6/BuyForMe/turn.png" width="17" height="31" class="flo mar30 marr30">
                            <a class="flo" data-img-index="11"><span class="mar25">Review<br>Get Points</span></a>
                        </div>
                    </div>
                    <a class="turnleft"></a>
                    <a class="turnright"></a>
                </div>

            </div>
            <div class="clear mar30 faqtit popucon">
                <p class="clear ove" style="width:320px;left:440px;">Top Stores In China</p>
            </div>
            <div id="featured-area" class="clear topstores">
                <ul class="roundabout-holder" bearing="0" tilt="0" minz="100" maxz="400" minopacity="0.4" maxopacity="1" minscale="0.4" maxscale="1" duration="600" easing="easeOutInCirc" clicktofocus="true" focusbearing="0" animating="0" childinfocus="0" shape="lazySusan" period="45" debug="false" childselector="li" style="padding: 0px; position: relative; z-index: 100;">
                    <li class="roundabout-moveable-item roundabout-in-focus" degrees="0" startpos="765,695,12" current-scale="1.0000" style="position: absolute; left: -38.75px; top: -3.75px; width: 765px; height: 695px; opacity: 1; z-index: 400; font-size: 12px;"><a href="https://www.tmall.com/" target="_blank"><img src="http://img.yoybuy.com/V6/BuyForMe/website1.jpg"></a></li>
                    <li class="roundabout-moveable-item" degrees="45" startpos="765,695,9" current-scale="0.9121" style="position: absolute; left: -226.1px; top: 26.8px; width: 697.76px; height: 633.91px; opacity: 0.91; z-index: 356; font-size: 8.21px;"><a href="http://www.taobao.com/" target="_blank"><img src="http://img.yoybuy.com/V6/BuyForMe/website2.jpg"></a></li>
                    <li class="roundabout-moveable-item" degrees="90" startpos="765,695,5" current-scale="0.7000" style="position: absolute; left: -236.5px; top: 100.5px; width: 535.5px; height: 486.5px; opacity: 0.7; z-index: 249; font-size: 3.5px;"><a href="http://www.jd.com/" target="_blank"><img src="http://img.yoybuy.com/V6/BuyForMe/website3.jpg"></a></li>
                    <li class="roundabout-moveable-item" degrees="135" startpos="765,695,5" current-scale="0.4879" style="position: absolute; left: -63.84px; top: 174.2px; width: 373.24px; height: 339.09px; opacity: 0.49; z-index: 143; font-size: 2.44px;"><a href="http://www.mi.com/" target="_blank"><img src="http://img.yoybuy.com/V6/BuyForMe/website4.jpg"></a></li>
                    <li class="roundabout-moveable-item" degrees="180" startpos="765,695,9" current-scale="0.4000" style="position: absolute; left: 190.75px; top: 204.75px; width: 306px; height: 278px; opacity: 0.4; z-index: 100; font-size: 3.6px;"><a href="http://www.1688.com/" target="_blank"><img src="http://img.yoybuy.com/V6/BuyForMe/website5.jpg"></a></li>
                    <li class="roundabout-moveable-item" degrees="225" startpos="765,695,9" current-scale="0.4879" style="position: absolute; left: 378.1px; top: 174.2px; width: 373.24px; height: 339.09px; opacity: 0.49; z-index: 143; font-size: 4.39px;"><a href="http://www.meilishuo.com/" target="_blank"><img src="http://img.yoybuy.com/V6/BuyForMe/website6.jpg"></a></li>
                    <li class="roundabout-moveable-item" degrees="270" startpos="765,695,9" current-scale="0.7000" style="position: absolute; left: 388.5px; top: 100.5px; width: 535.5px; height: 486.5px; opacity: 0.7; z-index: 250; font-size: 6.3px;"><a href="http://www.handu.com/" target="_blank"><img src="http://img.yoybuy.com/V6/BuyForMe/website7.jpg"></a></li>
                    <li class="roundabout-moveable-item" degrees="315" startpos="765,695,9" current-scale="0.9121" style="position: absolute; left: 215.84px; top: 26.8px; width: 697.76px; height: 633.91px; opacity: 0.91; z-index: 356; font-size: 8.21px;"><a href="http://www.moonbasa.com/" target="_blank"><img src="http://img.yoybuy.com/V6/BuyForMe/website8.jpg"></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    //buyfoMe页面轮播设置
    $(document).ready(function () {
        $('#featured-area ul').roundabout({
            easing: 'easeOutInCirc',
            duration: 600
        });

        //所有的menu
        var allMenuOptions = $("a[data-menu-optionIndex]");  //data-menu-optionIndex
        //根据menu区分的div
        var allRotationDiv = $(".faqslide");  //不用命名  根据类名或者元素位置获取，确认是有五个div
        //所有的图片
        var allImg = $(".faqimg > img"); // 元素位置获取
        //所有用来切换图片的a标签
        var allReplaceImgA = $("a[data-img-index]"); //data-img-index
        //所有的leftBtn
        var allLeftBtn=$(".turnleft");
        //所有的rightBtn
        var allRightBtn=$(".turnright");
        //当前的图片
        var currentImgIndex = 0;

        ChangeShowDivByMenuOption = function (num) {
            HideDiv();
            switch (num) {
                case 0:
                    ShowCurrentObj(allRotationDiv, 0, allImg, 0);
                    CurrentObjAddClass(allMenuOptions, 0, allReplaceImgA, 0);
                    ChangeCurrentImgNum(0);
                    break;
                case 1:
                    ShowCurrentObj(allRotationDiv, 1, allImg, 6);
                    CurrentObjAddClass(allMenuOptions, 1, allReplaceImgA, 6);
                    ChangeCurrentImgNum(6);
                    break;
                case 2:
                    ShowCurrentObj(allRotationDiv, 2, allImg, 8);
                    CurrentObjAddClass(allMenuOptions, 2, allReplaceImgA, 8);
                    ChangeCurrentImgNum(8);
                    break;
                case 3:
                    ShowCurrentObj(allRotationDiv, 3, allImg, 9);
                    CurrentObjAddClass(allMenuOptions, 3, allReplaceImgA, 9);
                    ChangeCurrentImgNum(9);
                    break;
                case 4:
                    ShowCurrentObj(allRotationDiv, 4, allImg, 10);
                    CurrentObjAddClass(allMenuOptions, 4, allReplaceImgA, 10);
                    ChangeCurrentImgNum(10);
                    break;
            }
            //ChangeleftAndrightEvent();
        };

        ShowCurrentObj = function (allObjOne, numOne, allObjTwo, numTwo) {
            $(allObjOne[numOne]).show();
            if (allObjTwo == null && currentObjTwo == null) return;
            $(allObjTwo[numTwo]).show();
        };
        CurrentObjAddClass = function (allObjOne, currentObjOne, allObjTwo, currentObjTwo) {
            $(allObjOne[currentObjOne]).addClass( "current");
            if (allObjTwo == null &&currentObjTwo ==null) return;
            $(allObjTwo[currentObjTwo]).addClass( "current");
        };
        HideDiv = function () {
            allMenuOptions.removeClass("current");
            allReplaceImgA.removeClass("current");
            allRotationDiv.hide();
            allImg.hide();
        }

        //menuOptions的单击事件
        allMenuOptions.click( function () {
            ChangeShowDivByMenuOption(parseInt($(this).attr("data-menu-optionIndex")));
        });
        //切换图片的a标签事件
        allReplaceImgA.click( function(){
            ChangeImgByNum(parseInt($(this).attr("data-img-index")))
        });
        ChangeImgByNum = function (num) {
            allImg.hide();
            allReplaceImgA.removeClass("current");
            ChangeCurrentImgNum(num);
            CurrentObjAddClass(allReplaceImgA, currentImgIndex, null, null);
            $(allImg[currentImgIndex]).show();
        }
        //left right 的事件
        //left事件
        allLeftBtn.click(function () {
            if (currentImgIndex == 10) {
                ChangeShowDivByMenuOption(3);
            } else if (currentImgIndex == 9) {
                ChangeShowDivByMenuOption(2);
            } else if (currentImgIndex == 8) {
                HideDiv();
                ShowCurrentObj(allRotationDiv, 1, allImg, 7);
                CurrentObjAddClass(allMenuOptions, 1, allReplaceImgA, 7);
                ChangeCurrentImgNum(7);
            } else if (currentImgIndex == 6) {
                HideDiv();
                ShowCurrentObj(allRotationDiv, 0, allImg, 5);
                CurrentObjAddClass(allMenuOptions, 0, allReplaceImgA, 5);
                ChangeCurrentImgNum(5);
            } else {
                ChangeCurrentImgNum(currentImgIndex - 1);
                ChangeImgByNum(currentImgIndex);
            }
        })
        //right事件
        allRightBtn.click(function () {
            //查看图片切换类目的前一张图片索引。 做if判断
            if (currentImgIndex == 5) {
                ChangeShowDivByMenuOption(1);
            } else if (currentImgIndex == 7) {
                ChangeShowDivByMenuOption(2);
            } else if (currentImgIndex == 8) {
                ChangeShowDivByMenuOption(3);
            } else if (currentImgIndex == 9) {
                ChangeShowDivByMenuOption(4);
            } else {
                ChangeCurrentImgNum(currentImgIndex + 1);
                ChangeImgByNum(currentImgIndex);
            }
        });


        ChangeCurrentImgNum= function(num){
            currentImgIndex=num;
            allLeftBtn.hide();
            allRightBtn.hide();
            switch (currentImgIndex) {
                case 0:
                    allRightBtn.show();
                    break;
                case 11:
                    allLeftBtn.show();
                    break;
                default:
                    allLeftBtn.show();
                    allRightBtn.show();
                    break;
            }
        };

    });

</script>
<!--Content End-->