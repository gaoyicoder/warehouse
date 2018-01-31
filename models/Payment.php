<?php
/**
 * Created by PhpStorm.
 * User: gaoyi
 * Date: 12/27/17
 * Time: 12:24 AM
 */

namespace app\models;


use yii\db\ActiveRecord;
use app\components\exceptions\ModelException;
use Yii;
use yii\web\BadRequestHttpException;


/**
 * Class Payment
 * @package app\models
 * @property integer $id
 * @property string $tradeNo
 * @property string $orderId
 * @property integer $paymentTypeId
 * @property string $paymentTypeName
 * @property float $subtotalUsd
 * @property float $handingFee
 * @property integer $status
 * @property string $statusDesc
 * @property string $createTime
 * @property string $payTime
 */
class Payment extends ActiveRecord
{
    public function rules() {
        return [
            [['orderId', 'paymentTypeId', 'paymentTypeName', 'subtotalUsd', 'handingFee', 'status', 'statusDesc', 'createTime'], 'required'],
        ];
    }

    public function scenarios(){
        return [
            'create' => ['orderId', 'paymentTypeId', 'paymentTypeName', 'subtotalUsd', 'handingFee', 'status', 'statusDesc', 'createTime'],
            'pay' => ['status', 'statusDesc', 'tradeNo', 'payTime'],
        ];
    }

    public static function createNewPayment(Order $order, $paymentTypeName, $userId) {
        if($order && $paymentTypeName) {
            $payment = new Payment();
            $payment->setScenario('create');
            $payment->id = $payment->generatePaymentId($userId);
            $payment->orderId = $order->id;
            $payment->paymentTypeId = 0;
            $payment->paymentTypeName = $paymentTypeName;
            $payment->subtotalUsd = $order->subtotalUsd;

            $handingFeeRate = Yii::$app->params['paymentType'][$paymentTypeName]['handingFee'] ? Yii::$app->params['paymentType'][$paymentTypeName]['handingFee'] : 0;
            $payment->handingFee = $order->subtotalUsd * $handingFeeRate;
            $payment->status = 0;
            $payment->statusDesc = 'new';
            $payment->setCreateTime();

            if($payment->save()) {
                return $payment;
            } else {
                $error=array_values($payment->getFirstErrors())[0];
                throw new ModelException($error);
            }

        } else {
            throw new ModelException("Empty user or subtotal error.");
        }
    }

    public function setCreateTime() {
        $this->createTime = Yii::$app->securityTools->getCurrentTime("Y-m-d H:i:s");
    }

    public function setPayTime() {
        $this->payTime = Yii::$app->securityTools->getCurrentTime("Y-m-d H:i:s");
    }

    public function makePaymentSuccess($tradeNo, $paymentType) {
        if ($this->id && $this->orderId) {

            //TODO 事务处理
            $db = static::getDb();
            $transaction = $db->beginTransaction();
            try {
                $this->setScenario('pay');
                $this->status = 1;
                $this->statusDesc = 'success';
                $this->tradeNo = $tradeNo;
                $this->setPayTime();
                $this->save();

                $orderModel = Order::getOrderById($this->orderId);
                $orderModel->makeOrderPaid($this->id, $paymentType);
                $transaction->commit();

            } catch (\Exception $e) {
                $transaction->rollBack();
                throw new BadRequestHttpException($e);
            }
        }
    }

    public function makePaymentFailure($tradeNo) {
        if ($this->id) {
            $this->setScenario('pay');
            $this->status = 2;
            $this->statusDesc = 'failure';
            $this->tradeNo = $tradeNo;
            $this->setPayTime();
            $this->save();
        }
    }

    /**
     * @param string $orderId
     * @return null|Payment
     */
    public static function getLastPaymentByOrderId($orderId = '') {
        return self::find()->where(['orderId' => $orderId])->orderBy('createTime DESC')->one();
    }

    /**
     * @param string $id
     * @return Payment
     */
    public static function getPaymentById($id = '') {
        $payment = self::findOne(['id' => $id]);
        return $payment;
    }

    private function generatePaymentId($userId){

        if (is_int($userId)) {
            $userIdLen = strlen($userId);
            if($userIdLen >4) {
                $userCode = substr($userIdLen, -4);
            } else {
                $userCode = $userId;
            }
            $paymentId = time()*10000+$userCode;
            $paymentId = rand(10, 99).$paymentId;

            return $paymentId;
        } else {
            throw new ModelException("User id error.");
        }
    }

}