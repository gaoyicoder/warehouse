<?php
/**
 * Created by PhpStorm.
 * User: gaoyi
 * Date: 6/20/17
 * Time: 11:11 PM
 */

/* @var $this \yii\web\View */

use yii\helpers\BaseUrl;

$this->registerCssFile('@web/css/member/sidebar.css', ['depends'=>['app\assets\AppAsset']]);
?>
<?php $this->beginContent('@app/views/layouts/main.php');?>
<!--Content Start-->
<div id="container" class="clear ove padb90">
    <div id="content">
        <div class="clear breadcrumb">

            <div class="clear breadcrumb">
                <a href="<?=BaseUrl::home(true)?>" class="flo norcol padnum"><?=Yii::t("app/member", 'Home')?></a>
                <span class="flo padnum">&gt;</span>
                <a href="<?=BaseUrl::to(array('member/index'), true)?>" class="flo norcol padnum"><?=Yii::t("app/member", 'My ChinaInAir')?></a>
            </div>


        </div>
        <div class="clear ordercont">

            <div class="flo myyoybuy">
                <h2><?=Yii::t("app/member", 'My ChinaInAir')?></h2>
                <dl class="clear ove yoybuylist mar5">
                    <dt><strong><?=Yii::t("app/member", 'BuyForMe Service')?></strong></dt>
                    <dd class="mar5"><a href="<?=BaseUrl::to(array('cart/add-url'), true)?>" class="noline norcol orangea"><?=Yii::t("app/member", 'Add URL')?></a></dd>
                    <dd><a id="myitems" href="http://order.yoybuy.com/en/myorder" class="noline norcol orangea">My

                            Items</a></dd>
                    <dd><a id="myParcels" href="http://order.yoybuy.com/en/myparcels" class="noline norcol orangea">My

                            Parcels</a></dd>
                </dl>
                <dl class="clear ove yoybuylist mar5">
                    <dt><strong>ShipForMe Service</strong></dt>
                    <dd class="mar5"><a id="myaddressinchina" href="http://order.yoybuy.com/en/myaddressinchina" class="noline norcol orangea">My Address in China</a></dd>
                    <dd><a id="MyChineseAddress" href="http://order.yoybuy.com/en/chineseaddress.html" class="noline

norcol orangea">My Warehouse</a></dd>
                    <dd><a id="myforwardingparcels" href="http://order.yoybuy.com/en/myforwardingparcels" class="noline

norcol orangea">My Forwarding Parcels</a></dd>
                </dl>
                <dl class="clear ove yoybuylist mar5">
                    <dt><strong>My Account</strong></dt>
                    <dd class="mar5"><a href="https://account.yoybuy.com/en/addmoney" class="noline norcol orangea">Add

                            Money</a></dd>
                    <dd><a href="https://account.yoybuy.com/en/myaccounthistory" class="noline norcol orangea">My

                            Account History</a></dd>
                    <dd><a href="https://account.yoybuy.com/en/withdrawmoney" class="noline norcol orangea">Withdraw

                            Money</a></dd>
                    <dd><a href="https://account.yoybuy.com/en/myyoybuypoints" class="noline norcol orangea">My

                            Coupons</a></dd>
                </dl>
                <dl class="clear ove yoybuylist mar5">
                    <dt><strong>Member Settings</strong></dt>
                    <dd><a href="http://customercenter.yoybuy.com/en/addressbook.html" class="noline norcol

orangea">Address Records</a></dd>
                    <dd><a href="http://customercenter.yoybuy.com/en/edituserinfo.html" class="noline norcol

orangea">Personal Profile</a></dd>
                    <dd><a id="myshareNav" href="http://customercenter.yoybuy.com/en/myshare.html" class="noline norcol

orangea" style="color: rgb(255, 102, 0);">Recommend To Friends</a></dd>
                    <dd><a href="http://www.yoybuy.com/en/share-and-earn-money.html" class="noline norcol

orangea">Get $5 coupon</a></dd>
                </dl>
                <dl class="clear ove yoybuylist mar5">
                    <dt><strong>Customer Service</strong></dt>
                    <dd class="mar5"><a href="javascript:Common100Position();" class="noline norcol

orangea">Submit a ticket</a></dd>
                </dl>
            </div>

            <input id="buyformeservice_message" type="hidden" value="0">
            <input id="onesteporder_message" type="hidden" value="0">
            <?= $content ?>

        </div>
    </div>
</div>
<!--Content End-->
<?php $this->endContent();?>
