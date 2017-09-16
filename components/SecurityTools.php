<?php
/**
 * Created by PhpStorm.
 * User: gaoyi
 * Date: 5/25/17
 * Time: 12:55 PM
 */

namespace app\components;


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
}