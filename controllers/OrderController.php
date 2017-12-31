<?php
/**
 * Created by PhpStorm.
 * User: gaoyi
 * Date: 11/17/17
 * Time: 4:41 PM
 */

namespace app\controllers;


use app\models\Order;
use app\models\OrderItem;
use yii\web\Controller;
use yii;
use yii\web\NotFoundHttpException;

class OrderController extends Controller
{
    public function behaviors() {
        return [
            'access' => [
                'class' => yii\filters\AccessControl::className(),
                'only' => ['pay-order'],
                'rules' => [
                    [
                        'allow' => 'true',
                        'actions' => ['pay-order'],
                        'roles' => ['@'],
                    ],
                ],
            ]
        ];
    }
    public function actionPayOrder($id) {

        $order = Order::getOrderById($id);
        if ($order) {
            $orderItemList = OrderItem::getItemsByOrderId($id);
            $itemsCount = count($orderItemList);
            $user = Yii::$app->user->identity;
            return $this->render("payOrder", ['user'=> $user, 'order'=> $order, 'orderItemList' => $orderItemList, 'itemsCount' => $itemsCount]);
        } else {
            throw new NotFoundHttpException(Yii::t('app/order','Can\'t found the order.'));
        }
    }
}