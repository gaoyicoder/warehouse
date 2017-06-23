<?php
/**
 * Created by PhpStorm.
 * User: gaoyi
 * Date: 6/21/17
 * Time: 1:57 PM
 */
/* @var $urlRules array*/
/* @var $urlExamples array*/
use yii\helpers\BaseUrl;

$this->registerJsFile('@web/js/memberAddUrl.js',['depends'=>['app\assets\AppAsset']]);
$this->registerCssFile('@web/css/member/addUrl.css', ['depends'=>['app\assets\AppAsset']]);
?>
<!--Content Start-->
<div id="container">
    <!-- content -->
    <div id="content">
        <ul class="stps">
            <li class="actv"><span>1</span><?=Yii::t('app/member','Search URL')?><em></em></li>
            <li><span>2</span><?=Yii::t('app/member','Pay Order')?><em></em></li>
            <li><span>3</span><?=Yii::t('app/member','ChinaInAir Purchasing')?><em></em></li>
            <li><span>4</span><?=Yii::t('app/member','Submit Parcel')?><em></em></li>
            <li><span>5</span><?=Yii::t('app/member','Confirm Reception')?><em></em></li>

        </ul>
        <div class="admi_section01">
            <div class="add_link">
                <input placeholder="<?=Yii::t('app/member','Please enter Taobao URL here');?>" class="link_input" type="text" name="" id="ItemUrl" />
                <input id="AddItemUrl" type="hidden" value="<?=BaseUrl::to(array("member/add-item"))?>" />
                <?php foreach($urlRules as $rule) { ?>
                    <input class="url_rules" type="hidden" value="<?=$rule ?>">
                <?php } ?>
                <input id="MsgContent" type="hidden" value="<?=Yii::t('app/member','* Error website address, please check it!')?>" />
                <a class="btn" href="javascript:void(1)" id="SumbitUrlBtn"><em></em><?=Yii::t('app/member','Buy Now')?></a>
            </div>
            <div class="link_error" style="display: none" id="ItemUrlInputErrorMsg"></div>
            <div class="hr01"></div>
            <div class="mag_text" style="">
                <p class="tit"><strong><?=Yii::t('app/member','URL Example: ') ?></strong></p>
                <?php foreach($urlExamples as $examples) { ?>
                    <p><?=$examples ?></p>
                <?php } ?>
            </div>
        </div>
    </div>
    <!-- //content -->
</div>
<!--Content End-->