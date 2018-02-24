<?php
/**
 * Created by PhpStorm.
 * User: gaoyi
 * Date: 12/21/17
 * Time: 3:34 PM
 */

namespace app\controllers;

use app\components\payment\AliPaymentManager;
use app\components\payment\PayPalPaymentManager;
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
                    if ($orderModel->status != 0 && $orderModel->paymentId != "") {
                        throw new BadRequestHttpException(Yii::t('app/payment','You already paid the order.'));
                    } else {
                        $paymentType = $post['payType'];
                        if(array_key_exists($paymentType, Yii::$app->params['paymentType'])){
                            try{
                                $userId = Yii::$app->user->id;
                                $paymentModel = Payment::createNewPayment($orderModel, $paymentType, $userId);

                            }catch (Exception $e) {
                                throw new BadRequestHttpException($e);
                            }

                            if($paymentModel) {
                                if ($paymentModel->paymentTypeName == "aliPay") {

                                    $totalAmount = Yii::$app->securityTools->formatNum(($paymentModel->subtotalUsd + $paymentModel->handingFee), 2);
                                    $this->payByAliPay($paymentModel->id, $totalAmount, Yii::$app->params['paymentType']['aliPay']['subject']);
                                } else if ($paymentModel->paymentTypeName == "payPal") {

                                    $totalAmount = Yii::$app->securityTools->formatNum(($paymentModel->subtotalUsd + $paymentModel->handingFee), 2);
                                    $this->payByPayPal($paymentModel->id, $totalAmount, Yii::$app->params['paymentType']['aliPay']['subject']);
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

    public function actionAliReturn() {
        try {
            $paymentModel = $this->returnByAliPay();
            return $this->render("paySuccess", ['payment' => $paymentModel]);
        }catch (\Exception $e) {
            throw $e;
        }
    }

    public function actionAliNotify() {
        try {
            $this->returnByAliPay();
        }catch (\Exception $e) {
            throw $e;
        }
    }


    private function payByAliPay($paymentNumber, $totalAmount, $subject) {

        $config = Yii::$app->params['aliPayApi'];
        $config['returnUrl'] = BaseUrl::to('payment/ali-return',true);
        $config['notifyUrl'] = BaseUrl::to('payment/ali-notify',true);
        $paymentManager = new AliPaymentManager($config);
        $totalAmount = Yii::$app->securityTools->usdToCny($totalAmount);
        $paymentManager->doPayment($paymentNumber, $totalAmount, $subject);
    }

    private function returnByAliPay() {
        $paymentId = $_REQUEST['out_trade_no'];
        $tradeNo = $_REQUEST['trade_no'];
        $paymentModel = Payment::getPaymentById($paymentId);
        if($paymentModel) {
            $config = Yii::$app->params['aliPayApi'];
            $paymentManager = new AliPaymentManager($config);
            $result = $paymentManager->analyzeNotify();
            if ($result) {
                $paymentModel->makePaymentSuccess($tradeNo, 'aliPay');
                return $paymentModel;
            } else {
                $paymentModel->makePaymentFailure($tradeNo);
                throw new BadRequestHttpException(Yii::t('app/payment','Payment failure.'));
            }
        } else {
            throw new BadRequestHttpException(Yii::t('app/payment','Can\'t find the payment.'));
        }
    }

    public function actionPayPalReturn() {
        try {
            $paymentModel = $this->returnByPayPal();
            return $this->render("paySuccess", ['payment' => $paymentModel]);
        }catch (\Exception $e) {
            throw $e;
        }
    }

    private function payByPayPal($paymentNumber, $totalAmount, $subject) {

        $config = Yii::$app->params['payPalApi'];
        $config['returnUrl'] = BaseUrl::to(['payment/pay-pal-return', 'id'=>$paymentNumber],true);
        $config['cancelUrl'] = BaseUrl::to(['payment/pay-pal-cancel', 'id'=>$paymentNumber],true);
        $paymentManager = new PayPalPaymentManager($config);
        $paymentManager->doPayment($totalAmount, $subject);

    }

    private function returnByPayPal() {
        $paymentId = $_REQUEST['id'];

        $paymentModel = Payment::getPaymentById($paymentId);
        if($paymentModel) {
            $config = Yii::$app->params['payPalApi'];
            $paymentManager = new PayPalPaymentManager($config);
            $tradeNo = $paymentManager->analyzeNotify();
            if ($tradeNo) {
                $paymentModel->makePaymentSuccess($tradeNo, 'payPal');
                return $paymentModel;
            } else {
                $paymentModel->makePaymentFailure($tradeNo);
                throw new BadRequestHttpException(Yii::t('app/payment','Payment failure.'));
            }
        } else {
            throw new BadRequestHttpException(Yii::t('app/payment','Can\'t find the payment.'));
        }

    }
}