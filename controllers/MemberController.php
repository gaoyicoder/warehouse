<?php
/**
 * Created by PhpStorm.
 * User: gaoyi
 * Date: 6/13/17
 * Time: 1:54 PM
 */

namespace app\controllers;


use yii\web\Controller;

class MemberController extends Controller
{
    public function actionIndex() {
        return $this->render('index',[]);
    }

}