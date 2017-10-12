<?php
/**
 * Created by PhpStorm.
 * User: gaoyi
 * Date: 9/28/17
 * Time: 4:00 PM
 */

/* @var $this \yii\web\View */
/* @var $shoppingStep int */

?>

<ul class="stps">
    <? $shoppingStep = isset($shoppingStep) ? $shoppingStep : 1 ?>
    <li <? if($shoppingStep == 1) {?> class="actv" <? } ?>><span>1</span><?=Yii::t('app/cart','Search URL')?><em></em></li>
    <li <? if($shoppingStep == 2) {?> class="actv" <? } ?>><span>2</span><?=Yii::t('app/cart','Pay Order')?><em></em></li>
    <li <? if($shoppingStep == 3) {?> class="actv" <? } ?>><span>3</span><?=Yii::t('app/cart','ChinaInAir Purchasing')?><em></em></li>
    <li <? if($shoppingStep == 4) {?> class="actv" <? } ?>><span>4</span><?=Yii::t('app/cart','Submit Parcel')?><em></em></li>
    <li <? if($shoppingStep == 5) {?> class="actv" <? } ?>><span>5</span><?=Yii::t('app/cart','Confirm Reception')?><em></em></li>
</ul>
