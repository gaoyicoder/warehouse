<?php
/**
 * Created by PhpStorm.
 * User: gaoyi
 * Date: 8/28/17
 * Time: 11:45 PM
 */

namespace app\models;


use yii\db\ActiveRecord;
use Yii;
use yii\web\Cookie;

/**
 * Class Cart
 * @package app\models
 * @property integer $id
 * @property string $name
 * @property float $price
 * @property integer $amount
 * @property integer $postFeeType
 * @property string $url
 * @property string $shopUrl
 * @property string $shop
 * @property string $photoUrl
 * @property string $remark
 * @property string $source
 * @property string $cartCookieId
 * @property integer userId
 */

class Cart extends ActiveRecord
{
    public function rules() {
        return [
            [['name', 'price', 'amount', 'postFeeType', 'url', 'shopUrl', 'shop', 'photoUrl', 'remark', 'source'], 'required'],
        ];
    }

    public function scenarios(){
        return [
            'default' => ['name', 'price', 'amount', 'postFeeType', 'url', 'shopUrl', 'shop', 'photoUrl', 'remark', 'source', 'cartCookieId']
        ];
    }

    public static function findAllByCartCookieId($cartCookieId) {
        return self::findAll(["cartCookieId" => $cartCookieId]);
    }

    public static function findAllByUserId($userId) {
        return self::findAll(["userId" => $userId]);
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

    public static function getCartList() {
        $cartList = [];
        if (Yii::$app->user->isGuest) {
            $cartCookieIdentity = Yii::$app->params['userCartCookieIdentity'];
            $cartCookieId = self::getCartCookieId($cartCookieIdentity);

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

    public function addCart($post) {
        if($this->load($post, "")) {
            if ($this->validate()) {

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

    public static function removeCartCookieId($cookieName) {
        Yii::$app->getResponse()->getCookies()->remove(new Cookie(['name' => $cookieName]));
    }
}