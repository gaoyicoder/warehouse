<?php
/**
 * Created by PhpStorm.
 * User: gaoyi
 * Date: 5/25/17
 * Time: 12:55 PM
 */

namespace app\components;
use Yii;

class SecurityTools
{
    public function passwordHash($password) {

        $salt = "";
        $salt = $salt . substr($password, 0,1);
        $salt = $salt . substr($password, -1,1);
        return md5($password.$salt);
    }


    /**
     * @param $password
     * @param $hash
     * @return bool whether the password is correct.
     */
    public function validatePassword($password, $hash) {
        $salt = "";
        $salt = $salt . substr($password, 0,1);
        $salt = $salt . substr($password, -1,1);
        return md5($password.$salt) == $hash;
    }

    public function getCurrentTime($format) {

        return gmdate($format);
    }

    public function createUuid($prefix = ""){
        $str = md5(uniqid(mt_rand(), true));
        $uuid  = substr($str,0,8) . '-';
        $uuid .= substr($str,8,4) . '-';
        $uuid .= substr($str,12,4) . '-';
        $uuid .= substr($str,16,4) . '-';
        $uuid .= substr($str,20,12);
        return $prefix . $uuid;
    }

    public function cnyToUsd($cny) {
        $usdRate = Yii::$app->params['usdRate'];
        if(is_numeric($usdRate)) {
            return $this->formatNum($cny/$usdRate, 2);
        } else {
            return $this->formatNum($cny/6.10, 2);
        }
    }

    public function usdToCny($usd) {
        $usdRate = Yii::$app->params['usdRate'];
        if(is_numeric($usdRate)) {
            return $this->formatNum($usd*$usdRate, 2);
        } else {
            return $this->formatNum($usd*6.10, 2);
        }
    }

    public function formatNum($num1, $num2) {
        if (is_null($num1) || is_null($num2)) {
            return 0;
        } else {
           return round($num1, $num2);
        }
    }

}