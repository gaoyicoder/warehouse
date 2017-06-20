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

class LoginForm extends Model
{
    public $email;
    public $password;
    public $code;
    public $rememberMe = "0";

    private $_user = false;

    public function rules()
    {
        return [
            [['email', 'password', 'code'], 'required'],
            ['email', 'email'],
            ['code', 'codeVerify', 'params' => ['caseSensitive' => false]],
            ['password', 'validatePassword'],
        ];
    }

    public function scenarios() {
        return [
            'default' => ['email', 'password', 'code', 'rememberMe'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'email' => Yii::t('app/user', 'Email'),
            'password' => Yii::t('app/user', 'Password'),
            'code' => Yii::t('app/user', 'Code'),
            'rememberMe' => Yii::t('app/user', 'Remember Me'),
        ];
    }

    public function codeVerify($attribute, $params) {
        $captchaAction = new CaptchaAction('captcha', Yii::$app->controller);
        if($this->$attribute) {
            $code = $captchaAction->getVerifyCode();
            $valid = $params['caseSensitive'] ? ($this->$attribute === $code) : strcasecmp($this->$attribute, $code) === 0;
            if (!$valid) {
                $this->addError($attribute, Yii::t('app/user','Code Wrong.'));
            }
        }
    }

    public function validatePassword($attribute, $params) {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, Yii::t('app/user','Incorrect username or password.'));
            }
        }

    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByEmail($this->email);
        }

        return $this->_user;
    }

    public function login($post) {
        if($this->load($post)) {
            if($this->validate()) {
                $userModel = $this->getUser();
                $userModel->setScenario(User::SCENARIO_LOGIN);
                if ($userModel->save()) {
                    return Yii::$app->user->login($this->getUser(), $this->rememberMe=="1" ? 3600*24*30 : 0);
                }
            }
        }
        return false;
    }
}