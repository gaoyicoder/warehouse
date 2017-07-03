<?php
/**
 * Created by PhpStorm.
 * User: gaoyi
 * Date: 6/13/17
 * Time: 1:54 PM
 */

namespace app\controllers;

use yii;
use yii\web\Controller;

class MemberController extends Controller
{
    public $layout='member';
    public function actionIndex() {
        return $this->render('index',[]);
    }

    public function actionAddUrl() {
        $this->layout='main';
        $urlRules = Yii::$app->params['urlRules'];
        $urlExamples = Yii::$app->params['urlExamples'];
        return $this->render('addUrl',['urlRules' => $urlRules, 'urlExamples' => $urlExamples]);
    }

    public function actionAddItem() {
        $request = \Yii::$app->getRequest();
        $url = $request->get('url');
        $this->layout='main';
        return $this->render('addItem', ['urlAddress' => $url]);
    }

    public function actionGetGoods() {
        $request = \Yii::$app->getRequest();
        $url = $request->get('goodsUrl');

        $data = Yii::$app->taoBaoManager->resolverGoods($url);
        mb_convert_encoding($data, 'UTF-8', 'GBK');
        echo $data;
//        return $this->asJson(array('result'=> true, 'data' => $data));
    }
}