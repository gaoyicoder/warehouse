<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */


$this->title = $name;

?>
<!--Content Start-->
<div id="container" class="clear ove padb90">
    <div id="content">
        <dl class="clear ove centers" style="padding-top:105px;">
            <dt><img src="<?=Yii::getAlias('@imagePath'); ?>/error/<?=$exception->statusCode;?>.jpg" width="329" height="212" class="marauto"></dt>
            <dd class="font14 redtips mar15"><strong><?=$message?></strong></dd>
        </dl>
    </div>
</div>
<!--Content End-->
