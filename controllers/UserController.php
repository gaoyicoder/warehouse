<?php

namespace app\controllers;
use app\models\RegisterForm;
use app\models\User;
use yii\web\Controller;
use yii;
use yii\web\Cookie;
use app\models\Country;
class UserController extends Controller
{
    public function actions() {
        return [
            'captcha' => [
                'class' => 'app\components\CaptchaAction',
//                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
                'maxLength' => 5, //最大显示个数
                'minLength' => 5,//最少显示个数
                'height'=>35,//高度
                'width' => 128,  //宽度
                'offset'=>1,        //设置字符偏移量 有效果
                'foreColor' => 0x0033CC,
                'disturbCharCount' =>1,//干扰字符数量
                'transparent' => false,
            ],
        ];
    }
    public function actionIndex()
    {
//        return $this->render('index');
    }
    public function actionChangeLan($id)
    {
        $cookiesSet = Yii::$app->response->cookies;
        $cookiesSet->add(new Cookie([
            'name' => 'language',
            'value' => $id,
            'expire' => time()+30*24*3600,
        ]));
        Yii::$app->language = Yii::$app->params['availableLanguage'][$id][0];
        $urlReferrer = Yii::$app->request->getReferrer();
        if(!$urlReferrer) {
            $urlReferrer = array('/');
        }
        $this->redirect($urlReferrer);
        return ;
    }

    public function actionRegister() {
        $countyModel = new Country();
        $countyList = $countyModel->find()->all();
        $model = new RegisterForm(); //实例化 Comments model
        return $this->render('register', [
            'countryList' => $countyList,
            'model' => $model
        ]);
    }

    public function actionValidateRegister() {

        $model = new RegisterForm();
        $request = \Yii::$app->getRequest();
        if ($request->isPost && $model->load($request->post())) {
            Yii::$app->response->format = yii\web\Response::FORMAT_JSON;
            return yii\bootstrap\ActiveForm::validate($model);
        } else {
            return null;
        }
    }

    public function actionDoRegister() {
        $model = new RegisterForm();
        $request = \Yii::$app->getRequest();
        if ($request->isPost && $model->load($request->post())) {
            if(!yii\bootstrap\ActiveForm::validate($model)) {
                $userModel = new User();
                $userModel->setScenario(User::SCENARIO_REGISTER);
                $userModel->load($request->post(),'RegisterForm');
                $isValid = $userModel->validate();
                if ($isValid) {
                    if($userModel->save(false)) {
                        echo 111;exit;
                        return $this->render('success', [
                        ]);
                    }
                }
            }
        }
        Yii::error("User didn't pass the validation when do registration.");
        return $this->redirect(['user/register']);
    }

}
