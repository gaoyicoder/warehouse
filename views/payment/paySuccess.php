<?php
/**
 * Created by PhpStorm.
 * User: gaoyi
 * Date: 11/21/17
 * Time: 4:14 PM
 */
/* @var $payment \app\models\Payment
 */
use yii\helpers\BaseUrl;
$this->registerCssFile('@web/css/payment/paySuccess.css', ['depends'=>['app\assets\AppAsset']]);
?>
<div id="container" class="clear ove padb90">
    <div id="content">
        <div class="clear ove mar60 centers">
            <div class="clear ove mailtip">
                <img src="<?=Yii::getAlias('@imagePath'); ?>/payment/check.png" width="59" height="59" class="flo marr20">
                <p class="flo font28 mar12"><strong><?=Yii::t('app/payment','Your order has been received!')?></strong></p>
            </div>
        </div>
        <div class="clear ove ordercon marauto">
            <ul class="clear ove ordertip">
                <li class="clear ove mar15"><span class="flo" style="width:130px;padding-left:28px;"><?=Yii::t('app/payment','Order Number: ')?></span><strong class="flo font14"><?=$payment->orderId?></strong></li>
                <li class="clear ove mar8"><span class="flo" style="width:130px;padding-left:28px;"><?=Yii::t('app/payment','Total Amount: ')?></span><strong class="flo font14 redtips">$ <?=$payment->subtotalUsd + $payment->handingFee ?></strong></li>
            </ul>
            <p class="clear ove centers mar15"><a href="<?= BaseUrl::to(array('order/overview'), true);?>"><?=Yii::t('app/payment','Back to My Order')?>  &gt;&gt;</a></p>
            <p class="clear ove centers mar30"><?=Yii::t('app/payment','After the items arrived at the warehouse, please remember to submit delivery!')?></p>
        </div>
    </div>
</div>
