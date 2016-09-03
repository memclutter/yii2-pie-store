<?php

namespace app\models;

use yii\base\Object;
use yii\db\Query;

class ProductAttribute extends Object
{
    public static function getHashMap($type, $idAttribute = 'id', $valueAttribute = 'value')
    {
        return (new Query())
            ->from('{{%attr_' . $type . '}}')
            ->select([$valueAttribute, $idAttribute])
            ->indexBy($idAttribute)
            ->column();
    }
}