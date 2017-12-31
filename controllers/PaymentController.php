<?php
/**
 * Created by PhpStorm.
 * User: gaoyi
 * Date: 12/21/17
 * Time: 3:34 PM
 */

namespace app\controllers;

use app\components\payment\AliPaymentManager;
use yii\web\Controller;
use yii\helpers\BaseUrl;
use yii;
use yii\web\BadRequestHttpException;
use yii\web\NotFoundHttpException;
use app\models\Order;
use app\models\Payment;
use yii\base\Exception;

class PaymentController extends Controller
{
    public function behaviors() {
        return [
            'access' => [
                'class' => yii\filters\AccessControl::className(),
                'only' => ['pay-order', 'pay-by-ali-pay'],
                'rules' => [
                    [
                        'allow' => 'true',
                        'actions' => ['pay-order', 'pay-by-ali-pay'],
                        'roles' => ['@'],
                    ],
                ],
            ]
        ];
    }

    public function actionPayOrder() {
        $request = \Yii::$app->getRequest();
        if ($request->isPost) {
            $post = $request->post();
            $orderId = isset($post['orderId'])?$post['orderId']:"";
            if ($orderId != "") {
                $orderModel = Order::getOrderById($orderId);
                if ($orderModel) {
                    $oldPayment = Payment::getLastPaymentByOrderId($orderModel->id);
                    if ($oldPayment && $oldPayment->status == 1) {
                        throw new BadRequestHttpException(Yii::t('app/payment','You already paid the order.'));
                    } else {
                        $paymentType = $post['payType'];
                        if(array_key_exists($paymentType, Yii::$app->params['paymentType'])){
                            try{
                                $paymentModel = Payment::createNewPayment($orderModel, $paymentType);

                            }catch (Exception $e) {
                                throw new BadRequestHttpException($e);
                            }

                            if($paymentModel) {
                                if ($paymentModel->paymentTypeName == "aliPay") {

                                    $totalAmount = Yii::$app->securityTools->formatNum(($paymentModel->subtotalUsd + $paymentModel->handingFee), 2);
                                    $this->payByAliPay($orderId, $totalAmount, Yii::$app->params['paymentType']['aliPay']['subject']);
                                }
                            }

                        } else {
                            throw new BadRequestHttpException(Yii::t('app/payment','Payment type can\'t be empty.'));
                        }
                    }

                } else {
                    throw new NotFoundHttpException(Yii::t('app/order','Can\'t found the order.'));
                }
            } else {
                throw new BadRequestHttpException(Yii::t('app/payment','Order id can\'t be empty.'));
            }
        } else {
            throw new BadRequestHttpException(Yii::t('app/payment','Order id can\'t be empty.'));
        }

    }

    private function payByAliPay($orderNumber, $totalAmount, $subject) {

        $config = Yii::$app->params['aliPayApi'];
        $config['returnUrl'] = BaseUrl::to('payment/ali-return-url',true);
        $config['notifyUrl'] = BaseUrl::to('payment/ali-notify-url',true);
        $paymentManager = new AliPaymentManager($config);
        $paymentManager->doPayment($orderNumber, $totalAmount, $subject);
    }
}