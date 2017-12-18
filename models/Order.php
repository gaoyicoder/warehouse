<?php
/**
 * Created by PhpStorm.
 * User: gaoyi
 * Date: 11/14/17
 * Time: 1:36 PM
 */

namespace app\models;

use app\components\exceptions\ModelException;
use yii\db\ActiveRecord;
use Yii;

/**
 * Class Order
 * @package app\models
 * @property string $id
 * @property integer $userId
 * @property float $subtotal
 * @property float $subtotalUsd
 * @property integer $transactionId
 * @property string $paymentType
 * @property string $createTime
 * @property string $payTime
 * @property string $sendTime
 * @property integer $status
 * @property string $statusDesc
 */

class Order extends ActiveRecord
{
    public function rules() {
        return [
            [['id','userId', 'subtotal', 'createTime', 'status', 'statusDesc'], 'required'],
        ];
    }

    public function scenarios(){
        return [
            'create' => ['id','userId', 'subtotal', 'createTime', 'status', 'statusDesc'],
        ];
    }

    public static function createNewOrder($userId="", $subtotal="") {
        if ($userId && $subtotal) {
            $order = new Order();
            $order->setScenario("create");
            $order->id = $order->generateOrderId($userId);
            $order->userId = $userId;
            $order->subtotal = $subtotal;
            $order->subtotalUsd = Yii::$app->securityTools->cnyToUsd($subtotal);
            $order->setCreateTime();
            $order->status = 0;
            $order->statusDesc = "new";
            if($order->save()) {
                return $order;
            } else {
                $error=array_values($order->getFirstErrors())[0];
                throw new ModelException($error);
            }
        } else {
            throw new ModelException("Empty user or subtotal error.");
        }
    }

    public function setCreateTime() {
        $this->createTime = Yii::$app->securityTools->getCurrentTime("Y-m-d H:i:s");
    }

    public static function getOrderById($id = '') {
        $order = self::findOne(['id' => $id]);
        return $order;
    }

    private function generateOrderId($userId){

        if (is_int($userId)) {
            $userIdLen = strlen($userId);
            if($userIdLen >4) {
                $userCode = substr($userIdLen, -4);
            } else {
                $userCode = $userId;
            }
            $orderId = time()*10000+$userCode;
            $orderId = rand(10, 99).$orderId;

            return $orderId;
        } else {
            throw new ModelException("User id error.");
        }
    }
}