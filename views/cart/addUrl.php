<?php
/**
 * Created by PhpStorm.
 * User: gaoyi
 * Date: 6/21/17
 * Time: 1:57 PM
 */
/* @var $urlRules array*/
/* @var $urlExamples array*/
/* @var $this \yii\web\View */
use yii\helpers\BaseUrl;

$this->registerCssFile('@web/css/cart/addUrl.css', ['depends'=>['app\assets\AppAsset']]);
?>
<!--Content Start-->
<div id="container">
    <!-- content -->
    <div id="content">
        <?=$this->render('/layouts/shoppingSteps', ['shoppingStep' => 1])?>
        <div class="admi_section01">
            <div class="add_link">
                <input placeholder="<?=Yii::t('app/cart','Please enter Taobao URL here');?>" class="link_input" type="text" name="" id="ItemUrl" />
                <input id="AddItemUrl" type="hidden" value="<?=BaseUrl::to(array("cart/add-item"))?>" />
                <?php foreach($urlRules as $rule) { ?>
                    <input class="url_rules" type="hidden" value="<?=$rule ?>">
                <?php } ?>
                <input id="MsgContent" type="hidden" value="<?=Yii::t('app/cart','* Error website address, please check it!')?>" />
                <a class="btn" href="javascript:void(1)" id="SumbitUrlBtn"><em></em><?=Yii::t('app/cart','Buy Now')?></a>
            </div>
            <div class="link_error" style="display: none" id="ItemUrlInputErrorMsg"></div>
            <div class="hr01"></div>
            <div class="mag_text" style="">
                <p class="tit"><strong><?=Yii::t('app/cart','URL Example: ') ?></strong></p>
                <?php foreach($urlExamples as $examples) { ?>
                    <p><?=$examples ?></p>
                <?php } ?>
            </div>
        </div>
    </div>
    <!-- //content -->
</div>
<script>
    $(function(){

        $('#SumbitUrlBtn').click(function(){
            var verified = false;
            var itemUrl = $("#ItemUrl").val().trim();
            $(".url_rules").each(function() {
                var rule = new RegExp($(this).val(),'i');
                if(rule.test(itemUrl)) {
                    verified = true;
                }
            });
            if (verified) {
                location.href = $('#AddItemUrl').val()+"?url="+encodeURIComponent(itemUrl);
            } else {
                $('#ItemUrlInputErrorMsg').html($('#MsgContent').val());
                $('#ItemUrlInputErrorMsg').show();
            }
        });
    });
</script>
<!--Content End-->