<?php
/**
 * Created by PhpStorm.
 * User: gaoyi
 * Date: 9/20/17
 * Time: 10:00 AM
 */

namespace app\controllers;

use yii;
use yii\web\Controller;
use app\models\Cart;

class CartController extends Controller
{
    //Display the add url view
    public function actionAddUrl() {
        $urlRules = Yii::$app->params['urlRules'];
        $urlExamples = Yii::$app->params['urlExamples'];
        return $this->render('addUrl',['urlRules' => $urlRules, 'urlExamples' => $urlExamples]);
    }

    //Display the add item view
    public function actionAddItem() {
        $request = \Yii::$app->getRequest();
        $url = $request->get('url');
        $rightSideCart = $this->getCartView();
        return $this->render('addItem', ['urlAddress' => $url, 'rightSideCart' => $rightSideCart]);
    }

    //Resolve taoBao url for add item view, return json
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

    //Add cart action for add item view, return json
    public function actionAddCart() {
        $result = false;
        $model = new Cart();
        $errMsg = "";

        $request = \Yii::$app->getRequest();
        if ($request->isPost) {
            if($model->addCart($request->post())){
                $result = true;
            } else {
                $errMsg = Yii::t('app/cart','Failed to add item, please try again later');
            }
        }
        $data = $this->getCartView();
        return $this->asJson(array('result'=> $result, 'data' => $data, 'errMsg' => $errMsg));
    }

    //Get cart list for main view, return json
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

    //Delete cart item for main view, return json
    public function actionDeleteCartItem() {
        $result = Cart::deleteCartByPost();
        $data['totalMoney'] = Cart::getCartTotalMoney();
        return $this->asJson(array('result'=> $result, 'data'=>$data));
    }

    //Delete cart item for add item view,, return json
    public function actionDeleteCartItemRight() {
        $result = Cart::deleteCartByPost();
        $data = $this->getCartView();
        return $this->asJson(array('result'=> $result, 'data'=>$data));
    }

    //Update cart item amount for add item view,, return json
    public function actionUpdateCartItemAmount() {
        $result = false;
        $data = [];

        $cartModel = Cart::updateCartAmountByPost();

        if ($cartModel) {
            $result = true;
            $data['cartId'] = $cartModel->id;
            $data['amount'] = $cartModel->amount;
            $data['shopTotalMoneyUsd'] = Yii::$app->securityTools->cnyToUsd(Cart::getCartShopTotalMoney($cartModel->shop));
            $data['totalMoneyUsd'] = Yii::$app->securityTools->cnyToUsd(Cart::getCartTotalMoney());
        }
        return $this->asJson(array('result'=> $result, 'data'=>$data));

    }

    //show shopping cart view
    public function actionShoppingCart() {

        return $this->render("shoppingCart", []);

    }

    private function getCartView() {

        $cartList = Cart::getCartList();
        $cartArray = [];
        $totalMoney = Cart::getCartTotalMoney();
        $totalCount = count($cartList);
        foreach($cartList as $cartItem) {

            if (!isset($cartArray[$cartItem->shop]['totalMoney'])) {
                $cartArray[$cartItem->shop]['totalMoney'] = 0;
            }
            $cartArray[$cartItem->shop]['list'][] = $cartItem;
        }

        foreach($cartArray as $shop => $array) {
            $cartArray[$shop]['totalMoney'] = Cart::getCartShopTotalMoney($shop);
        }

        return $this->renderPartial('rightSideCart', ['cartArray'=> $cartArray, 'totalMoney'=> $totalMoney, 'totalCount' => $totalCount]);
    }
}