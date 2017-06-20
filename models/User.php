<?php

namespace app\models;

use yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * @property integer $id;
 * @property string $passwordHash
 * @property string $userName
 * @property string $email
 * @property string $countryID
 * @property string $countryName
 * @property string $invitationCode
 * @property string $registerTime
 * @property string $loginTime
 * @property string $loginIP
 * @property string $emailActivate
 * @property string $status
 * @property string $authKey;
 *
 */

class User extends ActiveRecord implements IdentityInterface
{
    const SCENARIO_LOGIN = 'login';
    const SCENARIO_REGISTER = 'register';

    public $password;
    public $accessToken;

    public function scenarios()
    {
        return [
            self::SCENARIO_REGISTER => ['userName', 'email', 'password', 'countryID', 'countryName', 'invitationCode', 'registerTime', 'emailActivate', 'status', 'authKey'],
            self::SCENARIO_LOGIN => ['loginTime', 'loginIP'],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new yii\base\NotSupportedException("'findIdentityByAccessToken' is not implemented.");
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    public function setAuthKey()
    {
        $this->authKey = Yii::$app->security->generateRandomString();
    }

    public function beforeSave($insert) {
        if(parent::beforeSave($insert)) {

            if ($insert) {
                $this->setPassword($this->password);
                $this->setCountryName($this->countryID);
                $this->setRegisterTime();
                $this->setAuthKey();
                $this->emailActivate = 0;
                $this->status = 1;
            } else {
                $this->setLoginTime();
                $this->setLoginIP();
            }
            return true;

        } else {
            return false;
        }
    }

    public function setPassword($password)
    {
        $this->passwordHash = Yii::$app->securityTools->passwordHash($password);
    }

    public function setCountryName($countryID) {
        $this->countryName = Country::getCountryNameByID($countryID);
    }

    public function setRegisterTime() {
        $this->registerTime = Yii::$app->securityTools->getCurrentTime("Y-m-d H:i:s");
    }

    public function setLoginTime() {
        $this->loginTime = Yii::$app->securityTools->getCurrentTime("Y-m-d H:i:s");
    }

    public function setLoginIP() {
        $this->loginIP = Yii::$app->request->getUserIP();
    }

    public static function findByEmail($email) {
        $user = self::findOne(['email' => $email]);
        return $user;
    }

    public function validatePassword($password) {
        return Yii::$app->securityTools->validatePassword($password, $this->passwordHash);
    }
}
