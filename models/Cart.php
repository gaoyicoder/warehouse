<?php
/**
 * Created by PhpStorm.
 * User: gaoyi
 * Date: 8/28/17
 * Time: 11:45 PM
 */

namespace app\models;


use yii\base\Exception;
use yii\bootstrap\Html;
use yii\db\ActiveRecord;
use Yii;
use yii\db\Transaction;
use yii\web\Cookie;

/**
 * Class Cart
 * @package app\models
 * @property integer $id
 * @property string $name
 * @property float $price
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

class Cart extends ActiveRecord
{

    public function rules() {
        return [
            [['name', 'price', 'amount', 'postFeeType', 'postFeeTypeDesc', 'url', 'shopUrl', 'shop', 'photoUrl', 'remark', 'source'], 'required'],
        ];
    }

    public function scenarios(){
        return [
            'default' => ['name', 'price', 'amount', 'postFeeType', 'postFeeTypeDesc', 'url', 'shopUrl', 'shop', 'photoUrl', 'remark', 'source', 'cartCookieId', 'createTime']
        ];
    }

    public function beforeSave($insert){

        if (parent::beforeSave($insert)) {
            if ($insert) {
                $this->setCreateTime();
            }
            return true;
        } else {
            return false;
        }
    }

    public function setCreateTime() {
        $this->createTime = Yii::$app->securityTools->getCurrentTime("Y-m-d H:i:s");
    }

    public static function findAllByCartCookieId($cartCookieId = "") {
        return self::find()->where(["cartCookieId" => $cartCookieId])->orderBy('createTime DESC')->all();
    }

    public static function findAllByUserId($userId = "") {
        return self::find()->where(["userId" => $userId])->orderBy('createTime DESC')->all();
    }

    public static function findAllByIdsAndUserId($ids = [], $userId = "") {
        return self::find()->where(["id" => $ids, "userId" => $userId])->orderBy('createTime DESC')->all();
    }

    public static function updateAllUserIdByCartCookieId($userId, $cartCookieId) {
        return self::updateAll(["userId" => $userId, "cartCookieId" => ''], "cartCookieId='$cartCookieId'");
    }

    public function updateCartToLoginUser() {

        $cartCookieIdentity = Yii::$app->params['userCartCookieIdentity'];
        $cartCookieId = self::getCartCookieId($cartCookieIdentity);

        if (!Yii::$app->user->isGuest && $cartCookieId != "") {
            self::removeCartCookieId($cartCookieIdentity);
            $userId = Yii::$app->user->id;
            self::updateAllUserIdByCartCookieId($userId, $cartCookieId);
        }
    }

    /**
     * @return static
     */
    public static function updateCartAmountByPost() {
        $result = false;

        $request = \Yii::$app->getRequest();
        if ($request->isPost) {
            $post = $request->post();
            $cartId = $post['cartId'];
            $amount =intval($post['amount']);

            if ($cartId && $amount > 0) {
                $cartModel = Cart::findOne($cartId);
                if ($cartModel->id) {
                    if(Yii::$app->user->isGuest) {
                        $cartCookieIdentity = Yii::$app->params['userCartCookieIdentity'];
                        $cartCookieId = self::getCartCookieId($cartCookieIdentity);
                        if ($cartModel->cartCookieId == $cartCookieId) {
                            $cartModel->amount = $amount;
                            $cartModel->save();
                            $result = $cartModel;
                        }
                    }else {
                        if (Yii::$app->user->id == $cartModel->userId) {
                            $cartModel->amount = $amount;
                            $cartModel->save();
                            $result = $cartModel;
                        }
                    }
                }
            }
        }

        return $result;
    }

    public static function updateCartRemarkByPost() {

        $result = false;

        $request = \Yii::$app->getRequest();
        if ($request->isPost) {
            $post = $request->post();
            $cartId = $post['cartId'];

            $remark =$post['remark'];

            if ($cartId && strlen($remark)<500) {
                $cartModel = Cart::findOne($cartId);
                if ($cartModel->id) {
                    if(Yii::$app->user->isGuest) {
                        $cartCookieIdentity = Yii::$app->params['userCartCookieIdentity'];
                        $cartCookieId = self::getCartCookieId($cartCookieIdentity);
                        if ($cartModel->cartCookieId == $cartCookieId) {
                            $cartModel->remark = $remark;
                            $cartModel->save();
                            $result = $cartModel;
                        }
                    }else {
                        if (Yii::$app->user->id == $cartModel->userId) {
                            $cartModel->remark = $remark;
                            $cartModel->save();
                            $result = $cartModel;
                        }
                    }
                }
            }
        }

        return $result;
    }

    public static function getCartList() {
        $cartList = [];
        if (Yii::$app->user->isGuest) {
            $cartCookieIdentity = Yii::$app->params['userCartCookieIdentity'];
            $cartCookieId = self::getCartCookieId($cartCookieIdentity);

            //this line is for the new arrivals who don't have cart cookie
            if (!$cartCookieId) {
                $cartCookieId = self::getCartResponseCookieId($cartCookieIdentity);
            }
            if ($cartCookieId) {
                $cartList = self::findAllByCartCookieId($cartCookieId);
            }
        } else {
            $userId = Yii::$app->user->id;

            if ($userId) {
                $cartList = self::findAllByUserId($userId);
            }
        }
        return $cartList;
    }

    public static function getCartTotalMoney() {

        $totalMoney = 0;
        if (Yii::$app->user->isGuest) {
            $cartCookieIdentity = Yii::$app->params['userCartCookieIdentity'];
            $cartCookieId = self::getCartCookieId($cartCookieIdentity);

            //this line is for the new arrivals who don't have cart cookie
            if (!$cartCookieId) {
                $cartCookieId = self::getCartResponseCookieId($cartCookieIdentity);
            }

            if ($cartCookieId) {
                $totalMoney = self::getTotalMoneyByCookieId($cartCookieId);
            }
        } else {
            $userId = Yii::$app->user->id;

            if ($userId) {
                $totalMoney = self::getTotalMoneyByUserId($userId);
            }
        }
        return $totalMoney;

    }

    public static function getCartShopTotalMoney($shop) {
        $totalMoney = 0;
        if (Yii::$app->user->isGuest) {
            $cartCookieIdentity = Yii::$app->params['userCartCookieIdentity'];
            $cartCookieId = self::getCartCookieId($cartCookieIdentity);

            //this line is for the new arrivals who don't have cart cookie
            if (!$cartCookieId) {
                $cartCookieId = self::getCartResponseCookieId($cartCookieIdentity);
            }

            if ($cartCookieId) {
                $totalMoney = self::getShopTotalMoneyByCookieId($cartCookieId,$shop);
            }
        } else {
            $userId = Yii::$app->user->id;

            if ($userId) {
                $totalMoney = self::getShopTotalMoneyByUserId($userId,$shop);
            }
        }
        return $totalMoney;
    }

    public static function getTotalMoneyByCookieId($cookieId) {
        $where = ["cartCookieId" => $cookieId];
        return self::getTotalMoneyByWhere($where);
    }

    public static function getTotalMoneyByUserId($userId = '') {
        $where = ["userId" => $userId];
        return self::getTotalMoneyByWhere($where);
    }

    public static function getShopTotalMoneyByCookieId($cookieId = '',$shop = '') {
        $where = ["cartCookieId" => $cookieId, "shop" => $shop];
        return self::getTotalMoneyByWhere($where);
    }

    public static function getShopTotalMoneyByUserId($userId = '',$shop = '') {

        $where = ["userId" => $userId, "shop" => $shop];
        return self::getTotalMoneyByWhere($where);
    }

    public static function getTotalMoneyByIdsAndUserId($ids = [], $userId = '') {
        $where = ["id" => $ids, "userId" => $userId];
        return self::getTotalMoneyByWhere($where);
    }

    public static function getTotalMoneyByWhere($where) {
        return self::find()->where($where)->sum('price*amount');
    }

    public static function deleteCartByPost() {
        $result = false;

        $request = \Yii::$app->getRequest();
        if ($request->isPost) {
            $post = $request->post();
            $cartId = $post['cartId'];
            if ($cartId) {
                $cartModel = Cart::findOne($cartId);
                if ($cartModel->id) {
                    if(Yii::$app->user->isGuest) {
                        $cartCookieIdentity = Yii::$app->params['userCartCookieIdentity'];
                        $cartCookieId = self::getCartCookieId($cartCookieIdentity);
                        if ($cartModel->cartCookieId == $cartCookieId) {
                            $cartModel->delete();
                            $result = true;
                        }
                    }else {
                        if (Yii::$app->user->id == $cartModel->userId) {
                            $cartModel->delete();
                            $result = true;
                        }
                    }
                }
            }
        }
        return $result;
    }

    public static function deleteCartByIds($ids = []) {
        $result = false;

        if($ids != []) {
            if(Yii::$app->user->isGuest) {
                $cartCookieIdentity = Yii::$app->params['userCartCookieIdentity'];
                $cartCookieId = self::getCartCookieId($cartCookieIdentity);
                $result = Cart::deleteAll(['id' => $ids, 'cartCookieId' => $cartCookieId]);

            } else {
                $userId = Yii::$app->user->id;
                $result = Cart::deleteAll(['id' => $ids, 'userId' => $userId]);
            }
        }

        return $result;
    }

    public static function combineOrderByIds($ids = []) {
        $result = false;

        if($ids != []) {
            $userId = Yii::$app->user->id;
            $cartList = Cart::findAllByIdsAndUserId($ids, $userId);
            if($cartList) {
                //TODO 事务处理
                $db = static::getDb();
                $transaction = $db->beginTransaction();
                try {
                    $subtotal = Cart::getTotalMoneyByIdsAndUserId($ids, $userId);
                    $orderModel = Order::createNewOrder($userId, $subtotal);

                    foreach($cartList as $cart) {
                        OrderItem::createOrderItemByCart($cart, $orderModel->id);
                    }
                    Cart::deleteCartByIds($ids);
                    $result = $orderModel->id;
                    $transaction->commit();

                } catch (Exception $e) {
                    $transaction->rollBack();
                    Yii::error($e);
                    $result = false;
                }

            }
        }

        return $result;
    }

    public function addCart($post) {

        if($this->load($post, "")) {
            if($this->postFeeType == 0) {
                $this->postFeeTypeDesc = Yii::t('app/cart','Free or low cost delivery');;
            } else {
                $this->postFeeTypeDesc = Yii::t('app/cart','Fastest delivery');
            }
            if ($this->validate()) {
                $this->name = Html::encode($this->name);
                $cartCookieIdentity = Yii::$app->params['userCartCookieIdentity'];
                $cartCookieId = self::getCartCookieId($cartCookieIdentity);
                if(Yii::$app->user->isGuest) {
                    if ($cartCookieId == "") {
                        $this->cartCookieId = $this->sendCartCookieIdentity($cartCookieIdentity, 3600*24*30);
                    } else {
                        $this->cartCookieId = $cartCookieId;
                    }
                } else {
                    $this->userId = Yii::$app->user->id;
                }

                if ($this->save()) {
                    return true;
                }
            }
        }
        return false;
    }

    public function sendCartCookieIdentity($cookieName, $duration)  {
        $identity = Yii::$app->securityTools->createUuid("cci");
        $cookie = new Cookie(['name' => $cookieName]);
        $cookie->value = $identity;
        $cookie->expire = time() + $duration;
        Yii::$app->getResponse()->getCookies()->add($cookie);
        return $identity;
    }

    public static function getCartCookieId($cookieName) {
        return Yii::$app->getRequest()->getCookies()->getValue($cookieName);
    }

    public static function getCartResponseCookieId($cookieName) {
        return Yii::$app->getResponse()->getCookies()->getValue($cookieName);
    }

    public static function removeCartCookieId($cookieName) {
        Yii::$app->getResponse()->getCookies()->remove(new Cookie(['name' => $cookieName]));
    }
}