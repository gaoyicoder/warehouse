<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "country".
 *
 * @property string $id
 * @property string $name
 */
class Country extends ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'country';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            ['name', 'string', 'max' => 52],
        ];
    }

    /**
     * @param $id
     * @return String
     */
    static public function getCountryNameByID($id) {
        $country = self::findOne($id);
        return $country->name;
    }
}
