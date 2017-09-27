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
    public $topNav = [];
    public $layout='member';

    public function beforeAction($action) {
        if(parent::beforeAction($action)) {
            $this->topNav = [Yii::t('app/cart', 'My ChinaInAir') => BaseUrl::to("member/index")];

            return true;
        } else {
            return false;
        }
    }

    public function actionIndex() {
//        $this->addNav([Yii::t('app/cart', 'My ChinaInAir1') => BaseUrl::to("member/index")]);
        return $this->render('index',[]);
    }

    private function addNav($nextNav) {
        if($nextNav) {
            $this->topNav = array_merge($this->topNav, $nextNav);
        }
    }
}