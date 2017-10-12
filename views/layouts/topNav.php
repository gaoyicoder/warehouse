<?php
/**
 * Created by PhpStorm.
 * User: gaoyi
 * Date: 9/26/17
 * Time: 11:21 AM
 */
/* @var $this \yii\web\View */
/* @var $this->context \app\controllers\CartController */
use yii\helpers\BaseUrl;

?>
<div class="flo breadcrumb">
    <a href="<?=BaseUrl::home(true);?>" class="flo norcol padnum">Home</a>


    <? if($this->params['topNav']) { ?>
        <? foreach($this->params['topNav'] as $navKey => $navUrl) {?>
            <span class="flo padnum">&gt;</span>
            <? if($navUrl) {?>
                <a href="<?=$navUrl;?>" class="flo norcol padnum"><?=$navKey?></a>
            <? } else { ?>
                <span class="flo padnum gray"><?=$navKey?></span>
            <? } ?>
        <? } ?>
    <? } ?>
</div>