<?php
/**
 * Created by PhpStorm.
 * User: gaoyi
 * Date: 11/14/17
 * Time: 11:30 PM
 */

namespace app\models;

use app\components\exceptions\ModelException;
use Yii;
use yii\db\ActiveRecord;

/**
 * Class OrderItem
 * @package app\models
 * @property integer $id
 * @property string $name
 * @property float $price
 * @property float $priceUsd
 * @property integer $amount
 * @property integer $postFeeType
 * @property string $postFeeTypeDesc
 * @property string $url
 * @property string $shopUrl
 * @property string $shop
 * @property string $photoUrl
 * @property string $remark
 * @property string $source
 * @property string $cartCookieId
 * @property integer $userId
 * @property string $createTime
 */

class OrderItem extends ActiveRecord
{
    public function rules() {
        return [
            [['name', 'price', 'priceUsd', 'amount', 'postFeeType', 'postFeeTypeDesc', 'url', 'shopUrl', 'shop', 'photoUrl', 'remark', 'source'], 'required'],
        ];
    }

    public function scenarios(){
        return [
            'default' => ['name', 'price', 'priceUsd', 'amount', 'postFeeType', 'postFeeTypeDesc', 'url', 'shopUrl', 'shop', 'photoUrl', 'remark', 'source', 'cartCookieId', 'createTime']
        ];
    }

    public function setCreateTime() {
        $this->createTime = Yii::$app->securityTools->getCurrentTime("Y-m-d H:i:s");
    }

    public static function createOrderItemByCart(Cart $cart = null, $orderId = '') {
        if ($cart && $orderId) {
            $orderItemModel = new OrderItem();
            foreach($orderItemModel as $key=>$value) {
                if ($key != "orderId" && $key != "priceUsd" && $key != 'id') {
                    $orderItemModel->$key = $cart->$key;
                }
            }
            $orderItemModel->orderId = $orderId;
            $orderItemModel->priceUsd = Yii::$app->securityTools->cnyToUsd($orderItemModel->price);
            $orderItemModel->setCreateTime();
            if ($orderItemModel->save()) {
                return $orderItemModel;
            } else {
                $error=array_values($orderItemModel->getFirstErrors())[0];
                throw new ModelException($error);
            }
        } else {
            throw new ModelException("Empty cart or order id error.");
        }
    }
}