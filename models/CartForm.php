<?php
/**
 * Created by PhpStorm.
 * User: gaoyi
 * Date: 8/16/17
 * Time: 7:09 PM
 */

namespace app\models;

use Yii;
use yii\base\Model;

class CartForm extends Model
{
    public $name;
    public $price;
    public $amount;
    public $postFeeType;
    public $url;
    public $shopUrl;
    public $shop;
    public $photoUrl;
    public $remark;
    public $source;


    public function rules() {
        return [
            [['name', 'price', 'amount', 'postFeeType', 'url', 'shopUrl', 'shop', 'photoUrl', 'remark', 'source'], 'required'],
        ];
    }

    public function scenarios() {
        return [
            'default' => ['name', 'price', 'amount', 'postFeeType', 'url', 'shopUrl', 'shop', 'photoUrl', 'remark', 'source'],
        ];
    }

}