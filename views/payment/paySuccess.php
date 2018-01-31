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
$this->registerCssFile('@web/css/payment/paySuccess.css', ['depends'=>['app\assets\AppAsset']]);
?>
<div id="container" class="clear ove padb90">
    <div id="content">
        <div class="success_wraptop">
            <img class="c_success" src="Chinese Buying Agent Help Buy from China and Ship World Widely _ ChinaInAir Taobao Agent_files/success.png">
            <h2>恭喜您，支付成功！</h2>
        </div>
        <div class="success_wrapbottom">
            <a href="#">
                <input class="order" type="button" name="" value="查看订单">
            </a>
            <a href="#">
                <input class="go_on" type="button" value="继续购物 》" name="">
            </a>
        </div>
    </div>
</div>
