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


/**
 * Class Payment
 * @package app\models
 * @property integer $id
 * @property string $orderId
 * @property integer $paymentTypeId
 * @property string $paymentTypeName
 * @property float $subtotalUsd
 * @property float $handingFee
 * @property integer $status
 * @property string $statusDesc
 * @property string $createTime
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
        ];
    }

    public static function createNewPayment(Order $order, $paymentTypeName) {
        if($order && $paymentTypeName) {
            $payment = new Payment();
            $payment->setScenario('create');
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

    /**
     * @param string $orderId
     * @return null|Payment
     */
    public static function getLastPaymentByOrderId($orderId = '') {
        return self::find()->where(['orderId' => $orderId])->orderBy('createTime DESC')->one();
    }
}