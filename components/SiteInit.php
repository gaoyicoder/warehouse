<?php
/**
 * Created by PhpStorm.
 * User: gaoyi
 * Date: 3/29/17
 * Time: 5:00 PM
 */

namespace app\components;


use yii\base\Object;
use yii;
use yii\web\Cookie;

class SiteInit extends Object
{
    static public function beforeRequest() {
        $cookiesGet = Yii::$app->request->cookies;
        if (!$cookiesGet->has('language') || !array_key_exists($cookiesGet->get('language')->__toString(), Yii::$app->params['availableLanguage'])){
            $cookiesSet = Yii::$app->response->cookies;
            $cookiesSet->add(new Cookie([
                'name' => 'language',
                'value' => 'en',
                'expire' => time()+30*24*3600,
            ]));
            Yii::$app->language = Yii::$app->params['availableLanguage']['en'][0];
            Yii::$app->view->params['userLanguage'] = 'en';
        } else {
            $lan = $cookiesGet->get('language')->__toString();
            Yii::$app->view->params['userLanguage'] = $lan;
            Yii::$app->language = Yii::$app->params['availableLanguage'][$lan][0];
        }

    }
}