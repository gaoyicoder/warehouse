<?php
/**
 * Created by PhpStorm.
 * User: gaoyi
 * Date: 11/17/17
 * Time: 4:41 PM
 */

namespace app\controllers;


use yii\web\Controller;
use yii;

class OrderController extends Controller
{
    public function behaviors() {
        return [
            'access' => [
                'class' => yii\filters\AccessControl::className(),
                'only' => ['pay-order'],
                'rules' => [
                    [
                        'allow' => 'true',
                        'actions' => ['pay-order'],
                        'roles' => ['@'],
                    ],
                ],
            ]
        ];
    }
    public function actionPayOrder($id) {
        echo Yii::$app->getTimeZone();
        return $this->render("payOrder", []);
    }
}