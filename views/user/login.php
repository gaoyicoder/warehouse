<?php
/**
 * Created by PhpStorm.
 * User: gaoyi
 * Date: 5/27/17
 * Time: 3:50 PM
 */
use yii\captcha\Captcha;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\BaseUrl;

$this->registerCssFile('@web/css/user/register.css', ['depends'=>['app\assets\AppAsset']]);
?>
<!--Content Start-->
<div id="container">
    <!-- content -->
    <div id="content02">
        <div class="login_bjbox ">
            <div class="login_box register_box">
                <h2 class="tit"><?=Yii::t('app/user', 'Best Taobao Agent') ?></h2>
                <?php $form = ActiveForm::begin([
                    'id' => 'register-form',
                    'action' => BaseUrl::to(array('user/do-login'), true),
                    'validationUrl' => BaseUrl::to(array('user/validate-login'), true),
                    'fieldConfig' => [
                        'enableAjaxValidation' => true,
                        'inputOptions' => ['class' => 'input01'],
                        'template' => "<span class='filltxt'>{label}</span>\n
                        {input}\n<em style=''>{error}</em>",
                    ],
                ]); ?>
                <ul class="login_input style_<?=Yii::$app->language?>">
                    <li>
                        <?= $form->field($model,'email',
                            [
                                'labelOptions' => ['class' =>'required'],
                            ])
                            ->textInput(); ?>
                    </li>
                    <li>
                        <?= $form->field($model,'password', ['labelOptions' => ['class' =>'required']])->passwordInput(); ?>
                    </li>
                    <li>
                        <?= $form->field($model,'code', [
                            'template' => "<span class='filltxt'>{label}</span>\n{input}
                            <a id='captchaLiContent' href='javascript:void(0);'>
                        ".Captcha::widget(['name'=>'captchaimg','captchaAction'=>'user/captcha','imageOptions'=>['id'=>'captchaimg', 'title'=>'换一个', 'alt'=>'换一个', 'style'=>'cursor:pointer;'],'template'=>'{image}'])."
                        </a>\n<em style=''>{error}</em>",
                            'labelOptions' => ['class' =>'required'],
                            'enableAjaxValidation' => true,
                        ])->textInput(); ?>
                    </li>
                    <li>
                        <?= Html::submitButton(Yii::t('app/user', 'Sign Up'),['class'=>'login_btn']) ?>
                    </li>
                    <li class="rfp">
                        <?= $form->field($model,'rememberMe')->checkbox([
                            'style' => 'margin-top:-8px;',
                            'template' => '<span class="left">{input}{label}</span><span class="right">'.Yii::t('app/user', 'Forget').'<a href="'.BaseUrl::to(array('user/forget-password')).'">'.Yii::t('app/user', 'Password').'</a></span>',
                        ]); ?>
                    </li>
                    <li class="rfp"><a href="<?=BaseUrl::to(array('user/register'));?>" class="btn02"><?=Yii::t('app/user', 'Join Free Now') ?></a></li>
                </ul>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
<!--Content End-->
