<?php
/**
 * Created by PhpStorm.
 * User: gaoyi
 * Date: 4/3/17
 * Time: 11:37 PM
 */
use yii\captcha\Captcha;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\BaseUrl;

/* @var $this yii\web\View */
$this->registerCssFile('@web/css/user/register.css', ['depends'=>['app\assets\AppAsset']]);
?>
<!--Content Start-->
<div id="container">
    <!-- content -->
    <div id="content02">
        <div class="login_bjbox ">
            <div class="login_box register_box">
                <h2 class="tit"><?=Yii::t('app/user', 'Join ChinaInAir Now') ?></h2>
                <p class="have_account"><?=Yii::t('app/user', 'Already have an account? Please <a href="{url}" rel="nofollow">click here to sign in!</a>', ['url'=>BaseUrl::to(array('user/login'), true)]) ?></p>
                <?php $form = ActiveForm::begin([
                    'id' => 'register-form',
                    'action' => BaseUrl::to(array('user/do-register'), true),
                    'validationUrl' => BaseUrl::to(array('user/validate-register'), true),
                    'fieldConfig' => [
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
                                'enableAjaxValidation' => true,
                            ])
                            ->textInput(); ?>
                    </li>
                    <li>
                        <?= $form->field($model,'userName',
                            [
                                'labelOptions' => ['class' =>'required'],
                                'enableAjaxValidation' => true,
                            ])->textInput(); ?>
                    </li>
                    <li>
                        <?= $form->field($model,'password', ['labelOptions' => ['class' =>'required']])->passwordInput(); ?>
                    </li>
                    <li>
                        <?= $form->field($model,'passwordRepeat', ['labelOptions' => ['class' =>'required']])->passwordInput(); ?>
                    </li>
                    <li>
                        <dl id="country" class="select_country">
                            <dt><span data-countryid="0" class="text"></span><span class="btn_xiala"><em class="sjx"></em></span></dt>
                            <dd style="display: none;">
                                <a data-countryid="0">- select one -</a>
                                <?php
                                /* @var $countryList \Array */
                                foreach($countryList as $country) {
                                    ?>
                                    <a data-countryid="<?=$country->id;?>"><?=$country->name; ?></a>
                                <?php } ?>
                            </dd>

                        </dl>
                        <?= $form->field($model,'countryID', ['labelOptions' => ['class' =>'required']])->hiddenInput(); ?>
                    </li>
                    <li>
                        <?= $form->field($model,'invitationCode')->textInput(); ?>
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
                        <?= Html::submitButton(Yii::t('app/user', 'Sign up'),['class'=>'login_btn']) ?>
                    </li>
                    <li class="rfp">
                        <p>
                            <?=Yii::t('app/user', 'By creating an account, I accept ChinaInAir’s <a href="{urlTerm}">Terms of Service</a>
                            and <a href="{urlPolicy}">Privacy Policy</a>.', ['urlTerm'=>BaseUrl::to(array('help/index','id'=>1), true), 'urlPolicy'=>BaseUrl::to(array('help/index','id'=>2), true)]) ?>
                        </p>
                        <p style="margin-top:5px;"><?=Yii::t('app/user', 'Sign up to receive the latest updates, promotions, and news from ChinaInAir.') ?></p>
                    </li>
                </ul>
                <?php ActiveForm::end(); ?>
            </div>
        </div>




    </div>
    <!-- //content -->
</div>
<script>
    $(function() {
        $(document).click(function () {
            $("#country").find("dd").hide();
        });
        $("#country").find("dt").click(function (e) {
            var obj = $("#country").find("dd");
            if (obj.is(":visible")) {
                obj.hide();
            } else {
                obj.show();

            }
            e.preventDefault();
            return false;
        });

        $("#country").find("a").bind({
            'click': function (event) {
                var countryName = $.trim($(this).html());
                var countryId = $.trim($(this).attr("data-countryId"));
                $("#country").children().eq(0).children().eq(0).html(countryName);
                if(countryId == 0) {
                    $("#registerform-countryid").val('');
                } else {
                    $("#registerform-countryid").val(countryId);
                }

                var $form = $('#register-form');
                $form.yiiActiveForm("validateAttribute", "registerform-countryid");
                $("#country").find("dd").hide();
                event.stopPropagation();
            }
        });

    });
</script>
<!--Content End-->
