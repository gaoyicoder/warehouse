<?php

/**
 * Created by PhpStorm.
 * User: gaoyi
 * Date: 11/15/17
 * Time: 3:57 PM
 */
namespace app\components\exceptions;

class ModelException extends BaseException
{
    public function __toString() {
        $string = parent::__toString();
        return "[Model Exception]".$string;
    }
}