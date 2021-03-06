<?php
/**
 * Created by PhpStorm.
 * User: gaoyi
 * Date: 6/13/17
 * Time: 1:54 PM
 */

namespace app\controllers;

use yii;
use yii\web\Controller;
use yii\helpers\BaseUrl;

class MemberController extends Controller
{
    public $layout='member';

    public function beforeAction($action) {
        if(parent::beforeAction($action)) {
            $this->view->params['topNav'] = [Yii::t('app/cart', 'My ChinaInAir') => BaseUrl::to("member/index")];

            return true;
        } else {
            return false;
        }
    }

    public function behaviors() {
        return [
            'access' => [
                'class' => yii\filters\AccessControl::className(),
                'only' => ['index'],
                'rules' => [
                    [
                        'allow' => 'true',
                        'actions' => ['index'],
                        'roles' => ['@'],
                    ],
                ],
            ]
        ];
    }

    public function actionIndex() {
//        $this->addNav([Yii::t('app/cart', 'My ChinaInAir1') => BaseUrl::to("member/index")]);
        return $this->render('index',[]);
    }

    private function addNav($nextNav) {
        if($nextNav) {
            $this->view->params['topNav'] = array_merge($this->view->params['topNav'], $nextNav);
        }
    }
}