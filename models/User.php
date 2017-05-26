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
 */

class User extends ActiveRecord implements IdentityInterface
{
    const SCENARIO_LOGIN = 'login';
    const SCENARIO_REGISTER = 'register';

    public $password;

    public $authKey;
    public $accessToken;

    public function scenarios()
    {
        return [
            self::SCENARIO_REGISTER => ['userName', 'email', 'password', 'countryID', 'countryName', 'invitationCode', 'registerTime', 'emailActivate', 'status'],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {

    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {

    }

    /**
     * @inheritdoc
     */
    public function getId()
    {

    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {

    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {

    }

    public function beforeSave($insert) {
        if(parent::beforeSave($insert)) {

            if ($insert) {
                $this->setPassword($this->password);
                $this->setCountryName($this->countryID);
                $this->setRegisterTime();
                $this->emailActivate = 0;
                $this->status = 1;
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
}
