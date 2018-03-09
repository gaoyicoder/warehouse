<?php

namespace app\controllers;

use yii\web\Controller;

class IndexController extends Controller
{
    public function behaviors() {
        return [];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {

        return $this->render('index');
    }

    public function actionBfmIntroduce() {
        return $this->render('bfmIntroduce');
    }

    public function actionTest() {
        print_r(explode(":", "123.162.75.25:25726"));
    }

    public function actionTest1() {
        $requestUrl = 'https://detailskip.taobao.com/service/getData/1/p1/item/detail/sib.htm?itemId=528465917423&sellerId=2594360131&modules=dynStock,qrcode,viewer,price,duty,xmpPromotion,delivery,upp,activity,fqg,zjys,couponActivity,soldQuantity,originalPrice,tradeContract&callback=onSibRequestSuccess';
        $ch = curl_init();
        $timeout = 5;
        curl_setopt($ch, CURLOPT_URL, $requestUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_PROXYAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_PROXY, "222.85.50.13");
        curl_setopt($ch, CURLOPT_PROXYPORT, '43820');
        curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_HTTP);
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1) AppleWebKit/536.11 (KHTML, like Gecko) Chrome/20.0.1132.47 Safari/536.11");
        curl_setopt ($ch,CURLOPT_REFERER,"https://item.taobao.com/item.htm?spm=a230r.1.14.68.ebb2eb2azTb8s&id=528465917423&ns=1&abbucket=8#detail");
        $file_contents = curl_exec($ch);
        curl_close($ch);
        echo $file_contents;
    }

}
