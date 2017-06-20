<?php
/**
 * Created by PhpStorm.
 * User: gaoyi
 * Date: 4/3/17
 * Time: 11:37 PM
 */
use yii\helpers\BaseUrl;

/* @var $this yii\web\View */

$this->registerCssFile('@web/css/user/registerSuccess.css', ['depends'=>['app\assets\AppAsset']]);
$this->registerJsFile('@web/js/registerSuccess.js',['depends'=>['app\assets\AppAsset']]);
?>
<!--Content Start-->
<div id="container">
    <div class="zccgy">
        <div class="zccgyct">
            <img src="<?=Yii::getAlias('@imagePath'); ?>/user/green-right.png" class="icn-cg">
            <p class="gxnn"><?=Yii::t('app/user',
                    'Congratulations, <span class="clrorg">{userName}</span>, you have registered successfully!',
                    ['userName' => Yii::$app->user->identity->userName])?></p>
            <p><span class="clrorg" style="font-size:18px">$10</span> <?=Yii::t('app/user','coupon has been sent to your ChinaInAir account.') ?></p>
            <a class="begnow" href="<?=BaseUrl::home(true);?>"><?=Yii::t('app/user', 'Begin your shopping trip now') ?></a>
            <div class="jmp"><?=Yii::t('app/user', 'After <span class="clrorg" id="countdown"></span> seconds the page will automatically jump to ChinaInAir “Home” page'); ?></div>
        </div>
    </div>
</div>
<!--Content End-->
