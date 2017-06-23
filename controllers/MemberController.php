<?php
/**
 * Created by PhpStorm.
 * User: gaoyi
 * Date: 6/13/17
 * Time: 1:54 PM
 */

namespace app\controllers;

use Yii;
use yii\web\Controller;

class MemberController extends Controller
{
    public $layout='member';
    public function actionIndex() {
        return $this->render('index',[]);
    }

    public function actionAddUrl() {
        $this->layout='main';
        $urlRules = Yii::$app->params['urlRules'];
        $urlExamples = Yii::$app->params['urlExamples'];
        return $this->render('addUrl',['urlRules' => $urlRules, 'urlExamples' => $urlExamples]);
    }

}