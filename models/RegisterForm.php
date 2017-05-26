<?php
/**
 * Created by PhpStorm.
 * User: gaoyi
 * Date: 4/20/17
 * Time: 4:21 PM
 */

namespace app\models;

use app\components\CaptchaAction;
use yii;
use yii\base\Model;

class RegisterForm extends Model
{
    public $email;
    public $userName;
    public $password;
    public $passwordRepeat;
    public $countryID;
    public $invitationCode;
    public $code;

    public function rules()
    {
        return [
            [['userName', 'email', 'password', 'passwordRepeat', 'countryID', 'code'], 'required'],
            ['password', 'string', 'length' => [8, 16]],
            ['passwordRepeat', 'compare', 'compareAttribute'=>'password', 'message' => Yii::t('app/user', 'Passwords don’t match.'),],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => 'app\models\User', 'message' => Yii::t('app/user', 'This Email is already registered, please re-enter.'),],
            ['userName', 'unique', 'targetClass' => 'app\models\User', 'message' => Yii::t('app/user', 'This User Name is already in use, please re-enter.'),],
            ['code', 'codeVerify', 'params' => ['caseSensitive' => false]],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'userName' => Yii::t('app/user', 'User Name'),
            'email' => Yii::t('app/user', 'Email'),
            'password' => Yii::t('app/user', 'Password'),
            'passwordRepeat' => Yii::t('app/user', 'Confirm password'),
            'countryID' => Yii::t('app/user', 'Country'),
            'invitationCode' => Yii::t('app/user', 'Invitation Code'),
            'code' => Yii::t('app/user', 'Code'),
        ];
    }

    public function codeVerify($attribute, $params) {
        $captchaAction = new CaptchaAction('captcha', Yii::$app->controller);
        if($this->$attribute) {
            $code = $captchaAction->getVerifyCode();
            $valid = $params['caseSensitive'] ? ($this->$attribute === $code) : strcasecmp($this->$attribute, $code) === 0;
            if (!$valid) {
                $this->addError($attribute, 'Code Wrong.');
            }
        }
    }
}