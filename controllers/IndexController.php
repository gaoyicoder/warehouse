<?php

namespace app\controllers;

use yii\web\Controller;

class IndexController extends Controller
{
    public function behaviors() {
        return [];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {

        return $this->render('index');
    }

}
