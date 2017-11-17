<?php
/**
 * Created by PhpStorm.
 * User: gaoyi
 * Date: 11/15/17
 * Time: 4:12 PM
 */

namespace app\components\exceptions;


use yii\base\Exception;

class BaseException extends Exception
{
    public function __toString() {
        return $this->file . ": [Line: {$this->line}]: {$this->message}";
    }
}