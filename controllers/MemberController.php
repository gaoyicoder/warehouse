<?php
/**
 * Created by PhpStorm.
 * User: gaoyi
 * Date: 6/13/17
 * Time: 1:54 PM
 */

namespace app\controllers;

use app\models\CartForm;
use yii;
use yii\web\Controller;
use app\models\Cart;

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
        $url = $request->post('goodsUrl');
        $result = false;
        $data = [];
        if($url) {
            foreach(Yii::$app->params['urlRules'] as $urlRule) {

                if(preg_match('/'.addcslashes($urlRule, '/').'/', $url, $match )) {
                    $data = [];
                    $result = Yii::$app->taoBaoManager->resolverGoods($url, $data);
                    break;
                }
            }
        }
        return $this->asJson(array('result'=> $result, 'data' => $data));
    }

    public function actionAddCart() {
        $result = false;
        $data = [];
        $model = new Cart();

        $request = \Yii::$app->getRequest();
        if ($request->isPost) {
            if($model->addCart($request->post())){
                $result = true;
            }
        }
        return $this->asJson(array('result'=> $result, 'data' => $data));
    }

    public function actionGetCartList() {
        $result = false;
        $data = [];
        $cartList = Cart::getCartList();

        if ($cartList) {
            $result = true;
            $data = $cartList;
        }
        return $this->asJson(array('result'=> $result, 'data' => $data));
    }

    public function actionDeleteCartItem() {
        $result = Cart::deleteCartByPost();
        return $this->asJson(array('result'=> $result));
    }
}